<main class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo form_open('login/login'); ?>
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
