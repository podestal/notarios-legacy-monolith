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


function reiniciar()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	//tomamos el valor de la lista desplegable
	numdoc2 = "borrar";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","reiniciar_data.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.getElementById('datosc').disabled=true;
			document.getElementById('datos').disabled=false;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc2="+numdoc2)
	
}

function cargar_data(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	fec_desde = document.getElementById('fec_desde').value;
	fec_hasta = document.getElementById('fec_hasta').value;
	m_form = document.getElementById('m_form').checked;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","cargar_data.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.getElementById('datos').disabled=true;
			document.getElementById('datosc').disabled=false;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta+"&m_form="+m_form)
	
	}
	
function cargar_datac(){
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
	ajax.open("POST","cargar_data_comple.php",true);
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
	
	}