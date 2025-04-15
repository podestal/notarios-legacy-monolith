<?php
require_once("../includes/gridView.php")  ;
$Grid1 = new GridView()					  ;
				$_epublic = $_POST["_epublic"];
				$val  = $_POST["val"];
				$hasta = 20;
								
if($_epublic == "ini") 
{					
				$Grid1->DataSource= "SELECT usuarios.idusuario,usuarios.loginusuario,usuarios.password,
CONCAT(usuarios.apepat,' ',usuarios.apemat,' ,',usuarios.prinom) AS 'Usuario',
usuarios.telefono
FROM usuarios";
}
else if($_epublic == "seg"){
	$Grid1->DataSource= "SELECT usuarios.idusuario,usuarios.loginusuario,
CONCAT(usuarios.apepat,' ',usuarios.apemat,' ,',usuarios.prinom) AS 'Usuario',
usuarios.telefono
FROM usuarios WHERE CONCAT(usuarios.apepat,' ',usuarios.apemat,' ,',usuarios.prinom) LIKE '%$val%'";
	}

                //echo $Grid1->DataSource;
				$Grid1->name      = "gridPedidos"   
;
                $Grid1->cssPar    = "GridPar"              ; 
                $Grid1->cssImp    = "GridImp"              ;
                $Grid1->cssCab    = "GridCab"               ;
                $Grid1->click     = "fShowDetail(this)"     ; 
                #$Grid1->dblclick  = "fShowDetail(this)"    ;
				$Grid1->paginar   = "Si"				    ; 
                $Grid1->posPag    = "1"                     ;
				$Grid1->width     = "100%"                  ;
				$Grid1->border     = 1                      ;
				$Grid1->NumFields = 4                       ;
				$Grid1->botonModi = "Si"		            ;
				$Grid1->modiClick = "editclie(this);"	    ;
				$Grid1->botonElim   = ""			        ;
				$Grid1->elimClick = "fElimItemClient();"    ;
			    #$Grid1->despuesElim = "fDisMonto(numFil);"   ;
				$Grid1->Show()                             ; 
                $Grid1->fDesCon()						   ;
 ?>