<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/all.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tipo de Folio</title>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="frmfolio" name="frmfolio" method="post" action="grabar_tipo_folio">
<table width="588" border="0">
  <tr>
    <td colspan="4" class="titulo">Tipo de Folio<img src="img/Linea separadora.gif" width="658" height="16" longdesc="img/Linea separadora.gif" /></td>
  </tr>
  <tr>
    <td width="179">&nbsp;</td>
    <td width="185">&nbsp;</td>
    <td width="286" colspan="2" rowspan="6"><div align="left"></div>
      <div align="left"></div>      
      <div align="left"><img src="img/folio.png" width="166" height="150" longdesc="img/folio.png" /></div></td>
    </tr>
  <tr>
    <td height="24" class="lblayuda"><div align="right">Descripción del Folio</div></td>
    <td>
      <span id="sprytextfield1">
        <label>
          <input type="text" name="des_folio" class="lbl" id="des_folio" />
        </label>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>    </td>
    </tr>
  <tr>
    <td class="lblayuda">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td class="lblayuda">&nbsp;</td>
    <td>
      <span id="sprytextfield2">
        <label></label>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>    <input type="submit" name="btn_grabar" class="btn" id="btn_grabar" value="Grabar" />
        <input type="submit" name="btn_cancelar" class="btn" id="btn_cancelar" value="Cancelar" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label></label></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="286" colspan="2">&nbsp;</td>
  </tr>
</table>

<div align="left"></div>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
</body>
</html>
