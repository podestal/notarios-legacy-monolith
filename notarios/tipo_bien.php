<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/all.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tipo de Bien</title>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

</head>

<body>
<form id="frmbien" name="frmbien" method="post" action="http://jvwebdesigner.com/fernando/notarios/grabar_tipo_bien.php">
<table width="859" border="0">
  <tr>
    <td colspan="5" class="titulo">Tipo de Bien<img src="img/Linea separadora.gif" width="849" height="20" longdesc="img/Linea separadora.gif" /></td>
  </tr>
  <tr>
    <td width="190">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="510" colspan="2" rowspan="6"><div align="left"></div>
      <div align="left"><img src="img/avion.png" width="250" height="177" longdesc="img/avion.png" />      </div>
      <div align="left"></div></td>
    </tr>
  <tr>
    <td height="24" class="lblayuda"><div align="right">Código de Bien</div></td>
    <td colspan="2">
      <span id="sprytextfield1">
        <label>
          <input type="text" name="cod_bien" class="lbl" id="cod_bien" />
        </label>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>    </td>
    </tr>
  <tr>
    <td class="lblayuda"><div align="center"></div></td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td class="lblayuda"><div align="right">Descripción del Tipo de Bien</div></td>
    <td colspan="2"><span id="sprytextfield2">
      <label>
      <input type="text" name="des_Tipobien" class="lbl" id="des_Tipobien"/>
      </label>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><label></label></td>
    </tr>
  <tr>
    <td height="71">&nbsp;</td>
    <td width="97"><input name="btn_grabar" type="submit" class="btn" id="btn_grabar" value="Grabar" /></td>
    <td width="106"><input type="submit" name="btn_cancelar" class="btn" id="btn_cancelar" value="Cancelar" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="510" colspan="2">&nbsp;</td>
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
