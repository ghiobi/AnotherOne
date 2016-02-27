<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
include_once 'Helper/Schedule.php';
include_once 'Helper/ScheduleGenerator.php';

include_once 'Helper/GroupSection.php';

include_once 'Helper/Block.php';
include_once 'Helper/LectureBlock.php';
include_once 'Helper/LaboratoryBlock.php';
include_once 'Helper/TutorialBlock.php';

class Scheduler extends CI_Model
{
	private $semester_id;
	private $student_id;

	public $main_schedule;
	public $registered_course_list;
	public $adding_courses_list;
	public $preferences;

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
	 * Initializes the schedule object
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
		$this->registered_course_list = $this->main_schedule->getRegisteredCourseList();
		$this->adding_courses_list = [];
	}

	/**
	 * Drops a section in the main schedule and in the database.
	 *
	 * @param $hash_id - the hash id of the registered section, kept on the client side.
	 * @return bool/oject - false if drop was successful - usually should be true all the time unless hacking.
	 */
	public function dropSection($hash_id)
	{
		//Removing section from main schedule, it returns the section_group
		$section_group = $this->main_schedule->removeSection($hash_id);

		//Usually doesn't not return false. Just a checkpoint.
		if($section_group === FALSE)
			return FALSE;

		//Delete Record from database
		$register_id = $section_group->getRegisterId();

		$section_group->setRegisterId(NULL);

		$this->db->where('id', $register_id);
		$this->db->delete('registered');

		$serialize = serialize($section_group);
		$ciphered_section = $this->encryption->encrypt($serialize);

		//Returns the encrypted section object.
		return $ciphered_section;
	}

	/**
	 * @param $section_group
	 * @return mixed
	 */
	public function undoDropSection($encrpyted_section)
	{
		$serialized_section_group = $this->encryption->decrypt($encrpyted_section);
		$section_group = unserialize($serialized_section_group);

		//Registered section back to database.
		$register_id = $this->addSectionRecordToDB($section_group);
		//TODO: Does not check if the database insertion is a failure

		$section_group->setRegisterId($register_id);

		return $this->main_schedule->addSection($section_group);
	}

	/**
	 * Adds a group section to the registered table. Returns the register id
	 *
	 * @param $section_id
	 * @param $tutorial_id
	 * @param $laboratory_id
	 * @return $register_id
	 */
	public function addSectionRecordToDB($section_group)
	{
		$student_id = $this->student_id;
		$section_id = $section_group->getSectionId();

		$tutorial_id = $section_group->getTutorialId();
		if($tutorial_id)
			$tutorial_id = "'" . $tutorial_id . "'";
		else
			$tutorial_id = 'NULL';

		$laboratory_id = $section_group->getLaboratoryId();
		if($laboratory_id)
			$laboratory_id = "'" . $laboratory_id . "'";
		else
			$laboratory_id = 'NULL';

		$this->db->query("
			INSERT INTO
			  registered
				(student_id, section_id, tutorial_id, laboratory_id)
			VALUES
				('$this->student_id', '$section_id', $tutorial_id, $laboratory_id)");

		$register_id = $this->db->query("SELECT LAST_INSERT_ID() AS  inserted_id")->row()->inserted_id;

		//TODO: needs to return false if insertion is a fail.

		return $register_id;
	}

	/**
	 * Transfers the new generated schedule as the main schedule.
	 *
	 * @param $encrypted_schedule
	 */
	public function transferNewSchedule($encrypted_schedule)
	{

	}

	/**
	 * Returns a possible list of courses the student can take.
	 */
	public function autoPickCourse()
	{
		
	}

	/**
	 * Returns possible generated schedules.
	 *
	 * @param course_list - Courses to add
	 * @return array
	 */
	public function generateSchedules($course_list = [1, 2])
	{
		$schedules = [];
		$course_groups = [];

		foreach($course_list as $course) {
			array_push($course_groups, $this->getPossibleGroups($course));
		}

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
			$clone = clone $current_schedule;

			//If current_course is not end index of the number of courses to add, recurse if successful group add.
			if($current_course != $num_courses)
			{
				if($clone->addUnregistered($courses[$current_course][$i]))
				{
					$this->generator($current_course + 1, $num_courses, $clone, $stack, $courses);
				}
			}
			else //If this is the last course, and successful in adding group in last course, push to stack.
			{
				if($clone->addUnregistered($courses[$current_course][$i]))
				{
					$serialize = serialize($clone);
					$ciphered = $this->encryption->encrypt($serialize);

					array_push($stack, [$clone , $ciphered]);
				}
			}
		}
	}

	/**
	 * Returns an array of all section combination groups of section lectures, tutorials, and laboratories
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

	/**
	 * TODO: Return true if course is a valid takable course.
	 *
	 * @param $course_id
	 * @return bool
	 */
	public function validateCourse($course_id)
	{

	}

	/**
	 * TODO:Adds a course to the list
	 * + Assumes the search has already filtered out invalid courses
	 *
	 * Actions:
	 * + Generates a possible section combinations of the course.
	 * + Adds the course to the list;
	 *
	 * @param
	 * @return int - number of possible sections.
	 */
	public function addCourseToList($course)
	{

	}

	/**
	 * TODO: Returns a valid list of encrypted course ids and their full names
	 * Course must be:
	 * + Takable, refer to student model
	 * + Available in semester
	 *
	 * @param $search_string - encrypted course id of course
	 * @return string - JSON
	 */
	public function courseSearch($search_string)
	{

	}

	/**
	 * Used for initializing schedule. Returns the Objectified Group Section of a registered table.
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
	 * Returns the encoded JSON string of a schedule Object
	 *
	 * @return string
	 */
	public function getMainSchedule()
	{
		return json_encode($this->main_schedule, JSON_NUMERIC_CHECK);
	}

}