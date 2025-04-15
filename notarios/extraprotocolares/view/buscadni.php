<?php 
include("../../conexion.php");

$numdoc2        = $_POST['numdoc2'];
$tipdoc_conyuge = $_POST['tipdoc_conyuge'];

$sqlclie=mysql_query("select * from cliente where  numdoc = '$numdoc2' and idtipdoc='$tipdoc_conyuge' and tipper='N'", $conn) or die(mysql_error());
$rowclc=mysql_fetch_array($sqlclie);

	 if ($rowclc['numdoc']!=""){
	     include ("mostrarexisconyuge.php");
		}else{ 
		  include ("mostrarnewconyuge.php");
	    }

 
?>
