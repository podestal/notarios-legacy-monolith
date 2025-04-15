<?php 
include("conexion.php");

$numdoc6=$_POST['numdoc6'];
$tidocu2=$_POST['tipodocu2'];

$sqlclie=mysql_query("select * from cliente where  numdoc='$numdoc6' and (tipper='N' and idtipdoc='$tidocu2')", $conn) or die(mysql_error());
$rowclc=mysql_fetch_array($sqlclie);

	 if ($rowclc['numdoc']==""){
	     include ("mostrarnewconyuge2.php"); 
		}else{ 
		 include ("mostrarexisconyuge2.php");
	    }
 //fin
?>
