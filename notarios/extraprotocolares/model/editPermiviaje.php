<?php
include('../../conexion.php');

$id_viaje  = $_POST["id_viaje"];
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

$num_crono = $_POST["num_crono"];
$fecha_crono = $_POST["fecha_crono"];
$num_formu = $_POST["num_formu"];
$lugar_formu = $_POST["lugar_formu"];
$observacion = $_POST["observacion"];
$via = $_POST["via"];
$fecha_desde = $_POST["fecha_desde"];
$fecha_hasta = $_POST["fecha_hasta"];

$updatepermiviaje="UPDATE permi_viaje SET  
                        asunto = '$asunto', 
                        fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), 
                        nom_recep = '$nom_recep', 
                        hora_recep = '$hora_recep', 
                        referencia = '$referencia', 
                        nom_comu = '$nom_comu', 
                        tel_comu = '$tel_comu', 
                        email_comu = '$email_comu', 
                        documento = '$documento',
                        num_crono = '$num_crono',
                        lugar_formu = '$lugar_formu', 
                        observacion = '$observacion',
                        via='$via',
                        fecha_desde='$fecha_desde',
                        fecha_hasta='$fecha_hasta'
                    WHERE permi_viaje.id_viaje = '$id_viaje'";

mysql_query($updatepermiviaje,$conn) or die(mysql_error());
mysql_close($conn);
?>

