<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/

include_once 'Scheduler/Schedule.php';
include_once 'Scheduler/ScheduleGenerator.php';

include_once 'Scheduler/GroupSection.php';
include_once 'Scheduler/GroupSectionGenerator.php';

include_once 'Scheduler/Block.php';
include_once 'Scheduler/LectureBlock.php';
include_once 'Scheduler/LaboratoryBlock.php';
include_once 'Scheduler/TutorialBlock.php';

class Scheduler extends CI_Model
{
	private $semester_id;
	private $main_schedule;

	function __construct()
	{
		parent::__construct();

		//Loading useful models for the scheduler;
		$this->load->model('student');
		$this->load->model('section');
		$this->load->model('lecture');
		$this->load->model('tutorial');
		$this->load->model('laboratory');
	}

	function init($semester_id)
	{
		$this->semester_id = $semester_id;

		$registered_sections = $this->student->getRecordBySemester($this->semester_id);

		$sectionGroups = [];
		foreach ($registered_sections as $sect) {
			array_push($sectionGroups, $this->groupSectionFactory($sect->course_id, $sect->section_id, $sect->tutorial_id, $sect->laboratory_id));
		}

		$this->main_schedule = new Scheduler\Schedule($sectionGroups);
		die($this->main_schedule->toJSON());
	}
	
	function groupSectionFactory($course_id, $section_id, $tutorial_id = NULL, $laboratory_id = NULL)
	{

		$tutorial = NULL;
		if($tutorial_id != NULL) {
			$obj = $this->tutorial->getByID($tutorial_id);
			$tutorial = new Scheduler\TutorialBlock($obj->id, $obj->room, $obj->instructor, $obj->letter, $obj->capacity, $obj->start, $obj->end, $obj->weekday);
		}

		$laboratory = NULL;
		if($laboratory_id != NULL){
			$obj = $this->laboratory->getByID($laboratory_id);
			$laboratory = new Scheduler\LaboratoryBlock($obj->id, $obj->room, $obj->instructor, $obj->letter, $obj->capacity, $obj->start, $obj->end, $obj->weekday);
		}

		$lectArray = [];
		$lectures = $this->lecture->getLecturesBySectID($section_id);

		foreach($lectures as $obj){
			array_push($lectArray, new Scheduler\LectureBlock($obj->id, $obj->room, $obj->start, $obj->end, $obj->weekday));
		}

		$section = $this->section->getBySectID($section_id);

		return new Scheduler\GroupSection($course_id, $section_id, $section->professor, $section->capacity, $section->letter, $lectArray, $tutorial, $laboratory);
	}

}