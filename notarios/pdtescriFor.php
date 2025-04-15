<?php
include('conexion.php');
function quitar_sim($dato){
	$dato1=str_replace("?"," ",$dato);
    $dato2=str_replace("*"," ",$dato1);
    $dato3=str_replace("QQ11QQ"," ",$dato2);
	$dato4=str_replace("Ñ","N",$dato3);
	$dato5=str_replace("ñ","n",$dato4);
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
    $resultado=str_replace("QQ22KK"," ",$dato19); 
    return $resultado;	
}
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano=date('Y');

$archivo = "3520".$ano.$rowarchi['ruc'].".For";
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($archivo));
 
include($archivo);

$sql = "SELECT * FROM temp_otg";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {
	
	    	if ($row["idtipkar"]==1){
				$tipokardex= '1';			
			}else{
				if ($row["idtipkar"]==3){
					$tipokardex= '2';				
				}else{
					$tipokardex= $row["idtipkar"];
					}
				} 
		
		 $numeroescritura=$row["numescritura"]; $secuacto=$row["secuencialacto"];  
		 $secuoto=$row["secuencialoto"];  $tipootorgante=$row["tipootorgante"];  $idrenta=$row['idrenta'];
		// tipo de otorgante 
		if($idrenta!=''){
		$sqlformu="select * from formulario where idrenta='".$idrenta."'";
	    $resulformu=mysql_query($sqlformu,$conn);
		$rowformu= mysql_fetch_array($resulformu);
		$numformu=$rowformu['numformu'];
		$pagoformu=$rowformu['monto'];
		
		
echo str_pad(substr(intval($tipokardex),0,1),1," ",STR_PAD_LEFT)."|".str_pad(substr(intval($numeroescritura),0,5),5," ",STR_PAD_LEFT)."|".str_pad(substr($secuacto,0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($secuoto,0,5),5," ",STR_PAD_RIGHT)."|".str_pad(substr($tipootorgante,0,2),2," ",STR_PAD_RIGHT)."|".str_pad(substr($numformu,0,10),10," ",STR_PAD_RIGHT)."|".str_pad(substr($pagoformu,0,15),15," ",STR_PAD_RIGHT)."|".chr(13).chr(10);
		}
}
mysql_free_result($result);
mysql_close($conn);

?>