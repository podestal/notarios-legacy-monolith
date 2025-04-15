<?php 
date_default_timezone_set("America/Lima");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<title>Documento sin título</title>
</head>

<body  oncontextmenu="return false" >
<table width="635" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19">&nbsp;</td>
    <td width="616" colspan="3"><span style="font-family:Verdana, Geneva, sans-serif; font-size:22px; color:#036;">Backup</span></td>
  </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td colspan="3"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#333;">Para crear una copia de seguridad completa de la base de datos da click en el boton <strong>Generar Backup</strong></span></td>
  </tr>
  <tr>
    <td height="41">&nbsp;</td>
    <td colspan="3" align="center"><input type="button" name="button" id="button" value="Generar Backup" style="width:150px; height:50px; font-family:Verdana, Geneva, sans-serif; font-size:15px; background:#036; color:#FFF" onClick="generar_backup();"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><hr size="2px" color="black"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><div id="resu_backup" style="width:616px; height:300px;"></div></td>
  </tr>
</table>
<