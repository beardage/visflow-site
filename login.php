<!doctype html>
<head>
	<title>Visflow - Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" href="image/favicon.ico" />
</head>
<body>
<div id='topnav'>
	<ul>
		<li><a href="documentation.php">DOCUMENTATION</a></li>
		<li><a href="downloads.php">DOWNLOADS</a></li>
		<li><a href="index.php">ABOUT VISFLOW</a></li>
			<a href="http://visflow.info" id='smalllogopage'>visflow</a>
	</ul>
</div>
<div id="welcome"><a href="login.php">LOGIN</a></div>


	<div id="logo"><a href="index.php">visflow</a></div>
	<div id="logincontainer">
	<p>Enter your iPlant credentials here after you&#39;ve started the Visflow script on a 
	high performance computing grid to view status and download files. Need help? Check out the <a href="documentation.html">documentation.</a></p>

	<form action="status.php" method=POST>
		<input type="hidden" name="mode" value="login">
		<input class="loginform" type="text" name="iplantname" placeholder="username">
		<input class="loginform" type="password" name="iplantpass" placeholder="password">
		<input class="loginform" type="text" name="iplanthost" placeholder="host server">
		<input class="loginport" type="text" name="iplantport" placeholder="port"> <input class="loginbutton" type="submit" value="LOGIN TO IPLANT">
	</form>

</div>

<?php
echo '</body>';
echo '</html>';
?>