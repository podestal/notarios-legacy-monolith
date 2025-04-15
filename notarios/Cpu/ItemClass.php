<?php 

class ItemClass{

	private  $_keyItem;
	private  $_valueItem;
	private  $_nameItem;
	private  $_errorItem;
	private  $_sql;
	private  $_paramsSQL = array();
	private  $_error;
	private  $_kardex;
	private  $_idKardex;
	private  $_valueRemplace;
	private  $_categoryCorrect;
	private  $_act;
	private  $_fileType;
	private  $_typeAct;
	private  $_itemMp;
	private  $_writingDate;
	private  $_numberFile;
	private $_typeOfCorrection;
	private $_isCorrectable;
	private $_idContractor;
	private $_bookNumber;



	public function __construct(){
		$this->_keyItem = '';
		$this->_valueItem = '';
		$this->_nameItem = '';
		$this->_errorItem = '';
		$this->_error = 0;
		$this->_idKardex = 0;
		$this->_valueRemplace = '';
		$this->_categoryCorrect = 0;
		$this->_typeAct = 0;
		$this->_itemMp = 0;
		$this->_typeOfCorrection = 0;
		$this->_isCorrectable = 0;
		$this->_numberFile = 0;
		$this->_writingDate = '';
		$this->_idContractor = 0;
		$this->_bookNumber = 0;
		$this->_kardex = '';
	}

	public function  setIdKardex($value){
			$this->_idKardex = $value;
	}
	public function getIdKardex(){
		return $this->_idKardex;
	}

	public function setKardex($value){
		$this->_kardex = $value;
	}
	public function  getKardex(){
		return $this->_kardex;
	}

	public function setKeyItem($value){
		$this->_keyItem = $value;
	}
	public function getKeyItem(){
		return $this->_keyItem;
	}
	public function setItemValue($value){
		$this->_valueItem = $value;
	}
	public function getItemValue(){
		return $this->_valueItem;
	}
	public function setErrorItem($value){
		$this->_errorItem = $value;
	}
	public function  getErrorItem(){
		return $this->_errorItem;
	}
	public function setItem($objItem){
		$this->_keyItem = $objItem->getKeyItem();
		$this->_valueItem = $objItem->getValueItem();
		$this->_errorItem = $objItem->getErrorItem();
	}

	public function setSQL($value){
			$this->_sql = $value;
	}
	public function getSQL(){
		return $this->_sql;
	}

	public function setError($value){
		$this->_error  = $value;
	}
	public function isError(){
		return $this->_error != 0?true:false; 
	}
	public function  pushParams($value){
		$this->_paramsSQL[] = $value;
	}
	public function  setValueRemplace($value){
			$this->_valueRemplace = $value;
	}
	public function getValueRemplace(){
		return $this->_valueRemplace;
	}

	public function setCategoryCorrect($value){
			$this->_categoryCorrect = $value;
	}
	public function  getCategoryCorrect(){
		return $this->_categoryCorrect;
	}

	public function  setAct($value){
		$this->_act = $value;
	}
	public function  getAct(){
		return $this->_act;
	}

	public function  setFileType($value){
		$this->_fileType = $value;
	}
	public function  getFileType(){
		return $this->_fileType;
	}
	public function  setTypeAct($value){
		$this->_typeAct = $value;
	}
	public function  getTypeAct(){
		return $this->_typeAct;
	}
	public function  setItemMp($value){
		$this->_itemMp = $value;
	}
	public function  getItemMp(){
		return $this->_itemMp;
	}
	public function  setTypeOfCorrection($value){
		$this->_typeOfCorrection = $value;
	}
	public function  getTypeOfCorrection(){
		return $this->_typeOfCorrection;
	}
	public function  setIsCorrectable($value){
		$this->_isCorrectable = $value;
	}
	public function  isCorrectable(){
		return $this->_isCorrectable;
	}
	public function  setNumberFile($value){
		$this->_numberFile = $value;
	}
	public function  getNumberFile(){
		return $this->_numberFile;
	}
	public function  setWritingDate($value){
		$this->_writingDate = $value;
	}
	public function  getWritingDate(){
		return $this->_writingDate;
	}
	public function  setIdContractor($value){
		$this->_idContractor = $value;
	}
	public function  getIdContractor(){
		return $this->_idContractor;
	}
	public function  setBookNumber($value){
		$this->_bookNumber = $value;
	}
	public function  getBookNumber(){
		return $this->_bookNumber;
	}

}