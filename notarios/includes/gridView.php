<?php
 /*
 * Commentarios   : Clase para la construccion de Grid View
 * Fecha Creacion : 15/12/2011
 * Creador por    : carlos llontop
 * Actualización  :
 * Observación    : Se debe incluir las siguientes librerias en la pagina que contendrá el Grid,
 se muestra un ejemplo:
<link href="../../includes/Css/scrollableFixedHeaderTable.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../../includes/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../includes/js/jquery.cookie.pack.js"></script>
<script type="text/javascript" src="../../includes/js/jquery.dimensions.min.js"></script>
<script type="text/javascript" src="../../includes/js/jquery.scrollableFixedHeaderTable.js"></script>

 *  Ejemplo :
<?php 
 require_once("../includes/gridView.php")     ;
 $Grid1 = new GridView();
*/
	class GridView
	{
		private $srv        ;
		private $db         ;
		private $usr        ;
		private $pwd        ;
		private $oMySQLi    ;
		public  $DataSource ;
		public  $name       ;
		public  $cssPar     ;
		public  $cssImp     ;
		public  $cssCab     ;
		public  $click      ;
		public  $dblclick   ;
		public  $onmouseover;
		public  $onMouseOut1;
		public  $onMouseOut2;
		public  $paginar    ;
		public  $numPag     ;
		public  $txtpag;
		public  $btnpag;
		private $qRs        ;
		public  $numReg     ;
		public  $width      ;
		public  $border      ;
		public  $NumFields  ;
		public  $posPag     ;
		public  $height     ;
		public  $height2     ;
		private $js			;
		public  $botonElim  ;
		public  $botonModi  ;
		public  $elimClick  ;
		public  $modiClick  ;
		public  $despuesElim;
		public  $chkItem;
		public  $chkClick;
		public  $submit;
		
		function __construct()
			{
				$this->srv     = "localhost"      ;
				$this->usr     = "root"           ;
				$this->pwd     = "12345"          ;
				$this->db      = "notarios"       ;
				$this->oMySQLi = new MySQLi()     ;			
				$this->numReg  = 10               ;
				$this->width   = "";
				$this->border   = "";
				$this->onmouseover = "";
				$this->onMouseOut1 = "";
				$this->onMouseOut2 = "";
				$this->txtpag      = "";
				$this->btnpag      = "";
				$this->click       = "";
				$this->dblclick    = "";
				$this->paginar     = "";
				$this->numPag      = "1";
				$this->NumFields   =  0;
				$this->posPag      = "0";
				$this->height      = "0";
				$this->height2      = "";
				$this->botonElim   = "";
				$this->elimClick   = "";
				$this->despuesElim = "";
				$this->chkItem     = "";
				$this->chkClick	   = "";
				$this->submit	   = "";
				$this->thisform	   = "";
			}
		
		private function fCon()
			{
				$this->oMySQLi->connect($this->srv,$this->usr,$this->pwd);
				if($this->oMySQLi->connect_errno)
					{
						die("Error :".$this->oMySQLi->connect_errno);
						exit();
					}
			}
			
		function Show()
			{
				$this->fCon();
				$this->oMySQLi->select_db($this->db);
				$this->qRs = $this->oMySQLi->query($this->DataSource);
				$Cols = $this->qRs->field_count;
				$th    = "";
				$tr    = "";
				$td    = "";
				$fil   = "";
				$numFil= 1;
				$fields = $this->qRs->fetch_fields();
				$num = 0;
				$this->js = ' <style>
								.'.$this->name.' {
								background-color: WHITE;font-size: 10px;}
								.'.$this->name.' .header td {font-weight: bold;
								background-color: #CCCCCC;}
							 </style>';
				//$th = '<td>&nbsp; :3</td>';
				$columns = 0;
				foreach($fields as $xfield)
					{
						if($this->NumFields==0)
						{
							$th = $th.'<td class="'.$this->cssCab.'" id="C'.$columns.'">'.$xfield->name.'</td>';
							}
						else
						{
						if($num<=$this->NumFields && $this->NumFields>0)
							{
								$th = $th.'<td bgcolor="#CCCCCC" class="'.$this->cssCab.'" id="C'.$columns.'">'.$xfield->name.'</td>';
								
							}
						$num++;
						}
						$columns++;
					}
					if($this->botonModi!=""){
					$th = $th.'<td bgcolor="#CCCCCC" class="'.$this->cssCab.'" colspan="2">Mantenimiento</td>';
					}
				while ($row = $this->qRs->fetch_array(MYSQLI_BOTH))
					{
						if($numFil % 2 == 0)
							{
							$tr = '<tr class="'.$this->cssPar.'" onclick="'.$this->click.';$focus(this);" ondblclick="'.$this->dblclick.'" onmouseover="'.$this->onmouseover.'" id="'."f".$numFil.'" name="'."f".$numFil.'" onMouseOut="'.$this->onMouseOut1.'" >';
							
							}
						else
							{
								$tr = '<tr class="'.$this->cssImp.'" onclick="'.$this->click.';$focus(this);" ondblclick="'.$this->dblclick.'" onmouseover="'.$this->onmouseover.'" id="'."f".$numFil.'" name="'."f".$numFil.'" onMouseOut="'.$this->onMouseOut2.'">';
							}
						
						$num = 0;	
						$xrow = "";
						// PARA HACER FOCUS A LA TABLA:
						
						//$td = $td. '<td id="tdButton'.$numFil.'" name="tdButton'.$numFil.'">';
						// <input type="text" id="txtfocus'.$numFil.'" name="txtfocus'.$numFil.'" style="background-color: transparent;border-width:0;width:1px" />
						
						if($this->chkItem!="")
							{
								$td = $td. '<input id="chk'.$numFil.'" name="chk'.$numFil.'" type="checkbox" onclick="'.$this->chkClick.'" class="cursor" title="escoger"/>';
							}
						# BOTON ELIMINAR.
						# BOTON MODIFICAR.
						
						/*if($this->botonElim!="")
							{
								$td = $td. '<button id="btnEli'.$numFil.'" name="btnEli'.$numFil.'" title="eliminar" type="button" value="X"  onclick="fElimina('.$numFil.');"><img src="../../images/x.png" width="15" height="15" /></button>';
							}
						
						if($this->botonModi!="")
							{
								$td = $td. '<button id="b'.$numFil.'" name="b'.$numFil.'" title="modificar" type="button" value="..."  onclick="'.$this->modiClick.'"><img src="../../images/editar.png" width="15" height="15" class="btnMod" /></button>';
							}*/
						//$td = $td. '</td>';
						for($i=0;$i<=$Cols;$i++)
							{
								$value = $row[$i];
								
								if(empty($value)){$value="";}
								if($this->NumFields==0)
									{
										$td = $td. '<td id="tdButton'.$numFil.'" name="tdButton'.$numFil.'">'.htmlentities(trim($value), ENT_QUOTES).'</td>';
										$xrow = $xrow .htmlentities(trim($value), ENT_QUOTES).'|';
									}
								else
									{	
									if($num<=$this->NumFields )
										{
											$td   = $td. '<td id="tdButton'.$numFil.'" name="tdButton'.$numFil.'">'.htmlentities(trim($value), ENT_QUOTES).'</td>';
											$xrow = $xrow .htmlentities(trim($value), ENT_QUOTES).'|';
										}
									else
										{
											$xrow = $xrow .htmlentities(trim($value), ENT_QUOTES).'|';	
										}
									$num++;
									}
							}
						//$td = $td. '</td>';
						
						# GUARDA LOS VALORES DE TODA LA FILA SEPARADOS POR EL CARACTER "|"
						
						//$td = $td.'<td><input type="hidden" id="datos'.$numFil.'" size="1" name="datos'.$numFil.'" value="'.$xrow.'"/></td>';
						
						if($this->botonModi!="")
							{
								$td = $td. '<td><a href="#" id="b'.$numFil.'" name="b'.$numFil.'" title="modificar"  value="..."  onclick="'.$this->modiClick.'"><img src="../../iconos/editamv.png" width="15" height="15" class="btnMod" /></a><input type="hidden" id="datos'.$numFil.'" size="1" name="datos'.$numFil.'" value="'.$xrow.'"/></td>';
							}
							
						if($this->botonElim!="")
							{
								$td = $td. '<td><a href="#" id="btnEli'.$numFil.'" name="btnEli'.$numFil.'" title="eliminar" value="X"  onclick="fElimina('.$numFil.');"><img src="../../iconos/eliminamv.png" width="15" height="15" /></a></td>';
							}					
						
						$fil = $fil.$tr.$td."</tr>";
						$tr="";
						$td="";
						$numFil++;
					}
				/*$pag = '<table align="center" class="'.$this->name.' style="width:'.$this->width.';"><tr ><td><button type="button" onclick="nameform(this);pagleft();" class="cur">pagina ant.</button></td><td colspan="23" align="center"><input type="hidden" name="txtFil" id="txtFil" value="'.$fila.'"/></td><td align="right"><button type="button" onclick="nameform(this);pagright();" class="cur">pagina sig.</button><input type="hidden" id="txtVer" name="txtVer" /></td></tr></table>';
				*/
				$pag = '';
				if(trim($this->paginar)!="")
					{
						if(trim($this->posPag)=="0")
							{
							$table ='<input type="hidden" name="txtFil" id="txtFil" value="'.$fila.'"/><table name="'.$this->name.'" id="'.$this->name.'" style="width:'.$this->width.';height:'.$this->height2.'" class="'.$this->name.' scrollableFixedHeaderTable" border="'.$this->border.'" ><tr>'.$th.'</tr>'.$fil.'</table>'.$pag;
							}
						else
							{
							$table ='<input type="hidden" name="txtFil" id="txtFil" value="'.$fila.'"/><table name="'.$this->name.'" id="'.$this->name.'" style="width:'.$this->width.'" class="'.$this->name.' scrollableFixedHeaderTable"  border="'.$this->border.'" class="'.$this->name.' scrollableFixedHeaderTable" >'.'<tr>'.$th.'</tr>'.$fil.'</table>'.$pag;									
							}
					}
					else
					{
						$table = '<input type="hidden" name="txtFil" id="txtFil" value="'.$fila.'"/><table name="'.$this->name.'" id="'.$this->name.'"  border="'.$this->border.'" style="width:'.$this->width.'" class="'.$this->name.' scrollableFixedHeaderTable"><tr>'.$th.'</tr>'.$fil.'</table>';
					}
				
				
				$script = '<input type="hidden" name="txtNumRows" id="txtNumRows" /><input type="hidden" name="txtElimina" id="txtElimina" value=""/><br/> 
				<style type="text/css">.cur{cursor:pointer;}</style>
				<script langueje="javascript">
					function nameform(obj)
					{
    	 					do {
				    		     obj=obj.parentNode;
					           } while(obj.tagName!="FORM");
					                 document.getElementById("txtVer").value=obj.name;
								     return false;
					}
				   function pagleft(){
						var fil = parseFloat(document.getElementById("txtpag").value);
						if(fil>1){
							fil=fil-1;
							document.getElementById("txtpag").value=fil;
							var _form = document.getElementById("txtVer").value;
							document.getElementById(_form).submit();}
						}
					function pagright(){
						var fil = parseFloat(document.getElementById("txtpag").value);
						if(fil>=1){
							fil=fil+1;
							document.getElementById("txtpag").value=fil;
							var _form = document.getElementById("txtVer").value;
							document.getElementById(_form).submit();}
						}
					function NumCheck(e, field) {
							key = e.keyCode ? e.keyCode : e.which
							// backspace
							if (key == 8) return true
							
							if(key==13){
									document.getElementById("bpag").focus();
										}
							// 0-9
							if (key > 47 && key < 58) {
							if (field.value == "") return true
							regexp = /.[0-9]{*}$/
							return !(regexp.test(field.value))
							}
							// .
							if (key == 46) {
							if (field.value == "") return false
							regexp = /^[0-9]+$/
							return regexp.test(field.value)
												}
							// other key
							return false
							}
							
					
					function $GridData(_obj)
						{
							var _datos = document.getElementById("datos"+_obj.id.substr(1,3)).value;
							return _datos.split("|");
						}
					function $focus(_obj)
						{
							document.getElementById("txtFil").value = _obj.id.substr(1,10);	
						}
					
					function fElimina(numFil)
						{
							
							if(confirm("Eliminar registro??"))
							{
								'.$this->elimClick.'
								//document.getElementById("'.$this->name.'").deleteRow(numFil);
								//var filas=document.getElementById("txtNumRows").value;
								//document.getElementById("txtNumRows").value=filas-1;
								'.$this->despuesElim.'
							}
						}
				</script>'	;
				
				if($this->height=="0")
					{
					echo $this->js.$table.$script;
					}
				else
					{
					echo $this->js.$table.$script;	
					}
			}
			
		function __destruct()
				{
					foreach(get_object_vars($this) as $k=>$v)
						{
	    				unset($this->$k);
						}
				}
		
		function fDesCon()
			{
				$this->qRs->free_result();
				$this->oMySQLi->close();
			}
				
	}
?>