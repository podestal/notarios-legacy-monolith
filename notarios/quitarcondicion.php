<style type="text/css">
<!--
.checks {
	font-family: Calibri;
	font-size: 12px;
	color: #FFFFFF;
	font-style: italic;
}
-->
</style>
<?php 
include("conexion.php");

     $codkardex=$_POST['codkardex'];
	 $codcon=$_POST['codcon'];

	$condiciones=explode("/",$codcon);
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
	
	
	
	
	
	$consulta=mysql_query("Select * from detalle_actos_kardex where kardex = '$codkardex'", $conn) or die(mysql_error());
		while($row=mysql_fetch_array($consulta)){
		   echo "<table><tr>
				<td width='500' ><span class='ajo'>".$row['desacto']."</span><br></td>
			  </tr>
			  <tr>
				<td colspan='2'>";
				$i=0;
				 while ($i < count ($condicionesss) ) {
				    $numitem=$condicionesss[$i];
				    $consulta2=mysql_query("Select * from actocondicion WHERE idtipoacto='".$row['idtipoacto']."' and idcondicion='".$numitem."'", $conn) or die(mysql_error());
					 while($row2=mysql_fetch_array($consulta2)){
					echo "<input type='checkbox' checked='checked' name='".$row2['idcondicion']."' id='".$row['item']."' value='".$row2['idcondicion']."' onClick='mostrar3(this.checked, this.name, this.id)'><span class='ajo2'>".$row2['condicion']."</span><br>";
					 }
			$i++;	
		}
				echo "</td>
			  </tr>
			</table>";
	
		} 	
		
    
			 
?>
