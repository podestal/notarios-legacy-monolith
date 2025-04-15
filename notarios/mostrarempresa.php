
<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Razón Social</span></td>
        <td height="30" colspan="3"><input name="apepat" type="text"  style="text-transform:uppercase"   id="apepat" value="<?php 
		
		$textoraz=str_replace("?","'",$row['razonsocial']);
		 $textoamperraz=str_replace("*","&",$textoraz);
		 echo strtoupper($textoamperraz);
		
		 ?>" size="60" /></td>
        <td height="30" ><a onClick="validar2()"><img src="iconos/condicion.png" width="60" height="29" border="0" /></a><a onClick="validarquit()"><img src="iconos/condicion2.png" width="60" height="29" border="0" /></a>
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
          </div><div id="menucondicionk" class="menucondicion" style="display:none; z-index:4;" >
                                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="16">&nbsp;</td>
                                          <td width="180"><span class="titulomenuacto">Quitar Condición(es)</span></td>
                                        </tr>
                                    </table></td>
                                    <td width="45" align="right" valign="middle">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25">&nbsp;</td>
    <td width="725"><div id="tipocondicionk" class="tipoacto" style="overflow:auto;"></div></td>
  </tr>
</table></td>
                                  </tr>
                                  <tr>
                                    <td width="620" height="10">&nbsp;</td>
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicionk')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
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
        <td height="30" ><span class="camposss">Domicilio Fiscal</span></td>
        <td height="30" colspan="3"><input name="direccion"  style="text-transform:uppercase" type="text" id="direccion" value="<?php 
		
		$textodom=str_replace("?","'",$row['domfiscal']);
		 $textoamperdom=str_replace("*","&",$textodom);
		 echo strtoupper($textoamperdom);
		
		
		 ?>" size="60" /></td>
        <td height="30" ><a onClick="validarcontra()"><img src="iconos/contratante.png" width="120" height="29" border="0" /></a></td>
      </tr>
      <tr>
        <td width="112" height="30" ><span class="camposss">Incluir en el Indice</span></td>
        <td width="145" height="30"><input name="inde" type="checkbox" id="inde" checked="checked" value="1" onclick="mostrarindice(this.checked, this.value)" /></td>
        <td width="93" height="30">&nbsp;</td>
        <td width="174" height="30">&nbsp;</td>
        <td width="126" height="30" >&nbsp;</td>
      </tr>
      
      <tr>
        <td height="30" colspan="5" ><span class="camposss">
          <label>
            <input type="hidden" name="indice" id="indice" value="1" />
            </label>
          <label>
          <input type="hidden" name="repre" id="repre" value="0"  />
          </label>
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
          <input name="codcon" type="hidden" id="codcon" size="20" />
          <input name="inscrito" type="hidden" id="inscrito" size="20" />
          <input name="idsederegerp" type="hidden" id="idsederegerp" size="20" />
          <input name="nparti" type="hidden" id="nparti" size="20" />
          <input name="firma" type="hidden" id="firma" onclick="mostrarfirma(this.checked, this.value)" value="0" />
          <input type="hidden" name="representaa" id="representaa" />
          
        </span></td>
        </tr>
      <tr>
        <td height="30" colspan="5" ><table width="650" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="172">
<input name="radio" type="radio" id="radio" value="0" checked onclick="buttons(0)" /><span class="camposss">Derecho Propio</span></td>
            <td width="159"><input type="radio" name="radio" id="radio2" value="1" onclick="buttons23(1)" />
              <div id="representante" class="representante" style="display:none; z-index:2;" >
                  <table width="604" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="201" height="29" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16">&nbsp;</td>
                            <td width="180"><span class="titulomenuacto">Contratantes</span></td>
                          </tr>
                      </table></td>
                      <td width="403" align="right" valign="middle">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2"><div id="contratan" class="allcontrata"></div></td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2"><table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="69"><span class="titulomenuacto">Facultades:</span></td>
                          <td width="531"><label>
                            <input name="facultades" type="text" id="facultades" size="70" />
                          </label></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" valign="middle"></td>
                    </tr>
                  </table>
                </div><span class="camposss"> Representante</span></td>
            <td width="309"><input type="radio" name="radio" id="radio3" value="2" onclick="buttons23(2)" /><span class="camposss">Por Derecho Propio y Representación</span></td>
            </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>

