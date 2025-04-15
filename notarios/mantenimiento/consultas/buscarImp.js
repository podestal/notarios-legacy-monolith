// JavaScript Document
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



function buscar_imp_control(){
	
	var divResultado = document.getElementById('lst_cliente');
	var noficio     = document.getElementById('noficio').value;
	 document.getElementById('lst_cliente').style.overflow="scroll";

	
	ajax=objetoAjax();

	ajax.open("POST", "../consultas/buscar_imp_control.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("noficio="+noficio);

}

function buscar_imp_control2(){
	
	var divResultado = document.getElementById('lst_cliente');
	var noficio2     = document.getElementById('noficio2').value;
	 document.getElementById('lst_cliente').style.overflow="scroll";

	
	ajax=objetoAjax();

	ajax.open("POST", "../consultas/buscar_imp_control2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("noficio="+noficio2);

}

function buscar_cliente_DNI(){
	
	var divResultado = document.getElementById('respuesta');
	var _tipo_doc     = document.getElementById('tip_doc').value;
	var _num_doc     = document.getElementById('n_doc').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../consultas/buscar_clientes_impDNI.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;	
			mostrar_desc("respuesta");	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_tipo_doc="+_tipo_doc+"&_num_doc="+_num_doc);

}

function buscar_cliente_Cli(){
	
	var divResultado = document.getElementById('respuesta');
	var _cliente     = document.getElementById('cliente').value;
	var _tipper    = document.getElementById('tip_per').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../consultas/buscar_clientes_impCLI.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;
			mostrar_desc("respuesta");		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_cliente="+_cliente+"&_tipper="+_tipper);

}

function buscar_cliente_DNI2(){
	
	var divResultado = document.getElementById('respuesta2');
	var _tipo_doc     = document.getElementById('tip_doc2').value;
	var _num_doc     = document.getElementById('n_doc1').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../consultas/buscar_clientes_impDNI2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
			mostrar_desc("respuesta2");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_tipo_doc="+_tipo_doc+"&_num_doc="+_num_doc);

}

function buscar_cliente_Cli2(){
	
	var divResultado = document.getElementById('respuesta2');
	var _cliente     = document.getElementById('cliente1').value;
	var _tipper    = document.getElementById('tip_per2').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../consultas/buscar_clientes_impCLI2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;	
			mostrar_desc("respuesta2");	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_cliente="+_cliente+"&_tipper="+_tipper);

}

function grabarcliente()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta');
	//tomamos el valor de la lista desplegable
	tipoper="N";
	numdoc_solic=document.getElementById('numdoc_solic').value;
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
	
	
				document.getElementById('numdoc_solic').value="";
				document.getElementById('apepat').value="";
				document.getElementById('apemat').value="";
				document.getElementById('prinom').value="";
				document.getElementById('segnom').value="";
				document.getElementById('direccion').value="";
				document.getElementById('email').value="";
				document.getElementById('telfijo').value="";
				document.getElementById('telcel').value="";
				document.getElementById('telofi').value="";
				document.getElementById('sexo').value="";
				document.getElementById('idestcivil').value="";
				document.getElementById('nacionalidad').value="";
				document.getElementById('idprofesion').value="";
				document.getElementById('idcargoo').value="";
				document.getElementById('cumpclie').value="";
				document.getElementById('natper').value="";
				document.getElementById('codubisc').value="";
				document.getElementById('nomprofesiones').value="";
				document.getElementById('nomcargoss').value="";
				document.getElementById('ubigensc').value="";
				document.getElementById('residente').value="";
				document.getElementById('docpaisemi').value="";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.forms["impe_n_cliente"].reset();
		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc_solic+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi);


}

function grabarcliente2()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta');
	divResultado2 = document.getElementById('respuesta2');
	//tomamos el valor de la lista desplegable
	tipoper="J";
	codubi=document.getElementById('codubi').value;
	ubigen=document.getElementById('ubigen').value;
	razonsocial=document.getElementById('razonsocial').value;
	numdoc_solic=document.getElementById('numdoc_solic').value;
	ndomfiscal=document.getElementById('ndomfiscal').value;
	ubigen=document.getElementById('ubigen').value;
	contacempresa=document.getElementById('contacempresa').value;
	fechaconstitu=document.getElementById('fechaconstitu').value;
	numregistro=document.getElementById('numregistro').value;
	idsedereg3=document.getElementById('idsedereg3').value;
	numpartida=document.getElementById('numpartida').value;
	telempresa=document.getElementById('telempresa').value;
	actmunicipal=document.getElementById('actmunicipal').value;
	mailempresa=document.getElementById('mailempresa').value;
	
	
				document.getElementById('codubi').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('razonsocial').value="";
				document.getElementById('numdoc_solic').value="";
				document.getElementById('ndomfiscal').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('contacempresa').value="";
				document.getElementById('fechaconstitu').value="";
				document.getElementById('numregistro').value="";
				document.getElementById('idsedereg3').value="";
				document.getElementById('numpartida').value="";
				document.getElementById('telempresa').value="";
				document.getElementById('actmunicipal').value="";
				document.getElementById('mailempresa').value="";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = ajax.responseText;
			document.forms["impe_n_empresa"].reset();
		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("ubigen="+ubigen+"&numdoc_solic="+numdoc_solic+"&numdoc_solic="+numdoc_solic+"&razonsocial="+razonsocial+"&ndomfiscal="+ndomfiscal+"&codubi="+codubi+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&idsedereg3="+idsedereg3+"&numpartida="+numpartida+"&telempresa="+telempresa+"&actmunicipal="+actmunicipal+"&mailempresa="+mailempresa);


}


function grabarcliente_dom()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta');
	divResultado2 = document.getElementById('respuesta2');
	
	//tomamos el valor de la lista desplegable
	tipoper="N";
	numdoc_solic=document.getElementById('n_doc_n').value;
	
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
	
	
				document.getElementById('n_doc_n').value="";	
				document.getElementById('apepat').value="";
				document.getElementById('apemat').value="";
				document.getElementById('prinom').value="";
				document.getElementById('segnom').value="";
				document.getElementById('direccion').value="";
				document.getElementById('email').value="";
				document.getElementById('telfijo').value="";
				document.getElementById('telcel').value="";
				document.getElementById('telofi').value="";
				document.getElementById('sexo').value="";
				document.getElementById('idestcivil').value="";
				document.getElementById('nacionalidad').value="";
				document.getElementById('idprofesion').value="";
				document.getElementById('idcargoo').value="";
				document.getElementById('cumpclie').value="";
				document.getElementById('natper').value="";
				document.getElementById('codubisc').value="";
				document.getElementById('nomprofesiones').value="";
				document.getElementById('nomcargoss').value="";
				document.getElementById('ubigensc').value="";
				document.getElementById('residente').value="";
				document.getElementById('docpaisemi').value="";
				
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = ajax.responseText;
			document.forms["impe_n_cliente"].reset();
				
			cerrar2_2();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc_solic+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi);


}


//juridicos
function grabarcliente2_dom()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta');
	divResultado2 = document.getElementById('respuesta2');
	//tomamos el valor de la lista desplegable
	tipoper="J";
	codubi=document.getElementById('codubi').value;
	ubigen=document.getElementById('ubigen').value;
	razonsocial=document.getElementById('nrazonsocial').value;
	numdoc_solic=document.getElementById('n_doc_r').value;
	ndomfiscal=document.getElementById('ndomfiscal').value;
	ubigen=document.getElementById('ubigen').value;
	contacempresa=document.getElementById('contacempresa').value;
	fechaconstitu=document.getElementById('fechaconstitu').value;
	numregistro=document.getElementById('numregistro').value;
	idsedereg3=document.getElementById('idsedereg3').value;
	numpartida=document.getElementById('numpartida').value;
	telempresa=document.getElementById('telempresa').value;
	actmunicipal=document.getElementById('actmunicipal').value;
	mailempresa=document.getElementById('mailempresa').value;

	
	
				document.getElementById('codubi').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('nrazonsocial').value="";
				document.getElementById('n_doc_r').value="";
				document.getElementById('ndomfiscal').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('contacempresa').value="";
				document.getElementById('fechaconstitu').value="";
				document.getElementById('numregistro').value="";
				document.getElementById('idsedereg3').value="";
				document.getElementById('numpartida').value="";
				document.getElementById('telempresa').value="";
				document.getElementById('actmunicipal').value="";
				document.getElementById('mailempresa').value="";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp1.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = ajax.responseText;
			document.forms["impe_n_empresa"].reset();
				
			cerrar2_1();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("ubigen="+ubigen+"&numdoc_solic="+numdoc_solic+"&numdoc_solic="+numdoc_solic+"&razonsocial="+razonsocial+"&ndomfiscal="+ndomfiscal+"&codubi="+codubi+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&idsedereg3="+idsedereg3+"&numpartida="+numpartida+"&telempresa="+telempresa+"&actmunicipal="+actmunicipal+"&mailempresa="+mailempresa);


}// JavaScript Document

//juridicos
function grabarcliente2_dom_editar()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta2');
	//tomamos el valor de la lista desplegable
	tipoper="J";
	codubi=document.getElementById('codubi').value;
	ubigen=document.getElementById('ubigen').value;
	razonsocial=document.getElementById('nrazonsocial').value;
	numdoc_solic=document.getElementById('n_doc_r').value;
	ndomfiscal=document.getElementById('ndomfiscal').value;
	ubigen=document.getElementById('ubigen').value;
	contacempresa=document.getElementById('contacempresa').value;
	fechaconstitu=document.getElementById('fechaconstitu').value;
	numregistro=document.getElementById('numregistro').value;
	idsedereg3=document.getElementById('idsedereg3').value;
	numpartida=document.getElementById('numpartida').value;
	telempresa=document.getElementById('telempresa').value;
	actmunicipal=document.getElementById('actmunicipal').value;
	mailempresa=document.getElementById('mailempresa').value;
	
	
				document.getElementById('codubi').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('razonsocial').value="";
				document.getElementById('n_doc_r').value="";
				document.getElementById('ndomfiscal').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('contacempresa').value="";
				document.getElementById('fechaconstitu').value="";
				document.getElementById('numregistro').value="";
				document.getElementById('idsedereg3').value="";
				document.getElementById('numpartida').value="";
				document.getElementById('telempresa').value="";
				document.getElementById('actmunicipal').value="";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp1_1.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.forms["impe_m_empresa"].reset();
				
			cerrar2_1();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("ubigen="+ubigen+"&numdoc_solic="+numdoc_solic+"&razonsocial="+razonsocial+"&ndomfiscal="+ndomfiscal+"&codubi="+codubi+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&idsedereg3="+idsedereg3+"&numpartida="+numpartida+"&telempresa="+telempresa+"&actmunicipal="+actmunicipal+"&mailempresa="+mailempresa);


}// JavaScript Document


function grabarcliente_dom_editar()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta2');
	
	//tomamos el valor de la lista desplegable
	tipoper="N";
	numdoc_solic=document.getElementById('n_doc_n').value;

	
	apepat=document.getElementById('napepat').value;
	tip_doc_cli=document.getElementById('tip_doc_cli').value;
	apemat=document.getElementById('napemat').value;
	prinom=document.getElementById('nprinom').value;
	segnom=document.getElementById('nsegnom').value;
	direccion=document.getElementById('ndireccion').value;
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
	
	
				document.getElementById('n_doc_n').value="";	
				document.getElementById('apepat').value="";
				document.getElementById('apemat').value="";
				document.getElementById('prinom').value="";
				document.getElementById('segnom').value="";
				document.getElementById('direccion').value="";
				document.getElementById('email').value="";
				document.getElementById('telfijo').value="";
				document.getElementById('telcel').value="";
				document.getElementById('telofi').value="";
				document.getElementById('sexo').value="";
				document.getElementById('idestcivil').value="";
				document.getElementById('nacionalidad').value="";
				document.getElementById('idprofesion').value="";
				document.getElementById('idcargoo').value="";
				document.getElementById('cumpclie').value="";
				document.getElementById('natper').value="";
				document.getElementById('codubisc').value="";
				document.getElementById('nomprofesiones').value="";
				document.getElementById('nomcargoss').value="";
				document.getElementById('ubigensc').value="";
				document.getElementById('residente').value="";
				document.getElementById('docpaisemi').value="";
				document.getElementById('tip_doc_cli').value="";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp2_2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.forms["impe_m_cliente"].reset();
			
			
	
	
			cerrar2_2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc_solic+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi+"&tip_doc_cli="+tip_doc_cli);


}


function grabarcliente_dom_editar2()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta2');
	
	//tomamos el valor de la lista desplegable
	tipoper="N";
	numdoc_solic=document.getElementById('m_doc_n2').value;

	
	apepat=document.getElementById('mapepat').value;
	tip_doc_cli=document.getElementById('mtip_doc_cli2').value;
	apemat=document.getElementById('mapemat').value;
	prinom=document.getElementById('mprinom').value;
	segnom=document.getElementById('msegnom').value;
	direccion=document.getElementById('mdireccion').value;
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
	
	
				document.getElementById('m_doc_n2').value="";	
				document.getElementById('mapepat').value="";
				document.getElementById('mapemat').value="";
				document.getElementById('mprinom').value="";
				document.getElementById('msegnom').value="";
				document.getElementById('mdireccion').value="";
				document.getElementById('email').value="";
				document.getElementById('telfijo').value="";
				document.getElementById('telcel').value="";
				document.getElementById('telofi').value="";
				document.getElementById('sexo').value="";
				document.getElementById('idestcivil').value="";
				document.getElementById('nacionalidad').value="";
				document.getElementById('idprofesion').value="";
				document.getElementById('idcargoo').value="";
				document.getElementById('cumpclie').value="";
				document.getElementById('natper').value="";
				document.getElementById('codubisc').value="";
				document.getElementById('nomprofesiones').value="";
				document.getElementById('nomcargoss').value="";
				document.getElementById('ubigensc').value="";
				document.getElementById('residente').value="";
				document.getElementById('docpaisemi').value="";
				document.getElementById('mtip_doc_cli2').value="";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp2_2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.forms["impe_m_cliente"].reset();
			
			
	
	
			cerrar2_2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc_solic+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi+"&tip_doc_cli="+tip_doc_cli);


}


function grabarcliente2_dom_editar2()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('respuesta2');
	//tomamos el valor de la lista desplegable
	tipoper="J";
	codubi=document.getElementById('codubi').value;
	ubigen=document.getElementById('ubigen').value;
	razonsocial=document.getElementById('mrazonsocial').value;
	numdoc_solic=document.getElementById('m_doc_r').value;
	ndomfiscal=document.getElementById('mdomfiscal').value;
	ubigen=document.getElementById('ubigen').value;
	contacempresa=document.getElementById('mcontacempresa').value;
	fechaconstitu=document.getElementById('mfechaconstitu').value;
	numregistro=document.getElementById('mnumregistro').value;
	idsedereg3=document.getElementById('idsedereg3').value;
	numpartida=document.getElementById('numpartida').value;
	telempresa=document.getElementById('telempresa').value;
	actmunicipal=document.getElementById('actmunicipal').value;
	mailempresa=document.getElementById('mailempresa').value;
	
	
				document.getElementById('codubi').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('mrazonsocial').value="";
				document.getElementById('m_doc_r').value="";
				document.getElementById('mdomfiscal').value="";
				document.getElementById('ubigen').value="";
				document.getElementById('mcontacempresa').value="";
				document.getElementById('mfechaconstitu').value="";
				document.getElementById('mnumregistro').value="";
				document.getElementById('idsedereg3').value="";
				document.getElementById('numpartida').value="";
				document.getElementById('telempresa').value="";
				document.getElementById('actmunicipal').value="";
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_imp1_1.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.forms["impe_m_empresa"].reset();
				
			cerrar2_1();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("ubigen="+ubigen+"&numdoc_solic="+numdoc_solic+"&razonsocial="+razonsocial+"&ndomfiscal="+ndomfiscal+"&codubi="+codubi+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&idsedereg3="+idsedereg3+"&numpartida="+numpartida+"&telempresa="+telempresa+"&actmunicipal="+actmunicipal+"&mailempresa="+mailempresa);


}// JavaScript Document