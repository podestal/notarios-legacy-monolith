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
<title>Certificado Domiciliario</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../includes/css/CertDomiVie.css" />


<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/js/CertDomiVie.js"></script> 
<script type="text/javascript">
function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('distrito_solic').value = name;  
  ocultar_desc('buscaubi');     
        
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
			nom_notario : _nom_notario
		}
	
		$.post("../../reportes_word/generador_certifi_domiciliario.php",_data,function(_respuesta){
						alert(_respuesta);
					});
	
	}

	function fVisualDocument()
	{
		var valid_numcrono = document.getElementById('num_certificado').value;
		if(valid_numcrono==''){alert('Debe guardar los datos primero');return;}
		var _num_crono = document.getElementById('muesnumcerti').value;
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';

		window.open("genera_domiciliario.php?num_crono="+_num_crono+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);				
	}
	
function nomtestigo(){
	
 valord=document.getElementById('nnom_testigo').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('nom_testigo').value=textod;
}

function domicilio(){
 valord=document.getElementById('ndomic_solic').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('domic_solic').value=textod;

}
function nombresolic(){
 valord=document.getElementById('nnombre_solic').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('nombre_solic').value=textod;

}
	
function fShowDatosPersona(evento)
{	
	var _tipdoc     = document.getElementById('tipdoc_solic').value;
	var _numdoc		= document.getElementById('numdoc_solic').value;
	
	var _nombre_soli	= document.getElementById('nnombre_solic');
	var _nombre_soli2   = document.getElementById('nombre_solic');
	
	var _direccion 	    = document.getElementById('ndomic_solic');
	var __direccion2	= document.getElementById('domic_solic');
	
	var _distrito   = document.getElementById('distrito_solic');
	var _motivo		= document.getElementById('motivo_solic');
	var _idestcivil	= document.getElementById('idestcivil');
	var _sexo   	= document.getElementById('sexo');
	var _nomprofesionesc   	= document.getElementById('nomprofesionesc');
	var _idprofesionc   	= document.getElementById('idprofesionc');
			
			if(evento.keyCode==13) 
				{
					if(_numdoc=='' || _tipdoc==''){alert('Ingrese un numero de documento');return;}
					
					var _des = fShowAjaxDato('../includes/certnombre.php?numdoc='+_numdoc);
					document.getElementById('nnombre_solic').value = _des;
					document.getElementById('nombre_solic').value = _des;
					var _direcc = fShowAjaxDato('../includes/certdireccion.php?numdoc='+_numdoc);
					document.getElementById('ndomic_solic').value=_direcc;
					document.getElementById('domic_solic').value=_direcc;
					
					var _dist = fShowAjaxDato('../includes/certdistrito.php?numdoc='+_numdoc);
					document.getElementById('distrito_solic').value=_dist;
					
					
					var _dist2 = fShowAjaxDato('../includes/certdistrito2.php?numdoc='+_numdoc);
					document.getElementById('ubigen').value=_dist2;
									
					var _estciv = fShowAjaxDato('../includes/certestciv.php?numdoc='+_numdoc);
					document.getElementById('idestcivil').value=_estciv;
						var _sexo = fShowAjaxDato('../includes/certsexo.php?numdoc='+_numdoc);
					document.getElementById('sexo').value=_sexo;
					
						var _idprofesion = fShowAjaxDato('../includes/certidprof.php?numdoc='+_numdoc);
					document.getElementById('idprofesionc').value=_idprofesion;
					
						var _nomprofesion = fShowAjaxDato('../includes/certdetprof.php?numdoc='+_numdoc);
					document.getElementById('nomprofesionesc').value=_nomprofesion;
					
					if(_nombre_soli.value==''){alert('No se encuentra registrado');
					
					
					$('#nnombre_solic').val('');
					$('#nombre_solic').val('');
					$('#ndomic_solic').val('');
					$('#domic_solic').val('');
					$('#distrito_solic').val('');
					$('#motivo_solic').val('');
					$('#idestcivil').val('');
					$('#sexo').val('');
					$('#ubigen').val('');
					return; }
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
	
function focusprofec(){
	document.getElementById('buscaprofesc').focus();
	}
	
function buscaprofesionesc()
{ 	
	var divResultado = document.getElementById('resulprofesionesc');
	var buscaprofes  = document.getElementById('buscaprofesc').value;
		
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
  document.getElementById('idprofesionc').value = id;
  document.getElementById('nomprofesionesc').value = name;  
  ocultar_desc('buscaprofec');        
    }
function fShowDatosPersonacert(evento)
{
			var _tipdoc        = $("#tdoc_testigo");			
			var _numdoc		   = $("#ndocu_testigodom").val();

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
 
  
    if( !er_telefono.test(frmbuscakardex.num_certificado.value) ) {
        alert('Caracter Incorrecto.')
		document.getElementById('num_certificado').value='';
        return false
    }
 
  
    return false           
}



function validacion4() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([A-Z\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.distrito_solic.value) ) {
        alert('Caracter Incorrecto.')
		document.getElementById('distrito_solic').value='';
        return false
    }
 
  
    return false           
}

function validacion5() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([A-Z\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.nomprofesionesc.value) ) {
        alert('Caracter Incorrecto.')
		document.getElementById('nomprofesionesc').value='';
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
</head>

<body style="font-size:62.5%;">
<div id="carta_content">
<form name="frmbuscakardex" method="post" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr><td>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="23%">
     <?php
				$oBarra->Graba        = "1"               ;
				$oBarra->GrabaClick   = "fGraba();"       ;
				$oBarra->Impri        = "1"               ;
				$oBarra->ImpriClick   = "fImprimir();"    ;
				$oBarra->clase        = "css"      		  ; 
				$oBarra->widthtxt   = "20"				  ; 
				$oBarra->Show()  						  ; 
				?>
    </td>
	<td width="77%"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
</tr>
</table>
  </td></tr>
  <tr>
    <td ><table  width="100%">
      <tr>
        <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar el Certificado..?</div><div id="confirmaGuarda"></div></td>
        </tr>
      <tr>
        <td width="13%"><span class="camposss">Nro certificado:</span></td>
        <td width="19%"><div id="resul_certi" style="width:100px;"><input name="num_certificado" type="text" id="num_certificado" style="text-transform:uppercase" size="15" readonly="readonly" placeholder="Autogenerado"  onKeyUp="return validacion3(this)"/></div></td>
        <td width="11%"><span class="camposss">Fecha Ingreso:</span> </td>
        <td width="23%"><input name="fec_ingreso" type="text" id="fec_ingreso" style="text-transform:uppercase" size="15" value="<?php echo date("d/m/Y"); ?>"  class="tcal" onKeyUp = "this.value=formateafecha(this.value);" /></td>
        <td width="14%"><span class="camposss"># Formulario:</span></td>
        <td width="20%"><input name="num_formu" type="text" id="num_formu"  style="text-transform:uppercase" size="15" onkeypress="return solonumeros(event)" /></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <fieldset>
    <legend><strong><span class="camposss">SOLICITANTE</span></strong></legend>
    <table  width="100%">
      <tr>
          <td><span class="camposss">Identificado con:</span></td>
          <td width="23%" colspan="-1"><?php 
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
			$oCombo->selected   = "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="9%" colspan="-1" align="right"><span class="camposss">Nro:</span></td>
          <td width="54%" colspan="-1"><input name="numdoc_solic" type="text" id="numdoc_solic" onkeypress="return solonumeros(event)" style="text-transform:uppercase" size="15" maxlength="20" placeholder="Num. Docum." /></td>
        </tr>
        <tr>
          <td width="14%"><span class="camposss">Solicitante:</span></td>
          <td colspan="3"><input name="nnombre_solic" type="text" id="nnombre_solic" style="text-transform:uppercase" size="100" maxlength="400" onkeypress="return soloLetras(event)"/>
            <input type="hidden" name="nombre_solic" style="text-transform:uppercase" id="nombre_solic" />
            </td>
        </tr>
      
        <tr>
          <td><span class="camposss">Domicilio:</span></td>
          <td colspan="3"><input name="ndomic_solic" type="text" id="ndomic_solic" style="text-transform:uppercase" size="100" maxlength="2000"  placeholder="Direccion" onKeyUp="domicilio();"/>
                    <input type="hidden" name="domic_solic" style="text-transform:uppercase" id="domic_solic" />
          </td>
          </tr>
        <tr>
          <td><span class="camposss">Distrito:</span></td>
          <td colspan="3"><input name="distrito_solic" type="hidden" id="distrito_solic" size="15" />
            <table width="522" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="428"><input name="ubigen" type="text" id="ubigen" size="60" onKeyUp="return validacion4(this)"  /></td>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
              </tr>
            </table><div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 60px; top: 232px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
              <table width="637" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="24" height="29">&nbsp;</td>
                  <td width="585" class="camposss">Seleccionar Zona:</td>
                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><label>
                    <input name="_buscaubi" style="text-transform:uppercase; background:#FFF; text-transform:uppercase" type="text" id="_buscaubi" size="65" onkeypress="buscaubigeos()" />
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
          <td><span class="camposss">Motivo:</span></td>
          <td colspan="3"><input name="motivo_solic" type="text" id="motivo_solic" style="text-transform:uppercase" size="100" maxlength="2000" onkeypress="return soloLetras(event)" /></td>
          </tr>
           <tr>
    <td height="30" align="left"><span class="camposss">Prof./Ocupaciòn :</span></td>
    <td height="30" colspan="3"><table width="466" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="254"><label>
          <input name="nomprofesionesc" style="text-transform:uppercase"  type="text" id="nomprofesionesc" size="40"   />
        </label></td>
        <td width="118"><a id="limprofe" href="#" onclick="mostrar_desc('buscaprofec');focusprofec()"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
        
          <td width="94"><div id="buscaprofec" style="position:absolute; display:none; width:637px; height:223px; left: 50px; top: 296px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
            <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Profesion:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaprofec')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaprofesc" type="text" id="buscaprofesc"  style="background:#FFFFFF; text-transform:uppercase" size="50" onkeypress="buscaprofesionesc()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulprofesionesc" style="width:585px; height:150px; overflow:auto"></div></td>
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
    </table></td>
          </tr>
   <tr>

    <td height="30" align="left"><span class="camposss">Estado Civil :</span></td>
    <td height="30"><select name="idestcivil" id="idestcivil">
      <option value = "0" selected="selected">SELECCIONE</option>
      <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
  </tr>
  <tr>

    <td height="30" align="left"><span class="camposss">Sexo :</span></td>
    <td height="30"><select name="sexo" id="sexo">
      <option value = "" selected="selected">SELECCIONE SEXO</option>
      <option value="M">MASCULINO</option>
      <option value="F">FEMENINO</option>
    </select></td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30"><fieldset>
      <legend><strong><span class="camposss">CUERPO</span></strong></legend>
      <table  width="100%">
        <tr>
          
          <td colspan="4"><label for="texto_cuerpo"></label>
            <textarea style="text-transform:uppercase;" name="texto_cuerpo" id="texto_cuerpo" cols="95" rows="5"></textarea></td>
        </tr>
        
        
        <tr>
         <td width="8%"><span class="camposss">Identificado con:</span></td>
          <td width="29%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "tdoc_testigo";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "validar_documento();";   
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="14%" align="center"><span class="camposss">Nro :</span></td>
          <td width="15%" align="left"><input name="ndocu_testigodom" type="text" id="ndocu_testigodom" style="text-transform:uppercase" size="15" maxlength="8" placeholder="N. documento" onkeypress="return solonumeros(event)" /></td>
          <td width="30%">&nbsp;</td>
          <td width="1%" align="right">&nbsp;</td>
          <td width="1%">&nbsp;</td>
          <td width="1%">&nbsp;</td>
          <td width="1%">&nbsp;</td>
        </tr>
        <tr>
         <td colspan="9"><span class="camposss">Testigo a ruego:
              <input name="nnom_testigo" type="text" id="nnom_testigo" style="text-transform:uppercase" size="80" maxlength="400" onkeypress="return soloLetras(event)"/>
              <input type="hidden" name="nom_testigo" style="text-transform:uppercase" id="nom_testigo" />
          </span></td>
        </tr>
        <tr>
          <td colspan="5"><input name="justifi_cuerpo" type="hidden" id="justifi_cuerpo" /></td>
        </tr>
        <tr>
          <td colspan="5"><input name="id_domiciliario" type="hidden" id="id_domiciliario" /><input name="idprofesionc" type="hidden" id="idprofesionc" size="15" /></td>
          </tr>
        </table>
    </fieldset></td>
  </tr>
</table>
</form>
</div>
</body>
</html>