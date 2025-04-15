<?php

class ActFilePdt{

	private $_tipoKardex;
	private $_numeroEscritura;
	private $_fechaEscritura;
	private $_fechaConclusion;
	private $_fechaLegalizacion;
	private $_actoSunat;
	private $_secuencial;
	private $_moneda;
	private $_importe;
	private $_plazoInicial;
	private $_plazoFinal;
	private $_nombreContrato;
	private $_fechaInscripcionMinuta;
	private $_exibioMedioPago;

	private $_vars = array();
	
	private $_kardex;
	private $_idKardex;


	
	public function  __construct(){
		$this->_vars = array('tipoKardex','numeroEscritura','fechaEscritura','fechaConclusion','fechaLegalizacion',
			'actoSunat','secuencial','moneda','importe','plazoInicial','plazoFinal','nombreContrato','fechaInscripcionMinuta',
			'exibioMedioPago');
		foreach ($this->_vars as $value) {
			# code...
			$this->_vars[$value] = new ItemClass();
			$this->_vars[$value]->setFileType('ACTO');

		}
		/*$this->_tipoKardex = new ItemClass();
		$this->_numeroEscritura = new itemClass();
		$this->_fechaEscritura = new itemClass();
		$this->_fechaConclusion = new ItemClass();
		$this->_fechaLegalizacion = new ItemClass();
		$this->_actoSunat = new ItemClass();
		$this->_secuencial = new itemClass();
		$this->_moneda = new ItemClass();
		$this->_importe = new ItemClass();
		$this->_plazoInicial = new ItemClass();
		$this->_plazoFinal = new ItemClass();
		$this->_fechaInscripcionMinuta = new ItemClass();
		$this->_exibioMedioPago = new ItemClass();*/

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

	/*public function validationTipoKardex($item){
		$this->_tipoKardex->setItem($item);
	}*/

	public function validationsItems(){

		#Validando tipo de kardex


		#Validando  numero de escritura
		$numeroEscritura = (int) $this->_vars['numeroEscritura']->getItemValue();
		if($numeroEscritura == 0){
			$this->_vars['numeroEscritura']->setErrorItem('Numero de escritura no puedo ser cero');
		}
		#Validando fecha de escritura

		#Validando la fecha de conclusion
		$fechaEscritura =  $this->_vars['fechaEscritura']->getItemValue();
		$arrFechaEscritura = explode('-', $fechaEscritura);
		$intFechaEscritura = intval($arrFechaEscritura[2].$arrFechaEscritura[1].$arrFechaEscritura[0]);


		$fechaConclusion = $this->_vars['fechaConclusion']->getItemValue();
		$arrFechaConclusion = explode('/', $fechaConclusion);
		$intFechaConclusion = intval($arrFechaConclusion[2].$arrFechaConclusion[1].$arrFechaConclusion[0]);

		if($intFechaConclusion<$intFechaEscritura){
			$this->_vars['fechaConclusion']->setErrorItem('La fecha de conclusion no puede ser menor que la fecha de escritura.');
		}
		#Validando la fecha de la inscripcion de la minuta
		$fechaInscripcionMinuta =  $this->_vars['fechaInscripcionMinuta']->getItemValue();
		$arrFechaInscripcionMinuta = explode('-', $fechaInscripcionMinuta);
		$intFechaInscripcionMinuta = intval($arrFechaInscripcionMinuta[2].$arrFechaInscripcionMinuta[1].$arrFechaInscripcionMinuta[0]);
		if($intFechaEscritura<$intFechaInscripcionMinuta){
			/*$this->_vars['fechaConclusion']->setSQL("UPDATE patrimonial SET nminuta = '$fechaEscritura' WHERE kardex = '' AND item = '' ");*/
			$this->_vars['fechaConclusion']->setErrorItem('La fecha de inscripcion de la minuta  puede ser mayor que la fecha de escritura.');
		}

		/*foreach ($this->_vars as  $item) {
			# code...
			switch ($item->getKeyItem()) {
				case 'tipoKardex':
					# code...
					break;

				case 'numeroEscritura':
					


					break;
				
				default:
					# code...
					break;
			}


		}*/



	}
	public function getItems(){
		return $this->_vars;
	}

	



}