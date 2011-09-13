<?php
session_start();

include 'DBManager.class.php';
include 'Concepto.class.php';

$DB = new DBmanager;
$DB->conectar();
$_SESSION['conect'] = $DB->conect;
//$_SESSION['i'] = 1;


	
$concept = new Concepto('404684003');
//$concept = new Concepto('33384004');



foreach ($concept->getDescendencia() as $value) {
 	$query = "SELECT * FROM descriptions WHERE CONCEPTID = $value AND DESCRIPTIONTYPE < 3 AND DESCRIPTIONSTATUS = 0";
//	print $query."\n\r";
	$consulta = mysql_query($query, $_SESSION['conect']);
	while ($row = mysql_fetch_row($consulta)) 
	{	
		insertar($row);
	}		
}

function insertar($row)
{
//	$code = "GT".$_SESSION['i'];
	$sql = "INSERT INTO diagnosis_es (CONCEPT_ID, DESCRIPTION_ID, DESCRIPTION, ACTIVE, DESCRIPTION_TYPE) values ('$row[2]', '$row[0]','$row[3]','A','$row[5]')";
	mysql_query($sql);
	echo $row[3]."\n\r";
//	$_SESSION['i']++;
}



?>