<?php 

include("../../conexion.php");
	$codclie		= $_POST['codclie'];
	$codubi 		= $_POST['codubi'];
	$razonsocial 	= $_POST['razonsocial'];
	$domfiscal	 	=  $_POST['domfiscal'];
	$contacempresa 	=  $_POST['contacempresa'];
	$fechaconstitu 	=  $_POST['fechaconstitu'];
	$numregistro 	=  $_POST['numregistro'];
	$idsedereg3 	=  $_POST['idsedereg3'];
	$numpartida 	=  $_POST['numpartida'];
	$telempresa 	=  $_POST['telempresa'];
	$actmunicipal 	=  $_POST['actmunicipal'];
	$mailempresa 	=  $_POST['mailempresa'];
	
	$ubigen 		=  $_POST['ubigen'];
	$codubi 		= $_POST['codubi'];
	
	$numero_ruc		= $_POST['numero_ruc'];

if ($ubigen==""){
$idubigeoos4=0;
}else{
$idubigeoos4=$codubi;
}

$grabarclientesc2="UPDATE cliente SET razonsocial='$razonsocial',domfiscal='$domfiscal',idubigeo='$idubigeoos4',contacempresa='$contacempresa',fechaconstitu='$fechaconstitu',numregistro='$numregistro',idsedereg='$idsedereg3',numpartida='$numpartida',telempresa='$telempresa',actmunicipal='$actmunicipal',mailempresa='$mailempresa', numdoc = '$numero_ruc', idtipdoc='8'  WHERE idcliente='$codclie'";
mysql_query($grabarclientesc2,$conn) or die(mysql_error());

/*if ($cconyuge6!=""){

$grabarconyugee="update cliente set conyuge='$codclie3' where idcliente='$cconyuge6'";
mysql_query($grabarconyugee,$conn) or die(mysql_error());

}*/

//echo"<input name='cconyuge' type='hidden' value='$codclie3' /><img src='iconos/conyugeadd.png' />";

?>