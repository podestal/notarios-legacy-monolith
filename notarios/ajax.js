function objetoAjax(){
	var xmlhttp = false;
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

function verObsEscriF(id)
{ 	
	 var divResultado = document.getElementById('verObsEscri');
	divResultado.style.display='';	
	ajax=objetoAjax();
	ajax.open("POST","verObsEscriF.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id="+id);
	
}

function cerrarObsEscri(){
	document.getElementById('verObsEscri').style.display="none";
}

function cerrarObsEscri2(){
	document.getElementById('verObsEscri2').style.display="none";
}


function generar_backup(){
	var divResultadoxx = document.getElementById('resu_backup');
	var kardexxx = "Bckup";
	
	ajax=objetoAjax();
	ajax.open("POST","backup/backup.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultadoxx.innerHTML = ajax.responseText;
		}
	
	}
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("kardexxx="+kardexxx);
}
function buscausu(){
	var divResultado = document.getElementById('resultado');
	var paterno      = document.frmbuscausu.paterno.value;

	ajax=objetoAjax();
	ajax.open("POST", "bupaterno.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("paterno="+paterno)
}
function buscausu2(){
	
	var divResultado = document.getElementById('resultado');
	var materno      = document.frmbuscausu.materno.value;
	
	ajax=objetoAjax();
	ajax.open("POST", "bumaterno.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("materno="+materno)
}
function listarescrituraciondocs()
{
	var divResultado2 = document.getElementById('escrituracion');
	divResultado2.style="display:inline";
	divResultado2.innerHTML= '<img src="loading.gif">';
	
	var kardex    = document.getElementById('codkardex').value;
	var idkardex    = document.getElementById('idcodkardex').value;
	
	ajax=objetoAjax();
	ajax.open("POST","escrituraciondocs.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado2.innerHTML = ajax.responseText;
		    if (kardex.indexOf('PRE') != -1) {
				//predetallito();
				
			}else{
				//detallito();
				
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("kardex="+kardex+"&id="+idkardex);
}

function listarCuerpoDocum(kardex)
{ 	
	var divResultado = document.getElementById('resultEscri');
	divResultado.style.display='';	
	ajax=objetoAjax();
	ajax.open("POST","listarCuerpoDocum.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("kardex="+kardex);
}

function listarGenerarProy(kardex)
{ 	
	var divResultado = document.getElementById('resultEscri');
	divResultado.style.display='';	
	ajax=objetoAjax();
	ajax.open("POST","listarGenerarProy.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("kardex="+kardex);
}
function generaminuta(kardex,ext) {	
	window.open("generadorminuta.php?kardex="+kardex+"&ext="+ext);
}

function eliminarminuta(kardex,ext) {	
	
	ajax=objetoAjax();
	ajax.open("POST","eliminarminuta.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {	
			document.formu.submit();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("kardex="+kardex+"&ext="+ext);	
}
function CreaDocum(accion=null){
	
		var _num_kardex = document.getElementById('codkardex').value;
		var _tip_kardex = document.getElementById('idtipkar').value;		
		var _idtipoacto = document.getElementById('codactos').value;
		var _idTemplate = document.getElementById('idTemplate').value;
	
		if(accion==null){
			if(window.confirm('ESTA SEGURO QUE QUIERE GENERAR EL DOCUMENTO')){
			}else{
				return false;
			}
		}
		console.error(_idTemplate)
		var _grupoCliente= "";
		if(_num_kardex==''){alert('Debe guardar los datos primero');return false;}
					
//		window.open();	
		//actualizarFechas(_num_kardex,_tip_kardex);
		document.getElementById("btnGenerarProyecto").value="GENERANDO...";
		document.getElementById("btnGenerarProyecto").style.cursor="no-drop";

		let loader = document.getElementById('loaderProy');
		loader.style.display='block'
		ajax=objetoAjax();
			ajax.open("POST",'pregenerador.php',true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4 && ajax.status==200) {
					var result = ajax.responseText;
					
					if(accion=='actualizar'){
						let url = 'abrir_documento_guardado.php?kardex='+result+'&accion=actualizar';
						window.location.href = url
						alert(result.trim());
						loader.style.display='none'
					}else if(accion=='parte'){
						let url = 'abrir_parte_notarial.php?kardex='+result+'&accion=parte';
						window.location.href = url
						alert(result.trim());
						loader.style.display='none'
					}else{
						
						document.getElementById("btnGenerarProyecto").style.cursor="pointer";
						document.getElementById("btnGenerarProyecto").value="GENERAR PROYECTO";
						
						if(result.trim().indexOf("Se genero el archivo")!=-1){
							registraDocum(_num_kardex,'PROYECTO');
							fVisualDocument();

						}		
						alert(result.trim()); 
						loader.style.display='none'
						//alert("Modificado Exitosamente.");
					}
					loader.style.display='none'
				}else{
					loader.style.display='none'
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send('num_kardex='+_num_kardex+'&idtipoacto='+_idtipoacto+"&tip_kardex="+_tip_kardex+"&tipo="+23+"&grupoCliente="+_grupoCliente+"&accion="+accion+"&idTemplate="+_idTemplate);

		//fVisualDocument(); 
	//window.open('luchin.php?num_kardex='+_num_kardex+"&tipo="+15);	
	
}
function abrirPdf(kardex,dir,anio){
	
	let url = 'abrir_documento_pdf.php?kardex='+kardex+'&directorio='+dir+'&anio='+anio;

	window.location.href = url
}
function abrirDocumento(kardex){
	
	let url = 'abrir_documento_guardado.php?kardex='+kardex+'&accion=null';
	window.location.href = url
}
function abrirParteNotarial(kardex){
	
	let url = 'abrir_parte_notarial.php?kardex='+kardex+'&accion=null';
	window.location.href = url
}
function registraDocum(kardex,tipo)
{ 	
	console.log("TIPOOOO => "+tipo);
	var divResultado = document.getElementById('resultEscri');
	var obs = document.getElementById('obs').value;
	var idtipkar = document.getElementById('idtipkar').value;
	var archivo="";
	divResultado.style.display='';	
	ajax=objetoAjax();
		if(tipo=="TESTIMONIO" || tipo=="PARTE"){
			archivo="grabarLogDocParTesti.php";
			var cliente = document.getElementById('cliente').value;
			var tipodocu = document.getElementById('tipodocu').value;
			var numdocu = document.getElementById('numdocu').value;
			var fecha = document.getElementById('fecha').value; 
			var cargo="CARGO";
		}else {
			archivo="grabarLogDoc.php";
		}
	ajax.open("POST",archivo,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			if(tipo=="PROYECTO"){
				listarGenerarProy(kardex);
			}else if(tipo=="INSTRUMENTO"){
				listarGenerarInst(kardex,idtipkar);
			}else if(tipo=="MINUTA"){
				listarGenerarMin(kardex);
			}else if(tipo=="TESTIMONIO"){
				listarGenerarTest(kardex);
			}else if(tipo=="PARTE"){
				listarGenerarPart(kardex);
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		if(tipo=="TESTIMONIO" || tipo=="PARTE"){
			ajax.send("kardex="+kardex+"&tipo="+tipo+"&obs="+obs+"&fecha="+fecha+"&numdocu="+numdocu+"&tipodocu="+tipodocu+"&cliente="+cliente+"&cargo="+cargo+"&idtipkar="+idtipkar);
		}else {
			ajax.send("kardex="+kardex+"&tipo="+tipo+"&obs="+obs+"&idtipkar="+idtipkar);
		}
	
}

function fVisualDocument(){
	
		var _numcarta = document.getElementById('codkardex').value;
		console.log(_numcarta);
		if(_numcarta == ''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';

		window.open("generador.php?numcarta="+_numcarta+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&tipo="+23);
			
}

function mostraraconyuge(){
	
	var divResultado = document.getElementById('nuevaconyuge2');
	var numconyuge = document.getElementById('conyu').value;
	document.getElementById('numdoc6').value = numconyuge;
	var tipodocumento= document.getElementById('tpdoc').value;
	document.getElementById('tidocu2').selectedIndex=tipodocumento;
	
	var idclicony= document.getElementById('idconyucli').value;
	document.getElementById('clieidconyu').value=idclicony;
	
	var numdoc6      = document.getElementById('numdoc6').value;
	var tipodocu2    = document.getElementById('tpdoc').value;

	ajax=objetoAjax();

	ajax.open("POST","buscadni2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('cumpclie7')){$("#cumpclie7").mask("99/99/9999",{placeholder:"_"});}
			if(document.getElementById('cumpclie6')){$("#cumpclie6").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&numdoc6="+numdoc6+"&tipodocu2="+tipodocu2);
	
	
	}
	
function mostraraconyuge2(){
	
	var divResultado = document.getElementById('nuevaconyuge2');
	var numconyuge = document.getElementById('conyu').value;
	document.getElementById('numdoc6').value = numconyuge;
	var tipodocumento= document.getElementById('tpdoc').value;
	document.getElementById('tidocu2').selectedIndex=tipodocumento;
	
	var idclicony= document.getElementById('idconyucli').value;
	document.getElementById('clieidconyu').value=idclicony;
	
	var numdoc6      = document.getElementById('numdoc6').value;
	var tipodocu2    = document.getElementById('tpdoc').value;

	ajax=objetoAjax();

	ajax.open("POST","buscadnicliente.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('cumpclie7')){$("#cumpclie7").mask("99/99/9999",{placeholder:"_"});}
			if(document.getElementById('cumpclie6')){$("#cumpclie6").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&numdoc6="+numdoc6+"&tipodocu2="+tipodocu2);
	
	
	}
 
function buscausu3(){

	var divResultado = document.getElementById('resultado');
	var nombre       = document.frmbuscausu.nombre.value;

	ajax=objetoAjax();
	ajax.open("POST", "bunombre.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nombre="+nombre)
}

function grabainsertos2()
{
	var _num_insertos	= document.getElementById('num_inser').value;
	var _num_kardex     = document.getElementById('codkardex').value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_insertos.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se Actualizo el kardex');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("num_insertos="+_num_insertos+"&num_kardex="+_num_kardex);		
}

function editar(){

	var divResultado = document.getElementById('resultado2');
	var idusu        = document.frmusu.idusu.value;

	ajax=objetoAjax();
	ajax.open("POST", "editar_usu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idusu="+idusu)
}

function permisos(){

	var divResultado = document.getElementById('resultado2');
	var idusu2       = document.frmpermiso.idusu2.value;

	ajax=objetoAjax();
	ajax.open("POST", "permiso_usu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idusu2="+idusu2)
}

function clave(){

	var divResultado = document.getElementById('resultado2');
	var idusu3       = document.frmclave.idusu3.value;

	ajax=objetoAjax();
	ajax.open("POST", "clave_usu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idusu3="+idusu3)
}
function verifiuser()
{

	var divResultado = document.getElementById('comprobar');
	var loginusuario = document.frmusuario.loginusuario.value;

	ajax=objetoAjax();
	ajax.open("POST","verifiusu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("loginusuario="+loginusuario)
}

function generakardex()
{
	var divResultado = document.getElementById('resultado');
	divResultado.innerHTML= '<img src="loading.gif">';

	var idtipkar     = document.getElementById('idtipkar').value;
	var fechaingreso = document.getElementById('fechaingreso').value;
	var nreferencia  = document.getElementById('nreferencia').value;
	var codactos     = document.getElementById('codactos').value;
	var contrato     = document.getElementById('contrato').value;
	var dregistral   = document.getElementById('dregistral').value;
	var dnotarial    = document.getElementById('dnotarial').value;
	var idabogado    = document.getElementById('idabogado').value;
	var responsable_new    = document.getElementById('responsable_new').value;
	var idusuarios   = document.getElementById('idusuarios').value;
	var horaingreso   = document.getElementById('horaingreso').value;
	var funcionario_new = document.getElementById('funcionario_new').value;
	var tipoescritura= document.getElementById('tipoescritura').value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_kardex.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idtipkar="+idtipkar+"&fechaingreso="+fechaingreso+"&nreferencia="+nreferencia+"&codactos="+codactos+"&contrato="+contrato+"&dregistral="+dregistral+"&dnotarial="+dnotarial+"&idabogado="+idabogado+"&responsable_new="+responsable_new+"&idusuarios="+idusuarios+"&horaingreso="+horaingreso+"&funcionario_new="+funcionario_new+"&tipoescritura="+tipoescritura)
	
}

function actualizarkardex()
{
	var divResultado = document.getElementById('xcxcxvcx');

	var codkardex    = document.frmprotocolares.codkardex.value;
	var idtipkar     = document.frmprotocolares.idtipkar.value;
	var nreferencia  = document.frmprotocolares.nreferencia.value;
	var codactos     = document.frmprotocolares.codactos.value;
	var contrato     = document.frmprotocolares.contrato.value;
	var dregistral   = document.frmprotocolares.dregistral.value;
	var dnotarial    = document.frmprotocolares.dnotarial.value;
	var kardexconexo = document.frmprotocolares.kardexconexo.value;
	var idnotario    = document.frmprotocolares.idnotario.value;
	var fechaingreso = document.frmprotocolares.fechaingreso.value;	


	
	var idPresentante =  document.frmprotocolares.idPresentante.value;
	var pkTemplate = document.frmprotocolares.idTemplate.value;






	var _txa_minuta = document.getElementById('txa_minuta').value;	
	var idabogado    = document.getElementById('idabogado').value;
	var responsable_new    = document.getElementById('responsable_new').value;
	var ob_nota    = document.getElementById('ob_nota').value;
	var ins_espec    = document.getElementById('ins_espec').value;
	var idusuarios   = document.getElementById('idusuarios').value;
	var funcionario_new = document.getElementById('funcionario_new').value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_kardex_edit.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idtipkar="+idtipkar+"&kardexconexo="+kardexconexo+"&nreferencia="+nreferencia+"&codactos="+codactos+"&contrato="+
		contrato+"&dregistral="+dregistral+"&dnotarial="+dnotarial+"&idnotario="+idnotario+"&codkardex="+codkardex+"&fechaingreso="+
		fechaingreso+"&idabogado="+idabogado+"&responsable_new="+responsable_new+"&ob_nota="+ob_nota+"&ins_espec="+
		ins_espec+"&idusuarios="+idusuarios+"&funcionario_new="+funcionario_new+"&idPresentante="+idPresentante+'&pkTemplate='+pkTemplate);
	
}

function editarmp(){
	
	var divResultado   = document.getElementById('rouif');
	var _codkardex     = document.getElementById('codkardex').value;  
	var _itemmpp       = document.getElementById('itemmpp').value;
    var _tipoactopatri = document.getElementById('tipoactopatri').value; 
	var _nnminuta      = document.getElementById('nnminuta').value; 
	var _imptrans      = document.getElementById('imptrans').value; 
	var _tipomoneda    = document.getElementById('tipomoneda').value; 
	var _exibio        = document.getElementById('exibio').value; 
	var _tipcambio     = document.getElementById('tipcambio').value;
	//humbral = document.getElementById('humbral').value;
	
	// new  : 
	var _idoppago      = document.getElementById('idoppago').value;
	var _des_idoppago  = document.getElementById('otroidoppago').value;

	ajax=objetoAjax();
	ajax.open("POST","editar_grabar_mp2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+_codkardex+"&tipoactopatri="+_tipoactopatri+"&nnminuta="+_nnminuta+"&imptrans="+_imptrans+"&tipomoneda="+_tipomoneda+"&exibio="+_exibio+"&tipcambio="+_tipcambio+"&itemmpp="+_itemmpp+"&idoppago="+_idoppago+"&des_idoppago="+_des_idoppago)
	
}


function grabarmp()
{
	var divResultado  = document.getElementById('rouif');
	var codkardex     = document.frmprotocolares.codkardex.value;
	var tipoactopatri = document.frmprotocolares.tipoactopatri.value;
	var nnminuta      = document.frmprotocolares.nnminuta.value;
	var imptrans      = document.frmprotocolares.imptrans.value;
	var tipomoneda    = document.frmprotocolares.tipomoneda.value;
	var exibio        = document.frmprotocolares.exibio.value;
	var tipcambio     = document.frmprotocolares.tipcambio.value;
	var humbral       = document.frmprotocolares.humbral.value;
	var fpago         = document.frmprotocolares.fpago.value;
	
	// new : 
	var _idoppago     = document.getElementById('idoppago').value;
	var _des_idoppago = document.getElementById('otroidoppago').value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_mp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("codkardex="+codkardex+"&tipoactopatri="+tipoactopatri+"&nnminuta="+nnminuta+"&imptrans="+imptrans+"&tipomoneda="+tipomoneda+"&exibio="+exibio+"&tipcambio="+tipcambio+"&humbral="+humbral+"&fpago="+fpago+"&idoppago="+_idoppago+"&des_idoppago="+_des_idoppago)
	
}


function grabaruifppp()
{
	var codkardex  = document.frmprotocolares.codkardex.value;
	var pregis     = document.frmprotocolares.pregis.value;
	var nregis     = document.frmprotocolares.nregis.value;
	var idsedereg2 = document.frmprotocolares.idsedereg2.value;
	var fpago      = document.frmprotocolares.fpago.value;
	var oporpago   = document.frmprotocolares.oporpago.value;
	var ofpago     = document.frmprotocolares.ofpago.value;
	var itemmpp    = document.frmprotocolares.itemmpp.value;
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_uifp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&pregis="+pregis+"&nregis="+nregis+"&idsedereg2="+idsedereg2+"&fpago="+fpago+"&oporpago="+oporpago+"&ofpago="+ofpago+"&itemmpp="+itemmpp)
	
}

function gggppp()
{ 
	var codkardex          = document.frmprotocolares.codkardex.value;
	var mediopago          = document.frmprotocolares.mediopago.value;
	var entidadfinanciera  = document.frmprotocolares.entidadfinanciera.value;
	var impmediopago       = document.frmprotocolares.impmediopago.value;
	var fechaoperacion     = document.frmprotocolares.fechaoperacion.value;
	var documentos         = document.frmprotocolares.documentos.value;
	var itemmpp            = document.frmprotocolares.itemmpp.value;
	
	var _idtipacto         = document.getElementById('tipactox').value;
	var _fpago             = document.getElementById('fpago').value;
	var _idmon		       = document.getElementById('idmon_mp').value;
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_newmp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//divResultado.innerHTML = ajax.responseText;
			mostrarlistmpp();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&mediopago="+mediopago+"&entidadfinanciera="+entidadfinanciera+"&impmediopago="+impmediopago+"&fechaoperacion="+fechaoperacion+"&documentos="+documentos+"&itemmpp="+itemmpp+"&idtipacto="+_idtipacto+"&fpago="+_fpago+"&idmon="+_idmon)
	
}

function addgbbiens()
{ 

	var divResultado = document.getElementById('rxexmxexlxa');
	var codkardex    = document.frmprotocolares.codkardex.value;
	var _idtipacto   = document.getElementById('tipactox').value;

	var tipob        = document.frmprotocolares.tipob.value;
	var tipobien     = document.frmprotocolares.tipobien.value;
	var codubis      = document.frmprotocolares.codubis.value;
	var fechaconst   = document.frmprotocolares.fechaconst.value;
	var oespecific   = document.frmprotocolares.oespecific.value;
	var smaquiequipo = document.frmprotocolares.smaquiequipo.value;
	var tpsm         = document.frmprotocolares.tpsm.value;
	var npsm         = document.frmprotocolares.npsm.value;
	//var itemmpp      = document.frmprotocolares.itemmpp.value;
	/**/
	var _pregis		 = document.getElementById('pregis').value;
	var _idsederegbien  = document.getElementById('idsedereg2').value;
	
	ajax = objetoAjax();
	ajax.open("POST","grabar_newbienn.php",true);
	ajax.onreadystatechange=function() {
	if (ajax.readyState==4 && ajax.status==200) {
	divResultado.innerHTML = ajax.responseText;
  }
}
	/*ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("codkardex="+codkardex+"&tipob="+tipob+"&tipobien="+tipobien+"&codubis="+codubis+"&fechaconst="+fechaconst+"&oespecific="+oespecific+"&smaquiequipo="+smaquiequipo+"&tpsm="+tpsm+"&npsm="+npsm+"&itemmpp="+itemmpp+"&idtipacto="+_idtipacto+"&pregis="+_pregis+"&idsederegbien="+_idsederegbien)*/
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("codkardex="+codkardex+"&tipob="+tipob+"&tipobien="+tipobien+"&codubis="+codubis+"&fechaconst="+fechaconst+"&oespecific="+oespecific+"&smaquiequipo="+smaquiequipo+"&tpsm="+tpsm+"&npsm="+npsm+"&idtipacto="+_idtipacto+"&pregis="+_pregis+"&idsederegbien="+_idsederegbien)

} 


function tipoacto()
{
	var divResultado = document.getElementById('tipoacto');
	var idtipkar     = document.frmprotocolares.idtipkar.value;
	
	ajax=objetoAjax();
	ajax.open("POST","mostraractos.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idtipkar="+idtipkar)
	
}

function tipoacto2kit()
{
	var divResultado = document.getElementById('tipoacto2');
	var codactos     = document.frmprotocolares.codactos.value;

	ajax=objetoAjax();
	ajax.open("POST","quitaractos.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codactos="+codactos)
	
}

function mostrartab()
{
	var  divResultado = document.getElementById('tabs');
	divResultado.innerHTML= '<img src="loading.gif">';
	var tab="mostrartab";

	ajax=objetoAjax();
	ajax.open("POST","tab.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tab="+tab)
	
}

function buscaclientes2()
{
	var divResultado = document.getElementById('nuevaconyuge');
	var numdoc2      = document.getElementById('numdoc2').value;
	var tidocu       = document.getElementById('tidocu').value;

	ajax=objetoAjax();
	ajax.open("POST","buscadni.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('cumpclie2')){$("#cumpclie2").mask("99/99/9999",{placeholder:"_"});}
			if(document.getElementById('cumpclie4')){$("#cumpclie4").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&numdoc2="+numdoc2+"&tidocu="+tidocu)
	
}

function buscaclientes6()
{

	var divResultado = document.getElementById('nuevaconyuge2');
	var numdoc6      = document.frmprotocolares.numdoc6.value;
	var tipodocu2    = document.getElementById('tidocu2').value;

	ajax=objetoAjax();

	ajax.open("POST","buscadni2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('cumpclie7')){$("#cumpclie7").mask("99/99/9999",{placeholder:"_"});}
			if(document.getElementById('cumpclie6')){$("#cumpclie6").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&numdoc6="+numdoc6+"&tipodocu2="+tipodocu2);
	
}

function vertipoactopat()
{
	var divResultado = document.getElementById('tpacto');
	var codkardex    = document.getElementById('codkardex').value

	ajax=objetoAjax();
	ajax.open("POST","tipoactopatrimonial.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
	
}

function listadobien()
{ 
	var divResultado = document.getElementById('listbiennes');
	if(document.getElementById('listbiennes2'))
	{var divResultado2 = document.getElementById('listbiennes2');}
	
	var codkardex=document.frmprotocolares.codkardex.value;
	var _tipoactopatri = document.getElementById('tipactox').value;
	var ajax=objetoAjax();

	ajax.open("POST","listadobbiieenneess.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('listbiennes2'))
			{divResultado2.innerHTML = ajax.responseText;}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&tipoactopatri="+_tipoactopatri);
	
}
function condiciones()
{
	var divResultado = document.getElementById('tipocondicion');
	var codkardex    = document.frmprotocolares.codkardex.value;

	ajax=objetoAjax();
	ajax.open("POST","mostrarcondicion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
	
}
function condicionesquit()
{
	var divResultado = document.getElementById('tipocondicion');
	var codkardex    = document.frmprotocolares.codkardex.value;
	var codcon       = document.frmprotocolares.codcon.value;

	ajax=objetoAjax();
	ajax.open("POST","mostrarcondicionquit.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&codcon="+codcon)
	
}

function condicionesk()
{
	var divResultado = document.getElementById('tipocondicionk');
	var codkardex    = document.frmprotocolares.codkardex.value;
	var codcon       = document.frmprotocolares.codcon.value;

	ajax=objetoAjax();
	ajax.open("POST","quitarcondicion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&codcon="+codcon)
	
}

function mostrarcontrata()
{
	var divResultado = document.getElementById('contratan');
	divResultado.innerHTML= '<img src="loading.gif">';
	var codkardex    = document.frmprotocolares.codkardex.value;

	ajax=objetoAjax();
	ajax.open("POST","mostrar_contratan.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
	
}
function mostrarcontratac()
{
	var divResultado = document.getElementById('contratanc');
	var codkardex    = document.frmprotocolares.codkardex.value;

	ajax=objetoAjax();
	ajax.open("POST","mostrar_contratanc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
	
}
 
function verclientee()
{
	var divResultado = document.getElementById('verclienterctm');
	var codclie      = document.frmprotocolares.codclie.value;

	ajax=objetoAjax();
	ajax.open("POST","mostrar_clienteeditable.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codclie="+codclie)
	
} 
function verclientee4()
{
	//var divResultado = document.getElementById('verclienterctm');
	var codclie      = document.getElementById('codclie').value;

	ajax=objetoAjax();
	ajax.open("POST","mostrar_cliente.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codclie="+codclie)
}
 
function mostraruifpdtparticipante()
{
	var divResultado = document.getElementById('asigna');
	var codkardex    = document.frmprotocolares.codkardex.value;

	ajax=objetoAjax();
	ajax.open("POST","asigna.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
	
}

function grabarcliente()
{
	var divResultado = document.getElementById('busclie');

	var tipoper        = document.frmprotocolares.tipoper.value;
	
	var tipodoc        = document.frmprotocolares.tipodoc.value;
	
	var numdoc         = document.frmprotocolares.numdoc.value;
	var apepat         = document.frmprotocolares.apepat.value;
	var apemat         = document.frmprotocolares.apemat.value;
	var prinom         = document.frmprotocolares.prinom.value;
	var segnom         = document.frmprotocolares.segnom.value;
	var direccion      = document.frmprotocolares.direccion.value;
	var email          = document.frmprotocolares.email.value;
	var telfijo        = document.frmprotocolares.telfijo.value;
	var telcel         = document.frmprotocolares.telcel.value;
	var telofi         = document.frmprotocolares.telofi.value;
	var sexo           = document.frmprotocolares.sexo.value;
	var idestcivil     = document.frmprotocolares.idestcivil.value;
	var nacionalidad   = document.frmprotocolares.nacionalidad.value;
	var idprofesion    = document.frmprotocolares.idprofesion.value;
	var idcargoo       = document.frmprotocolares.idcargoo.value;
	var cumpclie       = document.frmprotocolares.cumpclie.value;
	var natper         = document.frmprotocolares.natper.value;
	var codubisc       = document.frmprotocolares.codubisc.value;
	var nomprofesiones = document.frmprotocolares.nomprofesiones.value;
	var nomcargoss     = document.frmprotocolares.nomcargoss.value;
	var ubigensc       = document.frmprotocolares.ubigensc.value;
	var cconyuge       = document.frmprotocolares.cconyuge.value;
	var residente      = document.frmprotocolares.residente.value;
	var docpaisemi     = document.frmprotocolares.docpaisemi.value;

	if(idcargoo=='' || idcargoo==0){
		alert('Falta completar el CARGO de la persona')
		return false;
	}else if(idestcivil=='' || idestcivil==0){
		alert('Falta completar el ESTADO CIVIL de la persona')
		return false;
	}else if(sexo=='' || sexo==0){
		alert('Falta completar el SEXO de la persona')
		return false;
	}else if(idprofesion=='' || idprofesion==0){
		alert('Falta completar el OCUPACION de la persona')
		return false;
	}

	ajax=objetoAjax();
	ajax.open("POST","grabar_cliente.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&cconyuge="+cconyuge+"&residente="+residente+"&docpaisemi="+docpaisemi)
	
}

function grabarcliente2()
{
	var divResultado    = document.getElementById('ccconyuge');
	var tipoper         = document.frmprotocolares.tipoper.value;
	var tipodoc         = document.frmprotocolares.tidocu.value;
	var numdoc2         = document.frmprotocolares.numdoc2.value;
	var apepat2         = document.frmprotocolares.apepat2.value;
	var apemat2         = document.frmprotocolares.apemat2.value;
	var prinom2         = document.frmprotocolares.prinom2.value;
	var segnom2         = document.frmprotocolares.segnom2.value;
	var direccion2      = document.frmprotocolares.direccion2.value;
	var email2          = document.frmprotocolares.email2.value;
	var telfijo2        = document.frmprotocolares.telfijo2.value;
	var telcel2         = document.frmprotocolares.telcel2.value;
	var telofi2         = document.frmprotocolares.telofi2.value;
	var sexo2           = document.frmprotocolares.sexo2.value;
	var idestcivil2     = document.frmprotocolares.idestcivil2.value;
	var nacionalidad2   = document.frmprotocolares.nacionalidad2.value;
	var idprofesion2    = document.frmprotocolares.idprofesion2.value;
	var idcargoo2       = document.frmprotocolares.idcargoo2.value;
	var cumpclie2       = document.frmprotocolares.cumpclie2.value;
	var natper2         = document.frmprotocolares.natper2.value;
	var codubisc2       = document.frmprotocolares.codubisc2.value;
	var nomprofesiones2 = document.frmprotocolares.nomprofesiones2.value;
	var nomcargoss2     = document.frmprotocolares.nomcargoss2.value;
	var ubigensc2       = document.frmprotocolares.ubigensc2.value;
	var residente2      = document.frmprotocolares.residente2.value;
	var docpaisemi2     = document.frmprotocolares.docpaisemi2.value;
		
	if(idcargoo2=='' || idcargoo2==0){
		alert('Falta completar el CARGO de la persona')
		return false;
	}else if(idestcivil2=='' || idestcivil2==0){
		alert('Falta completar el ESTADO CIVIL de la persona')
		return false;
	}else if(sexo2=='' || sexo2==0){
		alert('Falta completar el SEXO de la persona')
		return false;
	}else if(idprofesion2=='' || idprofesion2==0){
		alert('Falta completar el OCUPACION de la persona')
		return false;
	}


	ajax=objetoAjax();
	ajax.open("POST","grabar_cliente2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc2="+numdoc2+"&apepat2="+apepat2+"&apemat2="+apemat2+"&prinom2="+prinom2+"&segnom2="+segnom2+"&direccion2="+direccion2+"&email2="+email2+"&telfijo2="+telfijo2+"&telcel2="+telcel2+"&telofi2="+telofi2+"&sexo2="+sexo2+"&idestcivil2="+idestcivil2+"&nacionalidad2="+nacionalidad2+"&idprofesio2n="+idprofesion2+"&idcargoo2="+idcargoo2+"&cumpclie2="+cumpclie2+"&natper2="+natper2+"&codubisc2="+codubisc2+"&nomprofesiones2="+nomprofesiones2+"&nomcargoss2="+nomcargoss2+"&ubigensc2="+ubigensc2+"&residente2="+residente2+"&docpaisemi2="+docpaisemi2)
	
}


function grabarcliente3()
{
	var divResultado    = document.getElementById('tredfdfdf');
	var numdoc3         = document.frmprotocolares.numdoc3.value;
	var apepat3         = document.frmprotocolares.apepat3.value;
	var apemat3         = document.frmprotocolares.apemat3.value;
	var prinom3         = document.frmprotocolares.prinom3.value;
	var segnom3         = document.frmprotocolares.segnom3.value;
	var direccion3      = document.frmprotocolares.direccion3.value;
	var email3          = document.frmprotocolares.email3.value;
	var telfijo3        = document.frmprotocolares.telfijo3.value;
	var telcel3         = document.frmprotocolares.telcel3.value;
	var telofi3         = document.frmprotocolares.telofi3.value;
	var sexo3           = document.frmprotocolares.sexo3.value;
	var idestcivil3     = document.frmprotocolares.idestcivil3.value;
	var nacionalidad3   = document.frmprotocolares.nacionalidad3.value;
	var idprofesion3    = document.frmprotocolares.idprofesion3.value;
	var idcargoo3       = document.frmprotocolares.idcargoo3.value;
	var cumpclie3       = document.frmprotocolares.cumpclie3.value;
	var natper3         = document.frmprotocolares.natper3.value;
	var codubisc3       = document.frmprotocolares.codubisc3.value;
	var nomprofesiones3 = document.frmprotocolares.nomprofesiones3.value;
	var nomcargoss3     = document.frmprotocolares.nomcargoss3.value;
	var ubigensc3       = document.frmprotocolares.ubigensc3.value;
	var residente3      = document.frmprotocolares.residente3.value;
	var docpaisemi3     = document.frmprotocolares.docpaisemi3.value;
	var codclie3        = document.frmprotocolares.codclie3.value;	
	var cconyuge6       = document.frmprotocolares.cconyuge6.value;

	if(idcargoo3=='' || idcargoo3==0){
		alert('Falta completar el CARGO de la persona')
		return false;
	}else if(idestcivil3=='' || idestcivil3==0){
		alert('Falta completar el ESTADO CIVIL de la persona')
		return false;
	}else if(sexo3=='' || sexo3==0){
		alert('Falta completar el SEXO de la persona')
		return false;
	}else if(idprofesion3=='' || idprofesion3==0){
		alert('Falta completar el OCUPACION de la persona')
		return false;
	}

	ajax=objetoAjax();
	ajax.open("POST","grabar_cliente3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			buscaclientes();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoc3="+numdoc3+"&apepat3="+apepat3+"&apemat3="+apemat3+"&prinom3="+prinom3+"&segnom3="+segnom3+"&direccion3="+direccion3+"&email3="+email3+"&telfijo3="+telfijo3+"&telcel3="+telcel3+"&telofi3="+telofi3+"&sexo3="+sexo3+"&idestcivil3="+idestcivil3+"&nacionalidad3="+nacionalidad3+"&idprofesion3="+idprofesion3+"&idcargoo3="+idcargoo3+"&cumpclie3="+cumpclie3+"&natper3="+natper3+"&codubisc3="+codubisc3+"&nomprofesiones3="+nomprofesiones3+"&nomcargoss3="+nomcargoss3+"&ubigensc3="+ubigensc3+"&residente3="+residente3+"&docpaisemi3="+docpaisemi3+"&codclie3="+codclie3+"&cconyuge6="+cconyuge6)
	
}

function grabarcliente4()
{
	var divResultado    = document.getElementById('ccconyuge');
	var tipoper			= document.frmprotocolares.tipoper.value;
	var tipodoc			= document.frmprotocolares.tipodoc.value;
	var numdoc2			= document.frmprotocolares.numdoc2.value;
	var apepat4			= document.frmprotocolares.apepat4.value;
	var apemat4			= document.frmprotocolares.apemat4.value;
	var prinom4			= document.frmprotocolares.prinom4.value;
	var segnom4			= document.frmprotocolares.segnom4.value;
	var direccion4      = document.frmprotocolares.direccion4.value;
	var email4          = document.frmprotocolares.email4.value;
	var telfijo4        = document.frmprotocolares.telfijo4.value;
	var telcel4         = document.frmprotocolares.telcel4.value;
	var telofi4         = document.frmprotocolares.telofi4.value;
	var sexo4           = document.frmprotocolares.sexo4.value;
	var idestcivil4     = document.frmprotocolares.idestcivil4.value;
	var nacionalidad4   = document.frmprotocolares.nacionalidad4.value;
	var idprofesion4    = document.frmprotocolares.idprofesion4.value;
	var idcargoo4       = document.frmprotocolares.idcargoo4.value;
	var cumpclie4       = document.frmprotocolares.cumpclie4.value;
	var natper4         = document.frmprotocolares.natper4.value;
	var codubisc4       = document.frmprotocolares.codubisc4.value;
	var nomprofesiones4 = document.frmprotocolares.nomprofesiones4.value;
	var nomcargoss4		= document.frmprotocolares.nomcargoss4.value;
	var ubigensc4		= document.frmprotocolares.ubigensc4.value;
	var residente4		= document.frmprotocolares.residente4.value;
	var docpaisemi4		= document.frmprotocolares.docpaisemi4.value;
	var codclie4		= document.frmprotocolares.codclie4.value;	

	ajax=objetoAjax();
	ajax.open("POST","grabar_cliente4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc2="+numdoc2+"&apepat4="+apepat4+"&apemat4="+apemat4+"&prinom4="+prinom4+"&segnom4="+segnom4+"&direccion4="+direccion4+"&email4="+email4+"&telfijo4="+telfijo4+"&telcel4="+telcel4+"&telofi4="+telofi4+"&sexo4="+sexo4+"&idestcivil4="+idestcivil4+"&nacionalidad4="+nacionalidad4+"&idprofesio4n="+idprofesion4+"&idcargoo4="+idcargoo4+"&cumpclie4="+cumpclie4+"&natper4="+natper4+"&codubisc4="+codubisc4+"&nomprofesiones4="+nomprofesiones4+"&nomcargoss4="+nomcargoss4+"&ubigensc4="+ubigensc4+"&residente4="+residente4+"&docpaisemi4="+docpaisemi4+"&codclie4="+codclie4)
	
}

function grabarcliente6()
{
	var divResultado    = document.getElementById('ccconyuge2');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var numdoc6			= document.frmprotocolares.numdoc6.value;
	var apepat6			= document.frmprotocolares.apepat6.value;
	var apemat6			= document.frmprotocolares.apemat6.value;
	var prinom6			= document.frmprotocolares.prinom6.value;
	var segnom6			= document.frmprotocolares.segnom6.value;
	var direccion6		= document.frmprotocolares.direccion6.value;
	var email6			= document.frmprotocolares.email6.value;
	var telfijo6		= document.frmprotocolares.telfijo6.value;
	var telcel6			= document.frmprotocolares.telcel6.value;
	var telofi6			= document.frmprotocolares.telofi6.value;
	var sexo6			= document.frmprotocolares.sexo6.value;
	var idestcivil6     = document.frmprotocolares.idestcivil6.value;
	var nacionalidad6   = document.frmprotocolares.nacionalidad6.value;
	var idprofesion6    = document.frmprotocolares.idprofesion6.value;
	var idcargoo6       = document.frmprotocolares.idcargoo6.value;
	var cumpclie6       = document.frmprotocolares.cumpclie6.value;
	var natper6         = document.frmprotocolares.natper6.value;
	var codubisc6       = document.frmprotocolares.codubisc6.value;
	var nomprofesiones6 = document.frmprotocolares.nomprofesiones6.value;
	var nomcargoss6		= document.frmprotocolares.nomcargoss6.value;
	var ubigensc6		= document.frmprotocolares.ubigensc6.value;
	var residente6		= document.frmprotocolares.residente6.value;
	var docpaisemi6		= document.frmprotocolares.docpaisemi6.value;
	var codclie6		= document.frmprotocolares.codclie6.value;	

	ajax=objetoAjax();
	ajax.open("POST","grabar_cliente6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			verclientee()
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoc6="+numdoc6+"&apepat6="+apepat6+"&apemat6="+apemat6+"&prinom6="+prinom6+"&segnom6="+segnom6+"&direccion6="+direccion6+"&email6="+email6+"&telfijo6="+telfijo6+"&telcel6="+telcel6+"&telofi6="+telofi6+"&sexo6="+sexo6+"&idestcivil6="+idestcivil6+"&nacionalidad6="+nacionalidad6+"&idprofesio6n="+idprofesion6+"&idcargoo6="+idcargoo6+"&cumpclie6="+cumpclie6+"&natper6="+natper6+"&codubisc6="+codubisc6+"&nomprofesiones6="+nomprofesiones6+"&nomcargoss6="+nomcargoss6+"&ubigensc6="+ubigensc6+"&residente6="+residente6+"&docpaisemi6="+docpaisemi6+"&codclie6="+codclie6)
	
}
function grabarclienteexist()
{
	var divResultado    = document.getElementById('ccconyuge2');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var numdoc6			= document.getElementById('numdoc6').value;
	var apepat6			= document.getElementById('apepat6').value;
	var apemat6			= document.getElementById('apemat6').value;
	var prinom6			= document.getElementById('prinom6').value;
	var segnom6			= document.getElementById('segnom6').value;
	var direccion6		= document.getElementById('direccion6').value;
	var email6			= document.getElementById('email6').value;
	var telfijo6		= document.getElementById('telfijo6').value;
	var telcel6			= document.getElementById('telcel6').value;
	var telofi6			= document.getElementById('telofi6').value;
	var sexo6			= document.getElementById('sexo6').value;
	var idestcivil6     = document.getElementById('idestcivil6').value;
	var nacionalidad6   = document.getElementById('nacionalidad6').value;
	var idprofesion6    = document.getElementById('idprofesion6').value;
	var idcargoo6       = document.getElementById('idcargoo6').value;
	var cumpclie6       = document.getElementById('cumpclie6').value;
	var natper6         = document.getElementById('natper6').value;
	var codubisc6       = document.getElementById('codubis6').value;
	var nomprofesiones6 = document.getElementById('nomprofesiones6').value;
	var nomcargoss6		= document.getElementById('nomcargoss6').value;
	var ubigensc6		= document.getElementById('ubigensc6').value;
	var residente6		= document.getElementById('residente6').value;
	var docpaisemi6		= document.getElementById('docpaisemi6').value;
	var codclie6		= document.getElementById('codclie6').value;	

	ajax=objetoAjax();
	ajax.open("POST","grabar_clienteexist.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			verclientee4()
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoc6="+numdoc6+"&apepat6="+apepat6+"&apemat6="+apemat6+"&prinom6="+prinom6+"&segnom6="+segnom6+"&direccion6="+direccion6+"&email6="+email6+"&telfijo6="+telfijo6+"&telcel6="+telcel6+"&telofi6="+telofi6+"&sexo6="+sexo6+"&idestcivil6="+idestcivil6+"&nacionalidad6="+nacionalidad6+"&idprofesio6n="+idprofesion6+"&idcargoo6="+idcargoo6+"&cumpclie6="+cumpclie6+"&natper6="+natper6+"&codubisc6="+codubisc6+"&nomprofesiones6="+nomprofesiones6+"&nomcargoss6="+nomcargoss6+"&ubigensc6="+ubigensc6+"&residente6="+residente6+"&docpaisemi6="+docpaisemi6+"&codclie6="+codclie6)
}

function grabarcliente7()
{
	var divResultado = document.getElementById('ccconyuge2');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var tidocu2			= document.frmprotocolares.tidocu2.value;
	var numdoc6			= document.frmprotocolares.numdoc6.value;
	var apepat7			= document.frmprotocolares.apepat7.value;
	var apemat7			= document.frmprotocolares.apemat7.value;
	var prinom7			= document.frmprotocolares.prinom7.value;
	var segnom7			= document.frmprotocolares.segnom7.value;
	var direccion7		= document.frmprotocolares.direccion7.value;
	var email7			= document.frmprotocolares.email7.value;
	var telfijo7		= document.frmprotocolares.telfijo7.value;
	var telcel7			= document.frmprotocolares.telcel7.value;
	var telofi7			= document.frmprotocolares.telofi7.value;
	var sexo7			= document.frmprotocolares.sexo7.value;
	var idestcivil7		= document.frmprotocolares.idestcivil7.value;
	var nacionalidad7	= document.frmprotocolares.nacionalidad7.value;
	var idprofesion7	= document.frmprotocolares.idprofesion7.value;
	var idcargoo7		= document.frmprotocolares.idcargoo7.value;
	var cumpclie7		= document.frmprotocolares.cumpclie7.value;
	var natper7			= document.frmprotocolares.natper7.value;
	var codubisc7		= document.frmprotocolares.codubisc7.value;
	var nomprofesiones7 = document.frmprotocolares.nomprofesiones7.value;
	var nomcargoss7		= document.frmprotocolares.nomcargoss7.value;
	var ubigensc7		= document.frmprotocolares.ubigensc7.value;
	var residente7		= document.frmprotocolares.residente7.value;
	var docpaisemi7		= document.frmprotocolares.docpaisemi7.value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_cliente7.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tidocu2="+tidocu2+"&numdoc6="+numdoc6+"&apepat7="+apepat7+"&apemat7="+apemat7+"&prinom7="+prinom7+"&segnom7="+segnom7+"&direccion7="+direccion7+"&email7="+email7+"&telfijo7="+telfijo7+"&telcel7="+telcel7+"&telofi7="+telofi7+"&sexo7="+sexo7+"&idestcivil7="+idestcivil7+"&nacionalidad7="+nacionalidad7+"&idprofesio7n="+idprofesion7+"&idcargoo7="+idcargoo7+"&cumpclie7="+cumpclie7+"&natper7="+natper7+"&codubisc7="+codubisc7+"&nomprofesiones7="+nomprofesiones7+"&nomcargoss7="+nomcargoss7+"&ubigensc7="+ubigensc7+"&residente7="+residente7+"&docpaisemi7="+docpaisemi7)
	
}

function grabarempresa()
{
	var divResultado  = document.getElementById('busclie');

	var tipoper		  = document.frmprotocolares.tipoper.value;
	var tipodoc		  = document.frmprotocolares.tipodoc.value;
	var numdoc		  = document.frmprotocolares.numdoc.value;
	var razonsocial	  = document.frmprotocolares.razonsocial.value;
	var domfiscal	  = document.frmprotocolares.domfiscal.value;
	var telempresa	  = document.frmprotocolares.telempresa.value;
	var mailempresa   = document.frmprotocolares.mailempresa.value;
	var contacempresa = document.frmprotocolares.contacempresa.value;
	var fechaconstitu = document.frmprotocolares.fechaconstitu.value;
	var numregistro   = document.frmprotocolares.numregistro.value;
	var numpartida    = document.frmprotocolares.numpartida.value;
	var actmunicipal  = document.frmprotocolares.actmunicipal.value;
	var codubi		  = document.frmprotocolares.codubi.value;
	var idsedereg3	  = document.frmprotocolares.idsederegemp.value;



	$.ajax({
		url:'grabar_empresa.php',
		data:{tipoper:tipoper,tipodoc:tipodoc,numdoc:numdoc,razonsocial:razonsocial,domfiscal:domfiscal,
			telempresa:telempresa,mailempresa:mailempresa,contacempresa:contacempresa,fechaconstitu:fechaconstitu,
			numregistro:numregistro,numpartida:numpartida,actmunicipal:actmunicipal,codubi:codubi,idsedereg3:idsedereg3},
		dataType:'html',
		type:'POST',
		success:function(response){
			divResultado.innerHTML = response;
		}

	});

	/*
	ajax=objetoAjax();
	ajax.open("POST","grabar_empresa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3)
	*/
}

function grabarempresanp()
{
	var divResultado  = document.getElementById('datos');

	var tipoper		  = document.getElementById("tipoper").value;
	var tipodoc		  = document.getElementById("selectdoc").value;
	var numdoc		  = document.getElementById("numdoc").value;
	var razonsocial	  = document.getElementById("razonsocial").value;
	var domfiscal	  = document.getElementById("domfiscal").value;
	var telempresa	  = document.getElementById("telempresa").value;
	var mailempresa   = document.getElementById("mailempresa").value;
	var contacempresa = document.getElementById("contacempresa").value;
	var fechaconstitu = document.getElementById("fechaconstitu").value;
	var numregistro   = document.getElementById("numregistro").value;
	var numpartida    = document.getElementById("numpartida").value;
	var actmunicipal  = document.getElementById("actmunicipal").value;
	var codubi		  = document.getElementById("codubi").value;
	var idsedereg3	  = document.getElementById("idsedereg3").value;

	$.ajax({
		url:'grabar_empresanp.php',
		data:{tipoper:'J',tipodoc:tipodoc,numdoc:numdoc,razonsocial:razonsocial,domfiscal:domfiscal,
			telempresa:telempresa,mailempresa:mailempresa,contacempresa:contacempresa,fechaconstitu:fechaconstitu,
			numregistro:numregistro,numpartida:numpartida,actmunicipal:actmunicipal,codubi:codubi,idsedereg3:idsedereg3},
		dataType:'html',
		type:'POST',
		success:function(response){
			divResultado.innerHTML = response;
		}

	});

	/*
	ajax=objetoAjax();
	ajax.open("POST","grabar_empresanp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoper=J&tipodoc="+tipodoc+"&numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3)
	*/

}

function grabarempresa3()
{
	var divResultado = document.getElementById('busclie');

	var numdoc        = document.frmprotocolares.numdoc.value;
	var ruc_emp        = document.frmprotocolares.ruc_emp.value;
	var razonsocial   = document.frmprotocolares.razonsocial.value;
	var domfiscal     = document.frmprotocolares.domfiscal.value;
	var telempresa    = document.frmprotocolares.telempresa.value;
	var mailempresa   = document.frmprotocolares.mailempresa.value;
	var contacempresa = document.frmprotocolares.contacempresa.value;
	var fechaconstitu = document.frmprotocolares.fechaconstitu.value;
	var numregistro   = document.frmprotocolares.numregistro.value;
	var numpartida    = document.frmprotocolares.numpartida.value;
	var actmunicipal  = document.frmprotocolares.actmunicipal.value;
	var codubi		  = document.frmprotocolares.codubi.value;
	var idsedereg3	  = document.frmprotocolares.idsederegemp.value;
	var idclie		  = document.frmprotocolares.codclie3.value;
	var contra		  = document.frmprotocolares.coddcontrata2.value;

	$.ajax({
		url:'grabar_empresa3.php',
		data:{numdoc:numdoc,razonsocial:razonsocial,domfiscal:domfiscal,
			telempresa:telempresa,mailempresa:mailempresa,contacempresa:contacempresa,fechaconstitu:fechaconstitu,
			numregistro:numregistro,numpartida:numpartida,actmunicipal:actmunicipal,codubi:codubi,idsedereg3:idsedereg3,
			idclie:idclie,contra:contra,ruc_emp:ruc_emp},
		dataType:'html',
		type:'POST',
		success:function(response){
			divResultado.innerHTML = response;
		}

	});
	/*
	ajax=objetoAjax();
	ajax.open("POST","grabar_empresa3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			mostrarcontratante();
			alert('Contratante modificado satisfactoriamente');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3+"&idclie="+idclie+"&contra="+contra+"&ruc_emp="+ruc_emp)
	*/
}

function limpiarbucaclie()
{
	var divResultado = document.getElementById('busclie');
	var numdoc       = document.frmprotocolares.numdoc.value;

	ajax=objetoAjax();
	ajax.open("POST","limpiabusclie.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			mostrarcombopersona();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoc="+numdoc)
	
}

function updatekardex()
{
	divResultado = document.getElementById('mela');
	
	var codkardex       = document.frmprotocolares.codkardex.value;
	var fechaconclusion = document.frmprotocolares.fechaconclusion.value;
	var folioini        = document.frmprotocolares.folioini.value;
	var foliofin        = document.frmprotocolares.foliofin.value;
	var papelini        = document.frmprotocolares.papelini.value;
	var papelfin        = document.frmprotocolares.papelfin.value;
	var numminuta       = document.frmprotocolares.numminuta.value;
	var numescritura    = document.frmprotocolares.numescritura.value;
	var fechaescritura  = document.frmprotocolares.fechaescritura.value;
	var _contrato2      = document.getElementById('contrato').value;
	var tomo  = document.getElementById('tomox').value;
	var registro  = document.getElementById('regx').value;
	var fechaminuta  = document.getElementById('fechaminuta').value;


	var papelTrasladoIni = document.frmprotocolares.papelTrasladoIni.value;
	var papelTrasladoFin = document.frmprotocolares.papelTrasladoFin.value;

	var idtipkar  = document.getElementById('idtipkar').value;
	
	var isBorrarEscritura="";
		if(document.getElementById("isBorrarEscritura")!=undefined)
			isBorrarEscritura=document.getElementById("isBorrarEscritura").value;

	if(isBorrarEscritura==""){

		if(fechaescritura!=''){
			CompareDatesescritu(document.getElementById('fechaingreso').value,document.getElementById('fechaescritura').value);
			if(numescritura!=''){			
			}else{
				alert('Faltan ingresar Escritura');return;
			}
		} else {
			alert('Faltan ingresar Fecha de Escritura');return;
		}
			
		if(CompareDatesescritu(document.getElementById('fechaingreso').value,document.getElementById('fechaescritura').value)==true)
		divResultado.innerHTML= '<img src="loading.gif">';
	}

	ajax=objetoAjax();
	ajax.open("POST","grabar_kardex_escritura.php",true);
	ajax.onreadystatechange=function() {
		
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechaconclusion="+fechaconclusion+"&folioini="+folioini+"&foliofin="+foliofin+"&papelini="+papelini+"&papelfin="+
		papelfin+"&numminuta="+numminuta+"&numescritura="+numescritura+"&fechaescritura="+fechaescritura+"&codkardex="+codkardex+
		"&tomo="+tomo+"&registro="+registro+"&fechaminuta="+fechaminuta+'&papelTrasladoIni='+papelTrasladoIni+
		'&papelTrasladoFin='+papelTrasladoFin+"&idtipkar="+idtipkar);
	
	
		// ***************************** //
}
	


function listarcontrata()
{
	var divResultado = document.getElementById('manclie');
	divResultado.innerHTML= '<img src="loading.gif">';
	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","mostrar_contratantes_list.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex)
}


function grabarrenta()
{
	var divResultado   = document.getElementById('rptf');
	var codkardex      = document.frmprotocolares.codkardex.value;
	var idcontratantee = document.frmprotocolares.idcontratantee.value;
	var pregu1         = document.frmprotocolares.pregu1.value;
	var pregu2         = document.frmprotocolares.pregu2.value;
	var pregu3		   = document.frmprotocolares.pregu3.value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_renta.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			calcularfrm();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&idcontratantee="+idcontratantee+"&pregu1="+pregu1+"&pregu2="+pregu2+"&pregu3="+pregu3)
	
}


function calcularfrm()
{
	var divResultado = document.getElementById('formulinn');
	divResultado.innerHTML= '<img src="loading.gif">';
	var pregu1       = document.frmprotocolares.pregu1.value;
	var pregu2       = document.frmprotocolares.pregu2.value;
	var pregu3       = document.frmprotocolares.pregu3.value;
	
	ajax=objetoAjax();
	ajax.open("POST","mostrarboton.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("pregu1="+pregu1+"&pregu2="+pregu2+"&pregu3="+pregu3)
	
}
function grabar_renta_edit(){
	
	var divResultado   = document.getElementById('rptf');
	var idrenta = document.frmprotocolares.idrenta.value;
	var pregu1  = document.frmprotocolares.pregu1.value;
	var pregu2  = document.frmprotocolares.pregu2.value;
	var pregu3	= document.frmprotocolares.pregu3.value;


	ajax=objetoAjax();
	ajax.open("POST","grabar_renta_edit.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			calcularfrm();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idrenta="+idrenta+"&pregu1="+pregu1+"&pregu2="+pregu2+"&pregu3="+pregu3)
	
	}


function eliformul(id){
	
	var divResultado = document.getElementById('formulinn');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var formu        = id;
	
	ajax=objetoAjax();
	ajax.open("POST","eliminarformu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText; 
			alert('Formulario Eliminado..!');
			listaformu();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("formu="+formu);
	}

function verificarsiexistefor(){
	
	
	var divResultado = document.getElementById('formulinn');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var contrata     = document.getElementById('idcontratantee').value;
	
	ajax=objetoAjax();
	ajax.open("POST","mostrarboton2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText; grabarrenta2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("contrata="+contrata);
	}

function grabarrenta2()
{
	var divResultado = document.getElementById('rptf');

	divResultado.innerHTML= '<img src="loading.gif">';
	
	var contrata     = document.getElementById('idcontratantee').value;
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_renta2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;         
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("contrata="+contrata);
}

function edicion(){
	
	var divResultado = document.getElementById('gbrrent');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var contrata     = document.getElementById('idcontratantee').value;
	
	ajax=objetoAjax();
	ajax.open("POST","verkboton.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText; verificarsiexistefor();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("contrata="+contrata);
	}


/////////////////////////////////////////////////
function mostrar_datos_renta(){
	
	var divResultado = document.getElementById('formu_rent');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var contrata     = document.getElementById('idcontratantee').value;
	
	ajax=objetoAjax();
	ajax.open("POST","mostrar_formurent.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;   	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("contrata="+contrata);
	
	
	}

////////////////////////////////////////////////////

function saveformulario()
{
	var divResultado = document.getElementById('listform');
	var numformu     = document.getElementById('numformu').value;
	var monto        = document.getElementById('monto').value;
	var idrenta      = document.getElementById('idrentas').value;
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_formulario.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			listaformu();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+numformu+"&monto="+monto+"&idrenta="+idrenta);
}



function listaformu()
{
	var divResultado = document.getElementById('listform');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var idrenta      = document.getElementById('idrenta').value;

	ajax=objetoAjax();
	ajax.open("POST","mostrar_formulario.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idrenta="+idrenta);
}

function buscakardexn()
{
	divResultado = document.getElementById('bkardex');
	var	nnkardex = document.frmbuscakardex.nnkardex.value;
	
	ajax = objetoAjax();
	ajax.open("POST","buscakardexn.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nnkardex="+nnkardex);
}

function buscakardexn2()
{
	
	var divResultado  = document.getElementById('bkardex');
	var _rangoc1  = document.getElementById('rangoc1').value; 	
	var _rangoc2  = document.getElementById('rangoc2').value;
	var _nombrer  = document.getElementById('nombrer').value;
	var _nombred  = document.getElementById('nombred').value;
	var _numcarta = document.getElementById('numcarta').value;
	
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaCARTA2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("rangocuno="+_rangoc1+"&rangocdos="+_rangoc2+"&nombrer="+_nombrer+
			  "&nombred="+_nombred+"&numcarta="+_numcarta);
}

function buscakardexn3()
{
	
	var divResultado = document.getElementById('bkardex');
	var _nombred     = document.getElementById('nombred').value;
	
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaCARTA3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nombred="+_nombred);
}

function buscakardexc()
{
	var divResultado   = document.getElementById('bkardex');
	var nomcontratante = document.frmbuscakardex.nomcontratante.value;
	var tipoper        = document.frmbuscakardex.tipoper.value;

	ajax=objetoAjax();
	ajax.open("POST","buscakardexc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nomcontratante="+nomcontratante+"&tipoper="+tipoper);
}

function elimmrp()
{
	var divResultado  = document.getElementById('oiutyr');
	var itemcodmovreg = document.frmprotocolares.itemcodmovreg.value;
	var codmovreg     = document.frmprotocolares.codmovreg.value;
	
	ajax=objetoAjax();
	ajax.open("POST","eliminarmrrpp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			mostrarnewreg();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("itemcodmovreg="+itemcodmovreg+"&codmovreg="+codmovreg);
}

function vermovimientorp(argId)
{

	var itemcodmovreg = argId;
	$('#titleMovimiento').text('Edición  de Movimientos RR. PP');
	$('#newmrrpp').show();

	$.ajax({
		url:'ditarmrrpp.php',
		dataType:'json',
		type:'POST',
		data:{itemcodmovreg:itemcodmovreg},
		success:function(response){


			
			if(response.error == 0){

				data = response.data;

				

				$('#itemcodmovreg').val(data.itemmov);
				$('#fechamov').val(data.fechamov);
				$('#vencimiento').val(data.vencimiento);
				$('#titulorp').val(data.titulorp);

				$('#idtiptraoges').val(data.idtiptraoges);
				$('#uniform-idtiptraoges span').text($("#idtiptraoges option:selected").html());
				
				$('#idsedereg').val(data.idsedereg);
				$('#uniform-idsedereg span').text($("#idsedereg option:selected").html());


				$('#numeroPartida').val(data.numeroPartida);

				$('#idsecreg').val(data.idsecreg);
				$('#uniform-idsecreg span').text($("#idsecreg option:selected").html());

				$('#idestreg').val(data.idestreg);
				$('#uniform-idestreg span').text($("#idestreg option:selected").html());

				$('#asiento').val(data.asiento);
				$('#importee').val(data.importee);
				$('#encargado').val(data.encargado);
				$('#recibo').val(data.recibo);
				$('#fechaInscripcion').val(data.fechaInscripcion);
				$('#observa').val(data.observa);
				$('#anotacion').val(data.anotacion);
				$('#registrador').val(data.registrador);


			}
			


		}
	});

	/*var divResultado  = document.getElementById('edirrpp');

	var itemcodmovreg = document.frmprotocolares.itemcodmovreg.value;
	
	ajax = objetoAjax();
	ajax.open("POST","ditarmrrpp.php",true);
	ajax.onreadystatechange=function() {

		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("itemcodmovreg="+itemcodmovreg);*/
}

function mostrarlistmpp()
{
	var divResultado = document.getElementById('listmedpago');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","listarmpp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}


function mostrarlistmpp2()
{
	var divResultado = document.getElementById('listmedpago2');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var codkardex    = document.getElementById('codkardex').value;
	
	ajax=objetoAjax();
	ajax.open("POST","listarmpp2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}

function mostrarsaldos()
{
	var divResultado = document.getElementById('resultcodmovreg');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var codkardex    = document.frmprotocolares.codkardex.value;
	var codmovreg    = document.frmprotocolares.codmovreg.value;
	
	ajax=objetoAjax();
	ajax.open("POST","mostrarsaldorp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&codmovreg="+codmovreg);
}

function editcontra()
{
	var divResultado = document.getElementById('rptaedit');
	var idcontra     = document.frmprotocolares.idcontra.value;
	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","mostrareditarcontratante.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra+"&codkardex="+codkardex);
}

function grabareditarcontraaaa()
{
    var divResultado = document.getElementById('msjee');
	var idcontra	 = document.frmprotocolares.idcontra.value;
	var idtipkar	 = document.frmprotocolares.idtipkar.value;
	var codkardex	 = document.frmprotocolares.codkardex.value;
	var codconn		 = document.frmprotocolares.codconn.value;
	var firmaa		 = document.frmprotocolares.firmaa.value;
	var indice2		 = document.frmprotocolares.indice2.value;
	var repre2       = document.frmprotocolares.repre2.value;
	var representaa2 = document.frmprotocolares.representaa2.value;
	var facultadess  = document.frmprotocolares.facultadess.value;
	var inscrito     = document.getElementById('inscrito').value;
	var idsederegerp     = document.getElementById('idsederegerp').value;
	var nparti     = document.getElementById('nparti').value;
	
	ajax=objetoAjax();
	ajax.open("POST","grabareditarcontratante.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200){
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra+"&codkardex="+codkardex+"&codconn="+codconn+"&firmaa="+firmaa+"&indice2="+indice2+"&repre2="+repre2+"&representaa2="+representaa2+"&facultadess="+facultadess+"&idtipkar="+idtipkar+"&inscrito="+inscrito+"&idsederegerp="+idsederegerp+"&nparti="+nparti);
}

function limpiaredit()
{
	var divResultado = document.getElementById('rptaedit');
	var idcontra     = document.frmprotocolares.idcontra.value;
	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","limpiaedit.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra+"&codkardex="+codkardex);
}

function mosteliminarc()
{ 
	var divResultado = document.getElementById('uuu');
	var idcontra     = document.frmprotocolares.idcontra.value;
	
	ajax=objetoAjax();
	ajax.open("POST","eliminarcontratante.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idcontra="+idcontra);
	}
	
function infopago()
{
	var divResultado = document.getElementById('frmpatrimo');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","patri_info_pago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}

function infobien()
{ 
	var divResultado = document.getElementById('frmpatrimo');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var codkardex    = document.frmprotocolares.codkardex.value;
	ajax=objetoAjax();
	ajax.open("POST","patri_info_bien.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}
	

function infosatuif()
{ 	
	var divResultado = document.getElementById('frmpatrimo');
	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","patri_info_sunatuif.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}

function grabarfirma()
{
	var codkardex = document.frmprotocolares.codkardex.value;
	var fecfirmaa = document.frmprotocolares.fecfirmaa.value;
	var firmitaa  = document.frmprotocolares.firmitaa.value;
	
	// EXISTEN DOS DIVS RESULTADO, verifyfirma y mela, SE COLOCA A mela COMO PRINCIPAL
	var divResultado = document.getElementById('mela');
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_firma_contrante.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			mostrarcontratante();
			//mostrarcontratante2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fecfirmaa="+fecfirmaa+"&firmitaa="+firmitaa);
}


function buscaubigeos()
{ 	
	var divResultado = document.getElementById('resulubi');
	var buscaubi     = document.frmprotocolares.buscaubi.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeo.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubi="+buscaubi);
}

function buscaubigeoss()
{ 	
	var divResultado = document.getElementById('resulubis');
	var buscaubis    = document.frmprotocolares.buscaubis.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeos.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubis="+buscaubis);
}

function buscaubigeossc()
{ 	
	var divResultado = document.getElementById('resulubisc');
	var buscaubisc   = document.frmprotocolares.buscaubisc.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc);
}

function buscaubigeossc2()
{ 	
	var divResultado = document.getElementById('resulubisc2');
	var buscaubisc2  = document.frmprotocolares.buscaubisc2.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc2="+buscaubisc2);
}

function buscaubigeossc3()
{ 	
	var divResultado = document.getElementById('resulubisc3');
	var buscaubisc3  = document.frmprotocolares.buscaubisc3.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc3="+buscaubisc3);
}

	function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigensc3').value = id;
  document.getElementById('ubigensc3').value = name;  

        
    }




function buscaubigeossc4()
{ 	
	var divResultado = document.getElementById('resulubisc4');
	var buscaubisc4  = document.frmprotocolares.buscaubisc4.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc4="+buscaubisc4);
}

function buscaubigeossc6()
{ 	
	var divResultado = document.getElementById('resulubisc6');
	var buscaubisc6  = document.frmprotocolares.buscaubisc6.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc6="+buscaubisc6);
}

function buscaprofesiones()
{ 	
	var divResultado = document.getElementById('resulprofesiones');
	var buscaprofes  = document.frmprotocolares.buscaprofes.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes);
}

function buscaubigeossc7()
{ 	
	var divResultado = document.getElementById('resulubisc7');
	var buscaubisc7  = document.frmprotocolares.buscaubisc7.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc7.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc7="+buscaubisc7);
}

function buscaprofesiones()
{ 	
	var divResultado = document.getElementById('resulprofesiones');
	var buscaprofes  = document.frmprotocolares.buscaprofes.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes);
}

function buscacarguitoss()
{ 	
	var divResultado  = document.getElementById('resulcargito');
	var buscacargooss = document.frmprotocolares.buscacargooss.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss="+buscacargooss);
}

function buscaprofesiones2()
{ 	
	var divResultado = document.getElementById('resulprofesiones2');
	var buscaprofes2 = document.frmprotocolares.buscaprofes2.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes2="+buscaprofes2);
}


function buscacarguitoss2()
{ 	
	var divResultado   = document.getElementById('resulcargito2');
	var buscacargooss2 = document.frmprotocolares.buscacargooss2.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss2="+buscacargooss2);
}

function buscaprofesiones3()
{ 	
	var divResultado = document.getElementById('resulprofesiones3');
	var buscaprofes3 = document.frmprotocolares.buscaprofes3.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes3="+buscaprofes3);
}


function buscacarguitoss3()
{ 	
	var divResultado   = document.getElementById('resulcargito3');
	var buscacargooss3 = document.frmprotocolares.buscacargooss3.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss3="+buscacargooss3);
}

function buscaprofesiones4()
{ 	
	var divResultado = document.getElementById('resulprofesiones4');
	var buscaprofes4 = document.frmprotocolares.buscaprofes4.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes4="+buscaprofes4);
}

function buscacarguitoss4()
{ 	
	var divResultado   = document.getElementById('resulcargito4');
	var buscacargooss4 = document.frmprotocolares.buscacargooss4.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss4="+buscacargooss4);
}

function buscaprofesiones6()
{ 	
	var divResultado = document.getElementById('resulprofesiones6');
	var buscaprofes6 = document.frmprotocolares.buscaprofes6.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes6="+buscaprofes6);
}


function buscacarguitoss6()
{ 	
	var divResultado   = document.getElementById('resulcargito6');
	var buscacargooss6 = document.frmprotocolares.buscacargooss6.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos6.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss6="+buscacargooss6);
}

function buscaprofesiones7()
{ 	
	var divResultado = document.getElementById('resulprofesiones7');
	var buscaprofes7 = document.frmprotocolares.buscaprofes7.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnes7.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes7="+buscaprofes7);
}


function buscacarguitoss7()
{ 	
	var divResultado   = document.getElementById('resulcargito7');
	var buscacargooss7 = document.frmprotocolares.buscacargooss7.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargos7.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargooss7="+buscacargooss7);
}

function verificarfirmas()
{ 	
	var divResultado = document.getElementById('verifyfirma');
	var codkardex    = document.frmprotocolares.codkardex.value;
	var fecfirmaa    = document.frmprotocolares.fecfirmaa.value;	
	
	ajax=objetoAjax();
	ajax.open("POST","conclusionfirma.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fecfirmaa="+fecfirmaa);
}


function mostrarumbral()
{ 	
	var divResultado   = document.getElementById('cumbral');
	var idttiippooacto = document.getElementById('idttiippooacto').value;
	var codkardex      = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","showumbral.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idttiippooacto="+idttiippooacto+"&codkardex="+codkardex);
}

function grabarnewmov()
{	
	var divResultado = document.getElementById('vermovi');
	var codkardex    = document.frmprotocolares.codkardex.value;
	var fechamov     = document.frmprotocolares.fechamov.value;
	var vencimiento  = document.frmprotocolares.vencimiento.value;
	var idsedereg    = document.frmprotocolares.idsedereg.value;
	var idsecreg     = document.frmprotocolares.idsecreg.value;
	var titulorp     = document.frmprotocolares.titulorp.value;
	var idtiptraoges = document.frmprotocolares.idtiptraoges.value;
	var idestreg     = document.frmprotocolares.idestreg.value;
	var importee     = document.frmprotocolares.importee.value;
	var codusuario   = document.frmprotocolares.codusuario.value;
	var anotacion    = document.frmprotocolares.anotacion.value;
	var codmovreg    = document.frmprotocolares.codmovreg.value;

	//var numeroo      = document.frmprotocolares.numeroo.value;
	///var mayorderecho = document.frmprotocolares.mayorderecho.value;

	var numeroo      = '';
	var mayorderecho = '';

	var observa      = document.frmprotocolares.observa.value;
	var conestado    = document.frmprotocolares.conestado.value;

	var registrador  = document.frmprotocolares.registrador.value;
	//alert(document.frmprotocolares.numeroTitulo.value);
	var numeroPartida = document.frmprotocolares.numeroPartida.value;

	var asiento = document.frmprotocolares.asiento.value;
	var recibo = document.frmprotocolares.recibo.value;
	var fechaInscripcion = document.frmprotocolares.fechaInscripcion.value;



	
	ajax=objetoAjax();
	ajax.open("POST","grabar_movimiento.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			 mostrarnewreg();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fechamov="+fechamov+"&vencimiento="+vencimiento+"&idsedereg="+idsedereg+
		"&idsecreg="+idsecreg+"&titulorp="+titulorp+"&idtiptraoges="+idtiptraoges+"&idestreg="+idestreg+"&importee="+
		importee+"&codusuario="+codusuario+"&anotacion="+anotacion+"&codmovreg="+codmovreg+"&mayorderecho="+mayorderecho+
		"&numeroo="+numeroo+"&observa="+observa+"&conestado="+conestado+"&registrador="+registrador+"&numeroPartida="+numeroPartida+
		"&asiento="+asiento+"&recibo="+recibo+"&fechaInscripcion="+fechaInscripcion)
	
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
function editarmovreg()
{
	//divResultado = document.getElementById('rctmmmm');
	
	var itemcodmovreg = document.frmprotocolares.itemcodmovreg.value;


	var codkardex    = document.frmprotocolares.codkardex.value;
	var fechamov     = document.frmprotocolares.fechamov.value;
	var vencimiento  = document.frmprotocolares.vencimiento.value;
	var idsedereg    = document.frmprotocolares.idsedereg.value;
	var idsecreg     = document.frmprotocolares.idsecreg.value;
	var titulorp     = document.frmprotocolares.titulorp.value;
	var idtiptraoges = document.frmprotocolares.idtiptraoges.value;
	var idestreg     = document.frmprotocolares.idestreg.value;
	var importee     = document.frmprotocolares.importee.value;
	var codusuario   = document.frmprotocolares.codusuario.value;
	var anotacion    = document.frmprotocolares.anotacion.value;
	var codmovreg    = document.frmprotocolares.codmovreg.value;

	//var numeroo      = document.frmprotocolares.numeroo.value;
	///var mayorderecho = document.frmprotocolares.mayorderecho.value;

	var numeroo      = '';
	var mayorderecho = '';

	var observa      = document.frmprotocolares.observa.value;
	var conestado    = document.frmprotocolares.conestado.value;

	var registrador  = document.frmprotocolares.registrador.value;
	//alert(document.frmprotocolares.numeroTitulo.value);
	var numeroPartida = document.frmprotocolares.numeroPartida.value;

	var asiento = document.frmprotocolares.asiento.value;
	var recibo = document.frmprotocolares.recibo.value;
	var fechaInscripcion = document.frmprotocolares.fechaInscripcion.value;



	
	ajax=objetoAjax();
	ajax.open("POST","editar_movimiento.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//divResultado.innerHTML = ajax.responseText;
			mostrarnewreg();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&fechamov2="+fechamov+"&vencimiento2="+vencimiento+"&idsedereg2="+idsedereg+
		"&idsecreg2="+idsecreg+"&titulorp2="+titulorp+"&idtiptraoges2="+idtiptraoges+"&idestreg2="+
		idestreg+"&importee2="+importee+"&codusuario2="+codusuario+"&anotacion2="+anotacion+"&codmovreg="+
		codmovreg+"&numeroo2="+numeroo+"&observa2="+observa+"&conestado2="+conestado+
		"&registrador="+registrador+"&numeroPartida="+numeroPartida+
		"&asiento="+asiento+"&recibo="+recibo+"&fechaInscripcion="+fechaInscripcion+

		"&itemcodmovreg="+itemcodmovreg)
	
}

////////////////////////////////////////////////
function mostrarnewreg()
{   
	var divResultadoo = document.getElementById('vermovi');
	divResultadoo.innerHTML= '<img src="loading.gif">';
	
	var codkardex     = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();
	ajax.open("POST","vergrillamovimiento.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultadoo.innerHTML = ajax.responseText;
			FShowPagos_Kardex_result_2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}

function grabarcontratantes()
{
	var divResultado = document.getElementById('busclie');

	var idtipkar     = document.getElementById('idtipkar').value;  
	var codkardex    = document.getElementById('codkardex').value;  
	var codclie      = document.getElementById('codclie').value;  
	var repre        = document.getElementById('repre').value;  
	var codcon       = document.getElementById('codcon').value;  
	var indice       = document.getElementById('indice').value;  
	var firma        = document.getElementById('firma').value;  
	var representaa  = document.getElementById('representaa').value;  
	var facultades   = document.getElementById('facultades').value;  
	var inscrito     = document.getElementById('inscrito').value; 
	var idsederegerp   = document.getElementById('idsederegerp').value;  
	var nparti     = document.getElementById('nparti').value; 

	ajax=objetoAjax();

	ajax.open("POST","grabar_contratantes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			console.log(ajax.responseText)
			divResultado.innerHTML = ajax.responseText;
			mostrarcontratante();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idtipkar="+idtipkar+"&codkardex="+codkardex+"&codclie="+codclie+"&repre="+repre+"&codcon="+codcon+"&indice="+indice+"&firma="+firma+"&representaa="+representaa+"&facultades="+facultades+"&inscrito="+inscrito+"&idsederegerp="+idsederegerp+"&nparti="+nparti);
}

////////////////////////////////////////////////////
var gCount = 0;
countImageReniec = 1;
var html = '';
function buscaclientes()
{
	validaDNIRUC();
	var divResultado = document.getElementById('busclie');	
	var tipodoc = $('#tipodoc').val();
	
	// var consultReniecSunat =  0;
	// var vtipdoc = $('#tipodoc').val();
	
	// if( vtipdoc == 1 || vtipdoc == 8){
	// 	consultReniecSunat = 1;
	// }else{
	// 	consultReniecSunat = 0;
	// }

	if(tipodoc=='8' || tipodoc=='10'){		
		var tipoper = "J";		
	}else{
		var tipoper = "N";		
	}
	
	var numdoc  = document.frmprotocolares.numdoc.value;
	// vimageCaptcha  = $('#txtImageCaptcha').val();
	
	
	jQuery.ajax({
		url:'buscacliedniruc.php',
		type:'POST',
		dataType:'html',
		data:{tipoper:tipoper,tipodoc:tipodoc,numdoc:numdoc},
		// data:{tipoper:tipoper,tipodoc:tipodoc,numdoc:numdoc,image:vimageCaptcha,consult_sunat_reniec:consultReniecSunat},
		success:function(response){
			// html = '';
			

			// if(response == '1'){

			// 	$('#txtImageCaptcha').show();
			// 	$('#imgCaptchaReniec').show();

			// 	$('#imgCaptchaReniec').attr('src','reniec_sunat/generate_captcha_reniec.php?count='+countImageReniec);

			// 	$('#imgCaptchaSunat').hide();

			// 	$('#txtImageCaptcha').focus();
				
			// 	html = html + '<div id="error-message" style="color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">';
			// 	html  = html + 'El dni '+$('#numdoc').val()+' no existe en la base de datos del SISNOT, ingrese el codigo de la imagen para consultar en  RENIEC</div>';
			// 	divResultado.innerHTML = html;
			// 	countImageReniec = countImageReniec +1;

			// } else if(response == '2'){
			// 	$('#txtImageCaptcha').show();
			// 	$('#imgCaptchaSunat').show();
			// 	$('#imgCaptchaSunat').attr('src','reniec_sunat/generate_captcha_sunat.php');
			// 	$('#imgCaptchaReniec').hide()
			// 	$('#txtImageCaptcha').focus();
			// 	html = html + '<div id="error-message" style="color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">';
			// 	html  = html + 'El ruc '+$('#numdoc').val()+' no existe en la base de datos del SISNOT, ingrese el codigo de la imagen para consultar en  Sunat</div>';
			// 	divResultado.innerHTML = html;
			// }
			// else{
				
			// 	//$('#txtImageCaptcha').hide();
			// 	//$('#imgCaptchaReniec').hide();
			// 	divResultado.innerHTML = response;
			// 	if(tipoper == 'J'){
			// 		$('#txtImageCaptcha').val('');	
			//  		$('#imgCaptchaSunat').attr('src','reniec_sunat/generate_captcha_sunat.php?nmagic='+gCount);
			//  		gCount = gCount + 1;
		    // 	}
			// 	console.log('ok')
			// }

			divResultado.innerHTML = response;
			console.log('ok')



			if(document.getElementById('idsedereg3')){ $("#idsedereg3").val("09"); }
			if(document.getElementById('cumpclie')){
				$("#cumpclie").mask("99/99/9999",{placeholder:"_"});
			}
		}
	});

}

////////////////////////
function mostrarcontratante()
{ 
	var divResultado = document.getElementById('contratantes');
	divResultado.innerHTML= '<img src="loading.gif">';

	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();

	ajax.open("POST","mostrar_contratantes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			mostrarcontratante2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}

//////////////////
function mostrarcontratante2()
{ 
	var divResultado = document.getElementById('verifyfirma');
	var codkardex    = document.frmprotocolares.codkardex.value;
	
	ajax=objetoAjax();

	ajax.open("POST","grabar_firma_contratante2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex);
}
/////////////////////////////////////

function cambiatipdoc(_id)
{ 
	var divResultado = document.getElementById('tipodocuR');
	var _id          = document.frmprotocolares.tipodoc.value;

	ajax=objetoAjax();

	ajax.open("POST","combodocu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id="+_id);
}

// EDITAR  MEDIO DE PAGO
function vermediopagoe()
{
	var divResultado = document.getElementById('vermediopagoedit');
	var detmp        = document.getElementById('detmp').value; // hidden
	
	ajax=objetoAjax();
	ajax.open("POST","mostrar_mpagoedit.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("detmp="+detmp);
} 


//GRABAR LA EDICION DEL MEDIO DE PAGO
function actmediopago()
{

	var divResultado      = document.getElementById('tredfdfdf');
	var codkardex         = document.getElementById('codkardex').value;
	var mediopago         = document.getElementById('mediopago').value;
	var entidadfinanciera = document.getElementById('entidadfinanciera').value;
	var impmediopago      = document.getElementById('impmediopago').value;
	var fechaoperacion    = document.getElementById('fechaoperacion').value;
	var documentos 		  = document.getElementById('documentos').value;
	var itemmpp 		  = document.getElementById('itemmpp').value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_editpago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&codkardex="+codkardex+"&mediopago="+mediopago+"&entidadfinanciera="+entidadfinanciera+"&impmediopago="+impmediopago+"&fechaoperacion="+fechaoperacion+"&documentos="+documentos+"&itemmpp="+itemmpp);
}


function recalcularasignass(){
	
	var divResultado = document.getElementById('hjpt');
	var codkardex    = document.getElementById('codkardex').value;
	var xasignaitem  = document.getElementById('xasignaitem').value;
	var xasignacondi = document.getElementById('xasignacondi').value;
	var xasignavalor = document.getElementById('xasignavalor').value;
	var xasignaid    = document.getElementById('xasignaid').value;

	ajax=objetoAjax();
	ajax.open("POST","recalcularasigna.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&xasignaitem="+xasignaitem+"&xasignacondi="+xasignacondi+"&xasignavalor="+xasignavalor+"&xasignaid="+xasignaid);
	}


/////////////////////////////////////////////////grabar en ajax original///////////////////////////////////
function buscaclientescnt()
{
	var divResultado = document.getElementById('nuevaconyugecnt');
	var numdoccnt    = document.getElementById('numdoccnt').value; // .frmprotocolares.numdoccnt.value;

	ajax=objetoAjax();
	ajax.open("POST","buscadnicnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoccnt="+numdoccnt);
}

function buscacarguitosscnt()
{ 	
	var divResultado     = document.getElementById('resulcargitocnt');
	var buscacargoosscnt = document.frmprotocolares.buscacargoosscnt.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscacargoscnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscacargoosscnt="+buscacargoosscnt);
}

function buscaprofesionescnt()
{ 	
	var divResultado   = document.getElementById('resulprofesionescnt');
	var buscaprofescnt = document.frmprotocolares.buscaprofescnt.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnescnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofescnt="+buscaprofescnt);
}


function buscaubigeossccnt()
{ 	
	var divResultado  = document.getElementById('resulubisccnt');
	var buscaubisccnt = document.frmprotocolares.buscaubisccnt.value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosccnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisccnt="+buscaubisccnt);
}


function grabarcliente6mm()
{
	var divResultado    = document.getElementById('ccconyugecnt');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var numdoc6			= document.frmprotocolares.numdoc6.value;
	var apepat6			= document.frmprotocolares.apepat6.value;
	var apemat6			= document.frmprotocolares.apemat6.value;
	var prinom6			= document.frmprotocolares.prinom6.value;
	var segnom6			= document.frmprotocolares.segnom6.value;
	var direccion6		= document.frmprotocolares.direccion6.value;
	var email6			= document.frmprotocolares.email6.value;
	var telfijo6		= document.frmprotocolares.telfijo6.value;
	var telcel6			= document.frmprotocolares.telcel6.value;
	var telofi6			= document.frmprotocolares.telofi6.value;
	var sexo6			= document.frmprotocolares.sexo6.value;
	var idestcivil6		= document.frmprotocolares.idestcivil6.value;
	var nacionalidad6	= document.frmprotocolares.nacionalidad6.value;
	var idprofesion6	= document.frmprotocolares.idprofesion6.value;
	var idcargoo6		= document.frmprotocolares.idcargoo6.value;
	var cumpclie6		= document.frmprotocolares.cumpclie6.value;
	var natper6			= document.frmprotocolares.natper6.value;
	var codubisc6		= document.frmprotocolares.codubisc6.value;
	var nomprofesiones6 = document.frmprotocolares.nomprofesiones6.value;
	var nomcargoss6		= document.frmprotocolares.nomcargoss6.value;
	var ubigensc6		= document.frmprotocolares.ubigensc6.value;
	var residente6		= document.frmprotocolares.residente6.value;
	var docpaisemi6		= document.frmprotocolares.docpaisemi6.value;
	var codclie6		= document.frmprotocolares.codclie6.value;	
	var codclie6n		= document.frmprotocolares.codclie6n.value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_cliente6mm.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numdoc6="+numdoc6+"&apepat6="+apepat6+"&apemat6="+apemat6+"&prinom6="+prinom6+"&segnom6="+segnom6+"&direccion6="+direccion6+"&email6="+email6+"&telfijo6="+telfijo6+"&telcel6="+telcel6+"&telofi6="+telofi6+"&sexo6="+sexo6+"&idestcivil6="+idestcivil6+"&nacionalidad6="+nacionalidad6+"&idprofesio6n="+idprofesion6+"&idcargoo6="+idcargoo6+"&cumpclie6="+cumpclie6+"&natper6="+natper6+"&codubisc6="+codubisc6+"&nomprofesiones6="+nomprofesiones6+"&nomcargoss6="+nomcargoss6+"&ubigensc6="+ubigensc6+"&residente6="+residente6+"&docpaisemi6="+docpaisemi6+"&codclie6="+codclie6+"&codclie6n="+codclie6n);
}


function verclientee2()
{
	var divResultado  = document.getElementById('verclienterctm2');
	var coddcontrata2 = document.frmprotocolares.coddcontrata2.value;
	ajax=objetoAjax();
	
	ajax.open("POST","mostrar_clienteeditable2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('cumpclie3')){$("#cumpclie3").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("coddcontrata2="+coddcontrata2);
	
}  

function verclientee3()
{
	var divResultado  = document.getElementById('verclienterctm2');
	var coddcontrata2 = document.frmprotocolares.coddcontrata2.value;

	ajax=objetoAjax();

	ajax.open("POST","mostrar_clienteeditable3.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("coddcontrata2="+coddcontrata2);
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////

function eliminarformuuu()
{
	var melixx = document.frmprotocolares.melixx.value;

	ajax=objetoAjax();
	ajax.open("POST","elimi_foprmu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			listaformu();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("melixx="+melixx);
}

/////////////////////////////////////////////////////////////////////////////////////////	
function actualizarsospesi(){
	
	var codkardex = document.frmprotocolares.codkardex.value;
	var si        = "si";
	
	ajax=objetoAjax();
	ajax.open("POST","grabar_sospesi.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("si="+si+"&codkardex="+codkardex);
}


function actualizarsospeno(){
	
	var codkardex = document.frmprotocolares.codkardex.value;
	var no        = "no";

	ajax=objetoAjax();
	ajax.open("POST","grabar_sospeno.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("no="+no+"&codkardex="+codkardex);
}
	
function actualizarinusi(){
	
	var codkardex = document.frmprotocolares.codkardex.value;
	var si        = "si";

	ajax=objetoAjax();
	ajax.open("POST","grabar_inusi.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax.send("si="+si+"&codkardex="+codkardex);
}

function actualizarinuno(){
	
	var codkardex = document.frmprotocolares.codkardex.value;
	var no        = "no";

	ajax=objetoAjax();
	ajax.open("POST","grabar_inuno.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("no="+no+"&codkardex="+codkardex);
}
//////////////////////////////////aqui ultimas funciones//////////////////////////////////////////
	
function verificarinscrito(){
	var divResultado = document.getElementById('inscri');
	var codcon       = document.frmprotocolares.codcon.value;

	ajax=objetoAjax();
	ajax.open("POST","mostrarinscrito.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codcon="+codcon);
}
	
// ###########	BUSQUEDAS EXTRAPROTOCOLARES

/////// PERMISO VIAJE
function buscaPERMIVIAJE()
{
	
	var divResultado    = document.getElementById('bkardex');
	var _numformu       = document.getElementById('numformu').value; 
	var _participante   = document.getElementById('participante').value;
	var _rango1 		= document.getElementById('rango1').value;
	var _rango2 		= document.getElementById('rango2').value;
	var _tippersona		= document.getElementById('tippersona').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaPERMIVIAJE.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+_numformu+"&participante="+_participante+
				"&rangouno="+_rango1+"&rangodos="+_rango2+"&tippersona="+_tippersona);
}
	
////// PODERES	
function buscaPODERES()
{
	
	var divResultado  = document.getElementById('bkardex');
	var _numformu     = document.getElementById('numformu').value ;
	
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaPODERES.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+_numformu);
}	

	
function buscaPODERES2()
{
	
	var divResultado  = document.getElementById('bkardex');
	var _nomc 		  = document.getElementById('nomc').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaPODERES2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nomc="+_nomc);
}		

////////////////// PERSONA CAPAZ
function buscaPCAPAZ()
{
	var divResultado  = document.getElementById('bkardex');
	var _numformu     = document.getElementById('numformu').value ;
	var _pcapaz 	  = document.getElementById('pcapaz').value;
	var _direccionca  = document.getElementById('direccionca').value;
	var _rangoca1	  = document.getElementById('rangoca1').value;
	var _rangoca2 	  = document.getElementById('rangoca2').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaPCAPAZ.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+_numformu+"&pcapaz="+_pcapaz+"&direccionca="+_direccionca+"&rangoca1="+_rangoca1+"&rangoca2="+_rangoca2);
}	
	
/////////////// PERSONA INCAPAZ
function buscaPINCAPAZ()
{
	var divResultado  = document.getElementById('bkardex');
	var _numformu     = document.getElementById('numformu').value; 
	var _pincapaz 	  = document.getElementById('pincapaz').value;
	
	var _direccionin  = document.getElementById('direccionin').value;
	var _rangoin1	  = document.getElementById('rangoin1').value;
	var _rangoin2	  = document.getElementById('rangoin2').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaINPCAPAZ.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+_numformu+"&pincapaz="+_pincapaz+"&direccionin="+_direccionin+"&rangoin1="+_rangoin1+"&rangoin2="+_rangoin2);
}

////////////////////// CERTIFICADO DOMIDILIARIO
function buscaCERTDOMI()
{
	var divResultado  = document.getElementById('bkardex');
	var _numformu     = document.getElementById('numformu').value;
	var _solicitanted = document.getElementById('solicitanted').value;
	
	var _rangopc1	  = document.getElementById('rangopc1').value;
	var _rangopc2	  = document.getElementById('rangopc2').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaCERTDOMI.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+_numformu+"&solicitanted="+_solicitanted+"&rangopc1="+_rangopc1+"&rangopc2="+_rangopc2);
}

///////////////// CAMBIO DE CARACTERRIRTICAS
function buscaCAMBCARAC()
{
	var divResultado  = document.getElementById('bkardex');
	var _numformu     = document.getElementById('numformu').value ;
	var _solicitantec = document.getElementById('solicitantec').value;
	
	var _rangocc1	  = document.getElementById('rangocc1').value;
	var _rangocc2	  = document.getElementById('rangocc2').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaCAMBCARAC.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("numformu="+_numformu+"&solicitantec="+_solicitantec+"&rangocc1="+_rangocc1+"&rangocc2="+_rangocc2);
}


function buscaSERVICIO()
{
	var divResultado  = document.getElementById('bkardex');
	var _descri       = document.getElementById('descri').value; 	
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaSERVICIO.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("descri="+_descri);
}
	 
	 
function buscafechapermi()
{

	var divResultado  = document.getElementById('bkardex');
	var _rango1       = document.getElementById('rango1').value; 	
	var _rango2       = document.getElementById('rango2').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaFECHAPERMI.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("rangouno="+_rango1+"&rangodos="+_rango2);
}

function buscafechapoderes()
{

	var divResultado  = document.getElementById('bkardex');
	var _rangop1      = document.getElementById('rangop1').value; 	
	var _rangop2      = document.getElementById('rangop2').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaFECHAPODER.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("rangopuno="+_rangop1+"&rangopdos="+_rangop2);
}
	 
function buscafechacarta()
{
	var divResultado  = document.getElementById('bkardex');
	var _rangoc1      = document.getElementById('rangoc1').value; 	
	var _rangoc2      = document.getElementById('rangoc2').value;
	
	divResultado.innerHTML= '<img src="../../loading.gif">';
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscaFECHACARTA.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("rangocuno="+_rangoc1+"&rangocdos="+_rangoc2);
}
	 
// **************************************************************************************************************************************
// **************************************************************************************************************************************
// *****************************************  INICIO DE FUNCIONES DE PROTESTOS  *********************************************************

function fSaveIngProtestos()
{	
   
    var divResultado    = document.getElementById('confirmaGuarda');
	divResultado.innerHTML = '<center><img src="loading.gif"></center>';
	
	var divResultado2   = document.getElementById('resul_protesto');
	
	var _id_prote       = document.getElementById('id_prote').value;
	var _num_prote  	= document.getElementById('num_prote').value;
	var _num_prote  	= document.getElementById('num_prote').value;
	var _solicitante 	= document.getElementById('solicitante').value;
	var _nom_recep      = document.getElementById('nom_recep').value;
	var	_hora_recep		= document.getElementById('hora_recep').value;
	var _cod_tipop		= document.getElementById('cod_tipop').value;
	var _fec_ingreso	= document.getElementById('fec_ingreso').value;
	var _numero		 	= document.getElementById('numero').value;
	var _lugarg			= document.getElementById('lugarg').value;
	var _referenciap	= document.getElementById('referenciap').value;
	var _fecgiro	 	= document.getElementById('fecgiro').value;
	var _fecvence		= document.getElementById('fecvence').value;
	var _idmon			= document.getElementById('idmon').value;
	var _importe		= document.getElementById('importe').value;
	var _diligencia		= document.getElementById('diligencia').value;
	var _fecnoti		= document.getElementById('fecnoti').value;
	var _fecconst		= document.getElementById('fecconst').value;
	var _text_check		= document.getElementById('text_check').value;
	var _des_respon		= document.getElementById('des_respon').value;
			
	ajax=objetoAjax();
	ajax.open("POST", "guardaProtestos.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Guardado satisfactoriamente</center></div>";
			divResultado2.innerHTML = ajax.responseText;
			document.getElementById('btn_poderes').style.display="";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("num_prote="+_num_prote+"&solicitante="+_solicitante+"&nom_recep="+_nom_recep+"&hora_recep="+_hora_recep+"&cod_tipop="+_cod_tipop+"&fec_ingreso="+_fec_ingreso+
	"&numero="+_numero+"&lugarg="+_lugarg+"&referenciap="+_referenciap+"&fecgiro="+_fecgiro+"&fecvence="+_fecvence+"&idmon="+_idmon+
	"&importe="+_importe+"&diligencia="+_diligencia+"&fecnoti="+_fecnoti+"&fecconst="+_fecconst+"&des_respon="+_des_respon+"&text_check="+_text_check+"&id_prote="+_id_prote);
}


function buscarclienteprotesto()
{
	var divResultado = document.getElementById('datos');
	var _tipoper     = document.getElementById('tipoper').value;
	var _numdoc      = document.getElementById('numdoc').value ;
	var _tip_poder   = document.getElementById('id_tippoder').value ;
	
	ajax=objetoAjax();
	ajax.open("POST","buscaclienteprotesto.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoper="+_tipoper+"&numdoc="+_numdoc+"&tip_poder="+_tip_poder);	
}


function buscaubigeosscprotestos()
{ 	
	var divResultado = document.getElementById('resulubisc');
	var buscaubisc   = document.getElementById('_buscaubisc').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosclib1.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc);
}

function grabarclienteprotesto()
{
	var divResultado   = document.getElementById('datos');
	var tipoper   	   = document.getElementById('tipoper').value;
	var numdoc    	   = document.getElementById('numdoc').value;
	var apepat		   = document.getElementById('apepat').value;
	var apemat		   = document.getElementById('apemat').value;
	var prinom		   = document.getElementById('prinom').value;
	var segnom		   = document.getElementById('segnom').value;
	var direccion	   = document.getElementById('direccion').value;
	var email		   = document.getElementById('email').value;
	var telfijo		   = document.getElementById('telfijo').value;
	var telcel		   = document.getElementById('telcel').value;
	var telofi	       = document.getElementById('telofi').value;
	var sexo		   = document.getElementById('sexo').value;
	var idestcivil	   = document.getElementById('idestcivil').value;
	var nacionalidad   = document.getElementById('nacionalidad').value;
	var idprofesion	   = document.getElementById('idprofesion').value;
	var idcargoo	   = document.getElementById('idcargoo').value;
	var cumpclie	   = document.getElementById('cumpclie').value;
	var natper		   = document.getElementById('natper').value;
	var codubisc	   = document.getElementById('codubisc').value;
	var nomprofesiones = document.getElementById('nomprofesiones').value;
	var nomcargoss	   = document.getElementById('nomcargoss').value;
	var ubigensc	   = document.getElementById('ubigensc').value;
	var residente	   = document.getElementById('residente').value;
	var docpaisemi	   = document.getElementById('docpaisemi').value;
	var cconyuge 	   = document.getElementById('cconyuge').value;

	ajax=objetoAjax();
	ajax.open("POST","grabar_clienteprotesto.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi+"&cconyuge="+cconyuge);
}


function fAddCondiciones3()
{	
	var _id_prote       = document.getElementById('id_prote').value;
	var _c_codcontrat   = document.getElementById('docum').value;
	var _direccion		= document.getElementById('direc').value;
		var _fec_ingreso		= document.getElementById('fec_ingreso').value;
	if(document.getElementById('napepat1'))
				{
					var _c_descontrat   = document.getElementById('apepat1').value+' '+document.getElementById('apemat1').value+', '+document.getElementById('prinom1').value;
				}
				else {
					var _c_descontrat   = document.getElementById('apepat2').value+' '+document.getElementById('napemat22').value+', '+document.getElementById('prinom2').value;
					}
	

	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "guardaProtestoParti.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderes2();	
			$('#div_newcontra').dialog("destroy").remove();	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_prote+"&c_codcontrat="+_c_codcontrat+"&direccion="+_direccion+"&c_descontrat="+_c_descontrat+"&c_condicontrat="+_c_condicontrat+"&fec_ingreso="+_fec_ingreso);
}


function mostrarlistPoderes2()
{
	var divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var _id_poder    = document.getElementById('id_protesto').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
 	
	ajax=objetoAjax();
	ajax.open("POST","ProtestosParticipantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&fec_ingreso="+_fec_ingreso)
}


function fAddCondiciones4()
{	
	var _id_prote       = document.getElementById('id_protesto').value;
	var _c_codcontrat   = document.getElementById('docum').value;
	var _direccion		= document.getElementById('direc').value;
	var _fec_ingreso	= document.getElementById('fec_ingreso').value;
	if(document.getElementById('napepat1'))
				{
					var _c_descontrat   = document.getElementById('apepat1').value+' '+document.getElementById('apemat1').value+' '+document.getElementById('prinom1').value;
				}
				else {
					var _c_descontrat   = document.getElementById('apepat2').value+' '+document.getElementById('napemat22').value+' '+document.getElementById('prinom2').value;
					}
	
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	
	ajax=objetoAjax();
	ajax.open("POST", "guardaProtestoParti2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderes3();	
			$('#div_newcontra').dialog("destroy").remove();			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_prote+"&c_codcontrat="+_c_codcontrat+"&direccion="+_direccion+"&c_descontrat="+_c_descontrat+"&c_condicontrat="+_c_condicontrat+"&fec_ingreso="+_fec_ingreso);
}


function mostrarlistPoderes3()
{
	var divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var _id_poder = document.getElementById('id_protesto').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	ajax=objetoAjax();
	
	ajax.open("POST","ProtestosParticipantes2.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&fec_ingreso="+_fec_ingreso)
}

// EDITA PARTICIPANTE DEL PROTESTO
	function EditPartiP(_id_poder, _id_contrata)
	{

		$('<div id="div_editcontra" title="div_editcontra"></div>').load('EditParticipantesp.php?id_poder='+_id_poder+'&id_contrata='+_id_contrata)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 500,
						height  : 200,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {evaleditParticipante();$(this).dialog("destroy").remove(); }},
								  
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Editar Contratantes'
						
						}).width(500).height(200);	
						$(".ui-dialog-titlebar").hide();
	}
	
function felimContratante(_id_poder, _id_contrata, _anio)
{
	var _id_poder	 = _id_poder;
	var _id_contrata = _id_contrata;
		var _anio = _anio;

	ajax=objetoAjax();
	ajax.open("POST", "elimparticipantep.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se elimino satisfactoriamente');	
			mostrarlistPContratantesElim();		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&id_contrata="+_id_contrata+"&anio="+_anio);	
}

function felimContratante2(_id_poder, _id_contrata,_anio)
{
	var _id_poder	 = _id_poder;
	var _id_contrata = _id_contrata;
		var _anio = _anio;

	ajax=objetoAjax();
	ajax.open("POST", "elimparticipantep2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se elimino satisfactoriamente');	
			mostrarlistPContratantesElim2();		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&id_contrata="+_id_contrata+"&anio="+_anio);	

}
function mostrarlistPContratantesElim2()
{
	var divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var _id_poder    = document.getElementById('id_poder').value;
		var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();
	ajax.open("POST","ProtestosParticipantes2.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&fec_ingreso="+_fec_ingreso)
}

function mostrarlistPContratantesElim()
{
	var divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var _id_poder    = document.getElementById('id_prote').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();
	ajax.open("POST","ProtestosParticipantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&fec_ingreso="+_fec_ingreso)
}
function fEditContratantesPoder2()
{
	var _id_poder       = document.getElementById('id_poder').value;
	var _id_contrata    = document.getElementById('id_contrata').value;
	var _c_codcontrat   = document.getElementById('c_codcontrat').value;
	var _c_descontrat   = document.getElementById('nc_descontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();
	ajax.open("POST", "EdiProtestoParti.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderesEdit2();					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_condicontrat="+_c_condicontrat+"&id_contrata="+_id_contrata+"&fec_ingreso="+_fec_ingreso);

}

function fEditContratantesPoder()
{	
	var _id_poder       = document.getElementById('id_poder').value;
	var _id_contrata    = document.getElementById('id_contrata').value;
	var _c_codcontrat   = document.getElementById('c_codcontrat').value;

	var _c_descontrat   = document.getElementById('nc_descontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();
	ajax.open("POST", "EdiProtestoParti.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderesEdit();					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_condicontrat="+_c_condicontrat+"&id_contrata="+_id_contrata+"&fec_ingreso="+_fec_ingreso);

}

function mostrarlistPoderesEdit()
{	
	var divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var _id_poder    = document.getElementById('id_prote').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();
	ajax.open("POST","ProtestosParticipantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			fcerrardivedicion4();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&fec_ingreso="+_fec_ingreso)
}
function mostrarlistPoderesEdit2()
{
	var divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var _id_poder    = document.getElementById('id_poder').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();
	ajax.open("POST","ProtestosParticipantes2.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			fcerrardivedicion4();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&fec_ingreso="+_fec_ingreso)
}


// GUARDA DATOS EDITADOS DE INGRESO DE PODERES - CABECERA.
function fEditIngProtesto()
{	

	var divResultado    = document.getElementById('confirmaGuarda');
	divResultado.innerHTML = '<center><img src="loading.gif"></center>';
	
	var _id_prote       = document.getElementById('id_poder').value;
	
	var _num_prote  	= document.getElementById('id_prote').value;
	var _nom_recep      = document.getElementById('nom_recep').value;
	var _solicitante 	= document.getElementById('solicitante').value;
	var	_hora_recep		= document.getElementById('hora_recep').value;
	var _cod_tipop		= document.getElementById('cod_tipop').value;
	var _fec_ingreso	= document.getElementById('fec_ingreso').value;
	var _numero		 	= document.getElementById('numero').value;
	var _lugarg			= document.getElementById('lugarg').value;
	var _referenciap	= document.getElementById('referenciap').value;
	var _fecgiro	 	= document.getElementById('fecgiro').value;
	var _fecvence		= document.getElementById('fecvence').value;
	var _idmon			= document.getElementById('idmon').value;
	var _importe		= document.getElementById('importe').value;
	var _diligencia		= document.getElementById('diligencia').value;
	var _fecnoti		= document.getElementById('fecnoti').value;
	var _fecconst		= document.getElementById('fecconst').value;
	var _text_check		= document.getElementById('text_check').value;
	var _des_respon		= document.getElementById('des_respon').value;
	
	ajax=objetoAjax();
	ajax.open("POST", "EditIngProtestos.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Actualizado satisfactoriamente</center></div>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("num_prote="+_num_prote+"&solicitante="+_solicitante+"&nom_recep="+_nom_recep+"&hora_recep="+_hora_recep+"&cod_tipop="+_cod_tipop+"&fec_ingreso="+_fec_ingreso+
	"&numero="+_numero+"&lugarg="+_lugarg+"&referenciap="+_referenciap+"&fecgiro="+_fecgiro+"&fecvence="+_fecvence+"&idmon="+_idmon+
	"&importe="+_importe+"&diligencia="+_diligencia+"&fecnoti="+_fecnoti+"&fecconst="+_fecconst+"&des_respon="+_des_respon+"&text_check="+_text_check+"&id_prote="+_id_prote);

}
// #============================================================================================================
function fGeneraNumProtesto()
{	

    var divResultado  = document.getElementById('div_numcrono');
	
	var divResultado2 = document.getElementById('div_confirmacion');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';

	var _id_poder     = document.getElementById('id_poderG').value;
	var _fecha_crono  = document.getElementById('fecha_crono').value;

	ajax=objetoAjax();
	ajax.open("POST", "generarIngProtestos.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Generado Satisfactoriamente</center></div>";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecha_crono="+_fecha_crono+"&id_poder="+_id_poder);

}

function fbusdiligencia()
{
	var divResultado = document.getElementById('cartas_ayuda');
	divResultado.innerHTML= '<img src="loading.gif">';
	
	var _dessello    = document.getElementById('dessello').value;
	
	ajax=objetoAjax();
	ajax.open("POST","listdetadilig.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("dessello="+_dessello);
}

function faddCondicionesRUC()
{	
	var _id_poder       = document.getElementById('id_protesto').value;
	
	var _c_codcontrat   = document.getElementById('docum').value;
	var _c_descontrat   = document.getElementById('apepat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	//var _codi_asegurado = document.getElementById('codi_asegurado').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	ajax=objetoAjax();
	ajax.open("POST", "guardaProtestoJ.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderes2();	
			$('#div_newcontra').dialog("destroy").remove();	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_condicontrat="+_c_condicontrat+"&fec_ingreso="+_fec_ingreso);

}
function buscarkardexavanzada(){
	
	var divResultado  = document.getElementById('bkardex');
	
	var idtipkar     = document.getElementById('idtipkar').value;
	var opcionradio  = document.getElementById('opcionradio').value;
    var idusu  = document.getElementById('idusu').value;
	var rangof1  = document.getElementById('rangof1').value;
	var rangof2  = document.getElementById('rangof2').value;
	
	ajax=objetoAjax();
	ajax.open("POST", "busqueda_kardex2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idtipkar="+idtipkar+"&opcionradio="+opcionradio+"&idusu="+idusu+"&rangof1="+rangof1+"&rangof2="+rangof2);
	}
	
function mostrarcombitotipdocu(){
	
	var divResultado  = document.getElementById('cmbshow');
	var tipodedocum = document.getElementById('tipoper').value;
		
	ajax=objetoAjax();
	ajax.open("POST", "combotipodedocu.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipodedocum="+tipodedocum);
	
	}	

function mostrarpermiusux(){
	var divResultado = document.getElementById('permi_x');
	var idusu      = document.getElementById('idusu').value;

	ajax=objetoAjax();
	ajax.open("POST", "ver_permi_usux.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idusu="+idusu)
	}
	
function buscaclientesrctm()
{
	var divResultado = document.getElementById('busclie');
	var nompersona= document.getElementById('buscanombemp').value;
	ajax=objetoAjax();

	ajax.open("POST","buscacliednirucrctm.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('idsedereg3')){ $("#idsedereg3").val("09"); }
			if(document.getElementById('cumpclie')){$("#cumpclie").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nompersona="+nompersona);
}

function mostrarxisclie(id){
	var divResultado = document.getElementById('busclie');
	var codclie= id;
	ajax=objetoAjax();

	ajax.open("POST","buscacliedniruc_seleccion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('idsedereg3')){ $("#idsedereg3").val("09"); }
			if(document.getElementById('cumpclie')){$("#cumpclie").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codclie="+codclie);
	}
	
function buscaclientesrctm2()
{
	var divResultado = document.getElementById('busclie');
	var valor= "cliente";
	ajax=objetoAjax();

	ajax.open("POST","muestra_busqueda_cli.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('idsedereg3')){ $("#idsedereg3").val("09"); }
			if(document.getElementById('cumpclie')){$("#cumpclie").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("valor="+valor);
}

function buscaclientesrctm3()
{
	var divResultado = document.getElementById('busclie');
	var valor= "empresa";
	ajax=objetoAjax();

	ajax.open("POST","muestra_busqueda_cli.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('idsedereg3')){ $("#idsedereg3").val("09"); }
			if(document.getElementById('cumpclie')){$("#cumpclie").mask("99/99/9999",{placeholder:"_"});}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("valor="+valor);
}

function buscaclientespersona()
{
	
	var divResultado = document.getElementById('bkardex');
	var busnombres = document.getElementById('busca_nombre').value;
	var numdoc  = document.getElementById('numdocu').value;
	
	ajax=objetoAjax();

	ajax.open("POST","buscapersona_empresa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("busnombres="+busnombres+"&numdoc="+numdoc);
}


function consultSunarp(){
	placa = $('#numplacav').val();
	jQuery.ajax({
		url:'Sunarp/get_data_vehicle.php',
		dataType:'json',
		type:'POST',
		data:{placa:placa},
		success:function(response){

			if(response.error == 0){
				$('#numseriev').val(response.serialNumber);
				$('#motorv').val(response.engineNumber);
				$('#colorv').val(response.color);
				$('#marcav').val(response.mark);
				$('#modelov').val(response.model);
			}else{
				alert(response.messageDescription);
				$('#numseriev').val('');
				$('#motorv').val('');
				$('#colorv').val('');
				$('#marcav').val('');
				$('#modelov').val('');
			}
		}
	});	
}

function consultar_placa(){
	// placa = $('#numplacav').val();
	if(document.getElementById('numplacav')){

		placa = $('#numplacav').val();
	}
	if(document.getElementById('numplacav2')){

		placa = $('#numplacav2').val();
	}
	jQuery.ajax({
		url:'models/get_vehiculo.php',
		dataType:'json',
		type:'POST',
		data:{placa:placa},
		success:function(response){
			console.log(response)
			if(response!=''){

				if(document.getElementById('numplacav')){
	
					// $('#numplacav').val(response['vehiculo'][0].placa)
					$('#anofabv').val(response['vehiculo'][0].anio_fabricacion)
					$('#clasev').val(response['vehiculo'][0].clase)
					$('#marcav').val(response['vehiculo'][0].marca)
					$('#modelov').val(response['vehiculo'][0].modelo)
					$('#combustiblev').val(response['vehiculo'][0].combustible)
					$('#carroceriav').val(response['vehiculo'][0].carroceria)
					$('#fecinscv').val(response['vehiculo'][0].fecha_inscripcion)
					$('#colorv').val(response['vehiculo'][0].color)
					$('#motorv').val(response['vehiculo'][0].motor)
					$('#numseriev').val(response['vehiculo'][0].numero_serie)
					$('#pregis_vehi').val(response['vehiculo'][0].partida_registral)
					$('#idsedereg2_vehi').val(response['vehiculo'][0].id_sede_registral)
				}
				if(document.getElementById('numplacav2')){
	
					// $('#numplacav2').val(response['vehiculo'][0].placa)
					$('#anofabv2').val(response['vehiculo'][0].anio_fabricacion)
					$('#clasev2').val(response['vehiculo'][0].clase)
					$('#marcav2').val(response['vehiculo'][0].marca)
					$('#modelov2').val(response['vehiculo'][0].modelo)
					$('#combustiblev2').val(response['vehiculo'][0].combustible)
					$('#carroceriav2').val(response['vehiculo'][0].carroceria)
					$('#fecinscv2').val(response['vehiculo'][0].fecha_inscripcion)
					$('#colorv2').val(response['vehiculo'][0].color)
					$('#motorv2').val(response['vehiculo'][0].motor)
					$('#numseriev2').val(response['vehiculo'][0].numero_serie)
					$('#pregis_vehi2').val(response['vehiculo'][0].partida_registral)
					$('#idsedereg2_vehi_2').val(response['vehiculo'][0].id_sede_registral)
				}
			}else{
				alert('El vehiculo no ha sido registrado anteriormente');
				if(document.getElementById('numplacav')){
	
					// $('#numplacav').val('')
					$('#anofabv').val('')
					$('#clasev').val('')
					$('#marcav').val('')
					$('#modelov').val('')
					$('#combustiblev').val('')
					$('#carroceriav').val('')
					$('#fecinscv').val('')
					$('#colorv').val('')
					$('#motorv').val('')
					$('#numseriev').val('')
					$('#pregis_vehi').val('')
					$('#idsedereg2_vehi').val('')
				}
				if(document.getElementById('numplacav2')){
	
					// $('#numplacav2').val('')
					$('#anofabv2').val('')
					$('#clasev2').val('')
					$('#marcav2').val('')
					$('#modelov2').val('')
					$('#combustiblev2').val('')
					$('#carroceriav2').val('')
					$('#fecinscv2').val('')
					$('#colorv2').val('')
					$('#motorv2').val('')
					$('#numseriev2').val('')
					$('#pregis_vehi2').val('')
					$('#idsedereg2_vehi_2').val('')
				}
			}
		}
	});	
}

function isConsultSunarp(){
	valueSelection = $('#idplacav').val();
	if(valueSelection == 'P'){
		$('#btn-consult-sunarp').show();
	}else{
		$('#btn-consult-sunarp').hide();	
		$('#numseriev').val('');
		$('#motorv').val('');
		$('#colorv').val('');
		$('#marcav').val('');
		$('#modelov').val('');
	}
}
	

function isConsultSunarp2(){
  valueSelection = $('#idplacav2').val();
  if(valueSelection == 'P'){
    $('#btn-consult-sunarp2').show();
  }else{
    $('#btn-consult-sunarp2').hide();  
    $('#numseriev2').val('');
    $('#motorv2').val('');
    $('#colorv2').val('');
    $('#marcav2').val('');
    $('#modelov2').val('');
  }
}


function consultSunarp2(){
  placa = $('#numplacav2').val();
  jQuery.ajax({
    url:'Sunarp/get_data_vehicle.php',
    dataType:'json',
    type:'POST',
    data:{placa:placa},
    success:function(response){

      if(response.error == 0){
        $('#numseriev2').val(response.serialNumber);
        $('#motorv2').val(response.engineNumber);
        $('#colorv2').val(response.color);
        $('#marcav2').val(response.mark);
        $('#modelov2').val(response.model);
      }else{
        alert(response.messageDescription);
        $('#numseriev2').val('');
        $('#motorv2').val('');
        $('#colorv2').val('');
        $('#marcav2').val('');
        $('#modelov2').val('');
      }
    }
  }); 
}
function buscarkardexavanzada3(pag){
	
	var divResultado  = document.getElementById('bkardex');
 	divResultado.innerHTML= '<img src="loading.gif">';
	console.log(divResultado);
	//divResultado.innerHTML= '<img src="../../loading.gif">';
	var idtipoacto     = document.getElementById('idtipoacto').value;
    var nombre  = document.getElementById('nombre').value;	
	var numdoc  = document.getElementById('numdoc').value;
	var rangof1  = document.getElementById('rangof1').value;
	var rangof2  = document.getElementById('rangof2').value;
	var idtipkar  = document.getElementById('idtipkar').value;
	var radio7=document.getElementById('radio7').value;
	var inconcluso=document.getElementById('inconcluso').checked;
	var estudio=document.getElementById('estudio').value;
	var responsable=document.getElementById('responsable').value;
	var desistido=document.getElementById('desistido').checked;
	var retenido=document.getElementById('retenido').checked;
	var nopresentado=document.getElementById('nopresentado').checked;
	var est_rrpp=document.getElementById('est_rrpp').value;
	var codkardex=document.getElementById('codkardex').value;
	
	var concluso=document.getElementById('concluso').checked;
	var noescriturado=document.getElementById('noescriturado').checked;
	var escriturado=document.getElementById('escriturado').checked;
	var pagado=document.getElementById('pagado').checked;
	var nopagado=document.getElementById('nopagado').checked;
	var saldo=document.getElementById('saldo').checked;

	var cmbGrupoCliente="";
	var cmbProyecto="";
	var empresacons=document.getElementById('empresacons').value;
	
	document.getElementById("boton").setAttribute("onClick","");
		
	ajax=objetoAjax();
	ajax.open("POST", "busqueda_kardex7.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;		
			document.getElementById("boton").setAttribute("onClick","cargakardexava2(1);");	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("cmbGrupoCliente="+cmbGrupoCliente+"&cmbProyecto="+cmbProyecto+"&empresacons="+empresacons+"&idtipoacto="+idtipoacto+"&nombre="+nombre+"&rangof1="+rangof1+"&rangof2="+rangof2+"&numdoc="+numdoc+"&pag="+pag+"&idtipkar="+idtipkar+"&radio7="+radio7+"&inconcluso="+inconcluso+"&estudio="+estudio+"&responsable="+responsable+"&retenido="+retenido+"&desistido="+desistido+"&nopresentado="+nopresentado+"&est_rrpp="+est_rrpp+"&codkardex="+codkardex+"&concluso="+concluso+"&noescriturado="+noescriturado+"&escriturado="+escriturado+"&pagado="+pagado+"&nopagado="+nopagado+"&saldo="+saldo);
	}