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




function config_inicial(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	ini_sisnot      = document.getElementById('ini_sisnot').checked;
	ini_correlativo = document.getElementById('ini_correlativo').checked;
	ini_banco       = document.getElementById('ini_banco').checked;
	ajax=objetoAjax();
	ajax.open("POST","config_inicial.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		//	document.getElementById('datos').disabled=true;
		//	document.getElementById('datosc').disabled=false;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&ini_sisnot="+ini_sisnot+"&ini_correlativo="+ini_correlativo+"&ini_banco="+ini_banco)
	
	}
	
