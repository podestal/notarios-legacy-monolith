<?php 
include("conexion.php");

$loginusuario=strtoupper($_POST['loginusuario']);
$password=strtoupper($_POST['password']);
$apepat=strtoupper($_POST['apepat']);
$apemat=strtoupper($_POST['apemat']);
$prinom=strtoupper($_POST['prinom']);
$segnom=strtoupper($_POST['segnom']);
$dni=strtoupper($_POST['dni']);
$fecnac=$_POST['fecnac'];
$estado=1;
$domicilio=strtoupper($_POST['domicilio']);
$idubigeo=intval($_POST['idubigeo']);
$telefono=$_POST['telefono'];
$idcargo=intval($_POST['idcargo']);

$sql="INSERT INTO usuarios(idusuario, loginusuario, password, apepat, apemat, prinom, segnom, fecnac, estado, domicilio, idubigeo, telefono, idcargo, dni) VALUES (NULL,'$loginusuario','$password', '$apepat','$apemat','$prinom','$segnom','$fecnac','$estado','$domicilio','$idubigeo','$telefono', '$idcargo','$dni')";
mysql_query($sql,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('El usuario se grabo satisfactoriamente');</script>
<script type="text/javascript">window.location="new_usuarios.php"; </script>