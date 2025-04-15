<div id="vvehicular" style="display:">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18">&nbsp;</td>
                                                <td width="692"><a id="_newVehiculo" onclick="agregarVehiculo();" href="#">Nuevo </a>&nbsp;&nbsp;&nbsp;&nbsp;<a id="_listVehiculo" onclick="listarVehiculos();" href="#">Listado </a></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newvehiculo" style="display:">
                                                  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19" align="right"><span class="titupatrimo">Tipo: </span></td>
                                                        <td height="19"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT det_placa.id_placa AS 'id', det_placa.descripcion AS 'des'
FROM det_placa"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "100"; 
			$oCombo->name       = "idplacav";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?><!--<input name="idplacav" type="text"  id="idplacav" style="background:#FFFFFF" size="1" maxlength="2" />--></td>
                                                        <td height="19" align="right"><span class="titupatrimo">Carroceria :</span></td>
                                                        <td height="19"><input name="carroceriav" type="text"  id="carroceriav" style="background:#FFFFFF" maxlength="20" class="text" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td width="246" height="30" align="right"><span class="titupatrimo">N. Placa / Poliza :</span></td>
                                                        <td width="252" height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="numplacav" type="text"  id="numplacav" size="15" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" />
                                                        <span style="color:#F00">*</span></span></td>
                                                        <td width="186" height="30" align="right"><span class="titupatrimo">Color :</span></td>
                                                        <td width="563" height="30"><span class="titupatrimo">
                                                          <input name="colorv" type="text"  id="colorv" style="background:#FFFFFF" maxlength="20" class="text" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30" align="right"><span class="titupatrimo">Clase :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="clasev" type="text"  id="clasev" style="background:#FFFFFF" maxlength="20" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Motor :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="motorv" type="text"  id="motorv" style="background:#FFFFFF" maxlength="20" class="text" />
                                                        <span style="color:#F00">*</span></span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30" align="right"><span class="titupatrimo">Marca :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="marcav" type="text"  id="marcav" style="background:#FFFFFF" maxlength="20" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Cilindros :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <input name="numcilv" type="text"  id="numcilv" style="background:#FFFFFF" size="5" maxlength="3" class="text" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Año Fabric.:</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                        <input name="anofabv" type="text"  id="anofabv" style="background:#FFFFFF" size="10" maxlength="10" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Serie Nro.:</span></td>
                                                        <td height="30"></span><span class="titupatrimo">
                                                        <input name="numseriev" type="text"  id="numseriev" style="background:#FFFFFF" maxlength="20" class="text" />
                                                        </span></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Modelo :</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <input name="modelov" type="text"  id="modelov" style="background:#FFFFFF" maxlength="20" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Ruedas :</span></td>
                                                        <td height="30"><input name="numruedav" type="text"  id="numruedav" style="background:#FFFFFF" size="5" maxlength="3" class="text" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Combustible :</span></td>
                                                        <td height="15"><input name="combustiblev" type="text"  id="combustiblev" style="background:#FFFFFF" maxlength="20" class="text" /></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Fec. Inscrip:</span></td>
                                                        <td height="30"><input name="fecinscv" type="text"  class="tcal" id="fecinscv" style="background:#FFFFFF" size="10" maxlength="15" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"></td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15"><a href="#" onClick="gbvehicular()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" />
                                                          <input name="idtipactov" type="hidden" id="idtipactov" />
                                                        <span class="titupatrimo">
                                                          <input name="codmepagv" type="hidden"  id="codmepagv" />
                                                        <input name="preciov" type="hidden"  id="preciov"  value="0.00" />
                                                        <input name="idmonv" type="hidden"  id="idmonv" />
                                                        <input name="detvehx" type="hidden" id="detvehx"  />
                                                        </span></a></td>
                                                      </tr>
                                                  </table>
</div>
                                                    </td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="vervehiedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx" type="hidden" id="detbienx" />
                                              </tr>
                                              <tr>
                                              	<td colspan="2"><div id="listvehiculos" style="display:">Listado de Vehiculos</div>
                                              	</td>
                                              </tr>
                                            </table>
                                      </div>
                                      
                                      
                                      
                                      
                                      