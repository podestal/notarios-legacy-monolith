<?php

class FormFilePdt{

	private $_vars = array();
	private $_kardex;
	private $_idKardex;

	public function  __construct(){
		$this->_vars = array('filaFormulario','tipoKardex','numeroEscritura','numeroSecuencialActo','numeroSecuencialOtorgante','tipoOtorgante',
			'numeroFormulario','pagoCuenta');
		foreach ($this->_vars as $value) {
			# code...
			$this->_vars[$value] = new ItemClass();
			$this->_vars[$value]->setFileType('FORMULARIO');

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