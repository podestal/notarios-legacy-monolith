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

// NUMEROS
	function NumCheck(e, field) 
	{
		key = e.keyCode ? e.keyCode : e.which
		// backspace
		if (key == 8) return true
		if(key==13){
		//document.getElementById("bpag").focus();
		}
		// 0-9
		if (key > 47 && key < 58) {
		if (field.value == "") return true
		regexp = /.[0-9]{*}$/
		return !(regexp.test(field.value))
		}
		// .
		if (key == 46) {
		if (field.value == "") return false
		regexp = /^[0-9]+$/
		return regexp.test(field.value)
		}
		// other key
		return false
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


// FORMULARIO CARTAS
//Guarda datos de carta
function fguardaCarta()
{	
	var divResultado      = document.getElementById('resul_carta');
	
	var divResultado2     = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	var _num_carta        = document.getElementById('numcarta').value;
	var _fec_ingreso      = document.getElementById('fecingreso').value;
	var _id_remitente     = document.getElementById('numdoc').value;
	
	// ADICIONALES SEGUN REQ.
	var _remitente        = document.getElementById('remitente').value;
	var _direccion_remi   = document.getElementById('direccion_remi').value;
	var _telefono         = document.getElementById('telefono').value;
	
	var _nom_destinatario = document.getElementById('destinatario').value;
	var _dir_destinatario = document.getElementById('dirdestino').value;
	var _zona_destinatario = document.getElementById('idzona').value;
	var _costo             = document.getElementById('costo').value;
	var _id_encargado      = document.getElementById('idencargado').value;
	var _des_encargado     = document.getElementById('encargado').value;
	var _fec_entrega       = document.getElementById('fecentrega').value;
	var _hora_entrega      = document.getElementById('horaentrega').value;
	var _emple_entrega     = document.getElementById('empentrega').value;
	
	var _nom_regogio       = document.getElementById('nomrecogio').value;
	var _doc_recogio       = document.getElementById('docrecogio').value;
	var _fec_recogio       = document.getElementById('fecrecogio').value;
	var _fact_recogio      = document.getElementById('factura').value;
	
	      
	var valord=document.getElementById('contecarta').value;
    var textod=valord.replace(/&/gi,"*");
    var textod2=textod.replace(/'/gi,"?");
    var textod4=textod2.replace(/#/gi,"QQ11QQ");
    var textod5=textod4.replace(/°/gi,"QQ22KK");
    var _conte_carta=textod5;
		
	ajax=objetoAjax();
	ajax.open("POST", "../model/guardacarta.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Carta satisfactoriamente');
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Guardado satisfactoriamente</center></div>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_carta="+_num_carta+"&fec_ingreso="+_fec_ingreso+"&id_remitente="+_id_remitente+"&nom_destinatario="+_nom_destinatario+"&dir_destinatario="+_dir_destinatario+"&zona_destinatario="+_zona_destinatario+"&fec_entrega="+_fec_entrega+"&hora_entrega="+_hora_entrega+"&emple_entrega="+_emple_entrega+"&conte_carta="+_conte_carta+"&nom_regogio="+_nom_regogio+"&doc_recogio="+_doc_recogio+"&fec_recogio="+_fec_recogio+"&costo="+_costo+"&id_encargado="+_id_encargado+"&des_encargado="+_des_encargado+"&fact_recogio="+_fact_recogio+"&remitente="+_remitente+"&direccion_remi="+_direccion_remi+"&telefono="+_telefono);

}

//Guarda datos editados de la carta
function feditaCarta()
{	
	var _num_carta        = document.getElementById('numcarta').value;
	var _fec_ingreso      = document.getElementById('fecingreso').value;
	var _id_remitente     = document.getElementById('numdoc').value;
	
	// ADICIONALES SEGUN REQ.
	var _remitente        = document.getElementById('remitente').value;
	var _direccion_remi   = document.getElementById('direccion_remi').value;
	var _telefono         = document.getElementById('telefono').value;
	//
	
	var _nom_destinatario   = document.getElementById('destinatario').value;
	var _dir_destinatario   = document.getElementById('dirdestino').value;
	var _zona_destinatario  = document.getElementById('idzona').value;
	var _costo 				= document.getElementById('costo').value;
	var _id_encargado  = document.getElementById('idencargado').value;
	var _des_encargado = document.getElementById('encargado').value;
	var _fec_entrega   = document.getElementById('fecentrega').value;
	var _hora_entrega  = document.getElementById('horaentrega').value;
	var _emple_entrega = document.getElementById('empentrega').value;
	
	var _nom_regogio   = document.getElementById('nomrecogio').value;
	var _doc_recogio   = document.getElementById('docrecogio').value;
	var _fec_recogio   = document.getElementById('fecrecogio').value;
	var _fact_recogio  = document.getElementById('factura').value;
	
	var valord=document.getElementById('contecarta').value;
    var textod=valord.replace(/&/gi,"*");
    var textod2=textod.replace(/'/gi,"?");
    var textod4=textod2.replace(/#/gi,"QQ11QQ");
    var textod5=textod4.replace(/°/gi,"QQ22KK");
    var _conte_carta=textod5;
	
	ajax=objetoAjax();
	
	ajax.open("POST", "../model/editcarta.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_carta="+_num_carta+"&fec_ingreso="+_fec_ingreso+"&id_remitente="+_id_remitente+"&nom_destinatario="+_nom_destinatario+"&dir_destinatario="+_dir_destinatario+"&zona_destinatario="+_zona_destinatario+"&fec_entrega="+_fec_entrega+"&hora_entrega="+_hora_entrega+"&emple_entrega="+_emple_entrega+"&conte_carta="+_conte_carta+"&nom_regogio="+_nom_regogio+"&doc_recogio="+_doc_recogio+"&fec_recogio="+_fec_recogio+"&costo="+_costo+"&id_encargado="+_id_encargado+"&des_encargado="+_des_encargado+"&fact_recogio="+_fact_recogio+"&remitente="+_remitente+"&direccion_remi="+_direccion_remi+"&telefono="+_telefono);

}


//Elimina datos de una carta
function fElimCarta()
{	
	var _num_carta      = document.getElementById('numcarta').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimcarta.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_carta="+_num_carta);

}

// busca el detalle de los sellos:
function fbussello()
{
	divResultado = document.getElementById('cartas_ayuda');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	
	_dessello = document.getElementById('dessello').value;
	ajax=objetoAjax();
	
	ajax.open("POST","listdetallecarta.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			//fcerrardivedicion();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("dessello="+_dessello);
}

function fbusClientePar()
{
	divResultado = document.getElementById('participante_select');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	
	_desparticipante = document.getElementById('desparticipante').value;
	ajax=objetoAjax();
	
	ajax.open("POST","listParticipanteDet.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			//fcerrardivedicion();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("desparticipante="+_desparticipante);
}


// CREA BLOQUES DE CARTAS (VARIAS CARTAS) DEACUERDO AL NUMERO DE CARTAS SELECCIONADO
function fcreaBloque()
{

	var _num_cartas   = document.getElementById('num_cartas').value;
	var _remitente    = document.getElementById('remitente2').value;
	var _idremitente  = document.getElementById('idremitente').value;
	var _fec_ingreso  = document.getElementById('fec_ingreso').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaBloqueCartas.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo El Bloque de '+_num_cartas+' cartas satisfactoriamente');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_cartas="+_num_cartas+"&remitente="+_remitente+"&fec_ingreso="+_fec_ingreso+"&idremitente="+_idremitente);
		
}





// #########################################################################################################################
// ###################### FORMULARIO INGRESO DE PERMISOS DE VIAJE ##########################################################

//Guarda datos de permiso de viaje
function fguardapermiviaje()
{	
    divResultado = document.getElementById('resul_crono');
	//divResultado.innerHTML= '<img src="../../loading.gif">';
	
	divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	var _id_viaje = document.getElementById('id_viaje').value;
	var _num_kardex = document.getElementById('codkardex').value;
	var _asunto = document.getElementById('idasunto').value;
	var _fec_ingreso = document.getElementById('fecingreso').value;
	var _nom_recep = document.getElementById('recepcionado').value;
	var _hora_recep = document.getElementById('horarecep').value;
	var _referencia = document.getElementById('referencia').value;
	var _nom_comu = document.getElementById('nom_comu').value;
	var _tel_comu = document.getElementById('tel_comu').value;
	var _email_comu = document.getElementById('email_comu').value;
	var _documento = document.getElementById('doc_comu').value;
	var _num_crono = document.getElementById('num_cronoG').value;
	var _fecha_crono = document.getElementById('fecha_cronoG').value;
	var _num_formu = document.getElementById('num_formuG').value;
	var _lugar_formu = document.getElementById('lugar_formuG').value;
	var _observacion = document.getElementById('observacionG').value;
	
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPermiviaje.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Guardado satisfactoriamente</center></div>";
			//alert('Se guardo Permiso satisfactoriamente');
			//document.getElementById('Grabar').disabled = true;
			//document.getElementById('btnobs').disabled = true;
			
			
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&asunto="+_asunto+"&fec_ingreso="+_fec_ingreso+"&nom_recep="+_nom_recep+"&hora_recep="+_hora_recep+"&referencia="+_referencia+"&nom_comu="+_nom_comu+"&tel_comu="+_tel_comu+"&email_comu="+_email_comu+"&documento="+_documento+"&num_crono="+_num_crono+"&fecha_crono="+_fecha_crono+"&num_formu="+_num_formu+"&lugar_formu="+_lugar_formu+"&observacion="+_observacion+"&id_viaje="+_id_viaje);

}

//Guarda datos editados de la permiso de viaje
function feditaPermiviaje()
{	
	
 	divResultado = document.getElementById('confirmaGuarda');
	divResultado.innerHTML= '<center><img src="../../loading.gif"></center>';


	var _id_viaje = document.getElementById('id_viaje').value;
	var _num_kardex = document.getElementById('numkardex').value;
	var _asunto = document.getElementById('idasunto').value;
	var _fec_ingreso = document.getElementById('fecingreso').value;
	var _nom_recep = document.getElementById('recepcionado').value;
	var _hora_recep = document.getElementById('horarecep').value;
	var _referencia = document.getElementById('referencia').value;
	var _nom_comu = document.getElementById('nom_comu').value;
	var _tel_comu = document.getElementById('tel_comu').value;
	var _email_comu = document.getElementById('email_comu').value;
	var _documento = document.getElementById('doc_comu').value;
	var _num_crono = document.getElementById('num_cronoG').value;
	var _fecha_crono = document.getElementById('fecha_cronoG').value;
	var _num_formu = document.getElementById('num_formuG').value;
	var _lugar_formu = document.getElementById('lugar_formuG').value;
	var _observacion = document.getElementById('observacionG').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editPermiviaje.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se actualizo satisfactoriamente');
			divResultado.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Actualizado satisfactoriamente</center></div>";
			

			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&asunto="+_asunto+"&fec_ingreso="+_fec_ingreso+"&nom_recep="+_nom_recep+"&hora_recep="+_hora_recep+"&referencia="+_referencia+"&nom_comu="+_nom_comu+"&tel_comu="+_tel_comu+"&email_comu="+_email_comu+"&documento="+_documento+"&id_viaje="+_id_viaje+"&num_crono="+_num_crono+"&fecha_crono="+_fecha_crono+"&num_formu="+_num_formu+"&lugar_formu="+_lugar_formu+"&observacion="+_observacion);

}


//Elimina datos de un permiso de viaje
function fElimPermiviaje()
{	
	var _id_viaje      = document.getElementById('id_viaje').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimPermiviaje.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');	
			document.getElementById('Grabar').disabled = true;
			document.getElementById('Elimi').disabled = true;
			document.getElementById('btncontratantes').disabled = true;
			document.getElementById('btnobs').disabled = true;
					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_viaje="+_id_viaje);

}

//ELIMINA DATOS DE PERMISO DE VIAJE V. 1.1
function fElimPermiviaje2()
{	
	divResultado = document.getElementById('confirmaElimina');
	divResultado.innerHTML= '<center><img src="../../loading.gif"></center>';
	var _id_viaje      = document.getElementById('id_viaje').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimPermiviaje.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se elimino satisfactoriamente');	
			document.getElementById('Grabar').disabled = true;
			document.getElementById('Elimi').disabled = true;
			document.getElementById('btncontratantes').disabled = true;
			document.getElementById('btnobs').disabled = true;
			document.getElementById('Generar').disabled = true;
			
			divResultado.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Eliminado satisfactoriamente</center></div>";
					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_viaje="+_id_viaje);

}

// GUARDA DATOS EDITADOS DE LOS PARTICIPANTES:



function feditaCondiciones()
{	
	c_descontrat();
	feditaCondicionesresult();
}
function feditaCondicionesresult()
{	
	var _id_viaje       = document.getElementById('id_viaje').value;
	var _id_contratante = document.getElementById('id_contratante').value;
	var _c_codcontrat   = document.getElementById('c_codcontrat').value;
	var _c_descontrat   = document.getElementById('nc_descontrat').value;
	var _c_fircontrat   = document.getElementById('c_fircontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	var _edad_menor     = document.getElementById('edad_menor3').value;
	var _condi_edad     = document.getElementById('condi_edad3').value;
	
	var _codi_apoderado  = "";
	
	if(document.getElementById('chk_ambos'))
	{
		var _chk_ambos = document.getElementById('chk_ambos').checked;
		if (_chk_ambos == true)
				{
					if(document.getElementById('codi_apoderado'))
					{var _codi_apoderado  = "AMBOS";}
					else {var _codi_apoderado  = "";}
				}
				else {
						if(document.getElementById('codi_apoderado'))
						{var _codi_apoderado  = document.getElementById('codi_apoderado').value;}
						else {var _codi_apoderado  = "";}
					 }
	}//chk_ambos

	if(document.getElementById('partida_numero'))
	{var _partida_numero  = document.getElementById('partida_numero').value;}
	else {var _partida_numero  = "";}
	
	if(document.getElementById('sede_registral_a'))
	{var _sede_registral_a  = document.getElementById('sede_registral_a').value;}
	else {var _sede_registral_a  = "";}	

	
	
	// NEW:
	//var _distrito_solic = document.getElementById('distrito_solic').value;
	// +"&distrito_solic="+_distrito_solic
	ajax = objetoAjax();
	hola();
	ajax.open("POST", "../model/editViajePartic.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistParticipantes();
				
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_viaje="+_id_viaje+"&id_contratante="+_id_contratante+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat+"&edad_menor="+_edad_menor+"&condi_edad="+_condi_edad+"&codi_apoderado="+_codi_apoderado+"&partida_numero="+_partida_numero+"&sede_registral_a="+_sede_registral_a);

}

// MUESTRA DATOS EDITADOS EN EL LIST DE PARTICIPANTES
function mostrarlistParticipantes()
{   
	divResultado = document.getElementById('div_participantes');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	
	_id_viaje = document.getElementById('id_viaje').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST","PermiParticipantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			//fcerrardivedicion();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_viaje="+_id_viaje)
}


// GUARDA DATOS DE NUEVOS PARTICIPANTES
function fAddCondiciones()
{	
	var _id_viaje       = document.getElementById('id_viaje').value;
	var _c_codcontrat   = document.getElementById('c_codcontrat').value;
	var _c_descontrat   = document.getElementById('c_descontrat').value;
	var _c_fircontrat   = document.getElementById('c_fircontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaViajePartic.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistParticipantes2();
			
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_viaje="+_id_viaje+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat);

}

// #== muestra listado - NUEVO participante.
function mostrarlistParticipantes2()
{
	divResultado = document.getElementById('div_participantes');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	
	_id_viaje = document.getElementById('id_viaje').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST","PermiParticipantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			//fcerrardivedicion2();
			document.getElementById('_evalIngreso').value = '1';
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_viaje="+_id_viaje)
}


// #== ELIMINA DATOS DE UN PARTICIPANTE DEL PERMISO DE VIAJE.
function fElimViajePartic(_viaje, _contratante)
{	
	//var _id_viaje      = document.getElementById('id_viaje').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimViajePartic.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino el Participante');	
			mostrarlistParticipantes2();								
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_viaje="+_viaje+"&id_contratante="+_contratante);

}


// #== GENERA NUM KARDEX (CRONOLOGICO) - PARA LA IMPRESION V. 1.1
function fGenerapermiviaje()
{	
    divResultado = document.getElementById('div_numcrono');
	//divResultado.innerHTML= '<img src="../../loading.gif">';
	
	divResultado2 = document.getElementById('div_confirmacion');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';

	
	var _id_viaje = document.getElementById('id_viajeG').value;
	var _fecha_crono = document.getElementById('fecha_crono').value;
	var _num_formu = document.getElementById('num_formu').value;

	ajax=objetoAjax();

	ajax.open("POST", "../model/generaPermiviaje.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Generado Satisfactoriamente</center></div>";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fecha_crono="+_fecha_crono+"&num_formu="+_num_formu+"&id_viaje="+_id_viaje);

}






//#########################################################################################################################
//###################### FORMULARIO SUPERVIVENCIA PERSONA CAPAZ ###########################################################
//#########################################################################################################################

//Guarda datos de supervivencia persona capaz
function fgrabpersonazapaz()
{	
	

	var _num_kardex = "";//document.getElementById('numkardex').value;
	var _num_crono = document.getElementById('num_crono').value;
	var _fecha = document.getElementById('fecha').value;
	var _num_formu = document.getElementById('num_formu').value;
	var _documento = document.getElementById('documento').value;
	var _nombre = document.getElementById('nombre1').value;
	var _tipdocu = document.getElementById('tipdocu').value;
	var _numdocu = document.getElementById('numdocu').value;
	var _nacionalidad = document.getElementById('nacionalidad').value;
	var _ecivil = document.getElementById('ecivil').value;
	var _idzona = document.getElementById('idzona').value;
	
	var _direccion = document.getElementById('direccion').value;
	var _observaciones = document.getElementById('observaciones').value;
	
	var _nom_testigo   = document.getElementById('nom_testigo').value;
	var _tdoc_testigo  = document.getElementById('tdoc_testigo').value;
	var _ndocu_testigo = document.getElementById('ndocu_testigo').value;
	var _idprofesion   = document.getElementById('idprofesion').value;
	var _detprofesion  = document.getElementById('nomprofesiones').value;
	var _espec		   = document.getElementById('espec').value; 

	
	//var _representante = document.getElementById('representante').value;
	//var _tipdocu_rep = document.getElementById('tipdocu_rep').value;
	//var _numdocu_rep = document.getElementById('numdocu_rep').value;
	//var _nombre_rep = document.getElementById('nombre_rep').value;

//id_supervivencia
//swt_capacidad
if(_nacionalidad==''){alert('debe seleccionar nacionalidad')}else{
	var divResultado  = document.getElementById('resul_crono');
	
	var divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPersonacapaz.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Certificado satisfactoriamente');
			divResultado.innerHTML  = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;margin:0 auto;border: 2px solid #ddd; border-radius: 10px;padding: 2px; box-shadow: #ccc 5px 0 5px; margin-bottom:0px;'><center>Guardado satisfactoriamente</center></div>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&num_crono="+_num_crono+"&fecha="+_fecha+"&num_formu="+_num_formu+"&documento="+_documento+"&_nombre="+_nombre+"&tipdocu="+_tipdocu+"&numdocu="+_numdocu+"&nacionalidad="+_nacionalidad+"&ecivil="+_ecivil+"&_direccion="+_direccion+"&observaciones="+_observaciones+"&idzona="+_idzona+"&_nom_testigo="+_nom_testigo+"&tdoc_testigo="+_tdoc_testigo+"&ndocu_testigo="+_ndocu_testigo+"&idprofesion="+_idprofesion+"&detprofesion="+_detprofesion+"&espec="+_espec);
}
}

//Guarda datos editados de la supervivencia persona capaz
function feditpersonacapaz()
{	
	var _num_kardex = "";//document.getElementById('numkardex').value;
	var _num_crono = document.getElementById('num_crono').value;
	var _fecha = document.getElementById('fecha').value;
	var _num_formu = document.getElementById('num_formu').value;
	var _documento = document.getElementById('documento').value;
	var _nombre = document.getElementById('nombre').value;
	var _tipdocu = document.getElementById('tipdocu').value;
	var _numdocu = document.getElementById('numdocu').value;
	var _nacionalidad = document.getElementById('nacionalidad').value;
	var _ecivil = document.getElementById('ecivil').value;
	var _idzona = document.getElementById('idzona').value;
	var _direccion = document.getElementById('direccion').value;
	var _observaciones = document.getElementById('observaciones').value;
	//var _representante = document.getElementById('representante').value;
	//var _tipdocu_rep = document.getElementById('tipdocu_rep').value;
	//var _numdocu_rep = document.getElementById('numdocu_rep').value;
	//var _nombre_rep = document.getElementById('nombre_rep').value;
	var _id_supervivencia = document.getElementById('id_supervivencia').value;
	var _swt_capacidad = document.getElementById('swt_capacidad').value;
	
	var _nom_testigo   = document.getElementById('nom_testigo').value;
	var _tdoc_testigo  = document.getElementById('tdoc_testigo').value;
	var _ndocu_testigo = document.getElementById('ndocu_testigo').value;
	
	var _idprofesion = document.getElementById('idprofesion2').value;
	var _detprofesion  = document.getElementById('nomprofesiones2').value;
	var _espec1			= document.getElementById('espec1').value;

//id_supervivencia
//swt_capacidad
	if(_nacionalidad==''){alert('Debe seleccionar nacionalidad')}else {
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editPersonacapaz.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&num_crono="+_num_crono+"&fecha="+_fecha+"&num_formu="+_num_formu+"&documento="+_documento+"&nombre="+_nombre+"&tipdocu="+_tipdocu+"&numdocu="+_numdocu+"&nacionalidad="+_nacionalidad+"&ecivil="+_ecivil+"&direccion="+_direccion+"&observaciones="+_observaciones+"&id_supervivencia="+_id_supervivencia+"&swt_capacidad="+_swt_capacidad+"&idzona="+_idzona+"&nom_testigo="+_nom_testigo+"&tdoc_testigo="+_tdoc_testigo+"&ndocu_testigo="+_ndocu_testigo+"&idprofesion="+_idprofesion+"&detprofesion="+_detprofesion+"&espec1="+_espec1);

}}


//Elimina datos de supervivencia persona capaz
function fElimpersonacapaz()
{	
	var _id_supervivencia = document.getElementById('id_supervivencia').value;
	var _swt_capacidad    = document.getElementById('swt_capacidad').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimPersonacapaz.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_supervivencia="+_id_supervivencia+"&swt_capacidad="+_swt_capacidad);

}

//#########################################################################################################################
//###################### FORMULARIO SUPERVIVENCIA PERSONA INCAPAZ #########################################################
//#########################################################################################################################

//Guarda datos de supervivencia persona incapaz
function fgrabpersonaincapaz()
{	
	

	
	var _num_kardex = "";//document.getElementById('numkardex').value;
	var _num_crono = document.getElementById('num_crono').value;
	var _fecha = document.getElementById('fecha').value;
	var _num_formu = document.getElementById('num_formu').value;
	var _documento = document.getElementById('documento').value;
	var _nombre = document.getElementById('nombre').value;
	var _tipdocu = document.getElementById('tipdocu').value;
	var _numdocu = document.getElementById('numdocu').value;
	var _nacionalidad = document.getElementById('nacionalidad').value;
	var _ecivil = document.getElementById('ecivil').value;
	var _idzona = document.getElementById('idzona').value;
	
	var _direccion = document.getElementById('direccion').value;
	var _observaciones = document.getElementById('observaciones').value;
	
	var _representante = document.getElementById('nrepresentante').value;
	var _tipdocu_rep = document.getElementById('tipdocu_rep').value;
	var _numdocu_rep = document.getElementById('numdocu_rep').value;
	var _nombre_rep = document.getElementById('nombre_rep').value;
	
	var _nom_testigo   = document.getElementById('nom_testigo').value;
	var _tdoc_testigo  = document.getElementById('tdoc_testigo').value;
	var _ndocu_testigo = document.getElementById('ndocu_testigo').value;
	var _pelectronica  = document.getElementById('pelectronica').value;
	var _especi 	   = document.getElementById('especi').value;
//id_supervivencia
//swt_capacidad
if(_nacionalidad==''){
	alert('falta ingresar nacionalidad');
	}
else{
	divResultado = document.getElementById('resul_crono');
	
	divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPersonaincapaz.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Certificado satisfactoriamente');
			divResultado.innerHTML  = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;margin:0 auto;border: 2px solid #ddd; border-radius: 10px;padding: 2px; box-shadow: #ccc 5px 0 5px; margin-bottom:0px;'><center>Guardado satisfactoriamente</center></div>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&num_crono="+_num_crono+"&fecha="+_fecha+"&num_formu="+_num_formu+"&documento="+_documento+"&nombre="+_nombre+"&tipdocu="+_tipdocu+"&numdocu="+_numdocu+"&nacionalidad="+_nacionalidad+"&ecivil="+_ecivil+"&direccion="+_direccion+"&observaciones="+_observaciones+"&representante="+_representante+"&tipdocu_rep="+_tipdocu_rep+"&numdocu_rep="+_numdocu_rep+"&nombre_rep="+_nombre_rep+"&idzona="+_idzona+"&nom_testigo="+_nom_testigo+"&tdoc_testigo="+_tdoc_testigo+"&ndocu_testigo="+_ndocu_testigo+"&pelectronica="+_pelectronica+"&especi="+_especi);
}
}

//Guarda datos editados de la supervivencia persona incapaz
function feditpersonaincapaz()
{	
	var _num_kardex = "";//document.getElementById('numkardex').value;
	var _num_crono = document.getElementById('num_crono').value;
	var _fecha = document.getElementById('fecha').value;
	var _num_formu = document.getElementById('num_formu').value;
	var _documento = document.getElementById('documento').value;
	var _nombre = document.getElementById('nombre').value;
	var _tipdocu = document.getElementById('tipdocu').value;
	var _numdocu = document.getElementById('numdocu').value;
	var _nacionalidad = document.getElementById('nacionalidad').value;
	var _ecivil = document.getElementById('ecivil').value;
	var _idzona = document.getElementById('idzona').value;
	
	var _direccion = document.getElementById('direccion').value;
	var _observaciones = document.getElementById('observaciones').value;
	
	var _representante = document.getElementById('representante').value;
	var _tipdocu_rep = document.getElementById('tipdocu_rep').value;
	var _numdocu_rep = document.getElementById('numdocu_rep').value;
	var _nombre_rep = document.getElementById('nombre_rep').value;
	
	var _id_supervivencia = document.getElementById('id_supervivencia').value;
	var _swt_capacidad = document.getElementById('swt_capacidad').value;
	
	var _nom_testigo   = document.getElementById('nom_testigo').value;
	var _tdoc_testigo  = document.getElementById('tdoc_testigo').value;
	var _ndocu_testigo = document.getElementById('ndocu_testigo').value;
	var _pelectronica  = document.getElementById('pelectronica2').value;
	var _especi1	   = document.getElementById('especi1').value;
//id_supervivencia
//swt_capacidad
	if (_nacionalidad==''){alert('Debe seleccionar nacionalidad');}else{
	ajax=objetoAjax();

	ajax.open("POST", "../model/editPersonaincapaz.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			alert('Se actualizo satisfactoriamente');		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&num_crono="+_num_crono+"&fecha="+_fecha+"&num_formu="+_num_formu+"&documento="+_documento+"&nombre="+_nombre+"&tipdocu="+_tipdocu+"&numdocu="+_numdocu+"&nacionalidad="+_nacionalidad+"&ecivil="+_ecivil+"&direccion="+_direccion+"&observaciones="+_observaciones+"&representante="+_representante+"&tipdocu_rep="+_tipdocu_rep+"&numdocu_rep="+_numdocu_rep+"&nombre_rep="+_nombre_rep+"&id_supervivencia="+_id_supervivencia+"&swt_capacidad="+_swt_capacidad+"&idzona="+_idzona+"&nom_testigo="+_nom_testigo+"&tdoc_testigo="+_tdoc_testigo+"&ndocu_testigo="+_ndocu_testigo+"&pelectronica="+_pelectronica+"&especi1="+_especi1);
	}
}


//Elimina datos de supervivencia persona incapaz
function fElimpersonaincapaz()
{	
	var _id_supervivencia = document.getElementById('id_supervivencia').value;
	var _swt_capacidad = document.getElementById('swt_capacidad').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimPersonaincapaz.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_supervivencia="+_id_supervivencia+"&swt_capacidad="+_swt_capacidad);

}


//#########################################################################################################################
//###################### FORMULARIO  CERTIFICADO  DOMICILIARIO ############################################################
//#########################################################################################################################

//Guarda datos certificado domiciliario
function fgrabcertidomic()
{
	divResultado = document.getElementById('resul_certi');
	
	divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';	

	//var id_domiciliario
	var _num_certificado = document.getElementById('num_certificado').value;
	var _fec_ingreso     = document.getElementById('fec_ingreso').value;
	var _num_formu       = document.getElementById('num_formu').value;
	var _nombre_solic    = document.getElementById('nnombre_solic').value;
	var _tipdoc_solic    = document.getElementById('tipdoc_solic').value;
	var _numdoc_solic    = document.getElementById('numdoc_solic').value;
	var _domic_solic     = document.getElementById('domic_solic').value;
	var _motivo_solic    = document.getElementById('motivo_solic').value;
	var _distrito_solic  = document.getElementById('distrito_solic').value;
	var _texto_cuerpo    = document.getElementById('texto_cuerpo').value;
	var _justifi_cuerpo  = document.getElementById('justifi_cuerpo').value;
	var sexo			 = document.getElementById('sexo').value;
	var idestcivil		 = document.getElementById('idestcivil').value;
	
	var _nom_testigo 	 = document.getElementById('nnom_testigo').value;
	var _tdoc_testigo 	 = document.getElementById('tdoc_testigo').value;
	var _ndocu_testigodom	 = document.getElementById('ndocu_testigodom').value;
	var _nomprofesionesc	 = document.getElementById('nomprofesionesc').value;
	var _idprofesionc	 = document.getElementById('idprofesionc').value;

	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaCertDomic.php",true);	
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
	ajax.send("num_certificado="+_num_certificado+"&fec_ingreso="+_fec_ingreso+"&num_formu="+_num_formu+"&nombre_solic="+
	_nombre_solic+"&tipdoc_solic="+_tipdoc_solic+"&numdoc_solic="+_numdoc_solic+"&domic_solic="+_domic_solic+"&motivo_solic="+
	_motivo_solic+"&distrito_solic="+_distrito_solic+"&texto_cuerpo="+_texto_cuerpo+"&justifi_cuerpo="+_justifi_cuerpo+"&nom_testigo="+_nom_testigo+"&tdoc_testigo="+
	_tdoc_testigo+"&ndocu_testigodom="+_ndocu_testigodom+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nomprofesionesc="+_nomprofesionesc+"&idprofesionc="+_idprofesionc);


}

//Guarda datos editados del certificado domiciliario
function fgrabCertDomic()
{	
	var _id_domiciliario  = document.getElementById('id_domiciliario').value;
	var _num_certificado = document.getElementById('num_certificado').value;
	var _fec_ingreso     = document.getElementById('fec_ingreso').value;
	var _num_formu       = document.getElementById('num_formu').value;
	var _nombre_solic    = document.getElementById('nombre_solic').value;
	var _tipdoc_solic    = document.getElementById('tipdoc_solic').value;
	var _numdoc_solic    = document.getElementById('numdoc_solic').value;
	var _domic_solic     = document.getElementById('domic_solic').value;
	var _motivo_solic    = document.getElementById('motivo_solic').value;
	var _distrito_solic  = document.getElementById('distrito_solicc').value;
	var _texto_cuerpo    = document.getElementById('texto_cuerpo').value;
	var _justifi_cuerpo  = document.getElementById('justifi_cuerpo').value;
	var sexo			=document.getElementById('sexo').value;
	var idestcivil=document.getElementById('idestcivill').value;
	
		var _nom_testigo 	 = document.getElementById('nom_testigo').value;
	var _tdoc_testigo 	 = document.getElementById('tdoc_testigo').value;
	var _ndocu_testigodom	 = document.getElementById('ndocu_testigodom').value;
	var _nomprofesionesc	 = document.getElementById('nomprofesionesc2').value;
	var _idprofesionc	 = document.getElementById('idprofesionc2').value;

	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editCertDomic.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_certificado="+_num_certificado+"&fec_ingreso="+_fec_ingreso+"&num_formu="+_num_formu+"&nombre_solic="+_nombre_solic+"&tipdoc_solic="+_tipdoc_solic+"&numdoc_solic="+_numdoc_solic+"&domic_solic="+_domic_solic+"&motivo_solic="+_motivo_solic+"&distrito_solic="+_distrito_solic+"&texto_cuerpo="+_texto_cuerpo+"&justifi_cuerpo="+_justifi_cuerpo+"&id_domiciliario="+_id_domiciliario+"&nom_testigo="+_nom_testigo+"&tdoc_testigo="+
	_tdoc_testigo+"&ndocu_testigodom="+_ndocu_testigodom+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nomprofesionesc="+_nomprofesionesc+"&idprofesionc="+_idprofesionc);

}


//Elimina datos del certificado domiciliario
function fElimCertDomic()
{	
	var _id_domiciliario = document.getElementById('id_domiciliario').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/elimCertDomic.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_domiciliario="+_id_domiciliario);

}


function editcontratantescambios()
{	

		var _id_cambio = document.getElementById('id_cambio').value;
		var _nombre = document.getElementById('nombre').value;
		var _tipdoc = document.getElementById('tipdoc').value;
		var _num_docu = document.getElementById('num_docu').value;
		var _direccion = document.getElementById('direccion').value;
		var _ecivil = document.getElementById('ecivil').value;
		
		ajax=objetoAjax();
		
		
		ajax.open("POST", "../model/EditContCambios.php",true);	
		ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderesEdit();					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&nombre="+_nombre+"&tipodoc="+_tipodoc+"&num_docu="+_num_docu+
	"&direccion="+_direccion+"&ecivil="+_ecivil);

}


// #########################################################################################################################
// ###################### FORMULARIO INGRESO DE PODERES ####################################################################

// GUARDA NUEVOS DATOS DE INGRESO DE PODERES -  CABECERA
function fSaveIngPoderes()
{	
   
    var divResultado = document.getElementById('confirmaGuarda');
	divResultado.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	var divResultado2 = document.getElementById('resul_poder');
	
	var _id_poder       = document.getElementById('id_poder').value;
	
	var _num_kardex  	= document.getElementById('num_kardex').value;
	var _num_kardex  	= document.getElementById('num_kardex').value;
	var _nom_recep      = document.getElementById('nom_recep').value;
	var	_hora_recep		= document.getElementById('hora_recep').value;
	var _id_asunto		= document.getElementById('id_asunto').value;
	var _fec_ingreso	= document.getElementById('fec_ingreso').value;
	var _referencia		= document.getElementById('referencia').value;
	var _nom_comuni		= document.getElementById('nom_comuni').value;
	var _telf_comuni	= document.getElementById('telf_comuni').value;
	var _email_comuni	= document.getElementById('email_comuni').value;
	var _documento		= document.getElementById('documento').value;
	var _id_respon		= document.getElementById('id_respon').value;
	var _des_respon		= document.getElementById('des_respon').value;
	var _doc_presen		= document.getElementById('doc_presen').value;
	var _fec_ofre		= document.getElementById('fec_ofre').value;
	var _hora_ofre		= document.getElementById('hora_ofre').value;
	
	var _num_formu      = document.getElementById('num_formuG').value;
	
	/*var _num_crono = document.getElementById('num_cronoG').value;
	var _fecha_crono = document.getElementById('fecha_cronoG').value;
	var _num_formu = document.getElementById('num_formuG').value;
	var _lugar_formu = document.getElementById('lugar_formuG').value;
	var _observacion = document.getElementById('observacionG').value;*/
			
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaIngPoderes.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Guardado satisfactoriamente</center></div>";
			divResultado2.innerHTML = ajax.responseText;
			document.getElementById('btn_poderes').style.display="";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&nom_recep="+_nom_recep+"&hora_recep="+_hora_recep+"&id_asunto="+_id_asunto+"&fec_ingreso="+_fec_ingreso+"&referencia="+_referencia+"&nom_comuni="+_nom_comuni+"&telf_comuni="+_telf_comuni+"&email_comuni="+_email_comuni+"&documento="+_documento+"&id_respon="+_id_respon+"&des_respon="+_des_respon+"&doc_presen="+_doc_presen+"&fec_ofre="+_fec_ofre+"&hora_ofre="+_hora_ofre+"&id_poder="+_id_poder+"&num_formu="+_num_formu);

}


// #=============================================================
// #== GENERA NUM KARDEX (CRONOLOGICO) - PARA LA IMPRESION V. 1.1
function fGeneraNumPoder()
{	
    divResultado = document.getElementById('div_numcrono');
	//divResultado.innerHTML= '<img src="../../loading.gif">';
	
	divResultado2 = document.getElementById('div_confirmacion');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';

	
	var _id_poder = document.getElementById('id_poderG').value;
	var _fecha_crono = document.getElementById('fecha_crono').value;
	var _num_formu = document.getElementById('num_formu').value;

	ajax=objetoAjax();

	ajax.open("POST", "../model/generaIngPoder.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Generado Satisfactoriamente</center></div>";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("fecha_crono="+_fecha_crono+"&num_formu="+_num_formu+"&id_poder="+_id_poder);

}
// #=============================================================
// #=============================================================



//########################################################
// GUARDA DATOS EDITADOS DE INGRESO DE PODERES - CABECERA.
function fEditIngPoderes()
{	
	divResultado = document.getElementById('confirmaGuarda');
	divResultado.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	var _id_poder  	    = document.getElementById('id_poder').value;
	var _num_kardex  	= document.getElementById('num_kardex').value;
	var _nom_recep      = document.getElementById('nom_recep').value;
	var	_hora_recep		= document.getElementById('hora_recep').value;
	var _id_asunto		= document.getElementById('id_asunto').value;
	var _fec_ingreso	= document.getElementById('fec_ingreso').value;
	var _referencia		= document.getElementById('referencia').value;
	var _nom_comuni		= document.getElementById('nom_comuni').value;
	var _telf_comuni	= document.getElementById('telf_comuni').value;
	var _email_comuni	= document.getElementById('email_comuni').value;
	var _documento		= document.getElementById('documento').value;
	var _id_respon		= document.getElementById('id_respon').value;
	var _des_respon		= document.getElementById('des_respon').value;
	var _doc_presen		= document.getElementById('doc_presen').value;
	var _fec_ofre		= document.getElementById('fec_ofre').value;
	var _hora_ofre		= document.getElementById('hora_ofre').value;
	
	/*var _num_crono = document.getElementById('num_cronoG').value;
	var _fecha_crono = document.getElementById('fecha_cronoG').value;
	var _num_formu = document.getElementById('num_formuG').value;
	var _lugar_formu = document.getElementById('lugar_formuG').value;
	var _observacion = document.getElementById('observacionG').value;*/
	
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/EditIngPoderes.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Actualizado satisfactoriamente</center></div>";
			
			//alert('Se guardo Poder satisfactoriamente');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("num_kardex="+_num_kardex+"&nom_recep="+_nom_recep+"&hora_recep="+_hora_recep+"&id_asunto="+_id_asunto+"&fec_ingreso="+_fec_ingreso+"&referencia="+_referencia+"&nom_comuni="+_nom_comuni+"&telf_comuni="+_telf_comuni+"&email_comuni="+_email_comuni+"&documento="+_documento+"&id_respon="+_id_respon+"&des_respon="+_des_respon+"&doc_presen="+_doc_presen+"&fec_ofre="+_fec_ofre+"&hora_ofre="+_hora_ofre+"&id_poder="+_id_poder);

}
// #============================================================================================================


//##################################################
// GUARDA DATOS DE REGISTRO - PENSION  PARA UN PODER

function fsavePoderPensiones()
{	
	var _id_poder  	    = document.getElementById('id_poder').value;
	var _p_crono        = document.getElementById('p_crono').value;
	var	_p_fecha		= document.getElementById('p_fecha').value;
	var _p_numformu		= document.getElementById('p_numformu').value;
	var _p_domicilio	= document.getElementById('p_domicilio').value;
	var _p_pension		= document.getElementById('p_pension').value;
	var _p_mespension   = document.getElementById('p_mespension').value;
	var _p_anopension	= document.getElementById('p_anopension').value;
	var _p_plazopoder	= document.getElementById('p_plazopoder').value;
	var _p_fecotor		= document.getElementById('p_fecotor').value;
	var _p_fecvcto		= document.getElementById('p_fecvcto').value;
	var _p_presauto		= document.getElementById('p_presauto').value;
	var _p_observ		= document.getElementById('p_observ').value;
	
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPensionPoderes.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo datos satisfactoriamente');
			//pasadatos();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&p_crono="+_p_crono+"&p_fecha="+_p_fecha+"&p_numformu="+_p_numformu+"&p_domicilio="+_p_domicilio+"&p_pension="+_p_pension+"&p_mespension="+_p_mespension+"&p_anopension="+_p_anopension+"&p_plazopoder="+_p_plazopoder+"&p_fecotor="+_p_fecotor+"&p_fecvcto="+_p_fecvcto+"&p_presauto="+_p_presauto+"&p_observ="+_p_observ);

}

//#############################################################
// GUARDA DATOS DE REGISTRO - PRESTACIONES ECONOMICAS - ESSALUD.

function fsavePoderEssalud()
{	
	var _id_poder  	    = document.getElementById('id_poder').value;
	var _e_crono        = document.getElementById('e_crono').value;
	var	_e_fecha		= document.getElementById('e_fecha').value;
	var _e_numformu		= document.getElementById('e_numformu').value;
	var _e_domicilio	= document.getElementById('e_domicilio').value;
	var _e_montosep		= document.getElementById('e_montosep').value;
	var _e_montomater   = document.getElementById('e_montomater').value;
	var _e_montolact	= document.getElementById('e_montolact').value;
	var _e_montototal	= document.getElementById('e_montototal').value;
	var _e_plazopoder	= document.getElementById('e_plazopoder').value;
	var _e_fecotor		= document.getElementById('e_fecotor').value;
	var _e_fecvcto		= document.getElementById('e_fecvcto').value;
	var _e_presauto		= document.getElementById('e_presauto').value;
	var _e_monto		= document.getElementById('e_monto').value;
	
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaEssaludPoderes.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo datos satisfactoriamente');
			pasadatos();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&e_crono="+_e_crono+"&e_fecha="+_e_fecha+"&e_numformu="+_e_numformu+"&e_domicilio="+_e_domicilio+"&e_montosep="+_e_montosep+"&e_montomater="+_e_montomater+"&e_montolact="+_e_montolact+"&e_montototal="+_e_montototal+"&e_plazopoder="+_e_plazopoder+"&e_fecotor="+_e_fecotor+"&e_fecvcto="+_e_fecvcto+"&e_presauto="+_e_presauto+"&e_monto="+_e_monto);

}


//#############################################################
// GUARDA DATOS DE REGISTRO - PODER FUERA DE REGISTRO

function fsavePoderFRegistro()
{	
	var _id_poder  	    = document.getElementById('id_poder').value;
	var _f_crono        = document.getElementById('f_crono').value;
	var	_f_fecha		= document.getElementById('f_fecha').value;
	var _f_numformu		= document.getElementById('f_numformu').value;
	var _id_tipo    	= document.getElementById('id_tipo').value;
	
	var _f_plazopoder	= document.getElementById('f_plazopoder').value;
	var _f_fecotor		= document.getElementById('f_fecotor').value;
	var _f_fecvcto		= document.getElementById('f_fecvcto').value;
	var _f_presauto		= document.getElementById('f_presauto').value;
	var _f_observ		= document.getElementById('f_observ').value;
	var _f_solicita		= document.getElementById('f_solicita').value;
	
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPoderFRegistro.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo datos satisfactoriamente');
			//pasadatos();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&f_crono="+_f_crono+"&f_fecha="+_f_fecha+"&f_numformu="+_f_numformu+"&id_tipo="+_id_tipo+"&f_plazopoder="+_f_plazopoder+"&f_fecotor="+_f_fecotor+"&f_fecvcto="+_f_fecvcto+"&f_presauto="+_f_presauto+"&f_observ="+_f_observ+"&f_solicita="+_f_solicita);

}


//##################################################
// GUARDA DATOS DE NUEVOS CONTRATANTES - PODERES.
function fAddContratantesPoder()
{	
	var _id_poder       = document.getElementById('id_poder').value;
	var _c_codcontrat   = document.getElementById('c_codcontrat').value;
	var _c_descontrat   = document.getElementById('c_descontrat').value;
	var _c_fircontrat   = document.getElementById('c_fircontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPoderCont.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderes2();					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat);

}


//##################################################
// GUARDA DATOS EDITADOS DE CONTRATANTES - PODERES.
function fEditContratantesPoder()
{	
	var _id_poder       = document.getElementById('id_poder').value;
	var _id_contrata    = document.getElementById('id_contrata').value;
	var _c_codcontrat   = document.getElementById('c_codcontrat').value;
	var _c_descontrat   = document.getElementById('nc_descontrat').value;
	var _c_fircontrat   = document.getElementById('c_fircontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/EditPoderCont.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderesEdit();					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat+"&id_contrata="+_id_contrata);

}


//##################################################
// #== MUESTRA LISTADO - NUEVO CONTRATANTE - PODERES.
function mostrarlistPoderes2()
{
	var divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	
	var _id_poder = document.getElementById('id_poder').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST","PoderContratantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder)
}

//##################################################
// #== MUESTRA LISTADO EDITADOS - NUEVO CONTRATANTE - PODERES. 
function mostrarlistPoderesEdit()
{
	divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	
	_id_poder = document.getElementById('id_poder').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST","PoderContratantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			fcerrardivedicion4();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder)
}

// #== ELIMINA CONTRATANTE -  PODERES
function felimContratante(_id_poder, _id_contrata)
{

	ajax=objetoAjax();

	ajax.open("POST", "../model/elimpcontratante.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino satisfactoriamente');	
			mostrarlistPContratantesElim();		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&id_contrata="+_id_contrata);	
}

//// #== MUESTRA LISTADO DE CONTRATANTES LUEGO DE ELIMINAR ALGUNO
function mostrarlistPContratantesElim()
{
	divResultado = document.getElementById('div_pcontratantes');
	divResultado.innerHTML= '<img src="../../loading.gif">';
	
	_id_poder = document.getElementById('id_poder').value;
	
	ajax=objetoAjax();
	
	ajax.open("POST","PoderContratantes.php",true);
	ajax.onreadystatechange=function() {
		if ((ajax.readyState==4 && ajax.status==200)) {
			divResultado.innerHTML = ajax.responseText;
			//fcerrardivedicion4();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_poder="+_id_poder)
}



// #== PERMISO VIAJES  -- BUSQUEDA DE PARTICIPANTES V. 1.1
function buscarcliente()
{
	var divResultado = document.getElementById('datos');
	var _tipoper     = document.getElementById('tipoper').value;
	var _numdoc      = document.getElementById('numdoc').value ;
	var tipodoc		 = document.getElementById('idtipdoc').value ;
	
	ajax=objetoAjax();

	ajax.open("POST","../model/buscacliedniruclib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+_tipoper+"&numdoc="+_numdoc+"&tipodoc="+tipodoc);
	
}

// #= PERMISO VIAJE  -  GUARDA DATOS DE NUEVOS PARTICIPANTES V. 1.1
function fAddCondiciones2()
{	
	var _id_viaje       = document.getElementById('id_viaje').value;
	var _c_codcontrat   = document.getElementById('docum').value;
	if(document.getElementById('napepat2'))
				{
	var _c_descontrat   = document.getElementById('apepat2').value+' '+document.getElementById('apemat2').value+' '+document.getElementById('prinom2').value+' '+document.getElementById('segnom').value;
				}
				else {
					var _c_descontrat   = document.getElementById('apepat2').value+' '+document.getElementById('apemat2').value+' '+document.getElementById('prinom2').value+' '+document.getElementById('segnom').value;
					}
	

	var _c_fircontrat   = document.getElementById('c_fircontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	
	// para menor:
	var _edad		= document.getElementById('edad_menor').value;
	var _condi_edad = document.getElementById('condi_edad').value;
	
	// PARA TESTIGO :
	if(document.getElementById('codi_testigo'))
	{var _codi_testigo     = document.getElementById('codi_testigo').value;}
	else {var _codi_testigo     = "";}
	
	if(document.getElementById('codi_tiptestigo'))
	{var _codi_tiptestigo  = document.getElementById('codi_tiptestigo').value;}
	else {var _codi_tiptestigo  = "";}
	
	// PARA APODERADO :
	//if(document.getElementById('codi_apoderado'))
	//{ var _codi_apoderado = document.getElementById('codi_apoderado').value; }
	//else { var _codi_apoderado = ""; }
	
	// EVALUA LOS CAMPOS DEL DIV REPRESENTACIÓN
	
	// chk_ambos
	var _codi_apoderado  = "";
	
	if(document.getElementById('chk_ambos'))
	{
		var _chk_ambos = document.getElementById('chk_ambos').checked;
		if (_chk_ambos == true)
				{
					if(document.getElementById('codi_apoderado'))
					{var _codi_apoderado  = "AMBOS";}
					else {var _codi_apoderado  = "";}
				}
				else {
						if(document.getElementById('codi_apoderado'))
						{var _codi_apoderado  = document.getElementById('codi_apoderado').value;}
						else {var _codi_apoderado  = "";}
					 }
	}//chk_ambos

	if(document.getElementById('partida_numero'))
	{var _partida_numero  = document.getElementById('partida_numero').value;}
	else {var _partida_numero  = "";}
	
	if(document.getElementById('sede_registral_a'))
	{var _sede_registral_a  = document.getElementById('sede_registral_a').value;}
	else {var _sede_registral_a  = "";}	
	
	
	ajax = objetoAjax();

	ajax.open("POST", "../model/guardaViajePartic.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistParticipantes2();
			$('#div_newpartic').dialog("destroy").remove();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_viaje="+_id_viaje+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat+"&edad="+_edad+"&condi_edad="+_condi_edad+"&codi_testigo="+_codi_testigo+"&codi_tiptestigo="+_codi_tiptestigo+"&codi_apoderado="+_codi_apoderado+"&partida_numero="+_partida_numero+"&sede_registral_a="+_sede_registral_a);

}

//  #== PERMISO VIAJE --  FUNCION AGREGA NUEVO CLIENTE
function grabarcliente()
{
	apepaterno();
	apematerno();
	prinombre();
	segnombre();
	direcction();
	grabarclienteresult();

}
function grabarclienteresult()
{
	var divResultado = document.getElementById('datos');

	var _idtipdoc = document.getElementById('idtipdoc').value;
	var tipoper=document.getElementById('tipoper').value;
	var numdoc=document.getElementById('numdoc').value;
	var apepat=document.getElementById('apepat').value;
	var apemat=document.getElementById('apemat').value;
	var prinom=document.getElementById('prinom').value;
	var segnom=document.getElementById('segnom').value;
	var direccion=document.getElementById('direccion').value;
	var email=document.getElementById('email').value;
	var telfijo=document.getElementById('telfijo').value;
	var telcel=document.getElementById('telcel').value;
	var telofi=document.getElementById('telofi').value;
	var sexo=document.getElementById('sexo').value;
	var idestcivil=document.getElementById('idestcivil').value;
	var nacionalidad=document.getElementById('nacionalidad').value;
	var idprofesion=document.getElementById('idprofesion').value;
	var idcargoo=document.getElementById('idcargoo').value;
	var cumpclie=document.getElementById('cumpclie').value;
	var natper=document.getElementById('natper').value;
	var codubisc=document.getElementById('codubisc').value;
	var nomprofesiones=document.getElementById('nomprofesiones').value;
	var nomcargoss=document.getElementById('nomcargoss').value;
	var ubigensc=document.getElementById('ubigensc').value;
	var residente=document.getElementById('residente').value;
	var docpaisemi=document.getElementById('docpaisemi').value;
	var cconyuge = document.getElementById('cconyuge').value;
	var idprofesion = document.getElementById('idprofesion').value;
	var detprofesion = document.getElementById('nomprofesiones').value;
	 
	ajax = objetoAjax();

	ajax.open("POST","../model/grabar_clientelib.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi+"&idtipdoc="+_idtipdoc+"&cconyuge="+cconyuge+"&idprofesion="+idprofesion+"&detprofesion="+detprofesion);
	
	


}


// #== PERMISO VIAJE -- FUNCION AGREGAR UBIGEO
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


function buscaubigeosc2()
{ 	divResultado = document.getElementById('resulubisc');
	buscaubisc=document.getElementById('buscaubisc2').value;
		
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


// #== INGRESO PODERES  -- BUSQUEDA DE PARTICIPANTES V. 1.1
function buscarcliente2()
{
	var divResultado = document.getElementById('datos');
	var _tipoper     = document.getElementById('tipoper').value;
	var _numdoc      = document.getElementById('numdoc').value ;
	var _tip_poder   = document.getElementById('id_tippoder').value ;
	var idtipdoc	 = document.getElementById('idtipdoc').value ;
	
	ajax=objetoAjax();

	ajax.open("POST","../model/buscacliedniruclib2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+_tipoper+"&numdoc="+_numdoc+"&tip_poder="+_tip_poder+"&idtipdoc="+idtipdoc);
	
}


// #=================================================== // #===================================================
// #=================================================== // #===================================================

// GUARDA DATOS DE NUEVOS CONTRATANTES - PODERES.
/*function fAddContratantesPoder()
{	
	var _id_poder       = document.getElementById('id_poder').value;
	var _c_codcontrat   = document.getElementById('c_codcontrat').value;
	var _c_descontrat   = document.getElementById('c_descontrat').value;
	var _c_fircontrat   = document.getElementById('c_fircontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPoderCont.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderes2();					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat);

}*/
// #=================================================== // #===================================================
// #=================================================== // #===================================================



// #= INGRESO PODERES  -  GUARDA DATOS DE NUEVOS PARTICIPANTES V. 1.1

function fAddCondiciones3()
{	
	var _id_poder       = document.getElementById('id_poder').value;
	var _c_codcontrat   = document.getElementById('docum').value;
	if(document.getElementById('napepat1'))
				{
					var _c_descontrat   = document.getElementById('apepat1').value+' '+document.getElementById('apemat1').value+' '+document.getElementById('prinom1').value +' '+document.getElementById('segnom').value;
				}
				else {
					var _c_descontrat   = document.getElementById('apepat2').value+' '+document.getElementById('napemat22').value+' '+document.getElementById('prinom2').value +' '+document.getElementById('segnom').value;
					}
	
	var _c_fircontrat   = document.getElementById('c_fircontrat').value;
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	

	var _codi_asegurado = document.getElementById('codi_asegurado').value;

	if(document.getElementById('codi_testigo'))
	{var _codi_testigo = document.getElementById('codi_testigo').value;}
	 else {var _codi_testigo = "";}
	
	if(document.getElementById('codi_tiptestigo'))
	{var _codi_tiptestigo = document.getElementById('codi_tiptestigo').value;}
	 else {var _codi_tiptestigo = "";}
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPoderCont.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderes2();	
			$('#div_newcontra').dialog("destroy").remove();
			
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat+"&codi_asegurado="+_codi_asegurado+"&codi_testigo="+_codi_testigo+"&codi_tiptestigo="+_codi_tiptestigo);

}

// #= INGRESO PODERES -- GRABAR CLIENTE 
function grabarcliente2()
{
	var divResultado = document.getElementById('datos');
	var _idtipdoc    = document.getElementById('idtipdoc').value;
	var tipoper      = document.getElementById('tipoper').value;
	var numdoc       = document.getElementById('numdoc').value;
	var apepat       = document.getElementById('apepat').value;
	var apemat       = document.getElementById('apemat').value;
	var prinom       = document.getElementById('prinom').value;
	var segnom 		 = document.getElementById('segnom').value;
	var direccion	 = document.getElementById('direccion').value;
	var email=document.getElementById('email').value;
	var telfijo=document.getElementById('telfijo').value;
	var telcel=document.getElementById('telcel').value;
	var telofi=document.getElementById('telofi').value;
	var sexo=document.getElementById('sexo').value;
	var idestcivil=document.getElementById('idestcivil').value;
	var nacionalidad=document.getElementById('nacionalidad').value;
	var idcargoo=document.getElementById('idcargoo').value;
	var cumpclie=document.getElementById('cumpclie').value;
	var natper=document.getElementById('natper').value;
	var codubisc=document.getElementById('codubisc').value;
	var nomcargoss=document.getElementById('nomcargoss').value;
	var ubigensc=document.getElementById('ubigensc').value;
	var residente=document.getElementById('residente').value;
	var docpaisemi=document.getElementById('docpaisemi').value;
	var cconyuge = document.getElementById('cconyuge').value;
	var idprofesion=document.getElementById('idprofesion').value;
	var nomprofesiones=document.getElementById('nomprofesiones').value;

	ajax=objetoAjax();

	ajax.open("POST","../model/grabar_clientelib2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi+"&cconyuge="+cconyuge+"&idtipdoc="+_idtipdoc);


}

// #=========================================================
// #== CARTAS NOTARIALES  -- BUSQUEDA DE PARTICIPANTES V. 1.1
function buscarclienteCar()
{
	var divResultado = document.getElementById('datos');
	var _tipoper = document.getElementById('tipoper').value;
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


//  #== CARTAS NOTARIAL --  FUNCION AGREGA NUEVO CLIENTE
function grabarclienteCar()
{
	divResultado = document.getElementById('datos');

	var tipoper   = document.getElementById('tipoper').value;
	var numdoc    = document.getElementById('numdoc2').value;
	var apepat    = document.getElementById('apepat').value;
	var apemat    = document.getElementById('apemat').value;
	var prinom    = document.getElementById('prinom').value;
	var segnom    = document.getElementById('segnom').value;
	var direccion = document.getElementById('direccion').value;
	var email     = document.getElementById('email').value;
	var telfijo   = document.getElementById('telfijo').value;
	var telcel    = document.getElementById('telcel').value;
	var telofi    = document.getElementById('telofi').value;
	var sexo      = document.getElementById('sexo').value;
	var idestcivil   = document.getElementById('idestcivil').value;
	var nacionalidad = document.getElementById('nacionalidad').value;
	var idprofesion  = document.getElementById('idprofesion').value;
	var idcargoo     = document.getElementById('idcargoo').value;
	var cumpclie     = document.getElementById('cumpclie').value;
	var natper       = document.getElementById('natper').value;
	var codubisc     = document.getElementById('codubisc').value;
	var nomprofesiones = document.getElementById('nomprofesiones').value;
	var nomcargoss   = document.getElementById('nomcargoss').value;
	var ubigensc     = document.getElementById('ubigensc').value;
	var residente    = document.getElementById('residente').value;
	var docpaisemi   = document.getElementById('docpaisemi').value;


	var ajax = objetoAjax();

	ajax.open("POST","../model/grabar_clientelibCar.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&apepat="+apepat+"&apemat="+apemat+"&prinom="+prinom+"&segnom="+segnom+"&direccion="+direccion+"&email="+email+"&telfijo="+telfijo+"&telcel="+telcel+"&telofi="+telofi+"&sexo="+sexo+"&idestcivil="+idestcivil+"&nacionalidad="+nacionalidad+"&idprofesion="+idprofesion+"&idcargoo="+idcargoo+"&cumpclie="+cumpclie+"&natper="+natper+"&codubisc="+codubisc+"&nomprofesiones="+nomprofesiones+"&nomcargoss="+nomcargoss+"&ubigensc="+ubigensc+"&residente="+residente+"&docpaisemi="+docpaisemi);


}

/// ##########################################
// ####################### CONYUGES
// ####################### CONYUGES
// ####################### CONYUGES
function buscaclientes2()
{
	divResultado = document.getElementById('nuevaconyuge');
	var numdoc2 = document.getElementById('numdoc2').value;
	var tipdoc_conyuge = document.getElementById('tipdoc_conyuge').value;
	
	ajax=objetoAjax();

	ajax.open("POST","buscadni.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&numdoc2="+numdoc2+"&tipdoc_conyuge="+tipdoc_conyuge)
}
/// ##########################################
/// ##########################################
function grabarcliente4()
{
	//donde se mostrará el resultado
	var divResultado = document.getElementById('casado');
	//tomamos el valor de la lista desplegable
	var tipoper       = document.getElementById('tipoper').value;
	var tipodoc 	  = "1";//document.getElementById('tipodoc').value; 
	var numdoc2 	  = document.getElementById('numdoc2').value;  
	var apepat4 	  = document.getElementById('apepat4').value; 
	var apemat4 	  = document.getElementById('apemat4').value; 
	var prinom4 	  = document.getElementById('prinom4').value; 
	var segnom4 	  = document.getElementById('segnom4').value; 
	var direccion4    = document.getElementById('direccion4').value;  
	var sexo4         = document.getElementById('sexo4').value;   
	var idestcivil4   = document.getElementById('idestcivil4').value;  
	var nacionalidad4 = document.getElementById('nacionalidad4').value;  
	var idprofesion4  = document.getElementById('idprofesion4').value; 
	var idcargoo4     = "";//document.getElementById('idcargoo4').value;  
	var cumpclie4     = document.getElementById('cumpclie4').value;  
	var natper4       = document.getElementById('natper4').value;  
	var codubisc4     = document.getElementById('codubisc4').value;  
	var ubigensc4     = document.getElementById('ubigensc4').value;   
	var residente4    = document.getElementById('residente4').value;   
	var codclie4      = document.getElementById('codclie4').value;   
	var _nomprofesiones = document.getElementById('nomprofesiones4').value;
	
	ajax=objetoAjax();

	ajax.open("POST","../model/grabar_cliente4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc2="+numdoc2+"&apepat4="+apepat4+"&apemat4="+apemat4+"&prinom4="+prinom4+"&segnom4="+segnom4+"&direccion4="+direccion4+"&sexo4="+sexo4+"&idestcivil4="+idestcivil4+"&nacionalidad4="+nacionalidad4+"&idprofesio4n="+idprofesion4+"&idcargoo4="+idcargoo4+"&cumpclie4="+cumpclie4+"&natper4="+natper4+"&codubisc4="+codubisc4+"&ubigensc4="+ubigensc4+"&residente4="+residente4+"&codclie4="+codclie4+"&nomprofesiones="+_nomprofesiones)
	
}

/// ##########################################


//################################################################################################################
// ########################################## CAMBIO DE CARACTERISTICAS ##########################################
//################################################################################################################


//GUARDA DATOS DE CAMBIO DE CARACTERISTICAS.
//#########################################
function fguardaCambio()
{	
	divResultado = document.getElementById('resul_cambio');
	
	divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
    var _id_cambio      = document.getElementById('id_cambio').value;
	var _num_crono      = document.getElementById('num_crono').value;
	var _fec_ingreso    = document.getElementById('fec_ingreso').value;
	var _num_formu      = document.getElementById('num_formu').value;
	var _nombre         = document.getElementById('nombre').value;
	var _tipdoc 	    = document.getElementById('tipdoc').value;
	var _num_docu 	    = document.getElementById('num_docu').value;
	var _direccion      = document.getElementById('direccion').value;
	var _ecivil         = document.getElementById('ecivil').value;
	var _c_nombre 	    = document.getElementById('c_nombre').value;
	var _c_tipdoc 	    = document.getElementById('c_tipdoc').value;
	var _c_numdoc 	    = document.getElementById('c_numdoc').value;
	var _representacion = document.getElementById('representacion').value;
	var _poder_inscrito = document.getElementById('poder_inscrito').value;
	var _int_legitimo 	= document.getElementById('int_legitimo').value;
	
	var _observacion 	= document.getElementById('observacion').value;
		
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaCambioCarac.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Carta satisfactoriamente');
			divResultado.innerHTML = ajax.responseText;
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Guardado satisfactoriamente</center></div>";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&num_crono="+_num_crono+"&fec_ingreso="+_fec_ingreso+"&num_formu="+_num_formu+"&nombre="+_nombre+"&tipdoc="+_tipdoc+"&num_docu="+_num_docu+"&direccion="+_direccion+"&ecivil="+_ecivil+"&c_nombre="+_c_nombre+"&c_tipdoc="+_c_tipdoc+"&c_numdoc="+_c_numdoc+"&representacion="+_representacion+"&poder_inscrito="+_poder_inscrito+"&int_legitimo="+_int_legitimo+"&observacion="+_observacion);

}


//GUARDA DATOS DE DETALLE DE CAMBIO DE CARACTERISTICAS.
//####################################################
function fPassData()
{	
	var _id_cambio      = document.getElementById('id_cambio').value;
	var _detalle        = document.getElementById('detalle_cambios').value;

	divResultado = document.getElementById('div_muesresul');
	
	divResultado2 = document.getElementById('div_cambiocar');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaDetCCarac.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Carta satisfactoriamente');
			divResultado.innerHTML = ajax.responseText;
			fPassData2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&detalle="+_detalle);
}

//ACTUALIZA DETALLE DE CAMBIO DE CARACTERISTICAS.
//####################################################

function fupdateCarac(_id_dato,_descripcion)
{
	
	var _id_cambio      = document.getElementById('id_cambio').value;

	divResultado = document.getElementById('div_cambiocar');
	
	//divResultado2 = document.getElementById('div_cambiocar');
	//divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/UpdateDetCCarac.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//fPassData2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&id_dato="+_id_dato+"&descripcion="+_descripcion);
		
}


//ELIMINA DATOS DE DETALLE DE CAMBIO DE CARACTERISTICAS.
//####################################################
function fElimData()
{	
	var _id_cambio      = document.getElementById('id_cambio').value;
	var _detalle        = document.getElementById('detalle_cambios').value;

	divResultado = document.getElementById('div_cambiocar');
	
	divResultado2 = document.getElementById('div_cambiocar');
	divResultado2.innerHTML= '<center><img src="../../loading.gif"></center>';
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/ElimDetCCarac.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			//alert('Se guardo Carta satisfactoriamente');
			//divResultado.innerHTML = ajax.responseText;
			fElimData2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&detalle="+_detalle);
}


// #######################################################
// GUARDA DATOS DE NUEVA EMPRESA - EN CONTRATANTES PODERES
function grabarempresa()
{

	var divResultado  = document.getElementById('datos');
	
	var tipoper       = document.getElementById('tipoper').value;
	var numdoc		  = document.getElementById('numdoc').value;
	var razonsocial	  = document.getElementById('razonsocial').value;
	var domfiscal 	  = document.getElementById('domfiscal').value;
	var telempresa	  = document.getElementById('telempresa').value;
	var mailempresa	  = document.getElementById('mailempresa').value;
	var contacempresa = document.getElementById('contacempresa').value;
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
// #######################################################
// #######################################################

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


// #= INGRESO PODERES  -  GUARDA DATOS DE NUEVOS PARTICIPANTES RUC

function faddCondicionesRUC()
{	
	var _id_poder       = document.getElementById('id_poder').value;
	
	var _c_codcontrat   = document.getElementById('numdoc').value;
	var _c_descontrat   = document.getElementById('apepat').value;
	
	var _c_fircontrat   = "NO";
	var _c_condicontrat = document.getElementById('c_condicontrat').value;
	//var _codi_asegurado = document.getElementById('codi_asegurado').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/guardaPoderRuc.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			mostrarlistPoderes2();	
			$('#div_newcontra').dialog("destroy").remove();	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder+"&c_codcontrat="+_c_codcontrat+"&c_descontrat="+_c_descontrat+"&c_fircontrat="+_c_fircontrat+"&c_condicontrat="+_c_condicontrat);

}


// #######################################################
// GUARDA DATOS DE NUEVA EMPRESA - EN CARTAS
function grabarempresa_Cartas()
{

	var divResultado  = document.getElementById('datos');
	
	var tipoper       = document.getElementById('tipoper').value;
	var numdoc		  = document.getElementById('numdoc2').value;
	var razonsocial	  = document.getElementById('razonsocial').value;
	var domfiscal 	  = document.getElementById('domfiscal').value;
	var telempresa	  = document.getElementById('telempresa').value;
	var mailempresa	  = document.getElementById('mailempresa').value;
	var contacempresa = document.getElementById('contacempresa').value;
	var fechaconstitu = document.getElementById('fechaconstitu').value;
	var numregistro	  = document.getElementById('numregistro').value;
	var numpartida	  = document.getElementById('numpartida').value;
	var actmunicipal  = document.getElementById('actmunicipal').value;
	var codubi		  = document.getElementById('codubi').value;
	var idsedereg3	  = document.getElementById('idsedereg3').value;
	
	ajax=objetoAjax();

	ajax.open("POST","../model/grabar_empresalibcar.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipoper="+tipoper+"&numdoc="+numdoc+"&razonsocial="+razonsocial+"&domfiscal="+domfiscal+"&telempresa="+telempresa+"&mailempresa="+mailempresa+"&contacempresa="+contacempresa+"&fechaconstitu="+fechaconstitu+"&numregistro="+numregistro+"&numpartida="+numpartida+"&actmunicipal="+actmunicipal+"&codubi="+codubi+"&idsedereg3="+idsedereg3)
	
}
// #######################################################
// #######################################################


// VIAJES
// # =====================================================================================
function fNocorreAction()
{	
	
	var divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML = '<center><img src="../../loading.gif"></center>';
	
	var _id_viaje = document.getElementById('id_viaje').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/evalNoCorre.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Se cambio el Estado a: NO CORRE</center></div>";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_viaje="+_id_viaje);

}
// # =====================================================================================


// PODERES
// # =====================================================================================
function fNocorreActionPoder()
{	
	
	var divResultado2 = document.getElementById('confirmaGuarda');
	divResultado2.innerHTML = '<center><img src="../../loading.gif"></center>';
	
	var _id_poder = document.getElementById('id_poder').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/evalNoCorrePoder.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado2.innerHTML = "<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Se cambio el Estado a: NO CORRE</center></div>";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_poder="+_id_poder);

}
// # =====================================================================================

// Graba el nuevo conyuge en Viaje Contratantes:
function grabarConyuge2()
{
	//donde se mostrará el resultado
	var divResultado = document.getElementById('casado');
	//tomamos el valor de la lista desplegable
	var tipoper			= document.getElementById('tipoper').value; 
	var tipodoc			= "1";//document.getElementById('tipodoc').value;  
	var numdoc2			= document.getElementById('numdoc2').value;  
	var apepat2			= document.getElementById('apepat2').value;
	var apemat2			= document.getElementById('apemat2').value; 
	var prinom2			= document.getElementById('prinom2').value; 
	var segnom2			= document.getElementById('segnom2').value; 
	var direccion2		= document.getElementById('direccion2').value; 
	var email2			= "";//document.getElementById('email2').value; 
	var telfijo2		= ""//document.getElementById('telfijo2').value; 
	var telcel2			= ""//document.getElementById('telcel2').value;
	var telofi2			= ""//document.getElementById('telofi2').value; 
	var sexo2			= document.getElementById('sexo2').value; 
	var idestcivil2		= document.getElementById('idestcivil2').value; 
	var nacionalidad2	= document.getElementById('nacionalidad2').value; 
	var idprofesion2	= document.getElementById('idprofesion2').value; 
	var idcargoo2		= "";//document.getElementById('idcargoo2').value;
	var cumpclie2		= document.getElementById('cumpclie2').value; 
	var natper2			= document.getElementById('natper2').value; 
	var codubisc2		= document.getElementById('codubis2').value;
	var _nomprofesiones2	= document.getElementById('nomprofesiones2').value; 
	var nomcargoss2		= "";//document.getElementById('nomcargoss2').value; 
	var ubigensc2		= document.getElementById('ubigensc2').value;
	var residente2		= document.getElementById('residente2').value; 
	var docpaisemi2		= "";//document.getElementById('docpaisemi2').value; 

	ajax=objetoAjax();
	ajax.open("POST","../model/grabar_conyuge2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipoper="+tipoper+"&tipodoc="+tipodoc+"&numdoc2="+numdoc2+"&apepat2="+apepat2+"&apemat2="+apemat2+"&prinom2="+prinom2+"&segnom2="+segnom2+"&direccion2="+direccion2+"&email2="+email2+"&telfijo2="+telfijo2+"&telcel2="+telcel2+"&telofi2="+telofi2+"&sexo2="+sexo2+"&idestcivil2="+idestcivil2+"&nacionalidad2="+nacionalidad2+"&idprofesio2n="+idprofesion2+"&idcargoo2="+idcargoo2+"&cumpclie2="+cumpclie2+"&natper2="+natper2+"&codubisc2="+codubisc2+"&nomprofesiones2="+nomprofesiones2+"&nomcargoss2="+nomcargoss2+"&ubigensc2="+ubigensc2+"&residente2="+residente2+"&docpaisemi2="+docpaisemi2+"&idprofesion="+idprofesion2+"&nomprofesiones="+_nomprofesiones2)
	
}

//// UBIGEO DIV CONYUGE - PERMISOS DE VIAJE

function buscaubigeossc2()
{ 	
	var divResultado = document.getElementById('resulubisc2');
	var buscaubisc2  = document.getElementById('buscaubisc2').value  
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscarubigeosc2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc2="+buscaubisc2)
}


///// UBIGEO DIV CONYUGE - EXISTE Y CONSULTA - PERMISOS DE VIAJE
function buscaubigeossc4()
{ 	
	var divResultado = document.getElementById('resulubisc4');
	var buscaubisc4  = document.getElementById('buscaubisc4').value;
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscarubigeosc4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc4="+buscaubisc4)
}


	
	
function editarsolicitante(_id_cambio, _id_solicitante)
	{
		var divobs = $('<div id="div_editsoli" title="div_editsoli"></div>');
		
		$('<div id="div_editsoli" title="div_editsoli"></div>').load('EditSolicitante.php?id_cambio='+_id_cambio+'&id_solicitante='+_id_solicitante)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 800,
						height  : 300,
						modal:false,
						resizable:false,
						buttons: [{id: "editPartic", text: "Aceptar",click: function() {evaleditSolicitante();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Editar participantes'
						
						}).width(800).height(300);	
						$(".ui-dialog-titlebar").hide();
		
	}
function editarsolicitante2(_id_cambio, _id_solicitante)
	{
		var divobs = $('<div id="div_newtsoli" title="div_newtsoli"></div>');
		
		$('<div id="div_newtsoli" title="div_newtsoli"></div>').load('EditSolicitante1.php?id_cambio='+_id_cambio+'&id_solicitante='+_id_solicitante)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 800,
						height  : 300,
						modal:false,
						resizable:false,
						buttons: [{id: "editPartic", text: "Aceptar",click: function() {evaleditSolicitante2();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Editar participantes'
						
						}).width(800).height(300);	
						$(".ui-dialog-titlebar").hide();
		
	}
		
function evaleditSolicitante()
{
	
	editnnombre_solic();
	editndireccion_solic();
	editnrepresentacion_solic();
	evaleditSolicitanteresult();
	
	
}
function evaleditSolicitanteresult()
{
	
	var _id_cambio       = document.getElementById('id_cambio').value;
	var _id_solicitante  = document.getElementById('id_solicitante').value;
	var _nombre    	     = document.getElementById('nombre_soli').value;
	var _tipdoc 		 = document.getElementById('tipdoc_soli').value;
	var _num_docu	     = document.getElementById('num_docu_soli').value;
	var _direccion       = document.getElementById('direccion_soli').value;
	var _ecivil 	     = document.getElementById('ecivil_soli').value;
	var _representacion  = document.getElementById('representacion_soli').value;
	var _poder_inscrito  = document.getElementById('poder_inscrito_soli').value;
	var _int_legitimo    = document.getElementById('int_legitimo_soli').value;
	
	// NEW:
	var _distrito_solicitante  = document.getElementById('distrito_solic1').value;
	
	var _tipdoc_repedit = document.getElementById('tipdoc_repedit').value;
	
	var _numdocu_repedit = document.getElementById('numdocu_repedit').value;
	
	ajax = objetoAjax();

	ajax.open("POST", "../model/editSolicitante.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			Recargar();
				
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&id_solicitante="+_id_solicitante+"&nombre="+_nombre+"&tipdoc="+_tipdoc+"&num_docu="+_num_docu+"&direccion="+_direccion+"&ecivil="+_ecivil+"&representacion="+_representacion+"&poder_inscrito="+_poder_inscrito+"&int_legitimo="+_int_legitimo+"&distrito_solic="+_distrito_solicitante+"&tipdoc_repedit="+_tipdoc_repedit+"&numdocu_repedit="+_numdocu_repedit);
}
function evaleditSolicitante2()
{
	nuevonnombre_solic();
	nuevondireccion_solic();
	nuevorepresentacion_solic();
	evaleditSolicitante2result();
}
	
function evaleditSolicitante2result()
{
	var _id_cambio       = document.getElementById('id_cambio').value;
	var _id_solicitante  = document.getElementById('id_solicitante2').value;
	var _nombre    	     = document.getElementById('nombre_soli').value;
	var _tipdoc 		 = document.getElementById('tipdoc_soli').value;
	var _num_docu	     = document.getElementById('num_docu_soli').value;
	var _direccion       = document.getElementById('direccion_soli').value;
	var _ecivil 	     = document.getElementById('ecivil_soli').value;
	var _representacion  = document.getElementById('representacion_soli').value;
	var _poder_inscrito  = document.getElementById('poder_inscrito_soli').value;
	var _int_legitimo    = document.getElementById('int_legitimo_soli').value;
	var _distrito_solicitante  = document.getElementById('distrito_solic0').value;
		var _tipdoc_repedit = document.getElementById('tipdoc_repedit').value;
	
	var _numdocu_repedit = document.getElementById('numdocu_repedit').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editSolicitante2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			Recargar2();
				
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&id_solicitante="+_id_solicitante+"&nombre="+_nombre+"&tipdoc="+_tipdoc+"&num_docu="+_num_docu+"&direccion="+_direccion+"&ecivil="+_ecivil+"&representacion="+_representacion+"&poder_inscrito="+_poder_inscrito+"&int_legitimo="+_int_legitimo+"&distrito_solic0="+_distrito_solicitante+"&tipdoc_repedit="+_tipdoc_repedit+"&numdocu_repedit="+_numdocu_repedit);
}
	function ElimSolicitante(_id_cambio, _id_solicitante)
{	
	//var _id_viaje      = document.getElementById('id_viaje').value;
	if(confirm('Desea eliminar el contratante..?'))
		{ 
	ajax=objetoAjax();

	ajax.open("POST", "../model/ElimSolicitante.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se elimino el Solicitante');	
			Recargar();								
		}}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id_cambio="+_id_cambio+"&id_solicitante="+_id_solicitante);

}
	function Recargar()
	{
	var _id_cambio = document.getElementById('id_cambio').value;
	$('#llamaphp').load('list_cambios.php?id_cambio='+_id_cambio);
	}
	function Recargar2()
	{
	var _id_cambio = document.getElementById('id_cambio').value;
	$('#llamaphp').load('list_cambiosnew.php?id_cambio='+_id_cambio);
	}
	
function buscarclientedoble(id)
{
	var divResultado = document.getElementById('datos');
	var idclie     = id;
		
	ajax=objetoAjax();

	ajax.open("POST","../view/mostrarclientelibdoble.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idclie="+idclie);
	
}