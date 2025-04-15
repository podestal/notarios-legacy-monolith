<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT (CASE WHEN cliente.nombre != '' THEN cliente.nombre ELSE cliente.razonsocial  END) AS 'des', cliente.numdoc AS 'id' FROM cliente",$conn) or die(mysql_error());

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

	function ShowDetSello(_iddocum,_partidesc)
	{
		document.getElementById('parti_docu').value = _iddocum;
		document.getElementById('parti_des').value = _partidesc;
	}

	function fbusdetallecarta() { fbusClientePar();	}
	
	function pasadatos()
	{
		var _obs = document.getElementById('contecarta2').value;
		document.getElementById('contecarta').value = _obs;	
	}

	function pasadatos()
	{
		var _id  = document.getElementById('parti_docu').value;
		var _des = document.getElementById('parti_des').value;
		document.getElementById('c_codcontrat').value = _id;
		document.getElementById('c_descontrat').value = _des;	
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
          <td width="19"><input name="parti_docu" type="hidden" id="parti_docu"  />
          <input name="parti_des" type="hidden" id="parti_des"  /></td>
          <td><span class="titubuskar0"><!--Tipo Contratante-->
            <input name="desparticipante" type="text" id="desparticipante" size="30" onkeyup="//fbusdetallecarta()" />
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
              <td width="90" align="center"><span class="titubuskar0">DOCUMENTO</span></td>
              <td width="250" align="center"><span class="titubuskar0">DESCRIPCION</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="participante_select">
            <?php 
include("../../conexion.php");


$consulkar=mysql_query("SELECT (CASE WHEN cliente.nombre != '' THEN cliente.nombre ELSE cliente.razonsocial  END) AS 'des', cliente.numdoc AS 'id' FROM cliente", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='90' align='center' ><span class='reskar'><a href='#' id='".$rowkar['id']."' name='".$rowkar['des']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['id']."</a></span></td>
	<td width='250' align='center' ><span class='reskar'><a href='#' id='".$rowkar['id']."' name='".$rowkar['des']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['des']."</a></span></td>
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



