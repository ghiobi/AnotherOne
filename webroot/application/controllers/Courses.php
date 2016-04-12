<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  The courses controller deals with viewing courses/sections and courses.
 *
 *  This class extends directly from the CI_Controller which means it can be accessed without logging in.
 */
class Courses extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function sections($SEMESTER = NULL, $COURSECODE = NULL, $NUMBER = NULL)
    {
        //Loading header and models
        if($SEMESTER != NULL || $COURSECODE != NULL || $NUMBER != NULL)
            $data['info_bar'] = '<a href="'.site_url('courses/sections').'"><i class="glyphicon glyphicon-info-sign"></i> New Search</a>';
        else
            $data['info_bar'] = '<i class="glyphicon glyphicon-info-sign"></i> Tip! Enter the subject and click search!';

        $this->load->view('layouts/header.php', $data);

        $this->load->model('section');
        $this->load->model('semester');

        //Parameters being inputted into the url, if none are inputted then display the search page.
        if($SEMESTER == NULL && $COURSECODE == NULL && $NUMBER == NULL)
        {
            //Get form input info, semester, course code, and course number
            if($this->input->post('search', TRUE)){

                $semester = $this->input->post('semester', TRUE);
                $course_code = $this->input->post('course_code', TRUE);
                $course_number = $this->input->post('course_number', TRUE);

                //Validating form.
                $this->form_validation->set_rules('semester', 'Semester', 'trim|required');
                $this->form_validation->set_rules('course_code', 'Course Code', ($course_number)?'trim|required':'trim');
                $this->form_validation->set_rules('course_number', 'Course Number', 'trim');

                if($this->form_validation->run() === FALSE)
                {
                    goto search;
                }

                //If the parameters are filled refresh this same controller which will pass into the else block
                redirect("courses/sections/".$semester."/$course_code/$course_number", 'refresh');

                return;
            }

        }
        else{
            //Slug is the url format of the semester name, if not found go back to search.
            if(!$semester = $this->semester->getBySlug($SEMESTER))
                goto search;

            //Fetching all results according to input.
            $results = $this->section->getAllSections($semester->id, $COURSECODE, $NUMBER);

            if($results == FALSE) {
                $data['error_message'] = '<p>No results were found!</p>';
                goto search;
            }

            //If results are found lost the result page with the data.
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
