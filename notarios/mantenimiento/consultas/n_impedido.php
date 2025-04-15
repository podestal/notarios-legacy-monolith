<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../stylesglobal.css"/>


<title>Documento sin t&iacute;tulo</title>
</head>

<body>


<?php

	include("../../extraprotocolares/view/funciones.php");
    include("../../conexion.php");
    $conexion = Conectar();
	
	
	$sql_impedido=mysql_query("SELECT MAX(idimpedido) AS idimpedido FROM impedidos",$conexion);
	
	$rs=mysql_fetch_array($sql_impedido);
	
	if(!empty($rs)){
		$cod_imp=intval($rs["idimpedido"]) + 1;
	}else{
		$cod_imp=1;
	}
	
	?>
<div id="nuevo">
<form id="frm_ncli" name="frm_ncli" style="width:100%; height:auto;">

<table width="580" height="auto"  cellpadding="0" cellspacing="0">
<tr>
  <td align="right" width="35"><a  onclick="cerrarnuevo();"><img src="../../iconos/cerrar.png" width="21" height="20" /></a>
<tr height="30" style="background-color:#264965">
  <td align="center"><span style="font-size:14px; font-family:Verdana, Geneva, sans-serif; color:#FFF">Nuevo Registro Impedidos / Tachados</span></td>
</tr>
  <tr>
  <td><table>
      <tr height="35">
        <td width="80"><span class="titubuskar0">&nbsp;&nbsp;N°</span></td>
        <td width="158"><div id="myDiv"><input id="n_cod" name="n_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $cod_imp; ?>" readonly /></div></td>
        <td width="97"><span class="titubuskar0" style="margin-left:8px">Fecha Ingreso</span></td>
        <td width="205"><input id="n_fecha" name="n_fecha" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo date("d/m/Y") ?>" readonly /></td>
      </tr>
      <tr>
        <td><span class="titubuskar0" style="margin-left:8px">Entidad</span></td>
        <td colspan="3">
          <select name="entidad" id="entidad" onchange="mostar_enti(this.value)">
          <option value="" selected="selected">SELECCIONE ENTIDAD</option>
            <option value="CNL">CNL</option>
            <option value="NOTARIO">NOTARIO</option>
            <option value="PNP">PNP</option>
            <option value="PODER JUDICIAL">PODER JUDICIAL</option>
            <option value="MINISTERIO PUBLICO">MINISTERIO PUBLICO</option>
            <option value="MINISTERIO DEL INTERIOR">MINISTERIO DEL INTERIOR</option>
            <option value="OTROS">OTROS</option>
          </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input id="n_impentidad" name="n_impentidad" type="text" class="Estilo7" style="width:465px; text-transform:uppercase" maxlength="80" onclick="focusentidad();" readonly="readonly" /></td>
      </tr>
      <tr>
        <td><span class="titubuskar0" style="margin-left:8px">Descripcion</span></td>
        <td colspan="3"><textarea id="n_impmotivo" cols="64" rows="4" style="text-transform:uppercase" class="Estilo7" name="n_impmotivo" onclick="focusmotivo();" ></textarea></td>
      </tr>
      
      <!-- AQUI SE CARGA EL NOMBRE DEL CLIENTE -->
      <tr height="35" align="center">
        <td height="28" colspan="4"><input type="button" value="Nuevo registro"  style="width:120px" onclick="limpiar();"/>    &nbsp;      <input type="button" id="enviar" name="enviar" value="Guardar" class="Estilo7" style="width:70px" onclick="registrar_impedido()"/></td>
      </tr>
      <tr height="35" align="center">
        <td height="426" colspan="4"><div id="list_impe" style="display:none">
        <table>
  <tr height="35">
    <td height="37" colspan="4"><table width="543" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="26" align="center" bgcolor="#003366"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF"><strong>Ingresar Impedidos / Tachados al Registro</strong></span></td>
      </tr>
    </table></td>
  </tr>
  <tr height="35">
    <td><span class='titubuskar0' style="margin-left:8px">Buscar por</span></td>
    <td width="184"><select id="tip_per" name="tip_per" class="Estilo7" style="width:153px" >
      <option value="0">--Tipo Persona--</option>
      <option value="N">--Natural--</option>
      <option value="J">--Juridica--</option>
    </select></td>
    <td width="61"><span class="titubuskar0" style="margin-left:8px">Cliente</span></td>
    <td width="244"><span style="color:red; margin-left:5px">
      <input id="cliente" name="cliente" type="text"  class="Estilo7" style="width:200px; text-transform:uppercase" onkeypress="sendCli(event);" maxlength="80" />
    </span></td>
  </tr>
  <tr>
    <td width="92" align="center"><span class='titubuskar0' style="margin-left:8px">o</span></td>
    <td><select id="tip_doc" name="tip_doc" class="Estilo7" style="width:153px" onchange="cambiar_doic(1, this.value)" >
      <option value="0" selected="selected">--Tipo Documento--</option>
      <?php
                            	
								
				$exe_tipdoc=mysql_query("select * from tipodocumento",$conexion);
				while($tipdoc = mysql_fetch_array($exe_tipdoc)){ 
                                   
					 echo ' <option value="'.$tipdoc['idtipdoc'].'">'.$tipdoc['destipdoc'].'</option>';
								   
								    }
                                    ?>
    </select></td>
    <td style="margin-left:8px"><span class='titubuskar0' style="margin-left:8px">N&uacute;mero</span></td>
    <td><input id="n_doc" name="n_doc" type="text" class="Estilo7" style="width:205px; text-transform:uppercase" maxlength="25"  onkeypress="sendDNI(event);"/></td>
  </tr>
  <!-- AQUI SE CARGA EL NOMBRE DEL CLIENTE -->
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><div id="respuesta"></div></td>
  </tr>
  <tr height="35" align="center">
    <td height="37" colspan="2">&nbsp;</td>
    <td height="37" colspan="2"><input type="button" value="Agregar al Listado"  style="width:120px" onclick="regimpedido();"/></td>
  </tr>
  <tr height="35" align="center">
    <td height="25" colspan="4"><table width="543" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="26" align="center" bgcolor="#003366"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF"><strong>Listado de Impedidos / Tachados Ingresados al Registro</strong></span></td>
      </tr>
    </table></td>
  </tr>
  <tr height="35" align="center">
    <td height="202" colspan="4"><div id="tacha" style=" height:200px; overflow:auto;"></div></td>
  </tr>
</table>
        
        </div></td>
      </tr>
    </table>

    </form>
        </div>  

      <div id="clientenew" class="dalib" style="display:none; z-index:8; font-weight: bold; font-family: Calibri; font-style: italic;">
      <form id="impe_n_empresa" name="impe_n_empresa" >
   
  <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="editcampp">Agregar Cliente</td>
                              <td width="35"><a  onclick="cerrar()"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td height="233" colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                      <table width="637" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                                        <tr>
                                          <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
                                          <td height="32" >&nbsp;</td>
                                          <td height="32" colspan="5"> <input name="nrazonsocial" type="text" style="text-transform:uppercase" id="nrazonsocial" size="60" onkeyup="razonsociall();" />
      <input name="razonsocial" type="hidden" style="text-transform:uppercase" id="razonsocial" size="60" />
      <span style="color:#F00">*</span>
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
                                                      <td width="725"><div id="tipocondicion" class="tipoacto"></div></td>
                                                    </tr>
                                                  </table></td>
                                                </tr>
                                                <tr>
                                                  <td width="620" height="10">&nbsp;</td>
                                                  <td width="95"><a href='#' onclick="ocultar_desc('menucondicion')"><img src="../../iconos/aceptar.jpg" alt="" width="95" height="29" border="0" /></a></td>
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
                                        <td colspan="2"></td>
                                        <td><select id="tip_doc_cli" name="tip_doc_cli" class="Estilo7" style="width:153px" onchange="cambiar_doic(1, this.value)" >
      <option value="0" selected="selected">--Tipo Documento--</option>
      <?php
                            	
								
				$exe_tipdoc=mysql_query("select * from tipodocumento",$conexion);
				while($tipdoc = mysql_fetch_array($exe_tipdoc)){ 
                                   
					 echo ' <option value="'.$tipdoc['idtipdoc'].'">'.$tipdoc['destipdoc'].'</option>';
								   
								    }
                                    ?>
    </select></td>
    <td style="margin-left:8px"><span class='titubuskar0' style="margin-left:8px">N&uacute;mero</span></td>
    <td><input id="n_doc_r" name="n_doc_r" type="text" class="Estilo7" style="width:205px; text-transform:uppercase" onkeypress="sendDNI(event);" maxlength="25" /></td>
                                        </tr>
                                        <tr>
                                          <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
                                          <td height="26" >&nbsp;</td>
                                          <td height="26" colspan="5"><input name="ndomfiscal" style="text-transform:uppercase" type="text" onkeyup="domfiscall();" id="ndomfiscal" size="60" /><input name="domfiscal" style="text-transform:uppercase"  type="hidden" id="domfiscal" size="60" /><span style="color:#F00">*</span></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5" valign="middle"><table width="522" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="428"><input name="ubigen" readonly type="text" id="ubigen" size="60" />
                                                <span style="color:#F00">*</span></td>
                                              <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss"><span class="camposss">Objeto Social</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5"><input name="contacempresa" style="text-transform:uppercase" type="text" id="contacempresa" size="60" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td width="155" height="30"><input type="text" name="fechaconstitu" class="tcal" style="text-transform:uppercase" id="fechaconstitu" /></td>
                                          <td width="15" height="30" >&nbsp;</td>
                                          <td width="138" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
                                          <td width="14" height="30" >&nbsp;</td>
                                          <td height="30" ><input type="text" name="numregistro" style="text-transform:uppercase" id="numregistro" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Sede Registral</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30"><label><span class="titupatrimo">
                                            <select name="idsedereg3" id="idsedereg3">
                                            <option selected="selected" value="09">IX - Lima</option>
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
                                            <input type="text" name="numpartida" style="text-transform:uppercase" id="numpartida" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td width="141" height="30" align="right" ><span class="camposss">Telefono</span></td>
                                          <td width="10" height="30" >&nbsp;</td>
                                          <td height="30"><label>
                                            <input type="text" name="telempresa" style="text-transform:uppercase" id="telempresa" />
                                          </label></td>
                                          <td height="30">&nbsp;</td>
                                          <td height="30" align="right" ><span class="camposss">CIIU</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" ><label>
                                            <select style="width:200px;" name="actmunicipal" id="actmunicipal">
                                            <option value="">SELECCIONAR</option>
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
                                          <td height="30" align="right" ><span class="camposss">Correo de la empresa</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" valign="middle" ><label>
                                            <input name="mailempresa" type="text" id="mailempresa" size="60" />
                                          </label>
                                            <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 50px; top: 120px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="24" height="29">&nbsp;</td>
                                                  <td width="585" class="camposss">Seleccionar Ubigeo:</td>
                                                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td><label>
                                                    <input name="_buscaubi" style="text-transform:uppercase; background:#FFF;" type="text" id="_buscaubi" size="65" onkeypress="buscaubigeosc2()" />
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
                                          <td height="30" colspan="5" ><a  onclick="ggclie1dom2()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" />
                                            <input name="codubi" type="hidden" id="codubi" size="15" />
                                          </a></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table></form>
 
    </div>
    
          <div id="clientenewdni" class="dalib" style="display:none; z-index:8;">
          <form id="impe_n_cliente" name="impe_n_cliente" >
        <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="">Agregar Cliente</td>
                              <td width="35"><a  onclick="cerrar2();"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                    <table width="607" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="napepat" style="text-transform:uppercase" id="napepat" onkeyup="apepaterno();" /><input type="hidden" name="apepat" style="text-transform:uppercase" id="apepat" /><span style="color:#F00">*</span></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="179" height="30"><input type="text" name="napemat" style="text-transform:uppercase" id="napemat" onkeyup="apematerno();" /><input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="nprinom" style="text-transform:uppercase" id="nprinom" onkeyup="prinombre();" /><input type="hidden" name="prinom" style="text-transform:uppercase" id="prinom" /><span style="color:#F00">*</span></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="nsegnom" style="text-transform:uppercase" id="nsegnom" onkeyup="segnombre();" /><input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccion" style="text-transform:uppercase" type="text" id="ndireccion" size="55" /><input name="direccion" style="text-transform:uppercase" type="hidden" id="direccion" size="55" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
  <td colspan="2"></td>
   <td><select id="tip_doc_cli" name="tip_doc_cli" class="Estilo7" style="width:153px" onchange="cambiar_doic(1, this.value)" >
      <option value="0" selected="selected">--Tipo Documento--</option>
      <?php
                            	
								
				$exe_tipdoc=mysql_query("select * from tipodocumento",$conexion);
				while($tipdoc = mysql_fetch_array($exe_tipdoc)){ 
                                   
					 echo ' <option value="'.$tipdoc['idtipdoc'].'">'.$tipdoc['destipdoc'].'</option>';
								   
								    }
                                    ?>
    </select></td>
    <td style="margin-left:8px"><span class='titubuskar0' style="margin-left:8px">N&uacute;mero</span></td>
    <td><input id="n_doc_n" name="n_doc_n" type="text" class="Estilo7" style="width:205px; text-transform:uppercase" maxlength="25" /></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td height="44" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3"><table width="471" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="336"><input name="ubigensc" readonly type="text" id="ubigensc" size="40" /><span style="color:#F00">*</span></td>
        <td width="135"><a href="#" onclick="mostrar_desc('buscaubisc')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubisc" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Ubigeo:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubisc')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="_buscaubisc" type="text" id="_buscaubisc"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onkeypress="buscaubigeossc()" />
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
    <td height="30"><select name="idestcivil" id="idestcivil">
      <option value = "0" selected="selected">SELECCIONE ESTADO</option>
      <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" colspan="2" align="left"><div id="casado" style="display:none">
      <table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a href="#" onclick="mostrar_desc('conyugesss')"><img src="../../iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
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
    </select></td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select name="nacionalidad" id="nacionalidad" style="width:150px;">
      <option value = "177" selected="selected">PERUANA</option>
      <?php
	      $naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
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
    <td height="30"><input name="cumpclie" type="text" class="tcal" id="cumpclie" style="text-transform:uppercase" size="20" /></td>
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
    <td height="30"><a  onclick="ggclie1dom()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idprofesion" type="hidden" id="idprofesion" size="15" value="0" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" value="0" />
      <input name="nomcargoss" type="hidden" id="nomcargoss" size="40" />
      <input name="nomprofesiones" type="hidden" id="nomprofesiones" size="40" />
      <input type="hidden" name="docpaisemi" id="docpaisemi" value="PERU" /></td>
  </tr>
</table>
                                    </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table></form>
    </div>

</body></html>