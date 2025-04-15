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
$codactos = $_POST['codactos'];

$acto1 = substr($codactos,0,3);
$acto2 = substr($codactos,3,3);
$acto3 = substr($codactos,6,3);
$acto4 = substr($codactos,9,3);
$acto5 = substr($codactos,12,3);

$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);

/*$codigosActos = substr($codactos,0, -1);
$actoss = explode(',', $codigosActos);*/

	$i=0;
	while ($i < count ($actoss)) {
		$numacto=$actoss[$i];
		$consulta=mysql_query("Select * from tiposdeacto where idtipoacto='".$numacto."'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($consulta);
		if(!empty($row)){echo "<table width='600' border='0' cellspacing='0' cellpadding='0'>
				  <tr>
					<td width='20'>&nbsp;</td>
					<td width='580'><input type='checkbox' checked='checked' name='".$row['idtipoacto']."' value='".$row['desacto']."' id='".$row['idtipoacto']."' onClick='mostrar(this.checked,this.value); mostrar2(this.checked, this.name)'><span class='checks'>".$row['desacto']."</span></td>
				  </tr>
				</table>";}
		
		$i++;
	}
?>
