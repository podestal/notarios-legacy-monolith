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

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/sellos.js" ></script>
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
<!-- ini table -->
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

	$("#frmtipkar").dialog({height:400, width:700,position :["center","top"],  style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Tipos de Kardex'}); 
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
		})

	function muesdatos(){ muestragrid(); }

	function selectidkar(id) {document.getElementById('datos').value = id;}

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
								_gridView.rows[i].style.backgroundColor = '#E8E8E8';
							}
					}
	
					obj.style.backgroundColor = '#b4b4b4'; 
					var fil=obj.id;
					document.getElementById('txtfilas').value=fil;
	
					_datos =  $GridData(obj);
					document.getElementById('idsello').value = _datos[0];
					document.getElementById('dessello').value = _datos[1];
					document.getElementById('contenido').value = _datos[2];
			}


	function editkar(){
		var _idsello   = document.getElementById('idsello').value;	
		var _dessello  = document.getElementById('dessello').value;	
		var _contenido = document.getElementById('contenido').value;	 				 
		
		$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/EditSello.php?idsello='+_idsello+'&dessello='+_dessello+'&contenido='+_contenido+'"/>').dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 450,
						height  : 250,
						modal:false,
						resizable:false,
						title:'Editar Sello'
						}).width(450).height(250);	
		}
	
	function agregar(){
		$('<iframe id="frame1" class="window-Frame" frameborder="0" src="../controller/Newsello.php"/>').dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 450,
						height  : 180,
						modal:false,
						resizable:false,
						
						title:'Nuevo Sello'
						}).width(450).height(180);	
		}

	function focusSearch(evento){if(evento.keyCode==13){document.getElementById('Buscar').focus();}} 
	
	function frefresh(){ window.location.reload(); }

	function cerrar2(){  $("#frmtipkar").dialog("close"); }

function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//Elimina datos del tipo de kardex
	function fElimItemGrid()
	{	
		var _idsello = document.getElementById('idsello').value;
		ajax=objetoAjax();
		ajax.open("POST", "../model/elimsello.php",true);	
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4 && ajax.status==200) {
				alert('Se elimino satisfactoriamente');
				window.location.reload();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("idsello="+_idsello);
	}

</script>-->
</head>

<body style="font-size:62.5%;" onLoad="listar_sellos(1)">

<div id="frmtipkar" style="background-color: #ffffff; border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:940px; height:600px;">
	
    <table id="title_client" width="100%" bgcolor="#264965" bordercolor="#264965" cellpadding="0" cellspacing="0">
         <tr>
            <td width="36" height="28" align="center" bgcolor="#264965"><img src="../../iconos/nuevo2.png" width="20" height="22" /></td>
           <td width="745" bgcolor="#264965"><span class="submenutitu">Mantenimiento de Sellos</span></td>
         </tr>
   </table>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
   		<tr>
            <td height="46">
            <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:63px; height:20px; cursor:pointer; margin-top:10px; margin-left:22px" title="Nuevo" onClick="nuevo_sello()">
        <img src="../../images/new.png" width="20" height="20" /><span style="color:#3A7099; position:relative; left:5px; top:-5px";><B>NUEVO</B></span>
        </div>
            
            </td>
        </tr>
        <tr>
			<td valign="top" align="center"><div id="lst_sellos" style="margin-top:13px"></div></td>
		</tr>
   </table>

	<div id="div_nsello" style=" display:none; position:absolute; top:160px; left:218px; width:584px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white "></div>
  
  <div id="div_msello" style=" display:none; position:absolute; top:160px; left:218px; width:584px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white "></div>

</div>
<!--<script language="javascript">
	$(document).ready(function(){
		$('#gridKardex').scrollableFixedHeaderTable(660,200,null,null)
			
		});  
</script>-->		
</body>
</html>
