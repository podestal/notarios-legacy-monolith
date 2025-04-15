<?php
class OtorganteFilePdt{

	private $_vars = array();
	private $_kardex;
	private $_idKardex;

	public function  __construct(){
		$this->_vars = array('filaOtorgante','tipoKardex','numeroEscritura','fechaEscritura','numeroSecuencialActo','numeroSecuencialBien','numeroSecuencialOtorgante',
			'tipoDocumento','numeroDocumento','tipoOtorgante','tipoPersona','codigoHubicacion','porcetanjeParticipacion','razonSocial','apellidoPaterno','apellidoMaterno','primerNombre','segundoNombre','pregunta1','pregunta2','pregunta3');
		foreach ($this->_vars as $value) {
			# code...
			$this->_vars[$value] = new ItemClass();
			$this->_vars[$value]->setFileType('OTORGANTE');

		}
	}

	public function setIdKardex($value){
		$this->_idKardex = $value;
	}
	public function getIdkardex(){
		return $this->_idKardex;
	}
	public function setKardex($value){
		$this->_kardex = $value;
	}
	public function  getKardex(){
		return $this->_kardex;
	}

	

	

	public function setItem($item){
		$this->_vars[$item->getKeyItem()]->setItem($item);

	}

	public function  getItem($key){
		return $this->_vars[$key];
	}


}