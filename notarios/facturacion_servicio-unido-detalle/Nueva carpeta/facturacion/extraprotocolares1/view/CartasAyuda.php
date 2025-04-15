<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM selloscartas",$conn) or die(mysql_error());

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
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
<script type="text/javascript">

	function ShowDetSello(_idsello,_contenido){ 
	document.getElementById('contecarta2').value = _contenido;
	
		fecha=document.getElementById('fecentrega').value;
	hora=document.getElementById('horaentrega').value;
	
	contenido1 = _contenido.replace('00/00/0000',fecha);
	contenido2  =  contenido1.replace('00:00',hora);
	document.getElementById('contecarta').value = contenido2;
	
	$(div_ayudacarta).dialog("destroy").remove();
	
	
	 }

	function fbusdetallecarta() { fbussello();	}
	
	function pasadatos()
	{
		var _obs = document.getElementById('contecarta2').value;
		document.getElementById('contecarta').value = _obs;	
	}

</script>
</head>

<body>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form name="frmbuscakardex" method="post" action="">
      <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><span class="titubuskar0">Ingrese Descripción</span></td>
          <td width="19"><input name="contecarta2" type="hidden" id="contecarta2"  /></td>
          <td><span class="titubuskar0">
            <input name="dessello" type="text" id="dessello" size="30" onkeyup="//fbusdetallecarta()" />
            </span><span class="titubuskar1">
            <a href="#" onClick="fbusdetallecarta()"> <img src="../../images/search.png" width="15" height="15" alt="" /></a></span></td>
          <td><label>
          </label></td>
        </tr>
      </table>
        </form>   </td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2"><div id="gennn" style="width:500px; height:200px; overflow:auto;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="90" align="center"><span class="titubuskar0">CODIGO</span></td>
              <td width="250" align="center"><span class="titubuskar0">DESCRIPCION</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="cartas_ayuda">
            <?php 
include("../../conexion.php");


$consulkar=mysql_query("Select * from selloscartas", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='90' align='center' ><span class='reskar'><a href='#' id='".$rowkar['idsello']."' name='".$rowkar['contenido']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['idsello']."</a></span></td>
	<td width='250' align='center' ><span class='reskar'><a href='#' id='".$rowkar['idsello']."' name='".$rowkar['contenido']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['dessello']."</a></span></td>
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



