<!doctype html>
	<head>
		<title>Visflow - Documentation</title>
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
		<div id="pagecontainer">
			<h1>Documentation</h1>
			<p>	
				Visflow is a program designed to help those who do not have technical knowledge in
				 Computer Science nor have any in-depth knowledge of makeflow or iRODS application.
				  Visflow will allow users to take their data from point A to point C without ever
				   having to worry about point B.

				The process is simple. All the user will need is an iRODS account, a large data set, 
				a process script, and access to high performance computing grid, e.g. futuregrid or 
				hpc. They will need to upload the large data set and process script into iRODS and 
				login into Visflow using the iRODS user information. Once the user logs in to Visflow 
				they will be asked a few simple questions and point A will be complete. Point B is 
				where Visflow comes into play. Visflow will take your data and process script and run 
				the necessary program in order to ensure that the user will get the output data they 
				wanted. While Visflow is running it will take the user to a status page and will show 
				constant updates to the user. This will show what workers are running: when it started, 
				when it finished, and how long it took to finish its job. 

				What Visflow strives for is to help bridge the disconnect between scientists in 
				non-computational fields and high performance computing.
			</p>
			<h2>FAQS</h2>
			
			<h3>What is the minumum the user will need to input?</h3>
			<p>'sh imake <*iplant folder> **'
				*the iplant folder will need to have a script or app to run as well as all the data
				**the irods password will be asked later after excecuting imake.sh </p>
			<h3>Where is the irods configuration file stored?</h3>
			<p>~/.irods/.irods/.irodsEnv</p>
			<h3>What is located in the .irodsEnv file?</h3>
			<p>Everything needed for irods to connect to iplant except the password.</p>
			<h3>How do I store the password so I can connect to irods from other machines?</h3>
			<p>read -s -p "Enter irods password: " pass
			   iinit -e $pass</p>
			<h3>What format must the iplant folder be in?</h3>
			<p>Starting from the home folder navigate starting with the folder you wish to navigate as usual 
				in bash. example sh imake tmp/tempFolder/<br/>

				Make sure either the irods folder has been exported to PATH or that the irods folder is found in ~/icommands.
			</p>

			<h2>Server File Details</h2>
			<p>-check_irods_key.sh checks for irods cookie in ~/.irods/.irodsEnv exits with 0 for found exits with 1 for not found</p>
			<p>-getFolder.sh gets the structure (recursively) of irods folder given as argument</p>
			<p>-login.sh gets the pass for irods</p>
			<p>-split_option.sh splits local or remote files found on irods and returns them from whence they came in either a /splits or /chunks directory</p>

		</div>
	</body>
</html>
