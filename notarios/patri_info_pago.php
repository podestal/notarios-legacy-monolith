<?php 
include("conexion.php");
$codkardex=$_POST['cokardex'];
$sqlxxx=mysql_query("SELECT * FROM detalle_actos_kardex where kardex='$codkardex'",$conn) or die(mysql_error()); 
$sqlmon=mysql_query("SELECT * FROM monedas",$conn) or die(mysql_error()); 
$sqltpago=mysql_query("SELECT * FROM tipopago",$conn) or die(mysql_error()); 
$sqlbancos=mysql_query("SELECT * FROM bancos",$conn) or die(mysql_error()); 
?>

<style type="text/css">
<!--
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}
-->
</style>
<table width="680" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="24" height="30">&nbsp;</td>
    <td width="156"><span class="titupatrimo">Tipo de Acto:</span></td>
    <td width="205" height="30"><span class="titupatrimo">
      <select name="tipoacto2" id="tipoacto2">
       <?php
	       while($rowdetaacto = mysql_fetch_array($sqlxxx)){

	         echo "<option value=".$rowdetaacto['idtipoacto'].">".$rowdetaacto['desacto']."</option> \n";
             }
	     ?>
        </select>
    </span></td>
    <td height="30" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><span class="titupatrimo">Tipo Moneda</span></td>
    <td height="30"><span class="titupatrimo">
      <label>
      <select name="tipomoneda" id="tipomoneda">
       <?php
	       while($rowmoneda = mysql_fetch_array($sqlmon)){

	         echo "<option value=".$rowmoneda['idmon'].">".$rowmoneda['desmon']."</option> \n";
             }
	     ?>
      </select>
      </label>
    </span></td>
    <td width="151" height="30"><span class="titupatrimo">Tipo de Cambio</span></td>
    <td width="144" height="30"><span class="titupatrimo">
      <label>
      <input name="tipcambio" type="text" id="tipcambio" size="20">
      </label>
    </span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><span class="titupatrimo">Importe Transaccional</span></td>
    <td height="30"><span class="titupatrimo">
      <label>
      <input name="imptrans" type="text" id="imptrans" size="20">
      </label>
    </span></td>
    <td height="30"><span class="titupatrimo">Importe Efectivo</span></td>
    <td height="30"><span class="titupatrimo">
      <label>
      <input name="impefectivo" type="text" id="impefectivo" size="20">
      </label>
    </span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><span class="titupatrimo">Medio de Pago</span></td>
    <td height="30"><span class="titupatrimo">
      <select name="mediopago" id="mediopago">
       <?php
	       while($rowtpago = mysql_fetch_array($sqltpago)){

	         echo "<option value=".$rowtpago['idtipopago'].">".$rowtpago['destipopago']."</option> \n";
             }
	     ?>
      </select>
    </span></td>
    <td height="30"><span class="titupatrimo">Importe Medio de Pago</span></td>
    <td height="30"><span class="titupatrimo">
      <label>
      <input name="impmediopago" type="text" id="impmediopago" size="20">
      </label>
    </span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><span class="titupatrimo">Entidad Financiera</span></td>
    <td height="30" colspan="3"><span class="titupatrimo">
      <select name="entidadfinanciera" id="entidadfinanciera">
      <?php
	       while($rowbanco = mysql_fetch_array($sqlbancos)){

	         echo "<option value=".$rowbanco['idbancos'].">".$rowbanco['desbanco']."</option> \n";
             }
	     ?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><span class="titupatrimo">Fecha de Operación</span></td>
    <td height="30" colspan="2"><span class="titupatrimo">
      <label></label>
      <input name="fechaoperacion" type="text" id="fechaoperacion" class="tcal" size="20" />
    </span></td>
    <td height="30"><span class="titupatrimo">
      <label></label>
      <img src="iconos/grabar.png" width="94" height="29" /></span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><span class="titupatrimo">Documentos</span></td>
    <td height="30" colspan="2"><span class="titupatrimo">
      <input name="documentos" type="text" id="documentos" size="50" />
    </span></td>
    <td height="30">&nbsp;</td>
  </tr>
</table>
