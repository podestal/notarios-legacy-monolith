<?php 

include("conexion.php");


$nombre    = strtoupper($_POST['nombre']);
$apellido  = strtoupper($_POST['apellido']);
$ruc       = strtoupper($_POST['ruc']);
$telefono  = strtoupper($_POST['telefono']);
$direccion = strtoupper($_POST['direccion']);
$codnotario = strtoupper($_POST['codnotario']);
$codoficial = strtoupper($_POST['codoficial']);
$coduif = strtoupper($_POST['coduif']);


$email     = $_POST['correo'];
$item      = intval("1");

#                                                          distrito  
## NEW:
$distrito     = strtoupper($_POST['notariode']);

$sql="select * from confinotario where idnotar='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());
$row=mysql_fetch_array($rpta);


if($row['idnotar']=='1'){
	?>
    <script language='javascript'>alert('Ya se encuentra registrado el Notario');</script>
	<?php
	}else{
		$grabarclientesc="INSERT INTO confinotario(idnotar, nombre, apellido, telefono, correo, ruc, direccion, distrito, codnotario, codoficial, coduif) VALUES ('$item','$nombre','$apellido','$telefono','$email','$ruc', '$direccion', '$distrito', '$codnotario', '$codoficial', '$coduif')";
		mysql_query($grabarclientesc,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('grabado satisfactoriamente');</script> 
<?php
		
		}


?>


