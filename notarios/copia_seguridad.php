<?php
session_start();
include("conexion.php");
$id_usuario= $_SESSION["id_usu"];
$sqlu  = mysql_query("SELECT * FROM permisos_usuarios where idusuario = '$id_usuario'",$conn) or die(mysql_error());

$rowu= mysql_fetch_array($sqlu);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
div.frmprotocolar
{ 
  background-color: #ffffff;
border: 4px solid #132E4A;  
width:100%; height:850px;
}

.titulosprincipales {
	font-family: Verdana;
	font-size: 16px;
	color: #FFFFFF;
	
}
.line {color: #FFFFFF}
</style>
</head>

<body  oncontextmenu="return false" >
<div class="frmprotocolar">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#132E4A"><table width="924" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="37" height="30" align="center"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="278"><span class="titulosprincipales">Copia de seguridad (Backup)</span></td>
          <td width="609" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="192" height="30">&nbsp;</td>
              <td width="87">&nbsp;</td>
              <td width="17" align="center"><span class="line">|</span></td>
              <td width="158">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><iframe name="copybd" src="seguridad_bd.php" frameborder="0" width="100%" height="800" allowtransparency="true" scrolling="auto"></iframe></td>
    </tr>
  </table>
</div>
</body>
</html>
