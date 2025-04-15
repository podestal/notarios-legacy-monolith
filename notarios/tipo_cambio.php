<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/all.css" rel="stylesheet" type="text/css"/>
<script language='javascript' src="popcalendar.js"></script> 
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tipo de cambio</title>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>

  <form id="frmcambio" name="frmcambio" method="post" action="http://jvwebdesigner.com/fernando/notarios/grabar_tipo_cambio.php">
  <table width="588" border="0">
    <tr>
      <td colspan="5" class="titulo">Tipo de Cambio<img src="img/Linea separadora.gif" width="658" height="16" longdesc="img/Linea separadora.gif" /></td>
    </tr>
    <tr>
      <td width="193">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td width="248" colspan="2" rowspan="5"><div align="left"></div>
          <div align="left"><img src="img/dolar.jpg" width="113" height="125" longdesc="img/dolar.jpg" /></div></td>
    </tr>
    <tr>
      <td height="24" class="lblayuda"><div align="right">Tipo de Cambio</div></td>
      <td colspan="2"><span id="sprytextfield1">
        <label>
        <input type="text" name="tip_cambio" class="lbl" id="tip_cambio" />
        </label>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span> </td>
    </tr>
    <tr>
      <td class="lblayuda">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td height="46" class="lblayuda"><div align="right">Fecha</div></td>
      <td colspan="2"><span id="sprytextfield2">
        <input name="fecha" class="lbl" type="text"  id="dateArrival" onclick="popUpCalendar(this, frmcambio.dateArrival, 'dd.mm.yyyy');"/>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><label></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="85"><input type="submit" name="btn_grabar" class="btn" id="btn_grabar" value="Grabar" /></td>
      <td width="120"><input type="submit" name="btn_cancelar" class="btn" id="btn_cancelar" value="Cancelar" /></td>
      <td width="248" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td width="248" colspan="2">&nbsp;</td>
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
