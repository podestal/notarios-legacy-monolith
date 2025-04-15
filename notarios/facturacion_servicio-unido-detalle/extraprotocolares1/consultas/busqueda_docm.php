<?php

	include("../view/funciones.php");
	
	include("dame_ubigeo.php");
	
	include("dame_profesion.php");
    
    $conexion = Conectar();
	
	$id_domiciliario = $_REQUEST['id_domiciliario'];
	
	$sql_domiciliario  =   "SELECT
						    cert_domiciliario.id_domiciliario,
						    cert_domiciliario.num_certificado,
						    cert_domiciliario.fec_ingreso,
						    cert_domiciliario.nombre_solic,
						    cert_domiciliario.domic_solic,
						    cert_domiciliario.motivo_solic,
						    cert_domiciliario.num_formu,
							cert_domiciliario.tipdoc_solic,
							cert_domiciliario.numdoc_solic,
							cert_domiciliario.distrito_solic,
							cert_domiciliario.texto_cuerpo,
							cert_domiciliario.nom_testigo,
							cert_domiciliario.tdoc_testigo,
							cert_domiciliario.ndocu_testigo,
							cert_domiciliario.idestcivil,
							cert_domiciliario.sexo,
							cert_domiciliario.profesionc
							FROM 
							cert_domiciliario
							where cert_domiciliario.id_domiciliario=$id_domiciliario";
	
	$exe_domiciliario = mysql_query($sql_domiciliario, $conexion);
	  
    while($domiciliarios = mysql_fetch_array($exe_domiciliario, MYSQL_ASSOC))
    {
		$arr_domiciliarios[0] = $domiciliarios["id_domiciliario"]; 
		$arr_domiciliarios[1] = $domiciliarios["num_certificado"];
		$arr_domiciliarios[2] = $domiciliarios["fec_ingreso"];
		$arr_domiciliarios[3] = $domiciliarios["domic_solic"];
		$arr_domiciliarios[4] = $domiciliarios["nombre_solic"];
		$arr_domiciliarios[5] = $domiciliarios["motivo_solic"];
		$arr_domiciliarios[6] = $domiciliarios["num_formu"]; 
		$arr_domiciliarios[7] = $domiciliarios["tipdoc_solic"];
		$arr_domiciliarios[8] = $domiciliarios["numdoc_solic"];
		$arr_domiciliarios[9] = $domiciliarios["distrito_solic"];
		$arr_domiciliarios[10] = $domiciliarios["texto_cuerpo"];
		$arr_domiciliarios[11] = $domiciliarios["nom_testigo"];
		$arr_domiciliarios[12] = $domiciliarios["tdoc_testigo"]; 
		$arr_domiciliarios[13] = $domiciliarios["ndocu_testigo"];
		$arr_domiciliarios[14] = $domiciliarios["idestcivil"];
		$arr_domiciliarios[15] = $domiciliarios["sexo"];
		$arr_domiciliarios[16] = $domiciliarios["profesionc"];
	}
	
	
	$desc_profesion = dame_profesion($arr_domiciliarios[16]);
	
	$par = $_REQUEST['par'];
	
	$numdoc = $_REQUEST['numdoc'];
	
	$sql_cliente =	"SELECT
					cliente.idcliente,
					cliente.tipper,
					cliente.apepat,
					cliente.apemat,
					cliente.prinom,
					cliente.segnom,
					cliente.nombre,
					cliente.direccion,
					cliente.idtipdoc,
					cliente.numdoc,
					cliente.email,
					cliente.telfijo,
					cliente.telcel,
					cliente.telofi,
					cliente.sexo,
					cliente.idestcivil,
					cliente.natper,
					cliente.conyuge,
					cliente.nacionalidad,
					cliente.idprofesion,
					cliente.detaprofesion,
					cliente.idcargoprofe,
					cliente.profocupa,
					cliente.dirfer,
					cliente.idubigeo,
					cliente.cumpclie,
					cliente.fechaing,
					cliente.razonsocial,
					cliente.domfiscal,
					cliente.telempresa,
					cliente.mailempresa,
					cliente.contacempresa,
					cliente.fechaconstitu,
					cliente.idsedereg,
					cliente.numregistro,
					cliente.numpartida,
					cliente.actmunicipal,
					cliente.tipocli,
					cliente.impeingre,
					cliente.impnumof,
					cliente.impeorigen,
					cliente.impentidad,
					cliente.impremite,
					cliente.impmotivo,
					cliente.residente,
					cliente.docpaisemi,
					ubigeo.nomdis,
					ubigeo.nomdpto,
					ubigeo.coddis,
					profesiones.desprofesion,
					profesiones.idprofesion
					FROM
					cliente
					Left Join ubigeo ON cliente.idubigeo = ubigeo.coddis
					Left Join profesiones ON cliente.idprofesion = profesiones.idprofesion
					WHERE
					cliente.numdoc =  '$numdoc'";
	
	if($par<>1){				
	   $exe_cliente = mysql_query($sql_cliente, $conexion);
	}
	
	 while($cliente = mysql_fetch_array($exe_cliente, MYSQL_ASSOC))
	  {
		$arr_cliente[0] = $cliente["idtipdoc"]; 
		$arr_cliente[1] = $cliente["numdoc"];
		$arr_cliente[2] = $cliente["nombre"];
		$arr_cliente[3] = $cliente["direccion"];
		$arr_cliente[4] = $cliente["idubigeo"];
		$arr_cliente[5] = $cliente["motivo_solic"];
		$arr_cliente[6] = $cliente["profocupa"];
		$arr_cliente[7] = $cliente["idestcivil"];
		$arr_cliente[8] = $cliente["sexo"];
		$arr_cliente[9] = $cliente["nomdis"];
		$arr_cliente[10] = $cliente["nomdpto"];
		$arr_cliente[11] = $cliente["razonsocial"];
		$arr_cliente[12] = $cliente["domfiscal"];
		$arr_cliente[13] = $arr_cliente[9].', '.$arr_cliente[10];
		$arr_cliente[14] = $cliente["coddis"];
		$arr_cliente[15] = $cliente["idprofesion"];
		$arr_cliente[16] = $cliente["desprofesion"];
		$i++; 
	 }
	 
	
	$sql_tipdoc = "SELECT
				   tipodocumento.idtipdoc as idtipdoc,
				   tipodocumento.codtipdoc as codtipdoc,
				   tipodocumento.destipdoc as destipdoc
				   FROM
				   tipodocumento";
				
	$exe_tipdoc = mysql_query($sql_tipdoc, $conexion);
	  
	$i=0;
  
	while($tipdoc = mysql_fetch_array($exe_tipdoc, MYSQL_ASSOC))
	{
		$arr_tipdoc[$i][0] = $tipdoc["idtipdoc"]; 
		$arr_tipdoc[$i][1] = $tipdoc["codtipdoc"]; 
		$arr_tipdoc[$i][2] = $tipdoc["destipdoc"]; 
		$i++; 
	}	
	
	$sql_civil = "SELECT
				  tipoestacivil.idestcivil,
				  tipoestacivil.codestcivil,
				  tipoestacivil.desestcivil
				  FROM
				  tipoestacivil";
				
 	$exe_civil = mysql_query($sql_civil, $conexion);
	  
    $i=0;
  
    while($civil = mysql_fetch_array($exe_civil, MYSQL_ASSOC))
    {
		$arr_civil[$i][0] = $civil["idestcivil"]; 
		$arr_civil[$i][1] = $civil["codestcivil"]; 
		$arr_civil[$i][2] = $civil["desestcivil"]; 
		$i++; 
    }

?>
			<table width="765" height="218">
            		<tr>
                    	<td width="104"><span class="camposss">Identificado con:</span></td>
                        <td width="356">
                        	<select id="m_tipdocus" name="m_tipdocus" style="width:319px" class="camposss" onChange="cambiar_doc('m_numdocus', this.value)">
                            	<option value="0">--Tipo Documento--</option>
                                <?php for($j=0; $j<count($arr_tipdoc); $j++){?>
                                <option
                                <?php 
								if($arr_tipdoc[$j][0]==$arr_domiciliarios[7]){
									echo "selected='selected'";
								}
								?>
                                
                                <?php 
								if($arr_tipdoc[$j][0]==$arr_cliente[0]){
									echo "selected='selected'";
								}
								?>
                                
                                 value="<?php echo $arr_tipdoc[$j][0]; ?>"><?php echo $arr_tipdoc[$j][2]; ?></option>
								<?php }?>
                                
                            </select><span style="color:red; margin-left:5px">(*)</span>
                        </td>
                        <td width="66"><span class="camposss">Nº DOC:</span></td>
                        <td width="219"><input id="m_numdocus" name="m_numdocus" type="text" style="width:150px" maxlength="20" onkeypress="buscar_docm(this.id, event);"   value="<?php echo $arr_cliente[1];?><?php echo $arr_domiciliarios[8]; ?>" class="camposss"/><span style="color:red; margin-left:5px">(*)</span></td>
                    </tr>
                    <tr>
                    	<td><span class="camposss">Solicitante:</span></td>
                        <td colspan="3"><input id="m_solicitante" name="m_solicitante" value="<?php echo $arr_cliente[2];?><?php echo $arr_cliente[11]; ?><?php echo $arr_domiciliarios[4]; ?>" type="text" style="width:581px; text-transform:uppercase" class="camposss"/><span style="color:red; margin-left:5px">(*)</span></td>
                    </tr>
                    <tr>
                    	<td><span class="camposss">Domicilio:</span></td>
                        <td colspan="3"><input id="m_domicilio" name="m_domicilio" value="<?php echo $arr_cliente[3];?><?php echo $arr_cliente[12]; ?><?php echo $arr_domiciliarios[3]; ?>" type="text" style="width:581px; ; text-transform:uppercase" class="camposss"/><span style="color:red; margin-left:5px">(*)</span></td>
                    </tr>
                    <tr>
                    	<td><span class="camposss">Distrito:</span></td>
                        <td colspan="2"><input id="m_ubigeo" name="m_ubigeo" value="<?php echo $arr_cliente[13]; ?><?php echo dame_ubigeo($arr_domiciliarios[9]); ?>" type="text" style="width:300px; text-transform:uppercase" class="camposss" onchange="evaluar_distrito()"/>
                        <input id="m_idubigeo" name="m_idubigeo" value="<?php echo $arr_cliente[14]; ?><?php echo $arr_domiciliarios[9]; ?>" type="hidden" style="width:300px" class="camposss"/><span style="color:red; margin-left:5px">(*)</span>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td><span class="camposss">Motivo:</span></td>
                        <td colspan="3"><input id="m_motivo" name="m_motivo" value="<?php echo $arr_cliente[5];?><?php echo $arr_domiciliarios[5]; ?>" type="text" style="width:470px" class="camposss" /></td>
                    </tr>
                    <tr>
                    	<td><span class="camposss">Prof. Ocupación:</span></td>
                        <td colspan="2"><input id="m_profesion" name="m_profesion" value="<?php echo $arr_cliente[16];?><?php echo dame_profesion($arr_domiciliarios[16]); ?>" type="text" style="width:400px; text-transform:uppercase" class="camposss" />
                        <input id="m_idprofesion" name="m_idprofesion" value="<?php echo $arr_cliente[15];?><?php echo $arr_domiciliarios[16];  ?>" type="hidden" style="width:400px" class="camposss" /></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td><span class="camposss">Estado Civil:</span></td>
                        <td>
                            <select id="m_civil" name="m_civil" style="width:180px" class="camposss">
                            	<option value="0">--Estado Civil--</option>
                                <?php for($j=0; $j<count($arr_civil); $j++){?>
                                <option
                                <?php 
								if($arr_tipdoc[$j][0]==$arr_domiciliarios[14]){
									echo "selected='selected'";
								}
								?>
                                <?php 
								if($arr_civil[$j][0]==$arr_cliente[7]){
									echo "selected='selected'";
								}
								?>
                                value="<?php echo $arr_civil[$j][0]; ?>"><?php echo $arr_civil[$j][2]; ?></option>
								<?php }?>
                                
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td><span class="camposss">Sexo:</span></td>
                        <td>
                        	<select id="m_sexo" name="m_sexo" style="width:180px" class="camposss">
                            	<option value="0">--Sexo--</option>
                                <option value="M"
                                <?php 
								if($arr_domiciliarios[15]=="M"){
									echo "selected='selected'";
								}
								?>
                                <?php 
								if($arr_cliente[8]=="M"){
									echo "selected='selected'";
								}
								?>>Masculino</option>
                                <option value="F"
                                <?php 
								if($arr_domiciliarios[15]=="F"){
									echo "selected='selected'";
								}
								?>
                                <?php 
								if($arr_cliente[8]=="F"){
									echo "selected='selected'";
								}
								?>
                                >Femenino</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    
            </table>
            
            
             
