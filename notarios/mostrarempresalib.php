<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Razón Social</span></td>
        <td height="30" colspan="3"><input name="empresa2" type="text"  style="text-transform:uppercase"   id="empresa2" value="<?php $textoraz=str_replace("?","'",$row['razonsocial']);
		 $textoamperraz=str_replace("*","&",$textoraz);
		 echo strtoupper($textoamperraz); ?>" size="60" readonly="readonly" />
         
         <input name="empresa" type="hidden"  style="text-transform:uppercase"   id="empresa" value="<?php echo strtoupper($row['razonsocial']); ?>" size="60" />
         </td>
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
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
        <td height="30" colspan="3"><input name="direccion2"  style="text-transform:uppercase" type="text" id="direccion2" value="<?php $textodom=str_replace("?","'",$row['domfiscal']);
		 $textoamperdom=str_replace("*","&",$textodom);
		 echo strtoupper($textoamperdom); ?>" size="60" readonly="readonly"/>
         
         <input name="direccion"  style="text-transform:uppercase" type="hidden" id="direccion" value="<?php  echo strtoupper($row['domfiscal']); ?>" size="60" />
         </td>
        <td height="30" >
         <!-- VALIDACION DE DATOS : -->
        	
        <input type="hidden" name="eval_codubi"  id="eval_codubi" value="<?php echo strtoupper($row['idubigeo']); ?>" />
        <input type="hidden" name="eval_actmunicipal"  id="eval_actmunicipal" value="<?php echo strtoupper($row['actmunicipal']); ?>" />
         <!-- --------------------- --> 
        
        </td>
      </tr>
      <tr>
        <td width="112" height="30" ><span class="camposss">
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   /><input type='hidden' name='apepat' style='text-transform:uppercase'   id='apepat' value='' /><input type='hidden' name='apemat' style='text-transform:uppercase'   id='apemat' value='' /><input type='hidden' name='prinom' style='text-transform:uppercase'   id='prinom' value='' /><input type='hidden' name='segnom' style='text-transform:uppercase'   id='segnom' value='' /><input type='hidden' name='idubigeo' id='idubigeo'  value='<?php echo $row['idubigeo']; ?>' />
          </span></td>
        <td width="145" height="30">&nbsp;</td>
        <td width="93" height="30">&nbsp;</td>
        <td width="174" height="30">&nbsp;</td>
        <td width="126" height="30" >&nbsp;</td>
      </tr>
      
    </table></td>
  </tr>
</table>

