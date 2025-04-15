    <?php

	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();
	
	$sql_tipdocumento = "SELECT
						 tipodocumento.idtipdoc,
						 tipodocumento.codtipdoc,
						 tipodocumento.destipdoc
						 FROM
						 tipodocumento";		
					  
	$exe_tipdocumento = mysql_query($sql_tipdocumento, $conexion);
	
	$i=0;
	
	//while($tipdocumento = mysql_fetch_array($exe_tipdocumento, MYSQL_ASSOC))
	//{
		//$arr_tipdocumento[$i][0] = $tipdocumento["idtipdoc"];
		//$arr_tipdocumento[$i][1] = $tipdocumento["codtipdoc"];
	//	$arr_tipdocumento[$i][2] = $tipdocumento["destipdoc"];
	//	$i++;
	//}
	
	$doic = $_REQUEST['doic'];
	
	$sdoic = $_REQUEST['sdoic'];

	$consulta_cliente =  "select 
					
						 tb_proveedor.numdoc as numdoc,
						 tb_proveedor.prinom as prinom,
						 tb_proveedor.segnom as segnom,
						 tb_proveedor.apepat as apepat,
						 tb_proveedor.apemat as apemat,
						 tb_proveedor.razonsocial as razonsocial,
						 tb_proveedor.telfijo as telfijo, 
						 tb_proveedor.direccion as direccion, 
						 tb_proveedor.telofi as telofi, 
						 tb_proveedor.domfiscal as domfiscal, 
 						 tb_proveedor.tipper as tipper, 
						 ubigeo.nomdis as nomdis,
						 tb_proveedor.idtipdoc as tipdocu,
						 tb_proveedor.idproveedor as cod_proveedor
						 from tb_proveedor 
						 LEFT JOIN ubigeo ON tb_proveedor.idubigeo=ubigeo.coddis 
						 where numdoc='$doic' AND tb_proveedor.numdoc <> ''";
	
	$ejecutar_cliente = mysql_query($consulta_cliente, $conexion);
	
	while($cliente = mysql_fetch_array($ejecutar_cliente)){
		$array_cliente[0] = $cliente['numdoc'];
		$array_cliente[1] = $cliente['prinom'].' '.$cliente['segnom'].' '.$cliente['apepat'].' '.$cliente['apemat'];
		$array_cliente[2] = $cliente['razonsocial'];
		$array_cliente[3] = $cliente['telfijo'];
		$array_cliente[4] = $cliente['direccion'];
		$array_cliente[5] = $cliente['telofi'];
		$array_cliente[6] = $cliente['domfiscal'];
		$array_cliente[7] = $cliente['nomdis'];
		$array_cliente[8] = $cliente['tipper'];
		$array_cliente[9] = $cliente['tipdocu'];
		$array_cliente[10] = $cliente['cod_proveedor'];
	}
	
	//var_dump($array_cliente);
	
	if(count($array_cliente) == 0){ ?>
		<input id="flag_cliente" name="flag_cliente" type="hidden" value="0" />
	
	<?php 
	
	}
 	?>   
    
    
    <table width="754">
            <tr>
                <td width="102"><span class="camposss">RUC/DOIC:</span></td>
				<td width="340">
                	<select id="select_doic" name="select_doic" class="camposss" onchange="cambiar_doic('doic', this.value)" style="width:340px">
                    <option value="0">--Tipo de Documento--</option>
                    <?php 
					while($tipdocumento = mysql_fetch_array($exe_tipdocumento, MYSQL_ASSOC))
						{
							
							if($tipdocumento["idtipdoc"]==$sdoic){
								echo '<option value="'.$tipdocumento["idtipdoc"].'" selected="selected">'.$tipdocumento["destipdoc"].'</option>';
							}else{
								echo '<option value="'.$tipdocumento["idtipdoc"].'">'.$tipdocumento["destipdoc"].'</option>';
								}
							
						}
										?>
                              
                    </select>
                </td>
				<td width="102"><input id="doic" name="doic" type="text" class="camposss" style="width:100px" onkeypress="actualizar_datoscliente(event); return isNumberKey(event)"  value="<?php echo $doic;?>" /></td>
                <td width="22"><!--<img src="../../images/search.png" width="20" height="20" onClick=" nuevo_cliente();" style="cursor:pointer">--></td>
                <td width="58"><span class="camposss">Teléfono:</span></td>
                <td width="102"><input id="telefono" name="telefono"  type="text" class="camposss" style="width:100px" value="<?php echo $array_cliente[3]; echo $array_cliente[5];?>" maxlength="10" onKeyPress="return isNumberKey(event)"/></td>
            </tr>
            <tr>
                <td><span class="camposss">Nombre :</span></td>
                <td colspan="5"><input id="nom_cliente" name="nom_cliente" type="text" class="camposss" style="width:300px; text-transform:uppercase"  value="<?php echo simbolos(trim($array_cliente[1].$array_cliente[2])) ;?>" maxlength="100" /><input id="cod_proveedor" name="cod_proveedor" type="hidden" class="camposss" style="width:300px; text-transform:uppercase"  value="<?php echo ($array_cliente[10]) ;?>" maxlength="100" /></td>
            </tr>
            <tr>
                <td><span class="camposss">Dirección:</span></td>
                <td  colspan="5"><input id="direccion" name="direccion" type="text" class="camposss" style="width:640px; text-transform:uppercase" value="<?php if(trim($array_cliente[4])<>""){echo simbolos($array_cliente[4].' - '.$array_cliente[7]);} if(trim($array_cliente[6])<>""){echo simbolos($array_cliente[6].' - '.$array_cliente[7]);}?>" maxlength="100"/></td>
            </tr>
    </table>