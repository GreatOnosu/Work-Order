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
			<span><a href="Admin/index2">Dashboard</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<div class="body-info">
				<div class="dashset dashset1">
					<?php if($_SESSION['session_dept'] == 'Maintenance'){
						echo '
						<a href="staff/acceptmain">
							<div class="upperset"></div>
							<div class="lowerset">
								<span>Accept Work</span>
							</div>
						</a>';
					}else{
						echo '
						<a href="staff/acceptexam">
							<div class="upperset"></div>
							<div class="lowerset">
								<span>Accept Work</span>
							</div>
						</a>';						
						}?>
				</div>
				<div class="dashset dashset1">
					<?php if($_SESSION['session_dept'] == 'Maintenance'){
						echo '
						<a href="staff/completemain">
							<div class="upperset"></div>
							<div class="lowerset">
								<span>Complete Work</span>
							</div>
						</a>';
					}else{
						echo '
						<a href="staff/completeexam">
							<div class="upperset"></div>
							<div class="lowerset">
								<span>Complete Work</span>
							</div>
						</a>';						
						}?>
				</div>
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