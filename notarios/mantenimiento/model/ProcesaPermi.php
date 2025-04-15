<?php
require("../../conexion.php");

$idusuario = $_REQUEST["idusuario"];

$consulta = mysql_query("SELECT CONCAT('[', GROUP_CONCAT(m_permi.menuid),']') AS 'datos' FROM usuarios INNER JOIN m_permi ON m_permi.cdg_usr = usuarios.idusuario WHERE cdg_usr=  '".$idusuario."' ", $conn) or die(mysql_error());
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