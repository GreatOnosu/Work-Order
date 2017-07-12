<!DOCTYPE html>
<html>
<head runat="server">
	<base href="/Vicky/public/">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BENSON IDAHOSA UNIVERSITY WORK ORDER SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/magic.css">
	<script src="../vendor/jquery.min.js"></script>
	<script src="js/menu.js"></script>
</head>
<body>
	<header id="adminHeader">
		<div class="header-title">
			<h1><?=$_SESSION['session_dept']?></h1>
		</div>
		<img src="<?=$_SESSION['session_pix']?>" id="user-pix" />
		<div class="user-profile">
			<span><?=$_SESSION['session_lastname']?></span><a href="logout"><img src="icons/logout.png" title="Logout" /></a>
		</div>
	</header>
	<nav id="breadcrumb">
		<div class="side-menu">
			<img src="icons/menu.png" />
		</div>
		<div class="crumbs">
			<span><a href="staff/index2">Dashboard</a> / </span><span><a href="staff/accept">Accept</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<div class="body-info">
				<h1 style="color: #381d40;">Work In Queue</h1><!-- <span style="float: right;">Print</span> -->
				<h3 style="color: #4CAF50; text-align: center;"><?=$stat?></h3>
				<table>
					<tr>
						<th>Full Name</th>
						<th>Mat. No.</th>
				  	</tr>
				  	<?php foreach($records as $record):?>
				  	<tr>
				  		<td><?=$student->first_name .' '. $student->last_name?></td>
				  		<td><?=$student->username?></td>
				  		<?php foreach($courses as $course):?>
				  			<?php
				  			if($course != ''){
				  			$res = explode("-", $course); 
				  			if($res[1] == 'A'){
								echo '<td><select name="'.$course.'" id="'.$student->username.'">
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="C">C</option>
												<option value="D">D</option>
												<option value="E">E</option>
												<option value="F">F</option>
											</select></td>';
							}elseif($res[1] == 'B'){
								echo '<td><select name="'.$course.'" id="'.$student->username.'">
												<option value="B">B</option>
												<option value="A">A</option>
												<option value="C">C</option>
												<option value="D">D</option>
												<option value="E">E</option>
												<option value="F">F</option>
											</select></td>';
							}elseif($res[1] == 'C'){
								echo '<td><select name="'.$course.'" id="'.$student->username.'">
												<option value="C">C</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="D">D</option>
												<option value="E">E</option>
												<option value="F">F</option>
											</select></td>';
							}elseif($res[1] == 'D'){
								echo '<td><select name="'.$course.'" id="'.$student->username.'">
												<option value="D">D</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="C">C</option>
												<option value="E">E</option>
												<option value="F">F</option>
											</select></td>';
							}elseif($res[1] == 'E'){
								echo '<td><select name="'.$course.'" id="'.$student->username.'">
												<option value="E">E</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="C">C</option>
												<option value="D">D</option>
												<option value="F">F</option>
											</select></td>';
							}elseif($res[1] == 'F'){
								echo '<td><select name="'.$course.'" id="'.$student->username.'">
												<option value="F">F</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="C">C</option>
												<option value="D">D</option>
												<option value="E">E</option>
											</select></td>';
							}else{
								echo '<td><select name="'.$course.'" id="'.$student->username.'">
												<option value=" ">Select Grade</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="C">C</option>
												<option value="D">D</option>
												<option value="E">E</option>
												<option value="F">F</option>
											</select></td>';
							}}
				  			?>
						<?php endforeach;?>
				  	</tr>
				  	<?php endforeach;?>
				</table>
				<form action="staff/result" method="post">
					<input type="submit" class="btn-login" name="staff_submit" value="Submit" />
				</form>
			</div>
		</div>
	</section>
	<div style="clear: both;"></div>
	<footer id="adminFooter">
		<div>
			<h3>&copy;Benson Idahosa University</h3>
		</div>
	</footer>
</body>
</html>