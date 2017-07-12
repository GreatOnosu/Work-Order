<!DOCTYPE html>
<html>
<head runat="server">
	<base href="/Vicky/public/">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BENSON IDAHOSA UNIVERSITY WORK ORDER SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/magic.css">
</head>
<body>
	<header id="adminHeader">
		<div class="header-title">
			<h1>Dashboard</h1>
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
			<span><a href="Admin/index">Dashboard</a> / </span><span><a href="Admin/progress">Work In Progress</a> / </span><span><a href="Admin/progressmain">Maintenance</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<div class="body-info">
				<h1 style="color: #381d40;">Maintenance</h1>
				<table>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Staff Allocated</th>
						<th>Status</th>
						<th>Time of Assignment</th>
						<th>Time of Completion</th>
				  	</tr>
				  	<?php foreach($records as $record):?>
				  	<tr>
				  		<td><?=$record->title?></td>
				  		<td><?=$record->description?></td>
				  		<td><?=$record->staff_allocated?></td>
				  		<td><?=$record->status?></td>
				  		<td><?=$record->post_time?></td>
				  		<td><?=$record->complete_time?></td>
				  	</tr>
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