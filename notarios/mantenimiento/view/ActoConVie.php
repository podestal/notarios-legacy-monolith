<?php
	require_once("../includes/barramenu.php") ;
	require_once("../includes/gridView.php")  ;
	require_once("../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Mantenimiento de condiciones</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link href="../includes/scrollableFixedHeaderTable.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<!--<link rel="stylesheet" href="../../css/uniform.default.css" type="text/css" media="screen">-->
<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>-->	  
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/jquery.scrollableFixedHeaderTable.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/condicion.js" ></script>
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>

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
.GridPar
{
	border:0px;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#FFFFFF;
}
.GridImp
{
	border:0px;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#E8E8E8;
}
.GridCab
{
	font-size:17px;
	
	
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
<!--<script type="text/javascript">
$(document).ready(function(){ 

	$("#frmtipkar").dialog({height:580, width:880,position :["center","top"],style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Tipos de Actos'}); 
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();	 
		 fmuestraGrid();
		})

	function muesdatos(){	muestragrid(); }

	function selectidkar(id) {document.getElementById('datos').value = id;}

	function fShowDetail(obj)
			{
				var _id = obj.cells[0].innerHTML;
				var _gridView = document.getElementById('gridActos');
				var _rows  = _gridView.rows.length;
				for(i=1;i<=_rows-1;i++)
					{
						if(i%2==0)
							{
								_gridView.rows[i].style.backgroundColor = '#FFFFFF';
							}
						else
							{
								_gridView.rows[i].style.backgroundColor = '#E8E8E8';
							}
					}
				obj.style.backgroundColor = '#b4b4b4'; 
				
				var fil=obj.id;
				document.getElementById('txtfilas').value=fil;
	
					_datos =  $GridData(obj);
					
					document.getElementById('idcondicion').value = _datos[0];
					document.getElementById('idtipoacto').value = _datos[6];
					document.getElementById('condicion').value = _datos[2];
					document.getElementById('parte').value = _datos[3];
					document.getElementById('uif').value = _datos[4];
					document.getElementById('formulario').value = _datos[5];
					document.getElementById('montop').value = _datos[7];
				
			}


	function editacto(){
		var _idcondicion = document.getElementById('idcondicion').value; 
		var _idtipoacto  = document.getElementById('idtipoacto').value ;
		var _condicion   = document.getElementById('condicion').value ;
		var _parte       = document.getElementById('parte').value ;
		var _uif         = document.getElementById('uif').value ;
		var _formulario  = document.getElementById('formulario').value ;
		var _montop      = document.getElementById('montop').value ;		 
		
		$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/editCondiCon.php?idcondicion='+_idcondicion+'&idtipoacto='+_idtipoacto+'&condicion='+_condicion+'&parte='+_parte+'&uif='+_uif+'&formulario='+_formulario+'&montop='+_montop+'"/>').dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 420,
						height  : 280,
						modal:false,
						resizable:false,
						title:'Editar Condicion'
						}).width(420).height(280);	
		}
	
	function agregar(){				 
		$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/newActoCon.php"/>').dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 420,
						height  : 280,
						modal:false,
						resizable:false,
						title:'Nueva Condicion'
						}).width(420).height(280);	
		}

	function focusSearch(evento){if(evento.keyCode==13){document.getElementById('Buscar').focus();}} 

	function frefresh(){ 	window.location.reload();}

	function cerrar2(){$("#frmtipkar").dialog("close");	}


	function fbusca(_obj,_val)
	{
		if(_obj == true)
		{var _tipkar = "1"}
		else {var _tipkar = "0"}
	
		$("#dgrid_kardex").load('list_ActoCon.php' ,{_epublic  : _tipkar, val : _val}, function(){
				$('#gridActos').scrollableFixedHeaderTable(820,380,null,null);
			});
			
	}	

	function fmuestraGrid()
		{
			var _ini="ini";
			$("#dgrid_kardex").load('list_ActoCon.php',	{ val  : _ini}, function(){
					$('#gridActos').scrollableFixedHeaderTable(820,380,null,null);
				});
			
		}

	function ActListTipActo()
		{
			var _escrituras   = document.getElementById('escrituras').checked;
			var _asuntos      = document.getElementById('asuntos').checked;
			var _vehicular    = document.getElementById('vehicular').checked;
			var _mobiliaria   = document.getElementById('mobiliaria').checked;
			var _testamentos  = document.getElementById('testamentos').checked;
			
			if( _escrituras==true  || _asuntos==true || _vehicular==true || _mobiliaria==true || _testamentos==true )
			{ var _tipkar = "1";}
			else { var _tipkar = "0"; }
			
			if(_escrituras==true)
			{_val = '1';}
				else if(_asuntos==true)
				{_val = '2';}
					else if(_vehicular==true)
					{_val = '3';}
						else if(_mobiliaria==true)
						{_val = '4';}
							else if(_testamentos==true)
							{_val = '5';}
								else {_val = 'ini';}
			$("#dgrid_kardex").load('../view/list_ActoCon.php' ,  {_epublic  : _tipkar, val     : _val});				
		}
			
</script>-->
</head>

<body style="font-size:62.5%;" onLoad="listar_condicion(1, 0)">
<div id="frmtipkar" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:940px; height:600px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="19"><table id="title_client" width="100%" bgcolor="#264965"    bordercolor="#264965" cellpadding="0" cellspacing="0">
        <tr>
          <td width="36" height="28" align="left" bgcolor="#264965"><img src="../../iconos/nuevo2.png" width="20" height="22" style="margin-left:10px" /><span style="margin-left:15px" class="submenutitu">Mantenimiento de Condiciones</span></td>
        </tr>
        <tr></tr>
      </table></td>
    </tr>
    
    <tr>
    	<td>
        	<form id="frm_cliente" name="frm_cliente">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="19">
                 <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td align="center">
                            <table  width="820" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td height="46">
                                    <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:63px; height:20px; cursor:pointer; margin-top:5px" title="Nuevo" onClick="nueva_condicion()">
                                <img src="../../images/new.png" width="20" height="20" /><span style="color:#3A7099; position:relative; left:5px; top:-5px";><B>NUEVO</B></span>
                                </div>
                                    
                                    </td>
                              </tr>
                                <tr>
                                    <td>
                                    <table width="805">
                                            <tr>
                                                <td width="75" height="33"><span class="Estilo7">Escr. Públicas</span></td>
                                                <td width="58"><input id="id_escritura" name="cond" type="radio" value="1" onClick="listar_condicion(1)"></td>
                                                <td width="94"><span class="Estilo7">Asun. No Conten.</span></td>
                                                <td width="50"><input id="id_asuntos" name="cond" type="radio" value="2" onClick="listar_condicion(1)"></td>
                                                <td width="98"><span class="Estilo7">Trans. Vehiculares</span></td>
                                                <td width="49"><input id="id_vehicular" name="cond" type="radio" value="3" onClick="listar_condicion(1)"></td>
                                                <td width="87"><span class="Estilo7">Gar. Mobiliarias</span></td>
                                                <td width="54"><input id="id_garantias" name="cond" type="radio" value="4" onClick="listar_condicion(1)"></td>
                                                <td width="67"><span class="Estilo7">Testamentos</span></td>
                                                <td width="56"><input id="id_testamento" name="cond" type="radio" value="5" onClick="listar_condicion(1)"></td>
                                                <td width="32"><span class="Estilo7">Todos</span></td>
                                                <td width="33"><input id="id_todos" name="cond" type="radio" value="0" onClick="listar_condicion(1)"></td>
                                                
                                            </tr>
                                        </table>
                                    </td>
                              </tr>
                          </table>
                          </td>
                        </tr>
                        <tr>
                            <td valign="top" align="center"><div id="list_cond"></div></td>
                        </tr>
                   </table>
               </td>
            </tr>
          </table>
          </form>
    </tr>
  </table>
  
  <div id="div_ncondicion" style=" display:none; position:absolute; top:160px; left:240px; width:543px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white "></div>
  
  <div id="div_mcondicion" style=" display:none; position:absolute; top:160px; left:240px; width:543px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white "></div>
  
</div>		
</body>
</html>
