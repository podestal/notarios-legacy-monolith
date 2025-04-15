<?php 
include("conexion.php");

$numdoc6=$_POST['numdoccnt'];

$sqlclie=mysql_query("select * from cliente where numdoc='$numdoc6' and tipper='N'", $conn) or die(mysql_error());
$rowclc=mysql_fetch_array($sqlclie);

	 if ($rowclc['numdoc']!=""){
	     include ("mostrarexisconyugecnt.php");
		}else{ 
		  include ("mostrarnewconyugecnt.php");
	    }

 
?>
