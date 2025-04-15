<?php

include_once('tbs_class.php');
include_once('tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');


$config['hostDataBase'] = 'localhost';
$config['userDataBase'] = 'root';
$config['passwordDataBase'] = '12345';
$config['nameDataBase'] = 'notarios';



class TemplateClass {


	private $_pkTemplate;
	private $_templateName;
	private $_pathTemplate;
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

	public function getPathTemplate(){
		return  $this->_pathTemplate;
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
		global $config;
		
		$this->_objPDO = new PDO('mysql:host='.$config['hostDataBase'].';dbname='.$config['nameDataBase'], $config['userDataBase'], $config['passwordDataBase']) or die('Error al conectarse al servidor') or die('Error al conectarse al servidor');
		$this->_totalScore = 25;

		
		$this->_objNumeroLetra = new ClaseNumeroLetra();
		$this->_objTbs = new clsTinyButStrong('{,}');
		$this->_objTbs->ResetVarRef(true);
		$this->_objTbs->MergeField('var');	

		$this->_codeActs = $codeActs;
		//$this->_pkTypeKardex = $pkTypeKardex;

		$this->_pkTemplate = $pkTemplate;

		/*if($this->_codeActs == 0 || $this->_pkTypeKardex == 0){
			$this->showError(1);
		}*/

	}

	public function setParams($arrParams){
		$this->_params = $arrParams;
	}

	public function  run(){


		$sql = "SELECT pkTemplate,nameTemplate,codeActs,contract,urlTemplate,fileName FROM tpl_template WHERE pkTemplate = ? ";
		$sth = $this->_objPDO->prepare($sql);



		$sth->execute(array($this->_pkTemplate));

		$result = $sth->fetch(PDO::FETCH_ASSOC);
		$this->_templateId = $result['pkTemplate'];
		$this->_templateName = $result['fileName'];

		$here = getcwd();
		$this->_pathTemplate = $here.$result['urlTemplate'].$this->_templateName;
		
		if(!$result){
			$this->showError(2);
		}

		$sql = "SELECT nombre AS nombres,apellido AS apellidos, CONCAT(nombre,' ',apellido) AS notario,ruc AS ruc_notario FROM confinotario";
		$sth = $this->_objPDO->prepare($sql);
		$sth->execute();
		$resultSql = $sth->fetchAll(PDO::FETCH_ASSOC);

		if($sth->rowCount() == 1){

	   			foreach ($resultSql  as $key => $record) {
		   			$lastRecord = $record;
				}	
	   		
		   		foreach ($lastRecord as $key => $value) {
		   		
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
	   		$columnCount = $sth->columnCount();
			for ($j = 0; $j<$columnCount; $j++) { 

				$arrColumn = $sth->getColumnMeta($j);
				$key = $arrColumn['name'];
				$value = '';

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

			
	   	}
		$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.idtipkar,tipokar.nomtipkar AS tipo_kardex,kardex.kardexconexo,
				kardex.fechaingreso AS fecha_ingreso,YEAR(STR_TO_DATE(kardex.fechaingreso,'%d/%m/%Y')) AS 
				anio_kardex,kardex.horaingreso,kardex.referencia,kardex.codactos,kardex.contrato,
				kardex.idusuario,usuarios.apepat AS usuario_apellido_parteno,usuarios.apemat AS usuario_apellido_materno,
				usuarios.prinom AS usuario_primer_nombre,usuarios.segnom AS usuario_segundo_nombre,kardex.responsable,
				
				kardex.observacion,kardex.documentos,kardex.fechacalificado,kardex.fechainstrumento AS fecha_instrumento,
				STR_TO_DATE(kardex.fechaconclusion,'%d/%m/%Y') AS fecha_conclusion,kardex.numinstrmento AS numero_instrumento,
				kardex.folioini AS folio_inicial,kardex.folioinivta,kardex.foliofin AS folio_final,
				kardex.papelTrasladoIni AS papel_inicial_traslado,kardex.papelTrasladoFin AS papel_inicial_traslado,
				kardex.foliofinvta,kardex.papelinivta,kardex.papelini  AS papel_notarial_inicial,kardex.papelfin AS papel_notarial_final,
				kardex.papelfinvta,kardex.comunica1,kardex.contacto,kardex.telecontacto,kardex.mailcontacto,kardex.retenido,kardex.desistido,kardex.autorizado,
				kardex.idrecogio,kardex.pagado,kardex.visita,kardex.dregistral AS derecho_registral,kardex.dnotarial AS derecho_notarial,
				kardex.idnotario, notarios.descon AS notaria,notarios.direccion,kardex.numminuta AS numero_minuta,kardex.numescritura AS numero_escritura,
				kardex.fechaescritura AS fecha_escritura,kardex.insertos,kardex.direc_contacto,kardex.txa_minuta AS registro,kardex.idabogado,
				IF( tb_abogado.razonsocial IS NULL ,'',tb_abogado.razonsocial )  AS abogado,tb_abogado.documento,tb_abogado.matricula,tb_abogado.sede_colegio AS sede_colegio_abogado,
				kardex.responsable_new AS responsable,kardex.fechaminuta AS fecha_minuta,kardex.ob_nota,kardex.ins_espec,kardex.recepcion,
				kardex.funcionario_new AS funcionario,kardex.nc,kardex.fecha_modificacion,kardex.idPresentante,
				IF(presentante.idPresentante IS NULL,'',presentante.numeroDocumento) AS presentante_numero_documento, 
				presentante.apellidoPaterno AS presentante_apellido_paterno,presentante.apellidoMaterno AS presentante_apellido_materno,
				presentante.primerNombre AS presentante_primer_nombre, presentante.segundoNombre AS presentante_segundo_nombre,
				IF(presentante.idPresentante IS NULL,'',CONCAT(presentante.apellidoPaterno,' ',presentante.apellidoMaterno,' ',
				presentante.primerNombre, ' ',presentante.segundoNombre, ' '
				) )AS presentante
				FROM kardex INNER JOIN tipokar 
				ON kardex.idtipkar = tipokar.idtipkar LEFT JOIN  usuarios ON kardex.idusuario  = usuarios.idusuario
				LEFT JOIN  notarios ON  kardex.idnotario = notarios.idnotario LEFT JOIN tb_abogado 
				ON kardex.idabogado = tb_abogado.idabogado LEFT JOIN presentante ON kardex.idPresentante = presentante.idPresentante
				WHERE kardex.kardex =  ?";

		//die($this->_kardex);
		$sth = $this->_objPDO->prepare($sql);
		$sth->execute(array($this->_kardex));
		$resultSql = $sth->fetchAll(PDO::FETCH_ASSOC);


		if($sth->rowCount() == 1){

	   			foreach ($resultSql  as $key => $record) {
		   			$lastRecord = $record;
				}	
	   		
		   		foreach ($lastRecord as $key => $value) {

		   			switch ($key) {
		   				case 'fecha_conclusion':
		   					# code...
		   					$lettersFechaConclusion = $this->_objNumeroLetra->fun_fech_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $lettersFechaConclusion;
		   					break;
		   				case 'fecha_escritura':
		   					# code...
		   					$lettersFechaConclusion = $this->_objNumeroLetra->fun_fech_letras($value);
		   					$bookmarkName = mb_strtoupper('LETRA'.'_'.$key);
				 			$this->_objTbs->VarRef[$bookmarkName] = $lettersFechaConclusion;
		   					break;
		   				default:
		   					# code...
		   					break;
		   			}

		   			$key = mb_strtoupper(trim($key));
		   			$value = is_null($value)?'?':$value;
		   			$this->_objTbs->VarRef[$key] = mb_strtoupper($value);

		   		}
	   	}

	   	$sql = "SELECT idcondicion,idtipoacto,condicion,parte,uif,formulario,montop,totorgante FROM  actocondicion WHERE idtipoacto = ?";
	   	$sth = $this->_objPDO->prepare($sql);
		$sth->execute(array($this->_codeActs));
		$resultSql = $sth->fetchAll(PDO::FETCH_ASSOC);

		foreach ($resultSql as $key => $row) {
			# code...
			$pkTypAct = $row['idcondicion'];
			$nameAct = $row['condicion'];
			$char1 = substr($nameAct, 0,1);
			$sql = "SELECT  cliente.idcliente,cliente.tipper,cliente.apepat AS apellido_paterno,cliente.apemat AS apellido_materno,cliente.prinom AS primer_nombre,
					cliente.segnom AS segundo_nombre,cliente.nombre AS contratante,
					cliente.direccion,cliente.idtipdoc ,tipodocumento.destipdoc AS tipo_documento,cliente.numdoc AS numero_documento,cliente.email,
					cliente.telfijo AS telefono,cliente.telcel AS celular,cliente.telofi,cliente.sexo,cliente.idestcivil ,tipoestacivil.desestcivil AS estado_civil,
					cliente.natper AS persona_natural,cliente.conyuge,cliente.nacionalidad,cliente.idprofesion,profesiones.desprofesion AS profesion,
					cliente.idcargoprofe,cargoprofe.descripcrapro AS cargo,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis AS distrito,
					ubigeo.nomprov AS provincia,ubigeo.nomdpto AS departamento,cliente.cumpclie AS fecha_nacimiento,cliente.fechaing,cliente.razonsocial AS empresa,
					cliente.domfiscal AS domicilio_fiscal,cliente.telempresa AS empresa_telefono,
					cliente.mailempresa AS empresa_email,cliente.contacempresa,cliente.fechaconstitu AS fecha_constitucion,
					cliente.idsedereg,sedesregistrales.dessede AS sede_registral,cliente.numregistro AS numero_registro,cliente.numpartida AS numero_partida,
					cliente.actmunicipal,ciiu.nombre AS ciiu,cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad,
					cliente.impremite,cliente.impmotivo,cliente.residente,cliente.docpaisemi,
					contratantes.condicion,contratantes.firma ,contratantes.fechafirma AS fecha_firma,contratantes.resfirma,
					contratantes.tiporepresentacion,contratantes.idcontratanterp,contratantes.numpartida AS numpartidaContratante,contratantes.facultades,contratantes.indice,
					contratantes.visita,contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion,
					actocondicion.condicion,
					contratantesxacto.parte,contratantesxacto.porcentaje,contratantesxacto.uif,
					contratantesxacto.formulario,contratantesxacto.monto,contratantesxacto.opago,
					contratantesxacto.ofondo,contratantesxacto.montop FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc 
					 LEFT JOIN tipoestacivil ON cliente.idestcivil =  tipoestacivil.idestcivil 
					 LEFT JOIN  profesiones ON cliente.idprofesion =  profesiones.idprofesion
					 LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe
					 LEFT JOIN  ubigeo ON ubigeo.coddis = cliente.idubigeo
					 LEFT JOIN  sedesregistrales ON cliente.idsedereg = sedesregistrales.idsedereg
					 LEFT JOIN ciiu ON ciiu.coddivi = cliente.actmunicipal
					 LEFT JOIN cliente2 ON cliente.idcliente = cliente2.idcliente
					 LEFT JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante
					 LEFT JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante
					 LEFT JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion
					 WHERE    contratantes.kardex = ? AND contratantesxacto.idcondicion = ?";

			$sth = $this->_objPDO->prepare($sql);
			$sth->execute(array($this->_kardex,$pkTypAct));
			$resultSql = $sth->fetchAll(PDO::FETCH_ASSOC);
			$affectedRows = $sth->rowCount();

			
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
			foreach ($resultSql  as $row => $record) {
				 	$data[] =  $record;

				 	$valueBookMar = str_repeat('_',30);
					$bookmarkName = 'FIRMA';
					$bookmarkName = $char1.$bookmarkName.$i;
					$this->_objTbs->VarRef[$bookmarkName] = $valueBookMar;
				 	foreach ($record as $key => $value) {
				 		# code...
				 		switch ($key) {
				 			case 'numero_documento':
				 				# code...
				 				$lettersNumdoc = $this->_objNumeroLetra->fun_nume_letras($value);
				 				$bookmarkName =  mb_strtoupper($char1.'_'.'LETRA'.'_'.$key.'_'.$i);
				 				/*if($char1 == 'R'){
				 					die($bookmarkName.'-'.$lettersNumdoc);
				 				}*/
				 				$this->_objTbs->VarRef[$bookmarkName] = $lettersNumdoc;
				 				break;
				 			case 'fecha_firma':
				 				/*if($char1 == 'I'){
				 						die($this->_objNumeroLetra->fun_fech_letras($value).'hola');
				 				}*/
				 				
				 				$lettersFechaFirma = $this->_objNumeroLetra->fun_fech_letras($value);
				 				$bookmarkName =  mb_strtoupper($char1.'_'.'LETRA'.'_'.$key.'_'.$i);
				 				$this->_objTbs->VarRef[$bookmarkName] = $lettersFechaFirma;
				 				break;

				 			/*case 'nacionalidad':

				 				$bookmarkName = $char1.'_NACIONALIDAD_'.$i;
				 				$this->_objTbs->VarRef[$bookmarkName] = $lettersFechaFirma;

				 				break;
				 				*/



				 			default:
				 				# code...
				 				break;
				 		}

				 		$conditionName = mb_strtoupper(trim($nameAct).'_'.$key.'_'.$i);
				 		$bookmarkName = mb_strtoupper($char1.'_'.$key.'_'.$i);
	
				 		$value = is_null($value)?'?':$value;
				 		$this->_objTbs->VarRef[$conditionName] =  utf8_decode($value);
				 		$this->_objTbs->VarRef[$bookmarkName] =  utf8_decode($value);
				 	}
				 	$i++;
				
			}

			$columnCount = $sth->columnCount();
			
			for($x = $i; $x<=$this->_totalScore;$x++){

				for ($j = 0; $j<$columnCount; $j++) { 

					$arrColumn = $sth->getColumnMeta($j);
					$columName = $arrColumn['name'];
					$valueEmpty = '';
					switch ($columName) {
				 			case 'numero_documento':
				 				# code...
				 				$lettersNumdoc = $this->_objNumeroLetra->fun_nume_letras($valueEmpty);
				 				$bookmarkName =  mb_strtoupper($char1.'_'.'LETRA'.'_'.$columName.'_'.$i);
				 				$this->_objTbs->VarRef[$bookmarkName] = $lettersNumdoc;
				 				break;
				 			
				 			default:
				 				# code...
				 				break;
				 	}

					$valueBookMar = $valueEmpty;
					$bookmarkName = 'FIRMA';
					$bookmarkName = $char1.$bookmarkName.$x;
					$this->_objTbs->VarRef[$bookmarkName] = $valueBookMar;




					 $key = mb_strtoupper($char1.'_'.$columName.'_'.$x);
					 $this->_objTbs->VarRef[$key] = $valueEmpty;
				}

			}	

		}


		$curDate = $this->_objNumeroLetra->fun_fech_letras(date("Y/m/d"));
		$key = 'LETRA_FECHA_ACTUAL';
		$this->_objTbs->VarRef[$key] = $curDate;

		foreach ($this->_arrVars as $key => $value) {
			# code...
			$key = mb_strtoupper($key);
			$this->_objTbs->VarRef[$key] = $value;
		}


   		
   		if(!file_exists($this->_pathTemplate)){
   			die('El  directorio de la plantilla no existe');
   		}


   		$this->_objTbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

   		
   		$this->_objTbs->LoadTemplate($this->_pathTemplate);
   		
   		
   		$this->_objTbs->PlugIn(OPENTBS_DELETE_COMMENTS);


		$this->_objTbs->Show(OPENTBS_DOWNLOAD, $this->_fileName.'.'.$this->_fileType);
   		
   			
   		
		
		


	}



	public function showError($error){

		switch ($error) {
			case 1:
				# code...
			die('Error ingrese un valor correcto.');
				break;
			case 2:
			die('Error el template de codigo '.$this->_templateId.' no existe.');
				break;
			
			default:
				# code...
				break;
		}
	}


}