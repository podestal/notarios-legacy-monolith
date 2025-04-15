<?php 
include("conexion.php");

$kardex=$_POST['codkardex'];
$id=$_POST['id'];



//si se crea el kardex
$consult = mysql_query("select idtipkar,codactos,contrato,idusuario,responsable,numescritura,fechaescritura FROM kardex WHERE kardex='$kardex' and idkardex=$id", $conn) or die(mysql_error());


$row = mysql_fetch_assoc($consult);


$consulta=mysql_query("insert into kardex (kardex,idtipkar,codactos,contrato,idusuario,responsable,numescritura,fechaescritura) 
					values ('$kardex',".$row['idtipkar'].",'".$row['codactos']."','".$row['contrato']."',
					".$row['idusuario'].",".$row['responsable'].",'".$row['numescritura']."','".$row['fechaescritura']."')",$conn);
					
	$consul=mysql_query("update kardex set nc=1,fechaescritura='0000-00-00',numescritura='',referencia='NO CORRE' WHERE kardex='$kardex' and idkardex=$id",$conn);


				
					
?>