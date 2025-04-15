<?php 
include("../../conexion.php");
require_once("../../includes/combo.php") ;
$codigocliente=$_REQUEST['dni_cliente'];


$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
$consulcliente=mysql_query("Select * from cliente where numdoc='$codigocliente'", $conn) or die(mysql_error());
$rowclientte = mysql_fetch_array($consulcliente);


?>
<table width="598" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paternoa :</span></td>
    <td width="180" height="30"><input name="napepatcnt" type="text" id="napepatcnt"  onkeyup="napepatcnt();" style="text-transform:uppercase; background:#FFFFFF" value="<?php 
					$c_desc = $rowclientte['apepat'];
					$textorpat=str_replace("?","'",$c_desc);
					$textoamperpat=str_replace("*","&",$textorpat);
					echo strtoupper($textoamperpat); ?>" maxlength="100" />
                    <input type="hidden" name="apepatcnt" id="apepatcnt" />

                    </td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="170" height="30"><input name="napematcnt" type="text" id="napematcnt" onkeyup="napematcnt();" style="text-transform:uppercase; background:#FFFFFF" value="<?php $c_desc = $rowclientte['apemat'];
					$textorpat=str_replace("?","'",$c_desc);
					$textoamperpat=str_replace("*","&",$textorpat);
					echo strtoupper($textoamperpat);   ?>" maxlength="100" />
                    <input type="hidden" name="apematcnt" id="apematcnt" />
                    </td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input name="nprinomcnt" type="text" id="nprinomcnt" onkeyup="nprinomcnt();" style="text-transform:uppercase; background:#FFFFFF" value="<?php 
					$c_desc = $rowclientte['prinom'];
					$textorpat=str_replace("?","'",$c_desc);
					$textoamperpat=str_replace("*","&",$textorpat);
					echo strtoupper($textoamperpat); ?>" maxlength="100" />
                    <input type="hidden" name="prinomcnt" id="prinomcnt" />
                    </td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input name="nsegnomcnt" type="text" id="nsegnomcnt" onkeyup="nsegnomcnt();" style="text-transform:uppercase; background:#FFFFFF" value="<?php 
					$c_desc = $rowclientte['segnom'];
					$textorpat=str_replace("?","'",$c_desc);
					$textoamperpat=str_replace("*","&",$textorpat);
					echo strtoupper($textoamperpat); ?>" maxlength="100" />
                    <input type="hidden" name="segnomcnt" id="segnomcnt" />
                    </td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccioncnt" type="text" id="ndireccioncnt" style="text-transform:uppercase; background:#FFFFFF" value="<?php 
					$c_desc = $rowclientte['direccion'];
					$textorpat=str_replace("?","'",$c_desc);
					$textoamperpat=str_replace("*","&",$textorpat);
					echo strtoupper($textoamperpat); ?>" size="60" maxlength="3000" />
    <input type="hidden" name="direccioncnt" id="direccioncnt" />
    </td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="30" colspan="3"><table width="412" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="289"><input name="ubigensccnt" readonly="readonly" style="background:#FFFFFF" type="text" id="ubigensccnt" size="45" value="<?php 
		$sqlubiubi=mysql_query("select * from ubigeo where  coddis='".$rowclientte['idubigeo']."'", $conn) or die(mysql_error());
        $rowubiubi=mysql_fetch_array($sqlubiubi);
		echo $rowubiubi['nomdpto']."/".$rowubiubi['nomprov']."/".$rowubiubi['nomdis']; ?>" />        </td>
        <td width="223"><a id="_selUbieclient" href="#" onClick="mostrar_desc('div_buscaubisccnt')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
              <div id="div_buscaubisccnt" style="position:absolute; display:none; width:580px; height:223px; left: 5px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                <table width="550" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24" height="29">&nbsp;</td>
                    <td><span class="camposss">Seleccionar Ubigeo:</span></td>
                    <td width="28"><a href="#" onClick="ocultar_desc('div_buscaubisccnt')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="buscaubisccnt" type="text" id="buscaubisccnt"  style="background:#FFFFFF; text-transform:uppercase;" size="50"  onkeyup="buscaubigeossccnt()" />
                    </label></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div id="resulubisccnt" style="width:550px; height:150px; overflow:auto"></div></td>
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
    <td height="30"><select name="idestcivilcnt" id="idestcivilcnt">
      <?php 
	     $sqltec=mysql_query("select * from tipoestacivil where  idestcivil='".$rowclientte['idestcivil']."'", $conn) or die(mysql_error());
        $rowtec=mysql_fetch_array($sqltec);
		echo "<option value = ".$rowtec["idestcivil"]." selected='selected'>".nl2br($rowtec["desestcivil"])."</option>";
		
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" colspan="2" align="left"><div id="ccconyugecnt"><input name='cconyugecnt' type='hidden' value='' /></div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexocnt" id="sexocnt">
      <?php if ($rowclientte['sexo']=="M"){
		      echo "<option value='M' selected='selected'>MACULINO</option>";
			} else{
			  echo "<option value='F' selected='selected'>FEMEMNINO</option>";
			}  
		?>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select></td>
    <td height="30" align="right" class="camposss">D.N.I. :</td>
    <td height="30"><label>
      <input name="numdoccnt" type="text" id="numdoccnt" style="background:#FFFFFF" value="<?php echo $rowclientte['numdoc'];  ?>" size="20" maxlength="8" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30">
    <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des'
FROM nacionalidades
ORDER BY nacionalidades.desnacionalidad ASC ";
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "nacionalidadcnt";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowclientte['nacionalidad'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residentecnt" id="residentecnt">
        <?php if ($rowclientte['residente']=="1"){
		      echo "<option value='1' selected='selected'>SI</option>";
			} else{
			  echo "<option value='0' selected='selected'>NO</option>";
			} 
		?>
        <option value="1">SI</option>
        <option value="0">NO</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Natural de :</span></td>
    <td height="30"><input type="text" style="text-transform:uppercase; background:#FFFFFF" name="natpercnt" id="natpercnt" value="<?php echo $rowclientte['natper'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpcliecnt" type="text" id="cumpcliecnt" style="text-transform:uppercase; background:#FFFFFF" size="20" value="<?php echo $rowclientte['cumpclie'];  ?>"/></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="right"><span class="camposss">Pais de Emisi&oacute;n del Documento de Identidad :</span></td>
    <td height="30" colspan="2"><label>
      <input type="text" style="text-transform:uppercase; background:#FFFFFF" name="docpaisemicnt" id="docpaisemicnt" value="<?php echo $rowclientte['docpaisemi'];  ?>" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaci&oacute;n :</span></td>
    <td height="30" colspan="3"><table width="410" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomprofesionescnt" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomprofesionescnt" size="45" value="<?php echo $rowclientte['detaprofesion'];  ?>" />
        </label></td>
        <td width="129"><a id="_selProfeclient" href="#" onClick="mostrar_desc('buscaprofecnt')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Cargo :</span></td>
    <td height="30" colspan="3"><table width="409" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomcargosscnt" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomcargosscnt" size="45" value="<?php echo $rowclientte['profocupa'];  ?>" />
        </label></td>
        <td width="128"><a id="_selCargoclient" href="#" onClick="mostrar_desc('buscacargooocnt')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcelcnt" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telcelcnt" size="20" value="<?php echo $rowclientte['telcel'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="teloficnt" style="text-transform:uppercase; background:#FFFFFF" type="text" id="teloficnt" size="20" value="<?php echo $rowclientte['telofi'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijocnt" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telfijocnt" size="20" value="<?php echo $rowclientte['telfijo'];  ?>" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="emailcnt" type="text" id="emailcnt" style="background:#FFFFFF" value="<?php echo $rowclientte['email'];  ?>" size="60" maxlength="100" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a href="#" onclick="ggcliecnt1();"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisccnt" type="hidden" id="codubisccnt" size="15" value="<?php echo $rowclientte['idubigeo'];  ?>" />
        <input name="idprofesioncnt" type="hidden" id="idprofesioncnt" size="15" value="<?php echo $rowclientte['idprofesion'];  ?>" />
        <input name="idcargoocnt" type="hidden" id="idcargoocnt" size="15" value="<?php echo $rowclientte['idcargoprofe'];  ?>" />
        <input name="codcliecnt" type="hidden" id="codcliecnt" size="15" value="<?php echo $rowclientte['idcontratante'];  ?>" /></td>
  </tr>
</table>
<div id="buscaprofecnt" style="position:absolute; display:none; width:580px; height:223px; left: 5px; top: 200px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="570" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="570"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofecnt')"><img src="../../iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofescnt" type="text" id="buscaprofescnt" style="background:#FFFFFF; text-transform:uppercase;" size="50"  onkeyup="buscaprofesionescnt()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesionescnt" style="width:550px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<!-- -->
<div id="buscacargooocnt" style="position:absolute; display:none; width:580px; height:223px; left: 5px; top: 250px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="570" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="570"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooocnt')"><img src="../../iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargoosscnt" type="text" id="buscacargoosscnt"  style="background:#FFFFFF; text-transform:uppercase;" size="50"  onkeyup="buscacarguitosscnt()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargitocnt" style="width:550px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>