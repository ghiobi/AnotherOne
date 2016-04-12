<?php

/**
 * Class CourseAddException the parent of all the adding courses exceptions.
 */
class CourseAddException extends \Exception{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}

class CourseAlreadyListedException extends CourseAddException{
    public function __construct($message = NULL){
        if(!$message)
            $message = 'Course already listed.';
        parent::__construct($message);
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