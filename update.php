


<?php

$user    =  '';
$pass 	 = 	'';

$dsn	 =	"mysql:host='';dbname=''";	
$conn	 =	new	PDO($dsn, $user, $pass);
$version =	$conn->getattribute(4);	
echo $version;


if(!isset($_GET['mode'])) {
	echo 'You should not be here.';
}
else {
	$mode = $_GET["mode"];
}


if ($mode === "add") {
	$table = $_GET['table'];
	$id = $_GET['id'];
	$status = $_GET['status'];
	add_worker($table, $id, $status);
	echo 'worker added';
}
else if ($mode === "update") {
	$table = $_GET['table'];
	$id = $_GET['id'];
	$status = $_GET['status'];
	update_worker($table, $id, $status);
	echo 'worker updated';
}
else if ($mode === "reset") {
	$tabletoreset = $_GET['table'];
	reset_table($tabletoreset);
	echo 'table reset';
}
else if ($mode === "create") {
	$table = $_GET['table'];
	create_table($table);
	echo 'table created';
}




function create_table($table) {
	global $conn;
	$stmt = $conn->prepare("create table if not exists $table (
 			`id` bigint not null auto_increment primary key,
 			`starttime` datetime,
 			`endtime` datetime,
 			`status` int not null
 			)");
	$result = $stmt->execute();


	if(!$result) {
		var_dump($stmt->errorInfo());
		die("error!");
	}
}

function reset_table($tabletoreset) {
	global $conn;
	$stmt = $conn->prepare("delete from $tabletoreset");
	
	$result = $stmt->execute();



	if(!$result) {
		var_dump($stmt->errorInfo());
		die("error!");
	}
}

function update_worker($table, $id, $status) {
	global $conn;
	$stmt = $conn->prepare("update $table set endtime=now() where id=:id; update $table set status=:status where id=:id;");
	//$stmt->bindParam(':table', $table);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':status', $status);
	$result = $stmt->execute();

	if(!$result) {
		var_dump($stmt->errorInfo());
		die("error!");
	}
}


function add_worker($table, $id, $status) {
	global $conn;
	$stmt = $conn->prepare("
		insert into $table (id, starttime, status) values(:id, now(), :status)");
	//$stmt->bindParam(':table', $table);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':status', $status);
		
	echo "table = ($table)";
	$result = $stmt->execute();
	if(!$result) {
		var_dump($stmt->errorInfo());
		die("error!");
	}

	

	
}

?>
