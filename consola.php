<?php
session_start();

include 'DBManager.class.php';
include 'Concepto.class.php';

$DB = new DBmanager;
$DB->conectar();
$_SESSION['conect'] = $DB->conect;

//$_SESSION['i'] = 1;
//$concept = new Concepto('404684003');



?>