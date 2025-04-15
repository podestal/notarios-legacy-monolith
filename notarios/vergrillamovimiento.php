<style type='text/css'>
<!--
.rrrppp {font-style: italic; font-family: Calibri;}
-->
</style>
<?php 

include("conexion.php");

$codkardex=$_POST['codkardex'];


$conmoves=mysql_query("Select * from movirrpp where kardex='$codkardex'", $conn) or die(mysql_error());

while($rowves = mysql_fetch_array($conmoves)){
		$conmo=mysql_query("SELECT *, STR_TO_DATE(fechamov,'%d/%m/%Y') FROM detallemovimiento   where idmovreg='".$rowves['idmovreg']."' ORDER BY titulorp, STR_TO_DATE(fechamov,'%d/%m/%Y') ASC", $conn) or die(mysql_error());
		
		while($rowvie = mysql_fetch_array($conmo)){
		 
		 echo"<table width='710' height='29' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
         <tr>
		 <td width='70' height='28' align='center' bgcolor='#ffffff'><span class='Estilo36'><a href='#' onmouseover='seleccionmov(this.id,this.name)' id='".$rowves['idmovreg']."' name='".$rowvie['itemmov']."'>".$rowvie['fechamov']."</a></span></td>
    <td width='153' align='center' bgcolor='#ffffff'><span class='Estilo36'>"; $sqltra=mysql_query("SELECT * FROM tipotramogestion where idtiptraoges='".$rowvie['idtiptraoges']."'",$conn) or die(mysql_error());
	$rowtra=mysql_fetch_array($sqltra); echo $rowtra['desctiptraoges'];
	 echo"</span></td>
    <td width='73' align='center' bgcolor='#ffffff'><span class='Estilo36'>".$rowvie['titulorp']."</span></td>
    <td width='125' align='center' bgcolor='#ffffff'><span class='Estilo36'>"; $sqlestra=mysql_query("SELECT * FROM estadoregistral where idestreg='".$rowvie['idestreg']."'",$conn) or die(mysql_error());
	$rowesta=mysql_fetch_array($sqlestra); echo $rowesta['desestreg'];
	 echo"</span></td>
    <td width='63' align='center' bgcolor='#ffffff'><span class='Estilo36'>"; if($rowvie['importee']==""){echo $rowvie['mayorderecho'];}else{echo $rowvie['importee'];} echo"</span></td>
    <td width='115' align='center' bgcolor='#ffffff'><span class='Estilo36'>";$sqlsede=mysql_query("SELECT * FROM sedesregistrales where idsedereg='".$rowvie['idsedereg']."' ",$conn) or die(mysql_error()); 
	$rowsederegi=mysql_fetch_array($sqlsede); echo $rowsederegi['dessede'];
	echo"</span></td>
    <td width='95' align='center' bgcolor='#ffffff'><span class='Estilo36'>";$sqlsec=mysql_query("SELECT * FROM seccionesregistrales where idsecreg='".$rowvie['idsecreg']."'",$conn) or die(mysql_error()); 
	$rowseccregi=mysql_fetch_array($sqlsec); echo $rowseccregi['dessecc'];
	echo"</span></td>
	<td width='16'><a href='#' id='".$rowvie['itemmov']."'   onclick='edimrrpp(this.id)'><img src='iconos/editamv.png' /></a></td>
	<td width='18'><a href='#' onclick='elimrrpp()'><img src='iconos/eliminamv.png' /></a></td>
    </tr>
</table>";
	
		}


}
echo"<br><br>";

$presupuesto=mysql_query("select * from kardex where kardex='$codkardex'",$conn) or die(mysql_error());
$rowpresupu=mysql_fetch_array($presupuesto);

$movreg=mysql_query("select * from movirrpp where kardex='$codkardex'",$conn) or die(mysql_error());
$rowmov=mysql_fetch_array($movreg);
	
$sqlsalditooo="select * from saldorrpp where idmovreg='".$rowmov['idmovreg']."'";
$rptasalditooo=mysql_query($sqlsalditooo,$conn) or die(mysql_error());	
$rowsalditooo=mysql_fetch_array($rptasalditooo);

echo"<table width='519' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666' bgcolor='#CCCCCC'>
  <tr>
    <td height='52' colspan='3' align='left'><table width='246' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
      <tr>
        <td width='117' align='center' class='rrrppp'>Presupuesto</td>
        <td width='22' align='center' class='rrrppp'>-</td>
        <td width='107' align='center' class='rrrppp'>Cobrado</td>
      </tr>
      <tr>
        <td align='center'><input name='presu' style='background:#FFFFFF' type='text' id='presu' value='".$rowpresupu['dregistral']."' size='10' readonly  /></td>
        <td align='center' class='rrrppp'>-</td>
        <td align='center'><input name='cobra' style='background:#FFFFFF' type='text' id='cobra' size='10' value='0' readonly /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width='137' height='20' align='center'><span class='rrrppp'>Pagado a RR.PP</span></td>
    <td width='208' align='center'><span class='rrrppp'>Mayor Derecho por Pagar</span></td>
    <td width='166' align='center'><span class='rrrppp'>Por Cobrar al Cliente</span></td>
  </tr>
  <tr>
    <td height='20' align='center'> <input name='prrpp' type='text' style='background:#FFFFFF' id='prrpp' value='".$rowsalditooo['pagadorrpp']."' readonly size='10' /></td>
    <td align='center'><input name='mder' type='text' style='background:#FFFFFF' id='mder' size='10' value='".$rowsalditooo['mayorderecho']."' readonly /></td>
    <td align='center'><input name='xcobra' type='text' style='background:#FFFFFF' id='xcobra' value='".$rowsalditooo['xcobrarclie']."' size='10' readonly /></td>
  </tr>
</table>";

?>
