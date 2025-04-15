<?php

class ItemRoClass{

	private  $_itemNumber;
	private  $_itemNumberError;
	private  $_elementValue;
	private  $_descriptionElementValue;
	private  $_descriptionElement;
	private  $_codeElement;
	private  $_elementLength;
	private  $_moduleCode;
	private  $_idKardex;
	private  $_kardex;
	private  $_dataType;
	private  $_detailsError;
	private  $_rowType;
	private  $_errorLevel;
	private  $_act;
	private  $_isCorrectable;
	private $_idContractor;
	private $_typeOfCorrection;
	private  $_categoryCorrect;


	public function __construct($itemNumber  = 0){
		$this->_itemNumber = $itemNumber;
		$this->_elementValue = null;
		$this->_descriptionElement = null;
		$this->_descriptionElementValue = null;
		$this->_codeElement = 0;
		$this->_elementLength = 0;
		$this->_moduleCode = 0;
		$this->_kardex = null;
		$this->_dataType = 0;
		$this->_rowType = 1;
		$this->_itemNumberError = 0;
		$this->_detailsError = '';
		$this->_errorLevel = 1;
		$this->_act = null;
		$this->_isCorrectable = 0;
		$this->_idContractor = 0;
		$this->_typeOfCorrection = 0;
		$this->_categoryCorrect = 0;
	}

	public function  setItemNumber($value){
		$this->_itemNumber = $value;
	}
	public function  getItemNumber(){
		return $this->_itemNumber;
	}

	public function  setItemNumberError($value){
		$this->_itemNumberError = $value;
	}
	public function  getItemNumberError(){
		return $this->_itemNumberError;
	}

	public function  setElementValue($value){
		$this->_elementValue = $value;
	}

	public function  getElementValue(){
		return $this->_elementValue;
	}

	public function  setDescriptionElementValue($value){
		$this->_descriptionElementValue = $value;
	}
	public function  getDescriptionElementValue(){
		return $this->_descriptionElementValue;
	}

	public function setDescriptionElement($value){
		$this->_descriptionElement = $value;
	}

	public function getDescriptionElement(){
		return $this->_descriptionElement;
	}

	public function setCodeElement($value){
		$this->_codeElement = $value;
	}

	public function getCodeElement(){
		return $this->_codeElement;
	}

	public function setElementLength($value){
		$this->_elementLength = $value;
	}

	public function getElementLength(){
		return $this->_elementLength;
	}

	public function setModuleCode($value){
		$this->_moduleCode = $value;
	}

	public function getModuleCode(){
		return $this->_moduleCode;
	}

	public function setIdKardex($value){
		$this->_idKardex = $value;
	}

	public function getIdKardex(){
		return $this->_idKardex;
	}
	public function setKardex($value){
		$this->_kardex = $value;
	}
	public function getKardex(){
		return $this->_kardex;
	}

	public function setDataType($value){
		$this->_dataType = $value;
	}

	public function getDataType(){
		return $this->_dataType;
	}

	public function setRowType($value){
		$this->_rowType = $value;
	}

	public function getRowType(){
		return $this->_rowType;
	}

	public function  setDetailsError($value){
		$this->_detailsError = $value;
	}
	public function  getDetailsError(){
		return  $this->_detailsError;
	}

	public function  setAct($value){
		$this->_act = $value;
	}
	public function  getAct(){
		return $this->_act;
	}

	public function  setIsCorrectable($value){
		$this->_isCorrectable = $value;
	}
	public function  isCorrectable(){
		return $this->_isCorrectable;
	}
	public function  setTypeOfCorrection($value){
		$this->_typeOfCorrection = $value;
	}
	public function  getTypeOfCorrection(){
		return $this->_typeOfCorrection;
	}
	public function  setIdContractor($value){
		$this->_idContractor = $value;
	}
	public function  getIdContractor(){
		return $this->_idContractor;
	}
	public function setCategoryCorrect($value){
			$this->_categoryCorrect = $value;
	}
	public function  getCategoryCorrect(){
		return $this->_categoryCorrect;
	}

}