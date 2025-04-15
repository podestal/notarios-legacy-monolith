<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_cli = $_REQUEST['id_cliente'];
	
	$sql_cliente = "SELECT
					cliente.idcliente AS idcliente,
					cliente.tipper AS tipper,
					cliente.apepat AS apepat,
					cliente.apemat AS apemat,
					cliente.prinom AS prinom,
					cliente.segnom AS segnom,
					cliente.nombre AS nombre,
					cliente.direccion AS direccion,
					cliente.idtipdoc AS idtipdoc,
					cliente.numdoc AS numdoc,
					cliente.email AS email,
					cliente.telfijo AS telfijo,
					cliente.telcel AS telcel,
					cliente.telofi AS telofi,
					cliente.sexo AS sexo,
					cliente.idestcivil AS idestcivil,
					cliente.natper AS natper,
					cliente.conyuge AS conyugue,
					cliente.nacionalidad AS nacionalidad,
					cliente.idprofesion AS profesion,
					cliente.detaprofesion AS detprofesion,
					cliente.idcargoprofe AS cargo,
					cliente.profocupa AS ocupacion,
					cliente.dirfer AS dirfer,
					cliente.idubigeo AS ubigeo,
					cliente.cumpclie AS fecnac,
					cliente.fechaing AS fecha,
					cliente.razonsocial AS razon,
					cliente.domfiscal AS domfiscal,
					cliente.telempresa AS telemp,
					cliente.mailempresa AS mailemp,
					cliente.contacempresa AS contacto,
					cliente.fechaconstitu AS fechacons,
					cliente.idsedereg AS sede,
					cliente.numregistro AS registro,
					cliente.numpartida AS partida,
					cliente.actmunicipal AS acta,
					cliente.tipocli AS tipocli,
					cliente.impeingre AS impingre,
					cliente.impnumof AS impnumof,
					cliente.impeorigen AS imporigen,
					cliente.impentidad AS impentidad,
					cliente.impremite AS impemite,
					cliente.impmotivo AS impmotivo,
					cliente.residente AS residente,
					cliente.docpaisemi AS docpaismei,
					concat(ubigeo.nomdis,'/',ubigeo.nomprov,'/',ubigeo.nomdpto) as d_ubigeo
					FROM
					cliente
					left Join ubigeo ON cliente.idubigeo = ubigeo.coddis
					where cliente.idcliente='$id_cli'";
				
	$sql_cliente =	$sql_cliente." order by cast(cliente.idcliente as signed) desc";

	$exe_cliente = mysql_query($sql_cliente, $conexion);
  
    while($cliente = mysql_fetch_array($exe_cliente)){
		
        $arr_cliente[0] = $cliente["id_cliente"]; 
		$arr_cliente[1] = $cliente["tipper"]; 
		$arr_cliente[2] = $cliente["apepat"]; 
		$arr_cliente[3] = $cliente["apemat"]; 
		$arr_cliente[4] = $cliente["prinom"]; 
		$arr_cliente[5] = $cliente["segnom"]; 
		$arr_cliente[6] = $cliente["nombre"]; 
		$arr_cliente[7] = $cliente["direccion"]; 
		$arr_cliente[8] = $cliente["idtipdoc"]; 
		$arr_cliente[9] = $cliente["numdoc"];

		$arr_cliente[10] = $cliente["email"]; 
		$arr_cliente[11] = $cliente["telfijo"]; 
		$arr_cliente[12] = $cliente["telcel"]; 
		$arr_cliente[13] = $cliente["telofi"]; 
		$arr_cliente[14] = $cliente["sexo"]; 
		$arr_cliente[15] = $cliente["idestcivil"]; 
		$arr_cliente[16] = $cliente["natper"]; 
		$arr_cliente[17] = $cliente["conyugue"]; 
		$arr_cliente[18] = $cliente["nacionalidad"]; 
		$arr_cliente[19] = $cliente["profesion"]; 

		$arr_cliente[20] = $cliente["detprofesion"]; 
		$arr_cliente[21] = $cliente["cargo"]; 
		$arr_cliente[22] = $cliente["ocupacion"]; 
		$arr_cliente[23] = $cliente["dirfer"]; 
		$arr_cliente[24] = $cliente["ubigeo"]; 
		$arr_cliente[25] = $cliente["fecnac"]; 
		$arr_cliente[26] = $cliente["fecha"]; 
		$arr_cliente[27] = $cliente["razon"]; 
		$arr_cliente[28] = $cliente["domfiscal"]; 
		$arr_cliente[29] = $cliente["telemp"]; 

		$arr_cliente[30] = $cliente["mailemp"]; 
		$arr_cliente[31] = $cliente["contacto"]; 
		$arr_cliente[32] = $cliente["fechacons"]; 
		$arr_cliente[33] = $cliente["sede"]; 
		$arr_cliente[34] = $cliente["registro"]; 
		$arr_cliente[35] = $cliente["partida"]; 
		$arr_cliente[36] = $cliente["acta"]; 
		$arr_cliente[37] = $cliente["tipocli"]; 
		$arr_cliente[38] = $cliente["impingre"]; 
		$arr_cliente[39] = $cliente["impnumof"]; 
		
        $arr_cliente[40] = $cliente["imporigen"]; 
		$arr_cliente[41] = $cliente["impentidad"]; 
		$arr_cliente[42] = $cliente["impemite"]; 
		$arr_cliente[43] = $cliente["impmotivo"]; 
		$arr_cliente[44] = $cliente["residente"]; 
		$arr_cliente[45] = $cliente["docpaismei"]; 
		$arr_cliente[46] = $cliente["d_ubigeo"];

    }
	
	
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
	
	$sql_conyugue = "SELECT
					 cliente.idcliente AS idcliente,
					 cliente.apepat AS apepat,
					 cliente.prinom AS prinom
					 FROM
					 cliente where cliente.idcliente=".$arr_cliente[17];
					 
	$exe_conyugue = mysql_query($sql_conyugue, $conexion);
	
	$conyugue = mysql_fetch_array($exe_conyugue);
	
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
	
	
<form id="frm_mcli" name="frm_mcli" style="width:100%; height:auto "/>
    <table width="580" height="auto"  cellpadding="0" cellspacing="0">
        <tr height="30" style="background-color:#264965">
            <td align="center"><span class='submenutitu' style="font-size:14px">Modificar Cliente</span></td>
        </tr>
        <tr>
        	<td>
            	<table>
                		<tr height="35">
                            <td width="98"><span class='titubuskar0' style="margin-left:8px">Tipo Persona</span></td>
                            <td width="197">
                                <select id="m_tipper" name="m_tipper" class="Estilo7" onchange="m_openrow()" style="width:153px" >
                                    <option value="N"
                                    <?php 
									if($arr_cliente[1]=="N"){
										echo "selected='selected'";
									}
									?>
                                    >Natural</option>
                                    <option value="J"
                                    <?php 
									if($arr_cliente[1]=="J"){
										echo "selected='selected'";
									}
									?>
                                    >Jurídica</option>
                                </select>
                                <span style="color:red; margin-left:5px">(*)</span>
                            </td>
                            <td width="99"><span class='titubuskar0'>Código</span></td>
                            <td width="147"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_cli; ?>" readonly /></td>
                        </tr>
                        <tr height="35">
                            <td><span class='titubuskar0' style="margin-left:8px">Tipo Documento</span></td>
                            <td>
                                <select id="m_tipdoc" name="m_tipdoc" class="Estilo7" style="width:153px" onchange="cambiar_doic(2, this.value)" >
                                    <?php
                            		$i=0;
                            		while($tipdoc = mysql_fetch_array($exe_tipdoc)){ ?>
                                    <option
                                    <?php
									if($arr_cliente[8]==$tipdoc["idtipdoc"]){
										echo "selected='selected'";
									}
									?>
                                     value="<?php echo $tipdoc["idtipdoc"]; ?>"><?php echo $tipdoc["desctipdoc"]; ?></option>
                                    <?php
                                    $i++; 
                                    }
                                    ?>
                                </select>
                                <span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="99"><span class='titubuskar0'>Nº Documento</span></td>
                            <td width="147"><input id="m_doc" name="m_doc" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" value="<?php echo $arr_cliente[9];?>" /><span style="color:red; margin-left:5px">(*)</span></td>
                        </tr>
                        <tr height="35">
                            <td width="98"><span class='titubuskar0' style="margin-left:8px">Ubigeo</span></td>
                            <td width="197"><input id="m_ubigeo" name="m_ubigeo" type="text" class="Estilo7" style="width:150px; text-transform:uppercase " value="<?php echo $arr_cliente[46];?>"/><input id="m_idubigeo" name="m_idubigeo" type="hidden" value="<?php echo $arr_cliente[24];?>" /></td>
                            <td width="99"><span class='titubuskar0'>Fecha de Ingreso</span></td>
                            <td width="147"><input id="m_fecha" name="m_fecha" type="text" class="Estilo7" style="width:100px; background-color:#CCC " value="<?php echo date("d/m/Y") ?>" readonly /></td>
                        </tr> 
                        <tr>
                            <td width="98"><span class='titubuskar0' style="margin-left:8px">Impedido</span></td>
                   	  <td>
                            	<input id="m_tipcliente" name="m_tipcliente" type="checkbox" onclick="mostrar_impedidosm()" 
                                <?php 
								if($arr_cliente[37]==1){
									echo "checked='checked'";
								}
								?>
                                />
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                
                </table>
            </td>
        </tr>
       <tr id="m_filanatural" height="35" style="display:none">
       		<td>
            	<table>
                		<tr><td height="38" colspan="4" align="center"><span class='titubuskar0'>PERSONA NATURAL</span></td></tr>
                		<tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Primer Nombre</span></td>
                            <td width="197"><input id="m_prinom" name="m_prinom" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" value="<?php echo $arr_cliente[4];?>" /><span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="99"><span class='titubuskar0'>Segundo Nombre</span></td>
                            <td width="147"><input id="m_segnom" name="m_segnom" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" value="<?php echo $arr_cliente[5]; ?>" /></td>                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Apellido Paterno</span></td>
                            <td width="197"><input id="m_apepat" name="m_apepat" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" value="<?php echo $arr_cliente[2]; ?>" /><span style="color:red; margin-left:5px">(*)</span></td>
                            <td width="99"><span class='titubuskar0'>Apellido Materno</span></td>
                            <td width="147"><input id="m_apemat" name="m_apemat" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" value="<?php echo $arr_cliente[3];?>" /></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Dirección</span></td>
                            <td width="197" colspan="3"><input id="m_direccion" name="m_direccion" type="text" class="Estilo7" style="width:404px; text-transform:uppercase" maxlength="200" value="<?php echo $arr_cliente[7]; ?>" /></td>
                        </tr>
                        <tr>
                            <td width="99"><span class='titubuskar0' style="margin-left:8px">Email</span></td>
                            <td width="147" colspan="3"><input id="m_mail" name="m_mail" type="text" class="Estilo7" style="width:300px; " maxlength="80" value="<?php echo $arr_cliente[10];?>" /></td>                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Tel. Fijo</span></td>
                            <td width="197"><input id="m_telefono" name="m_telefono" type="text" class="Estilo7" style="width:100px; " maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $arr_cliente[11]; ?>" /></td>
                            <td width="99"><span class='titubuskar0'>Celular</span></td>
                            <td width="147"><input id="m_celular" name="m_celular" type="text" class="Estilo7" style="width:100px; " maxlength="9" onkeypress="return isNumberKey(event)" value="<?php echo $arr_cliente[12]; ?>"/></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Sexo</span></td>
                            <td width="197">
                            <select id="m_sexo" name="m_sexo" class="Estilo7" style="width:150px" >
                                    <option value="0">--Género--</option>
                                    <option value="M"
                                    <?php
									if($arr_cliente[14]=="M"){
										echo "selected='selected'";
									}
									?>
                                    >Masculino</option>
                                    <option value="F"
                                    <?php
									if($arr_cliente[14]=="F"){
										echo "selected='selected'";
									}
									?>
                                    >Femenino</option>
                            </select>
                            </td>
                            <td width="99"><span class='titubuskar0'>Nacionalidad</span></td>
                            <td width="147">
                              	<select id="m_nacionalidad" name="m_nacionalidad" class="Estilo7" style="width:150px" >
                                    <option value="0">--Nacionalidad--</option>
                                    <?php
                                    for($i=0; $i<count($arr_nacionalidad); $i++){ ?>
                                    <option
                                    <?php
									if($arr_cliente[18]==$arr_nacionalidad[$i][0]){
										echo "selected='selected'";
									}
									?>
                                    value="<?php echo $arr_nacionalidad[$i][0]; ?>"><?php echo $arr_nacionalidad[$i][2]; ?></option>
                                    <?php
                                    }
                                    ?>


                                </select>
                            </td>                        
                        </tr>
                        <tr  height="35">
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Estado Civil</span></td>
                            <td width="197">
                                <select id="m_civil" name="m_civil" class="Estilo7" style="width:150px" onchange="cambiar_civil()" >									<option value="0">--Est. Civil--</option>
                                        <?php
                                        $i=0;
                                        while($civil = mysql_fetch_array($exe_civil)){ ?>
                                        <option 
                                        <?php
                                        if($arr_cliente[15]==$civil["idestcivil"]){
                                            echo "selected='selected'";
                                        }
                                        ?>
                                        value="<?php echo $civil["idestcivil"]; ?>"><?php echo $civil["descestcivil"]; ?></option>
                                        <?php
                                        $i++; 
                                        }
                                        ?>
                                </select> 
                            	
                        </td>
                            <td width="99"><span class='titubuskar0'>Conyugue</span></td>
                            <td width="147">
                            <div id="btm_conyugue2" style=" float:left; width:120px"><input id="txt_mconyugue" name="txt_mconyugue" type="text" class="Estilo7" style="width:119px; background-color:#CCC; text-transform:uppercase" value="<?php if($conyugue[0]<>""){ echo $conyugue[1].', '.$conyugue[2];}?>" readonly /><input id="m_conyugue" name="m_conyugue" type="hidden" value="<?php echo $conyugue[0];?>"/></div>
                            <div id="btm_conyugue" style=" float:right"><img src="../../images/conyugue.png" width="20" height="20" title="Seleccionar" style="cursor:pointer; margin-left:5px" onclick="nuevo_conyugue('<?php echo $id_cli; ?>')"/></div>
           		            </td>                        
						</tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Profesión</span></td>
                            <td width="197">
                            	<select id="m_profesiones" name="m_profesiones" class="Estilo7" style="width:150px">
                                    <option value="0">--Profesión--</option>
                                    <?php
                                    $i=0;
                                    while($profesiones = mysql_fetch_array($exe_profesiones)){ ?>
                                    <option 
                                    <?php
									if($arr_cliente[19]==$profesiones["idprof"]){
										echo "selected='selected'";
									}
									?>
                                    value="<?php echo $profesiones["idprof"]; ?>"><?php echo $profesiones["descprof"]; ?></option>

                                    <?php
                                    $i++; 
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="99"><span class='titubuskar0'>Det. Profesión</span></td>
                            <td width="147"><input id="m_detprof" name="m_detprof" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" value="<?php echo $arr_cliente[20];?>" /></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Cargo Prof.</span></td>
                            <td width="197">
								<select id="m_cargo" name="m_cargo" class="Estilo7" style="width:150px">
                                    <option value="0">--Cargos--</option>
                                    <?php
                                    $i=0;
                                    while($cargos = mysql_fetch_array($exe_cargos)){ ?>
                                    <option 
                                    <?php
									if($arr_cliente[21]==$cargos["idcargo"]){
										echo "selected='selected'";
									}
									?>
                                    value="<?php echo $cargos["idcargo"]; ?>"><?php echo $cargos["desccargo"]; ?></option>
                                    <?php
                                    $i++; 
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="99"><span class='titubuskar0'>Ocupación</span></td>
                            <td width="147">
                            	<input id="m_ocupacion" name="m_ocupacion" type="text" class="Estilo7" style="width:100px; text-transform:uppercase"  maxlength="20" value="<?php echo $arr_cliente[22];?>"/></td>                        
                        
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Fec. Nacimiento</span></td>
                            <td width="197"><input id="m_fecnac" name="m_fecnac" type="text" class="Estilo7" style="width:100px; " value="<?php echo $arr_cliente[25];?>" /></td>
                            <td width="99"><span class='titubuskar0'>País de Emisión</span></td>
                            <td width="147">
                            <select id="m_emision" name="m_emision" class="Estilo7" style="width:150px">
                                    <option value="0">--País de Emisión--</option>
                                    <?php
                                    for($i=0; $i<count($arr_nacionalidad); $i++){ ?>
                                    <option 
                                    <?php
									if($arr_cliente[45]==$arr_nacionalidad[$i][0]){
										echo "selected='selected'";
									}
									?>
                                    value="<?php echo $arr_nacionalidad[$i][0]; ?>"><?php echo $arr_nacionalidad[$i][1]; ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                            </td> 
                        </tr>
                        <tr>
							<td width="98"><span class='titubuskar0' style="margin-left:8px">Residente</span></td>
                            <td width="197">
                            	<input id="m_residente" name="m_residente" type="checkbox" class="Estilo7" style="width:20px;"
                                <?php 
								if($arr_cliente[44]==1)
									echo "checked='checked'"; 	
								?>
                                value="1" />
                            </td>
                            <td width="99"><span class='titubuskar0'>Natural de</span></td>
                            <td width="147">
                                <input id="m_natde" name="m_natde" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" value="<?php echo $arr_cliente[16]; ?>"/>
                            </td>                        
                        </tr>
                </table>
            </td>
        </tr> 
        <tr id="m_filajuridica" height="35" style="display:none">
       		<td>
            	<table>
            		<tr><td height="37" colspan="4" align="center"><span class='titubuskar0'>PERSONA JURIDICA</span></td></tr>
            		<tr>
						<td width="98"><span class='titubuskar0' style="margin-left:8px">Razón Social</span></td>

                        <td width="197" colspan="3"><input id="m_razon" name="m_razon" type="text" class="Estilo7" style="width:404px; text-transform:uppercase " maxlength="200" value="<?php echo $arr_cliente[27]; ?>" /><span style="color:red; margin-left:5px">(*)</span></td>
                    </tr>
            		<tr>
                        <td width="99"><span class="titubuskar0" style="margin-left:8px">Dom. Fiscal</span></td>
                        <td width="147" colspan="3"><input id="m_domfis" name="m_domfis" type="text" class="Estilo7" style="width:404px; text-transform:uppercase" maxlength="200" value="<?php echo $arr_cliente[28]; ?>"/></td>                        
                    </tr>
                    <tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Telf. Oficina</span></td>
                        <td width="197"><input id="m_telofi" name="m_telofi" type="text" class="Estilo7" style="width:100px; "  maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $arr_cliente[13]; ?>"/></td>
                        <td width="99"><span class="titubuskar0">Telf. Empresa</span></td>
                        <td width="147"><input id="m_telemp" name="m_telemp" type="text" class="Estilo7" style="width:100px; " maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $arr_cliente[29]; ?>"/></td>                        
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Mail Empresa</span></td>
                        <td width="197" colspan="3"><input id="m_mailemp" name="m_mailemp" type="text" class="Estilo7" style="width:300px; " maxlength="80" value="<?php echo $arr_cliente[30]; ?>"/></td>
                               
                    
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Fec. Constitución</span></td>
                        <td width="197"><input id="m_feccons" name="m_feccons" type="text" class="Estilo7" style="width:100px; " readonly value="<?php echo $arr_cliente[32]; ?>"/></td>
                        <td width="99"><span class="titubuskar0">Sede de Registro</span></td>
                        <td width="147">
                        <select id="m_sede" name="m_sede" class="Estilo7" style="width:118px">
                                <option value="0">--Sedes--</option>
                                <?php
                                $i=0;
                                while($sedes = mysql_fetch_array($exe_sedes)){ ?>
                                <option 
                                <?php
								if($arr_cliente[33]==$sedes["idsede"]){
									echo "selected='selected'";
								}
								?>
                                value="<?php echo $sedes["idsede"]; ?>"><?php echo $sedes["descsede"]; ?></option>
                                <?php
                                $i++; 
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Nº de Registro</span></td>
                        <td width="197"><input id="m_registro" name="m_registro" type="text" class="Estilo7" style="width:100px; " maxlength="20" value="<?php echo $arr_cliente[34]; ?>"/></td>
                        <td width="99"><span class="titubuskar0">Nº de partida</span></td>
                        <td width="147"><input id="m_partida" name="m_partida" type="text" class="Estilo7" style="width:100px; " maxlength="20" value="<?php echo $arr_cliente[35]; ?>"/></td>                        
                    
                    </tr>
            		<tr>
						<td width="98"><span class="titubuskar0" style="margin-left:8px">Acta Municipal</span></td>
                        <td width="197"><input id="m_acta" name="m_acta" type="text" class="Estilo7" style="width:100px; " maxlength="20" value="<?php echo $arr_cliente[36]; ?>"/></td>
                        <td width="99"><span class="titubuskar0">Objeto Social</span></td>
                        <td width="99"><input id="m_contacto" name="m_contacto" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" value="<?php echo $arr_cliente[31]; ?>"/></td>
                                    
                    </tr>
                </table>
            </td>
        </tr>
        <tr id="m_filaimpedidoss" style="display:none">
            <td>
            	<table width="561">
                      <tr>  
                         <td height="40" colspan="4" align="center"><span class="titubuskar0" style="margin-left:8px">IMPEDIDO</span></td>
                     </tr>
                		<tr>
                        	<td width="101"><span class="titubuskar0" style="margin-left:8px">Fecha de Ingreso</span></td>
                            
                            <td width="198"><input id="m_impeingre" name="m_impeingre" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" value="<?php echo $arr_cliente[38]; ?>" /></td>
                            <td width="87"><span class="titubuskar0">Teléfono</span></td>
                            <td width="155"><input id="m_impnumof" name="m_impnumof" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" value="<?php echo $arr_cliente[39]; ?>" onkeypress="return isNumberKey(event)"/></td>

                        </tr>
                        <tr>
                        	<td><span class="titubuskar0" style="margin-left:8px">Origen</span></td>
                            <td><input id="m_impeorigen" name="m_impeorigen" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" value="<?php echo $arr_cliente[40]; ?>"/></td>
                            <td><span class="titubuskar0">Entidad</span></td>
                            <td><input id="m_impentidad" name="m_impentidad" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" value="<?php echo $arr_cliente[41]; ?>"/></td>
						</tr>
                        <tr>
                        	<td><span class="titubuskar0" style="margin-left:8px">Emite</span></td>
                            <td><input id="m_impremite" name="m_impremite" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" value="<?php echo $arr_cliente[42]; ?>"/></td>
                            <td><span class="titubuskar0">Motivo</span></td>
                            <td><input id="m_impmotivo" name="m_impmotivo" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="80" value="<?php echo $arr_cliente[43]; ?>"/></td>

                        </tr>
                </table>
            </td>
        </tr> 
        <tr height="35" align="center">
            <td height="52"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="mod_impedido('<?php echo $id_cli; ?>')"/></td>
      </tr>
        
        
        
    </table>
    </form>

	<span class='submenutitu' style="position:absolute; top:5px; left:555px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mcliente()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>	
