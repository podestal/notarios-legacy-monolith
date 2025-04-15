<?php
session_start();
 
    include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 	;
	$Grid1 = new GridView()		;
	$oCombo = new CmbList()  	;	
	
	$id_poder  = $_REQUEST['id_poder'];	
	$consulpoder = mysql_query("SELECT ingreso_poderes.*, DATE_FORMAT(ingreso_poderes.fec_ingreso, '%d/%m/%Y') AS 'fec_ingreso2' FROM ingreso_poderes WHERE ingreso_poderes.id_poder='$id_poder'", $conn) or die(mysql_error());
	$rowpoder = mysql_fetch_array($consulpoder);
	$numkar = $rowpoder['num_kardex'];
	$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);
	
	$id_usuario= $_SESSION["id_usu"];
$sqlu  = mysql_query("SELECT * FROM permisos_usuarios where idusuario = '$id_usuario'",$conn) or die(mysql_error());

$rowu= mysql_fetch_array($sqlu);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de poderes</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 

<style type="text/css">
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
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

$(document).ready(function(){ 
	 $("button").button();
	 $("input, textarea").uniform();
	 $("#dialog").dialog();
	 $( "#dialog:ui-dialog" ).dialog( "destroy" );
	 
	 	var _id_poder = $("#id_poder").val();
		
	 	$("#div_muesStatusNC").load("../model/statusNOCORRE_poder.php",{ id_poder : _id_poder }, function(){
		 		if($("#div_muesStatusNC").html()!='')
					{
						$("#Grabar").attr('disabled','disabled');
						$("#Generar").attr('disabled','disabled');
						$("#nocorre").attr('disabled','disabled');	
					}
		});
		_evalBtn_Poderes();
	})

	function _evalBtn_Poderes()
	{
		var _tippoder = $("#id_asunto").val();		
		if(_tippoder=='')
		{
			$("#btn_poderes").attr("style","display:none");
		}
		
		if(_tippoder=='004')
		{
			document.getElementById('btnessalud').disabled=false;
			document.getElementById('btnessalud').style.display="";
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnpensiones').style.display="none";
			document.getElementById('btnobs').disabled=true;
			document.getElementById('btnobs').style.display="none";
		}
		
		if(_tippoder=='003')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnessalud').style.display="none";
			document.getElementById('btnpensiones').disabled=false;
			document.getElementById('btnpensiones').style.display="";
			document.getElementById('btnobs').disabled=true;
			document.getElementById('btnobs').style.display="none";
		}
		
		if(_tippoder=='002')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnessalud').style.display="none";
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnpensiones').style.display="none";
			document.getElementById('btnobs').disabled=false;
			document.getElementById('btnobs').style.display="";
		}
	} 

// #=== PENSIONES
	function fmuesPensiones(){
		
		var _id_poder = document.getElementById('id_poder').value;
	$('<div id="div_ppensiones" title="div_ppensiones"></div>').load('PoderPensiones.php?id_poder='+_id_poder)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 500,
					height  : 230,
					modal:false,
					resizable:false,
					<?php
					
					if($rowu['editpod'] == '1')
                   {?>
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {fguardaPPensiones();$(this).dialog("destroy").remove(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
				   <?php
					}else{
						?>
						buttons: [{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						<?php
						}
					?>
					title:'Observaciones'
					
					}).width(500).height(230);	
					$(".ui-dialog-titlebar").hide();
		}

// #=== ESSALUD
	function fmuesEssalud(){
		
		var _id_poder = document.getElementById('id_poder').value;
	$('<div id="div_pessalud" title="div_pessalud"></div>').load('PoderEssalud.php?id_poder='+_id_poder)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 500,
					height  : 350,
					modal:false,
					resizable:false,
					<?php
					
					if($rowu['editpod'] == '1')
                   {?>
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {fguardaPEssalud();$(this).dialog("destroy").remove(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
				   <?php
					}else{
						?>
						buttons: [{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						<?php
						}
					?>
					
					title:'Observaciones'
					
					}).width(500).height(350);	
					$(".ui-dialog-titlebar").hide();
		}

// #=== MUESTRA CONTRATANTES - PODERES
	function fmuesContratantes()
	{
	
		var _id_poder = document.getElementById('id_poder');
		if(_id_poder.value=='')
		{alert('Debe ingresar y grabar los datos primero...');return;}
	
		var _id_poder  = document.getElementById('id_poder').value;
		var _tip_poder = document.getElementById('id_asunto').value
	
	$('<div id="div_pcontratantes" title="div_pcontratantes"></div>').load('PoderContratantes.php?id_poder='+_id_poder+'&tip_poder='+_tip_poder)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 800,
					height  : 400,
					modal:false,
					resizable:false,
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {$(this).dialog("destroy").remove(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Participantes'
					
					}).width(800).height(400);	
					$(".ui-dialog-titlebar").hide();
	
	}



// #=== MUESTRA BOTON GENERAR
	function fmuesObservacion()
	{
		var _id_poder = document.getElementById('id_poder').value;
	$('<div id="div_generador" title="div_generador"></div>').load('PoderGenerador.php?id_poder='+_id_poder)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 800,
					height  : 300,
					modal:false,
					resizable:false,
					<?php
					
					if($rowu['editpod'] == '1')
                   {?>
					 
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {fguardaPFueraReg(); $(this).dialog("destroy").remove();/*fguardaPGenerador();*/ }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
				   <?php
					}else{
						?>
						buttons: [{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						<?php
						}
					?>
					
					title:'Observaciones'
					
					}).width(800).height(300);	
					$(".ui-dialog-titlebar").hide();
			
	}


	function fGraba()
	{
			var _num_kardex = document.getElementById('num_kardex') ;
			var _nom_recep  = document.getElementById('nom_recep')  ;
			var _hora_recep = document.getElementById('hora_recep') ;
			var _id_asunto  = document.getElementById('id_asunto') 	;
		
	if( _hora_recep.value=='')
	{alert('Faltan Ingresar datos');return;}	
	else
	{
	$( "#muesguarda" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: {
					"Actualizar": function() { fevaledit();
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
			
	}		
}
	
	function fevaledit()
	{
		fEditIngPoderes();
		$("#muesguarda").dialog("close");	
	}

	function agregar()
	{
		if(confirm('Nuevo..?'))
			 { 		
				document.getElementById('num_kardex').value = '';	
				document.getElementById('nom_recep').value = '';	
				document.getElementById('hora_recep').value = '';	
				document.getElementById('id_asunto').value = '';	
				document.getElementById('fec_ingreso').value = '';	
				document.getElementById('referencia').value = '';	
				document.getElementById('nom_comuni').value = '';	
				document.getElementById('telf_comuni').value = '';	
				document.getElementById('email_comuni').value = '';	
				document.getElementById('documento').value = '';	
				document.getElementById('id_respon').value = '';	
				document.getElementById('des_respon').value = '';	
				document.getElementById('doc_presen').value = '';	
				document.getElementById('fec_ofre').value = '';	
				document.getElementById('hora_ofre').value = '';	
			 }
	}

	function selectAsunto(_obj)
	{
		if(_obj=='004')
		{
			document.getElementById('btnessalud').disabled=false;
			document.getElementById('btnessalud').style.display="";
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnpensiones').style.display="none";
			document.getElementById('btnobs').disabled=true;
			document.getElementById('btnobs').style.display="none";
		}
		
		if(_obj=='003')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnessalud').style.display="none";
			document.getElementById('btnpensiones').disabled=false;
			document.getElementById('btnpensiones').style.display="";
			document.getElementById('btnobs').disabled=true;
			document.getElementById('btnobs').style.display="none";
		}
		
		if(_obj=='001' || _obj=='002')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnessalud').style.display="none";
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnpensiones').style.display="none";
			document.getElementById('btnobs').disabled=false;
			document.getElementById('btnobs').style.display="";
		}
			
	}



// #===================================
// #=== MUESTRA GENERACION   -  PODERES
	function fGenerar()
	{
	
		var _id_poder  = document.getElementById('id_poder');
		var _id_poder2 = document.getElementById('id_poder').value;
		
		if(_id_poder.value=='')
		{alert('Debe ingresar y grabar los datos primero...');return;}
	
	$('<div id="div_generacion" title="div_generacion"></div>').load('IngPoderGenerar.php?id_poder='+_id_poder2)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 500,
					height  : 300,
					modal:false,
					resizable:false,
					buttons: [{id: "btnGenerar", text: "Generar",click: function() {pasadatosPod(); }},
					{id: "btnQuitGenerar", text: "Quitar Generacion",click: function() {QuitaPod(); }},
					//{id: "btnImprimir", text: "Imprimir",click: function() {fImprimir(); }},
					{id: "btnCerrar", text: "Cerrar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Generar Poder '
					
					}).width(500).height(300);	
					$(".ui-dialog-titlebar").hide();	
	}


// #################################
// ##= Imprime Ingreso poderes. =###
	function fImprimir()
	{
		var _tip_poder = document.getElementById('id_asunto').value;
		
		var _id_poder = document.getElementById('id_poder').value;
		if(_id_poder == ''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
		_data = {
					id_poder : _id_poder,
					usuario_imprime : _usuario_imprime,
					nom_notario : _nom_notario
					
					
				}
		
	// #= PENSION ONP:	
	if(_tip_poder=='003')
		{		
			$.post("../../reportes_word/generador_poderONP.php",_data,function(_respuesta){
						alert(_respuesta);
					});
		}
		
	// #= PODER ESSALUD:		
	else if(_tip_poder=='004')
		{		
			$.post("../../reportes_word/generador_poder_essalud.php",_data,function(_respuesta){
						alert(_respuesta);
					});			
		}
	
	// #= PODER FUERA DE REGISTRO:			
	else if(_tip_poder=='002')
		{
			$.post("../../reportes_word/generador_poder_fueraregistro.php",_data,function(_respuesta){
						alert(_respuesta);
					});
		}	
	
	}

	function fNoCorrePoder()
	{
		var _id_poder = document.getElementById('id_poder');
		if(_id_poder.selectedIndex=='0'){alert('No se ha grabado el Poder');return;}
		
		else 
		{
			$( "#mues_nocorre" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: {
					"Aceptar": function() { fevalNocorre();
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}	
	}

	function fevalNocorre()
	{
		fNocorreActionPoder();
		$("#mues_nocorre").dialog("close");
	}

function fVisualDocument()
	{
		var _tip_poder = document.getElementById('id_asunto').value;
		
		var _id_poder = document.getElementById('id_poder').value;
		if(_id_poder == ''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_poder.php?id_poder="+_id_poder+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);
			
	}

function fbuscanrocontrol(numero){
    if (!/^([0-9])*$/.test(numero))
      alert("El valor " + numero + " no es un número");
	  document.getElementById('id_poder').value='';

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
 
  
    if( !er_telefono.test(frmbuscakardex.telf_comuni.value) ) {
        alert('Caracter Incorrecto.')
		document.getElementById('telf_comuni').value='';

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
</script>
</head>

<body style="font-size:62.5%;">
<div id="permisos_viaje">
<form name="frmbuscakardex" method="post" action="">
 <?php
			  if($rowu['editpod'] == '1')
              {
                    echo'<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="29%">'; ?>
     <?php
				$oBarra->Graba        = "1"                   ;
				$oBarra->GrabaClick   = "fGraba();"           ;
				$oBarra->Genera       = "1"                   ;
				$oBarra->GeneraClick  = "fGenerar();"         ;
				$oBarra->Impri        = "1"                   ;
				$oBarra->ImpriClick   = "fImprimir();"        ;
				$oBarra->clase        = "css"      		      ; 
				$oBarra->widthtxt     = "20"				  ; 
				$oBarra->Show()  						      ; 
				?>
    <?php echo'</td>
    <td width="27%" align="left"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
    <td width="33%" align="left"><div id="div_muesStatusNC"></div></td>
    <td width="11%" align="left"> <button title="No corre" type="button" name="nocorre"    id="nocorre" value="no corre" onclick="fNoCorrePoder();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />No Corre</button></td>
</tr>
</table>';
			  }else{
				    echo'';
				  }
              
			  
			  ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td >
    <fieldset id="cabecera">
    <legend></legend>
    <table  width="100%">
        <tr>
          <td colspan="4"><table  width="100%">
            <tr>
              <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea Actualizar el Poder..?</div><div id="mues_nocorre" title="Confirmacion" style="display:none">Se cambiara el estado del Poder a : NO CORRE</div><div id="confirmaGuarda"></div></td>
            </tr>
            <tr>
              <td width="14%"><span class="camposss">Nro Control:</span></td>
              <td width="17%"><input name="num_kardex" type="hidden" id="num_kardex" style="text-transform:uppercase" value="<?php echo $rowpoder['num_kardex']; ?>" size="15" />
              <input name="id_poder" type="text" id="id_poder"  value="<?php echo $id_poder; ?>" size="15" style="text-transform:uppercase" onkeyup="fbuscanrocontrol(this.value)" /><input name="mues_kardex" type="hidden" id="mues_kardex" style="text-transform:uppercase" value="<?php echo $numkar2; ?>" size="15" />
              </td>
              <td width="13%" align="right"><span class="camposss">
                Hora:</span></td>
              <td width="34%"><input name="hora_recep" type="text" id="hora_recep" style="text-transform:uppercase"  onkeypress="return solonumeros(event)" value="<?php echo $rowpoder['hora_recep']; ?>" size="10" maxlength="10"/>
                <input name="nom_recep" type="hidden" id="nom_recep" style="text-transform:uppercase" value="<?php echo $rowpoder['nom_recep']; ?>" size="15" /></td>
              <td width="6%">&nbsp;</td>
              <td width="16%">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td width="19%"><span class="camposss">Tipo Poder:</span></td>
          <td colspan="3"><input name="idasunto" type="hidden" id="idasunto" style="text-transform:uppercase" value="<?php echo $rowpoder['id_asunto']; ?>" size="2" readonly />&nbsp;
          <input name="des_asunto" type="hidden" id="des_asunto" style="text-transform:uppercase" value="<?php echo $rowpoder['id_asunto']; ?>" size="7" readonly />
            <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT poderes_asunto.id_asunto AS 'id', poderes_asunto.des_asunto AS 'des'
FROM poderes_asunto 
WHERE poderes_asunto.conte_asunto != 'F'
ORDER BY poderes_asunto.des_asunto ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "id_asunto";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "selectAsunto(this.value);";   
			$oCombo->selected   =  $rowpoder['id_asunto'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
</td>
          </tr>
        <tr>
          <td><span class="camposss">Fec. Ingreso</span></td>
          <td width="10%"><input name="fec_ingreso" type="text" class="tcal" id="fec_ingreso" style="text-transform:uppercase" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo $rowpoder['fec_ingreso2']; ?>" size="10" maxlength="10"/></td>
          <td width="14%"><span class="camposss">Referencia:</span> </td>
          <td width="57%"><input name="referencia" type="text" id="referencia" style="text-transform:uppercase" value="<?php echo $rowpoder['referencia']; ?>" size="50" maxlength="900"  /></td>
          </tr>
        <tr>
          <td><span class="camposss">Comunicarse con:</span> </td>
          <td><input name="nom_comuni" type="text" id="nom_comuni" style="text-transform:uppercase" value="<?php echo $rowpoder['nom_comuni']; ?>" size="30" maxlength="400" onkeypress="return soloLetras(event)"/></td>
          <td><span class="camposss">Telefono:</span> </td>
          <td><input name="telf_comuni" type="text" id="telf_comuni" style="text-transform:uppercase" value="<?php echo $rowpoder['telf_comuni']; ?>" size="10" maxlength="200" onkeypress="return solonumeros(event)"/></td>
        </tr>
        <tr>
          <td><span class="camposss">Email:</span></td>
          <td><input name="email_comuni" type="text" id="email_comuni" value="<?php echo $rowpoder['email_comuni']; ?>" size="30" maxlength="400" /></td>
          <td></td>
          <td><input name="documento" type="hidden" id="documento" style="text-transform:uppercase" value="<?php echo $rowpoder['documento']; ?>" size="20" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Responsable Not.</span></td>
          <td colspan="3">
<input name="id_respon" type="text" id="id_respon" style="text-transform:uppercase" readonly value="<?php echo $rowpoder['id_respon']; ?>" size="60" maxlength="400" onkeypress="return soloLetras(event)"/>
            <input name="des_respon" type="hidden" id="des_respon" style="text-transform:uppercase" value="<?php echo $rowpoder['des_respon']; ?>" size="40" /></td>
          </tr>
        <tr>
          <td valign="top"></td>
          <td colspan="3"><label for="doc_presen"></label>
            
            <input name="doc_presen" type="hidden" id="doc_presen" /></td>
        </tr>
        <tr>
          <td valign="top"></td>
          <td><input name="fec_ofre" type="hidden" id="fec_ofre" style="text-transform:uppercase" value="<?php echo $rowpoder['fec_ofre']; ?>" size="15" /></td>
          <td></td>
          <td><input name="hora_ofre" type="hidden" id="hora_ofre" style="text-transform:uppercase" value="<?php echo $rowpoder['hora_ofre']; ?>" size="10" /></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><div id="btn_poderes"><fieldset id="cabecera">
            <button title="Contratantes" type="button" name="btncontratantes"    id="btncontratantes" value="contratantes" onclick="fmuesContratantes();" ><img src="../../images/newuser.png" width="20" height="20" align="absmiddle" />&nbsp; Participantes</button>  &nbsp;&nbsp;
            
            <button title="essalud" type="button" name="btnessalud"    id="btnessalud" value="essalud" onclick="fmuesEssalud();" ><img src="../../images/health.png" width="20" height="20" align="absmiddle" />&nbsp; Essalud</button> &nbsp;&nbsp;
            
             <button title="Pensiones" type="button" name="btnpensiones"    id="btnpensiones" value="pensiones" onclick="fmuesPensiones();" ><img src="../../images/pay.png" width="20" height="20" align="absmiddle" />&nbsp; Pensiones</button> &nbsp;&nbsp;
            
                      <button title="Observacion" type="button" name="btnobs"    id="btnobs" value="observacion" onclick="fmuesObservacion();" ><img src="../../images/obs.png" width="20" height="20" align="absmiddle" /> Formato libre</button></fieldset></div></td>
          </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30" >
    <input name="id_poder" type="hidden" id="id_poder"  value="<?php echo $id_poder; ?>"/>
    
    <input name="num_cronoG" type="hidden" id="num_cronoG" />
    <input name="fecha_cronoG" type="hidden" id="fecha_cronoG" />
    <input name="num_formuG" type="hidden" id="num_formuG" />
    <input name="lugar_formuG" type="hidden" id="lugar_formuG" />
    <input name="observacionG" type="hidden" id="observacionG" />
    </td>
  </tr>
</table>
</form>
</div>
</body>
</html>