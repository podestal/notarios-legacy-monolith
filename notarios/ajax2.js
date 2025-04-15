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

function buscaescritura(nropagina){
	
//alert("hola");

	//donde se mostrará el resultado
	divResultado = document.getElementById('buscaescrituta');

	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}
	
	ajax=objetoAjax();

	ajax.open("POST", "buscaescritura.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechade="+_fechade+"&fechaa="+_fechaa)


}
function imprimir()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('dsdsdsd');
	//tomamos el valor de la lista desplegable
	fechade=document.frmescri.fechade.value;
	fechaa=document.frmescri.fechaa.value;
    
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "imprimir.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&nropagina="+nropagina)
}

function buscanoconten(nropagina){

	var divResultado = document.getElementById('buscaescrituta');

	var fechade = document.getElementById('fechade').value;
	var fechaa  = document.getElementById('fechaa').value;
	
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	} 
	ajax=objetoAjax();
	ajax.open("POST", "buscanoconten.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&nropagina="+nropagina)
}

function buscanoconten2(nropagina){

	var divResultado = document.getElementById('buscaescrituta');

	var fechade = document.getElementById('fechade').value;
	var fechaa  = document.getElementById('fechaa').value;
	
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	} 
	ajax=objetoAjax();
	ajax.open("POST", "buscanoconten2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&nropagina="+nropagina)
}
function buscavehiculo(nropagina){

	var divResultado = document.getElementById('buscaescrituta');

	var _fechade     = document.getElementById('fechade').value;  
	var _fechaa      = document.getElementById('fechaa').value; 
	
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	} 
    
	ajax=objetoAjax();

	ajax.open("POST", "buscavehicular.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+_fechade+"&fechaa="+_fechaa+"&nropagina="+nropagina)
}

function buscavehiculo2(nropagina){

	var divResultado = document.getElementById('buscaescrituta');

	var _fechade     = document.getElementById('fechade').value;  
	var _fechaa      = document.getElementById('fechaa').value; 
	
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	} 
    
	ajax=objetoAjax();

	ajax.open("POST", "buscavehicular2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+_fechade+"&fechaa="+_fechaa+"&nropagina="+nropagina)
}

function buscagarantia(nropagina){

	divResultado = document.getElementById('buscaescrituta');

	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}
    
	ajax=objetoAjax();

	ajax.open("POST", "buscagarantias.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&nropagina="+nropagina)
}

function buscagarantia2(nropagina){

	divResultado = document.getElementById('buscaescrituta');

	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}
    
	ajax=objetoAjax();

	ajax.open("POST", "buscagarantias2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&nropagina="+nropagina)
}

function buscatestamento(nropagina){
	
	divResultado = document.getElementById('buscaescrituta');

	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value; 
	
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}

	ajax = objetoAjax();

	ajax.open("POST", "buscatestamento.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&nropagina="+nropagina)
}

function buscaescrituraalfa(){

	var divResultado = document.getElementById('buscaescrituta');

	var fechade = document.getElementById('fechade').value; 
	var fechaa  = document.getElementById('fechaa').value;
	
	if(fechade == "" || fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}
    
	ajax = objetoAjax();

	ajax.open("POST", "buscaescrituraalfa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+fechade+"&fechaa="+fechaa)
}


// BUSQUEDA DE CARTAS EN INDICE DE CARTAS:
function buscacartas(nropagina){

	divResultado = document.getElementById('buscacartas');
	fechade = document.getElementById('fechade').value;
	fechaa = document.getElementById('fechaa').value; 
    
	ajax=objetoAjax();

	ajax.open("POST", "buscarcartas.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechade="+fechade+"&fechaa="+fechaa+"&nropagina="+nropagina)
}

