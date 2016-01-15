<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('resources/img/favicon.ico'); ?>" />

	<title><?php echo SITE_NAME; ?><?php echo (isset($title))? ' | '.$title : ''; ?></title>

	<link href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('resources/css/normalize.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('resources/css/main.css'); ?>" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	
	</head>
<body>

<header class="container">

	<div class="row">
		<div class="col-sm-6 col-md-5">
			<a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>resources/img/logo.png"></a>
		</div>
	</div>

	<div class="infobar">
		<?php $is_login = $this->uri->segment(1) == 'login' ?>
		<p <?php echo ($is_login)? 'style="width:100%"':'' ?>><?php echo (isset($info_bar))? $info_bar : ' '; ?></p>
		<?php 
		if(!$is_login)
			echo '
			<button class="btn visible-xs-block pull-right signout-collapse-btn" type="button" data-toggle="collapse" aria-expanded="false" data-target="#signout-container"><i class="glyphicon glyphicon-menu-hamburger"></i></button>
			<div class="signout-collapse-container" id="signout-container">'.
				form_open("login/signout").'
					<button class="infobar-signout-btn" type="submit">Sign Out</button>
				</form>
			</div>
			';	
		?>
	</div>
		
</header>