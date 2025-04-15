<?php 
 session_start();
include("conexion.php");



$condicion=$_POST['codcon'];
	

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
		$numitem=$condicionesss[$i];
        $consulta=mysql_query("SELECT * FROM actocondicion WHERE idcondicion='$numitem'", $conn) or die(mysql_error());
		$rowpendex=mysql_fetch_array($consulta);
		if(!empty($rowpendex)){
		        $formu=$rowpendex['formulario'];
				   if($formu=="2"){
					   echo"<table width='250' border='0' cellspacing='0' cellpadding='0'>
            <tr>
              <td width='54'><span class='camposss'>Inscrito</span></td>
              <td width='48'><input type='radio' name='inscrito' id='inscrito' checked='checked' onclick='mostrarinscri(1)'/></td>
              <td width='84'><span class='camposss'>No Inscrito</span></td>
              <td width='64'><label for='inscrito'><input type='radio' name='inscrito' id='noinscrito' onclick='mostrarinscri2(0)'/>
              </label></td>
            </tr>
          </table>";
					   
					   }else{
						echo"";   
					   }
				  
					}
		
		$i++;
		}
	
?>
