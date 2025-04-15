<?php 

include("conexion.php");

$detmp     = $_POST['detmp'];
$kardex    = $_POST['kardex'];
$codkardex    = $_POST['codkardex'];
$codmepag  = $_POST['mediopago'];
$idbancos  = intval($_POST['entidadfinanciera']);
$importemp = floatval($_POST['impmediopago']);
$foperacion = $_POST['fechaoperacion'];
$documentos = $_POST['documentos'];
$monedas2   = $_POST['monedas2'];
$fecha_modificacion = date("d/m/Y");

/*if ($profocupa3==""){
$idcargoosss3=0;
}else{
$idcargoosss3=$idcargoo3;
}*/

if ($codmepag==""){
$codmepagx=0;
}else{
$codmepagx=$codmepag;
}

$grabarmpagos="UPDATE detallemediopago SET detallemediopago.codmepag = $codmepagx, detallemediopago.idbancos = '$idbancos', 
detallemediopago.importemp = '$importemp', detallemediopago.foperacion = '$foperacion', detallemediopago.documentos = '$documentos', detallemediopago.idmon = '$monedas2' WHERE detallemediopago.detmp = '$detmp'";
mysql_query($grabarmpagos,$conn) or die(mysql_error());

$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion',estado_sisgen='0' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());

echo "UPDATE detallemediopago SET detallemediopago.codmepag = $codmepagx, detallemediopago.idbancos = '$idbancos', 
detallemediopago.importemp = '$importemp', detallemediopago.foperacion = '$foperacion', detallemediopago.documentos = '$documentos', detallemediopago.idmon = '$monedas2' WHERE detallemediopago.detmp = '$detmp'";



?>



