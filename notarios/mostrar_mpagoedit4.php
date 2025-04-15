
<?php 

include("conexion.php")					  ;
require_once("includes/combo.php")  	  ;
$oCombo = new CmbList()  				  ;

$detmp = $_POST['detmp'];
$tipoactopatri = $_POST['tipoactopatri'];

$consulmpago=mysql_query("SELECT * FROM detallemediopago where detmp='$detmp' and tipacto = '$tipoactopatri'", $conn) or die(mysql_error());
$rowmpago = mysql_fetch_array($consulmpago);



?>
<table width="726" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30" colspan="3" class="Estilo23 Estilo43">Editar Medio de Pago</td>
                                                                      <td height="30"><table width="200" border="0" cellpadding="0" cellspacing="0">
                                                                  <tr>
                                                                            <td width="176">&nbsp;</td>
                                                                            <td width="24"><a href="#" onClick="ocultar_desc('vermediopagoedit')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
                                                                        </tr>
                                                                      </table></td>
                                                                </tr>
                                                                    <tr>
                                                                      <td width="15">&nbsp;</td>
                                                                      <td width="116" height="30"><span class="titupatrimo">Medio de Pago</span></td>
                                                                      <td width="270" height="30"> 
                                                                        <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT mediospago.codmepag AS 'id', mediospago.desmpagos AS 'des' FROM mediospago"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "mediopago2";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowmpago['codmepag'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>                                                                   </td>
                                                                      <td width="119" height="30"><span class="titupatrimo">Importe Medio de Pago</span></td>
                                                                      <td width="206" height="30"><span class="titupatrimo">
                                                                    <label></label>
                                                                        <input name="impmediopago2" style="background:#FFFFFF; text-align:right;" type="text" id="impmediopago2" size="20" value="<?php echo $rowmpago['importemp'];  ?>" />
                                                                      </span></td>
                                                                </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Entidad Financiera</span></td>
                                                                      <td height="30"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT bancos.idbancos AS 'id', bancos.desbanco AS 'des'
FROM bancos"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "entidadfinanciera2";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowmpago['idbancos'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
                                                                      <td height="30" class="titupatrimo">Fecha de Operación</td>
                                                                      <td height="30"><label><span class="titupatrimo">
                                                                      <input name="fechaoperacion2" style="background:#FFFFFF" type="text" id="fechaoperacion2" class="tcal text tcalInput" size="20" value="<?php echo $rowmpago['foperacion'];  ?>" />
                                                                      </span></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Tipo Moneda</span></td>
                                                                    <td height="30"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT monedas.idmon AS 'id', monedas.desmon AS 'des' FROM monedas"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "monedas2";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowmpago['idmon'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
                                                                      <td height="30">&nbsp;</td>
                                                                      <td height="30">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Documentos</span></td>
                                                                      <td height="30" colspan="2"><span class="titupatrimo">
                                                                        <input name="documentos2" style="background:#FFFFFF; text-transform:uppercase;" type="text" id="documentos2" size="50" value="<?php echo $rowmpago['documentos'];  ?>" />
                                                                      </span></td>
                                                                      <td height="30"><span class="titupatrimo"><a href="#" onClick="gmediopago()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></span></td>
                                                                    </tr>
                                                              </table>
                                                           