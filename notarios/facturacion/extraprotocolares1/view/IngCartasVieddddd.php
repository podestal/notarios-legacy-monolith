<?php 
session_start();

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

<script type="text/javascript">
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

function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('idzona').value = name;  
  ocultar_desc('buscaubi');     
        
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

function validateEnter(e) {
	var key=e.keyCode || e.which;
	if (key==13){ return true; } else { return false; }
}

</script>
</head>

<body style="font-size:62.5%;">
<div id="carta_content">
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
     <td width="71%"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
  
   
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
    <table  width="100%">
        <tr><form id="compruebaDni" action="ValidarDni_cartas.php" method="post">
          <td width="11%"><span class="camposss">N.documento</span></td>
          <td width="15%"><input name="numdoc" type="text" id="numdoc" style="text-transform:uppercase"  onkeypress="return solonumeros(event)" onkeyup="if(validateEnter(event) == true) { var inputci=this.value;document.forms.compruebaDni.submit();}" value="<?php echo $_GET['val1'];?>" size="15" maxlength="15"/>&nbsp;
            <!--<a href="#" onClick="newParticipante();//fShowDatosProveeClick()"> <img src="../../images/search.png" alt="" width="15" height="15" border="0" /></a>--> </td>
            <?php 
			if(count($_GET) > 0){
			?>
           <td width="24%">
           <span class="camposss">&nbsp;</span></td>
           <td width="16%">
           <input type="hidden" value="<?php echo $_GET['val6'];?>"  name="tipoPer">
           </td>
           <?php 
			}else{
		   ?>
           <td width="24%">
           <span class="camposss">Tipo de Persona&nbsp;</span></td>
           <td width="16%">
           <select  name="tipoPer" style="width:150px">
           <option value="N" selected="selected">Persona Natural</option>´
           <option value="J">Persona Juridica</option>
           </select>
           </td>
            <?php 
			}
		   ?>
           </tr>
           <tr>
                    <td><span class="camposss">Identificado con:</span></td>
          <td width="23%" colspan="-1"><?php 
			$oCombo = new CmbList()  ;
			if(count($_GET) > 0){					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
where idtipdoc='".$_GET['val2']."'
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "tipdoc_solic";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validar_documento2()";   
			$oCombo->selected   = $_GET['val2'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
			}else{
				$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "tipdoc_solic";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validar_documento2()";   
			$oCombo->selected   = "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
			}
?></td>
          </form>
          
          
          <td width="24%"><span class="camposss">Telefono:</span></td>

          <td width="16%"><input name="telefono" type="text" id="telefono"  style="text-transform:uppercase" size="15" maxlength="15" value="<?php echo $_GET['val4'];?>" onkeypress="return solonumeros(event)"/></td>
        </tr>
        <tr>
          <td><span class="camposss">Remitente:</span> </td>
          <td colspan="3"><input name="remitente2" type="text" id="remitente2" style="text-transform:uppercase" size="60" onkeypress="return soloLetrasynumeros(event)" onKeyUp="remitente1();" maxlength="400"  value="<?php echo $_GET['val3']?>" />
          <input type="hidden" name="remitente" id="remitente" >
          </td>
          </tr>
        <tr>
          <td><span class="camposss">Direccion:</span> </td>
          <td colspan="3"><input name="direccion_remi1" style="text-transform:uppercase" type="text" id="direccion_remi1" size="60" onkeypress="return soloLetrasynumeros(event)" value="<?php echo $_GET['val5'];?>"  onKeyUp="direccion_remi2();" maxlength="300"/>
          <input type="hidden" name="direccion_remi" id="direccion_remi" >
          </td>
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
          <td width="14%"><span class="camposss">Nombre:</span> </td>
          <td colspan="3"><input name="destinatario2" type="text" id="destinatario2" style="text-transform:uppercase" size="60" onkeypress="return soloLetrasynumeros(event)" maxlength="400" onKeyUp="destinatario1();" /><input name="destinatario" type="hidden" id="destinatario" style="text-transform:uppercase" size="60" maxlength="400" /></td>
          </tr>
        <tr>
          <td><span class="camposss">Dir. destino</span></td>
          <td colspan="3"><input name="dirdestino2" style="text-transform:uppercase" onKeyUp="dirdestinatario1();" type="text" id="dirdestino2" onkeypress="return soloLetrasynumeros(event)" size="60" maxlength="400" /><input name="dirdestino" style="text-transform:uppercase" type="hidden" id="dirdestino"  size="60" maxlength="400" /></td>
          </tr>
        <tr>
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
<input name="idzona" type="hidden" id="idzona" size="15" />
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
          <td width="11%"><input name="costo" type="hidden" id="costo" style="text-transform:uppercase" value="0.00" size="15" /></td>
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
          </tr>
        </table>
    </fieldset>
    </td>
    </tr>
  <tr>
    <td width="92" height="30" valign="top" ><span class="camposss">Contenido:</span>
    <a href="#" onClick="fmuescontenido()"><img src="../../images/help.png" alt="" width="12" height="12" border="0" /></a>
      </td>
    <td width="545" height="30" ><label for="contecarta"></label>
      <textarea name="contecarta" id="contecarta" cols="110" rows="5" onkeypress="return soloLetrasynumeros(event)" style="text-transform:uppercase;"></textarea></td>
    </tr>
  <tr>
    <td height="30" colspan="2" ><fieldset id="field_cargo">
      <legend><span class="camposss">CARGO DESTINATARIO</span></legend>
      <table  width="100%">
        <tr>
          <td width="14%"><span class="camposss">Recogio la carta:</span> </td>
          <td colspan="3"><input name="nomrecogio" type="text" id="nomrecogio" style="text-transform:uppercase" size="60" maxlength="400"  onkeypress="return soloLetras(event)"/></td>
        </tr>
        <tr>
          <td><span class="camposss">Documento</span></td>
          <td width="35%"><input name="docrecogio" style="text-transform:uppercase" type="text" id="docrecogio" size="30" maxlength="20" onkeypress="return soloLetrasynumeros(event)"  /></td>
          <td width="20%"><span class="camposss">Dia:</span> </td>
          <td width="31%"><input name="fecrecogio" type="text" class="tcal" id="fecrecogio" style="text-transform:uppercase"  size="15" maxlength="50" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Nro Fac/Bol:</span></td>
          <td><input name="factura" type="text" id="factura" style="text-transform:uppercase" size="30" maxlength="400" /></td>
          <td colspan="2"></td>
          </tr>
      </table>
    </fieldset></td>
    </tr>
  <tr>
    <td height="30" colspan="2" align="right" >&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>