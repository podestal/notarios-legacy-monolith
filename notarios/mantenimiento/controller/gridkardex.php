<?php 
//$idkardex=$_POST['idkardex'];
/*include('../../conexion.php');


$consulta = mysql_query("SELECT tipokar.idtipkar, tipokar.tipkar, tipokar.nomtipkar FROM tipokar", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){

echo"<table width='710' border='1'>
  <tr>
    <td width='50' valign='top'><span class='Estilo12'><a href='#' onmouseover='selectidkar(this.id)' onClick='selectidkar(this.id)' id='".$row['idtipkar']."|".$row['tipkar']."|".$row['nomtipkar']."'>".$row['idtipkar']."</a></span></td>
    <td width='71' valign='top'><span class='Estilo12'>".$row['tipkar']."</span></td>
    <td width='70' valign='top'><span class='Estilo12'>".$row['nomtipkar']."</span></td>
    <td width='16'><span class='Estilo12'><a href='#' onclick='editkar()'><img src='../../iconos/editamv.png' /></a></span></td>
	<td width='18'><span class='Estilo12'><a href='#' onclick='elimkar()'><img src='../../iconos/eliminamv.png' /></a></span></td>
  </tr>
</table>";
}*/

#= nueva clase :
	require_once("../includes/gridView.php")  ;
	$Grid1 = new GridView()					  ;
				$Grid1->numPag = $_REQUEST["txtpag"];
				#**********Para el focus **********#
				$fila 			= trim($_REQUEST["txtFil"]);
				if($fila==""){$fila="1";}
				#**********************************#
				if (trim($Grid1->numPag)=="")
					{
						$desde= 0;	
						$Grid1->numPag = 1;
					}
					else{ 
						$desde = ($Grid1->numPag-1)*100; 
					}
				$buscado = $_POST["txtBuscar"];
				$opc     = $_POST["cboBusca"]; 
				$hab=$_POST['txthab'];
	
				if($opc==""  ){$opc="0";   }
				if($hasta==""){$hasta="20";} 
				$hasta = 20;
								
				$Grid1->DataSource= "SELECT tipokar.idtipkar as 'Id. Kardex', tipokar.tipkar as 'Tip. Kardex', tipokar.nomtipkar as 'Descripcion' FROM tipokar";
                //echo $Grid1->DataSource;
				$Grid1->name      = "gridKardex"                ;
                $Grid1->cssPar    = "Estilo12"              ; 
                $Grid1->cssImp    = "Estilo12"              ;
                $Grid1->cssCab    = "GridCab"              ;
                $Grid1->click     = "fShowDetail(this)"    ; 
                #$Grid1->dblclick  = "fShowDetail(this)"  ;
				$Grid1->paginar   = "Si"				  ; 
                $Grid1->posPag    = "1"                    ;
				$Grid1->width     = "100%"                 ;
				$Grid1->border     = 1                 ;
				$Grid1->NumFields = 2                      ;
				$Grid1->botonModi = "Si"		           ;
				$Grid1->modiClick = "editkar();"	   ;
				$Grid1->botonElim   = "Si"			   ;
				#$Grid1->elimClick = "fElimItemGrid(numFil);return;"   ;
			    #$Grid1->despuesElim = "fDisMonto(numFil);"   ;
				$Grid1->Show()                             ; 
                $Grid1->fDesCon()						   ;
               
          	
?>