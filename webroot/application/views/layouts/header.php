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
		<div class="col-sm-6 col-md-4">
			<a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>resources/img/logo.png"></a>
		</div>
	</div>
</header>