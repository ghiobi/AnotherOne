<?php
/**
 * TASK: Create a class to render a the menu according to url from root. Below is temporary.
 */

$LOGIN = <<<LOGIN
<div id="login-welcome">
	<p>Welcome to mytinerary. A simple web app for schedule making and course sequence planning.</p>
</div>
LOGIN;

$NORMAL = <<<NORM
<div class="navbar-skitt">
	<button class="btn visible-xs-block btn-block" type="button" data-toggle="collapse" aria-expanded="false" data-target="#collapseExample"><i class="glyphicon glyphicon-menu-hamburger"></i></button>
	<div class="collapse navbar-collapse" id="collapseExample">
		<ol class="breadcrumb">
			<li><a href="">Somelink</a></li>
			<li><a href="">Somelink</a></li>
			<li><a href="">Somelink</a></li>
			<li><a href="">Somelink</a></li>
		</ol>
		<form action="" method="post"><button class="sign-out-btn" name="sign-out-btn">Sign Out</button></form>
	</div>
</div>
NORM;
?>

<?php echo (!is_login_page())? $NORMAL:$LOGIN; ?>
