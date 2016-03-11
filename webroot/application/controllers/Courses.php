<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  The courses controller deals with viewing courses/sections and courses.
 */
class Courses extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function sections($SEMESTER = NULL, $COURSECODE = NULL, $NUMBER = NULL)
    {
        //Loading header
        if($SEMESTER != NULL || $COURSECODE != NULL || $NUMBER != NULL)
            $data['info_bar'] = '<a href="'.site_url('courses/sections').'"><i class="glyphicon glyphicon-info-sign"></i> New Search</a>';
        else
            $data['info_bar'] = '<i class="glyphicon glyphicon-info-sign"></i> Tip! Enter the subject and click search!';

        $this->load->view('layouts/header.php', $data);

        $this->load->model('section');
        $this->load->model('semester');

        if($SEMESTER == NULL && $COURSECODE == NULL && $NUMBER == NULL)
        {
            //Get form input info, semester, course code, and course number
            if($this->input->post('search', TRUE)){

                $semester = $this->input->post('semester', TRUE);
                $course_code = $this->input->post('course_code', TRUE);
                $course_number = $this->input->post('course_number', TRUE);

                $this->form_validation->set_rules('semester', 'Semester', 'trim|required');
                $this->form_validation->set_rules('course_code', 'Course Code', ($course_number)?'trim|required':'trim');
                $this->form_validation->set_rules('course_number', 'Course Number', 'trim');

                if($this->form_validation->run() === FALSE)
                {
                    goto search;
                }

                //If the parameters are filled refresh to ;
                redirect("courses/sections/".$semester."/$course_code/$course_number", 'refresh');

                return;
            }

        }
        else{

            $results = $this->section->getAllSections($this->semester->getIdBySlug($SEMESTER), $COURSECODE, $NUMBER);

            if($results == FALSE) {
                $data['error_message'] = '<p>No results were found!</p>';
                goto search;
            }

            $data['results'] = $results;
            $this->load->view('course/result.php', $data);

            goto footer;
        }

        search:
        $data['available_semesters'] = $this->semester->getSemesters();
        $this->load->view('course/search.php', $data);

        footer:
        $this->load->view('layouts/footer.php');
    }

}
