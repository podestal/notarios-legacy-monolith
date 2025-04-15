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




function cargar_data(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="../../loading2.gif">';
	numdoc2 = "crear_backup";
	
	ajax=objetoAjax();
	ajax.open("POST","crear_backup.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			//document.getElementById('datos').disabled=true;
			//document.getElementById('datosc').disabled=false;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc2="+numdoc2)
	
	}
	
