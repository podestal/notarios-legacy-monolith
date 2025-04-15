<?php
include_once('../Cpu/tbs_class.php');
include_once('../Cpu/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../conexion.php');



$idPermiViaje = $_GET['idPermiViaje'];


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

$sql = "SELECT permi_viaje.id_viaje AS id_viaje,permi_viaje.num_kardex AS kardex, permi_viaje.asunto  AS asunto,
	permi_viaje.fec_ingreso AS fecha_ingreso, permi_viaje.nom_recep AS nombreRecepcionista, 
	permi_viaje.hora_recep AS hora_recepcion,permi_viaje.referencia,permi_viaje.nom_comu  AS comunicarse,
	permi_viaje.email_comu  AS comunicarse_email, permi_viaje.documento,permi_viaje.num_crono AS numero_cronologico,
	permi_viaje.fecha_crono AS fecha_cronologico,permi_viaje.num_formu AS numero_formulario,permi_viaje.lugar_formu AS destino,
	permi_viaje.observacion, permi_viaje.swt_est,permi_viaje.partida_e,permi_viaje.sede_regis
 	FROM  permi_viaje  WHERE permi_viaje.id_viaje = '$idPermiViaje'";

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

$sql = "SELECT c_condiciones.id, c_condiciones.id_condicion AS idCondicion,c_condiciones.des_condicion AS condicion,c_condiciones.swt_condicion AS 		swtCondicion FROM  c_condiciones ORDER BY  c_condiciones.id ";
$result = mysql_query($sql);
$listParticipante = array();
while($row = mysql_fetch_assoc($result)){
	$idCondicion = $row['idCondicion'];
	$condicion = strtolower($row['condicion']);

	$sql = "SELECT viaje_contratantes.c_condicontrat AS id_condicion,CONCAT(cliente.prinom, ' ', cliente.segnom, ' ', cliente.apepat, ' ', cliente.apemat) AS contratante,
			 tipodocumento.destipdoc AS tipo_documento, cliente.numdoc AS numero_documento, nacionalidades.descripcion AS nacionalidad, 
			cliente.direccion AS direccion,  viaje_contratantes.c_fircontrat,cliente.direccion,
			IF(ubigeo.coddis='' OR ISNULL(ubigeo.coddis) ,'',CONCAT('DISTRITO DE ',ubigeo.nomdis, ', PROVINCIA DE ', ubigeo.nomprov,', DEPARTAMENTO DE ',ubigeo.nomdpto ))  AS ubigeo,
			tipoestacivil.desestcivil AS estado_civil,
			 IF(ISNULL(profesiones.desprofesion),'',profesiones.desprofesion) AS profesion, 
			 IF(ISNULL(viaje_contratantes.codi_podera),'',viaje_contratantes.codi_podera) AS codigo_poderado,
			 cliente.detaprofesion AS profesion_cliente,
			 (CASE WHEN  viaje_contratantes.condi_edad = 1 AND viaje_contratantes.edad != ''  THEN CONCAT(viaje_contratantes.edad,' AÑOS') 
			       WHEN  viaje_contratantes.condi_edad = 2 	AND viaje_contratantes.edad != '' THEN CONCAT(viaje_contratantes.edad,' MESES')
			 ELSE '' END) AS edad
			FROM viaje_contratantes 
			INNER JOIN cliente ON cliente.numdoc = viaje_contratantes.c_codcontrat
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
			INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
			LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
			WHERE viaje_contratantes.c_condicontrat = '$idCondicion' AND viaje_contratantes.id_viaje = '$idPermiViaje'";

			//die($sql);

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





if(count($listParticipante['padre']) != 0 && count($listParticipante['madre']) != 0){
	$padreMadre = 'PADRES';
}else 
if(count($listParticipante['padre']) != 0){
	$padreMadre = 'PADRE';
}else{
	$padreMadre = 'MADRE';
}

$pathDocumentSave = 'permiviaje/';

$objTbs->VarRef['VACIO'] = '';
$objTbs->VarRef['PADRE_MADRE'] = $padreMadre;
$objTbs->VarRef['CONFIG'] = $idPermiViaje.'_'.$pathDocumentSave;

$urlTemplate = '/tpl_templates/extraprotocolares/';
$folderTemplate = 'permisos_viajes/';
$templateName = 'PERMISO_VIAJE_INTERIOR.docx';

$fileName = 'PERMIVIAJE';
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

foreach ($listParticipante as $key => $record) {
	
		
	
		$objTbs->MergeBlock($key,$record);
	
}

//$objTbs->LoadTemplate($pathTemplate);

$objTbs->PlugIn(OPENTBS_DELETE_COMMENTS);
$objTbs->Show(OPENTBS_DOWNLOAD, $fileName.$fileType);