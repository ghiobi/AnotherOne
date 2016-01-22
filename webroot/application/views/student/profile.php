
<main class="container">
	<!-- attach alert-fail. For wrong password or no identical -->
	<!--<div class="alert alert-success" role="alert">
	
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p><strong>Success!</strong> Password Changed</p>
		
	</div>-->
	
	<div class="row">
	
		<div class="col-md-4">
			<h4>Details:</h4>
			<div class="well custom-well-profile">
				<table class="student-profile-table">
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
		<style>
			.student-profile-table{
				width: 100%;
			}
			.student-profile-table > tr{
				width: 100%;
			}
			.student-profile-table > tbody > tr > td {
				padding: 3px 0;
				width: 50%;
			}
			.student-profile-table > tbody > tr > td:first-child {
				width: 30%;
			}
			.student-profile-table > tbody > tr > td:last-child {
				width: 70%;
			}
			.custom-well-profile{
				border-radius: 0;
				border: none;
				box-shadow: none;
				background-color: #ecf0f1;
			}
			.custom-registered {
				padding: 0;
			}
			.custom-registered h4{
				text-transform: uppercase;
				padding: 15px;
				background-color: #16a085;
				margin: 0;
				color: white;
			}
			.semester-data-active{
				display: block !important;
			}
			.semester-data{
				padding: 10px 15px;
				width: 100%;
				display: none;
			}
			.semester-data > tbody{
				width: 100%;
			}
			.semester-data > tbody > tr + tr{
				border-top: solid 1px #eee;
			}
			.semester-data > tbody > tr > td{
				padding: 3px 3px;
			}
			.semester-data > tbody > tr > td:nth-child(1){
				width: 15%;
			}
			.semester-data > tbody > tr > td:nth-child(2){
				width: 60%;
			}
			.semester-data > tbody > tr > td:nth-child(3){
				width: 20%;
			}
			.semester-data > tbody > tr > td:nth-child(4){
				width: 10%;
			}
			.semester-data > tbody > tr > td:last-child{
				width: 10%;
				text-align: right;
			}
		</style>
		<div class="col-md-8">
			<h4>Semester</h4>
			<div class="list-group">
				<div class="list-group-item custom-registered">
					<h4 class="semester-title">SUMMER 2015</h4>
					<table class="semester-data semester-data-active">
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td> 2015 Fall</td><td>A+</td><td>3.5</td></tr>
						<tr><td>SOEN 341</td><td>Sofware Process</td><td> 2019 Fall</td><td>A-</td><td>3</td></tr>
						<tr><td>COMP 232</td><td>Mathematics for Computer Science</td><td> 1989 Summer</td><td>B+</td><td>3.14</td></tr>
						<tr><td>COMP 335</td><td>Mathematics for Computer Science</td><td> 1990 Winter</td><td>B-</td><td>4.20</td></tr>
						<tr><td>SOEN 228</td><td>Mathematics for Computer Science</td><td> 2012 Winter</td><td>B+</td><td>4.20</td></tr>
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td> 2015 Fall</td><td>A+</td><td>3.5</td></tr>
					</table>
				</div>
				<div class="list-group-item custom-registered">
					<h4 class="semester-title">SUMMER 2018</h4>
					<table class="semester-data">
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td> 2015 Fall</td><td>A+</td><td>3.5</td></tr>
						<tr><td>SOEN 341</td><td>Sofware Process</td><td> 2019 Fall</td><td>A-</td><td>3</td></tr>
						<tr><td>COMP 232</td><td>Mathematics for Computer Science</td><td> 1989 Summer</td><td>B+</td><td>3.14</td></tr>
						<tr><td>COMP 335</td><td>Mathematics for Computer Science</td><td> 1990 Winter</td><td>B-</td><td>4.20</td></tr>
						<tr><td>SOEN 228</td><td>Mathematics for Computer Science</td><td> 2012 Winter</td><td>B+</td><td>4.20</td></tr>
						<tr><td>COMP 248</td><td>Object Oriented programming I</td><td> 2015 Fall</td><td>A+</td><td>3.5</td></tr>
					</table>
				</div>

			</div>
		</div>
		
	</div>
	<script>

	</script>
</main>

<style type="text/css">
		.student-profile-table{
			width: 100%;
		}
		.student-profile-table > tr{
			width: 100%;
		}
		.student-profile-table > tbody > tr > td{
			padding: 3px 0;
		}
		.student-edit-btn{
			position: absolute;
			left: 020px;
			top: 5px;
			opacity: .3;
			border: none;
			border-radius: 5px;
			font-size: 12px;
			padding: 1px 4px;
		}
	</style>

