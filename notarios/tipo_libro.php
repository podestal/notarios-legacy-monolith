<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/all.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">

</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="frmlibro" name="frmlibro" method="post" action="grabar_tipo_libro">
<table width="660" border="0">
  <tr>
    <td colspan="5" class="titulo">Tipo de Libro      <img src="img/Linea separadora.gif" width="658" height="16" longdesc="img/Linea separadora.gif" /></td>
  </tr>
  <tr>
    <td width="232">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="247" colspan="2" rowspan="5"><div align="left"></div>
      <div align="center"><img src="img/libros.png" width="128" height="128" longdesc="img/libros.png" /></div></td>
    </tr>
  <tr>
    <td height="24"><div align="right"><span class="lblayuda">Código de Libro</span></div></td>
    <td colspan="2">
      <span id="sprytextfield1">
        <label>
          <input type="text" name="cod_libro" class="lbl" id="cod_libro" />
        </label>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>    </td>
    </tr>
  <tr>
    <td class="lblayuda"><div align="center"></div></td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td class="lblayuda"><div align="right">Denominación de Libro</div></td>
    <td colspan="2">
      <span id="sprytextfield2">
        <label>
          <input type="text" name="deno_libro" class="lbl" id="deno_libro" />
        </label>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><label></label></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="84"><input type="submit" name="btn_grabar" id="btn_grabar" class="btn" value="Grabar" /></td>
    <td width="83"><input type="submit" name="btn_cancelar" id="btn_cancelar" class="btn" value="Cancelar" /></td>
    <td width="247" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="247" colspan="2">&nbsp;</td>
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
