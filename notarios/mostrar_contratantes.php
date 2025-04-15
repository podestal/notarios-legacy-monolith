<?php 
include("conexion.php");
$codkardex=$_POST['codkardex'];

$consulta = mysql_query("SELECT * from contratantes where kardex='$codkardex' ORDER BY idcontratante ASC ", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
    $consul=mysql_query("Select * from cliente2 where idcontratante='".$row['idcontratante']."' ", $conn) or die(mysql_error());
    $row2 = mysql_fetch_array($consul);
	echo "<table width='700' border='1' bordercolor='#666666' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='234' height='28px' bgcolor='#FFFFFF'><span class='textocontratantesss'>"; if($row2['tipper']=="N") { 
	
	$nomyape=strtoupper($row2['apepat']." ".$row2['apemat'].", ".$row2['prinom']." ".$row2['segnom']);
	$textorefe=str_replace("?","'",$nomyape);
						  $textoampers=str_replace("*","&",$textorefe);
						  $textoamperss=str_replace("ñ","Ñ",$textoampers);
						  echo strtoupper($textoamperss);
	
	 }else {  
	 
	$empresita=strtoupper($row2['razonsocial']);
	$textorefe=str_replace("?","'",$empresita);
						  $textoampers  = str_replace("*","&",$textorefe);
						  $textoamperss = str_replace("ñ","Ñ",$textoampers);
						  echo strtoupper($textoamperss);
	 
	} echo"</span></td>
	<td width='154' bgcolor='#FFFFFF'><span class='textocontratantesss'>";  
	
	$consuld=mysql_query("Select * from contratantesxacto where idcontratante='".$row['idcontratante']."' ", $conn) or die(mysql_error());
    while($rowd = mysql_fetch_array($consuld)){
	 $consulcc=mysql_query("Select * from actocondicion where idcondicion='".$rowd['idcondicion']."'", $conn) or die(mysql_error());
      $rowcc = mysql_fetch_array($consulcc);
	  echo strtoupper($rowcc['condicion'])."<br>";
	}
	 echo"</span></td>
    <td width='64' bgcolor='#FFFFFF'><span class='textocontratantesss'>"; if ($row['firma']=="1"){echo "SI   :<a  id='".$row['idcontratante']."' onclick='mostraridcontratante(this.id)'><img src='iconos/firmita.png' width='34' height='23'  border='0' /></a>";}else{echo "NO";} echo"</span></td>
    <td width='97' bgcolor='#FFFFFF'><span class='textocontratantesss'>".$row['fechafirma']."</span></td>
    <td width='139' bgcolor='#FFFFFF'><span class='textocontratantesss'>"; 
	$usuconsulta=mysql_query("SELECT * FROM usuarios WHERE idusuario='".$row['resfirma']."'", $conn) or die(mysql_error());
    $rowiusu=mysql_fetch_array($usuconsulta); 
	echo $rowiusu['apepat']." ".$rowiusu['apemat'].$rowiusu['prinom']." ".$rowiusu['segnom']; 
  echo"</span></td>";
	echo "<td class='sinEstilos' id='sinEstilos'>
		<img id='loading".$row["idcontratante"]."' style='display: none' src='loading.gif'>
		<select class='cmbAnexo' id='cmbAnexo".$row["idcontratante"]."' onchange='generateDeclaracionJurada(".'"'.$row["idcontratante"].'"'.")' style='font-size:10px;width:60px'>
			<option value='0'>.::DDJJ::.</option>
			<option value='ANEXO5'>ANEXO 5</option>
			<option value='ANEXO5.1'>ANEXO 5.1</option>
			<option value='ANEXO5.2'>ANEXO 5.2</option>
			<option value='ANEXO5.3'>ANEXO 5.3</option>
			<option value='ANEXO5.4'>ANEXO 5.4</option>
			<option value='ANEXO6'>ANEXO 6</option>
		</select>
		
	</td>";
  echo "</tr>
</table>";
}
?>