<?php
include('../../conexion.php');

$id_poder    = $_POST["id_poder"];

$num_kardex    = $_POST["num_kardex"];
$nom_recep	   = $_POST["nom_recep"];
$hora_recep    = $_POST["hora_recep"];
$id_asunto     = $_POST["id_asunto"];
$fec_ingreso   = $_POST["fec_ingreso"];
$referencia    = $_POST["referencia"];
$nom_comuni    = $_POST["nom_comuni"];
$telf_comuni   = $_POST["telf_comuni"];
$email_comuni  = $_POST["email_comuni"];
$documento     = $_POST["documento"];
$id_respon     = $_POST["id_respon"];
$des_respon    = $_POST["des_respon"];
$doc_presen    = $_POST["doc_presen"];
$fec_ofre      = $_POST["fec_ofre"];
$hora_ofre     = $_POST["hora_ofre"];

$num_formu     = $_POST["num_formu"];


//verifica la existencia del cronologico, si no edita

if($id_poder=='')
{

// NUM_KARDEX AUTOGENERADO:

$busnumkardex = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(ingreso_poderes.num_kardex,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(ingreso_poderes.num_kardex,6) AS DECIMAL))+1)) AS numkar FROM ingreso_poderes";

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

##################
/*echo "<input name='num_kardex' id='num_kardex' readonly='readonly' type='hidden' value='".$new_num_kar."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>"; */

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_kar;
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

/*echo "<input name='muestraCodkar' id='muestraCodkar' readonly='readonly' type='hidden' value='".$numkar2."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>"; */
##################

$grabapermiviaje = "INSERT INTO ingreso_poderes(id_poder, num_kardex, nom_recep, hora_recep, id_asunto, fec_ingreso, referencia, nom_comuni,
								telf_comuni, email_comuni, documento, id_respon, des_respon, doc_presen, fec_ofre, hora_ofre)
					VALUES(NULL, '', '$nom_recep', '$hora_recep', '$id_asunto', STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), '$referencia', '$nom_comuni',
						  '$telf_comuni', '$email_comuni', '$documento', '$id_respon', '$des_respon', '$doc_presen', '$fec_ofre', '$hora_ofre')";
$resulconsulta =  mysql_query($grabapermiviaje,$conn) or die(mysql_error());
//$row = mysql_fetch_array($consulpartici);

/* $busidviaje = "SELECT ingreso_poderes.id_poder FROM ingreso_poderes WHERE ingreso_poderes.num_kardex = '$new_num_kar'";
$resulviaje =  mysql_query($busidviaje,$conn) or die(mysql_error());
$rowviaje   = mysql_fetch_array($resulviaje); */

$creaidpoder      = "SELECT MAX(ingreso_poderes.id_poder) FROM ingreso_poderes";
$resulcreaidpoder = mysql_query($creaidpoder,$conn) or die(mysql_error());
$rowcreaidpoder   = mysql_fetch_array($resulcreaidpoder);

echo "<input name='id_poder' id='id_poder' type='text' value='".$rowcreaidpoder[0]."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

}


########################################################################################################################################################################
########################################################################################################################################################################

## edicion
else if($id_poder != '')
{
$updatepoderes = "UPDATE ingreso_poderes SET  nom_recep = '$nom_recep', hora_recep = '$hora_recep', id_asunto = '$id_asunto', fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), referencia = '$referencia', nom_comuni = '$nom_comuni', telf_comuni = '$telf_comuni', email_comuni = '$email_comuni', documento = '$documento', id_respon = '$id_respon', des_respon = '$des_respon', doc_presen = '$doc_presen', fec_ofre = '$fec_ofre', hora_ofre = '$hora_ofre' WHERE id_poder = '$id_poder'";

##################
/*echo "<input name='num_kardex' id='num_kardex' readonly='readonly' type='hidden' value='".$num_kardex."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>";*/

// Muestra el ID en la forma:  000001-2013
$numkarE = $num_kardex;
$numkar3 = substr($numkarE,5,6).'-'.substr($numkarE,0,4);

/*echo "<input name='muestraCodkar' id='muestraCodkar' readonly='readonly' type='text' value='".$numkar3."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>";*/
##################

	/*$busidp = "SELECT ingreso_poderes.id_poder FROM ingreso_poderes WHERE ingreso_poderes.num_kardex = '$num_kardex'";
	$resulviaje3 =  mysql_query($busidp,$conn) or die(mysql_error());
	$rowviaje3   = mysql_fetch_array($resulviaje3);*/
	
	echo "<input name='id_poder' id='id_poder' type='text' value='".$id_poder."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

mysql_query($updatepoderes, $conn) or die(mysql_error());	
}

mysql_close($conn);
?>


