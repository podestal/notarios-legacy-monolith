<style>
.impedido {
	font-family: Calibri;
	font-weight: bold;
	font-style: italic;
	font-size: 16px;
	color: #FF0000;
}
.impedido2 {
	font-family: Calibri;
	font-style: italic;
	font-size: 14px;
	color: #FF0000;
}
</style>
<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="163" height="30"><input type="text" name="apepat"  style="text-transform:uppercase; color:#FF0000;"   id="apepat" value="<?php echo $row['apepat']; ?>" /></td>
        <td width="99" height="30" ><span class="camposss">Ape. Materno</span></td>
        <td width="168" height="30" ><input type="text" name="apemat" style="text-transform:uppercase; color:#FF0000;" id="apemat" value="<?php echo $row['apemat']; ?>" /></td>
        <td height="30" ><a onClick="validar2()"><img src="iconos/condicion.png" width="120" height="29" border="0" /></a>
    <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
                                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="16">&nbsp;</td>
                                          <td width="180"><span class="titulomenuacto">Seleccione Condición(es)</span></td>
                                        </tr>
                                    </table></td>
                                    <td width="45" align="right" valign="middle">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25">&nbsp;</td>
    <td width="725"><div id="tipocondicion" class="tipoacto" style="overflow:auto;"></div></td>
  </tr>
</table></td>
                                  </tr>
                                  <tr>
                                    <td width="620" height="10">&nbsp;</td>
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion');mostrar_desc('validarrepre')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
          </div>    </td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input type="text" name="prinom" style="text-transform:uppercase; color:#FF0000;"  id="prinom" value="<?php echo $row['prinom']; ?>" /></td>
        <td height="30" ><span class="camposss">2do Nombre</span></td>
        <td height="30" ><input type="text" name="segnom" id="segnom" style="text-transform:uppercase; color:#FF0000;" value="<?php echo $row['segnom']; ?>"  /></td>
        <td height="30" ><a onClick="validarcontra()"><img src="iconos/contratante.png" width="120" height="29" border="0" /></a></td>
      </tr>
      <tr>
        <td width="94" height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3">
          <input name="direccion" type="text" id="direccion" style="text-transform:uppercase; color:#FF0000;" value="<?php echo $row['direccion']; ?>" size="65" >        </td>
        <td width="126" height="30" align="center" ><a href="#" onclick="clienteeditado()"><img src="iconos/editacontratantes.png" width="120" height="29" border="0" /></a></td>
      </tr>
      <tr>
        <td height="30" colspan="5" ><table width="632" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="94"><span class="camposss">Firma</span></td>
            <td width="187"><input name="fir" type="checkbox" id="fir" onClick="mostrarfirma(this.checked, this.value)" value="1" checked="checked" />
              <span class="camposss">
              <input type="hidden" name="firma" id="firma" value="1" />
              <input type="hidden" name="indice" id="indice" value="1" />
              <input type="hidden" name="repre" id="repre" value="0"  />
              <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
              <input type="hidden" name="representaa" id="representaa" />
              <input name="codcon" type="hidden" id="codcon" size="20" />
              </span></td>
            <td width="132"><span class="camposss">Incluir en el Indice</span></td>
            <td width="75"><label>
              <input name="inde" type="checkbox" id="inde" checked="checked" value="1" onClick="mostrarindice(this.checked, this.value)" />
            </label></td>
            <td width="144"><label><span class="impedido">IMPEDIDO</span></label></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="30" colspan="5" ><table width="642" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span class="camposss">Fecha Ingreso:</span></td>
            <td width="211"><span class="impedido2">
              <?php  echo $row['impeingre']; ?>
              </span></td>
            <td width="55"><span class="camposss">Origen:</span></td>
            <td width="281"><span class="impedido2">
              <?php  echo $row['impeorigen']; ?>
              </span></td>
            </tr>
          <tr>
            <td width="95"><span class="camposss">Motivo:</span></td>
            <td colspan="3"><span class="impedido2"><?php  echo $row['impmotivo']; ?></span></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>

