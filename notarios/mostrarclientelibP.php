<style type="text/css">
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
</style>

<?php 
	include("conexion.php");
	require_once("barramenu.php") ;
	require_once("includes/gridView.php")  ;
	require_once("includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	

?>

<table width="674" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="653"><table width="647" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="159" height="30"><input type="text" name="napepat2" style="text-transform:uppercase"   id="napepat2" onkeyup="napepat2();" value="<?php 
		$apepat = $row['apepat'];
		$textorpat=str_replace("?","'",$apepat);
		$textoamperpat1=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat1);  ?>" />
        <input type="hidden" name="apepat2" id="apepat2"/>
        </td>
        <td width="95" height="30" ><span class="camposss">Ape.Materno</span></td>
        <td width="163" height="30" ><input type="text" name="napemat2" style="text-transform:uppercase"   id="napemat2" onkeyup="napemat2();" value="<?php 
		$apepat = $row['apemat'];
		$textorpat=str_replace("?","'",$apepat);
		$textoamperpat1=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat1);  ?>" />
         <input type="hidden" name="napemat22" id="napemat22"/>
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion');mostrar_desc('validarrepre')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicionk')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
    </div>
          <input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" value="<?php echo strtoupper($row['segnom']); ?>"  />
          <input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" value="<?php echo strtoupper($row['apemat']); ?>" />
          <input type="hidden" name="docum" style="text-transform:uppercase" id="docum" value="<?php echo strtoupper($row['numdoc']); ?>" /></td>
        </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input type="text" name="nprinom2" style="text-transform:uppercase" id="nprinom2" onkeyup="nprinom2();" value="<?php 
		$apepat = $row['prinom'];
		$textorpat=str_replace("?","'",$apepat);
		$textoamperpat1=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat1);  ?>" />
        <input type="hidden" name="prinom2" id="prinom2"/>
        </td>
        <td height="30" >&nbsp;</td>
        <td height="30" >&nbsp;</td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3"><input name="ndireccion2" type="text" style="text-transform:uppercase" id="ndireccion2" onkeyup="ndireccion2();" value="<?php
		$apepat = $row['direccion'];
		$textorpat=str_replace("?","'",$apepat);
		$textoamperpat1=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat1); ?>" size="60" />
        <input type="hidden" name="direc" id="direc"/>
        </td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="103" height="30" ><span class="camposss">Condicion</span></td>
        <td height="30"><span style="color:#F00; font-size:14px"><strong>
          <?php 
			$oCombo = new CmbList()  ;
			$oCombo->dataSource = "SELECT c_protesto.id_condicionp AS 'id', c_protesto.des_condicionp AS 'des' FROM c_protesto 
 			ORDER BY des_condicionp ASC"; 		
				 		
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "160"; 
			$oCombo->name       = "c_condicontrat";
			$oCombo->style      = ".camposss"; 
			$oCombo->click      = "//fEvalCondi();";   
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
          <strong>*</strong></strong></span></td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" >&nbsp;</td>
        <td height="30">&nbsp;</td>
         
        <td height="30" colspan="3">
        <label id="labelcod1" style="display:none;">Cod. Asegurado:</label><label id="labelcod2" style="display:none;">Cod.Pensionista:</label>
        <div id="div_codasegurado" style="display:none;"><input name="codi_asegurado" type="text" id="codi_asegurado" style="text-transform:uppercase;" size="20" /></div><div id="div_codtestigo" style="display:none;"></div></td>
        </tr>
      <tr>
        <td height="30" colspan="5" ><table width="44" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="44"><label><span class="camposss">
              <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
              </span></label></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>


