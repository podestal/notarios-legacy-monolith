<?php
include('conexion.php');
	
$id_prote     		 = $_POST["id_prote"];
$num_prote    		 = $_POST["num_prote"];
$solicitante 		 = $_POST["solicitante"];
$hora_recep		     = $_POST["hora_recep"];
$cod_tipop    		 = $_POST["cod_tipop"];
$id_asunto     		 = $_POST["fec_ingreso"];
$fec_ingreso   		 = $_POST["fec_ingreso"];
$numero   			 = $_POST["numero"];
$lugarg    			 = $_POST["lugarg"];
$referenciap 	     = $_POST["referenciap"];
$fecgiro 		     = $_POST["fecgiro"];
$fecvence   	     = $_POST["fecvence"];
$idmon     			 = $_POST["idmon"];
$importe    		 = $_POST["importe"];
$diligencia   	     = $_POST["diligencia"];
$fecnoti     		 = $_POST["fecnoti"];
$fecconst     		 = $_POST["fecconst"];
$text_check    		 = $_POST["text_check"];


$updatepoderes = "UPDATE protesto 
SET solicitante = '$solicitante' , fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y') , tipo = '$cod_tipop' , lugar_giro = '$lugarg' , numero = '$numero' , doc_referencia ='$referenciap' ,
fec_giro = STR_TO_DATE('$fecgiro','%d/%m/%Y') , fec_venc = STR_TO_DATE('$fecvence','%d/%m/%Y') , moneda = '$idmon' , importe = '$importe' , diligencia = '$diligencia' ,
fec_notificacion = STR_TO_DATE('$fecnoti','%d/%m/%Y') , fec_constancia =  STR_TO_DATE('$fecconst','%d/%m/%Y') , camara = '$text_check' WHERE id_protesto = '$id_prote'";


mysql_query($updatepoderes, $conn) or die(mysql_error());
mysql_close($conn);
?>
