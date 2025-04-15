<?php 
include("conexion.php");
include_once 'Cpu/Person.php';
$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci = mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
$error = 0;
if($tipodoc == 1){
  $objPerson = new Person(1,false);
  $objPerson->setFileCookie('cookie.txt');
  $objPerson->setDocument($numdoc);
  $objPerson->setCodeCaptcha($captcha);
  $objPerson->runQuery();
  $name1 = $objPerson->getName1();
  $name2 = $objPerson->getName2();
  $surname1 = $objPerson->getSurname1();
  $surname2 = $objPerson->getSurname2();
  $error = $objPerson->getErrorResponseContent();
  $messageDescription = $objPerson->getMessageReponseContent();

}




?>
<?php if($error != 0){ ?>

<div style="color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;"> <?php echo $messageDescription; ?></div>

<?php }else { ?>
<table width="607" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>

    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="182" height="30"><input type="text" name="apepat" style="text-transform:uppercase" id="apepat" onkeyup="apepaterno();" value="<?php if($tipodoc == 1) { echo $surname1; } ?>" />

    <!--<input type="hidden" name="apepat" style="text-transform:uppercase" id="apepat" />-->

    <span style="color:#F00">*</span></td>

    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
 <td width="179" height="30"><input type="text" value="<?php if($tipodoc == 1) { echo $surname2; } ?>" name="apemat" style="text-transform:uppercase" id="apemat" onkeyup="apematerno();" />
    <!--<input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" />-->
    <div style="position:absolute;right:40px;top:135px;cursor:pointer;"><a onclick="consultar_dni()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px" src="iconos/icon-reniec.png" alt="" width="100px" id="iconReniec"><img id="loaderReniec" style="display: none" src="loading.gif"></a></div>
    </td>
  </tr>

  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="prinom" value="<?php if($tipodoc == 1) { echo $name1; }?>" style="text-transform:uppercase" id="prinom" onkeyup="prinombre();" />
    <!--<input type="hidden" name="prinom" style="text-transform:uppercase" id="prinom" />-->
    <span style="color:#F00">*</span></td>

    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="segnom" value="<?php if($tipodoc == 1) { echo $name2; } ?>" style="text-transform:uppercase" id="segnom" onkeyup="segnombre();" />
    <!--<input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" />-->
    </td>

  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccion" style="text-transform:uppercase" type="text" id="ndireccion" size="55" onkeyup="direcction();" /><input name="direccion" style="text-transform:uppercase" type="hidden" id="direccion" size="55" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td height="44" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="371"><input name="ubigensc" readonly="readonly" type="text" id="ubigensc" size="50" /><span style="color:#F00">*</span></td>
        <td width="100"><a id="limubi" href="#" onclick="mostrar_desc('buscaubiscclie');ubifocus()"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubiscclie" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubiscclie')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaubisc" type="text" id="buscaubisc"  style="background:#FFFFFF; text-transform:uppercase" size="80" onkeyup="buscaubigeossc()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulubisc" style="width:585px; height:150px; overflow:auto"></div></td>
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
    <td height="30"><select name="idestcivil" id="idestcivil" onchange="casadito(this.value)">
      <option value = "0" selected="selected">SELECCIONE ESTADO</option>
      <?php
      while($rowcicil=mysql_fetch_array($civil)){
      echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
      }
    ?>
    </select><span style="color:#F00">*</span></td>
    <td height="30" colspan="2" align="left"><div id="casado" style="display:none">
      <table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a id="_selectConyuge1" href="#" onclick="mostrar_desc('conyugesss')"><img src="iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo" id="sexo">
      <option value = "" selected="selected">SELECCIONE SEXO</option>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select><span style="color:#F00">*</span></td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><div id="ccconyuge"><input name='cconyuge' id='cconyuge' type='hidden' value='' /></div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select name="nacionalidad" id="nacionalidad" style="width:150px;">
      <option value = "177" selected="selected">PERUANA</option>
      <?php
      while($rownaci=mysql_fetch_array($naci)){
      echo "<option value = ".$rownaci["idnacionalidad"].">".nl2br($rownaci["descripcion"])."</option>";  
      }
    ?>
    </select></td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente" id="residente">
        <option value="1" selected="selected">SI</option>
        <option value="0">NO</option>
                  </select>
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Natural de :</span></td>
    <td height="30"><input type="text" style="text-transform:uppercase" name="natper" id="natper" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie" type="text" id="cumpclie" style="text-transform:uppercase"  size="20" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" colspan="2" align="right"><span class="camposss">Pais de Emisi&oacute;n del Documento de Identidad :</span></td>
    <td height="30" colspan="2"><label>
      <input type="text" name="docpaisemi" id="docpaisemi" value="PERU" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaci&oacute;n :</span></td>
    <td height="30" colspan="3"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="306"><label>
          <input name="nomprofesiones" style="text-transform:uppercase"  type="text" id="nomprofesiones" size="40" /><span style="color:#F00" required>*</span>
        </label></td>
        <td width="160"><a id="limprofe" href="#" onclick="mostrar_desc('buscaprofe');focusprofe()"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Cargo :</span></td>
    <td height="30" colspan="3"><table width="465" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="306"><label>
          <input name="nomcargoss" readonly="readonly" style="text-transform:uppercase" type="text" id="nomcargoss" size="40" /><span style="color:#F00">*</span>
        </label></td>
        <td width="159"><a id="limcargo" href="#"  onclick="mostrar_desc('buscacargooo');focuscargo()"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel" type="text" id="telcel" size="20" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi" type="text" id="telofi" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo" type="text" id="telfijo" size="20" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email" type="text" id="email" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a  onclick="ggclie1()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubis" size="15" /><input name="idprofesion" type="hidden" id="idprofesion" size="15" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" /></td>
  </tr>
</table>
<?php } ?>

