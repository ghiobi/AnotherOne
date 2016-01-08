<?php include 'mytinerary-load.php'; ?>

<?php $GLOBALS['PAGE_TITLE'] = 'Home'; ?>

<?php get_header(); ?>

<main class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>Welcome Back, John Smith.</h4>
			<div class="front-menu">
				<a href="<?php echo get_root_url().'/profile/'; ?>"><i class="glyphicon glyphicon-user"></i> Account Profile</a>
				<a href="<?php echo get_root_url().'/registration/'; ?>"><i class="glyphicon glyphicon-pencil"></i> Class Registration</a>
				<a href="#"><i class="glyphicon glyphicon-calendar"></i> View Schedule</a>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
