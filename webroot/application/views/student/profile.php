
<main class="container">
	<!-- attach alert-fail. For wrong password or no identical -->
	<!--<div class="alert alert-success" role="alert">
	
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p><strong>Success!</strong> Password Changed</p>
		
	</div>-->
	
	<div class="row">
	
		<div class="col-md-4">
			<h4>Details:</h4>
			<div class="well">
				<table class="student-profile-table">
				
					<tr><td>Student ID:</td><td>431141</td></tr>
					<tr><td>Program:</td><td>Bachelor of Random</td></tr>
					<tr><td>First Name:</td><td>Bob</td></tr>
					<tr><td>Last Name:</td><td>Smith</td></tr>
					<tr><td>Login Name:</td><td>bob_smith</td></tr>

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
​
		<div class="col-md-8">
		
			<h4>Registered Courses</h4>
			<table class ="table student-profile-table tablesorter">
				<thead>
					<tr class><td class = "blob">Course ID</td> <td class = "blob">Course Name</td><td class = "blob">Term</td><td class = "blob">Grade</td><td class = "blob">Credits</td></tr>
				</thead>
				<tbody>
					<tr><td>COMP 248</td><td>Object Oriented programming I</td><td> 2015 Fall</td><td>A+</td><td>3.5</td></tr>
					<tr><td>SOEN 341</td><td>Sofware Process</td><td> 2019 Fall</td><td>A-</td><td>3</td></tr>
					<tr><td>COMP 232</td><td>Mathematics for Computer Science</td><td> 1989 Summer</td><td>B+</td><td>3.14</td></tr>
					<tr><td>COMP 335</td><td>Mathematics for Computer Science</td><td> 1990 Winter</td><td>B-</td><td>4.20</td></tr>
					<tr><td>SOEN 228</td><td>Mathematics for Computer Science</td><td> 2012 Winter</td><td>B+</td><td>4.20</td></tr>
					<tr><td>COMP 248</td><td>Object Oriented programming I</td><td> 2015 Fall</td><td>A+</td><td>3.5</td></tr>
					<tr><td>SOEN 341</td><td>Sofware Process</td><td> 2019 Fall</td><td>D-</td><td>3</td></tr>
					<tr><td>COMP 232</td><td>Mathematics for Computer Science</td><td> 1989 Summer</td><td>B+</td><td>3.14</td></tr>
					<tr><td>COMP 335</td><td>Mathematics for Computer Science</td><td> 1990 Winter</td><td>B-</td><td>4.20</td></tr>
					<tr><td>SOEN 228</td><td>Mathematics for Computer Science</td><td> 2012 Fall</td><td>B+</td><td>4.20</td></tr>
				</tbody>
			</table>
			
		</div>
		
	</div>
	
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

