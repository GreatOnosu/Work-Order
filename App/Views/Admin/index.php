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
			<span><a href="Admin/index">Dashboard</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<div class="body-links">
				<a href="Admin/users" class="link-data" style="background-color: #479129;"><div>
					<p>View <br /> Users</p>
				</div></a>
				<a href="Admin/assign" class="link-data" style="background-color: #63C2DE;"><div>
					<p>Assign <br /> Orders</p>
				</div></a>				
				<a href="Admin/queue" class="link-data" style="background-color: #F8CB00;"><div>
					<p>Orders In Queue</p>
				</div></a>
			</div>
			<div class="body-links">
				<a href="Admin/progress" class="link-data" style="background-color: #63C2DE;"><div>
					<p>Work In Progress</p>
				</div></a>
				<a href="Admin/fulfilled" class="link-data" style="background-color: #F8CB00;"><div>
					<p>Fulfilled</p>
				</div></a>
				<a href="Admin/closed" class="link-data" style="background-color: #479129;"><div>
					<p>Closed</p>
				</div></a>
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