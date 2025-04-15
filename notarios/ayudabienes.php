<div id="vbien" style="display:">
                                            <table width="710" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18">&nbsp;</td>
                                                <td width="692"><img src="iconos/biennes.png" alt="" width="181" height="25" border="0" usemap="#Map2" /></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newbiennnes" style="display:">
                                                  <table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                      </tr>
                                                      <tr>
                                                        <td width="135" height="30"><span class="titupatrimo">Tipo</span></td>
                                                        <td width="208" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                          <label>
                                                          <select name="tipob" id="tipob">
                                                            <option value="" selected="selected">SELECCIONAR </option>
                                                            <option value="BIENES">BIENES</option>
                                                            <option value="ACCIONES Y DERECHOS">ACCIONES Y DERECHOS</option>
                                                          </select>
                                                          </label>
                                                        </span></td>
                                                        <td width="118" height="30"><span class="titupatrimo">Partida Registral</span></td>
                                                        <td width="219" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                        <input name="pregis" style="background:#FFFFFF" type="text" id="pregis" size="20"  />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Bien-Acto Jurídico</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <label></label>
                                                          <select name="tipobien" id="tipobien" onChange="enviarvalores(this.value)">
                                                          <option value="" selected="selected">SELECCIONAR </option>
                                                            <?php
	       while($rowtbien = mysql_fetch_array($sqltbienn)){
	         echo "<option value=".$rowtbien['idtipbien'].">".$rowtbien['desestcivil']."</option> \n";
             }
	     ?>
                                                          </select>
                                                        </span></td>
                                                        <td height="30"><span class="titupatrimo">Sede Registral</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <select name="idsedereg2" id="idsedereg2">
                                                            <?php
	       while($rowsedess = mysql_fetch_array($sqlsedess)){
	         echo "<option value=".$rowsedess['idsedereg'].">".$rowsedess['dessede']."</option> \n";
             }
	     ?>
                                                          </select>
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Ubigeo</span></td>
                                                        <td height="30" colspan="2"><input name="ubigens" type="text" id="ubigens" style="background:#FFFFFF" size="45" /><span style="color:#F00">*</span></td>
                                                        <td height="30"><a id="_clickBuscaUbis" href="#" onClick="mostrar_desc('div_buscaubis')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
                                                            <div id="div_buscaubis" style="position:absolute; display:none; width:637px; height:223px; left: 14px; top: 162px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="24" height="29">&nbsp;</td>
                                                                  <td width="585" class="titupatrimo">Seleccionar Ubigeo:</td>
                                                                  <td width="28"><a id="_CloseDivUbi" href="#" onClick="ocultar_desc('div_buscaubis')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td><label>
                                                                    <input name="buscaubis" type="text" style="background:#FFFFFF; text-transform:uppercase;" id="buscaubis" size="60" onKeyUp="buscaubigeoss()" />
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
                                                            </div>
                                                          <input name="codubis" type="hidden" id="codubis" size="15" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"><span class="titupatrimo">Fecha de Add. o Cons.</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                          <label>
                                                          <input type="text" name="fechaconst" style="background:#FFFFFF" class="tcal" id="fechaconst" />
                                                          </label>
                                                        </span><span style="color:#F00">*</span></td>
                                                        <td height="30" align="center">&nbsp;</td>
                                                        <td height="30"><a id="_saveNewBien" href="#"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15">
                                                            
                                                          </td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15">&nbsp;</td>
                                                      </tr>
                                                  </table>
                                      </div>
                                                    <div id="listbiennes" style="display:">Listado de Bienes</div></td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="verbienesedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx" type="hidden" id="detbienx" />
                                              </tr>
                                            </table>
                                      </div>