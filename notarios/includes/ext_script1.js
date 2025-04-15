// JavaScript Document
 /*
 * Commentarios   : extensor ext_script1 
 * Fecha Creacion : 25/01/2013
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
//muestra datos en el grid:
function muestragrid()
{
	divResultado = document.getElementById('dgrid_kardex');
	divResultado.innerHTML= '<br><center><img src="../../loading.gif"></center>';

	var _idkar = document.getElementById('txtbuscar').value;

	ajax=objetoAjax();

	ajax.open("POST", "../controller/gridkardex.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4  && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idkar="+_idkar)	
}


//Guarda nuevos datos del tipo de kardex
function fguardaTipKar()
{	
	var idkar = document.getElementById('idtipkar').value;
	var tipkar = document.getElementById('tipkar').value;
	var nomtipkar = document.getElementById('nomtipkar').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardatipkar.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idkar="+idkar+"&tipkar="+tipkar+"&nomtipkar="+nomtipkar);

}

//Edita datos del tipo de kardex
function feditaTipKar()
{	
	var idkar = document.getElementById('idtipkar').value;
	var tipkar = document.getElementById('tipkar').value;
	var nomtipkar = document.getElementById('nomtipkar').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/edittipkar.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idkar="+idkar+"&tipkar="+tipkar+"&nomtipkar="+nomtipkar);

}


//Elimina datos del tipo de kardex
function fElimItemGrid()
{	
	var idkar = document.getElementById('idkardex').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimtipkarmon.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');
			window.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idkar="+idkar);

}
// #= FUNCIONES PARA ACTOS.
// =# Edita los tipos de actos

function feditaActos()
{	
	var _idtipoacto = document.getElementById('idtipoacto').value; 
	var _actosunat = document.getElementById('actosunat').value ;
	var _actouif = document.getElementById('actouif').value ;
	var _idtipkar = document.getElementById('idtipkar').value ;
	var _desacto = document.getElementById('desacto').value ;
	var _umbral = document.getElementById('umbral').value ;
	var _impuestos = document.getElementById('impuestos').value; 
	var _idcalnot = document.getElementById('idcalnot').value ;
	var _idecalreg = document.getElementById('idecalreg').value ;
	var _idmodelo = document.getElementById('idmodelo').value	;	
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editacto.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipoacto="+_idtipoacto+"&actosunat="+_actosunat+"&actouif="+_actouif+"&idtipkar="+_idtipkar+"&desacto="+_desacto+"&umbral="+_umbral+"&impuestos="+_impuestos+"&idcalnot="+_idcalnot+"&idecalreg="+_idecalreg+"&idmodelo="+_idmodelo);

}

// #= Guarda nuevo tipo de acto.
function fguardaTipActo()
{	
	var _idtipoacto = document.getElementById('idtipoacto').value; 
	var _actosunat  = document.getElementById('actosunat').value ;
	var _actouif 	= document.getElementById('actouif').value   ;
	var _idtipkar 	= document.getElementById('idtipkar').value  ;
	var _desacto 	= document.getElementById('desacto').value   ;
	var _umbral 	= document.getElementById('umbral').value    ;
	var _impuestos 	= document.getElementById('impuestos').value ; 
	var _idcalnot 	= document.getElementById('idcalnot').value  ;
	var _idecalreg 	= document.getElementById('idecalreg').value ;
	var _idmodelo 	= document.getElementById('idmodelo').value	 ;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaActo.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipoacto="+_idtipoacto+"&actosunat="+_actosunat+"&actouif="+_actouif+"&idtipkar="+_idtipkar+"&desacto="+_desacto+"&umbral="+_umbral+"&impuestos="+_impuestos+"&idcalnot="+_idcalnot+"&idecalreg="+_idecalreg+"&idmodelo="+_idmodelo);

}

//Elimina datos del tipo de actos
function fElimTipActo()
{	
	var idtipoacto = document.getElementById('idtipoacto').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimtipacto.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');
			window.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipoacto="+idtipoacto);

}

// Para grabar la edicion de cliente:
function grabEdiCliente()
{
	//donde se mostrará el resultado
	//divResultado = document.getElementById('frmclient');
	//tomamos el valor de la lista desplegable
	
	numdoc3=document.frmprotocolares.numdoc3.value;
	apepat3=document.frmprotocolares.apepat3.value;
	apemat3=document.frmprotocolares.apemat3.value;
	prinom3=document.frmprotocolares.prinom3.value;
	segnom3=document.frmprotocolares.segnom3.value;
	direccion3=document.frmprotocolares.direccion3.value;
	email3=document.frmprotocolares.email3.value;
	telfijo3=document.frmprotocolares.telfijo3.value;
	telcel3=document.frmprotocolares.telcel3.value;
	telofi3=document.frmprotocolares.telofi3.value;
	sexo3=document.frmprotocolares.sexo3.value;
	idestcivil3=document.frmprotocolares.idestcivil3.value;
	nacionalidad3=document.frmprotocolares.nacionalidad3.value;
	idprofesion3=document.frmprotocolares.idprofesion3.value;
	idcargoo3=document.frmprotocolares.idcargoo3.value;
	cumpclie3=document.frmprotocolares.cumpclie3.value;
	natper3=document.frmprotocolares.natper3.value;
	codubisc3=document.frmprotocolares.codubisc3.value;
	nomprofesiones3=document.frmprotocolares.nomprofesiones3.value;
	nomcargoss3=document.frmprotocolares.nomcargoss3.value;
	ubigensc3=document.frmprotocolares.ubigensc3.value;
	residente3=document.frmprotocolares.residente3.value;
	docpaisemi3=document.frmprotocolares.docpaisemi3.value;
	codclie3=document.frmprotocolares.codclie3.value;	
	//cconyuge6=document.frmprotocolares.cconyuge6.value;	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente3.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			
			//divResultado.innerHTML = ajax.responseText;
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc3="+numdoc3+"&apepat3="+apepat3+"&apemat3="+apemat3+"&prinom3="+prinom3+"&segnom3="+segnom3+"&direccion3="+direccion3+"&email3="+email3+"&telfijo3="+telfijo3+"&telcel3="+telcel3+"&telofi3="+telofi3+"&sexo3="+sexo3+"&idestcivil3="+idestcivil3+"&nacionalidad3="+nacionalidad3+"&idprofesion3="+idprofesion3+"&idcargoo3="+idcargoo3+"&cumpclie3="+cumpclie3+"&natper3="+natper3+"&codubisc3="+codubisc3+"&nomprofesiones3="+nomprofesiones3+"&nomcargoss3="+nomcargoss3+"&ubigensc3="+ubigensc3+"&residente3="+residente3+"&docpaisemi3="+docpaisemi3+"&codclie3="+codclie3)
	
}

// Para grabar clientes nuevos:
function grabNewClient()
{

	tipoper = document.getElementById('tipoper').value;
	tipodoc = document.getElementById('tipodoc').value;
	numdoc = document.getElementById('numdoc').value;
	apepat = document.getElementById('apepat').value;
	apemat = document.getElementById('apemat').value;
	prinom = document.getElementById('prinom').value;
	segnom = document.getElementById('segnom').value;
	direccion = document.getElementById('direccion').value;
	email = document.getElementById('email').value;
	telfijo = document.getElementById('telfijo').value;
	telcel = document.getElementById('telcel').value;
	telofi = document.getElementById('telofi').value;
	sexo = document.getElementById('sexo').value;
	idestcivil = document.getElementById('idestcivil').value;
	nacionalidad = document.getElementById('nacionalidad').value;
	idprofesion = document.getElementById('idprofesion').value;
	idcargoo = document.getElementById('idcargoo').value;
	cumpclie = document.getElementById('cumpclie').value;
	natper = document.getElementById('natper').value;
	codubisc = document.getElementById('codubisc').value;
	nomprofesiones = document.getElementById('nomprofesiones').value;
	nomcargoss = document.getElementById('nomcargoss').value;
	ubigensc = document.getElementById('ubigensc').value;
	//cconyuge = document.getElementById('cconyuge').value;
	residente = document.getElementById('residente').value;
	docpaisemi = document.getElementById('docpaisemi').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi)
	
}


// Para mostrar los codigos ubigeo
function buscaubigeosscNew()
{ divResultado = document.getElementById('resulubisc');
	buscaubisc = document.getElementById('buscaubisc3').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc)
}

// PARA MOSTRAR LOS CODIGOS DE PROFESIONES:
function buscaprofesionesNew()
{ 	divResultado = document.getElementById('resulprofesiones');
	buscaprofes =  document.getElementById('buscaprofes').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes)
}

// MOSTRAR LOS CODIGOS DE CARGOS

function buscacarguitossNew()
{ 	divResultado = document.getElementById('resulcargito');
	buscacargooss = document.getElementById('buscacargooss').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss="+buscacargooss)
}

// MOSTRAR UBIGEO PARA EDICION

function buscaubigeosscEdit()
{   
	divResultado = document.getElementById('resulubisc3');

	_buscaubisc3 = document.getElementById('buscaubisc33').value;

	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc3.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc3="+_buscaubisc3);
}

// MOSTRAR PROFESION APRA EDICION
function buscaprofesionesEdit()
{ 	divResultado = document.getElementById('resulprofesiones3');
	buscaprofes3 = document.getElementById('buscaprofes3').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes3="+buscaprofes3)
}

// MOSTARR CARGO PARA EDICION
function buscacarguitossEdit()
{ 	divResultado = document.getElementById('resulcargito3');
	buscacargooss3 = document.getElementById('buscacargooss3').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss3="+buscacargooss3)
}

// EDITAR CONDICIONES

function feditaCondiciones()
{	
	var _idcondicion = document.getElementById('idcondicion').value; 
	var _idtipoacto = document.getElementById('idtipoacto').value ;
	var _condicion = document.getElementById('condicion').value ;
	var _parte = document.getElementById('parte').value ;
	var _uif = document.getElementById('uif').value ;
	var _formulario = document.getElementById('formulario').value ;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editcondi.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idcondicion="+_idcondicion+"&idtipoacto="+_idtipoacto+"&condicion="+_condicion+"&parte="+_parte+"&uif="+_uif+"&formulario="+_formulario);

}

// GRABAR NUEVAS CONDICIONES.

function fguardaCondicion()
{	
	var _idcondicion = document.getElementById('idcondicion').value; 
	var _idtipoacto = document.getElementById('idtipoacto').value ;
	var _condicion = document.getElementById('condicion').value ;
	var _parte = document.getElementById('parte').value ;
	var _uif = document.getElementById('uif').value ;
	var _formulario = document.getElementById('formulario').value ;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaCondicion.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idcondicion="+_idcondicion+"&idtipoacto="+_idtipoacto+"&condicion="+_condicion+"&parte="+_parte+"&uif="+_uif+"&formulario="+_formulario);

}

//ELIMINA CONDICION.
function fElimCondicion()
{	
	var _idcondicion = document.getElementById('idcondicion').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimCondicion.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');
			window.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idcondicion="+_idcondicion);

}


// EDITA IMPEDIDOS
function feditImpedido()
{	
var _idimpedido = document.getElementById('idimpedido').value;
var _idcliente  = document.getElementById('idcliente').value;
var  _descli    = document.getElementById('descliente').value;
var _fechaing   = document.getElementById('fechaing').value;
var _oficio     = document.getElementById('oficio').value;
var _origen     = document.getElementById('origen').value;
var _motivo     = document.getElementById('motivo').value;
var _pep        = document.getElementById('pep').value;
var _laft       = document.getElementById('laft').value; 				 
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editImpedido.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idimpedido="+_idimpedido+"&idcliente="+_idcliente+"&descli="+_descli+"&fechaing="+_fechaing+"&oficio="+_oficio+"&origen="+_origen+"&motivo="+_motivo+"&pep="+_pep+"&laft="+_laft);

}
// ELIMINA IMPEDIDOS

//AGREGA IMPEDIDOS
function grabNewImpedido()
{
	tipoper = document.getElementById('tipoper').value;
	tipodoc = document.getElementById('tipodoc').value;
	numdoc = document.getElementById('numdoc').value;
	apepat = document.getElementById('apepat').value;
	apemat = document.getElementById('apemat').value;
	prinom = document.getElementById('prinom').value;
	segnom = document.getElementById('segnom').value;
	direccion = document.getElementById('direccion').value;
	email = document.getElementById('email').value;
	telfijo = document.getElementById('telfijo').value;
	telcel = document.getElementById('telcel').value;
	telofi = document.getElementById('telofi').value;
	sexo = document.getElementById('sexo').value;
	idestcivil = document.getElementById('idestcivil').value;
	nacionalidad = document.getElementById('nacionalidad').value;
	idprofesion = document.getElementById('idprofesion').value;
	idcargoo = document.getElementById('idcargoo').value;
	cumpclie = document.getElementById('cumpclie').value;
	natper = document.getElementById('natper').value;
	codubisc = document.getElementById('codubisc').value;
	nomprofesiones = document.getElementById('nomprofesiones').value;
	nomcargoss = document.getElementById('nomcargoss').value;
	ubigensc = document.getElementById('ubigensc').value;
	//cconyuge = document.getElementById('cconyuge').value;
	residente = document.getElementById('residente').value;
	docpaisemi = document.getElementById('docpaisemi').value;
	
	// Datos de Impedido:
	var _fechaing  = document.getElementById('fechaing').value;
	var _oficio    = document.getElementById('oficio').value;
	var _origen    = document.getElementById('origen').value;
	var _motivo    = document.getElementById('motivo').value;
	var _pep       = document.getElementById('pep').value;
	var _laft      = document.getElementById('laft').value; 				 

	ajax=objetoAjax();
	
	ajax.open("POST","grabar_impedido.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi+"&fechaing="+_fechaing+"&oficio="+_oficio+"&origen="+_origen+"&motivo="+_motivo+"&pep="+_pep+"&laft="+_laft)
	
}


// PARA BUSCAR CONYUGES Y AGREGARLO AL CLIENTE
function buscaclientes2()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('nuevaconyuge');
	//tomamos el valor de la lista desplegable
	numdoc2 = document.getElementById('numdoc2').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","buscadni.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc2="+numdoc2)
	
}



