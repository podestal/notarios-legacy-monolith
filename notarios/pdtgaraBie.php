<?php
include('conexion.php');
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano=date('Y');

$archivo = "3520".$ano.$rowarchi['ruc'].".Bie";
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($archivo));
 
$secuencial=0;
$nittem="";

$sql = "SELECT * FROM temp_act";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {
	
	$sqldetalle="select * from detallebienes where itemmp='".$row['itemmp']."'";
	$resultdet=mysql_query($sqldetalle,$conn);
	$valor=mysql_num_rows($resultdet);
    $cantidad=intval($valor);
	while($rowdet = mysql_fetch_array($resultdet)) {
     
     $sql2="select * from tipobien where idtipbien='".$rowdet['idtipbien']."'"; 
		$result2=mysql_query($sql2,$conn); 
		$row2 = mysql_fetch_array($result2);
		/*
		$ittem=$rowdet['itemmp'];
		
		if($ittem!=$nittem){
			$nittem=$ittem;
			$secuencial=0;
			}
		if($cantidad==1 ){ 
		 $secuencial=1; 
		}
		if($cantidad>1 ){ 
			if($rowdet['itemmp']==$nittem){*/
			$secuencial=$secuencial+1; 
			//}
		//}
		
		if ($rowdet['tipob']=="BIENES"){
			$tipobien="B";
			}else{
			$tipobien="A";	
			}
		
		$opciones=$rowdet['tpsm'];
		switch ($opciones) {
		case "P":
		$opcion="1";
		break;
		case "S":
		$opcion="2";	
		break;
		case "M":
		$opcion="3";
		break;
		case "":
		$opcion="";	
		break;							
	     }

		
		$ubicas=$rowdet['coddis'];
		if($ubicas!=''){
			$ubica=$rowdet['coddis'];
			}else{$ubica='';}
		
		if($ubica!=""){
		$codibien=$row2["codbien"];
		if($codibien=='04' || $codibien=='99'){
			$origenbien="1"; 
		}else{
			  $origenbien="";
			}
		}else{
			 $origenbien="";
			}
		$tipokardexx='5';
			
		$numero=$rowdet['npsm']; $kardex=$row["kardex"];
		$tipokardex=$row["idtipkar"]; $numeroescritura=$row["numescritura"]; $fechaescri=$row["fechaescritura"]; $secuacto=$row["secuencialacto"];  
		$codbien=$row2["codbien"]; $numserie=$rowdet['smaquiequipo'];  $fechacons=$rowdet['fechaconst']; $descrip=$rowdet['oespecific']; $tempo="T";
		
		
		echo str_pad(substr(intval($tipokardexx),0,1),1," ",STR_PAD_RIGHT)."|".str_pad(substr(intval($numeroescritura),0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($fechaescri,0,10),10," ",STR_PAD_RIGHT)."|".str_pad(substr($secuacto,0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($secuencial,0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($tipobien,0,1),1," ",STR_PAD_RIGHT)."|".str_pad(substr($codbien,0,2),2," ",STR_PAD_RIGHT)."|".str_pad(substr($opcion,0,1),1," ",STR_PAD_RIGHT)."|".str_pad(substr($numero,0,20),20," ",STR_PAD_RIGHT)."|".str_pad(substr($numserie,0,20),20," ",STR_PAD_RIGHT)."|".str_pad(substr($origenbien,0,1),1," ",STR_PAD_RIGHT)."|".str_pad(substr($ubica,0,6),6," ",STR_PAD_RIGHT)."|".str_pad(substr($fechacons,0,10),10," ",STR_PAD_RIGHT)."|".str_pad(substr($descrip,0,30),30," ",STR_PAD_RIGHT)."|".chr(13).chr(10);
		
	 mysql_query("INSERT INTO temp_bie(idbie, kardex, idtipkar, numescritura, fechaescrituracion, secuacto, secubien, tipobien, codbien, nopcion, npsm, numserie, oriegenbien, ubibien, fechaadd, descrip, flag) 
	 VALUES (NULL,'".$kardex."','".$tipokardex."','".$numeroescritura."','".$fechaescri."','".$secuacto."','".$secuencial."','".$tipobien."','".$codbien."','".$opcion."','".$numero."','".$numserie."','".$origenbien."','".$ubica."','".$fechacons."','".$descrip."','".$tempo."')",$conn); 
	 
	 
      }

}
mysql_free_result($result);
mysql_close($conn);
?>