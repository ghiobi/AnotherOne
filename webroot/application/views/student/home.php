<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<main class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>Welcome Back, <?php echo $name ?>.</h4>
			<div>
				<a class="front-menu" href="<?php echo site_url('students/profile') ?>"><i class="glyphicon glyphicon-user"></i> Student Profile</a>
				<a class="front-menu" role="button" data-toggle="collapse" href="#enroll" aria-expanded="false" aria-controls="collapseExample">
					<i class="glyphicon glyphicon-pencil"></i> Register Now
				</a>
				<div class="collapse" id="enroll">
					<ul class="front-dropdown">
						<!--Printing all available semesters-->
						<?php foreach($semesters as $semester): ?>
							<li><a href="<?= site_url('students/enroll/'.$semester->slug) ?>"><?= $semester->name ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<a class="front-menu" style="margin-top: 10px" href="<?php echo site_url('courses/sections') ?>"><i class="glyphicon glyphicon-search"></i> View Available Courses</a>
				<a class="front-menu" role="button" data-toggle="collapse" href="#view-schedule" aria-expanded="false" aria-controls="collapseExample">
					<i class="glyphicon glyphicon-calendar"></i> View Schedule</a>
				<div class="collapse" id="view-schedule">
					<ul class="front-dropdown">
						<!--Printing all available semesters-->
						<?php foreach($semesters as $semester): ?>
							<li><a href="<?= site_url('students/view/'.$semester->slug) ?>"><?= $semester->name ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6" style="margin-top: 39px">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bullhorn fa-lg"></i> 
					Breaking News
				</div>
				<div class="panel-body">
					<div id="notice-slider" class="carousel slide sidebar-slider" data-interval="10000" data-ride="carousel">
						<div class="carousel-inner">

							<?php
							if ($news === FALSE):
								echo 'Had trouble connecting to New York Times.';
							else:
								for($i = 0; $i < 10; $i++): ?>
									<div class="<?php if($i == 0) echo 'active' ;?> item">
										<h4><a target="_blank" href="<?php echo $news[$i]['url'] ?>" ><?php echo $news[$i]['title'] ?></a></h4>
										<p><?php echo $news[$i]['abstract'] ?></p>
									</div>
								<?php endfor;
							endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<h4 style="margin-bottom: 17px">Course Sequence for <?= $progress['program_name'] ?>
		<span class="pull-right">
			<small>
				<div style="height: 10px; width: 10px; display: inline-block; background-color: green"></div>
				Completed or In Progress
				<div style="height: 10px; width: 10px; display: inline-block; background-color: yellow"></div>
				Can take
			</small>
		</span>
	</h4>
		<?php

			$sequence = $progress['progress'];

			//If the array sequence is greater then 0 then display the seq
			if(count($sequence) > 0):
				$semester = $sequence[0]['semester'];

				$index = 0;
				while($index < count($sequence)){

					//This tries to format three semesters in one row
					if(($semester - 1) % 3 == 0)
						echo'<div class="row">';

					echo '<div class="col-md-4">
						<h5>Semester '.$semester.'</h5>
						<ul class="list-group">';

					//If the semester is the not the same semester then it will create a new list group.
					while($semester == $sequence[$index]['semester']){

						echo '<li class="list-group-item';
						if($sequence[$index]['completed'])
							echo ' list-group-item-success';
						else if($sequence[$index]['takable'])
							echo ' list-group-item-warning';
						echo '">' . $sequence[$index]['name'] . '</li>';

						$index++;

					}

					echo '</ul>
					</div>';

					if(($semester) % 3 == 0)
						echo'</div>';

					//increments new semester from every new semester
					$semester++;
				}

				//If the last semester was not closed by a div, then this will close it.
				if($semester > 1 && ($semester - 1) % 3 != 0)
					echo'</div>';

			endif;

		?>
</main>
