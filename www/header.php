<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/ico" href="<?php echo get_resource_url(); ?>/img/favicon.ico" />

	<title><?php echo SITE_TITLE; if(isset($GLOBALS['PAGE_TITLE'])) { echo ' | '.$GLOBALS['PAGE_TITLE']; }?></title>

	<link href="<?php echo get_resource_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_resource_url(); ?>/css/normalize.css" rel="stylesheet">
	<link href="<?php echo get_resource_url(); ?>/css/main.css" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	</head>
<body>

<header class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<a class="brand" href="<?php echo get_root_url(); ?>"><img src="<?php echo get_resource_url(); ?>/img/logo.png"></a>
		</div>
	</div>
	<?php get_navbar(); ?>
</header>
