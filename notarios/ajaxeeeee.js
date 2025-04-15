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

function buscausu(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado');

	//tomamos el valor de la lista desplegable
	paterno=document.frmbuscausu.paterno.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "bupaterno.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("paterno="+paterno)
}
function buscausu2(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado');

	//tomamos el valor de la lista desplegable
	materno=document.frmbuscausu.materno.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "bumaterno.php",true);
	
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("materno="+materno)
}
function buscausu3(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado');

	//tomamos el valor de la lista desplegable
	nombre=document.frmbuscausu.nombre.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "bunombre.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("nombre="+nombre)
}

function editar(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado2');

	//tomamos el valor de la lista desplegable
	idusu=document.frmusu.idusu.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "editar_usu.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idusu="+idusu)
}

function permisos(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado2');

	//tomamos el valor de la lista desplegable
	idusu2=document.frmpermiso.idusu2.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "permiso_usu.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idusu2="+idusu2)
}

function clave(){
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado2');
	
	//tomamos el valor de la lista desplegable
	idusu3=document.frmclave.idusu3.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "clave_usu.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idusu3="+idusu3)
}
function verifiuser()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('comprobar');
	
	//tomamos el valor de la lista desplegable
	loginusuario=document.frmusuario.loginusuario.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","verifiusu.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("loginusuario="+loginusuario)
}

function generakardex()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	idtipkar=document.frmprotocolares.idtipkar.value;
	fechaingreso=document.frmprotocolares.fechaingreso.value;
	referencia=document.frmprotocolares.referencia.value;
	codactos=document.frmprotocolares.codactos.value;
	contrato=document.frmprotocolares.contrato.value;
	dregistral=document.frmprotocolares.dregistral.value;
	dnotarial=document.frmprotocolares.dnotarial.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_kardex.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipkar="+idtipkar+"&fechaingreso="+fechaingreso+"&referencia="+referencia+"&codactos="+codactos+"&contrato="+contrato+"&dregistral="+dregistral+"&dnotarial="+dnotarial)
	
}

function actualizarkardex()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('xcxcxvcx');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	idtipkar=document.frmprotocolares.idtipkar.value;
	referencia=document.frmprotocolares.referencia.value;
	codactos=document.frmprotocolares.codactos.value;
	contrato=document.frmprotocolares.contrato.value;
	dregistral=document.frmprotocolares.dregistral.value;
	dnotarial=document.frmprotocolares.dnotarial.value;
	kardexconexo=document.frmprotocolares.kardexconexo.value;
	idnotario=document.frmprotocolares.idnotario.value;
	

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_kardex_edit.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipkar="+idtipkar+"&kardexconexo="+kardexconexo+"&referencia="+referencia+"&codactos="+codactos+"&contrato="+contrato+"&dregistral="+dregistral+"&dnotarial="+dnotarial+"&idnotario="+idnotario+"&codkardex="+codkardex)
	
}

function grabarmp()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('ittmp');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	tipoactopatri=document.frmprotocolares.tipoactopatri.value;
	nnminuta=document.frmprotocolares.nnminuta.value;
	imptrans=document.frmprotocolares.imptrans.value;
	tipomoneda=document.frmprotocolares.tipomoneda.value;
	exibio=document.frmprotocolares.exibio.value;
	tipcambio=document.frmprotocolares.tipcambio.value;
	humbral=document.frmprotocolares.humbral.value;

	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_mp.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&tipoactopatri="+tipoactopatri+"&nnminuta="+nnminuta+"&imptrans="+imptrans+"&tipomoneda="+tipomoneda+"&exibio="+exibio+"&tipcambio="+tipcambio+"&humbral="+humbral)
	
}


function grabaruifppp()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('iuoiuoiuio');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	pregis=document.frmprotocolares.pregis.value;
	nregis=document.frmprotocolares.nregis.value;
	idsedereg2=document.frmprotocolares.idsedereg2.value;
	fpago=document.frmprotocolares.fpago.value;
	oporpago=document.frmprotocolares.oporpago.value;
	ofpago=document.frmprotocolares.ofpago.value;
	itemmpp=document.frmprotocolares.itemmpp.value;
	
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_uifp.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))  ) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&pregis="+pregis+"&nregis="+nregis+"&idsedereg2="+idsedereg2+"&fpago="+fpago+"&oporpago="+oporpago+"&ofpago="+ofpago+"&itemmpp="+itemmpp)
	
}

function gggppp()
{
	//donde se mostrará el resultado
	//divResultado = document.getElementById('eqweqeqw');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	mediopago=document.frmprotocolares.mediopago.value;
	entidadfinanciera=document.frmprotocolares.entidadfinanciera.value;
	impmediopago=document.frmprotocolares.impmediopago.value;
	fechaoperacion=document.frmprotocolares.fechaoperacion.value;
	documentos=document.frmprotocolares.documentos.value;
	itemmpp=document.frmprotocolares.itemmpp.value;
	
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_newmp.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			mostrarlistmpp();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&mediopago="+mediopago+"&entidadfinanciera="+entidadfinanciera+"&impmediopago="+impmediopago+"&fechaoperacion="+fechaoperacion+"&documentos="+documentos+"&itemmpp="+itemmpp)
	
}

function addgbbiens()
{ 
//alert(document.getElementById('tipactox').value);
//donde se mostrará el resultado
divResultado = document.getElementById('rxexmxexlxa');
//tomamos el valor de la lista desplegable
codkardex=document.frmprotocolares.codkardex.value;
_idtipacto = document.getElementById('tipactox').value;

tipob=document.frmprotocolares.tipob.value;
tipobien=document.frmprotocolares.tipobien.value;
codubis=document.frmprotocolares.codubis.value;
fechaconst=document.frmprotocolares.fechaconst.value;
oespecific=document.frmprotocolares.oespecific.value;
smaquiequipo=document.frmprotocolares.smaquiequipo.value;
tpsm=document.frmprotocolares.tpsm.value;
npsm=document.frmprotocolares.npsm.value;
itemmpp=document.frmprotocolares.itemmpp.value;

ajax=objetoAjax();
//usamos el medoto POST
//archivo que realizará la operacion
//datoscliente.php
ajax.open("POST","grabar_newbienn.php",true);
ajax.onreadystatechange=function() {
if (((ajax.readyState==4 && ajax.status==200))) {
//mostrar resultados en esta capa
divResultado.innerHTML = ajax.responseText;
  }
}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//enviando los valores
ajax.send("codkardex="+codkardex+"&tipob="+tipob+"&tipobien="+tipobien+"&codubis="+codubis+"&fechaconst="+fechaconst+"&oespecific="+oespecific+"&smaquiequipo="+smaquiequipo+"&tpsm="+tpsm+"&npsm="+npsm+"&itemmpp="+itemmpp+"&idtipacto="+_idtipacto)

} 


function tipoacto()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tipoacto');
	//tomamos el valor de la lista desplegable
	idtipkar=document.frmprotocolares.idtipkar.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostraractos.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipkar="+idtipkar)
	
}
function tipoacto2kit()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tipoacto2');
	//tomamos el valor de la lista desplegable
	codactos=document.frmprotocolares.codactos.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","quitaractos.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codactos="+codactos)
	
}

function mostrartab()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tabs');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	tab="mostrartab";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","tab.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tab="+tab)
	
}


/*function buscaclientes()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//tomamos el valor de la lista desplegable
	tipoper=document.frmprotocolares.tipoper.value;
	tipodoc=document.frmprotocolares.tipodoc.value;
	numdoc=document.frmprotocolares.numdoc.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","buscacliedniruc.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc)
	
}*/

function buscaclientes2()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('nuevaconyuge');
	//tomamos el valor de la lista desplegable
	numdoc2=document.frmprotocolares.numdoc2.value;
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

function buscaclientes6()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('nuevaconyuge2');
	//tomamos el valor de la lista desplegable
	numdoc6=document.frmprotocolares.numdoc6.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","buscadni2.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc6="+numdoc6);
	
}





function vertipoactopat()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tpacto');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","tipoactopatrimonial.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex)
	
}

function listadobien()
{ //alert(document.getElementById('tipactox').value);
	//donde se mostrará el resultado
	divResultado = document.getElementById('listbiennes');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	_tipoactopatri = document.getElementById('tipactox').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","listadobbiieenneess.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&tipoactopatri="+_tipoactopatri)
	
}
function condiciones()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tipocondicion');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrarcondicion.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex)
	
}
function condicionesk()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tipocondicionk');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	codcon=document.frmprotocolares.codcon.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","quitarcondicion.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&codcon="+codcon)
	
}

/*function grabarcontratantes()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//tomamos el valor de la lista desplegable
	idtipkar=document.frmprotocolares.idtipkar.value;
	codkardex=document.frmprotocolares.codkardex.value;
	codclie=document.frmprotocolares.codclie.value;
	repre=document.frmprotocolares.repre.value;
	codcon=document.frmprotocolares.codcon.value;
	indice=document.frmprotocolares.indice.value;
	firma=document.frmprotocolares.firma.value;
	representaa=document.frmprotocolares.representaa.value;
	facultades=document.frmprotocolares.facultades.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_contratantes.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipkar="+idtipkar+"&codkardex="+codkardex+"&codclie="+codclie+"&repre="+repre+"&codcon="+codcon+"&indice="+indice+"&firma="+firma+"&representaa="+representaa+"&facultades="+facultades)
	
}*/


function mostrarcontrata()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('contratan');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrar_contratan.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex)
	
}
function mostrarcontratac()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('contratanc');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrar_contratanc.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex)
	
}

/*function mostrarcontratante()
{ 
	//donde se mostrará el resultado
	divResultado = document.getElementById('contratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrar_contratantes.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex)
	
}*/

 
function verclientee()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('verclienterctm');
	//tomamos el valor de la lista desplegable
	codclie=document.frmprotocolares.codclie.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrar_clienteeditable.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codclie="+codclie)
	
} 
 
function verclientee2()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('verclienterctm2');
	//tomamos el valor de la lista desplegable
	coddcontrata2=document.frmprotocolares.coddcontrata2.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrar_clienteeditable2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("coddcontrata2="+coddcontrata2)
	
}  
function mostraruifpdtparticipante()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('asigna');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","asigna.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex)
	
}

function grabarcliente()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//tomamos el valor de la lista desplegable
	tipoper=document.frmprotocolares.tipoper.value;
	tipodoc=document.frmprotocolares.tipodoc.value;
	numdoc=document.frmprotocolares.numdoc.value;
	apepat=document.frmprotocolares.apepat.value;
	apemat=document.frmprotocolares.apemat.value;
	prinom=document.frmprotocolares.prinom.value;
	segnom=document.frmprotocolares.segnom.value;
	direccion=document.frmprotocolares.direccion.value;
	email=document.frmprotocolares.email.value;
	telfijo=document.frmprotocolares.telfijo.value;
	telcel=document.frmprotocolares.telcel.value;
	telofi=document.frmprotocolares.telofi.value;
	sexo=document.frmprotocolares.sexo.value;
	idestcivil=document.frmprotocolares.idestcivil.value;
	nacionalidad=document.frmprotocolares.nacionalidad.value;
	idprofesion=document.frmprotocolares.idprofesion.value;
	idcargoo=document.frmprotocolares.idcargoo.value;
	cumpclie=document.frmprotocolares.cumpclie.value;
	natper=document.frmprotocolares.natper.value;
	codubisc=document.frmprotocolares.codubisc.value;
	nomprofesiones=document.frmprotocolares.nomprofesiones.value;
	nomcargoss=document.frmprotocolares.nomcargoss.value;
	ubigensc=document.frmprotocolares.ubigensc.value;
	cconyuge=document.frmprotocolares.cconyuge.value;
	residente=document.frmprotocolares.residente.value;
	docpaisemi=document.frmprotocolares.docpaisemi.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&cconyuge="+cconyuge+"&residente="+residente+"&docpaisemi="+docpaisemi)
	
}

function grabarcliente2()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('ccconyuge');
	//tomamos el valor de la lista desplegable
	tipoper=document.frmprotocolares.tipoper.value;
	tipodoc=document.frmprotocolares.tipodoc.value;
	numdoc2=document.frmprotocolares.numdoc2.value;
	apepat2=document.frmprotocolares.apepat2.value;
	apemat2=document.frmprotocolares.apemat2.value;
	prinom2=document.frmprotocolares.prinom2.value;
	segnom2=document.frmprotocolares.segnom2.value;
	direccion2=document.frmprotocolares.direccion2.value;
	email2=document.frmprotocolares.email2.value;
	telfijo2=document.frmprotocolares.telfijo2.value;
	telcel2=document.frmprotocolares.telcel2.value;
	telofi2=document.frmprotocolares.telofi2.value;
	sexo2=document.frmprotocolares.sexo2.value;
	idestcivil2=document.frmprotocolares.idestcivil2.value;
	nacionalidad2=document.frmprotocolares.nacionalidad2.value;
	idprofesion2=document.frmprotocolares.idprofesion2.value;
	idcargoo2=document.frmprotocolares.idcargoo2.value;
	cumpclie2=document.frmprotocolares.cumpclie2.value;
	natper2=document.frmprotocolares.natper2.value;
	codubisc2=document.frmprotocolares.codubisc2.value;
	nomprofesiones2=document.frmprotocolares.nomprofesiones2.value;
	nomcargoss2=document.frmprotocolares.nomcargoss2.value;
	ubigensc2=document.frmprotocolares.ubigensc2.value;
	residente2=document.frmprotocolares.residente2.value;
	docpaisemi2=document.frmprotocolares.docpaisemi2.value;
		
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente2.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc2="+numdoc2+"&apepat2="+apepat2+"&apemat2="+apemat2+"&prinom2="+prinom2+"&segnom2="+segnom2+"&direccion2="+direccion2+"&email2="+email2+"&telfijo2="+telfijo2+"&telcel2="+telcel2+"&telofi2="+telofi2+"&sexo2="+sexo2+"&idestcivil2="+idestcivil2+"&nacionalidad2="+nacionalidad2+"&idprofesio2n="+idprofesion2+"&idcargoo2="+idcargoo2+"&cumpclie2="+cumpclie2+"&natper2="+natper2+"&codubisc2="+codubisc2+"&nomprofesiones2="+nomprofesiones2+"&nomcargoss2="+nomcargoss2+"&ubigensc2="+ubigensc2+"&residente2="+residente2+"&docpaisemi2="+docpaisemi2)
	
}


function grabarcliente3()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tredfdfdf');
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
	cconyuge6=document.frmprotocolares.cconyuge6.value;	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&numdoc3="+numdoc3+"&apepat3="+apepat3+"&apemat3="+apemat3+"&prinom3="+prinom3+"&segnom3="+segnom3+"&direccion3="+direccion3+"&email3="+email3+"&telfijo3="+telfijo3+"&telcel3="+telcel3+"&telofi3="+telofi3+"&sexo3="+sexo3+"&idestcivil3="+idestcivil3+"&nacionalidad3="+nacionalidad3+"&idprofesion3="+idprofesion3+"&idcargoo3="+idcargoo3+"&cumpclie3="+cumpclie3+"&natper3="+natper3+"&codubisc3="+codubisc3+"&nomprofesiones3="+nomprofesiones3+"&nomcargoss3="+nomcargoss3+"&ubigensc3="+ubigensc3+"&residente3="+residente3+"&docpaisemi3="+docpaisemi3+"&codclie3="+codclie3+"&cconyuge6="+cconyuge6)
	
}

function grabarcliente4()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('ccconyuge');
	//tomamos el valor de la lista desplegable
	tipoper=document.frmprotocolares.tipoper.value;
	tipodoc=document.frmprotocolares.tipodoc.value;
	numdoc2=document.frmprotocolares.numdoc2.value;
	apepat4=document.frmprotocolares.apepat4.value;
	apemat4=document.frmprotocolares.apemat4.value;
	prinom4=document.frmprotocolares.prinom4.value;
	segnom4=document.frmprotocolares.segnom4.value;
	direccion4=document.frmprotocolares.direccion4.value;
	email4=document.frmprotocolares.email4.value;
	telfijo4=document.frmprotocolares.telfijo4.value;
	telcel4=document.frmprotocolares.telcel4.value;
	telofi4=document.frmprotocolares.telofi4.value;
	sexo4=document.frmprotocolares.sexo4.value;
	idestcivil4=document.frmprotocolares.idestcivil4.value;
	nacionalidad4=document.frmprotocolares.nacionalidad4.value;
	idprofesion4=document.frmprotocolares.idprofesion4.value;
	idcargoo4=document.frmprotocolares.idcargoo4.value;
	cumpclie4=document.frmprotocolares.cumpclie4.value;
	natper4=document.frmprotocolares.natper4.value;
	codubisc4=document.frmprotocolares.codubisc4.value;
	nomprofesiones4=document.frmprotocolares.nomprofesiones4.value;
	nomcargoss4=document.frmprotocolares.nomcargoss4.value;
	ubigensc4=document.frmprotocolares.ubigensc4.value;
	residente4=document.frmprotocolares.residente4.value;
	docpaisemi4=document.frmprotocolares.docpaisemi4.value;
	codclie4=document.frmprotocolares.codclie4.value;	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente4.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc2="+numdoc2+"&apepat4="+apepat4+"&apemat4="+apemat4+"&prinom4="+prinom4+"&segnom4="+segnom4+"&direccion4="+direccion4+"&email4="+email4+"&telfijo4="+telfijo4+"&telcel4="+telcel4+"&telofi4="+telofi4+"&sexo4="+sexo4+"&idestcivil4="+idestcivil4+"&nacionalidad4="+nacionalidad4+"&idprofesio4n="+idprofesion4+"&idcargoo4="+idcargoo4+"&cumpclie4="+cumpclie4+"&natper4="+natper4+"&codubisc4="+codubisc4+"&nomprofesiones4="+nomprofesiones4+"&nomcargoss4="+nomcargoss4+"&ubigensc4="+ubigensc4+"&residente4="+residente4+"&docpaisemi4="+docpaisemi4+"&codclie4="+codclie4)
	
}

function grabarcliente6()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('ccconyuge2');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	
	numdoc6=document.frmprotocolares.numdoc6.value;
	apepat6=document.frmprotocolares.apepat6.value;
	apemat6=document.frmprotocolares.apemat6.value;
	prinom6=document.frmprotocolares.prinom6.value;
	segnom6=document.frmprotocolares.segnom6.value;
	direccion6=document.frmprotocolares.direccion6.value;
	email6=document.frmprotocolares.email6.value;
	telfijo6=document.frmprotocolares.telfijo6.value;
	telcel6=document.frmprotocolares.telcel6.value;
	telofi6=document.frmprotocolares.telofi6.value;
	sexo6=document.frmprotocolares.sexo6.value;
	idestcivil6=document.frmprotocolares.idestcivil6.value;
	nacionalidad6=document.frmprotocolares.nacionalidad6.value;
	idprofesion6=document.frmprotocolares.idprofesion6.value;
	idcargoo6=document.frmprotocolares.idcargoo6.value;
	cumpclie6=document.frmprotocolares.cumpclie6.value;
	natper6=document.frmprotocolares.natper6.value;
	codubisc6=document.frmprotocolares.codubisc6.value;
	nomprofesiones6=document.frmprotocolares.nomprofesiones6.value;
	nomcargoss6=document.frmprotocolares.nomcargoss6.value;
	ubigensc6=document.frmprotocolares.ubigensc6.value;
	residente6=document.frmprotocolares.residente6.value;
	docpaisemi6=document.frmprotocolares.docpaisemi6.value;
	codclie6=document.frmprotocolares.codclie6.value;	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("numdoc6="+numdoc6+"&apepat6="+apepat6+"&apemat6="+apemat6+"&prinom6="+prinom6+"&segnom6="+segnom6+"&direccion6="+direccion6+"&email6="+email6+"&telfijo6="+telfijo6+"&telcel6="+telcel6+"&telofi6="+telofi6+"&sexo6="+sexo6+"&idestcivil6="+idestcivil6+"&nacionalidad6="+nacionalidad6+"&idprofesio6n="+idprofesion6+"&idcargoo6="+idcargoo6+"&cumpclie6="+cumpclie6+"&natper6="+natper6+"&codubisc6="+codubisc6+"&nomprofesiones6="+nomprofesiones6+"&nomcargoss6="+nomcargoss6+"&ubigensc6="+ubigensc6+"&residente6="+residente6+"&docpaisemi6="+docpaisemi6+"&codclie6="+codclie6)
	
}

function grabarcliente7()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('ccconyuge2');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	
	numdoc6=document.frmprotocolares.numdoc6.value;
	apepat7=document.frmprotocolares.apepat7.value;
	apemat7=document.frmprotocolares.apemat7.value;
	prinom7=document.frmprotocolares.prinom7.value;
	segnom7=document.frmprotocolares.segnom7.value;
	direccion7=document.frmprotocolares.direccion7.value;
	email7=document.frmprotocolares.email7.value;
	telfijo7=document.frmprotocolares.telfijo7.value;
	telcel7=document.frmprotocolares.telcel7.value;
	telofi7=document.frmprotocolares.telofi7.value;
	sexo7=document.frmprotocolares.sexo7.value;
	idestcivil7=document.frmprotocolares.idestcivil7.value;
	nacionalidad7=document.frmprotocolares.nacionalidad7.value;
	idprofesion7=document.frmprotocolares.idprofesion7.value;
	idcargoo7=document.frmprotocolares.idcargoo7.value;
	cumpclie7=document.frmprotocolares.cumpclie7.value;
	natper7=document.frmprotocolares.natper7.value;
	codubisc7=document.frmprotocolares.codubisc7.value;
	nomprofesiones7=document.frmprotocolares.nomprofesiones7.value;
	nomcargoss7=document.frmprotocolares.nomcargoss7.value;
	ubigensc7=document.frmprotocolares.ubigensc7.value;
	residente7=document.frmprotocolares.residente7.value;
	docpaisemi7=document.frmprotocolares.docpaisemi7.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente7.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("numdoc6="+numdoc6+"&apepat7="+apepat7+"&apemat7="+apemat7+"&prinom7="+prinom7+"&segnom7="+segnom7+"&direccion7="+direccion7+"&email7="+email7+"&telfijo7="+telfijo7+"&telcel7="+telcel7+"&telofi7="+telofi7+"&sexo7="+sexo7+"&idestcivil7="+idestcivil7+"&nacionalidad7="+nacionalidad7+"&idprofesio7n="+idprofesion7+"&idcargoo7="+idcargoo7+"&cumpclie7="+cumpclie7+"&natper7="+natper7+"&codubisc7="+codubisc7+"&nomprofesiones7="+nomprofesiones7+"&nomcargoss7="+nomcargoss7+"&ubigensc7="+ubigensc7+"&residente7="+residente7+"&docpaisemi7="+docpaisemi7)
	
}

function grabarempresa()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	tipoper=document.frmprotocolares.tipoper.value;
	tipodoc=document.frmprotocolares.tipodoc.value;
	numdoc=document.frmprotocolares.numdoc.value;
	razonsocial=document.frmprotocolares.razonsocial.value;
	domfiscal=document.frmprotocolares.domfiscal.value;
	telempresa=document.frmprotocolares.telempresa.value;
	mailempresa=document.frmprotocolares.mailempresa.value;
	contacempresa=document.frmprotocolares.contacempresa.value;
	fechaconstitu=document.frmprotocolares.fechaconstitu.value;
	numregistro=document.frmprotocolares.numregistro.value;
	numpartida=document.frmprotocolares.numpartida.value;
	actmunicipal=document.frmprotocolares.actmunicipal.value;
	codubi=document.frmprotocolares.codubi.value;
	idsedereg3=document.frmprotocolares.idsedereg3.value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_empresa.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3)
	
}
function limpiarbucaclie()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//tomamos el valor de la lista desplegable
	numdoc=document.frmprotocolares.numdoc.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","limpiabusclie.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("numdoc="+numdoc)
	
}

function updatekardex()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('mela');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	fechaconclusion=document.frmprotocolares.fechaconclusion.value;
	folioini=document.frmprotocolares.folioini.value;
	foliofin=document.frmprotocolares.foliofin.value;
	papelini=document.frmprotocolares.papelini.value;
	papelfin=document.frmprotocolares.papelfin.value;
	numminuta=document.frmprotocolares.numminuta.value;
	numescritura=document.frmprotocolares.numescritura.value;
	fechaescritura=document.frmprotocolares.fechaescritura.value;
	
	if(fechaescritura=='' || numescritura==''){alert('Faltan ingresar datos');return;}
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_kardex_escritura.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fechaconclusion="+fechaconclusion+"&folioini="+folioini+"&foliofin="+foliofin+"&papelini="+papelini+"&papelfin="+papelfin+"&numminuta="+numminuta+"&numescritura="+numescritura+"&fechaescritura="+fechaescritura+"&codkardex="+codkardex)
	
}

function listarcontrata()
{
	divResultado = document.getElementById('manclie');
	divResultado.innerHTML= '<img src="loading.gif">';
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","mostrar_contratantes_list.php",true);
	ajax.onreadystatechange=function() {
		if (((ajax.readyState==4 && ajax.status==200))) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}


function grabarrenta()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('rptf');
	//divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	idcontratantee=document.frmprotocolares.idcontratantee.value;
	pregu1=document.frmprotocolares.pregu1.value;
	pregu2=document.frmprotocolares.pregu2.value;
	pregu3=document.frmprotocolares.pregu3.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_renta.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&idcontratantee="+idcontratantee+"&pregu1="+pregu1+"&pregu2="+pregu2+"&pregu3="+pregu3)
	
}


function calcularfrm()
{
	divResultado = document.getElementById('formulinn');
	divResultado.innerHTML= '<img src="loading.gif">';
	pregu1=document.frmprotocolares.pregu1.value;
	pregu2=document.frmprotocolares.pregu2.value;
	pregu3=document.frmprotocolares.pregu3.value;
	ajax=objetoAjax();
	ajax.open("POST","mostrarboton.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("pregu1="+pregu1+"&pregu2="+pregu2+"&pregu3="+pregu3)
	
}


function saveformulario()
{
	//divResultado = document.getElementById('xxx');
	numformu=document.frmprotocolares.numformu.value;
	monto=document.frmprotocolares.monto.value;
	idrenta=document.frmprotocolares.idrenta.value;
	ajax=objetoAjax();
	ajax.open("POST","grabar_formulario.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			listaformu();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+numformu+"&monto="+monto+"&idrenta="+idrenta)
	
}
function listaformu()
{
	divResultado = document.getElementById('listform');
	divResultado.innerHTML= '<img src="loading.gif">';
	idrenta=document.frmprotocolares.idrenta.value;

	ajax=objetoAjax();
	ajax.open("POST","mostrar_formulario.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idrenta="+idrenta)
	
}
function buscakardexn()
{
	
	divResultado = document.getElementById('bkardex');
	nnkardex=document.frmbuscakardex.nnkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","buscakardexn.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nnkardex="+nnkardex)
	
}


function buscakardexc()
{
	
	divResultado = document.getElementById('bkardex');
	
	nomcontratante=document.frmbuscakardex.nomcontratante.value;
	tipoper=document.frmbuscakardex.tipoper.value;

	ajax=objetoAjax();
	ajax.open("POST","buscakardexc.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nomcontratante="+nomcontratante+"&tipoper="+tipoper)
	
}

/*
function grabarnewmov()
{
	divResultado = document.getElementById('sssss');
	codkardex=document.frmprotocolares.codkardex.value;
	fechamov=document.frmprotocolares.fechamov.value;
	vencimiento=document.frmprotocolares.vencimiento.value;
	idsedereg=document.frmprotocolares.idsedereg.value;
	idsecreg=document.frmprotocolares.idsecreg.value;
	titulorp=document.frmprotocolares.titulorp.value;
	idtiptraoges=document.frmprotocolares.idtiptraoges.value;
	idestreg=document.frmprotocolares.idestreg.value;
	importee=document.frmprotocolares.importee.value;
	codusuario=document.frmprotocolares.codusuario.value;
	anotacion=document.frmprotocolares.anotacion.value;
	codmovreg=document.frmprotocolares.codmovreg.value;
	numeroo=document.frmprotocolares.numeroo.value;
	mayorderecho=document.frmprotocolares.mayorderecho.value;
	observa=document.frmprotocolares.observa.value;
	conestado=document.frmprotocolares.conestado.value;
	//aqui enviar cobrado eso sera con el modulo de facturacion
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_movimiento.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			mostrarnewreg();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fechamov="+fechamov+"&vencimiento="+vencimiento+"&idsedereg="+idsedereg+"&idsecreg="+idsecreg+"&titulorp="+titulorp+"&idtiptraoges="+idtiptraoges+"&idestreg="+idestreg+"&importee="+importee+"&codusuario="+codusuario+"&anotacion="+anotacion+"&codmovreg="+codmovreg+"&mayorderecho="+mayorderecho+"&numeroo="+numeroo+"&observa="+observa+"&conestado="+conestado)
	
}

*/
/*
function mostrarnewreg()
{
	divResultado = document.getElementById('vermovi');
	divResultado.innerHTML= '<img src="loading.gif">';
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","vergrillamovimiento.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}
*/

function elimmrp()
{
	divResultado = document.getElementById('oiutyr');
	itemcodmovreg=document.frmprotocolares.itemcodmovreg.value;
	codmovreg=document.frmprotocolares.codmovreg.value;
	ajax=objetoAjax();
	ajax.open("POST","eliminarmrrpp.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			mostrarnewreg();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("itemcodmovreg="+itemcodmovreg+"&codmovreg="+codmovreg)
}



function vermovimientorp()
{
	divResultado = document.getElementById('edirrpp');
	itemcodmovreg=document.frmprotocolares.itemcodmovreg.value;
	ajax=objetoAjax();
	ajax.open("POST","ditarmrrpp.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("itemcodmovreg="+itemcodmovreg)
}




function mostrarlistmpp()
{
	divResultado = document.getElementById('listmedpago');
	divResultado.innerHTML= '<img src="loading.gif">';
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","listarmpp.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}
function mostrarsaldos()
{
	divResultado = document.getElementById('resultcodmovreg');
	divResultado.innerHTML= '<img src="loading.gif">';
	codkardex=document.frmprotocolares.codkardex.value;
	codmovreg=document.frmprotocolares.codmovreg.value;
	ajax=objetoAjax();
	ajax.open("POST","mostrarsaldorp.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&codmovreg="+codmovreg)	
}

function editcontra()
{
	divResultado = document.getElementById('rptaedit');
	idcontra=document.frmprotocolares.idcontra.value;
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","mostrareditarcontratante.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra+"&codkardex="+codkardex)
	
}

function grabareditarcontraaaa()
{
    divResultado = document.getElementById('msjee');
	
	idcontra=document.frmprotocolares.idcontra.value;
	idtipkar=document.frmprotocolares.idtipkar.value;
	codkardex=document.frmprotocolares.codkardex.value;
	codconn=document.frmprotocolares.codconn.value;
	firmaa=document.frmprotocolares.firmaa.value;
	indice2=document.frmprotocolares.indice2.value;
	repre2=document.frmprotocolares.repre2.value;
	representaa2=document.frmprotocolares.representaa2.value;
	facultadess=document.frmprotocolares.facultadess.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST","grabareditarcontratante.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra+"&codkardex="+codkardex+"&codconn="+codconn+"&firmaa="+firmaa+"&indice2="+indice2+"&repre2="+repre2+"&representaa2="+representaa2+"&facultadess="+facultadess+"&idtipkar="+idtipkar)
	
}


function limpiaredit()
{
	divResultado = document.getElementById('rptaedit');
	idcontra=document.frmprotocolares.idcontra.value;
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","limpiaedit.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra+"&codkardex="+codkardex)
	
}
function mosteliminarc()
{ 
	divResultado = document.getElementById('uuu');
	idcontra=document.frmprotocolares.idcontra.value;
	ajax=objetoAjax();
	ajax.open("POST","eliminarcontratante.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra)
	}
	

function infopago()
{
	divResultado = document.getElementById('frmpatrimo');
	divResultado.innerHTML= '<img src="loading.gif">';
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","patri_info_pago.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}

function infobien()
{ 
	divResultado = document.getElementById('frmpatrimo');
	divResultado.innerHTML= '<img src="loading.gif">';
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","patri_info_bien.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}
	

function infosatuif()
{ 	divResultado = document.getElementById('frmpatrimo');
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","patri_info_sunatuif.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}

function grabarfirma()
{ 	//divResultado = document.getElementById('xxxxxx');
	codkardex=document.frmprotocolares.codkardex.value;
	fecfirmaa=document.frmprotocolares.fecfirmaa.value;
	firmitaa=document.frmprotocolares.firmitaa.value;
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_firma_contrante.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			mostrarcontratante();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fecfirmaa="+fecfirmaa+"&firmitaa="+firmitaa)
}


function buscaubigeos()
{ 	divResultado = document.getElementById('resulubi');
	buscaubi=document.frmprotocolares.buscaubi.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeo.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubi="+buscaubi)
}

function buscaubigeoss()
{ 	divResultado = document.getElementById('resulubis');
	buscaubis=document.frmprotocolares.buscaubis.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeos.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubis="+buscaubis)
}

function buscaubigeossc()
{ 	divResultado = document.getElementById('resulubisc');
	buscaubisc=document.frmprotocolares.buscaubisc.value;
		
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

function buscaubigeossc2()
{ 	divResultado = document.getElementById('resulubisc2');
	buscaubisc2=document.frmprotocolares.buscaubisc2.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc2.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc2="+buscaubisc2)
}

function buscaubigeossc3()
{ 	divResultado = document.getElementById('resulubisc3');
	buscaubisc3=document.frmprotocolares.buscaubisc3.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc3.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc3="+buscaubisc3)
}

function buscaubigeossc4()
{ 	divResultado = document.getElementById('resulubisc4');
	buscaubisc4=document.frmprotocolares.buscaubisc4.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc4.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc4="+buscaubisc4)
}
function buscaubigeossc6()
{ 	divResultado = document.getElementById('resulubisc6');
	buscaubisc6=document.frmprotocolares.buscaubisc6.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc6.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc6="+buscaubisc6)
}

function buscaprofesiones()
{ 	divResultado = document.getElementById('resulprofesiones');
	buscaprofes=document.frmprotocolares.buscaprofes.value;
		
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

function buscaubigeossc7()
{ 	divResultado = document.getElementById('resulubisc7');
	buscaubisc7=document.frmprotocolares.buscaubisc7.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc7.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc7="+buscaubisc7)
}

function buscaprofesiones()
{ 	divResultado = document.getElementById('resulprofesiones');
	buscaprofes=document.frmprotocolares.buscaprofes.value;
		
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


function buscacarguitoss()
{ 	divResultado = document.getElementById('resulcargito');
	buscacargooss=document.frmprotocolares.buscacargooss.value;
		
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

function buscaprofesiones2()
{ 	divResultado = document.getElementById('resulprofesiones2');
	buscaprofes2=document.frmprotocolares.buscaprofes2.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes2="+buscaprofes2)
}


function buscacarguitoss2()
{ 	divResultado = document.getElementById('resulcargito2');
	buscacargooss2=document.frmprotocolares.buscacargooss2.value;
		
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

function buscaprofesiones3()
{ 	divResultado = document.getElementById('resulprofesiones3');
	buscaprofes3=document.frmprotocolares.buscaprofes3.value;
		
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


function buscacarguitoss3()
{ 	divResultado = document.getElementById('resulcargito3');
	buscacargooss3=document.frmprotocolares.buscacargooss3.value;
		
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

function buscaprofesiones4()
{ 	divResultado = document.getElementById('resulprofesiones4');
	buscaprofes4=document.frmprotocolares.buscaprofes4.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes4="+buscaprofes4)
}


function buscacarguitoss4()
{ 	divResultado = document.getElementById('resulcargito4');
	buscacargooss4=document.frmprotocolares.buscacargooss4.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss4="+buscacargooss4)
}

function buscaprofesiones6()
{ 	divResultado = document.getElementById('resulprofesiones6');
	buscaprofes6=document.frmprotocolares.buscaprofes6.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes6="+buscaprofes6)
}


function buscacarguitoss6()
{ 	divResultado = document.getElementById('resulcargito6');
	buscacargooss6=document.frmprotocolares.buscacargooss6.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss6="+buscacargooss6)
}

function buscaprofesiones7()
{ 	divResultado = document.getElementById('resulprofesiones7');
	buscaprofes7=document.frmprotocolares.buscaprofes7.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes7.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes7="+buscaprofes7)
}


function buscacarguitoss7()
{ 	divResultado = document.getElementById('resulcargito7');
	buscacargooss7=document.frmprotocolares.buscacargooss7.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos7.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss7="+buscacargooss7)
}

function verificarfirmas()
{ 	divResultado = document.getElementById('verifyfirma');
	codkardex=document.frmprotocolares.codkardex.value;
	fecfirmaa=document.frmprotocolares.fecfirmaa.value;	
	
	ajax=objetoAjax();
	ajax.open("POST","conclusionfirma.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fecfirmaa="+fecfirmaa)
}


function mostrarumbral()
{ 	
divResultado = document.getElementById('cumbral');
	idttiippooacto=document.frmprotocolares.idttiippooacto.value;
	ajax=objetoAjax();
	ajax.open("POST","showumbral.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idttiippooacto="+idttiippooacto)
}

function grabarnewmov()
{	
	divResultado = document.getElementById('vermovi');
	codkardex=document.frmprotocolares.codkardex.value;
	fechamov=document.frmprotocolares.fechamov.value;
	vencimiento=document.frmprotocolares.vencimiento.value;
	idsedereg=document.frmprotocolares.idsedereg.value;
	idsecreg=document.frmprotocolares.idsecreg.value;
	titulorp=document.frmprotocolares.titulorp.value;
	idtiptraoges=document.frmprotocolares.idtiptraoges.value;
	idestreg=document.frmprotocolares.idestreg.value;
	importee=document.frmprotocolares.importee.value;
	codusuario=document.frmprotocolares.codusuario.value;
	anotacion=document.frmprotocolares.anotacion.value;
	codmovreg=document.frmprotocolares.codmovreg.value;
	numeroo=document.frmprotocolares.numeroo.value;
	mayorderecho=document.frmprotocolares.mayorderecho.value;
	observa=document.frmprotocolares.observa.value;
	conestado=document.frmprotocolares.conestado.value;
	//aqui enviar cobrado eso sera con el modulo de facturacion
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_movimiento.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			 mostrarnewreg();
			//alert("Movimiento grabado satisfactoriamente");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fechamov="+fechamov+"&vencimiento="+vencimiento+"&idsedereg="+idsedereg+"&idsecreg="+idsecreg+"&titulorp="+titulorp+"&idtiptraoges="+idtiptraoges+"&idestreg="+idestreg+"&importee="+importee+"&codusuario="+codusuario+"&anotacion="+anotacion+"&codmovreg="+codmovreg+"&mayorderecho="+mayorderecho+"&numeroo="+numeroo+"&observa="+observa+"&conestado="+conestado)
	
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////
function editarmovreg()
{
	//divResultado = document.getElementById('rctmmmm');
	codkardex=document.frmprotocolares.codkardex.value;
	fechamov2=document.frmprotocolares.fechamov2.value;
	vencimiento2=document.frmprotocolares.vencimiento2.value;
	idsedereg2=document.frmprotocolares.idsedereg2.value;
	idsecreg2=document.frmprotocolares.idsecreg2.value;
	titulorp2=document.frmprotocolares.titulorp2.value;
	idtiptraoges2=document.frmprotocolares.idtiptraoges2.value;
	idestreg2=document.frmprotocolares.idestreg2.value;
	importee2=document.frmprotocolares.importee2.value;
	codusuario2=document.frmprotocolares.codusuario2.value;
	anotacion2=document.frmprotocolares.anotacion2.value;
	codmovreg=document.frmprotocolares.codmovreg.value;
	numeroo2=document.frmprotocolares.numeroo2.value;
	observa2=document.frmprotocolares.observa2.value;
	conestado2=document.frmprotocolares.conestado2.value;
	itemcodmovreg=document.frmprotocolares.itemcodmovreg.value;
	//aqui enviar cobrado eso sera con el modulo de facturacion
	
	ajax=objetoAjax();
	ajax.open("POST","editar_movimiento.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			mostrarnewreg();
			//alert("Movimiento grabado satisfactoriamente");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fechamov2="+fechamov2+"&vencimiento2="+vencimiento2+"&idsedereg2="+idsedereg2+"&idsecreg2="+idsecreg2+"&titulorp2="+titulorp2+"&idtiptraoges2="+idtiptraoges2+"&idestreg2="+idestreg2+"&importee2="+importee2+"&codusuario2="+codusuario2+"&anotacion2="+anotacion2+"&codmovreg="+codmovreg+"&numeroo2="+numeroo2+"&observa2="+observa2+"&conestado2="+conestado2+"&itemcodmovreg="+itemcodmovreg)
	
}

////////////////////////////////////////////////

function mostrarnewreg()
{   
	divResultadoo = document.getElementById('vermovi');
	divResultadoo.innerHTML= '<img src="loading.gif">';
	codkardex=document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","vergrillamovimiento.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultadoo.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}

function grabarcontratantes()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//tomamos el valor de la lista desplegable
	idtipkar=document.frmprotocolares.idtipkar.value;
	codkardex=document.frmprotocolares.codkardex.value;
	codclie=document.frmprotocolares.codclie.value;
	repre=document.frmprotocolares.repre.value;
	codcon=document.frmprotocolares.codcon.value;
	indice=document.frmprotocolares.indice.value;
	firma=document.frmprotocolares.firma.value;
	representaa=document.frmprotocolares.representaa.value;
	facultades=document.frmprotocolares.facultades.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_contratantes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			mostrarcontratante();
			//alert('se grabo');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idtipkar="+idtipkar+"&codkardex="+codkardex+"&codclie="+codclie+"&repre="+repre+"&codcon="+codcon+"&indice="+indice+"&firma="+firma+"&representaa="+representaa+"&facultades="+facultades);
	
}

////////////////////////////////////////////////////
function buscaclientes()
{validaDNIRUC();
	//donde se mostrará el resultado
	divResultado = document.getElementById('busclie');
	//tomamos el valor de la lista desplegable
	tipoper=document.frmprotocolares.tipoper.value;
	tipodoc=document.frmprotocolares.tipodoc.value;
	numdoc=document.frmprotocolares.numdoc.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","buscacliedniruc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc);
	
}

////////////////////////
function mostrarcontratante()
{ 
	//donde se mostrará el resultado
	divResultado = document.getElementById('contratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrar_contratantes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex)
	
}
//////////////////

//////////////////
/////////////////////////////////////

function cambiatipdoc(_id)
{ 

	divResultado = document.getElementById('tipodocuR');
	_id=document.frmprotocolares.tipodoc.value;
	
	//var _id = document.getElementById('tipodoc').value;
	
	ajax=objetoAjax();

	ajax.open("POST","combodocu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id="+_id)
	
}

// EDITAR  MEDIO DE PAGO
function vermediopagoe()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('vermediopagoedit');
	//tomamos el valor de la lista desplegable
	detmp = document.getElementById('detmp').value; // hidden
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","mostrar_mpagoedit.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("detmp="+detmp)
	
} 

//GRABAR LA EDICION DEL MEDIO DE PAGO

function actmediopago()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tredfdfdf');
	//tomamos el valor de la lista desplegable
	
codkardex = document.getElementById('codkardex').value;
mediopago = document.getElementById('mediopago').value;
entidadfinanciera = document.getElementById('entidadfinanciera').value;
impmediopago = document.getElementById('impmediopago').value;
fechaoperacion = document.getElementById('fechaoperacion').value;
documentos = document.getElementById('documentos').value;
itemmpp = document.getElementById('itemmpp').value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_editpago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&codkardex="+codkardex+"&mediopago="+mediopago+"&entidadfinanciera="+entidadfinanciera+"&impmediopago="+impmediopago+"&fechaoperacion="+fechaoperacion+"&documentos="+documentos+"&itemmpp="+itemmpp);
	
}



function recalcularasignass(){
	//divResultado = document.getElementById('hjpt');
	//tomamos el valor de la lista desplegable
	codkardex=document.frmprotocolares.codkardex.value;
	xasignacontra=document.frmprotocolares.xasignacontra.value;
	xasignacondi=document.frmprotocolares.xasignacondi.value;
	xasignavalor=document.frmprotocolares.xasignavalor.value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","recalcularasigna.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//divResultado.innerHTML = ajax.responseText;
			//mostrarcontratante();
			//alert('remmelalaalla');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&xasignacontra="+xasignacontra+"&xasignacondi="+xasignacondi+"&xasignavalor="+xasignavalor);
	
	
	
	}


/////////////////////////////////////////////////grabar en ajax original///////////////////////////////////
function buscaclientescnt()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('nuevaconyugecnt');
	//tomamos el valor de la lista desplegable
	numdoccnt = document.getElementById('numdoccnt').value; // .frmprotocolares.numdoccnt.value;
	//alert(numdoccnt);
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","buscadnicnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("numdoccnt="+numdoccnt);
	
}

function buscacarguitosscnt()
{ 	divResultado = document.getElementById('resulcargitocnt');
	buscacargoosscnt=document.frmprotocolares.buscacargoosscnt.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargoscnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargoosscnt="+buscacargoosscnt)
}

function buscaprofesionescnt()
{ 	divResultado = document.getElementById('resulprofesionescnt');
	buscaprofescnt=document.frmprotocolares.buscaprofescnt.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnescnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofescnt="+buscaprofescnt)
}


function buscaubigeossccnt()
{ 	divResultado = document.getElementById('resulubisccnt');
	buscaubisccnt=document.frmprotocolares.buscaubisccnt.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosccnt.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisccnt="+buscaubisccnt)
}


function grabarcliente6mm()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('ccconyugecnt');
	divResultado.innerHTML= '<img src="loading.gif">';
	//tomamos el valor de la lista desplegable
	
	numdoc6=document.frmprotocolares.numdoc6.value;
	apepat6=document.frmprotocolares.apepat6.value;
	apemat6=document.frmprotocolares.apemat6.value;
	prinom6=document.frmprotocolares.prinom6.value;
	segnom6=document.frmprotocolares.segnom6.value;
	direccion6=document.frmprotocolares.direccion6.value;
	email6=document.frmprotocolares.email6.value;
	telfijo6=document.frmprotocolares.telfijo6.value;
	telcel6=document.frmprotocolares.telcel6.value;
	telofi6=document.frmprotocolares.telofi6.value;
	sexo6=document.frmprotocolares.sexo6.value;
	idestcivil6=document.frmprotocolares.idestcivil6.value;
	nacionalidad6=document.frmprotocolares.nacionalidad6.value;
	idprofesion6=document.frmprotocolares.idprofesion6.value;
	idcargoo6=document.frmprotocolares.idcargoo6.value;
	cumpclie6=document.frmprotocolares.cumpclie6.value;
	natper6=document.frmprotocolares.natper6.value;
	codubisc6=document.frmprotocolares.codubisc6.value;
	nomprofesiones6=document.frmprotocolares.nomprofesiones6.value;
	nomcargoss6=document.frmprotocolares.nomcargoss6.value;
	ubigensc6=document.frmprotocolares.ubigensc6.value;
	residente6=document.frmprotocolares.residente6.value;
	docpaisemi6=document.frmprotocolares.docpaisemi6.value;
	codclie6=document.frmprotocolares.codclie6.value;	
	codclie6n=document.frmprotocolares.codclie6n.value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente6mm.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("numdoc6="+numdoc6+"&apepat6="+apepat6+"&apemat6="+apemat6+"&prinom6="+prinom6+"&segnom6="+segnom6+"&direccion6="+direccion6+"&email6="+email6+"&telfijo6="+telfijo6+"&telcel6="+telcel6+"&telofi6="+telofi6+"&sexo6="+sexo6+"&idestcivil6="+idestcivil6+"&nacionalidad6="+nacionalidad6+"&idprofesio6n="+idprofesion6+"&idcargoo6="+idcargoo6+"&cumpclie6="+cumpclie6+"&natper6="+natper6+"&codubisc6="+codubisc6+"&nomprofesiones6="+nomprofesiones6+"&nomcargoss6="+nomcargoss6+"&ubigensc6="+ubigensc6+"&residente6="+residente6+"&docpaisemi6="+docpaisemi6+"&codclie6="+codclie6+"&codclie6n="+codclie6n)
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////


