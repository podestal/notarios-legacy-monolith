<?php 
session_start();

	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1  = new GridView()					 ;
	$oCombo = new CmbList()  				     ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cambio de Caracteristicas</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../includes/css/CambioCaracVie.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/js/CambioCaracVie.js"></script>
<script type="text/javascript">

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
 
  
    if( !er_telefono.test(frmbuscakardex.tel_comu.value) ) {
        alert('Caracter Incorrecto.')
        return false
    }
 
  
    return false           
}



function validacion4() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([A-Z\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.ubigen.value) ) {
        alert('Caracter Incorrecto.')
		document.getElementById('ubigen').value='';
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
  document.getElementById('distrito_solic').value = name;  
  ocultar_desc('buscaubi');     
        
    }


$(document).ready(function(){ 
	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();	 
	 ShowCCarac();
	 $(".ui-dialog-titlebar").hide();
	 $('#div_newsolicitante').attr('style','display:none'); 
	 $("#contienepersona").removeAttr("style","display:none");
	 var _id_cambio = document.getElementById('id_cambio').value;
	 $('#llamaphp').load('list_cambios.php?id_cambio='+_id_cambio);
	 
	 // Oculta el boton: agregar solicitante
	 $("#div_show_btnSolic").attr("style","display:none");
	 
	})


	function fVisualDocument()
	{
		var valid_numcrono = document.getElementById('num_crono').value;
		if(valid_numcrono==''){alert('Debe guardar los datos primero');return;}
		var _num_crono = document.getElementById('muesnumcrono').value;
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';

		window.open("genera_cambio.php?num_crono="+_num_crono+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);				
	}
	

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
		
	function validacion()
	{
		
		if	(!$('#tipdoc').val())
		{alert("debe seleccionar tipo de documento");
		}else if($('#tipdoc').val()==01)
		{
			$("#num_docu").attr("maxlength", 8);
		}else if($('#tipdoc').val()==08)
		{
			$("#num_docu").attr("maxlength", 11);
		}
	}
	function validacion1()
	{
		
		if	(!$('#tipdoc_representante').val())
		{alert("debe seleccionar tipo de documento");
		}else if($('#tipdoc_representante').val()==01)
		{
			$("#numdocu_representante").attr("maxlength", 8);
		}else if($('#tipdoc_representante').val()==08)
		{
			$("#numdocu_representante").attr("maxlength", 11);
		}
	}
function newnombre()
	{
		valord=document.getElementById('nnombre').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('nombre').value=textod;
	}
function newdireccion()
	{
		valord=document.getElementById('ndireccion').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('direccion').value=textod;
	}
	
function newrepresentacion()
	{
		valord=document.getElementById('nrepresentacion').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('representacion').value=textod;
	}
	
function nuevonnombre_solic()
	{
		valord=document.getElementById('nnombre_soli').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('nombre_soli').value=textod;
	}
function nuevondireccion_solic()
	{
		valord=document.getElementById('ndireccion_soli').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('direccion_soli').value=textod;
	}
function nuevorepresentacion_solic()
	{
		valord=document.getElementById('nrepresentacion_soli').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('representacion_soli').value=textod;
	}
	
	
	

	function ggpcambiocarac()
	{
		newnombre();
		newdireccion();
		newrepresentacion();
		ggpcambiocaracresult();
			
	}
////////////////////////////////////////////////////////////
	function fShowDatosProvee(evento)
	{
	var _tipdoc     = document.getElementById('tipdoc').value;
	var _numdoc		= document.getElementById('num_docu').value;
	
	var _nombre_solic	= document.getElementById('nnombre');
	var _nombre_soli2   = document.getElementById('nombre');
	
	var _direccion 	    = document.getElementById('ndireccion');
	var __direccion2	= document.getElementById('direccion');
	
	var _distrito   = document.getElementById('distrito_solic');
	var _idestcivil	= document.getElementById('ecivil');
			
			if(evento.keyCode==13) 
				{
					if(_numdoc=='' || _tipdoc==''){alert('Ingrese un numero de documento');return;}
					
					var _des = fShowAjaxDato('../includes/ccnombre.php?numdoc='+_numdoc);
					document.getElementById('nnombre').value = _des;
					document.getElementById('nombre').value = _des;
					
					var _direcc = fShowAjaxDato('../includes/ccdireccion.php?numdoc='+_numdoc);
					document.getElementById('ndireccion').value=_direcc;
					document.getElementById('direccion').value=_direcc;
					
					var _dist = fShowAjaxDato('../includes/ccdistrito.php?numdoc='+_numdoc);
					document.getElementById('distrito_solic').value=_dist;
				
					var _dist2 = fShowAjaxDato('../includes/ccdistrito2.php?numdoc='+_numdoc);
					document.getElementById('ubigen').value=_dist2;
					
						var _estciv = fShowAjaxDato('../includes/ccestciv.php?numdoc='+_numdoc);
					document.getElementById('ecivil').value=_estciv;
						
					if(_nombre_solic.value==''){alert('No se encuentra registrado');
					
					
					$('#nnombre').val('');
					$('#nombre').val('');
					$('#ndireccion').val('');
					$('#direccion').val('');
					$('#distrito_solic').val('');
					$('#ecivil').val('');
					$('#ubigen').val('');
					return; }
				}
	
	}

function fShowDatosProvee1(evento)
	{
	var _tipdoc     = document.getElementById('tipdoc_representante').value;
	var _numdoc		= document.getElementById('numdocu_representante').value;
	var _nrepres	= document.getElementById('nrepresentacion');
	var _nrepres1	= document.getElementById('representacion');	
	
	if(evento.keyCode==13) 
				{
					if(_numdoc=='' || _tipdoc==''){alert('Ingrese un numero de documento');return;}
					
					var _des = fShowAjaxDato('../includes/ccnombre.php?numdoc='+_numdoc);
					document.getElementById('nrepresentacion').value = _des;
					document.getElementById('representacion').value = _des;
					
			
						
					if(_nrepres.value==''){alert('No se encuentra registrado');
					
						$('#nrepresentacion').val('');
				

					return; }
				}
	
	}


///////////////////////////////////////////////
	function ggpcambiocaracresult()
	{ 
		var _id_cambio 		= document.getElementById('id_cambio').value;
		var _num_crono      = document.getElementById('muesnumcrono').value;
		var _nombre 		= document.getElementById('nombre').value;
		var _tipdoc			= document.getElementById('tipdoc').value;
		var _num_docu 		= document.getElementById('num_docu').value;
		var _direccion 		= document.getElementById('direccion').value;
		var _ecivil 		= document.getElementById('ecivil').value;
		var _id_solicitante = document.getElementById('id_solicitante').value;
		var _representante 	= document.getElementById('representacion').value;
		var _poder_inscrito = document.getElementById('poder_inscrito').value;
		var _int_legitimo 	= document.getElementById('int_legitimo').value;
		var _tipdoc_rep		= document.getElementById('tipdoc_representante').value;
		
		var _numdoc_rep		= document.getElementById('numdocu_representante').value;
		//NEW
		var _distrito_solic 	= document.getElementById('distrito_solic').value;
		
		var data = {
			id_cambio       : _id_cambio,
			num_crono       : _num_crono,
			nombre          : _nombre,
			tipdoc          : _tipdoc,
			num_docu        : _num_docu,
			direccion       : _direccion,
			ecivil          : _ecivil,
			id_solicitante  : _id_solicitante,
			representante   : _representante,
			poder_inscrito  : _poder_inscrito,
			int_legitimo    : _int_legitimo,
			distrito_solic  : _distrito_solic,
			numdoc_rep		: _numdoc_rep,
			tipdoc_rep  	: _tipdoc_rep
			
			};
		
		if( _nombre == '' || _tipdoc == '' || _num_docu == '' || _direccion == '' || _ecivil == '')
		
		{alert('Faltan ingresar datos');return;}
		
		// graba
		$.post("../model/grabar_clientecambio.php",data,function(){ 
			ocultar_desc('div_newsolicitante');
			$('#llamaphp').load('list_cambiosnew.php?id_cambio='+_id_cambio,function(){
					
					 mostrar_desc('llamaphp');
					 $("#contienepersona").removeAttr("style","display:none");
				
				});
			});		
	}



</script> 
</head>
<body style="font-size:62.5%;">
<div id="carta_content">
<form name="frmbuscakardex" method="post" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="24%">
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
	<td width="76%"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td colspan="2"><table  width="100%"><input name="usuario_imprime" type="hidden" id="usuario_imprime" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" />
      <tr>
        <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar los datos..?</div><div id="confirmaGuarda"></div></td>
        </tr>
      <tr>
        <td width="14%"><span class="camposss">Nro Cronologico:</span></td>
        <td width="16%"><div id="resul_cambio" style="width:100px;"><input name="num_crono" type="hidden" id="num_crono" size="15" readonly="readonly" placeholder="Autogenerado" /><input name="id_cambio" type="hidden" id="id_cambio" /></div></td>
        <td width="17%"><span class="camposss">Fecha ingreso:</span></td>
        <td width="33%"><input name="fec_ingreso" type="text" id="fec_ingreso" style="text-transform:uppercase" value="<?php echo date("d/m/Y"); ?>" size="15" class="tcal"  onKeyUp = "this.value=formateafecha(this.value);"/></td>
        <td width="17%"><span class="camposss"># Formulario:</span></td>
        <td width="36%"><input name="num_formu" type="text" id="num_formu" style="text-transform:uppercase" size="15"  onkeypress="return solonumeros(event)"/></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><!--<span class="camposss">Tipo de persona</span>--></td>
  </tr>
  <tr>
    <td colspan="2">
    <fieldset id="field_remitente">
    <legend><span class="camposss"><div id="div_show_btnSolic"><button style="font-size:80.5%;" onClick="agregarpersona();" title="Agregar" type="button" name="addpersona"    id="addpersona" value="Agregar" ><img src="../../images/newuser.png" alt="" width="15" height="15" align="absmiddle" />Agregar Solicitante</button></div>
    </legend>
    <div id="div_newsolicitante">
    <table  width="100%">
        <tr>
          <td colspan="4">
          	
            <table width="100%" height="100%">
          	
        <tr>
          <td><span class="camposss">Identificado con:</span> </td>
          <td width="17%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdoc";
			$oCombo->style      = "camposss"; 
			//$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->click      = "validacion()"; 
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="7%" align="center"><span class="camposss">Nro:</span></td>
          <td width="66%" align="left"><input name="num_docu" type="text" id="num_docu" style="text-transform:uppercase" onkeypress="return solonumeros(event)" size="16" maxlength="20" /></td>
          </tr>
          <tr>
            	<td width="10%"><span class="camposss">Solicitante:</span></td>
          <td colspan="3"><input name="nnombre" type="text" id="nnombre" style="text-transform:uppercase" size="60" maxlength="400"  onkeypress="return soloLetras(event)"/>
          					<input type="hidden" name="nombre" id="nombre" />
          </td>
          </tr>
        <tr>
          <td><span class="camposss">Domicilio:</span> </td>
          <td colspan="3"><input name="ndireccion" type="text" id="ndireccion" onKeyUp="newdireccion();" style="text-transform:uppercase" size="60" maxlength="2000" />
          <input type="hidden" name="direccion" id="direccion" />
          </td>
        </tr>
        <tr>
          <td><span class="camposss">Distrito:</span></td>
          <td colspan="3"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT ubigeo.coddis AS 'id', CONCAT(ubigeo.nomdis,'/', ubigeo.nomprov,'/',ubigeo.nomdpto)  AS 'descripcion' FROM ubigeo
ORDER BY ubigeo.nomdis ASC
"; 
			$oCombo->value      = "id";
			$oCombo->text       = "descripcion";
			$oCombo->size       = "150"; 
			$oCombo->name       = "distrito_solic";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectzona(this.value);";   
			$oCombo->selected   =  "150101";
			$oCombo->Show();
			$oCombo->oDesCon(); */
?>
            <input name="distrito_solic" type="hidden" id="distrito_solic" size="15" />
            <table width="522" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="428"><input name="ubigen" type="text" id="ubigen" size="60" readonly="readonly"  onKeyUp="return validacion4(this)" /></td>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
              </tr>
            </table><div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 28px; top: 335px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
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
        </tr>
        <tr>
          <td><span class="camposss">Estado civil:</span></td>
          <td colspan="3"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipoestacivil.idestcivil AS 'id', tipoestacivil.desestcivil AS 'des'
FROM tipoestacivil
ORDER BY tipoestacivil.desestcivil ASC "; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "ecivil";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  "1";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
        </tr>
        <tr>
          <td colspan="4">
            <input name="c_nombre" style="text-transform:uppercase" type="hidden" id="c_nombre" size="60" />
            <input name="c_tipdoc" type="hidden" id="c_tipdoc" size="60" />
            <input name="c_numdoc" type="hidden" id="c_numdoc" style="text-transform:uppercase" onKeyPress="//fShowDatosProvee(event);" size="15" />
            <input name="id_solicitante" type="hidden" id="id_solicitante" />
            </td>
    
            </tr>
          </table>
            
          </td>
        </tr>
        <tr>
          <td colspan="6"><span class="camposss">Quien manifesto actuar por su propio derecho, o en representacion de :</span></td>
        </tr>
         <tr>
          <td><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdoc_representante";
			$oCombo->style      = "camposss"; 
			//$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->click      = "validacion1()"; 
			$oCombo->selected   =  "";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="12%" align="center"><span class="camposss">Nro:</span></td>
          <td width="17%"><input name="numdocu_representante" type="text" id="numdocu_representante" style="text-transform:uppercase" onkeypress="return solonumeros(event)" size="16" maxlength="20" /></td>
          <td width="61%">&nbsp;</td>

          </tr>
        <tr>
          <td colspan="6"><input name="nrepresentacion" type="text" id="nrepresentacion"  onKeyUp="newrepresentacion();" style="text-transform:uppercase" size="100" maxlength="400" />
          <input type="hidden" name="representacion" id="representacion" />
          </td>
          </tr>
        <tr>
          <td width="10%"><span class="camposss">Nro de partida Electronica:</span></td>
          <td colspan="5"><input name="poder_inscrito" type="text" id="poder_inscrito" style="text-transform:uppercase" size="84" maxlength="400"  onKeyUp="return validacion3(this)" /></td>
          </tr>
        <tr>
          <td><span class="camposss">O tercero con interes legitimo segun</span></td>
          <td colspan="5"><input name="int_legitimo" type="text" id="int_legitimo" style="text-transform:uppercase" size="84" maxlength="400"   onkeypress="return soloLetras(event)"/></td>
          </tr>
          <tr>
          <td><button title="grabar" type="button" name="Grabar"   id="Grabar"   value="Grabar" onclick="ggpcambiocarac()"   ><img src="../../images/save.png" width="17" height="17" align="absmiddle" /> Guardar</button></td>
    	  <td colspan="3"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="ggpcambiocarac2()" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver</button></td>
          </tr>
        </table>
        </div>
        
        
        
        
        <div id="contienepersona">
        	
   			 <table width="880" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="20" align="center"><span class="titubuskar0">Nro</span></td>
              <td width="90" align="center"><span class="titubuskar0">Documento</span></td>
              <td width="150" align="center"><span class="titubuskar0">Solicitante</span></td>
              <td width="150" align="center"><span class="titubuskar0">Domicilio</span></td>
              <td width="50" align="center"><span class="titubuskar0">Accion</span></td>
              

          	  </tr>
          </table>
          <div id="llamaphp">
    
          </div>
          
        </div>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td colspan="2">
    <fieldset id="field_destinatario">
    <legend><span class="camposss">CAMBIO DE CARACTERISTICAS</span></legend>
    <table  width="98%">
        <tr>
          <td width="67%" rowspan="3" valign="top"><div id="div_cambiocar" style='border: 1px solid #264965;border-radius: 5px;width:560px; height:150px; overflow:auto;'></div></td>
          <td width="9%"><span class="camposss">Agregar:</span></td>
          <td width="24%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT detalle_cambios.id_cambio AS 'id', CONCAT(detalle_cambios.id_cambio,' - ',detalle_cambios.des_cambio) AS 'des'
FROM detalle_cambios ORDER BY des_cambio ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "detalle_cambios";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          </tr>
        <tr>
          <td colspan="2"><button title="Añadir" type="button" name="anadir"    id="anadir" value="anadir" onclick="fAddDetalle();" ><img src="../../images/obs.png" width="18" height="18" align="absmiddle" /> Añadir</button>&nbsp;&nbsp;<button title="Crear Bloque" type="button" name="eliminar"    id="eliminar" value="eliminar" onclick="fElimDetalle();" ><img src="../../images/delete.png" width="18" height="18" align="absmiddle" /> Eliminar</button></td>
          </tr>
        <tr>
          <td colspan="2" valign="top"><div id="div_muesresul"></div></td>
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
    <td height="30" colspan="2" align="right" >&nbsp;</td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="top"><span class="camposss">Observaciones: </span></td>
    <td width="587"><textarea name="observacion" style="text-transform:uppercase;" id="observacion" cols="110" rows="5"></textarea></td>
  </tr>
</table>
</form>
</div>
</body>
</html>