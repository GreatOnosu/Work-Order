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
			<span><a href="Admin/index">Dashboard</a> / </span><span><a href="Admin/assign">Assigned Orders</a> / </span><span><a href="Admin/assignmaintenance">Assigned Maintenance</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<div class="body-info">
				<h3 style="color: #4CAF50; text-align: center;"><?=$stat?></h3>
				<h1 style="color: #381d40;">Maintenance</h1>
				<form action="admin/assignmaintenance" method="post">
				<table>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Submitted By</th>
						<th>Status</th>
						<th>Time of Assignment</th>
						<th>Select Staff</th>
						<th>Allocate</th>
				  	</tr>
				  	<?php foreach($records as $record):?>
				  	<tr>
				  		<td><?=$record->title?></td>
				  		<td><?=$record->description?></td>
				  		<td><?=$record->poster?></td>
				  		<td><?=$record->status?></td>
				  		<td><?=$record->post_time?></td>
				  		<td>
							<select name="it_allocate" required>
								<option value="">Select Staff</option>
								<?php foreach($staffs as $staff):?>
									<?php $full = $staff->first_name .' '. $staff->last_name;?>
									<?php echo'<option value="'.$full.'">'.$full.'</option>';?>
									<input type="hidden" name="id" value="<?=$record->id?>" />
								<?php endforeach;?>
							</select>
						</td>
						<td>
							<input type="submit" name="allo_main" class="btn-login" value="Allocate" />
						</td>
				  	</tr>
				  	<?php endforeach;?>
				</table>
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