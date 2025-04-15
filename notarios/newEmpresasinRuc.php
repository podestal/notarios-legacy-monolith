<?php 
include("conexion.php");
?><style type="text/css">
div.representante {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:638px;
	height:220px;
	position:absolute;
	left: 549px;
	top: 496px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}

div.allcontrata {width:600px; height:150px; overflow:auto;}
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}
</style>
<table width="637" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
    <td height="32" >&nbsp;</td>
    <td height="32" colspan="5"><label>
      <input name="razonsocial_sr" type="text" style="text-transform:uppercase" id="razonsocial_sr" size="60" /><span style="color:#F00">*</span>
    </label>      <label></label>   <a id="bus_coincidencia" href="#"> <img src="images/search.png" width="15" height="15" alt="" /></a><span id="muesresulb"></span> <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
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
    <td height="26" colspan="5"><input name="domfiscal_sr" style="text-transform:uppercase" type="text" id="domfiscal_sr" size="60" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
    <td height="0" >&nbsp;</td>
    <td height="0" colspan="5" valign="middle"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="381"><input name="ubigen_sr" type="text" id="ubigen_sr" size="60" /><span style="color:#F00">*</span></td>
        <td width="119"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
    <td height="30" >&nbsp;</td>
    <td width="152" height="30"><input type="text" name="fechaconstitu_sr" class="tcal" style="text-transform:uppercase" id="fechaconstitu_sr" /></td>
    <td width="14" height="30" >&nbsp;</td>
    <td width="135" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
    <td width="11" height="30" >&nbsp;</td>
    <td width="208" height="30" ><input type="text" name="numregistro_sr" style="text-transform:uppercase" id="numregistro_sr" /></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Sede Registral</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30"><label><span class="titupatrimo">
      <select name="idsedereg3_sr" id="idsedereg3_sr">
        <?php
		   
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
      <input type="text" name="numpartida_sr" style="text-transform:uppercase" id="numpartida_sr" />
    </label></td>
  </tr>
  <tr>
    <td width="110" height="30" align="right" ><span class="camposss">Telefono</span></td>
    <td width="7" height="30" >&nbsp;</td>
    <td height="30"><label>
      <input type="text" name="telempresa_sr" style="text-transform:uppercase" id="telempresa_sr" />
    </label></td>
    <td height="30">&nbsp;</td>
    <td height="30" align="right" >CIIU</td>
    <td height="30" >&nbsp;</td>
    <td height="30" ><label>
       <select style="width:200px;" name="actmunicipal_sr" id="actmunicipal_sr">
        <?php
		   
		   $sqlciiu=mysql_query("SELECT * FROM ciiu",$conn) or die(mysql_error()); 
	       while($rowciuu = mysql_fetch_array($sqlciiu)){
	         echo "<option value=".$rowciuu['coddivi'].">".$rowciuu['nombre']."</option> \n";
             }
	     ?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Objeto Social</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30" colspan="5" valign="middle" ><input name="contacempresa_sr" style="text-transform:uppercase" type="text" id="contacempresa_sr" size="60" /></td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Correo de la empresa</span></td>
    <td height="30" >&nbsp;</td>
    <td height="30" colspan="5" valign="middle" ><label>
      <input name="mailempresa_sr" type="text" id="mailempresa_sr" size="60" />
    </label>      <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 8px; top: 110px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585">Seleccionar Ubigeo:</td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaubi" style="text-transform:uppercase" type="text" id="buscaubi" size="50" onkeypress="buscaubigeos()" />
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
    <td height="30" colspan="4" ><a id="btn_saveEmpsinRuc"  onclick="btngrabaremp()"><img src="iconos/grabar.png" width="94" height="29" border="0" />
      <input name="codubi_sr" type="hidden" id="codubi_sr" size="15" />
      <input name="_eval_idcliente" type="hidden" id="_eval_idcliente" size="15" />
    </a></td>
    <td height="30" ><div id="divResultado_save" style="display:none">R.U.C.: <input type='text' id='numdocnew' name='numdocnew' size='25' /></div></td>
  </tr>
</table>
