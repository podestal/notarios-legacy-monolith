<?php 
session_start();
include("../../conexion.php");
require_once("../includes/combo.php") ;   
	
;

	$oCombo = new CmbList()  				  ;		
$civil = mysql_query("SELECT * FROM 
tipoestacivil",$conn) or die(mysql_error

());
$naci = mysql_query("SELECT * FROM 
nacionalidades order by desnacionalidad 
asc",$conn) or die(mysql_error());

	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancelacion de Documentos</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 

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


#field_remitente, #field_destinatario, #field_responpago, #field_diligencia, #field_cargo{
	margin:0 auto;
	border: 2px solid #ddd; 
	border-radius: 10px; 
	padding: 2px; 
	box-shadow: #ccc 5px 0 5px;
	margin-bottom:0px;
	}

.fielSetTipoVista{
	width:100%;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#000;
	font-weight:bold;
	border:#000 solid 1px;
	box-shadow: #ccc 5px 0 10px;
	border-radius: 10px; 
	}
	
</style>
<script type="text/javascript">

$(document).ready(function(){ 
		//$("input, textarea, select, button").uniform(); 
	 //$("input, textarea, select, button").uniform();
	 //$("button").button();
	 $("#dialog").dialog();
	 //$(".ui-dialog-titlebar").hide();
	 //muestragrid();
	})

jQuery(function($){
//$("#cumpclie").mask("99/99/9999",{placeholder:"_"});

});

function muesdatos()
{
	muestragrid();
}

function selectidkar(id) {
	
document.getElementById('datos').value = id;
fllenardatos();
}

function fllenardatos()
{
	/*_datos = document.getElementById('datos').value;
	_datos = _datos.split('|');
	document.getElementById('idkardex').value = _datos[0];
	document.getElementById('tipkar').value = _datos[1];
	document.getElementById('nomtipkar').value = _datos[2];*/
	
}


function focusSearch(evento)
{if(evento.keyCode==13){document.getElementById('Buscar').focus();}} 

function fini()
{
	//document.getElementById('cboBusca').selectedIndex='1'
	//document.getElementById('txtBuscar').focus();
}	
function ggclie1()
    {   
	var _apepat = document.getElementById('apepat');
	var _prinom = document.getElementById('prinom');
	var _dire   = document.getElementById('direccion');
	var _ecivil = document.getElementById('idestcivil');
	var _ubigensc = document.getElementById('ubigensc');
	var _sexo   = document.getElementById('sexo');
	var _nomprofesiones   = document.getElementById('nomprofesiones');
	//var _nomcargoss   = document.getElementById('nomcargoss');
	
	
	
	if( _apepat.value == '' || _prinom.value == '' || _dire.value == '' || _ecivil.selectedIndex=='0' || _ubigensc.value == '' || _sexo.selectedIndex == '0' || _nomprofesiones.value == '')
	
	{alert('Faltan ingresar datos');return;}
	else{
	   grabNewClient();
	  
		}
  
    }
function ggclie5()
    {   
	   grabNewConyuge();
	   ocultar_desc('conyugesss');  
	   
	   //alert("Cliente grabado satisfactoriamente");
    }	
function ggjuridica()
{
	grabNewJurid2();
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
function mostrarubigeoo2(id,name)
    {
		
  document.getElementById('codubisc4').value = name;
  document.getElementById('ubigen2').value = id;
  ocultar_desc('buscaubi');        
    }
	
function mostrarubigeoosc(id,name)
    {
  	  document.getElementById('ubigensc').value = id;
	  document.getElementById('codubisc').value = name;	
	  ocultar_desc('buscaubisc');        
    }
	
function mostrarubigeoosc2(id,name)
	{
		
	  if(document.getElementById('ubigensc2'))
	  {
	  document.getElementById('ubigensc2').value = id;
	  }
	  if(document.getElementById('codubis2'))
	  {
	  document.getElementById('codubis2').value = name;
	  }
	  ocultar_desc('buscaubisc2');
	}
function mostrarprofesioness(id,name)
    {
  document.getElementById('idprofesion').value = id;
  document.getElementById('nomprofesiones').value = name;  
  ocultar_desc('buscaprofe');        
    }
function mostrarprofesioness2(id,name)
    {
  document.getElementById('idprofesion2').value = id;
  document.getElementById('nomprofesiones2').value = name;  
  ocultar_desc('buscaprofe2');        
    }
function mostrarcargoos(id,name)
    {
  document.getElementById('idcargoo').value = id;
  document.getElementById('nomcargoss').value = name; 
  ocultar_desc('buscacargooo');        
    }	
function mostrarcargoos2(id,name)
    {
  document.getElementById('idcargoo2').value = id;
  document.getElementById('nomcargoss2').value = name; 
  ocultar_desc('buscacargooo2');        
    }	
		
	
function mostrarubigeoosc3(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('codubi').value = name;  
  ocultar_desc('buscaubi');        
    }
	
function casadito(valor)
{
  /* if(valor==2){
    mostrar_desc('casado');
   }else{
    ocultar_desc('casado');
   }*/
}		


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(window).ready(function(){ 

	 ShowDetComprobante()
	 $('#div_buscadoc').attr('style','display:none');
	 $('#fAgregarItem').attr('style','display:none');
	 
	 $('#cboBusca').val('2');

	 //$("input, textarea, select, button").uniform();
	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	 //$("#div_bloques").sortable();
	 
	 ShowCCarac();
	 
	 $(".ui-dialog-titlebar").hide();
	 //muestragrid();
	})

jQuery(function($){
    $("#fec_ingreso").mask("99/99/9999",{placeholder:"_"});
});

// #==============================================================


////////
function NumCheck(e, field) {
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
////////


function fGraba2()
{
	var _numdoc		  = document.getElementById('num_docu');
	var _solicitante  = document.getElementById('nombre'); 

	if(_numdoc.value=='' || _solicitante.value=='')
	{alert('Faltan ingresar datos');return;}
	
	else 
	{
		$( "#muesguarda" ).dialog({
			resizable: false,
			height:140,
			position :["center","top"],
			modal: true,
			buttons: {
				"Aceptar": function() { fevalguarda();
					//$( this ).dialog( "close" );
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});
	}	
}
// #==============================================================
function fevalguarda()
{
	
	fguardaCambio();
	$("#muesguarda").dialog("close");
    //$("#muesguarda").remove();
}
// #==========================================================================
// #==========================================================================
function ShowCCarac()
{
$('#div_cambiocar').load('listdetCCarac.php');		
}

function fAddDetalle()
{
	var _id_cambio = document.getElementById('id_cambio').value;
	var _detalle = document.getElementById('detalle_cambios').value;
	
	if(_id_cambio == '')
	{
		alert('Debe ingresar y grabar los datos primero...');return;
	}
	else if(_id_cambio != '')	
	{
		if(_detalle == ''){alert('Debe seleccionar la caracteristica');return;}
		fPassData();
		//$('#div_cambiocar').load('listdetCCarac.php?detalle='+_detalle+'&id_cambio='+_id_cambio);
	}
	
}

// #=============================================================

function fPassData2()
{
	var _id_cambio = document.getElementById('id_cambio').value;
	var _detalle = document.getElementById('detalle_cambios').value;
	$('#div_cambiocar').load('listdetCCarac.php?detalle='+_detalle+'&id_cambio='+_id_cambio);	
}

// #=============================================================

function fElimDetalle()
{
	var _id_cambio = document.getElementById('id_cambio').value;
	var _detalle = document.getElementById('detalle_cambios').value;
	
	if(_id_cambio == '')
	{
		alert('Debe ingresar y grabar los datos primero...');return;
	}
	else if(_id_cambio != '')	
	{
		if(_detalle == ''){alert('Debe seleccionar la caracteristica a eliminar');return;}
		fElimData();
		//$('#div_cambiocar').load('listdetCCarac.php?detalle='+_detalle+'&id_cambio='+_id_cambio);
	}
	
}
 
function fElimData2()
{
	var _id_cambio = document.getElementById('id_cambio').value;
	var _detalle = document.getElementById('detalle_cambios').value;
	$('#div_cambiocar').load('listdetCCarac.php?detalle='+_detalle+'&id_cambio='+_id_cambio);	
	//alert('Se elimino satisfactoriamente');	
}	
// #========== AGREGAR NEW PARTICIPANTES ===============# 
function newParticipante()
{
	//var _id_viaje = document.getElementById('id_viaje').value;
	//var _id_contratante = "";
	
var divobs = $('<div id="div_newpartic" title="div_newpartic"></div>');
// carga con ajax y abre el dialog.
$('<div id="div_newpartic" title="div_newpartic"></div>').load('NewRemitente.php')
.dialog({
				autoOpen: true,
				position :["center","top"],
                width   : 720,
                height  : 350,
                modal:false,
                resizable:false,
				//show: 'clip',
				//hide: 'clip',
				buttons: [{id: "btnAcepPartic2", text: "Aceptar",click: function() {/*$(this).dialog("close");*/ }},
				{text: "Cancelar",click: function() {$(this).dialog("close"); }}],
                title:'Agregar participantes'
				
                }).width(720).height(350);	
				$(".ui-dialog-titlebar").hide();		
}


// ################
// ################
function ShowDetComprobante()
{
	var _firsteval = "0";
$('#div_detalle').load('listDocsPen.php?evalbus='+_firsteval);		
}

function fTipoBusq()
{
		var _tipbus = $('#tipoper').val();	
	if(_tipbus=='N') 	   // x documento
	{
		$('#numdoc').val('');
		$('#apepat').val('');
		$('#apemat').val('');
		$('#prinom').val('');
		$('#segnom').val('');
		$('#direccion').val('');
		$('#ubigensc').val('');
		$('#natper').val('');
		$('#cumpclie').val('');
		$('#nomprofesiones').val('');
		$('#nomcargoss').val('');
		$('#telcel').val('');
		$('#telofi').val('');
		$('#telfijo').val('');
		$('#email').val('');
		$('#codubisc').val('');
		$('#idprofesion').val('');
		$('#idcargoo').val('');
		$('#div_buscadoc').attr('style','display:none');
		$('#div_buscaclie').removeAttr('style');
	}
	else if(_tipbus=='J')  // x codigo de cliente
	{
		$('#razonsocial').val('');
		$('#domfiscal').val('');
		$('#ubigen2').val('');
		$('#contacempresa').val('');
		$('#fechaconstitu').val('');
		$('#numregistro').val('');
		$('#numpartida').val('');
		$('#telempresa').val('');
		$('#actmunicipal').val('');
		$('#mailempresa').val('');
		$('#codubisc4').val('');
		$('#div_buscaclie').attr('style','display:none');
		$('#div_buscadoc').removeAttr('style');
	}
}
 
function fBuscaDoc()
{
	var _evalbus     = $('#cboBusca').val();  //  #1- documento  #2. Codigo Cliente.
	var _codigo_cli  = $('#txtcodigo').val();
	var _tipo_docu   = $('#tipdocu').val();
	var _serie       = $('#txtserie').val();
	var _documento   = $('#txtnumdocu').val();	
	
	if(_evalbus=='1') 	   // x documento
	{
		$('#div_detalle').load('listDocsPen.php?evalbus='+_evalbus+'&tipo_docu='+_tipo_docu+'&serie='+_serie+'&documento='+_documento);
	}
	else if(_evalbus=='2')  // x codigo de cliente
	{
		$('#div_detalle').load('listDocsPen.php?evalbus='+_evalbus+'&codigo_cli='+_codigo_cli);
	}		
} 

function PagarDocu(_obj)
{
	var _id_ctaventas = _obj ;
	var _vars = fShowAjaxDato('../includes/DatosCtaCte.php?id_ctaventas='+_id_ctaventas);
	document.getElementById('datosCC').value = _vars;
	//alert(document.getElementById('datosCC').value);
	var _datos = document.getElementById('datosCC').value;
	
	_datos = _datos.split('|');
	
		var _id_ctaventas = _datos[0];
		var _tipdoc       = _datos[7];
		var _cliente      = _datos[6];
		var _fecha        = _datos[4];
		var _forpago      = _datos[10];
		//var _concepto     = _datos[1];
		var _monto        = _datos[15];
		var _saldo        = _datos[16];
		var _serie        = _datos[2];
		var _numdoc       = _datos[3];
		//var _emple        = _datos[1];
		var _swtdet       = _datos[17];
		var _montodet     = _datos[18];
		var _banco        = _datos[11];
		var _numero       = _datos[12];
	
	document.getElementById('id_ctaventas').value = _id_ctaventas;	
	document.getElementById('tipdocu2').value = _tipdoc;	
	document.getElementById('cliente').value = _cliente;
	document.getElementById('txtfecha').value = _fecha;	
	document.getElementById('tippago').value = _forpago;	
	document.getElementById('txtmonto').value = _monto;	
	document.getElementById('txtsaldo').value = _saldo;	
	document.getElementById('seriedoc').value = _serie;	
	document.getElementById('numdocumen').value = _numdoc;	
	document.getElementById('txtmonreten').value = _montodet;
		
	/*if(_montodet=='0.00' || _montodet=='')
	{
		document.getElementById('swtreten').checked = false;
	}
	else if(parseFloat(_montodet) > 0.00)
	{
		document.getElementById('swtreten').checked = true;	
	}*/
	
	document.getElementById('txtbanco').value = _banco;	
	document.getElementById('numcta').value = _numero;		
	
	
	//$('#fAgregarItem').removeAttr('style');
	$('#fAgregarItem').fadeIn();
		
}

function fOcultaAdd()
{	
	$('#id_ctaventas').val('');
	$('#tipdocu2').val('');
	$('#cliente').val('');
	$('#tippago').val('');
	$('#txtmonto').val('');
	$('#txtsaldo').val('');
	$('#seriedoc').val('');
	$('#numdocumen').val('');
	$('#txtmonreten').val('');
	$('#txtbanco').val('');
	$('#numcta').val('');
	//document.getElementById('swtreten').checked   = false;
	
	$('#fAgregarItem').fadeOut();
}
 
function fAgregaAdd()
{
	var _id_ctaventas = $('#id_ctaventas').val();
	var _tipdocu2     = $('#tipdocu2').val();
	var _cliente      = $('#cliente').val();
	var _tippago      = $('#tippago').val();
	var _txtmonto     = $('#txtmonto').val();
	var _txtsaldo     = $('#txtsaldo').val();
	var _seriedoc     = $('#seriedoc').val();
	var _numdocumen   = $('#numdocumen').val();
	var _txtmonreten  = $('#txtmonreten').val();
	var _txtbanco     = $('#txtbanco').val();
	var _numcta       = $('#numcta').val();	
	var _txtfecha     = $('#txtfecha').val();	
	
	if(_txtsaldo > _txtmonto)
	{alert('El monto a pagar supera el Monto total del documento');return;}
	
    if(_id_ctaventas == '')
	{
		alert('Debe seleccionar un documento a cancelar...');return;
	}
	else if(_id_ctaventas != '')	
	{
		if(_tipdocu2 =='' || _cliente == '' ||  _tippago == '' || _txtsaldo == '' || _seriedoc == '' || _numdocumen == '')
		{alert('Falta ingresar datos...');return;}
		fUpdateCtaCte();	
		//$('#fAgregarItem').fadeOut();
		
		//$('#div_cambiocar').load('listdetCCarac.php?detalle='+_detalle+'&id_cambio='+_id_cambio);
		//fCalculosGeneral();
	}
	
} 
function estado()
{
	
	var _valor = document.getElementById('idestcivil').value;
	if(_valor==2){
		mostrar_desc('casado');
		}else{
			ocultar_desc('casado');
			}
}
 
 
     function fShowDatosProvee(evento) //
		{			
			var _numdoc		= document.getElementById('numdoc').value;
			
			
			if(evento.keyCode==13) 
				{
					
					if(_numdoc=='')
					{
							alert('Ingrese un numero de documento');
							return;
					}
						var _des = fShowAjaxDato('../../facturacion/includes/remitente.php?numdoc='+_numdoc);

						if(_des!='')
						{
							alert('El numero de documento ingresado ya existe')
							$('#numdoc').val('');
						}
						
						
						
				    }
		}
		  function fShowDatosProvee2(evento) //
		{			
			var _numdoc		= document.getElementById('numdoc2').value;
			
			
			if(evento.keyCode==13) 
				{
					
					if(_numdoc=='')
					{
							alert('Ingrese un numero de documento');
							return;
					}
						var _des = fShowAjaxDato('../../facturacion/includes/remitente.php?numdoc='+_numdoc);

						if(_des!='')
						{
							alert('El numero de documento ingresado ya existe')
							$('#numdoc2').val('');
						}
						
						
						
				    }
		}
 
</script>



		

</head>
<body style="font-size:62.5%;">
<div id="carta_content">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
    </td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  
  <tr>
<td height="93"><table width="601" height="51" border="" cellspacing="0" cellpadding="0">
  <tr>
    <th width="137"  align="center"><span class="camposss">Tipo de persona:</span></th>
    <td width="141"><select name="tipoper" id="tipoper"  onChange="fTipoBusq()">
      <option value = "" selected="selected" >TIPO DE PERSONA</option>
      <option value="N" selected="selected">Natural</option>
      <option value="J">Jurídica</option>
    </select></td>
    <td width="137" align="center"><span class="camposss" >Tipo Docum.</span></td>
    <td width="178"><?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.idtipdoc AS 'id', tipodocumento.destipdoc AS 'des' FROM tipodocumento"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipodoc";
			
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
  </tr>
</table></td>
</tr>
  <tr>
    <td>
      <fieldset id="field_remitente">
    <legend><span class="camposss">Detalles</span>
    </legend>
<div id="div_buscaclie">
   <table width="607" height="480" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Num. Docu.:</span></td>
    <td height="30" colspan="3"><input name="numdoc" type="text" id="numdoc"  maxlength="8" onKeyPress="fShowDatosProvee(event);"/><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td width="10" height="30">&nbsp;</td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Paterno :</span></td>
    <td width="180" height="30"><input type="text" name="apepat" style="text-transform:uppercase" id="apepat" /><span style="color:#F00">*</span></td>
    <td width="119" height="30" align="right"><span class="camposss">Apellido Materno :</span></td>
    <td width="179" height="30"><input type="text" name="apemat" style="text-transform:uppercase" id="apemat" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">1er Nombre :</span></td>
    <td height="30"><input type="text" name="prinom" style="text-transform:uppercase" id="prinom" /><span style="color:#F00">*</span></td>
    <td height="30" align="right"><span class="camposss">2do Nombre :</span></td>
    <td height="30"><input type="text" name="segnom" style="text-transform:uppercase" id="segnom" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Direccion :</span></td>
    <td height="30" colspan="3"><input name="direccion" style="text-transform:uppercase" type="text" id="direccion" size="60" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="30" colspan="3"><table width="412" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="289"><input name="ubigensc" readonly type="text" id="ubigensc" size="45" /></td>
        <td width="223"><a href="#" onClick="mostrar_desc('buscaubisc')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
       <!-- buscar ubi --> 
      <div id="buscaubisc" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
            <td width="28"><a href="#" onClick="ocultar_desc('buscaubisc')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaubisc3" type="text" id="buscaubisc3"  style="background:#FFFFFF;" size="50" onKeyPress="buscaubigeosscNew()" />
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
    </div>
    <!-- DIV BUSCAR PROFESIONES -->
    <div id="buscaprofe" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe')"><img src="../../iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes" type="text" id="buscaprofes"  style="background:#FFFFFF;" size="50" onKeyPress="buscaprofesionesNew()" />
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
   <!-- DIV BUSCAR CARGO --> 
   <div id="buscacargooo" style="position:absolute; display:none; width:637px; height:223px; left: 8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left;  -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo')"><img src="../../iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss" type="text" id="buscacargooss"  style="background:#FFFFFF;" size="50" onKeyPress="buscacarguitossNew()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargito" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
   
   <span style="color:#F00">*</span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right">&nbsp;</td>
    
    <td height="30"><div id="conyugesss" style="position:absolute; display:none; width:662px; height:307px; left: 3px; top: 282px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="13" height="29">&nbsp;</td>
      <td width="130"><span class="camposss">Ingresar Conyuge </span></td>
      <td width="206" align="right" class="camposss">N° D.N.I. :</td>
      <td width="143"><input name="numdoc2" type="text" id="numdoc2" style="background:#FFFFFF" size="20" maxlength="8"  onKeyPress="fShowDatosProvee2(event);" /></td>
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
</div></td>
    <td></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    
    <td height="30"><select name="idestcivil" id="idestcivil" onChange="estado()" style="width:160px;">
      <option value = "0" selected="selected">SELECCIONE ESTADO</option>
      <?php
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select><span style="color:#F00">*</span></td>
    <td height="30" colspan="2" align="left"><div id="casado" style="display:none;">
      <table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a href="#" onClick="mostrar_desc('conyugesss')"><img src="../../iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
        </tr>
      </table>
    </div>    </td>
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
    <td height="30"><div id="ccconyuge"><input name='cconyuge6' id='cconyuge6' type='hidden' value='' /></div></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select style="width:120px;" name="nacionalidad" id="nacionalidad">
      <option value = "177" selected="selected">PERU</option>
      <?php
		  while($rownaci=mysql_fetch_array($naci)){
		  echo "<option value = ".$rownaci["idnacionalidad"].">".nl2br($rownaci["desnacionalidad"])."</option>";  
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
    <td height="30" colspan="2" align="right"><span class="camposss">Pais de Emisi&oacute;n del Documento de Identidad :</span></td>
    <td height="30" colspan="2"><label>
      <input type="text" name="docpaisemi" id="docpaisemi" value="PERU" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Prof./Ocupaci&oacute;n :</span></td>
    <td height="30" colspan="3"><table width="410" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomprofesiones" type="text" id="nomprofesiones" size="45" readonly />
        </label></td>
        <td width="129"><a href="#" onClick="mostrar_desc('buscaprofe')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /><span style="color:#F00">*</span></a></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Cargo :</span></td>
    <td height="30" colspan="3"><table width="409" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="281"><label>
          <input name="nomcargoss" type="text" id="nomcargoss" size="45" readonly />
        </label></td>
        <td width="128"><a href="#" onClick="mostrar_desc('buscacargooo')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /><span style="color:#F00">*</span></a></td>
      </tr>
    </table></td>
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
    <td height="30"> <input name="telfijo" type="text" id="telfijo" size="20" /></td>
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
    <td height="30"><a  onclick="ggclie1()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idprofesion" type="hidden" id="idprofesion" size="15" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" /></td>
  </tr>
</table>
        </div>



<div id="div_buscadoc">
 
         <table width="637" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
  
    <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
    <td height="32" >&nbsp;</td>
    <td height="32" colspan="5"><label>
      <input name="razonsocial" type="text" style="text-transform:uppercase" id="razonsocial" size="60" /><span style="color:#F00">*</span>
    </label>      <label></label>    <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
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
            <td width="95"><a href='#' onClick="ocultar_desc('menucondicion')"><img src="iconos/aceptar.png" alt="" width="95" height="29" border="0" /></a></td>
            <td height="10">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="middle"></td>
          </tr>
        <tr></tr>
        </table>
    </div>
   </td>
 
  </tr>
  <tr>
    <td height="26" align="right" ><span class="camposss">Nro RUC</span></td>
    <td height="26" >&nbsp;</td>
    <td height="26" colspan="5">
      <input name="numruc" style="text-transform:uppercase" type="text" id="numruc" size="60" />
   <span style="color:#F00">*</span>
     </td>
  </tr>
  <tr>
    <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
    <td height="26" >&nbsp;</td>
    <td height="26" colspan="5">
      <input name="domfiscal" style="text-transform:uppercase" type="text" id="domfiscal" size="60" />
   <span style="color:#F00">*</span>
     </td>
  </tr>
  <tr>
    <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
    <td height="0" >&nbsp;</td>
    <td height="0" colspan="5" valign="middle"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="381"><input name="ubigen2" type="text" id="ubigen2" size="60" /><span style="color:#F00">*</span></td>
       
       <td width="223"><a href="#" onClick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
       <!-- buscar ubi --> 
      <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; float:left; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><span class="camposss">Seleccionar Ubigeo:</span></td>
            <td width="28"><a href="#" onClick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaubigeo" type="text" id="buscaubigeo"  style="background:#FFFFFF;" size="50" onKeyUp="buscaubigeosscEditJ()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulubigeo" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
    </div>
    <!-- DIV BUSCAR PROFESIONES -->
    
   <!-- DIV BUSCAR CARGO --> 
   
   
   <span style="color:#F00">*</span> </td>
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
    <td width="152" height="30"><input type="text" name="fechaconstitu" class="tcal" style="text-transform:uppercase" id="fechaconstitu" /></td>
    <td width="14" height="30" >&nbsp;</td>
    <td width="135" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
    <td width="11" height="30" >&nbsp;</td>
    <td width="208" height="30" ><input type="text" name="numregistro" style="text-transform:uppercase" id="numregistro" /></td>
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
      <input type="text" name="numpartida" style="text-transform:uppercase" id="numpartida" />
    </label></td>
  </tr>
  <tr>
    <td width="110" height="30" align="right" ><span class="camposss">Telefono</span></td>
    <td width="7" height="30" >&nbsp;</td>
    <td height="30"><label>
      <input type="text" name="telempresa" style="text-transform:uppercase" id="telempresa" />
    </label></td>
    <td height="30">&nbsp;</td>
    <td height="30" align="right" >CIIU</td>
    <td height="30" >&nbsp;</td>
    <td height="30" ><label>
       <select style="width:200px;" name="actmunicipal" id="actmunicipal">
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
    </label> </td>
  </tr>
  <tr>
    <td height="30" align="right" >&nbsp;</td>
    <td height="30" >&nbsp;</td>
    <td height="30" colspan="5" ><a  onclick="ggjuridica()"><img src="../../iconos/grabar.png" width="94" height="29" border="0" />
      <input name="codubisc4" type="hidden" id="codubisc4" size="15" />
    </a></td>
  </tr>
</table>
        </div>
</fieldset>  
      </td>
    </tr>
</table>
</div>
</body>
</html>