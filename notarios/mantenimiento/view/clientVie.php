<?php
	require_once("../includes/barramenu.php") ;
	require_once("../includes/gridView.php")  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1  = new GridView()				  ;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Mantenimiento kardex</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link href="../includes/scrollableFixedHeaderTable.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<!--<link rel="stylesheet" href="../../css/uniform.default.css" type="text/css" media="screen">-->

<script type="text/javascript" src="../../librerias/jquery/external/jquery/jquery.js"></script>
<script type="text/javascript" src="../../librerias/jquery/jquery-ui.js"></script>

<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>-->	  

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/jquery.scrollableFixedHeaderTable.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/cliente.js" ></script>
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>

<style type="text/css">

#field_remitente, #field_destinatario, #field_responpago, #field_diligencia, #field_cargo, #div_detfact{
	margin:0 auto;
	border: 2px solid #ddd; 
	border-radius: 10px; 
	padding: 2px; 
	box-shadow: #ccc 5px 0 5px;
	margin-bottom:0px;
	}

table.aatable {
	border-top: #333333 2px solid;
	border-left: #333333 2px solid;
	border-collapse: collapse;
	width: 100%;
padding: 1px 1px 1px 1px;

  font-size: 11px;
}
table.aatable th {

	border-right: #333333 2px solid;
	border-bottom: #333333 2px solid;
	background-color: #CCCCCC;
	padding: 3px 0px 3px 0px;
	text-align: center;
  font-size: 10px;
  font-family:Verdana, Geneva, sans-serif;
}
table.aatable td {
	/*border-right: #f5ebce 1px solid;
	border-bottom: #f5ebce 1px solid;*/
	border-right: #333333 2px solid;
	border-bottom: #333333 2px solid;
	padding-left:4px;
	color: #000000;
	/*vertical-align: top;*/
	padding:4px 2px 2px 2px;
	 font-size: 10px;
  font-family:Verdana, Geneva, sans-serif;

}
table.aatable td.label {
	border-right: #f5ebce 1px solid;
	border-bottom: #f5ebce 1px solid;
	background-color: #fffae8;
	border-right: #F69424 1px solid;
	border-bottom: #F69424 1px solid;
	background-color: #F69424;
	text-align:left;
	font-weight:500;		
}
table.aatable tr
{
height:12px;
}
table.aatable tr.tr0 td {
	background-color:#e3fdfb;
}
table.aatable tr.tr1 td {
	background-color:#fff;
}
table.aatable tr.trResaltado td {
	background-color:#fdeec5;
}

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

	$("#frmclientes").dialog({height:800, width:740, position :["center","top"],style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Mant. de Clientes'}); 
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	
		 fmuestraGrid();
	
		})
	
	$('#btncerrar2').click( function() { alert('das');
		$("#frmclientes").dialog("close");
	});
	
	function muesdatos(){muestragrid();}
	
	function cerrar2(){$("#frmclientes").dialog("close");	}

	function selectidkar(id) { document.getElementById('datos').value = id;	}
	
	function editclie(_obj){
		
		var codclie = document.getElementById('codclie').value; 				 
		var tipop   = document.getElementById('tipop').value; 
		
	$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/editClientCon.php?codclie='+codclie+'&tipop='+tipop+'"/>').dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 720,
					height  : 500,
					modal:false,
					resizable:false,
					title:'Editar Clientes'
					}).width(720).height(500);	
		}
		
	function editContratante(_id_cliente,_tipop)
	{

	var codclie = document.getElementById('codclie').value; 				 
		var tipop   = document.getElementById('tipop').value; 
			
	$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/editClientCon.php?id_cliente='+_id_cliente+'&tipop='+_tipop+'"/>').dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 720,
					height  : 500,
					modal:false,
					resizable:false,
					title:'Editar Clientes'
					}).width(720).height(500);	
	}
	function fShowDetail(obj)
			{
				var _id = obj.cells[0].innerHTML;
				var _gridView = document.getElementById('gridClientes');
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
					document.getElementById('tipop').value = _datos[2];
					document.getElementById('codclie').value = _datos[0];
	
			}
	
	function agregar(){
	$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/newClientCon.php"/>').dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 700,
					height  : 650,
					modal:false,
					resizable:false,
					title:'Nuevo Cliente'
					}).width(700).height(650);	
		}

	function focusSearch(evento){if(evento.keyCode==13){document.getElementById('Buscar').focus();}} 
	
	function frefresh(){ window.location.reload();}

	function fbusca()
	{
		var combo = document.getElementById('tippersona').value;
		var descrio = document.getElementById('descrio').value;
		if(combo == "")
		{alert('Seleccione tipo de persona')}
	
		$("#dgrid_kardex").load('list_clientes.php' ,	{_epublic  : combo,	val  : descrio	}, function(){
			$('#gridClientes').scrollableFixedHeaderTable(700,500,null,null);
			});
	}	
	
		function fbuscas()
	{
		var combo = document.getElementById('tippersona').value;
		var documen = document.getElementById('documen').value;
			if(combo == "")
		{alert('Seleccione tipo de persona')}
	
		$("#dgrid_kardex").load('list_clientes.php' ,	{_epublic  : combo,val  : documen	}, function(){
			$('#gridClientes').scrollableFixedHeaderTable(700,500,null,null);
			});
	}	
	
	function fbuscadir()
	{
		var combo = document.getElementById('tippersona').value;
		var direccion = document.getElementById('direccion').value;
			if(combo == "")
		{alert('Seleccione tipo de persona')}
	
		$("#dgrid_kardex").load('list_clientes.php' ,	{_epublic  : combo,val  : direccion	}, function(){
			$('#gridClientes').scrollableFixedHeaderTable(700,500,null,null);
			});
	}	
	
	

function fbusca1()
	{
		var combo = document.getElementById('tippersona').value;
		var pro=4;
		$("#dgrid_kardex").load('list_clientes.php' ,	{_epublic  : combo,col  : pro	}, function(){
			$('#gridClientes').scrollableFixedHeaderTable(700,500,null,null);
			});
	}	
	function fmuestraGrid()
	{
		var _ini="ini";
		$("#dgrid_kardex").load('list_clientes.php',{_epublic  : _ini }, function(){
			$('#gridClientes').scrollableFixedHeaderTable(700,500,null,null);
			});
	}	

		
</script>-->

</head>

<body style=" font-size:63.5%;" onLoad="listar_cliente(1)">
<div id="frmtipkar" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:940px; height:650px;">
	<table id="title_client" width="100%" cellpadding="0" cellspacing="0" height="620">
 	  <tr>
            <td width="36" height="28" align="center" bgcolor="#264965"><img src="../../iconos/nuevo2.png" width="20" height="22" /></td>
            <td width="745" bgcolor="#264965"><span class="submenutitu">Mantenimiento de Clientes</span></td>
      </tr>
      <tr>
        	<td></td>
            <td height="46" >
            <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:63px; height:20px; cursor:pointer; margin-top:5px; float:left " title="Nuevo" onClick="nuevo_cliente()">
        <img src="../../images/new.png" width="20" height="20" /><span style="color:#3A7099; position:relative; left:5px; top:-5px";><B>NUEVO</B></span>
        </div>
            <div style="float:left; margin-left:20px; margin-top:8px; cursor:pointer;" title="Lista Ofac"><a onClick="window.open('http://www.treasury.gov/ofac/downloads/t11sdn.pdf', '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=300, left=800, width=600, height=600, location=0');" href="#"><img src="../../imagenes/ofac.jpg" width="23" height="23"/></a></div>
            </td>
      </tr>
      <tr height="40">
            <td colspan="2" valign="top">
            	<form id="frm_cliente" name="frm_cliente" method="post" >
                <fieldset id="field_remitente" style=" width:850px; margin-top:0px">
                <legend><span class="Estilo7">Buscar Cliente</span></legend>
               <table width="850" height="70" border="0" cellpadding="0" cellspacing="0">
               		<tr>
                    	<td width="80"><span class="Estilo7" style="margin-left:5px">Tipo Persona:</span> </td>
                    	<td width="176">
                        	<select id="b_tippersona" name="b_tippersona" class="Estilo7" onChange="listar_cliente(1)">
                            	<option value="">--Tipo de Persona--</option>
                                <option value="N">Natural</option>
                                <option value="J">Jurídica</option>
                            </select>
                        </td>
                        
                        <td width="48"><span class="Estilo7">Nº DOC</span>: </td>
                        <td width="142"><input id="b_doi" name="b_doi" type="text" maxlength="20" class="Estilo7" style="width:120px"/></td>
                        
                        <td width="70"><span class="Estilo7">Tipo Cliente:</span> </td>
                    	<td width="182">
                        	<select id="b_tipcliente" name="b_tipcliente" class="Estilo7" onChange="listar_cliente(1)">
                            	<option value="">Todos</option>
                                <option value="0">Normal</option>
                                <option value="1">Impedido</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td width="42"><span class="Estilo7" style="margin-left:5px">Cliente</span>: </td>
                        <td width="145" colspan="4"><input id="b_cliente" name="b_cliente" type="text" maxlength="120" class="Estilo7" style="width:392px"/></td>
						<td width="65"><input type="button" value="Buscar" class="Estilo7" onClick="listar_cliente(1)"/></td>
                    </tr>
               </table>
               </fieldset>
               </form>
            </td>
    	</tr>
        <tr height="480">
            <td colspan="2" valign="top" align="center"><div id="lst_cliente" style="margin-top:10px"></div></td>
        </tr>
        
    </table>
   <div id="div_ncliente" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>
     
   <div id="div_nconyugue" style=" display:none; position:absolute; top:240px; left:350px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:#D2E9FF; z-index:2 "></div>
  
   <div id="div_mcliente" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>

</form>
</div>

<div id="div_login" style="background-color:#DDECF7; width:300px; height:auto; border-radius: 10px; border-color:#DDECF7; position:absolute; left:360px; top:220px; display:none"></div>

</body>
</html>
