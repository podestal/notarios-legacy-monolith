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


// devuelve el resultado como dato de funcion
function fShowAjaxDato(url){
		
		   _ajax = objetoAjax();
		    var _pag = '';
		    _ajax.open('GET', url,false);
		    _ajax.onreadystatechange = function(){
				
		    if(_ajax.readyState==4 && _ajax.status==200)
			{ 
		     _pag = _ajax.responseText;

			 }
		  }
	  _ajax.send(null);
	  return _pag; 
	  			 
	}

// CREA BLOQUES DE KARDEX (VARIOS KARDEX) DEACUERDO AL NUMERO DE KARDEX Y KARDEX INICIAL SELECCIONADOS
function fcreaBloqueKar()
{

	var _num_kinicial    = document.getElementById('num_kinicial').value;
	var _num_registros   = document.getElementById('num_registros').value;
	var _fec_ingreso     = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaBloqueCartas.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo El Bloque de '+_num_registros+' Kardex satisfactoriamente');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_registros="+_num_registros+"&num_kinicial="+_num_kinicial+"&fec_ingreso="+_fec_ingreso);
		
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
	var _actosunat  = document.getElementById('actosunat').value ;
	var _actouif    = document.getElementById('actouif').value ;
	var _idtipkar   = document.getElementById('idtipkar').value ;
	var _desacto    = document.getElementById('desacto').value ;
	var _umbral     = document.getElementById('umbral').value ;
	var _impuestos  = document.getElementById('impuestos').value; 
	var _idcalnot   = document.getElementById('idcalnot').value ;
	var _idecalreg  = document.getElementById('idecalreg').value ;
	var _idmodelo   = document.getElementById('idmodelo').value	;	
	
	ajax = objetoAjax();

	ajax.open("POST", "../model/editacto.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			//window.parent.document.location.reload();
		var _escrituras   = window.parent.document.getElementById('escrituras').checked;
		var _asuntos      = window.parent.document.getElementById('asuntos').checked;
		var _vehicular    = window.parent.document.getElementById('vehicular').checked;
		var _mobiliaria   = window.parent.document.getElementById('mobiliaria').checked;
		var _testamentos  = window.parent.document.getElementById('testamentos').checked;
		
		if( _escrituras==true  || _asuntos==true || _vehicular==true || _mobiliaria==true || _testamentos==true )
		{var _tipkar = "1";}	else {var _tipkar = "0";}
		if(_escrituras==true)
		{_val = '1';}
			else if(_asuntos==true)
			{_val = '2';}
				else if(_vehicular==true)
				{_val = '3';}
					else if(_mobiliaria==true)
					{_val = '4';}
						else if(_testamentos==true)
						{_val = '5';}
							else {_val = 'ini';}
		$("#dgrid_kardex", window.parent.document).load('../view/list_tipoacto.php' ,	{_epublic  : _tipkar, val     : _val});
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
		var _escrituras   = window.parent.document.getElementById('escrituras').checked;
		var _asuntos      = window.parent.document.getElementById('asuntos').checked;
		var _vehicular    = window.parent.document.getElementById('vehicular').checked;
		var _mobiliaria   = window.parent.document.getElementById('mobiliaria').checked;
		var _testamentos  = window.parent.document.getElementById('testamentos').checked;
		
		if( _escrituras==true  || _asuntos==true || _vehicular==true || _mobiliaria==true || _testamentos==true )
		{var _tipkar = "1";}	else {var _tipkar = "0";}
		if(_escrituras==true)
		{_val = '1';}
			else if(_asuntos==true)
			{_val = '2';}
				else if(_vehicular==true)
				{_val = '3';}
					else if(_mobiliaria==true)
					{_val = '4';}
						else if(_testamentos==true)
						{_val = '5';}
							else {_val = 'ini';}
		$("#dgrid_kardex", window.parent.document).load('../view/list_tipoacto.php' ,	{_epublic  : _tipkar, val     : _val});	
		
		
		//$("#frameNewActo", window.parent.document).dialog("destroy").remove();
		//$(window.parent).dialog('close');
		
		// LIMPIA PARA AGREGAR NUEVO:
		document.getElementById('idtipoacto').value  = ""; 
		document.getElementById('actosunat').value   = "";
		document.getElementById('actouif').value     = "";
		document.getElementById('idtipkar').value    = "";
		document.getElementById('desacto').value     = "";
		document.getElementById('umbral').value      = "";
		document.getElementById('impuestos').value   = ""; 
		document.getElementById('idcalnot').value    = "";
		document.getElementById('idecalreg').value   = "";
		document.getElementById('idmodelo').value	 = "";
		
		}
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
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
			
		var _escrituras   = document.getElementById('escrituras').checked;
		var _asuntos      = document.getElementById('asuntos').checked;
		var _vehicular    = document.getElementById('vehicular').checked;
		var _mobiliaria   = document.getElementById('mobiliaria').checked;
		var _testamentos  = document.getElementById('testamentos').checked;
		
		if( _escrituras==true  || _asuntos==true || _vehicular==true || _mobiliaria==true || _testamentos==true )
		{var _tipkar = "1";}	else {var _tipkar = "0";}
		if(_escrituras==true)
		{_val = '1';}
			else if(_asuntos==true)
			{_val = '2';}
				else if(_vehicular==true)
				{_val = '3';}
					else if(_mobiliaria==true)
					{_val = '4';}
						else if(_testamentos==true)
						{_val = '5';}
							else {_val = 'ini';}
		$("#dgrid_kardex").load('../view/list_tipoacto.php' ,	{_epublic  : _tipkar, val     : _val});	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idtipoacto="+idtipoacto);

}

// Para grabar la edicion de cliente:
function grabEdiCliente()
{
	//donde se mostrará el resultado
	//divResultado = document.getElementById('frmclient');
	//tomamos el valor de la lista desplegable
	//tipoper = document.getElementById('tipoper').value;
	//new : tipdocu
	var _tipodoc = document.getElementById('tipdocu').value;
	var _numdoc = document.getElementById('numdoc3').value;
	var _codclie = document.getElementById('codclie').value;
	var _apepat = document.getElementById('apepat3').value;
	var _apemat = document.getElementById('apemat3').value;
	var _prinom = document.getElementById('prinom3').value;
	var _segnom = document.getElementById('segnom3').value;
	var _direccion = document.getElementById('direccion3').value;
	var _email = document.getElementById('email3').value;
	var _telfijo = document.getElementById('telfijo3').value;
	var _telcel = document.getElementById('telcel3').value;
	var _telofi = document.getElementById('telofi3').value;
	var _sexo = document.getElementById('sexo3').value;
	var _idestcivil = document.getElementById('idestcivil3').value;
	var _nacionalidad = document.getElementById('nacionalidad3').value;
	var _idprofesion = document.getElementById('idprofesion3').value;
	var _idcargoo = document.getElementById('idcargoo3').value;
	var _cumpclie = document.getElementById('cumpclie3').value;
	var _natper = document.getElementById('natper3').value;
	var _codubisc = document.getElementById('codubisc3').value;
	var _ubigensc = document.getElementById('codubisc3').value;
	var _nomprofesiones = document.getElementById('nomprofesiones3').value;
	var _nomcargoss = document.getElementById('nomcargoss3').value;
	
	//cconyuge = document.getElementById('cconyuge').value;
	var _residente = document.getElementById('residente3').value;
	var _docpaisemi = document.getElementById('docpaisemi3').value;

	ajax=objetoAjax();

	ajax.open("POST","grabar_cliente3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//divResultado.innerHTML = ajax.responseText;
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc="+_numdoc+"&codclie="+_codclie+"&apepat="+_apepat+"&apemat="+_apemat+"&prinom="+_prinom+"&segnom="+_segnom+"&direccion="+_direccion+"&email="+_email+"&telfijo="+_telfijo+"&telcel="+_telcel+"&telofi="+_telofi+"&sexo="+_sexo+"&idestcivil="+_idestcivil+"&nacionalidad="+_nacionalidad+"&idprofesion="+_idprofesion+"&idcargoo="+_idcargoo+"&cumpclie="+_cumpclie+"&natper="+_natper+"&codubisc="+_codubisc+"&nomprofesiones="+_nomprofesiones+"&nomcargoss="+_nomcargoss+"&ubigensc="+_ubigensc+"&residente="+_residente+"&docpaisemi="+_docpaisemi+"&tipodoc="+_tipodoc)
	
}

function grabNewConyuge()
{
	
	divResultado = document.getElementById('ccconyuge');
	numdoc = document.getElementById('numdoc2').value;
	apepat = document.getElementById('apepat2').value;
	apemat = document.getElementById('apemat2').value;
	prinom = document.getElementById('prinom2').value;
	segnom = document.getElementById('segnom2').value;
	direccion = document.getElementById('direccion2').value;
	email = document.getElementById('email2').value;
	telfijo = document.getElementById('telfijo2').value;
	telcel = document.getElementById('telcel2').value;
	telofi = document.getElementById('telofi2').value;
	sexo = document.getElementById('sexo2').value;
	idestcivil = document.getElementById('idestcivil2').value;
	nacionalidad = document.getElementById('nacionalidad2').value;
	idprofesion = document.getElementById('idprofesion2').value;
	idcargoo = document.getElementById('idcargoo2').value;
	cumpclie = document.getElementById('cumpclie2').value;
	natper = document.getElementById('natper2').value;
	nomprofesiones = document.getElementById('nomprofesiones2').value;
	nomcargoss = document.getElementById('nomcargoss2').value;
	cconyuge = document.getElementById('cconyuge').value;
	residente = document.getElementById('residente2').value;
	docpaisemi = document.getElementById('docpaisemi2').value;
	codubisc = document.getElementById('codubis2').value;
	ubigensc = document.getElementById('ubigensc2').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			alert('Se guardo satisfactoriamente');
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("numdoc2="+numdoc+"&apepat2="+apepat+"&apemat2="+apemat+"&prinom2="+prinom+"&segnom2="+segnom+
	"&direccion2="+direccion+"&email2="+email+"&telfijo2="+telfijo+"&telcel2="+telcel+"&telofi2="+telofi+"&sexo2="+sexo+
	"&idestcivil2="+idestcivil+"&nacionalidad2="+nacionalidad+"&idprofesion2="+idprofesion+"&idcargoo2="+idcargoo+
	"&cumpclie2="+cumpclie+"&natper2="+natper+"&codubisc2="+codubisc+"&nomprofesiones2="+nomprofesiones+"&nomcargoss2="+nomcargoss+
	"&cconyuge="+cconyuge+"&ubigensc2="+ubigensc+"&residente2="+residente+"&docpaisemi2="+docpaisemi)

}

// Para grabar clientes nuevos:
function grabNewClient()
{

	var	 tipoper = document.getElementById('tipoper').value;
	var tipodoc = document.getElementById('tipodoc').value;
	var numdoc = document.getElementById('numdoc').value;
	var apepat = document.getElementById('apepat').value;
var 	apemat = document.getElementById('apemat').value;
var 	prinom = document.getElementById('prinom').value;
	var segnom = document.getElementById('segnom').value;
var 	direccion = document.getElementById('direccion').value;
	var email = document.getElementById('email').value;
var 	telfijo = document.getElementById('telfijo').value;
	var telcel = document.getElementById('telcel').value;
var 	telofi = document.getElementById('telofi').value;
	var sexo = document.getElementById('sexo').value;
var 	idestcivil = document.getElementById('idestcivil').value;
	var nacionalidad = document.getElementById('nacionalidad').value;
var 	idprofesion = document.getElementById('idprofesion').value;
	var idcargoo = document.getElementById('idcargoo').value;
var 	cumpclie = document.getElementById('cumpclie').value;
	var natper = document.getElementById('natper').value;
	
var 	nomprofesiones = document.getElementById('nomprofesiones').value;
	var nomcargoss = document.getElementById('nomcargoss').value;
var 	cconyuge = document.getElementById('cconyuge6').value;

	var residente = document.getElementById('residente').value;
var 	docpaisemi = document.getElementById('docpaisemi').value;
	var codubisc = document.getElementById('codubisc').value;
var 	ubigensc = document.getElementById('ubigensc').value;
var 	tipocli = document.getElementById('tipocli').value;


var 	nrooficio = document.getElementById('nrooficio').value;
var 	origenoficio = document.getElementById('origenoficio').value;
var 	entidad = document.getElementById('entidad').value;
var 	remitente = document.getElementById('remitente').value;
var 	motivo = document.getElementById('motivo').value;


	//instanciamos el objetoAjax
	ajax=objetoAjax();

	ajax.open("POST","grabar_cliente.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+
	"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+
	"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+
	"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+
	"&cconyuge="+cconyuge+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi+"&tipocli="+tipocli+"&nrooficio="+nrooficio+"&origenoficio="+origenoficio+"&entidad="+entidad+"&remitente="+remitente+"&motivo="+motivo)
	
}


function grabNewJurid2()
{
	//donde se mostrará el resultado
	//divResultado = document.getElementById('frmclient');
	//tomamos el valor de la lista desplegable
	
	var _tipoper = document.getElementById('tipoper').value;
	var _tipodoc = document.getElementById('tipodoc').value;
	var _razonsocial 		= document.getElementById('razonsocial').value;
	var _domfiscal			= document.getElementById('domfiscal').value;
	var _codubi 			= document.getElementById('codubisc4').value;
	var _ubigen 			= document.getElementById('codubisc4').value;
	var _contacempresa 		= document.getElementById('contacempresa').value;
	var _fechaconstitu 		= document.getElementById('fechaconstitu').value;
	var _numregistro 		= document.getElementById('numregistro').value;
	var _idsedereg3 		= document.getElementById('idsedereg3').value;
	var _numpartida 		= document.getElementById('numpartida').value;
	var _telempresa 		= document.getElementById('telempresa').value;
	var _actmunicipal 		= document.getElementById('actmunicipal').value;
	var _mailempresa 		= document.getElementById('mailempresa').value;
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_juridica.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//divResultado.innerHTML = ajax.responseText;
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
		ajax.send("tipoper="+_tipoper+"&tipodoc="+_tipodoc+"&codubi="+_codubi+"&razonsocial="+_razonsocial+"&domfiscal="+_domfiscal+"&ubigen="+_ubigen+"&contacempresa="+_contacempresa+"&fechaconstitu="+_fechaconstitu+"&numregistro="+_numregistro+"&idsedereg3="+_idsedereg3+"&numpartida="+_numpartida+"&telempresa="+_telempresa+"&actmunicipal="+_actmunicipal+"&mailempresa="+_mailempresa)	
}


function grabNewJurid()
{	

	var _tipoper = document.getElementById('tipoper').value;
	var _tipodoc = document.getElementById('tipodoc').value;
	var _razons = document.getElementById('razonsocial').value;
	var _numruc = document.getElementById('numruc').value;
	var _domf = document.getElementById('domfiscal').value;
	var _contace = document.getElementById('contacempresa').value;
	var _fechac = document.getElementById('fechaconstitu').value;
	var _numreg = document.getElementById('numregistro').value;
	var _idsedereg = document.getElementById('idsedereg3').value;
	var _numpar = document.getElementById('numpartida').value;
	var _telemp = document.getElementById('telempresa').value;
	var _atcmun = document.getElementById('actmunicipal').value;
	var _mailemp = document.getElementById('mailempresa').value;
	var _codubisc = document.getElementById('codubisc4').value;
	var _ubigen = document.getElementById('ubigen2').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_juridica.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+_tipoper+"&tipodoc="+_tipodoc+"&razons="+_razons+"&numruc="+_numruc+"&domf="+_domf+"&codubisc="+_codubisc+"&ubigen="+_ubigen+"&contace="+_contace+"&fechac="+fechaconstitu+"&numreg="+_numreg+"&idsedereg="+_idsedereg+"&numpar="+_numpar+"&telemp="+_telemp+"&atcmun="+_atcmun+"&mailemp="+_mailemp)
	
	}

function grabarempresa()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	tipoper=document.getElementById('tipoper').value;
	tipodoc=document.getElementById('tipodoc').value;
	numdoc=document.getElementById('numdoc').value;
	razonsocial=document.getElementById('razonsocial').value;
	domfiscal=document.getElementById('domfiscal').value;
	telempresa=document.getElementById('telempresa').value;
	mailempresa=document.getElementById('mailempresa').value;
	contacempresa=document.getElementById('contacempresa').value;
	fechaconstitu=document.getElementById('fechaconstitu').value;
	numregistro=document.getElementById('numregistro').value;
	numpartida=document.getElementById('numpartida').value;
	actmunicipal=document.getElementById('actmunicipal').value;
	codubi=document.getElementById('codubisc3').value;
	idsedereg3=document.getElementById('idsedereg3').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","../../grabar_empresa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
		alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3)
	
}


function grabEdiEmpresa()
{
	//donde se mostrará el resultado
	//divResultado = document.getElementById('frmclient');
	//tomamos el valor de la lista desplegable
	var _codclie 			= document.getElementById('codclie').value;
	
	var _razonsocial 		= document.getElementById('razonsocial').value;
	var _domfiscal			= document.getElementById('domfiscal').value;
	var _codubi 			= document.getElementById('codubisc4').value;
	var _ubigen 			= document.getElementById('codubisc4').value;
	var _contacempresa 		= document.getElementById('contacempresa').value;
	var _fechaconstitu 		= document.getElementById('fechaconstitu').value;
	var _numregistro 		= document.getElementById('numregistro').value;
	var _idsedereg3 		= document.getElementById('idsedereg3').value;
	var _numpartida 		= document.getElementById('numpartida').value;
	var _telempresa 		= document.getElementById('telempresa').value;
	var _actmunicipal 		= document.getElementById('actmunicipal').value;
	var _mailempresa 		= document.getElementById('mailempresa').value;
	// nuevo
	var _numero_ruc 		= document.getElementById('numero_ruc').value;
	
	var ajax = objetoAjax();
	ajax.open("POST","grabar_empresa3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//divResultado.innerHTML = ajax.responseText;
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
		ajax.send("&codclie="+_codclie+"&codubi="+_codubi+"&razonsocial="+_razonsocial+"&domfiscal="+_domfiscal+"&ubigen="+_ubigen+"&contacempresa="+_contacempresa+"&fechaconstitu="+_fechaconstitu+"&numregistro="+_numregistro+"&idsedereg3="+_idsedereg3+"&numpartida="+_numpartida+"&telempresa="+_telempresa+"&actmunicipal="+_actmunicipal+"&mailempresa="+_mailempresa+"&numero_ruc="+_numero_ruc);
}

function buscaubigeo()
{ divResultado = document.getElementById('resulubigeo');
	_buscaubi = document.getElementById('buscaubigeo').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeo.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubigeo="+_buscaubi)
}

function buscaubigeosscEdit()
{   
	divResultado = document.getElementById('resulubisc3');

	_buscaubisc3 = document.getElementById('buscaubisc33').value;

	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc3="+_buscaubisc3);
}

function buscaubigeosscEditJ()
{   
	divResultado = document.getElementById('resulubigeo');

	_buscaubigeo = document.getElementById('buscaubigeo').value;

	ajax=objetoAjax();
	ajax.open("POST","../controller/buscarubigeoscj.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
		}resulubigeo
		
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubigeo="+_buscaubigeo);
}


// Para mostrar los codigos ubigeo
function buscaubigeosscNew()
{ divResultado = document.getElementById('resulubisc');
	buscaubisc = document.getElementById('buscaubisc3').value;
		
	ajax=objetoAjax();
	ajax.open("POST","../controller/buscarubigeosc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc)
}
function buscaubigeossc2()
{
	divResultado = document.getElementById('resulubisc2');
	buscaubisc2 = document.getElementById('buscaubiscnuevo').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc2)

}
// PARA MOSTRAR LOS CODIGOS DE PROFESIONES:
function buscaprofesionesNew()
{ 	divResultado = document.getElementById('resulprofesiones');
	buscaprofes =  document.getElementById('buscaprofes').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","../controller/buscaprofesionnes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes)
}

function buscaprofesionesNew2()
{
	
	divResultado = document.getElementById('resulprofesiones2');
	buscaprofeconyuge =  document.getElementById('buscaprofeconyuge').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofeconyuge="+buscaprofeconyuge)
	
	}

// MOSTRAR LOS CODIGOS DE CARGOS

function buscacarguitossNew()
{ 	divResultado = document.getElementById('resulcargito');
	buscacargooss = document.getElementById('buscacargooss').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","../controller/buscacargos.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss="+buscacargooss)
}


function buscacarguitossNew2()
{ 	divResultado = document.getElementById('resulcargito2');
	buscacargooss2 = document.getElementById('buscacargooss2').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss2="+buscacargooss2)
}

// MOSTRAR UBIGEO PARA EDICION



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
	var _montop = document.getElementById('montop').value ;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editcondi.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			var _escrituras   = window.parent.document.getElementById('escrituras').checked;
			var _asuntos      = window.parent.document.getElementById('asuntos').checked;
			var _vehicular    = window.parent.document.getElementById('vehicular').checked;
			var _mobiliaria   = window.parent.document.getElementById('mobiliaria').checked;
			var _testamentos  = window.parent.document.getElementById('testamentos').checked;
			
			if( _escrituras==true  || _asuntos==true || _vehicular==true || _mobiliaria==true || _testamentos==true )
			{ var _tipkar = "1";}
			else { var _tipkar = "0"; }
			
			if(_escrituras==true)
			{_val = '1';}
				else if(_asuntos==true)
				{_val = '2';}
					else if(_vehicular==true)
					{_val = '3';}
						else if(_mobiliaria==true)
						{_val = '4';}
							else if(_testamentos==true)
							{_val = '5';}
								else {_val = 'ini';}
			$("#dgrid_kardex", window.parent.document).load('../view/list_ActoCon.php' ,  {_epublic  : _tipkar, val     : _val});
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idcondicion="+_idcondicion+"&idtipoacto="+_idtipoacto+"&condicion="+_condicion+"&parte="+_parte+"&uif="+_uif+"&formulario="+_formulario+"&montop="+_montop);

}

// GRABAR NUEVAS CONDICIONES.

function fguardaCondicion()
{	
	var _idcondicion = document.getElementById('idcondicion').value; 
	var _idtipoacto  = document.getElementById('idtipoacto').value ;
	var _condicion   = document.getElementById('condicion').value ;
	var _parte       = document.getElementById('parte').value ;
	var _uif         = document.getElementById('uif').value ;
	var _formulario  = document.getElementById('formulario').value ;
	var _montop      = document.getElementById('montop').value ;
	
	var ajax = objetoAjax();

	ajax.open("POST", "../model/guardaCondicion.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se guardo satisfactoriamente');
			//window.parent.document.location.reload();
			var _escrituras   = window.parent.document.getElementById('escrituras').checked;
			var _asuntos      = window.parent.document.getElementById('asuntos').checked;
			var _vehicular    = window.parent.document.getElementById('vehicular').checked;
			var _mobiliaria   = window.parent.document.getElementById('mobiliaria').checked;
			var _testamentos  = window.parent.document.getElementById('testamentos').checked;
			
			if( _escrituras==true  || _asuntos==true || _vehicular==true || _mobiliaria==true || _testamentos==true )
			{ var _tipkar = "1";}
			else { var _tipkar = "0"; }
			
			if(_escrituras==true)
			{_val = '1';}
				else if(_asuntos==true)
				{_val = '2';}
					else if(_vehicular==true)
					{_val = '3';}
						else if(_mobiliaria==true)
						{_val = '4';}
							else if(_testamentos==true)
							{_val = '5';}
								else {_val = 'ini';}
			$("#dgrid_kardex", window.parent.document).load('../view/list_ActoCon.php' ,  {_epublic  : _tipkar, val     : _val});
			document.getElementById('idcondicion').value = ""; 
			document.getElementById('idtipoacto').value  = "";
			document.getElementById('condicion').value   = "";
			document.getElementById('parte').value       = "";
			document.getElementById('uif').value         = "";
			document.getElementById('formulario').value  = "1";
			document.getElementById('montop').value      = "";	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idcondicion="+_idcondicion+"&idtipoacto="+_idtipoacto+"&condicion="+_condicion+"&parte="+_parte+"&uif="+_uif+"&formulario="+_formulario+"&montop="+_montop);

}

//ELIMINA CONDICION.
function fElimCondicion()
{	
	var _idcondicion = document.getElementById('idcondicion').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimCondicion.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			var _escrituras   = document.getElementById('escrituras').checked;
			var _asuntos      = document.getElementById('asuntos').checked;
			var _vehicular    = document.getElementById('vehicular').checked;
			var _mobiliaria   = document.getElementById('mobiliaria').checked;
			var _testamentos  = document.getElementById('testamentos').checked;
			
			if( _escrituras==true  || _asuntos==true || _vehicular==true || _mobiliaria==true || _testamentos==true )
			{ var _tipkar = "1";}
			else { var _tipkar = "0"; }
			
			if(_escrituras==true)
			{_val = '1';}
				else if(_asuntos==true)
				{_val = '2';}
					else if(_vehicular==true)
					{_val = '3';}
						else if(_mobiliaria==true)
						{_val = '4';}
							else if(_testamentos==true)
							{_val = '5';}
								else {_val = 'ini';}
			$("#dgrid_kardex").load('../view/list_ActoCon.php' ,  {_epublic  : _tipkar, val     : _val});
			
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
	
	// new:
	var _entidad    = document.getElementById('entidad').value; 
	var _remite     = document.getElementById('remite').value; 				 
	
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
	ajax.send("idimpedido="+_idimpedido+"&idcliente="+_idcliente+"&descli="+_descli+"&fechaing="+_fechaing+"&oficio="+_oficio+"&origen="+_origen+"&motivo="+_motivo+"&pep="+_pep+"&laft="+_laft+"&entidad="+_entidad+"&remite="+_remite);

}
// ELIMINA IMPEDIDOS

//AGREGA IMPEDIDOS



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
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc2="+numdoc2)
	
}


///#=== SELLOS GUARDAR
//Guarda nuevos datos del SELLO
function fguardaSello()
{	
	var _dessello = document.getElementById('dessello').value;
	var _contenido = document.getElementById('contenido').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/savesello.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("dessello="+_dessello+"&contenido="+_contenido);

}

function fguardaPermiUsuario(){
	
	
	var _id_uduario = document.getElementById('id_uduario').value;
	var _numcampos = document.getElementById('numcampos').value;
	
	
	var _chk_protocolares = document.getElementById('chk_protocolares').checked;
		if(_chk_protocolares == true){
		var chk1 = 1;
		}else {var chk1 = 0;}
		
		
	var _chk_extraproto = document.getElementById('chk_extraproto').checked;
		if(_chk_extraproto == true){
		var chk2 = 1;
		}else {var chk2 = 0;}
		
		
	var _chk_reportes = document.getElementById('chk_reportes').checked;
		if(_chk_reportes == true){
		var chk3 = 1;
		}else {var chk3 = 0;}
		
		
	var _chk_caja = document.getElementById('chk_caja').checked;
		if(_chk_caja == true){
		var chk4 = 1;
		}else {var chk4 = 0;}
		
		
	var _chk_usuarios = document.getElementById('chk_usuarios').checked;
		if(_chk_usuarios == true){
		var chk5 = 1;
		}else {var chk5 = 0;}
		
		
	var _chk_herramientas = document.getElementById('chk_herramientas').checked;
		if(_chk_herramientas == true){
		var chk6 = 1;
		}else {var chk6 = 0;}
		
		
	var _chk_config = document.getElementById('chk_config').checked;
		if(_chk_config == true){
		var chk7 = 1;
		}else {var chk7 = 0;}
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardarpermisos.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_usuario="+_id_uduario+"&numcampos="+_numcampos+"&chk1="+chk1+"&chk2="+chk2+"&chk3="+chk3+"&chk4="+chk4+"&chk5="+chk5+"&chk6="+chk6+"&chk7="+chk7);
}



function fgrabservicios()
{
	
	divResultado = document.getElementById('resul_certi');
	
	divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';	

	//var id_domiciliario
	
	var _codigoservi = document.getElementById('codigoservi').value;
	var _descriservi     = document.getElementById('descriservi').value;
	var _tiposervi       = document.getElementById('tiposervi').value;
	var _precio1    = document.getElementById('servprecio1').value;
	var _abrevservi    = document.getElementById('abrevservi').value;
	var _precio2    = document.getElementById('servprecio2').value;
	var _gruposervi     = document.getElementById('gruposervi').value;
	var _porcenservi    = document.getElementById('porcenservi').value;
	var _kardexservi  = document.getElementById('kardexservi').value;
	var _infservi    = document.getElementById('infservi').value;
	var _actiservi  = document.getElementById('actiservi').value;
	var _areaservi  = document.getElementById('areaservi').value;
	var _serarea  = document.getElementById('serarea').value;
	ajax=objetoAjax();

	ajax.open("POST", "../model/editServicio.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Certificado satisfactoriamente');
			divResultado.innerHTML  = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;margin:0 auto;border: 2px solid #ddd; border-radius: 10px;padding: 2px; box-shadow: #ccc 5px 0 5px; margin-bottom:0px;'><center>Guardado satisfactoriamente</center></div>";
			//agregar();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codigoservi="+_codigoservi+"&descriservi="+_descriservi+"&tiposervi="+_tiposervi+"&precio1="+_precio1+"&abrevservi="+_abrevservi+"&precio2="+_precio2+"&gruposervi="+_gruposervi+"&porcenservi="+_porcenservi+"&kardexservi="+_kardexservi+"&infservi="+_infservi+"&actiservi="+_actiservi+"&areaservi="+_areaservi+"&serarea="+_serarea);

}

function fgrabservicios2()
{
	
	divResultado = document.getElementById('resul_certi');
	
	divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';	

	//var id_domiciliario
	
	var _codigoservi  = document.getElementById('codigoservi').value;
	var _descriservi  = document.getElementById('descriservi').value;
	var _tiposervi    = document.getElementById('tiposervi').value;
	var _precio1      = document.getElementById('servprecio1').value;
	var _abrevservi   = document.getElementById('abrevservi').value;
	var _precio2      = document.getElementById('servprecio2').value;
	var _gruposervi   = document.getElementById('gruposervi').value;
	var _porcenservi  = document.getElementById('porcenservi').value;
	var _kardexservi  = document.getElementById('kardexservi').value;
	var _infservi     = document.getElementById('infservi').value;
	var _actiservi    = document.getElementById('actiservi').value;
	var _areaservi    = document.getElementById('areaservi').value;
	var _serarea      = document.getElementById('serarea').value;
	// new: 
	var _ctaserv      = document.getElementById('ctaserv').value;
	
	var ajax = objetoAjax();

	ajax.open("POST", "../model/guardarServicio.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Certificado satisfactoriamente');
			divResultado.innerHTML  = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;margin:0 auto;border: 2px solid #ddd; border-radius: 10px;padding: 2px; box-shadow: #ccc 5px 0 5px; margin-bottom:0px;'><center>Guardado satisfactoriamente</center></div>";
			//agregar();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codigoservi="+_codigoservi+"&descriservi="+_descriservi+"&tiposervi="+_tiposervi+"&precio1="+_precio1+"&abrevservi="+_abrevservi+"&precio2="+_precio2+"&gruposervi="+_gruposervi+"&porcenservi="+_porcenservi+"&kardexservi="+_kardexservi+"&infservi="+_infservi+"&actiservi="+_actiservi+"&areaservi="+_areaservi+"&serarea="+_serarea);

}




