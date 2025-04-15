<?php 
	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
	$num_crono   = $_REQUEST["num_crono"];
	$fecha_crono = $_REQUEST["fecha_crono"];
	$num_formu   = $_REQUEST["num_formu"];
	$lugar_formu = $_REQUEST["lugar_formu"];
	$observacion = $_REQUEST["observacion"];
	$id_viaje    = $_REQUEST["id_viaje"];

$naci = mysql_query("SELECT * FROM nacionalidades",$conn) or die(mysql_error());
	
?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script>
<style type="text/css">
div.dalib {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0px 0px 1px #000000;
	-webkit-box-shadow: 0px 0px 1px #000000;
	box-shadow: 0px 0px 1px #000000;
	width:760px;
	height:400px;
	position:absolute;
	left: 467px;
	top: 66px;
	margin-top: 5px;
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

  function soloLetras(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " abcdefghijklmnñopqrstuvwxyz-:/._";
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
 

 
 function solonumerosletras(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " -/._0123456789abcdefghijklmnñopqrstuvwxyz";
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



$(document).ready(function(){ 
	$("#numdoc").attr("maxlength", 8);
	$("#_SelectUbiConyuge").live("click", function(){
				$("#buscaubisc2").val("");
				$("#buscaubisc2").focus();
				$("#resulubisc2").html("");
			 })
		 
	$("#_buscUbiConyuPerso").live("click", function(){
				$("#buscaubisc4").val("");
				$("#buscaubisc4").focus();
				$("#resulubisc4").html("");
			 })		 


	 $("button").button();
	 $("#dialog").dialog();
	 
	  $("#cumpclie").mask("99/99/9999",{placeholder:"_"});//.datepicker({ dateFormat: "dd/mm/yy" });
	  $("#cumpclie2").mask("99/99/9999",{placeholder:"_"});
	})
	
	function fguardaObservacion(){  pasadatos(); }

	function pasadatos()
	{	
		var _num_crono   = document.getElementById('num_crono').value;
		var _fecha_crono = document.getElementById('fecha_crono').value;
		var _num_formu   = document.getElementById('num_formu').value;
		var _lugar_formu = document.getElementById('lugar_formu').value;
		var _observacion = document.getElementById('observacion').value;
	
		document.getElementById('num_cronoG').value = _num_crono;
		document.getElementById('fecha_cronoG').value = _fecha_crono;
		document.getElementById('num_formuG').value = _num_formu;
		document.getElementById('lugar_formuG').value = _lugar_formu;
		document.getElementById('observacionG').value = _observacion;
		
		document.getElementById('num_crono').value   = '';
		document.getElementById('fecha_crono').value = '';
		document.getElementById('num_formu').value   = '';
		document.getElementById('lugar_formu').value = '';
		document.getElementById('observacion').value = '';
	
		alert('Se agregaron los datos satisfactoriamente');
	
		$("#div_observaciones").remove();//.destroy();	
		
	}

	$('#btnaceptar').click( function() { pasadatos();});

	function vercliente(){	
	
	buscarcliente();
			
		}
	
	function Destructor()
	{
		$("#div_newpartic").remove();
		$("#datos").remove();	
		$("#div_newpartic").dialog("close");
	}
	
	function desactivaboton()
	{
	if(document.getElementById('btnAcepPartic2'))
		{
			document.getElementById('btnAcepPartic2').style.display="none";

		}
	}
	function activaboton()
	{
	if(document.getElementById('btnAcepPartic2').style.display="none")
		{
			document.getElementById('btnAcepPartic2').style.display="";
	
	}}
	function evalGuardaParticipante()
	{
		
		desactivaboton();
		
	
		
		var _condicion = document.getElementById('c_condicontrat').value;
		var _evali = document.getElementById('_evalIngreso'); 
		
		var _firma   = document.getElementById('c_fircontrat').value;
		var _ecivil  = document.getElementById('ecivil').value;
		var _edad_menor = document.getElementById('edad_menor').value;
		
		if(_condicion=='002')
		{
			if(_condicion=='' || _firma=='' || _edad_menor=='')
			{alert('Debe ingresar los datos obligatorios (*)');
			activaboton();
			return;}
		}
		if(_condicion!='002')
		{
			if(_condicion=='' || _firma==''  || _ecivil=='')
			{alert('Debe ingresar los datos obligatorios (*)');
			activaboton();
			return;}
		}

		
			
			if(document.getElementById('napepat2'))
				{
					
					 napepat2();
					 napemat2();
 					 prinom2();
					 direc2();
				}
				else {
					
						 apepat3();
						 apemat3();
						 prinom3();
					 	 segnom3();
						 direccion3();
					}
		
		fAddCondiciones2();
	}

// #= Para agregar nuevo cliente:
	 function ggclie1()
	 {
		var _apepat = document.getElementById('apepat');
		var _prinom = document.getElementById('prinom');
		var _sexo	= document.getElementById('sexo');
		//var _apemat = document.getElementById('apemat');
	
		
		if( _apepat.value == '' || _prinom.value == '' || _sexo.value == '')
		
		{alert('Faltan ingresar datos');return;}
		else{
			
		   grabarcliente();
		   alert("Cliente grabado satisfactoriamente");
		
		   ocultar_desc('clientenewdni');
			}
		 }

/// ##################################################################
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
		
				
	function newclient()
		{
			$("#apepat").val("");
			$("#apemat").val("");
			$("#prinom").val("");
			$("#segnom").val("");
			$("#direccion").val("");
			$("#ubigensc").val("");
			$("#idestcivil").val("1");
			$("#sexo").val("");	
		// Muestra el div para agregar:
			mostrar_desc('clientenewdni');
		}	
	
	function mostrarubigeoosc(id,name)
		{
			  document.getElementById('ubigensc').value = id;
			  document.getElementById('codubisc').value = name;  
			  ocultar_desc('buscaubisc');        
		}
	
// GRABA EL UBIGEO DEL CONYUGE ;	
	function mostrarubigeoosc2(id,name)
		{
		  document.getElementById('ubigensc2').value = id;
		  document.getElementById('codubis2').value = name;  
		  ocultar_desc('div_buscaubisc2');        
		}		

// GRABA EL UBIGEO CONYUGE (PERSONA YA REGISTRADA)
	function mostrarubigeoosc4(id,name)
		{
		  document.getElementById('ubigensc4').value = id;
		  document.getElementById('codubisc4').value = name;  
		  ocultar_desc('div_buscaubisc4');        
		}

	function casadito(valor)
	{
	   if(valor==2){
		mostrar_desc('casado');
	   }else{
		ocultar_desc('casado');
	}

}

// FUNCIONES CONYUGE
	function ggclie4()
		{   
			   grabarcliente4();
			   ocultar_desc('conyugesss');
			   alert("Conyuge grabado satisfactoriamente");
		}
		
	function ggclie2()
		{   
		   grabarConyuge2();
		   ocultar_desc('conyugesss');
		   alert("Conyuge grabado satisfactoriamente");
		}
	
	function fEvalCondicion()
	{
		document.getElementById('div_Data_Apoderado').innerHTML = "";
		document.getElementById('chk_repre').checked = false;
		
		var _condicion = document.getElementById('c_condicontrat').value;
		if(_condicion=='002')
		{
			document.getElementById('div_codtestigo').style.display   = 'none';
			var _div = document.getElementById('div_emenor');
			document.getElementById('div_emenor').style.display = '';
			// DIV LABEL REPRESENTACION
			$("#div_represen").attr("style","display:none");
			$("#div_represen_2").attr("style","display:none");
			
			
			$(".ocultarX").attr("style","display:none");
			$("#c_fircontrat").val("NO");
			
			
		}
		else{ 
			// DIV LABEL REPRESENTACION
			$("#div_represen").attr("style","");
			$("#div_represen_2").attr("style","");
			
			document.getElementById('div_emenor').style.display = 'none';
			document.getElementById('edad_menor').value ='';
			
			$(".ocultarX").removeAttr("style","display:none");
			$("#c_fircontrat").val("SI");
			
			// ******************************************************************************
			// EVALUA AL TESTIGO :
					if(_condicion=='010')
					{ 
					    fshowTestigo();
						var _div = document.getElementById('div_codtestigo');
						document.getElementById('div_codtestigo').style.display = '';
						
						//if(document.getElementById('codi_apoderado'))
						//{document.getElementById('codi_apoderado').value 			  = '';}
			
					}
					else if(_condicion != '010')
					{
						
						// Evalua el poder
						if(_condicion == '003')
						{
							//document.getElementById('div_codpoderdante').style.display = '';
							//fshowDatPoderdante();
						}
						// Resultado normal
						else
						{
							document.getElementById('div_codtestigo').style.display   = 'none';
							// combo del testigo :
							if(document.getElementById('codi_testigo'))
							{document.getElementById('codi_testigo').value 			   = '';}
							
							//document.getElementById('div_codpoderdante').style.display = 'none';
							// combo del poderdante :
							//if(document.getElementById('codi_apoderado'))
							//{document.getElementById('codi_apoderado').value 		   = '';}
							
						}
			
					}
			// ******************************************************************************
			// ******************************************************************************
					
			}
		
	}



// EVALUA DATOS TESTIGO :
function fshowTestigo()
	{		
		var _id_viaje = document.getElementById('id_viaje').value;
		var _testigo = fShowAjaxDato('../includes/showtestigo_v.php?id_viaje='+_id_viaje);
		var _tipinca = fShowAjaxDato('../includes/showcmbTipInca_v.php');	
		document.getElementById('div_codtestigo').innerHTML  ="<table><tr><td></td><td align='center'>Nombre</td><td align='center'>Tipo</td></tr><tr><td>De:</td><td>"+_testigo+"</td><td>"+_tipinca+"</td></tr></table>";		
	}	
	
// EVALUA DATOS DE PODERDANTE DE QUIEN :
function fshowDatPoderdante()
	{	
		var _id_viaje  = document.getElementById('id_viaje').value;
		var _apoderado = fShowAjaxDato('../includes/showApoderado.php?id_viaje='+_id_viaje);
		document.getElementById('div_codpoderdante').innerHTML  ="<table><tr><td></td><td align='center'>Apod. de:</td><td align='center'>" + _apoderado + "</td></tr></table>";		
	}	
	
	
// MUESTRA EL NUEVO DIV DE DATOS DEL APODERADO:
function fshowData_Apoderado()
	{	
		var _id_viaje  = document.getElementById('id_viaje').value;
		var _apoderado = fShowAjaxDato('../includes/showApoderado.php?id_viaje='+_id_viaje);
		
		document.getElementById('div_Data_Apoderado').innerHTML  ="<table><tr><td align='right'>Repres. a:</td><td>" + _apoderado + "</td><td colspan='3' align='center'><input type='checkbox' name='chk_ambos' id='chk_ambos' onclick='fSelectRepresenta()' /> Ambos padres </td></tr><tr><td>Partida Electr. N°:</td><td><input name='partida_numero' type='text'  id='partida_numero'/></td><td>Sede Registral:</td><td><input name='sede_registral_a' type='text'  id='sede_registral_a'/></td></tr></table>";		
	}			


// EVALUA DIV REPRESENTACION
function fActiva_repre(){
	
	var _swtrepre = document.getElementById('chk_repre').checked;

		if (_swtrepre == true)
			{  
			  document.getElementById('div_Data_Apoderado').style.display   = '';
			  fshowData_Apoderado();
			  
			} 
			else{
					document.getElementById('div_Data_Apoderado').style.display   = 'none';
				  	document.getElementById('div_Data_Apoderado').innerHTML = "";
				}	
}
	
// EVALUA CHECK DE AMBOS PADRES
function fSelectRepresenta(){
	
		var _chk_ambos = document.getElementById('chk_ambos').checked;
			if (_chk_ambos == true)
				{  
					document.getElementById('codi_apoderado').selectedIndex = 0 ;
				} 

}


	
function apepaterno(){
	
 valord=document.getElementById('napepat').value;
  textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22kk");
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
function segnombre(){
 valord=document.getElementById('nsegnom').value;
  textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('segnom').value=textod5;

}
function direcction(){
 valord=document.getElementById('ndireccion').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('direccion').value=textod5;

}

function napepat2(){
 valord=document.getElementById('napepat2').value;
  textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apepat2').value=textod5;

}

function napemat2(){
 valord=document.getElementById('napemat2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apemat2').value=textod5;

}

function prinom2(){
 valord=document.getElementById('nprinom2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('prinom2').value=textod5;

}

function direc2(){
 valord=document.getElementById('ndireccion2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('direccion2').value=textod5;
}

function segnom2(){
 valord=document.getElementById('nsegnom2').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('segnom2').value=textod5;
}

function apepat3(){
 valord=document.getElementById('napepat3').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apepat2').value=textod5;
}

function apemat3(){
 valord=document.getElementById('napemat3').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('apemat2').value=textod5;
}

function prinom3(){
 valord=document.getElementById('nprinom3').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('prinom2').value=textod5;
}


function segnom3(){
 valord=document.getElementById('nsegnom3').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('segnom3').value=textod5;
}

function direccion3(){
 valord=document.getElementById('ndireccion3').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('direccion3').value=textod5;
}

//genera cuando se graba uno nuevo

function apepaterno1(){

 valord=document.getElementById('napepat1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"NRO");
 textod5=textod4.replace(/°/gi,"RO");
 document.getElementById('apepat1').value=textod5;
}

function apematerno1(){
 valord=document.getElementById('napemat1').value;
  textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"NRO");
 textod5=textod4.replace(/°/gi,"RO");
 document.getElementById('apemat1').value=textod5;

}
function prinombre1(){
 valord=document.getElementById('nprinom1').value;
  textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"NRO");
 textod5=textod4.replace(/°/gi,"RO");
 document.getElementById('prinom1').value=textod5;

}
function segnombre1(){
 valord=document.getElementById('nsegnom1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"NRO");
 textod5=textod4.replace(/°/gi,"RO");
 document.getElementById('segnom1').value=textod5;

}
function direccion1(){
 valord=document.getElementById('ndireccion1').value;
 textod=valord.replace(/&/gi,"*");
 textod2=textod.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"NRO");
 textod5=textod4.replace(/°/gi,"RO");
 document.getElementById('direccion1').value=textod5;

}
function validacion()
	{
	
		if	(!$('#idtipdoc').val())
		{
			
		alert("debe seleccionar tipo de documento");
		}else if($('#idtipdoc').val()==1)
		{
			$("#numdoc").attr("maxlength", 8);
			$("#numdoc").attr("onkeypress", "return solonumeros(event)");
			document.getElementById('numdoc').value="";
			
			
		}else if($('#idtipdoc').val()!=1)
		{
			$("#numdoc").attr("maxlength", 16);
			$("#numdoc").attr("onkeypress", "return solonumerosletras(event)");
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


function mostrarprofesioness(id,name)
    {
  document.getElementById('idprofesion').value = id;
  document.getElementById('nomprofesiones').value = name;  
  ocultar_desc('buscaprofe');        
    }

function seleccionaclie(id){
	
	buscarclientedoble(id);
	
	}	

</script>

<table>
<tr>
<td>
	<table>
	<tr>
                <td><strong>Busqueda de Cliente</strong></td>
                <td height="26" align="right">
                 <td height="26" align="right">
                 <!--<input type="hidden" name="id_poder" id="id_poder" value="<?php echo $id_viaje; ?>" />-->
                <input type="hidden" name="id_viaje" id="id_viaje" value="<?php echo $id_viaje; ?>" /></td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
              </tr>
              <tr>
                <td height="43" colspan="7"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="6">&nbsp;</td>
                    <td width="92" align="center"><span class="Estilo10">Tipo Docum.

                    </span></td>
                    <td width="216"><span class="Estilo10">
                      <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.idtipdoc AS 'id', tipodocumento.destipdoc AS 'des' FROM tipodocumento WHERE tipodocumento.idtipdoc <> '8' AND tipodocumento.idtipdoc <> '10' ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "260"; 
			$oCombo->name       = "idtipdoc";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validacion();";   
			$oCombo->selected   = "1";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                    </span></td>
                    <td width="197">N. Docum: 
                    <input name="numdoc" type="text" id="numdoc" size="15"  maxlength="16" /></td>
                    <td width="133"><a  onclick="vercliente();"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>                    
                  </tr>                    
<tr>
   <td height="33" colspan="10" align="left"><div id="datos" style="height:330px"></div><div id="clientenewdni" class="dalib" style="display:none;  z-index:7;">
<table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="submenutitu">Agregar Cliente</td>
                              <td width="35"><a  onclick="ocultar_desc('clientenewdni')"><img src="../../iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:750px; height:310px; overflow:auto">
                                    <table width="607" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input name="napepat" type="text" id="napepat" style="text-transform:uppercase" onkeyup="apepaterno();" maxlength="100"/><input type="hidden" name="apepat" style="text-transform:uppercase" id="apepat" /><span style="color:#F00">*</span></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="179" height="30"><input name="napemat" type="text" id="napemat" style="text-transform:uppercase" onkeyup="apematerno();" maxlength="100"/><input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input name="nprinom" type="text" id="nprinom" style="text-transform:uppercase" onkeyup="prinombre();" maxlength="100"/><input type="hidden" name="prinom" style="text-transform:uppercase" id="prinom" /><span style="color:#F00">*</span></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input name="nsegnom" type="text" id="nsegnom" style="text-transform:uppercase" onkeyup="segnombre();" maxlength="100"/><input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="ndireccion" type="text" id="ndireccion" style="text-transform:uppercase" onkeyup="direcction();" size="55" maxlength="200"/><input name="direccion" style="text-transform:uppercase" type="hidden" id="direccion" size="55" /></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td height="44" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3"><table width="471" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="336"><input name="ubigensc" type="text" id="ubigensc" size="40" maxlength="200" readonly="readonly" /></td>
        <td width="135"><a id="_selectUbiViaje" href="#" onclick="mostrar_desc('buscaubisc')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubisc" style="position:absolute; display:none; width:637px; height:223px; left: 20px; top: 80px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Ubigeo:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubisc')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="_buscaubisc" type="text" id="_buscaubisc"  style="background:#FFFFFF; text-transform:uppercase;" size="50"  onkeyup="buscaubigeossc()" />
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
   <td></td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaciòn :</span></td>
    <td height="30" colspan="3"><table width="466" border="0" cellspacing="0" cellpadding="0">
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
              <input name="buscaprofes" type="text" id="buscaprofes"  style="background:#FFFFFF;" size="50" onkeypress="buscaprofesiones()" />
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
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    <td height="30"><select name="idestcivil" id="idestcivil" onchange="casadito(this.value)">
      <option value = "1" selected="selected"></option>
      <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" colspan="2" align="left"><div id="casado" style="display:none"><input type="hidden" id="cconyuge">
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
    </select><span style="color:#F00">*</span></td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select style="width:120px;" name="nacionalidad" id="nacionalidad">
      <option value = "177" selected="selected">PERUANA</option>
      <?php
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
    <td height="30"><input name="natper" type="text" id="natper" style="text-transform:uppercase" onkeypress="return soloLetras(event)" maxlength="30" /></td>
    <td height="30" align="right"><span class="camposss">Fecha de Nac. :</span></td>
    <td height="30"><input name="cumpclie" type="text" class="tcal" id="cumpclie" style="text-transform:uppercase" size="20" maxlength="10" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel" type="text" id="telcel" onkeypress="return solonumeros(event)" size="20" maxlength="10" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi" type="text" id="telofi" onkeypress="return solonumeros(event)" size="20" maxlength="10" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo" type="text" id="telfijo" onkeypress="return solonumeros(event)" size="20" maxlength="10" /></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Email :</span></td>
    <td height="30" colspan="3"><input name="email" type="text" id="email" size="60" maxlength="200" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30"><a  onclick="ggclie1()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" value="0" />
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
</div></td>
</tr>                    
</table>
<!------------------------------------- INGRESO DE CONYUGE ---------------------------------------------->
<div id="conyugesss" style="position:absolute; display:none; width:662px; height:307px; left: 10px; top: 100px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="13" height="29">&nbsp;</td>
      <td width="130"><span class="Estilo42">Ingresar Conyuge </span></td>
      <td width="206" align="right" class="camposss"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT CAST(tipodocumento.codtipdoc AS DECIMAL) AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "120"; 
			$oCombo->name       = "tipdoc_conyuge";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   = "1";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>&nbsp;&nbsp;
        N°:</td>
      <td width="143"><input name="numdoc2" type="text" id="numdoc2" style="background:#FFFFFF" size="20" maxlength="8"  /></td>
      <td width="144"><a  onclick="buscaclientes2()"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
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
<select name="tipoper" id="tipoper" style="visibility:hidden;" >
  <option value="N" selected="selected">Natural</option>
</select>                