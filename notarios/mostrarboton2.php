<?php
include("conexion.php");
$contrataa=intval($_POST['contrata']);

$consultac=mysql_query("Select * from renta where idcontratante='$contrataa'", $conn) or die(mysql_error());
$rowcc = mysql_fetch_array($consultac);

if (!empty($rowcc)){
	if($rowcc['pregu3'=="0"]){
 ?>
<a href="#" onClick="validarformul()"><img src='iconos/ingresarformulario.png' border="0"/></a>

<?php
	}
}

 ?>

