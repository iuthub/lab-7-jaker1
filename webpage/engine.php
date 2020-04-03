<?php 
//  Here you will find all the necessary functions to facilitate the developement
function db_get($table, ...$matches){
	global $db;

	$sql = "SELECT * FROM $table";


	foreach ($matches as $match) {
		$sql.= strpos($sql, "WHERE")==0 ? " WHERE ".$match[0]." = '".$match[1]."'" : " AND ".$match[0]." = '".$match[1]."'";
	}

	// echo "$sql";
	$result = mysqli_query($db, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);

}
function db_get2($table, $order){
	global $db;

	$sql = "SELECT * FROM $table ORDER BY $order DESC";

	// echo "$sql";
	$result = mysqli_query($db, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);

}



function db_update($table, $id, ...$changes){
	global $db;
	$sql = "UPDATE $table";


	foreach ($changes as $change) {
		$sql.= strpos($sql, "SET")==0 ? " SET ".$change[0]." = '".$change[1]."'" : ", ".$change[0]." = '".$change[1]."'";
	}

	$sql.= " WHERE id='$id'";
	echo "$sql";
	mysqli_query($db, $sql); // Updated




}














 ?>