

<main class="container">

	<div id="login-welcome">
		<p>Welcome to mytinerary. A simple web app for schedule making and course sequence planning.</p>
	</div>

	<div class="row">

		<div class="col-md-6">

			<?php echo form_open('login/login'); ?>

			<?php if(validation_errors()){
				echo '
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Warning!</strong> '.validation_errors().'
				</div>';
			}


			; ?>

				<div class="form-group">
					<label for="login_id">Login ID: </label>
					<input type="text" class="form-control" name="login_id" placeholder="Login ID">
				</div>

				<div class="form-group">
					<label for="password">Password: </label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				</div>

				<button name="login-btn" type="submit" class="btn btn-block btn-default">Log In</button>
			
			</form>

		</div>

	</div>

</main>
