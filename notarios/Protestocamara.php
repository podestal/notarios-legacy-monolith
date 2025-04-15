<?php
require("conexion.php");

$id_poder = $_REQUEST["id_poder"];

$consulta = mysql_query("SELECT protesto.camara AS 'datos' FROM protesto  WHERE id_protesto=  '".$id_poder."' ", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["datos"];

/*$Arraymenu = array();
while($row= mysql_fetch_array($consulta))
{
  array_push($Arraymenu, $row[0]);	
}*/

//var_dump($Arraymenu);
echo $data;

// evaluacion

?>