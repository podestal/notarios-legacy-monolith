<?php

require_once("../../../includes/combo.php")  	  ;
$oCombo = new CmbList()  				  ;	
include("conexion.php");
?>	
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../../tcal.css" />
<script type="text/javascript" src="../../../tcal.js"></script> 
<script language="JavaScript" type="text/javascript" src="../../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../../includes/script1.js"></script>
<script src="../../../includes/jquery-1.8.3.js"></script>
<script src="../../../includes/js/jquery-ui-notarios.js"></script>
<!--<script src="../../../mantenimiento/view/funciones_ro.js"></script>-->


<title>BASE CENTRALIZADA</title>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.titulosprincipales {	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
div.frmcrono {  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:850px;
}

div.clienedit1 {	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:760px;
	height:299px;
	position:absolute;
	left: 494px;
	top: 274px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}

.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
</style>
<script type="text/javascript">

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

function objetoAjax2(){
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

// BUSQUEDA DE VIAJES EN INDICE DE VIAJES:
function buscakardex(){

	divResultado = document.getElementById('buscakardex');
	//var _cmb_tipkar = document.getElementById('cmb_tipkar').value;
	//var fec_desde = document.getElementById('fec_desde').value; 
	//var fec_hasta  = document.getElementById('fec_hasta').value; 
	/*
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}	*/
    divResultado.innerHTML= '<img src="../../../loading.gif">';
	
	ajax = objetoAjax();

	ajax.open("POST", "sisgen_report_error.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//ajax.send("tipokar="+_cmb_tipkar+"&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta)
	ajax.send()
	
	
}
function buscacount(){

	
	divResultado2 = document.getElementById('message2');
	/*
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}	*/
    //divResultado2.innerHTML= '<img src="../../../loading.gif">';
	
	ajax2 = objetoAjax2();

	ajax2.open("POST", "sisgen_count.php",true);
	ajax2.onreadystatechange=function() {
		if (ajax2.readyState==4) {
			divResultado2.innerHTML = ajax2.responseText
		}
	}
	ajax2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax2.send()
	
	
}

function funciones(){
	/*console.time("t1");
	buscakardex();
	console.timeEnd("t1");
	alert (console.timeEnd);
	setTimeout("buscacount()",3000);*/
	
	buscakardex();
	setTimeout("buscacount()",2000);
}

// FUNCIONES SISGEN
function cargar_data_sisgen3(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="../../../loading.gif">';
	//tomamos el valor de la lista desplegable
	var _cmb_tipkar = document.getElementById('cmb_tipkar').value;
	fec_desde = document.getElementById('fec_desde').value;
	fec_hasta = document.getElementById('fec_hasta').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","xmlcompraventa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipokar="+_cmb_tipkar+"&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta)
	
	}
	
	function sisgen2(name,id){
	//document.location.href="consultas/verkardex.php?kardex="+kardex;
	
	document.location.href="report_mensaje.php?kardex="+name+"&id="+id;
	ocultar_desc('clienedit'); 
}

function asi2()
    { 
	 //listarcontrata();
	alert("Debe seleccionar un rango de Fechas válido");
	 } 

	/*
	function enviar_data_sisgen(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	//tomamos el valor de la lista desplegable
	fec_desde = document.getElementById('fec_desde').value;
	fec_hasta = document.getElementById('fec_hasta').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","../../prueba6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.getElementById('datos').disabled=true;
			document.getElementById('datosc').disabled=true;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta)
	
	}*/


</script>

</head>

<body onload="buscakardex()">
<div class="frmcrono" >
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="354"><span class="titulosprincipales">KARDEX QUE PRESENTAN ERRORES EN EL ENVIO</span></td>
          <td width="484" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="239" height="30">&nbsp;</td>
              <td width="80">&nbsp;</td>
              <td width="17"><span class="line">|</span></td>
              <td width="118">&nbsp;</td>
            </tr>
          </table></td>
          <td width="29"><img src="../../../iconos/cerrar.png" width="21" height="20" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="863" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="824" height="18"><form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
            <td height="36" align="LEFT" colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong>REPORTE</strong></span></td>
            
			</tr>
              
        </table>
                    </form>          </td>
					
        </tr>
		<td><div align="center" id="message2" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#036;"></div></td>
        <tr>
			<td height="9">---------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        <tr>
          <td height="22"><table width="840" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333"><!--<td width="70" height="19" bgcolor="#CCCCCC"><span class="Estilo14">Numero</span></td>-->
            <tr>
                <td width="40" bgcolor="#CCCCCC"  align="center"><span class="Estilo14">TIPO DE KARDEX</span></td>
                <td width="150" bgcolor="#CCCCCC" align="center"><span class="Estilo14">KARDEX</span></td>
				<td width="50" bgcolor="#CCCCCC" align="center"><span class="Estilo14">NUMERO DE ESCRITURA</span></td>
                <td width="50" bgcolor="#CCCCCC" align="center"><span class="Estilo14">FECHA DE ENVIO</span></td>
                <td width="1" bgcolor="#CCCCCC" align="center"><span class="Estilo14">ESTADO</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="buscakardex" style="height:600px; overflow:auto;"></div></td>
		  </tr>
		  
      </table></td>
    </tr>
  </table>
</div>

</body>

</html>
