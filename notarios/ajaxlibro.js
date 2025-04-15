
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

function verboton(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('datolib');

	//tomamos el valor de la lista desplegable
	paterno="hola";

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "verbotonlibro.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("paterno="+paterno)
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function grabarlibrocant(){
	
	fecing=document.getElementById('fecing').value;
	cantidad=document.getElementById('cantidad').value;
	solicitante=document.getElementById('solicitante').value;
	dni=document.getElementById('dni').value;
	idusuario=document.getElementById('usuario').value;
	codclie=document.getElementById('codclie').value;
			
	ajax=objetoAjax();
	ajax.open("POST","grabarbloquelibro.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//divResultado.innerHTML = ajax.responseText;
			alert("Se crearon los Bloques de libros");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecing="+fecing+"&cantidad="+cantidad+"&solicitante="+solicitante+"&dni="+dni+"&idusuario="+idusuario+"&codclie="+codclie)
	
	
	}


function buscarcliente()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('datos');
	//tomamos el valor de la lista desplegable
	tipoper=document.getElementById('tipoper').value;
	numdoc=document.getElementById('numdoc').value;
	buscanombre=document.getElementById('nombrebus').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","buscacliedniruclib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&buscanombre="+buscanombre);
	
}

/////////////////////////////////////////////////////////////////////////////////
function grabarempresa()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('datos');
	//divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	tipoper=document.getElementById('tipoper').value;
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
	codubi=document.getElementById('codubi').value;
	idsedereg3=document.getElementById('idsedereg3').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_empresalib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3)
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
function grabarcliente()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('datos');
	//tomamos el valor de la lista desplegable
	tipoper=document.getElementById('tipoper').value;
	numdoc=document.getElementById('numdoc').value;
	apepat=document.getElementById('apepat').value;
	apemat=document.getElementById('apemat').value;
	prinom=document.getElementById('prinom').value;
	segnom=document.getElementById('segnom').value;
	direccion=document.getElementById('direccion').value;
	email=document.getElementById('email').value;
	telfijo=document.getElementById('telfijo').value;
	telcel=document.getElementById('telcel').value;
	telofi=document.getElementById('telofi').value;
	sexo=document.getElementById('sexo').value;
	idestcivil=document.getElementById('idestcivil').value;
	nacionalidad=document.getElementById('nacionalidad').value;
	idprofesion=document.getElementById('idprofesion').value;
	idcargoo=document.getElementById('idcargoo').value;
	cumpclie=document.getElementById('cumpclie').value;
	natper=document.getElementById('natper').value;
	codubisc=document.getElementById('codubisc').value;
	nomprofesiones=document.getElementById('nomprofesiones').value;
	nomcargoss=document.getElementById('nomcargoss').value;
	ubigensc=document.getElementById('ubigensc').value;
	residente=document.getElementById('residente').value;
	docpaisemi=document.getElementById('docpaisemi').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_clientelib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi);


}

function buscaubigeos()
{ 	divResultado = document.getElementById('resulubi');
	__buscaubi=document.getElementById('_buscaubi').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeolib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubi="+__buscaubi);
}


function buscaubigeossc()
{ 	divResultado = document.getElementById('resulubisc');
	buscaubisc=document.getElementById('_buscaubisc').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosclib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc)
}

function buscaprofesiones()
{ 	divResultado = document.getElementById('resulprofesiones');
	buscaprofes=document.getElementById('_buscaprofes').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionneslib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes)
}

function buscacarguitoss()
{ 	divResultado = document.getElementById('resulcargito');
	buscacargooss=document.getElementById('_buscacargooss').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargoslib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss="+buscacargooss)
}

function grabarlibro()
{
	divResultado = document.getElementById('ncrono');
	fecing=document.getElementById('fecing').value;
	nlibro=document.getElementById('nlibro').value;
	tipolib=document.getElementById('tipolib').value;
	tlibro=document.getElementById('tlibro').value;
	tlegal=document.getElementById('tlegal').value;
	folio=document.getElementById('folio').value;
	tipfol=document.getElementById('tipfol').value;
	detalle=document.getElementById('detalle').value;
	solicitante=document.getElementById('solicitante').value;
	dni=document.getElementById('dni').value;
	idusuario=document.getElementById('idusuario').value;
	comentarios2=document.getElementById('comentarios2').value;
	comentarios=document.getElementById('comentarios').value;
	idnotario=document.getElementById('idnotario').value;
	flegal=document.getElementById('flegal').value;
	codclie=document.getElementById('codclie').value;
			
	ajax=objetoAjax();
	ajax.open("POST","agregarlib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			alert("Se grabo satisfactoriamente");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecing="+fecing+"&nlibro="+nlibro+"&tipolib="+tipolib+"&tlibro="+tlibro+"&tlegal="+tlegal+"&folio="+folio+"&tipfol="+tipfol+"&detalle="+detalle+"&solicitante="+solicitante+"&dni="+dni+"&idusuario="+idusuario+"&comentarios2="+comentarios2+"&comentarios="+comentarios+"&idnotario="+idnotario+"&flegal="+flegal+"&codclie="+codclie)
	
	}




function grabarlibroedit()
{
	if(document.getElementById('numcrono')){
		numcrono = document.getElementById('numcrono').value;
	}else{
		numcrono = document.getElementById('ncrono').text;
	}
	console.log(numcrono)
	numlibro=document.getElementById('numlibro').value;
	fecing=document.getElementById('fecing').value;
	nlibro=document.getElementById('nlibro').value;
	tipoper=document.getElementById('tipoper').value;
	numdoc=document.getElementById('numdoc').value;
	apepat=document.getElementById('apepat').value;
	apemat=document.getElementById('apemat').value;
	prinom=document.getElementById('prinom').value;
	segnom=document.getElementById('segnom').value;
	direccion=document.getElementById('direccion').value;
	idnotario=document.getElementById('idnotario').value;
	flegal=document.getElementById('flegal').value;
	comentarios=document.getElementById('comentarios').value;
	tipolib=document.getElementById('tipolib').value;
	tlegal=document.getElementById('tlegal').value;
	folio=document.getElementById('folio').value;
	tipfol=document.getElementById('tipfol').value;
	detalle=document.getElementById('detalle').value;
	solicitante=document.getElementById('solicitante').value;
	dni=document.getElementById('dni').value;
	idusuario=document.getElementById('idusuario').value;
	comentarios2=document.getElementById('comentarios2').value;
	//coddis=document.getElementById('idubigeo').value;
	//empresa=document.getElementById('empresa').value;
	tlibro=document.getElementById('tlibro').value;
    codclie=document.getElementById('codclie').value;
			
	ajax=objetoAjax();
	ajax.open("POST","editarlib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//divResultado.innerHTML = ajax.responseText;
			alert("Se edito satisfactoriamente");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numcrono="+numcrono+"&numlibro="+numlibro+"&fecing="+fecing+"&nlibro="+nlibro+"&tipoper="+tipoper+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&idnotario="+idnotario+"&flegal="+flegal+"&comentarios="+comentarios+"&tipolib="+tipolib+"&tlegal="+tlegal+"&folio="+folio+"&tipfol="+tipfol+"&detalle="+detalle+"&solicitante="+solicitante+"&dni="+dni+"&idusuario="+idusuario+"&comentarios2="+comentarios2+"&tlibro="+tlibro+"&codclie="+codclie)
	
	}



function buscacrono()
{
	
	divResultado = document.getElementById('blibro');
	crono=document.getElementById('crono').value
	ajax=objetoAjax();
	ajax.open("POST","buscalibrocrono.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("crono="+crono)
	
}


function buscadesc(){
	
	divResultado = document.getElementById('blibro');
	var _descrio = document.getElementById('descrio').value;
	ajax=objetoAjax();
	ajax.open("POST","buscalibrodes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("descrio="+_descrio)
	}
	


function buscaruc()
{	

	divResultado    = document.getElementById('blibro');
	var dnilib      = document.getElementById('dnilib').value;
	var vdescrio    = document.getElementById('descrio').value;
	var vcrono   	= document.getElementById('crono').value;
	var rangof1		= document.getElementById('rangof1').value;
	var rangof2 	= document.getElementById('rangof2').value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "buscalibroruc.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
				divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("dnilib="+dnilib+"&descrio="+vdescrio+"&crono="+vcrono+"&rangof1="+rangof1+"&rangof2="+rangof2);
}

function buscarucdni(){
	divResultado = document.getElementById('blibro');
	var dnilib = document.getElementById('dnilib').value;
	  
	
	
	ajax=objetoAjax();
	ajax.open("POST", "buscalibroruc1.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
				divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("dnilib="+dnilib);
	
	}



function buscalibcro(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('blibro');
	//tomamos el valor de la lista desplegable
	fechade = document.getElementById('fechade').value;
	fechaa  = document.getElementById('fechaa').value;
    if(fechade == "" || fechaa == "")
	{
		alert("Debe ingresar un rango de fechas válido");return;	
	}
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "cronolibbusca.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechade="+fechade+"&fechaa="+fechaa)
}


	
function mostrarxisclie(id){
	var divResultado = document.getElementById('datos');
	var codclie= id;
	ajax=objetoAjax();

	ajax.open("POST","buscarclieruc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codclie="+codclie);
	}	
	