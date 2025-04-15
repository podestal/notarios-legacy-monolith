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



function exportaescact()
{
	fechadesde=document.getElementById('desde').value;
	fechahasta=document.getElementById('hasta').value;
	ajax=objetoAjax();
	ajax.open("POST","pdtescriAct.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechadesde="+fechadesde+"&fechahasta="+fechahasta)
	
}

function exportaescbie()
{
	
	
	fechadesde=document.getElementById('desde').value;
	fechahasta=document.getElementById('hasta').value;
	ajax=objetoAjax();
	ajax.open("POST","pdtescriBie.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechadesde="+fechadesde+"&fechahasta="+fechahasta)
	
}

function exportaescfor()
{
	
	
	fechadesde=document.getElementById('desde').value;
	fechahasta=document.getElementById('hasta').value;
	ajax=objetoAjax();
	ajax.open("POST","pdtescriFor.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechadesde="+fechadesde+"&fechahasta="+fechahasta)
	
}

function exportaescmpa()
{
	fechadesde=document.getElementById('desde').value;
	fechahasta=document.getElementById('hasta').value;
	ajax=objetoAjax();
	ajax.open("POST","pdtescriMpa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechadesde="+fechadesde+"&fechahasta="+fechahasta)
	
}

function exportaescotg()
{
	fechadesde=document.getElementById('desde').value;
	fechahasta=document.getElementById('hasta').value;
	ajax=objetoAjax();
	ajax.open("POST","pdtescriOtg.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechadesde="+fechadesde+"&fechahasta="+fechahasta)
	
}

