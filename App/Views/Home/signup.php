<!DOCTYPE html>
<html>
<head runat="server">
	<base href="/Vicky/public/">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BENSON IDAHOSA UNIVERSITY WORK ORDER SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/magic.css">
</head>
<body>
	<section id="signUp">
		<dl class="form">
			<dt>
				<h1><?=$stat?></h1>
				<h1>Register</h1>
			</dt>
			<form action="Home/signup" method="post" enctype="multipart/form-data">
			<dt class="form-control">
				<label>Upload a Photo</label>
				<input type="file" id="image" name="image" required />
			</dt>
			<dt class="form-control">
				<input type="text" id="fname" name="fname" placeholder="First Name" required />
			</dt>
			<dt class="form-control">
				<input type="text" id="lname" name="lname" placeholder="Last Name" required />
			</dt>
			<dt class="form-control" style="text-align: left; font-size: 16px;">
				<label>Gender</label><br>
				<input name="gender" value="male" checked="" type="radio"> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="gender" value="female" type="radio"> Female<br>
			</dt>
			<dt class="form-control">
				<select name="category" required>
					<option value="">Select a Category</option>
					<option value="Staff">Staff</option>
					<option value="Student">Student</option>
				</select>
			</dt>
			<dt class="form-control">
				<select name="department" required>
					<option value="">Select a Department</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Mass Communication">Mass Communication</option>
					<option value="Law">Law</option>
					<option value="International Studies and Diplomacy">International Studies and Diplomacy</option>
					<option value="Mechanical Engineering">Mechanical Engineering</option>
					<option value="Maintenance">Maintenance</option>
				</select>
			</dt>
			<dt class="form-control">
				<input type="password" id="pin" name="pin" placeholder="Pin" required />
			</dt>
			<dt class="form-control">
				<input type="submit" value="Sign Up" name="btn_signup" class="btn-login" />
			</dt>
			<dt>
				<a href="Home/index">Sign In</a>
			</dt>
			</form>
		</dl>
	</section>
</body>
</html>