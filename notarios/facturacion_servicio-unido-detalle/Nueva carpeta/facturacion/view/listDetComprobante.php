<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM d_regventas",$conn) or die(mysql_error());

$id_regventas = $_REQUEST["id_regventas"];

?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>
<table id="Table_det_Serv" name="Table_det_Serv" width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2"><div id="gennn" style="width:100%; height:300; overflow:auto;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="150" align="left"><span class="titubuskar0">Codigo</span></td>
              <td width="350" align="left"><span class="titubuskar0">Descripcion</span></td>
              <td width="120" align="right"><span class="titubuskar0">Precio</span></td>
              <td width="120" align="right"><span class="titubuskar0">Cantidad</span></td>
              <td width="120" align="right"><span class="titubuskar0">Total</span></td>
              <td style="display:none"></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="bkardex">
            <?php 
include("../../conexion.php");

 
$consulkar=mysql_query("SELECT d_regventas.codigo AS 'Codigo', d_regventas.detalle AS 'Descripcion', d_regventas.precio AS 'Precio', d_regventas.cantidad AS 'Cantidad', d_regventas.total AS 'Total'
FROM d_regventas 
WHERE d_regventas.id_regventas = '$id_regventas'
ORDER BY d_regventas.detalle ASC", $conn) or die(mysql_error());
$i=0;
while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='150' align='left' ><span class='reskar'>".$rowkar['Codigo']."</span></td>
	<td width='350' align='left' ><span class='reskar'>".$rowkar['Descripcion']."</span></td>
	<td width='120' align='right' ><span class='reskar'>".$rowkar['Precio']."</span></td>
	<td width='120' align='right' ><span class='reskar'>".$rowkar['Cantidad']."</span></td>
	<td width='120' align='right' ><span class='reskar'>".$rowkar['Total']."</span></td>
	<td style='display:none'><input name='datos".$i."' type='text' id='datos".$i."'>".$rowkar['Codigo'].'|'.$rowkar['Descripcion'].'|'.$rowkar['Precio'].'|'.$rowkar['Cantidad'].'|'.$rowkar['Total'].
	
	"</td>
  </tr>
</table>";
 $i++;
}
?>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>



