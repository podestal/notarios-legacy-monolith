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

<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>-->	 
<script type="text/javascript" src="../consultas/buscarImp.js"></script> 


<script type="text/javascript">



	function limpiar(){
	
		
	var cod=document.getElementById('n_cod').value;
	var newcod=parseInt(cod)+parseInt(1);
document.getElementById('n_cod').value=newcod;
	
		document.getElementById('list_impe').style.display="none";
		document.getElementById('tacha').style.display="none";
		
	document.getElementById('n_doc').value="";
	document.getElementById('tip_doc').value=0;
	document.getElementById('cliente').value="";
	document.getElementById('tip_per').value=0;
	document.getElementById('n_doc').focus()
	document.getElementById('tip_doc').focus()
	document.getElementById('cliente').focus()
	document.getElementById('tip_per').focus()
	document.getElementById('n_doc').disabled=false;	
	document.getElementById('tip_doc').disabled=false;
	document.getElementById('cliente').disabled=false;
	document.getElementById('tip_per').disabled=false;
	document.getElementById('n_impentidad').focus();
	document.getElementById('n_impmotivo').focus();
	document.getElementById('n_impmotivo').value="";
	document.getElementById('n_impentidad').value="";
	document.getElementById('entidad').value="";
	
	
	}
	

	
function focusentidad(){
	
	
	document.getElementById('n_doc').value="";
	document.getElementById('tip_doc').value=0;
	document.getElementById('cliente').value="";
	document.getElementById('tip_per').value=0;
	document.getElementById('n_doc').focus()
	document.getElementById('tip_doc').focus()
	document.getElementById('cliente').focus()
	document.getElementById('tip_per').focus()
	document.getElementById('n_doc').disabled=false;	
	document.getElementById('tip_doc').disabled=false;
	document.getElementById('cliente').disabled=false;
	document.getElementById('tip_per').disabled=false;
	document.getElementById('n_impentidad').focus();
	
	}
	
function btngrabar(){
	document.getElementById('guardar').disabled=false;
}
	
function focusmotivo(){
	document.getElementById('n_doc').value="";
	document.getElementById('tip_doc').value=0;
	document.getElementById('cliente').value="";
	document.getElementById('tip_per').value=0;
	document.getElementById('n_doc').focus()
	document.getElementById('tip_doc').focus()
	document.getElementById('cliente').focus()
	document.getElementById('tip_per').focus()
	document.getElementById('n_doc').disabled=false;	
	document.getElementById('tip_doc').disabled=false;
	document.getElementById('cliente').disabled=false;
	document.getElementById('tip_per').disabled=false;
	document.getElementById('n_impmotivo').focus();
	
	}		
		
	
function ggclie1dom()
 {
	
	   grabarcliente_dom();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
	   ocultar_desc2('clientenewdni2');
	
	 }
	 
function ggclie1dom2()
 {
	
	   grabarcliente2_dom();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenew');
	   ocultar_desc2('clientenew2');
	   
	
	 }
	 
	 
	function ggclie1dom_editar()
 {
	
	   grabarcliente_dom_editar();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
	   ocultar_desc2('clientenewdni2');
	
	 }
	 
function ggclie1dom2_editar()
 {
	
	   grabarcliente2_dom_editar();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenew');
	   ocultar_desc2('clientenew2');
	   
	
	 } 
	 
//natural
	function ggclie11dom_editar()
 {
	
	   grabarcliente_dom_editar2();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
	   ocultar_desc2('clientenewdni2');
	
	 }

//juridica	 
function ggclie1dom22_editar()
 {
	
	   grabarcliente2_dom_editar2();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenew');
	   ocultar_desc2('clientenew2');
	   
	
	 } 	 
	 
	 
function apepaterno(){
	
 valord=document.getElementById('napepat').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apepat').value=textod;
}

function apematerno(){
 valord=document.getElementById('napemat').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apemat').value=textod;

}
function prinombre(){
 valord=document.getElementById('nprinom').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('prinom').value=textod;

}
function segnombre(){
 valord=document.getElementById('nsegnom').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('segnom').value=textod;

}
function direccion(){
 valord=document.getElementById('ndireccion').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion').value=textod;

}

function razonsociall(){
	
 valorra=document.getElementById('nrazonsocial').value;
 textor=valorra.replace(/&/g,"*");
 document.getElementById('razonsocial').value=textor;
	}
function domfiscall(){
	
valord=document.getElementById('ndomfiscal').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('domfiscal').value=textod;
	}	

	
$("#idzonax").live("click", function(){
				$("#_buscaubi").val("");
				$("#_buscaubi").focus();
				$("#resulubi").html("");
			 })
	
function mostrarubigeoosc2(id,name)
    {

  document.getElementById('ubigen').value = id;
  document.getElementById('codubi').value = name;  
  ocultar_desc('buscaubi');     
        
    }
	
	function mostrarubigeoosc(id,name){
	document.getElementById('ubigensc').value=id;
	document.getElementById('codubisc').value=name;
	ocultar_desc('buscaubisc');
	
	}
	
function buscaprofesionesc()
{ 	
	var divResultado = document.getElementById('resulprofesionesc');
	var buscaprofes  = document.getElementById('buscaprofesc').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnesdomic.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes);
}

function mostrarprofesionessc(id,name)
    {
  document.getElementById('idprofesionc').value = id;
  document.getElementById('nomprofesionesc').value = name;  
  ocultar_desc('buscaprofec');        
    }
	

function regresa_caja(){
	var divResultado = document.getElementById('respuesta');

	ajax=objetoAjax();

	ajax.open("POST", "../consultas/clear_impe.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send();
	
	}
	
	
	function regresa_caja2(){
	var divResultado = document.getElementById('respuesta2');

	ajax=objetoAjax();

	ajax.open("POST", "../consultas/clear_impe.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send();
	
	}
	
	function buscaubigeossc()
{ 	divResultado = document.getElementById('resulubisc');
	buscaubisc=document.getElementById('_buscaubisc').value;
		
	ajax=objetoAjax();
	ajax.open("POST","../../extraprotocolares/model/buscarubigeosclib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc)
}


function buscaubigeosc2()
{ 	divResultado = document.getElementById('resulubi');
	buscaubisc2=document.getElementById('_buscaubi').value;
		
	ajax=objetoAjax();
	ajax.open("POST","../../extraprotocolares/model/buscarubigeosc2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc2="+buscaubisc2)
}
			 
function sendCli(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
		var tipperx = document.getElementById('tip_per').value; 
        if (tecla==13){
			if(tipperx==0){
				alert("Debe escoger el tipo de persona");
			}else{
				buscar_cliente_Cli();	
				
			}
		} 
} 

function sendCli2(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
		var tipperx = document.getElementById('tip_per2').value; 
        if (tecla==13){
			if(tipperx==0){
				alert("Debe escoger el tipo de persona");
			}else{
				buscar_cliente_Cli2();	
				
			}
		} 
}


function sendImpe(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
		 
        if (tecla==13){
				buscar_imp_control();	
				
		} 
}


function sendImpe2(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
		 
        if (tecla==13){
				buscar_imp_control2();	
				
		} 
}


function sendDNI(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
       var tipperx = document.getElementById('tip_doc').value; 
	   
        if (tecla==13){
			if(tipperx==""){
				alert("Debe escoger el tipo de documento");
			}else{
				buscar_cliente_DNI();	
			}
		} 
}

function sendDNI2(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
       var tipperx = document.getElementById('tip_doc2').value; 
	   
        if (tecla==13){
			if(tipperx==""){
				alert("Debe escoger el tipo de documento");
			}else{
				buscar_cliente_DNI2();	
			}
		} 
} 

function newclient()
    {
	mostrar_desc('clientenewdni');

	}
function newclientempresa()
    {
	mostrar_desc('clientenew');
	
	}
	
	
	function newclient2()
    {
	mostrar_desc2('clientenewdni2');

	}
function newclientempresa2()
    {
	mostrar_desc2('clientenew2');
	
	}		

	
	function mostrar_desc(objab)
		{
		
		if(document.getElementById(objab).style.display=="none")
		document.getElementById(objab).style.display="";
		else
		document.getElementById(objab).style.display="";
		}
		
		
			function mostrar_desc2(objac)
		{
		
		if(document.getElementById(objac).style.display=="none")
		document.getElementById(objac).style.display="";
		else
		document.getElementById(objac).style.display="";
		}
		
	
	function cerrar(){
	ocultar_desc('clientenew');


	}
	
	
		function cerrar2_1(){
	ocultar_desc2('clientenew2');


	}
	
	function cerrarnuevo(){

	ocultar_descnew('nuevo');
	ocultar_descnew('div_nimpedido');
	
	
	buscar_imp_control();

	}

function cerrar2(){
	ocultar_desc('clientenewdni')

	}
	
	function cerrar2_2(){
	ocultar_desc2('clientenewdni2')

	}
	
	

		

function ocultar_desc(objac2)
		{
		
		if(document.getElementById(objac2).style.display=="")
		document.getElementById(objac2).style.display="none";
		else
			document.getElementById(objac2).style.display="none";
		}
		
		
		function ocultar_desc2(objac22)
		{
		
		if(document.getElementById(objac22).style.display=="")
		document.getElementById(objac22).style.display="none";
		else
			document.getElementById(objac22).style.display="none";
		}
		
		function ocultar_descnew(objac3)
		{
		
		if(document.getElementById(objac3).style.display==""){
		document.getElementById(objac3).style.display="none";
		document.getElementById(objac3).style.border="none";
		}else{
			document.getElementById(objac3).style.display="none";
			document.getElementById(objac3).style.border="none";
		}
		}
		
		
		
		
  </script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/jquery.scrollableFixedHeaderTable.js"></script>
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/impedidos.js" ></script>
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

<style>
div.dalib {
	background: #333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width: 760px;
	height: 299px;
	position: absolute;
	left: 494px;
	top: 121px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
	
}


</style>

</head>

<body style=" font-size:63.5%;" onLoad="listar_impedidos(1)">
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
            <td width="745" bgcolor="#264965"><span class="submenutitu">Mantenimiento de Impedidos</span></td>
        </tr>
        <tr>
        	<td></td>
            <td height="46" >
            <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:63px; height:20px; cursor:pointer; margin-top:5px" title="Nuevo" onClick="nuevo_impedido()" >
        <img src="../../images/new.png" width="20" height="20" /><span style="color:#3A7099; position:relative; left:5px; top:-5px"><B>NUEVO</B></span>
        </div>
            
            </td>
      </tr>
        <tr height="40">
            <td colspan="2" valign="top" align="center">
            	<form id="frm_cliente" name="frm_cliente" method="post" >
                <fieldset id="field_remitente" style=" width:550px;height:90px; margin-top:0px;float:left;margin-left:25px;">
                <legend><span class="Estilo7">Busqueda por cliente Impedido</span>
               </legend>
               <table width="550" height="70" border="0" cellpadding="0" cellspacing="0">
               		<tr>
                    	<td width="80"><span class="Estilo7" style="margin-left:5px">Tipo Persona:</span> </td>
                    	<td width="176">
                        	<select id="b_tippersona" name="b_tippersona" class="Estilo7" onChange="listar_impedidos(1)">
                            	<option value="">--Tipo de Persona--</option>
                                <option value="N">Natural</option>
                                <option value="J">Jurídica</option>
                            </select>
                        </td>
                        
                        <td width="48"><span class="Estilo7">Nº DOC</span>: </td>
                        <td width="142"><input id="b_doi" name="b_doi" type="text" maxlength="20" class="Estilo7" style="width:120px"/></td>
                      
                    </tr>
                    <tr>
                    	<td width="42"><span class="Estilo7" style="margin-left:5px">Cliente</span>: </td>
                        <td width="145" colspan="4"><input id="b_cliente" name="b_cliente" type="text" maxlength="120" class="Estilo7" style="width:392px"/></td>
						<td width="65"><input type="button" value="Buscar" class="Estilo7" onClick="listar_impedidos(1)"/></td>
                    </tr>
               </table>
               </fieldset>
                 <fieldset style=" width:270px;height:90px; margin-top:0px;float:right;margin-right:35px;">
                 <table><tr>
                        <legend><span class="Estilo7">Busqueda por Oficio</span></legend>
                        <td width="282"><span class="Estilo7">Nro Control&nbsp;&nbsp;</span>
                       	<input type="text" id="noficio" name="noficio" class="Estilo7" onkeypress="sendImpe(event);" style="width:150px"/>
                        </td></tr>
                       <td width="282"><span class="Estilo7">Nro Oficio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                       	<input type="text" id="noficio2" name="noficio2" class="Estilo7" onkeypress="sendImpe2(event);" style="width:150px"/>
                        </td></tr> 
                          <td><span style="font-size:9px">(*)&nbsp;Presionar la tecla enter en un campo vacio para consultar todos los registros</span></td>
                        </tr></table>
                          </fieldset>
               </form>
            </td>
    	</tr>
        <tr height="480">
            <td colspan="2" valign="top" align="center"><div id="lst_cliente" style="margin-top:10px;overflow:scroll;"></div></td>
        </tr>
        
    </table>

</div>

<div id="div_nimpedido" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>

<div id="div_nconyugue" style=" display:none; position:absolute; top:240px; left:350px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:#D2E9FF; z-index:2 "></div>
  
   <div id="div_mimpedido" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1 "></div>
   
 <div id="div_mimpedido_control" style=" display:none; position:absolute; top:160px; left:225px; width:580px; height:auto; border-radius:10px; -moz-border-radius: 10px;  border: black 1px solid; background-color:white; z-index:1; "></div>  
   

	
</body>
</html>
