<style type="text/css">
<!--
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}
-->
</style>
<table width="680" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="146" height="30"><span class="titupatrimo">Plazo Inicial</span></td>
    <td width="146" height="30"><span class="titupatrimo">
      <input name="plini" type="text" id="plini" size="20">
    </span></td>
    <td height="30" class="titupatrimo">Plazo Final</td>
    <td height="30"><span class="titupatrimo">
      <input name="plfin" type="text" id="plfin" size="20">
    </span></td>
  </tr>
  <tr>
    <td height="30"><span class="titupatrimo">Bienes</span></td>
    <td height="30"><span class="titupatrimo">
      <label></label>
      <label>
      <input name="radio" type="radio" id="radio" value="Bienes" checked>
      </label>
    </span></td>
    <td width="154" height="30"><span class="titupatrimo">Acciones y Derechos</span></td>
    <td width="234" height="30"><span class="titupatrimo">
      <label></label>
      <input type="radio" name="radio" id="radio2" value="Acciones" />
    </span></td>
  </tr>
  <tr>
    <td height="30"><span class="titupatrimo">Bien-Acto Jurídico</span></td>
    <td height="30"><span class="titupatrimo">
      <label></label>
      <select name="tipobien" id="tipobien">
      </select>
    </span></td>
    <td height="30"><span class="titupatrimo">1era Venta (Si/No)</span></td>
    <td height="30"><span class="titupatrimo">
      <label></label>
      <select name="select3" id="select3">
        <option value="1">SI</option>
        <option value="0">NO</option>
            </select>
    </span></td>
  </tr>
  <tr>
    <td height="30"><span class="titupatrimo">Ubigeo</span></td>
    <td height="30" colspan="2"><input name="ubigens" type="text" id="ubigens" size="45" /></td>
    <td height="30"><a href="#" onclick="mostrar_desc('buscaubis')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubis" style="position:absolute; display:none; width:637px; height:223px; left: 14px; top: 162px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585">Seleccionar Ubigeo:</td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubis')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaubis" type="text" id="buscaubis" size="50" onkeypress="buscaubigeoss()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulubis" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td height="15"><span class="titupatrimo">Fecha de Add. o Cons.</span></td>
    <td height="15"><span class="titupatrimo">
      <label></label>
      <label>
      <input type="text" name="fechaconst" class="tcal" id="fechaconst" />
      </label>
    </span></td>
    <td height="30" align="center">&nbsp;</td>
    <td height="30"><img src="iconos/grabar.png" width="94" height="29" /></td>
  </tr>
  <tr>
    <td height="15">&nbsp;</td>
    <td height="15">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td height="15"><input name="codubis" type="hidden" id="codubis" size="15" /></td>
  </tr>
</table>
