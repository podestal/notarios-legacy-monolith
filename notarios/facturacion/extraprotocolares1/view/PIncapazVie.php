<?php 
session_start();
	
	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;  	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario Persona Capaz</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../includes/css/PIncapazVie.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/js/PIncapazVie.js"></script> 

<script type="text/javascript">

function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('idzona').value = name;  
  ocultar_desc('buscaubi');     
        
    }

	function fImprimir()
	{
		var _num_crono = document.getElementById('num_crono').value;
		if(_num_crono==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
	_data =
		{
			num_crono : _num_crono,
			usuario_imprime : _usuario_imprime,
			nom_notario : _nom_notario
		}
	
		$.post("../../reportes_word/generador_persona_incapaz.php",_data,function(_respuesta){
						alert(_respuesta);
					});
		}
		
	
	
	
	function fVisualDocument()
	{
		var valid_numcrono = document.getElementById('num_crono').value;
		if(valid_numcrono==''){alert('Debe guardar los datos primero');return;}
		var _num_crono = document.getElementById('muesnumcrono').value;
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';

		window.open("genera_pincapaz.php?num_crono="+_num_crono+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);				
	}
	
function primnomb(){
	
 valord=document.getElementById('nnombre').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('nombre').value=textod;
}

function representante(){
 valord=document.getElementById('nrepresentante').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('representante').value=textod;

}
function direccion(){
 valord=document.getElementById('ndireccion').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion').value=textod;

}
function nom_testigo(){
 valord=document.getElementById('nnom_testigo').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('nom_testigo').value=textod;

}

function fShowDatosPersona3(evento)
{
	



			var _tipdoc        = $("#tdoc_testigo");			
			var _numdoc		   = $("#ndocu_testigo").val();

			var _nombre        = $("#nnom_testigo");
			var _nombre_2      = $("#nom_testigo");
			
			if(evento.keyCode==13) 
				{
					if(_numdoc=='' || _tipdoc.val()==''){alert('Ingrese un numero/tipo de documento');return;}
					
					// Nombre de la persona
					var _des_nombre = fShowAjaxDato('../includes/testigo_nombre.php?numdoc='+_numdoc);
					document.getElementById('nnom_testigo').value = _des_nombre;
					document.getElementById('nom_testigo').value  = _des_nombre;
					
					
					if(_nombre.val()==''){alert('No se encuentra registrado');
					
					
					$('#nrepresentante').val('');
					$('#representante').val('');

					return; }
				}


}

function fShowDatosPersona2(evento)
{
	
			var _tipdoc        = $("#tipdocu_rep");			
			var _numdoc		   = $("#numdocu_rep").val();

			var _nombre        = $("#nrepresentante");
			var _nombre_2      = $("#representante");
			
			var _num_partida   = $("#pelectronica")
			
			if(evento.keyCode==13) 
				{
					if(_numdoc=='' || _tipdoc.val()==''){alert('Ingrese un numero/tipo de documento');return;}
					
					// Nombre de la persona
					var _des_nombre = fShowAjaxDato('../includes/incapaz_nombre.php?numdoc='+_numdoc);
					document.getElementById('nrepresentante').value = _des_nombre;
					document.getElementById('representante').value  = _des_nombre;
					
					var _num_partidaa = fShowAjaxDato('../includes/incapaz_numpartida.php?numdoc='+_numdoc);
					document.getElementById('pelectronica').value = _num_partidaa;
				
					
					
					if(_nombre.val()==''){alert('No se encuentra registrado');
					
					
					$('#nrepresentante').val('');
					$('#representante').val('');

					return; }
				}
}
   
function fShowDatosPersona(evento)
		{
			var _tipdoc        = $("#tipdocu");		
				
			var _numdoc		   = $("#numdocu").val();
			var _numdoc_2      = $("#documento");
			
			var _nombre        = $("#nnombre");
			var _nombre_2      = $("#nombre");
			
			var _nacionalidad  = $("#nacionalidad");
			var _ecivil        = $("#ecivil");
			
			var _ndireccion    = $("#ndireccion");
			var _ndireccion_2  = $("#direccion");
			
			var _idzona        = $("#idzona");
			
			if(evento.keyCode==13) 
				{
					if(_numdoc=='' || _tipdoc.val()==''){alert('Ingrese un numero/tipo de documento');return;}
					
					// Nombre de la persona
					var _des_nombre = fShowAjaxDato('../includes/capaz_nombre.php?numdoc='+_numdoc);
					document.getElementById('nnombre').value = _des_nombre;
					document.getElementById('nombre').value  = _des_nombre;
					
					// Nacionalidad de la Persona
					var _des_nacionalidad = fShowAjaxDato('../includes/capaz_nacionalidad.php?numdoc='+_numdoc);
					document.getElementById('nacionalidad').value=_des_nacionalidad;
					
					// Estado Civil de la Persona
					var _des_ecivil = fShowAjaxDato('../includes/capaz_ecivil.php?numdoc='+_numdoc);
					document.getElementById('ecivil').value=_des_ecivil;
					
					// Dirección de la Persona
					var _des_ndireccion = fShowAjaxDato('../includes/capaz_ndireccion.php?numdoc='+_numdoc);
					document.getElementById('ndireccion').value=_des_ndireccion;
					document.getElementById('direccion').value=_des_ndireccion;
					
					// Zona registral de la Persona
					var _des_idzona = fShowAjaxDato('../includes/capaz_idzona.php?numdoc='+_numdoc);
					document.getElementById('idzona').value=_des_idzona;
					
					var _des_descri = fShowAjaxDato('../includes/capaz_idzona2.php?numdoc='+_numdoc);
					document.getElementById('ubigen').value=_des_descri;
					
					
					if(_nombre.val()==''){alert('No se encuentra registrado');
					
					$('#documento').val('');
					
					$('#nnombre1').val('');
					$('#nombre1').val('');
					
					$('#ndireccion').val('');
					$('#direccion').val('');
					$('#nacionalidad').val('177');
					
					$('#ubigen').val('');
					
					return; }
				}
		}
	function validacion()
	{
	
		if	(!$('#tipdocu').val())
		{
			
			alert("debe seleccionar tipo de documento");
		}else if($('#tipdocu').val()==01)
		{
			$("#numdocu").attr("maxlength", 8);
		}else if($('#tipdocu').val()==08)
		{
			$("#numdocu").attr("maxlength", 11);
		}
	}
	function validacion1()
	{
	
		if	(!$('#tipdocu_rep').val())
		{
			
			alert("debe seleccionar tipo de documento");
		}else if($('#tipdocu_rep').val()==01)
		{
			$("#numdocu_rep").attr("maxlength", 8);
		}else if($('#tipdocu_rep').val()==08)
		{
			$("#numdocu_rep").attr("maxlength", 11);
		}
	}
	function validacion2()
	{
	
		if	(!$('#tdoc_testigo').val())
		{
			
			alert("debe seleccionar tipo de documento");
		}else if($('#tdoc_testigo').val()==01)
		{
			$("#ndocu_testigo").attr("maxlength", 8);
		}else if($('#tdoc_testigo').val()==08)
		{
			$("#ndocu_testigo").attr("maxlength", 11);
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
 
  
    if( !er_telefono.test(frmbuscakardex.num_crono.value) ) {
        alert('Caracter Incorrecto.')
			document.getElementById('num_crono').value='';
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
</script>
</head>

<body style="font-size:62.5%;">
<div id="carta_content">
<form name="frmbuscakardex" method="post" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="18%">
     <?php
				$oBarra->Graba        = "1"            ;
				$oBarra->GrabaClick   = "fGraba();"    ;
				$oBarra->Impri        = "1"            ;
				$oBarra->ImpriClick   = "fImprimir();" ;
				$oBarra->clase        = "css"      	   ; 
				$oBarra->widthtxt     = "20"		   ; 
				$oBarra->Show()  					   ; 
	 ?>
    </td>
	<td width="82%"><div id="verdocumen">
	  <button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button>
	  </div></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td ><table  width="100%">
      <tr>
        <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar el Certificado..?</div><div id="confirmaGuarda"></div></td>
        </tr>
      <tr>
        <td width="13%"><span class="camposss">Cronologico:</span></td>
        <td width="19%"><div id="resul_crono" style="width:100px;"><input name="num_crono" type="text" id="num_crono" placeholder="Autogenerado" size="15" readonly  onKeyUp="return validacion3(this)" /></div></td>
        <td width="11%"><span class="camposss">Fecha:</span> </td>
        <td width="23%"><input name="fecha" type="text" id="fecha" style="text-transform:uppercase" value="<?php echo date("d/m/Y"); ?>" size="15" class="tcal" onKeyUp = "this.value=formateafecha(this.value);"/></td>
        <td width="14%"><span class="camposss"># Formulario:</span></td>
        <td width="20%"><input name="num_formu" type="text" id="num_formu" onkeypress="return solonumeros(event)" style="text-transform:uppercase" size="15"  /></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <fieldset>
    <legend><strong><span class="camposss">Datos del Formulario</span></strong></legend>
    <table  width="100%">
        <tr>
          <td colspan="4">&nbsp;</td>
          <td width="14%" colspan="-1"></td>
          <td width="34%" colspan="-1"><input name="documento" type="hidden" id="documento" style="text-transform:uppercase" size="15" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Identificado con :</span></td>
          <td colspan="2"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdocu";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validacion();";   
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="11%" align="right"><span class="camposss">Nro.</span></td>
          <td colspan="2"><input name="numdocu"  type="text" id="numdocu" style="text-transform:uppercase" size="15" maxlength="11" placeholder="N. documento" onkeypress="return solonumeros(event)"  /></td>
        </tr>
        <tr>
          <td colspan="6"><input name="nombre" type="text" id="nombre" style="text-transform:uppercase" size="100" maxlength="500" onkeypress="return soloLetras(event)"/>
            <input type="hidden" name="nombre" style="text-transform:uppercase" id="nombre" /></td>
          </tr>
          <tr>
          <td colspan="5"><span class="camposss">presentado(a) ante mi, el dia de hoy por:</span></td>
          
          </tr>
           <tr>
          <td width="23%"><span class="camposss">Identificado con:</span></td>
          <td width="2%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdocu_rep";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validacion1();";   
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>          </td>
          <td width="16%" align="right"><span class="camposss">Nro.</span></td>
          <td><input name="numdocu_rep" type="text" id="numdocu_rep" style="text-transform:uppercase" size="15"  onkeypress="return solonumeros(event)"  maxlength="11" placeholder="N. documento" /></td>
          <td align="right"><span class="camposss">quien dice ser:</span></td>
          <td><input name="nombre_rep" type="text" id="nombre_rep" style="text-transform:uppercase" size="30" maxlength="11" onkeypress="return soloLetras(event)"/></td>
          </tr>
        <tr>
         
          <td colspan="5"><input name="nrepresentante" type="text" id="nrepresentante" style="text-transform:uppercase" size="80" maxlength="500" placeholder="nombre y apellido del representado" onkeypress="return soloLetras(event)"/>
          <input type="hidden" name="representante" style="text-transform:uppercase" id="representante" />
          </td>
          </tr>
       
        <tr>
          <td colspan="6"><span class="camposss">y declara bajo responsabilidad que el(la) incapaz es el(la) titular del documento con el que se ha presentado, y que sus datos personales son:</span></td>
          </tr>
        <tr>
          <td><span class="camposss">Nacionalidad:</span></td>
          <td colspan="2"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des'
FROM nacionalidades
ORDER BY nacionalidades.desnacionalidad ASC "; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "nacionalidad";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   = "177";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>          </td>
          <td align="right"><span class="camposss">Estado civil</span></td>
          <td><?php 
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
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>          </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td><span class="camposss">Domiciliado:</span></td>
          <td colspan="5"><input name="direccion" type="text" id="direccion" style="text-transform:uppercase" size="100" maxlength="3000" placeholder="direccion" onKeyUp="direccion();"/>
          <input type="hidden" name="direccion" style="text-transform:uppercase" id="direccion" />
          </td>
          </tr>
          <tr>
          	<td><span class="camposss">Partida electronica:</span></td>
              <td colspan="5"><input name="pelectronica" type="text" id="pelectronica" style="text-transform:uppercase" size="50"/>
          
          </td>
          </tr>
        <tr>
          <td><span class="camposss">Zona:</span></td>
          <td colspan="5">
           
            <input name="idzona" type="hidden" id="idzona" size="15" />
            <table width="522" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="428"><input name="ubigen" type="text" id="ubigen" size="60" onKeyUp="return validacion4(this)" /></td>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
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
        </tr>
        
        <tr>
          <td><span class="camposss">Testigo identificado con:</span></td>
          <td><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "tdoc_testigo";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validacion2();";   
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td align="right"><span class="camposss">Nro.</span></td>
          <td><input name="ndocu_testigo" type="text" id="ndocu_testigo" style="text-transform:uppercase" size="15" maxlength="11" placeholder="N. documento"  onkeypress="return solonumeros(event)"  /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6"><span class="camposss">Nombre de Testigo a ruego:
              <input name="nom_testigo" type="text" id="nom_testigo" style="text-transform:uppercase" size="80" maxlength="500" onkeypress="return soloLetras(event)"/>
         		<input type="hidden" name="nom_testigo" style="text-transform:uppercase" id="nom_testigo"/>
                 </span></td>
          </tr>
           <tr>
     <td><span class="camposss">Interviene por :</span></td>
     <td height="30"><select name="especi" id="especi">
      <option value = "" selected="selected">SELECCIONE</option>
      <option value="IL">ILETRADO(A)</option>
      <option value="IN">INCAPACIDAD FISICA</option>
      <option value="AR">A RUEGO</option>
    </select></td>
     </tr>
        <tr>
          <td colspan="6"><span class="camposss">Observaciones:</span></td>
        </tr>
        <tr>
          <td colspan="6"><label for="observaciones"></label>
            <textarea name="observaciones" id="observaciones" cols="120" rows="6" style="text-transform:uppercase"></textarea></td>
        </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30"><input name="swtcapacidad"  type="hidden" id="swtcapacidad" /></td>
  </tr>
</table>
</form>
</div>
</body>
</html>