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

	</div>

</main>
