<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$xasignaid=$_POST['xasignaid'];
$xasignaitem=$_POST['xasignaitem'];
$xasignacondi=$_POST['xasignacondi'];
$xasignavalor=$_POST['xasignavalor'];
$fecha_modificacion = date("d/m/Y");

mysql_query("UPDATE contratantesxacto SET monto='$xasignavalor' where idcondicion='$xasignacondi' and id='$xasignaid'", $conn) or die(mysql_error());

$sqlsumam="SELECT SUM(monto) as sumamonto FROM contratantesxacto WHERE kardex = '$codkardex' and (idcondicion='$xasignacondi' and item='$xasignaitem')";
$rptasumam=mysql_query($sqlsumam,$conn) or die(mysql_error());
$rowsumam=mysql_fetch_array($rptasumam);	
$sumamontos=$rowsumam['sumamonto'];

$sqltrans="SELECT * FROM patrimonial WHERE kardex = '$codkardex' and item='$xasignaitem'";
$rptatrans=mysql_query($sqltrans,$conn) or die(mysql_error());
$rowtransa=mysql_fetch_array($rptatrans);	
$transaccion=$rowtransa['importetrans'];

if ($sumamontos<$transaccion){
	echo"La suma de los montos es: ".$sumamontos.", no puede ser menor a ".$transaccion;
	}
if ($sumamontos>$transaccion){
	
	echo"La suma de los montos es: ".$sumamontos.", no puede ser mayor a ".$transaccion;
	}
	
$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());
	
?>