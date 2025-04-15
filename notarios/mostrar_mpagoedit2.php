<?php 

include("conexion.php")					  ;
require_once("includes/combo.php")  	  ;
$oCombo = new CmbList()  				  ;

$detmp = $_POST['detmp'];
$consulmpago=mysql_query("SELECT * FROM detallemediopago where detmp='$detmp'", $conn) or die(mysql_error());
$rowmpago = mysql_fetch_array($consulmpago);



?>
<table width="726" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30" colspan="3" class="Estilo23 Estilo43">Editar Medio de Pago/Tipo de Fondo</td>
                                                                      <td height="30"><table width="200" border="0" cellpadding="0" cellspacing="0">
                                                                  <tr>
                                                                            <td width="176">&nbsp;</td>
                                                                            <td width="24"><a href="#" onClick="ocultar_desc('vermediopagoedit2')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
                                                                        </tr>
                                                                      </table></td>
                                                                </tr>
                                                                    <tr>
                                                                      <td width="15">&nbsp;</td>
                                                                      <td width="116" height="30"><span class="titupatrimo">M. Pago/T. fondo</span></td>
                                                                      <td width="270" height="30"> 
                                                                        <?php 
			echo "<select name='mediopago2' id='mediopago2' onchange='selectAsunto(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo3 = mysql_query( "SELECT mediospago.codmepag AS 'id', mediospago.desmpagos AS 'des',mediospago.sunat FROM mediospago ORDER BY des ASC",$conn);
			while ($rs3=mysql_fetch_assoc($combo3)){
			
			echo "<option value='".$rs3['id']."'";
			
			if($rs3['id']==$rowmpago['codmepag']){
				echo " selected='selected' ";
			}
			
			echo ">".$rs3['sunat']." - ".$rs3['des']."</option>";
			}
			echo "</select>";
?>                                                                   </td>
                                                                      <td width="119" height="30"><span class="titupatrimo">Importe M. Pago/T. fondo</span></td>
                                                                      <td width="206" height="30"><span class="titupatrimo">
                                                                    <label></label>
                                                                        <input name="impmediopago6" style="background:#FFFFFF; text-align:right;" type="text" id="impmediopago6" size="20" value="<?php echo $rowmpago['importemp'];  ?>" />
                                                                      </span></td>
                                                                </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Entidad Financiera</span></td>
                                                                      <td height="30"><?php 
			echo "<select name='entidadfinanciera2' id='entidadfinanciera2' onchange='selectAsunto(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo4 = mysql_query( "SELECT bancos.idbancos AS 'id', bancos.desbanco AS 'des'
FROM bancos ORDER BY des ASC",$conn);
			while ($rs4=mysql_fetch_assoc($combo4)){
			
			echo "<option value='".$rs4['id']."'";
			
			if($rs4['id']==$rowmpago['idbancos']){
				echo " selected='selected' ";
			}
			
			echo ">".$rs4['des']."</option>";
			}
			echo "</select>"; 
?></td>
                                                                      <td height="30" class="titupatrimo">Fecha de Operación</td>
                                                                      <td height="30"><label><span class="titupatrimo">
                                                                      <input name="fechaoperacion6" style="background:#FFFFFF" type="text" id="fechaoperacion6" class="tcal" size="20" value="<?php echo $rowmpago['foperacion'];  ?>" />
                                                                      </span></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Tipo Moneda</span></td>
                                                                    <td height="30"><?php 
			echo "<select name='monedas2' id='monedas2' onchange='selectAsunto(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo5 = mysql_query( "SELECT monedas.idmon AS 'id', monedas.desmon AS 'des' FROM monedas",$conn);
			while ($rs5=mysql_fetch_assoc($combo5)){
			
			echo "<option value='".$rs5['id']."'";
			
			if($rs5['id']==$rowmpago['idmon']){
				echo " selected='selected' ";
			}
			
			echo ">".$rs5['des']."</option>";
			}
			echo "</select>";
?></td>
                                                                      <td height="30">&nbsp;</td>
                                                                      <td height="30">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Documentos</span></td>
                                                                      <td height="30" colspan="2"><span class="titupatrimo">
                                                                        <input name="documentos6" style="background:#FFFFFF; text-transform:uppercase;" type="text" id="documentos6" size="50" value="<?php echo $rowmpago['documentos'];  ?>" />
                                                                      </span></td>
                                                                      <td height="30"><span class="titupatrimo"><a href="#" onClick="gmediopago2()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></span></td>
                                                                    </tr>
                                                              </table>
                                                           