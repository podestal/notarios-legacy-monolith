<?php
	require_once("../includes/barramenu.php") ;
	require_once("../includes/gridView.php")  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Mantenimiento kardex</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link href="../includes/scrollableFixedHeaderTable.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/jquery.scrollableFixedHeaderTable.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>
<style type="text/css">
<!--
#title_client{
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;	
}
div.frmclientes
{ 
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:820px; height:750px;
}

.submenutitu {
	font-family: Calibri;
	font-size: 18px;
	font-style: italic;
	color:#FF9900;
}
#frmclientes{
	padding-bottom:0px;
	margin-bottom:0px;
	}
<!-- ini table -->
.GridPar
{
	border:0px #036;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#D6F3D8;
}
.GridImp
{
	border:0px #036;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#DADADA;
}
.GridCab
{
	font-size:17px;
	font-weight:bold;
}
<!-- end table -->

.line {color: #FFFFFF}
.titulosprincipales {	font-family: Calibri;
	font-size: 14px;
	color: #FF9900;
	font-style: italic;
}

.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; cursor:pointer; }
-->
</style>
<script type="text/javascript">
$(document).ready(function(){ 

	$("#frmtipkar").dialog({height:400, width:740,position :["center","top"], style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Tipos de Kardex'}); 
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	})

	function muesdatos() { muestragrid(); }

	function selectidkar(id) { document.getElementById('datos').value = id; }

	function fShowDetail(obj)
			{
				var _id = obj.cells[0].innerHTML;
				var _gridView = document.getElementById('gridKardex');
				var _rows  = _gridView.rows.length;
				for(i=1;i<=_rows-1;i++)
					{
						if(i%2==0)
							{
								_gridView.rows[i].style.backgroundColor = '#FFFFFF';
							}
						else
							{
								_gridView.rows[i].style.backgroundColor = '#FFFFFF';
							}
					}
	
				    obj.style.backgroundColor = '#656F8C'; 
				
				    var fil=obj.id;
				    document.getElementById('txtfilas').value=fil;
	
					_datos =  $GridData(obj);
					document.getElementById('idkardex').value = _datos[0];
					document.getElementById('tipkar').value = _datos[1];
					document.getElementById('nomtipkar').value = _datos[2];
			}


	function editkar(){
		var _idkar = document.getElementById('idkardex').value;	
		var _tipkar = document.getElementById('tipkar').value;	
		var _nomtipkar = document.getElementById('nomtipkar').value;	 				 
		
		$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/EditKarCon.php?idkar='+_idkar+'&tipkar='+_tipkar+'&nomtipkar='+_nomtipkar+'"/>').dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 420,
						height  : 160,
						modal:false,
						resizable:false,
						title:'Editar tipo de Kardex'
						}).width(420).height(160);	
		}
	
	function agregar(){
		$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/NewKarCon.php"/>').dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 420,
						height  : 160,
						modal:false,
						resizable:false,
						}).width(420).height(160);	
		}

	function focusSearch(evento) {if(evento.keyCode==13){document.getElementById('Buscar').focus();}} 
	
	function frefresh(){ window.location.reload(); }

	function cerrar2(){    $("#frmtipkar").dialog("close");	}	
</script>
</head>

<body>
<div id="frmtipkar" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:600px;">
<table id="title_client" width="100%" bgcolor="#264965" bordercolor="#264965" cellpadding="0" cellspacing="0">
 <tr>
<td width="36" height="28" align="center" bgcolor="#264965"><img src="../../iconos/nuevo2.png" width="20" height="22" /></td>
              <td width="745" bgcolor="#264965"><span class="submenutitu">Mantenimiento de Tipos de Kardex</span></td>
              <td width="28" bgcolor="#264965"><a  onClick="cerrar2()" id="btncerrar" href="#"><img id="btncerrar" src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
            </tr>
            <tr></tr>
</table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="19">
      				  <input name="datos" id="datos" type="hidden" />
      				  <input name="idkardex" id="idkardex" type="hidden" />
      				  <input name="tipkar" id="tipkar" type="hidden" />
                      <input name="nomtipkar" id="nomtipkar" type="hidden" />
                      <input name="txtbuscar" id="txtbuscar" type="hidden" />
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
    <form id="frmescri" name="frmescri" method="post" action="">
    <input type="hidden" id="txtfilas" name="txtfilas" value="" />
            <table width="834" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><span class="Estilo7">
                <?php
				$oBarra->Nuevo      = "1"           	  ; 
				$oBarra->NuevoClick = "agregar();"   	  ; 
				$oBarra->refresh      = "1"          	  ;
				$oBarra->refreshClick = "frefresh();"   	  ;
				//$oBarra->Graba      = "1"          		  ;
				//$oBarra->GrabaClick = "fGraba();"   	  ;
				//$oBarra->Elimi      = "1"           	  ;
				//$oBarra->ElimiClick = "fElimina();"  	  ;
				//$oBarra->Busca      = "1"           	  ;
				//$oBarra->itemBusca  = "Descripcion"			  ; 
				//$oBarra->BuscaClick = "fBuscaTKardex()"    	  ;
			    //$oBarra->onKeytxt   = "focusSearch(event)";
				$oBarra->clase      = "css"      		  ; 
				//$oBarra->widthtxt   = "20"				  ; 
				$oBarra->Show()  						  ; 
				?>
                </span></td>
                </tr>
            </table>
                    </form>
    </td>
</tr>
        <tr><td valign="top" width="710">
<div id="dgrid_kardex" style="width:710px;">
<?php
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
				$Grid1->elimClick = "fElimItemGrid();"   ;
			    #$Grid1->despuesElim = "fDisMonto(numFil);"   ;
				$Grid1->Show()                             ; 
                $Grid1->fDesCon()						   ;
 ?>
</div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
<script language="javascript">
	$(document).ready(function(){
		$('#gridKardex').scrollableFixedHeaderTable(720,200,null,null)
			
		});  
</script>		
</body>
</html>
