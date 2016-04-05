<?php
/**
 * Created by PhpStorm.
 * User: TheChosenOne
 * Date: 2016-03-08
 * Time: 4:59 PM
 */

class CourseAddException extends \Exception{

}

class CourseAlreadyListedException extends CourseAddException{
    public function __construct($message){
        parent::__construct('Course already listed.');
    }
}

class CourseAlreadyInRegistered extends CourseAlreadyListedException{
    public function __construct(){
        parent::__construct('Course already registered.');
    }
}

class CourseAlreadyAdded extends CourseAlreadyListedException{
    public function __construct(){
        parent::__construct('Course already added.');
    }
}

class ExceedsMaxCoursesException extends CourseAddException{
    public function __construct($max_course){
        parent::__construct('Exceeds the maximum number of courses per semester, '. $max_course.'.');
    }
}
class ExceedsMaxCombinationException extends CourseAddException{
    public function __construct(){
        parent::__construct('Exceeds the maximum number of calculations please commit and then add more courses.');
    }
}

class RequisitesNotMetException extends CourseAddException{
    public function __construct($message){
        parent::__construct($message);
    }
}

class PrerequisiteNotMetException extends RequisitesNotMetException{
    public function __construct($course_name){
        parent::__construct('Prerequisite not complete: '. $course_name);
    }
}

class CorequisiteNotMetException extends RequisitesNotMetException{
    public function __construct($course_name){
        parent::__construct('Co-requisite not complete: '. $course_name);
    }
}