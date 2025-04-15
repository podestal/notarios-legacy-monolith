
<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Razón Social</span></td>
        <td height="30"><input name="apepat" type="text"  style="text-transform:uppercase"   id="apepat" value="<?php echo $row['razonsocial']; ?>" size="60" /></td>
        <td height="30" ><div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
          </div>   <input type="hidden" name="docum" style="text-transform:uppercase" id="docum" value="<?php echo strtoupper($row['numdoc']); ?>" /> </td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Domicilio Fiscal</span></td>
        <td height="30"><input name="direccion"  style="text-transform:uppercase" type="text" id="direccion" value="<?php echo $row['domfiscal']; ?>" size="60" /></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="112" height="30" ><span class="camposss">Telefono</span></td>
        <td height="30"><input name="tel_empresa"  style="text-transform:uppercase" type="text" id="tel_empresa" value="<?php echo $row['telempresa']; ?>" size="20" /></td>
        <td width="126" height="30" >&nbsp;</td>
      </tr>
      
      <tr>
        <td height="30" colspan="3" ><span class="camposss">
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
          </span></td>
      </tr>
    </table></td>
  </tr>
</table>

