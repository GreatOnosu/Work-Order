<!DOCTYPE html>
<html>
<head runat="server">
	<base href="/Vicky/public/">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BENSON IDAHOSA UNIVERSITY WORK ORDER SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/magic.css">
</head>
<body>
	<section id="title">
		<h1>Benson Idahosa University</h1>
		<h2>Work Order System</h2>
	</section>
	<section id="container">		
		<article class="left-container">
			<span style="color: #cc1212;"><?=$stat?></span>
			<h1>LOGIN</h1>
			<form action="Home/index" method="post" style="text-align: center;">
				<input type="text" name="username" placeholder="Username" required />
				<input type="password" name="pin" placeholder="Password" required />
				<input type="submit" value="Login" class="btn-login" name="btn_login" />
			</form>
		</article>
		<article class="right-container">
			<h1>Register</h1>
			<a href="Home/signup" class="btn-register">Sign Up</a>
		</article>
	</section>
</body>
</html>