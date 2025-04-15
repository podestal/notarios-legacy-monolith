<?php 
include("conexion.php");
include("includes/combo.php");

$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
?>
<style type="text/css">
<!--
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
-->
</style>
<table width="598" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="apepat2" style="text-transform:uppercase; background:#FFFFFF" id="apepat2" /></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="170" height="30"><input type="text" name="apemat2" style="text-transform:uppercase; background:#FFFFFF" id="apemat2" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="prinom2" style="text-transform:uppercase; background:#FFFFFF" id="prinom2" /></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="segnom2" style="text-transform:uppercase; background:#FFFFFF" id="segnom2" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="direccion2" style="text-transform:uppercase; background:#FFFFFF" type="text" id="direccion2" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="30" colspan="3"><table width="412" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="289"><input name="ubigensc2" readonly="readonly" style="background:#FFFFFF" type="text" id="ubigensc2" size="45" /></td>
        <td width="223"><a id="limpconyuge" href="#" onClick="mostrar_desc('buscaubisc222')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
              <div id="buscaubisc222" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                <table width="637" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24" height="29">&nbsp;</td>
                    <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
                    <td width="28"><a href="#" onClick="ocultar_desc('buscaubisc222')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="buscaubisc2" type="text" id="buscaubisc2"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaubigeossc2()" />
                    </label></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div id="resulubisc2" style="width:585px; height:150px; overflow:auto"></div></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    <td height="30">
    <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipoestacivil.idestcivil AS 'id', tipoestacivil.desestcivil AS 'des' FROM tipoestacivil
ORDER BY tipoestacivil.desestcivil ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "120"; 
			$oCombo->name       = "idestcivil2";
			$oCombo->style      = ""; 
			$oCombo->click      = "//eval_idoppago(this.value)";   
			$oCombo->selected   =  "2";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
    </td>
    <td height="30" colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo2" id="sexo2">
      <option value = "" selected="selected">SELECCIONE SEXO</option>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select></td>
    <td height="30" align="right" class="camposss">&nbsp;</td>
    <td height="30"><label></label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><?php 
                $oCombo = new CmbList()  ;					 		
                $oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des' FROM nacionalidades 
    WHERE nacionalidades.descripcion <> '' ORDER BY nacionalidades.descripcion ASC"; 
				//echo  $oCombo->dataSource;
                $oCombo->value      = "id";
                $oCombo->text       = "des";
                $oCombo->size       = "150"; 
                $oCombo->name       = "nacionalidad2";
                $oCombo->style      = ""; 
                $oCombo->click      = "//eval_idoppago(this.value)";   
                $oCombo->selected   = "177";
                $oCombo->Show();
                $oCombo->oDesCon(); 
    ?></td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente2" id="residente2">
        <option value="1" selected="selected">SI</option>
        <option value="0">NO</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Natural de :</span></td>
    <td height="30"><input type="text" style="text-transform:uppercase; background:#FFFFFF" name="natper2" id="natper2" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie2" type="text" id="cumpclie2" style="text-transform:uppercase; background:#FFFFFF" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="right"><span class="camposss">Pais de Emisi&oacute;n del Documento de Identidad :</span></td>
    <td height="30" colspan="2"><label>
      <input type="text" style="text-transform:uppercase; background:#FFFFFF" name="docpaisemi2" id="docpaisemi2" value="PERU" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaci&oacute;n :</span></td>
    <td height="30" colspan="3"><table width="410" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomprofesiones2" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomprofesiones2" size="45" />
        </label></td>
        <td width="129"><a href="#" id="ocupa" onClick="mostrar_desc('buscaprofe2')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Cargo :</span></td>
    <td height="30" colspan="3"><table width="409" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomcargoss2" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomcargoss2" size="45" />
        </label></td>
        <td width="128"><a href="#" id="carguis" onClick="mostrar_desc('buscacargooo2')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel2" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telcel2" size="20" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi2" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telofi2" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo2" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telfijo2" size="20" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email2" style="background:#FFFFFF" type="text" id="email2" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a href="#" onclick="ggclie2()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc2" type="hidden" id="codubis2" size="15" />
        <input name="idprofesion2" type="hidden" id="idprofesion2" size="15" />
        <input name="idcargoo2" type="hidden" id="idcargoo2" size="15" /></td>
  </tr>
</table>

