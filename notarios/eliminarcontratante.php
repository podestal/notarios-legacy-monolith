<?php 
include('conexion.php');
$idcontra=$_POST['idcontra'];
echo $idcontra;
$sqldeleclie2="DELETE FROM cliente2 WHERE idcontratante='$idcontra'"; 
mysql_query($sqldeleclie2,$conn) or die(mysql_error());

$sqldelcontra="DELETE FROM contratantes WHERE idcontratante='$idcontra'"; 
mysql_query($sqldelcontra,$conn) or die(mysql_error());

$sqldelcontaxacto="DELETE FROM contratantesxacto WHERE idcontratante='$idcontra'"; 
mysql_query($sqldelcontaxacto,$conn) or die(mysql_error());


$sqldelcontrarent="DELETE FROM renta WHERE idcontratante='$idcontra'"; 
mysql_query($sqldelcontrarent,$conn) or die(mysql_error());

?>