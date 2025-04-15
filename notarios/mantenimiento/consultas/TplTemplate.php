<?php
include_once '../../Cpu/FileClass.php';
include_once '../../conexion.php';

class TplTemplate{

	private $_pkTemplate;
	private $_nameTemplate;
	private $_fkTypeKardex;
	private $_codeActs;
	private $_contract;

	private $_urlTemplate;
	private $_fileName;
	private $_objFile;
	private $_file;
	private $_error;


	public function __construct(){
		global $conn;
		$this->_objFile = new Cpu_File();
	}

	public function  setPkTemplate($value){
		$this->_pkTemplate = $value;
	}
	public function setNameTemplate($value){
		$this->_nameTemplate = $value;
	}
	public function  setFkTypeKardex($value){
		$this->_fkTypeKardex = $value;
	}
	public function setCodeActs($value){
		$this->_codeActs = $value;
	}
	public function  setContract($value){
		$this->_contract = $value;
	}
	public function  setDirectory($value){
		$this->_directory = $value;
	}
	public function setUrlTemplate($value){
		$this->_urlTemplate = $value;
	}
	public function getFileName(){
		return $this->_fileName;
	}
	public function  setFile($value){
		$this->_file = $value;
	}
	public function  getError(){
		return $this->_error;
	}

	public function  setError($value){
		$this->_value = $value;
	}

	public function  deleteTemplate(){
		$sql = "UPDATE tpl_template SET statusRegister = 0 WHERE pkTemplate = '$this->_pkTemplate'";
		$result = mysql_query($sql);
		$affectedRows = mysql_affected_rows();
		$this->_error = $affectedRows == 1?0:5;
		return $this->_error != 0?false:true;	
	}
	public function getTemplateByTypeAct(){

		$sql = "SELECT tpl_template.pkTemplate,tpl_template.nameTemplate,tipokar.nomtipkar,tpl_template.fkTypeKardex,tipokar.nomtipkar,tpl_template.codeActs,tpl_template.contract,tpl_template.urlTemplate,fileName FROM tpl_template INNER JOIN tipokar ON tpl_template.fkTypeKardex = tipokar.idtipkar WHERE  tpl_template.statusRegister = 1";
		$result = mysql_query($sql);
		$data = array();
		while($row = mysql_fetch_array($result))
			$data[] = $row;
		return $data;
	}

	public function getTemplateByPk(){
		$sql = "SELECT tpl_template.pkTemplate,tpl_template.nameTemplate,tipokar.nomtipkar,tpl_template.fkTypeKardex,tipokar.nomtipkar,tpl_template.codeActs,tpl_template.contract,tpl_template.urlTemplate,fileName FROM tpl_template INNER JOIN tipokar ON tpl_template.fkTypeKardex = tipokar.idtipkar WHERE tpl_template.pkTemplate = '$this->_pkTemplate' AND tpl_template.statusRegister = 1";

		$result = mysql_query($sql);
		$data = array();
		while($row = mysql_fetch_array($result))
			$data[] = $row;
		return $data;
	}
	
	public function uploadFileTemplate(){
		//$date = new DateTime();
		$nameTemplate = strtoupper(str_replace(' ', '_', trim($this->_nameTemplate)));
		//$fileName = $nameTemplate.'_'.$date->getTimestamp();
		$fileName = $nameTemplate;
		$listTypeFile = array('odt','docx');
		$this->_objFile->setFile($this->_file);
		$this->_objFile->setTypeFile($listTypeFile);
		$this->_objFile->setSize(2);
		$this->_objFile->setNameFile($fileName);
		$this->_objFile->setPathFile('../../reportes_word/tpl_templates/protocolares/');
		if(!$this->_objFile->correctTypeFile()){
		    $this->_error  = 1;
		    return false;
		}
		if(!$this->_objFile->correctSize()){
		   	$this->_error = 2;
		   	return  false;
		}
		if(!$this->_objFile->uploadFile()){
			$this->_error = 3;
			return false;

		}
		$fileName = $fileName.$this->_objFile->getExtension();
		$this->_fileName = $fileName;
		return  true;	
	}
	public function  addTemplate(){
		// if(!$this->uploadFileTemplate()){
		// 	return false;
		// }


		$sql = "SELECT pkTemplate FROM  tpl_template WHERE nameTemplate = '$this->_nameTemplate' AND fkTypeKardex = $this->_fkTypeKardex";
		

		$result = mysql_query($sql);
		$affectedRows = mysql_affected_rows();

		////VALIDACION PARA PLANTILLAS REPETIDAS
		// if($affectedRows != 0){
		// 	$this->_error = 6;
		// 	return false;
		// }

		$plantilla=$this->_nameTemplate.'.docx';

		$sql = "INSERT INTO tpl_template(nameTemplate,fkTypeKardex,codeActs,contract,urlTemplate,fileName,registrationDate,statusRegister) VALUES('$this->_nameTemplate','$this->_fkTypeKardex','$this->_codeActs','$this->_contract','$this->_directory','$plantilla',NOW(),1)";
		$result = mysql_query($sql);
		$affectedRows = mysql_affected_rows();

		$this->_error = $affectedRows == 1?0:4;
		return $this->_error != 0?false:true;

	}




	public function changeFileTemplate(){
		if(!$this->uploadFileTemplate()){
			return false;
		}

		$sql = "UPDATE tpl_template SET fileName = '$this->_fileName' WHERE pkTemplate = '$this->_pkTemplate'";
		$result = mysql_query($sql);
		$affectedRows = mysql_affected_rows();
		$this->_error = $affectedRows == 1?0:5;
		return $this->_error != 0?false:true;	
	}

	public function changeTemplate(){

		$sql = "SELECT pkTemplate FROM  tpl_template WHERE nameTemplate = '$this->_nameTemplate' AND pkTemplate != $this->_pkTemplate AND fkTypeKardex = '$this->_fkTypeKardex'";
		$result = mysql_query($sql);
		$affectedRows = mysql_affected_rows();

		if($affectedRows != 0){
			$this->_error = 6;
			return false;		}

		$plantilla=$this->_nameTemplate.'.docx';

		$sql = "UPDATE tpl_template SET fkTypeKardex = '$this->_fkTypeKardex',nameTemplate='$this->_nameTemplate',codeActs = '$this->_codeActs',contract = '$this->_contract',urlTemplate='$this->_directory',fileName='$plantilla' WHERE pkTemplate = '$this->_pkTemplate'";
		$result = mysql_query($sql);
		$affectedRows = mysql_affected_rows();
		$this->_error = $affectedRows == 1?0:0;
		return $this->_error != 0?false:true;	
	}


	public function  getDescriptionError(){
		$messsage = '';
		switch ($this->_error) {
			case 1:
				# code...
				$messsage = 'El tipo de archivo es incorrecto';
				break;
			case 2:
				$messsage = 'El tamaño del archivo es incorrecto';
				break;
			break;

			case 3:
				$messsage = 'Error al  subir  la plantilla';
				break;
			break;

			case 4:
				$messsage = 'Error al  ejecutar la consulta';
				break;
			case 5:
				$messsage = 'No realizo ningun cambio';
				break;
			case 6:
				$messsage = 'El nombre de la plantilla ya existe';
				break;
			default:
				# code...
				break;
		}
		return $messsage;
	}




}

$action = (int)$_POST['action'];
$objTemplate = new TplTemplate();
$objResponse = new stdClass();
switch ($action) {
	case 1:
		# code...	
		$fkTypeKardex = isset($_POST['fkTypeKardex'])?$_POST['fkTypeKardex']:null;
		$nameTemplate = isset($_POST['nameTemplate'])?$_POST['nameTemplate']:null;
		$codeActs = isset($_POST['codeActs'])?$_POST['codeActs']:null;
		$contract =  isset($_POST['contract'])?$_POST['contract']:null;
		// $fileTemplate = isset($_FILES['fileTemplate'])?$_FILES['fileTemplate']:null;
		$directory =  isset($_POST['directorio'])?$_POST['directorio']:null;

		if(is_null($fkTypeKardex)){
				$objResponse->error = -1;
				$objResponse->descriptionError =  'El  valor para el campo tipo de kardex  es Incorrecto';
				echo  json_encode($objResponse);
				exit();
			}
		if(is_null($nameTemplate)){
			$objResponse->error = -1;
			$objResponse->descriptionError =  'El  valor para el campo nombre de la plantilla es Incorrecto';
			echo  json_encode($objResponse);
			exit();
		}
		if(is_null($codeActs)){
			$objResponse->error = -1;
			$objResponse->descriptionError =  'El  valor para el campo codigo de acto  es Incorrecto';
			echo  json_encode($objResponse);
			exit();
		}
		// if(is_null($fileTemplate)){
		// 	$objResponse->error = -1;
		// 	$objResponse->descriptionError =  'No se adjuntado el archivo  para la plantilla';
		// 	echo  json_encode($objResponse);
		// 	exit();
		// }
		$objTemplate->setFkTypeKardex($fkTypeKardex);
		$objTemplate->setNameTemplate($nameTemplate);
		$objTemplate->setCodeActs($codeActs);
		$objTemplate->setContract(trim($contract));
		$objTemplate->setDirectory(trim($directory));
		// $objTemplate->setFile($fileTemplate);
		$objTemplate->setUrlTemplate('/tpl_templates/');


		if($objTemplate->addTemplate()){
			$objResponse->error = 0;
			$objResponse->descriptionError = 'La Plantilla se registro con exito';
			echo json_encode($objResponse);
		}else{
			$objResponse->error = $objTemplate->getError();
			$objResponse->descriptionError = $objTemplate->getDescriptionError();
			echo json_encode($objResponse);
		}
		


		break;

	case 2:
		$pkTemplate = isset($_POST['pkTemplate'])?$_POST['pkTemplate']:null;
		$fkTypeKardex = isset($_POST['fkTypeKardex'])?$_POST['fkTypeKardex']:null;
		$nameTemplate = isset($_POST['nameTemplate'])?$_POST['nameTemplate']:null;
		$codeActs = isset($_POST['codeActs'])?$_POST['codeActs']:null;
		$contract =  isset($_POST['contract'])?$_POST['contract']:null;
		$directory =  isset($_POST['directorio'])?$_POST['directorio']:null;

		if(is_null($pkTemplate)){
				$objResponse->error = -1;
				$objResponse->descriptionError =  'El  valor para el campo id de plantilla  es Incorrecto';
				echo  json_encode($objResponse);
				exit();
		}
		if(is_null($nameTemplate)){
			$objResponse->error = -1;
			$objResponse->descriptionError =  'El  valor para el campo nombre de la plantilla es Incorrecto';
			echo  json_encode($objResponse);
			exit();
		}

		if(is_null($fkTypeKardex)){
				$objResponse->error = -1;
				$objResponse->descriptionError =  'El  valor para el campo tipo de kardex  es Incorrecto';
				echo  json_encode($objResponse);
				exit();
		}
	
		if(is_null($codeActs)){
			$objResponse->error = -1;
			$objResponse->descriptionError =  'El  valor para el campo codigo de acto  es Incorrecto';
			echo  json_encode($objResponse);
			exit();
		}
		$objTemplate->setPkTemplate($pkTemplate);
		$objTemplate->setFkTypeKardex($fkTypeKardex);
		$objTemplate->setNameTemplate($nameTemplate);

		$objTemplate->setCodeActs($codeActs);
		$objTemplate->setContract(trim($contract));
		$objTemplate->setDirectory(trim($directory));

		if($objTemplate->changeTemplate()){
			$objResponse->error = 0;
			$objResponse->descriptionError = 'La Plantilla se actualizo con exito';
			echo json_encode($objResponse);
		}else{
			$objResponse->error = $objTemplate->getError();
			$objResponse->descriptionError = $objTemplate->getDescriptionError();
			echo json_encode($objResponse);
		}


		break;	

	case 3:

		$pkTemplate = isset($_POST['pkTemplate'])?$_POST['pkTemplate']:null;
		if(is_null($pkTemplate)){
				$objResponse->error = -1;
				$objResponse->descriptionError =  'El  valor para el campo id de plantilla  es Incorrecto';
				echo  json_encode($objResponse);
				exit();
		}
		$objTemplate->setPkTemplate($pkTemplate);
		if($objTemplate->deleteTemplate()){
			$objResponse->error = 0;
			$objResponse->descriptionError = 'Se elimino la plantilla con exito';
			echo json_encode($objResponse);
		}else{
			$objResponse->error = $objTemplate->getError();
			$objResponse->descriptionError = $objTemplate->getDescriptionError();
			echo json_encode($objResponse);
		}

		break;		
	case 4:
		$pkTemplate = isset($_POST['pkTemplate'])?$_POST['pkTemplate']:null;
		$nameTemplate = isset($_POST['nameTemplate'])?$_POST['nameTemplate']:null;
		$fileTemplate = isset($_FILES['fileTemplate'])?$_FILES['fileTemplate']:null;

		if(is_null($pkTemplate)){
				$objResponse->error = -1;
				$objResponse->descriptionError =  'El  valor para el campo id de plantilla  es Incorrecto';
				echo  json_encode($objResponse);
				exit();
		}

		if(is_null($nameTemplate)){
			$objResponse->error = -1;
			$objResponse->descriptionError =  'El  valor para el campo nombre de la plantilla es Incorrecto';
			echo  json_encode($objResponse);
			exit();
		}

		if(is_null($fileTemplate)){
			$objResponse->error = -1;
			$objResponse->descriptionError =  'No se adjuntado el archivo  para la plantilla';
			echo  json_encode($objResponse);
			exit();
		}
		$objTemplate->setPkTemplate($pkTemplate);
		$objTemplate->setNameTemplate($nameTemplate);
		$objTemplate->setFile($fileTemplate);

		if($objTemplate->changeFileTemplate()){
			$objResponse->error = 0;
			$objResponse->descriptionError = 'Se cambio la plantilla con exito';
			echo json_encode($objResponse);
		}else{
			$objResponse->error = $objTemplate->getError();
			$objResponse->descriptionError = $objTemplate->getDescriptionError();
			echo json_encode($objResponse);
		}

	break;
	case 5:
		$codeActs = $_POST['codeActs'];
		$objTemplate->setCodeActs($codeActs);
		$objResponse->error = 0;
		$objResponse->data = $objTemplate->getTemplateByTypeAct();
		echo  json_encode($objResponse);

	break;

	case 6:
		
	break;
	default:
		# code...
		break;
}
