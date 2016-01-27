<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Since this extends CI_Controller and not App_Base_Controller. This search can be made available.
 * TODO: reconstruct the class description formally.
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
        $data['info_bar'] = 'Page description';
        $this->load->view('layouts/header.php', $data);

        $this->load->model('Course');

        if($SEMESTER == NULL || $COURSECODE == NULL || $NUMBER == NULL){
            //Home page, load form.
            $this->load->view('course/search.php');

            //1. Get form input info, semester, course code, and course number

            //2. if the parameters are filled refresh to redirect('courses/$semester/$coursecode/$number', 'refresh');
        }
        else{
            //if there are no results to the parameters inputted load search.php with error messages
            if(true){
                die('No Results Found');
            }
            $this->load->view('course/search.php');

            //else load another view with the results.
        }

        //Loading footer
        $this->load->view('layouts/footer.php');
    }

}
?>