<?php
include('../../conexion.php');

$id_viaje    = $_POST["id_viaje"]; 

$num_kardex  = $_POST["num_kardex"];
$asunto      = $_POST["asunto"];
$fec_ingreso = $_POST["fec_ingreso"];
$nom_recep 	 = $_POST["nom_recep"];
$hora_recep  = $_POST["hora_recep"];
$referencia  = $_POST["referencia"];
$nom_comu    = $_POST["nom_comu"];
$tel_comu    = $_POST["tel_comu"];
$email_comu  = $_POST["email_comu"];
$documento   = $_POST["documento"];

$num_crono   = $_POST["num_crono"];
$fecha_crono = $_POST["fecha_crono"];
$num_formu   = $_POST["num_formu"];
$lugar_formu = $_POST["lugar_formu"];
$observacion = $_POST["observacion"];

//verifica la existencia del cronologico, si no edita

if($id_viaje=='')
{
//guarda el cronologico.
$busnumkardex = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(permi_viaje.num_kardex,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(permi_viaje.num_kardex,6) AS DECIMAL))+1)) AS numkardex FROM permi_viaje WHERE swt_est = '' ";

$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum[0];

	if($newnumkar == '')
	{
		$new_num_kar = date('Y').'000001';
	}
	else if($newnumkar != '')
	{
		$new_num_kar = $newnumkar;
	}
/*echo "<input name='codkardex' id='codkardex' readonly='readonly' type='hidden' value='".$new_num_kar."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>";*/

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_kar;
$numkar2 = $new_num_kar;

/*echo "<input name='muestraCodkar' id='muestraCodkar' readonly='readonly' type='hidden' value='".$numkar2."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>";*/

$grabapermiviaje = "INSERT INTO permi_viaje(id_viaje, num_kardex, asunto, fec_ingreso, nom_recep, hora_recep,referencia, nom_comu, tel_comu, email_comu, documento,
num_crono, fecha_crono, num_formu, lugar_formu, observacion)
VALUES( NULL, '','$asunto',STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), '$nom_recep', '$hora_recep', '$referencia', '$nom_comu', '$tel_comu', '$email_comu', '$documento', 
'$num_crono', STR_TO_DATE('$fecha_crono','%d/%m/%Y') , '$num_formu', '$lugar_formu', '$observacion')";
$resulconsulta =  mysql_query($grabapermiviaje,$conn) or die(mysql_error());

//$row = mysql_fetch_array($consulpartici);

/*$busidviaje = "SELECT permi_viaje.id_viaje FROM permi_viaje WHERE permi_viaje.num_kardex = '$new_num_kar'";
$resulviaje =  mysql_query($busidviaje,$conn) or die(mysql_error());
$rowviaje   = mysql_fetch_array($resulviaje);*/

$creaidviaje = "SELECT MAX(permi_viaje.id_viaje) FROM permi_viaje";
$resulcreaidviaje = mysql_query($creaidviaje,$conn) or die(mysql_error());
$rowcreaidviaje   = mysql_fetch_array($resulcreaidviaje);

echo "<input name='id_viaje' id='id_viaje' type='text' value='".$rowcreaidviaje[0]."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8' readonly='readonly'>";
}


########################################################################################################################################################################
########################################################################################################################################################################


else if($id_viaje != '')
{
	$updatepermiviaje="UPDATE permi_viaje SET  asunto = '$asunto', fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), nom_recep = '$nom_recep', 
	hora_recep = '$hora_recep', referencia = '$referencia', nom_comu = '$nom_comu', tel_comu = '$tel_comu', email_comu = '$email_comu', documento = '$documento',
	num_crono = '$num_crono',  lugar_formu = '$lugar_formu', observacion = '$observacion'
	WHERE permi_viaje.id_viaje = '$id_viaje'";
	
/*	echo "<input name='codkardex' id='codkardex' readonly='readonly' type='hidden' value='".$num_kardex."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' 																																																										size='8'>"; */
	// Muestra el ID en la forma:  000001-2013

/*
	$numkarE = $num_kardex;
	$numkar3 = substr($numkarE,4,6).'-'.substr($numkarE,0,4);
	echo "<input name='muestraCodkar' id='muestraCodkar' readonly='readonly' type='hidden' value='".$numkar3."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>"; 

*/

	
	/*$busid = "SELECT permi_viaje.id_viaje FROM permi_viaje WHERE permi_viaje.num_kardex = '$num_kardex'";
	$resulviaje2 =  mysql_query($busid,$conn) or die(mysql_error());
	$rowviaje2   = mysql_fetch_array($resulviaje2);*/
	
	echo "<input name='id_viaje' id='id_viaje' type='text' value='".$id_viaje."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8' readonly='readonly'>";
	
	mysql_query($updatepermiviaje,$conn) or die(mysql_error());
}


mysql_close($conn);

?>

