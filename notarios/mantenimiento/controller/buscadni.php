<?php 
include("../../conexion.php");

$numdoc2=$_POST['numdoc2'];

$sqlclie=mysql_query("select * from cliente where  numdoc LIKE '%$numdoc2%' and tipper='N'", $conn) or die(mysql_error());
$rowclc=mysql_fetch_array($sqlclie);

	 if ($rowclc['numdoc']!=""){
	     include ("mostrarexisconyuge.php");
		}else{ 
		  include ("mostrarnewconyuge.php");
	    }

 
?>
