<table><tr><td align='right'>Repres. a:</td><td>" + _apoderado + "</td><td colspan='3' align='center'><input type='checkbox' name='chk_ambos' id='chk_ambos' onclick='fSelectRepresenta' /> Ambos padres </td></tr><tr><td>Partida Electr. N°:</td><td>
<input name='partida_numero' type='text'  id='partida_numero'/></td>
  <td>Sede Registral:</td>
    <td><input name='sede_registral_a' type='text'  id='sede_registral_a'/></td>
</tr>
</table>
<?php
include("conexion.php");

$sqltpago=mysql_query("SELECT * FROM mediospago",$conn) or die(mysql_error());
$sqlmon=mysql_query("SELECT * FROM monedas",$conn) or die(mysql_error()); 

?>

<div id="vvehicular" style="display:">
                                            <table width="710" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18">&nbsp;</td>
                                                <td width="692"></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newvehiculo" style="display:">
                                                  <table width="650" border="0" align="left" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19">Placa / Poliza :</td>
                                                        <td height="19"><input name="idplacav" type="text"  id="idplacav" style="background:#FFFFFF" size="2" maxlength="2" />
                                                        <input name="numplacav" type="text"  id="numplacav" style="background:#FFFFFF" maxlength="20" /><span style="color:#F00">*</span></td>
                                                        <td height="19">Color :</td>
                                                        <td height="19"><span class="titupatrimo">
                                                          <input name="colorv" type="text"  id="colorv" style="background:#FFFFFF" maxlength="20" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td width="174" height="30"><span class="titupatrimo">Clase :</span></td>
                                                        <td width="178" height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="clasev" type="text"  id="clasev" style="background:#FFFFFF" maxlength="20" />
                                                        </span></td>
                                                        <td width="108" height="30">Motor :</td>
                                                        <td width="420" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                        <input name="motorv" type="text"  id="motorv" style="background:#FFFFFF" maxlength="20" />
                                                        </span><span style="color:#F00">*</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Marca :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="marcav" type="text"  id="marcav" style="background:#FFFFFF" maxlength="20" />
                                                        </span></td>
                                                        <td height="30">Cilindros :</td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="numcilv" type="text"  id="numcilv" style="background:#FFFFFF" size="5" maxlength="3" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Año Fabric.:</span></td>
                                                        <td height="30"><input name="anofabv" type="text"  id="anofabv" style="background:#FFFFFF" size="10" maxlength="10" /></td>
                                                        <td height="30">Serie Nro.:</td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="numseriev" type="text"  id="numseriev" style="background:#FFFFFF" maxlength="20" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"><span class="titupatrimo">Modelo :</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                        <label>
                                                          <input name="modelov" type="text"  id="modelov" style="background:#FFFFFF" maxlength="20" />
                                                          </label>
                                                        </span></td>
                                                        <td height="30">Ruedas :</td>
                                                        <td height="30">
                                                          <input name="numruedav" type="text"  id="numruedav" style="background:#FFFFFF" size="5" maxlength="3" />
                                                        </span></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15">Combustible :</td>
                                                        <td height="15"><input name="combustiblev" type="text"  id="combustiblev" style="background:#FFFFFF" maxlength="20" /></td>
                                                        <td height="30">Moneda :</td>
                                                        <td height="30"><select name="idmonv" id="idmonv">
                                                          <?php
	       while($rowmoneda = mysql_fetch_array($sqlmon)){

	         echo "<option value=".$rowmoneda['idmon'].">".$rowmoneda['desmon']."</option> \n";
             }
	     ?>
                                                        </select><span style="color:#F00">*</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15">Carroceria :</td>
                                                        <td height="15"><input name="carroceriav" type="text"  id="carroceriav" style="background:#FFFFFF" maxlength="20" /></td>
                                                        <td height="30">Precio Venta :</td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="preciov" type="text"  id="preciov" style="background:#FFFFFF" maxlength="19" />
                                                        </span><span style="color:#F00">*</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15">Fec. Inscripcion :
                                                            
                                                          </td>
                                                        <td height="15"><input name="fecinscv" type="text"  id="fecinscv" style="background:#FFFFFF" size="10" maxlength="15" /></td>
                                                        <td height="30">Forma Pago :</td>
                                                        <td height="15"><select name="codmepagv" id="codmepagv">
                                                                          <?php
	       while($rowtpago = mysql_fetch_array($sqltpago)){

	         echo "<option value=".$rowtpago['codmepag'].">".$rowtpago['desmpagos']."</option> \n";
             }
	     ?>
                                                                        </select></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"></td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15"><a href="#" onclick="gbvehicular()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" />
                                                          <input name="idtipactov" type="hidden" id="idtipactov" size="15" />
                                                        </a></td>
                                                      </tr>
                                                  </table>
                                                </div>
                                                    </td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="vervehiedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx" type="hidden" id="detbienx" />
                                              </tr>
                                            </table>
                                      </div>
