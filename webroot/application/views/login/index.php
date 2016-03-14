<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('resources/img/favicon.ico'); ?>" />

	<title></title>
	<link href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('resources/css/normalize.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('resources/css/main.css'); ?>" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

	<style>
		html, body, .wrapper-m{
			height: 100%;
		}
		body{
			min-height: 600px;
		}
		.wrapper{
			background-color: #1abc9c;
			clear: right;
		}
		.login-form{
			background-color: whitesmoke;
			border-radius: 5px;
			padding: 20px;
		}
		.logo{
			margin-top: 3%;
		}
		.description{
			font-size: 1.2em;
			margin-top: 15px;
			text-align: right;
			color: white
		}
		.img-center{
			width: 200px;
			margin: 0 auto;
		}
		.wrap-navigation{
			width: 100%;
			z-index: 100;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			background-color: white;
		}
		.navigation{
			list-style-type: none;
		}
		.navigation > li{
			float: right;
			padding: 15px 15px;
			display: inline-block;
			cursor: pointer;
		}
		.navigation > li > a{
			text-decoration: none;
			color: black;
		}
		@media (max-width: 768px) {
			.logo{
				margin-top: 0;
			}
		}
	</style>
</head>
<body>

<div class="wrap-navigation" style="display: none;">
	<div class="container" style="height: 50px;">
		<ul class="navigation">
			<li><a href="<?= base_url().'course' ?>">COURSES</a></li>
			<li><a id="aboutus-btn">ABOUT US</a></li>
		</ul>
	</div>
</div>
<div class="wrapper">
	<div class="container wrapper-m" style="display: table; vertical-align: middle;">
		<div style="display: table-cell; vertical-align: middle;">
			<div class="row">
				<div class="col-sm-5 col-md-7">
					<div id="left-post" style="opacity: 0; left: -75px; position: relative">
						<img class="img-responsive logo" style="-webkit-filter: invert(1);" src="<?php echo base_url(); ?>resources/img/logo.png">
						<p class="description">A simple web app for schedule making and course sequence planning.</p>
					</div>
				</div>
				<div class="col-sm-7 col-md-5">
					<div class="login-form" style="display: none">
						<?php echo form_open('login'); ?>

						<?php
						if(validation_errors() || isset($invalid_record)){
							echo '<div class="alert alert-danger" role="alert">
								<p><strong>Warning!</strong></p>';
							if(validation_errors())
								echo validation_errors();
							if(isset($invalid_record))
								echo '<p>'.$invalid_record.'</p>';
							echo '</div>';
						}
						?>
						<div class="form-group">
							<label for="login_name">Login Name: </label>
							<input type="text" class="form-control" name="login_name" placeholder="Login Name: " value="<?php /*echo set_value('login_name'); */?>">
						</div>

						<div class="form-group">
							<label for="password">Password: </label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						<input type="submit" value="Sign In" name="signin_btn" class="btn btn-block btn-default">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container" id="aboutus">
	<!-- Team Members Row -->
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Our Team</h2>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/laurendy.jpg') ?>">
			<h3>Laurendy Lam
				<small>Lead Engineer</small>
			</h3>
			<p>Designs the user experience and loves baking cakes.</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/alex.jpg') ?>" alt="">
			<h3>Alessandro Power
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/anhkhoi.jpg') ?>" alt="">
			<h3>Anhkhoi Vu-Nguyen
				<small>Consultant</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/pragas.jpg') ?>" alt="">
			<h3>Pragas Velauthapillai
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/andy.jpg') ?>" alt="">
			<h3>Andy Nguyen
				<small>Component Designer</small>
			</h3>
			<p>Andy manages how subsystems interact with each other. He is very proud of his gains.</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/jacqueline.jpg') ?>" alt="">
			<h3>Jacqueline Luo
				<small>Database</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/michael.jpg') ?>" alt="">
			<h3>Michael Mescheder
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/theebz.jpg') ?>" alt="">
			<h3>Piratheeban Annamalai
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/eric.jpg') ?>" alt="">
			<h3>Eric Payette
				<small>Software Developer</small>
			</h3>
			<p>Eric helps with the development and loves playing Age of Empires 2 on the job.</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/ronnie.jpg') ?>" alt="">
			<h3>Ronnie Pang
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/kenny.jpg') ?>" alt="">
			<h3>Kenny Nguyen
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="<?= base_url('resources/img/james.jpg') ?>" alt="">
			<h3>James Talarico
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
	</div>
</div>
<footer>
	<div class="container">
		<p class="copyright">&copy; Copyright <?php echo date('Y'); ?> | <?php echo SITE_NAME; ?> | {elapsed_time}s</span></p>
	</div>
</footer>
<script src="<?= base_url('resources/js/jquery-1.12.1.min.js'); ?>"></script>
<script src="<?= base_url('resources/js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script>
	$(function(){
		$('.login-form').fadeIn(2500);
		$('.wrap-navigation').slideDown('slow');
		$('#left-post').animate({
			opacity: 1,
			left: 0
		}, 2500);
		$("#aboutus-btn").click(function() {
			$('html, body').animate({
				scrollTop: $("#aboutus").offset().top - 50
			}, 2000);
		});
	});
</script>
</body>
</html>
