<?php 
include("../conexion.php");
require("../funciones.php");
$conexion = Conectar();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISGEN</title>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<style type="text/css">
div.frmprotocolar
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:400px;
}

.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}
</style>
</head>

<body>
<div class="frmprotocolar">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">KARDEX PENDIENTES DE ENVIO</span></td>
          <td width="510" align="left">&nbsp;</td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><form id="form1" name="form1" method="post" action="grabarnotario.php">
        <table width="740" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="36" align="LEFT" colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>SELECCIONE KARDEX A ENVIAR</strong></span></td>
            </tr>
          
        </table>
      </form></td>
    </tr>
  </table>
</div>
</body>
</html>
