<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<main class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php
                $details = $results['course'];
                $sections = $results['sections'];
            ?>


            <h3><?php echo $details['code'].' '.$details['number'].' '.$details['name'].' '.$details['credit']; ?></h3>

            <?php foreach($sections as $section): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Section: <?php echo $section['info']['letter'] ?> Professor: <?php echo $section['info']['professor'] ?> Capacity: <?php echo $section['info']['capacity'] ?>
                    </div>
                    <table class="table table-condensed table-bordered">
                        <tbody>
                            <tr><th>Lectures</th></tr>
                            <?php
                                foreach($section['lect'] as $lecture) {
                                    echo '<tr><td>' . $lecture['room'] . '</td><td>' . $lecture['start'] . '</td><td>' . $lecture['end'] . '</td><td>' . jddayofweek($lecture['weekday'], 1) . '</td></tr>';
                                }
                                if($section['tuts'])
                                {
                                    echo '<tr><th>Tutorials</th></tr>';
                                    foreach ($section['tuts'] as $tutorial)
                                        echo '<tr><td>' . $tutorial['room'] . '</td><td>' . $tutorial['start'] . '</td><td>' . $tutorial['end'] . '</td><td>' . jddayofweek($tutorial['weekday'], 1) . '</td></tr>';
                                }

                                if($section['labs'])
                                {
                                    echo '<tr><th>Laboratories</th></tr>';
                                    foreach ($section['labs'] as $laboratory)
                                        echo '<tr><td>' . $laboratory['room'] . '</td><td>' . $laboratory['start'] . '</td><td>' . $laboratory['end'] . '</td><td>' . date($laboratory['weekday']) . '</td></tr>';
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
