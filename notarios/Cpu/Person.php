<?php
/**
 *  Clase para realizar Consultas Dni-Reniec, Ruc -Sunat
 * @version 1.0.0
 * @author Spencer Castillo <spencer.leo040890@gmail.com>
 * @copyright 2016
 * @license  GPL
 */ 
class Person{
	private $_fullNames;
	private $_surname1;
	private $_surname2;
	private $_name1;
	private $_name2;
	private $_name3;
	private $_address;
	private $_businessName;
	private $_statusTaxPayer;
	private $_conditionTaxPayer;
	private $_documentType;
	private $_document;
	private $_codeCaptcha;
	private $_params = array();
	private $_url;
	private $_urlCaptcha;
	private $_imageName;
	private $_pathImage;
	private $_imageCaptcha;
	private $_messageReponseContent;
	private $_errorResponseContent;
	private $_isCreateImageCaptcha;
	private $_fileCookie;


	public function __construct($documentType,$imageCaptcha = true){
		$this->_errorResponseContent = 0;
		$this->_documentType = $documentType;
		$this->_imageCaptcha = $imageCaptcha;


		if($this->_documentType == 1 && $this->_imageCaptcha){
			$this->_url = 'https://cel.reniec.gob.pe/valreg/codigo.do';
			$this->_params = null;
		}else if($this->_documentType == 1 && !$this->_imageCaptcha){
			$this->_url = 'https://cel.reniec.gob.pe/valreg/valreg.do';
			$this->_params = array('accion'=>'buscar','tecla_7'=>6,'tecla_8'=>7,'tecla_9'=>9,
				'tecla_4'=>0,'tecla_5'=>1,'tecla_6'=>2,'tecla_1'=>3,'tecla_2'=>8,'tecla_3'=>4,
				'tecla_0'=>5,'nuDni'=>'','imagen'=>'','bot_consultar.x'=>13,'bot_consultar.y'=>24);

		}else if($this->_documentType == 2 && $this->_imageCaptcha){
			$this->_url = 'http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/captcha?accion=image&nmagic=0';
			$this->_params = null;
		}else if($this->_documentType == 2 && !$this->_imageCaptcha){
			$this->_url = 'http://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/jcrS00Alias';
			$this->_params = array('accion'=>'consPorRuc','razSoc'=>'','nroRuc'=>'','nrodoc'=>'',
				'contexto'=>'ti-it','tQuery'=>'on','search1'=>'','codigo'=>'','tipdoc'=>1,
				'search2'=>'','coddpto'=>'','codprov'=>'','coddist'=>'','search3'=>'');
		}else{
			$this->getError(1);
		}

	}

	public function getFullNames(){
		return $this->_fullNames;
	}
	public function getSurname1(){
		return $this->_surname1;
	}
	public function  getSurname2(){
		return $this->_surname2;
	}
	public function getName1(){
		return $this->_name1;
	}
	public function  getName2(){
		return  $this->_name2;
	}
	public function  getName3(){
		return $this->_name3;
	}
	public function getAddress(){
		return $this->_address;
	}
	public function  getBusinessName(){
		return $this->_businessName;
	}
	public function  getStatusTaxPayer(){
		return $this->_statusTaxPayer;
	}
	public function  getConditionTaxPayer(){
		return $this->_conditionTaxPayer;
	}
	public function setImageName($value){
		$this->_imageName = $value;
	}

	public function pathImage($value){
		$this->_pathImage = $value;
	}

	public function setDocumentType($value){
		$this->_documentType = $value;
	}
	public function  getdocumentType(){
		return $this->_documentType;
	}

	public function setDocument($value){
		$this->_document = $value;
	}
	public function getDocument(){
		return $this->_document;
	}
	public function setCodeCaptcha($value){
		$this->_codeCaptcha = $value;
	}
	public function getCodeCaptcha(){
		return  $this->_codeCaptcha;
	}
	public function getErrorResponseContent(){
		return  $this->_errorResponseContent;
	}
	public function getMessageReponseContent(){
		return $this->_messageReponseContent;
	}

	public function setFileCookie($value){
		$this->_fileCookie = $value;
	}

	public function createImageCaptcha(){

		$this->_isCreateImageCaptcha = true;
		$imageBind = $this->getContent($this->_url,false,$this->_params,$this->_fileCookie);
		$file = fopen($this->_pathImage.$this->_imageName.'.jpg', 'w') or die(' Error al crear la imagen');
		fwrite($file, $imageBind);
		fclose($file);
		

	}
	public function  getImageCaptcha(){
		if(!$this->_isCreateImageCaptcha)
			$this->createImageCaptcha();
		header('Content-type: image/jpeg');
		readfile($this->_pathImage.$this->_imageName.'.jpg');
	}

	public function  getContent($url, $useCookie,$params,$fileCookie){

		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)');
		curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookie);
		if($useCookie)
		    curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookie);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if($params != null){
		    curl_setopt($ch, CURLOPT_POST,true);
		     curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		$string = curl_exec ($ch);  
		curl_close ($ch);
		return $string;
	}
	public function assignParams(){
		if($this->_documentType == 1){
			$this->_params['nuDni'] = $this->_document;
			$this->_params['imagen'] = $this->_codeCaptcha;
		}else{
			$this->_params['nroRuc'] = $this->_document;
			$this->_params['search1'] = $this->_document;
			$this->_params['codigo'] = $this->_codeCaptcha;
		}
	}

	public function getParams(){
		$this->assignParams();
		return $this->_params;
	}
	public function getHttpBuildParams(){
		$this->assignParams();
		$is = http_build_query($this->_params);

		if(!$is){
			return $this->_params;
		}else{
			return $is;
		}
	}

	public function getContentResponse(){
		$this->assignParams();
		$this->_params = http_build_query($this->_params);
		$responseContent = $this->getContent($this->_url,true,$this->_params,$this->_fileCookie);
		return $responseContent;
	}

	public function runQuery(){
		if($this->_documentType == 1 && !$this->_imageCaptcha){
			$responseContent = $this->getContentResponse();	
			$pattern1 = "(<td height=\"63\" class=\"style2\" align=\"center\">(.*)</td>)";
			$pattern2 = "(<td height=\"63\" class=\"style2\" align=\"center\">([\s\S]*)</td>)";
			$pattern3 = "(<br/>([\s\S]*)</td>)";
			if(preg_match_all($pattern1, $responseContent, $matches)){
				$this->_messageReponseContent =  $matches[1][0];
				$this->_errorResponseContent = 1;
			}else if(preg_match_all($pattern2, $responseContent, $matches)){

				if(preg_match_all($pattern3, $matches[1][0], $matches2)){
					$this->_messageReponseContent  = "El ".$this->_document.",no se encuentra en el Archivo Magnético del RENIEC";
					$this->_errorResponseContent = 2;
				}else{
					$arrayPreData = explode('<br>', $matches[1][0]);
				    $dataPerson = explode('                  ',trim($arrayPreData[0]));

				    if(count($dataPerson) == 3){
				      $names = $dataPerson[0];
				      $arrNames = explode(' ',$dataPerson[0]);
				     
				      $name1 = $arrNames[0];

				      $this->_name1 = utf8_encode($name1);

				      if(count($arrNames) > 2){
				      	$name2 = $arrNames[1];
				      	$name3 = $arrNames[2];
				      	$this->_name2 = utf8_encode($name2);
				      	$this->_name3 = utf8_encode($name3);
				      }else{
				      	$name2 =  $arrNames[1];
				      	$this->_name2 = utf8_encode($name2);
				      }
				      $surname1 = $dataPerson[1];
				      $surname2 = $dataPerson[2];

				      $this->_surname1 = utf8_encode($surname1);
				      $this->_surname2 = utf8_encode($surname2);

				      $this->_fullNames = trim($this->_name1.' '.$this->_name2.' '.$this->_name3.' '.$this->_surname1.' '.$this->_surname2);
				    }
				}
			}

		}else if($this->_documentType == 2 && !$this->_imageCaptcha){
			
			
			$responseContent =  $this->getContentResponse();	
			$pattern1 = "(<strong>([\s\S]*)</strong>)";
			$pattern2 = "(<p class=\"error\">([\s\S]*)</p>)";
			$pattern3 = "(<tr>([\s\S]*)</tr>)";
			$pattern4 = "(<td class=\"bg\" colspan=3>(.*)</td>)";
			$pattern5 =  "";

			if(preg_match_all($pattern1, $responseContent, $matches1)){
				$arrayPreData = $matches1[1][0];
  				$this->_errorResponseContent = 1;
  				$this->_messageReponseContent = utf8_encode($matches1[1][0]);

			}else if(preg_match_all($pattern2, $responseContent, $matches1)){

				$arrayPreData = $matches1[1][0];
  				$this->_errorResponseContent = 1;
  				$this->_messageReponseContent = utf8_encode($matches1[1][0]);

			}else if(preg_match_all($pattern3, $responseContent, $matches1)){
				
				#EXTRAENDO LA RAZON SOCIAL
				$array  = explode('Tipo Contribuyente:', $matches1[1][0]);
			    $array1 = explode(' - ', $array[0],2);
			    $array2 = explode('</td>',$array1[1]);
			    $businessName = trim($array2[0]);
	
			    $businessName = $businessName;
			    $this->_businessName = utf8_encode($businessName);

			    #EXTRAENDO LA RAZON SOCIAL
				$array  = explode('Tipo Contribuyente:', $matches1[1][0]);
			    $array1 = explode(' - ', $array[0],2);
			    $array2 = explode('</td>',$array1[1]);
			    $businessName = trim($array2[0]);
	
			    $businessName = $businessName;
			    $this->_businessName = utf8_encode($businessName);

			    #EXTRAENDO LA DOMICILIO FISCAL
			   if(preg_match_all($pattern4,$responseContent, $matches2)){
			   		$address = '';
			   		$previusAddress = $matches2[1][1];
			   		$countEmpty = 0;
			   		$arrEmpty =  array();
			   		for($i = 0;$i<strlen($previusAddress);$i++){
			   			if($previusAddress[$i] == ' '){
			   				$countEmpty++;
			   			}else{
			   				$countEmpty = 0;
			   			}	
			   			if($countEmpty == 1 || $previusAddress[$i] != ' ' ){
			   				$address = $address.$previusAddress[$i];
			   			}	
			   			
			   		}
			   		//$address = $matches2[1][1];
			   		//$arrAddress = explode('-',$matches2[1][1]);
			   		
			   		/*if(count($arrAddress)>3){
			   			$arrAddress = array_filter($arrAddress);

			   			$address = trim($arrAddress[4]).' - '.trim($arrAddress[5]).' - '.trim($arrAddress[6]);
			   		}else{
			   			$address = trim($arrAddress[0]).' - '.trim($arrAddress[1]).' - '.trim($arrAddress[2]);
			   		}*/
					
					$val = array("-----", "----", "---", "--");
					$this->_address = str_replace($val,'',utf8_encode($address));
			   }
			   #EXTRAENDO ESTADO Y CONDICION DEL CONTRIBUYENTE
			   	$array3  = explode('Estado del Contribuyente:', $matches1[1][0]);
			   	$array4 = explode('<td class="bg" colspan=1>', $array3[1]);
				$array5 = explode('</td>', $array4[1]);
				$this->_statusTaxPayer = trim($array5[0]);

				$array6 = explode('<td class="bgn"colspan=1>Condici&oacute;n del Contribuyente:</td>
              <td class="bg" colspan=3>', $matches1[1][0]);
				$array7 = explode('</td>', $array6[1]);
				$this->_conditionTaxPayer = trim($array7[0]);


				
			}

		}else{
			$this->getError(2);
		}
	}
	public function  getError($numberError){
		switch ($numberError) {
			case 1:
				# code...
				die('El tipo de documento no es correcto');
				break;
			case 2:
				die('Error de parametros asignados');
				break;
			default:
				# code...
				break;
		}
	}


}