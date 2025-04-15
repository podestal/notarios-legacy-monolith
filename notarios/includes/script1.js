// JavaScript Document
 /*
 * Commentarios   : Libreria script1 reportes
 * Fecha Creacion : 16/02/2013
 * Creado por     : Carlos LLontop
 * Actualización  :
 * Observación    : 
*/
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


// escrituras publicas
function pdf(fecini,fecfin,html){

	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}
	
	ajax = objetoAjax();
	ajax.open("POST", "PDFescri.php",true);
	
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDFescri.php?fecini="+fecini+"&fecfin="+fecfin+"&html="+html); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin+"&html="+html);
}
////////////////////////////

// asuntos no contenciosos
function pdfacon(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax = objetoAjax();
	ajax.open("POST", "PDFanocon.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDFanocon.php?fecini="+fecini+"&fecfin="+fecfin+"&html="+html); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin+"&html="+html);
}
////////////////////////////

// GARANTIAS MOBILIARIAS
function pdfgmovi(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "PDFgamov.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDFgamov.php?fecini="+fecini+"&fecfin="+fecfin+"&html="+html); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin+"&html="+html);
}
////////////////////////////


// TESTAMENTOS
function pdftesta(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax = objetoAjax();
	ajax.open("POST", "PDFtestam.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDFtestam.php?fecini="+fecini+"&fecfin="+fecfin); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin+"&html="+html);
}
////////////////////////////


// TRANSFERENCIAS VEHICULARES
function pdftvehi(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "PDFtranv.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDFtranv.php?fecini="+fecini+"&fecfin="+fecfin+"&html="+html); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin+"&html="+html);
}
////////////////////////////

function pdf2(fecini,fecfin,html){
	ajax=objetoAjax();
	ajax.open("POST", "pruebalibreria.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("pruebalibreria.php?fecini="+fecini+"&fecfin="+fecfin+"&html="+html);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin+"&html="+html);

}
// ORDEN ALFABETICO

// Indice alfabetico de ESCRITURAS PUBLICAS 
function pdfAlfa(fecini,fecfin,html){

	var _fechade = document.getElementById('fechade').value ; 
	var _fechaa  = document.getElementById('fechaa').value; 
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}
	
	ajax = objetoAjax();
	ajax.open("POST", "reportes/reporteAlfa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("reportes/reporteAlfa.php?fecini="+fecini+"&fecfin="+fecfin);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}
////////////////////////////////////////////////////

// Indice alfabetico de ASUNTOS NO CONTENCISOS
function pdfAlfaANC(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value;
	
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax = objetoAjax();
	ajax.open("POST", "reportes/RptAsunNCAlfa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("reportes/RptAsunNCAlfa.php?fecini="+fecini+"&fecfin="+fecfin);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}
////////////////////////////////////////////////////

// Indice alfabetico de TRANSFERENCIAS VEHICULARES
function pdfAlfaTRANV(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "reportes/RptTranVAlfa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("reportes/RptTranVAlfa.php?fecini="+fecini+"&fecfin="+fecfin);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}
////////////////////////////////////////////////////


// Indice alfabetico de GARANTIAS MOBILIARIAS
function pdfAlfaGMOBI(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "reportes/RptGaraIAlfa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("reportes/RptGaraIAlfa.php?fecini="+fecini+"&fecfin="+fecfin);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}
////////////////////////////////////////////////////


// Indice alfabetico de TESTAMENTOS
function pdfAlfaTESTA(fecini,fecfin,html){
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "reportes/RptTestaAlfa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("reportes/RptTestaAlfa.php?fecini="+fecini+"&fecfin="+fecfin);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}
////////////////////////////////////////////////////


function pdflibro(fecini,fecfin,html){

	ajax=objetoAjax();
	ajax.open("POST", "PDFlibro.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDFlibro.php?fecini="+fecini+"&fecfin="+fecfin+"&html="+html); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin+"&html="+html);
}



function pdfgmovifir2(){
	
	var tipokar = document.getElementById('cmb_tipkar').value;
	
	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "PDF_pendfirma.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDF_pendfirma.php?tipokar="+tipokar+"&fechade="+fechade+"&fechaa="+fechaa); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipokar="+tipokar+"&fechade="+fechade+"&fechaa="+fechaa);
}