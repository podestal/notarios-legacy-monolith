<?php 
	include("../../conexion.php");
	$codigocliente=$_POST['codclie'];
	$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
	$naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());

?>
<table width="598" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="apepat4" style="text-transform:uppercase; background:#FFFFFF" id="apepat4" value="<?php echo $rowclc['apepat'];  ?>" /></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="170" height="30"><input type="text" name="apemat4" style="text-transform:uppercase; background:#FFFFFF" value="<?php echo $rowclc['apemat'];  ?>" id="apemat4" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="prinom4" style="text-transform:uppercase; background:#FFFFFF" id="prinom4" value="<?php echo $rowclc['prinom'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="segnom4" style="text-transform:uppercase; background:#FFFFFF" id="segnom4" value="<?php echo $rowclc['segnom'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="direccion4" style="text-transform:uppercase; background:#FFFFFF" type="text" id="direccion4" value="<?php echo $rowclc['direccion'];  ?>" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="30" colspan="3"><table width="412" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="289"><input name="ubigensc4" readonly="readonly" style="background:#FFFFFF" type="text" id="ubigensc4" size="45" value="<?php 
		$sqlubiubi=mysql_query("select * from ubigeo where  coddis='".$rowclc['idubigeo']."'", $conn) or die(mysql_error());
        $rowubiubi=mysql_fetch_array($sqlubiubi);
		echo $rowubiubi['nomdpto']."/".$rowubiubi['nomprov']."/".$rowubiubi['nomdis']; ?>" />        </td>
        <td width="223"><a id="_buscUbiConyuPerso" href="#" onClick="mostrar_desc('div_buscaubisc4')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
              <div id="div_buscaubisc4" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                <table width="637" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24" height="29">&nbsp;</td>
                    <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
                    <td width="28"><a href="#" onClick="ocultar_desc('div_buscaubisc4')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="buscaubisc4" type="text" id="buscaubisc4"  style="background:#FFFFFF;" size="50"  onkeyup="buscaubigeossc4()" />
                    </label></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div id="resulubisc4" style="width:585px; height:150px; overflow:auto"></div></td>
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
   <td></td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaciòn :</span></td>
    <td height="30" colspan="3"><table width="466" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="254"><label>
          <input name="nomprofesiones4" style="text-transform:uppercase"  type="text" id="nomprofesiones4" size="40"  value="<?php echo $rowclc['detaprofesion'];  ?>"/>
        </label></td>
        <td width="118"><a id="limprofe" href="#" onclick="mostrar_desc('busca_profe2')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
        <td width="94"> <div id="busca_profe2" style="position:absolute; display:none; width:637px; height:223px; left: 90px; top: 80px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
            <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Profesion:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('busca_profe2')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaprofescc2" type="text" id="buscaprofescc2"  style="background:#FFFFFF;" size="50" onkeypress="buscaprofesiones_cc2()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulprofesionescc2" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
  </div>
        
        </td>
      </tr>
    </table>
    </td>
          </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    <td height="30"><select name="idestcivil4" id="idestcivil4" onChange="">
      <?php 
	     $sqltec=mysql_query("select * from tipoestacivil where  idestcivil='".$rowclc['idestcivil']."'", $conn) or die(mysql_error());
        $rowtec=mysql_fetch_array($sqltec);
		echo "<option value = ".$rowtec["idestcivil"]." selected='selected'>".nl2br($rowtec["desestcivil"])."</option>";
		
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo4" id="sexo4">
      <?php if ($rowclc['sexo']=="M"){
		      echo "<option value='M' selected='selected'>MACULINO</option>";
			} else{
			  echo "<option value='F' selected='selected'>FEMEMNINO</option>";
			}  
		?>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select></td>
    <td height="30" align="right" class="camposss">&nbsp;</td>
    <td height="30"><label></label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select style="width:120px;" name="nacionalidad4" id="nacionalidad4">
      <option value = "177" selected="selected">PERU</option>
      <?php
		  while($rownaci=mysql_fetch_array($naci)){
		  echo "<option value = ".$rownaci["idnacionalidad"].">".nl2br($rownaci["desnacionalidad"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente4" id="residente4">
        <?php if ($rowclc['residente']=="1"){
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
    <td height="30"><input type="text" style="text-transform:uppercase; background:#FFFFFF" name="natper4" id="natper4" value="<?php echo $rowclc['natper'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie4" type="text" id="cumpclie4" style="text-transform:uppercase; background:#FFFFFF" size="20" value="<?php echo $rowclc['cumpclie'];  ?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a href="#" onclick="ggclie4()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc4" type="hidden" id="codubisc4" size="15" value="<?php echo $rowclc['idubigeo'];  ?>" />
        <input name="idprofesion4" type="hidden" id="idprofesion4" size="15" value="<?php echo $rowclc['idprofesion'];  ?>" />
        <input name="idcargoo4" type="hidden" id="idcargoo4" size="15" value="<?php echo $rowclc['idcargoprofe'];  ?>" />
        <input name="codclie4" type="hidden" id="codclie4" size="15" value="<?php echo $rowclc['idcliente'];  ?>" /></td></td>
  </tr>
</table>
