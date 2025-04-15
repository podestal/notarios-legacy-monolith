<?php
include("conexion.php");
$idcliente = $_REQUEST["idcliente"];

$sqldata = mysql_query("SELECT * FROM cliente WHERE cliente.idcliente = '$idcliente'");
$rows = array();
while($r = mysql_fetch_assoc($sqldata)) {
  $rows[] = $r;
}
echo json_encode($rows);

?>