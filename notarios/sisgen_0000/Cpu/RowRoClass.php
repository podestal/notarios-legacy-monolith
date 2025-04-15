<?php

class  RowRoClass{

	private  $_itemRo = array();


	public function __construct($arrRoDataField = array()){
		foreach ($arrRoDataField as   $row) {
			# code...
			$numberItem = $row['numberOfData'];
			$descriptionElement = $row['columnDescription'];
			$dataType = $row['numberDataType'];
			$elementLength = $row['columnLength'];
			$codeElement = $row['columnCode'];
			$this->_itemRo[$numberItem] = new  ItemRoClass($numberItem);
			$this->_itemRo[$numberItem]->setDescriptionElement($descriptionElement);
			$this->_itemRo[$numberItem]->setDataType($dataType);
			$this->_itemRo[$numberItem]->setElementLength($elementLength);
			$this->_itemRo[$numberItem]->setCodeElement($codeElement);
			
		}
		
	}
	public function getItemRoByNumber($numberItem){
		return $this->_itemRo[$numberItem];
	}



}