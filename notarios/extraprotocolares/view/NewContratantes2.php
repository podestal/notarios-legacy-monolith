<?php
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

$id_poder    = $_REQUEST["id_poder"];
$id_contrata = $_REQUEST["id_contrata"];
$tip_poder   = $_REQUEST["tip_poder"];
$anio   = $_REQUEST["anio"];

$consulcontrat = mysql_query("SELECT * FROM poderes_contratantes WHERE poderes_contratantes.id_poder='$id_poder' AND poderes_contratantes.id_contrata = '$id_contrata'", $conn) or die(mysql_error());
$rowpart = mysql_fetch_array($consulcontrat);
	
$naci = mysql_query("SELECT * FROM nacionalidades",$conn) or die(mysql_error());
	
?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script>
<style type="text/css">
div.dalib {
	background: #333333;
	border: 1px solid #333333;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0px 0px 2px #000000;
	-webkit-box-shadow: 0px 0px 2px #000000;
	box-shadow: 0px 0px 2px #000000;
	width: 692px;
	height: 299px;
	position: absolute;
	left: 461px;
	top: -3px;
	margin-top: 10px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
.submenutitu {	font-family: Calibri;
	font-size: 16px;
	font-style: italic;
	color:#FF9900;
}

</style>
<script type="text/javascript">

$("#ubipoderxx").live( "click", function() {
			$("#_buscaubisc").val("");
			$("#resulubisc").html("");
			$("#_buscaubisc").focus();
		})
		
$("#uniemppoder").live( "click", function() {
			$("#_buscaubi").val("");
			$("#resulubi").html("");
			$("#_buscaubi").focus();
		})		



		
$(document).ready(function(){ 
$("#numdoc").attr("maxlength", 8);
	 if(document.getElementById('tipoper').value=='N')
	 {document.getElementById('numdoc').setAttribute('maxlength','8');}
	 
	 $("button").button();
	 $("#dialog").dialog();
	 
	 $("#cumpclie").mask("99/99/9999",{placeholder:"_"});//.datepicker({ dateFormat: "dd/mm/yy" });
	 
	})

	function vercliente(){
		var _numdocu = document.getElementById('numdoc').value;
		var tipoper = document.getElementById('tipoper').value;
		if(_numdocu=='')
		{alert('No ha ingresado el numero de documento');return;}
		if(tipoper=="A"){
		 alert('No ha seleccionado el tipo de persona');return;	
			}
		buscarcliente2();
		}

	function Destructor()
	{
		$("#div_newpartic").remove();
		$("#datos").remove();	
		$("#div_newpartic").dialog("close");
	}
	
function desactivaboton()
	{
	if(document.getElementById('btnAContratante'))
		{
			document.getElementById('btnAContratante').style.display="none";
		 //document.getElementById('btnAcepPartic2').style.backgroundColor="green";

		//alert('cambio colores y desactivo');
		}
	}
function activaboton()
	{
	if(document.getElementById('btnAContratante').style.display="none")
		{
			document.getElementById('btnAContratante').style.display="";
	
	}}

	function addCont()
	{
		desactivaboton();
	 var _tipoper = document.getElementById('tipoper').value;
	 
	 if(_tipoper == 'N')
	 {
		var _sino = document.getElementById('c_fircontrat');
		var _condicion = document.getElementById('c_condicontrat');
		
		if(_sino.value=='' || _condicion.value=='')
		{alert('Ingrese datos obligatorios (*)');
		activaboton();
		return;}
		else
			{ 
				if(document.getElementById('napepat1'))
				{
					
				apepaterno1(); apematerno1(); prinombre1(); direccion1();
				}
				else {
					
					napepat2();
					nprinom2();
					ndireccion2();
					napemat2();
					}
				
			    evalGuardaParticipante();
			}	 
	 }
 
	 else if(_tipoper == 'J') { faddCondicionesRUC(); }
	}


	function evalGuardaParticipante() { fAddCondiciones3(); }
	
	function fcerrardivedicion3()
	{
		$("#div_newcontra").dialog("close");
		$("#div_newcontra").remove();
		$("#datos").remove();	
	}
		

// #= Para agregar nuevo cliente:
	 function ggclie1()
	 {		
	 		apepaterno();
		    apematerno();
		    prinombre();
		    direccion();
		   ggclie1result();
		 
		
		 }
		 
	function ggclie1result()
	 {
		var _apepat = document.getElementById('apepat');
		var _prinom = document.getElementById('prinom');
		//var _apemat = document.getElementById('apemat');
		var _codubisc= document.getElementById('codubisc');
		var _direccion= document.getElementById('direccion');
		
		var _idestcivil = document.getElementById('idestcivil').value;
		
		if( _apepat.value == '' || _prinom.value == ''  || _codubisc.value == '' || _direccion.value == '' || _idestcivil.value == '0')
		
		{alert('Faltan ingresar datos');return;}
		else{
		   grabarcliente2();
		   alert("Cliente grabado satisfactoriamente");
		   /*apepaterno();
		   apematerno();
		   prinombre();
		   direccion();*/

		   ocultar_desc('clientenewdni');
			}
	  
		 }


///////////// Funciones cliente div misma pagina:
	function ocultar_desc(objac2)
		{
			
		if(document.getElementById(objac2).style.display=="")
			document.getElementById(objac2).style.display="none";
		else
			document.getElementById(objac2).style.display="none";
		}	
	
	function mostrar_desc(objac)
		{
			if(document.getElementById(objac).style.display=="none")
				document.getElementById(objac).style.display=""
			else
				document.getElementById(objac).style.display="";
		}
		
// permite crear nueva empresa			
	function newclientempresa()
		{
		mostrar_desc('clientenew');
		}

// boton que graba nueva empresa
	function btngrabaremp()
	{
		grabarempresa();
		ocultar_desc('clientenew');	
	}
	
// permite crear nueva persona natural
	function newclient()    {	mostrar_desc('clientenewdni');	}	
		
	function mostrarubigeoosc(id,name)
		{
			  document.getElementById('ubigensc').value = id;
			  document.getElementById('codubisc').value = name;  
			  ocultar_desc('buscaubisc');        
		}	

	function fEvalCondi()
	{
		var _tipcondi = document.getElementById('c_condicontrat').value;
		if(_tipcondi=='007')
		{
			document.getElementById('div_codasegurado').style.display = '';
			document.getElementById('div_codtestigo').style.display   = 'none';
			document.getElementById('labelcod1').style.display   = 'none';
			document.getElementById('labelcod2').style.display   = '';
			if(document.getElementById('65149889'))
			{document.getElementById('codi_testigo').value 			  = '';	}
		}
		else if(_tipcondi=='008')
		{
			fshowTestigo();
			document.getElementById('div_codtestigo').style.display   = '';
			document.getElementById('div_codasegurado').style.display = 'none';
			document.getElementById('labelcod1').style.display   = 'none';
			document.getElementById('labelcod2').style.display   = 'none';
			document.getElementById('codi_asegurado').value 		  = '';	
		}
		else if(_tipcondi=='009')
		{
			fshowTestigo();
			document.getElementById('div_codtestigo').style.display   = 'none';
			document.getElementById('labelcod1').style.display   = '';
			document.getElementById('labelcod2').style.display   = 'none';
			document.getElementById('div_codasegurado').style.display = '';
			document.getElementById('codi_asegurado').value 		  = '';	
		}
		else
		{
			document.getElementById('div_codtestigo').style.display   = 'none';
			document.getElementById('div_codasegurado').style.display = 'none';
			document.getElementById('labelcod1').style.display   = 'none';
			document.getElementById('labelcod2').style.display   = 'none';
			if(document.getElementById('codi_testigo'))
			{document.getElementById('codi_testigo').value 			  = '';}
			document.getElementById('codi_asegurado').value 		  = '';	
		}		
	}	


	
// Agrega el ubigeo seleccionado:
	function mostrarubigeoo(id,name)
		{
		  document.getElementById('ubigen').value = id;
		  document.getElementById('codubi').value = name;  
		  ocultar_desc('buscaubi');       
		}
	
	function fshowTestigo()
	{
		
		var _idpoder = document.getElementById('id_poder').value;
		var _testigo = fShowAjaxDato('../includes/showtestigo.php?idpoder='+_idpoder);
		var _tipinca = fShowAjaxDato('../includes/showcmbTipInca.php');	
		document.getElementById('div_codtestigo').innerHTML  ="<table><tr><td></td><td align='center'>Nombre</td><td align='center'>Tipo</td></tr><tr><td>De:</td><td>"+_testigo+"</td><td>"+_tipinca+"</td></tr></table>";		
	}	
	
function apepaterno(){
 valord=document.getElementById('napepat').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apepat').value=textod5;
}

function apematerno(){
 valord=document.getElementById('napemat').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apemat').value=textod5;

}
function prinombre(){
 valord=document.getElementById('nprinom').value;
textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('prinom').value=textod5;

}

function direccion(){
 valord=document.getElementById('ndireccion').value;
textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('direccion').value=textod5;

}

//grabar en 2da tabla

function apepaterno1(){

 valord=document.getElementById('napepat1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apepat1').value=textod5;
}

function apematerno1(){
 valord=document.getElementById('napemat1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apemat1').value=textod5;

}
function prinombre1(){
 valord=document.getElementById('nprinom1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('prinom1').value=textod5;

}
function segnombre1(){
 valord=document.getElementById('nsegnom1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('segnom1').value=textod5;

}
function direccion1(){
 valord=document.getElementById('ndireccion1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('direccion1').value=textod5;

}

function napepat2(){
 valord=document.getElementById('napepat2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apepat2').value=textod5;

}

function nprinom2(){
 valord=document.getElementById('nprinom2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('prinom2').value=textod5;

}
function ndireccion2(){
 valord=document.getElementById('ndireccion2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('direccion2').value=textod5;

}
function napemat2(){
 valord=document.getElementById('napemat2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('napemat22').value=textod5;

}

////aqui el cambio de caracter especial para empresa //////

function  razonsocial(){
 valord=document.getElementById('razonsocial2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('razonsocial').value=textod5;

}

function  domfiscal(){
 valord=document.getElementById('domfiscal2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('domfiscal').value=textod5;

}

function casadito(valor)
	{
		var _idtipdoc = $("#idestcivil").val();
		if(_idtipdoc == '1' || _idtipdoc == '3')
		{
			$("#cconyuge").val("0");
		}
		
		
	   if(valor==2){
		mostrar_desc('casado');
	   }else{
		ocultar_desc('casado');
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

function ggclie4()
		{   
			   grabarcliente4();
			   ocultar_desc('conyugesss');
			   alert("Conyuge grabado satisfactoriamente");
		}

function ggclie2()
		{   
		   var apepat= document.getElementById('apepat2').value;
		   var prinom= document.getElementById('prinom2').value;
		   var sexo2 = document.getElementById('sexo2').value;
		   
		   if(apepat=='' || prinom==''  || sexo2==''){
			   alert("Falta ingresar: Apellido Paterno y/o Primer nombre, ubigeo o sexo del conyuge");
			   }
		   else{
		   grabarConyuge2();
		   ocultar_desc('conyugesss');
		   alert("Conyuge grabado satisfactoriamente");
		   }
		}
	function validacion()
	{
	
		if	(!$('#idtipdoc').val())
		{
			alert("debe seleccionar tipo de documento");
		}else if($('#idtipdoc').val()==1)
		{
			$("#numdoc").attr("maxlength", 8);
			document.getElementById('numdoc').value="";
		}else if($('#idtipdoc').val()==8)
		{
			$("#numdoc").attr("maxlength", 11);
			document.getElementById('numdoc').value="";
		}else if($('#idtipdoc').val()!=8 || $('#idtipdoc').val()!=1)
		{
			$("#numdoc").attr("maxlength", 15);
			document.getElementById('numdoc').value="";
		}
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
	
function focusprofe(){
	document.getElementById('buscaprofes').focus();
	}
	
function buscaprofesiones()
{ 	
	var divResultado = document.getElementById('resulprofesiones');
	var buscaprofes  = document.getElementById('buscaprofes').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnescert.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes);
}

function mostrarprofesioness(id,name)
    {
  document.getElementById('idprofesion').value = id;
  document.getElementById('nomprofesiones').value = name;  
  ocultar_desc('buscaprofe');        
    }
	
function buscaprofesiones_cc()
{ 	
	var divResultado = document.getElementById('resulprofesionescc');
	var buscaprofes  = document.getElementById('buscaprofescc').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnesconyuge.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes);
}

function mostrarprofesioness_cc(id,name)
    {
  document.getElementById('idprofesion2').value = id;
  document.getElementById('nomprofesiones2').value = name;  
  ocultar_desc('busca_profe');        
    }

function buscaprofesiones_cc2()
{ 	
	var divResultado = document.getElementById('resulprofesionescc2');
	var buscaprofes  = document.getElementById('buscaprofescc2').value;
		
	ajax=objetoAjax();
	ajax.open("POST","buscaprofesionnesconyuge2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaprofes="+buscaprofes);
}

function mostrarprofesioness_cc2(id,name)
    {
  document.getElementById('idprofesion4').value = id;
  document.getElementById('nomprofesiones4').value = name;  
  ocultar_desc('busca_profe2');        
    }

function buscaubigeossc2()
{ 	
	var divResultado = document.getElementById('resulubisc2');
	var buscaubisc2  = document.getElementById('buscaubisc2').value  
		//alert(buscaubisc2);
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeosc2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubisc2="+buscaubisc2)
}
function mostrarubigeoosc2(id,name)
    {
  
  document.getElementById('ubigensc2').value = id; 
  document.getElementById('codubis2').value = name; 
  ocultar_desc('div_buscaubisc2');        
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
	 
function validar_combito(){
	
	if($('#tipoper').val()=="N"){
		
		document.getElementById('idtipdoc').selectedIndex=6;
		document.getElementById('numdoc').value="";
		$("#numdoc").attr("maxlength", 8);
		}else{
			
		document.getElementById('idtipdoc').selectedIndex=10;
		document.getElementById('numdoc').value="";	
		$("#numdoc").attr("maxlength", 11);
			}
			
			
		
	
	}
</script>
<script src="../../js/consulta_reniec_sunat.js"></script>
<table>
<tr>
<td>
	<table>
	<tr>
                <td><strong>Busqueda de Cliente</strong></td>
                <td height="26" align="right"><input type="hidden" name="id_poder" id="id_poder" value="<?php echo $rowpart['id_poder']; ?>" /></td>
                <td height="26" align="right"><input type="hidden" name="id_contrata" id="id_contrata" value="<?php echo $rowpart['id_contrata']; ?>" />
                <input type="hidden" name="id_tippoder" id="id_tippoder" value="<?php echo $tip_poder; ?>" /></td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
              </tr>
              <tr>
                <td height="43" colspan="7"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="144"><select name="tipoper" id="tipoper" onchange="validar_combito()">
                      <option value = "A" selected="selected">TIPO DE PERSONA</option>
                      <option value="N">Natural</option>
                      <option value="J">Jurídica</option>
                    </select></td>
                    <td width="549"><table width="549" border="0" align="left" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="71" bgcolor="#FFFFFF"><span class="Estilo10">T.Docum. </span></td>
                        <td width="244" bgcolor="#FFFFFF"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.idtipdoc AS 'id', tipodocumento.destipdoc AS 'des' FROM tipodocumento ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "idtipdoc";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validacion();";   
			$oCombo->selected   = "1";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
                        <td width="154" bgcolor="#FFFFFF"><input name="numdoc" type="text" id="numdoc"  maxlength="16"   /></td>
                        <td width="72" align="right" bgcolor="#FFFFFF"><a  onclick="vercliente();"><img src="../../iconos/buscarclie.png" alt="" width="72" height="29" border="0" /></a></td>
                        <td width="10" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                    </table></td>                    
</tr>                    
<tr>
   <td height="33" colspan="7" align="left"><div id="datos" style="height:130px"> </div><div id="clientenewdni" class="dalib" style="display:none; z-index:7;">
<table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="16" height="29">&nbsp;</td>
                              <td width="609" class="submenutitu">Agregar Cliente</td>
                              <td width="83"><a  onclick="ocultar_desc('clientenewdni')"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="659" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="659" height="54" bgcolor=""><div id="busclie" style=" width:660px; height:250px; overflow:auto">
                                    <table width="622" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="14" height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="115" height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30" bgcolor="#FFFFFF"><input name="napepat" type="text" id="napepat" style="text-transform:uppercase" onkeypress="return soloLetras(event)"  onkeyup="apepaterno();" maxlength="50"/><input type="hidden" name="apepat" style="text-transform:uppercase" id="apepat" /><span style="color:#F00">*</span></td>
    <td width="119" height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Apellido Materno :</span></td>
    <td width="194" height="30" bgcolor="#FFFFFF"><input name="napemat" type="text" id="napemat" style="text-transform:uppercase"  onkeypress="return soloLetras(event)" maxlength="50"><input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" /></td>
    <div style="position:absolute;right:40px;top:40px;cursor:pointer;"><a onclick="consultar_dni()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px" src="../../iconos/icon-reniec.png" alt="" width="100px" id="iconReniec"><img id="loaderReniec" style="display: none" src="../../loading.gif"></a></div>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">1er Nombre :</span></td>
    <td height="30" bgcolor="#FFFFFF"><input name="nprinom" type="text" id="nprinom" style="text-transform:uppercase"  onkeypress="return soloLetras(event)" maxlength="50"/><input type="hidden" name="prinom" style="text-transform:uppercase" id="prinom" /><span style="color:#F00">*</span></td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">2do Nombre :</span></td>
    <td height="30" bgcolor="#FFFFFF"><input type="text" name="segnom" style="text-transform:uppercase" id="segnom" onkeypress="return soloLetras(event)" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3" bgcolor="#FFFFFF"><input name="ndireccion" type="text" id="ndireccion" style="text-transform:uppercase"  onkeyup="direccion();" size="55" maxlength="200"/><input type="hidden" name="direccion" style="text-transform:uppercase" id="direccion" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="44" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="44" align="right" bgcolor="#FFFFFF"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3" bgcolor="#FFFFFF"><table width="471" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="336"><input name="ubigensc" type="text" id="ubigensc" size="40" maxlength="200" readonly="readonly" /><span style="color:#F00">*</span></td>
        <td width="135"><a href="#" id="ubipoderxx" onclick="mostrar_desc('buscaubisc')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubisc" style="position: absolute; display:none; width: 637px; height: 223px; left: 10px; top: 33px; z-index: 20; background: #CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Ubigeo:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubisc')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="_buscaubisc" type="text" id="_buscaubisc"  style="background:#FFFFFF;text-transform:uppercase;" size="50" onkeypress="buscaubigeossc()"  />
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
   <td bgcolor="#FFFFFF"></td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Prof./Ocupaciòn :</span></td>
    <td height="30" colspan="3" bgcolor="#FFFFFF"><table width="466" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="254"><label>
          <input name="nomprofesiones"  type="text" id="nomprofesiones" style="text-transform:uppercase" size="40" maxlength="200" />
        </label></td>
        <td width="118"><a id="limprofe" href="#" onclick="mostrar_desc('buscaprofe');focusprofe()"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
        
          <td width="94"> <input name="idprofesion" type="hidden" id="idprofesion" size="15" /><div id="buscaprofe" style="position:absolute; display:none; width:637px; height:223px; left: 90px; top: 80px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
            <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Profesion:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaprofe')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaprofes" type="text" id="buscaprofes"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onkeypress="buscaprofesiones()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulprofesiones" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
  </div>
        
        </td>
      </tr>
    </table>
    </td>
          </tr> 
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Estado Civil :</span></td>
    <td height="30" bgcolor="#FFFFFF"><select name="idestcivil" id="idestcivil" onchange="casadito(this.value)">
     <option value = "1" selected="selected"></option>
      <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select><span style="color:#F00">*</span></td>
    <td height="30" colspan="2" align="left" bgcolor="#FFFFFF"><div id="casado" style="display:none"><input id="cconyuge" type="hidden" name="cconyuge">
      <table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a href="#" onclick="mostrar_desc('conyugesss')"><img src="../../iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Sexo :</span></td>
    <td height="30" bgcolor="#FFFFFF"><select name="sexo" id="sexo">
      <option value = "" selected="selected">SELECCIONE SEXO</option>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select></td>
    <td height="30" align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Nacionalidad :</span></td>
    <td height="30" bgcolor="#FFFFFF"><select style="width:120px;" name="nacionalidad" id="nacionalidad">
      <option value = "177" selected="selected">PERUANA</option>
      <?php
		  while($rownaci=mysql_fetch_array($naci)){
		  echo "<option value = ".$rownaci["idnacionalidad"].">".nl2br($rownaci["descripcion"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Residente :</span></td>
    <td height="30" bgcolor="#FFFFFF"><label>
      <select name="residente" id="residente">
        <option value="1" selected="selected">SI</option>
        <option value="0">NO</option>
                  </select>
    </label></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Natural de :</span></td>
    <td height="30" bgcolor="#FFFFFF"><input name="natper" type="text" id="natper" style="text-transform:uppercase" onkeypress="return soloLetras(event)" maxlength="100" /></td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30" bgcolor="#FFFFFF"><input name="cumpclie" type="text" class="tcal" id="cumpclie" style="text-transform:uppercase"  onKeyUp = "this.value=formateafecha(this.value);" size="20" maxlength="10"/></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30" bgcolor="#FFFFFF"><input name="telcel" type="text" id="telcel" size="20" onkeypress="return solonumeros(event)"  /></td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30" bgcolor="#FFFFFF"><input name="telofi" type="text" id="telofi" size="20" onkeypress="return solonumeros(event)" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30" bgcolor="#FFFFFF"><input name="telfijo" type="text" id="telfijo" onkeypress="return solonumeros(event)" size="20" maxlength="15" /></td>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3" bgcolor="#FFFFFF"><input name="email" type="text" id="email" size="60" maxlength="200" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" align="right" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" bgcolor="#FFFFFF"><a  onclick="ggclie1()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
    <td height="30" bgcolor="#FFFFFF"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" value="0" />
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

<!-- ############################################################################################### -->
<!-- PARA AGREGAR NUEVO CON RUCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC  -->
<div id="clientenew" class="dalib" style="display:none; z-index:7; color: #F90; font-weight: bold; font-family: Calibri; font-style: italic;">
                          <table width="701" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="16" height="29">&nbsp;</td>
                              <td width="637" class="editcampp">Agregar Cliente</td>
                              <td width="48"><a  onclick="ocultar_desc('clientenew')"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td height="233" colspan="3"><table width="683" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="683" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:680px; height:230px; overflow:auto">
                                      <table width="653" border="0" align="left" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                                        <tr>
                                          <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
                                          <td height="32" >&nbsp;</td>
                                          <td height="32" colspan="5"><label>
                                            <input name="razonsocial2" type="text" id="razonsocial2" style="text-transform:uppercase" onkeyup="razonsocial();" size="60" maxlength="200" /><input name="razonsocial" type="hidden" id="razonsocial" style="text-transform:uppercase" size="60" maxlength="200" />
                                            <span style="color:#F00">*</span> </label>
                                            <label></label>
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
                                             <div style="position:absolute;right:40px;top:40px;cursor:pointer;"><a onclick="consultar_ruc()"><img style="box-shadow:0px 0px 5px 0px gray;border-radius:5px" src="../../iconos/icon-sunat.png" alt="" width="100px"></a></div>
                                        </tr>
                                        <tr>
                                          <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
                                          <td height="26" >&nbsp;</td>
                                          <td height="26" colspan="5"><input name="domfiscal2" type="text" id="domfiscal2" style="text-transform:uppercase" onkeyup="domfiscal();" size="60" maxlength="200" /><input name="domfiscal" type="hidden" id="domfiscal" style="text-transform:uppercase" size="60" maxlength="200" />
                                            <span style="color:#F00">*</span></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5" valign="middle"><table width="500" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="381"><input name="ubigen" type="text" id="ubigen" size="50" maxlength="200" />
                                                <span style="color:#F00">*</span></td>
                                              <td width="119"><a href="#" id="uniemppoder" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Fecha de Const.</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td width="164" height="30"><input name="fechaconstitu" type="text" class="tcal" id="fechaconstitu" style="text-transform:uppercase" size="20" /></td>
                                          <td width="16" height="30" >&nbsp;</td>
                                          <td width="146" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
                                          <td width="18" height="30" >&nbsp;</td>
                                          <td width="175" height="30" ><input name="numregistro" type="text" id="numregistro" style="text-transform:uppercase" size="20" maxlength="15" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Sede Registral</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30"><label><span class="titupatrimo">
                                            <select name="idsedereg3" id="idsedereg3">
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
                                            <input name="numpartida" type="text" id="numpartida" style="text-transform:uppercase" size="20" maxlength="15" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td width="126" height="30" align="right" ><span class="camposss">Telefono</span></td>
                                          <td width="8" height="30" >&nbsp;</td>
                                          <td height="30"><label>
                                            <input name="telempresa" type="text" id="telempresa" style="text-transform:uppercase" size="20" maxlength="15" />
                                          </label></td>
                                          <td height="30">&nbsp;</td>
                                          <td height="30" align="right" ><span class="camposss">CIIU</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" ><label>
                                            <select style="width:150px;" name="actmunicipal" id="actmunicipal">
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
                                          <td height="30" align="right" ><span class="camposss">Objeto Social</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" valign="middle" ><input name="contacempresa" type="text" id="contacempresa" style="text-transform:uppercase" size="60" maxlength="200" /></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Correo de la empresa</span></td>
                                          <td height="30" >&nbsp;</td>
                                          <td height="30" colspan="5" valign="middle" ><label>
                                            <input name="mailempresa" type="text" id="mailempresa" size="60" maxlength="200" />
                                          </label>
                                            <div id="buscaubi" style="position: absolute; display:none; width: 637px; height: 223px; left: 20px; top: 35px; z-index: 20; background: #CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="24" height="29">&nbsp;</td>
                                                  <td width="585" class="camposss">Seleccionar Ubigeo:</td>
                                                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td><label>
                                                    <input name="_buscaubi" type="text" id="_buscaubi" size="50"  onkeyup="buscaubigeos()" />
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
                                          <td height="30" colspan="5" ><a  onclick="btngrabaremp()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" />
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
<!-- ############ FIN NUEVO CON RUUUUUUUUCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC ######################### -->
<!-- ############################################################################################### -->
</td>
</tr>                    
</table>

<!------------------------------------- INGRESO DE CONYUGE ---------------------------------------------->
<div id="conyugesss" style="position: absolute; display:none; width: 662px; height: 307px; left: 12px; top: 14px; z-index: 20; background: #CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="13" height="29">&nbsp;</td>
      <td width="113"><span class="Estilo42">Ingresar Conyuge </span></td>
      <td width="276" align="right" class="camposss"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT CAST(tipodocumento.codtipdoc AS DECIMAL) AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "160"; 
			$oCombo->name       = "tipdoc_conyuge";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   = "1";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>&nbsp;&nbsp;
        N°:</td>
      <td width="142"><input name="numdoc2" type="text" id="numdoc2" style="background:#FFFFFF" size="20" maxlength="8"  /></td>
      <td width="92"><a  onclick="buscaclientes2()"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
      <td width="23"><a href="#" onClick="ocultar_desc('conyugesss')"><img src="../../iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><div id="nuevaconyuge" style="width:618px; height:220px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<!------------------------------------- FIN INGRESO DE CONYUGE ------------------------------------------>