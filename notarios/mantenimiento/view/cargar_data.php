<?php
include("../../conexion.php");

$fechade=$_POST['fec_desde'];
$fechaha=$_POST['fec_hasta'];
$mform=$_POST['m_form'];
if($mform=='true'){
$sqlkardex = 'SELECT DISTINCT kardex.codactos, kardex.idkardex, kardex.kardex, kardex.idtipkar, kardex.numescritura, kardex.fechaescritura, kardex.fechaconclusion FROM kardex 
WHERE kardex.idtipkar <>"2" ANd kardex.idtipkar <>"5" AND kardex.fechaescritura >= STR_TO_DATE("'.$fechade.'","%d/%m/%Y") AND kardex.fechaescritura <= STR_TO_DATE("'.$fechaha.'","%d/%m/%Y") order by kardex.idtipkar,kardex.fechaescritura,FN_ONLYNUM(kardex.numescritura) asc';
}else{
$sqlkardex = 'SELECT DISTINCT kardex.codactos, kardex.idkardex, kardex.kardex, kardex.idtipkar, kardex.numescritura, kardex.fechaescritura, kardex.fechaconclusion FROM kardex 
WHERE kardex.idtipkar <>"2" ANd kardex.idtipkar <>"5" AND kardex.fechaescritura >= STR_TO_DATE("'.$fechade.'","%d/%m/%Y") AND kardex.fechaescritura <= STR_TO_DATE("'.$fechaha.'","%d/%m/%Y") order by kardex.idtipkar asc';	
}

$result=mysql_query($sqlkardex,$conn);
while($row = mysql_fetch_array($result)) {

    $kardex=$row['kardex']; $codactos=$row['codactos']; $numescri=$row['numescritura']; $fechaescritura=$row['fechaescritura']; $fechaconclusion=$row['fechaconclusion'];
	
	if($row['idtipkar']=='1'){ $tipkar='E'; }
    if($row['idtipkar']=='3'){ $tipkar='T'; }
    if($row['idtipkar']=='4'){ $tipkar='G'; }
	
	$acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
    $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto' and actouif <> '' AND (actouif = '001' OR actouif = '002' OR actouif = '003' 
								OR actouif = '004' OR actouif = '005' OR actouif = '006' OR actouif = '007' OR actouif = '008'
								OR actouif = '009' OR actouif = '010' OR actouif = '011' OR actouif = '012' OR actouif = '013'
								OR actouif = '014' OR actouif = '015' OR actouif = '016' OR actouif = '017' OR actouif = '018'
								OR actouif = '019' OR actouif = '020' OR actouif = '021' OR actouif = '022' OR actouif = '023'
								OR actouif = '024' OR actouif = '025' OR actouif = '026' OR actouif = '027' OR actouif = '028' 
								OR actouif = '029' OR actouif = '030' OR actouif = '031' OR actouif = '032' OR actouif = '033'
								OR actouif = '034' OR actouif = '035' OR actouif = '036' OR actouif = '037' OR actouif = '038'
								OR actouif = '039' OR actouif = '040' OR actouif = '041' OR actouif = '042' OR actouif = '043'
								OR actouif = '044' OR actouif = '045' OR actouif = '046' OR actouif = '047' OR actouif = '048'
								OR actouif = '049' OR actouif = '050' OR actouif = '051' OR actouif = '052' OR actouif = '053'
								OR actouif = '054' OR actouif = '055' OR actouif = '056' OR actouif = '999')", $conn) or die(mysql_error());
		$row2=mysql_fetch_array($consulta);
		if(!empty($row2)){
		        $idtipoacto=$row2['idtipoacto']; $actouif=$row2['actouif'];
				$sql2="INSERT INTO kardex_ro(idkardex, kardex, idtipkar, codactos, uif, numescritura, fechaescritura, fechaconclusion, tipo) 
				       VALUES (NULL,'$kardex','$tipkar','$idtipoacto','$actouif','$numescri','$fechaescritura','$fechaconclusion', 'I')";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		$i++;
		}

}

mysql_free_result($result);
mysql_close($conn);  

echo"Data Cargada Satisfactoriamente..!!!!!";

?>