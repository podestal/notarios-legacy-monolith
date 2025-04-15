<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/all.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tipo de Contratante</title>
<style type="text/css">

</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="frmcontratante" name="frmcontratante" method="post" action="grabar_tipo_contratante">
<table width="716" border="0">
  <tr>
    <td colspan="5" class="titulo">Tipo de Contratante<img src="img/Linea separadora.gif" width="658" height="16" longdesc="img/Linea separadora.gif" /></td>
  </tr>
  <tr>
    <td width="238">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="287" colspan="2" rowspan="5"><div align="left"><img src="img/Contratante.jpg" width="244" height="119" longdesc="img/Contratante.jpg" /></div>
      <div align="center"></div></td>
    </tr>
  <tr>
    <td height="24"><div align="right" class="lblayuda">Descripción del Contratante</div></td>
    <td colspan="2">
      <span id="sprytextfield1">
        <label>
          <input type="text" name="des_contra" class="lbl" id="des_contra" />
        </label>
      <span class="textfieldRequiredMsg">Ingresar valor.</span></span>    </td>
    </tr>
  <tr>
    <td class="lblayuda"><div align="center"></div></td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td class="lblayuda"><div align="right">Tipo de Kardex</div></td>
    <td colspan="2"><span id="sprytextfield2">
      <label>
      <input type="text" name="tip_karx" id="tip_karx" />
      </label>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="90"><label>
      <input type="submit" name="btn_grabar" class="btn" id="btn_grabar" value="Grabar" />
    </label></td>
    <td width="83"><input type="submit" name="btn_cancelar" class="btn" id="btn_cancelar" value="Cancelar" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="287" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="287" colspan="2">&nbsp;</td>
  </tr>
</table>

</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
</body>
</html>
