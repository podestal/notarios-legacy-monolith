<?php 
session_start();

	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	$sqlrctm=mysql_query("SELECT * FROM tipodocumento",$conn) or die(mysql_error());
	$sqlrctm2=mysql_query("SELECT * FROM tipodocumento",$conn) or die(mysql_error());
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de cartas</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../includes/css/IngCartasVie.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/js/IngCartasVie.js"></script> 
<script type="text/javascript" src="ajaxcart.js"></script> 

<script type="text/javascript">

function tabulador (field, event) {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if (keyCode == 9) {
		var i;
		for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
				break;
		i = (i + 1) % field.form.elements.length;
		field.form.elements[i].focus();
		return false;
	} 
	else
	return true;
} 

function send(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13){
			
			
        buscar_cliente_car();} 
        } 
		
function send2(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13){
			
			
        buscar_cliente_car2();} 
        } 
		
function newclientempresa()
    {
	mostrar_desc('clientenew');
	
	}	
function newclient()
    {
	mostrar_desc('clientenewdni');
	
	}		

function validar(value){
	
	if(valor=='8'){
		document.getElementById('numdoc').maxLength="11";
		}
		
	if(valor=='1'){
		document.getElementById('numdoc').maxLength="8";
		}
		
	if(valor!='1' || valor!='8'){
		document.getElementById('numdoc').maxLength="15";
		}
	}
function validar2(value){
	
	if(valor=='8'){
		document.getElementById('numdoc2').maxLength="11";
		}
		
	if(valor=='1'){
		document.getElementById('numdoc2').maxLength="8";
		}
		
	if(valor!='1' || valor!='8'){
		document.getElementById('numdoc2').maxLength="15";
		}
	}
function cerrar(){
	ocultar_desc('clientenew');
	regresa_caja();

	}

function cerrar2(){
	ocultar_desc('clientenewdni')
	regresa_caja();
	}
	
function regresa_caja(){
	var divResultado = document.getElementById('rpta_bus');
	var _num_doc     = document.getElementById('numdoc').value;
	ajax=objetoAjax();

	ajax.open("POST", "clear_text_clie.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_num_doc="+_num_doc);
	
	}
	
	function regresa_caja2(){
	var divResultado = document.getElementById('rpta_bus2');
	var _num_doc     = document.getElementById('numdoc').value;
	ajax=objetoAjax();

	ajax.open("POST", "clear_text_clie2.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_num_doc="+_num_doc);
	
	}
	
	
	//para la zona de la carta
function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('idzona').value = name;  
  ocultar_desc('buscaubi');     
        
		
    }
	
//para empresa
function mostrarubigeoosc4(id,name)
    {
  document.getElementById('ubigen2').value = id;
  document.getElementById('codubi').value = name;  
  ocultar_desc('buscaubi2');     
        
		
    }	
		
	
	
	//para clientess
	function mostrarubigeoosc(id,name)
    {
  document.getElementById('ubigensc').value = id;
  document.getElementById('codubisc').value = name;  
  ocultar_desc('buscaubisc');     
        
		
		
		
    }
	
	

 
function ggclie1cartas()
 {
	
	   grabarcliente_car();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
	
	 }
	 
	function ggclie1cartas2()
 {
	
	   grabarcliente2_dom();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenew');
	
	 }

function apepaterno(){
	
 valord=document.getElementById('napepat').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apepat').value=textod;
}

function apematerno(){
 valord=document.getElementById('napemat').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apemat').value=textod;

}
function prinombre(){
 valord=document.getElementById('nprinom').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('prinom').value=textod;

}
function segnombre(){
 valord=document.getElementById('nsegnom').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('segnom').value=textod;

}
function direccion(){
 valord=document.getElementById('ndireccion').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion').value=textod;

}

function razonsociall(){
	
 valorra=document.getElementById('nrazonsocial').value;
 textor=valorra.replace(/&/g,"*");
 document.getElementById('razonsocial').value=textor;
	}
function domfiscall(){
	
valord=document.getElementById('ndomfiscal').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('domfiscal').value=textod;
	}	

	
$("#idzonax").live("click", function(){
				$("#_buscaubi").val("");
				$("#_buscaubi").focus();
				$("#resulubi").html("");
			 })



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

function buscaubigeos2()
{ 	var divResultado = document.getElementById('resulubi2');
	var __buscaubi   = document.getElementById('_buscaubi2').value;
		
	ajax=objetoAjax();
	ajax.open("POST","../model/buscarubigeosc4.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubi2="+__buscaubi);
}


function mostrar_desc(objac)
		{
		if(document.getElementById(objac).style.display=="none")
		document.getElementById(objac).style.display=""
		else
		document.getElementById(objac).style.display="";
		}
		

function ocultar_desc(objac2)
		{
		if(document.getElementById(objac2).style.display=="")
		document.getElementById(objac2).style.display="none";
		else
			document.getElementById(objac2).style.display="none";
		}

$(document).ready(function(){ 

	 $("button").button();
	 $("#dialog").dialog();
	 $("input, textarea").uniform();
	 $( "#dialog:ui-dialog" ).dialog( "destroy" );
	 
	})
	
	jQuery(function($){
		$("#fecentrega").mask("99/99/9999",{placeholder:"_"});
		$("#horaentrega").mask("99:99 aa",{placeholder:"_"});
		$("#fecrecogio").mask("99/99/9999",{placeholder:"_"});
		
	});
	
	function fEdita(){ feditaCarta(); }

	function fElimina()
	{
		var _numcarta = document.getElementById('numcarta').value;
		if(confirm('eliminar datos de la carta notarial N. '+_numcarta+' ?'))
		{	fElimCarta(); }	
		else{return;}
	}

	function fini(){	document.getElementById('idzona').value = '<?php echo $rowcarta['zona_destinatario']; ?>';	}


	function fmuescontenido()
	{
		var divobs = $('<div id="div_ayudacarta" title="div_ayudacarta"></div>');
		$('<div id="div_ayudacarta" title="div_ayudacarta"></div>').load('CartasAyuda.php')
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 550,
						height  : 250,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {pasadatos();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() { $(this).dialog("destroy").remove(); }}],
						title:'Ayuda Cartas'
						
						}).width(550).height(250);	
						$(".ui-dialog-titlebar").hide();		
	}

	function newParticipante()
	{
		$('<div id="div_newpartic" title="div_newpartic"></div>').load('NewRemitente.php')
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 720,
						height  : 350,
						modal:false,
						resizable:false,
						buttons: [{id: "btnAcepPartic2", text: "Aceptar",click: function() {evalGuardaParticipante();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Agregar participantes'
						
						}).width(720).height(350);	
						$(".ui-dialog-titlebar").hide();		
	}

	function fImprimir()
	{
		var _num_carta = document.getElementById('numcarta').value;
		
		
		if(_num_carta==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
		var _data = {
						num_carta       : _num_carta,
						usuario_imprime : _usuario_imprime,
						nom_notario     : _nom_notario
					}
		
		
		$.post("../../reportes_word/generador_cartas.php",_data,function(_respuesta){
						alert(_respuesta);
					});
			
	}


	function fImprimirqr()
	{

    var reply=confirm("IMPORTANTE \n ANTES DE GENERAR EL QR SE RECOMIENDA VERIFICAR QUE LA INFORMACIÓN INGRESADA EN EL INSTRUMENTO SEA LA CORRECTA, CREADO EL QR ESTE NO PODRÁ SER MODIFICADO.  \n  ¿Desea continuar?")
			if (reply==true) 
				{
		var _num_carta = document.getElementById('numcarta').value;
		
		
		if(_num_carta==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
		var _data = {
						num_carta       : _num_carta,
						usuario_imprime : _usuario_imprime,
						nom_notario     : _nom_notario
					}
		
		
	    	$.post("../../reportes_word/generador_cartasqr.php",_data,function(_respuesta){
						alert(_respuesta);
          });
        }
          else 
				{
					
					$( this ).dialog( "close" );
				}
	}


    function fShowDatosProvee(evento)
		{			
			var _numdoc		= document.getElementById('numdoc').value;
			var _remitente  = document.getElementById('remitente');
			var _direccion  = document.getElementById('direccion_remi');
			var _telefono   = document.getElementById('telefono');
			
			if(evento.keyCode==13) 
				{
					if(_numdoc==''){alert('Ingrese un numero de documento');return;}
					
					var _des = fShowAjaxDato('../includes/remitente.php?numdoc='+_numdoc);
					document.getElementById('remitente').value = _des;
					
					var _direcc = fShowAjaxDato('../includes/direccion.php?numdoc='+_numdoc);
					document.getElementById('direccion_remi').value=_direcc;
					
					var _telf = fShowAjaxDato('../includes/telefono.php?numdoc='+_numdoc);
					document.getElementById('telefono').value=_telf;
					
					if(_remitente.value==''){alert('No se encuentra registrado');
					
					$('#remitente').val('');
					$('#direccion_remi').val('');
					$('#telefono').val('');
					return; }
				}
		}


function fVisualDocument()
	{
		var eval_numcarta = document.getElementById('numcarta').value;
		
		if(eval_numcarta == ''){alert('Debe guardar los datos primero');return;}
		var _numcarta     = document.getElementById('muesnumcarta').value;
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_carta.php?numcarta="+_numcarta+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);
			
	}


	function fbuscanrocontrol(numero){
    if (!/^([0-9])*$/.test(numero))
      alert("El valor " + numero + " no es un número");

  }
  
  function buscanomparticipante(numero){
    if (!/^([0-9])*$/.test(numero))
      alert("El valor " + numero + " no es un número");

  } 
  
function IsNumeric(valor) 
{ 
var log=valor.length; var sw="S"; 
for (x=0; x<log; x++) 
{ v1=valor.substr(x,1); 
v2 = parseInt(v1); 
//Compruebo si es un valor numérico 
if (isNaN(v2)) { sw= "N";} 
} 
if (sw=="S") {return true;} else {return false; } 
} 
var primerslap=false; 
var segundoslap=false; 
function formateafecha(fecha) 
{ 
var long = fecha.length; 
var dia; 
var mes; 
var ano; 
if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2); 
if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; } 
else { fecha=""; primerslap=false;} 
} 
else 
{ dia=fecha.substr(0,1); 
if (IsNumeric(dia)==false) 
{fecha="";} 
if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; } 
} 
if ((long>=5) && (segundoslap==false)) 
{ mes=fecha.substr(3,2); 
if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true; } 
else { fecha=fecha.substr(0,3);; segundoslap=false;} 
} 
else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } } 
if (long>=7) 
{ ano=fecha.substr(6,4); 
if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); } 
else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } } 
} 
if (long>=10) 
{ 
fecha=fecha.substr(0,10); 
dia=fecha.substr(0,2); 
mes=fecha.substr(3,2); 
ano=fecha.substr(6,4); 
// Año no viciesto y es febrero y el dia es mayor a 28 
if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"/"; } 
} 
return (fecha); 
}
  
  
  function soloLetras(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-:/.";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     }
 
function soloLetrasynumeros(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " 0123456789áéíóúabcdefghijklmnñopqrstuvwxyz-:/.'&#°";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     }

function solonumeros(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 nume = " 0123456789";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(nume.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     }

function solonumerosysignos(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 nume = " 0123456789*+\-:/_,;.^()|$#%";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(nume.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     } 
 
 
 var nav4 = window.Event ? true : false;
function aceptNum(evt){
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key>= 48 && key <= 57));
}


/*no valida otros caracteres*/

var r={'special':/[\W]/g}
function valid(o,w){
o.value = o.value.replace(r[w],'');

}


function isNumberKey(evt)
     {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
           return true;
 
        return false;
     }


function validacion3() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([0-9\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.tel_comu.value) ) {
        alert('Caracter Incorrecto.')
        return false
    }
 
  
    return false           
}



function validacion4() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([A-Z\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.lugar_formuG.value) ) {
        alert('Caracter Incorrecto.')
        return false
    }
 
  
    return false           
}


function CheckTime(str)
{
hora=str.value
if (hora=='') {return}
if (hora.length>8) {alert("Introdujo una cadena mayor a 8 caracteres");return}
if (hora.length!=8) {alert("Introducir HH:MM:SS");return}
a=hora.charAt(0) //<=2
b=hora.charAt(1) //<4
c=hora.charAt(2) //:
d=hora.charAt(3) //<=5
e=hora.charAt(5) //:
f=hora.charAt(6) //<=5
if ((a==2 && b>3) || (a>2)) {alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23");return}
if (d>5) {alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59");return}
if (f>5) {alert("El valor que introdujo en los segundos no corresponde");return}


}

function remitente1(){
 valord=document.getElementById('remitente2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('remitente').value=textod5;

}
function direccion_remi2(){
 valord=document.getElementById('direccion_remi1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('direccion_remi').value=textod5;

}



function dirdestinatario1(){
 valord=document.getElementById('dirdestino2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('dirdestino').value=textod5;

}
function destinatario1(){
 valord=document.getElementById('destinatario2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('destinatario').value=textod5;

}
function actualizarContenido(){
    event.preventDefault()
    let contenidoCarta = document.getElementById('contecarta').value;
    console.log(contenidoCarta)

    let fechaFormateada = fecentrega.value.split('/').reverse().join('/');;

    var fecha = new Date(fechaFormateada);
    var options = { year: 'numeric', month: 'long', day: 'numeric' };

    
    let fechaLetras = fecha.toLocaleDateString("es-ES", options)
   
  
    let newContenidoCarta = contenidoCarta.replace('<F>',fechaLetras).replace('<F_N>',fecentrega.value).replace('<HORA>',horaentrega.value).replace('<DIRECCION>',dirdestino2.value).replace('<RECEPCION>',recepcion.value)
    
     contecarta.value=newContenidoCarta
  
}
</script>
<script src="../../js/consulta_reniec_sunat.js"></script>
<style>
div.dalib {
	background: #333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width: 760px;
	height: 299px;
	position: absolute;
	left: 494px;
	top: 121px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}


</style>
</head>

<body style="font-size:62.5%;">
<div id="carta_content">
<form name="frmbuscakardex" method="post" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="13%">
     <?php
				$oBarra->Graba        = "1"               ;
				$oBarra->GrabaClick   = "fGraba2();"      ;
				$oBarra->Impri        = "1"               ;
				$oBarra->ImpriClick   = "fImprimir();"    ;
				$oBarra->clase        = "css"      		  ; 
				$oBarra->widthtxt     = "20"			  ; 
				$oBarra->Show()  						  ; 
				?>
    </td>
      <td width="16%" align="left"> <button title="Crear Bloque" type="button" name="bloque"    id="bloque" value="bloque" onclick="fCreabloque();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Crear Bloque</button></td>
     <td width="33%"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
     <td width="33%"><div id="verdoqr"><button title="Generar QR" type="button" name="qr"    id="qr" value="ar" onclick="fImprimirqr();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Generar QR</button></div></td>
  
   
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td colspan="2"><table  width="100%">
      <tr>
        <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar la Carta..?</div><div id="confirmaGuarda"></div></td>
        </tr>
      <tr>
        <td width="14%"><span class="camposss">Nro carta:</span></td>
        <td width="16%"><div id="resul_carta" style="width:100px;"><input name="numcarta" type="hidden" id="numcarta" size="15" readonly placeholder="Autogenerado" onKeyUp="return validacion3(this)" /></div></td>
        <td width="17%"><span class="camposss">Responsable:</span></td>
        <td width="33%"><input name="idencargado" type="text" id="idencargado" style="text-transform:uppercase" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" size="15"  onkeypress="return soloLetras(event)"  readonly />
          <input name="encargado" type="hidden" id="encargado" style="text-transform:uppercase" size="40" /></td>
        <td width="17%"><span class="camposss">Fecha ingreso:</span> </td>
        <td width="36%"><input name="fecingreso" type="text" class="tcal" id="fecingreso" style="text-transform:uppercase" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo date("d/m/Y"); ?>" size="15" maxlength="10"/></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">
    <fieldset id="field_remitente">
    <legend><span class="camposss">Remitente</span></legend>
    <table  width="83%">
        <tr>
          <td><span class="camposss">T.documento :</span></td>
          <td><label for="select"></label>
            <select name="tipdocumento" id="tipdocumento" onchange="validar(this.value)">
            <?php 
			while($rowdocw=mysql_fetch_array($sqlrctm)){
				if($rowdocw['idtipdoc']=='1'){echo "<option value='".$rowdocw['idtipdoc']."' selected='selected'>".$rowdocw['destipdoc']."</option>";}
				else{echo "<option value='".$rowdocw['idtipdoc']."'>".$rowdocw['destipdoc']."</option>";}
				
				}
			?>
             </select>
            
           </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="14%" height="29"><span class="camposss">N.documento :</span></td>
          <td width="37%"><input name="numdoc" type="text" id="numdoc" style="text-transform:uppercase"  onkeypress="send(event);"  size="15" />&nbsp;
            <!--<a href="#" onClick="newParticipante();//fShowDatosProveeClick()"> <img src="../../images/search.png" alt="" width="15" height="15" border="0" /></a>-->
           </td>
          <td width="19%"><span class="camposss">Telefono:</span></td>
          <td width="30%"><input name="telefono" type="text" id="telefono"  style="text-transform:uppercase" size="15" maxlength="15" onkeypress="return tabulador(this, event);return solonumeros(event)"/></td>
        </tr>
        <tr>
          <td height="68" colspan="4"><div id="rpta_bus">
            <table  width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="14%" height="33"><span class="camposss">Remitente:</span></td>
                <td width="86%" colspan="3"><input name="remitente2" type="text" id="remitente2" style="text-transform:uppercase" size="60" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)" onKeyUp="remitente1();" maxlength="400" value=""/>
                 </td>
              </tr>
              <tr>
                <td><span class="camposss">Direccion:</span></td>
                <td colspan="3"><input name="direccion_remi1" style="text-transform:uppercase" type="text" id="direccion_remi1" size="60" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)"  onKeyUp="direccion_remi2();" maxlength="300" value=""/>
                 </td>
              </tr>
            </table>
          </div></td>
          </tr>
        </table> 
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td colspan="2">
    <fieldset id="field_destinatario">
    <legend><span class="camposss">Destinatario</span></legend>
    <table  width="100%">
		<tr>
          <td><span class="camposss">T.documento :</span></td>
          <td><label for="select"></label>
            <select name="tipdocumento2" id="tipdocumento2" onchange="validar2(this.value)">
            <?php 
			while($rowdocw=mysql_fetch_array($sqlrctm2)){
				if($rowdocw['idtipdoc']=='1'){echo "<option value='".$rowdocw['idtipdoc']."' selected='selected'>".$rowdocw['destipdoc']."</option>";}
				else{echo "<option value='".$rowdocw['idtipdoc']."'>".$rowdocw['destipdoc']."</option>";}
				
				}
			?>
             </select>
            
           </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
		  <tr>
		  <td width="14%" height="29"><span class="camposss">N.documento :</span></td>
          <td width="37%"><input name="numdoc2" type="text" id="numdoc2" style="text-transform:uppercase"  onkeypress="send2(event);"  size="15" />&nbsp;
            <!--<a href="#" onClick="newParticipante();//fShowDatosProveeClick()"> <img src="../../images/search.png" alt="" width="15" height="15" border="0" /></a>-->
           </td>
		   </tr>
        </tr>
		<tr>
		<td height="68" colspan="4"><div id="rpta_bus2">
		 <table  width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="14%"><span class="camposss">Nombre:</span> </td>
          <td colspan="3"><input name="destinatario2" type="text" id="destinatario2" style="text-transform:uppercase" size="60" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)" maxlength="400" onKeyUp="destinatario1();" value="" /></td>
          </tr>
        <tr>
          <td><span class="camposss">Dir. destino</span></td>
          <td colspan="3"><input name="dirdestino2" style="text-transform:uppercase" onKeyUp="dirdestinatario1();" type="text" id="dirdestino2" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)" size="60" maxlength="400" value=""/></td>
          </tr>
        </table>
		</div></td>
		</tr>
          <td><span class="camposss">Zona:</span> </td>
          <td width="66%">
		  <?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT ubigeo.coddis AS 'id',CONCAT(ubigeo.nomdis,'/',ubigeo.nomdpto)AS 'descripcion' FROM ubigeo
ORDER BY ubigeo.nomdis ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "descripcion";
			$oCombo->size       = "150"; 
			$oCombo->name       = "idzona";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectzona(this.value);";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); */
?>
<!--<input name="zonadestinatario" type="hidden" id="zonadestinatario" />-->

<table width="522" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="428"><input name="ubigen" type="text" id="ubigen" size="60"  onKeyUp="return validacion4(this)"/></td>
    <td width="94"><a id="idzonax" href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
  </tr>
</table><div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 67px; top: 346px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
              <table width="637" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="24" height="29">&nbsp;</td>
                  <td width="585" class="camposss">Seleccionar Zona:</td>
                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><label>
                    <input name="_buscaubi" style="text-transform:uppercase; background:#FFF;" type="text" id="_buscaubi" size="65" onkeypress="buscaubigeos()" />
                  </label></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div id="resulubi" style="width:585px; height:150px; overflow:auto"></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
          </div></td>
          <td width="9%"><span class="camposss"><!--Costo:--></span> </td>
          <td width="11%">
         </td>
        </tr>
        </table>
    </fieldset>
    
    </td>
    </tr>
  <tr>
    <td colspan="2">
    </td>
    </tr>
  <tr>
    <td colspan="2" >
    <fieldset id="field_diligencia">
    <legend><span class="camposss">Diligencia</span></legend>
    <table  width="100%">
        <tr>
          <td width="14%"><span class="camposss">Fec. Diligencia:</span></td>
          <td width="16%"><input name="fecentrega" type="text" class="tcal" id="fecentrega" style="text-transform:uppercase" onKeyUp = "this.value=formateafecha(this.value);" size="15" maxlength="10" /></td>
          <td width="8%"><span class="camposss">Hora:</span> </td>
          <td width="23%"><input name="horaentrega" type="text" id="horaentrega" style="text-transform:uppercase" onBlur="CheckTime(this)" size="15" maxlength="8" /></td>
          <td width="7%"><span class="camposss">Por:</span></td>
          <td width="32%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT usuarios.loginusuario AS 'id' ,CONCAT(usuarios.apepat,' ',usuarios.apemat, ', ',usuarios.prinom) AS 'des' FROM usuarios WHERE estado='1'
ORDER BY usuarios.apepat ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "empentrega";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectzona(this.value);";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
</td>
<td><span class="camposss">Firmó?:</span></td>
<td><select id="firmo" name="firmo">
	<option value="NO">NO</option>
	<option value="SI">SI</option>
</select></td>
          </tr>
        </table>
    </fieldset>
    </td>

    
    </tr>
    <tr>
	    <td width="92" height="30" valign="top" ><span class="camposss">Recepcion y/o Resultado:</span>
	    <br>
	      </td>
	    <td width="545" height="30" >
	      <textarea name="recepcion" id="recepcion" cols="110" rows="2" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)" ></textarea></td>
	      
	    </tr>
  <tr>
    <td width="92" height="30" valign="top" ><span class="camposss">Contenido:</span>
    <a href="#" onClick="fmuescontenido()"><img src="../../images/help.png" alt="" width="12" height="12" border="0" /></a><br>
    <button onclick="actualizarContenido()">ACTUALIZAR CONTENIDO</button>
      </td>
    <td width="545" height="30" ><label for="contecarta"></label>
      <textarea name="contecarta" id="contecarta" cols="110" rows="5" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)" style="text-transform:uppercase;"></textarea></td>
      
    </tr>
  <!--<tr>
    <td height="30" colspan="2" ><fieldset id="field_cargo">
      <legend><span class="camposss">CARGO DE ENTREGA AL CLIENTE</span></legend>
      <table  width="100%">
        <tr>
          <td width="14%"><span class="camposss">Recogio la carta:</span> </td>
          <td colspan="3"><input name="nomrecogio" type="text" id="nomrecogio" style="text-transform:uppercase" size="60" maxlength="400"  onkeypress="return tabulador(this, event);return soloLetras(event)"/></td>
        </tr>
        <tr>
          <td><span class="camposss">Documento</span></td>
          <td width="35%"><input name="docrecogio" style="text-transform:uppercase" type="text" id="docrecogio" size="30" maxlength="20" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)"  /></td>
          <td width="20%"><span class="camposss">Dia:</span> </td>
          <td width="31%"><input name="fecrecogio" type="text" class="tcal" id="fecrecogio" style="text-transform:uppercase"  size="15" maxlength="50" onkeypress="return tabulador(this, event);" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Nro Fac/Bol:</span></td>
          <td><input name="factura" type="text" id="factura" style="text-transform:uppercase" size="30" maxlength="400" onkeypress="return tabulador(this, event);" /></td>
          <td colspan="2"></td>
          </tr>
      </table>
    </fieldset></td>
    </tr>-->
  <tr>
    <td height="30" colspan="2" align="right" >&nbsp;</td>
  </tr>
</table>
<input name="dirdestino" style="text-transform:uppercase" type="hidden" id="dirdestino"  size="60" maxlength="400" />
 <input type="hidden" name="remitente" id="remitente" value="" >
  <input type="hidden" name="direccion_remi" id="direccion_remi" value="" >
<input name="destinatario" type="hidden" id="destinatario" style="text-transform:uppercase" size="60" maxlength="400" />
 <input name="idzona" type="hidden" id="idzona" size="15" />
          <input name="costo" type="hidden" id="costo" style="text-transform:uppercase" value="0.00" size="15" />  
</form>
</div>
<div id="clientenewdni" class="dalib" style="display:none; z-index:7;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="">Agregar Cliente</td>
                              <td width="35"><a  onclick="cerrar2();"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                    <table width="607" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="napepat" style="text-transform:uppercase" id="napepat" onkeyup="apepaterno();" /><input type="hidden" name="apepat" style="text-transform:uppercase" id="apepat" /><span style="color:#F00">*</span></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="179" height="30"><input type="text" name="napemat" style="text-transform:uppercase" id="napemat" onkeyup="apematerno();" /><input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" /></td>
    <div style="position:absolute;right:40px;top:40px;cursor:pointer;"><a onclick="consultar_dni()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px" src="../../iconos/icon-reniec.png" alt="" width="80px" id="iconReniec"><img id="loaderReniec" style="display: none" src="../../loading.gif"></a></div>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="nprinom" style="text-transform:uppercase" id="nprinom" onkeyup="prinombre();" /><input type="hidden" name="prinom" style="text-transform:uppercase" id="prinom" /><span style="color:#F00">*</span></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="nsegnom" style="text-transform:uppercase" id="nsegnom" onkeyup="segnombre();" /><input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccion" style="text-transform:uppercase" type="text" id="ndireccion" size="55" onkeyup="direccion();" /><input name="direccion" style="text-transform:uppercase" type="hidden" id="direccion" size="55" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td height="44" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3"><table width="471" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="336"><input name="ubigensc" readonly type="text" id="ubigensc" size="40" /><span style="color:#F00">*</span></td>
        <td width="135"><a href="#" onclick="mostrar_desc('buscaubisc')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubisc" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Ubigeo:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubisc')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="_buscaubisc" type="text" id="_buscaubisc"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onkeypress="buscaubigeossc()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulubisc" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
    </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    <td height="30"><select name="idestcivil" id="idestcivil">
      <option value = "0" selected="selected">SELECCIONE ESTADO</option>
      <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" colspan="2" align="left"><div id="casado" style="display:none">
      <table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a href="#" onclick="mostrar_desc('conyugesss')"><img src="../../iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo" id="sexo">
      <option value = "" selected="selected">SELECCIONE SEXO</option>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select></td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select name="nacionalidad" id="nacionalidad" style="width:150px;">
      <option value = "177" selected="selected">PERUANA</option>
      <?php
	      $naci =mysql_query("SELECT * FROM nacionalidades order by desnacionalidad asc",$conn) or die(mysql_error());
		  while($rownaci=mysql_fetch_array($naci)){
		  echo "<option value = ".$rownaci["idnacionalidad"].">".nl2br($rownaci["descripcion"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" align="right"><span class="camposss">Residente :</span></td>
    <td height="30"><label>
      <select name="residente" id="residente">
        <option value="1" selected="selected">SI</option>
        <option value="0">NO</option>
                  </select>
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Natural de :</span></td>
    <td height="30"><input type="text" style="text-transform:uppercase" name="natper" id="natper" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie" type="text" class="tcal" id="cumpclie" style="text-transform:uppercase" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel" type="text" id="telcel" size="20" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi" type="text" id="telofi" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo" type="text" id="telfijo" size="20" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email" type="text" id="email" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a  onclick="ggclie1cartas()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idprofesion" type="hidden" id="idprofesion" size="15" value="0" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" value="0" />
      <input name="nomcargoss" type="hidden" id="nomcargoss" size="40" />
      <input name="nomprofesiones" type="hidden" id="nomprofesiones" size="40" />
      <input type="hidden" name="docpaisemi" id="docpaisemi" value="PERU" /></td>
  </tr>
</table>
                                    </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                      </div>
                      <div id="clientenew" class="dalib" style="display:none; z-index:7; color: #F90; font-weight: bold; font-family: Calibri; font-style: italic;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="editcampp">Agregar Cliente</td>
                              <td width="35"><a  onclick="cerrar()"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td height="233" colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                      <table width="637" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                                        <tr>
                                          <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
                                          <td height="32" >&nbsp;</td>
                                          <td height="32" colspan="5"> <input name="nrazonsocial" type="text" style="text-transform:uppercase" id="nrazonsocial" size="60" onkeyup="razonsociall();" />
      <input name="razonsocial" type="hidden" style="text-transform:uppercase" id="razonsocial" size="60" />
      <span style="color:#F00">*</span>
                                            <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
                                              <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td width="16">&nbsp;</td>
                                                      <td width="180"><span class="titulomenuacto">Seleccione Condición(es)</span></td>
                                                    </tr>
                                                  </table></td>
                                                  <td width="45" align="right" valign="middle">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td width="25">&nbsp;</td>
                                                      <td width="725"><div id="tipocondicion" class="tipoacto"></div></td>
                                                    </tr>
                                                  </table></td>
                                                </tr>
                                                <tr>
                                                  <td width="620" height="10">&nbsp;</td>
                                                  <td width="95"><a href='#' onclick="ocultar_desc('menucondicion')"><img src="../../iconos/aceptar.png" alt="" width="95" height="29" border="0" /></a></td>
                                                  <td height="10">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td colspan="3" align="center" valign="middle"></td>
                                                </tr>
                                                <tr></tr>
                                              </table>
                                            </div></td>
                                            <div style="position:absolute;right:40px;top:40px;cursor:pointer;"><a onclick="consultar_ruc()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px" src="../../iconos/icon-sunat.png" alt="" width="80px"></a></div>
                                        </tr>
                                        <tr>
                                          <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
                                          <td height="26" >&nbsp;</td>
                                          <td height="26" colspan="5"><input name="ndomfiscal" style="text-transform:uppercase" type="text" onkeyup="domfiscall();" id="ndomfiscal" size="60" /><input name="domfiscal" style="text-transform:uppercase"  type="hidden" id="domfiscal" size="60" /><span style="color:#F00">*</span></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5" valign="middle"><table width="522" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="428"><input name="ubigen2" type="text" id="ubigen2" size="60" />
                                                <span style="color:#F00">*</span></td>
                                              <td width="94"><a href="#" onclick="mostrar_desc('buscaubi2')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss"><span class="camposss">Contacto</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5"><input name="contacempresa" style="text-transform:uppercase" type="text" id="contacempresa" size="60" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td width="155" height="30"><input type="text" name="fechaconstitu" class="tcal" style="text-transform:uppercase" id="fechaconstitu" /></td>
                                          <td width="15" height="30" >&nbsp;</td>
                                          <td width="138" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
                                          <td width="14" height="30" >&nbsp;</td>
                                          <td height="30" ><input type="text" name="numregistro" style="text-transform:uppercase" id="numregistro" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Sede Registral</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30"><label><span class="titupatrimo">
                                            <select name="idsedereg3" id="idsedereg3">
                                            <option selected="selected" value="09">IX - Lima</option>
                                              <?php
		   
		   $sqlsedesss=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 
	       while($rowsedesss = mysql_fetch_array($sqlsedesss)){
	         echo "<option value=".$rowsedesss['idsedereg'].">".$rowsedesss['dessede']."</option> \n";
             }
	     ?>
                                            </select>
                                          </span></label></td>
                                          <td height="30">&nbsp;</td>
                                          <td height="30" align="right" ><span class="camposss">N° de Partida</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" ><label>
                                            <input type="text" name="numpartida" style="text-transform:uppercase" id="numpartida" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td width="141" height="30" align="right" ><span class="camposss">Telefono</span></td>
                                          <td width="10" height="30" >&nbsp;</td>
                                          <td height="30"><label>
                                            <input type="text" name="telempresa" style="text-transform:uppercase" id="telempresa" />
                                          </label></td>
                                          <td height="30">&nbsp;</td>
                                          <td height="30" align="right" ><span class="camposss">CIIU</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" ><label>
                                            <select style="width:200px;" name="actmunicipal" id="actmunicipal">
                                            <option value="">SELECCIONAR</option>
                                              <?php
		   
		   $sqlciiu=mysql_query("SELECT * FROM ciiu",$conn) or die(mysql_error()); 
	       while($rowciuu = mysql_fetch_array($sqlciiu)){
	         echo "<option value=".$rowciuu['coddivi'].">".$rowciuu['nombre']."</option> \n";
             }
	     ?>
                                            </select>
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Correo de la empresa</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" valign="middle" ><label>
                                            <input name="mailempresa" type="text" id="mailempresa" size="60" />
                                          </label>
                                            <div id="buscaubi2" style="position:absolute; display:none; width:637px; height:223px; left: 50px; top: 120px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="24" height="29">&nbsp;</td>
                                                  <td width="585" class="camposss">Seleccionar Ubigeo:</td>
                                                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi2')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td><label>
                                                    <input name="_buscaubi2" style="text-transform:uppercase; background:#FFF;" type="text" id="_buscaubi2" size="65" onkeypress="buscaubigeos2()" />
                                                  </label></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td><div id="resulubi2" style="width:585px; height:150px; overflow:auto"></div></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                              </table>
                                          </div></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" >&nbsp;</td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" ><a  onclick="ggclie1cartas2()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" />
                                            <input name="codubi" type="hidden" id="codubi" size="15" />
                                          </a></td>
                                        </tr>
                                      </table>
                                    </div>
</td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                      </div>
</body>
</html>