<?php 
include("conexion.php");
include("includes/combo.php");
$codigocliente=$_POST['coddcontrata2'];


$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
$consulcliente=mysql_query("Select * from cliente2 where idcontratante='$codigocliente'", $conn) or die(mysql_error());
$rowclientte = mysql_fetch_array($consulcliente);


?>

<table width="598" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="166" height="30"><input type="text" name="napepat3" style="text-transform:uppercase; background:#FFFFFF" id="napepat3" onkeyup="apepaterno3();" value="<?php 
	
	$textorpat=str_replace("?","'",$rowclientte['apepat']);
		 $textoamperpat=str_replace("*","&",$textorpat);
		 echo strtoupper($textoamperpat);
	
	 ?>" />
    
    <input type="hidden" name="apepat3" style="text-transform:uppercase; background:#FFFFFF" id="apepat3" value="<?php echo $rowclientte['apepat'];  ?>" />
    </td>
    <td width="133" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="170" height="30"><input type="text" name="napemat3"  style="text-transform:uppercase; background:#FFFFFF" onkeyup="apematerno3();" value="<?php 
	
	$textormat=str_replace("?","'",$rowclientte['apemat']);
		 $textoampermat=str_replace("*","&",$textormat);
						  echo strtoupper($textoampermat);
	
	 ?>" id="napemat3" />
    
    <input type="hidden" name="apemat3" style="text-transform:uppercase; background:#FFFFFF" value="<?php echo $rowclientte['apemat'];  ?>" id="apemat3" />
    
    </td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="nprinom3" style="text-transform:uppercase; background:#FFFFFF" onkeyup="prinombre3();" id="nprinom3" value="<?php 
	
	$textorpri=str_replace("?","'",$rowclientte['prinom']);
		 $textoamperpri=str_replace("*","&",$textorpri);
						  echo strtoupper($textoamperpri);
 ?>" />
    
    <input type="hidden" name="prinom3" style="text-transform:uppercase; background:#FFFFFF" id="prinom3" value="<?php echo $rowclientte['prinom'];  ?>" />
    
    </td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="nsegnom3" onkeyup="segnombre3();" style="text-transform:uppercase; background:#FFFFFF" id="nsegnom3" value="<?php 
	
	$textorseg=str_replace("?","'",$rowclientte['segnom']);
		 $textoamperseg=str_replace("*","&",$textorseg);
						  echo strtoupper($textoamperseg);
		
	 ?>" />
    
    <input type="hidden" name="segnom3" style="text-transform:uppercase; background:#FFFFFF" id="segnom3" value="<?php echo $rowclientte['segnom'];  ?>" />
    
    
    </td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccion3" onkeyup="direcction3();" style="text-transform:uppercase; background:#FFFFFF" type="text" id="ndireccion3" value="<?php 
	
	 $textordir=str_replace("?","'",$rowclientte['direccion']);
		 $textoamperdir=str_replace("*","&",$textordir);
		 echo strtoupper($textoamperdir);
 ?>" size="60" />
    
    
    <input name="direccion3" style="text-transform:uppercase; background:#FFFFFF" type="hidden" id="direccion3" value="<?php echo $rowclientte['direccion'];  ?>" size="60" />
    
    </td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="30" colspan="3"><table width="412" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="289"><input name="ubigensc3"    style="background:#FFFFFF" type="text" id="ubigensc3" size="45" value="<?php 
		$sqlubiubi=mysql_query("select * from ubigeo where  coddis='".$rowclientte['idubigeo']."'", $conn) or die(mysql_error());
        $rowubiubi=mysql_fetch_array($sqlubiubi);
		echo $rowubiubi['nomdpto']."/".$rowubiubi['nomprov']."/".$rowubiubi['nomdis']; ?>" />        </td>
        <td width="223"><a href="#" id="busedit" onClick="mostrar_desc('buscaubisc3e')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
              <div id="buscaubisc3e" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                <table width="637" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24" height="29">&nbsp;</td>
                    <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
                    <td width="28"><a href="#" onClick="ocultar_desc('buscaubisc3e')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="buscaubisc3" type="text" id="buscaubisc3"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaubigeossc3()" />
                    </label></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div id="resulubisc3" style="width:585px; height:150px; overflow:auto"></div></td>
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
			$oCombo->name       = "idestcivil3";
			$oCombo->style      = ""; 
			$oCombo->click      = "casadito2(this.value)";   
			$oCombo->selected   = $rowclientte['idestcivil'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
</td>
    <td height="30" colspan="2" align="left"><div id="ccconyuge2"><input name='cconyuge3' type='hidden' value='<?php echo $rowclientte['conyuge'];  ?>' id="cconyuge3" /></div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">Casado(a) con :</td>
    <td height="30" colspan="3"><?php if ($rowclientte['idestcivil']==2){
	$sqlteccc=mysql_query("select * from cliente where idcliente='".$rowclientte['conyuge']."'", $conn) or die(mysql_error());
        $rowteccc=mysql_fetch_array($sqlteccc);
		echo $rowteccc["nombre"]." ";
		echo"<a id='_selectConyuge2' href='#' onclick='hhh()'><img src='iconos/grabarconyuge2.png' width='111' height='29' border='0' /></a>";
	}
	?><div id="casado2" style="display:none"><table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a id="_busConyuge2" href="#" onclick="mostrar_desc('conyugesss2')"><img src="iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
        </tr>
      </table>
    </div></div></td>
  </tr>  
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo3" id="sexo3">
      <?php if ($rowclientte['sexo']=="M"){
		      echo "<option value='M' selected='selected'>MASCULINO</option>
			  		<option value='F' >FEMENINO</option>";
			} else{
			  echo "<option value='F' selected='selected'>FEMENINO</option>
			  		<option value='M' >MASCULINO</option>";
			}  
		?>
      <!--<option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>-->
    </select>
    <input name="numdoc3" style="background:#FFFFFF" type="hidden"  id="numdoc3" size="20" value="<?php echo $rowclientte['numdoc'];  ?>" /></td>
    <td height="30" align="right" class="camposss"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT CAST(tipodocumento.codtipdoc AS DECIMAL) AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "175"; 
			$oCombo->name       = "tipdocu";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowclientte['idtipdoc'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
    <td height="30"><input name="numdoced3" style="background:#FFFFFF" type="text" id="numdoced3" size="20" value="<?php echo $rowclientte['numdoc'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30">
    <?php 
                $oCombo = new CmbList()  ;					 		
                $oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des' FROM nacionalidades 
    WHERE nacionalidades.descripcion <> '' ORDER BY nacionalidades.descripcion ASC"; 
				//echo  $oCombo->dataSource;
                $oCombo->value      = "id";
                $oCombo->text       = "des";
                $oCombo->size       = "150"; 
                $oCombo->name       = "nacionalidad3";
                $oCombo->style      = ""; 
                $oCombo->click      = "//eval_idoppago(this.value)";   
                $oCombo->selected   = $rowclientte['nacionalidad'];
                $oCombo->Show();
                $oCombo->oDesCon(); 
    ?>
    </td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente3" id="residente3">
        <?php if ($rowclientte['residente']=="1"){
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
    <td height="30"><input type="text" style="text-transform:uppercase; background:#FFFFFF" name="natper3" id="natper3" value="<?php echo $rowclientte['natper'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie3" type="text" id="cumpclie3" style="text-transform:uppercase; background:#FFFFFF" size="20" value="<?php echo $rowclientte['cumpclie'];  ?>"/></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="right"><span class="camposss">Pais de Emisi&oacute;n del Documento de Identidad :</span></td>
    <td height="30" colspan="2"><label>
      <input type="text" style="text-transform:uppercase; background:#FFFFFF" name="docpaisemi3" id="docpaisemi3" value="<?php echo $rowclientte['docpaisemi'];  ?>" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaci&oacute;n :</span></td>
    <td height="30" colspan="3"><table width="410" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomprofesiones3"  style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomprofesiones3" size="45" value="<?php echo $rowclientte['detaprofesion'];  ?>" />
        </label></td>
        <td width="129"><a href="#" id="busprofe3" onClick="mostrar_desc('buscaprofe3')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Cargo :</span></td>
    <td height="30" colspan="3"><table width="409" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomcargoss3" readonly="readonly" style="text-transform:uppercase; background:#FFFFFF" type="text" id="nomcargoss3" size="45" value="<?php echo $rowclientte['profocupa'];  ?>" />
        </label></td>
        <td width="128"><a href="#" id="buscargo3" onClick="mostrar_desc('buscacargooo3')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telcel3" size="20" value="<?php echo $rowclientte['telcel'];  ?>" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telofi3" size="20" value="<?php echo $rowclientte['telofi'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo3" style="text-transform:uppercase; background:#FFFFFF" type="text" id="telfijo3" size="20" value="<?php echo $rowclientte['telfijo'];  ?>" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email3" style="background:#FFFFFF" type="text" id="email3" size="60" value="<?php echo $rowclientte['email'];  ?>" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a href="#" onclick="ggcliecnt();"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc3" type="hidden" id="codubisc3" size="15" value="<?php echo $rowclientte['idubigeo'];  ?>" />
        <input name="idprofesion3" type="hidden" id="idprofesion3" size="15" value="<?php echo $rowclientte['idprofesion'];  ?>" />
        <input name="idcargoo3" type="hidden" id="idcargoo3" size="15" value="<?php echo $rowclientte['idcargoprofe'];  ?>" />
        <input name="codclie3" type="hidden" id="codclie3" size="15" value="<?php echo $rowclientte['idcliente'];  ?>" />
        <?php 
		
		$docconyu =mysql_query("SELECT * FROM cliente where idcliente='".$rowclientte['conyuge']."'",$conn) or die(mysql_error());
		$rowdocconyu = mysql_fetch_array($docconyu);
		?>
        
        <input name="conyu" type="hidden" id="conyu" size="15" value="<?php echo $rowdocconyu['numdoc'];  ?>" />
      <input name="tpdoc" type="hidden" id="tpdoc" size="15" value="<?php echo $rowdocconyu['idtipdoc'];  ?>" />
      <input name="idconyucli" type="hidden" id="idconyucli" size="15" value="<?php echo $rowclientte['conyuge'];  ?>" />  
        </td>
  </tr>
</table>
