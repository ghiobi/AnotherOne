<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<main class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>Welcome Back, <?php echo $name ?>.</h4>
			<div class="front-menu">
				<a href="<?php echo site_url('student/profile') ?>"><i class="glyphicon glyphicon-user"></i> Student Profile</a>
				<a href="<?php echo site_url('student/enroll') ?>"><i class="glyphicon glyphicon-pencil"></i> Register Now</a>
				<a href="<?php echo site_url('courses') ?>"><i class="glyphicon glyphicon-search"></i> View Available Courses</a>
				<a href="<?php echo site_url('student/view') ?>"><i class="glyphicon glyphicon-calendar"></i> View Schedule</a>
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
							<?php for($i = 0; $i < 10; $i++): ?>
							<div class="<?php if($i == 0) echo 'active' ;?> item">
								<h4><a target="_blank" href="<?php echo $news[$i]['url'] ?>" ><?php echo $news[$i]['title'] ?></a></h4>
								<p><?php echo $news[$i]['abstract'] ?></p>
							</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
