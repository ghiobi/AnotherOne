<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: TheChosenOne
 * Date: 2016-04-12
 * Time: 8:34 AM
 */
class UnitTest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }

    public function index()
    {
        echo '<a href="'.base_url('unittest/blocktest').'">BlockTest</a><br>';
        echo '<a href="'.base_url('unittest/gradetest').'">GradeTest</a><br>';
    }

    public function BlockTest()
    {
        include ('C:\Users\TheChosenOne\Desktop\AnotherOne\webroot\application\models\Helper\Block.php');

        //Test 1
        $block_1 = new Scheduler\Block('12:00:00', '13:00:00', 1);
        $block_2 = new Scheduler\Block('12:00:00', '13:00:00', 1);
        $expected_result = true;

        $this->unit->run($block_1->overlaps($block_2), $expected_result,'Block 1 does overlap block 2.'
            , 'Same time, same day.');

        //Test 2
        $block_1 = new Scheduler\Block('12:00:00', '13:00:00', 1);
        $block_2 = new Scheduler\Block('12:00:00', '13:00:00', 2);
        $expected_result = false;

        $this->unit->run($block_1->overlaps($block_2), $expected_result,'Block 1 does not overlap block 2.'
            , 'Same time, different days.');

        //Test 3
        $block_1 = new Scheduler\Block('12:00:00', '13:00:00', 1);
        $block_2 = new Scheduler\Block('13:05:00', '13:10:00', 1);
        $expected_result = false;

        $this->unit->run($block_1->overlaps($block_2), $expected_result,'Block 1 does not overlap block 2.'
            , 'Block 1 ends at 13:00:00 and Block 2 starts at 13:10:00.');

        //Test 4
        $block_1 = new Scheduler\Block('12:00:00', '13:00:00', 1);
        $block_2 = new Scheduler\Block('11:05:00', '12:10:00', 1);
        $expected_result = true;

        $this->unit->run($block_1->overlaps($block_2), $expected_result,'Block 1 does overlap block 2.'
            , 'Block 2 ends at 12:10:00 and Block 2 starts at 12:00:00.');

        echo $this->unit->report();
    }

    public function GradeTest()
    {
        include ('C:\Users\TheChosenOne\Desktop\AnotherOne\webroot\application\models\Helper\Grade.php');

        //Test 1
        $grade_1 = new Grade('A+');
        $expected_result = true;

        $this->unit->run($grade_1->passed('C+'), $expected_result,'Grade A- passed course grade of C+.');

        //Test 2
        $grade_1 = new Grade('D+');
        $expected_result = false;

        $this->unit->run($grade_1->passed('C+'), $expected_result,'Grade D- failed course grade of C+.');

        //Test 3
        $grade_1 = new Grade('');
        $expected_result = true;

        $this->unit->run($grade_1->passed('C+'), $expected_result,'Empty Grade (Pending Grade), conditional pass.');

        //Test 3
        $grade_1 = new Grade('D-');
        $expected_result = true;

        $this->unit->run($grade_1->passed('D-'), $expected_result,'Grade D- passed course grade of D-.');


        echo $this->unit->report();

    }

    public function ()
    {
        
    }
}