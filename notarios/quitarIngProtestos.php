<?php
include('conexion.php');

$fecha_ini    = $_POST["fecha_ini"];
$fecha_hasta    = $_POST["fecha_hasta"];
$text_check	  = $_POST["text_check"];

if($text_check == '1'){
// NUM_KARDEX AUTOGENERADO:
$filas = "SELECT protesto.id_protesto FROM protesto WHERE fec_constancia >= DATE_FORMAT(STR_TO_DATE('$fecha_ini','%d/%m/%Y'),'%Y-%m-%d')
 AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$fecha_hasta','%d/%m/%Y'),'%Y-%m-%d')";
 $numfilas = mysql_query($filas, $conn) or die(mysql_error());
 //$rowcondi = mysql_num_rows($numfilas);
 //$rowprotesto = mysql_fetch_array($filas);	
}else if($text_check == '2'){
	$filas = "SELECT protesto.id_protesto FROM protesto WHERE fec_notificacion >= DATE_FORMAT(STR_TO_DATE('$fecha_ini','%d/%m/%Y'),'%Y-%m-%d')
 AND fec_notificacion <= DATE_FORMAT(STR_TO_DATE('$fecha_hasta','%d/%m/%Y'),'%Y-%m-%d')";
 $numfilas = mysql_query($filas, $conn) or die(mysql_error());}
else if($text_check == '3'){
	$filas = "SELECT protesto.id_protesto FROM protesto WHERE fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$fecha_ini','%d/%m/%Y'),'%Y-%m-%d')
 AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$fecha_hasta','%d/%m/%Y'),'%Y-%m-%d')";
 $numfilas = mysql_query($filas, $conn) or die(mysql_error());}






while($rowprotesto = mysql_fetch_array($numfilas)){
	//$i=0;
	//$rowprotesto = mysql_fetch_array($filas);
	//echo $rowprotesto['id_protesto'];
	$id_protesto = $rowprotesto['id_protesto'];
	//while($i < $rowcondi){
	$busnumkardex = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(protesto.num_protesto,6) AS DECIMAL))+1))),
	(MAX(CAST(RIGHT(protesto.num_protesto,6) AS DECIMAL))+1)) AS numkar FROM protesto";
	$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
	$rownum = mysql_fetch_array($numkarbus);
	$newnumkar  = $rownum[0];
	//echo $i."-".$id_protesto;
	
	//$id_protesto = $id_protesto1;
	if($newnumkar == '')
		{
		$new_num_kar = '2013000001';
		}
	else 
		{
		$new_num_kar = $newnumkar;
	    }
			
	$updatepoderes = "UPDATE protesto SET num_protesto = '' 
	WHERE id_protesto = '".$id_protesto."'";
	mysql_query($updatepoderes, $conn) or die(mysql_error());
		//$i++;
//	}
// Muestra el ID en la forma:  000001-2013
/*$numkar = $new_num_kar;
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo "<input name='num_crono' id='num_crono' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";*/

}



?>