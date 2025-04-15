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
	$dato20=str_replace(","," ",$dato19);
	$dato21=str_replace("."," ",$dato20);
	$dato22=str_replace("-"," ",$dato21);
	$dato23=str_replace("NÂº"," ",$dato22);
	$dato24=str_replace("Âº"," ",$dato23);
	$dato25=str_replace("`"," ",$dato24);
	$dato26=str_replace('"'," ",$dato25);
	$dato27=str_replace("´"," ",$dato26);
    $resultado=str_replace("QQ22KK"," ",$dato27); 
    return $resultado;	
}
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano=date('Y');
$archivo = "3520".$ano.$rowarchi['ruc'].".lib";
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($archivo));
 
include($archivo);
$fechade=$_POST['desde'];
$fechaha=$_POST['hasta'];
$sql = "SELECT * FROM libros where fecing BETWEEN str_to_date('$fechade','%d/%m/%Y') AND str_to_date('$fechaha','%d/%m/%Y') AND (idnlibro <> '0' And idtiplib <>'99')";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {

echo str_pad(substr($row["numlibro"],0,10),10," ",STR_PAD_LEFT)."|"; $fecha=explode('-',$row["fecing"]); $fecha2 = $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0]; echo $fecha2;echo "|".str_pad(substr(intval($row["idtiplib"]),0,2),2," ",STR_PAD_LEFT)."|".str_pad(substr(intval($row["folio"]),0,10),10," ",STR_PAD_LEFT)."|"; if ($row["tipper"]=="N"){echo "1";}else{echo "2";} echo "|".str_pad(substr($row["ruc"],0,11),11," ",STR_PAD_RIGHT)."|".str_pad(strtoupper (substr(quitar_sim($row["apepat"]),0,15)),15," ",STR_PAD_RIGHT)."|".str_pad(strtoupper (substr(quitar_sim($row["apemat"]),0,15)),15," ",STR_PAD_RIGHT)."|".str_pad(strtoupper (substr(quitar_sim($row["prinom"]),0,15)),15," ",STR_PAD_RIGHT)."|".str_pad(strtoupper (substr(quitar_sim($row["segnom"]),0,30)),30," ",STR_PAD_RIGHT)."|".str_pad(strtoupper (substr(quitar_sim($row["empresa"]),0,40)),40," ",STR_PAD_RIGHT)."|".chr(13).chr(10);
}
mysql_free_result($result);
mysql_close($conn);  //Cierras la Conexión
?>
