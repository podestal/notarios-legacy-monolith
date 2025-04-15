<?php
include('conexion.php');
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano=date('Y');

$archivo = "3520".$ano.$rowarchi['ruc'].".Mpa";
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($archivo));
 
include($archivo);



$sql = "SELECT * FROM temp_act";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {
	
	$sqldetalle="select * from detallemediopago where itemmp='".$row['itemmp']."' and codmepag <> '95' and codmepag <> '96' and codmepag <> '98' and codmepag <> '15' and codmepag <> '16'";
	$resultdet=mysql_query($sqldetalle,$conn);
	while($rowdet = mysql_fetch_array($resultdet)) {
		
     if($rowdet["tipacto"]=='028' || $rowdet["tipacto"]=='029' || $rowdet["tipacto"]=='105' || $rowdet["tipacto"]=='030' || $rowdet["tipacto"]=='107' || $rowdet["tipacto"]=='108' || $rowdet["tipacto"]=='110' || $rowdet["tipacto"]=='111' || $rowdet["tipacto"]=='112' || $rowdet["tipacto"]=='113' || $rowdet["tipacto"]=='094' || $rowdet["tipacto"]=='106' || $rowdet["tipacto"]=='068' || $rowdet["tipacto"]=='061' || $rowdet["tipacto"]=='064' || $rowdet["tipacto"]=='041'){
        $sql2="select * from mediospago where codmepag='".$rowdet['codmepag']."'"; 
		$result2=mysql_query($sql2,$conn); 
		$row2 = mysql_fetch_array($result2);
		
		//if($row2['codmepag']!='15' || $row2['codmepag']!='16' || $row2['codmepag']!='95' || $row2['codmepag']!='96' || $row2['codmepag']!='98' ){
		$money=$rowdet['idmon'];
		switch ($money) {
		case "1":
		$moneda="2";
		$importe=$rowdet["importemp"];
		break;
		case "2":
		$moneda="1";	
		$importe=$rowdet["importemp"];
		break;					
	     }

		$sqlb="select * from bancos where idbancos='".$rowdet['idbancos']."'"; 
		$resultb=mysql_query($sqlb,$conn); 
		$rowb = mysql_fetch_array($resultb);	
		$tipokardexx='5';
		$tipokardex=$row["idtipkar"]; $numeroescritura=$row["numescritura"]; $secuacto=$row["secuencialacto"];   
		$codpag=$row2["sunat"]; $fechapago=$rowdet["foperacion"]; $numdocumento=$rowdet["documentos"]; $banco=$rowb['codbancos'];
		
		
		echo str_pad(substr(intval($tipokardexx),0,1),1," ",STR_PAD_LEFT)."|".str_pad(substr(intval($numeroescritura),0,5),5," ",STR_PAD_LEFT)."|".str_pad(substr($secuacto,0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($codpag,0,3),3," ",STR_PAD_RIGHT)."|".str_pad(substr($moneda,0,1),1," ",STR_PAD_RIGHT)."|".str_pad(substr($importe,0,15),15," ",STR_PAD_RIGHT)."|".str_pad(substr($fechapago,0,10),10," ",STR_PAD_RIGHT)."|".str_pad(substr($numdocumento,0,25),25," ",STR_PAD_RIGHT)."|".str_pad(substr($banco,0,2),2," ",STR_PAD_RIGHT)."|".chr(13).chr(10);
		   
	/*	mysql_query("INSERT INTO temp_mpa(idmpa, idtipkar, numescritura, secuencialacto, sunat, idmon, importemp, foperacion, documentos, codbancos) VALUES (NULL,'".$tipokardex."','".$numeroescritura."','".$secuacto."','".$codpag."','".$moneda."','".$importe."','".$fechapago."','".$numdocumento."','".$banco."')",$conn); */
         }
	  
	 }
}
mysql_free_result($result);
mysql_close($conn);
?>