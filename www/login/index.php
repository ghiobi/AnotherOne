<?php 

	include '../mytinerary-load.php'; 

	$GLOBALS['PAGE_TITLE'] = 'Login';

	if (isset($_SESSION['LOGIN_ID'])) {
		header('location:'.get_root_url());
	}

	if(isset($_POST['login-btn'])){
		$_SESSION['LOGIN_ID'] = 12345;
		header('location:'.get_root_url());
	}

	get_header(); ?>

<main class="container">
	<div class="row">
		<div class="col-md-6">
			<form action="" method="post">
				<div class="form-group">
					<label for="username">Email Address: </label>
					<input type="email" class="form-control" id="username" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="password">Password: </label>
					<input type="email" class="form-control" id="password" placeholder="Password">
				</div>
				<button name="login-btn" type="submit" class="btn btn-block btn-default">Log In</button>
			</form>
		</div>
	</div>
</main>

<?php get_footer(); ?>
