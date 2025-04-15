<?php 
include("conexion.php");
require_once("includes/_ClsCon.php");
class GMedPago extends _ClsCon
	{		
###################################################### 
#################### GRABA  ################## 

		function fGrabaD($itmp ,$codkardex ,$tipoactopatri ,$nnminuta ,$tipomoneda ,$tipcambio ,$imptrans ,$exibio, $sedereg, $opopago)
			{
		
			$strsqla = "CALL spGrabaMedioPago('".$itmp."' ,'".$codkardex."' ,'".$tipoactopatri."' ,'".$nnminuta."' ,".$tipomoneda." ,'".$tipcambio."' ,'".$imptrans."' ,'".$exibio."', '".$sedereg."', ".$opopago.");";	
									  
									  
		    //echo $strsqla;
			//exit();
			$this->_trans($strsqla);
			}					
	}

$oModel = new GMedPago();

$codkardex=$_POST['codkardex'];
$tipoactopatri=$_POST['tipoactopatri'];
$nnminuta=$_POST['nnminuta'];
$imptrans=$_POST['imptrans'];
$tipomoneda=$_POST['tipomoneda'];
$exibio=$_POST['exibio'];
$tipcambio=$_POST['tipcambio'];
$humbral=$_POST['humbral'];
$consulta=mysql_query("Select * from patrimonial order by itemmp DESC LIMIT 1", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$numero=$row['itemmp'];
$suma= intval($numero) + 1;
$cantidad= strlen($suma);
 switch ($cantidad) {
	case "1":
	$itmp="00000".$suma;
	break;
	case "2":
	$itmp="0000".$suma;	
	break;
	case "3":
	$itmp="000".$suma;
	break;
	case "4":
	$itmp="00".$suma;	
	break;
	case "5":
	$itmp="0".$suma;
	break;
	case "6":
	$itmp=$suma;	
	break;						
}
$opopago=0;
$sedereg=0;


$sqlmp="INSERT INTO patrimonial(itemmp, kardex, idtipoacto, nminuta, idmon, tipocambio, importetrans, exhibiomp, presgistral, nregistral, idsedereg, fpago, idoppago, ofondos) VALUES ('$itmp','$codkardex','$tipoactopatri','$nnminuta','$tipomoneda','$tipcambio','$imptrans','$exibio','','','$sedereg','','$opopago','')"; 

mysql_query($sqlmp,$conn) or die(mysql_error());

echo "<input name='itemmpp' readonly='readonly' type='hidden' value='".$itmp."' size='8'>";


if ($tipomoneda=="1"){
$conver=(floatval($imptrans)/floatval($tipcambio));
  if(floatval($humbral) < floatval($conver)){
    mysql_query("update kardex set horaingreso='1' where kardex='$codkardex'",$conn) or die(mysql_error()); 
	mysql_query("INSERT INTO rouif(item, kardex, uni, sospe) VALUES (NULL,'$codkardex','no','no')",$conn) or die(mysql_error());
	echo"<span style='font-family:Calibri; font:bold; font-size:15px; color:#036'>* UIF - RO </span>|<input type='checkbox' name='inu' id='inu' onclick='valorinu(this.checked)' /><span style='font-family:Calibri; font-size:12px; color:#036'>OPERACION INUSUAL</span>";
  }
}else{
 if(floatval($humbral) < floatval($imptrans)){
    mysql_query("update kardex set horaingreso='1' where kardex='$codkardex'",$conn) or die(mysql_error()); 
mysql_query("INSERT INTO rouif(item, kardex, uni, sospe) VALUES (NULL,'$codkardex','no','no')",$conn) or die(mysql_error());
	echo"<span style='font-family:Calibri; font:bold; font-size:15px; color:#036'>* UIF - RO </span>|<input type='checkbox' name='inu' id='inu' onclick='valorinu(this.checked)' /><span style='font-family:Calibri; font-size:12px; color:#036'>OPERACION INUSUAL</span>";
   }
}


## funcion para guardar:
$oModel->fGrabaM($itmp ,$codkardex ,$tipoactopatri ,$nnminuta ,$tipomoneda ,$tipcambio ,$imptrans ,$exibio, $sedereg, $opopago); 

?>



