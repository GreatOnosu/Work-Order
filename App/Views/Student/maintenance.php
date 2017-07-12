
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
			<h1>Student Dashboard</h1>
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
			<span><a href="student/index">Dashboard</a> / </span><span><a href="student/maintenance">Maintenance</a></span>
		</div>
	</nav>
	<section>
		<div class="admin-body">
			<br />
			<div class="body-info">
				<h1 style="color: #381d40;">Request Maintenance</h1>
				<dl class="form">
					<h3 style="color: #381d40; text-align: center;"><?=$stat?></h3>
					<form action="Student/maintenance" method="post">
					<dt class="form-control">
						<input type="text" id="mtitle" name="mtitle" placeholder="Title" required />
					</dt>
					<dt class="form-control">
						<textarea placeholder="Description" name="description"></textarea>
					</dt>
					<dt class="form-control">
						<input type="submit" value="Submit Request" name="btn_request" class="btn-login" />
					</dt>
					</form>
				</dl>
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