<?php 
include("conexion.php");

$codkardex  = $_POST['codkardex'];

$itemmp     = $_POST['itemmp'];
$tipoactopatri = $_POST['tipoactopatri'];
$nnminuta   = $_POST['nnminuta'];
$imptrans   = $_POST['imptrans'];
$tipomoneda = $_POST['tipomoneda'] == ''?0:$_POST['tipomoneda'];
$exibio     = $_POST['exibio'];
$tipcambio  = $_POST['tipcambio'];
$fecha_modificacion = date("d/m/Y");

# new : 
$idoppago      = $_POST['idoppago'];
$des_idoppago  = strtoupper($_POST['des_idoppago']);
$fpago  = $_POST['fpago3'];

$sqlmp="UPDATE patrimonial SET  patrimonial.nminuta='$nnminuta', patrimonial.idmon='$tipomoneda', patrimonial.tipocambio='$tipcambio', patrimonial.importetrans='$imptrans', patrimonial.exhibiomp='$exibio', patrimonial.idoppago = '$idoppago', patrimonial.des_idoppago = '$des_idoppago', patrimonial.fpago='$fpago'  WHERE patrimonial.itemmp = '$itemmp'"; 
mysql_query($sqlmp,$conn) or die(mysql_error());

$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion',estado_sisgen='0' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());


$sqlacto=mysql_query("Select * from tiposdeacto where idtipoacto='".$tipoactopatri."'", $conn) or die(mysql_error());
$rowaccto=mysql_fetch_array($sqlacto);

$humbral=$rowaccto['umbral'];

if ($tipomoneda==1){
$conver=floatval($imptrans)/floatval($tipcambio);
  if(floatval($humbral) < floatval($conver)){
    mysql_query("update kardex set horaingreso='1' where kardex='$codkardex'",$conn) or die(mysql_error()); 
mysql_query("INSERT INTO rouif(item, kardex, uni, sospe) VALUES (NULL,'$codkardex','no','no')",$conn) or die(mysql_error());
	echo"<span style='font-family:Calibri; font:bold; font-size:15px; color:#036'>* UIF - RO </span>|<input type='checkbox' name='inu' id='inu' onclick='valorinu(this.checked)' /><span style='font-family:Calibri; font-size:12px; color:#036'>OPERACION INUSUAL</span>";
  }
}else{
 if(floatval($humbral) < floatval($imptrans)){
    mysql_query("update kardex set horaingreso='1' where kardex='$codkardex'",$conn) or die(mysql_error()); 
mysql_query("INSERT INTO rouif(item, kardex, uni, sospe) VALUES (NULL,'$codkardex','no','no')",$conn) or die(mysql_error());
	echo"<span style='font-family:Calibri; font:bold; font-size:15px; color:#036'>* UIF - RO </span>|<input type='checkbox' name='inu' id='inu' onclick='valorinu(this.checked)' /><span style='font-family:Calibri; font-size:12px; color:#036'>OPERACION INUSUAL</span>";
   }
}
#============================================================================================================================================


?>