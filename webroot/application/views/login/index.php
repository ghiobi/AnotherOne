<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<main class="container">

	<div class="row">

		<div class="col-md-6">

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
					<input type="text" class="form-control" name="login_name" placeholder="Login Name: " value="<?php echo set_value('login_name'); ?>">
				</div>

				<div class="form-group">
					<label for="password">Password: </label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				</div>

				<input type="submit" value="Sign In" name="signin_btn" class="btn btn-block btn-default">
			
			</form>

		</div>

		<div class="col-md-6" style="margin-top: 20px">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<a class="btn btn-primary" href="<?=base_url().'course'?>">View Courses</a>
		</div>

	</div>

</main>
