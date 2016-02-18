<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/

include_once 'Helper/Schedule.php';
include_once 'Helper/ScheduleGenerator.php';

include_once 'Helper/GroupSection.php';
include_once 'Helper/GroupSectionGenerator.php';

include_once 'Helper/Block.php';
include_once 'Helper/LectureBlock.php';
include_once 'Helper/LaboratoryBlock.php';
include_once 'Helper/TutorialBlock.php';

class Scheduler extends CI_Model
{
	private $semester_id;
	public $main_schedule;

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
	}

	public function init($semester_id)
	{
		$this->semester_id = $semester_id;

		$registered_sections = $this->student->getRecordBySemester($this->semester_id);

		$sectionGroups = [];
		foreach ($registered_sections as $sect) {
			array_push($sectionGroups, $this->groupSectionFactory($sect->course_id, $sect->section_id, $sect->tutorial_id, $sect->laboratory_id));
		}

		$this->main_schedule = new Scheduler\Schedule($sectionGroups);
	}

	public function getMainSchedule()
	{
		return $this->getPossibleSchedule()->toJSON();
	}

	public function getPossibleSchedule()
	{
		$temp = clone $this->main_schedule;
		for($i = 1; $i < 110; $i++){
			if($i == 28) continue;
			if(!$groups = $this->getPossibleGroups($i))
				continue;
			foreach($groups as $group)
			{
				if($temp->addSection($group))
				{
					break;
				}
			}
		}
		return $temp;
	}

	public function getPossibleGroups($course_id)
	{
		if(!$sections = $this->section->getSection($this->semester_id, $course_id))
			return FALSE;

		$course = $this->course->getByID($course_id);

		$combo = [];

		foreach($sections as $section)
		{
			if(!$section['lect'])
				continue;

			$lectures = [];

			foreach($section['lect'] as $lect)
			{
				$obj = new Scheduler\LectureBlock($lect->id, $lect->room, $lect->start, $lect->end, $lect->weekday);
				array_push($lectures, $obj);
			}

			//Objectifying every tutorial
			$tutorials = [];
			if($section['tuts'])
			{
				foreach ($section['tuts'] as $tut)
				{
					$obj = new Scheduler\TutorialBlock($tut->id, $tut->instructor, $tut->letter, $tut->capacity, $tut->room, $tut->start, $tut->end, $tut->weekday);
					array_push($tutorials, $obj);
				}
			}

			//Objectifying every laboratory
			$laboratories = [];
			if($section['labs'])
			{
				foreach ($section['labs'] as $lab)
				{
					$obj = new Scheduler\LaboratoryBlock($lab->id, $lab->instructor, $lab->letter, $lab->capacity, $lab->room, $lab->start, $lab->end, $lab->weekday);
					array_push($laboratories, $obj);
				}
			}

			if($laboratories && $tutorials)
			{
				foreach($laboratories as $laboratory)
				{
					foreach($tutorials as $tutorial)
					{
						$group = new Scheduler\GroupSection($course_id, $course->name, $course->code, $course->number, $section['sect']->id, $section['sect']->professor, $section['sect']->capacity, $section['sect']->letter, $lectures, $tutorial, $laboratory);
						array_push($combo, $group);
					}
				}
			}

			elseif($tutorials && !$laboratories)
			{
				foreach($tutorials as $tutorial)
				{
					$group = new Scheduler\GroupSection($course_id, $course->name, $course->code, $course->number, $section['sect']->id, $section['sect']->professor, $section['sect']->capacity, $section['sect']->letter, $lectures, $tutorial, NULL);
					array_push($combo, $group);
				}
			}

			elseif(!$tutorials && $laboratories)
			{
				foreach($laboratories as $laboratory)
				{
					$group = new Scheduler\GroupSection($course_id, $course->name, $course->code, $course->number, $section['sect']->id, $section['sect']->professor, $section['sect']->capacity, $section['sect']->letter, $lectures, NULL, $laboratory);
					array_push($combo, $group);
				}
			}
			else{
				$group = new Scheduler\GroupSection($course_id, $course->name, $course->code, $course->number, $section['sect']->id, $section['sect']->professor, $section['sect']->capacity, $section['sect']->letter, $lectures, NULL, NULL);
				array_push($combo, $group);
			}
		}
		return $combo;
	}

	public function searchCourse(){
		
	}

	public function groupSectionFactory($course_id, $section_id, $tutorial_id = NULL, $laboratory_id = NULL)
	{

		$tutorial = NULL;
		if($tutorial_id != NULL) {
			$obj = $this->tutorial->getByID($tutorial_id);
			$tutorial = new Scheduler\TutorialBlock($obj->id, $obj->instructor, $obj->letter, $obj->capacity, $obj->room, $obj->start, $obj->end, $obj->weekday);
		}

		$laboratory = NULL;
		if($laboratory_id != NULL){
			$obj = $this->laboratory->getByID($laboratory_id);
			$laboratory = new Scheduler\LaboratoryBlock($obj->id, $obj->instructor, $obj->letter, $obj->capacity, $obj->room, $obj->start, $obj->end, $obj->weekday);
		}

		$lectArray = [];
		$lectures = $this->lecture->getLecturesBySectID($section_id);

		foreach($lectures as $obj){
			array_push($lectArray, new Scheduler\LectureBlock($obj->id, $obj->room, $obj->start, $obj->end, $obj->weekday));
		}

		$section = $this->section->getBySectID($section_id);
		$course = $this->course->getByID($course_id);

		return new Scheduler\GroupSection($course_id, $course->name, $course->code, $course->number, $section_id, $section->professor, $section->capacity, $section->letter, $lectArray, $tutorial, $laboratory);
	}

}