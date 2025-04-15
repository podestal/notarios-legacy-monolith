<?php session_start(); 
include("conexion.php");

$codkardex          = $_POST['codkardex']; 
$fecha_modificacion = date("d/m/Y");
if($_POST['mediopago']!=""){
	$mediopago=$_POST['mediopago'];
}else{
	$mediopago=0;
}

$entidadfinanciera  = intval($_POST['entidadfinanciera']);
$impmediopago       = floatval($_POST['impmediopago']);
$fechaoperacion     = $_POST['fechaoperacion'];
$documentos         = $_POST['documentos'];

if($_REQUEST['itemmpp']==''){	
	$itemmpp        = $_SESSION['varitem'];
}else if($_REQUEST['itemmpp']!=''){
	$itemmpp        = $_REQUEST['itemmpp'];
}

$concatenado        = $_POST['idtipacto'];
$rows               = explode("|",$concatenado );
$idtipacto          = $rows[0];

$fpago				= $_POST['fpago'];
$idmon				= $_POST['idmon'];


mysql_query("INSERT INTO detallemediopago(detmp, itemmp, kardex, tipacto, codmepag, fpago, idbancos, importemp, idmon, foperacion, documentos) VALUES (NULL,'$itemmpp','$codkardex', '$idtipacto',$mediopago, '$fpago','$entidadfinanciera','$impmediopago', '$idmon','$fechaoperacion','$documentos')", $conn) or die(mysql_error());


$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion',estado_sisgen='0' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());
