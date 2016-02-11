<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']?>

<main class="container">

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

        <?php
        
            function my_time($time){
                return date('H:i', strtotime($time));
            }

            foreach ($results as $course):

                $details = $course['course'];
                $sections = $course['section'];
        ?>

                <h4 class="text-center" style="margin: 30px 0"><?php echo $details->code.' '.$details->number.' '.$details->name.' '.$details->credit; ?></h4>

                <?php foreach($sections as $section): ?>

                    <div class="panel panel-default">

                        <div class="panel-heading text-center">
                            <div>
                                <div class="pull-left"><?= $section['sect']->letter ?></div>
                                <?= $section['sect']->professor ?>
                                <div class="pull-right"><?= $section['sect']->capacity ?></div>
                            </div>
                        </div>

                        <table class="table table-condensed table-bordered">

                            <thead><tr><th>Section</th><th>Instructor</th><th>Capacity</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Weekday</th></tr></thead>

                            <tbody>

                                <tr><th colspan="7">Lectures</th></tr>

                                <?php

                                    foreach($section['lect'] as $lecture)
                                    {
                                        echo '<tr><td colspan="3"></td><td>' . $lecture->room . '</td><td>' . my_time($lecture->start) . '</td><td>' . my_time($lecture->end) . '</td><td>' . $weekday[$lecture->weekday] . '</td></tr>';
                                    }

                                    if($section['tuts'])
                                    {
                                        echo '<tr><th colspan="7">Tutorials</th></tr>';
                                        foreach ($section['tuts'] as $tutorial)
                                            echo '<tr><td>' . $tutorial->letter . '</td><td>' . $tutorial->instructor . '</td><td>' . $tutorial->capacity . '</td><td>' . $tutorial->room . '</td><td>' . my_time($tutorial->start) . '</td><td>' . my_time($tutorial->end) . '</td><td>' . $weekday[$tutorial->weekday] . '</td></tr>';
                                    }

                                    if($section['labs'])
                                    {
                                        echo '<tr><th colspan="7">Laboratories</th></tr>';
                                        foreach ($section['labs'] as $laboratory)
                                            echo '<tr><td>' . $laboratory->letter . '</td><td>' . $laboratory->instructor . '</td><td>' . $laboratory->capacity . '</td><td>' . $laboratory->room . '</td><td>' . my_time($laboratory->start) . '</td><td>' . my_time($laboratory->end) . '</td><td>' . $weekday[$laboratory->weekday] . '</td></tr>';
                                    }

                                ?>

                            </tbody>

                        </table>

                    </div>

                <?php endforeach; ?>

            <?php endforeach; ?>

        </div>

    </div>

</main>
