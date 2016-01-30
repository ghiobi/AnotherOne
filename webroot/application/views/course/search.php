<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<main class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php if(validation_errors() || isset($error_message)): ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong>
                    <?php echo validation_errors();
                    if (isset($error_message))
                        echo $error_message;
                    ?>

                </div>
            <?php endif; ?>
            <?php echo form_open('courses/sections', ['class' => 'form-horizontal']); ?>
                <div class="form-group">
                    <label for="semester" class="col-sm-2 control-label">Semester</label>
                    <div class="col-sm-10">
                        <select name="semester" id="semester" class="form-control">
                            <?php
                                foreach($available_semesters as $semester)
                                    echo '<option value="'.url_title($semester->name).'">'.$semester->name.'</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_code" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Course Code">
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_number" class="col-sm-2 control-label">Number</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="course_number" name="course_number" placeholder="Course Number">
                    </div>
                </div>
                <input type="submit" class="btn btn-info pull-right" name="search" value="Search!">
            </form>
        </div>
    </div>
</main>