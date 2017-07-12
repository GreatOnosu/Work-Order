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
			<span><a href="staff/indexexam">Dashboard</a> / </span><span><a href="staff/completemain">Complete</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<br />
			<div class="body-info">
				<h1 style="color: #381d40;">Work In Progress</h1><!-- <span style="float: right;">Print</span> -->
				<h3 style="color: #4CAF50; text-align: center;"><?=$stat?></h3>
				<table>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Status</th>
						<th>Time of Assignment</th>
						<th>Complete</th>
				  	</tr>
				  	<?php foreach($records as $record):?>
				  	<tr>
				  		<td><?=$record->title?></td>
				  		<td><?=$record->description?></td>
				  		<td><?=$record->status?></td>
				  		<td><?=$record->post_time?></td>
				  		<td>
				  		<form action="staff/completemain" method="post">
				  			<input type="hidden" class="btn-login" name="complete_id" value="<?=$record->id?>" />
							<input type="submit" class="btn-login" name="complete_main" value="Complete" />
						</form>
						</td>
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