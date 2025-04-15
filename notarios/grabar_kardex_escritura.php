<?php 

include("conexion.php");
$codkardex=$_POST['codkardex'];
$numminuta=$_POST['numminuta'];
$folioini=$_POST['folioini'];
$foliofin=$_POST['foliofin'];
$papelfin=$_POST['papelfin'];
$papelini=$_POST['papelini'];
$numescritura=$_POST['numescritura'];
$fechaescritura=$_POST['fechaescritura'];
$fechaconclusion=$_POST['fechaconclusion'];
$tomo=$_POST['tomo'];
$registro=$_POST['registro'];
$fechaminuta=$_POST['fechaminuta'];
$fecha_modificacion = date("d/m/Y");

$papelTrasladoIni = $_POST['papelTrasladoIni'];
$papelTrasladoFin = $_POST['papelTrasladoFin'];

$idtipkar = $_POST['idtipkar'];

if($fechaminuta!=''){
$t_fechminu=explode ("/",$fechaminuta);
$fin_fechaminuta= $t_fechminu[2]."-".$t_fechminu[1]."-".$t_fechminu[0];
}else{
$fin_fechaminuta='';
}


$tiempo = explode ("/",$fechaescritura);
if($fechaescritura==''){
	$fechaes = NULL;
}else{
	$fechaes = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];
}
if($numescritura==''){
	$numescritura = NULL;
}

$queryEscritura = "SELECT kardex,numescritura,idtipkar,responsable_new as usuario,LEFT(fechaescritura,4) as anio_escritura FROM kardex WHERE numescritura='$numescritura' and idtipkar='$idtipkar' and LEFT(fechaescritura,4) = '".$tiempo[2]."'";
$resultEscritura = mysql_query($queryEscritura,$conn) or die(mysql_error());
$numeroEscritura = mysql_fetch_assoc($resultEscritura);

if($numeroEscritura['kardex'] != $codkardex){
	if($numeroEscritura['numescritura']!=''){

		if($numeroEscritura['numescritura'] == $numescritura && $numeroEscritura['idtipkar'] == $idtipkar && $numeroEscritura['anio_escritura'] == $tiempo[2]){
	
			echo '<p style="color:red">*ERROR: NUMERO DE ESCRITURA DUPLICADA EN EL '.$numeroEscritura['kardex'].'<br>UTILIZADO POR: '.$numeroEscritura['usuario'].'</p>';
			return false;
		}
	}
}

$sql="UPDATE kardex SET folioini='$folioini',foliofin='$foliofin', papelini='$papelini', papelfin='$papelfin', numminuta='$numminuta', numescritura='$numescritura', fechaescritura='$fechaes', txa_minuta='$tomo', numinstrmento='$registro' ,fechaminuta='$fin_fechaminuta',fecha_modificacion = '$fecha_modificacion', papelTrasladoIni = '$papelTrasladoIni', papelTrasladoFin = '$papelTrasladoFin', estado_sisgen= '0' WHERE kardex='$codkardex' "; 
//die($sql);

mysql_query($sql,$conn) or die(mysql_error());

echo "<p style='color:green'>Grabado satisfactoriamente</p> ";
?>