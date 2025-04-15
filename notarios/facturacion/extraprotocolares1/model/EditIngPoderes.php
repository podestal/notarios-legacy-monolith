<?php
include('../../conexion.php');

$id_poder      = $_POST["id_poder"];
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


$updatepoderes = "UPDATE ingreso_poderes SET num_kardex = '$num_kardex', nom_recep = '$nom_recep', hora_recep = '$hora_recep', id_asunto = '$id_asunto', fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), referencia = '$referencia', nom_comuni = '$nom_comuni', telf_comuni = '$telf_comuni', email_comuni = '$email_comuni', documento = '$documento', id_respon = '$id_respon', des_respon = '$des_respon', doc_presen = '$doc_presen', fec_ofre = '$fec_ofre', hora_ofre = '$hora_ofre' WHERE id_poder = '$id_poder'";

mysql_query($updatepoderes, $conn) or die(mysql_error());
mysql_close($conn);
?>
