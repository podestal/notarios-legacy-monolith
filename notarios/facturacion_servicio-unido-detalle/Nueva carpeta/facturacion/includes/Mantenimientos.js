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
buscaComprobante
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

function foco(obj,e)
 	{
		if(e.keyCode==13)
			{
			obj.focus();
			}
	}	

// #####################################################################

// FORMULARIO COMPROBANTES
// GUARDA DATOS DE LOS COMPROBANTES DE PAGO
function fguardaComprobante()
{	
	var divResultado = document.getElementById('resul_documen');
	
	divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	var _id_regventas      = document.getElementById('id_regventas').value;
	var _tipo_docu         = document.getElementById('tipdocu').value;
	var _serie  	       = document.getElementById('seriedoc').value;
	var _factura      	   = document.getElementById('numdocumen').value;	
	var _fecha      	   = document.getElementById('fecemision').value;
	var _num_docu      	   = document.getElementById('numdoc').value;	
	var _kardex	      	   = document.getElementById('numero').value;	
	var _codigo_cli    	   = document.getElementById('idcliente').value;	
	var _concepto    	   = document.getElementById('nombre_cliente').value;	
	var _imp_total   	   = document.getElementById('total').value;	
	var _subtotal   	   = document.getElementById('subtotal').value;	
	var _impuesto   	   = document.getElementById('montoigv').value;	
	var _empleado   	   = document.getElementById('usuario_sesion').value;	
	var _tipopago   	   = document.getElementById('tippago').value;
	var _monedatipo	 	   = "1" //document.getElementById('').value;
	var _monto_igv	 	   = document.getElementById('montoigv').value;
	
	var _swt_det	 	   = document.getElementById('swt_det').value;
	var _detraccion	 	   = document.getElementById('detraccion').value;
	
	var _num_desde	 	   = document.getElementById('num_desde').value;
	var _num_hasta	 	   = document.getElementById('num_hasta').value;
	
	var _id_numbouc	 	   = document.getElementById('id_numbouc').value;
	
	// TEXTX QUE CONTIENE TODOS LOS DETALLES:
	var _detalles          = document.getElementById('txtTotServicios').value;
	
	// numero de rows ede la tabla
	var _txtNumRows = document.getElementById('txtNumRows').value;
	
	
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardacomprobante.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Carta satisfactoriamente');
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;margin:0 auto;border: 2px solid #ddd; border-radius: 10px;padding: 2px; box-shadow: #ccc 5px 0 5px; margin-bottom:0px;'><center>Guardado satisfactoriamente</center></div>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipo_docu="+_tipo_docu+"&serie="+_serie+"&factura="+_factura+"&fecha="+_fecha+"&num_docu="+_num_docu+"&kardex="+_kardex+"&codigo_cli="+_codigo_cli+"&concepto="+_concepto+"&imp_total="+_imp_total+"&subtotal="+_subtotal+"&impuesto="+_impuesto+"&empleado="+_empleado+"&tipopago="+_tipopago+"&monedatipo="+_monedatipo+"&monto_igv="+_monto_igv+"&swt_det="+_swt_det+"&detraccion="+_detraccion+"&id_regventas="+_id_regventas+"&num_desde="+_num_desde+"&num_hasta="+_num_hasta+"&id_numbouc="+_id_numbouc+"&txtTotServicios="+_detalles+"&txtNumRows="+_txtNumRows);

}

// PASA DATOS DE LOS ITEMS.

function fPassDataItem()
{	    
	var _id_regventas = document.getElementById('id_regventas').value;
	var _codigo		 = document.getElementById('servicio').value;
	var _codigo2	 = document.getElementById('servicio');
	var _serie		 = document.getElementById('seriedoc').value;
	var _documento	 = document.getElementById('numdocumen').value;
	var _tipo_docu	 = document.getElementById('tipdocu').value;
	var _kardex		 = document.getElementById('numero').value;
	var _detalle     =  _codigo2.options[_codigo2.selectedIndex].text; 
	var _precio		 = document.getElementById('servprecio').value;
	var _cantidad	 = document.getElementById('servcant').value;
	var _grupo		 = document.getElementById('servtipo').value;
	var _monedatipo	 = "01";
	var _igv 		 = 0.18 * (parseFloat(_precio) * parseFloat(_cantidad));
	var _monto_igv	 = Math.round(_igv * Math.pow(10, 2)) / Math.pow(10, 2);
	var _grupempl	 = document.getElementById('grupoemp').value;
	var _tot         = (parseFloat(_precio) * parseFloat(_cantidad)) - _monto_igv;
	var _total       = Math.round(_tot * Math.pow(10, 2)) / Math.pow(10, 2);
	
	var _detalle_fac = document.getElementById('detalle_fac').value;

	var divResultado 	 = document.getElementById('div_detalle');
	
	//divResultado.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaDetComprobante.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Carta satisfactoriamente');
			//divResultado.innerHTML = ajax.responseText;
			//fPassData2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_regventas="+_id_regventas+"&codigo="+_codigo+"&serie="+_serie+"&documento="+_documento+"&tipo_docu="+_tipo_docu+"&kardex="+_kardex+"&detalle="+_detalle+"&precio="+_precio+"&cantidad="+_cantidad+"&grupo="+_grupo+"&monedatipo="+_monedatipo+"&monto_igv="+_monto_igv+"&grupempl="+_grupempl+"&total="+_total+"&detalle_fac="+_detalle_fac);
}


// ACTUALIZA UNA CUENTA CORRIENTE -- MODULO CANCELACION DE DOCUMENTOS.

function fUpdateCtaCte()
{	
	var _doccli        = document.getElementById('txtcodigo').value;
	var _concepto      = document.getElementById('concepto').value;
    
	var _id_ctaventas  = document.getElementById('id_ctaventas').value ;	
	var _tipdocu2      = document.getElementById('tipdocu2').value ;	
	var _cliente       = document.getElementById('cliente').value ;	
	var _txtfecha      = document.getElementById('txtfecha').value ;	
	
	var _tippago       = document.getElementById('tippago').value ;	
	var _txtmonto      = document.getElementById('txtmonto').value ;	
	var _txtsaldo      = document.getElementById('txtsaldo').value ;	
	var _seriedoc      = document.getElementById('seriedoc').value ;	
	var _numdocumen    = document.getElementById('numdocumen').value ;	
	var _txtmonreten   = document.getElementById('txtmonreten').value ;
	//var _swtreten      = document.getElementById('swtreten').checked;
	/*if(_swtreten==true)
	{
		var _swtreten == '1'
	}
	else if(_swtreten==false)
	{
		var _swtreten == '0'
	}*/
	var _txtbanco      = document.getElementById('txtbanco').value ;	
	var _numcta        = document.getElementById('numcta').value ;	
	
	divResultado 	 = document.getElementById('div_detalle');
	
	divResultado.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/updateCtaCte.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			//divResultado.innerHTML = ajax.responseText;
			ShowDetComprobante();
			fOcultaAdd();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("doccli="+_doccli+"&concepto="+_concepto+"&id_ctaventas="+_id_ctaventas+"&tipdocu2="+_tipdocu2+"&cliente="+_cliente+"&txtfecha="+_txtfecha+"&tippago="+_tippago+"&txtmonto="+_txtmonto+"&txtsaldo="+_txtsaldo+"&seriedoc="+_seriedoc+"&numdocumen="+_numdocumen+"&txtmonreten="+_txtmonreten+"&txtbanco="+_txtbanco+"&numcta="+_numcta);
}



// ANULA UN PAGO REALIZADO - MONULO ANULACION DE PAGOS.
function fAnulPagos(_obj)
{	
	var _id_ctaventas  = _obj;	
	
	divResultado 	 = document.getElementById('div_detalle');
	divResultado2 = document.getElementById('confirmaGuarda');
	
	divResultado.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/AnulaDocum.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;margin:0 auto;border: 2px solid #ddd; border-radius: 10px;padding: 2px; box-shadow: #ccc 5px 0 5px; margin-bottom:0px;'><center>Se anuló el pago satisfactoriamente</center></div>";
			//divResultado.innerHTML = ajax.responseText;
			ShowDetComprobante();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_ctaventas="+_id_ctaventas);
}

//
// #====================================================
// #== INGRESO COMPROBANTES  -- BUSQUEDA DE CLIENTE V. 1
function buscarclienteCar()
{
	divResultado = document.getElementById('datos');
	var _tipoper = document.getElementById('tipoper').value ;
	var _numdoc  = document.getElementById('numdoc2').value ;

	ajax=objetoAjax();

	ajax.open("POST","../model/buscacliedniruclibCar.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+_tipoper+"&numdoc="+_numdoc);
	
}
// #=========================================================

//  #== INGRESO COMPROBANTES --  FUNCION AGREGA NUEVO CLIENTE
function grabarclienteCar()
{
	var divResultado = document.getElementById('datos');

	var tipoper    = document.getElementById('tipoper').value;
	var numdoc     = document.getElementById('numdoc2').value;
	var apepat     = document.getElementById('apepat').value.replace(/&/g,"*").replace(/'/g,"?");
	var apemat     = document.getElementById('apemat').value.replace(/&/g,"*").replace(/'/g,"?");
	var prinom     = document.getElementById('prinom').value.replace(/&/g,"*").replace(/'/g,"?");
	var segnom     = document.getElementById('segnom').value.replace(/&/g,"*").replace(/'/g,"?");
	var direccion  = document.getElementById('direccion').value.replace(/&/g,"*").replace(/'/g,"?");
	var email      = document.getElementById('email').value;
	var telfijo    = document.getElementById('telfijo').value;
	var telcel     = document.getElementById('telcel').value;
	var telofi     = document.getElementById('telofi').value;
	var sexo       = document.getElementById('sexo').value;
	var idestcivil = document.getElementById('idestcivil').value;
	var nacionalidad = document.getElementById('nacionalidad').value;
	var idprofesion  = document.getElementById('idprofesion').value;
	var idcargoo   = document.getElementById('idcargoo').value;
	var cumpclie   = document.getElementById('cumpclie').value;
	var natper     = document.getElementById('natper').value;
	var codubisc   = document.getElementById('codubisc').value;
	var nomprofesiones = document.getElementById('nomprofesiones').value;
	var nomcargoss = document.getElementById('nomcargoss').value;
	var ubigensc   = document.getElementById('ubigensc').value;
	var residente  = document.getElementById('residente').value;
	var docpaisemi = document.getElementById('docpaisemi').value;

	ajax=objetoAjax();

	ajax.open("POST","../model/grabar_clientelibCar.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi);


}

//////  REPORTE DE COMPROBANTES GENERAL IMPORTACION PDF

function pdf(fecini,fecfin){

	ajax=objetoAjax();
	ajax.open("POST", "../Reportes/PDFcomprob.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("../Reportes/PDFcomprob.php?fecini="+fecini+"&fecfin="+fecfin); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}

////// REPORTE DE COMPROBANTES GENERAL EN PANTALLA

function buscaComprobante(){

	var divResultado = document.getElementById('buscacomprobantes');

	var _fechade     = document.getElementById('fechade').value; 
	var _fechaa      = document.getElementById('fechaa').value; 
	
    divResultado.innerHTML= '<center><br><br><img src="../../loading.gif"></center>';
	ajax = objetoAjax();
	ajax.open("POST", "../model/buscaComprob_general.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+_fechade+"&fechaa="+_fechaa)
}

////// REPORTE DE COMPROBANTES PENDIENTES DE PAGO EN PANTALLA

function buscaComprobantePend(){

	divResultado = document.getElementById('buscacomprobantes');

	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	
    divResultado.innerHTML= '<center><br><br><img src="../../loading.gif"></center>';
	ajax = objetoAjax();
	ajax.open("POST", "../model/buscaComprob_Pendientes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+_fechade+"&fechaa="+_fechaa)
}

//////// REPORTE DE COMPROBANTES PENDIENTES DE PAGO IMPORTACION PDF

function pdf_Pend(fecini,fecfin){

	ajax=objetoAjax();
	ajax.open("POST", "../Reportes/PDFcomprob_Pend.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("../Reportes/PDFcomprob_Pend.php?fecini="+fecini+"&fecfin="+fecfin); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}

////////// REPORTE DE COMPROBANTES CANCELADOS EN PANTALLA

function buscaComprobanteCanc(){

	divResultado = document.getElementById('buscacomprobantes');

	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	
    divResultado.innerHTML= '<center><br><br><img src="../../loading.gif"></center>';
	ajax = objetoAjax();
	ajax.open("POST", "../model/buscaComprob_Cancelados.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+_fechade+"&fechaa="+_fechaa)
}

//////// REPORTE DE COMPROBANTES CANCELADOS IMPORTACION PDF

function pdfCanc(fecini,fecfin){

	ajax=objetoAjax();
	ajax.open("POST", "../Reportes/PDFcomprob_Canc.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("../Reportes/PDFcomprob_Canc.php?fecini="+fecini+"&fecfin="+fecfin); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecini="+fecini+"&fecfin="+fecfin);
}


function buscaubigeossc()
{ 	divResultado = document.getElementById('resulubisc');
	buscaubisc=document.getElementById('_buscaubisc').value;
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscarubigeosclib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc="+buscaubisc)
}





// Busca ubigeos en la creacion de nueva empresa.
function buscaubigeos()
{ 	var divResultado = document.getElementById('resulubi');
	var __buscaubi   = document.getElementById('_buscaubi').value;
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscarubigeolib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubi="+__buscaubi);
}




function grabarempresa()
{

	var divResultado  = document.getElementById('datos');
	
	var tipoper       = document.getElementById('tipoper').value;
	var numdoc		  = document.getElementById('numdoc2').value;
	var razonsocial	  = document.getElementById('razonsocial').value.replace(/&/g,"*").replace(/'/g,"?");
	var domfiscal 	  = document.getElementById('domfiscal').value.replace(/&/g,"*").replace(/'/g,"?");
	var telempresa	  = document.getElementById('telempresa').value;
	var mailempresa	  = document.getElementById('mailempresa').value;
	var contacempresa = document.getElementById('contacempresa').value.replace(/&/g,"*").replace(/'/g,"?");
	var fechaconstitu = document.getElementById('fechaconstitu').value;
	var numregistro	  = document.getElementById('numregistro').value;
	var numpartida	  = document.getElementById('numpartida').value;
	var actmunicipal  = document.getElementById('actmunicipal').value;
	var codubi		  = document.getElementById('codubi').value;
	var idsedereg3	  = document.getElementById('idsedereg3').value;
	
	ajax=objetoAjax();

	ajax.open("POST","../model/grabar_empresalib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3)
	
}


function buscaComprobante222(){

	var divResultado = document.getElementById('buscacomprobantes');

	var _fechade     = document.getElementById('fechade').value; 
	var _fechaa      = document.getElementById('fechaa').value; 
	
    divResultado.innerHTML= '<center><br><br><img src="../../loading.gif"></center>';
	ajax = objetoAjax();
	ajax.open("POST", "../model/BuscaComprob_general2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechade="+_fechade+"&fechaa="+_fechaa)
}