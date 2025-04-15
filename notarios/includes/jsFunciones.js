// JavaScript Document
// Libreria jsFunciones.js

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


// #= funcion para pasar los datos
function mostrarDatos()
{
	divResultado = document.getElementById('edit_div');
	divResultado.innerHTML= '<img src="../loading.gif">';

<!-- ################################################ -->
	// codigo para editar:
	codmovreg 	= document.frmprotocolares.codmovreg.value;
	// codigo del movimiento
	itemcodmovreg = document.frmprotocolares.itemcodmovreg.value;
	//divResultado = document.getElementById('sssss');
	codkardex 	= document.frmprotocolares.codkardex.value; //para evaluar
<!-- ################################################ -->

	ajax=objetoAjax();
	ajax.open("POST","mostrar_regpublicos_list.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&codmovreg="+codmovreg+"&itemcodmovreg="+itemcodmovreg);
	
}


// #= Funcion para editar movimiento
// #= se le pasa idkardex & idmov
function Editarmov()
{
	// codigo para editar:
	codmovreg 	= document.frmprotocolares.codmovreg.value;
	// codigo del movimiento
	itemcodmovreg = document.frmprotocolares.itemcodmovreg.value;
	
	//divResultado = document.getElementById('sssss');
	codkardex 	= document.frmprotocolares.codkardex.value; //para evaluar
	
	fechamov 	= document.frmprotocolares.fechamovE.value;    //OK
	vencimiento = document.frmprotocolares.vencimientoE.value; //OK
	idsedereg 	= document.frmprotocolares.idsederegE.value; //OK
	idsecreg 	= document.frmprotocolares.idsecregE.value;  //OK
	titulorp 	= document.frmprotocolares.titulorpE.value;  //OK
	idtiptraoges = document.frmprotocolares.idtiptraogesE.value; //OK
	idestreg 	= document.frmprotocolares.idestregE.value;  //OK
	importee 	= document.frmprotocolares.importeeE.value;  //OK
	codusuario 	= document.frmprotocolares.codusuario.value;  // SESION
	anotacion 	= document.frmprotocolares.anotacionE.value;  //OK
	numeroo 	= document.frmprotocolares.numeroo.value;
	mayorderecho = document.frmprotocolares.mayorderecho.value;
	observa 	= document.frmprotocolares.observaE.value;  //OK
	conestado 	= document.frmprotocolares.conestado.value;  
	//aqui enviar cobrado eso sera con el modulo de facturacion 
	
	ajax=objetoAjax();
	ajax.open("POST","editar_movimiento.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)&& ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			//mostrarnewreg();
			//alert("Movimiento grabado satisfactoriamente");
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fechamov="+fechamov+"&vencimiento="+vencimiento+"&idsedereg="+idsedereg+"&idsecreg="+idsecreg+"&titulorp="+titulorp+"&idtiptraoges="+idtiptraoges+"&idestreg="+idestreg+"&importee="+importee+"&codusuario="+codusuario+"&anotacion="+anotacion+"&codmovreg="+codmovreg+"&mayorderecho="+mayorderecho+"&numeroo="+numeroo+"&observa="+observa+"&conestado="+conestado);
	
}