<?php 
include("conexion.php");
$codigocliente=$_POST['coddcontrata2'];


$civil =mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
$naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
$consulcliente=mysql_query("Select * from cliente2 where idcontratante='$codigocliente'", $conn) or die(mysql_error());
$rowclientte = mysql_fetch_array($consulcliente);


?>
<table width="593" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
    <td height="32" >&nbsp;</td>
    <td height="32" colspan="5"><label>
      <input name="nrazonsocial" type="text" style="text-transform:uppercase" id="nrazonsocial" size="60" onkeyup="razonsociall();" value="<?php 
	  
	   $textoraz=str_replace("?","'",$rowclientte['razonsocial']);
		 $textoamperraz=str_replace("*","&",$textoraz);
		 echo strtoupper($textoamperraz);
		 
	  
	  ?>" />
      <input name="razonsocial" type="hidden" style="text-transform:uppercase" id="razonsocial" size="60" value="<?php 
	  
	
		 
		 echo strtoupper($rowclientte['razonsocial']);
	  
	  ?>" /><span style="color:#F00">*</span>
    </label>      <label></label>    <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
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
                <td width="725"><div id="tipocondicion" class="tipoacto"></div></td>
              </tr>
            </table></td>
          </tr>
        <tr>
          <td width="620" height="10">&nbsp;</td>
            <td width="95"><a href='#' onclick="ocultar_desc('menucondicion')"><img src="iconos/aceptar.png" alt="" width="95" height="29" border="0" /></a></td>
            <td height="10">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="middle"></td>
          </tr>
        <tr></tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
    <td height="26" >&nbsp;</td>
    <td height="26" colspan="5"><input name="ndomfiscal" style="text-transform:uppercase" type="text" onkeyup="domfiscall();" id="ndomfiscal" size="60" value="<?php 
	  
	  $textodom=str_replace("?","'",$rowclientte['domfiscal']);
		 $textoamperdom=str_replace("*","&",$textodom);
		 echo strtoupper($textoamperdom);
	  
	  ?>" /><input name="domfiscal" style="text-transform:uppercase"  type="hidden" id="domfiscal" size="60" value="<?php 

		 echo strtoupper($rowclientte['domfiscal']);
	  
	  ?>" /><span style="color:#F00">*</span></td>
  </tr>
  
  <tr>
    <td height="30" align="right" ><span class="camposss">R.U.C</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30" colspan="5" valign="middle" ><label>
      <input name="ruc_emp" type="text" id="ruc_emp" size="25" value="<?php  echo $rowclientte['numdoc']; ?>" />
    </label></td>
          </tr>
          
            
  
  <tr>
    <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
    <td height="0" >&nbsp;</td>
    <td height="0" colspan="5" valign="middle"><table width="462" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="328"><input name="ubigen" type="text" id="ubigen" size="50" value="<?php
		
		$ubii=mysql_query("Select * from ubigeo where coddis='".$rowclientte['idubigeo']."'", $conn) or die(mysql_error());
        $rowubii = mysql_fetch_array($ubii);
		
		echo  $rowubii['nomdpto']."/".$rowubii['nomprov']."/".$rowubii['nomdis'];
		
		
		
		
		 ?>" /><span style="color:#F00">*</span></td>
        <td width="172"><a href="#" id="busubiruccc" onclick="mostrar_desc('buscaubiruc')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss"><span class="camposss">Objeto Social</span></td>
    <td height="0" >&nbsp;</td>
    <td height="0" colspan="5"><input name="contacempresa" style="text-transform:uppercase" type="text" id="contacempresa" size="60" value="<?php  echo $rowclientte['contacempresa']; ?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
    <td height="30" >&nbsp;</td>
    <td width="151" height="30"><input type="text" name="fechaconstitu" value="<?php  echo $rowclientte['fechaconstitu']; ?>" class="tcal" style="text-transform:uppercase" id="fechaconstitu" /></td>
    <td width="14" height="30" >&nbsp;</td>
    <td width="101" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
    <td width="10" height="30" >&nbsp;</td>
    <td width="204" height="30" ><input type="text" name="numregistro" value="<?php  echo $rowclientte['numregistro']; ?>" style="text-transform:uppercase" id="numregistro" /></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Sede Registral</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30"><label><span class="titupatrimo">
    <select style="width:140px;" name="idsederegemp" id="idsederegemp">
        <?php
		
		if(strlen($rowclientte['idsedereg'])==1){
			echo $var="0".$rowclientte['idsedereg'];	
		}else{
			echo $var=$rowclientte['idsedereg'];	
		}
		   $sedereg=mysql_query("Select * from sedesregistrales where idsedereg='".$var."'", $conn) or die(mysql_error());
        $rowsedereg = mysql_fetch_array($sedereg);
		echo "<option selected='selected' value=".$rowsedereg['idsedereg'].">".$rowsedereg['dessede']."</option> \n";
		   $sqlsedesss=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 
	       while($rowsedesss = mysql_fetch_array($sqlsedesss)){
	         echo "<option value=".$rowsedesss['idsedereg'].">".$rowsedesss['dessede']."</option> \n";
             }
	     ?>
     </select>

    </span></label></td>
    <td height="30">&nbsp;</td>
    <td height="30" align="right" ><span class="camposss">N° de Partida</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30" ><label>
      <input type="text" name="numpartida" style="text-transform:uppercase" id="numpartida" value="<?php  echo $rowclientte['numpartida']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td width="108" height="30" align="right" ><span class="camposss">Telefono</span></td>
    <td width="5" height="30" >&nbsp;</td>
    <td height="30"><label>
      <input type="text" name="telempresa" style="text-transform:uppercase" id="telempresa" value="<?php  echo $rowclientte['telempresa']; ?>" />
    </label></td>
    <td height="30">&nbsp;</td>
    <td height="30" align="right" ><span class="camposss">CIIU</span></td>
    <td height="30" ><span style="color:#F00">*</span></td>
    <td height="30" ><label>
       <select style="width:180px;" name="actmunicipal" id="actmunicipal">
       <?php
		
		$actmun=mysql_query("Select * from ciiu where coddivi='".$rowclientte['actmunicipal']."'", $conn) or die(mysql_error());
        $rowactmun = mysql_fetch_array($actmun);
		echo "<option selected='selected' value=".$rowactmun['coddivi'].">".$rowactmun['nombre']."</option> \n";
		
		
		   $sqlciiu=mysql_query("SELECT * FROM ciiu order by nombre asc",$conn) or die(mysql_error()); 
	       while($rowciuu = mysql_fetch_array($sqlciiu)){
	         echo "<option value=".$rowciuu['coddivi'].">".$rowciuu['nombre']."</option> \n";
             }
	     ?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Correo de la empresa</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30" colspan="5" valign="middle" ><label>
      <input name="mailempresa" type="text" id="mailempresa" size="60" value="<?php  echo $rowclientte['mailempresa']; ?>" />
    </label><div id="buscaubiruc" style="position:absolute; display:none; width:637px; height:223px; left: 8px; top: 110px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubiruc'); ubifocusruc()"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaubi" style="text-transform:uppercase" type="text" id="buscaubi" size="80" onkeypress="buscaubigeos()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulubi" style="width:585px; height:150px; overflow:auto"></div></td>
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
  <tr>
    <td height="30" align="right" >&nbsp;</td>
    <td height="30" >&nbsp;</td>
    <td height="30" colspan="5" ><a  onclick="btngrabaremp3()"><img src="iconos/grabar.png" width="94" height="29" border="0" />
      <input name="codubi" type="hidden" id="codubi" size="15" value="<?php echo $rowclientte['idubigeo']; ?>" />
      <input name="codclie3" type="hidden" id="codclie3" size="15" value="<?php echo $rowclientte['idcliente'];  ?>" />
      <input name="contra" type="hidden" id="contra" size="16" value="<?php echo $codigocliente;  ?>" />
    </a></td>
  </tr>
</table>
