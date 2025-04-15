<?php 
session_start();
include("conexion.php");

$sqlnlibro=mysql_query("SELECT * FROM nlibro",$conn) or die(mysql_error());
$sqltlibro=mysql_query("SELECT * FROM tipolibro",$conn) or die(mysql_error());
$sqltlegal=mysql_query("SELECT * FROM tipolegal",$conn) or die(mysql_error());
$sqltfol=mysql_query("SELECT * FROM tipofolio",$conn) or die(mysql_error());
$not =mysql_query("SELECT * FROM notarios order by descon asc",$conn) or die(mysql_error());


$query="SELECT COUNT(numdoc_plantilla)+1 AS numdoc FROM cliente WHERE numdoc_plantilla LIKE '%CODJU%'";
$result = mysql_query($query,$conn);

$totalCodJuridica = mysql_fetch_assoc($result);
$codJuridica = str_pad($totalCodJuridica['numdoc'], 6, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Libros</title>
<script language="JavaScript" type="text/javascript" src="ajaxlibro.js"></script>
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen">
<script type="text/javascript" charset="utf-8">
      $(function(){
        $("input, textarea, select, button").uniform();
      });
    </script>
<script type="text/javascript">
function consultar_dni_libro(){
	let docPerNatural = document.getElementById('dni').value;
	let url='https://api.migo.pe/api/v1/dni';
	let token = 'iGIjSH4dbFgaQlvPZSdMkxpyWAr820UeN23TpvQttzQAFsdoY44hYmRJeAr2';

  if(document.getElementById('iconReniecLibro')){
		iconReniecLibro.style.display='none';
		loaderReniecLibro.style.display='block';
	}

	if(docPerNatural.length>8){
		alert('Ingrese un DNI válido de 8 digitos');
    if(document.getElementById('iconReniecLibro')){
      iconReniecLibro.style.display='block';
      loaderReniecLibro.style.display='none';
    }
	}else{
		let docPerJuridica = document.getElementById('dni').value;
		if(docPerJuridica==''){
			alert('El campo DNI esta vacio');
      if(document.getElementById('iconReniecLibro')){
        iconReniecLibro.style.display='block';
        loaderReniecLibro.style.display='none';
      }
		}else{
      // let token = '88291cd82d6815f4e4fd5c2e6b92f808';//TOKEN API PERU
			// let url='https://consulta.api-peru.com/api/dni/'+docPerNatural+'/'+token+'/json';
			consultar_reniec_libro(url,docPerNatural,token)
		}
	}
}

async function consultar_reniec_libro(url,dni,token){
	try{
		let dataEnv={
			dni:dni,
			token:token,
		};
		let myHeaders = new Headers({
			'Content-Type': 'application/json',
		});
		let myInit = {
			method: 'POST', // or 'PUT'
			body: JSON.stringify(dataEnv), // data can be `string` or {object}!
			headers:myHeaders
		}
		let response = await fetch(url,myInit);
		if (response.status>=200 && response.status<400) {
			let dataTotal = await response.json()
			// let data = dataTotal.data
			// console.log(data)
			if(dataTotal.success==true){
          // console.log(data)
          // solicitante.value=dataTotal.nombres+' '+dataTotal.apellido_paterno+' '+dataTotal.apellido_materno
          solicitante.value=dataTotal.nombre
          if(document.getElementById('iconReniecLibro')){
            iconReniecLibro.style.display='block';
            loaderReniecLibro.style.display='none';
          }
          // let names=data.nombre.split(' ');
          // solicitante.value=names[2]+' '+names[3]+' '+names[0]+' '+names[1]
			}
		}else{
				console.log(data)
				throw new Error (`Codigo: ${response.status} Mensaje: ${response.statusText} url: ${response.url}`);
        if(document.getElementById('iconReniecLibro')){
          iconReniecLibro.style.display='block';
          loaderReniecLibro.style.display='none';
        }
			
		}
	}catch(e){
	console.log(e)
  if(document.getElementById('iconReniecLibro')){
      iconReniecLibro.style.display='block';
      loaderReniecLibro.style.display='none';
    }
	
	}
	
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
		
function mostrarboton(valor){
	if(valor=="1"){
		ocultar_desc('datoslibb');	
		ocultar_desc('datolib');
		//limpiartext('');	
		}
	if (valor!="1"){
		mostrar_desc('datolib');
		verboton();
		}	
	}
	
function lanterior(){
	
	mostrar_desc('datoslibb');
	}
	
function vercliente(){
	buscarcliente();
	}
function newclientempresa()
    {
	mostrar_desc('clientenew');
	
	}	
function newclient()
    {
	mostrar_desc('clientenewdni');
	
	}	

function btngrabaremp()
{
	grabarempresa();
	//limpiarempresa();
	ocultar_desc('clientenew');	
	
}
 function ggclie1()
 {
	
	   grabarcliente();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
	
	 }

function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('codubi').value = name;  
  ocultar_desc('buscaubi');     
        
    }
	
function mostrarubigeoosc(id,name)
    {
  document.getElementById('ubigensc').value = id;
  document.getElementById('codubisc').value = name;  
  ocultar_desc('buscaubisc');        
    }
function mostrarprofesioness(id,name)
    {
  document.getElementById('idprofesion').value = id;
  document.getElementById('nomprofesiones').value = name;  
  ocultar_desc('buscaprofe');        
    }
	
function mostrarcargoos(id,name)
    {
  document.getElementById('idcargoo').value = id;
  document.getElementById('nomcargoss').value = name;  
  ocultar_desc('buscacargooo');        
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
	
function mostrartipolibro(){

	var num = document.getElementById('tlibro')[document.getElementById('tlibro').options.selectedIndex].text; 
	document.getElementById('tipolib').value = num;
	ocultar_desc('tlibros');
	}
	
function gbrlibro()
{   
    var _numdoc   = document.getElementById('numdoc');
	var _tipoper = document.getElementById('tipoper');
  var _codclie = document.getElementById('codclie');
  let desLibro = document.getElementById('tipolib').value;
  let folioLibro = document.getElementById('folio').value;
  let tipoFolioLibro = document.getElementById('tipfol').value;
  let numeroLibro = document.getElementById('nlibro').value;
  let tipoLegalizacion = document.getElementById('tlegal').value;

    if(numeroLibro=='Ninguno'){
      alert('Falta seleccionar el numero de libro');
      return false;
    }else if(desLibro==''){
      alert('Falta completar la descripcion del libro');
      return false;
    }else if(tipoLegalizacion=='Ninguno'){
      alert('Falta seleccionar el tipo de legalizacion');
      return false;
    }else if(folioLibro==''){
      alert('Falta completar el folio del libro');
      return false;
    }else if(tipoFolioLibro=='Ninguno'){
      alert('Falta seleccionar el tipo de folio');
      return false;
    }
	
      if(_tipoper.selectedIndex == '0'){
            alert('Falta seleccionar Tipo de Persona');return;
        }else{
          grabarlibro();
          ocultar_desc('gbrlibross');
          mostrar_desc('implibro');
          mostrar_desc('verlibro');
      }
}	
	
//function gbrlibroedit()
//{
	//grabarlibroedit();	
//}	

function validacampos()
{   
gbrlibro();
	//alert("Libro Grabado Satisfactoriamente");
	//var _libro = document.getElementById('nlibro');
//	var _tlibro = document.getElementById('tlibro');
	
  //  var _tipfol = document.getElementById('tipfol');
//	var _tlegal   = document.getElementById('tlegal');
//	var _folio   = document.getElementById('folio');
	
	
	
	//var _nomcargoss   = document.getElementById('nomcargoss');
	
	//if(_libro.selectedIndex == '0')
	//{
	//	alert('Faltan Ingresar Numero de Libro');return;
	//}else{
	 //   if(_tlibro.selectedIndex == '0'){
		//   alert('Falta seleccionar Tipo de Libro');return;
	  //   }else{
		//	 if(_numdoc.value == ''){
		//        alert('Falta Ingresar R.U.C.');return;
	     //     }else{
			//	 if(_tipoper.selectedIndex == '0'){
		      //     alert('Falta seleccionar Tipo de Persona');return;
	           //    }else{
					//   if(_tlegal.selectedIndex == '0'){
					//	   alert('Falta seleccionar Tipo de Legalizacion');return;
						 //  }else{
							//   if(_tipfol.selectedIndex == '0'){
							//   alert('Falta seleccionar Tipo de Folio');return;
							//   }else{
								//   if(_folio.value == ''){
								//		alert('Falta Ingresar Numero de Folio');return;
								//	  }else{
								  //      gbrlibro();
								//        alert("Libro Grabado Satisfactoriamente");
								//   }
							//  }
						 // }
					   
				 // }
				  
			 // }
		// }
	   
	//}
  
}
	
function cuentadni()
{   
	var _dnicuenta = document.getElementById('numdoc');
    var _tipoper = document.getElementById('tipoper');
	
		if(_tipoper.selectedIndex == '0')
	     {alert('Falta seleccionar Tipo de Persona');return;
	     }else{
	      vercliente();
		 }
	
  
}

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
  

function validacion3() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([0-9\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.dd.value) ) {
        alert('Caracter Incorrecto.')
			document.getElementById('dd').value='';
        return false
    }
 
  
    return false           
}



function gbrlibroedit()
{
	grabarlibroedit();
		
	}
	

</script>
<script type="text/javascript">
function fImprimir()
{
  
  var fecha = new Date();
  var anoActual = fecha. getFullYear();

  var _num_libro = document.getElementById('numlibro').value;
  var _anioLibro = document.getElementById('anioLibro').value;

  var _orientacionH = document.getElementById('horizontal').checked;
  var _orientacionV = document.getElementById('vertical').checked;
 
	if(_num_libro==''){alert('Debe guardar los datos primero');return;}

    var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
    var _nom_notario     = 'NOMBRE DEL NOTARIO';
	  var _dist_notario = 'LIMA';


			_data = {
					
					num_libro : _num_libro,
					usuario_imprime : _usuario_imprime,
					nom_notario : _nom_notario,
					dist_notario : _dist_notario,
          anioLibro : _anioLibro,
          orientacionH : _orientacionH,
          orientacionV : _orientacionV
					
				}
				$.post("reportes_word/generador_libros.php",_data,function(_respuesta){
			  alert(_respuesta);
				});

}
function fImprimirqr()
{

  var reply=confirm("IMPORTANTE \n ANTES DE GENERAR EL QR SE RECOMIENDA VERIFICAR QUE LA INFORMACIÓN INGRESADA EN EL INSTRUMENTO SEA LA CORRECTA, CREADO EL QR ESTE NO PODRÁ SER MODIFICADO.  \n  ¿Desea continuar?")
			if (reply==true) 
				{
	
	var _num_libro = document.getElementById('numlibro').value;
  var _ano_libro= document.getElementById('anionumlibro').value;
	
	if(_num_libro==''){alert('Debe guardar los datos primero');return;}

    var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
    var _nom_notario     = 'NOMBRE DEL NOTARIO';
	var _dist_notario = 'LIMA';


			_data = {
					
					num_libro : _num_libro,
					usuario_imprime : _usuario_imprime,
					nom_notario : _nom_notario,
					dist_notario : _dist_notario,
          ano_libro : _ano_libro
					
				}
				$.post("reportes_word/generador_librosqr.php",_data,function(_respuesta){
			alert(_respuesta);
            });
          }
          else 
				{
					
					$( this ).dialog( "close" );
				}

}
function fVisualDocument()
	{
		var _numcarta = document.getElementById('numerolib').value;
    var _anioLibro = document.getElementById('anioLibro').value;
		if(_numcarta == ''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_libro.php?numcarta="+_numcarta+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&nom_notario="+_nom_notario+"&anioLibro="+_anioLibro);
			
	}
function limpiaruc(){
	document.getElementById('numdoc').value="";
	}
function limpianombre(){
	document.getElementById('nombrebus').value="";
	}
function seleccionacliente(id){
	
	mostrarxisclie(id);
	}
</script>
<script src="js/consulta_reniec_sunat.js"></script>
<style type="text/css">
<!--

.Estilo1 {color: #000033}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo10 {
	color: #333333;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo11 {color: #333333}
.Estilo12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

div.newlibro
{ 
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:820px; height:600px;
}
.submenutitu {	font-family: Calibri;
	font-size: 18px;
	font-style: italic;
	color:#FF9900;
}

div.clienbus1 {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:760px;
	height:299px;
	position:absolute;
	left: 496px;
	top: 335px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}

div.dalib {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:760px;
	height:299px;
	position:absolute;
	left: 491px;
	top: 162px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}

div.dalib2 {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:760px;
	height:220px;
	position:absolute;
	left: 489px;
	top: 163px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
div.dalib3 {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:760px;
	height:223px;
	position:absolute;
	left: 487px;
	top: 277px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
div.representante {
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

.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
#newproto table tr td #frmlibro table tr td table tr td strong {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<div class="newlibro" id="newproto">

  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><form id="frmlibro" name="frmbuscakardex" method="post" action="actualizar_kardex.php">
        <table width="820" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="36" height="28" align="center" bgcolor="#264965"><img src="iconos/nuevo2.png" width="20" height="22" /></td>
            <td width="745" bgcolor="#264965"><span class="submenutitu">Nuevo Libro</span></td>
          </tr>
          <tr>
            <td colspan="2"><table width="793" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <th height="28" colspan="7" align="right" scope="col">&nbsp;</th>
              </tr>
              <tr>
                <td width="115" height="30" align="right"><span class="Estilo10">N° Cronológico</span></td>
                <td width="10">&nbsp;</td>
                <td width="172"><div id="ncrono" style="font-family:Calibri; font-size:18; font:bold; color:#036"><input type="text" name="dd" id="dd" value="" size="15" readonly="readonly"  onKeyUp="return validacion3(this)"/>
                  <input type="hidden" name="numlibro" id="numlibro" />
                </div></td>
                <td width="78"><span class="Estilo10">Fecha de Ingreso</span></td>
                <td width="162"><input name="fecing" type="text"  class="tcal" id="fecing" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo date("d/m/Y"); ?>"  size="18" maxlength="10" /></td>
                <td width="79"><span class="Estilo10">N° de Libro</span></td>
                <td width="177"><select name="nlibro" id="nlibro" onchange="mostrarboton(this.value)" >
                  <option value="Ninguno" selected="selected">Seleccionar</option>
                  <?php 
				   while($rownlibro=mysql_fetch_array($sqlnlibro)){
		          echo "<option value = ".$rownlibro['idnlibro'].">".nl2br($rownlibro['desnlibro'])."</option>";  
		           }
				  
				  ?>
                </select></td>
                </tr>
              <tr>
                <td height="26" colspan="7" align="center">------------------------------------------------------------------------------------------------------------------------------</td>
                </tr>
              <tr>
                <td height="26" colspan="3" align="center"><table width="290" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="17">&nbsp;</td>
                    <td width="273"><strong>Busqueda de Cliente</strong></td>
                  </tr>
                </table></td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
              </tr>
              <tr>
                <td height="43" colspan="7" align="right"><table width="750" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="22" rowspan="2">&nbsp;</td>
                    <td width="552"><table width="486" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="150" bgcolor="#FFFFFF"><label>
                          <select name="tipoper" id="tipoper" >
                            <option value = "A" selected="selected">TIPO DE PERSONA</option>
                            <option value="N">Natural</option>
                            <option value="J">Jurídica</option>
                          </select>
                        </label></td>
                        <td width="77" align="right" bgcolor="#FFFFFF"><span class="Estilo10">N° DOC</span></td>
                        <td width="144" align="right" bgcolor="#FFFFFF"><input name="numdoc" type="text" id="numdoc" size="15"  maxlength="11" value="<?php echo 'CODJU'.$codJuridica;?>" onkeypress="return solonumeros(event)" onclick="limpianombre();" /></td>
                        <td width="115" align="center" bgcolor="#FFFFFF"><a  onclick="cuentadni();"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                      </tr>
                    </table></td>
                    <td width="176" rowspan="2"><div id="datolib"></div></td>
                  </tr>
                  <tr>
                    <td height="27"><table width="528" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="217"><span style="font-family:Verdana, Geneva, sans-serif; font-size:8px; color:#333;"><strong>Apellidos y Nombres / Empresa</strong></span></td>
                        <td width="10">&nbsp;</td>
                        <td width="301"><input name="nombrebus" type="text" id="nombrebus" style="text-transform:uppercase" size="45" maxlength="300" onclick="limpiaruc();" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td height="33" colspan="7" align="right"><table width="791" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="25">&nbsp;</td>
                    <td width="766"><div id="datos" style="height:130px; text-align: left; overflow:auto;"><input type="hidden" name="codclie" id="codclie" value="" /></div></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td height="29" colspan="7" align="center">-------------------------------------------------------------------------------------------------------------------------------</td>
                </tr>
              <tr>
                <td height="29" align="right"><span class="Estilo11 Estilo12"><span class="Estilo10"> Tipo Libro</span></span></td>
                <td>&nbsp;</td>
                <td colspan="5"><table width="434" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="304"><input name="tipolib" type="text" id="tipolib" style="text-transform:uppercase" size="45" maxlength="200" /></td>
                    <td width="130"><a  onclick="mostrar_desc('tlibros');"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="33" align="right" class="Estilo10"><span class="Estilo11">Tipo de Legalización</span></td>
                <td>&nbsp;</td>
                <td colspan="5"><table width="636" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="176"><select name="tlegal" id="tlegal">
                      <option value="Ninguno" selected="selected">Seleccionar</option>
                  <?php 
				  
				  while($rowtlegal=mysql_fetch_array($sqltlegal)){
		         echo "<option value = ".$rowtlegal['idlegal'].">".nl2br($rowtlegal['deslegal'])."</option>";  
		           }
				  ?>
                    </select></td>
                    <td width="70"><span class="Estilo10"><span class="Estilo11">N°Fojas</span></span></td>
                    <td width="136"><input name="folio" type="text" id="folio" onkeypress="return solonumeros(event)" size="15" maxlength="20"/></td>
                    <td width="107"><span class="Estilo10"><span class="Estilo11">Tipo de Foja</span></span></td>
                    <td width="147"><select name="tipfol" id="tipfol" >
                      <option value="Ninguno">Seleccionar</option>
                      <?php 
				  
				  while($rowtfol=mysql_fetch_array($sqltfol)){
		         echo "<option value = ".$rowtfol['idtipfol'].">".nl2br($rowtfol['destipfol'])."</option>";  
		           }
				  ?>
                    </select></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="34" align="right" class="Estilo10">Detalle</td>
                <td>&nbsp;</td>
                <td colspan="5"><label for="detalle"></label>
                  <input name="detalle" type="text" id="detalle" style="text-transform:uppercase"  onkeypress="return soloLetras(event)" size="60" maxlength="500"/></td>
              </tr>
              <tr>
                <td height="33" align="right" class="Estilo10">A solicitud de:</td>
                <td>&nbsp;</td>
                <td colspan="5"><input name="solicitante" type="text" id="solicitante" style="text-transform:uppercase"  onkeypress="return soloLetras(event)" size="60" maxlength="200"/></td>
              </tr>
              <tr>
                <td height="34" align="right" class="Estilo11 Estilo12"><span class="Estilo10">D.N.I.</span></td>
                <td rowspan="2">&nbsp;</td>
                <td colspan="5"><table width="654" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="163"><input name="dni" type="text" id="dni" size="15" maxlength="9" onkeypress="return solonumeros(event)"/></td>
                    <td width="165"><a onclick="consultar_dni_libro()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px;cursor:pointer" src="iconos/icon-reniec.png" alt="" width="100px" id="iconReniecLibro"><img id="loaderReniecLibro" style="display: none" src="loading.gif"></a></td>
                    <td width="269">&nbsp;</td>
                    <td width="222"><a  onclick="mostrar_desc('comentario')"><img src="iconos/comentario.png" width="134" height="28" border="0" /></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="34" align="right" class="Estilo11 Estilo12"><span class="Estilo10">Responsable</span></td>
                <td colspan="4"><input name="usuario" type="text" id="usuario" value="<?php echo $_SESSION["apepat_usu"]." ".$_SESSION["apemat_usu"]." ".$_SESSION["nom1_usu"]." ".$_SESSION["nom2_usu"];?>" size="60" readonly="readonly" onkeypress="return soloLetras(event)"/>
                  <label for="idusuario"></label>
                  <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $_SESSION["id_usu"];?>" /></td>
                  <td colspan="2"><label for="horizontal">Horizontal</label><input type="radio" id="horizontal" name="orientacion" checked><label for="vertical">Vertical</label><input type="radio" id="vertical" name="orientacion"></td>
              </tr>
              <tr>
                <td height="46" align="right">&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="5">
               
                <div id="gbrlibross" ><a onclick="gbrlibro()"><img src="iconos/grabar.png" border="0" width="94" height="29" /></a></div>
               
                <div id="implibro" style="display:none"><a onclick="gbrlibroedit()"><img src="iconos/grabar.png" border="0" width="94" height="29" /></a><a onclick="fImprimir()"><img src="iconos/implib.png" border="0" width="94" height="29" /></a><a onClick="fVisualDocument()"><img src="iconos/verlibro.png" border="0" width="94" height="29" /></a><a onclick="fImprimirqr()"><img src="iconos/qr.png" border="0" width="94" height="29" /></a></div>
                
                </td>
              </tr>
			  
            </table></td>
          </tr>
        </table>
      </form></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr></tr>
  </table>
</div>
<div id="datoslibb" class="dalib2" style="display:none; font-family: Calibri; font-size: 12px; color: #FFF; font-family: Verdana, Geneva, sans-serif; font-style: italic;">
<table width="757" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25" height="31">&nbsp;</td>
    <td width="708" class="submenutitu">Datos del Libro Anterior</td>
    <td width="24"><a  onclick="ocultar_desc('datoslibb')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123">&nbsp;</td>
        <td width="343">&nbsp;</td>
        <td width="234">&nbsp;</td>
      </tr>
      <tr>
        <td height="30">Notario:</td>
        <td><select name="idnotario" id="idnotario" style="background:#FFF">
                                <option value="0" selected="selected">SELECCIONE NOTARIA</option>
                                
                                <?php
			 while($row2=mysql_fetch_array($not)){
		  echo "<option style='background:#FFF' value = ".$row2["idnotario"].">".$row2["descon"]."</option>";  
		  }
		?>
                              </select></td>
        <td align="center"><a onclick="ocultar_desc('datoslibb');"><img src="iconos/grabar.png" border="0" width="94" height="29" /></a></td>
      </tr>
      <tr>
        <td height="30">Fecha Legalización</td>
        <td>
          <input type="text" name="flegal" style="background:#FFF" id="flegal" />          <label for="comentarios"></label></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30">Comentario:</td>
        <td colspan="2" rowspan="3" valign="top"><textarea name="comentarios" id="comentarios" style="background:#FFF; text-transform:uppercase;" cols="60" rows="5"></textarea></td>
        </tr>
      <tr>
        <td height="15" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" valign="top">&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>


<!--------------------------------------------------------------------------------------------------------------------->

<div id="comentario" class="dalib3" style="display:none; font-family: Calibri; font-size: 12px; color: #FFF; font-family: Verdana, Geneva, sans-serif; font-style: italic;">
<table width="757" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25" height="31">&nbsp;</td>
    <td width="708" class="submenutitu">Comentario</td>
    <td width="24"><a  onclick="ocultar_desc('comentario')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="556">&nbsp;</td>
        <td width="58">&nbsp;</td>
        <td width="86">&nbsp;</td>
      </tr>
      <tr>
        <td><textarea name="comentarios2" style="text-transform:uppercase; background:#FFF;"  id="comentarios2" cols="90" rows="10"></textarea></td>
        <td>&nbsp;</td>
        <td valign="bottom"><a onclick="ocultar_desc('comentario');"><img src="iconos/grabar.png" border="0" width="94" height="29" /></a></td>
        </tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>

<!--------------------------------------------------------------------------------------------------------->
<div id="clientenew" class="dalib" style="display:none; z-index:7; color: #F90; font-weight: bold; font-family: Calibri; font-style: italic;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="editcampp">Agregar Cliente</td>
                              <td width="35"><a  onclick="ocultar_desc('clientenew')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
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
                                            <div style="position:absolute;right:40px;top:40px;cursor:pointer;"><a onclick="consultar_ruc()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px" src="iconos/icon-sunat.png" alt="" width="80px"></a></div>
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
                                          <td height="30" align="right" ><span class="camposss"><span class="camposss">Objeto Social</span></td>
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
                                          <td height="30" colspan="5" ><a  onclick="btngrabaremp()"><img src="iconos/grabar.png" width="94" height="29" border="0" />
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
<!---------------------------------------------------------------------------------------->                      
<div id="clientenewdni" class="dalib" style="display:none; z-index:7;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="submenutitu">Agregar Cliente</td>
                              <td width="35"><a  onclick="ocultar_desc('clientenewdni')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
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
    <div style="position:absolute;right:40px;top:40px;cursor:pointer;"><a onclick="consultar_dni()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px" src="iconos/icon-reniec.png" alt="" width="80px" id="iconReniec"><img id="loaderReniec" style="display: none" src="loading.gif"></a></div>
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
        <td width="336"><input name="ubigensc" readonly="readonly" type="text" id="ubigensc" size="40" /><span style="color:#F00">*</span></td>
        <td width="135"><a href="#" onclick="mostrar_desc('buscaubisc')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
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
    <td height="30"><a  onclick="ggclie1()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
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

<!-------------------------------------------------------------------------------------------->

<div id="tlibros" style="position:absolute; display:none; width:637px; height:110px; left: 87px; top: 339px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><strong><span class="camposss">Seleccionar Tipo Libro:</span></strong></td>
      <td width="28"><a href="#" onClick="ocultar_desc('tlibros')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><select name="tlibro" id="tlibro" onchange="mostrartipolibro()" >
                  <option value="Ninguno" selected="selected">Seleccionar</option>
                  <?php 
				  
				   while($rowtlibro=mysql_fetch_array($sqltlibro)){
		          echo "<option value = ".$rowtlibro['idtiplib'].">".nl2br($rowtlibro['destiplib'])."</option>";  
		           }
				  ?>
                </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</div>
</body>
</html>
