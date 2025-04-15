<?php 
include("conexion.php");

$numdoc2=$_POST['numdoc2'];
$tidocu=$_POST['tidocu'];


$sqlclie=mysql_query("select * from cliente where  numdoc='$numdoc2' and (tipper='N' and idtipdoc='$tidocu')", $conn) or die(mysql_error());
$rowclc=mysql_fetch_array($sqlclie);

	 if ($rowclc['numdoc']==""){
	     include ("mostrarnewconyuge.php"); 
		}else{ 
		 include ("mostrarexisconyuge.php");
	    }
?>
