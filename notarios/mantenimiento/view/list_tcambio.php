<?php
require_once("../includes/gridView.php")  ;
$Grid1 = new GridView()					  ;

				$fecha_tcambio = $_POST["fecha_tcambio"];
				$val            = $_POST["val"]     ;
				
				if($fecha_tcambio == '')
				{
					$Grid1->DataSource= "SELECT DATE_FORMAT(tipocambio.tc_fecha,'%d/%m/%Y') AS 'FECHA', tc_dol AS 'T.C. DOLAR', tc_eur AS 'T.C. EURO', idtipocamb FROM tipocambio ORDER BY tipocambio.tc_fecha DESC";
				}
				if($fecha_tcambio != '')
				{
					$Grid1->DataSource= "SELECT DATE_FORMAT(tipocambio.tc_fecha,'%d/%m/%Y') AS 'FECHA', tc_dol AS 'T.C. DOLAR', tc_eur AS 'T.C. EURO', idtipocamb FROM tipocambio WHERE DATE_FORMAT(tipocambio.tc_fecha,'%Y-%m-%d') = STR_TO_DATE('$fecha_tcambio','%d/%m/%Y') ORDER BY tipocambio.tc_fecha DESC";
				}
				$Grid1->name      = "gridTCambio"           ;
                $Grid1->cssPar    = "GridPar"              ; 
                $Grid1->cssImp    = "GridImp"              ;
                $Grid1->cssCab    = "GridCab"               ;
                $Grid1->click     = "fShowDetail(this)"     ; 
				$Grid1->paginar   = "Si"				    ;  
                $Grid1->posPag    = "1"                     ;
				$Grid1->width     = "100%"                  ;
				$Grid1->border    = 1                       ;
				$Grid1->NumFields = 2  						;
				//$Grid1->botonModi = "Si"		            ;
				//$Grid1->modiClick = "editclie(this);"	    ;
				//$Grid1->botonElim = "Si"			        ;
				//$Grid1->elimClick = "fElimCondicion();"     ;
				$Grid1->Show()                              ; 
                $Grid1->fDesCon()						    ;
 ?>