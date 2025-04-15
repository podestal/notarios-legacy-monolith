<?php 
session_start();

	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	
	
	$id_supervivencia  = $_REQUEST['id_supervivencia'];	
	
	$consulsupervivencia = mysql_query("SELECT cert_supervivencia.*, DATE_FORMAT(cert_supervivencia.fecha,'%d/%m/%Y') AS 'fecha2' FROM cert_supervivencia WHERE cert_supervivencia.id_supervivencia='$id_supervivencia' AND cert_supervivencia.swt_capacidad = 'I'", $conn) or die(mysql_error());
	$rowsuper = mysql_fetch_array($consulsupervivencia);
	
	$numkar = $rowsuper['num_crono'];
	$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);
	
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

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
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

function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('idzona').value = name;  
  ocultar_desc('buscaubi');     
        
    }

$(document).ready(function(){ 

	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	})

	function agregar()
	{
		document.getElementById('num_crono').value = '';
		document.getElementById('fecha').value = '';
		document.getElementById('num_formu').value = '';
		document.getElementById('documento').value = '';
		document.getElementById('nombre').value = '';
		document.getElementById('tipdocu').value = '';
		document.getElementById('numdocu').value = '';
		document.getElementById('nacionalidad').value = '';
		document.getElementById('ecivil').value = '';
		document.getElementById('direccion').value = '';
		document.getElementById('observaciones').value = '';
	}

	function fGraba(){
		
		 editnnombre1();
		 editnrepresentante();
		 editndireccion();
		 editnnom_testigo();
		 feditpersonaincapaz();
		  }

	function fElimina()
	{ 
		if(confirm('Desea eliminar el certificado..?'))
		{fElimpersonaincapaz(); }
		else {return;}
	}

	function fImprimir()
	{
		var _num_crono = document.getElementById('num_crono').value;
		if(_num_crono==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'Nombre del notario';
	
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
		var _num_crono = document.getElementById('muescrono').value;
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';

		window.open("genera_pincapaz.php?num_crono="+_num_crono+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);				
	}
	function editnnombre1()
	{
		valord=document.getElementById('nnombre1').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('nombre').value=textod;
	}
	function editnrepresentante()
	{
		valord=document.getElementById('nrepresentante1').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('representante').value=textod;
	}
	function editndireccion()
	{
		valord=document.getElementById('ndireccion1').value;
	 	textod=valord.replace(/&/g,"*");
		document.getElementById('direccion').value=textod;
	}
	function editnnom_testigo()
	{
		valord=document.getElementById('nnom_testigo1').value;
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
 
  
    if( !er_telefono.test(frmbuscakardex.muescrono.value) ) {
        alert('Caracter Incorrecto.')
			document.getElementById('muescrono').value='';
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
</script>
</head>

<body style="font-size:62.5%;">
<div id="carta_content">
<form name="frmbuscakardex" method="post" action="">
<input name="num_formu" type="hidden" id="num_formu" style="text-transform:uppercase" value="<?php echo $rowsuper['num_formu']; ?>" size="15"  onKeyUp="return validacion3(this)" readonly />
<?php
			  /*if($rowu['editinca'] == '1')
              {*/
                    echo'<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>'; ?>

<?php
//francisco aqui estan los botones, como haz estado tu modificando eso revisa aqui pk no aparece esto.

// aqui est5an los botnoes no vezzz????????????
				$oBarra->Graba        = "1"               ;
				$oBarra->GrabaClick   = "fGraba();"       ;
				$oBarra->Impri        = "1"                   ;
				$oBarra->ImpriClick   = "fImprimir();"      ;
				$oBarra->clase        = "css"      		  ; 
				$oBarra->widthtxt     = "20"			  ; 
				$oBarra->Show()  						  ; 
?>

    <?php echo'</td>
    <td width="82%"><div id="verdocumen">
	  <button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button>
	  </div></td>
</tr>
</table>';
			 /* }else{
				    echo'';
				  }*/
			  ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td ><table  width="100%">
      <tr>
        <td width="13%"><span class="camposss">Cronologico:</span></td>
        <td width="19%"><input name="num_crono" type="hidden" id="num_crono" style="text-transform:uppercase" value="<?php echo $rowsuper['num_crono']; ?>" size="15" readonly />
        <input name="muescrono" type="text" id="muescrono" style="text-transform:uppercase" value="<?php echo $numkar2; ?>" size="15" onKeyUp="return validacion3(this)"readonly="readonly" />
        </td>
        <td width="11%"><span class="camposss">Fecha:</span> </td>
        <td width="23%"><input name="fecha" type="text" id="fecha" style="text-transform:uppercase" value="<?php echo $rowsuper['fecha2']; ?>" size="15" class="tcal"  onKeyUp = "this.value=formateafecha(this.value);"/></td>
        <td width="14%"><!--<span class="camposss"># Formulario:</span>--></td>
        <td width="14%"><span class="camposss"># Formulario:</span></td>
        <td width="20%"><input name="num_formu" type="text" id="num_formu" onkeypress="return solonumeros(event)" style="text-transform:uppercase" size="15" value="<?php echo $rowsuper['num_formu']; ?>" readonly/></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <fieldset>
    <legend><strong><span class="camposss">Datos del Formulario</span></strong></legend>
    <table  width="100%">
        <tr>
          <td colspan="5">&nbsp;</td>
          <td width="23%" colspan="-1"></td>
          <td width="30%" colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td><span class="camposss">Identificado con : </span>           </td>
          <td colspan="3"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdocu";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowsuper['tipdocu'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>           </td>
          <td width="11%" align="right"><span class="camposss">Nro.</span></td>
          <td colspan="2"><input name="numdocu" type="text" id="numdocu" style="text-transform:uppercase" value="<?php echo $rowsuper['numdocu']; ?>" size="15" maxlength="11"  onkeypress="return solonumeros(event)"/></td>
          </tr>
        <tr>
          <td colspan="7"><input name="nnombre1" type="text" id="nnombre1"  onKeyUp="editnnombre1();"style="text-transform:uppercase" value="<?php 
		  $c_desc = $rowsuper['nombre'];
		  $textorpat=str_replace("?","'",$c_desc);
		  $textoamperpat=str_replace("*","&",$textorpat);
		  echo strtoupper($textoamperpat);?>" size="100" maxlength="500" />
          <input type="hidden" name="nombre" id="nombre" />  
            <input name="documento" type="hidden" id="documento" style="text-transform:uppercase"  onkeypress="return soloLetras(event)" value="<?php echo $rowsuper['documento']; ?>" size="15" /></td>
          </tr>
          <tr>
          <td  colspan="6"><span class="camposss">presentado(a) ante mi, el dia de hoy por:</span> </td>
          
          </tr>
          <tr>
          <td width="18%"><span class="camposss">Identificado con:</span></td>
          <td width="9%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdocu_rep";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowsuper['tipdocu_rep'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>           </td>
          <td width="9%" align="right"><span class="camposss">Nro.</span></td>
          <td width="18%"><input name="numdocu_rep" type="text" id="numdocu_rep" style="text-transform:uppercase" value="<?php echo $rowsuper['numdocu_rep']; ?>" size="15" maxlength="11" onkeypress="return solonumeros(event)" /></td>
          <td><span class="camposss">quien dice ser:</span></td>
          <td colspan="2"><input name="nombre_rep" type="text" id="nombre_rep" style="text-transform:uppercase" value="<?php echo $rowsuper['nombre_rep']; ?>" size="40" maxlength="500" onkeypress="return soloLetras(event)" /></td>
          </tr>
        <tr>
          
          <td colspan="6"><input name="nrepresentante1" type="text" id="nrepresentante1" onKeyUp="editnrepresentante();" style="text-transform:uppercase" value="<?php 
		    $c_desc = $rowsuper['representante'];
		  $textorpat=str_replace("?","'",$c_desc);
		  $textoamperpat=str_replace("*","&",$textorpat);
		  echo strtoupper($textoamperpat); ?>" size="80" maxlength="500" />
          <input type="hidden" name="representante" id="representante" />  
          </td>
          </tr>
        
        <tr>
          <td colspan="7"><span class="camposss">y declara bajo responsabilidad que el(la) incapaz es el(la) titular del documento con el que se ha presentado, y que sus datos personales son:</span></td>
          </tr>
          
        <tr>
          <td><span class="camposss">Nacionalidad:</span></td>
          <td colspan="3"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des'
FROM nacionalidades
ORDER BY nacionalidades.desnacionalidad ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "nacionalidad";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowsuper['nacionalidad'];
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
			$oCombo->selected   =  $rowsuper['ecivil'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>           </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td><span class="camposss">Domiciliado:</span></td>
          <td colspan="6"><input name="ndireccion1" type="text" id="ndireccion1" onKeyUp="editndireccion();" style="text-transform:uppercase" value="<?php 
		  $c_desc = $rowsuper['direccion'];
		  $textorpat=str_replace("?","'",$c_desc);
		  $textoamperpat=str_replace("*","&",$textorpat);
		  echo strtoupper($textoamperpat); ?>" size="100" maxlength="3000" />
          <input type="hidden" name="direccion" id="direccion" />  
          </td>
          </tr>
           <tr>
          	<td><span class="camposss">Partida electronica:</span></td>
              <td colspan="5"><input name="pelectronica2" type="text" id="pelectronica2" style="text-transform:uppercase" size="50" value="<?php echo $rowsuper['pelectronica']; ?>"/>
          
          </td>
          </tr>
        <tr>
          <td><span class="camposss">Zona:</span></td>
          <td colspan="6"><span class="camposss">
            <input name="idzona" type="hidden" id="idzona" value="<?php echo $rowsuper['ubigeo']; ?>" size="15" />
          </span>
            <?php 
		  
		  $consulubigeo= mysql_query("SELECT * FROM ubigeo where coddis='".$rowsuper['ubigeo']."'", $conn) or die(mysql_error());
		  $rowubbi=mysql_fetch_array($consulubigeo);
        
		  
		  ?>
            <table width="522" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="428"><input name="ubigen" type="text" id="ubigen" value="<?php echo $rowubbi['nomdpto']."/".$rowubbi['nomprov']."/".$rowubbi['nomdis']; ?>"  onKeyUp="return validacion4(this)" size="60" disabled /></td>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
              </tr>
            </table> <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 17px; top: 346px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
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
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowsuper['tdoc_testigo'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td align="right"><span class="camposss">Nro.</span></td>
          <td><input name="ndocu_testigo" type="text" id="ndocu_testigo" style="text-transform:uppercase" value="<?php echo $rowsuper['ndocu_testigo']; ?>" size="15" maxlength="11" placeholder="N. documento" onkeypress="return solonumeros(event)"  /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="7"><span class="camposss">Nombre testigo a ruego:
              <input name="nnom_testigo1" type="text" id="nnom_testigo1"   onkeypress="return soloLetras(event)" style="text-transform:uppercase" value="<?php 
			 $c_desc = $rowsuper['nom_testigo'];
		 	 $textorpat=str_replace("?","'",$c_desc);
		 	 $textoamperpat=str_replace("*","&",$textorpat);
		 	 echo strtoupper($textoamperpat); ?>" size="80" maxlength="500" />
          </span>
          <input type="hidden" name="nom_testigo" id="nom_testigo" />  
          </td>
          </tr>
               <tr>
        	<td><span class="camposss">Interviene por :</span></td>
            <td>
            <select name="especi1" id="especi1" >
     		<?php 
	 		if ($rowsuper['especificacion']=="IL"){
	 		echo "<option  selected='selected'>ILETRADO(A)</option>";
	 		echo "<option value='IN'>INCAPACIDAD FISICA</option>";
			echo "<option value='AR'>A RUEGO</option>";
	 		}else if($rowsuper['especificacion']=="IN"){
		    echo "<option  selected='selected'>INCAPACIDAD FISICA</option>";
		 	echo "<option value='IL'>ILETRADO(A)</option>";
			echo "<option value='AR'>A RUEGO</option>";
			}
			else if($rowsuper['especificacion']=="AR"){
			echo "<option value ='AR' selected='selected'>A RUEGO</option>";
			echo "<option value='IL'>ILETRADO(A)</option>";
			echo "<option value='IN'>INCAPACIDAD FISICA</option>";
			}
			else if($rowsuper['especificacion']==""){
			echo "<option value ='' selected='selected'>SELECCIONE</option>";
			echo "<option value='IL'>ILETRADO(A)</option>";
			echo "<option value='IN'>INCAPACIDAD FISICA</option>";
			echo "<option value='AR'>A RUEGO</option>";
			}
	 		?>

    </select>
            </td>
        
        </tr>
      
        <tr>
          <td colspan="7"><span class="camposss">Observaciones:</span></td>
        </tr>
        <tr>
          <td colspan="7"><label for="observaciones">
            <textarea style="text-transform:uppercase;" name="observaciones" id="observaciones" cols="120" rows="6"><?php echo $rowsuper['observaciones']; ?></textarea>
          </label></td>
        </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30"><input name="swt_capacidad"  type="hidden" id="swt_capacidad" value="<?php echo $rowsuper['swt_capacidad']; ?>" />
      <input name="id_supervivencia"  type="hidden" id="id_supervivencia" value="<?php echo $rowsuper['id_supervivencia']; ?>" /></td>
  </tr>
</table>
</form>
</div>
</body>
</html>