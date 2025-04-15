<?php 
include("conexion.php");
$codigo=$_POST['idusu3'];

$consulta=mysql_query("SELECT * from usuarios where idusuario='$codigo'", $conn) or die(mysql_error());

$row = mysql_fetch_array($consulta);

$sql=mysql_query("SELECT * FROM cargousu",$conn);
$sql2=mysql_query("SELECT * FROM ubigeo",$conn);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Usuario</title>
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, textarea, select, button").uniform();
      });
    </script>
<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen">
<style type="text/css">
<!--
.Estilo15 {
	font-family: Calibri;
	font-size: 15px;
	font-style: italic;
	font-weight: bold;
	color: #FF9900;
}
.Estilo17 {font-family: Calibri; font-style: italic; font-size: 14px; color: #FFFFFF; }
.Estilo18 {color: #FFFFFF}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="cambiar_clave.php">
  <table width="305" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" colspan="2"><span class="Estilo15">Cambiar  Contraseña Usuario
          <label>
        <input type="hidden" name="idusuario" value="<?php echo $row['idusuario']; ?>" id="idusuario" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td width="92" height="25"><span class="Estilo17">Usuario : </span></td>
      <td width="213" height="25"><input type="text" readonly="readonly" style="background:#FFFFFF; text-transform:uppercase;" name="loginusuario" id="loginusuario" value="<?php echo $row['loginusuario']; ?>" /></td>
    </tr>
    <tr>
      <td height="25"><span class="Estilo17">Contraseña : </span></td>
      <td height="25"><input name="clave" type="password" id="clave" style="background:#FFFFFF; text-transform:uppercase;"  maxlength="30" /></td>
    </tr>
    <tr>
      <td height="31">&nbsp;</td>
      <td height="31"><label>
        <input type="submit" name="button" id="button" value="Grabar" />
      </label></td>
    </tr>
  </table>
</form>

</body>
</html>
