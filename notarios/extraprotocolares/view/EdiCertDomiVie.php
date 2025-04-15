<?php 
session_start();

include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
$id_domiciliario  = $_REQUEST['id_domiciliario'];	
//echo $id_domiciliario; exit();
$consuldomiciliario = mysql_query("
SELECT ubigeo.coddis,
cert_domiciliario.*,tipoestacivil.idestcivil ,
DATE_FORMAT(cert_domiciliario.fec_ingreso,'%d/%m/%Y') AS 'fecingreso2'
FROM cert_domiciliario 
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cert_domiciliario.distrito_solic
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cert_domiciliario.idestcivil
WHERE cert_domiciliario.id_domiciliario = '$id_domiciliario'", $conn) or die(mysql_error());
$rowdomic = mysql_fetch_array($consuldomiciliario);
	// print_r($rowdomic);return false;
$numcarta = $rowdomic['num_certificado'];
$numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

	
?>
<?php 
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Certificado Domiciliario</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="ajaxdom.js"></script> 

<style type="text/css">
div.carta_content {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:638px;
	height:220px;
	position:absolute;
	left: 549px;
	top: 496px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}

div.allcontrata {width:600px; height:150px; overflow:auto;}
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}

div.div_bloques
{ 
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:820px; height:750px;
}

.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }


#cabecera{
	margin:0 auto;
	border: 2px solid #ddd; 
	border-radius: 10px; 
	padding: 2px; 
	box-shadow: #ccc 5px 0 5px;
	margin-bottom:0px;
	}
	
	
</style>
<script type="text/javascript">

function ggclie1dom()
 {
	
	   grabarcliente_dom();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
	
	 }
	 
	function ggclie1dom2()
 {
	
	   grabarcliente2_dom();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenew');
	
	 }
	 
function send(e){ 
	   
	    tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13){
			
			
        buscar_cliente_car();} 
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
	var _num_doc     = document.getElementById('numdoc_solic').value;
	ajax=objetoAjax();

	ajax.open("POST", "clear_text_dom.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) { 
			divResultado.innerHTML = ajax.responseText;		
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("_num_doc="+_num_doc);
	
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

function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('distrito_solicc').value = name;  
  ocultar_desc('buscaubi');     
        
    }

$(document).ready(function(){ 

	  $("input, textarea").uniform();
	  $("button").button();
	  $("#dialog").dialog();
	})

	function agregar()
	{
		document.getElementById('id_domiciliario').value = '';
		document.getElementById('num_certificado').value = '';
		document.getElementById('fec_ingreso').value = '';
		document.getElementById('num_formu').value = '';
		document.getElementById('nombre_solic').value = '';
		document.getElementById('tipdoc_solic').value = '';
		document.getElementById('numdoc_solic').value = '';
		document.getElementById('domic_solic').value = '';
		document.getElementById('motivo_solic').value = '';
		document.getElementById('distrito_solic').value = '';
		document.getElementById('texto_cuerpo').value = '';
		document.getElementById('justifi_cuerpo').value = '';
	}

	function fGraba(){
		editnnombre_solic();
		editndomic_solic();
		editnnom_testigo();
		 fgrabCertDomic();	}

	function fElimina()
	{ 
		if(confirm('Desea eliminar el certificado..?'))
		{fElimCertDomic(); }
		else {return;}
	}

	function fborrar()
	{
		var _texto_cuerpo   = document.getElementById('texto_cuerpo');
		var _justifi_cuerpo	= document.getElementById('justifi_cuerpo');
		_texto_cuerpo.value = '';
	}

	function fjustificar()
	{
		var _texto_cuerpo   = document.getElementById('texto_cuerpo').value;
		var _justifi_cuerpo	= document.getElementById('justifi_cuerpo').value;
	}


	function fImprimir()
	{
		var _num_crono = document.getElementById('num_certificado').value;
		if(_num_crono==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
	_data =
		{
			num_certificado : _num_crono,
			usuario_imprime : _usuario_imprime,
			nom_notario : _nom_notario,
		}
	
		$.post("../../reportes_word/generador_certifi_domiciliario.php",_data,function(_respuesta){
						alert(_respuesta);
					});
		
	}
	function fVisualDocument()
	{
		var valid_numcrono = document.getElementById('num_certificado').value;
		if(valid_numcrono==''){alert('Debe guardar los datos primero');return;}
		var _num_crono = document.getElementById('muescerti').value;
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';

		window.open("genera_domiciliario.php?num_crono="+_num_crono+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);				
	}
	

	
	function editnnombre_solic()
	{
		valord=document.getElementById('nnombre_solic').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('nombre_solic').value=textod;
	}
	function editndomic_solic()
	{
		valord=document.getElementById('domic_solic').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('domic_solic').value=textod;
	}
	function editnnom_testigo()
	{
		valord=document.getElementById('nnom_testigo').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('nom_testigo').value=textod;
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

	
function buscaprofesionesc2()
{ 	
	var divResultado = document.getElementById('resulprofesionesc2');
	var buscaprofes  = document.getElementById('buscaprofesc2').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnesdomic.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes);
}

function mostrarprofesionessc(id,name)
    {
  document.getElementById('idprofesionc2').value = id;
  document.getElementById('nomprofesionesc2').value = name;  
  ocultar_desc('buscaprofec2');        
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
 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-:/._";
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
 
  
    if( !er_telefono.test(frmbuscakardex.muescerti.value) ) {
        alert('Caracter Incorrecto.')
			document.getElementById('muescerti').value='';
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
if (c!=':' || e!=':') {alert("Introduzca el caracter ':' para separar la hora, los minutos y los segundos");return}

} 

function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('idzona').value = name;  
  ocultar_desc('buscaubi');     
        
		
    }
	
	function mostrarubigeoosc(id,name)
    {
  document.getElementById('ubigensc').value = id;
  document.getElementById('codubisc').value = name;  
  ocultar_desc('buscaubisc');     
        
    }
	
	function ggclie1cartas()
 {
	
	   grabarcliente_dom();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
	
	 }
	 
	function ggclie1cartas2()
 {
	
	   grabarcliente2_dom();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenew');
	
	 }

function validar_documento(){
	
if(document.getElementById('tdoc_testigo').value=='01'){
	document.getElementById('ndocu_testigodom').maxLength=8;
	}else{
		document.getElementById('ndocu_testigodom').maxLength=16;
		}
}

function validar_documento2(){
if(document.getElementById('tipdoc_solic').value=='01'){
	document.getElementById('numdoc_solic').maxLength=8;
	}else{
		document.getElementById('numdoc_solic').maxLength=16;
		}	
	
	}
</script>
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

<body  style="font-size:62.5%;">
<div id="carta_content">
<form name="frmbuscakardex" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td height="30"><fieldset>
      <table  width="100%">
        <tr>
          <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
            <tr>
              <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><?php
				$oBarra->Graba        = "1"            ;
				$oBarra->GrabaClick   = "fGraba();"    ;
				$oBarra->Impri        = "1"                   ;
				$oBarra->ImpriClick   = "fImprimir();"      ;
				$oBarra->clase        = "css"      		  ; 
				$oBarra->widthtxt     = "20"		      ; 
				$oBarra->Show()  						  ; 
				?></td>
                  <td width="77%"><div id="verdocumen">
                    <button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onClick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button>
                  </div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td ><table  width="100%">
                <tr>
                  <td width="13%"><span class="camposss">Nro certificado:</span></td>
                  <td width="19%"><input name="num_certificado" type="hidden" id="num_certificado" style="text-transform:uppercase" value="<?php echo $rowdomic['num_certificado']; ?>" size="15" readonly />
                    <input name="muescerti" type="text" id="muescerti" style="text-transform:uppercase" value="<?php echo $numcarta2; ?>" size="15"  onKeyUp="return validacion3(this)" readonly /></td>
                  <td width="11%"><span class="camposss">Fecha Ingreso:</span></td>
                  <td width="23%"><input name="fec_ingreso" type="text" id="fec_ingreso" style="text-transform:uppercase" value="<?php echo $rowdomic['fecingreso2']; ?>" size="15" class="tcal" onKeyUp = "this.value=formateafecha(this.value);" /></td>
                  <td width="14%"><span class="camposss"># Formulario:</span></td>
                  <td width="20%"><input name="num_formu" type="text" id="num_formu"  onKeyPress="return solonumeros(event)" style="text-transform:uppercase" value="<?php echo $rowdomic['num_formu']; ?>" size="15" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td style="border-collapse:collapse"><fieldset>
                <legend><strong><span class="camposss">SOLICITANTE</span></strong></legend>
                <table  width="95%">
                  <tr>
                    <td><span class="camposss">Identificado con:
                      <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "tipdoc_solic";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validar_documento2()";   
			$oCombo->selected   =  $rowdomic['tipdoc_solic'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                    </span></td>
                    <td width="9%"  align="right"><span class="camposss">Nro.</span></td>
                    <td width="54%" ><input name="numdoc_solic" type="text" id="numdoc_solic" style="text-transform:uppercase" value="<?php echo $rowdomic['numdoc_solic']; ?>" size="15" maxlength="20"  onKeyPress="send(event);" /></td>
                  </tr>
                  <tr>
                    <td colspan="3"><div id="rpta_bus">
                      <table  width="100%" border="0" cellpadding="0" cellspacing="0">
                        <td width="15%"><span class="camposss">Solicitante:</span></td>
                          <td colspan="3"><input name="nnombre_solic" type="text" id="nnombre_solic" onKeyPress="return soloLetras(event)" style="text-transform:uppercase" value="<?php 
		   $c_desc = $rowdomic['nombre_solic'];
		 	 $textorpat=str_replace("?","'",$c_desc);
		 	 $textoamperpat=str_replace("*","&",$textorpat);
		 	 echo strtoupper($textoamperpat); ?>" size="100" maxlength="400"  />
                            <input type="hidden" name="nombre_solic" id="nombre_solic" /></td>
                        </tr>
                        <tr>
                          <td><span class="camposss">Domicilio:</span></td>
                          <td colspan="3"><input name="domic_solic" type="text" id="domic_solic" onKeyUp="editndomic_solic();" style="text-transform:uppercase" value="<?php 
		   $c_desc = $rowdomic['domic_solic'];
		 	 $textorpat=str_replace("?","'",$c_desc);
		 	 $textoamperpat=str_replace("*","&",$textorpat);
		 	 echo strtoupper($textoamperpat); ?>" size="100" maxlength="2000" />
                            <input type="hidden" name="domic_solic" id="domic_solic" /></td>
                        </tr>
                        <tr>
                          <td><span class="camposss">Distrito:</span></td>
                          <td colspan="3"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT ubigeo.coddis AS 'id',  CONCAT(ubigeo.nomdis,'/', ubigeo.nomprov,'/',ubigeo.nomdpto)  AS 'descripcion' FROM ubigeo
ORDER BY ubigeo.nomdis ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "descripcion";
			$oCombo->size       = "150"; 
			$oCombo->name       = "distrito_solicc";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectzona(this.value);";   
			$oCombo->selected   =  $rowdomic['coddis'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
?>
                            <span class="camposss">
                              <input name="distrito_solicc" type="hidden" id="distrito_solicc" value="<?php echo $rowdomic['coddis']; ?>" size="15" />
                              </span>
                            <?php 
		  
		  $consulubigeo= mysql_query("SELECT * FROM ubigeo where coddis='".$rowdomic['coddis']."'", $conn) or die(mysql_error());
		  $rowubbi=mysql_fetch_array($consulubigeo);
        
		  
		  ?>
                            <table width="522" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="428"><input name="ubigen" type="text" id="ubigen" value="<?php echo $rowubbi['nomdpto']."/".$rowubbi['nomprov']."/".$rowubbi['nomdis']; ?>"  size="60" /></td>
                                <td width="94"><a href="#" onClick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
                              </tr>
                            </table>
                            <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 43px; top: 201px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="24" height="29">&nbsp;</td>
                                  <td width="585" class="camposss">Seleccionar Zona:</td>
                                  <td width="28"><a href="#" onClick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><label>
                                    <input name="_buscaubi" style="text-transform:uppercase; background:#FFF; text-transform:uppercase" type="text" id="_buscaubi" size="65" onKeyPress="buscaubigeos()" />
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
                        </tr>
                        <tr>
                          <td height="30" align="left"><span class="camposss">Prof./Ocupación :</span></td>
                          <td height="30" colspan="3"><table width="466" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="254"><label>
                                <input name="nomprofesionesc2" style="text-transform:uppercase"  type="text" id="nomprofesionesc2" size="40" value="<?php echo $rowdomic['detprofesionc'];?>"   />
                                <span style="color:#F00">*</span> </label></td>
                              <td width="118"><a id="limprofe" href="#" onClick="mostrar_desc('buscaprofec2');focusprofec2()"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
                              <td width="94"><div id="buscaprofec2" style="position:absolute; display:none; width:637px; height:223px; left: 28px; top: 271px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                <table width="637" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="24" height="29">&nbsp;</td>
                                    <td width="585"><strong><span class="camposss">Seleccionar Profesion:</span></strong></td>
                                    <td width="28"><a href="#" onClick="ocultar_desc('buscaprofec2')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td><label>
                                      <input name="buscaprofesc2" type="text" id="buscaprofesc2"  style="background:#FFFFFF; text-transform:uppercase" size="50" onKeyPress="buscaprofesionesc2()" />
                                    </label></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td><div id="resulprofesionesc2" style="width:585px; height:150px; overflow:auto"></div></td>
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
                          <td height="30" align="left"><span class="camposss">Estado Civil :</span></td>
                          <td height="30"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipoestacivil.idestcivil AS 'id',  CONCAT(tipoestacivil.desestcivil)  AS 'descripcion' FROM tipoestacivil
ORDER BY tipoestacivil.desestcivil ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "descripcion";
			$oCombo->size       = "150"; 
			$oCombo->name       = "idestcivill";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectzona(this.value);";   
			$oCombo->selected   =  $rowdomic['idestcivil'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
                        </tr>
                        <tr>
                          <td height="30" align="left"><span class="camposss">Sexo :</span></td>
                          <td height="30"><select name="sexo" id="sexo" >
                            <?php echo "<option  selected='selected'>"; 
	 if ($rowdomic['sexo']=="M"){
	 echo "MASCULINO";
	 echo "<option value='F'>FEMENINO</option>";
	 }else if($rowdomic['sexo']=="F"){
		  echo "FEMENINO";
		  echo "<option value='M'>MASCULINO</option>";
	 }
	 echo"</option>";?>
                          </select></td>
                          <td height="30" align="right">&nbsp;</td>
                          <td height="30">&nbsp;</td>
                                  </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td><span class="camposss">Motivo:</span></td>
                    <td colspan="3"><input name="motivo_solic" type="text" id="motivo_solic" style="text-transform:uppercase" value="<?php echo $rowdomic['motivo_solic']; ?>" size="100" maxlength="2000" onKeyPress="return soloLetras(event)" /></td>
                  </tr>
                  <tr>
                    <td><span class="camposss">Fecha que ocupa el inmueble:</span></td>
                    <td colspan="3"><input name="fecha_ocupa" type="date" id="fecha_ocupa" value="<?php echo $rowdomic['fecha_ocupa']; ?>" size="100" /></td>
                  </tr>
                  <tr>
                    <td><span class="camposss">Declara ser:</span></td>
                    <td colspan="3">
                    	<select name="declara_ser" id="declara_ser">
                    		<option value="INQUILINO">INQUILINO</option>
                    		<option value="PROPIETARIO">PROPIETARIO</option>
                    	</select>
                	</td>
                  </tr>
                  <tr>
                    <td><span class="camposss">Propietario:</span></td>
                    <td colspan="3"><input name="propietario" type="text" id="propietario" value="<?php echo $rowdomic['propietario']; ?>" size="100" /></td>
                  </tr>
                  <tr>
                    <td><span class="camposss">Recibido por:</span></td>
                    <td colspan="3"><input name="recibido" type="text" id="recibido" value="<?php echo $rowdomic['recibido']; ?>" size="100" /></td>
                  </tr>
                  <tr>
                  
                    <td><span class="camposss">Recibo de servicios Empresa:</span></td>
                    <td colspan="3">
                    	<select name="recibo_empresa" id="recibo_empresa">
                      <option selected value="<?php echo $rowdomic['recibo_empresa']?>"><?php echo $rowdomic['recibo_empresa']?></option>
                    		<option value="SEDA JULIACA S.A.">SEDA JULIACA S.A.</option>
                    		<option value="ELECTRO PUNO S.A.A">ELECTRO PUNO S.A.A</option>
                    	</select>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="camposss">Nro Recibo:</span></td>
                    <td colspan="3"><input name="numero_recibo" type="text" id="numero_recibo" value="<?php echo $rowdomic['numero_recibo']; ?>" size="100" /></td>
                  </tr>
                  <tr>
                    <td><span class="camposss">Mes facturado:</span></td>
                    <td colspan="3">
                    	<select name="mes_facturado" id="mes_facturado">
                      <option selected value="<?php echo $rowdomic['mes_facturado']?>"><?php echo$rowdomic['mes_facturado']?></option>
                    		<option value="ENERO">ENERO</option>
                    		<option value="FEBRERO">FEBRERO</option>
                    		<option value="MARZO">MARZO</option>
                    		<option value="ABRIL">ABRIL</option>
                    		<option value="MAYO">MAYO</option>
                    		<option value="JUNIO">JUNIO</option>
                    		<option value="JULIO">JULIO</option>
                    		<option value="AGOSTO">AGOSTO</option>
                    		<option value="SETIEMBRE">SETIEMBRE</option>
                    		<option value="OCTUBRE">OCTUBRE</option>
                    		<option value="NOVIEMBRE">NOVIEMBRE</option>
                    		<option value="DICIEMBRE">DICIEMBRE</option>
                    	</select>
                    </td>
                  </tr>
                </table>
              </fieldset></td>
            </tr>
            <tr>
              <td height="30"><fieldset>
                <legend><strong><span class="camposss">CUERPO</span></strong></legend>
                <table  width="100%">
                  <tr>
                    <td colspan="4"><label for="texto_cuerpo"></label>
                      <textarea style="text-transform:uppercase;" name="texto_cuerpo" id="texto_cuerpo" cols="95" rows="5"><?php echo $rowdomic['texto_cuerpo']; ?></textarea></td>
                  </tr>
                  <tr>
                    <td width="9%"><span class="camposss">Identificado con:</span></td>
                    <td width="18%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "tdoc_testigo";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validar_documento()";   
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
                    <td width="16%" align="right"><span class="camposss">Nro.</span></td>
                    <td width="42%"><input name="ndocu_testigodom" type="text" id="ndocu_testigodom" style="text-transform:uppercase" value="<?php echo $rowdomic['ndocu_testigo']; ?>" size="15" maxlength="20" placeholder="N. documento"  onKeyPress="return solonumeros(event)"/></td>
                    <td width="2%" align="right">&nbsp;</td>
                    <td width="11%">&nbsp;</td>
                    <td width="1%">&nbsp;</td>
                    <td width="1%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="64" colspan="8"><span class="camposss">Testigo a ruego:
                      <input name="nnom_testigo" type="text" id="nnom_testigo" onKeyPress="return soloLetras(event)" style="text-transform:uppercase" value="<?php 
			  $c_desc = $rowdomic['nom_testigo'];
		 	 $textorpat=str_replace("?","'",$c_desc);
		 	 $textoamperpat=str_replace("*","&",$textorpat);
		 	 echo strtoupper($textoamperpat); ?>" size="80" maxlength="400"  />
                      </span>
                      <input type="hidden" name="nom_testigo" id="nom_testigo" /></td>
                  </tr>
                  <tr>
                    <td colspan="4"><input name="justifi_cuerpo" type="hidden" id="justifi_cuerpo" value="<?php echo $rowdomic['justifi_cuerpo']; ?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="4"><input name="id_domiciliario" type="hidden" id="id_domiciliario" value="<?php echo $rowdomic['id_domiciliario']; ?>" />
                      <input name="idprofesionc2" type="hidden" id="idprofesionc2" size="15" /></td>
                  </tr>
                </table>
              </fieldset></td>
            </tr>
          </table></td>
        </tr>
      </table>
      </fieldset></td>
  </tr>
  </table>
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
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubisc')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
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
          <td width="133"><a href="#" onclick="mostrar_desc('conyugesss')"><img src="iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
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
                                                  <td width="95"><a href='#' onclick="ocultar_desc('menucondicion')"><img src="iconos/aceptar.png" alt="" width="95" height="29" border="0" /></a></td>
                                                  <td height="10">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td colspan="3" align="center" valign="middle"></td>
                                                </tr>
                                                <tr></tr>
                                              </table>
                                            </div></td>
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
                                              <td width="428"><input name="ubigen" type="text" id="ubigen" size="60" />
                                                <span style="color:#F00">*</span></td>
                                              <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
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
                                            <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 50px; top: 120px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="24" height="29">&nbsp;</td>
                                                  <td width="585" class="camposss">Seleccionar Ubigeo:</td>
                                                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
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
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" >&nbsp;</td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" ><a  onclick="ggclie1cartas2()"><img src="iconos/grabar.png" width="94" height="29" border="0" />
                                            <input name="codubi" type="hidden" id="codubi" size="15" />
                                          </a></td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                      </div>
</body>
</html>