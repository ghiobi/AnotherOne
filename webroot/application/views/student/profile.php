
<main class="container">

	<!-- attach alert-fail. For wrong password or no identical -->
	<!--<div class="alert alert-success" role="alert">
	
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p><strong>Success!</strong> Password Changed</p>
		
	</div>-->
	<div>
		<h2>Profile</h2>
	</div>
	<div class="row">
	
		<div class="col-md-5">
			<div class="well profile-custom-well">
				<table class="profile-details-table">
					<tr><td>Student ID:</td><td><?php echo $info->id ?></td></tr>
					<tr><td>Program:</td><td><?php echo $info->name ?></td></tr>
					<tr><td>First Name:</td><td><?php echo $info->firstname ?></td></tr>
					<tr><td>Last Name:</td><td><?php echo $info->lastname ?></td></tr>
					<tr><td>Login Name:</td><td><?php echo $info->login_name ?></td></tr>

					<tr><td>Password:</td><td>
					<button class="btn btn-xs" data-toggle="collapse" data-target="#profile-changepwd-div" aria-expanded="false" aria-controls="profile-changepwd-div">
					  Edit <i class="glyphicon glyphicon-pencil"></i>
					</button>
					</td></tr>
					
				</table>
			</div>
			<div id="profile-changepwd-div" class="collapse">
			
				<h4 style="margin-top: 20px">Change Password</h4>
				<form>
					<div class="form-group">
						<label for="old_password">Old Password</label>
						<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
					</div>
					<div class="form-group">
						<label for="new_password">New Password</label>
						<input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
					</div>
					<div class="form-group">
						<label for="confirm_password">Confirm Password</label>
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
					</div>
					<input type="submit" class="btn btn-default btn-block" name="change_pwd_btn" value="Commit Changes">
				</form>
				
			</div>
		</div>
		<div class="col-md-7">

			<?php if($record == FALSE): ?>

				<p>Sorry no records found ):</p>

			<?php else: ?>

			<div class="list-group">

				<?php $i = 0;
					foreach($record as $semester => $data): ?>
					<div class="list-group-item profile-list">
						<h4 class="profile-semes-title"><?= $semester ?></h4>
						<table class="profile-table table table-bordered table-condensed>">

							<?php foreach($data as $course)
								echo '<tr><td>'.$course->code.' '.$course->number.'</td><td>'.$course->name.'</td><td>'.$course->credit.'</td><td>'.(($course->grade)? $course->grade:'<i class="glyphicon glyphicon-minus"></i>').'</td></tr>';
							?>

						</table>
					</div>

					<?php $i++; ?>

				<?php endforeach; ?>

			</div>

			<?php endif; ?>

		</div>
		
	</div>
	<div class="row">

	</div>
</main>
