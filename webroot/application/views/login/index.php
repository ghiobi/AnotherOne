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

	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

	<style>
		*{
			font-family: 'Montserrat', sans-serif;
		}
		html, body, .container {
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
			height: 50px;
		}
		.navigation > ul{
			list-style-type: none;
		}
		.navigation > ul > li{
			float: right;
			padding: 15px 15px;
			display: inline-block;
		}
		.navigation > ul > li > a{
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

<div class="wrap-navigation">
	<div class="container navigation">
		<ul>
			<li><a href="<?= base_url().'course' ?>">Courses</a></li>
			<li><a id="aboutus-btn">About Us</a></li>
		</ul>
	</div>
</div>
<div class="wrapper">
	<div class="container" style="display: table; vertical-align: middle;">
		<div style="display: table-cell; vertical-align: middle;">
			<div class="row">
				<div class="col-sm-5 col-md-7">
					<div id="left-post" style="opacity: 0; left: -75px; position: relative">
						<img class="img-responsive logo" src="<?php echo base_url(); ?>resources/img/logo.png">
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
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
		<div class="col-lg-4 col-sm-6 text-center">
			<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
			<h3>John Smith
				<small>Job Title</small>
			</h3>
			<p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
		</div>
	</div>
</div>

<script src="<?= base_url('resources/js/jquery-1.12.1.min.js'); ?>"></script>
<script src="<?= base_url('resources/js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script>
	$(function(){
		$('.login-form').fadeIn(2500);
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
