<?php
$user    =  '';
$pass 	 = 	'';

$dsn	 =	"mysql:host='';dbname=''";	
$dbconn	 =	new	PDO($dsn, $user, $pass);
$version =	$dbconn->getattribute(4);


$tablename = $_GET['table'];


$workers = loadworkers();
printstatus($workers);	


function loadworkers() {
	global $dbconn;
	global $tablename;
		//	server	version	
	$workers = array();

	$stmt = $dbconn->query("select * from ". $tablename ." order by id");
	foreach	($stmt->fetchAll(PDO::FETCH_ASSOC) as	$row)	{
		$id = $row["id"];
		$starttime = $row["starttime"];
		$endtime = $row["endtime"];
		$status = $row["status"];
		$workers[] = array("id" => $id, "starttime" => $starttime, "endtime" => $endtime, "status" => $status);
	}
	
	return $workers;
}

function printstatus($workers) {
	
	foreach($workers as $worker) {
		echo "<div class='statussingle'>\n";
		echo '<p>id: <span class=worker>'.$worker['id']."</span></p>\n";
		echo '<p>start time: <span class=worker>'.$worker['starttime']."</span></p>\n";
		echo '<p>end time: <span class=worker>'.$worker['endtime']."</span></p>\n";
		if($worker['status'] === '1') {
			echo "<p>status: <span class=worker>started.</span></p>\n";
		}
		else if ($worker['status'] === '2') {
			echo "<p>status: <span class=worker>finished.</span></p>\n";
		}
		else if ($worker['status'] === '3') {
			echo "<p>status: <span class=worker>failed, diverting worker.</span></p>\n";
		}
		echo "</div>";

		

	}
}

?>