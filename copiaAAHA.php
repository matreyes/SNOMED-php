<?php
session_start();

include 'DBManager.class.php';
include 'Concepto.class.php';
include 'conceptos.php';

$DB = new DBmanager;
$DB->conectar();
$_SESSION['i'] = 1;



foreach ($arr as $value) {
 	$query = "SELECT * FROM Descriptions_en WHERE CONCEPTID = $value AND DESCRIPTIONTYPE < 2 AND DESCRIPTIONSTATUS = 0";
	print $query."\n\r";
	$consulta = mysql_query($query);
	while ($row = mysql_fetch_row($consulta)) 
	{	
		insertar($row);
	}		
}

function insertar($row)
{
	$code = $_SESSION['i'];
	$sql = "INSERT INTO diagnosis_en (CODE, CONCEPT_ID, DESCRIPTION_ID, DESCRIPTION, ACTIVE, DESCRIPTIONTYPE) values ('$code','$row[2]','$row[0]','$row[3]','A','$row[5]')";
	mysql_query($sql);
	echo utf8_encode($sql)."\n\r";
	$_SESSION['i']++;
}



?>