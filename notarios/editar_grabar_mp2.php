<?php 
include("conexion.php");

$codkardex  = $_POST['codkardex'];

$itemmp     = $_POST['itemmpp'];
$tipoactopatri = $_POST['tipoactopatri'];
$nnminuta   = $_POST['nnminuta'];
$imptrans   = $_POST['imptrans'];
$tipomoneda = $_POST['tipomoneda'];
$exibio     = $_POST['exibio'];
$tipcambio  = $_POST['tipcambio'];

# new : 
$idoppago      = $_POST['idoppago'];
$des_idoppago  = strtoupper($_POST['des_idoppago']);


$sqlmp="UPDATE patrimonial SET  patrimonial.nminuta='$nnminuta', patrimonial.idmon='$tipomoneda', patrimonial.tipocambio='$tipcambio', patrimonial.importetrans='$imptrans', patrimonial.exhibiomp='$exibio', patrimonial.idoppago = '$idoppago', patrimonial.des_idoppago = '$des_idoppago'  WHERE patrimonial.itemmp = '$itemmp'"; 

mysql_query($sqlmp,$conn) or die(mysql_error());

$sqlacto=mysql_query("Select * from tiposdeacto where idtipoacto='".$tipoactopatri."'", $conn) or die(mysql_error());
$rowaccto=mysql_fetch_array($sqlacto);

$humbral=$rowaccto['umbral'];

if ($tipomoneda==1){
$conver=floatval($imptrans)/floatval($tipcambio);
  if(floatval($humbral) < floatval($conver)){
    mysql_query("update kardex set horaingreso='1' where kardex='$codkardex'",$conn) or die(mysql_error()); 
mysql_query("INSERT INTO rouif(item, kardex, uni, sospe) VALUES (NULL,'$codkardex','no','no')",$conn) or die(mysql_error());
	echo"<span style='font-family:Calibri; font:bold; font-size:15px; color:#036'>* UIF - RO </span>|<input type='checkbox' name='inu' id='inu' onclick='valorinu(this.checked)' /><span style='font-family:Calibri; font-size:12px; color:#036'>OPERACION INUSUAL</span>";
  echo "<input name='itemmpp' id='itemmpp' readonly='readonly' type='hidden' value='".$itmp."' size='8'>";
  }
}else{
 if(floatval($humbral) < floatval($imptrans)){
    mysql_query("update kardex set horaingreso='1' where kardex='$codkardex'",$conn) or die(mysql_error()); 
mysql_query("INSERT INTO rouif(item, kardex, uni, sospe) VALUES (NULL,'$codkardex','no','no')",$conn) or die(mysql_error());
	echo"<span style='font-family:Calibri; font:bold; font-size:15px; color:#036'>* UIF - RO </span>|<input type='checkbox' name='inu' id='inu' onclick='valorinu(this.checked)' /><span style='font-family:Calibri; font-size:12px; color:#036'>OPERACION INUSUAL</span>";
  echo "<input name='itemmpp' id='itemmpp' readonly='readonly' type='hidden' value='".$itmp."' size='8'>";
   }
}
#=======================================================================

?>