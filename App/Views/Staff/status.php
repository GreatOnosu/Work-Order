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
			<h1>Staff Dashboard</h1>
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
			<span><a href="staff/index">Dashboard</a> / </span><span><a href="staff/status">Status</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<br />
			<div class="body-info">
				<h1 style="color: #381d40;">Maintenance</h1>
				<table>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Status</th>
						<th>Staff Allocated</th>
				  	</tr>
				  	<?php foreach($maintain as $main):?>
				  	<tr>
				  		<td><?=$main->title?></td>
				  		<td><?=$main->description?></td>
				  		<td><?=$main->status?></td>
				  		<td><?=$main->staff_allocated?></td>
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