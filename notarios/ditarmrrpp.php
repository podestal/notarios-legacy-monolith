<?php 
include('conexion.php');
$itemcodmovreg = $_POST['itemcodmovreg'];

$sqldelemrp = "SELECT detallemovimiento.itemmov,detallemovimiento.idmovreg,detallemovimiento.fechamov,
  detallemovimiento.vencimiento,detallemovimiento.titulorp,detallemovimiento.idestreg,detallemovimiento.idsedereg,
  detallemovimiento.idsecreg,detallemovimiento.idtiptraoges,detallemovimiento.idestreg,
  detallemovimiento.encargado AS idEncargado,
  CONCAT(usuarios.prinom, ' ',usuarios.segnom,' ',usuarios.apepat,' ',usuarios.apemat ) AS encargado,
  detallemovimiento.anotacion, detallemovimiento.importee, detallemovimiento.observa,
  detallemovimiento.numeroo,detallemovimiento.mayorderecho,detallemovimiento.registrador,
  detallemovimiento.numeroPartida,detallemovimiento.asiento,detallemovimiento.recibo,detallemovimiento.fechaInscripcion
 FROM detallemovimiento INNER JOIN usuarios ON detallemovimiento.encargado = usuarios.idusuario WHERE detallemovimiento.itemmov = '$itemcodmovreg'"; 
$resultt = mysql_query($sqldelemrp,$conn) or die(mysql_error());

$rowmmvv = mysql_fetch_array($resultt);

$objResponse = new stdClass();
$objResponse->error  = 0;

if($rowmmvv){
  $objResponse->data = $rowmmvv;
}else{
  $objResponse->error  = 1;
  $objResponse->data = array();
}

echo  json_encode($objResponse);


?>

