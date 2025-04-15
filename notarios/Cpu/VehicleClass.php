<?php

class VehicleClass {

	private $_licensePlate;
	private $_serialNumber;
	private $_engineNumber;
	private $_color;
	private $_mark;
	private $_model;
	private $_params = array();
	private $_fileCookie;
	private $_url;
	private $_messageReponseContent;
	private $_errorResponseContent;


	public function __construct($licensePlate){
		$this->_licensePlate = $licensePlate;
		$this->_serialNumber = '';
		$this->_engineNumber = '';
		$this->_color = '';
		$this->_mark = '';
		$this->_model = '';
		$this->_messageReponseContent = '';
		$this->_errorResponseContent = 0;
		$this->_url = 'https://m.sunarp.gob.pe/mobile/m_ConsultaVehicularResultado.aspx';
		$arrParams['TextLength'] = "8";
		$arrParams['Width'] = "200";
		$arrParams['Height'] = "40";
		$arrParams['FontFamily'] = "Arial";
		$arrParams['ForeColor'] = "-26368";
		$arrParams['BackColor'] = "-1";
		$arrParams['BrushFillerColor'] = "-1015680";
		$arrParams['TextBrush'] = "1";
		$arrParams['BackBrush'] = "1";
		$arrParams['LineNoise'] = "2";
		$arrParams['BackgroundNoise'] = "1";
		$arrParams['FontWarpLevel'] = "2";
		$arrParams['CharSet'] = "1;2;3;4;5;6;7;8;9;0;a;b;c;d;e;f;g;h;i;j;k;l;m;n;o;p;q;r;s;t;u;v;w;x;y;z";
		$this->_params['ctl00_MainContent_captch_cv_ClientState'] = json_encode($arrParams);
		$this->_params['_CurrentGuid_ctl00_MainContent_captch_cv'] = '425444675';
		$this->_params['__EVENTTARGET'] = '';
		$this->_params['__EVENTARGUMENT'] = '';
		$this->_params['__VIEWSTATE'] = '/wEPDwUJOTAwNTk2NzQ0D2QWAmYPZBYCAgMPZBYCAgEPZBYCAgEPZBYEAgMPZBYCAgEPZBYCZg9kFgICAQ8PFgQeBFRleHRlHgdWaXNpYmxlaGRkAgUPZBYGAgQPZBYCZg9kFgJmDw8WAh4KRm9udEZhbWlseQUFQXJpYWwWBB4Dc3JjBVAvbW9iaWxlL21fQ29uc3VsdGFWZWhpY3VsYXIuYXNweD9vYm91dGNhcHRjaGFndWlkPTE1OTAxMjcxNjgmd2lkdGg9MjAwJmhlaWdodD00MB4DYWx0ZWQCBg9kFgJmD2QWAmYPDxYCHwFoZGQCBw9kFgJmD2QWAgIBDw8WAh8BaGRkGAEFHl9fQ29udHJvbHNSZXF1aXJlUG9zdEJhY2tLZXlfXxYCBRtjdGwwMCRNYWluQ29udGVudCRjYXB0Y2hfY3YFG2N0bDAwJE1haW5Db250ZW50JGNhcHRjaF9jdmsmOnmlNL2VO68j0BAi4/kPfWUsqMj8ClCK87rfJNnf';
		$this->_params['__VIEWSTATEGENERATOR'] = '17FC25E2';
		$this->_params['__PREVIOUSPAGE'] = 'CGolXNipllt7008RVjwRwVUPsJjzqakvftncQWB1YeLs4pQ9sAhI_I1iJ7OcuG9KxT707ObZH6YVUeOqlA8QGEIneeQuFyaDWZMLa-waidWfhGg_gNR16evOBOG3fmM30';
		$this->_params['__EVENTVALIDATION'] = '/wEdAASOssWJsiagPFLLJWgmnm3c59mJmXNO3y9sk6D61NuALCn6OpuFFlvdwEvkvuq15aT53d8HLcsMPPSWw23i74K4/q7dgrtzjLZro6IKAeGSK/7aYhJW35mSKxTX2fdnHK0=';
		$this->_params['ctl00$MainContent$txtNoPlac'] = '';
		$this->_params['ctl00$MainContent$txtCaptcha'] = '28uhnag4';
		$this->_params['ctl00$MainContent$Button1'] = 'Buscar';

	}
	public function setLicensePlate($value){
		$this->_licensePlate = $value;
	}

	public function  getLicensePlate(){
		return $this->_licensePlate;
	}
	public function getSerialNumber(){
		return $this->_serialNumber;
	}
	public function  getEngineNumber(){
		return $this->_engineNumber;
	}

	public function  getColor(){
		return $this->_color;
	}

	public function getMark(){
		return $this->_mark;
	}
	public function getModel(){
		return $this->_model;
	}

	public function setFileCookie($value){
		$this->_fileCookie = $value;
	}
	public function getErrorResponseContent(){
		return  $this->_errorResponseContent;
	}
	public function getMessageReponseContent(){
		return $this->_messageReponseContent;
	}
	public function assignParams(){
		$this->_params['ctl00$MainContent$txtNoPlac'] = $this->_licensePlate;
	}
	public function getParams(){
		$this->assignParams();
		return $this->_params;
	}

	public function getContentResponse(){
		$this->assignParams();
		$this->_params = http_build_query($this->_params);
		$responseContent = $this->getContent($this->_url,true,$this->_params,$this->_fileCookie);
		return $responseContent;
	}

	public function  runQuery(){
		$responseContent = $this->getContentResponse();	
		$patternSerialNumber = '|<span id="MainContent_lblNoSeri">(.*?)</span>|is';
		$patternEngineNumber = '|<span id="MainContent_lblNoMotr">(.*?)</span>|is';
		$patternColor = '|<span id="MainContent_lblColr">(.*?)</span>|is';
		$patternMark = '|<span id="MainContent_lblMarca">(.*?)</span>|is';
		$patternModel = '|<span id="MainContent_lblModelo">(.*?)</span>|is';
		$patternTime = '|<span id="MainContent_lblMensaje2" style="font-size:Small;font-weight:bold;">(.*?)</span>|is';

		if(preg_match($patternTime, $responseContent,$matches1)){
				$this->_messageReponseContent = ($matches1[1]);
				$this->_errorResponseContent = 1;
		}else{
			if(preg_match($patternSerialNumber, $responseContent, $matches1)){
				$this->_serialNumber = $matches1[1];
			}
			if(preg_match($patternEngineNumber, $responseContent, $matches1)){
				$this->_engineNumber = $matches1[1];
			}
			if(preg_match($patternColor, $responseContent, $matches1)){
				$this->_color = $matches1[1];
			}
			if(preg_match($patternMark, $responseContent, $matches1)){
				$this->_mark = $matches1[1];
			}
			if(preg_match($patternModel, $responseContent, $matches1)){
				$this->_model = $matches1[1];
			}
		}
		
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

	public function  getError($numberError){
		switch ($numberError) {
			case 1:
				# code...
				return $this->_messageReponseContent;
			break;

		}
	}


}