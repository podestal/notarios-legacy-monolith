<?php
include("conexion.php");
$detveh = $_REQUEST["detveh"];

$sqldata = mysql_query("SELECT * FROM detallevehicular WHERE detallevehicular.detveh = '$detveh' ");
$rows = array();
while($r = mysql_fetch_assoc($sqldata)) {
  $rows[] = $r;
}
echo json_encode($rows);

?>