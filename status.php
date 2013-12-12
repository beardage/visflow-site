<!doctype html>
<title>Visflow - Status</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="shortcut icon" href="image/favicon.ico" />
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<body>
<div id='topnav'>
	<ul>
		<li><a href="documentation.php">DOCUMENTATION</a></li>
		<li><a href="downloads.php">DOWNLOADS</a></li>
		<li><a href="index.php">ABOUT VISFLOW</a></li>
			<a href="http://visflow.info" id='smalllogopage'>visflow</a>
	</ul>
</div>


<?php
require_once("api/prods-3.3.0-beta1/prods/src/Prods.inc.php");

if(!isset($_POST['mode'])) {
	echo 'Error: No Login';
}
else {
	$mode = $_POST["mode"];
}

if($mode === 'login') {
	$iplantuser = $_POST['iplantname'];
	$iplantpass = html_entity_decode($_POST['iplantpass']);
	$iplanthost = $_POST['iplanthost'];
	$iplantport = $_POST['iplantport'];
	settype($iplantport, 'int');
	$tablename = irod_connect($iplantuser, $iplantpass, $iplanthost, $iplantport);
	echo "<div id='welcome'><span>".$tablename."</span> - connected </div>\n";
}
else echo '<br>Login not found please <a href="login.php">try again</a>';

$user    =  '';
$pass 	 = 	'';
$dsn	 =	"mysql:host='';dbname=''";	
$dbconn	 =	new	PDO($dsn, $user, $pass);
$version =	$dbconn->getattribute(4);


?>





<script>
	$(document).ready(	
		function ()	
		{	
	 		setInterval(get_status, 1000);
	 		

	 		function get_status () {
	 			$.get("backend.php", {table:'<?=$tablename ?>'}, update_status);
	 		}	
	 		function update_status(html) {
	 			
	 			$('#status').html(html);

	 		}

	 		setInterval(get_jsonstatus, 1000);
	 		

	 		function get_jsonstatus () {
	 			$.get("chartbackend.php", {table:'<?=$tablename ?>'}, update_jsonstatus);
	 		}	

	 		function divforworker(w, maxelapsed) {
	 			if (w.elapsed === -1) {

	 				return '<div class="inprogressbar" style="width:' + ( ( w.timesofar / maxelapsed ) * 100) + '%; "><span class=caption>' + w.id +  ' in progress' + '</span> </div>'
	 			}
	 			return '<div class="bar" style="width:'+ ((w.elapsed / maxelapsed) * 100) +'%; "><span class=caption>' + w.id + ' <span class=time>' + w.elapsed + 's</span></span></div>'
	 		}

	 		function rankinggenerator(w, maxelapsed, minelapsed, averagecollection, inprogresscollection) {
	 			stats="";
	 			stats+='<p>slowest worker time: <span class="worker">' + maxelapsed + ' seconds</span></p>';
	 			if (inprogresscollection.length > 0) {
	 				stats+='<p>fastest worker time: <span class="worker">in progress</span></p>';
	 			}
	 			else stats+='<p>fastest worker time: <span class="worker">' + minelapsed + ' seconds</span></p>';
	 			var sum = eval(averagecollection.join('+')), avg = sum / averagecollection.length;

	 			stats+='<p>average worker time: <span class="worker">' + avg.toFixed(2) + ' seconds</span></p>'
	 			
	 			stats+='<p>complete workers: <span class="worker">' + averagecollection.length + ' workers</span></p>'

	 			stats+='<p>in progress workers: <span class="worker">' + inprogresscollection.length + ' workers</span></p>'

	 			return stats;
	 		}

	 		function update_jsonstatus(json) {
	 			workers=JSON.parse(json)
	 			maxelapsed = workers.map(function(o) { return o.elapsed}).sort(function(a,b) { if (+a < +b) return 1; else return -1; })[0]
	 			minelapsed = workers.map(function(o) { return o.elapsed}).sort(function(a,b) { if (+a > +b) return 1; else return -1; })[0]

	 			var html="";
	 			var averagecollection= new Array();
	 			var inprogresscollection= new Array();
	 			for(var i=0; i<workers.length;i++) {
	 				var w=workers[i];
	 				if (workers[i].elapsed != -1) {
	 					averagecollection.push(workers[i].elapsed);
	 				}
	 				else if (workers[i].elapsed == -1) {
	 					inprogresscollection.push(workers[i].elapsed);
	 				}
	 				
	 				html+=divforworker(w, maxelapsed);
	 			}
	 			$('#chart').html(html);

	 			var rankingshtml="";
	 			rankingshtml+=rankinggenerator(w, maxelapsed, minelapsed, averagecollection, inprogresscollection);
	 			$('#rankings').html(rankingshtml);

	 		}

		});
</script>



<div id='statuscontainer'>
	<h1 class="statusheadings">Workers</h1>
	<div id='status'></div>
</div>

<div id='statuscontainer'>
	<h1 class="statusheadings">Rankings</h1>
	<div id="rankings" >

	</div>
	<div id="chart">
	    
	</div>
</div>

</body>
</html>

<?php

// Functions //
function irod_connect($iplantuser, $iplantpass, $iplanthost, $iplantport) {
	
	//connect to irods, download webstart.txt for table reference.
	$irodsconn = new RODSAccount($iplanthost, $iplantport, $iplantuser, $iplantpass);
	$webstart = new ProdsFile($irodsconn, "/iplant/home/".$iplantuser."/visflow/webstart.txt");
	$webstart->open("r");
	
	$str=$webstart->read(4096);
	$webstart->close();
	return $str;
}




?>
