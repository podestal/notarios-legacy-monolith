<?php
require_once("../includes/gridView.php")  ;
$Grid1 = new GridView()					  ;

				$_epublic = $_POST["_epublic"];
				$val      = $_POST["val"];
				
				$hasta = 20;
				
				if($val=="ini") 
				{							
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
				}
				
				else if($val=="todos") // TODOS
				{	
					if($_epublic=='1')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
					}
					else if($_epublic=='0')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
					}
				}
				
				
						
				else if($val=="1") // escrituras publicas 
				{	
					if($_epublic=='1')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto WHERE tiposdeacto.idtipkar='1' ORDER BY tiposdeacto.desacto ASC";
					}
					else if($_epublic=='0')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
					}
				}

			else if($val=="2"){
				if($_epublic=='1')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto WHERE tiposdeacto.idtipkar='2' ORDER BY tiposdeacto.desacto ASC";
				}
				else if($_epublic=='0')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
					}
				}
			else if($val=="3"){
				if($_epublic=='1')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto WHERE tiposdeacto.idtipkar='3' ORDER BY tiposdeacto.desacto ASC";
				}
				else if($_epublic=='0')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
					}
				}
			else if($val=="4"){
				if($_epublic=='1')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto WHERE tiposdeacto.idtipkar='4' ORDER BY tiposdeacto.desacto ASC";
				}
				else if($_epublic=='0')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
					}
				}
			else if($val=="5"){
				if($_epublic=='1')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto WHERE tiposdeacto.idtipkar='5' ORDER BY tiposdeacto.desacto ASC";
				}
				else if($_epublic=='0')
					{					
				$Grid1->DataSource= "SELECT tiposdeacto.idtipoacto as 'ID', tiposdeacto.actosunat as 'SUNAT', tiposdeacto.actouif as 'UIF', tiposdeacto.idtipkar as 'ID.Kardex', tiposdeacto.desacto as 'Descripcion',
tiposdeacto.umbral as 'Umbral', tiposdeacto.impuestos as 'Impuestos', tiposdeacto.idcalnot as 'Idcalnot', tiposdeacto.idecalreg as 'Idcalreg', tiposdeacto.idmodelo as 'Idmodelo'
FROM tiposdeacto ORDER BY tiposdeacto.desacto ASC";
					}
				}

                //echo $Grid1->DataSource;
				$Grid1->name      = "gridActos"                ;
				$Grid1->border    = "5"              ; 
                $Grid1->cssPar    = "GridPar"              ; 
                $Grid1->cssImp    = "GridImpX"              ;
                $Grid1->cssCab    = "GridCab"              ;
                $Grid1->click     = "fShowDetail(this)"    ; 
                #$Grid1->dblclick  = "fShowDetail(this)"  ;
				$Grid1->paginar   = "Si"				  ; 
                $Grid1->posPag    = "1"                    ;
				$Grid1->width     = "100%"                 ;
				$Grid1->border     = 1                 ;
				$Grid1->NumFields = 5                      ;
				$Grid1->botonModi = "Si"		           ;
				$Grid1->modiClick = "editacto();"	   ;
				$Grid1->botonElim   = "Si"			   ;
				$Grid1->elimClick = "fElimTipActo();"   ;
			    #$Grid1->despuesElim = "fDisMonto(numFil);"   ;
				$Grid1->Show()                             ; 
                $Grid1->fDesCon()						   ;
 ?>