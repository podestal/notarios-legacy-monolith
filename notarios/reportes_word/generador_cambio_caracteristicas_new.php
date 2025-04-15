<?php

include_once('../Cpu/tbs_class.php');
include_once('../Cpu/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../conexion.php');


$numeroCronologico = '2016000002';        //Num. poder a exportar.
$idCambio = 2;

$objNumeroLetra = new ClaseNumeroLetra();
$objTbs = new clsTinyButStrong('{,}');
$objTbs->ResetVarRef(true);
$objTbs->MergeField('var');

$sql = "SELECT nombre AS nombres,apellido AS apellidos, CONCAT(nombre,' ',apellido) AS notario,ruc AS ruc_notario,distrito AS distrito_notario FROM confinotario";
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

$sql = "SELECT cambio_caracter.num_crono as numero_cronologico, detalle_cambios.des_cambio AS tipo_cambio , UPPER(det_cambiocarac.descripcion) AS numero_placa, 
	cambio_caracter.nombre AS participante_particular, IF(ISNULL(cambio_caracter.observacion),'',cambio_caracter.observacion) AS observacion,
	cambio_caracter.fec_ingreso AS fecha_ingreso
	FROM cambio_caracter
	INNER JOIN det_cambiocarac ON det_cambiocarac.id_cambio = cambio_caracter.id_cambio AND det_cambiocarac.id_dato='0000'
	INNER JOIN detalle_cambios ON detalle_cambios.id_cambio = det_cambiocarac.id_dato
	WHERE cambio_caracter.num_crono = '$numeroCronologico'";

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

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


$sql = "SELECT UPPER(CONCAT (cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',CLIENTE.apemat )) AS participante,
		 ccaracter_solicitantes.numdocu_solicitante AS numero_documento,tipodocumento.destipdoc AS tipo_documento,
		ccaracter_solicitantes.domic_solicitante AS direccion, tipoestacivil.desestcivil AS estado_civil,
		IF(ubigeo.coddis='070101','DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO',CONCAT('DISTRITO DE ',ubigeo.nomdis, ', PROVINCIA DE ', ubigeo.nomprov,', DEPARTAMENTO DE ',ubigeo.nomdpto ))  AS ubigeo,
		ccaracter_solicitantes.representante AS representante, ccaracter_solicitantes.poder_inscrito AS porder_inscrito,
		ccaracter_solicitantes.tipdoc_representante FROM ccaracter_solicitantes
		INNER JOIN cambio_caracter ON ccaracter_solicitantes.id_cambio = cambio_caracter.id_cambio
		INNER JOIN tipodocumento ON tipodocumento.codtipdoc = ccaracter_solicitantes.tipdoc_solicitante
		INNER JOIN CLIENTE ON CLIENTE.numdoc = CCARACTER_SOLICITANTES.numdocu_solicitante
		INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = ccaracter_solicitantes.ecivil_solicitante
		LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
		WHERE cambio_caracter.num_crono = '$numeroCronologico'";

$resultParticipantes = mysql_query($sql);
$affectedRow = mysql_affected_rows();
$arrParticipante = array();
if( $affectedRow != 0){
	while ($rowParticipante = mysql_fetch_assoc($resultParticipantes)) {
		# code...
		$record = $rowParticipante;
		foreach ($record as $key => $value) {
			# code...
			$bookmarkName = mb_strtoupper($condicion.'_'.$key);
			$objTbs->VarRef[$bookmarkName] = $value;
		}



		$arrParticipante[] = $rowParticipante;

	}
	
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
	
}


$sql = "SELECT detalle_cambios.des_cambio AS tipo_cambio, UPPER(det_cambiocarac.descripcion) AS descripcion
		FROM det_cambiocarac
		INNER JOIN detalle_cambios ON detalle_cambios.id_cambio = det_cambiocarac.id_dato AND det_cambiocarac.id_dato<>'0000'
		WHERE det_cambiocarac.id_cambio = '$idCambio'";

$resultDetalle = mysql_query($sql);
$affectedRow = mysql_affected_rows();
$arrDetalle = array();
if($affectedRow != 0){
	while ($rowDetalle = mysql_fetch_assoc($resultDetalle)) {
		# code...
		$record = $rowDetalle;
		foreach ($record as $key => $value) {
			# code...
			$bookmarkName = mb_strtoupper($condicion.'_'.$key);
			$objTbs->VarRef[$bookmarkName] = $value;
		}



		$arrDetalle[] = $rowDetalle;

	}
	
}else{
	$columnCount =  mysql_num_fields($resultDetalle);
	$row1 = array();
	for ( $j = 0;$j < mysql_num_fields($resultDetalle);$j++) {
		$metaData = mysql_fetch_field($resultDetalle, $j);
      	$key = $metaData->name;
      	$row1[$metaData->name] = '';
      	$bookmarkName = mb_strtoupper($condicion.'_'.$key);
		$objTbs->VarRef[$bookmarkName] = '';
      	
		
	}
	
}


$urlTemplate = '/tpl_templates/extraprotocolares/';
$folderTemplate = 'cambio_caracteristicas/';
$templateName = 'CAMBIO_CARACTERISTICA.docx';

$fileName = 'CAMBIO_CARACTERISTICA';
$fileType = '.docx';
$here = getcwd();
$pathTemplate = $here.$urlTemplate.$folderTemplate.$templateName;
if(!file_exists($pathTemplate)){
	die('El  directorio de la plantilla no existe:'.$pathTemplate);

}

$objTbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
$objTbs->NoErr = true;
$objTbs->LoadTemplate($pathTemplate,OPENTBS_ALREADY_UTF8);

//var_dump($listParticipante);
//die();
$objTbs->MergeBlock('p,f,c',$arrParticipante);
$objTbs->MergeBlock('d',$arrDetalle);
/*foreach ($listParticipante as $key => $record) {
	
		
	
		$objTbs->MergeBlock($key,$record);
	
}*/

//$objTbs->LoadTemplate($pathTemplate);

$objTbs->PlugIn(OPENTBS_DELETE_COMMENTS);
$objTbs->Show(OPENTBS_DOWNLOAD, $fileName.$fileType);
