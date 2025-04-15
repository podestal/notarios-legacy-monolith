
<table width="674" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="653"><table width="647" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="159" height="30"><input type="text" name="apepat" style="text-transform:uppercase"   id="apepat" value="<?php 
		
		$textorpat=str_replace("?","'",$row['apepat']);
		 $textoamperpat=str_replace("*","&",$textorpat);
		 echo strtoupper($textoamperpat);
		?>" /></td>
        <td width="95" height="30" ><span class="camposss">Ape. Materno</span></td>
        <td width="163" height="30" ><input type="text" name="apemat" style="text-transform:uppercase" id="apemat" value="<?php 
		
		$textormat=str_replace("?","'",$row['apemat']);
		 $textoampermat=str_replace("*","&",$textormat);
						  echo strtoupper($textoampermat);
		
		 ?>" /></td>
        <td width="127" height="30" ><a onClick="validar2()"><img src="iconos/condicion.png" width="60" height="29" border="0" /></a><a onClick="validarquit()"><img src="iconos/condicion2.png" width="60" height="29" border="0" /></a>
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
    </div></td>
        </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input type="text" name="prinom" style="text-transform:uppercase" id="prinom" value="<?php
		
		
		$textorpri=str_replace("?","'",$row['prinom']);
		 $textoamperpri=str_replace("*","&",$textorpri);
						  echo strtoupper($textoamperpri);
		
		  ?>" /></td>
        <td height="30" ><span class="camposss">2do Nombre</span></td>
        <td height="30" ><input type="text" name="segnom" style="text-transform:uppercase" id="segnom" value="<?php
		
		$textorseg=str_replace("?","'",$row['segnom']);
		 $textoamperseg=str_replace("*","&",$textorseg);
						  echo strtoupper($textoamperseg);
		
		  ?>"  /></td>
        <td height="30" ><a onClick="validarcontra()"><img src="iconos/contratante.png" width="120" height="29" border="0" /></a></td>
      </tr>
      <tr>
        <td width="103" height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3">
          <input name="direccion" type="text" style="text-transform:uppercase" id="direccion" value="<?php 
		  
		   $textordir=str_replace("?","'",$row['direccion']);
		 $textoamperdir=str_replace("*","&",$textordir);
		 echo strtoupper($textoamperdir);
		  
		 ?>" size="60" >        </td>
        <td height="30" ><a href="#" onclick="clienteeditado()"><img src="iconos/editacontratantes.png" width="120" height="29" border="0" /></a></td>
      </tr>
      <tr>
        <td height="30" colspan="5" ><table width="632" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="51"><span class="camposss">Firma</span></td>
            <td width="45"><input name="fir" type="checkbox" id="fir" onClick="mostrarfirma(this.checked, this.value)" value="1" checked="checked" /></td>
            <td width="128"><span class="camposss">Incluir en el Indice</span></td>
            <td width="40"><label>
              <input name="inde" type="checkbox" id="inde" checked="checked" value="1" onClick="mostrarindice(this.checked, this.value)" />
              </label></td>
            <td width="368"><div id="inscri" style="display:;">
          
        </div></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="30" colspan="5" ><div id="validarrepre" style="display:none">
          <table width="650" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30"><span class="camposss">Tipo de Representación: </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="172"><input name="radio" type="radio" id="radio" value="0" checked="checked" onclick="buttons(0)" />
                <span class="camposss">Derecho Propio</span></td>
              <td width="159"><input type="radio" name="radio" id="radio2" value="1" onclick="buttons23(1)" />
                <span class="camposss">Representante</span>
                <div id="representante" class="representante" style="display:none; z-index:2;" >
                  <table width="604" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="201" height="29" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="16">&nbsp;</td>
                          <td width="180"><span class="titulomenuacto">Contratantes</span></td>
                        </tr>
                      </table></td>
                      <td width="403" align="right" valign="middle"><a href="#" onclick="ocultar_desc('representante')"><img src='iconos/cerrar.png' width='21' height='20' border='0' /></a></td>
                    </tr>
                    <tr>
                     <td height="25" colspan="2"><table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="72"><span class="titulomenuacto">Facultades:</span></td>
                          <td width="293"><label>
                            <input name="facultades" type="text" id="facultades" style="text-transform:uppercase;" size="40" />
                          </label></td>
                          <td width="63"><span class="titulomenuacto">Inscrito:</span></td>
                          <td width="172"><select name="inscrito" id="inscrito">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                          &nbsp;</select></td>
                      
                       </tr>
                       <tr>
                          <td height="8" colspan="4"><div id="verinscrit" style="display:; height:30px;">
                            <table width="584" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="102"><span class="titulomenuacto">Sede Registral:</span></td>
                                <td width="171"><select name="idsederegerp" id="idsederegerp">
                      <option selected="selected" value="0">SELECCIONAR</option>
                        <?php
                           $sqlregrp=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 
                           while($rowsederegrp = mysql_fetch_array($sqlregrp)){
                             echo "<option value=".$rowsederegrp['idsedereg'].">".$rowsederegrp['dessede']."</option> \n";
                             }
                         ?>
                      </select>
      </td>
                                <td width="70"><span class="titulomenuacto">N° Partida:</span></td>
                                <td width="241">
                                <input name="nparti" type="text" id="nparti" size="10" maxlength="15"></td>
                              </tr>
                            </table>
                          </div></td>
                       </tr>
                       <tr>
                     <td height="25" colspan="4"><div id="contratan" class="allcontrata"></div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" valign="middle"></td>
                    </tr>
                  </table>
                </div></td>
              <td width="309"><input type="radio" name="radio" id="radio3" value="2" onclick="buttons23(2)" />
                <span class="camposss">Por Derecho Propio y Representación</span></td>
            </tr>
          </table>
        </div>
          <span class="camposss">
          <input type="hidden" name="firma" id="firma" value="1" />
          </span><span class="camposss">
          <input type="hidden" name="indice" id="indice" value="1" />
          </span><span class="camposss">
          <input type="hidden" name="repre" id="repre" value="0"  />
          </span><span class="camposss">
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
          </span>
          <input name="codcon" type="hidden" id="codcon" size="20" />
          <input type="hidden" name="representaa" id="representaa" />
          <input type="hidden" name="valorinscrito" id="valorinscrito" value="1" />
          <input type="hidden" name="eval_codubis"  id="eval_codubis" value="<?php echo strtoupper($row['idubigeo']); ?>" />
         <input type="hidden" name="eval_idestcivil"  id="eval_idestcivil" value="<?php echo strtoupper($row['idestcivil']); ?>" />
         <input type="hidden" name="eval_sexo"  id="eval_sexo" value="<?php echo strtoupper($row['sexo']); ?>" />
         <input type="hidden" name="eval_idprofesion"  id="eval_idprofesion" value="<?php echo strtoupper($row['idprofesion']); ?>" />
          </td>
      </tr>
    </table></td>
  </tr>
</table>


