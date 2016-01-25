
<main class="container">
	<!-- attach alert-fail. For wrong password or no identical -->
	<!--<div class="alert alert-success" role="alert">
	
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p><strong>Success!</strong> Password Changed</p>
		
	</div>-->
	
	<div class="row">
	
		<div class="col-md-4">
			<h4>Student Details</h4>
			<div class="well profile-custom-well">
				<table class="profile-details-table">
					<tr><td>Student ID:</td><td><?php echo $userinfo->id ?></td></tr>
					<tr><td>Program:</td><td><?php echo $userinfo->name ?></td></tr>
					<tr><td>First Name:</td><td><?php echo $userinfo->firstname ?></td></tr>
					<tr><td>Last Name:</td><td><?php echo $userinfo->lastname ?></td></tr>
					<tr><td>Login Name:</td><td><?php echo $userinfo->login_name ?></td></tr>

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
		<div class="col-md-8">
			<h4>Registered Courses and Grades</h4>

			<?php if($student_record == FALSE): ?>

				<p>Sorry no records found ):</p>

			<?php else: ?>

			<div class="list-group">

				<?php $i = 0;
					foreach($student_record as $semester => $data): ?>

					<div class="list-group-item profile-list">
						<h4 class="profile-semes-title"><?php echo $semester ?></h4>
						<table class="table profile-semester-data <?php if(!$i) echo 'profile-semester-active'; ?>">

							<?php foreach($data as $record)
								echo '<tr><td>'.$record->code.' '.$record->number.'</td><td>'.$record->name.'</td><td>'.$record->credit.'</td><td>'.(($record->grade)? $record->grade:'<i class="glyphicon glyphicon-minus"></i>').'</td></tr>';
							?>

						</table>
					</div>

					<?php $i++; ?>

				<?php endforeach; ?>

			</div>

			<?php endif; ?>

		</div>
		
	</div>
	<script>

	</script>
</main>
