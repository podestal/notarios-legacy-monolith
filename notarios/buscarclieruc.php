<?php 
include("conexion.php");
$codclie = $_POST['codclie'];

$sqlclie=mysql_query("select * from cliente where  idcliente = '$codclie'", $conn) or die(mysql_error());
$row=mysql_fetch_array($sqlclie);
 if ($row['tipper']=="N"){//es natural
 include("mostrarclientelib.php");
}else{
 include ("mostrarempresalib.php");
 }    
			
 
?>