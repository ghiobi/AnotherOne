<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'Helper/Grade.php';
include_once 'Helper/CourseAddException.php';

include_once 'Helper/Schedule.php';
include_once 'Helper/GroupSection.php';

include_once 'Helper/Block.php';
include_once 'Helper/PreferenceBlock.php';
include_once 'Helper/RoomBlock.php';
include_once 'Helper/LectureBlock.php';
include_once 'Helper/LaboratoryBlock.php';
include_once 'Helper/TutorialBlock.php';

/**
 * Class Scheduler manages the student's schedule and enrollment process.
 *
 * This classes is divided into 7 parts:
 * + Course Registration
 * + Schedule Generation
 * + Search
 * + Course Management
 * + Course List
 * + Preferences
 * + Factory
 */
class Scheduler extends CI_Model
{
	private $semester_id;
	private $student_id;
	private $search_course_list;
	private $course_sequence;

	//Main Schedule;
	public $main_schedule;

	//Keeps track of registered/unregistered courses associative arrays HASH
	public $registered_course_list;
	public $generator_course_list;

	//Preferences
	public $preference_blocks;

	public function __construct()
	{
		parent::__construct();

		//Loading useful models for the scheduler;
		$this->load->model('student');
		$this->load->model('course');
		$this->load->model('section');
		$this->load->model('lecture');
		$this->load->model('tutorial');
		$this->load->model('laboratory');

		//Loading libraries
		$this->load->library('encryption');
		$this->encryption->initialize([
			'cipher' => 'blowfish',
			'mode' => 'cbc'
		]);
	}

	/**
	 * Initializes the schedule object by retrieving the current schedule of this semester.
	 *
	 * @param $semester_id
	 */
	public function init($semester_id)
	{
		$this->semester_id = $semester_id;

		$registered_sections = $this->student->getRecordBySemester($this->semester_id);

		$sectionGroups = [];
		foreach ($registered_sections as $sect) {
			array_push($sectionGroups, $this->buildGroupSection(
				$sect->id,
				$sect->course_id,
				$sect->section_id,
				$sect->tutorial_id,
				$sect->laboratory_id
			));
		}

		$this->student_id = $this->student->getID();
		$this->main_schedule = new Scheduler\Schedule($sectionGroups, []);

		$this->search_course_list = [];
		$this->preference_blocks = [];

		$this->registered_course_list = $this->main_schedule->getCourseList();
		$this->generator_course_list = [];
	}

	/**
	 * Returns the encoded JSON string of a schedule Object
	 *
	 * @return string
	 */
	public function getMainSchedule()
	{
		return json_encode($this->main_schedule, JSON_NUMERIC_CHECK);
	}

	/**************************************************** Course Registration ***********************************************************/

	/**
	 * Drops a section in the main schedule and in the database.
	 *
	 * @param $hash_id - the hash id of the registered section, kept on the client side.
	 * @return bool/oject - false if drop was successful - usually should be true all the time unless hacking.
	 */
	public function drop($hash_id)
	{
		//Removing section from main schedule, it returns the section_group
		$section_group = $this->main_schedule->removeSection($hash_id);

		//Usually doesn't not return false. Just a checkpoint.
		if($section_group === FALSE)
			return FALSE;

		//TODO: prevent drop when there is a co-requisite course.

		//Delete Record from database
		$register_id = $section_group->getRegisterId();

		$section_group->setRegisterId(NULL);

		$this->db->where('id', $register_id);
		$this->db->delete('registered');

		$serialize = serialize($section_group);
		$ciphered_section = $this->encryption->encrypt($serialize);

		$this->registered_course_list = $this->main_schedule->getCourseList();

		//Returns the encrypted section object.
		return $ciphered_section;
	}

	/**
	 * @param $section_group
	 * @return mixed
	 */
	public function undo_drop($encrpyted_section)
	{
		if(!$serialized_section_group = $this->encryption->decrypt($encrpyted_section))
			return FALSE;

		$section_group = unserialize($serialized_section_group);

		//Registered section back to database.
		$section_group = $this->record_section($section_group);
		//TODO: Does not check if the database insertion is a failure

		$success = $this->main_schedule->addSection($section_group);

		//Refreshes the registered course list
		$this->registered_course_list = $this->main_schedule->getCourseList();

		return $success;
	}

	/**
	 * Adds a group section to the registered table record. Returns the register id
	 *
	 * @param $section_group
	 * @return mixed
	 */
	public function record_section($section_group)
	{
		$section_id = $section_group->getSectionId();

		//Preparing tutorial_id for SQL
		$tutorial_id = $section_group->getTutorialId();
		if($tutorial_id)
			$tutorial_id = "'" . $tutorial_id . "'";
		else
			$tutorial_id = 'NULL';

		//Preparing laboratory_id for SQL
		$laboratory_id = $section_group->getLaboratoryId();
		if($laboratory_id)
			$laboratory_id = "'" . $laboratory_id . "'";
		else
			$laboratory_id = 'NULL';

		//Inserting record to database
		$this->db->query("INSERT INTO registered
			(student_id, section_id, tutorial_id, laboratory_id)
				VALUES ('$this->student_id', '$section_id', $tutorial_id, $laboratory_id)");

		$register_id = $this->db->query("SELECT LAST_INSERT_ID() AS  inserted_id")->row()->inserted_id;

		//Sets the registeration_id;
		$section_group->setRegisterId($register_id);

		return $section_group;
	}

	/**
	 * Transfers the new generated schedule as the main schedule.
	 *
	 * @param $encrypted_schedule
	 */
	public function apply_new_schedule($encrypted_schedule)
	{
		//Decrypting selected schedule and unserializing string.
		if(!$serialized_schedule = $this->encryption->decrypt($encrypted_schedule))
			return FALSE;

		$schedule = unserialize($serialized_schedule);

		//getting unregistered sections and emptying list
		$unregistered_sections = $schedule->getUnregistered();
		$schedule->setUnregistered([]);

		//for each section/course add the section to schedule
		foreach($unregistered_sections as $section)
		{
			$section = $this->record_section($section);
			$schedule->addSection($section);
		}

		//sets the schedule as the main schedule.
		$this->main_schedule = $schedule;

		$this->generator_course_list = [];
		$this->registered_course_list = $this->main_schedule->getCourseList();

		return TRUE;
	}

	/**************************************************** Schedule Generation ***********************************************************/
	
	/**
	 * Returns possible generated schedules.
	 *
	 * @param course_list - Courses to add
	 * @return array
	 */
	public function generateSchedules()
	{
		$schedules = [];
		$course_groups = [];

		foreach($this->generator_course_list as $course)
			array_push($course_groups, $course['sections']);

		//if the array is empty return array array
		if(!$course_groups)
			return [];

		$this->generator(0, count($course_groups) - 1, $this->main_schedule, $schedules, $course_groups);

		return $schedules;
	}

	/**
	 * Generator generates all possible valid schedules into an array.
	 *
	 * @param $current_course - Keeps track of current course
	 * @param $num_courses - Number of courses being added
	 * @param Scheduler\Schedule $current_schedule - The current schedule
	 * @param $stack - Stack of possible schedules
	 * @param $courses - Two dimensional ragged array. [course][possible group sections]
	 */
	private function generator($current_course, $num_courses, $current_schedule, &$stack, $courses)
	{
		for ($i = 0; $i < count($courses[$current_course]); $i++)
		{
			//Clone the current schedule
			$schedule = clone $current_schedule;

			//If current_course is not end index of the number of courses to add, recurse if successful group add.
			if($current_course != $num_courses)
			{
				if($schedule->addUnregistered($courses[$current_course][$i]))
				{
					$this->generator($current_course + 1, $num_courses, $schedule, $stack, $courses);
				}
			}
			else //If this is the last course, and successful in adding group in last course, push to stack.
			{
				if($schedule->addUnregistered($courses[$current_course][$i]))
				{
					//If a preference overlaps, skip the addition.
					foreach($this->preference_blocks as $pref_block)
					{
						if($schedule->overlapsUnregistered($pref_block)){
							goto skip_add;
						}
					}

					//Addes the schedule to the stack if successful
					$serialize = serialize($schedule);
					$ciphered = $this->encryption->encrypt($serialize);
					array_push($stack, [$schedule , $ciphered]);

					skip_add:
				}
			}
		}
	}

	/**************************************************** Search ***********************************************************/

	/**
	 * Returns the search course list array to the client.
	 *
	 * @return string
	 */
	public function searchCourseList()
	{
		if(!$this->search_course_list){
			$this->db->cache_on();
			$course_list = [];

			foreach($this->course->getAvailableBySemester($this->semester_id) as $course){
				array_push($course_list, ['label' => $course->code.' '.$course->number.' '.$course->name,
					'hash' => $this->encryption->encrypt($course->id)]);
			}

			$this->db->cache_off();
			$this->search_course_list = json_encode($course_list, JSON_NUMERIC_CHECK);
		}
		return $this->search_course_list;
	}

	/**************************************************** Course Management ***********************************************************/

	/**
	 * Checks if the current student has completed the course.
	 *
	 * @param $course_id
	 * @return bool
	 * @throws Exception
	 */
	public function is_complete($course_id){

		$passing_grade = $this->course->getPassingGrade($course_id);

		$grades = $this->db->query("
			SELECT
			  registered.grade
			FROM registered
			  INNER JOIN sections
				ON registered.section_id = sections.id
			  INNER JOIN semesters
				ON sections.semester_id = semesters.id
			WHERE sections.course_id = '$course_id' AND semesters.id < '$this->semester_id' AND registered.student_id = '$this->student_id'")->result();

		foreach($grades as $grade){

			if(!$grade->grade)
				return TRUE;

			$mark = new Grade($grade->grade);
			if($mark->passed($passing_grade));
				return TRUE;

		}

		return FALSE;
	}

	/*
	 * Automatically adds one courses to the generator list.
	 */
	public function auto_pick_course()
	{
		if($this->course_sequence == NULL){
			$this->course_sequence = $this->db->query("
			SELECT DISTINCT
			  sections.course_id
			FROM students
			  INNER JOIN programsequence
				ON students.program_id = programsequence.program_id
			  INNER JOIN sections
				ON programsequence.course_id = sections.course_id
			  INNER JOIN semesters
				ON sections.semester_id = semesters.id
			WHERE students.id = '$this->student_id' AND semesters.id = '$this->semester_id'")->result();
		}

		do{
			$try_again = false;
			try{
				$course = $this->course_sequence[array_rand($this->course_sequence)];
				if($this->is_complete($course->course_id))
					throw new CourseAlreadyListedException();
				$this->add_to_generator($course->course_id);
			} catch(RequisitesNotMetException $e){
				$try_again = true;
			} catch(CourseAlreadyListedException $e){
				$try_again = true;
			} catch (CourseAddException $e){
				return 'Cannot add another course. '. $e->getMessage();
			}
		} while($try_again);

		return NULL;
	}

	/**
	 * This functions interacts with the user to add a course from an exncrypted course_id
	 * @param $encrypted_course_id
	 * @return null|string
	 */
	public function add_course($encrypted_course_id)
	{
		if(! $course_id = $this->encryption->decrypt($encrypted_course_id))
			return 'Course hash did not match.';

		try {
			$this->add_to_generator($course_id);
		} catch(PrerequisiteNotMetException $e) {
			return $e->getMessage();
		} catch (CorequisiteNotMetException $e) {
			return $e->getMessage();
		} catch (CourseAddException $e) {
			return $e->getMessage();
		}

		return NULL;
	}

	/**
	 * Actions:
	 * + Generates a possible section combinations of the course.
	 * + Adds the course to the list;
	 *
	 * @param $course_id
	 * @throws Exception
	 */
	public function add_to_generator($course_id)
	{
		//Checking if course id already exists in current semester
		if(array_key_exists($course_id, $this->registered_course_list))
			throw new CourseAlreadyInRegistered();

		if(array_key_exists($course_id, $this->generator_course_list))
			throw new CourseAlreadyAdded();

		$num_combinations = 1;
		foreach($this->generator_course_list as $course)
			$num_combinations *= $course['count'];

		if($num_combinations > 5000)
			throw new ExceedsMaxCombinationException();

		$max_num_course = 5; //TODO: this must be located somewhere else
		if(count($this->registered_course_list) + count($this->generator_course_list) >= $max_num_course)
			throw new ExceedsMaxCoursesException(5);

		//get course prerequisites
		$pre_req = $this->course->getPrerequisites($course_id);
		//get course corequisites
		$co_req = $this->course->getCorequisites($course_id);

		//for each pre check complete
		foreach($pre_req as $pre){

			if(! $this->is_complete($pre->prerequisite_course_id)){

				$course_name = $this->course->getCourseName($pre->prerequisite_course_id);
				throw new PrerequisiteNotMetException($course_name);
			}

		}

		//for each co check complete
		foreach($co_req as $co){

			if( ! $this->is_complete($co->corequisite_course_id)
				&& ! (key_exists($co->corequisite_course_id, $this->registered_course_list))) {
				$course_name = $this->course->getCourseName($co->prerequisite_course_id);
				throw new CorequisiteNotMetException($course_name);
			}

		}

		//Generates possible sections and adds course to section.
		$possible_sections = $this->getPossibleGroups($course_id);
		$this->generator_course_list[$course_id] = [
			'count' => count($possible_sections),
			'name' => $possible_sections[0]->course_subject.' '.$possible_sections[0]->course_number.' '.$possible_sections[0]->course_name,
			'sections' => $possible_sections,
		];
	}

	/**
	 * Removes course from generator list
	 * 
	 * @param $course_id
	 * @return bool - True if successful removal
	 */
	public function remove_from_generator($course_id)
	{
		if(array_key_exists($course_id, $this->generator_course_list)){
			unset($this->generator_course_list[$course_id]);
			return 'Course removed from generator.';
		}
		return FALSE;
	}

	/**************************************************** Course List ***********************************************************/

	/**
	 * This function is called every time there is an add, autopick, remove registered course, drop, and commit.
	 *
	 * @return json
	 */
	public function get_course_list()
	{
		$unreg_list = [];
		foreach($this->generator_course_list as $key => $course)
		{
			$unreg_list[$key] = [
				'count' => $course['count'],
				'name' => $course['name']
			];
		}
		$array = [
			'registered' => $this->registered_course_list,
			'unregistered' => $unreg_list
		];
		return json_encode($array, JSON_NUMERIC_CHECK);
	}

	/**************************************************** PREFERENCE ***********************************************************/

	/**
	 * Adds a time preference object to the preference_block list.
	 *
	 * @param $json_array - an array of prefrences in JSON format
	 * @return string - returns empty string if success
	 */
	public function addTimePreference($json_array)
	{
		$array_blocks = json_decode($json_array);

		$bad_count = 0;
		foreach($array_blocks as $block)
		{
			$time_block = new \Scheduler\PreferenceBlock($block['start'], $block['end'], $block['weekday']);

			//If the preference overlaps the main schedule then skip.
			if(!$this->main_schedule->overlapsRegistered($time_block)){

				//If a preference overlaps another preference then skip
				foreach($this->preference_blocks as $pref_block){
					if($pref_block->overlaps($time_block))
						goto end;
				}

				//generates a unique identifier and then addes it the array.
				$this->preference_blocks[spl_object_hash($time_block)] = $time_block;
				continue;
			}
			end: $bad_count++;
		}

		//If there were incompatible preferences then a message
		return ($bad_count)? 'Could not add '.$bad_count.' preferences.' : '';
	}

	/**
	 * Removes a time preference by the inputted object hash code
	 *
	 * @param $object_hashcode
	 * @return null|string - returns a message if successful
	 */
	public function removeTimePreference($object_hashcode){
		if(array_key_exists($object_hashcode, $this->preference_blocks)){
			unset($this->preference_blocks[$object_hashcode]);
			return 'Successfully removed time block';
		}
		return NULL;
	}

	/**
	 * Returns all the preferences in JSON
	 *
	 * @return string
	 */
	public function getTimePreferences()
	{
		return json_encode($this->preference_blocks, JSON_NUMERIC_CHECK);
	}

	/****************************************************FACTORY***********************************************************/

	/**
	 * Used for initializing schedules.
	 * Returns the Objectified Group Section of a registered section row in the database.
	 *
	 * @param $course_id
	 * @param $section_id
	 * @param null $tutorial_id
	 * @param null $laboratory_id
	 * @return \Scheduler\GroupSection
	 */
	public function buildGroupSection($register_id, $course_id, $section_id, $tutorial_id = NULL, $laboratory_id = NULL)
	{

		$tutorial = NULL;
		if($tutorial_id != NULL) {
			$obj = $this->tutorial->getByID($tutorial_id);
			$tutorial = new Scheduler\TutorialBlock(
				$obj->id, $obj->instructor,
				$obj->letter, $obj->capacity,
				$obj->room, $obj->start,
				$obj->end, $obj->weekday
			);
		}

		$laboratory = NULL;
		if($laboratory_id != NULL){
			$obj = $this->laboratory->getByID($laboratory_id);
			$laboratory = new Scheduler\LaboratoryBlock(
				$obj->id, $obj->instructor,
				$obj->letter, $obj->capacity,
				$obj->room, $obj->start,
				$obj->end, $obj->weekday
			);
		}

		$lectArray = [];
		$lectures = $this->lecture->getLecturesBySectID($section_id);

		foreach($lectures as $obj){
			array_push($lectArray,
				new Scheduler\LectureBlock(
				$obj->id, $obj->room,
				$obj->start, $obj->end,
				$obj->weekday)
			);
		}

		$section = $this->section->getBySectID($section_id);
		$course = $this->course->getByID($course_id);

		return new Scheduler\GroupSection(
			$register_id,
			$course_id, $course->name,
			$course->code, $course->number,
			$section_id, $section->professor,
			$section->capacity, $section->letter,
			$lectArray, $tutorial, $laboratory
		);
	}

	/**
	 * Returns an array of all section combination groups containing lectures, tutorials, and laboratories of a course.
	 *
	 * @param $course_id
	 * @return array|bool
	 */
	public function getPossibleGroups($course_id)
	{
		if(!$sections = $this->section->getSection($this->semester_id, $course_id))
			return FALSE;

		$course = $this->course->getByID($course_id);

		$combo = [];

		foreach($sections as $section)
		{
			if(!$section['lect']) //If section has no lectures skip. Invalid data filtering.
				continue;

			$lectures = [];

			foreach($section['lect'] as $lect)
			{
				$obj = new Scheduler\LectureBlock(
					$lect->id, $lect->room,
					$lect->start, $lect->end,
					$lect->weekday
				);
				array_push($lectures, $obj);
			}

			//Objectifying every tutorial
			$tutorials = [];
			if($section['tuts'])
			{
				foreach ($section['tuts'] as $tut)
				{
					$obj = new Scheduler\TutorialBlock(
						$tut->id, $tut->instructor,
						$tut->letter, $tut->capacity,
						$tut->room, $tut->start,
						$tut->end, $tut->weekday
					);
					array_push($tutorials, $obj);
				}
			}

			//Objectifying every laboratory
			$laboratories = [];
			if($section['labs'])
			{
				foreach ($section['labs'] as $lab)
				{
					$obj = new Scheduler\LaboratoryBlock(
						$lab->id, $lab->instructor,
						$lab->letter, $lab->capacity,
						$lab->room, $lab->start,
						$lab->end, $lab->weekday
					);
					array_push($laboratories, $obj);
				}
			}
			//If there are laboratories and tutorials
			if($laboratories && $tutorials)
			{
				foreach($laboratories as $laboratory)
				{
					foreach($tutorials as $tutorial)
					{
						$group = new Scheduler\GroupSection(
							NULL,
							$course_id, $course->name,
							$course->code,
							$course->number,
							$section['sect']->id,
							$section['sect']->professor,
							$section['sect']->capacity,
							$section['sect']->letter,
							$lectures, $tutorial, $laboratory
						);
						array_push($combo, $group);
					}
				}
			}
			//If there are tutorials but not laboratories
			elseif($tutorials && !$laboratories)
			{
				foreach($tutorials as $tutorial)
				{
					$group = new Scheduler\GroupSection(
						NULL,
						$course_id, $course->name,
						$course->code,
						$course->number,
						$section['sect']->id,
						$section['sect']->professor,
						$section['sect']->capacity,
						$section['sect']->letter,
						$lectures, $tutorial, NULL
					);
					array_push($combo, $group);
				}
			}
			//If there are no tutorials but has laboratories
			elseif(!$tutorials && $laboratories)
			{
				foreach($laboratories as $laboratory)
				{
					$group = new Scheduler\GroupSection(
						NULL,
						$course_id, $course->name,
						$course->code,
						$course->number,
						$section['sect']->id,
						$section['sect']->professor,
						$section['sect']->capacity,
						$section['sect']->letter,
						$lectures, NULL, $laboratory
					);
					array_push($combo, $group);
				}
			}
			//If there are not tutorials or laboraties.
			else{
				$group = new Scheduler\GroupSection(
					NULL,
					$course_id, $course->name,
					$course->code,
					$course->number,
					$section['sect']->id,
					$section['sect']->professor,
					$section['sect']->capacity,
					$section['sect']->letter,
					$lectures, NULL, NULL);
				array_push($combo, $group);
			}
		}

		return $combo;
	}

}