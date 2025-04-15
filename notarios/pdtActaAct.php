<?php
include('conexion.php');
function quitar_sim($dato){
	$dato1=str_replace("?"," ",$dato);
    $dato2=str_replace("*"," ",$dato1);
    $dato3=str_replace("QQ11QQ"," ",$dato2);
	$dato4=str_replace("Ñ"," ",$dato3);
	$dato5=str_replace("ñ"," ",$dato4);
	$dato6=str_replace("°"," ",$dato5);
	$dato7=str_replace("#"," ",$dato6);
	$dato8=str_replace("é"," ",$dato7);
	$dato9=str_replace("á"," ",$dato8);
	$dato10=str_replace("í"," ",$dato9);
	$dato11=str_replace("ó"," ",$dato10);
	$dato12=str_replace("ú"," ",$dato11);
	$dato13=str_replace("'"," ",$dato12);
	$dato14=str_replace("&"," ",$dato13);
	$dato15=str_replace("É"," ",$dato14);
	$dato16=str_replace("Á"," ",$dato15);
	$dato17=str_replace("Ó"," ",$dato16);
	$dato18=str_replace("Ú"," ",$dato17);
	$dato19=str_replace("Í"," ",$dato18);
	$dato20=str_replace("`"," ",$dato19);
	$dato21=str_replace("Ã‘","N",$dato20);

    $resultado=str_replace("QQ22KK"," ",$dato21); 
    return $resultado;	
}

$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano="2014";

$archivo = "3520".$ano.$rowarchi['ruc'].".Act";
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($archivo));
 
include($archivo);
$vacio="";
$secu=0;
$euros="3";

$sql = "SELECT * FROM kardex_ro INNER JOIN patrimonial WHERE kardex_ro.kardex=patrimonial.kardex AND kardex_ro.codactos=patrimonial.idtipoacto ORDER BY kardex_ro.kardex ASC";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {
$secu= $secu+1;
//aqui estoy consultando la descripcion del acto 
$sql2="select desacto from tiposdeacto where idtipoacto='".$row['idtipoacto']."'"; 
$result2=mysql_query($sql2,$conn); 
$row2 = mysql_fetch_array($result2);

//moneda y tipo de transaccion
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
//aqui si exibio medio de pago siendo estos actos 
if($row["uif"]=='10' || $row["uif"]=='04' || $row["uif"]=='24' || $row["uif"]=='26'){
	if($row["exhibiomp"]=="SI"){ 
		$pago="1"; }
	else{
		$pago="0"; 
		}
}else{
	$pago="";
	}
//paraq fecha de minuta  
if($row["uif"]=='10' || $row["uif"]=='04' || $row["uif"]=='24' || $row["uif"]=='26'){
	
	  $fecha1 = explode ("/", $row["nminuta"]);
      $fec1=intval($fecha1[2].$fecha1[1].$fecha1[0]);
      $fecha2 = explode ("/", "01/01/2004");
      $fec2=intval($fecha2[2].$fecha2[1].$fecha2[0]);
	  if($fec1>=$fec2){
		 $fecminu=$row["nminuta"]; 
	  }else{$fecminu=""; }
	
	}else{$fecminu="";}	
	
$fecha=explode('-',$row["fechaescritura"]); 
$fecha2 = $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];	

$actosunat=$row2["actosunat"];
if($actosunat=='14'){
	$acto=$row2["desacto"];
}else{
	$acto="";
}

if($row["idtipkar"]=="3"){
	$tipokardex="2";
	}
	
$numkardex=$row["kardex"]; $numeroescritura=$row["numescritura"]; $fechaescri=$fecha2; $money=$moneda; $nada=$vacio; $fechaconclu=$row["fechaconclusion"];
$sunat=$row["uif"]; $mpago=$pago; $importes=$importe; $flag="T"; $tipoacto=$row['idtipoacto']; $itemmp=$row['itemmp'];

echo str_pad(substr(intval($tipokardex),0,1),1," ",STR_PAD_LEFT)."|".str_pad(substr(intval($numeroescritura),0,5),5," ",STR_PAD_LEFT)."|".str_pad(substr($fechaescri,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($fechaconclu,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($nada,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($sunat,0,2),2," ",STR_PAD_LEFT)."|".str_pad(substr($secu,0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($money,0,1),1," ",STR_PAD_RIGHT)."|".str_pad(substr($importes,0,15),15," ",STR_PAD_RIGHT)."|".str_pad(substr($nada,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($nada,0,11),11," ",STR_PAD_LEFT)."|".str_pad(substr(quitar_sim($acto),0,30),30," ",STR_PAD_RIGHT)."|".str_pad(substr($fecminu,0,10),10," ",STR_PAD_LEFT)."|".str_pad(substr($pago,0,1),1," ",STR_PAD_LEFT)."|".chr(13).chr(10);

mysql_query("INSERT INTO temp_act(idact, kardex, itemmp, idtipkar, numescritura, fechaescritura, fechaconclusion, fechalegal, actosunat, tipoacto, secuencialacto, idmon, importetransac, plazoini, plazofin, desacto, mminuta, exhibiomp, temp) VALUES (NULL,'".$numkardex."','".$itemmp."','".$tipokardex."','".$numeroescritura."','".$fechaescri."','".$fechaconclu."','".$nada."','".$sunat."','".$tipoacto."','".$secu."','".$money."','".$importes."','".$nada."','".$nada."','".$acto."','".$fecminu."','".$mpago."','".$flag."')",$conn); 
}

mysql_free_result($result);
mysql_close($conn);  

?>