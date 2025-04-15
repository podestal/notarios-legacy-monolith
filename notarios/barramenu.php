<?php
/*
 * Commentarios   : Clase para la construccion de barra de menu
 * Fecha Creacion : 21/12/2011
 * Creador por    : carlos llontop
 * Actualización  :
 * Observación    : 
 * Ejemplo		  :
 
#==============================
<?php
require_once("../includes/class/barramenu.php");
$oBarra = new BarraMenu();
?>

<?php
		$oBarra->Nuevo      = "1"            ; # "" inactivo / "1" activos
		$oBarra->NuevoClick = "fNuevo();"    ; 
		$oBarra->Graba      = "1"            ;
		$oBarra->GrabaClick = "fGraba();"    ;
		$oBarra->Elimi      = "1"            ;
		$oBarra->ElimiClick = "fElimina();"  ;
		$oBarra->Busca      = "1"            ;
		$oBarra->itemBusca  = "a,b,c"		 ; # items del combo busqueda 		 
		$oBarra->BuscaClick = "fBusca()"     ;
	    $oBarra->onKeytxt   = "focus6(event)";
		$oBarra->clase      = "css"      	 ; # css de la barra
		$oBarra->widthtxt   = "50"			 ; # largo del txt de búsqueda
		$oBarra->Show()  					 ; 
?>
#============================== 
 
*/
	class BarraMenu
		{
			public $Nuevo        ;
			public $NuevoClick   ;
			public $Graba        ;
			public $GrabaClick   ;
			public $Elimi        ;
			public $ElimiClick   ;
			public $Anula        ;
			public $AnulaClick   ;
			public $Genera       ;
			public $GeneraClick  ;
			public $Impri        ;
			public $ImpriClick   ;
			public $Busca        ;
			public $Busca2       ;
			public $itemBusca    ;
			public $BuscaClick   ;
			public $xls          ;
			public $xlsClick     ;
			public $pdf          ;
			public $pdfClick     ;
			public $salir        ;
			public $salirClick   ;
			public $ayuda        ;
			public $ayudaClick   ;
			public $refresh		 ;
			public $refreshClick ;
			public $muestra      ;
			public $muestraClick ;
			public $css	         ;
			public $cmbClick     ;
			public $widthtxt     ;
			public $onKeytxt     ;
			public $parms;
		
			function __contruct()
				{
					$this->Nuevo        = "" ;
					$this->NuevoClick   = "" ;
					$this->Graba        = "" ;
					$this->GrabaClick   = "" ;
					$this->Elimi        = "" ;
					$this->ElimiClick   = "" ;
					$this->Anula        = "" ;
					$this->AnulaClick   = "" ;
					$this->Impri        = "" ;
					$this->ImpriClick   = "" ;
					$this->Genera       = "" ;
					$this->GeneraClick  = "" ;
					$this->Busca        = "" ;
					$this->Busca2       = "" ;
					$this->BuscaClick   = "" ;
					$this->xls          = "" ;
					$this->xlsClick     = "" ;
					$this->pdf          = "" ;
					$this->pdfClick     = "" ;
					$this->salir        = "" ;
					$this->salirClick   = "" ;
					$this->ayuda        = "" ;
					$this->ayudaClick   = "" ;
					$this->refresh      = "" ;
					$this->refreshClick = "" ;
					$this->muestra      = "" ;
					$this->muestraClick = "" ;
					$this->clase	    = "";
					$this->cmbClick     = "";
					$this->widthtxt     = "";
					$this->onKeytxt     = "";
					$this->parms 		= "";
			
				}
			
			function __destruct()
				{
				}
				
			function Show()
				{
					
					$barra = '<table class="'.$css.'">';
					$barra = $barra.'<tr>';
					if($this->Nuevo=="1"){$barra = $barra.'<td><button title="nuevo" type="button" name="Nuevo"    id="Nuevo"    value="Nuevo" onclick="'.$this->NuevoClick.'"   ><img src="images/new.png" width="17" height="17" align="absmiddle" /> Nuevo</button></td>';}
					if($this->Graba=="1"){$barra = $barra.'<td><button title="grabar" type="button" name="Grabar"   id="Grabar"   value="Grabar" onclick="'.$this->GrabaClick.'"   ><img src="images/save.png" width="17" height="17" align="absmiddle" /> Guardar</button></td>';}
					if($this->Anula=="1"){$barra = $barra.'<td><button title="anular" type="button" name="Anular"   id="Anular"   value="Anular" onclick="'.$this->AnulaClick.'"   ><img src="images/delete.png" alt="" width="15" height="15" align="absmiddle"/>Eliminar</button></td>';}
					
					if($this->Genera=="1"){$barra = $barra.'<td><button title="Generar" type="button" name="Generar"    id="Generar"    value="Generar" onclick="'.$this->GeneraClick.'"   ><img src="images/generate.png" width="17" height="17" align="absmiddle" /> Generar</button></td>';}
					
					if($this->Elimi=="1"){$barra = $barra.'<td><button title="eliminar" type="button" name="Elimi"    id="Elimi"    value="Eliminar" onclick="'.$this->ElimiClick.'"   ><img src="images/delete.png" width="17" height="17" align="absmiddle" /> Eliminar</button></td>';}
					
					
					
					if($this->Impri=="1"){$barra = $barra.'<td><button title="reporte" type="button" name="Imprim"   id="Imprim"   value="Imprimir" onclick="'.$this->ImpriClick.'" ><img src="images/print.png" width="17" height="17" align="absmiddle" /> Imprimir</button></td>';}
					
					if($this->refresh=="1"){$barra = $barra.'<td><button title="refrescar" type="button" name="Refresh"   id="Refresh"   value="Actualizar" onclick="'.$this->refreshClick.'" onFocus="'.$this->refreshClick.'" ><img src="images/refresh.png" width="15" height="15" /></button></td>';}
					if($this->xls  =="1"){$barra = $barra.'<td><input type="button" name="xls"      id="xls"      value="Exp. xls" class="buttonA" onclick="'.$this->xlsClick.'"     /></td>';}
					if($this->pdf  =="1"){$barra = $barra.'<td><input type="button" name="pdf"      id="pdf"      value="Exp. pdf"class="buttonA" onclick="'.$this->pdfClick.'"     /></td>';}
					if($this->salir=="1"){$barra = $barra.'<td><input type="button" name="salir"    id="salir"    value="Salir"  class="buttonA"  onclick="'.$this->salirClick.'"   /></td>';}
					if($this->ayuda=="1"){$barra = $barra.'<td><input type="button" name="ayuda"    id="ayuda"    value="Ayuda"  class="buttonA"  onclick="'.$this->ayudaClick.'"   /></td>';}
					if($this->muestra=="1"){$barra = $barra.'<td><button title="consultar" type="button" name="muestra"  id="muestra"  value="Mostrar" onclick="'.$this->muestraClick.'"><img src="images/search.png" width="15" height="15"/><br><font color="#003366" size="-3"><u>C</u>onsultar '.$this->parms.'</font></button></td>';}
					if($this->Busca=="1"){
					
					if(trim($this->itemBusca)!="")
						{
							$barra = $barra.'<td>&nbsp;<span style="font-family: Calibri; font-style: italic; font-size: 14px; color: #333333;">Busqueda por:</span>&nbsp;&nbsp;<select align="absbottom" id="cboBusca" name="cboBusca" value="0"  onchange="'.$this->cmbClick.'"><option></option>';
							$items = explode(",",$this->itemBusca);
							for($i=0;$i<= sizeof($items)-1;$i++)
								{
									$barra = $barra.'<option value="'.($i+1).'">'.$items[$i].' </option>';
								}
							$barra = $barra.'</select></td>'	;
						}
					}
					if($this->Busca2=="1"){
					###
					if(trim($this->itemBusca)!="")
						{
					$barra = $barra.'<td><input type="search" name="txtBuscar" onkeypress="'.$this->onKeytxt.'"  size="'.$this->widthtxt .'" id="txtBuscar" value="'.$_REQUEST["txtBuscar"].'"  placeholder="Buscar..."/></td><td><button class="cursor" align="absmiddle" title="buscar" type="button"  name="Buscar"   id="Buscar" value="Buscar"  onclick="'.$this->BuscaClick.'"  >
<img src="../../images/search.png" width="15" height="15" alt="" align="absmiddle"/></button></td>';
					###
						}
					}
					
					$barra = $barra.'<td><input type="hidden"   name="txtopc"    id="txtopc" />                                      </td>';
					$select = "0";
					if($_REQUEST["cboBusca"]!="")
						{
							$select = $_REQUEST["cboBusca"];
						}			
					$barra = $barra.'</tr>';
					$barra = $barra.'</table>';
					$script = "";
					if($this->Busca!= "")
						{
					$script = '<script language="javascript">
						document.getElementById("cboBusca").value ='.$select.' ;
					</script>';
						}
					echo $barra.$script;
				}
				
		}
?>
