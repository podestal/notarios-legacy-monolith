<style type="text/css">
<!--
.Estilo1 {
	font-family: Calibri;
	font-style: italic;
	font-weight: bold;
	font-size: 16px;
	color: #FF0000;
}
.impedido2 {	font-family: Calibri;
	font-style: italic;
	font-size: 14px;
	color: #FF0000;
}
.impedido {	font-family: Calibri;
	font-weight: bold;
	font-style: italic;
	font-size: 16px;
	color: #FF0000;
}
-->
</style>


<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Razón Social</span></td>
        <td height="30" colspan="3"><input name="apepat" type="text"   style="text-transform:uppercase; color:#FF0000" id="apepat" value="<?php 
		
		
		$textoraz=str_replace("?","'",$row['razonsocial']);
		 $textoamperraz=str_replace("*","&",$textoraz);
		 $textoamperrazz=str_replace("ñ","Ñ",$textoamperraz);
		 echo strtoupper($textoamperrazz);
		
		
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
          </div> <div id="menucondicionk" class="menucondicion" style="display:none; z-index:4;" >
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
    </div>   </td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Domicilio Fiscal</span></td>
        <td height="30" colspan="3"><input name="direccion" type="text" id="direccion"  style="text-transform:uppercase; color:#FF0000;" value="<?php 
		
		$textodom=str_replace("?","'",$row['domfiscal']);
		 $textoamperdom=str_replace("*","&",$textodom);
		 $textoamperdoms=str_replace("ñ","Ñ",$textoamperdom);
		 echo strtoupper($textoamperdoms);
		
		
		 ?>" size="60" /></td>
        <td height="30" ><a onClick="validarcontra()"><img src="iconos/contratante.png" width="120" height="29" border="0" /></a></td>
      </tr>
      <tr>
        <td width="114" height="30" ><span class="camposss">Incluir en el Indice</span></td>
        <td width="143" height="30"><input name="inde" type="checkbox" id="inde" checked="checked" value="1" onclick="mostrarindice(this.checked, this.value)" /></td>
        <td width="93" height="30"><input name="radio2" type="hidden" id="radio" value="0" checked onclick="buttons(0)" />
          <input type="hidden" name="radio3" id="radio3" value="2" onclick="buttons23(2)" />
          <input type="hidden" name="radio" id="radio2" value="1" onclick="buttons23(1)" /></td>
        <td width="174" height="30"><span class="camposss">
          <input type="hidden" name="representaa" id="representaa" />
          <input name="fir" type="hidden" id="fir" onclick="mostrarfirma(this.checked, this.value)" value="0" />
          <input name="codcon" type="hidden" id="codcon" size="20" />
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
          <input type="hidden" name="repre" id="repre" value="0"  />
          <input type="hidden" name="indice" id="indice" value="1" />
         <input name="idsederegerp" type="hidden" id="idsederegerp" size="20" />
          <input name="nparti" type="hidden" id="nparti" size="20" />
                   
        </span></td>
        <td width="126" height="30" align="center" >&nbsp;</td>
      </tr>
      
      <tr>
        <td height="30" colspan="5" ><span class="impedido">ESTA PERSONA ESTA IMPEDIDA DE CONTRATAR</span></td>
        </tr>
      <tr>
        <td height="30" colspan="5" ><table width="642" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td width="180"><span class="impedido2">
              <?php  echo $row['impeingre']; ?>
            </span></td>
            <td width="58">&nbsp;</td>
            <td width="309"><span class="impedido2">
              <?php  echo $row['impeorigen']; ?>
            </span></td>
          </tr>
          <tr>
            <td width="95">&nbsp;</td>
            <td colspan="3"><span class="impedido2">
              <?php  echo $row['impmotivo']; ?>
              </span></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>

