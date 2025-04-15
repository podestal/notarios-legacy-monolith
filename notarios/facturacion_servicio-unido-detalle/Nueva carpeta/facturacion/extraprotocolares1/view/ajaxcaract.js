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

function buscar_cliente_car(){
	
	var divResultado = document.getElementById('rpta_bus');
	var _tipo_doc     = document.getElementById('tipdoc_representante').value;
	var _num_doc     = document.getElementById('numdocu_representante').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "buscar_clientes_caract.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_tipo_doc="+_tipo_doc+"&_num_doc="+_num_doc);

}

function grabarcliente_dom()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('rpta_bus');
	//tomamos el valor de la lista desplegable
	tipoper="N";
	numdoc_solic=document.getElementById('numdocu_representante').value;
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
	ajax.open("POST","grabar_cliente_caract.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc_solic+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi);


}

function grabarcliente2_dom()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('rpta_bus');
	//tomamos el valor de la lista desplegable
	tipoper="J";
	codubi=document.getElementById('codubi').value;
	ubigen=document.getElementById('ubigen').value;
	razonsocial=document.getElementById('razonsocial').value;
	numdoc_solic=document.getElementById('numdocu_representante').value;
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
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_cliente_caract2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("ubigen="+ubigen+"&numdoc_solic="+numdoc_solic+"&numdoc_solic="+numdoc_solic+"&razonsocial="+razonsocial+"&ndomfiscal="+ndomfiscal+"&codubi="+codubi+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&idsedereg3="+idsedereg3+"&numpartida="+numpartida+"&telempresa="+telempresa+"&actmunicipal="+actmunicipal+"&mailempresa="+mailempresa);


}