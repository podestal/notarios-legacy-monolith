<?php 
include("conexion.php");
$sqlsedess=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 
$sqloporpago=mysql_query("SELECT * FROM oporpago",$conn) or die(mysql_error()); 

?>
<style type="text/css">
<!--
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}
-->
</style>
<table width="680" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="24" height="30">&nbsp;</td>
    <td width="125"><span class="titupatrimo">Partida Registral</span></td>
    <td width="224" height="30"><span class="titupatrimo">
      <input name="textfield5" type="text" id="textfield5" size="20">
    </span></td>
    <td height="30" class="titupatrimo">N° registral</td>
    <td height="30"><span class="titupatrimo">
      <input name="textfield" type="text" id="textfield" size="20">
    </span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><span class="titupatrimo">Sede Registral</span></td>
    <td height="30"><span class="titupatrimo"><select name="idsedereg2" id="idsedereg2">
                        <?php
	       while($rowsedess = mysql_fetch_array($sqlsedess)){
	         echo "<option value=".$rowsedess['idsedereg'].">".$rowsedess['dessede']."</option> \n";
             }
	     ?>
                      </select>
    </span></td>
    <td width="116" height="30"><span class="titupatrimo">Forma de Pago</span></td>
    <td width="191" height="30"><span class="titupatrimo">
      <select name="select2" id="select2">
        <option value="C">CONTADO</option>
        <option value="P">PLAZO</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="30" rowspan="2" class="titupatrimo">&nbsp;</td>
    <td height="30" class="titupatrimo">Oport. de Pago</td>
    <td height="30"><span class="titupatrimo">
      <label></label>
    </span><span class="titupatrimo">
    <select name="oporpago" id="oporpago">
     <?php
	       while($rowopor = mysql_fetch_array($sqloporpago)){

	         echo "<option value=".$rowopor['idoppago'].">".$rowopor['desoppago']."</option> \n";
             }
	     ?>
    </select>
    </span></td>
    <td height="30"><span class="titupatrimo">Origen de Fondos</span></td>
    <td height="30"><span class="titupatrimo">
      <label></label>
      <input name="textfield4" type="text" id="textfield4" size="20">
    </span></td>
  </tr>
  <tr>
    <td height="30" class="titupatrimo">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="30"><img src="iconos/grabar.png" width="94" height="29" /></td>
  </tr>
</table>
