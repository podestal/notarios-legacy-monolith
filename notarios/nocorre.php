<?php 
include("conexion.php");

$kardex=$_POST['codkardex'];

$id=$_POST['id'];


$consul=mysql_query("update kardex set nc=1,fechaescritura='0000-00-00',numescritura='',referencia='NO CORRE' WHERE kardex='$kardex' and idkardex=$id",$conn);

					
?>