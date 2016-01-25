<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>Welcome Back, <?php echo $name ?>.</h4>
			<div class="front-menu">
				<a href="<?php echo site_url('student/profile') ?>"><i class="glyphicon glyphicon-user"></i> Student Profile</a>
				<a href="<?php echo site_url('student/enroll') ?>"><i class="glyphicon glyphicon-pencil"></i> Register Now</a>
				<a href="<?php echo site_url('student/register') ?>"><i class="glyphicon glyphicon-search"></i> View Available Courses</a>
				<a href="<?php echo site_url('student/view') ?>"><i class="glyphicon glyphicon-calendar"></i> View Schedule</a>
			</div>
		</div>
		<div class="col-md-6" style="margin-top: 39px">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bullhorn fa-lg"></i> 
					Recent Notices
				</div>
				<div class="panel-body">
					<div id="notice-slider" class="carousel slide sidebar-slider" data-interval="10000" data-ride="carousel">
						<!-- Carousel indicators -->
						<ol class="carousel-indicators">
							<li data-target="#notice-slider" data-slide-to="0" class="active"></li>
							<li data-target="#notice-slider" data-slide-to="1"></li>
							<li data-target="#notice-slider" data-slide-to="2"></li>
						</ol>
						<!-- Carousel items -->
						<div class="carousel-inner">
							<div class="active item">
								<h4>Notice 1</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
								<p>SSG</p>
							</div>
							<div class="item">
								<h4>Notice 2</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
								<p>SMU</p>
							</div>
							<div class="item">
								<h4>Notice 3</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
								<p>NDR</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>