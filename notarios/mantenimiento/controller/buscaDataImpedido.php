<?php
include("../../conexion.php");
$id_cliente = $_REQUEST["id_cliente"];

$sqldata = mysql_query("SELECT * FROM cliente WHERE cliente.idcliente = '$id_cliente'");
$rows = array();
while($r = mysql_fetch_assoc($sqldata)) {
  $rows[] = $r;
}
echo json_encode($rows);

?>