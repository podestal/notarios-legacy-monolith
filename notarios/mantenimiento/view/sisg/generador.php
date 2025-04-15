<!DOCTYPE HTML>

<html>
	<head>
		<title>.-SISGEN-.</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" type="text/css" href="../../../Libs/bootstrap/css/bootstrap.min.css">
	</head>
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


function enviar_data_sisgen(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="ajax-loader.gif">';
	//tomamos el valor de la lista desplegable
	var _formu = (0);
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","enviarxml.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("formu="+_formu)
	
	}


</script>
	
	<body class="loading">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1>SISTEMA DE GESTION NOTARIAL - SISGEN</h1>
						<h3>GENERADOR DE ENVÍOS</h3>
						<nav>
							<body>
							
							
								
							</body>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						
					</footer>

			</div>
		</div>
		<script>
			window.onload = function() { document.body.className = ''; }
			window.ontouchmove = function() { return false; }
			window.onorientationchange = function() { document.body.scrollTop = 0; }
		</script>
	</body>
</html>