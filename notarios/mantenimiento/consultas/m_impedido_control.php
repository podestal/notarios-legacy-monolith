

  
<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_cli = $_REQUEST['id_cliente'];
	
	$sql_1=mysql_query("SELECT DISTINCT impedidos.idimpedido AS 'id',
impedidos.`origen` AS 'entidad',impedidos.`motivo` AS 'motivo' FROM deta_impe 
INNER JOIN impedidos ON impedidos.`idimpedido` = `deta_impe`.`idimpedido`
WHERE  impedidos.idimpedido='$id_cli'
ORDER BY impedidos.idimpedido",$conexion);
	
	?>
	
	<div id="nuevo">
<form id="frm_mcli" name="frm_mcli" style="width:100%; height:auto ">
<div><span class='submenutitu' style="position:absolute; top:5px; left:555px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mimpedido_control()"><a  onclick="cerrar_mimpedido_control();"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></span></div>

    <table width="470" height="auto"  cellpadding="0" cellspacing="0">
   <tr height="30" style="background-color:#003366">
  <td align="center" colspan="4"><span style="font-size:14px; font-family:Verdana, Geneva, sans-serif; color:#FFF">Edicion de Registro Impedidos / Tachados</span></td>
  <tr><td height="10"></td></tr>
</tr>    
        <tr>
        	
                		
                            <td width="98"><span class="titubuskar0" style="margin-left:8px">Código</span></td>
                            <td width="152"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_cli; ?>" readonly /></td>
                            <td width="140"><span class="titubuskar0" style="margin-left:8px">Fecha de ingreso</span></span></td>
                          <td width="128"><input id="m_fecha" name="m_fecha" type="text" class="Estilo7" style="width:100px; background-color:#CCC " value="<?php echo date("d/m/Y") ?>" readonly /></td>
                        </tr>
      <tr>
        <td><span class="titubuskar0" style="margin-left:8px">Entidad</span></td>
        <td colspan="3">
          <select name="entidad" id="entidad" onChange="mostar_enti(this.value)">
          <?php 
		  $rs1=mysql_fetch_assoc($sql_1);
		  echo '<option value="'.$rs1["entidad"].'">CNL</option>';
		  ?>
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
        <td colspan="3"><input id="n_impentidad" name="n_impentidad" type="text" class="Estilo7" style="width:465px; text-transform:uppercase" maxlength="80" onClick="focusentidad();" readonly="readonly" value="<?php echo $rs1["entidad"];?>" /></td>
      </tr>
      <tr>
        <td><span class="titubuskar0" style="margin-left:8px">Descripcion</span></td>
        <td colspan="3"><textarea id="n_impmotivo" cols="64" rows="4" style="text-transform:uppercase" class="Estilo7" name="n_impmotivo" onClick="focusmotivo();" ><?php echo $rs1["motivo"];?></textarea></td>
      </tr> 
      
      <tr height="35" align="center">
            <td height="52" colspan="4"><input type="button" value="Modificar Cabecera" class="Estilo7" style="width:120px" onClick="mod_impedido_cab('<?php echo $id_cli; ?>')"/></td>
      </tr>                   
  <!-- AQUI EMPIEZA EL LISTADO -->
  
  <tr height="35" align="center">
        <td height="426" colspan="4"><div id="list_impe" style="display:">
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
    <td width="184"><select id="tip_per2" name="tip_per2" class="Estilo7" style="width:153px" >
      <option value="">--Tipo Persona--</option>
      <option value="N">--Natural--</option>
      <option value="J">--Juridica--</option>
    </select></td>
    <td width="61"><span class="titubuskar0" style="margin-left:8px">Cliente</span></td>
    <td width="244"><span style="color:red; margin-left:5px">
      <input id="cliente1" name="cliente1" type="text"  class="Estilo7" style="width:200px; text-transform:uppercase" onKeyPress="sendCli2(event);" maxlength="80" />
    </span></td>
  </tr>
  <tr>
    <td width="92" align="center"><span class='titubuskar0' style="margin-left:8px">o</span></td>
    <td><select id="tip_doc2" name="tip_doc2" class="Estilo7" style="width:153px" onChange="cambiar_doic(1, this.value)" >
      <option value="" selected="selected">--Tipo Documento--</option>
      <?php
                            	
								
				$exe_tipdoc=mysql_query("select * from tipodocumento",$conexion);
				while($tipdoc = mysql_fetch_array($exe_tipdoc)){ 
                                   
					 echo ' <option value="'.$tipdoc['idtipdoc'].'">'.$tipdoc['destipdoc'].'</option>';
								   
								    }
                                    ?>
    </select></td>
    <td style="margin-left:8px"><span class='titubuskar0' style="margin-left:8px">N&uacute;mero</span></td>
    <td><input id="n_doc1" name="n_doc1" type="text" class="Estilo7" style="width:205px; text-transform:uppercase" maxlength="25" onKeyPress="sendDNI2(event);" /></td>
  </tr>

        
  <!-- AQUI SE CARGA EL NOMBRE DEL CLIENTE -->
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><div id="respuesta2"></div></td>
  </tr>
  <tr height="35" align="center">
    <td height="37" colspan="2">&nbsp;</td>
    <td height="37" colspan="2"><input type="button" value="Agregar al Listado"  style="width:120px" onClick="regimpedido_m();"/></td>
  </tr>
  <tr height="35" align="center">
    <td height="25" colspan="4"><table width="543" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="26" align="center" bgcolor="#003366"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF"><strong>Listado de Impedidos / Tachados Ingresados al Registro</strong></span></td>
      </tr>
    </table></td>
  </tr>
  <tr height="35" align="center">
    <td height="202" colspan="4"><div id="tacha_m" style=" height:200px; overflow:auto;">
    
    
    
    <?php 
	
	 echo '<table width="500" border="1" bordercolor="#003366" cellspacing="0" cellpadding="0">';
	
$sql=mysql_query("select * from deta_impe where idimpedido='".$id_cli."'",$conexion);
$contador=1;
 while($row=mysql_fetch_array($sql)){
  
  echo '
  <tr>
    <td width="15" align="center">'.$contador.'</td>
    <td width="446">';
	 
	 $sql2=mysql_query("select * from cliente where idcliente='".$row['idcliente']."'",$conexion);
	 $row2=mysql_fetch_array($sql2);
	 
	 echo holaacentos(strtoupper($row2['prinom']." ".$row2['segnom']." ".$row2['apepat']." ".$row2['apemat']." ".$row2['razonsocial']));
	

	echo"</td>
    <td width='39' align='center'><img id='".$row["idcliente"]."' name='$id_cli' src='../../iconos/cerrar.png' width='21' height='20' onclick='eliminar_tachado_m(this.id,this.name)'/></td>
  </tr>";
  $contador++;
  }
	
echo '</table>';	
	
	?></div></td>
     
      <tr align="center">
            <td height="52" colspan="4"><input type="button" value="Mostrar/Actualizar" class="Estilo7" style="width:120px" onClick="mostrar_tachados_m('<?php echo $id_cli; ?>')"/></td>
      </tr>       
  </tr>
</table>
        
        </div></td>
      </tr>
    </table>

    </form>
    </div> 

    
   <div id="clientenew2" class="dalib" style="display:none;overflow:scroll; z-index:8; font-weight: bold; font-family: Calibri; font-style: italic;">
   <form id="impe_m_empresa" name="impe_m_empresa" >
  <table width="760" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="18" height="29">&nbsp;</td>
      <td width="707" class="editcampp">Agregar Cliente</td>
      <td width="35"><a  onclick="cerrar2_1()"><img alt=""  src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
    </tr>
    <tr>
      <td height="233" colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                <table width="637" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                  <tr>
                    <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
                    <td height="32" >&nbsp;</td>
                    <td height="32" colspan="5"><input name="mrazonsocial" type="text" style="text-transform:uppercase" id="mrazonsocial" size="60" onkeyup="razonsociall();" />
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
                          <tr><td></td></tr>
                        </table>
                      </div></td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td><select id="mtip_doc_cli" name="mtip_doc_cli" class="Estilo7" style="width:153px" onchange="cambiar_doic(1, this.value)" >
                        <option value="0" selected="selected">--Tipo Documento--</option>
                        <?php
                            	
								
				$exe_tipdoc=mysql_query("select * from tipodocumento",$conexion);
				while($tipdoc = mysql_fetch_array($exe_tipdoc)){ 
                                   
					 echo ' <option value="'.$tipdoc['idtipdoc'].'">'.$tipdoc['destipdoc'].'</option>';
								   
								    }
                                    ?>
                      </select></td>
                    <td style="margin-left:8px"><span class='titubuskar0' style="margin-left:8px">N&uacute;mero</span></td>
                    <td><input id="m_doc_r" name="m_doc_r" type="text" class="Estilo7" style="width:205px; text-transform:uppercase" onkeypress="sendDNI(event);" maxlength="25" /></td>
                  </tr>
                  <tr>
                    <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
                    <td height="26" >&nbsp;</td>
                    <td height="26" colspan="5"><input name="mdomfiscal" style="text-transform:uppercase" type="text" onkeyup="domfiscall();" id="mdomfiscal" size="60" />
                      <input name="domfiscal" style="text-transform:uppercase"  type="hidden" id="domfiscal" size="60" />
                      <span style="color:#F00">*</span></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
                    <td height="0" >&nbsp;</td>
                    <td height="0" colspan="5" valign="middle"><table width="522" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="428"><input name="ubigen" readonly="readonly" type="text" id="ubigen" size="60" />
                            <span style="color:#F00">*</span></td>
                          <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" ><span class="camposss">Objeto Social</span></td>
                    <td height="0" >&nbsp;</td>
                    <td height="0" colspan="5"><input name="mcontacempresa" style="text-transform:uppercase" type="text" id="mcontacempresa" size="60" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
                    <td height="30" >&nbsp;</td>
                    <td width="155" height="30"><input type="text" name="mfechaconstitu" class="tcal" style="text-transform:uppercase" id="mfechaconstitu" /></td>
                    <td width="15" height="30" >&nbsp;</td>
                    <td width="138" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
                    <td width="14" height="30" >&nbsp;</td>
                    <td height="30" ><input type="text" name="mnumregistro" style="text-transform:uppercase" id="mnumregistro" /></td>
                  </tr>
                  
                  <tr>
                    <td height="30" align="right" >&nbsp;</td>
                    <td height="30" >&nbsp;</td>
                    <td height="30" colspan="5" ><a  onclick="ggclie1dom22_editar()"><img  alt=""  src="../../iconos/grabar.png" width="94" height="29" border="0" />
                      <input name="codubi" type="hidden" id="codubi" size="15" />
                      
                                    <input name="idsedereg3" type="hidden" id="idsedereg3" size="15" value="0" />
                                                  <input name="codunumpartidabi" type="hidden" id="numpartida" size="15" />
                                                                <input name="telempresa" type="hidden" id="telempresa" size="15" />
                                                                              <input name="actmunicipal" type="hidden" id="actmunicipal" size="15" />
                                                                                            <input name="mailempresa" type="hidden" id="mailempresa" size="15" />
                      
                      
                      </a></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </form>
</div>
    
          <div id="clientenewdni2" class="dalib" style="display:none;overflow:scroll; z-index:8;">
          <form id="impe_m_cliente" name="impe_m_cliente" >
       <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="">Agregar Cliente</td>
                              <td width="35"><a  onclick="cerrar2_2();"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                    <table width="607" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="mapepat" style="text-transform:uppercase" id="mapepat" />
   <span style="color:#F00">*</span></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="179" height="30"><input type="text" name="mapemat" style="text-transform:uppercase" id="mapemat" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="mprinom" style="text-transform:uppercase" id="mprinom" onkeyup="prinombre();" /><span style="color:#F00">*</span></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="msegnom" style="text-transform:uppercase" id="msegnom" onkeyup="segnombre();" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="mdireccion" style="text-transform:uppercase" type="text" id="mdireccion" size="55" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
  <td colspan="2"></td>
   <td><select id="mtip_doc_cli2" name="mtip_doc_cli2" class="Estilo7" style="width:153px" onchange="cambiar_doic(1, this.value)" >
      <option value="0" selected="selected">--Tipo Documento--</option>
      <?php
                            	
								
				$exe_tipdoc=mysql_query("select * from tipodocumento",$conexion);
				while($tipdoc = mysql_fetch_array($exe_tipdoc)){ 
                                   
					 echo ' <option value="'.$tipdoc['idtipdoc'].'">'.$tipdoc['destipdoc'].'</option>';
								   
								    }
                                    ?>
    </select></td>
    <td style="margin-left:8px"><span class='titubuskar0' style="margin-left:8px">N&uacute;mero</span></td>
    <td><input id="m_doc_n2" name="m_doc_n2" type="text" class="Estilo7" style="width:205px; text-transform:uppercase" maxlength="25" /></td>
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
  <input name="email" type="hidden" id="email" size="15" />
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a  onclick="ggclie11dom_editar()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idprofesion" type="hidden" id="idprofesion" size="15" value="0" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" value="0" />
      <input name="nomcargoss" type="hidden" id="nomcargoss" size="40" />
      <input name="nomprofesiones" type="hidden" id="nomprofesiones" size="40" />
      <input type="hidden" name="docpaisemi" id="docpaisemi" value="PERU" /></td>
    
    <input type="hidden" name="telfijo" id="telfijo" value="" />
    <input type="hidden" name="telcel" id="telcel" value="" />
      <input type="hidden" name="telofi" id="telofi" value="" />
        <input type="hidden" name="sexo" id="sexo" value="" />
        <input type="hidden" name="idestcivil" id="idestcivil" value="" />
        <input type="hidden" name="nacionalidad" id="nacionalidad" value="" />
        
    <input type="hidden" name="idprofesion" id="idprofesion" value="" />
    
    <input type="hidden" name="idcargoo" id="idcargoo" value="" />
    <input type="hidden" name="cumpclie" id="cumpclie" value="" />
    <input type="hidden" name="natper" id="natper" value="" />    
     <input type="hidden" name="residente" id="residente" value="" />    
   
  </tr>
</table>
                                    </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                          </form>
    </div>
    
  