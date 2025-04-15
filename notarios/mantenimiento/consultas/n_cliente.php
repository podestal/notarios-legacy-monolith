<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$sql_idcli = "select idcliente from cliente order by cast(cliente.idcliente as signed) desc";
	
	$exe_idcli = mysql_query($sql_idcli, $conexion);
	
	$row_lastcli = mysql_fetch_array($exe_idcli);
		
	$id_cli = $row_lastcli[0]+1;
	
	$id_cli = correlativo_numero10($id_cli); 
	
	$sql_tipdoc =  "SELECT
					tipodocumento.idtipdoc as idtipdoc,
					tipodocumento.codtipdoc as codtipdoc,
					tipodocumento.destipdoc as desctipdoc
					FROM
					tipodocumento";

	$exe_tipdoc = mysql_query($sql_tipdoc, $conexion);
	
	$sql_civil =  "SELECT
				   tipoestacivil.idestcivil as idestcivil, 
				   tipoestacivil.codestcivil as codestcivil,
				   tipoestacivil.desestcivil as descestcivil
				   FROM
				   tipoestacivil";
				   
	$exe_civil = mysql_query($sql_civil, $conexion);
	
	$sql_nacionalidad = "SELECT
						nacionalidades.idnacionalidad as idnac,
						nacionalidades.codnacion as codnac,
						nacionalidades.desnacionalidad as desnac,
						nacionalidades.descripcion as descripcion
						FROM
						nacionalidades";
						
	$exe_nacionalidad = mysql_query($sql_nacionalidad, $conexion);
	
	$i=0;
	
	while($nacionalidad = mysql_fetch_array($exe_nacionalidad)){
		$arr_nacionalidad[$i][0] = $nacionalidad["idnac"];
		$arr_nacionalidad[$i][1] = $nacionalidad["desnac"];
		$arr_nacionalidad[$i][2] = $nacionalidad["descripcion"];
		$i++;
	}
	
	$sql_profesiones = "SELECT
						profesiones.idprofesion as idprof,
						profesiones.codprof as codprof,
						profesiones.desprofesion as descprof
						FROM
						profesiones
						order by profesiones.desprofesion asc";
						
	$exe_profesiones = mysql_query($sql_profesiones, $conexion);

	$sql_cargos = "SELECT
				   cargoprofe.idcargoprofe as idcargo,
				   cargoprofe.codcargoprofe as codcargo,
				   cargoprofe.descripcrapro as desccargo
				   FROM
				   cargoprofe
				   order by cargoprofe.descripcrapro asc";
				   
	$exe_cargos = mysql_query($sql_cargos, $conexion);
	
	$sql_sedes = "SELECT
				  sedesregistrales.idsedereg as idsede,
				  sedesregistrales.dessede as descsede,
				  sedesregistrales.num_zona as zona,
				  sedesregistrales.zona_depar as depar
				  FROM
				  sedesregistrales";
	
	$exe_sedes = mysql_query($sql_sedes, $conexion);
	
	$cad = "kardex.idkardex,
			kardex.kardex,
			kardex.idtipkar,
			kardex.kardexconexo,
			kardex.fechaingreso,
			kardex.horaingreso,
			kardex.referencia,
			kardex.codactos,
			kardex.contrato,
			kardex.idusuario,
			kardex.responsable,
			kardex.observacion,
			kardex.documentos,
			kardex.fechacalificado,
			kardex.fechainstrumento,
			kardex.fechaconclusion,
			kardex.numinstrmento,
			kardex.folioini,
			kardex.folioinivta,
			kardex.foliofin,
			kardex.foliofinvta,
			kardex.papelini,
			kardex.papelinivta,
			kardex.papelfin,
			kardex.papelfinvta,
			kardex.comunica1,
			kardex.contacto,
			kardex.telecontacto,
			kardex.mailcontacto,
			kardex.retenido,
			kardex.desistido,
			kardex.autorizado,
			kardex.idrecogio,
			kardex.pagado,
			kardex.visita,
			kardex.dregistral,
			kardex.dnotarial,
			kardex.idnotario,
			kardex.numminuta,
			kardex.numescritura,
			kardex.fechaescritura,
			kardex.insertos,
			kardex.direc_contacto,
			kardex.txa_minuta";
	
	?>
	
	
<form id="frm_ncli" name="frm_ncli" style="width:100%; height:auto "/>
    <table width="580" height="auto"  cellpadding="0" cellspacing="0">
        <tr height="30" style="background-color:#264965">
            <td align="center"><span class='submenutitu' style="font-size:14px">Nuevo Cliente</span></td>
        </tr>
        <tr>
        	<td>
            	<table>
                		<tr height="35">
                            <td width="98"><span class='titubuskar0' style="margin-left:8px">Tipo Persona</span></td>
                            <td width="197">
                                <select id="tip_per" name="tip_per" class="Estilo7" onchange="open_row()" style="width:153px" >
                                    <option value="0">--Tipo de Persona--</option>
                                    <option value="N">Natural</option>
                                    <option value="J">Jurídica</option>
                                </select>
                                <span style="color:red; margin-left:5px">(*)</span>
                            </td>
                            <td width="99"><span class='titubuskar0'>Código</span></td>
                            <td width="147"><input id="n_cod" name="n_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_cli; ?>" readonly /></td>
                        </tr>
                        <tr height="35">
                            <td><span class='titubuskar0' style="margin-left:8px">Tipo Documento</span></td>
                            <td>
                                <select id="tip_doc" name="tip_doc" class="Estilo7" style="width:153px" onchange="cambiar_doic(1, this.value)" >
                                    <option value="0">--Tipo Documento--</option>
                                    <?php
                            		$i=0;
                            		while($tipdoc = mysql_fetch_array($exe_tipdoc)){ ?>
                                    <option value="<?php echo $tipdoc["idtipdoc"]; ?>"><?php echo $tipdoc["desctipdoc"]; ?></option>
                                    <?php
                                    $i++; 
                                    }
                                    ?>
                                </select>
                                <span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="99"><span class='titubuskar0'>Nº Documento</span></td>
                            <td width="147"><input id="n_doc" name="n_doc" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" /><span style="color:red; margin-left:5px">(*)</span></td>
                        </tr>
                        <tr height="35">
                            <td width="98"><span class='titubuskar0' style="margin-left:8px">Ubigeo</span></td>
                            <td width="197"><input id="n_ubigeo" name="n_ubigeo" type="text" class="Estilo7" style="width:150px; text-transform:uppercase "/><input id="n_idubigeo" name="n_idubigeo" type="hidden"/></td>
                            <td width="99"><span class='titubuskar0'>Fecha de Ingreso</span></td>
                            <td width="147"><input id="n_fecha" name="n_fecha" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo date("d/m/Y") ?>" readonly /></td>
                        </tr> 
                        <tr>
                            <td width="98"><span class='titubuskar0' style="margin-left:8px">Impedido</span></td>
                   	  <td>
                            	<input id="n_tipcliente" name="n_tipcliente" type="checkbox" onclick="mostrar_impedidos()"/>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
              </table>
            </td>
        </tr>
       <tr id="fila_natural" height="35" style="display:none">
       		<td>
            	<table>
                		<tr><td height="38" colspan="4" align="center"><span class='titubuskar0'>PERSONA NATURAL</span></td></tr>
                		<tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Primer Nombre</span></td>
                            <td width="197"><input id="n_prinom" name="n_prinom" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50"/><span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="99"><span class='titubuskar0'>Segundo Nombre</span></td>
                            <td width="147"><input id="n_segnom" name="n_segnom" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" /></td>                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Apellido Paterno</span></td>
                            <td width="197"><input id="n_apepat" name="n_apepat" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" /><span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="99"><span class='titubuskar0'>Apellido Materno</span></td>
                            <td width="147"><input id="n_apemat" name="n_apemat" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" /></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Dirección</span></td>
                            <td width="197" colspan="3"><input id="n_direccion" name="n_direccion" type="text" class="Estilo7" style="width:404px; text-transform:uppercase" maxlength="200" /></td>
                        </tr>
                        <tr>
                            <td width="99"><span class='titubuskar0' style="margin-left:8px">Email</span></td>
                            <td width="147" colspan="3"><input id="n_mail" name="n_mail" type="text" class="Estilo7" style="width:300px; " maxlength="80" /></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Tel. Fijo</span></td>
                            <td width="197"><input id="n_telefono" name="n_telefono" type="text" class="Estilo7" style="width:100px; " maxlength="7" onkeypress="return isNumberKey(event)" /></td>
                            <td width="99"><span class='titubuskar0'>Celular</span></td>
                            <td width="147"><input id="n_celular" name="n_celular" type="text" class="Estilo7" style="width:100px; " maxlength="9" onkeypress="return isNumberKey(event)"/></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Sexo</span></td>
                            <td width="197">
                            <select id="n_sexo" name="n_sexo" class="Estilo7" style="width:150px" >
                                    <option value="0">--Género--</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                            </select>
                            </td>
                            <td width="99"><span class='titubuskar0'>Nacionalidad</span></td>
                            <td width="147">
                              <select id="n_nacionalidad" name="n_nacionalidad" class="Estilo7" style="width:150px" >
                                    <option value="0">--Nacionalidad--</option>
                                    <?php
                                    for($i=0; $i<count($arr_nacionalidad); $i++){ ?>
                                    <option value="<?php echo $arr_nacionalidad[$i][0]; ?>"><?php echo $arr_nacionalidad[$i][2]; ?></option>
                                    <?php
                                    }
                                    ?>


                                </select> 
                            </td>                        
                        </tr>
                        <tr>
							<td width="98" height="28"><span class="titubuskar0"  style="margin-left:8px">Est. Civil</span></td>
                            <td width="197">
                           	  <select id="n_civil" name="n_civil" class="Estilo7" style="width:150px" onchange="open_conyugue()" >
                                    <option value="0">--Est. Civil--</option>
                                    <?php
                                    $i=0;
                                    while($civil = mysql_fetch_array($exe_civil)){ ?>
                                    <option value="<?php echo $civil["idestcivil"]; ?>"><?php echo $civil["descestcivil"]; ?></option>
                                    <?php
                                    $i++; 
                                    }
                                    ?>
                             </select> 
                          </td>
                            <td width="99"><span class='titubuskar0'>Conyuge</span></td>
                            <td width="147">
                            	<div id="btn_conyugue2" style="float:left; width:120px"><input id="txt_conyugue" name="txt_conyugue" type="text" class="Estilo7" style="width:119px; background-color:#CCC; text-transform:uppercase" value="" readonly /><input id="n_conyugue" name="n_conyugue" type="hidden" value="<?php echo $id_conyugue;  ?>"/></div>
                            	<div id="btn_conyugue" style="float:right"><img src="../../images/conyugue.png" width="20" height="20" title="Seleccionar" style="cursor:pointer; margin-left:5px;" onclick="nuevo_conyugue('<?php echo $id_cli; ?>')"/></div>
                            </td>                        
						</tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Profesión</span></td>
                            <td width="197">
                            	<select id="n_profesiones" name="n_profesiones" class="Estilo7" style="width:150px">
                                    <option value="0">--Profesión--</option>
                                    <?php
                                    $i=0;
                                    while($profesiones = mysql_fetch_array($exe_profesiones)){ ?>
                                    <option value="<?php echo $profesiones["idprof"]; ?>"><?php echo $profesiones["descprof"]; ?></option>
                                    <?php
                                    $i++; 
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="99"><span class='titubuskar0'>Det. Profesión</span></td>
                            <td width="147"><input id="n_detprof" name="n_detprof" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" /></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Cargo Prof.</span></td>
                            <td width="197">
								<select id="n_cargo" name="n_cargo" class="Estilo7" style="width:150px">
                                    <option value="0">--Cargos--</option>
                                    <?php
                                    $i=0;
                                    while($cargos = mysql_fetch_array($exe_cargos)){ ?>
                                    <option value="<?php echo $cargos["idcargo"]; ?>"><?php echo $cargos["desccargo"]; ?></option>
                                    <?php
                                    $i++; 
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="99"><span class='titubuskar0'>Ocupación</span></td>
                            <td width="147">
                            	<input id="n_ocupacion" name="n_ocupacion" type="text" class="Estilo7" style="width:100px; text-transform:uppercase "  maxlength="20"/></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Fec. Nacimiento</span></td>
                            <td width="197"><input id="n_fecnac" name="n_fecnac" type="text" class="Estilo7" style="width:100px; "  /></td>
                            <td width="99"><span class='titubuskar0'>País de Emisión</span></td>
                            <td width="147">
                            <select id="n_emision" name="n_emision" class="Estilo7" style="width:150px">
                                    <option value="0">--País de Emisión--</option>
                                    <?php
                                    for($i=0; $i<count($arr_nacionalidad); $i++){ ?>
                                    <option value="<?php echo $arr_nacionalidad[$i][0]; ?>"><?php echo $arr_nacionalidad[$i][1]; ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                            </td> 
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Residente</span></td>
                            <td width="197">
                            	<input id="n_residente" name="n_residente" type="checkbox" class="Estilo7" style="width:20px;" checked="checked" value="1" />
                            </td>
                            <td width="99"><span class='titubuskar0'>Natural de</span></td>
                            <td width="147">
                               <input id="n_natde" name="n_natde" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20"  />
                          </td>                        
                        </tr>
                </table>
            </td>
        </tr> 
        <tr id="fila_juridica" height="35" style="display:none">
       		<td>
            	<table>
            		<tr><td height="37" colspan="4" align="center"><span class='titubuskar0'>PERSONA JURIDICA</span></td></tr>
            		<tr>
						<td width="98"><span class='titubuskar0' style="margin-left:8px">Razón Social</span></td>
                        <td width="197" colspan="3"><input id="n_razon" name="n_razon" type="text" class="Estilo7" style="width:404px; text-transform:uppercase " maxlength="200" /><span style="color:red; margin-left:5px">(*)</span></td>
                    </tr>
            		<tr>
                        <td width="99"><span class="titubuskar0" style="margin-left:8px">Dom. Fiscal</span></td>
                        <td width="147" colspan="3"><input id="n_domfis" name="n_domfis" type="text" class="Estilo7" style="width:404px; text-transform:uppercase" maxlength="200" /></td>                        
                    </tr>
                    <tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Telf. Oficina</span></td>
                        <td width="197"><input id="n_telofi" name="n_telofi" type="text" class="Estilo7" style="width:100px; "  maxlength="7" onkeypress="return isNumberKey(event)"/></td>
                        <td width="99"><span class="titubuskar0">Telf. Empresa</span></td>
                        <td width="147"><input id="n_telemp" name="n_telemp" type="text" class="Estilo7" style="width:100px; " maxlength="7" onkeypress="return isNumberKey(event)"/></td>                        
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Mail Empresa</span></td>
                        <td width="197" colspan="3"><input id="n_mailemp" name="n_mailemp" type="text" class="Estilo7" style="width:300px; " maxlength="80" /></td>
                               
                    
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Fec. Constitución</span></td>
                        <td width="197"><input id="n_feccons" name="n_feccons" type="text" class="Estilo7" style="width:100px; " readonly /></td>
                        <td width="99"><span class="titubuskar0">Sede de Registro</span></td>
                        <td width="147">
                        <select id="n_sede" name="n_sede" class="Estilo7" style="width:118px">
                                <option value="0">--Sedes--</option>
                                <?php
                                $i=0;
                                while($sedes = mysql_fetch_array($exe_sedes)){ ?>
                                <option value="<?php echo $sedes["idsede"]; ?>"><?php echo $sedes["descsede"]; ?></option>
                                <?php
                                $i++; 
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Nº de Registro</span></td>
                        <td width="197"><input id="n_registro" name="n_registro" type="text" class="Estilo7" style="width:100px; " maxlength="20" /></td>
                        <td width="99"><span class="titubuskar0">Nº de partida</span></td>
                        <td width="147"><input id="n_partida" name="n_partida" type="text" class="Estilo7" style="width:100px; " maxlength="20" /></td>                        
                    
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Acta Municipal</span></td>
                        <td width="197"><input id="n_acta" name="n_acta" type="text" class="Estilo7" style="width:100px; " maxlength="20" /></td>
                        <td width="99"><span class="titubuskar0">Objeto Social.</span></td>
                        <td width="99"><input id="n_contacto" name="n_contacto" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" /></td>
                                    
                    </tr>
                </table>
			</td>
        </tr> 
        <tr id="n_filaimpedidoss" style="display:none">
            <td>
            	<table width="561">
                      <tr>  
                         <td height="39" colspan="4" align="center"><span class="titubuskar0" style="margin-left:8px">IMPEDIDO</span></td>
                     </tr>
                		<tr>
                        	<td width="102"><span class="titubuskar0" style="margin-left:8px">Fecha de Ingreso</span></td>
                            <td width="197"><input id="n_impeingre" name="n_impeingre" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" /></td>
                            <td width="87"><span class="titubuskar0">Teléfono</span></td>
                            <td width="155"><input id="n_impnumof" name="n_impnumof" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" onkeypress="return isNumberKey(event)"/></td>

                        </tr>
                        <tr>
                        	<td><span class="titubuskar0" style="margin-left:8px">Origen</span></td>
                            <td><input id="n_impeorigen" name="n_impeorigen" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" /></td>
                            <td><span class="titubuskar0">Entidad</span></td>
                            <td><input id="n_impentidad" name="n_impentidad" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" /></td>
						</tr>
                        <tr>
                        	<td><span class="titubuskar0" style="margin-left:8px">Emite</span></td>
                            <td><input id="n_impremite" name="n_impremite" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" /></td>
                            <td><span class="titubuskar0">Motivo</span></td>
                            <td><input id="n_impmotivo" name="n_impmotivo" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" /></td>

                        </tr>
                </table>
            </td>
      </tr>
  	  <tr height="35" align="center">
            <td height="52"><input type="button" value="Guardar" class="Estilo7" style="width:70px" onClick="registrar_cliente()"/></td>
      </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:absolute; top:5px; left:555px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_ncliente()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>	
