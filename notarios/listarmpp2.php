<style type="text/css">
<!--
.stylemp {font-family: Calibri; font-weight: bold; font-style: italic; font-size: 12px; }
.stylemp2 {font-family: Calibri; font-size: 12px; font-style: italic; }
-->
</style>

<?php session_start();
include("conexion.php");

$codkardex=$_POST['codkardex'];


$consulkarmp=mysql_query("SELECT * FROM detallemediopago where kardex='$codkardex' and tipacto='".$_SESSION['actopatri']."' and itemmp='".$_SESSION['varitem']."'", $conn) or die(mysql_error());


echo"<table width='650' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
    <td width='49' align='center' bordercolor='#333333' bgcolor='#999999'><span class='stylemp'>Kardex - Año</span></td>
    <td width='192' align='center' bordercolor='#333333' bgcolor='#999999'><span class='stylemp'>Medio  Pago</span></td>
    <td width='211' align='center' bordercolor='#333333' bgcolor='#999999'><span class='stylemp'>Banco</span></td>
    <td width='68' align='center' bordercolor='#333333' bgcolor='#999999'><span class='stylemp'>Importe</span></td>
    <td width='71' align='center' bordercolor='#333333' bgcolor='#999999'><span class='stylemp'>Fec. Oper.</span></td>
    <td width='25' align='center' bordercolor='#333333' bgcolor='#999999'>&nbsp;</td>
    <td width='18' align='center' bordercolor='#333333' bgcolor='#999999'>&nbsp;</td>
  </tr>";
while($rowkarmp = mysql_fetch_array($consulkarmp)){
 echo"<tr>
    <td align='center' bgcolor='#FFFFFF'><span class='stylemp2'>".$rowkarmp['kardex']."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='stylemp2'>"; 
	$mdpagooo=mysql_query("SELECT * FROM mediospago where codmepag='".$rowkarmp['codmepag']."'", $conn) or die(mysql_error());
	$rowmdpagoo=mysql_fetch_array($mdpagooo);
	echo $rowmdpagoo['desmpagos'];
	echo"</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='stylemp2'>";
	$mdbancoo=mysql_query("SELECT * FROM bancos where idbancos='".$rowkarmp['idbancos']."'", $conn) or die(mysql_error());
	$rowmdbancoo=mysql_fetch_array($mdbancoo);
	echo $rowmdbancoo['desbanco'];
	
	
	echo"</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='stylemp2'>".$rowkarmp['importemp']."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='stylemp2'>".$rowkarmp['foperacion']."</span></td>
    <td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowkarmp['detmp']."' onclick='muesdiveditar2(this.id)'><img src='iconos/editamv.png' width='16' height='18'></a></td>
    <td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowkarmp['detmp']."' onclick='moselimp2(this.id)'><img src='iconos/eliminamv.png' width='18' height='17'></a></td>
 </tr>";
  }
  echo"</table>";

?>