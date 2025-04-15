<?php 
include("../../conexion.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="../../ajax.js"></script>
<title>Untitled Document</title>
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
</head>

<body>
<table width="858" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="846" height="25"><span class="reskar2">Busqueda Por:</span></td>
    <td width="12" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><form name="frmbuscakardex" method="post" action="">
      <table width="605" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="79"><span class="titubuskar0">Nombre</span></td>
          <td width="164"><span class="titubuskar0">
            <label>
            <input name="descri" type="text" id="descri" size="50" style="text-transform:uppercase;"  onkeyup="buscaSERVICIO()">
            </label>
          </span></td>
          <td width="76" align="right">&nbsp;</td>
          <td width="286">&nbsp;</td>
          </tr>
      </table>
    </form>   </td>
  </tr>
  <tr>
    <td colspan="2">--------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td colspan="2"><div id="gennn" style="width:860px; height:450px; overflow:auto;">
      <table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="830" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="30" align="center"><span class="titubuskar0">Codigo</span></td>
              <td width="100" align="center"><span class="titubuskar0">Descripcion</span></td>
              <td width="30" align="center"><span class="titubuskar0">Tipo</span></td>
              <td width="86" align="center"><span class="titubuskar0">Precio</span></td>
              
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="bkardex">
            <?php 
include("../../conexion.php");


$consulkar=mysql_query("SELECT * FROM  `estudioabogado` ORDER BY nombre ASC", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

//$numcarta = $rowkar['num_certificado'];
//$numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

echo "<table width='830' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='35' align='center' ><span class='reskar'><a href='EdiServicios.php?codigo=".$rowkar['codigo']."'>
	".$rowkar['nombre']."</a></span></td>
	<td width='100' align='center' ><span class='reskar'>".$rowkar['direccion']."</span></td>
	<td width='30' align='center' ><span class='reskar'>".$rowkar['telefono']."</span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['colegiatura']."</span></td>
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

</body>
</html>