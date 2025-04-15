<?php
 /*
 * Commentarios   : Clase Combo
 * Fecha Creacion : 25/01/2013
 * Creador por    : 
 * Actualización  :
 * Observación    : 
 * Ejemplo 		  : Uso de la clase Combo
<?php 
require_once("../../includes/combo.php")    ; 
$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "select tabla.a, tabla.b from tabla"; 
			$oCombo->value      = "a";
			$oCombo->text       = "b";
			$oCombo->size       = "150"; 
			$oCombo->name       = "cmbprueba";
			$oCombo->style      = "clase_del_combo"; 
			$oCombo->click      = "funcionprueba()";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
*/
	class CmbList
		{
			private $srv       ;
			private $usr       ;
			private $pwd       ;
			private $db        ;
			public  $dataSource;
			private $oMysqli   ;
			private $qRs       ;
			public  $value     ;
			public  $text      ;
			public  $size      ;
			public  $name	   ;
			public  $click     ;
			public  $dblclick  ;
			public  $style     ;
			public  $selected  ;
			public $cmbClick   ;
			
			function __construct()
				{
					$this->srv      = "localhost";
					$this->usr      = "root";
					$this->pwd      = "12345";
					$this->db       = "notarios";
					$this->oMysqli  = new MySQLi();
					$this->name     = "";
					$this->size     = "";
					$this->click    = "";
					$this->dblclick = "";
					$this->style    = "";
					$this->selected = "";
					$this->cmbClick = "";
				}
			function oCon()
				{
					$this->oMysqli->connect($this->srv,$this->usr,$this->pwd);
					if($this->oMysqli->connect_errno)
						{
							die("Error :".$this->oMysqli->connect_errno);
							exit;
						}
				}
			function oNumRows()
				{
					$this->oCon();
					$this->oMysqli->select_db($this->db);
					$result = $this->oMysqli->query($this->dataSource);
					return $result->num_rows;
				}	
			function Show()
				{
					$this->oCon();
					$this->oMysqli->select_db($this->db);
					$this->qRs = $this->oMysqli->query($this->dataSource);
					$cmb = "";
					$opt = "";
					$cmb = '<select title="seleccionar" style="width:'.$this->size.'px" name="'.$this->name.'" id="'.$this->name.'" onchange="'.$this->click.'" ondblclick="'.$this->dblclick.'" class="'.$this->style.'">';
						$opt = $opt .'<option value=""></option>';
					while($row = $this->qRs->fetch_array())
						{
							$valorSelect = $row[$this->value];
							$valorSelect = explode("|",$valorSelect);
							//if($row[$this->value]==$this->selected)
							if($valorSelect[0]==$this->selected)
								{
									//.htmlentities(trim($value), ENT_QUOTES).   selected="selected"
									$opt = $opt . '<option value="'.$row[$this->value].'" selected="selected">'.htmlentities(trim($row[$this->text]), ENT_QUOTES).'</option>';			
								}
							else
								{
									$opt = $opt . '<option value="'.$row[$this->value].'" >'.htmlentities(trim($row[$this->text]), ENT_QUOTES).'</option>';			
								}
						}
					$cmb = $cmb.$opt.'</select>';
					echo $cmb;
				}
			function oDesCon()
				{
					$this->qRs->free_result();
					$this->oMysqli->close();
				}
			function __destruct()
				{
				}
		}
?>