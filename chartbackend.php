<?php
$user    =  '';
$pass 	 = 	'';

$dsn	 =	"mysql:host='';dbname=''";	
$dbconn	 =	new	PDO($dsn, $user, $pass);
$version =	$dbconn->getattribute(4);
date_default_timezone_set(timezone_name_from_abbr("CST"));

$tablename = $_GET['table'];


$workers = loadworkers();
printchart($workers);	


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

function get_seconds($s) {

	$date = date_create_from_format('Y-m-d H:i:s', $s);
	
	return date_timestamp_get($date);
}

function printchart($workers) {
	$result = array();
	foreach($workers as $worker) {

		$id=$worker['id'];
		$starttime=$worker['starttime'];
		$endtime=$worker['endtime'];

		if ($endtime === NULL) {
			$endtime=""; 
			$elapsed=-1;
			$day = time();
//			echo $day;
//			echo " ";
//			echo get_seconds($starttime);

			$timesofar = $day - get_seconds($starttime); 
		}
		else {
//			echo get_seconds($endtime);
//			echo " ";
//			echo get_seconds($starttime);
			$elapsed=get_seconds($endtime)-get_seconds($starttime);
			$timesofar = 0;
		}



		$barstatus = array(
			'id'=>$id,
			'starttime'=>$starttime,
			'endtime'=>$endtime,
			'elapsed'=>$elapsed,
			'timesofar'=>$timesofar
			
		);

		array_push($result, $barstatus);


	}
	echo json_encode($result);
}

?>