<?php 
include("conexion.php");
include("includes/combo.php");

$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());

?>
<table width="598" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="apepat6" style="text-transform:uppercase; background:#FFFFFF" id="apepat6" value="<?php echo $rowclc['apepat'];  ?>" /></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="170" height="30"><input type="text" name="apemat6" style="text-transform:uppercase; background:#FFFFFF" value="<?php echo $rowclc['apemat'];  ?>" id="apemat6" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="prinom6" style="text-transform:uppercase; background:#FFFFFF" id="prinom6" value="<?php echo $rowclc['prinom'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="segnom6" style="text-transform:uppercase; background:#FFFFFF" id="segnom6" value="<?php echo $rowclc['segnom'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="direccion6" style="text-transform:uppercase; background:#FFFFFF" type="text" id="direccion6" value="<?php echo $rowclc['direccion'];  ?>" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="30" colspan="3"><table width="412" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="289"><input name="ubigensc6" readonly="readonly" style="background:#FFFFFF" type="text" id="ubigensc6" size="45" value="<?php 
		$sqlubiubi=mysql_query("select * from ubigeo where  coddis='".$rowclc['idubigeo']."'", $conn) or die(mysql_error());
        $rowubiubi=mysql_fetch_array($sqlubiubi);
		echo $rowubiubi['nomdpto']."/".$rowubiubi['nomprov']."/".$rowubiubi['nomdis']; ?>" />        </td>
        <td width="223"><a href="#" onClick="mostrar_desc('buscaubisc6')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
              <div id="buscaubisc6" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                <table width="637" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24" height="29">&nbsp;</td>
                    <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
                    <td width="28"><a href="#" onClick="ocultar_desc('buscaubisc6')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="buscaubisc6" type="text" id="buscaubisc6"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaubigeossc6()" />
                    </label></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div id="resulubisc6" style="width:585px; height:150px; overflow:auto"></div></td>
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
			$oCombo->name       = "idestcivil6";
			$oCombo->style      = ""; 
			$oCombo->click      = "//eval_idoppago(this.value)";   
			$oCombo->selected   = $rowclc['idestcivil'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
</td>
    <td height="30" colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo6" id="sexo6">
      <?php if ($rowclc['sexo']=="M"){
		      echo "<option value='M' selected='selected'>MASCULINO</option>
			  		<option value='F' >FEMENINO</option>";
			} else{
			  echo "<option value='F' selected='selected'>FEMENINO</option>
			  		<option value='M' >MASCULINO</option>";
			}  
		?>
     <!-- <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>-->
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
                $oCombo->name       = "nacionalidad6";
                $oCombo->style      = ""; 
                $oCombo->click      = "//eval_idoppago(this.value)";   
                $oCombo->selected   = $rowclc['nacionalidad'];
                $oCombo->Show();
                $oCombo->oDesCon(); 
    ?>
    </td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente6" id="residente6">
        <?php if ($rowclc['residente']=="1"){
		      echo "<option value='1' selected='selected'>SI</option>
			  		<option value='0' >NO</option>";
			} else{
			  echo "<option value='0' selected='selected'>NO</option>
			  		<option value='1' >SI</option>";
			} 
		?>
       <!-- <option value="1">SI</option>
        <option value="0">NO</option>-->
      </select>
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Natural de :</span></td>
    <td height="30"><input type="text" style="text-transform:uppercase; background:#FFFFFF" name="natper6" id="natper6" value="<?php echo $rowclc['natper'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie6" type="text" id="cumpclie6" style="text-transform:uppercase; background:#FFFFFF" size="20" value="<?php echo $rowclc['cumpclie'];  ?>"/></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="right"><span class="camposss">Pais de Emisi&oacute;n del Documento de Identidad :</span></td>
    <td height="30" colspan="2"><label>
      <input type="text" style="text-transform:uppercase; background:#FFFFFF" name="docpaisemi6" id="docpaisemi6" value="<?php echo $rowclc['docpaisemi'];  ?>" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaci&oacute;n :</span></td>
    <td height="30" colspan="3"><table width="410" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomprofesiones6" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomprofesiones6" size="45" value="<?php echo $rowclc['detaprofesion'];  ?>" />
        </label></td>
        <td width="129"><a href="#" onClick="mostrar_desc('buscaprofe6')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Cargo :</span></td>
    <td height="30" colspan="3"><table width="409" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomcargoss6" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomcargoss6" size="45" value="<?php echo $rowclc['profocupa'];  ?>" />
        </label></td>
        <td width="128"><a href="#" onClick="mostrar_desc('buscacargooo6')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel6" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telcel6" size="20" value="<?php echo $rowclc['telcel'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi6" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telofi6" size="20" value="<?php echo $rowclc['telofi'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo6" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telfijo6" size="20" value="<?php echo $rowclc['telfijo'];  ?>" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email6" style="background:#FFFFFF" type="text" id="email6" size="60" value="<?php echo $rowclc['email'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a href="#" onclick="ggclie6()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc6" type="hidden" id="codubis6" size="15" value="<?php echo $rowclc['idubigeo'];  ?>" />
        <input name="idprofesion6" type="hidden" id="idprofesion6" size="15" value="<?php echo $rowclc['idprofesion'];  ?>" />
        <input name="idcargoo6" type="hidden" id="idcargoo6" size="15" value="<?php echo $rowclc['idcargoprofe'];  ?>" />
        <input name="codclie6" type="hidden" id="codclie6" size="15" value="<?php echo $rowclc['idcliente'];  ?>" /></td></td>
  </tr>
</table>
