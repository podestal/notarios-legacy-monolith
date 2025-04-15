<?php 
include("conexion.php");
$codclie = $_POST['codclie'];

$sqlclie=mysql_query("select * from cliente where  idcliente = '$codclie'", $conn) or die(mysql_error());
$row=mysql_fetch_array($sqlclie);
 if ($row['tipper']=="N"){//es natural
    if ($row['tipocli']=="1"){
	   include("mostrarimpedido.php");
	}else{
		 include("mostrarcliente.php");
		}
}else{
	if ($row['tipocli']=="1"){
	   include ("mostrarempresa2.php");
	}else{
    include ("mostrarempresa.php");
	}
 }    
			
 
?>
