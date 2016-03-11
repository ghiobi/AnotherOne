<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<main class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>Welcome Back, <?php echo $name ?>.</h4>
			<div>
				<a class="front-menu" href="<?php echo site_url('students/profile') ?>"><i class="glyphicon glyphicon-user"></i> Student Profile</a>
				<div class="dropdown front-menu">
					<div class="dropdown-toggle" type="button" id="enroll-semester" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<i class="glyphicon glyphicon-pencil"></i> Register Now
					</div>
					<!-- /TODO: transform to collapsible menu-->
					<ul class="dropdown-menu front-dropdown" aria-labelledby="enroll-semester">
						<?php foreach($semesters as $semester): ?>
							<li><a href="<?= site_url('students/enroll/'.$semester->slug) ?>"><?= $semester->name ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<!--
				<a class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				  Button with data-target
				</a>
				<div class="collapse" id="collapseExample">
				  <div class="well">
					...
				  </div>
				</div>
				-->
				<a class="front-menu" href="<?php echo site_url('courses/sections') ?>"><i class="glyphicon glyphicon-search"></i> View Available Courses</a>
				<a class="front-menu" href="<?php echo site_url('students/view') ?>"><i class="glyphicon glyphicon-calendar"></i> View Schedule</a>
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
						<!-- Carousel indicators -->
						<!-- Carousel items -->
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
	<h4 class="text-center" style="margin-bottom: 17px">Course Sequence for <?= $progress['program_name'] ?></h4>
	<div class="row">
		<?php
			$sequence = $progress['progress'];
			$num_course = count($sequence);
			$num_per_col = ceil($num_course / 3);

			$current = 0;
			for($col = 0; $col < $num_per_col && $current < $num_course; $col++)
			{
				echo '<div class="col-md-4">
						<ul class="list-group">';
					for($i = 0; $i < $num_per_col; $i++)
					{
						if($current >= $num_course)
							break;

						echo '<li class="list-group-item';
						if($sequence[$current]['completed'])
							echo ' list-group-item-success';
						else if($sequence[$current]['takable'])
							echo ' list-group-item-warning';
						echo '">' . $sequence[$current]['name'] . '</li>';

						$current++;
					}
				echo '</ul>
					</div>';
			}
		?>
	</div>
</main>
