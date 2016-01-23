
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
			<div class="list-group">
				<div class="list-group-item profile-list">
					<h4 class="profile-semes-title">SUMMER 2015</h4>
					<table class="table profile-semester-data profile-semester-active">
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td>3.5</td><td>A+</td></tr>
						<tr><td>SOEN 341</td><td>Sofware Process</td><td>3</td><td>A-</td></tr>
						<tr><td>COMP 232</td><td>Mathematics for Computer Science</td><td>3.14</td><td>B+</td></tr>
						<tr><td>COMP 335</td><td>Mathematics for Computer Science</td><td>4.20</td><td>B-</td></tr>
						<tr><td>SOEN 228</td><td>Mathematics for Computer Science</td><td>4.20</td><td>B+</td></tr>
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td>3.5</td><td>A+</td></tr>
					</table>
				</div>
				<div class="list-group-item profile-list">
					<h4 class="profile-semes-title">SUMMER 2018</h4>
					<table class="table profile-semester-data">
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td>3.5</td><td>A+</td></tr>
						<tr><td>SOEN 341</td><td>Sofware Process</td><td>3</td><td>A-</td></tr>
						<tr><td>COMP 232</td><td>Mathematics for Computer Science</td><td>3.14</td><td>B+</td></tr>
						<tr><td>COMP 335</td><td>Mathematics for Computer Science</td><td>4.20</td><td>B-</td></tr>
						<tr><td>SOEN 228</td><td>Mathematics for Computer Science</td><td>4.20</td><td>B+</td></tr>
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td>3.5</td><td>A+</td></tr>
					</table>
				</div>

			</div>
		</div>
		
	</div>
	<script>

	</script>
</main>
