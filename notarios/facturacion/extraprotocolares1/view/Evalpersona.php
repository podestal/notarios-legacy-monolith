<?php
//$id_supervivencia = $_REQUEST["id_supervivencia"];
$swt_capacidad = $_REQUEST["swt_capacidad"];

if($swt_capacidad =='C')
{
	require_once("EditPCapazVie.php");
}

else if($swt_capacidad =='I')
{
	require_once("EditPIncapazVie.php");
}

?>