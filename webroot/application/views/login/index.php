

<main class="container">

	<div id="login-welcome">
		<p>Welcome to mytinerary. A simple web app for schedule making and course sequence planning.</p>
	</div>

	<div class="row">

		<div class="col-md-6">

			<?php echo form_open('login/authenticate'); ?>

			<?php 
				if(validation_errors() || isset($invalid_record)){
					echo '<div class="alert alert-danger" role="alert">
						<p><strong>Warning!</strong></p>';
					if(validation_errors())
						echo validation_errors();
					if(isset($invalid_record))
						echo $invalid_record;
					echo '</div>';
				}
			?>
				<div class="form-group">
					<label for="login_id">Login ID: </label>
					<input type="text" class="form-control" name="login_id" placeholder="Login ID" value="<?php echo set_value('login_id'); ?>">
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
