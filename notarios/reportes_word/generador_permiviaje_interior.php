<?php
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('fecha_letra.php');
include("../phpqrcode/qrlib.php");
 
//
$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.

$queryUsuario = "SELECT loginusuario,
						dni
				FROM usuarios 
				WHERE CONCAT(apepat,' ',prinom)='$usuario_imprime'";
$executeQuery = mysql_query($queryUsuario);
$arrUsuario = mysql_fetch_assoc($executeQuery);

$USUARIO = $arrUsuario['loginusuario'];
$USUARIO_DNI = $arrUsuario['dni'];
$COMPROBANTE = 'sin';


$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('permiviaje');

$extension       = $ruta_archivos->__set_tip_output_ep();
//

$idPermiViaje = $_REQUEST['id_viaje'];

$sqlnuevo = "SELECT  qr FROM  permi_viaje  WHERE permi_viaje.id_viaje = '$idPermiViaje'";


	
$resultnuevo = mysql_query($sqlnuevo);
$rownuevo = mysql_fetch_assoc($resultnuevo);



$estadoviaje=$rownuevo ['qr'];


if($estadoviaje == '1'){
	
	echo "YA SE HA GENERADO EL QR...." ;
	
}
else{
	$objNumeroLetra = new ClaseNumeroLetra();
$objTbs = new clsTinyButStrong('{,}');
$objTbs->ResetVarRef(true);
$objTbs->MergeField('var');

$sql = "SELECT nombre AS nombres,apellido AS apellidos, CONCAT(nombre,' ',apellido) AS notario,ruc AS ruc_notario,distrito AS distrito_notario,direccion AS direccion_notario FROM confinotario";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);


if($row){
	foreach ($row as $key => $value) {
		# code...
		switch ($key) {
   				case 'ruc_notario':
   					# code...
   					$lettersRucNotario = $objNumeroLetra->fun_nume_letras($value);
   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
		 			$objTbs->VarRef[$bookmarkName] = $lettersRucNotario;
   					break;
   				default:
   					# code...
   					break;
   			}

   			$key = mb_strtoupper(trim($key));
   			$value = is_null($value)?'?':$value;
   			$objTbs->VarRef[$key] = mb_strtoupper($value);

	}
}else{
	$columnCount =  mysql_num_fields($result);
	for ( $j = 0;$j < mysql_num_fields($result);$j++) {
		$metaData = mysql_fetch_field($result, $j);
      	$key = $metaData->name;
      	$value = null;
      	switch ($key) {
   				case 'ruc_notario':
   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
		 			$objTbs->VarRef[$bookmarkName] = '';
   					break;
   				default:
   					# code...
   					break;
   			}
   			$value = null;
   			$key = mb_strtoupper(trim($key));
   			$value = is_null($value)?'?':$value;
   			$objTbs->VarRef[$key] = mb_strtoupper($value);
	
	}

}

$sql = "SELECT permi_viaje.id_viaje AS id_viaje,permi_viaje.num_kardex AS kardex, permi_viaje.asunto  AS asunto,
	permi_viaje.fec_ingreso AS fecha_ingreso, permi_viaje.nom_recep AS nombreRecepcionista, 
	permi_viaje.hora_recep AS hora_recepcion,permi_viaje.referencia,permi_viaje.nom_comu  AS comunicarse,
	permi_viaje.email_comu  AS comunicarse_email, permi_viaje.documento,permi_viaje.num_crono AS numero_cronologico,
	permi_viaje.fecha_crono AS fecha_cronologico,permi_viaje.num_formu AS numero_formulario,permi_viaje.lugar_formu AS destino,
	permi_viaje.observacion, permi_viaje.swt_est,permi_viaje.partida_e,permi_viaje.sede_regis,
	permi_viaje.via,
	permi_viaje.fecha_desde, 
	permi_viaje.fecha_hasta
 	FROM  permi_viaje  WHERE permi_viaje.id_viaje = '$idPermiViaje'";

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);


$fechaingres=$row['fecha_ingreso'];
$REFER = $row['referencia'];
$VIA_TRANS = $row['via'];
$FEC_DESDE = $objNumeroLetra->fun_fech_completo3_anio3($row['fecha_desde']);
$FEC_HASTA = $objNumeroLetra->fun_fech_completo3_anio3($row['fecha_hasta']);


$fechaingresonueva = $objNumeroLetra->fun_fech_completo2_anio2($fechaingres);
//die($fechaingresonueva);
$objTbs->VarRef['nuevafecha'] = $fechaingresonueva;


$sql3 = "SELECT nombre AS nombres,apellido AS apellidos, CONCAT(nombre,' ',apellido) AS notario,ruc AS ruc_notario,distrito AS distrito_notario,direccion AS direccion_notario FROM confinotario";


$result3 = mysql_query($sql3);
$row3 = mysql_fetch_assoc($result3);



$licencia = "SELECT notario,resolucion,fechainicio,fechafin, STR_TO_DATE(NOW(),'%Y-%m-%d'),STR_TO_DATE(fechainicio,'%Y-%m-%d') FROM confinotario
WHERE  STR_TO_DATE('$fechaingres','%Y-%m-%d') >= STR_TO_DATE(fechainicio,'%Y-%m-%d') AND STR_TO_DATE('$fechaingres','%Y-%m-%d') <= STR_TO_DATE(fechafin,'%Y-%m-%d')";
$licenciaresult = mysql_query($licencia);
$licencianueva = mysql_fetch_array($licenciaresult);
$notariolicencia= $licencianueva[0];
$notariolicencia2= $licencianueva[1];



if ($notariolicencia != null)
{
	$notariolicencianueva='POR LICENCIA DE LA NOTARIA '.$row3['notario'].' FIRMA EL NOTARIO '.$notariolicencia.' SEGUN RESOLUCION N° '.$notariolicencia2;
$objTbs->VarRef['licencia'] =$notariolicencianueva;
}
else
{
	$notariolicencianueva='YO '.$row3['notario'].' ABOGADO - NOTARIO DE PUNO CON OFICIO NOTARIAL EN '.$row3['direccion_notario'];
	$objTbs->VarRef['licencia'] =$notariolicencianueva;
}

if($row){
	foreach ($row as $key => $value) {
		# code...
		//$value = utf8_decode($value);
		switch ($key) {
   				case 'fecha_ingreso':
   					# code...
   					$lettersFechaConclusion = $objNumeroLetra->fun_fech_letras($value);
		   			$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 	$objTbs->VarRef[$bookmarkName] = $lettersFechaConclusion;
   					break;
				case 'kardex':
					$year = substr($value,0,4);
					$number = substr($value,4,strlen($value));
					$value = $number.'-'.$year;
					break;
   				default:
   					# code...
   					break;
   			}
   			$key = mb_strtoupper(trim($key));
   			$value = is_null($value)?'?':$value;
   			$objTbs->VarRef[$key] = mb_strtoupper($value,'UTF-8');

	}
}else{
	$columnCount =  mysql_num_fields($result);
	for ( $j = 0;$j < mysql_num_fields($result);$j++) {
		$metaData = mysql_fetch_field($result, $j);
      	$key = $metaData->name;
      	$value = null;
      	switch ($key) {
   				case 'fecha_ingreso':
		   			$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 	$objTbs->VarRef[$bookmarkName] = '';
   				default:
   					# code...
   					break;
   			}
   			$value = null;
   			$key = mb_strtoupper(trim($key));
   			$value = is_null($value)?'?':$value;
   			$objTbs->VarRef[$key] = mb_strtoupper($value);
	
	}

}

$sqlNumContratantes = "SELECT c_descontrat
FROM viaje_contratantes
WHERE (c_condicontrat = '001' 
		OR c_condicontrat='003'
		OR c_condicontrat='004'
		OR c_condicontrat='005'
		OR c_condicontrat='010' 
		) 
		AND viaje_contratantes.id_viaje = '$idPermiViaje'";
$resultNumContratantes = mysql_query($sqlNumContratantes);
$numContratantes = mysql_num_rows($resultNumContratantes);

$sql = "SELECT c_condiciones.id, c_condiciones.id_condicion AS idCondicion,c_condiciones.des_condicion AS condicion,c_condiciones.swt_condicion AS 		swtCondicion FROM  c_condiciones  WHERE swt_condicion = 'V' AND c_condiciones.id_condicion != '002'  ORDER BY  c_condiciones.id ";
$result = mysql_query($sql);
$listParticipante = array();
$arrContratantes = array();
while($row = mysql_fetch_assoc($result)){
	$idCondicion = $row['idCondicion'];
	$condicion = strtolower($row['condicion']);

	$sql = "SELECT viaje_contratantes.c_condicontrat AS id_condicion,CONCAT(cliente.prinom, ' ', cliente.segnom, ' ', cliente.apepat, ' ', cliente.apemat) AS contratante,
			 tipodocumento.td_abrev AS tipo_documento,tipodocumento.td_abrev AS abreviatura, cliente.numdoc AS numero_documento, nacionalidades.descripcion AS nacionalidad, 
			 CONCAT(' CON DOMICILIO EN ',cliente.direccion) AS direccion,  viaje_contratantes.c_fircontrat,
			IF(ubigeo.coddis='' OR ISNULL(ubigeo.coddis) ,'',CONCAT('DEL DISTRITO DE ',ubigeo.nomdis, ', PROVINCIA DE ', ubigeo.nomprov,', DEPARTAMENTO DE ',ubigeo.nomdpto ))  AS ubigeo,
			tipoestacivil.desestcivil AS estado_civil,
			 IF(ISNULL(profesiones.desprofesion),'',profesiones.desprofesion) AS profesion, 
			 IF(ISNULL(viaje_contratantes.codi_podera),'',viaje_contratantes.codi_podera) AS codigo_poderado,
			 cliente.detaprofesion AS profesion_cliente,
			 (CASE WHEN  viaje_contratantes.condi_edad = 1 AND viaje_contratantes.edad != ''  THEN CONCAT(viaje_contratantes.edad,' AÑOS') 
			       WHEN  viaje_contratantes.condi_edad = 2 	AND viaje_contratantes.edad != '' THEN CONCAT(viaje_contratantes.edad,' MESES')
			 ELSE '' END) AS edad,cliente.sexo
			FROM viaje_contratantes 
			INNER JOIN cliente ON cliente.numdoc = viaje_contratantes.c_codcontrat
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
			INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
			LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
			WHERE viaje_contratantes.c_condicontrat = '$idCondicion' AND viaje_contratantes.id_viaje = '$idPermiViaje'";
			
	$resultParticipantes = mysql_query($sql);
	$affectedRow = mysql_affected_rows();
	$arrParticipante = array();
	if( $affectedRow != 0){
		while ($rowParticipante = mysql_fetch_assoc($resultParticipantes)) {
			# code...

			if($numContratantes>1){
				$rowParticipante['SOLICITANTE'] = $rowParticipante['sexo'] == 'M'?'a los solicitantes':'a los solicitantes';
				$rowParticipante['nuevo'] = $rowParticipante['id_condicion'] == '003'?'QUIENES PROCEDEN EN REPRESENTACION SEGUN PODER INSCRITO EN LA PARTIDA REGISTRAL N°'.$rowParticipante['partida']:'';
				$rowParticipante['procede'] = $rowParticipante['sexo'] == 'M'?'Los compareciente proceden':'Los comparecienten proceden';
			}else{
	
				$rowParticipante['SOLICITANTE'] = $rowParticipante['sexo'] == 'M'?'al solicitante':'a la solicitante';
				$rowParticipante['nuevo'] = $rowParticipante['id_condicion'] == '003'?'QUIEN PROCEDE EN REPRESENTACION SEGUN PODER INSCRITO EN LA PARTIDA REGISTRAL N°'.$rowParticipante['partida']:'';
				$rowParticipante['procede'] = $rowParticipante['sexo'] == 'M'?'El compareciente procede':'La compareciente procede';
			}

			$rowParticipante['identificado'] = $rowParticipante['sexo'] == 'M'?'IDENTIFICADO':'IDENTIFICADA';
			$rowParticipante['domiciliado'] = $rowParticipante['sexo'] == 'M'?'CON DOMICILIO ':'CON DOMICILIO ';
			$rowParticipante['senor'] = $rowParticipante['sexo'] == 'M'?'SEÑOR':'SEÑORA';
			$rowParticipante['el'] = $rowParticipante['sexo'] == 'M'?'EL':'LA';
			$rowParticipante['don'] = $rowParticipante['sexo'] == 'M'?'DON':'DOÑA';
			$rowParticipante['nacionalidad'] = $rowParticipante['sexo'] == 'M'?substr($rowParticipante['nacionalidad'],0,-1).'O':substr($rowParticipante['nacionalidad'],0,-1).'A';
			$record = $rowParticipante;
			foreach ($record as $key => $value) {
				# code...

				$bookmarkName = mb_strtoupper($condicion.'_'.$key);
				$objTbs->VarRef[$bookmarkName] = $value;
			}
			$arrParticipante[] = $rowParticipante;
			$arrContratantes[] = $rowParticipante;

		}
		
		$listParticipante[$condicion] = $arrParticipante;

	}else{
		$columnCount =  mysql_num_fields($resultParticipantes);
		$row1 = array();
		for ( $j = 0;$j < mysql_num_fields($resultParticipantes);$j++) {
			$metaData = mysql_fetch_field($resultParticipantes, $j);
	      	$key = $metaData->name;
	      	$row1[$metaData->name] = '';
	      	$bookmarkName = mb_strtoupper($condicion.'_'.$key);
			$objTbs->VarRef[$bookmarkName] = '';
	      	
			
		}
		$listParticipante[$condicion] = array();
	}

}

$countContratantes = count($arrContratantes);
$x = 1;
foreach ($arrContratantes as $key =>  $value) {
	# code...
	if($countContratantes == $x){
		$arrContratantes[$key]['y_coma'] = '.';
	}else if(($countContratantes- 1) == $x){
		$arrContratantes[$key]['y_coma'] = 'Y';
	}else{
		$arrContratantes[$key]['y_coma'] = ',';
	}
	$x++;
}
if(count($arrContratantes) == 1 ){
		$objTbs->VarRef['A_EL_LOS'] = 'EL';
		$objTbs->VarRef['A_S'] = '';
		$objTbs->VarRef['A_N'] = '';

	
}else{
	 $objTbs->VarRef['A_EL_LOS'] = 'LOS';
	 $objTbs->VarRef['A_S'] = 'S';
	 $objTbs->VarRef['A_N'] = 'N';
}

	



$sql = "SELECT viaje_contratantes.c_condicontrat AS id_condicion,CONCAT(cliente.prinom, ' ', cliente.segnom, ' ', cliente.apepat, ' ', cliente.apemat) AS contratante,
			 tipodocumento.td_abrev AS tipo_documento, tipodocumento.td_abrev AS abreviatura,cliente.numdoc AS numero_documento, nacionalidades.descripcion AS nacionalidad, 
			cliente.direccion AS direccion,  viaje_contratantes.c_fircontrat,cliente.direccion,
			IF(ubigeo.coddis='' OR ISNULL(ubigeo.coddis) ,'',CONCAT('DISTRITO DE ',ubigeo.nomdis, ', PROVINCIA DE ', ubigeo.nomprov,', DEPARTAMENTO DE ',ubigeo.nomdpto ))  AS ubigeo,
			tipoestacivil.desestcivil AS estado_civil,
			 IF(ISNULL(profesiones.desprofesion),'',profesiones.desprofesion) AS profesion, 
			 IF(ISNULL(viaje_contratantes.codi_podera),'',viaje_contratantes.codi_podera) AS codigo_poderado,
			 cliente.detaprofesion AS profesion_cliente,
			 (CASE WHEN  viaje_contratantes.condi_edad = 1 AND viaje_contratantes.edad != ''  THEN CONCAT(viaje_contratantes.edad,' AÑOS') 
			       WHEN  viaje_contratantes.condi_edad = 2 	AND viaje_contratantes.edad != '' THEN CONCAT(viaje_contratantes.edad,' MESES')
			 ELSE '' END) AS edad,cliente.sexo
			FROM viaje_contratantes 
			INNER JOIN cliente ON cliente.numdoc = viaje_contratantes.c_codcontrat
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
			INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
			LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
			WHERE viaje_contratantes.c_condicontrat = '002' AND viaje_contratantes.id_viaje = '$idPermiViaje'";

$result = mysql_query($sql);
$arrMenores = array();
$affectedRowMenores = mysql_affected_rows();
$i = 1;
$allF = true;
while($row = mysql_fetch_assoc($result)){
	$sex = $row['sexo'];
	$row['identificado'] = $sex == 'M'?'IDENTIFICADO':'IDENTIFICADA';
	if($sex == 'M'){
		$allF = false;
	}
	if($affectedRowMenores == $i){
		$row['y_coma']	= '.';
	}else if(($affectedRowMenores- 1) == $i){
		$row['y_coma']	= 'Y';
	}else{
		$row['y_coma']	= ',';
	}
	$arrMenores[] = $row;
	$i++;
}


//$sexo->get($arrMenores['sexo']);

if(count($arrMenores) == 1 ){
		if($sex == 'M'){
			$objTbs->VarRef['EL_LA_LOS'] = 'EL';
			$objTbs->VarRef['HIJO'] = 'HIJO';
			
		}else{
			$objTbs->VarRef['EL_LA_LOS'] = 'LA';
			$objTbs->VarRef['HIJO'] = 'HIJA';
		}
		$objTbs->VarRef['MENOR'] = 'SU MENOR';
		$objTbs->VarRef['AUTORIZA'] = 'AUTORIZA';
	
}else{
	if($allF){
		$objTbs->VarRef['EL_LA_LOS'] = 'LAS';
		$objTbs->VarRef['HIJO'] = 'HIJAS';
	}else{
		$objTbs->VarRef['EL_LA_LOS'] = 'LOS';
		$objTbs->VarRef['HIJO'] = 'HIJOS';
	}
	$objTbs->VarRef['MENOR'] = 'SUS MENORES';
	$objTbs->VarRef['AUTORIZA'] = 'AUTORIZAN';
	
}

///qr

$sqlviaje = mysql_query('SELECT	permi_viaje.id_viaje ,
permi_viaje.num_kardex ,
(CASE WHEN(permi_viaje.asunto=001) THEN "PERMISO VIAJE AL INTERIOR" ELSE "PERMISO VIAJE AL EXTERIOR" END) AS tipopermiso,
IF(DATE_FORMAT(permi_viaje.fec_ingreso,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(permi_viaje.fec_ingreso,"%d/%m/%Y")) AS fec_ingreso,
IF(DATE_FORMAT(permi_viaje.fecha_crono,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(permi_viaje.fecha_crono,"%d/%m/%Y")) AS fecha_crono,
permi_viaje.asunto,
permi_viaje.lugar_formu ,
permi_viaje.num_crono ,
permi_viaje.swt_est AS estado,
permi_viaje.num_formu,
permi_viaje.observacion 
FROM permi_viaje  WHERE id_viaje ="'.$idPermiViaje.'"', $conn) or die(mysql_error());


$arr_viaje[]=array();
$poder = mysql_fetch_array($sqlviaje);
	$arr_viaje[0] = $poder["id_viaje"]; 
	$arr_viaje[1] = $poder["num_kardex"]; 
	$arr_viaje[2] = $poder["asunto"]; 
	$arr_viaje[3] = $poder["fec_ingreso"]; 
	$arr_viaje[4] = $poder["fecha_crono"]; 
	$arr_viaje[5] = $poder["asunto"]; 
	$arr_viaje[6] = $poder["lugar_formu"]; 
	$arr_viaje[7] = $poder["num_crono"]; 
	$arr_viaje[8] = $poder["estado"]; 
	$arr_viaje[9] = $poder["num_formu"]; 
	$arr_viaje[10] = $poder["observacion"]; 
	$arr_viaje[11] = $poder["estado"]; 
	$arr_viaje[12] = $poder["estado"]; 
	$arr_viaje[13] = $poder["estado"]; 
	$arr_viaje[14] = $poder["estado"]; 
	
	//JSON
         $objPermisoViaje = new stdClass();
		 $objPermisoViaje->codigotipoinstrumento = 102;
		 $objPermisoViaje->codigoinstrumento = 250; 
		 $objPermisoViaje->codigonotaria ="143";
		 $objPermisoViaje->fecharegistro =$arr_viaje[3];
		 $objPermisoViaje->fechainstrumento =  $arr_viaje[4]; 
		 $objPermisoViaje->fechaexpiracion = "";
		 $objPermisoViaje->fechasalida = "";
		 $objPermisoViaje->fecharetorno = "";
		 $objPermisoViaje->numerocontrol =  $arr_viaje[0];
		 $objPermisoViaje->numeroformulario =$arr_viaje[9];
		 $objPermisoViaje->cronologico = $arr_viaje[1];
		 $objPermisoViaje->ruta = $arr_viaje[6];
		 $objPermisoViaje->idavuelta = 1;
		 $objPermisoViaje->transporte = "T";
		 $objPermisoViaje->observacion = $arr_viaje[10];



		 $consultapar = mysql_query('SELECT V.`c_fircontrat`,V.`c_codcontrat`, C.apepat,C.`apemat`, C.`prinom` , C.`idtipdoc`,C.`direccion`, 
		 (CASE
			 WHEN V.c_condicontrat = 001 THEN "01" 
			 WHEN V.c_condicontrat = 002 THEN "03" 
			 WHEN V.c_condicontrat = 003 THEN "07" 
			 WHEN V.c_condicontrat = 004 THEN "09"
			 WHEN V.c_condicontrat = 005 THEN "02" 
			 WHEN V.c_condicontrat = 010 THEN "08" 
		 END) AS campo,
		 SUBSTRING(C.`docpaisemi`, 1, 3) segundo,C.`email`,C.`telcel` FROM viaje_contratantes V 
		 INNER JOIN cliente C ON C.numdoc = V.c_codcontrat WHERE id_viaje ="'.$idPermiViaje.'"', $conn) or die(mysql_error());
			$objParticipante = new stdClass();

			$datos = array();
		while($row3 = mysql_fetch_array($consultapar)){
		
			$objParticipante->condicion = $row3[7];
			$objParticipante->tipodocumento = '0'.$row3[5];
			$objParticipante->documento = $row3[1];
			$objParticipante->nombres = $row3[4];
			$objParticipante->apellidopaterno = $row3[2];
			$objParticipante->apellidomaterno = $row3[3];
			$objParticipante->fechanacimiento = '13/10/1998';
			$objParticipante->direccion = $row3[6];
			$objParticipante->nacionalidad = $row3[8];
			$objParticipante->correo = $row3[9];
			$objParticipante->telefono = $row3[10];
			$objParticipante->firma = true;
			$objParticipante->nombrepresentante = $row3[3];
			$objParticipante->documentorepresentante = $row3[3];
			$objParticipante->partidaregistral = $row3[3];
			$objParticipante->sederepresentante = $row3[3];
			$objParticipante->observacion = $row3[3];

			$datos[] = array('condicion'=> $objParticipante->condicion, 'tipodocumento'=>$objParticipante->tipodocumento,
			'documento'=>$objParticipante->documento,'nombres'=>$objParticipante->nombres,'apellidopaterno'=>$objParticipante->apellidopaterno,
			'apellidomaterno'=>$objParticipante->apellidomaterno,'fechanacimiento'=>$objParticipante->fechanacimiento,
			'direccion'=>$objParticipante->direccion,'correo'=>$objParticipante->correo,
			'telefono'=>$objParticipante->telefono,'firma'=>$objParticipante->firma,'nombrepresentante'=>$objParticipante->nombrepresentante,
			'documentorepresentante'=>$objParticipante->documentorepresentante,'partidaregistral'=>$objParticipante->partidaregistral
			,'sederepresentante'=>$objParticipante->sederepresentante,'observacion'=>$objParticipante->observacion);
		}
		 //var_dump($datos);
		 $objPermisoViaje->participantes  = $datos; 
		 // echo json_encode($objPermisoViaje);
		$objJson  = new stdClass();
		$objPermiViaje = new  stdClass();
		$objPermiViaje->pviajes = $objPermisoViaje;
		$objJson->pviajes = $objPermisoViaje;
		//$objJson->json = $objPermiViaje;
		$dataJson =  $objJson;
		$dataJson =  json_encode(array($objPermisoViaje));
		$std = new stdClass();
		$std->pviajes = $objPermisoViaje;
		$json = json_encode($std);
		$data = array("pviajes" => $objPermisoViaje);
		$versiones = array(
			"pviajes" => $objPermisoViaje
		);
		$myJSON = json_encode($versiones);

		$dataJson = json_encode(array("json" => $myJSON));

		//define('WS_ENVIAR_DOCUMENTO','http://192.168.250.45/serviceqr/public/api/pviajes');
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, WS_ENVIAR_DOCUMENTO);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($dataJson)));
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, true);
		$responseString = curl_exec ($ch); 

		$objResponse = json_decode($responseString, true);

		
		
		$arr_resp[]=array();
		
		//var_dump ($arr_resp[0]);

		$codigonuevo=$objResponse['instrumento']['codigoencriptado'];
		
		//var_dump ($arr_resp[0]);
		$objTbs->VarRef['codigonuevo'] = $codigonuevo;



		if(count($objResponse['error'])>0){
			
			$erroresnew='';
			for ($i = 0; $i < count($objResponse['error']); $i++) {
				$arr_resp[$i]=$objResponse['error'][$i];
				$erroresnew = $erroresnew."\n".$arr_resp[$i];
			}
			echo "Error'.$erroresnew.' ";
			die();

		}else {

			$dir = 'tempo/';
			//Si no existe la carpeta la creamos
			if (!file_exists($dir))
				mkdir($dir);
				//Declaramos la ruta y nombre del archivo a generar
			$filename = $dir.$arr_viaje[0] .'.png';
			$img=$arr_viaje[0] .'.png';
				//Parametros de Condiguración
			$tamaño = 10; //Tamaño de Pixel
			$level = 'L'; //Precisión Baja
			$framSize = 3; //Tamaño en blanco
			$contenido =$objResponse['hash']; //Texto
				//Enviamos los parametros a la Función para generar código QR 
			QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
			//Mostramos la imagen generada
			//echo '<img src="'.$dir.basename($filename).'" /><hr/>'; 
			$imagen =$dir.basename($filename); 
			$ruta1 = getcwd().'\\tempo\\';
			$ruta = $ruta1.$img;
			
			//die($ruta);
			
			$objTbs->VarRef['test'] =  $ruta;
if(count($listParticipante['padre']) != 0 && count($listParticipante['madre']) != 0){
	$condicion = 'PADRES';
	$manifiesta = 'MANIFIESTAN';
	$losellaPadres = 'LOS PADRES';
}else 
if(count($listParticipante['padre']) != 0){
	$condicion = 'PADRE';
	$manifiesta = 'MANIFIESTA';
	$losellaPadres = 'EL PADRE';
}else if(count($listParticipante['madre']) != 0){
	$condicion = 'MADRE';
	$manifiesta = 'MANIFIESTA';
	$losellaPadres = 'LA MADRE';
}else  if(count($listParticipante['apoderado']) != 0){
	$condicion = 'APODERADO';
	$manifiesta = 'MANIFIESTA';
	$losellaPadres = 'EL APODERADO';
}else  if(count($listParticipante['tutor']) != 0){
	$condicion = 'TUTOR';
	$manifiesta = 'MANIFIESTA';
	$losellaPadres = '';
}else{
	$condicion = 'TESTIGO';
	$manifiesta = 'MANIFIESTA';
}
$pathDocumentSave = 'permiviaje';

$objTbs->VarRef['VACIO'] = '';
$objTbs->VarRef['CONDICION'] = $condicion;
$objTbs->VarRef['MANIFIESTA'] = $manifiesta;
$objTbs->VarRef['LOSELLA_PADRES'] =  ($losellaPadres==null )?'SIN DATO':$losellaPadres;
$objTbs->VarRef['CONFIG'] = $idPermiViaje.'_'.$pathDocumentSave;

// $urlTemplate = '/tpl_templates/extraprotocolares/';
// $folderTemplate = 'permisos_viajes/';

	$sqlKardex = "SELECT num_kardex FROM  permi_viaje as p WHERE p.id_viaje = '$idPermiViaje'";
	$resultKardex = mysql_query($sqlKardex);
	$rowKardex = mysql_fetch_assoc($resultKardex);
	$anioKardex = substr($rowKardex['num_kardex'],0,4);


$rutaPlantilla="D:/plantillas/EXTRAPROTOCOLARES/ACTAS/AUTORIZACIONES DE VIAJE/";

$templateName = 'AUTORIZACION VIAJE MENOR INTERIOR.docx';
// $templateName = 'PERMISO_VIAJE_INTERIOR.odt';

$fileName = '__PERMIVIAJE__'.$arr_viaje[0].'-'.$anioKardex;
$fileType = '.docx';
// $fileType = '.odt';
$here = getcwd();
// $pathTemplate = $here.$urlTemplate.$folderTemplate.$templateName;
$pathTemplate = $rutaPlantilla.$templateName;

if(!file_exists($pathTemplate)){
	die('El  directorio de la plantilla no existe:'.$pathTemplate);

}

$objTbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
$objTbs->NoErr = true;
$objTbs->LoadTemplate($pathTemplate,OPENTBS_ALREADY_UTF8);


$objTbs->MergeBlock('c,f',$arrContratantes);
$objTbs->MergeBlock('m,a',$arrMenores);
foreach ($listParticipante as $key => $record) {
		$objTbs->MergeBlock($key,$record);
	
}

$objTbs->PlugIn(OPENTBS_DELETE_COMMENTS);
$objTbs-> PlugIn (OPENTBS_CHANGE_PICTURE, 'descripcionImagen', $ruta);

	


	if(!file_exists($path_exit.$anioKardex)){
		mkdir($path_exit.$anioKardex,0700);
	}


	$file_name3      = $path_exit.$anioKardex.'/'.$fileName.$fileType;
	
	
    $objTbs->Show(TBSZIP_FILE, $file_name3);
	
	echo "Se genero el archivo'.$fileName.'satisfactoriamente..!! " ;

}
	
	
}

















