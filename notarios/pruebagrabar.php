<?php 
include("conexion.php");
$condicion="001.1/001.2/";
    $condiciones=explode("/",$condicion);
	$condi1=$condiciones[0];
	$condi2=$condiciones[1];
	$condi3=$condiciones[2];
	$condi4=$condiciones[3];
	$condi5=$condiciones[4];
	$condi6=$condiciones[5];
	$condi7=$condiciones[6];
	$condi8=$condiciones[7];
	$condi9=$condiciones[8];
	$condi10=$condiciones[9];
	
	
	$ressepa=explode(".",$condi1);
	$codcondi=$ressepa[0]; $item0=$ressepa[1];
	
	$ressepa1=explode(".",$condi2);
	$codcondi1=$ressepa1[0]; $item1=$ressepa1[1];
	
	$ressepa2=explode(".",$condi3);
	$codcondi2=$ressepa2[0]; $item2=$ressepa2[1];
	
	$ressepa3=explode(".",$condi4);
	$codcondi3=$ressepa3[0]; $item3=$ressepa3[1];
	
	$ressepa4=explode(".",$condi5);
	$codcondi4=$ressepa4[0]; $item4=$ressepa4[1];
	
	$ressepa5=explode(".",$condi6);
	$codcondi5=$ressepa5[0]; $item5=$ressepa5[1];
	
	$ressepa6=explode(".",$condi7);
	$codcondi6=$ressepa6[0]; $item6=$ressepa6[1];
	
	$ressepa7=explode(".",$condi8);
	$codcondi7=$ressepa7[0]; $item7=$ressepa7[1];
	
	$ressepa8=explode(".",$condi9);
	$codcondi8=$ressepa8[0]; $item8=$ressepa8[1];
	
	$ressepa9=explode(".",$condi10);
	$codcondi9=$ressepa9[0]; $item9=$ressepa9[1];
	
	$condicionesss = array($codcondi,$codcondi1,$codcondi2,$codcondi3,$codcondi4,$codcondi5,$codcondi6,$codcondi7,$codcondi8,$codcondi9);
	$itemsss= array($item0,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9);
	$i=0;

	while ($i < count ($condicionesss) ) {
		$numitem=$condicionesss[$i]; $menuitem=$condicionesss[$i];
        $consultate=mysql_query("SELECT * FROM actocondicion WHERE idcondicion='$numitem'", $conn) or die(mysql_error());
		$rowcondi=mysql_fetch_array($consultate);
		if(!empty($rowcondi)){
		        $condition=$rowcondi['idcondicion']; $parte=$rowcondi['parte']; $idtipoacto=$rowcondi['idtipoacto']; $selecitem=$menuitem;
  $consultaw=mysql_query("INSERT INTO contratantesxacto(idtipkar, kardex, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, nformulario, impuesto, uifordenante, uifbeneficiario, uifapoderado) VALUES ('$idtipkar','$codkardex','$idtipoacto','$ncontratante','$selecitem','$condition','$parte','','','','','','')", $conn) or die(mysql_error());

					
					}
		
		$i++;
		
		
		}



?>