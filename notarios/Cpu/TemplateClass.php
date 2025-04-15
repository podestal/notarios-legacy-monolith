<?php

include_once('tbs_class.php');
include_once('tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../conexion.php');



class TemplateClass {
	private $_pkTemplate;
	private $_templateName;
	private $_pathTemplate;
	private $_folderTemplate;
	private $_urlTemplate;
	private $_template;
	private $_columns = array();
	private $_objPDO;
	private $_objTbs ;
	private $_params  = array();

	private $_fileName;
	private $_codeActs;
	private $_pkTypeKardex;
	private $_fileType;
	private $_kardex;
	private $_objNumeroLetra;
	private $_totalScore;
	private $_arrVars = array();
	private $_typeDocument;
	private $_error;
	
	public function setKardex($value){
		$this->_kardex = $value;
	}
	public function getKardex(){
		return $this->_kardex;
	}

	public function  setFileName($value){
		$this->_fileName = $value;
	}

	public function  getFileName(){
		return $this->_fileName;
	}

	public function  setFileType($value){
		$this->_fileType = $value;
	}
	public function  getFileType(){
		return  $this->_fileType;
	}

	public function setFolderTemplate($value){
		$this->_folderTemplate = $value;
	}

	public function  setTemplateName($value){
		$this->_templateName = $value;
	}

	public function getPathTemplate(){
		return  $this->_pathTemplate;
	}
	public function getError(){
		return $this->_error;
	}

	public function  isCorrectFormat(){
        $value = false;
        switch ($this->getFileType()){
           case 'odt':
           case 'doc':
           case 'html':
              $value = true;
               break;
       }
       return $value;
    }

    public function setVars($arrVars){

    	if(!is_array($arrVars)){
    		die('La lista de variables no es un array');
    	}else{
    		$this->_arrVars = $arrVars;
    	}

    }
    public function setTypeDocument($value){
    	$this->_typeDocument = $value;
    }

    public function  setPathTemplate($value){
    	$this->_pathTemplate = $value;
    }

	public function __construct($pkTemplate,$codeActs){
		global $conn;
		$this->_totalScore = 25;
		$this->_objNumeroLetra = new ClaseNumeroLetra();
		$this->_objTbs = new clsTinyButStrong('{,}');
		$this->_objTbs->ResetVarRef(true);
		$this->_objTbs->MergeField('var');	



		$this->_codeActs = $codeActs;

		$this->_pkTemplate = $pkTemplate;


		$sql = "SELECT pkTemplate,nameTemplate,codeActs,contract,urlTemplate,fileName FROM tpl_template WHERE pkTemplate = '$this->_pkTemplate' ";

		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);

		if(!$row){
			$this->_error = 2;
		}
		$this->_templateId = $row['pkTemplate'];
		$this->_urlTemplate = $row['urlTemplate'];
		$this->_templateName = $row['fileName'];
		$typeFile =  explode('.', $this->_templateName);
        $first = array_shift($typeFile);
        $this->_fileType = '.'.$typeFile[0];	

	}

	public function setParams($arrParams){
		$this->_params = $arrParams;
	}

	public function  run(){

		$sql = "SELECT nombre AS nombres,apellido AS apellidos, CONCAT(nombre,' ',apellido) AS notario,ruc AS ruc_notario,distrito AS distrito_notario FROM confinotario";
		

		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);

		if($row){
			foreach ($row as $key => $value) {
				# code...
				switch ($key) {
		   				case 'ruc_notario':
		   					# code...
		   					$lettersRucNotario = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $lettersRucNotario;
		   					break;
		   				default:
		   					# code...
		   					break;
		   			}

		   			$key = mb_strtoupper(trim($key));
		   			$value = is_null($value)?'?':$value;
		   			$this->_objTbs->VarRef[$key] = mb_strtoupper($value);

			}
		}else{
			$columnCount =  mysql_num_fields($result);
			for ( $j = 0;$j < mysql_num_fields($result);$j++) {
    			$metaData = mysql_fetch_field($result, $j);
		      	$key = $metaData->name;
		      	$value = null;
		      	switch ($key) {
		   				case 'ruc_notario':
		   					# code...
		   					$value = 0;
		   					$lettersRucNotario = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $lettersRucNotario;
		   					break;
		   				default:
		   					# code...
		   					break;
		   			}
		   			$value = null;
		   			$key = mb_strtoupper(trim($key));
		   			$value = is_null($value)?'?':$value;
		   			$this->_objTbs->VarRef[$key] = mb_strtoupper($value);
			
			}

		}


		$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.idtipkar,tipokar.nomtipkar AS tipo_kardex,kardex.kardexconexo, kardex.fechaingreso
				 AS fecha_ingreso,YEAR(STR_TO_DATE(kardex.fechaingreso,'%d/%m/%Y')) AS 
				 anio_kardex,kardex.horaingreso,kardex.referencia,kardex.codactos,kardex.contrato, 
				 kardex.idusuario,usuarios.apepat AS usuario_apellido_parteno,usuarios.apemat 
				 AS usuario_apellido_materno, usuarios.prinom AS usuario_primer_nombre,usuarios.segnom 
				 AS usuario_segundo_nombre,kardex.responsable, kardex.observacion,kardex.documentos,kardex.fechacalificado,kardex.fechainstrumento 
				 AS fecha_instrumento, STR_TO_DATE(kardex.fechaconclusion,'%d/%m/%Y') 
				 AS fecha_conclusion,kardex.numinstrmento AS numero_instrumento, kardex.folioini 
				 AS folio_inicial,kardex.folioinivta,kardex.foliofin AS folio_final, kardex.papelTrasladoIni 
				 AS papel_traslado_inicial,kardex.papelTrasladoFin 
				 AS papel_traslado_final, kardex.foliofinvta,kardex.papelinivta,kardex.papelini 
				 AS papel_notarial_inicial,kardex.papelfin 
				 AS papel_notarial_final, 
				 kardex.papelfinvta,kardex.comunica1,kardex.contacto,kardex.telecontacto,kardex.mailcontacto,kardex.retenido,
				 kardex.desistido,kardex.autorizado, kardex.idrecogio,kardex.pagado,kardex.visita,kardex.dregistral 
				 AS derecho_registral,kardex.dnotarial AS derecho_notarial, kardex.idnotario, notarios.descon
				 AS notaria,notarios.direccion,kardex.numminuta AS numero_minuta,kardex.numescritura AS numero_escritura, kardex.fechaescritura 
				 AS fecha_escritura,kardex.insertos,kardex.direc_contacto,kardex.txa_minuta AS registro,kardex.fechaminuta AS fecha_minuta,kardex.nc,kardex.fecha_modificacion
				 FROM kardex INNER JOIN tipokar ON kardex.idtipkar = tipokar.idtipkar LEFT JOIN usuarios ON kardex.idusuario = usuarios.idusuario 
				 LEFT JOIN notarios ON kardex.idnotario = notarios.idnotario WHERE kardex.kardex = '$this->_kardex'";

		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);


		if($row){
		
			
			foreach ($row as $key => $value) {
				$$key  = $value;
				


				switch ($key) {
		   				case 'fecha_conclusion':
		   					# code...
		   					$lettersFechaConclusion = $this->_objNumeroLetra->fun_fech_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $lettersFechaConclusion;
		   					break;
		   				case 'fecha_escritura':
		   					# code...

		   					$arrValue = explode('-', $value);
		   					$formatValue  = $arrValue[2].'-'.$arrValue[1].'-'.$arrValue[0];
		   					$this->_objTbs->VarRef[$key] = $formatValue;

		   					$lettersFechaConclusion = $this->_objNumeroLetra->fun_fech_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $lettersFechaConclusion;
				 			$value = $formatValue;

		   					break;


		   				case 'folio_inicial':
		   					$valueBookMark = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;

				 			$valueBookMark = '';
				 			for($q = 0;$q<strlen($value);$q++){
				 				$valueBookMark = $valueBookMark. $this->_objNumeroLetra->fun_nume_letras($value[$q]).' ';
				 			}
				 			$bookmarkName = mb_strtoupper('LETRADIGITO'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;

		   					break;	


		   				case 'folio_final':
		   					$valueBookMark = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;

				 			$valueBookMark = '';
				 			for($q = 0;$q<strlen($value);$q++){
				 				$valueBookMark = $valueBookMark. $this->_objNumeroLetra->fun_nume_letras($value[$q]).' ';
				 			}
				 			$bookmarkName = mb_strtoupper('LETRADIGITO'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;


		   					break;


		   				case 'papel_notarial_inicial':
		   					$valueBookMark = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;


				 			$valueBookMark = '';
				 			for($q = 0;$q<strlen($value);$q++){
				 				$valueBookMark = $valueBookMark. $this->_objNumeroLetra->fun_nume_letras($value[$q]).' ';
				 			}
				 			$bookmarkName = mb_strtoupper('LETRADIGITO'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;
		   					break;	

		   				case 'papel_notarial_final':
		   					$valueBookMark = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;

				 			$valueBookMark = '';
				 			for($q = 0;$q<strlen($value);$q++){
				 				$valueBookMark = $valueBookMark. $this->_objNumeroLetra->fun_nume_letras($value[$q]).' ';
				 			}
				 			$bookmarkName = mb_strtoupper('LETRADIGITO'.'_'.$key);
				 			
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;
		   					break;		

		   				case 'numero_escritura':
		   					$valueBookMark = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);

				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;
		   					break;

		   				case 'numero_minuta':
		   					$valueBookMark = $this->_objNumeroLetra->fun_nume_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;
		   					break;	


		   				default:
		   					# code...
		   					break;
		   			}

		   			$key = mb_strtoupper(trim($key));
		   	
		   			$value = is_null($value)?'?':$value;

		   			$this->_objTbs->VarRef[$key] = mb_strtoupper($value);

			}

			$numero_minuta =  mb_strtoupper($numero_minuta);
			$bookmarkName = 'MINUTA';

			if($numero_minuta == 'S/M' ){
				$bookmarkValueEtiqueta = $numero_minuta;
				$valueBookMark = ', EXTENDIÉNDOSE ESTE INSTRUMENTO PUBLICO SIN MINUTA DE CONFORMIDAD A LOS INCISOS I) Y A) DE LOS ARTÍCULOS 54 Y 58 RESPECTIVAMENTE DEL DECRETO LEGISLATIVO N° 1049 Y ME EXPONE:';
			}else{
				$bookmarkValueEtiqueta = 'MINUTA:';
				$valueBookMark = 'Y DEMÁS PERTINENTES DE LA LEY DEL NOTARIADO, ME ENTREGAN PARA QUE ELEVE SU CONTENIDO A ESCRITURA PÚBLICA, UNA MINUTA FIRMADA, LA MISMA QUE ARCHIVO EN SU LEGAJO RESPECTIVO BAJO EL N° CORRESPONDIENTE Y CUYO TENOR LITERAL ES EL SIGUIENTE: ';
			}
			$this->_objTbs->VarRef[$bookmarkName] = utf8_decode($valueBookMark);

			$bookmarkName = 'ETIQUETA_MINUTA';
			$this->_objTbs->VarRef[$bookmarkName] = utf8_decode($bookmarkValueEtiqueta);

		}




	   	$sql = "SELECT idcondicion,idtipoacto,condicion,parte,uif,formulario,montop,totorgante FROM  actocondicion WHERE idtipoacto = '$this->_codeActs'";





	   	$result = mysql_query($sql);
		
		while ($row = mysql_fetch_assoc($result)) {
			# code...
			$pkTypeOfCondition = $row['idcondicion'];
			$nameTypeOfCondition = $row['condicion'];
			$charUif = 'UIF'.$row['uif'];
			$charOB = $row['uif'];
			
			$char1 = substr($nameTypeOfCondition, 0,1);
			$sql = "SELECT  contratantes.idcontratante,cliente.idcliente,cliente.tipper AS tipo_persona,cliente.apepat AS apellido_paterno,cliente.apemat AS apellido_materno,cliente.prinom AS primer_nombre,
					cliente.segnom AS segundo_nombre,IF(cliente.tipper = 'N', CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat), cliente.razonsocial)  AS contratante,
					cliente.direccion,cliente.idtipdoc ,tipodocumento.destipdoc AS tipo_documento,cliente.numdoc AS numero_documento,cliente.email,
					cliente.telfijo AS telefono,cliente.telcel AS celular,cliente.telofi,cliente.sexo,cliente.idestcivil AS id_estado_civil ,tipoestacivil.desestcivil AS estado_civil,
					cliente.natper AS persona_natural,cliente.conyuge, nacionalidades.descripcion AS nacionalidad,cliente.idprofesion,profesiones.desprofesion AS profesion,
					cliente.idcargoprofe,cargoprofe.descripcrapro AS cargo,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis AS distrito,
					ubigeo.nomprov AS provincia,ubigeo.nomdpto AS departamento,cliente.cumpclie AS fecha_nacimiento,cliente.fechaing,cliente.razonsocial AS empresa,
					cliente.domfiscal AS domicilio_fiscal,cliente.telempresa AS empresa_telefono,
					cliente.mailempresa AS empresa_email,cliente.contacempresa,cliente.fechaconstitu AS fecha_constitucion,
					cliente.idsedereg,sedesregistrales.dessede AS sede_registral,cliente.numregistro AS numero_registro,cliente.numpartida AS numero_partida1,
					cliente.actmunicipal,ciiu.nombre AS ciiu,cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad,
					cliente.impremite,cliente.impmotivo,cliente.residente,cliente.docpaisemi,
					actocondicion.condicion,actocondicion.uif,contratantes.firma ,contratantes.fechafirma AS fecha_firma,contratantes.resfirma,
					contratantes.tiporepresentacion,contratantes.idcontratanterp,contratantes.numpartida AS numero_partida,contratantes.facultades,contratantes.indice,
					contratantes.visita,contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion,
					actocondicion.condicion,
					contratantesxacto.parte,contratantesxacto.porcentaje,
					contratantesxacto.formulario,contratantesxacto.monto,contratantesxacto.opago,
					contratantesxacto.ofondo,contratantesxacto.montop,contratantes.idcontratanterp FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc 
					 LEFT JOIN  nacionalidades ON cliente.nacionalidad = nacionalidades.idnacionalidad
					 LEFT JOIN tipoestacivil ON cliente.idestcivil =  tipoestacivil.idestcivil 
					 LEFT JOIN  profesiones ON cliente.idprofesion =  profesiones.idprofesion
					 LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe
					 LEFT JOIN  ubigeo ON ubigeo.coddis = cliente.idubigeo
					 LEFT JOIN ciiu ON ciiu.coddivi = cliente.actmunicipal
					 LEFT JOIN cliente2 ON cliente.idcliente = cliente2.idcliente
					 LEFT JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante
					 LEFT JOIN  sedesregistrales ON contratantes.idsedereg = sedesregistrales.idsedereg
					 LEFT JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante
					 LEFT JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion
					 WHERE    contratantes.kardex = '$this->_kardex' AND contratantesxacto.idcondicion = '$pkTypeOfCondition' GROUP BY cliente.idcliente ORDER BY cliente.apepat";

	// die($sql);				
			$resultPartaker = mysql_query($sql);
			$affectedRows = mysql_affected_rows();

			$bookmarkName = 'CANT_'.$nameTypeOfCondition;
			$this->_objTbs->VarRef[$bookmarkName] = $affectedRows;


			
			$valueBookMar = $affectedRows > 1?'LOS':'EL';
			$bookmarkName = 'LOS_EL';
			$bookmarkName = $char1.'_'.$bookmarkName;
			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMar;

			$valueBookMar = $affectedRows > 1?'ES':'';
			$bookmarkName = 'S';
			$bookmarkName = $char1.'_'.$bookmarkName;
			$this->_objTbs->VarRef[$bookmarkName] = $valueBookMar;

			$arrCountBookmarkContractor = ($this->_totalScore - $affectedRows);
			$i = 1;

			$bookmarkNameList = $char1;
			$arrData = array();
			$arrPersonSignature = array();
			while ($record = mysql_fetch_assoc($resultPartaker)) {
					$record['contratante'] = utf8_decode($record['contratante']);
					$record['letra_numero_documento'] = $this->_objNumeroLetra->fun_nume_letras($record['numero_documento']);;

				 	$data =  $record;
				 	$dataPersonSignature = $record;
					$idContratante = $record['idcontratante'];
					$idConyuge = $record['conyuge'];



					$sql = "SELECT  contratantes.idcontratante,cliente.idcliente,cliente.tipper AS tipo_persona,cliente.apepat AS apellido_paterno,cliente.apemat AS apellido_materno,cliente.prinom AS primer_nombre,
					cliente.segnom AS segundo_nombre,IF(cliente.tipper = 'N', CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat), cliente.razonsocial)  AS contratante,
					cliente.direccion,cliente.idtipdoc ,tipodocumento.destipdoc AS tipo_documento,cliente.numdoc AS numero_documento,cliente.email,
					cliente.telfijo AS telefono,cliente.telcel AS celular,cliente.telofi,cliente.sexo,cliente.idestcivil AS id_estado_civil ,(CASE WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil = 1   THEN 'SOLTERA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil = 2  THEN 'CASADA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil  = 3 THEN 'VIUDA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil  = 4 THEN 'DIVORCIADA'
					ELSE tipoestacivil.desestcivil END
					) AS estado_civil,
					cliente.natper AS persona_natural,cliente.conyuge, (CASE WHEN  SUBSTRING(nacionalidades.descripcion,LENGTH(nacionalidades.descripcion),1) = 'A' AND cliente.sexo  = 'M' THEN 
						CONCAT(SUBSTRING(nacionalidades.descripcion,1,(LENGTH(nacionalidades.descripcion)-1)),'O') 
						WHEN  SUBSTRING(nacionalidades.descripcion,LENGTH(nacionalidades.descripcion),1) = 'O' AND cliente.sexo  = 'F' THEN 
						CONCAT(SUBSTRING(nacionalidades.descripcion,1,(LENGTH(nacionalidades.descripcion)-1)),'A')
						
					 ELSE  nacionalidades.descripcion END ) AS nacionalidad,cliente.idprofesion,profesiones.desprofesion AS profesion,
					cliente.idcargoprofe,cargoprofe.descripcrapro AS cargo,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis AS distrito,
					ubigeo.nomprov AS provincia,ubigeo.nomdpto AS departamento,cliente.cumpclie AS fecha_nacimiento,cliente.fechaing,cliente.razonsocial AS empresa,
					cliente.domfiscal AS domicilio_fiscal,cliente.telempresa AS empresa_telefono,
					cliente.mailempresa AS empresa_email,cliente.contacempresa,cliente.fechaconstitu AS fecha_constitucion,
					cliente.idsedereg,sedesregistrales.dessede AS sede_registral,cliente.numregistro AS numero_registro,cliente.numpartida AS numero_partida1,
					cliente.actmunicipal,ciiu.nombre AS ciiu,cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad,
					cliente.impremite,cliente.impmotivo,cliente.residente,cliente.docpaisemi,
					actocondicion.condicion,actocondicion.uif,contratantes.firma ,contratantes.fechafirma AS fecha_firma,contratantes.resfirma,
					contratantes.tiporepresentacion,contratantes.idcontratanterp,contratantes.numpartida AS numero_partida,contratantes.facultades,contratantes.indice,
					contratantes.visita,contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion,
					actocondicion.condicion,
					contratantesxacto.parte,contratantesxacto.porcentaje,
					contratantesxacto.formulario,contratantesxacto.monto,contratantesxacto.opago,
					
					
					contratantesxacto.ofondo,contratantesxacto.montop,contratantes.idcontratanterp FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc 
					 LEFT JOIN  nacionalidades ON cliente.nacionalidad = nacionalidades.idnacionalidad
					 LEFT JOIN tipoestacivil ON cliente.idestcivil =  tipoestacivil.idestcivil 
					 LEFT JOIN  profesiones ON cliente.idprofesion =  profesiones.idprofesion
					 LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe
					 LEFT JOIN  ubigeo ON ubigeo.coddis = cliente.idubigeo
					 LEFT JOIN ciiu ON ciiu.coddivi = cliente.actmunicipal
					 LEFT JOIN cliente2 ON cliente.idcliente = cliente2.idcliente
					 LEFT JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante
					 LEFT JOIN  sedesregistrales ON contratantes.idsedereg = sedesregistrales.idsedereg
					 LEFT JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante
					 LEFT JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion
					 WHERE    contratantes.kardex = '$this->_kardex'  AND contratantes.idcontratanterp = '$idContratante'
					 GROUP BY cliente.idcliente ORDER BY cliente.apepat";


					 $resultRepresentative  = mysql_query($sql);
					 $arrRepresentative = array();

					$iR = 1;  
					$affectedRowsR = mysql_affected_rows();
				 	while($rowRepresentative =  mysql_fetch_assoc($resultRepresentative)){
					 	 $rowRepresentative['contratante'] = utf8_decode($rowRepresentative['contratante']);	
					 	/* $arrRepresentative = $rowRepresentative;	*/
					 	 

					 	
					 	 if($iR == ($affectedRowsR-1)){
					 	 	$rowRepresentative['y'] = 'Y';
					 	 }else if($iR<($affectedRowsR-1)){
					 	 	$rowRepresentative['y'] = ',';
					 	 }else{
					 	 	$rowRepresentative['y'] = '';
					 	 }
					 	 $iR++;
					 	 $arrRepresentative[] = $rowRepresentative;

				 	}

				 	$sql = "SELECT  contratantes.idcontratante,cliente.idcliente,cliente.tipper AS tipo_persona,cliente.apepat AS apellido_paterno,cliente.apemat AS apellido_materno,cliente.prinom AS primer_nombre,
					cliente.segnom AS segundo_nombre,IF(cliente.tipper = 'N', CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat), cliente.razonsocial)  AS contratante,
					cliente.direccion,cliente.idtipdoc ,tipodocumento.destipdoc AS tipo_documento,cliente.numdoc AS numero_documento,cliente.email,
					cliente.telfijo AS telefono,cliente.telcel AS celular,cliente.telofi,cliente.sexo,cliente.idestcivil AS id_estado_civil ,(CASE WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil = 1   THEN 'SOLTERA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil = 2  THEN 'CASADA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil  = 3 THEN 'VIUDA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil  = 4 THEN 'DIVORCIADA'
					ELSE tipoestacivil.desestcivil END
					) AS estado_civil,
					cliente.natper AS persona_natural,cliente.conyuge, (CASE WHEN  SUBSTRING(nacionalidades.descripcion,LENGTH(nacionalidades.descripcion),1) = 'A' AND cliente.sexo  = 'M' THEN 
						CONCAT(SUBSTRING(nacionalidades.descripcion,1,(LENGTH(nacionalidades.descripcion)-1)),'O') 
						WHEN  SUBSTRING(nacionalidades.descripcion,LENGTH(nacionalidades.descripcion),1) = 'O' AND cliente.sexo  = 'F' THEN 
						CONCAT(SUBSTRING(nacionalidades.descripcion,1,(LENGTH(nacionalidades.descripcion)-1)),'A')
						
					 ELSE  nacionalidades.descripcion END ) AS nacionalidad,cliente.idprofesion,profesiones.desprofesion AS profesion,
					cliente.idcargoprofe,cargoprofe.descripcrapro AS cargo,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis AS distrito,
					ubigeo.nomprov AS provincia,ubigeo.nomdpto AS departamento,cliente.cumpclie AS fecha_nacimiento,cliente.fechaing,cliente.razonsocial AS empresa,
					cliente.domfiscal AS domicilio_fiscal,cliente.telempresa AS empresa_telefono,
					cliente.mailempresa AS empresa_email,cliente.contacempresa,cliente.fechaconstitu AS fecha_constitucion,
					cliente.idsedereg,sedesregistrales.dessede AS sede_registral,cliente.numregistro AS numero_registro,cliente.numpartida AS numero_partida1,
					cliente.actmunicipal,ciiu.nombre AS ciiu,cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad,
					cliente.impremite,cliente.impmotivo,cliente.residente,cliente.docpaisemi,
					actocondicion.condicion,actocondicion.uif,contratantes.firma ,contratantes.fechafirma AS fecha_firma,contratantes.resfirma,
					contratantes.tiporepresentacion,contratantes.idcontratanterp,contratantes.numpartida AS numero_partida,contratantes.facultades,contratantes.indice,
					contratantes.visita,contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion,
					actocondicion.condicion,
					contratantesxacto.parte,contratantesxacto.porcentaje,
					contratantesxacto.formulario,contratantesxacto.monto,contratantesxacto.opago,
					
					
					contratantesxacto.ofondo,contratantesxacto.montop,contratantes.idcontratanterp FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc 
					 LEFT JOIN  nacionalidades ON cliente.nacionalidad = nacionalidades.idnacionalidad
					 LEFT JOIN tipoestacivil ON cliente.idestcivil =  tipoestacivil.idestcivil 
					 LEFT JOIN  profesiones ON cliente.idprofesion =  profesiones.idprofesion
					 LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe
					 LEFT JOIN  ubigeo ON ubigeo.coddis = cliente.idubigeo
					 LEFT JOIN ciiu ON ciiu.coddivi = cliente.actmunicipal
					 LEFT JOIN cliente2 ON cliente.idcliente = cliente2.idcliente
					 LEFT JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante
					 LEFT JOIN  sedesregistrales ON contratantes.idsedereg = sedesregistrales.idsedereg
					 LEFT JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante
					 LEFT JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion
					 WHERE     cliente2.idcliente = '$idConyuge'
					 GROUP BY cliente.idcliente ORDER BY cliente.apepat"; 

					 $resultConyuge = mysql_query($sql);

					 if(mysql_affected_rows() != 0){
					 	$data['conyuge_con'] = 'CON';
					 	$rowConyuge = mysql_fetch_assoc($resultConyuge);
					 	$data['mi_conyuge'] = $rowConyuge;
					 }else{
					 	$data['conyuge_con'] = '';
					 	$rowConyuge = array();
						$columnCount = mysql_num_fields($resultConyuge);
						for ($jc = 0; $jc<$columnCount; $jc++) { 
							$metaData = mysql_fetch_field($resultConyuge, $jc);
							$rowConyuge[$metaData->name] = '';
						}
						$data['mi_conyuge'] = $rowConyuge;
						
					 }
					 

				 	$valueBookMar = str_repeat('_',30);
					$bookmarkName = 'FIRMA';
					$bookmarkName = $char1.$bookmarkName.$i;
					$this->_objTbs->VarRef[$bookmarkName] = $valueBookMar;

				 	foreach ($data as $key => $value) {
				 		# code...
				 		$$key  = $value;

				 		switch ($key) {

				 			case 'contratante':

				 				$bookmarkName = mb_strtoupper($char1.'_'.$key.'_FIRMO_'.$i);
				 				$this->_objTbs->VarRef[$bookmarkName] = utf8_decode($value.' FIRMÓ EN ');


				 				break;	
				 			case 'numero_documento':
				 				# code...

				 				$lettersNumdoc = $this->_objNumeroLetra->fun_nume_letras($value);
				 				$bookmarkName =  mb_strtoupper($char1.'_'.'LETRA'.'_'.$key.'_'.$i);
				 				$this->_objTbs->VarRef[$bookmarkName] = $lettersNumdoc;
				 				$value = $value;

				 				break;
				 			case 'fecha_firma':

				 				$arrDateOfSignature = explode('/', $value);
				 				$dateOfSignature = $arrDateOfSignature[2].'-'.$arrDateOfSignature[1].'-'.$arrDateOfSignature[0];

				 				$lettersFechaFirma = $this->_objNumeroLetra->fun_fech_letras($dateOfSignature);
				 				$bookmarkName =  mb_strtoupper($char1.'_'.'LETRA'.'_'.$key.'_'.$i);
				 				$this->_objTbs->VarRef[$bookmarkName] = $lettersFechaFirma;
				 				break;

				 	
				 			case 'sexo':				 				
				 				$bookmarkName = $char1.'_IDENTIFICADO_'.$i;
				 				$sex = $value == 'F'?'A':'O';
				 				$valueIdentified = 'IDENTIFICAD'.$sex.' CON ';
				 				$this->_objTbs->VarRef[$bookmarkName] = $valueIdentified;
				 				break;

				 			case 'profesion':
				 				$value = ','.$value;
				 				break;
				 			default:
				 				# code...
				 				break;
				 		}


				 		$conditionName = mb_strtoupper(trim($nameTypeOfCondition).'_'.$key.'_'.$i);
				 		$bookmarkName = mb_strtoupper($char1.'_'.$key.'_'.$i);
				 		$bookmarkNameUif = mb_strtoupper($charUif.'_'.$key.'_'.$i);

				 		$value = is_null($value)?'?':$value;
				 		//if($char1 == 'A' && $bookmarkName=='A_NUMERO_DOCUMENTO_1')
				 				//die($value.'a');

				 		$this->_objTbs->VarRef[$conditionName] =  utf8_decode($value);
				 		$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($value);
				 		$this->_objTbs->VarRef[$bookmarkNameUif] =  utf8_decode($value);
				 		/** MARCADORES ADICIONALES**/
				 		$bookmarkName = 'MAYOREDAD';
				 		//$conditionName = mb_strtoupper(trim($nameTypeOfCondition).'_'.$key.'_'.$i);
				 		$bookmarkName = mb_strtoupper($char1.'_'.$bookmarkName.'_'.$i);
				 		$this->_objTbs->VarRef[$bookmarkName] =  ',MAYOR DE EDAD,';


				 	}



				 	$bookmarkName = $char1.'_DOMICILIO_'.$i;
				 	//if($bookmarkName == 'C_DOMICILIO_1')
				 	//echo $bookmarkName;
				 	$valueBookMark = ',CON DOMICILIO EN LA '.$direccion.', DEL DISTRITO DE '.$distrito.' PROVINCIA Y DEPARTAMENTO DE '.$departamento;
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);

				 	$bookmarkName = $char1.'_NACIONALIDAD_TIPODOCUMENTO_'.$i;
				 	
				 	$nacionalidad =  substr($nacionalidad, 0, -1);

				 	$nacionalidad = $nacionalidad.$sex;
					
					$valueBookMark = $nacionalidad.' CON '.$tipo_documento.' Nº ';
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);


				 	 if($id_estado_civil != 5){
				 	 	$estado_civil =  substr($estado_civil, 0, -1);
				 	 	$estado_civil = $estado_civil.$sex;
				 	 }


				 	 


				 	$bookmarkName = $char1.'_MANIFIESTOSER_'.$i;
				 	$valueBookMark = ' MANIFESTÒ SER '.$estado_civil;
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);

				 	
				 	
				 	$don = $sexo == 'F'?'DOÑA:':'DON:';
				 	$bookmarkName = $char1.'_'.'DON_'.$i;
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($don);

				 	$bookmarkName = $nameTypeOfCondition.'_DON_'.$i;
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($don);

				 	$bookmarkName = $charUif.'_DON_'.$i;
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($don);

				 	$valueBookMark = $sexo == 'F'?'LA':'EL';

				 	$bookmarkName = $nameTypeOfCondition.'_LA_EL_'.$i;
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);



				 	$bookmarkName = $char1.'_LA_EL_'.$i;
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);




				 	$bookmarkName = $char1.'_CONTRATANTE_DATOS_'.$i;
				 	/*$valueBookMark =  '='.$don.' '.$contratante.', MAYOR DE EDAD,'.$nacionalidad.' CON '.$tipo_documento.' Nº '.$numero_documento.
				 					  ' QUIEN MANIFESTÒ SER '.$estado_civil.', CON DOMICILIO EN LA '.$direccion.',DEL DISTRITO '.$distrito.
				 					  ' PRONVINCIA Y DEPARTAMENTO DE '.$departamento;*/
					
				 				  
				 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);



				 	/*$arrData[] = array('don'=>$don,'contratante'=>utf8_decode($contratante),'datos'=>utf8_decode('MAYOR DE EDAD,'.$nacionalidad.' CON '.$tipo_documento.' Nº '.$numero_documento. ' QUIEN MANIFESTÓ SER '.$estado_civil.', CON DOMICILIO EN LA '.$direccion.',DEL DISTRITO '.$distrito.
				 					  ' PRONVINCIA Y DEPARTAMENTO DE '.$departamento),
				 		'procede'=>utf8_decode(',QUIEN PROCEDE POR SU PROPIO DERECHO'),'condicion'=>utf8_decode($condicion));*/
	
					$arrData[]  = $data;

				 	if($i == 1){
		 				$valueContractingSimple =  $contratante;
		 			}else if($affectedRows == 2){
		 				$valueContractingSimple = $valueContractingSimple . ' Y '.$contratante;

		 			}
				 	
				 	$i++;
				 	if($i ==  $affectedRows){
				 		$bookmarkName = $char1.'_Y_COMA_'.$i;
				 		$valueBookMark = ' Y ';
				 		$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);
				 		$bookmarkName = $charUif.'_Y_COMA_'.$i;
				 		$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);
				 	}else{
				 		$bookmarkName = $char1.'_Y_COMA_'.$i;
				 		$valueBookMark = ',';
				 		$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);
				 		$bookmarkName = $charUif.'_Y_COMA_'.$i;
				 		$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);
				 	}

			}



			if($affectedRows > 2){
		 		$valueContractingSimple = $valueContractingSimple . ' Y '.' OTROS ';
		 	}

			$bookmarkName = mb_strtoupper($charOB.'_CONTRATANTES');
			$this->_objTbs->VarRef[$bookmarkName] =  ($valueContractingSimple);

			$bookmarkName = mb_strtoupper($nameTypeOfCondition.'_CONTRATANTES');
			$this->_objTbs->VarRef[$bookmarkName] =  ($valueContractingSimple);




			$charRuif = 'r'.$charOB;
			$listMergeBlock[] = array($char1=>$arrData);
			$listMergeBlockUif[] = array($charOB=>$arrData);	
			$listRepresentative[] = array($charRuif=>$arrRepresentative);

			

			//$this->_objTbs->MergeBlock($bookmarkNameList,$arrData);


			#MARCADORES RESTANTES
			$columnCount = mysql_num_fields($resultPartaker);
			//die($i.'s');
			for($x = $i; $x<=$this->_totalScore;$x++){


				for ($j = 0; $j<$columnCount; $j++) { 

					$metaData = mysql_fetch_field($resultPartaker, $j);
					$columName = $metaData->name;

					$value = '';

					switch ($columName) {

							case 'contratante':
								
				 				$bookmarkName = mb_strtoupper($char1.'_'.$columName.'_FIRMO_'.$x);
				 				$this->_objTbs->VarRef[$bookmarkName] = $value;
				 				break;

				 			case 'numero_documento':
				 				# code...
				 				$bookmarkName =  mb_strtoupper($char1.'_'.'LETRA'.'_'.$columName.'_'.$x);
				 				$this->_objTbs->VarRef[$bookmarkName] = $value;

				 				break;

				 			case 'fecha_firma':

				 				$bookmarkName =  mb_strtoupper($char1.'_'.'LETRA'.'_'.$columName.'_'.$x);
				 				$this->_objTbs->VarRef[$bookmarkName] = $value;
				 				break;
				 			case 'sexo':				 				
				 				$bookmarkName = $char1.'_IDENTIFICADO_'.$x;
				 				$this->_objTbs->VarRef[$bookmarkName] = $value;
				 				break;

				 		
				 			default:
				 				# code...
				 				break;
				 	}

					$valueBookMar = $value;
					$bookmarkName = 'FIRMA';
					$conditionName = mb_strtoupper(trim($nameTypeOfCondition).'_'.$columName.'_'.$x);


					

					$bookmarkName = $char1.'_Y_COMA_'.$x;
					$this->_objTbs->VarRef[$conditionName] =  utf8_decode($value);

					$bookmarkNameUif = mb_strtoupper($charUif.'_'.$key.'_'.$x);

					$this->_objTbs->VarRef[$bookmarkNameUif] =  $value;

					$bookmarkName = $charUif.'_Y_COMA_'.$x;

					$this->_objTbs->VarRef[$bookmarkName] =  $value;


					$bookmarkName = $char1.$bookmarkName.$x;
					$this->_objTbs->VarRef[$bookmarkName] = $valueBookMar;
					$key = mb_strtoupper($char1.'_'.$columName.'_'.$x);
					$this->_objTbs->VarRef[$key] = $value;

					/* MARACADORES ADICIONALES*/
					$bookmarkName = 'MAYOREDAD';
				 		//$conditionName = mb_strtoupper(trim($nameTypeOfCondition).'_'.$key.'_'.$i);
			 		$bookmarkName = mb_strtoupper($char1.'_'.$bookmarkName.'_'.$x);
			 		$this->_objTbs->VarRef[$bookmarkName] =  '';

				}

				$bookmarkName = $char1.'_DOMICILIO_'.$x;
				

			 	$this->_objTbs->VarRef[$bookmarkName] =  $value;
			 	$bookmarkName = $char1.'_NACIONALIDAD_TIPODOCUMENTO_'.$x;
			 	$this->_objTbs->VarRef[$bookmarkName] =  $value;
			 	$bookmarkName = $char1.'_MANIFIESTOSER_'.$x;
			 	$this->_objTbs->VarRef[$bookmarkName] =  $value;

		 		$bookmarkName = $char1.'_Y_COMA_'.$x;
		 		$valueBookMark = '';
		 		$this->_objTbs->VarRef[$bookmarkName] =  $valueBookMark;

		 		$bookmarkName = $nameTypeOfCondition.'_Y_COMA_'.$x;
		 		$valueBookMark = '';
		 		$this->_objTbs->VarRef[$bookmarkName] =  $valueBookMark;

		 		$bookmarkName = $char1.'_CONTRATANTE_DATOS_'.$x;
			 	$valueBookMark =  '';
			 	$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($valueBookMark);

			 	$bookmarkName = $char1.'_DON_'.$x;
				$this->_objTbs->VarRef[$bookmarkName] =  $value;


			 	$bookmarkName = $charUif.'_DON_'.$x;
				$this->_objTbs->VarRef[$bookmarkName] =  $value;
				
			}	
			
		}
		#PARTICIPANTES DE QUE FIRMAN

		$arrUif = array('fo'=>'O','fb'=>'B');

		$arrOb = array();
		foreach ($arrUif as $key => $value) {
			# code...

			$sql = "SELECT contratantes.idcontratante,cliente.idcliente,cliente.tipper AS tipo_persona,cliente.apepat AS
				 apellido_paterno,cliente.apemat AS apellido_materno,cliente.prinom AS primer_nombre, 
				 cliente.segnom AS segundo_nombre,IF(cliente.tipper = 'N', CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat), 
				 cliente.razonsocial) AS contratante, cliente.direccion,cliente.idtipdoc ,tipodocumento.destipdoc AS tipo_documento,
				 cliente.numdoc AS numero_documento,cliente.email, cliente.telfijo AS telefono,cliente.telcel AS celular,cliente.telofi,
				 cliente.sexo,cliente.idestcivil AS id_estado_civil ,tipoestacivil.desestcivil AS estado_civil, cliente.natper AS persona_natural,
				 cliente.conyuge, nacionalidades.descripcion AS nacionalidad,cliente.idprofesion,profesiones.desprofesion AS profesion, cliente.idcargoprofe,
				 cargoprofe.descripcrapro AS cargo,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis AS distrito, ubigeo.nomprov AS provincia,
				 ubigeo.nomdpto AS departamento,cliente.cumpclie AS fecha_nacimiento,cliente.fechaing,cliente.razonsocial AS empresa,
				  cliente.domfiscal AS domicilio_fiscal,cliente.telempresa AS empresa_telefono, cliente.mailempresa AS empresa_email,
				  cliente.contacempresa,cliente.fechaconstitu AS fecha_constitucion, cliente.idsedereg,sedesregistrales.dessede AS sede_registral,
				  cliente.numregistro AS numero_registro,cliente.numpartida AS numero_partida, cliente.actmunicipal,ciiu.nombre AS ciiu,
				  cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad, cliente.impremite,cliente.impmotivo,
				  cliente.residente,cliente.docpaisemi, actocondicion.condicion,actocondicion.uif,contratantes.firma ,
				  contratantes.fechafirma AS fecha_firma,contratantes.resfirma, contratantes.tiporepresentacion,contratantes.idcontratanterp,contratantes.numpartida AS numero_partida1,contratantes.facultades,contratantes.indice,
				  contratantes.visita,contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion, actocondicion.condicion,
				  contratantesxacto.parte,contratantesxacto.porcentaje, contratantesxacto.formulario,contratantesxacto.monto,contratantesxacto.opago, 
				  contratantesxacto.ofondo,contratantesxacto.montop,contratantes.idcontratanterp 
				  FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc
				     LEFT JOIN nacionalidades ON cliente.nacionalidad = nacionalidades.idnacionalidad 
				     LEFT JOIN tipoestacivil ON cliente.idestcivil = tipoestacivil.idestcivil 
				     LEFT JOIN profesiones ON cliente.idprofesion = profesiones.idprofesion 
				     LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe 
				     LEFT JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo 
				     LEFT JOIN ciiu ON ciiu.coddivi = cliente.actmunicipal 
				     LEFT JOIN cliente2 ON cliente.idcliente = cliente2.idcliente 
				     LEFT JOIN contratantes ON cliente2.idcontratante = contratantes.idcontratante 
				     LEFT JOIN  sedesregistrales ON contratantes.idsedereg = sedesregistrales.idsedereg
				     LEFT JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante 
				     LEFT JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion 
				     WHERE contratantes.kardex = '$this->_kardex' AND actocondicion.uif = '$value' GROUP BY cliente.idcliente ORDER BY cliente.apepat";
			//	     die($sql);
					 
			$resultRepresentante = mysql_query($sql);
			$affectedRows = mysql_affected_rows();		 
			$arrPersonSignature = array();
			while($row = mysql_fetch_assoc($resultRepresentante)){

				$row['contratante'] = utf8_decode($row['contratante']);
				$idContratante = $row['idcontratante'];
				$idConyuge = $row['conyuge'];
				$dataPersonSignature = $row;

				$sql = "SELECT cliente.idcliente,cliente.tipper AS tipo_persona,cliente.apepat AS apellido_paterno,cliente.apemat AS 
						apellido_materno,cliente.prinom AS primer_nombre, cliente.segnom 
						AS segundo_nombre,CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat) AS contratante,
						cliente.direccion,cliente.idtipdoc ,tipodocumento.destipdoc AS tipo_documento,cliente.numdoc 
						AS numero_documento,cliente.email, cliente.telfijo AS telefono,cliente.telcel 
						AS celular,cliente.telofi,cliente.sexo,cliente.idestcivil 
						AS id_estado_civil ,tipoestacivil.desestcivil AS estado_civil, cliente.natper 
						AS persona_natural,cliente.conyuge, nacionalidades.descripcion 
						AS nacionalidad,cliente.idprofesion,profesiones.desprofesion 
						AS profesion, cliente.idcargoprofe,cargoprofe.descripcrapro 
						AS cargo,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis 
						AS distrito, ubigeo.nomprov AS provincia,ubigeo.nomdpto 
						AS departamento,cliente.cumpclie AS fecha_nacimiento,cliente.fechaing,cliente.razonsocial 
						AS empresa, cliente.domfiscal AS domicilio_fiscal,cliente.telempresa 
						AS empresa_telefono, cliente.mailempresa AS empresa_email,cliente.contacempresa,cliente.fechaconstitu
						 AS fecha_constitucion, cliente.idsedereg,sedesregistrales.dessede AS sede_registral,cliente.numregistro 
						 AS numero_registro,cliente.numpartida AS numero_partida1, cliente.actmunicipal,ciiu.nombre 
						 AS ciiu,cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad, 
						 cliente.impremite,cliente.impmotivo,cliente.residente,cliente.docpaisemi, 
						 contratantes.condicion,contratantes.firma ,contratantes.fechafirma 
						 AS fecha_firma,contratantes.resfirma, contratantes.tiporepresentacion,contratantes.numpartida
						  AS numero_partida,contratantes.facultades,contratantes.indice, contratantes.visita,
						  contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion, actocondicion.condicion,
						   contratantesxacto.parte,contratantesxacto.porcentaje,contratantesxacto.uif, contratantesxacto.formulario,
						   contratantesxacto.monto,contratantesxacto.opago, contratantesxacto.ofondo,contratantesxacto.montop
						   FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc 
						   LEFT JOIN nacionalidades ON cliente.nacionalidad = nacionalidades.idnacionalidad 
						   LEFT JOIN tipoestacivil ON cliente.idestcivil = tipoestacivil.idestcivil 
						   LEFT JOIN profesiones ON cliente.idprofesion = profesiones.idprofesion 
						   LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe 
						   LEFT JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo 
						   LEFT JOIN ciiu ON ciiu.coddivi = cliente.actmunicipal 
						   LEFT JOIN cliente2 ON cliente.idcliente = cliente2.idcliente 
						   LEFT JOIN contratantes ON cliente2.idcontratante = contratantes.idcontratante 
						   LEFT JOIN  sedesregistrales ON contratantes.idsedereg = sedesregistrales.idsedereg
						   LEFT JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante
						    LEFT JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion WHERE contratantes.kardex = '$this->_kardex' 
						AND contratantes.idcontratanterp = '$idContratante'   GROUP BY cliente.idcliente ORDER BY cliente.apepat";

					//	die($sql);
				$resultPs = mysql_query($sql);
				$arrRepresentative1 = array();

				if(mysql_affected_rows() != 0){
					while($row1 = mysql_fetch_assoc($resultPs)){
						$row1['contratante'] = utf8_decode($row1['contratante']);
						$arrRepresentative1 = $row1;
						/*
						if(mysql_affected_rows() == 1){
							$row1['contratante'] = utf8_decode($row1['contratante']);
							$arrRepresentative1 = $row1;
						}else{
							$row1 = array();
							$columnCount = mysql_num_fields($resultPs);

							for ($jc = 0; $jc<$columnCount; $jc++) { 
								$metaData = mysql_fetch_field($resultPs, $jc);
								$row1[$metaData->name] = '';
							}
							$arrRepresentative1 = $row1;


						}*/
						$dataPersonSignature['representante'] = $arrRepresentative1;
						$arrPersonSignature[] = $dataPersonSignature;
					}

				}else{
					$row1 = array();
					$columnCount = mysql_num_fields($resultPs);

					for ($jc = 0; $jc<$columnCount; $jc++) { 
						$metaData = mysql_fetch_field($resultPs, $jc);
						$row1[$metaData->name] = '';
					}
					$arrRepresentative1 = $row1;
					$dataPersonSignature['representante'] = $arrRepresentative1;
					$arrPersonSignature[] = $dataPersonSignature;	
				}
						
						
		}

		$sql = "SELECT  contratantes.idcontratante,cliente.idcliente,cliente.tipper AS tipo_persona,cliente.apepat AS apellido_paterno,cliente.apemat AS apellido_materno,cliente.prinom AS primer_nombre,
					cliente.segnom AS segundo_nombre,IF(cliente.tipper = 'N', CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat), cliente.razonsocial)  AS contratante,
					cliente.direccion,cliente.idtipdoc ,tipodocumento.destipdoc AS tipo_documento,cliente.numdoc AS numero_documento,cliente.email,
					cliente.telfijo AS telefono,cliente.telcel AS celular,cliente.telofi,cliente.sexo,cliente.idestcivil AS id_estado_civil ,(CASE WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil = 1   THEN 'SOLTERA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil = 2  THEN 'CASADA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil  = 3 THEN 'VIUDA'
					      WHEN cliente.sexo = 'F' AND tipoestacivil.idestcivil  = 4 THEN 'DIVORCIADA'
					ELSE tipoestacivil.desestcivil END
					) AS estado_civil,
					cliente.natper AS persona_natural,cliente.conyuge, (CASE WHEN  SUBSTRING(nacionalidades.descripcion,LENGTH(nacionalidades.descripcion),1) = 'A' AND cliente.sexo  = 'M' THEN 
						CONCAT(SUBSTRING(nacionalidades.descripcion,1,(LENGTH(nacionalidades.descripcion)-1)),'O') 
						WHEN  SUBSTRING(nacionalidades.descripcion,LENGTH(nacionalidades.descripcion),1) = 'O' AND cliente.sexo  = 'F' THEN 
						CONCAT(SUBSTRING(nacionalidades.descripcion,1,(LENGTH(nacionalidades.descripcion)-1)),'A')
						
					 ELSE  nacionalidades.descripcion END ) AS nacionalidad,cliente.idprofesion,profesiones.desprofesion AS profesion,
					cliente.idcargoprofe,cargoprofe.descripcrapro AS cargo,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis AS distrito,
					ubigeo.nomprov AS provincia,ubigeo.nomdpto AS departamento,cliente.cumpclie AS fecha_nacimiento,cliente.fechaing,cliente.razonsocial AS empresa,
					cliente.domfiscal AS domicilio_fiscal,cliente.telempresa AS empresa_telefono,
					cliente.mailempresa AS empresa_email,cliente.contacempresa,cliente.fechaconstitu AS fecha_constitucion,
					cliente.idsedereg,sedesregistrales.dessede AS sede_registral,cliente.numregistro AS numero_registro,cliente.numpartida AS numero_partida1,
					cliente.actmunicipal,ciiu.nombre AS ciiu,cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad,
					cliente.impremite,cliente.impmotivo,cliente.residente,cliente.docpaisemi,
					actocondicion.condicion,actocondicion.uif,contratantes.firma ,contratantes.fechafirma AS fecha_firma,contratantes.resfirma,
					contratantes.tiporepresentacion,contratantes.idcontratanterp,contratantes.numpartida AS numero_partida,contratantes.facultades,contratantes.indice,
					contratantes.visita,contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion,
					actocondicion.condicion,
					contratantesxacto.parte,contratantesxacto.porcentaje,
					contratantesxacto.formulario,contratantesxacto.monto,contratantesxacto.opago,
					
					
					contratantesxacto.ofondo,contratantesxacto.montop,contratantes.idcontratanterp FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc 
					 LEFT JOIN  nacionalidades ON cliente.nacionalidad = nacionalidades.idnacionalidad
					 LEFT JOIN tipoestacivil ON cliente.idestcivil =  tipoestacivil.idestcivil 
					 LEFT JOIN  profesiones ON cliente.idprofesion =  profesiones.idprofesion
					 LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe
					 LEFT JOIN  ubigeo ON ubigeo.coddis = cliente.idubigeo
					 LEFT JOIN ciiu ON ciiu.coddivi = cliente.actmunicipal
					 LEFT JOIN cliente2 ON cliente.idcliente = cliente2.idcliente
					 LEFT JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante
					 LEFT JOIN  sedesregistrales ON contratantes.idsedereg = sedesregistrales.idsedereg
					 LEFT JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante
					 LEFT JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion
					 WHERE     cliente2.idcliente = '$idConyuge'
					 GROUP BY cliente.idcliente ORDER BY cliente.apepat"; 

		$resultConyuge = mysql_query($sql);
		


		if(mysql_affected_rows() != 0){
			$rowConyuge = mysql_fetch_assoc($resultConyuge);
			$arrPersonSignature[] = $rowConyuge;
			$arrOb[] = $rowConyuge;
		}
				 


		$arrOb[] = $dataPersonSignature;




		$listPersonSignature[] = array($key=>$arrPersonSignature);

	}

	$listPersonSignature[] = array('listaob'=>$arrOb);
	//var_dump($arrOb);
	//die();

	




		$sql = "SELECT  patrimonial.idmon,monedas.desmon AS moneda,monedas.simbolo AS simbolo_moneda,patrimonial.tipocambio,patrimonial.importetrans AS importe_patrimonial,
			patrimonial.exhibiomp,fpago_uif.descripcion AS forma_pago FROM  patrimonial  LEFT JOIN monedas ON patrimonial.idmon = monedas.idmon
			LEFT JOIN fpago_uif ON patrimonial.fpago  = fpago_uif.id_fpago
			WHERE patrimonial.kardex =  '$this->_kardex'";

		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);

		if($row){
			foreach ($row as $key => $value) {
				# code...
				

		   		switch ($key) {
		   			case 'importe_patrimonial':
		   				# code...
		   				$bookmarkName = mb_strtoupper('LETRA_'.$key);
		   				$valueBookMark = $this->_objNumeroLetra->fun_capital_moneda(1,$value);
		   				$this->_objTbs->VarRef[$bookmarkName] = $valueBookMark;


		   				break;
		   			
		   			default:
		   				# code...
		   				break;
		   		}

		   		$key = mb_strtoupper(trim($key));
		   		$value = is_null($value)?'?':$value;
		   		$this->_objTbs->VarRef[$key] = mb_strtoupper($value);

			}
		}else{

			$columnCount =  mysql_num_fields($result);
			for ( $j = 0;$j < mysql_num_fields($result);$j++) {
    			$metaData = mysql_fetch_field($result, $j);
		      	$key = $metaData->name;
		      	$value = null;
		   		$key = mb_strtoupper(trim($key));
		   		$value = is_null($value)?'?':$value;
		   		$this->_objTbs->VarRef[$key] = mb_strtoupper($value);
			
			}
		}






	
		
		$sql = "SELECT movirrpp.idmovreg,detallemovimiento.fechamov AS fecha_movimiento,detallemovimiento.vencimiento AS fecha_vencimiento,
			detallemovimiento.titulorp AS titulo_rrpp,
			detallemovimiento.idsedereg,sedesregistrales.dessede AS sede_registral,
			detallemovimiento.idsecreg,seccionesregistrales.dessecc AS seccion_registro,
			detallemovimiento.idtiptraoges,tipotramogestion.desctiptraoges,
			detallemovimiento.idestreg,estadoregistral.desestreg AS estado_registral, detallemovimiento.encargado AS encargado,
			detallemovimiento.registrador,
			detallemovimiento.anotacion,detallemovimiento.importee AS importe,detallemovimiento.observa AS observacion,
			detallemovimiento.numeroo AS numero,detallemovimiento.mayorderecho AS mayor_derecho,
			detallemovimiento.numeroPartida AS numero_partida,detallemovimiento.asiento ,detallemovimiento.recibo ,
			detallemovimiento.fechaInscripcion AS fecha_inscripcion

				FROM 
				 movirrpp INNER JOIN detallemovimiento 
				 
				 ON movirrpp.idmovreg = detallemovimiento.idmovreg INNER JOIN sedesregistrales
				   ON detallemovimiento.idsedereg = sedesregistrales.idsedereg INNER JOIN 
				   seccionesregistrales ON  detallemovimiento.idsecreg = seccionesregistrales.idsecreg
				 INNER JOIN    tipotramogestion ON  detallemovimiento.idtiptraoges = tipotramogestion.idtiptraoges
				 LEFT JOIN estadoregistral ON detallemovimiento.idestreg  = estadoregistral.idestreg
				 WHERE movirrpp.kardex = '$this->_kardex' ORDER BY itemmov  DESC LIMIT 1";

		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);


		if($row){
			foreach ($row as $key => $value) {
				# code...
				$key = mb_strtoupper(trim($key));
		   		$value = is_null($value)?'?':$value;
		   		$this->_objTbs->VarRef[$key] = mb_strtoupper($value);

			}
		}else{
			$columnCount =  mysql_num_fields($result);
			for ( $j = 0;$j < mysql_num_fields($result);$j++) {
    			$metaData = mysql_fetch_field($result, $j);
		      	$key = $metaData->name;
		      	$value = null;
		   		$key = mb_strtoupper(trim($key));
		   		$value = '';
		   		$this->_objTbs->VarRef[$key] = mb_strtoupper($value);
			
			}
		}

		

		$sql = "SELECT  detallevehicular.numplaca AS placa,detallevehicular.motor,detallevehicular.clase, detallevehicular.marca,detallevehicular.anofab AS anio,detallevehicular.modelo,detallevehicular.carroceria,detallevehicular.color, detallevehicular.numserie AS numero_serie FROM detallevehicular WHERE detallevehicular.kardex = '$this->_kardex'";
	
		$result = mysql_query($sql);
		$arrPatrimonial = array();

		if(mysql_affected_rows() != 0){
			while ($record = mysql_fetch_assoc($result)) {
				$record['placa'] = mb_strtoupper($record['placa']);
				$record['motor'] = mb_strtoupper($record['motor']);
				$record['clase'] = mb_strtoupper($record['clase']);
				$record['marca'] = mb_strtoupper($record['marca']);
				$record['anio'] = mb_strtoupper($record['anio']);
				$record['modelo'] = mb_strtoupper($record['modelo']);
				$record['carroceria'] = mb_strtoupper($record['carroceria']);
				$record['color'] = mb_strtoupper($record['color']);
				$record['numero_serie'] = mb_strtoupper($record['numero_serie']);
				$arrPatrimonial[] = $record;

				foreach ($record as $key => $value) {
					# code...
					$key = mb_strtoupper(trim($key));
					$this->_objTbs->VarRef[$key] = mb_strtoupper($value);
				}

			}		
		}else{
			$columnCount =  mysql_num_fields($result);
			for ( $j = 0;$j < mysql_num_fields($result);$j++) {
    			$metaData = mysql_fetch_field($result, $j);
		      	$key = $metaData->name;
		      	$value = null;
		   		$key = mb_strtoupper(trim($key));
		   		$value = '';
		   		$this->_objTbs->VarRef[$key] = mb_strtoupper($value);
			
			}
		}

		#CONSTANTES - MARCADORES
		$this->_objTbs->VarRef['VACIO'] = '';

		$curDate = $this->_objNumeroLetra->fun_fech_letras(date("Y/m/d"));
		$key = 'LETRA_FECHA_ACTUAL';
		$this->_objTbs->VarRef[$key] = $curDate;

		foreach ($this->_arrVars as $key => $value) {
			# code...
			$key = mb_strtoupper($key);
			$this->_objTbs->VarRef[$key] = $value;
		}

		$here = getcwd();
   		$this->_pathTemplate = $here.$this->_urlTemplate.$this->_folderTemplate.$this->_templateName;

   		if(!file_exists($this->_pathTemplate)){
   			die('El  directorio de la plantilla no existe:'.$this->_pathTemplate);
   		
   		}

   		
   		$this->_objTbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
   		$this->_objTbs->NoErr = true;
   		//$this->_objTbs->LoadTemplate($this->_pathTemplate,OPENTBS_ALREADY_UTF8);

   		$this->_objTbs->LoadTemplate($this->_pathTemplate);



 
   		$this->_objTbs->MergeBlock('bien',$arrPatrimonial);


   		foreach ($listMergeBlock as $key => $record) {
   			foreach ($record as $key1 => $row) {
   				# code...
   				$key1 = strtolower($key1);
   				$this->_objTbs->MergeBlock($key1,$row);
   			}

   		}	

		foreach ($listMergeBlockUif as $key => $record) {
   			foreach ($record as $key1 => $row) {
   				# code...
   				$key1 = strtolower($key1);
   				
   				$this->_objTbs->MergeBlock($key1,$row);

   				/*$nameMergerBlock = strtolower('f'.$key1);
   				$this->_objTbs->MergeBlock($nameMergerBlock,$row);*/
   			}

   		}	

   		//var_dump($listRepresentative);

   		foreach ($listRepresentative as $key => $record) {
   			foreach ($record as $key1 => $row) {
   				# code...
   				$key1 = strtolower($key1);
   				//var_dump($row);
   				if(!is_null($row)){
   					//echo $key1;
   					//var_dump($row);
   					$this->_objTbs->MergeBlock($key1,$row);
   				}
   					
   					
   				else{
   					$this->_objTbs->MergeBlock($key1,array());
   				}
   			}
   			
   		}
   		//var_dump($listPersonSignature);
   		//die();
   		
   		foreach ($listPersonSignature as $key => $record) {

   			foreach ($record as $key1 => $row) {
   				# code...
   				$this->_objTbs->MergeBlock($key1,$row);

   				
   			}


   		}	
   		

   		
   		
   		
   		$this->_objTbs->PlugIn(OPENTBS_DELETE_COMMENTS);

		$this->_objTbs->Show(OPENTBS_DOWNLOAD, $this->_fileName.$this->_fileType);
   		

	}

	public function getDescriptionError(){

		$messageError = '';
		switch ($this->_error) {
			case 1:
				# code...
				$messageError = 'Error ingrese un valor correcto.';
				break;
			case 2:
				$messageError = 'Error el template de codigo '.$this->_templateId.' no existe.';
				break;		 			
			
			default:
				# code...
				break;
		}
		return $messageError;
	}


}
