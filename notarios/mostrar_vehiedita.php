<?php
include("conexion.php");

$detveh=$_POST['detveh'];

$sqltpagov=mysql_query("SELECT * FROM mediospago",$conn) or die(mysql_error());
$sqlmonv=mysql_query("SELECT * FROM monedas",$conn) or die(mysql_error()); 

$consulvehic = mysql_query("SELECT * FROM detallevehicular where detallevehicular.detveh='$detveh'", $conn) or die(mysql_error());

$rowvehi = mysql_fetch_array($consulvehic);

?>

<div id="vvehicular2" style="display:">
                                            <table width="710" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18">&nbsp;</td>
                                                <td width="692"></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newvehiculo2" style="display:">
                                                  <table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19">Placa / Poliza :</td>
                                                        <td height="19"><input name="idplacav2" type="text"  id="idplacav2" style="background:#FFFFFF" size="1" maxlength="2" value="<?php echo $rowvehi['idplaca'];  ?>" />
                                                        <input name="numplacav2" type="text" id="numplacav2" style="background:#FFFFFF; text-transform:uppercase;"  value="<?php echo $rowvehi['numplaca'];  ?>" size="15" /><span style="color:#F00">*</span></td>
                                                        <td height="19">Color :</td>
                                                        <td height="19"><span class="titupatrimo">
                                                          <input type="text" name="colorv2" style="background:#FFFFFF"  id="colorv2" value="<?php echo $rowvehi['color'];  ?>" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td width="125" height="30"><span class="titupatrimo">Clase :</span></td>
                                                        <td width="186" height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input type="text" name="clasev2" style="background:#FFFFFF"  id="clasev2" value="<?php echo $rowvehi['clase'];  ?>" />
                                                        </span></td>
                                                        <td width="113" height="30">Motor :</td>
                                                        <td width="276" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                        <input type="text" name="motorv2" style="background:#FFFFFF"  id="motorv2" value="<?php echo $rowvehi['motor'];  ?>" />
                                                        </span><span style="color:#F00">*</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Marca :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input type="text" name="marcav2" style="background:#FFFFFF"  id="marcav2" value="<?php echo $rowvehi['marca'];  ?>" />
                                                        </span></td>
                                                        <td height="30">Cilindros :</td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="numcilv2" type="text"  id="numcilv2" style="background:#FFFFFF" size="5" value="<?php echo $rowvehi['numcil'];  ?>" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Año Fabric.:</span></td>
                                                        <td height="30"><input name="anofabv2" type="text"  id="anofabv2" style="background:#FFFFFF" size="10" value="<?php echo $rowvehi['anofab'];  ?>" /></td>
                                                        <td height="30">Serie Nro.:</td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input type="text" name="numseriev2" style="background:#FFFFFF"  id="numseriev2" value="<?php echo $rowvehi['numserie'];  ?>" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"><span class="titupatrimo">Modelo :</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                        <label>
                                                          <input type="text" name="modelov2" style="background:#FFFFFF"  id="modelov2" value="<?php echo $rowvehi['modelo'];  ?>" />
                                                          </label>
                                                        </span></td>
                                                        <td height="30">Ruedas :</td>
                                                        <td height="30"><a href="#" onClick="gbbiennes()"><span class="titupatrimo">
                                                          <input name="numruedav2" type="text"  id="numruedav2" style="background:#FFFFFF" size="5" value="<?php echo $rowvehi['numrueda'];  ?>" />
                                                        </span></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15">Combustible :</td>
                                                        <td height="15"><input type="text" name="combustiblev2" style="background:#FFFFFF"  id="combustiblev2" value="<?php echo $rowvehi['combustible'];  ?>" /></td>
                                                        <td height="30">Moneda :</td>
                                                        <td height="30"><select name="idmonv2" id="idmonv2">
<?php
$sqlmonedass = mysql_query("SELECT * FROM monedas where  idmon = '".$rowvehi['idmon']."'", $conn) or die(mysql_error());
$rowmmon = mysql_fetch_array($sqlmonedass);

echo "<option value = ".$rowmmon["idmon"]." selected='selected'>".nl2br($rowmmon["desmon"])."</option>";


while($rowmoneda = mysql_fetch_array($sqlmon)){
echo "<option value=".$rowmoneda['idmon'].">".$rowmoneda['desmon']."</option> \n";
}
?>
</select>	<span style="color:#F00">*</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15">Carroceria :</td>
                                                        <td height="15"><input type="text" name="carroceriav2" style="background:#FFFFFF"  id="carroceriav2" value="<?php echo $rowvehi['carroceria'];  ?>" /></td>
                                                        <td height="30">Precio Venta :</td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="preciov2" type="text"  id="preciov2" style="background:#FFFFFF" value="<?php echo $rowvehi['precio'];  ?>" size="15" />
                                                        </span><span style="color:#F00">*</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15">Fec. Inscripcion :
                                                            
                                                          </td>
                                                        <td height="15"><input name="fecinscv2" type="text" class="tcal" id="fecinscv2" style="background:#FFFFFF" size="10" value="<?php echo $rowvehi['fecinsc'];  ?>" /></td>
                                                        <td height="30">Forma Pago :</td>
                                                        <td height="15"><select name="codmepagv2" id="codmepagv2">
<?php
$sqlmpagovehi = mysql_query("SELECT * FROM mediospago where  codmepag = '".$rowvehi['codmepag']."'", $conn) or die(mysql_error());
$rowmpagove = mysql_fetch_array($sqlmpagovehi);
echo "<option value = ".$rowmpagove["codmepag"]." selected='selected'>".nl2br($rowmpagove["desmpagos"])."</option>";


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
                                                        <td height="15"><a href="#" onclick="gbvehicular2()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" />
                                                          <input name="kardexvehi2" type="hidden" id="kardexvehi2" size="15" value="<?php echo $rowvehi['kardex'];  ?>" />
                                                        <input name="idtipactov2" type="hidden" id="idtipactov2" size="15" value="<?php echo $rowvehi['idtipacto'];  ?>" />
                                                        </a></td>
                                                      </tr>
                                                  </table>
                                                </div>
                                                    </td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="vervehiedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx" type="hidden" id="detbienx" />
                                              </tr>
                                            </table>
                                      </div>