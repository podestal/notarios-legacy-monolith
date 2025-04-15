<link rel="stylesheet" href="../../stylesglobal.css">	  
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link href="../includes/scrollableFixedHeaderTable.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<!--<link rel="stylesheet" href="../../css/uniform.default.css" type="text/css" media="screen">-->

<script type="text/javascript" src="../../librerias/jquery/external/jquery/jquery.js"></script>
<script type="text/javascript" src="../../librerias/jquery/jquery-ui.js"></script>

<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>-->	  

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/jquery.scrollableFixedHeaderTable.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/cliente.js" ></script>
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>
<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_conyugue = $_REQUEST['id'];
	$prinom = strtoupper($_REQUEST['prinom']);
	$apepat = strtoupper($_REQUEST['apepat']);
	
	$sql_idcli = "select idcliente from cliente order by cast(cliente.idcliente as signed) desc";
	
	$exe_idcli = mysql_query($sql_idcli, $conexion);
	
	$row_lastcli = mysql_fetch_array($exe_idcli);
		
	$id_cli = $row_lastcli[0]+2;
	
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
	
	?>
	
	
<form id="frm_nconyugue" name="frm_nconyugue" style="width:100%; height:auto "/>
    <table width="580" height="auto"  cellpadding="0" cellspacing="0" style="background-color:#D2E9FF">
        <tr height="30" style="background-color:#264965">
            <td align="center"><span class='submenutitu' style="font-size:14px">Nuevo Conyugue</span></td>
        </tr>
       <tr>
       		<td>
            	<table>
                		<tr height="35">
                            <td width="110"><span class='titubuskar0' style="margin-left:8px">Tipo Persona</span></td>
                            <td width="192">
                                <select id="c_tipper" name="c_tipper" class="Estilo7" onchange="open_row()" style="width:153px" >
                                    <option value="N">Natural</option>
                                </select>
                                <span style="color:red; margin-left:5px">(*)</span>
                            </td>
                            <td width="93"><span class='titubuskar0'>Código</span></td>
                            <td width="158"><input id="c_cod" name="c_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_cli; ?>" readonly /></td>
                        </tr>
                        <tr height="35">
                            <td><span class='titubuskar0' style="margin-left:8px">Tipo Documento</span></td>
                            <td>
                                <select id="c_tipdoc" name="c_tipdoc" class="Estilo7" style="width:153px" onchange="cambiar_doic(3, this.value)" >
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
                            <td width="93"><span class='titubuskar0'>Nº Documento</span></td>
                            <td width="158"><input id="c_doc" name="c_doc" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" /><span style="color:red; margin-left:5px">(*)</span></td>
                        </tr>
                        <tr height="35">
                            <td width="110"><span class='titubuskar0' style="margin-left:8px">Ubigeo</span></td>
                            <td width="192"><input id="c_ubigeo" name="c_ubigeo" type="text" class="Estilo7" style="width:150px; text-transform:uppercase " onkeyup="c_ubigeos();"/><input id="c_idubigeo" name="c_idubigeo" type="hidden"/></td>
                            <td width="93"><span class='titubuskar0'>Fecha de Ingreso</span></td>
                            <td width="158"><input id="c_fecha" name="c_fecha" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo date("d/m/Y") ?>" readonly /></td>
                        </tr> 
                		<tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Primer Nombre</span></td>
                            <td width="191"><input id="c_prinom" name="c_prinom" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50"/><span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="90"><span class='titubuskar0'>Segundo Nombre</span></td>
                            <td width="150"><input id="c_segnom" name="c_segnom" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" /></td>                        </tr>
                        <tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Apellido Paterno</span></td>
                            <td width="191"><input id="c_apepat" name="c_apepat" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" /><span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="90"><span class='titubuskar0'>Apellido Materno</span></td>
                            <td width="150"><input id="c_apemat" name="c_apemat" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" /></td>                        
                        
                        </tr>
                        <tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Dirección</span></td>
                            <td colspan="3"><input id="c_direccion" name="c_direccion" type="text" class="Estilo7" style="width:404px; text-transform:uppercase" maxlength="200" /></td>
                        </tr>
                        <tr height="35">
                            <td width="114"><span class='titubuskar0' style="margin-left:8px">Email</span></td>
                            <td colspan="3"><input id="c_mail" name="c_mail" type="text" class="Estilo7" style="width:300px; " maxlength="80" /></td>                        
                        
                        </tr>
                        <tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Tel. Fijo</span></td>
                            <td width="191"><input id="c_telefono" name="c_telefono" type="text" class="Estilo7" style="width:100px; " maxlength="7" onkeypress="return isNumberKey(event)" /></td>
                            <td width="90"><span class='titubuskar0'>Celular</span></td>
                            <td width="150"><input id="c_celular" name="c_celular" type="text" class="Estilo7" style="width:100px; " maxlength="9" onkeypress="return isNumberKey(event)"/></td>                        
                        
                        </tr>
                        <tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Sexo</span></td>
                            <td width="191">
                            <select id="c_sexo" name="c_sexo" class="Estilo7" style="width:150px" >
                                    <option value="0">--Género--</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                            </select>
                            </td>
                            <td width="90"><span class='titubuskar0'>Nacionalidad</span></td>
                            <td width="150">
                              <select id="c_nacionalidad" name="c_nacionalidad" class="Estilo7" style="width:150px" >
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
                        <tr height="35"> 
							<td width="114"><span class="titubuskar0"  style="margin-left:8px">Est. Civil</span></td>
                            <td width="191">
                            	<select id="c_civil" name="c_civil" class="Estilo7" style="width:150px" onchange="opec_conyugue()" >
                                    <option value="2">Casado(a)</option>
                             </select> 
                          </td>
                            <td width="90"><span class='titubuskar0'>Conyuge</span></td>
                            <td width="150"><input type="text" class="Estilo7" style="width:144px; background-color:#CCC" value="<?php echo $apepat.', '.$prinom;  ?>" readonly /><input id="c_conyugue" name="c_conyugue" type="hidden" value="<?php echo $id_conyugue;  ?>"/>
							</td> 
						</tr>
                        <tr>
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Profesión</span></td>
                            <td width="191">
                            	<select id="c_profesiones" name="c_profesiones" class="Estilo7" style="width:150px">
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
                            <td width="90"><span class='titubuskar0'>Det. Profesión</span></td>
                            <td width="150"><input id="c_detprof" name="c_detprof" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" /></td>                        
                        
                        </tr>
                        <tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Cargo Prof.</span></td>
                            <td width="191">
								<select id="c_cargo" name="c_cargo" class="Estilo7" style="width:150px">
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
                            <td width="90"><span class='titubuskar0'>Ocupación</span></td>
                            <td width="150">
                            	<input id="c_ocupacion" name="c_ocupacion" type="text" class="Estilo7" style="width:100px; text-transform:uppercase "  maxlength="20"/></td>                        
                        
                        </tr>
                        <tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Fec. Nacimiento</span></td>
                            <td width="191"><input id="c_fecnac" name="c_fecnac" type="text" class="Estilo7" style="width:100px; " readonly="readonly" /></td>
                            <td width="90"><span class='titubuskar0'>País de Emisión</span></td>
                            <td width="150">
                            <select id="c_emision" name="c_emision" class="Estilo7" style="width:150px">
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
                        <tr height="35">
							<td width="114"><span class='titubuskar0' style="margin-left:8px">Residente</span></td>
                            <td width="191">
                            	<input id="c_residente" name="c_residente" type="checkbox" class="Estilo7" style="width:20px;" checked="checked" value="1" />
                            </td>
                            <td width="90"><span class='titubuskar0'>Natural de</span></td>
                            <td width="150">
                               <input id="c_natde" name="c_natde" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20"  />
                          </td>                        
                        </tr>
                </table>
            </td>
        </tr> 
      	<tr height="35" align="center">
            <td height="52"><input type="button" value="Guardar" class="Estilo7" style="width:70px" onClick="registrar_conyugue()"/></td>
      </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:absolute; top:5px; left:555px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_nconyugue()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>	
