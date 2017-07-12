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
			<h1>Admin Dashboard</h1>
		</div>
		<div class="user-profile">
			<span><?=$_SESSION['session_username']?></span><a href="logout"><img src="icons/logout.png" title="Logout" /></a>
		</div>
	</header>
	<nav id="breadcrumb">
		<div class="side-menu">
			<img src="icons/menu.png" />
		</div>
		<div class="crumbs">
			<span><a href="admin/index">Dashboard</a> / </span><span><a href="admin/users">Users</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<div class="body-info">
				<h1 style="color: #381d40;">Users</h1><!-- <span style="float: right;">Print</span> -->
				<table>
					<tr>
						<th>SN</th>
						<th>Username</th>
						<th>Password</th>
						<th>Level</th>
						<th>Full Name</th>
						<th>Department</th>
				  	</tr>
				  	<?php $ii=1;?>
				  	<?php foreach($users as $user):?>
				  	<tr>
				  		<td><?=$ii?></td>
				  		<td><?=$user->username?></td>
				  		<td><?=$user->password?></td>
				  		<td><?=$user->level?></td>
				  		<td><?=$user->full_name?></td>
				  		<td><?=$user->department?></td>
				  	</tr>
				  	<?php $ii++;?>
				  	<?php endforeach;?>
				</table>
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