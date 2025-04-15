<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM det_cambiocarac",$conn) or die(mysql_error());

$detalle   = $_REQUEST["detalle"];
$id_cambio = $_REQUEST["id_cambio"];


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
<table width="515" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><div id="gennn" style="width:450; height:300; overflow:auto;">
      <table width="515" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="515" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="150" align="left"><span class="titubuskar0">Dato</span></td>
              <td width="200"  align="left"><span class="titubuskar0">Descripcion</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="bkardex">
            <?php 
include("../../conexion.php");

 
$consulkar=mysql_query("SELECT det_cambiocarac.*,  CONCAT(detalle_cambios.id_cambio,' - ',detalle_cambios.des_cambio) AS 'des'
FROM det_cambiocarac INNER JOIN detalle_cambios ON detalle_cambios.id_cambio = det_cambiocarac.id_dato WHERE  det_cambiocarac.id_cambio =  '$id_cambio'
ORDER BY id_dato DESC", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='515' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='200' align='left' ><span class='reskar'>".$rowkar['des']."</span></td>
	<td width='200' align='left' ><span class='reskar'><input style='text-transform:uppercase'  name='".$rowkar['id_dato']."' id='".$rowkar['id_dato']."' type='text' size='40' maxlength='99' onKeyUp ='fupdateCarac(this.id,this.value)' value='".$rowkar['descripcion']."' /></span></td>
  </tr>
</table>";
}
?>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>



