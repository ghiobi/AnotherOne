<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>Welcome Back, <?php echo $name ?>.</h4>
			<div class="front-menu">
				<a href="<?php echo site_url('student/profile') ?>"><i class="glyphicon glyphicon-user"></i> Account Profile</a>
				<a href="<?php echo site_url('student/register') ?>"><i class="glyphicon glyphicon-pencil"></i> Class Registration</a>
				<a href="<?php echo site_url('student/view') ?>"><i class="glyphicon glyphicon-calendar"></i> View Schedule</a>
				<a href="<?php echo site_url('student/studentprofile') ?>"><i class="glyphicon glyphicon-calendar"></i> Student Profile</a>

			</div>
		</div>
	</div>
</main>