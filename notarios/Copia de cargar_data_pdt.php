<?php
include("conexion.php");

$fechade=$_POST['fecha_de'];;
$fechaha=$_POST['fecha_ha'];


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sqlkardex = 'SELECT DISTINCT kardex.codactos, kardex.idkardex, kardex.kardex, kardex.idtipkar, kardex.numescritura, kardex.fechaescritura, kardex.fechaconclusion FROM kardex 
WHERE kardex.idtipkar="1" AND STR_TO_DATE(kardex.fechaconclusion,"%d/%m/%Y") BETWEEN STR_TO_DATE("'.$fechade.'","%d/%m/%Y") AND STR_TO_DATE("'.$fechaha.'","%d/%m/%Y")
ORDER BY kardex.kardex ASC';

$result=mysql_query($sqlkardex,$conn);
while($row = mysql_fetch_array($result)) {

    $kardex=$row['kardex']; $codactos=$row['codactos']; $numescri=$row['numescritura']; $fechaescritura=$row['fechaescritura']; $fechaconclusion=$row['fechaconclusion'];
	$tipkar=$row['idtipkar'];
	
	$acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
    $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto' and actosunat <> '' AND (actosunat = '01' OR actosunat = '02' OR actosunat = '03' 
								OR actosunat = '04' OR actosunat = '06' OR actosunat = '07' OR actosunat = '08'
								OR actosunat = '09' OR actosunat = '10' OR actosunat = '11' OR actosunat = '12' OR actosunat = '13'
								OR actosunat = '14' OR actosunat = '15' OR actosunat = '16' OR actosunat = '17' OR actosunat = '18'
								OR actosunat = '19' OR actosunat = '20' OR actosunat = '21' OR actosunat = '22' OR actosunat = '23'
								OR actosunat = '024' OR actosunat = '025' OR actosunat = '026')", $conn) or die(mysql_error());
		$row2=mysql_fetch_array($consulta);
		if(!empty($row2)){
		        $idtipoacto=$row2['idtipoacto']; $actosunat=$row2['actosunat'];
				$sql2="INSERT INTO kardex_ro(idkardex, kardex, idtipkar, codactos, uif, numescritura, fechaescritura, fechaconclusion) 
				       VALUES (NULL,'$kardex','$tipkar','$idtipoacto','$actosunat','$numescri','$fechaescritura','$fechaconclusion')";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		$i++;
		}

}
echo "Data cargada satisfactoriamente..!!";
mysql_free_result($result);
mysql_close($conn);  
?>