<style type="text/css">
<!--
.blnacoo {
	font-family: Calibri;
	font-style: italic;
	font-size: 12px;
	color: #FFFFFF;
}
-->
</style>
<?php 
include("conexion.php");
$codkardex       = $_POST['codkardex'];
//$idrepresentante = $_POST['codkardex'];

$consulta = mysql_query("SELECT * from contratantes where kardex='$codkardex'", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
    $consul=mysql_query("Select * from cliente2 where idcontratante='".$row['idcontratante']."' ", $conn) or die(mysql_error());
    $row2 = mysql_fetch_array($consul);
	echo "<table width='512' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='18' height='34'>&nbsp;</td>
    <td width='366'><span class='blnacoo'>"; if($row2['tipper']=="N") { 
	 
	$nomyape=strtoupper($row2['apepat'])." ".strtoupper($row2['apemat']).", ".strtoupper($row2['prinom'])." ".strtoupper($row2['segnom']);
	$textorefe=str_replace("?","'",$nomyape);
	$textoampers=str_replace("*","&",$textorefe);
	$textoamperss=str_replace("ñ","Ñ",$textoampers);
	
	echo strtoupper($textoamperss);  
	
	}else { 
	  $empresita=strtoupper($row2['razonsocial']);
	         $textorefe=str_replace("?","'",$empresita);
						  $textoampers=str_replace("*","&",$textorefe);
						  $textoamperss=str_replace("ñ","Ñ",$textoampers);
						  echo strtoupper($textoamperss);
	 
	 } echo"</span></td>
    <td width='94'><a id='".$row2['idcontratante']."' href='#' onClick='seleccionarcontra(this.id)'><img src='iconos/seleccionar.png' width='94' height='29' border='0'></a></td>
  </tr>
</table>";

}
 
//.$row2['apepat']." ".$row2['apemat'].", ".$row2['prinom']." ".$row2['segnom'].
?>