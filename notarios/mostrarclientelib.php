<table width="674" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="653"><table width="647" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="159" height="30"><input type="text" name="apepat2" style="text-transform:uppercase"   id="apepa2t" readonly="readonly" value="<?php 
		$textorpat=str_replace("?","'",$row['apepat']);
		 $textoamperpat=str_replace("*","&",$textorpat);
		 echo strtoupper($textoamperpat);
		
		 ?>" />
         <input type="hidden" name="apepat" style="text-transform:uppercase"   id="apepat" value="<?php echo strtoupper($row['apepat']); ?>" />
         
         </td>
        <td width="95" height="30" ><span class="camposss">Ape. Materno</span></td>
        <td width="163" height="30" ><input type="text" name="apemat2" style="text-transform:uppercase" readonly="readonly" id="apemat2" value="<?php 
		
		$textormat=str_replace("?","'",$row['apemat']);
		 $textoampermat=str_replace("*","&",$textormat);
						  echo strtoupper($textoampermat);
		 ?>" />
         
         <input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" value="<?php  echo strtoupper($$row['apemat']);  ?>" />
         
         </td>
        <td width="127" height="30" >
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
          </div>    <div id="menucondicionk" class="menucondicion" style="display:none; z-index:4;" >
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
    </div></td>
        </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input type="text" name="prinom2" readonly="readonly" style="text-transform:uppercase" id="prinom2" value="<?php 
		
		$textorpri=str_replace("?","'",$row['prinom']);
		 $textoamperpri=str_replace("*","&",$textorpri);
						  echo strtoupper($textoamperpri);
		
		
		 ?>" />
         
         <input type="hidden" name="prinom" style="text-transform:uppercase" id="prinom" value="<?php echo strtoupper($$row['prinom']); ?>" />
         
         </td>
        <td height="30" ><span class="camposss">2do Nombre</span></td>
        <td height="30" ><input type="text" name="segnom2" readonly="readonly" style="text-transform:uppercase" id="segnom2" value="<?php 
		
		$textorseg=str_replace("?","'",$row['segnom']);
		 $textoamperseg=str_replace("*","&",$textorseg);
		 echo strtoupper($textoamperseg);
		
		 ?>"  />
         
         
         <input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" value="<?php  echo strtoupper($row['segnom']); ?>"  />
         </td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="103" height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3">
          <input name="direccion2" readonly="readonly" type="text" style="text-transform:uppercase" id="direccion2" value="<?php 
		  
		   $textordir=str_replace("?","'",$row['direccion']);
		 $textoamperdir=str_replace("*","&",$textordir);
		 echo strtoupper($textoamperdir);
		  
		   ?>" size="60" > 
           
           <input name="direccion" type="hidden" style="text-transform:uppercase" id="direccion" value="<?php echo strtoupper($row['direccion']); ?>" size="60" >
           
           
           
                  </td>
        <td height="30" >
        

        </td>
      </tr>
      <tr>
        <td height="30" colspan="5" ><table width="527" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="527"><label><span class="camposss">
              <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   /><input type='hidden' name='idubigeo' id='idubigeo'  value='<?php echo $row['idubigeo']; ?>' /><input name='empresa' type='hidden'   id='empresa' />
              </span></label></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>


