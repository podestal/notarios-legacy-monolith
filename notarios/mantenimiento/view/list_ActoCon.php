<?php
require_once("../includes/gridView.php")  ;
$Grid1 = new GridView()					  ;

				$_epublic = $_POST["_epublic"];
				$val      = $_POST["val"]     ;
				
				$hasta = 20;
				
				if($val=="ini") 
				{
					$Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";	
				}		
					else if($val=="1") // escrituras publicas 
					{
							if($_epublic=='1')
							{
								$Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar WHERE tipokar.idtipkar = '1' ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";	
							}
							else if($_epublic=='0')
							{
								$Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";
							}
					}
					else if($val=="2"){ // Asuntos no contenciosos
							if($_epublic=='1')
							{
								$Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar WHERE tipokar.idtipkar = '2' ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";	
							}
							else if($_epublic=='0')
							{
								$Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";	
							}
					}
					else if($val=="3"){ // Transferencias vehiculares
							if($_epublic=='1')
							{
								 $Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar WHERE tipokar.idtipkar = '3' ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";
							}
							else if($_epublic=='0')
							{
								 $Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";
							}
					}
					else if($val=="4"){ // Garantias mobiliarias
							if($_epublic=='1')
							{
								 $Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar WHERE tipokar.idtipkar = '4' ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";
							}
							else if($_epublic=='0')
							{
								 $Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";
							}
					}
					else if($val=="5"){ // Testamentos
							if($_epublic=='1')
							{
							 	 $Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar WHERE tipokar.idtipkar = '5' ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";
							}
							else if($_epublic=='0')
							{
								 $Grid1->DataSource= "SELECT actocondicion.idcondicion as 'ID',tiposdeacto.desacto AS 'Descripcion' , actocondicion.condicion AS 'Condicion', actocondicion.parte AS 'Parte', actocondicion.uif AS 'UIF', actocondicion.formulario, actocondicion.idtipoacto , actocondicion.montop
FROM actocondicion INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto INNER JOIN tipokar ON tipokar.idtipkar = tiposdeacto.idtipkar ORDER BY tiposdeacto.desacto, actocondicion.condicion ASC";
							}
					}

                //echo $Grid1->DataSource;
				$Grid1->name      = "gridActos"            ;
                $Grid1->cssPar    = "GridPar"              ; 
                $Grid1->cssImp    = "GridImp"              ;
                $Grid1->cssCab    = "GridCab"              ;
                $Grid1->click     = "fShowDetail(this)"    ; 
                #$Grid1->dblclick  = "fShowDetail(this)"   ;
				$Grid1->paginar   = "Si"				  ; 
                $Grid1->posPag    = "1"                    ;
				$Grid1->width     = "100%"                 ;
				$Grid1->border     = 1                 ;
				$Grid1->NumFields = 4                      ;
				$Grid1->botonModi = "Si"		           ;
				$Grid1->modiClick = "editacto();"	   ;
				$Grid1->botonElim   = "Si"			   ;
				$Grid1->elimClick = "fElimCondicion();"   ;
			    #$Grid1->despuesElim = "fDisMonto(numFil);"   ;
				$Grid1->Show()                             ; 
                $Grid1->fDesCon()						   ;
 ?>