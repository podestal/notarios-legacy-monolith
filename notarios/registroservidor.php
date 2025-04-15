<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
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
width:900px; height:220px;
}

.titulosprincipales {
	font-family: Verdana;
	font-size: 16px;
	color: #F90;

}
.line {color: #FFFFFF}
</style>
</head>

<body>
<div class="frmprotocolar">
  <table width="900"  height="228" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="iconos/newproto.png" width="34" height="30" /></td>
          <td width="328"><span class="titulosprincipales">Registro del servidor</span></td>
          <td width="510" align="left">&nbsp;</td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td height="179" align="center"><form id="form1" name="form1" method="post" action="grabarservidor.php">
        <table width="750" height="167" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="36" colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>Ingrese nombre del servidor</strong></span></td>
            </tr>
          <tr>
            <td width="94">&nbsp;</td>
            <td width="226">&nbsp;</td>
            <td width="18">&nbsp;</td>
            <td width="165">&nbsp;</td>
            <td width="156">&nbsp;</td>
            <td width="81">&nbsp;</td>
          </tr>
          <tr>
            <td height="31"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;">Servidor</span></td>
            <td colspan="4"><input type="text" class="texto" style="text-transform:uppercase;"   name="nombre" id="nombre"  size="50" value=""  /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31">&nbsp;</td>
            <td colspan="4">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="31">&nbsp;</td>
            <td colspan="4"><button type="submit" class="std_button" name="button" id="button">Grabar</button></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="19">&nbsp;</td>
            <td colspan="4">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>
</body>
</html>