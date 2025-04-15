<?php
include('conexion.php');
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
//$anio=$_GET['anio'];
$ano=date('Y');

$archivo = "3520".$ano.$rowarchi['ruc'].".Act";
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($archivo));
 
include($archivo);


$fechade=$_GET['desde'];
$fechaha=$_GET['hasta'];
$vacio="";
$nkardex="";
$secuencial=0;
$euros="3";

$sql = "SELECT * FROM kardex inner join patrimonial where kardex.kardex=patrimonial.kardex AND STR_TO_DATE(kardex.fechaconclusion,'%d/%m/%Y') >= STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE(kardex.fechaconclusion,'%d/%m/%Y') <= STR_TO_DATE('$fechaha','%d/%m/%Y') AND kardex.fechaconclusion <> '' AND kardex.idtipkar = '4' ORDER BY kardex.kardex ASC";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {

$sql2="select * from tiposdeacto where idtipoacto='".$row['idtipoacto']."'"; 
$result2=mysql_query($sql2,$conn); 
$row2 = mysql_fetch_array($result2);

$sql3="select * from patrimonial where kardex='".$row['kardex']."'";
$result3=mysql_query($sql3,$conn);
$valor=mysql_num_rows($result3);
$cantidad=intval($valor);

/*$kardex=$row['kardex'];

if($kardex!=$nkardex){
	$nkardex=$kardex;
	$secuencial=0;
	}

if($cantidad==1 ){ 
  $secuencial=1; 
}
if($cantidad>1 ){ 
	if($row['kardex']==$nkardex){
	$secuencial=$secuencial+1; 
	}
}
*/
$secuencial=$secuencial+1; 

if($row["idmon"]=="1"){
 $moneda="2"; $importe=$row["importetrans"]; 
 }

if($row["idmon"]=="2"){
 $moneda="1"; $importe=$row["importetrans"]; 
} 

if($row["idmon"]=="3"){ 
 $conver= floatval($row["importetrans"]) * floatval($row["tipocambio"]); 
 $moneda="1"; $importe=$conver; 
 }

if($row["idtipoacto"]=='028' || $row["idtipoacto"]=='029' || $row["idtipoacto"]=='105' || $row["idtipoacto"]=='030' || $row["idtipoacto"]=='107' || $row["idtipoacto"]=='108' || $row["idtipoacto"]=='110' || $row["idtipoacto"]=='111' || $row["idtipoacto"]=='112' || $row["idtipoacto"]=='113' || $row["idtipoacto"]=='094' || $row["idtipoacto"]=='106' || $row["idtipoacto"]=='068' || $row["idtipoacto"]=='061' || $row["idtipoacto"]=='064' || $row["idtipoacto"]=='041'){
	if($row["exhibiomp"]=="SI"){ 
		$pago="1"; }
	else{
		$pago="0"; 
		}
}else{
	$pago="";
	}
$fecha=explode('-',$row["fechaescritura"]); 
$fecha2 = $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];	

$actosunat=$row2["actosunat"];

if($actosunat=='14'){
	$acto=$row2["desacto"];
}else{
	$acto="";
}
$tipokardexx='5';

$tipokardex=$row["idtipkar"]; $numkardex=$row["kardex"]; $numeroescritura=$row["numescritura"]; $fechaescri=$fecha2; $money=$moneda; $nada=$vacio; $fechaconclu=$row["fechaconclusion"];
$sunat=$row2["actosunat"]; $secu=$secuencial;  $fecminu=$row["nminuta"]; $mpago=$pago; $importes=$importe; $flag="T"; $tipoacto=$row['idtipoacto']; $itemmp=$row['itemmp'];


echo str_pad(substr(intval($tipokardexx),0,1),1," ",STR_PAD_LEFT)."|".str_pad(substr(intval($numeroescritura),0,5),5," ",STR_PAD_LEFT)."|".str_pad(substr($nada,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($nada,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($fechaescri,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($sunat,0,2),2," ",STR_PAD_LEFT)."|".str_pad(substr($secu,0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($money,0,1),1," ",STR_PAD_RIGHT)."|".str_pad(substr($importes,0,15),15," ",STR_PAD_RIGHT)."|".str_pad(substr($nada,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($nada,0,11),11," ",STR_PAD_LEFT)."|".str_pad(substr($acto,0,30),30," ",STR_PAD_RIGHT)."|".str_pad(substr($nada,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($pago,0,1),1," ",STR_PAD_LEFT)."|".chr(13).chr(10);


mysql_query("INSERT INTO temp_act(idact, kardex, itemmp, idtipkar, numescritura, fechaescritura, fechaconclusion, fechalegal, actosunat, tipoacto, secuencialacto, idmon, importetransac, plazoini, plazofin, desacto, mminuta, exhibiomp, temp) VALUES (NULL,'".$numkardex."','".$itemmp."','".$tipokardex."','".$numeroescritura."','".$fechaescri."','".$fechaconclu."','".$nada."','".$sunat."','".$tipoacto."','".$secu."','".$money."','".$importes."','".$nada."','".$nada."','".$acto."','".$fecminu."','".$mpago."','".$flag."')",$conn); 
}

mysql_free_result($result);
mysql_close($conn);  

?>