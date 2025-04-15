<?php
include('conexion.php');
	$id_prote       = $_POST['id_prote'];
	$num_prote  	= $_POST['num_prote'];
	$num_prote  	= $_POST['num_prote'];
	$solicitante 	= $_POST['solicitante'];
	$nom_recep      = $_POST['nom_recep'];
	$hora_recep		= $_POST['hora_recep'];
	$cod_tipop		= $_POST['cod_tipop'];
	$fec_ingreso	= $_POST['fec_ingreso'];
	$numero		 	= $_POST['numero'];
	$lugarg			= $_POST['lugarg'];
	$referenciap	= $_POST['referenciap'];
	$fecgiro	 	= $_POST['fecgiro'];
	$fecvence		= $_POST['fecvence'];
	$idmon			= $_POST['idmon'];
	$importe		= $_POST['importe'];
	$diligencia		= $_POST['diligencia'];
	$fecnoti		= $_POST['fecnoti'];
	$fecconst		= $_POST['fecconst'];
	$text_check  	= intval($_POST['text_check']);
	$dato = explode("/", $fec_ingreso); 

$anio=$dato[2];

//verifica la existencia del cronologico, si no edita
if($id_prote=='')
{
$busnumkardex = "SELECT (CASE WHEN (IFNULL(REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(protesto.id_protesto,6) AS DECIMAL))+1))),''))='' THEN 
(REPEAT('0',6-LENGTH(((CAST(RIGHT('1',6) AS DECIMAL)))))) ELSE 
(REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(protesto.id_protesto,6) AS DECIMAL))+1)))) END ) AS c_cero,

(CASE WHEN  IFNULL((MAX(CAST(RIGHT(protesto.id_protesto,6) AS DECIMAL))+1),'')='' THEN ((CAST(RIGHT('1',6) AS DECIMAL)))
 ELSE (MAX(CAST(RIGHT(protesto.id_protesto,6) AS DECIMAL))+1) END ) AS numkar,num_protesto FROM protesto
WHERE anio=YEAR(STR_TO_DATE('".$fec_ingreso."','%d/%m/%Y'))";



$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum['num_protesto'];
$c_cero=$rownum['c_cero'];
$id_protesto=$rownum['numkar'];


$num_protesto = $anio.$c_cero.$id_protesto;


$grabapermiviaje = "
INSERT INTO protesto(id_protesto,num_protesto,solicitante,fec_ingreso,tipo,lugar_giro,numero,doc_referencia,fec_giro,
fec_venc,moneda,importe,diligencia,fec_notificacion,fec_constancia,camara,anio)
VALUES('$id_protesto','$num_protesto','$solicitante',STR_TO_DATE('$fec_ingreso','%d/%m/%Y'),'$cod_tipop','$lugarg','$numero','$referenciap',STR_TO_DATE('$fecgiro','%d/%m/%Y'),STR_TO_DATE('$fecvence','%d/%m/%Y'),
'$idmon','$importe','$diligencia',STR_TO_DATE('$fecnoti','%d/%m/%Y'),STR_TO_DATE('$fecconst','%d/%m/%Y'),'$text_check','$anio')";

$resulconsulta =  mysql_query($grabapermiviaje,$conn) or die(mysql_error());


echo "<input name='id_prote' id='id_prote' type='text' value='".$rownum['numkar']."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

}
## edicion
else if($id_prote != '' )
{
$updatepoderes = "UPDATE protesto 
SET solicitante = '$solicitante', fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y') , tipo = '$cod_tipop' , lugar_giro = '$lugarg' , numero = '$numero' , doc_referencia ='$referenciap' ,
fec_giro = STR_TO_DATE('$fecgiro','%d/%m/%Y') , fec_venc = STR_TO_DATE('$fecvence','%d/%m/%Y') , moneda = '$idmon' , importe = '$importe' , diligencia = '$diligencia' ,
fec_notificacion = STR_TO_DATE('$fecnoti','%d/%m/%Y') , fec_constancia =  STR_TO_DATE('$fecconst','%d/%m/%Y') , camara = '$text_check' WHERE id_protesto = '$id_prote' and anio='$anio'";

	
	echo "<input name='id_prote' id='id_prote' type='text' value='".$id_prote."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

mysql_query($updatepoderes, $conn) or die(mysql_error());	
}



mysql_close($conn);
?>


