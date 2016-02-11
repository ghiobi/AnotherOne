<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/

include_once 'Scheduler/Schedule.php';
include_once 'Scheduler/ScheduleGenerator.php';

include_once 'Scheduler/GroupSection.php';
include_once 'Scheduler/GroupSectionGenerator.php';

include_once 'Scheduler/TimeBlock.php';
include_once 'Scheduler/TutorialBlock.php';
include_once 'Scheduler/LaboratoryBlock.php';
include_once 'Scheduler/TutorialBlock.php';

class Scheduler extends CI_Model
{
	private $semester_id;

	function __construct()
	{
		parent::__construct();
	}

	function init($semester_id)
	{
		$this->semester_id = $semester_id;
	}

	/**
	 * @return mixed
	 */
	function getHello()
	{
		return 'Hello';
	}

}