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
						 cliente.numdoc as numdoc,
						 cliente.prinom as prinom,
						 cliente.segnom as segnom,
						 cliente.apepat as apepat,
						 cliente.apemat as apemat,
						 cliente.razonsocial as razonsocial,
						 cliente.telfijo as telfijo, 
						 cliente.direccion as direccion, 
						 cliente.telofi as telofi, 
						 cliente.domfiscal as domfiscal, 
 						 cliente.tipper as tipper, 
						 ubigeo.nomdis as nomdis,
						 cliente.idtipdoc as tipdocu
						 from cliente 
						 LEFT JOIN ubigeo ON cliente.idubigeo=ubigeo.coddis 
						 where numdoc='$doic' AND cliente.numdoc <> ''";
	
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
                <td><span class="camposss">Nombre Cliente:</span></td>
                <td colspan="5"><input id="nom_cliente" name="nom_cliente" type="text" class="camposss" style="width:300px; text-transform:uppercase"  value="<?php echo simbolos(trim($array_cliente[1].$array_cliente[2])) ;?>" maxlength="100" /></td>
            </tr>
            <tr>
                <td><span class="camposss">Dirección:</span></td>
                <td  colspan="5"><input id="direccion" name="direccion" type="text" class="camposss" style="width:640px; text-transform:uppercase" value="<?php if(trim($array_cliente[4])<>""){echo simbolos($array_cliente[4].' - '.$array_cliente[7]);} if(trim($array_cliente[6])<>""){echo simbolos($array_cliente[6].' - '.$array_cliente[7]);}?>" maxlength="100"/></td>
            </tr>
    </table>