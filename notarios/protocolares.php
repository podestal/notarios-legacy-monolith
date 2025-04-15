<?php
session_start();
if (empty($_SESSION["id_usu"])) 
  {
?>
	<script type="text/javascript">window.location="index.php"; </script>
<?php  
  }

include("conexion.php");
include("includes/combo.php"); 
include("fckeditor/fckeditor.php") ;
$tipoescritura = $_GET['te'];

$tipoid = $_GET['tipoid'];

$sql = mysql_query("SELECT * FROM tipokar",$conn) or die(mysql_error());
$sqlusuarios=mysql_query("SELECT * FROM usuarios order by loginusuario asc",$conn) or die(mysql_error());
$sql_abog = mysql_query("SELECT * FROM tb_abogado order by razonsocial asc ",$conn) or die(mysql_error());
$not = mysql_query("SELECT * FROM notarios order by descon asc ",$conn) or die(mysql_error());
$doc =mysql_query("SELECT * FROM tipodocumento",$conn) or die(mysql_error());
$sqlmon=mysql_query("SELECT * FROM monedas",$conn) or die(mysql_error()); 

$sqlmonv=mysql_query("SELECT * FROM monedas",$conn) or die(mysql_error()); 
$sqltpagov=mysql_query("SELECT * FROM mediospago ORDER BY desmpagos ASC",$conn) or die(mysql_error()); 

$sqltpago=mysql_query("SELECT * FROM mediospago ORDER BY desmpagos ASC",$conn) or die(mysql_error()); 
$sqlfpago=mysql_query("SELECT * FROM fpago_uif ORDER BY descripcion ASC",$conn) or die(mysql_error()); 

$sqlbancos=mysql_query("SELECT * FROM bancos ORDER BY desbanco ASC",$conn) or die(mysql_error()); 
$sqlsedess=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 
// 23-01-14 sede registral vehiculo:
$sqlsedess_vehi = mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 

$sqloporpago = mysql_query("SELECT * FROM oporpago",$conn) or die(mysql_error());
$sqltbienn   = mysql_query("SELECT * FROM tipobien ORDER BY tipobien.desestcivil ASC",$conn) or die(mysql_error());


$sqlsede =mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error());
$sqlsec =mysql_query("SELECT * FROM seccionesregistrales",$conn) or die(mysql_error());
$sqltra =mysql_query("SELECT * FROM tipotramogestion",$conn) or die(mysql_error());
$sqlestra=mysql_query("SELECT * FROM estadoregistral",$conn) or die(mysql_error());
$coduser=$_SESSION["id_usu"];
$sqluser=mysql_query("SELECT * FROM usuarios where idusuario='$coduser'",$conn) or die(mysql_error());

$sqlPresentante = mysql_query(" SELECT idPresentante,CONCAT(apellidoPaterno,' ',apellidoMaterno,' ',primerNombre,' ',segundoNombre)AS presentante,numeroDocumento FROM presentante",$conn) or die(mysql_error());

$sqlTemplate = "SELECT tpl_template.pkTemplate,tpl_template.nameTemplate,tipokar.nomtipkar,tpl_template.fkTypeKardex,tipokar.nomtipkar,tpl_template.codeActs,tpl_template.contract,tpl_template.urlTemplate,fileName 
FROM tpl_template INNER JOIN tipokar ON tpl_template.fkTypeKardex = tipokar.idtipkar";
$resultTemplate = mysql_query($sqlTemplate);



$rowwuser=mysql_fetch_array($sqluser);

$Hora= time();
$horaingreso=date( "H:i:s",$Hora);
//$horaingreso=time();

# CAPTCHA RENIEC
/*
$image_bin =  get_content('https://cel.reniec.gob.pe/valreg/codigo.do', false,null);
$myfile = fopen("reniec_sunat/imgcaptchareniec.jpg", "w") or die("Unable to open file!");
fwrite($myfile, $image_bin);
fclose($myfile);
*/

# CAPTCHA SUNAT
/*
$image_bin =  get_content('http://www.sunat.gob.pe/cl-ti-itmrconsruc/captcha?accion=image', false,null,'cookie1.txt');
$myfile = fopen("reniec_sunat/imgcaptchasunat.jpg", "w") or die("Unable to open file!");
fwrite($myfile, $image_bin);
fclose($myfile);
*/


# RENIEC - SUNAT
/*
function get_content($url, $useCookie,$params,$cookie = 'cookie.txt')  
{ 
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)');
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	if($useCookie)
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	if($params != null){
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
	$string = curl_exec ($ch);  
	curl_close ($ch);  
 
	return $string;      
}
*/
# FIN RENIEC - SUNAT
$idUsuarioError = $_SESSION["id_usu"];
// print_r($idUsuarioError);return false;
$sqlUsuarioError=mysql_query("SELECT * FROM usuarios WHERE idusuario = '$idUsuarioError'",$conn) or die(mysql_error());
$rowUsuarioError = mysql_fetch_assoc($sqlUsuarioError);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<!--<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>-->  <!-- jquery-1.9.0.js -->
<script src="includes/jquery-1.8.3.js"></script>

<script src="includes/js/jquery-ui-notarios.js"></script>

<script src="jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/uniform.default.css" type="text/css" media="screen">
<link href="js/sweetalert2.min.css" type="text/css" media="all" rel="stylesheet" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="tcal.css" />


<script type="text/javascript" src="tcal.js"></script>
<script type="text/javascript" src="mantenimiento/includes/jquery.scrollableFixedHeaderTable.js"></script>
<script src="includes/maskedinput.js"></script>

<script type="text/javascript">
function activaotro(){
	
document.getElementById('div_otroidoppago2').style.display="";
}

function activaotron(){
	
document.getElementById('div_otroidoppago').style.display="";
}

function activaotrobien(){
	
document.getElementById('oespecificos22').style.display="";
}

function activaotrobienm(){
	
document.getElementById('mequipos22').style.display="";
}

function activaotrobienv(){
	
document.getElementById('vterrestres22').style.display="";
}

//nuevoo

//nuevo
function activaotrobienn(){
	
document.getElementById('oespecificos').style.display="";
}



function activaotrobienmn(){
	
document.getElementById('mequipos').style.display="";
}

function activaotrobienvn(){
	
document.getElementById('vterrestres').style.display="";
}


function label_escri(){
	
	var tipok=document.getElementById('idtipkar').value;
	if(tipok==1){
		
		mostrar_desc('escri4');
		ocultar_desc('escri5');
		ocultar_desc('numins');
		mostrar_desc('min4');
		ocultar_desc('minsol');
		document.getElementById('numminuta').type="text";
		
	}else{
		if(tipok==3){
			
			mostrar_desc('escri5');
		    ocultar_desc('escri4');
		    ocultar_desc('numins');
			ocultar_desc('min4');
		    ocultar_desc('minsol');
			document.getElementById('numminuta').type="hidden";
			
			}else{
				if(tipok==2){
			
					ocultar_desc('escri5');
					ocultar_desc('escri4');
					mostrar_desc('numins');
					ocultar_desc('min4');
					mostrar_desc('minsol');
					document.getElementById('numminuta').type="text";
					}else{
						if(tipok==4){
			
						mostrar_desc('escri5');
						ocultar_desc('escri4');
						ocultar_desc('numins');
						ocultar_desc('min4');
						ocultar_desc('minsol');
						document.getElementById('numminuta').type="hidden";
						
						}else{
							
							mostrar_desc('escri4');
							ocultar_desc('escri5');
							ocultar_desc('numins');
							document.getElementById('numminuta').type="text";
							}
						
						}
				
				}
		}
		
}

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
// ***************************************************************
// ***************************************************************

// new: 
//// funciones a pegar en el signo//////////////////
function validacion(f)  {
if (isNaN(f)) {
alert("Error:\nEste campo debe tener sólo números.");
document.getElementById('importee').value="";
document.getElementById('importee').focus();
return (false);
 }
}

function numnot(f){if (isNaN(f)) { 
alert("Error:\nEste campo debe tener sólo números.");
document.getElementById('dnotarial').value="";
document.getElementById('dnotarial').focus();
return (false);
 }
 }

function numregi(f){if (isNaN(f)) {
alert("Error:\nEste campo debe tener sólo números.");
document.getElementById('dregistral').value="";
document.getElementById('dregistral').focus();
return (false);
 }
 }

function gbrescri(){
updatekardex();
}

function cambioampe(){
 valor=document.getElementById('referencia').value;
 texto=valor.replace(/&/gi,"*");
 textod2=texto.replace(/'/gi,"?");
 textod4=textod2.replace(/#/gi,"QQ11QQ");
 textod5=textod4.replace(/°/gi,"QQ22KK");
 document.getElementById('nreferencia').value=textod5;
	}
	
function oculistedi(){
	mostrarcontratante();
	ocultar_desc('clienedit')    
}

///// lo nuevo para agregar  en proto el amper y apostrofe

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
function direcction(){
	valord=document.getElementById('ndireccion').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion').value=textod;

}

function btngrabaremp3(){
	
// empresa
	var _razonsocial = document.getElementById('razonsocial');
	var _domfiscal = document.getElementById('domfiscal');
	var _ubigen = document.getElementById('ubigen');
	var _ciiu   = document.getElementById('actmunicipal');
	
	if( _razonsocial.value == '' || _domfiscal.value == '' || _ubigen.value == '')
	{alert('Faltan ingresar datos');return;}
	else{
	   grabarempresa3();
	   listarcontrata(); 
	   ocultar_desc('editcontrata2');
	   ocultar_desc('mantecontra');
	   //alert("Empresa grabada satisfactoriamente");
		}
}

//function verificarsi(valor){
	//if(valor=="1"){
		//mostrar_desc('verinscrit');
	//	}
	
	//if(valor=="0"){
	//	ocultar_desc('verinscrit');
	//	document.getElementById('idsederegerp').selectedIndex=0;
	//	}
	
	
	//}
/////////////////////////edicion ------


function apepaterno3(){
 valord=document.getElementById('napepat3').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apepat3').value=textod;
}

function apematerno3(){
 valord=document.getElementById('napemat3').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('apemat3').value=textod;

}
function prinombre3(){
	valord=document.getElementById('nprinom3').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('prinom3').value=textod;

}
function segnombre3(){
	valord=document.getElementById('nsegnom3').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('segnom3').value=textod;

}
function direcction3(){
	valord=document.getElementById('ndireccion3').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion3').value=textod;

}

function editcontratanteemp(){
	
	verclientee3();
	mostrar_desc('editcontrata2');
	//alert('recontramosn');
	}

function Select_Inserto(isChecked, myValue)
	{
		var _insertos = document.getElementById('num_inser').value;
		
		var separador = " , ";
		var quitar    = myValue + separador;
		var nuevoStr  = "";
		
		if (isChecked) 
			{
			
				document.getElementById('num_inser').value = _insertos + myValue + separador;}
		else 
			{
			
				document.getElementById('num_inser').value = _insertos.replace(quitar,nuevoStr);}
	
	}

function grabainsertos()
{
	var _divnumkar = document.getElementById('resultado').innerHTML;		
	if(_divnumkar == '')
	{
		alert('Falta generar el numero de kardex'); return;
	}
	grabainsertos2();
	
}

//// fin de las funciones a pegar en el signo//////////////////
	function eval_idoppago(valor)
		{   
			if(valor=="99")
			{
				mostrar_desc('div_otroidoppago');
				//document.getElementById('otroidoppago').value = "" ;
			}
			else 
			{			
			    ocultar_desc('div_otroidoppago');		
			}
			
		}

// edit patrimonial
	function eval_idoppago2(valor)
		{   
			if(valor=="99")
			{
				mostrar_desc('div_otroidoppago2');
				//document.getElementById('otroidoppago2').value = "" ;
			}
			else 
			{
				ocultar_desc('div_otroidoppago2');
				//document.getElementById('otroidoppago2').value = "";
			}
			
		}



function ocul_NewBienPatri()
{
	ocultar_desc('newbiennnes2');	
}

function listadobien2()
{ 
	var divResultado = document.getElementById('listbiennes');
	if(document.getElementById('listbiennes2'))
	{var divResultado2 = document.getElementById('listbiennes2');}
	
	var codkardex=document.frmprotocolares.codkardex.value;
	var _tipoactopatri = document.getElementById('tipactox').value;
	var ajax=objetoAjax();

	ajax.open("POST","listadobbiieenneess2.php",true);
	ajax.onreadystatechange=function() {
		
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
			if(document.getElementById('listbiennes2'))
			{divResultado2.innerHTML = ajax.responseText;}
		}
		
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&tipoactopatri="+_tipoactopatri);
	
}

function muesbieneditable2(_obj)
    {  
		// Contiene el id de detallebienes (para la edicion) : 
	    	document.getElementById('detbienx').value = _obj; 
			
		var data = { detbien : _obj }
		$("#verbienesedit2").load("mostrar_bienesedita2.php",data,function(){
			mostrar_desc('verbienesedit2');
		})  	
    }

function ocultarDigitacion()
{
	document.getElementById('escrituracion').style="display:none";
}

function gbienesedit2()
    {   
	   actbienes();
	   ocultar_desc('verbienesedit');
	   //mostrarlistmpp();
	   
    }	

///// ACTUALIZAR BIENES EDICION PATRIMONIAL
	function addgbbiens4()
	{
		var codkardex      = $("#codkardex").val();  
		var _idtipacto     = $("#tipoactopatrix").val();
		var detbien        = $("#detbienx").val();// Contiene el id de detallebienes (para la edicion)
		  
		var tipob          = $("#tipob3").val();  
		var tipobien       = $("#tipobien3").val(); 
		var codubis        = $("#codubis3").val(); 
		var fechaconst     = $("#fechaconst3").val(); 
		var oespecific     = $("#oespecific3").val();  
		var smaquiequipo   = $("#smaquiequipo4").val(); 
		var tpsm           = $("#tpsm4").val(); 
		var npsm           = $("#npsm4").val();  
		var itemmpp        = $("#itemmpx").val(); 
		/**/
		var _pregis		   = $("#pregis4").val();  
		var _idsederegbien = $("#idsedereg4").val();
		 
		var data = {
							codkardex     : codkardex,
							detbienx       : detbien,
							idtipacto     : _idtipacto,
							tipob2         : tipob,
							tipobien2      : tipobien,
							codubis2       : codubis,
							fechaconst2    : fechaconst,
							oespecific2    : oespecific,
							smaquiequipo2  : smaquiequipo,
							tpsm2 		  : tpsm,
							npsm2 		  : npsm,
							itemmpp 	  : itemmpp,
							pregis 	      : _pregis,
							idsederegbien : _idsederegbien  
							
						} ;
		$.post('editar_bien.php',data,function(data){
				alert("Bien grabado satisfactoriamente");
				listadobien2();
				ocultar_desc('verbienesedit2');			
			});
			return false;	
	}


// Editar detalle bienes Patrimonial:
function muesdiveditar2(_obj)
    {   
	    document.getElementById('detmpx').value = _obj;
		vermediopagoe2(_obj);
		mostrar_desc('vermediopagoedit2');
    }


// EDITAR  MEDIO DE PAGO
function vermediopagoe2(_obj)
{
	    var data = { detmp : _obj }
		$("#vermediopagoedit2").load("mostrar_mpagoedit2.php",data,function(){
			
		})	
} 


//////  ACTUALIZA MEDIO DE PAGO
function gmediopago2()
    {   
		var codkardex          = $("#codkardex").val();   
		var mediopago2         = $("#mediopago2").val();  
		var entidadfinanciera2 = $("#entidadfinanciera2").val();  
		var impmediopago2      = $("#impmediopago6").val();  
		var fechaoperacion2    = $("#fechaoperacion6").val();  
		var documentos2        = $("#documentos6").val(); 
		var itemmpp            = $("#detmpx").val(); 
		var monedas2		   = $("#monedas2").val();  
		
			
			
		var data = {
						kardex            : codkardex,
						mediopago         : mediopago2,
						entidadfinanciera : entidadfinanciera2,
						impmediopago      : impmediopago2,
						fechaoperacion    : fechaoperacion2,
						documentos        : documentos2,
						detmp             : itemmpp,
						monedas2          : monedas2
					} ;
							
		$.post('grabar_editpago.php',data,function(data){
			
				alert("Se actualizo medio de pago");
				$("#listmedpago2").load("listarmpp2.php", {codkardex : codkardex}, function(){
					ocultar_desc('vermediopagoedit2');		
					})	
				
			});
			return false;
    }	

// ELIMINAR COSAS

// detbienx

function ElimDetBienes(_obj)
    {   
	    document.getElementById('detbienx').value = _obj;
		if(confirm('Desea eliminar el bien..?'))
		{elimDetBien();}
		
    }
////////////////////////////////////////////////////
function elimDetBien()
{ 
	var _detbienx = document.getElementById('detbienx').value;
	ajax=objetoAjax();
	
	ajax.open("POST","elim_detbien.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			listarbienesss();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("detbienx="+_detbienx)
	}


// Elim Medios pago
////////////////////////////////////////////////////
function moselimp2(_obj)
    {   
	    document.getElementById('detmpx').value = _obj;
		if(confirm('Desea eliminar el medio de pago..?'))
		{elimdetpago2();}
		
    }
// Elim Medios pago
function elimdetpago2()
{ 
	var detmpx     = document.getElementById('detmpx').value;
	var codkardex  = $("#codkardex").val(); 
	ajax=objetoAjax();
	
	ajax.open("POST","elim_detpago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			$("#listmedpago2").load("listarmpp2.php", {codkardex : codkardex}, function(){
					//ocultar_desc('vermediopagoedit2');		
					})	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("detmp="+detmpx)
	}
	
	
// 	Elim Bienes de Editar Patrimonial
function ElimDetBienes2(_obj)
    {   
	    document.getElementById('detbienx').value = _obj;
		if(confirm('Desea eliminar el bien..?'))
		{elimDetBien2();}
		
    }	
// 	Elim Bienes de Editar Patrimonial
function elimDetBien2()
{ 
	var _detbienx = document.getElementById('detbienx').value;
	ajax=objetoAjax();
	
	ajax.open("POST","elim_detbien.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			listarbienesss2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("detbienx="+_detbienx)
	}
		



// **************************************************************************
// **************************************************************************
// ACCIONES VEHICULOS.
function agregarVehiculo()
    {   
		  ocultar_desc('listvehiculos');
		 // ocultar_desc('vbien');
		  mostrar_desc('newvehiculo');
		
		  // ***
		  $("#detvehx").val(""); 
		  
		  $("#idplacav").val("");
		  $("#numplacav").val("");
		  $("#clasev").val("");
		  
		  $("#marcav").val("");
		  $("#anofabv").val("");
		  $("#modelov").val("");
		  $("#combustiblev").val("");
		  
		  $("#carroceriav").val("");
		  $("#colorv").val("");
		  $("#motorv").val("");
		  $("#numcilv").val("");
		  $("#numseriev").val("");
		  
		  $("#numruedav").val("");
		  $("#numseriev").val("");
		  $("#fecinscv").val("<?php echo date("d/m/Y"); ?>");
		  // ***	
		  
		  // new 23-01-14
		  $("#pregis_vehi").val("");
		  $("#idsedereg2_vehi").val("");
		  
		  return false;
    }
	
// ACCIONES VEHICULOS.
function agregarVehiculo2()
    {   
		  ocultar_desc('listvehiculos2');
		  //ocultar_desc('vbien2');
		  mostrar_desc('newvehiculo2');		
		  // *** 
		  $("#detvehx2").val(""); 
		  
		  $("#idplacav2").val("");
		  $("#numplacav2").val("");
		  $("#clasev2").val("");
		  
		  $("#marcav2").val("");
		  $("#anofabv2").val("");
		  $("#modelov2").val("");
		  $("#combustiblev2").val("");
		  
		  $("#carroceriav2").val("");
		  $("#colorv2").val("");
		  $("#motorv2").val("");
		  $("#numcilv2").val("");
		  $("#numseriev2").val("");
		  
		  $("#numruedav2").val("");
		  $("#numseriev2").val("");
		  $("#fecinscv2").val("<?php echo date("d/m/Y"); ?>");
		  // ***	
		  
		  // new 23-01-14
		  $("#pregis_vehi_2").val("");
		  $("#idsedereg2_vehi_2").val("");
		  
		  return false;
    }	

function listarVehiculos()
	{
		var _codkardex      = $("#codkardex").val(); 
		var _tipoactopatri  = $("#tipactox").val();
		var data = {codkardex : _codkardex , tipoactopatri : _tipoactopatri}; 
		$("#listvehiculos").load("listadovehiculos.php",data,function(){ 
			ocultar_desc('newvehiculo');
			mostrar_desc('listvehiculos');
		})	
		return false;
	}
	
function listarVehiculos2()
	{
		var _codkardex      = $("#codkardex").val(); 
		//var _tipoactopatri  = $("#tipactox").val();
		var _tipoactopatri  = $("#tipoactopatrix").val();
		
		var data = {codkardex : _codkardex , tipoactopatri : _tipoactopatri};
		$("#listvehiculos2").load("listadovehiculos2.php",data,function(){ 
			ocultar_desc('newvehiculo2');
			mostrar_desc('listvehiculos2');
		})	
		return false;
	}	


// 1 GUARDA DATOS VEHICULO NUEVO - NUEVO KARDEX
function gbvehicular()
    {
		var _detvehx = document.getElementById('detvehx').value;
		 
	var codkardex  = $("#codkardex").val(); 
	var _idtipacto = $("#tipactox").val();
	
	var _idplaca  = document.getElementById('idplacav').value;
	var _numplaca = document.getElementById('numplacav').value;
	var _clase    = document.getElementById('clasev').value;
	var _marca    = document.getElementById('marcav').value;
	var _anofab   = document.getElementById('anofabv').value;
	var _modelo   = document.getElementById('modelov').value;
	var _combustible = document.getElementById('combustiblev').value;
	var _carroceria  = document.getElementById('carroceriav').value;
	var _fecinsc  = document.getElementById('fecinscv').value;
	var _color    = document.getElementById('colorv').value;
	var _motor    = document.getElementById('motorv').value;
	var _numcil   = document.getElementById('numcilv').value;
	var _numserie = document.getElementById('numseriev').value;
	var _numrueda = document.getElementById('numruedav').value;
	var _idmon    = document.getElementById('idmonv').value;
	var _precio   = document.getElementById('preciov').value;
	var _codmepag = document.getElementById('codmepagv').value;
	
	// Nuevo 23-01-14
	var _pregis_vehi     = document.getElementById('pregis_vehi').value;
	var _idsedereg2_vehi = document.getElementById('idsedereg2_vehi').value;

	var ajax=objetoAjax();
	
	if(_idplaca=='' || _numplaca ==''){alert('Ingrese el tipo y/o numero de placa');return;}
	
	ajax.open("POST","grabar_newvechiculo.php",true);
	ajax.onreadystatechange=function() {
	if (ajax.readyState==4 && ajax.status==200) {
		alert("Vehiculo grabado satisfactoriamente");
		listarVehiculos();
	
	  }
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&idtipacto="+_idtipacto+"&idplaca="+_idplaca+"&numplaca="+_numplaca+"&clase="+_clase+"&marca="+_marca+"&anofab="+_anofab+"&modelo="+_modelo+"&combustible="+_combustible+"&carroceria="+_carroceria+"&fecinsc="+_fecinsc+"&color="+_color+"&motor="+_motor+"&numcil="+_numcil+"&numserie="+_numserie+"&numrueda="+_numrueda+"&idmon="+_idmon+"&precio="+_precio+"&codmepag="+_codmepag+"&detvehx="+_detvehx+"&pregis_vehi="+_pregis_vehi+"&idsedereg2_vehi="+_idsedereg2_vehi);
	  
	}

// 2 EDITA DATOS VEHICULO - EDITAR PATRIMONIAL
function gbvehicular2()
    { 
		var _detvehx2 = document.getElementById('detvehx2').value;
		
		var codkardex = document.getElementById('codkardex').value;
		//var _idtipacto = document.getElementById('tipactox').value;
		var _idtipacto = document.getElementById('tipoactopatrix').value;
				
		var _idplaca  = document.getElementById('idplacav2').value;
		var _numplaca = document.getElementById('numplacav2').value;
		var _clase    = document.getElementById('clasev2').value;
		var _marca    = document.getElementById('marcav2').value;
		var _anofab   = document.getElementById('anofabv2').value;
		
		var _modelo   = document.getElementById('modelov2').value;
		var _combustible = document.getElementById('combustiblev2').value;
		var _carroceria  = document.getElementById('carroceriav2').value;
		var _fecinsc  = document.getElementById('fecinscv2').value;
		var _color    = document.getElementById('colorv2').value;
		var _motor    = document.getElementById('motorv2').value;
		var _numcil   = document.getElementById('numcilv2').value;
		var _numserie = document.getElementById('numseriev2').value;
		var _numrueda = document.getElementById('numruedav2').value;
		
		// Nuevo 23-01-14
		var _pregis_vehi     = document.getElementById('pregis_vehi_2').value;
		var _idsedereg2_vehi = document.getElementById('idsedereg2_vehi_2').value;

		
		if( _numplaca =='' || _idplaca==''){alert('Ingrese el tipo y/o numero de placa');return;}
		
		var ajax = objetoAjax();

		
		ajax.open("POST","editar_newvehiculo.php",true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4 && ajax.status==200) {
				alert("Vehiculo actualizado satisfactoriamente");
				listarVehiculos2();
			  }
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("codkardex="+codkardex+"&idtipacto="+_idtipacto+"&idplaca="+_idplaca+"&numplaca="+_numplaca+"&clase="+_clase+"&marca="+_marca+"&anofab="+_anofab+"&modelo="+_modelo+"&combustible="+_combustible+"&carroceria="+_carroceria+"&fecinsc="+_fecinsc+"&color="+_color+"&motor="+_motor+"&numcil="+_numcil+"&numserie="+_numserie+"&numrueda="+_numrueda+"&detvehx="+_detvehx2+"&pregis_vehi="+_pregis_vehi+"&idsedereg2_vehi="+_idsedereg2_vehi)
  
	  }


function muesVehiEditable(_obj)
{
	var _detveh    = _obj;
	var data       = {detveh : _detveh}
		$.getJSON('BuscaEditVehiculo.php',data,function(respuesta){
			
		var _Datos = respuesta;
		
		$("#detvehx").val(_Datos[0].detveh);
		$("#idplacav").val(_Datos[0].idplaca);		
		$("#numplacav").val(_Datos[0].numplaca);
		$("#clasev").val(_Datos[0].clase);
		$("#marcav").val(_Datos[0].marca);
		$("#anofabv").val(_Datos[0].anofab);
		$("#modelov").val(_Datos[0].modelo);
		$("#combustiblev").val(_Datos[0].combustible);
		$("#carroceriav").val(_Datos[0].carroceria);
		$("#fecinscv").val(_Datos[0].fecinsc);
		$("#colorv").val(_Datos[0].color);
		$("#motorv").val(_Datos[0].motor);
		$("#numcilv").val(_Datos[0].numcil);
		$("#numseriev").val(_Datos[0].numserie);
		$("#numruedav").val(_Datos[0].numrueda);
		
		// new 23-01-14
		$("#pregis_vehi").val(_Datos[0].pregistral);
		$("#idsedereg2_vehi").val(_Datos[0].idsedereg);
		
		 ocultar_desc('listvehiculos');
		 mostrar_desc('newvehiculo');	
		
	})		
}

	function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('codubi').value = name;  
  ocultar_desc('buscaubi');     
        
    }
	
	
// 2 MUESTRA DATOS EDITAR VEHICULO - EDICION PATRIMONIAL:
function muesVehiEditable2(_obj)
{
	var _detveh    = _obj;
	var data       = {detveh : _detveh}
		$.getJSON('BuscaEditVehiculo.php',data,function(respuesta){
			
		var _Datos = respuesta;
		
		$("#detvehx2").val(_Datos[0].detveh);
		$("#idplacav2").val(_Datos[0].idplaca);		
		$("#numplacav2").val(_Datos[0].numplaca);
		$("#clasev2").val(_Datos[0].clase);
		$("#marcav2").val(_Datos[0].marca);
		$("#anofabv2").val(_Datos[0].anofab);
		$("#modelov2").val(_Datos[0].modelo);
		$("#combustiblev2").val(_Datos[0].combustible);
		$("#carroceriav2").val(_Datos[0].carroceria);
		$("#fecinscv2").val(_Datos[0].fecinsc);
		$("#colorv2").val(_Datos[0].color);
		$("#motorv2").val(_Datos[0].motor);
		$("#numcilv2").val(_Datos[0].numcil);
		$("#numseriev2").val(_Datos[0].numserie);
		$("#numruedav2").val(_Datos[0].numrueda);
		
		// NUEVO 23-01-14
		$("#pregis_vehi_2").val(_Datos[0].pregistral);
		$("#idsedereg2_vehi_2").val(_Datos[0].idsedereg);
		
		 ocultar_desc('listvehiculos2');
		 mostrar_desc('newvehiculo2');	

	})		
}

function ElimVehi(_obj)
{
	  var _detveh    = _obj;
	  var data       = {detveh : _detveh}
	  if(confirm('Dese eliminar el vehiculo..?'))
	  {
		$.post("Elimvehi.php",data,function(){listarVehiculos();});
	  }	
}

function ElimVehi2(_obj)
{
	  var _detveh    = _obj;
	  var data       = {detveh : _detveh}
	  if(confirm('Dese eliminar el vehiculo..?'))
	  {
		$.post("Elimvehi.php",data,function(){listarVehiculos2();});
	  }	
}

// **************************************************************************
	
// Facturación:
////// MUESTRA LOS PAGOS POR EL KARDEX
	function FShowPagos_Kardex_result()
	{
		var _numkar = $("#codkardex").val();
		$("#divShowPagos").load("ShowPagos_Kardex.php",{codkardex : _numkar}, function(){});
		fCalculos2();	
	}
	
	// Evalua la pestaña Registros Públicos.
		function FShowPagos_Kardex_result_2()
	    {
        FShowPagos_Kardex_result();
		
		//LA FUNCION COMENTADA HACE UN BUCLE DE FUNCIONES.
		mostrarnewreg();
		var _numkar = $("#codkardex").val();
		var _cobrado = $("#cobrado2").val();
		var _pagadorrpp = $("#prrpp").val();
		var _result =  _pagadorrpp - _cobrado;
		
		$("#xcobra").val(_result);
		if($("#cobra"))
		{$("#cobra").val(_cobrado);}

		
		
	}
	
	function fCalculos2()
		{ 
			var _table          = $("#detPagosTb");
			var _subNotarial    = 0; 
			var _subRegistral   = 0; 
			
			var _preNotarial    = parseFloat($("#pre1").val());
			var _preRegistral   = parseFloat($("#pre2").val());
			
			var _cobroNotarial  = parseFloat($("#crobado1").val()); 
			var _cobroRegistral = parseFloat($("#cobrado2").val()); 
			
			var _saldoNotarial  = parseFloat($("#saldo1").val());  
			var _saldoRegistral = parseFloat($("#saldo2").val()); 
			 
			
			for(i=1;i<=$('#detPagosTb >tbody >tr').length;i++)
				{
					_datos = $("#datosTb"+i).val();
					_datos = _datos.split('|');
						// Evalua si se encuentra pagado
						if(_datos[3]=='PAGADO')
						{		// Evalua el tipo de documento - Notarial
								if(_datos[0]=='BOLETA' || _datos[0]=='FACTURA' || _datos[0]=='NOTA DE CREDITO')
								{
									if(_datos[0]=='NOTA DE CREDITO')
										{_subNotarial =	_subNotarial - parseFloat(_datos[4])}
									else
										{_subNotarial =	_subNotarial + parseFloat(_datos[4])}	
								}
								// Evalua el tipo de documento - Registral
								else if(_datos[0]=='RECIBO')
								{
									_subRegistral =	_subRegistral + parseFloat(_datos[4])
								}
						}
					// BOLETA | 01-000003 | 03/09/2013 | PAGADO | 159.30 | 0.00
				 }
				if(_subNotarial=='' || _subNotarial==0){$("#crobado1").val('0.00');}else{$("#crobado1").val((Math.round(_subNotarial * 10) / 10)+".00" );}
				if(_subRegistral=='' || _subRegistral==0){$("#cobrado2").val('0.00');}else{$("#cobrado2").val((Math.round(_subRegistral * 10) / 10)+".00" );}
				
				var _saldo1_ = parseFloat($("#pre1").val()) - _subNotarial;
				var _saldo2_ = parseFloat($("#pre2").val()) - _subRegistral;
				
				$("#saldo1").val((Math.round(_saldo1_ * 10) / 10)+".00") ;
				$("#saldo2").val((Math.round(_saldo2_ * 10) / 10)+".00");
		}	
	
		
// ***************************************************************
// ***************************************************************

///// funcionaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
////// patrimonial 2
function newgbrmp2()
    {  
	    gggppp2();
		mostrar_desc('listmedpago');
		ocultar_desc('regmedpago');
	    //mostrarlistmpp();
	    
    }

function gggppp2(){
	
		var codkardex         = $("#codkardex").val();
		var mediopago         = $("#mediopago3").val();
		var entidadfinanciera = $("#entidadfinanciera3").val();
		var impmediopago      = $("#impmediopago3").val();
		var fechaoperacion    = $("#fechaoperacion3").val();
		var documentos        = $("#documentos3").val();
		var itemmpp           = $("#itemmpxx").val();
		var _idtipacto        = $("#tipoactopatrix").val();
		var fpago             = $("#fpago2").val();
		var idmon_mp          = $("#idmon_mp3").val();
		
		var data = {
					codkardex         : codkardex,
					mediopago         : mediopago,
					entidadfinanciera : entidadfinanciera,
					impmediopago      : impmediopago,
					fechaoperacion    : fechaoperacion,
					documentos        : documentos,
					itemmpp           : itemmpp,
					idtipacto         : _idtipacto,
					fpago             : fpago,
					idmon             : idmon_mp
				   };
	
		$.post('grabar_newmp.php',data,function(data){
				mostrarlistmpp3();		
				alert("Medio de Pago Grabado Satisfactoriamenteaaaaaaaaaaaaa");
				ocultar_desc('regmedpago2'); 
			});
			return false;		
	}

	function mostrarlistmpp3()
	{	
		var codkardex = $("#codkardex").val();
		$("#listmedpago2").load("listarmpp2.php", { codkardex : codkardex }, function(){ })
	}
	

	function mmmppp2()
		{   
			mostrar_desc('regmedpago2');
			//ocultar_desc('listmedpago2'); 
			
			$("#impmediopago3").val("");
			$("#fechaoperacion3").val("");
			$("#documentos3").val("");
			$("#mediopago3").val("");
			$("#entidadfinanciera3").val("");
			$("#idmon_mp3").val("2");

		}

	function Eval_sucIntestada()
	{
		var _contrato = $("#contrato").val();
		var _busqueda = _contrato.search("SUCESION INTESTADA");//alert(_busqueda);
		if(_busqueda != -1)
		{
			$("#minsol").attr("style","display:none");
     		$("#numminuta").attr("style","display:none");
		}
	
	}


$(document).ready(function() {
	
		
	// ================================  Cambios Carlos 11/08/2013 ================================
	
	// sets
	$("#idsedereg2").val("");
	$("#idsedereg3").val("09");
	$("#tipomoneda").val("2");
	$("#numdoc2").attr("maxlength", 8);
	$("#numdoc6").attr("maxlength", 8);


	// functions
	
	
		$("#_saveNewBien3").live("click",  function(){
		
			var _tipob       = $("#tipob3").val();
			var _tipobien	 = $("#tipobien3").val();
			var _ubigens     = $("#ubigens3").val();
			var _fechaconst  = $("#fechaconst3").val();
			var _pregis      = $("#pregis4").val();
			
			//if(_tipob=='' || _tipobien=='' || _ubigens=='' || _fechaconst =='' || _pregis=='')
			
			addgbbiens4();
		})	
	
	
	// EVALUA TRANSFERENCIAS VEHICULARES
	$("#idtipkar").change( function(){
		
			var _idtipkar = $("#idtipkar").val();
			
			if(_idtipkar=='3')
			{
				$("._fecminutaEval").attr("style","display:none");		
			}
				else if(_idtipkar!='3')
				{
					$("._fecminutaEval").removeAttr("style","display:none");
				}
			 
		}) 
	
	$("#_clickBuscaUbis").click( function(){
			$("#buscaubis").focus();

		})
		
		
	// PARA CONYUGES 24-01-2014
	$("#_selectConyuge1").live( "click", function(){
			$("#tidocu").val("");
			$("#numdoc2").val("");
			$("#nuevaconyuge").html("");
			$("#numdoc2").focus();
		})
		
	// PARA CONYUGES EDITABLE 24-01-2014
	$("#_selectConyuge2").live( "click", function(){
			$("#tidocu2").val("");
			$("#numdoc6").val("");
			$("#nuevaconyuge2").html("");
			$("#numdoc6").focus();
		})
		
	// PARA CONYUGES EDITABLE 24-01-2014 VERKARDEX
	$("#_busConyuge2").live( "click", function(){
			$("#tidocu2").val("");
			$("#numdoc6").val("");
			$("#nuevaconyuge2").html("");
			$("#numdoc6").focus();
		})
		
	// PLUGIN FECHAS EN TODOS LOS CAMPOS **********	
	$("#fec_ingreso").mask("99/99/9999",{placeholder:"_"});			
				
	
	// ********************************************
	
	//
	$('#numdoc').live( "keypress", function(e) {
		  if (e.which == '13') {
			 e.preventDefault();
			 evalDocumento();
		   } 
	  });
	
	//	
	$('#numdoc2').live( "keypress", function(e) {
		  if (e.which == '13') {
			 e.preventDefault();
			buscaclientes2();
		   } 
	  });
	  
	  //	
	$('#numdoc6').live( "keypress", function(e) {
		  if (e.which == '13') {
			 e.preventDefault();
			buscaclientes6();
		   } 
	  });
		
	// ************************	
	
		
	$("#_busUbiEditBien").live( "click", function(){
			$("#buscaubis22").val("");
			$("#resulubis2").html("");
			$("#buscaubis22").focus();
		
		})
	
	$("#_CloseUbiEditBien").live( "click", function() {
			$("#buscaubis22").val("");
			$("#resulubis2").html("");
		})
				
	$("#_CloseUbiEditBien").live( "click", function() {
			$("#buscaubis22").val("");
			$("#resulubis2").html("");
		})
						
				
	$("#_CloseDivUbi").click( function() {
			$("#buscaubis").val("");
			$("#resulubis").html("");
		})
	
	$("#_RegMedPago").click(function(){
			// mediopago
			// entidadfinanciera
			// idmon_mp =  "2"
			
			// impmediopago
			// fechaoperacion
		
			// no funciona:
			//$("#mediopago").val("0");
			
			// no funciona:
			//document.getElementById('mediopago').selectedIndex = 1 ;
			
			// no funciona:
			//$('#mediopago option[value=0]').attr('selected', 'selected');
			
			// no funciona
			$("#entidadfinanciera").val("0");
			$("#mediopago").val("0");
			$("#idmon_mp").val("2");
			$("#oespecific").attr("style","text-transform:uppercase");
		})
	
	
	
	
	
	$("#_saveNewMedPago").click( function(){
		
			var _mediopago         = $("#mediopago").val();
			var _entidadfinanciera = $("#entidadfinanciera").val();
			var _idmon_mp          = $("#idmon_mp").val();
			var _impmediopago      = $("#impmediopago").val();
			var _fechaoperacion    = $("#fechaoperacion").val();
			var _documentos    = $("#documentos").val();

			// console.log(_documentos)
			if(_mediopago=='1' || _mediopago=='7' || _mediopago=='2' || _mediopago=='3'){

				if(_documentos==''){

					Swal.fire({
						icon: 'error',
						title: 'FALTA COMPLETAR EL DOCUMENTO DE PAGO',
						// text: 'Llene el numero de document',
					})
					return false;
				}
			}
			
			newgbrmp();
		})
		
	$("#_saveNewBien").click( function(){ 
			var _tipob       = $("#tipob").val();
			var _tipobien	 = $("#tipobien").val();
			var _ubigens     = $("#ubigens").val();
			var _fechaconst  = $("#fechaconst").val();
			var _pregis      = $("#pregis").val();
			
			//if(_tipob=='' || _tipobien=='' || _ubigens=='' || _fechaconst =='' || _pregis=='')
			
			gbbiennes();
		
		})	


	$("#_saveNewBien2").live("click",  function(){
		
			var _tipob       = $("#tipob2").val();
			var _tipobien	 = $("#tipobien2").val();
			var _ubigens     = $("#ubigens2").val();
			var _fechaconst  = $("#fechaconst2").val();
			var _pregis      = $("#pregis3").val();
			
			//if(_tipob=='' || _tipobien=='' || _ubigens=='' || _fechaconst =='' || _pregis=='')
			
			gbbiennes3();
		})	
	//
	
		// ******************************************
		$("#_busUbiPatr2").live( "click", function(){
			$("#buscaubisx").val("");
			$("#resulubis3").html("");
			$("#buscaubisx").focus();
		
		})	



	
	
	function gbbiennes3()
	{ 
		addgbbiens3();
		
		ocultar_desc('newbiennnes2');
		
	}
	/////////////////////
	function addgbbiens3()
	{
		var codkardex    = $("#codkardex").val();  
		var _idtipacto   = $("#tipoactopatrix").val();
		  
		var tipob        = $("#tipob2").val();  
		var tipobien     = $("#tipobien2").val(); 
		var codubis      = $("#codubis2").val(); 
		var fechaconst   = $("#fechaconst2").val(); 
		var oespecific   = $("#oespecific2").val();  
		var smaquiequipo = $("#smaquiequipo3").val(); 
		var tpsm         = $("#tpsm3").val(); 
		var npsm         = $("#npsm3").val();  
		var itemmpp      = $("#itemmpx").val(); 
		/**/
		var _pregis		   = $("#pregis3").val();  
		var _idsederegbien = $("#idsedereg3").val();
		 
			var data = {
							codkardex     : codkardex,
							idtipacto     : _idtipacto,
							tipob         : tipob,
							tipobien      : tipobien,
							codubis       : codubis,
							fechaconst    : fechaconst,
							oespecific    : oespecific,
							smaquiequipo  : smaquiequipo,
							tpsm 		  : tpsm,
							npsm 		  : npsm,
							itemmpp 	  : itemmpp,
							pregis 	      : _pregis,
							idsederegbien : _idsederegbien  
							
						} ;
		$.post('grabar_newbienn.php',data,function(data){
				alert("Bien grabado satisfactoriamente");
				listadobien2();			
			});
			return false;	
	}
		
	
	


	// ================================ Fin Cambios 10/08/2013 ================================
	
	$("#idsedereg").val("09");
	
	$("#limprofe").live( "click", function() {
			$("#buscaprofes").val("");
			$("#resulprofesiones").html("");
			$("#buscaprofes").focus();
		})	
	
	$("#limcargo").live( "click", function() {
			$("#buscacargooss").val("");
			$("#resulcargito").html("");
			$("#buscacargooss").focus();
			
		})	
	
	$("#limubi").live( "click", function() {
			$("#buscaubisc").val("");
			$("#resulubisc").html("");
			$("#buscaubisc").focus();
		})	
	
	$("#limpconyuge").live( "click", function() {
			$("#buscaubisc2").val("");
			$("#resulubisc2").html("");
			$("#buscaubisc2").focus();
		})
		
	$("#busedit").live( "click", function() {
			$("#buscaubisc3").val("");
			$("#resulubisc3").html("");
			$("#buscaubisc3").focus();
		})
		
		
	$("#busprofe3").live( "click", function() {
			$("#buscaprofes3").val("");
			$("#resulprofesiones3").html("");
			$("#buscaprofes3").focus();
		})
		
	$("#buscargo3").live( "click", function() {
			$("#buscacargooss3").val("");
			$("#resulcargito3").html("");
			$("#buscacargooss3").focus();
		})
	
	
		$("#busprofe2e").live( "click", function() {
			$("#buscaprofescnt").val("");
			$("#resulprofesionescnt").html("");
			$("#buscaprofescnt").focus();
		})
	
	$("#buscaedit2").live( "click", function() {
			$("#buscaubisccnt").val("");
			$("#resulubisccnt").html("");
			$("#buscaubisccnt").focus();
		})
	
		$("#buscargo2o").live( "click", function() {
			$("#buscacargoosscnt").val("");
			$("#resulcargitocnt").html("");
			$("#buscacargoosscnt").focus();
		})
	
		$("#busubiruccc").live( "click", function() {
			$("#buscaubi").val("");
			$("#resulubi").html("");
			$("#buscaubi").focus();
		})
	
	$("#buscaubi777").live( "click", function() {
			$("#buscaubisc7").val("");
			$("# resulubisc7").html("");
			$("#buscaubisc7").focus();
		})
	
	$("#clieee").live( "click", function() {

			$("#busclie").html("");
			
			
		})	
	
	$("#newcontratantee").live( "onmouseover", function() {
			
			$("#cbopersonas").html("");
			
		})
		
		$("#exisconyuge").live( "click", function() {
			$("#buscaubisc4").val("");
			$("#resulubisc4").html("");
			$("#buscaubis4").focus();
		})
	
	$("#buscaprofis").live( "click", function() {
			$("#buscaprofes4").val("");
			$("#resulprofesiones4").html("");
			$("#buscaprofes4").focus();
		})
	
	$("#buscacargooooooo").live( "click", function() {
			$("#buscacargooss4").val("");
			$("#resulcarguito4").html("");
			$("#buscacargooss4").focus();
		})
	

	$("#ocupa").live( "click", function() {
			$("#buscaprofes2").val("");
			$("#resulprofesiones2").html("");
			$("#buscaprofes2").focus();
		})
		
	$("#carguis").live( "click", function() {
			$("#buscacargooss2").val("");
			$("#resulcargito2").html("");
			$("#buscacargooss2").focus();
		})	
		
	$("#profe7").live( "click", function() {
			$("#buscaprofes7").val("");
			$("#resulprofesiones7").html("");
			$("#buscaprofes7").focus();
		})
		
		
	$("#car7").live( "click", function() {
			$("#buscacargooss7").val("");
			$("#resulcargito7").html("");
			$("#buscacargooss7").focus();
		})
	//clieee	
	
$(".Contenido").hide(); //Para ocultar los DIV's con contenido
$("ul.tabs li:first").addClass("active").show(); //Activamos el primer TAB
$(".Contenido:first").show(); //Muestra el contenido respectivo al primer TAB
 
//Al clickar sobre los Tabs
$("ul.tabs li").click(function() {
$("ul.tabs li").removeClass("active"); //Anula todas las selecciones
$(this).addClass("active"); //Asigna la clase Active al TAB Seleccionado
$(".Contenido").hide(); //Esconde todo el contenido de la tab
var activeTab = $(this).find("a").attr("href"); //Ubica los valores HREF y A para enlazarlos y activarlos
$(activeTab).fadeIn(); //Habilita efecto Fade en la transición de contenidos
return false;
});
});


</script>

<script type="text/javascript" charset="utf-8">
      $(function(){
        //$("input, textarea, select, button").uniform();
		$("input, select, button").uniform();
		
		// REMOVER ESTILOS COMBO
		// 1
		$("#mediopago").removeAttr("style");
		$("#uniform-mediopago").removeClass("selector");
		$('#uniform-mediopago').find('span').remove();
		$("#mediopago").attr("style","width:200px;");
		
		// 2
		$("#entidadfinanciera").removeAttr("style");
		$("#uniform-entidadfinanciera").removeClass("selector");
		$('#uniform-entidadfinanciera').find('span').remove();
		$("#entidadfinanciera").attr("style","width:200px;");
		
		// 3
		$("#idmon_mp").removeAttr("style");
		$("#uniform-idmon_mp").removeClass("selector");
		$('#uniform-idmon_mp').find('span').remove();
		$("#idmon_mp").attr("style","width:200px;");
		
		
		// BIENES
		// 1
		$("#tipob").removeAttr("style");
		$("#uniform-tipob").removeClass("selector");
		$('#uniform-tipob').find('span').remove();
		$("#tipob").attr("style","width:200px;");
		
		// 2
		$("#tipobien").removeAttr("style");
		$("#uniform-tipobien").removeClass("selector");
		$('#uniform-tipobien').find('span').remove();
		$("#tipobien").attr("style","width:200px;");
		
		// 3
		$("#idsedereg2").removeAttr("style");
		$("#uniform-idsedereg2").removeClass("selector");
		$('#uniform-idsedereg2').find('span').remove();
		$("#idsedereg2").attr("style","width:200px;");
		
		// Tipo de documento del conyuge
		$("#tidocu").removeAttr("style");
		$("#uniform-tidocu").removeClass("selector");
		$('#uniform-tidocu').find('span').remove();
		$("#tidocu").attr("style","width:200px;");
		
		// Tipo de documento del conyuge EDITABLE
		$("#tidocu2").removeAttr("style");
		$("#uniform-tidocu2").removeClass("selector");
		$('#uniform-tidocu2').find('span').remove();
		$("#tidocu2").attr("style","width:200px;");		
		
      });
    </script>



<script type="text/javascript">

function validarcontra()
    { 
	
	// Evalua los campos :  
	var _tipoper = $("#tipoper").val();
	
		if(_tipoper=='N')
		{
					var _napepat     = $("#apepat").val();
					var _nprinom     = $("#prinom").val();
					var _ndireccion  = $("#direccion").val();
					var _codubis     = $("#eval_codubis").val();
					var _idestcivil  = $("#eval_idestcivil").val();
					var _sexo        = $("#eval_sexo").val();
					var _idprofesion = $("#eval_idprofesion").val();
					
						if( _napepat == '' || _nprinom == '' || _ndireccion == '' || _idestcivil=='0' || _codubis == '0' || _sexo == '' || _idprofesion == '0')
						{	
							   if(confirm('Falta ingresar datos de SUNAT/UIF, desea continuar..?'))
							     {  grabarcontratantes();
	  								ocultar_desc('clienbus');  
								 }
						}
						else {		
								grabarcontratantes();
	  							ocultar_desc('clienbus'); 
							 }			
		}
		else if(_tipoper=='J')
		{
			grabarcontratantes();
	 		ocultar_desc('clienbus'); 	
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


function hhh()
    { 
	  mostraraconyuge();
	  mostrar_desc('conyugesss2');
	  
	 }	


function format(){
	//document.getElementById('tipoper').selectedIndex='0';
	document.getElementById('tipoper').value='A';

	}
function asi1()
    { 

    $('#txtImageCaptcha').hide();
	$('#imgCaptchaReniec').hide();
	$('#imgCaptchaSunat').hide();
	 	
	var divdoc = document.getElementById('tipodocuR').innerHTML='';
	var divcbo = document.getElementById('cbopersonas').innerHTML='';
     
	 limpiarbucaclie();
	 mostrar_desc('clienbus');
	 limpiacli();
	 
	 }
function asi2()
    { 
	 listarcontrata();
	 mostrar_desc('clienedit');
	 } 
	 
function asi3()
    { 
	tipoacto();
	mostrar_desc('menuactos');
	ocultar_desc('menuactos2');
	 } 
	 
function listarbienesss(){
listadobien();
}

function asi4()
    { 
	tipoacto2kit();
	mostrar_desc('menuactos2');
	ocultar_desc('menuactos');
	 } 
	  	
function gbbiennes()
    { 
	  addgbbiens();
	  alert("Bien, grabado satisfactoriamente");
	  ocultar_desc('newbiennnes');
       listadobien();
	  }
	
function validarpago()
    {  //vertipoactopat();
       
	   mostrar_desc('vpago');  
       ocultar_desc('vbien');
	   //ocultar_desc('vuif');
	   ocultar_desc('vvehicular');      
    }
	
function clienteeditado()
    {  verclientee();
       mostrar_desc('editaclie')
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
		
		var _cumpclie   = document.getElementById('cumpclie');
	
		if(_apepat.value == '' || _prinom.value == '' || _dire.value == '' || _ecivil.selectedIndex=='0' || _ubigensc.value == '' || _sexo.selectedIndex == '0' || _nomprofesiones.value == '' || _cumpclie.value == '')
		
		{
					if(confirm('Falta ingresar datos de SUNAT/UIF, desea continuar..?'))
					   {  grabarcliente();  }
		}
		else
		{
					grabarcliente();
				    alert("Cliente grabado satisfactoriamente");
		}
		
  
    }


function ggclie2()
    {   
	   grabarcliente2();
	   ocultar_desc('conyugesss');
	   alert("Conyuge grabado satisfactoriamente");
    }
	
	
function ggclie7()
    {   
	   grabarcliente7();
	   ocultar_desc('conyugesss2');
	   alert("Conyuge grabado satisfactoriamente");
    }

function ggclie4()
    {   
	   grabarcliente4();
	   ocultar_desc('conyugesss');
	   alert("Conyuge grabado satisfactoriamente");
    }
function ggclie3()
    {   
	   grabarcliente3();
	   ocultar_desc('editaclie');
	   alert("Cliente Grabado satisfactoriamente");
	   buscaclientes();limpiconyuge();
    }
// #====================================================================================
//GRABA MEDIO PAGO	
function gmediopago()
    {   
	   actmediopago();
	   ocultar_desc('vermediopagoedit');
	   //mostrarlistmpp();   
    }	

function muesdiveditar(_obj)
    {   
	    document.getElementById('detmpx').value = _obj;
		vermediopagoe(_obj);
		mostrar_desc('vermediopagoedit');
    }

function calcularasigna(name,id,valor){
	
	document.frmprotocolares.xasignacontra.value=name;
	document.frmprotocolares.xasignacondi.value=id;
	document.frmprotocolares.xasignavalor.value=valor;
	
	}
	
function recal(name,id,value,title){
	
	document.getElementById('xasignaitem').value=name;
	document.getElementById('xasignacondi').value=id;
	document.getElementById('xasignavalor').value=value;
	document.getElementById('xasignaid').value=title;
	
	recalcularasignass();

	}	
	
function remonto(name,id,title,valor){
	
	document.getElementById('xasignaitem').value=title;
	document.getElementById('xasignacondi').value=name;
	document.getElementById('xasignavalor').value=valor;
	document.getElementById('xasignaid').value=id;
	
	remontouif();
	//alert('hola');
	}
function grabaopago(valor,title){
	
	document.getElementById('opagotitle').value=title;
	document.getElementById('opagovalor').value=valor;
	
	opagoouif();
	}
	
function fondos(title,valor){
	
	document.getElementById('fondotitle').value=title;
	document.getElementById('fondovalor').value=valor;
	
	fondouif();
	}
// #====================================================================================
// #====================================================================================
//PARA ACUALIZAR BIENES
function gbienesedit()
    {   
	   actbienes();
	   ocultar_desc('verbienesedit');
	   fDest_DivBienesedita(); 
	   //mostrarlistmpp();
	   
    }	

function muesbieneditable(_obj)
    {   
	    document.getElementById('detbienx').value = _obj;
		verbienese(_obj);  
		mostrar_desc('verbienesedit');
    }
	
// almacena numero de placa, etc. para editar
function selecpsm2(valor)
    {  document.getElementById('tpsm2').value = valor;
    }	
// para mostrar la edicion de num placa, etc.
function enviarvalores2(valor)
    {   
	if(valor=="8"){
	mostrar_desc('vterrestres2');
	ocultar_desc('mequipos2');
	ocultar_desc('oespecificos2');
	/*document.getElementById('tpsm2').value="";
	document.getElementById('npsm2').value="" ;
	document.getElementById('oespecific2').value="" ;
	document.getElementById('smaquiequipo2').value="";*/
	}
		
	if(valor=="5"){
	mostrar_desc('mequipos2');
	ocultar_desc('vterrestres2');
	ocultar_desc('oespecificos2');
	/*document.getElementById('tpsm2').value="";
	document.getElementById('npsm2').value="" ;
	document.getElementById('oespecific2').value="";
	document.getElementById('smaquiequipo2').value="" ;*/
	}
		
	if(valor=="10"){
	mostrar_desc('oespecificos2');
	ocultar_desc('vterrestres2');
	ocultar_desc('mequipos2');
	/*document.getElementById('tpsm2').value="";
	document.getElementById('npsm2').value="" ;
	document.getElementById('oespecific2').value="" ;
	document.getElementById('smaquiequipo2').value="" ;*/
	}
	
	if(valor!="5" && valor!="8" && valor!="10"){ 
	ocultar_desc('vterrestres2');
	ocultar_desc('mequipos2');
	ocultar_desc('oespecificos2');
	/*document.getElementById('tpsm2').value="" ;
	document.getElementById('npsm2').value="";
	document.getElementById('oespecific2').value="" ;
	document.getElementById('smaquiequipo2').value="" ;*/
	}
    }


// #### PARA EDIT PATRIMONIAL :
function enviarvalore3(valor)
    {   
		if(valor=="8"){
			mostrar_desc('vterrestres3');
			ocultar_desc('mequipos3');
			ocultar_desc('oespecificos3');
			/*document.getElementById('tpsm2').value="";
			document.getElementById('npsm2').value="" ;
			document.getElementById('oespecific2').value="" ;
			document.getElementById('smaquiequipo2').value="";*/
		}
		if(valor=="5"){
			mostrar_desc('mequipos3');
			ocultar_desc('vterrestres3');
			ocultar_desc('oespecificos3');
			/*document.getElementById('tpsm2').value="";
			document.getElementById('npsm2').value="" ;
			document.getElementById('oespecific2').value="";
			document.getElementById('smaquiequipo2').value="" ;*/
		}
		if(valor=="10"){
			mostrar_desc('oespecificos3');
			ocultar_desc('vterrestres3');
			ocultar_desc('mequipos3');
			/*document.getElementById('tpsm2').value="";
			document.getElementById('npsm2').value="" ;
			document.getElementById('oespecific2').value="" ;
			document.getElementById('smaquiequipo2').value="" ;*/
		}
		if(valor!="5" && valor!="8" && valor!="10"){ 
			ocultar_desc('vterrestres3');
			ocultar_desc('mequipos3');
			ocultar_desc('oespecificos3');
			/*document.getElementById('tpsm2').value="" ;
			document.getElementById('npsm2').value="";
			document.getElementById('oespecific2').value="" ;
			document.getElementById('smaquiequipo2').value="" ;*/
		}
    }
	
	
// #====================================================================================
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
// EDITAR  MEDIO DE PAGO
function vermediopagoe(_obj)
{
	    var data = { detmp : _obj }
		$("#vermediopagoedit").load("mostrar_mpagoedit.php",data,function(){
			
		})	
} 
//////  ACTUALIZA MEDIO DE PAGO
function actmediopago()
{

	var codkardex          = document.getElementById('codkardex').value;
	var mediopago2         = document.getElementById('mediopago2').value;
	var entidadfinanciera2 = document.getElementById('entidadfinanciera2').value;
	var impmediopago2      = document.getElementById('impmediopago2').value;
	var fechaoperacion2    = document.getElementById('fechaoperacion2').value;
	var documentos2        = document.getElementById('documentos2').value;
    var itemmpp            = document.getElementById('detmpx').value;
	var monedas2		   = document.getElementById('monedas2').value;
	
	ajax = objetoAjax();
	
	ajax.open("POST","grabar_editpago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			alert("Se actualizo medio de pago");
			//divResultado.innerHTML = ajax.responseText; 
			mostrarlistmpp();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&codkardex="+codkardex+"&mediopago="+mediopago2+"&entidadfinanciera="+entidadfinanciera2+"&impmediopago="+impmediopago2+"&fechaoperacion="+fechaoperacion2+"&documentos="+documentos2+"&detmp="+itemmpp+"&monedas2="+monedas2);
	
}
///// PARA VER DATOS BIENES EDITABLE:
function verbienese(_obj)
{
		var data = { detbien : _obj }
		$("#verbienesedit").load("mostrar_bienesedita.php",data,function(){

			$("#fechaconst2").mask("99/99/9999",{placeholder:"_"});
		});
} 
///// ACTUALIZAR BIENES.
function actbienes()
{ 
	var codkardex     = document.getElementById('codkardex').value;
	var detbienx      = document.getElementById('detbienx').value
	
	var tipob2        = document.getElementById('tipob2').value;
	var tipobien2     = document.getElementById('tipobien2').value;
	var ubigens2      = document.getElementById('ubigens2').value;
	var fechaconst2   = document.getElementById('fechaconst2').value;
	var codubis2      = document.getElementById('codubis2').value;
    var npsm2         = document.getElementById('npsm2').value;
	var tpsm2         = document.getElementById('tpsm2').value;
	var smaquiequipo2 = document.getElementById('smaquiequipo2').value;
	var oespecific2   = document.getElementById('oespecific2').value;
	
	var pregis5       = document.getElementById('pregis5').value;
	var idsederegGG    = document.getElementById('idsederegGG').value;
	
	//alert(itemmpp+codkardex+documentos2);
	ajax=objetoAjax();
	
	ajax.open("POST","editar_bien.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			alert("Se actualizo datos del bien");
			//divResultado.innerHTML = ajax.responseText; 
			 listadobien();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&codkardex="+codkardex+"&detbienx="+detbienx+"&tipob2="+tipob2+"&tipobien2="+tipobien2+"&ubigens2="+ubigens2+"&fechaconst2="+fechaconst2+"&codubis2="+codubis2+"&npsm2="+npsm2+"&tpsm2="+tpsm2+"&smaquiequipo2="+smaquiequipo2+"&oespecific2="+oespecific2+"&pregis5="+pregis5+"&idsederegGG="+idsederegGG)
	
}

function remontouif(){
	
	divResultado = document.getElementById('hjpt2');
	//tomamos el valor de la lista desplegable
	codkardex=document.getElementById('codkardex').value;
	xasignaitem=document.getElementById('xasignaitem').value;
	xasignacondi=document.getElementById('xasignacondi').value;
	xasignavalor=document.getElementById('xasignavalor').value;
	xasignaid=document.getElementById('xasignaid').value;

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","remontoss.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			//mostrarcontratante();
			//alert('remmelalaalla');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&xasignaid="+xasignaid+"&xasignacondi="+xasignacondi+"&xasignaitem="+xasignaitem+"&xasignavalor="+xasignavalor);
	
	}
//////////////////////////////aqui comienza lo que hay que pasar	
function opagoouif(){
	
	divResultado = document.getElementById('hjpt2');
	//tomamos el valor de la lista desplegable
	codkardex=document.getElementById('codkardex').value;
	valor=document.getElementById('opagovalor').value;
	title=document.getElementById('opagotitle').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","oprtunidadpago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			//mostrarcontratante();
			//alert('remmelalaalla');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&valor="+valor+"&title="+title);
	
	}

function fondouif(){
	
	divResultado = document.getElementById('hjpt2');
	//tomamos el valor de la lista desplegable
	codkardex=document.getElementById('codkardex').value;
	valor=document.getElementById('fondovalor').value;
	title=document.getElementById('fondotitle').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","fondopago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			divResultado.innerHTML = ajax.responseText;
			//mostrarcontratante();
			//alert('remmelalaalla');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+codkardex+"&valor="+valor+"&title="+title);
	
	}

///////////////////////////////aqui termina
function mostrarcombopersona(){
	divResultado = document.getElementById('cbopersonas');
    var id = '1';
	//tomamos el valor de la lista desplegable
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST", "cbopersona.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id="+id)
	
	}
////////////////////////////////////////////////////////////////
function buscaubigeoss2()
{ 	divResultado = document.getElementById('resulubis2');
	buscaubis2 = document.getElementById('buscaubis22').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeos2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubis="+buscaubis2)
}
////////////////////////////////////////////////////////////////


/////
// ############### MUESTRA LISTADO PATRIMONIAL ################
function listapagosall()
{

	divResultado = document.getElementById('listpatrimonio');

	var cod = document.getElementById('codkardex').value;
	ajax=objetoAjax();

	ajax.open("POST","list_patrimonio.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
				divResultado.innerHTML = ajax.responseText; 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&cod="+cod)	
}

function ggclie6()
    {   
	   grabarcliente6();
	   ocultar_desc('conyugesss2');
	   alert("Conyuge Cambiado satisfactoriamente");
    }
	
function casadito(valor)
{
   if(valor==2){
    mostrar_desc('casado');
   }else{
	   if(valor==5){
		mostrar_desc('casado');
	   }else{
		ocultar_desc('casado');
	   }
}

 

}	
function casadito2(valor)
{
   if(valor==2){
    mostrar_desc('casado2');
   }else{
		if(valor==5){
		mostrar_desc('casado2');
	   }else{
		ocultar_desc('casado2');
	   }
   }
   
}

function selecpsm(valor)
    {  document.frmprotocolares.tpsm.value=valor;
    }	



function actkardex()
    {  actualizarkardex();
	   mostrarcontratante();
	   var _numkardex = document.getElementById('codkardex').value;
	   if(_numkardex == '')
		{alert('No ha generado el Num. de Kardex.');}
	   else if(_numkardex != ''){FShowPagos_Kardex_result();}

       alert("Kardex Actualizado");
    }

function enviarvalores(valor)
    {   
	if(valor=="8"){
	mostrar_desc('vterrestres');
	mostrar_desc('linkactivaotrobienvn');
	ocultar_desc('linkactivaotrobienmn');
	ocultar_desc('linkactivaotrobienn');
	ocultar_desc('mequipos');
	ocultar_desc('oespecificos');
	ocultar_desc('predio1');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
		
	if(valor=="5"){
	mostrar_desc('mequipos');
	mostrar_desc('linkactivaotrobienmn');
	ocultar_desc('linkactivaotrobienvn');
	ocultar_desc('linkactivaotrobienn');
	ocultar_desc('vterrestres');
	ocultar_desc('oespecificos');
	ocultar_desc('predio1');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
		
	if(valor=="10"){
	mostrar_desc('oespecificos');
	ocultar_desc('linkactivaotrobienvn');
	ocultar_desc('linkactivaotrobienmn');
	mostrar_desc('linkactivaotrobienn');
	ocultar_desc('vterrestres');
	ocultar_desc('mequipos');
	ocultar_desc('predio1');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
	
	if(valor!="5" && valor!="8" && valor!="10"){ 
	ocultar_desc('vterrestres');
	ocultar_desc('linkactivaotrobienvn');
	ocultar_desc('linkactivaotrobienmn');
	ocultar_desc('linkactivaotrobienn');
	ocultar_desc('mequipos');
	ocultar_desc('oespecificos');
	ocultar_desc('predio1');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
	if(valor=="4"){ 
	ocultar_desc('vterrestres');
	ocultar_desc('linkactivaotrobienvn');
	ocultar_desc('linkactivaotrobienmn');
	ocultar_desc('linkactivaotrobienn');
	ocultar_desc('mequipos');
	ocultar_desc('oespecificos');
	mostrar_desc('predio1');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
    }

function enviarvalores2(valor)
    {   
	if(valor=="8"){
	mostrar_desc('vterrestres22');
	ocultar_desc('mequipos22');
	ocultar_desc('oespecificos22');
	ocultar_desc('predio22');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
		
	if(valor=="5"){
	mostrar_desc('mequipos22');
	ocultar_desc('vterrestres22');
	ocultar_desc('oespecificos22');
	ocultar_desc('predio22');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
		
	if(valor=="10"){
	mostrar_desc('oespecificos22');
	ocultar_desc('vterrestres22');
	ocultar_desc('mequipos22');
	ocultar_desc('predio22');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
	
	if(valor!="5" && valor!="8" && valor!="10"){ 
	ocultar_desc('vterrestres22');
	ocultar_desc('mequipos22');
	ocultar_desc('oespecificos22');
	ocultar_desc('predio22');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
	if(valor=="4"){ 
	ocultar_desc('vterrestres22');
	ocultar_desc('mequipos22');
	ocultar_desc('oespecificos22');
	mostrar_desc('predio22');
	//document.frmprotocolares.tpsm.value="";
	//document.frmprotocolares.npsm.value="";
	//document.frmprotocolares.oespecific.value="";
	//document.frmprotocolares.smaquiequipo.value="";
	}
    }


function limpiconyuge()
    { 
		document.frmprotocolares.cconyuge.value="";
		document.frmprotocolares.cconyuge2.value="";
		document.frmprotocolares.cconyuge3.value="";
		document.frmprotocolares.cconyuge4.value="";
		document.frmprotocolares.cconyuge7.value="";
		document.frmprotocolares.cconyuge6.value="";
    }

//// verificar que se escoja el acto.
function validaIngreso()
{
var _docu = document.getElementById('numdoc');	
var _tipdoc = document.getElementById('tipodoc');

if(_tipdoc.value=='1')
{ 
	_docu.setAttribute('maxlength','8');
	if(_docu.value.length < 8)
	{alert('Debe ingresar el acto');return false;}
	else {return true;}
}
if(_tipdoc.value=='8')
{
	if(_docu.value.length < 11)
	{alert('Debe ingresar el acto');return false;}
	else {return true;}
}

}

/////////////////////////////////////
	
function validarbien()
    { var _idacto = document.getElementById('evaluavehi').value; 
	  if(_idacto=='')
	  { mostrar_desc('vbien');
	    
	  }
	  else if(_idacto=='V')
	  { mostrar_desc('vvehicular');}
	   
       ocultar_desc('vpago');
       ocultar_desc('vuif');
    }
	
/// validar antes de grabar los datos del medio de pago	
function fgrabMediopago()
{
var _tipoactopatri = document.getElementById('tipoactopatri');	
var _imptrans = document.getElementById('imptrans');
var _nnminuta = document.getElementById('nnminuta');

	if(_tipoactopatri.value=='0')
	{
		alert('Debe ingresar el acto');return false;
	}
	else {
		return true;
		}

}

//  graba medio de pago.
/////////////////////////////////
function grabarmediopago()
    { 
	  if(fgrabMediopago()==true)
	  {
		  // APARECE BIEN LUEGO DE GRABAR :
			$("#sp_infobien").attr("style","");
		  
	   	  grabarmp();
		  vermedio();
		  ocultar_desc('gbrmp');
		  mostrar_desc('editmp');
		  
		 /* document.getElementById('idplacav').value='';
		  document.getElementById('numplacav').value='';
		  document.getElementById('clasev').value='';
		  document.getElementById('marcav').value='';
		  document.getElementById('anofabv').value='';
		  document.getElementById('modelov').value='';
		  document.getElementById('combustiblev').value='';
		  document.getElementById('carroceriav').value='';
		  document.getElementById('fecinscv').value='';
		  document.getElementById('colorv').value='';
		  document.getElementById('motorv').value='';
		  document.getElementById('numcilv').value='';
		  document.getElementById('numseriev').value='';
		  document.getElementById('numruedav').value='';
		  document.getElementById('preciov').value='0.00';*/
		  
		  
		  //mostrar_desc('editmp');
	      //ocultar_desc('gbrmp'); 
		  alert("Datos Grabados Satisfactoriamente");
		  
		  // OCULTA EL BOTON GRABAR : 
		  $("#sp_grabmpago").attr("style","display:none");
	  }	
    }

		
function grabaruifp()
    { grabaruifppp();
	  mostrar_desc('edituifp');
      ocultar_desc('gbruifp'); 
	  alert("Datos Grabados Satisfactoriamente");  
    }

function editarmediopago()
    { editarmp();
	  alert("Datos Actualizados Satisfactoriamente");  
    }
	
function editarruifp()
    { editaruifp();
	  alert("Datos Actualizados Satisfactoriamente");  
    }
	

function elimrrpp()
    { elimmrp();
	  alert("Registro Eliminado Satisfactoriamente");  
	  mostrarnewreg();
    }

function edimrrpp(argId)
{ 
  $('#action').val(2);	
  vermovimientorp(argId);
 
  //mostrar_desc('editmrrpp');
  
}


function newgbrmp()
    {  
	    gggppp();
		mostrar_desc('listmedpago');
		ocultar_desc('regmedpago');
	    //mostrarlistmpp();
	    alert("Medio de Pago Grabado Satisfactoriamentebbbbbbbbbbbbbbb");
    }
	

function validaruif()
    {   
	   mostrar_desc('vuif');
       ocultar_desc('vpago');
       ocultar_desc('vbien');
	   ocultar_desc('vvehicular');
    }

function vermedio()
    { 
    //if(valor=="SI")
	mostrar_desc('newpagoo');
	//else ocultar_desc('newpagoo');
	//if(valor=="NO")ocultar_desc('newpagoo');
	//else mostrar_desc('newpagoo');
    }

function vernewpatri()
    {  
	

			$("#sp_grabmpago").attr("style","");
		
		
		validarpago(); // no lo hace
		
		vertipoactopat();
		
		mostrar_desc('newpatrimonio');
	    ocultar_desc('listpatrimonio');
		ocultar_desc('listmedpago');
		ocultar_desc('newpagoo');
		ocultar_desc('vterrestres');
		ocultar_desc('mequipos');
		ocultar_desc('oespecificos');
		//oculta la edicion;
		ocultar_desc('editpatrimonio');
		ocultar_desc('editmp');
		 mostrar_desc('gbrmp');
		
		document.getElementById('ubigens').value = ''
		document.getElementById('fechaconst').value = ''
		document.getElementById('imptrans').value = ''
		document.getElementById('nnminuta').value = '<?php echo date("d/m/Y"); ?>';
		document.getElementById('tipcambio').value = ''
		document.getElementById('codubis').value = ''
		document.getElementById('pregis').value = ''
		//document.getElementById('ofpago').value = ''
		document.getElementById('impmediopago').value = ''
		document.getElementById('fechaoperacion').value = ''
		document.getElementById('documentos').value = ''
		document.getElementById('idttiippooacto').value = ''
		
		
    }

function mmmppp()
    {   mostrar_desc('regmedpago');
	    ocultar_desc('listmedpago'); 
		document.frmprotocolares.impmediopago.value   = "";
        document.frmprotocolares.fechaoperacion.value = "";
	    document.frmprotocolares.documentos.value     = "";

    }

function verlistpatri()
    {   listapagosall();
	    mostrar_desc('listpatrimonio');
	    ocultar_desc('newpatrimonio');
		ocultar_desc('editpatrimonio');
    }

function agregarbienes()
    {   mostrar_desc('newbiennnes');
		
		  // ***
		  document.getElementById('pregis').value     = "";
		  document.getElementById('tipob').value      = "";
		  document.getElementById('tipobien').value   = "";
		  document.getElementById('idsedereg2').value = "";
		  // ***
			
	      document.frmprotocolares.ubigens.value="";
          document.frmprotocolares.fechaconst.value="";
	      document.frmprotocolares.codubis.value="";
	      document.frmprotocolares.npsm.value="";
	      document.frmprotocolares.tpsm.value="";
		  document.frmprotocolares.smaquiequipo.value="";
	      document.frmprotocolares.oespecific.value="";
    }

function cambiar()
    {       
			tipoacto();
			
		    document.getElementById('referencia').value   = "";
			document.getElementById('codactos').value     = "";
			document.getElementById('contrato').value     = "";
			document.getElementById('dregistral').value   = "";
			document.getElementById('dnotarial').value    = "";
			document.getElementById('kardexconexo').value = "";
			document.getElementById('idnotario').value    = "";
			
		    var _idtacto = document.getElementById('idtipkar').value;
			
			
		// ESCRITURAS PUBLICAS
		if (_idtacto=='1')
		    {
			    document.getElementById('evaluavehi').value='';
				
				mostrar_desc('min4');
				mostrar_desc('escri4');
				mostrar_desc('fecesc');
				ocultar_desc('fecact');
				ocultar_desc('escri5');
				ocultar_desc('minsol');
				ocultar_desc('fecins');
				ocultar_desc('numins');
				
				document.getElementById("numminuta").style.visibility = "visible";
				
				// BOTONERÍA 
			    $("#uniform-button3").removeAttr("style","display:none");        // UIF PDT PATRIMONIAL
			    $("#uniform-button2").removeAttr("style","display:none");        // UIF PDT PARTICIPA
				$("#uniform-buttonminutas").removeAttr("style","display:none");  // MINUTA	
			    $("#uniform-buttoninsertos").removeAttr("style","display:none"); // INSERTOS
				$("#uniform-btngenerador").removeAttr("style","display:none");   // GENERAR DOCUMENTO
				
			 } // 1	
			
		
		// ASUNTOS NO CONTENCIOSOS
		else if(_idtacto=='2')
			{
				document.getElementById('evaluavehi').value='';
				
				mostrar_desc('minsol');
			    mostrar_desc('fecins');
			    mostrar_desc('numins');
			    ocultar_desc('min4');
			    ocultar_desc('escri4');
			    ocultar_desc('escri5');
			    ocultar_desc('fecact');
			    ocultar_desc('fecesc');
 
			    document.getElementById('button3').disabled = true;
			    document.getElementById('button2').disabled = true;
			    document.getElementById("numminuta").style.visibility = "visible";

			    // BOTONERÍA 
			    $("#uniform-button3").attr("style","display:none");              // UIF PDT PATRIMONIAL
			    $("#uniform-button2").attr("style","display:none");              // UIF PDT PARTICIPA
				$("#uniform-buttonminutas").attr("style","display:none");        // MINUTA	
			    $("#uniform-buttoninsertos").attr("style","display:none");       // INSERTOS
				$("#uniform-btngenerador").removeAttr("style","display:none");   // GENERAR DOCUMENTO
			
			} // 2 
		
			
		// TRANSFERENCIAS VEHICULARES	
		else if(_idtacto=='3')
			{
				document.getElementById('evaluavehi').value='V';
			
			    ocultar_desc('min4');
			    ocultar_desc('escri4');
			    ocultar_desc('fecesc');
			    ocultar_desc('minsol');
			    ocultar_desc('fecins');
			    ocultar_desc('numins');
			    mostrar_desc('escri5');
			    mostrar_desc('fecact');
				
				document.getElementById("numminuta").style.visibility = "hidden";
				
			    // BOTONERÍA 
			    $("#uniform-button3").removeAttr("style","display:none");        // UIF PDT PATRIMONIAL
			    $("#uniform-button2").removeAttr("style","display:none");        // UIF PDT PARTICIPA
				$("#uniform-buttonminutas").attr("style","display:none");  // MINUTA	
			    $("#uniform-buttoninsertos").attr("style","display:none"); // INSERTOS
				$("#uniform-btngenerador").removeAttr("style","display:none");   // GENERAR DOCUMENTO
			
			} // 3
		
		
		// GARANTIAS MOBILIRIAS	
		else if(_idtacto=='4')
			{
				document.getElementById('evaluavehi').value='';
			
			    ocultar_desc('min4');
			    ocultar_desc('escri4');
			    ocultar_desc('fecesc');
			    ocultar_desc('minsol');
			    ocultar_desc('fecins');
			    ocultar_desc('numins');
			    mostrar_desc('escri5');
			    mostrar_desc('fecact');
			    
				document.getElementById("numminuta").style.visibility = "hidden";
				
			    // BOTONERÍA 
			    $("#uniform-button3").removeAttr("style","display:none");        // UIF PDT PATRIMONIAL
			    $("#uniform-button2").removeAttr("style","display:none");        // UIF PDT PARTICIPA
				$("#uniform-buttonminutas").attr("style","display:none");  // MINUTA	
			    $("#uniform-buttoninsertos").attr("style","display:none"); // INSERTOS
				$("#uniform-btngenerador").removeAttr("style","display:none");   // GENERAR DOCUMENTO
			
			} // 4	
			
 
		// TESTAMENTOS	 
		else if(_idtacto=='5') 
		{  
		        document.getElementById('evaluavehi').value='';

			    mostrar_desc('min4');
			    mostrar_desc('escri4');
			    mostrar_desc('fecesc');
			    ocultar_desc('fecact');
			    ocultar_desc('escri5');
			    ocultar_desc('minsol');
			    ocultar_desc('fecins');
			    ocultar_desc('numins');
			
				document.getElementById("numminuta").style.visibility = "visible";
				
			    // BOTONERÍA 
			    $("#uniform-button3").attr("style","display:none");        // UIF PDT PATRIMONIAL
			    $("#uniform-button2").attr("style","display:none");        // UIF PDT PARTICIPA
				$("#uniform-buttonminutas").attr("style","display:none");  // MINUTA	
			    $("#uniform-buttoninsertos").attr("style","display:none"); // INSERTOS
				$("#uniform-btngenerador").attr("style","display:none");   // GENERAR DOCUMENTO
		} // 5	 		
		
		
     } //cambiar()


function limpiacli()
    {   document.frmprotocolares.numdoc.value="";
	    document.getElementById('buscanombemp').value="";
    }

function estadorrpp(valor)
{
    document.frmprotocolares.conestado.value = valor;

	if(valor=="I"){
	mostrar_desc('ntitulo');
	//ocultar_desc('mayor');
	document.frmprotocolares.mayorderecho.value = ""; 
	document.frmprotocolares.numero.value = "";    
	    }
	
	if(valor!="I"){
	ocultar_desc('ntitulo');
	//ocultar_desc('mayor');
	document.frmprotocolares.mayorderecho.value = ""; 
	document.frmprotocolares.numero.value = "";  
	  
    }

}

function estadorrpp2(valor)
{
    document.frmprotocolares.conestado2.value = valor;

	if(valor=="I"){
	mostrar_desc('ntitulo2');
	
	//document.frmprotocolares.mayorderecho2.value = ""; 
	document.frmprotocolares.numero2.value = "";    
	    }
	
	if(valor!="I"){
	ocultar_desc('ntitulo2');
	//document.frmprotocolares.mayorderecho2.value = ""; 
	document.frmprotocolares.numero2.value = "";  
	  
    }

}




function mostrarubigeoo(id,name)
    {
  document.frmprotocolares.ubigen.value = id;
  document.frmprotocolares.codubi.value = name;  
  ocultar_desc('buscaubiruc');     
        
    }
	
	
/**********************************/	
function mostrarubigeoos(id,name)
    {
	  document.frmprotocolares.ubigens.value = id;
	  document.frmprotocolares.codubis.value = name; 
	
	  document.frmprotocolares.buscaubis.value = ''; 
	  refreshubigeo(); 
	  ocultar_desc('div_buscaubis');       
    }
/**********************************/	
function focusprofe(){
	document.getElementById('buscaprofes').focus();
	}
	
function focuscargo(){
	document.getElementById('buscacargooss').focus();
	}
	
	
	
	
/**********************************/		
function mostrarubigeoos2(id,name)
    {
  document.getElementById('ubigens2').value = id; 
  document.getElementById('codubis2').value = name; 
      
  ocultar_desc('buscaubis2');       
    }	
	
function mostrarubigeoosc(id,name)
    {
  document.frmprotocolares.ubigensc.value = id;
  document.frmprotocolares.codubisc.value = name;  
  ocultar_desc('buscaubiscclie');        
    }
function ubifocus(){
  document.getElementById('buscaubisc').focus();
	}
function ubifocusedit(){
  document.getElementById('buscaubisc3').focus();
	}
function ubifocus2(){
  document.getElementById('buscaubi').focus();
	}	
function ubifocusruc(){
  document.getElementById('buscaubi').focus();
	}
function mostrarubigeoosc2(id,name)
    {
  document.frmprotocolares.ubigensc2.value = id;
  document.frmprotocolares.codubisc2.value = name;  
  ocultar_desc('buscaubisc222');        
    }

function mostrarubigeoosc3(id,name)
    {
  document.frmprotocolares.ubigensc3.value = id;
  document.frmprotocolares.codubisc3.value = name;  
  ocultar_desc('buscaubisc3e');        
    }
	
function mostrarubigeoosc4(id,name)
    {
  document.frmprotocolares.ubigensc4.value = id;
  document.frmprotocolares.codubisc4.value = name;  
  ocultar_desc('buscaubisc44');        
    }	

function mostrarubigeoosc6(id,name)
    {
  document.frmprotocolares.ubigensc6.value = id;
  document.frmprotocolares.codubisc6.value = name;  
  ocultar_desc('buscaubisc6');        
    }
function mostrarubigeoosc7(id,name)
    {
  document.frmprotocolares.ubigensc7.value = id;
  document.frmprotocolares.codubisc7.value = name;  
  ocultar_desc('buscaubisc7s');        
    }

function mostrarprofesioness(id,name)
    {
  document.frmprotocolares.idprofesion.value = id;
  document.frmprotocolares.nomprofesiones.value = name;  
  ocultar_desc('buscaprofe');        
    }
	
function mostrarcargoos(id,name)
    {
  document.frmprotocolares.idcargoo.value = id;
  document.frmprotocolares.nomcargoss.value = name;  
  ocultar_desc('buscacargooo');        
    }	
	
///////////////
function mostrarprofesioness2(id,name)
    {
  document.frmprotocolares.idprofesion2.value = id;
  document.frmprotocolares.nomprofesiones2.value = name;  
  ocultar_desc('buscaprofe2');        
    }
	
function mostrarcargoos2(id,name)
    {
  document.frmprotocolares.idcargoo2.value = id;
  document.frmprotocolares.nomcargoss2.value = name;  
  ocultar_desc('buscacargooo2');        
    }		
/////////////////////////////////////
function mostrarprofesioness3(id,name)
    {
  document.frmprotocolares.idprofesion3.value = id;
  document.frmprotocolares.nomprofesiones3.value = name;  
  ocultar_desc('buscaprofe3');        
    }
	
function mostrarcargoos3(id,name)
    {
  document.frmprotocolares.idcargoo3.value = id;
  document.frmprotocolares.nomcargoss3.value = name;  
  ocultar_desc('buscacargooo3');        
    }		
/////////////////////////////////////////
function mostrarprofesioness4(id,name)
    {
  document.frmprotocolares.idprofesion4.value = id;
  document.frmprotocolares.nomprofesiones4.value = name;  
  ocultar_desc('buscaprofe4');        
    }
	
function mostrarcargoos4(id,name)
    {
  document.frmprotocolares.idcargoo4.value = id;
  document.frmprotocolares.nomcargoss4.value = name;  
  ocultar_desc('buscacargooo4');        
    }	
//////////////////////////////
function mostrarprofesioness6(id,name)
    {
  document.frmprotocolares.idprofesion6.value = id;
  document.frmprotocolares.nomprofesiones6.value = name;  
  ocultar_desc('buscaprofe6');        
    }
	
function mostrarcargoos6(id,name)
    {
  document.frmprotocolares.idcargoo6.value = id;
  document.frmprotocolares.nomcargoss6.value = name;  
  ocultar_desc('buscacargooo6');        
    }		
//////////////////////////////
function mostrarprofesioness7(id,name)
    {
  document.frmprotocolares.idprofesion7.value = id;
  document.frmprotocolares.nomprofesiones7.value = name;  
  ocultar_desc('buscaprofe7');        
    }
	
function mostrarcargoos7(id,name)
    {
  document.frmprotocolares.idcargoo7.value = id;
  document.frmprotocolares.nomcargoss7.value = name;  
  ocultar_desc('buscacargooo7');        
    }		
	
function grabarfirmacontra()
{
grabarfirma();
ocultar_desc('firmasss');
document.frmprotocolares.fecfirmaa.value = "";
document.frmprotocolares.firmitaa.value = "";
}

function valida()
    {
		var tipoacto=frmprotocolares.codactos.value;
		var karconexo=frmprotocolares.kardexconexo.value;
		
        if(frmprotocolares.codactos.value==""){
        alert("Los campos de codigo de actos, contratos o tipos de kardex estan vacios o no han sido seleccionados, por favor ingresar datos");
        frmprotocolares.contrato.focus();
        return;
        }else{
		
					
					
						generakardex();
						mostrar_desc('tabsss');
						ocultar_desc('menuactos');
			
						
			
		}	
        
    }


function limpiarrpp()
    {  

    $('#itemcodmovreg').val('');
	//$('#fechamov').val(data.fechamov);
	//$('#vencimiento').val(data.vencimiento);
	$('#titulorp').val('');
	//$('#idtiptraoges').val(data.idtiptraoges);

	//$('#idsedereg').val(data.idsedereg);

	$('#numeroPartida').val('');

	//$('#idsecreg').val(data.idsecreg);

	$('#asiento').val('');
	//$('#idestreg').val(data.idestreg);
	$('#importee').val('');

	$('#recibo').val('');
//	$('#fechaInscripcion').val(data.fechaInscripcion);
	$('#observa').val('');
	$('#anotacion').val('');
	$('#registrador').val('');
	//document.frmprotocolares.titulorp.value = "";
	//document.frmprotocolares.importee.value ="";
	//document.frmprotocolares.anotacion.value = "";
	//document.frmprotocolares.numeroo.value = "";
	//document.frmprotocolares.mayorderecho.value = "";
	//document.frmprotocolares.observa.value = "";

	$('#idtiptraoges').val(0);
	$('#uniform-idtiptraoges span').text($("#idtiptraoges option:selected").html());
	$('#idsedereg').val(0);
	$('#uniform-idsedereg span').text($("#idsedereg option:selected").html());
	$('#idsecreg').val(0);
	$('#uniform-idsecreg span').text($("#idsecreg option:selected").html());
	$('#idestreg').val(0);
	$('#uniform-idestreg span').text($("#idestreg option:selected").html());
    }

function validar2()
    {  
      condiciones();
	   mostrar_desc('menucondicion');
	   ocultar_desc('menucondicionk')
    }
	
function validarquit()
    {  
      condicionesk();
	   mostrar_desc('menucondicionk');
	   ocultar_desc('menucondicion')
    }
	
function validar2k()
    {  
       condicionesk();
	   mostrar_desc('menucondicionk');
    }

function grabareditarcontratante()
    {  
      grabareditarcontraaaa();
	  alert("Datos del Contratante Actualizados");
	  ocultar_desc('mantecontra');
	  mostrarcontratante();
    }

function mostraridcontratante(valor){
	document.frmprotocolares.firmitaa.value = valor;
	$("#fecfirmaa").val("");
	mostrar_desc('firmasss');
}

	function valorreg(valor){
		document.frmprotocolares.pre2.value = valor;
		document.frmprotocolares.presu.value = valor;
		//document.frmprotocolares.saldo2.value = valor;
		fCalculos2();
	}

	function valornot(valor){
		document.frmprotocolares.pre1.value = valor;
		//document.frmprotocolares.saldo1.value = valor;
		fCalculos2();
	}
	
function validarformular(valor)
    {  
     mostrar_desc('preguntas');
	  var contra= valor.toString();
	  var longitud= contra.length;
	  
	  switch (longitud) { 
		case 1: 
			 var idcontra = "000000000"+contra;
			 break 
		case 2: 
			 var idcontra = "00000000"+contra;
			 break 
		case 3: 
			 var idcontra = "0000000"+contra;
			 break 
		case 4: 
			 var idcontra = "000000"+contra;
			 break 
	    case 5: 
			 var idcontra = "00000"+contra;
			 break 
			 
	   case 6: 
			 var idcontra = "0000"+contra;
			 break 
	   case 7: 
			 var idcontra = "000"+contra;
			 break  
	   
	   case 8: 
			 var idcontra = "00"+contra;
			 break 
		case 9: 
			 var idcontra = "0"+contra;
			 break
			 
	   case 10: 
		 var idcontra = contra;
		 break
}
	  
	 document.getElementById('idcontratantee').value = idcontra;
	 
	 mostrar_datos_renta();
	 
    }
	
function validar4()
	 {  
	    mostrar_desc('uifpdtparticip');
		//mostraruifpdtparticipante()
    }	
	
function mostrar(isChecked, myValue)
{	
	total = document.frmprotocolares.contrato.value;
	separador=" / ";
	quitar=myValue + separador;
	nuevoStr="";
	if (isChecked) document.frmprotocolares.contrato.value = total + myValue + separador;

	else document.frmprotocolares.contrato.value = total.replace(quitar,nuevoStr);
}

function mostrarfirma(isChecked, myValue)
{ 
    total = document.frmprotocolares.firma.value;
	remplazo="0";
	if (isChecked) document.frmprotocolares.firma.value = total.replace(total,"") + myValue;

	else document.frmprotocolares.firma.value = total.replace(total,remplazo);
}

function mostrarfirma2(isChecked, myValue)
{ 
    totalw = document.frmprotocolares.firmaa.value;
	remplazo="0";
	if (isChecked) document.frmprotocolares.firmaa.value = totalw.replace(totalw,"") + myValue;

	else document.frmprotocolares.firmaa.value = totalw.replace(totalw,remplazo);
}

function mostrarfirma3(isChecked, myValue)
{ 
    totalw = document.frmprotocolares.firmaa.value;
	remplazo="1";
	if (isChecked) document.frmprotocolares.firmaa.value = totalw.replace(totalw,"") + remplazo;

	else document.frmprotocolares.firmaa.value = totalw.replace(totalw,myValue);
}



function mostrarindice(isChecked, myValue)
{ 
    total = document.frmprotocolares.indice.value;
	remplazo="0";
	if (isChecked) document.frmprotocolares.indice.value = total.replace(total,"") + myValue;

	else document.frmprotocolares.indice.value = total.replace(total,remplazo);
}

function mostrarindice2(isChecked, myValue)
{ 
    total = document.frmprotocolares.indice2.value;
	remplazo="0";
	if (isChecked) document.frmprotocolares.indice2.value = total.replace(total,"") + myValue;

	else document.frmprotocolares.indice2.value = total.replace(total,remplazo);
}

function mostrarindice3(isChecked, myValue)
{ 
    total = document.frmprotocolares.indice2.value;
	remplazo="1";
	if (isChecked) document.frmprotocolares.indice2.value = total.replace(total,"") + remplazo;

	else document.frmprotocolares.indice2.value = total.replace(total,myValue);
}

function seleccioncontratanteeli(valor){
document.frmprotocolares.idcontra.value=valor;
}

function mostedi(){
mostrar_desc('mantecontra');
editcontra();


}


function mosteli(){
	if(confirm('Desea eliminar el contratante..?'))
		{ 
			  mosteliminarc();
 alert("Contratante Eliminado");
		}	


 mostrarcontratante();
 ocultar_desc('clienedit');

}

function seleccionarcontra(valor) {

document.frmprotocolares.representaa.value=valor;
ocultar_desc('representante');
}

function seleccionarcontrac(valor) {

document.frmprotocolares.representaa2.value=valor;
ocultar_desc('representantee');
}

function buttons(valor) {
document.frmprotocolares.repre.value=valor;
ocultar_desc('representante');
document.frmprotocolares.representaa.value="";
document.frmprotocolares.facultades.value="";
}

function buttons23(valor) {
document.frmprotocolares.repre.value=valor;
mostrar_desc('representante');
mostrarcontrata();

}

function buttonsc(valor) {
document.frmprotocolares.repre2.value=valor;
ocultar_desc('representantee');
document.frmprotocolares.representaa2.value="";
document.frmprotocolares.facultadess.value="";

}
function buttons23c(valor) {
document.frmprotocolares.repre2.value=valor;
mostrar_desc('representantee');
mostrarcontratac();

}

function newmove() {
	$('#action').val(1);
	mostrar_desc('newmrrpp');
	$('#titleMovimiento').text('Ingreso  de Movimientos RR. PP');
}
function cierrarepre(){
	
	ocultar_desc('representantee');
	}

function seleccionmov(valor, name) {
document.frmprotocolares.codmovreg.value=valor;
document.frmprotocolares.itemcodmovreg.value=name;
}


////////////////////////////////////////////////////////


////////////////////////////////////////////////

function validanewmovreg() 
{

   action = $('#action').val();
	if(action == 1){
		 grabarnewmov();
	}else{
		editarmovreg();
	}
   ocultar_desc('newmrrpp');

}

function validaeditmovreg()
{
 editarmovreg();
 ocultar_desc('editmrrpp');

}

function btngrabaremp(){
	
// empresa
	//var _razonsocial = document.getElementById('razonsocial');
//	var _domfiscal = document.getElementById('domfiscal');
//	var _ubigen = document.getElementById('ubigen');
//	var _ciiu   = document.getElementById('actmunicipal');
	
//	if( _razonsocial.value == '' || _domfiscal.value == '' || _ubigen.value == '' || _ciiu.value == '')
	//{alert('Faltan ingresar datos');return;}
//	else{
	   grabarempresa();
	   alert("Empresa grabada satisfactoriamente");
	//	}
}


function cerrardiv(){
	ocultar_desc('representantee')
	}

function calcularrrpp() {
mostrar_desc('formurent');
}

function validarformul() {
valor=document.getElementById('idrenta').value;
document.getElementById('idrentas').value=valor;
mostrar_desc('formurent');
ocultar_desc('preguntas');
listaformu();
}

function grabar_renta() {
grabarrenta();
ocultar_desc('gbr');
mostrar_desc('gbr2');
}

function grabarformulario() {
var numfor = document.frmprotocolares.numformu.value;
	var montofor= document.frmprotocolares.monto.value;
	if(numfor=="" || montofor=="" ){
		
		alert("Falta ingresar Numero de formulario y/o monto");
		}else{
			saveformulario();
          document.frmprotocolares.numformu.value="";
          document.frmprotocolares.monto.value="";
			
			}
}

function formulita(valor) {
document.frmprotocolares.pregu1.value=valor;
//calcularfrm();
}

function formulita1(valor) {
document.frmprotocolares.pregu2.value=valor;
//calcularfrm();
}

function formulita2(valor) {
document.frmprotocolares.pregu3.value=valor;
//calcularfrm();
}

function mostrar2(isChecked, name)
{
	total2 = document.frmprotocolares.codactos.value;
    quitar2 = name;
	if (isChecked) 
		document.frmprotocolares.codactos.value = total2 + name;

	else
	 document.frmprotocolares.codactos.value = total2.replace(quitar2,"");

	vcodeActs = document.frmprotocolares.codactos.value;

	

	$('#idTemplate .item-template').remove();
	
	//$('#uniform-idTemplate span').remove();

	$.ajax({
		url:'mantenimiento/consultas/TplTemplate.php',
		data:{codeActs:vcodeActs,action:5},
		type:'POST',
		dataType:'json',
		success:function(response){
			html = '';
			data = response.data;
			if(data.length != 0){
				for(i in data){
					if(vcodeActs==data[i].codeActs){

					html = html + '<option class="item-template" value="'+data[i].pkTemplate+'">'+data[i].nameTemplate+'</option>';
					}
				}
				$('#idTemplate').append(html);
			}else{
				$('#idTemplate').val(data.idtiptraoges);
 				$('#uniform-idTemplate span').text($("#idTemplate option:selected").html());
			}

		}
	});
}
function mostrar3(isChecked, name, id)
{
	total3 = document.frmprotocolares.codcon.value;
	quitar3=name +"."+ id + "/";
	if (isChecked){ 
	document.frmprotocolares.codcon.value = total3 + name +"."+ id + "/";
	verificarinscrito();
	}
	else {document.frmprotocolares.codcon.value = total3.replace(quitar3,"");}
}

function mostrarinscri(valor){
	
	document.getElementById('valorinscrito').value=valor;
}
function mostrarinscri2(valor){
	
	document.getElementById('valorinscrito').value=valor;
}
	
function mostrarcon(isChecked, name, id)
{
	total4 = document.frmprotocolares.codconn.value;
	quitar4=name +"."+ id + "/";
	if (isChecked) document.frmprotocolares.codconn.value = total4 + name +"."+ id + "/";

	else document.frmprotocolares.codconn.value = total4.replace(quitar4,"");
}



function CompareDates(valor1,valor2,valor3)
{
    var str1 = valor1;
    var str2 = valor2;
	var str3 = valor3;
    var dt1  = parseInt(str1.substring(0,2),10);
    var mon1 = parseInt(str1.substring(3,5),10)-parseInt(1);
    var yr1  = parseInt(str1.substring(6,10),10);
    var dt2  = parseInt(str2.substring(0,2),10);
    var mon2 = parseInt(str2.substring(3,5),10)-parseInt(1);
    var yr2  = parseInt(str2.substring(6,10),10);
	 var dt3  = parseInt(str3.substring(0,2),10);
    var mon3 = parseInt(str3.substring(3,5),10)-parseInt(1);
    var yr3  = parseInt(str3.substring(6,10),10);
    var date1 = new Date(yr1, mon1, dt1);
    var date2 = new Date(yr2, mon2, dt2);
	var date3 = new Date(yr3, mon3, dt3);
	
	if (valor3!=""){
		if (date3<date1){
		alert("La fecha de Escrituracion no puede ser menor que la fecha de creacion del kardex");
		}else{
		  if(date2 < date3)
			{
				alert("La fecha no puede ser menor que la fecha de creacion del Kardex o Escrituracion");
				}
			else
			{
				grabarfirmacontra();
				
			}
		}
     }else{
	  
	   alert("Ingrese primero la fecha de Escrituracion");
	 }
}

function CompareDatesescritu(valor1,valor2)
{
	//a = document.getElementById('fechaescritura').value;
	//b = document.getElementById('fechaingreso').value;
	//valor2 = document.getElementById('fechaingreso');
    //alert('dsd');
	var str1 = valor1; 
    var str2 = valor2;
	var dt1  = parseInt(str1.substring(0,2),10);
    var mon1 = parseInt(str1.substring(3,5),10);
    var yr1  = parseInt(str1.substring(6,10),10);
    var dt2  = parseInt(str2.substring(0,2),10);
    var mon2 = parseInt(str2.substring(3,5),10);
    var yr2  = parseInt(str2.substring(6,10),10);
	
    var date1 = new Date(yr1, mon1, dt1);
    var date2 = new Date(yr2, mon2, dt2);

	if (valor2!=""){
		if (date2<date1){
		alert("La fecha de Escrituracion no puede ser menor que la fecha de creacion del kardex");
		document.frmprotocolares.fechaescritura.value="";
		return false;
		} else{
			return true;
			
			}
     }
}


function callumbral(valor)
{
	document.getElementById('idttiippooacto').value=valor;
	document.getElementById('tipactox').value = valor;
	mostrarumbral();
}
-->
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
function cambiatipdoc()
{ 

	divResultado = document.getElementById('tipodocuR');
	//_id=document.frmprotocolares.tipodoc.value;
	
	var _id = document.getElementById('tipoper').value;
	
	ajax=objetoAjax();

	ajax.open("POST","combodocu.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
			document.getElementById('tipodoc').selectedIndex='1';
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id="+_id)
	
}
function cambiatipdoc2()
{ 

	divResultado = document.getElementById('tipodocuR');
	//_id=document.frmprotocolares.tipodoc.value;
	
	var _id = document.getElementById('tipoper').value;
	
	ajax=objetoAjax();

	ajax.open("POST","combodocu2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
			document.getElementById('tipodoc').selectedIndex='1';
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("id="+_id)
	
}

function selectdocu(_eval)
{
//	var _eval = document.getElementById('tipoper').value;

	document.getElementById('busclie').innerHTML = '';

	$('#imgCaptchaSunat').hide();
	$('#imgCaptchaReniec').hide();
	$('#txtImageCaptcha').hide();

	$('#txtImageCaptcha').val('');
	$('#numdoc').val('');
	$('#numdoc').focus();

	
	if(_eval=='J')
	{ 
		//$('#imgCaptchaSunat').attr('src','reniec_sunat/generate_captcha_sunat.php');
		cambiatipdoc();
		document.getElementById('numdoc').maxLength=11;
	}
	else if(_eval=='N')
	{
		//$('#imgCaptchaReniec').attr('src','reniec_sunat/generate_captcha_reniec.php');
		cambiatipdoc2();
		document.getElementById('numdoc').maxLength=8;
	 
	
	}
	
}

// #= valida ingreso de DNI y RUC
function validaDNIRUC()
{
var _docu = document.getElementById('numdoc');	
var _tipdoc = document.getElementById('tipodoc');

if(_tipdoc.value=='1')
{ 
	_docu.setAttribute('maxlength','8');
	if(_docu.value.length < 8)
	{alert('El D.N.I. debe tener 8 dígitos');return false;}
	else {return true;}
}
if(_tipdoc.value=='8')
{
	if(_docu.value.length < 11)
	{alert('El R.U.C. debe tener 11 dígitos');return false;}
	else {return true;}
}
if(_tipdoc.value!='8' && _tipdoc.value!='1')
{
	return true;
}

}
// #= fin valida 
function evalDocumento()
{
	if(validaDNIRUC()==true){
	buscaclientes();//limpiconyuge();
	//
	
	}	
}

/* RENIEC - SUNAT  */
/*
$('#numdoc').live('keyup',function(e){

	v = this.value;
	tipdoc = $('#tipodoc').val();
	tipper = $('#tipoper').val();

	if(v.length == 8  && (tipdoc == 1 && tipper == 'N' )){

		evalDocumento();
	}

	if(v.length == 11 && (tipdoc == 8 && tipper == 'J')){
		evalDocumento();
	}
});

$('#txtImageCaptcha').live('keyup',function(e){

	v = this.value;
	tipdoc = $('#tipodoc').val();
	tipper = $('#tipoper').val();
	vdoc = $('#numdoc').val();
	if(v.length == 4  && (tipdoc == 1 && tipper == 'N' ) && vdoc.length === 8 ){
		evalDocumento();
	}

	if(v.length == 4 && (tipdoc == 8 && tipper == 'J') && vdoc.length === 11){
		evalDocumento();
	}
});
*/
/*

$('#btnRefreshCaptchaReniec').live('click',function(){
	alert('hola');
	$('#txtImageCaptcha').val('');	
	$('#imgCaptchaReniec').attr('src','reniec_sunat/generate_captcha_reniec.php');

});*/

/** FIN RENIEC SUNAT **/



//############################
function evallenght()
{
 
 $('#txtImageCaptcha').hide();
 $('#imgCaptchaSunat').hide();
 $('#imgCaptchaReniec').hide();
 document.getElementById('busclie').innerHTML = '';

 

var _docu = document.getElementById('numdoc');	
var _tipdoc = document.getElementById('tipodoc');

if(_tipdoc.value=='1')
{ 
	_docu.setAttribute('maxlength','8');

}
if(_tipdoc.value!='1')
{
  _docu.setAttribute('maxlength','11');
}
if(_tipdoc.value=='2')
{
  _docu.setAttribute('maxlength','10');
}

}
// #############################

function aumenta2() 
	  {
  		var num = 30;//document.getElementById('txtplazo').value; 
  		var f = document.getElementById('fechamov').value; 
		
  		f = f.split('/'); 
  		f = f[1]+'/'+f[0]+'/'+f[2];  
 		hoy = new Date(f); 
 	    hoy.setTime(hoy.getTime()+num*24*60*60*1000); 
  		mes = hoy.getMonth()+1; 
  		if(mes<9) { mes='0'+mes; }
  		fecha = hoy.getDate()+'/'+mes+'/'+hoy.getFullYear(); 
				document.getElementById('vencimiento').value = fecha;
				//document.getElementById('Grabar').focus();
	  }

// Para limpiar datos de divs
//vpago:
function refreshvpago()
{
	validarpago();
	vertipoactopat();
	document.getElementById('nnminuta').value  = '<?php echo date("d/m/Y"); ?>';
	document.getElementById('imptrans').value  = '';
	document.getElementById('tipcambio').value = '';
	//document.getElementById('newpagoo').style.display="none";			
}

//vpago:
function refreshnewbiennnes()
{
	//validarpago();
	document.getElementById('ubigens').value='';
	document.getElementById('codubis').value='';
	document.getElementById('fechaconst').value='';
	//document.getElementById('newpagoo').style.display="none";			
}

function editpatr(_itemmp,_idtipacto)
{ 
	document.getElementById('tipactox').value = _idtipacto;
	document.getElementById('itemmpx').value = _itemmp;

	
	mostrar_desc('editpatrimonio');
	//muestra la lista de bienes
	ocultar_desc('newbiennnes');
	listarbienesss2();
	ocultar_desc('newpatrimonio');
	ocultar_desc('newpatrimonio');
	mostrar_desc('vvehicular');
	muesEditPatr();
	
		ocultar_desc('listpatrimonio');
		ocultar_desc('listmedpago');
		ocultar_desc('newpagoo');
		ocultar_desc('vterrestres');
		ocultar_desc('mequipos');
		ocultar_desc('oespecificos');
		
	// Muestra el lista de los medios de pago.
	    //mostrarlistmpp2();
}

function elimpatr(_itemmp,_idtipacto)
{
	var __idtipacto = _idtipacto;
	var __kardex    = document.getElementById('codkardex').value;
	var __itemmp    = _itemmp;
	
	elimpatrimonio(__idtipacto, __kardex, __itemmp);
	 
}

function muesEditPatr()
{
	divResultado = document.getElementById('editpatrimonio');
	divResultado.innerHTML= '<img src="loading.gif">';

	var _itemmp = document.getElementById('itemmpx').value;
	var _idtacto = document.getElementById('tipactox').value;
	var _kardex = document.getElementById('codkardex').value;
	
	var codkardex = document.getElementById('codkardex').value;

	ajax=objetoAjax();
	
	ajax.open("POST","edit_patrimonial.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
			$("#listmedpago2").load("listarmpp2.php", {codkardex : codkardex, _idtacto : _idtacto}, function() {
					 mostrar_desc('newpagoo2');
					 mostrar_desc('listmedpago2');
				})  
			  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("itemmp="+_itemmp+"&idtacto="+_idtacto+"&kardex="+_kardex)

}
// ver nuevo bien
function validarbien2()
    {  
	  var _idacto = document.getElementById('evaluavehi').value; 
	  if(_idacto=='')
	  { mostrar_desc('vbien2');
	  	listarbienesss2();
	  }
	  else if(_idacto=='V')
	  { mostrar_desc('vvehicular2');}
	    listarVehiculos2();
	   //mostrar_desc('vbien2');
       ocultar_desc('vpago2');
       //ocultar_desc('vuif2');	   
    }
//ver div medio de pago
function validarpago2()
    {  //vertipoactopat();
       mostrar_desc('vpago2');
       ocultar_desc('vbien2');
	   //ocultar_desc('vuif2');
	   ocultar_desc('vvehicular2');
	   
	   // muestra los detalles del medo de pago
	   mostrarlistmpp2();
	   
	   mostrar_desc('newpagoo2');
	   mostrar_desc('listmedpago2');
	   
	   //////
    }

function validaruif2()
    {   
	   mostrar_desc('vuif2');
       ocultar_desc('vpago2');
       ocultar_desc('vbien2');
	   ocultar_desc('vvehicular2');
    }
	
function mostraruifpdtasigna(){
	
	mostraruifpdtparticipante();
	
	}	
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
function cerrarr(){
	ocultar_desc('representantee');
	}
	
function editcontratante2(){
	
	verclientee2();
	mostrar_desc('editcontrata2');
	//alert('recontramosn');
	}	

function casadito3(valor)
{
   if(valor==2){
    mostrar_desc('casado3');
   }else{
    ocultar_desc('casado3');
   }
}

function mostrarcargooscnt(id,name)
    {
  document.frmprotocolares.idcargoocnt.value = id;
  document.frmprotocolares.nomcargosscnt.value = name;  
  ocultar_desc('buscacargooocnt');        
    }	
	
function mostrarprofesionesscnt(id,name)
    {
  document.frmprotocolares.idprofesioncnt.value = id;
  document.frmprotocolares.nomprofesionescnt.value = name;  
  ocultar_desc('buscaprofecntn');        
    }

function mostrarubigeoosccnt(id,name)
    {
  document.frmprotocolares.ubigensccnt.value = id;
  document.frmprotocolares.codubisccnt.value = name;  
  ocultar_desc('buscaubisccntt');        
    }

function hhhcnt()
    { 
	  mostrar_desc('conyugessscnt');
	 }	
	 
function ggcliecnt()
    {   
	   grabarclientecnt();
	   alert("grabado satisfactoriamente");
	   listarcontrata();
	   ocultar_desc('editcontrata2');
	   ocultar_desc('mantecontra');
	   
	  //alert("Contratante modificado satisfactoriamente");
	   //editcontra();
    }
	
function ggclie6mm()
    {   
	   grabarcliente6mm();
	   ocultar_desc('conyugessscnt');
	   alert("Conyuge Cambiado satisfactoriamente");
}	

function grabarclientecnt()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tredfdfdf');
	//tomamos el valor de la lista desplegable
	
	tipdocu	= document.getElementById('tipdocu').value;
	numdoccnt=document.getElementById('numdoced3').value;
	apepatcnt=document.getElementById('apepat3').value;
	apematcnt=document.getElementById('apemat3').value;
	prinomcnt=document.getElementById('prinom3').value;
	segnomcnt=document.getElementById('segnom3').value;
	direccioncnt=document.getElementById('direccion3').value;
	emailcnt=document.getElementById('email3').value;
	telfijocnt=document.getElementById('telfijo3').value;
	telcelcnt=document.getElementById('telcel3').value;
	teloficnt=document.getElementById('telofi3').value;
	sexocnt=document.getElementById('sexo3').value;
	idestcivilcnt=document.getElementById('idestcivil3').value;
	nacionalidadcnt=document.getElementById('nacionalidad3').value;
	idprofesioncnt=document.getElementById('idprofesion3').value;
	idcargoocnt=document.getElementById('idcargoo3').value;
	cumpcliecnt=document.getElementById('cumpclie3').value;
	natpercnt=document.getElementById('natper3').value;
	codubisccnt=document.getElementById('codubisc3').value;
	nomprofesionescnt=document.getElementById('nomprofesiones3').value;
	nomcargosscnt=document.getElementById('nomcargoss3').value;
	ubigensccnt=document.getElementById('ubigensc3').value;
	residentecnt=document.getElementById('residente3').value;
	docpaisemicnt=document.getElementById('docpaisemi3').value;
	codcliecnt=document.getElementById('codclie3').value;	
	cconyugecnt=document.getElementById('cconyuge3').value;	
	idcontra=document.getElementById('idcontra').value;	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","grabar_clientecnt.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			mostrarcontratante();
			alert('Contratante modificado satisfactoriamente');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&tipdocu="+tipdocu+"&numdoccnt="+numdoccnt+"&apepatcnt="+apepatcnt+"&apematcnt="+apematcnt+"&prinomcnt="+prinomcnt+"&segnomcnt="+segnomcnt+"&direccioncnt="+direccioncnt+"&emailcnt="+emailcnt+"&telfijocnt="+telfijocnt+"&telcelcnt="+telcelcnt+"&teloficnt="+teloficnt+"&sexocnt="+sexocnt+"&idestcivilcnt="+idestcivilcnt+"&nacionalidadcnt="+nacionalidadcnt+"&idprofesioncnt="+idprofesioncnt+"&idcargoocnt="+idcargoocnt+"&cumpcliecnt="+cumpcliecnt+"&natpercnt="+natpercnt+"&codubisccnt="+codubisccnt+"&nomprofesionescnt="+nomprofesionescnt+"&nomcargosscnt="+nomcargosscnt+"&ubigensccnt="+ubigensccnt+"&residentecnt="+residentecnt+"&docpaisemicnt="+docpaisemicnt+"&codcliecnt="+codcliecnt+"&cconyugecnt="+cconyugecnt+"&idcontra="+idcontra)
	
}	
// #=========================================================================================================
// #=========================================================================================================
// FUNCIONES PARA ACTUALIZAR DESDE PATRIMONIAL
//
function grabarmediopago3()
    { 
	  if(fgrabMediopago3()==true)
	  {
	   	  grabarmp3();
		  //mostrar_desc('editmp');
	      //ocultar_desc('gbrmp'); 
		  alert("Datos actualizados Satisfactoriamente");
	  }	
    }
/////////////////////////////////
function fgrabMediopago3()
{
//var _tipoactopatri = document.getElementById('tipoactopatri');	
var _imptrans = document.getElementById('imptrans2');
var _nnminuta = document.getElementById('nnminuta2');

	if(_imptrans.value=='' || _nnminuta.value=='') 
	{
		alert('Falta ingresar datos');return false;
	}
	else {
			return true;
	     }
}
	
//////////////////////////////////////////////	
// 1
function grabarmp3()
{
	var divResultado = document.getElementById('rouif');
	var _codkardex3 = document.getElementById('codkardex').value;  
	
	var _itemmp3 = document.getElementById('itemmp3').value;
    var _tipoactopatri3 = document.getElementById('tipoactopatrix').value; 
	var _nnminuta3 = document.getElementById('nnminuta2').value; 
	var _imptrans3 = document.getElementById('imptrans2').value; 
	var _tipomoneda3 = document.getElementById('tipomoneda2').value; 
	var _exibio3 = document.getElementById('exibio2').value; 
	var _tipcambio3 = document.getElementById('tipcambio2').value;
	
	//humbral = document.getElementById('humbral').value;
	
	// new  : 
	var _idoppago = document.getElementById('idoppago2').value;
	var _des_idoppago = document.getElementById('otroidoppago2').value;
	var _fpago3 = document.getElementById('fpago3').value;
	
	ajax=objetoAjax();

	ajax.open("POST","editar_mp_patri.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("codkardex="+_codkardex3+"&tipoactopatri="+_tipoactopatri3+"&fpago3="+_fpago3+"&nnminuta="+_nnminuta3+"&imptrans="+_imptrans3+"&tipomoneda="+_tipomoneda3+"&exibio="+_exibio3+"&tipcambio="+_tipcambio3+"&itemmp="+_itemmp3+"&idoppago="+_idoppago+"&des_idoppago="+_des_idoppago)
	
}

////////////////////////////////////////////
//

////////////////////	  
// 2
/*function addgbbiens3()
{
	 //_codkardex3  = document.getElementById('codkardex').value;
	 //_idtipacto3  = document.getElementById('tipactox').value;
	
	 var _itemmp3   = document.getElementById('itemmp4').value; 
	
	 var _tipob3    = document.getElementById('tipob2').value; 
	 var _tipobien3 = document.getElementById('tipobien2').value; 
	 var _codubis3  = document.getElementById('codubis2').value; 
	 var _fechaconst3 = document.getElementById('fechaconst2').value; 
	 var _oespecific3 = document.getElementById('oespecific2').value; 
	 var _smaquiequipo3 = document.getElementById('smaquiequipo3').value; 
	 var _tpsm3     = document.getElementById('tpsm3').value; 
	 var _npsm3     = document.getElementById('npsm3').value; 
	 
	 var _pregis3     = document.getElementById('pregis3').value; 
	 var _idsedereg3  = document.getElementById('idsedereg3').value; 
	
	ajax=objetoAjax();
	ajax.open("POST","editar_bien_patri.php",true);
	ajax.onreadystatechange=function() {
	if (ajax.readyState==4 && ajax.status==200) {
	
	//divResultado.innerHTML = ajax.responseText;
	  }
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tipob="+_tipob3+"&tipobien="+_tipobien3+"&codubis="+_codubis3+"&fechaconst="+_fechaconst3+"&oespecific="+_oespecific3+"&smaquiequipo="+_smaquiequipo3+"&tpsm="+_tpsm3+"&npsm="+_npsm3+"&itemmp="+_itemmp3+"&pregis="+_pregis3+"&idsedereg="+_idsedereg3)
	
}  */
///////////////////////////////////////////////////
//
function grabaruifp3()
{ 
grabaruifppp3();
//mostrar_desc('edituifp');
//ocultar_desc('gbruifp'); 
alert("Datos Actualizados Satisfactoriamente");  
}
/////////////////////////////////////////////
// 3
function grabaruifppp3()
{
	_itemmp3 = document.getElementById('itemmp3').value;
	
	_pregis3     = document.getElementById('pregis2').value; 
	_nregis3     = document.getElementById('nregis2').value;
	_idsedereg3 = document.getElementById('idsedereg2').value; 
	_fpago3      = document.getElementById('fpago2').value; 
	_oporpago3   = document.getElementById('oporpago2').value; 
	_ofpago3    = document.getElementById('ofpago2').value; 
	 
	
	ajax=objetoAjax();

	ajax.open("POST","editar_uifp_patri.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("pregis="+_pregis3+"&nregis="+_nregis3+"&idsedereg="+_idsedereg3+"&fpago="+_fpago3+"&oporpago="+_oporpago3+"&ofpago="+_ofpago3+"&itemmp="+_itemmp3)
	
}
//////////////////////////////////////////////////
//////////para buscar ubigeo en editar patrimonial
function buscaubigeoss3()
{ 	divResultado = document.getElementById('resulubis3');
	buscaubisx = document.getElementById('buscaubisx').value; 
		
	ajax=objetoAjax();
	ajax.open("POST","buscar_ubigeo_patri.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubis="+buscaubisx)
}
///////////////
function mostrarubigeoos3(id,name)
    {		//alert(id);
  		   document.getElementById('ubigens2').value = id; 
		   document.getElementById('codubis2').value = name;
		   
		   document.getElementById('ubigens2').value = id; 
		   document.getElementById('codubis2').value = name;    
		  
		   document.getElementById('buscaubisx').value = ''; 
		   //refreshubigeo2(); 
		   ocultar_desc('buscaubis3');
		   //alert(document.getElementById('ubigens2').value);       
    }	
////////////////////////////////////////////////////////////////
// para editar en bienes patrimonial_edicion
function enviarvalores3(valor)
    {   
	if(valor=="8"){
	mostrar_desc('vterrestres3');
	ocultar_desc('mequipos3');
	ocultar_desc('oespecificos3');
	/*document.getElementById('tpsm2').value="";
	document.getElementById('npsm2').value="" ;
	document.getElementById('oespecific2').value="" ;
	document.getElementById('smaquiequipo2').value="";*/
	}
		
	if(valor=="5"){
	mostrar_desc('mequipos3');
	ocultar_desc('vterrestres3');
	ocultar_desc('oespecificos3');
	/*document.getElementById('tpsm2').value="";
	document.getElementById('npsm2').value="" ;
	document.getElementById('oespecific2').value="";
	document.getElementById('smaquiequipo2').value="" ;*/
	}
		
	if(valor=="10"){
	mostrar_desc('oespecificos3');
	ocultar_desc('vterrestres3');
	ocultar_desc('mequipos3');
	/*document.getElementById('tpsm2').value="";
	document.getElementById('npsm2').value="" ;
	document.getElementById('oespecific2').value="" ;
	document.getElementById('smaquiequipo2').value="" ;*/
	}
	
	if(valor!="5" && valor!="8" && valor!="10"){ 
	ocultar_desc('vterrestres3');
	ocultar_desc('mequipos3');
	ocultar_desc('oespecificos3');
	/*document.getElementById('tpsm2').value="" ;
	document.getElementById('npsm2').value="";
	document.getElementById('oespecific2').value="" ;
	document.getElementById('smaquiequipo2').value="" ;*/
	}
    }

////////////////////////////
// #==============================================================
// DATOS PARA FORMULARIO VEHICULAR.
// 1 guarda datos vehicular
/*
function gbvehicular()
    { 
	  addgvehiculo();
	  alert("Vehiculo grabado satisfactoriamente");
	}
*/	
// function para guardar datos vehicular.
/*
function addgvehiculo()
{ 
	var codkardex = document.getElementById('codkardex').value;
	var _idtipacto = document.getElementById('tipactox').value;
	
	var _idplaca  = document.getElementById('idplacav').value;
	var _numplaca = document.getElementById('numplacav').value;
	var _clase    = document.getElementById('clasev').value;
	var _marca    = document.getElementById('marcav').value;
	var _anofab   = document.getElementById('anofabv').value;
	var _modelo   = document.getElementById('modelov').value;
	var _combustible = document.getElementById('combustiblev').value;
	var _carroceria = document.getElementById('carroceriav').value;
	var _fecinsc  = document.getElementById('fecinscv').value;
	var _color    = document.getElementById('colorv').value;
	var _motor    = document.getElementById('motorv').value;
	var _numcil   = document.getElementById('numcilv').value;
	var _numserie = document.getElementById('numseriev').value;
	var _numrueda = document.getElementById('numruedav').value;
	var _idmon    = document.getElementById('idmonv').value;
	var _precio   = document.getElementById('preciov').value;
	var _codmepag = document.getElementById('codmepagv').value;
	
	var ajax=objetoAjax();
	
	ajax.open("POST","grabar_newvechiculo.php",true);
	ajax.onreadystatechange=function() {
	if (ajax.readyState==4 && ajax.status==200) {
	
	  }
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("codkardex="+codkardex+"&idtipacto="+_idtipacto+"&idplaca="+_idplaca+"&numplaca="+_numplaca+"&clase="+_clase+"&marca="+_marca+"&anofab="+_anofab+"&modelo="+_modelo+"&combustible="+_combustible+"&carroceria="+_carroceria+"&fecinsc="+_fecinsc+"&color="+_color+"&motor="+_motor+"&numcil="+_numcil+"&numserie="+_numserie+"&numrueda="+_numrueda+"&idmon="+_idmon+"&precio="+_precio+"&codmepag="+_codmepag);
} 
*/
// 2 para editarvehicular en edicion de patrimonial
// 1 guarda datos vehicular
/*
function gbvehicular2()
      { 
		  addgvehiculo2();
		  alert("Vehiculo actualizado satisfactoriamente");
	  }
*/	  
// funcion para guardar la edicion de vehiculos
/*
function addgvehiculo2()
{ 

codkardex = document.getElementById('codkardex').value;
_idtipacto = document.getElementById('tipactox').value;

_idplaca  = document.getElementById('idplacav2').value;
_numplaca = document.getElementById('numplacav2').value;
_clase    = document.getElementById('clasev2').value;
_marca    = document.getElementById('marcav2').value;
_anofab   = document.getElementById('anofabv2').value;

_modelo   = document.getElementById('modelov2').value;
_combustible = document.getElementById('combustiblev2').value;
_carroceria = document.getElementById('carroceriav2').value;
_fecinsc  = document.getElementById('fecinscv2').value;
_color    = document.getElementById('colorv2').value;
_motor    = document.getElementById('motorv2').value;
_numcil   = document.getElementById('numcilv2').value;
_numserie = document.getElementById('numseriev2').value;
_numrueda = document.getElementById('numruedav2').value;
_idmon    = document.getElementById('idmonv2').value;
_precio   = document.getElementById('preciov2').value;
_codmepag = document.getElementById('codmepagv2').value;

ajax=objetoAjax();

ajax.open("POST","editar_newvehiculo.php",true);
ajax.onreadystatechange=function() {
if (ajax.readyState==4 && ajax.status==200) {

  }
}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("codkardex="+codkardex+"&idtipacto="+_idtipacto+"&idplaca="+_idplaca+"&numplaca="+_numplaca+"&clase="+_clase+"&marca="+_marca+"&anofab="+_anofab+"&modelo="+_modelo+"&combustible="+_combustible+"&carroceria="+_carroceria+"&fecinsc="+_fecinsc+"&color="+_color+"&motor="+_motor+"&numcil="+_numcil+"&numserie="+_numserie+"&numrueda="+_numrueda+"&idmon="+_idmon+"&precio="+_precio+"&codmepag="+_codmepag)
}
*/

////////////////////////////////////////////
function moselimp(_obj)
    {   
	    document.getElementById('detmpx').value = _obj;
		if(confirm('Desea eliminar el medio de pago..?'))
		{elimdetpago();}
		
    }
////////////////////////////////////////////////////
function elimdetpago()
{ 
	var detmpx = document.getElementById('detmpx').value;
	ajax=objetoAjax();
	
	ajax.open("POST","elim_detpago.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			mostrarlistmpp();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("detmp="+detmpx)
	}
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

function valorsospe(isChecked)
{	
	if (isChecked) 
	actualizarsospesi();
	else 
	actualizarsospeno();
		
}

function valorinu(isChecked)
{	
	if (isChecked) 
	actualizarinusi();
	
	else
	actualizarinuno();

}

///////////// borrar muestra ubigeo

function refreshubigeo()
{ 	divResultado = document.getElementById('resulubis');
	_buscaubis = "yer654645t45";
		
	ajax=objetoAjax();
	ajax.open("POST","buscarubigeos.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubis="+_buscaubis)
}


function refreshubigeo2()
{ 	divResultado = document.getElementById('resulubis3');
	_buscaubis = "yer654645t45";
		
	ajax=objetoAjax();
	ajax.open("POST","buscar_ubigeo_patri.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("buscaubis="+_buscaubis)
}



///////////////////////////////////////////////////////////////////////////////////
// ELIMINAR LISTA DE PATRIMONIAL

function elimpatrimonio(__idtipacto, __kardex, __itemmp)
{
	var _divlistvehiculos = document.getElementById('listvehiculos');
	ajax=objetoAjax();
	
	ajax.open("POST","elim_list_patri.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			listarbienesss();
			listapagosall();
			if(_divlistvehiculos.innerHTML!='')
			{listarVehiculos();}
			
			alert('Se elimino satisfactoriamente');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idtipacto="+__idtipacto+"&kardex="+__kardex+"&itemmp="+__itemmp)
			
}


//////////////////////////////////
//////////////////////////////////
//  ## Genenerando el Documento
function GendoDocum(donwload,typeDocument)
{
		var pkTemplate =  document.getElementById('idTemplate').value;

		var _num_kardex = document.getElementById('codkardex').value;
		var _tip_kardex = document.getElementById('idtipkar').value;
		var _idtipoacto = document.getElementById('codactos').value;
		
		if(_num_kardex==''){
			alert('Debe guardar los datos primero');
			return;
		}else if(pkTemplate == 0){
			alert('Seleccione una plantilla');
			return;
		}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		//datos del notario:
		var _nom_notario  = 'NOMBRE DEL NOTARIO';
		var _num_doc      = "17863776";//document.getElementById('').value;
		var _num_doc2     = "1172155614";//document.getElementById('').value;
		var _reg_contrib  = "10178637768"; //document.getElementById('').value;

		window.open('reportes_word/generar_protocolar_kardex_u.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument+
					'&pkTemplate='+pkTemplate);	
/*
if(_tip_kardex == "1") 
	{

		
		if(_idtipoacto=='888')
		{ 
			window.open('reportes_word/generador_protocolar_podersinminuta.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+"&donwload="+donwload+'&typeDocument='+typeDocument);	
		}
		else if(_idtipoacto != '888')
		{
			// ENTRA A CONSTITUCIONES . 
			if(_idtipoacto == '036' || _idtipoacto == '037' || _idtipoacto == '035' || _idtipoacto == '034' || _idtipoacto == '033' || _idtipoacto == '038' || _idtipoacto == '116') 
			{ 
				window.open('reportes_word/generador_protocolar_constiempresa.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);	
			}
			else
			{
				window.open('reportes_word/generar_protocolar_kardex_u.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument+
					'&pkTemplate='+pkTemplate);	
			}
			
			
		}	
		
	}
else if(_tip_kardex == "3") 
	{
			if(_idtipoacto == '096' || _idtipoacto == '091') 
			{ 
				window.open('reportes_word/generador_protocolar_donacion.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);	
			}
			else
			{
		window.open('reportes_word/generador_protocolar_vehicular.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);
	}}
	
else if(_tip_kardex == "4")  // GARANTÍAS MOBILIARIAS
	{	
		//levantamiento de garantia
		if(_idtipoacto == '087') 
			{ 
				window.open('reportes_word/generador_protocolar_levantamiento.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);	
			}
			else
			{
				window.open('reportes_word/generador_protocolar_gmobiliaria.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);
	}
	}
		
else if(_tip_kardex == "2")  // ASUNTOS NO CONTENCIOSOS
	{	
		//DIVORCIO
		if(_idtipoacto == '012')//ETAPA SOLICITUD DEL DIVORCIO
		{
		window.open('reportes_word/generador_protocolar_(SOLICITUD).php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);	
		}
		else if(_idtipoacto == '122')//ETAPA AUDIENCIA DEL DIVORCIO
		{
		window.open('reportes_word/generador_protocolar_(AUDIENCIA).php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);	
		}
		else if(_idtipoacto == '123')//ETAPA DISOLUCION DEL DIVORCIO
		{
		window.open('reportes_word/generador_protocolar_(DISOLUCION).php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);	
		}
		// Evalua si es sucecion intestada :
		else if(_idtipoacto == '013')
		{
		 
		window.open('reportes_word/generador_protocolar_sucecionintestada.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);	
		}
		else if(_idtipoacto != '013')
		{

			window.open('reportes_word/generador_protocolar_nocontenciosos.php?num_kardex='+_num_kardex+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario+'&idtipoacto='+_idtipoacto+'&num_doc2='+_num_doc2+'&num_doc='+_num_doc+'&reg_contrib='+_reg_contrib+'&donwload='+donwload+'&typeDocument='+typeDocument);		
		}
	}*/


	
}


function verifyDocument(argtypeDocument){

	var numberKardex = document.getElementById('codkardex').value;
	var vpkTemplate 	=  document.getElementById('idTemplate').value;
	var vpkTypeAct = document.getElementById('codactos').value;


	if(vpkTemplate == 0){
		alert('Seleccione una plantilla');
		return;
	}

	$.ajax({
		url:'reportes_word/verify_document_kardex.php',
		dataType:'json',
		type:'POST',
		data:{kardex:numberKardex,typeDocument:argtypeDocument,pkTemplate:vpkTemplate,pkTypeAct:vpkTypeAct},
		success:function(response){

			error = response.error;
			if(error == 1){

				if(argtypeDocument == 1){
					$('#confirmGenerateDocument').text(response.descriptionError);
				}else if(argtypeDocument == 2){
					$('#confirmGenerateDocument').text(response.descriptionError);
				}else if(argtypeDocument == 3){
					$('#confirmGenerateDocument').text(response.descriptionError);
				}

				$('#confirmGenerateDocument').dialog({
					resizable: false,
					height:150,
					width:500,
					position :["center"],
					modal: true,
					buttons: {
						
						"Generar Documento": function() {
							$(this).dialog("destroy");
							GendoDocum(0,argtypeDocument);

						},
						"Ver Documento":function(){
							$(this).dialog("destroy");

							GendoDocum(1,argtypeDocument);


						},
						"Cancelar": function() {

							$(this).dialog("destroy");

						}
					}
				});

			}else if(error == 2){

				$('#confirmGenerateDocument').dialog({
					resizable: false,
					height:150,
					width:500,
					position :["center"],
					modal: true,
					buttons: {
						
						"Aceptar":function(){
							$(this).dialog("destroy");

						}
						
					}
				});
				$('#confirmGenerateDocument').text(response.descriptionError);


			}else{
				GendoDocum(0,argtypeDocument);
			}

		}

	});

}













//////////////////////////////////////////////////////////////////////////////////
//// Functions 20 / 08 / 2013  --> agregadas
	function validarbien3()
		{ var _idacto = document.getElementById('evaluavehi').value; 
		  if(_idacto=='')
		  { mostrar_desc('vbien');}
		  else if(_idacto=='V')
		  { mostrar_desc('vvehicular');}
		   
		   ocultar_desc('vpago');
		   ocultar_desc('vuif');
		}
	///
	function agregarbienes2()
		{   
			  mostrar_desc('newbiennnes2');
			  // ***
			  document.getElementById('pregis3').value        = "";
			  document.getElementById('tipob2').value         = ""; 
			  document.getElementById('tipobien2').value      = "";
			  document.getElementById('idsedereg3').value     = "";
			  // ***	
			  document.getElementById('ubigens2').value       = "" ;
			  document.getElementById('fechaconst2').value    = "" ;
			  document.getElementById('codubis2').value       = "" ;
			  document.getElementById('npsm3').value          = "" ;
			  document.getElementById('tpsm3').value          = "" ;
			  document.getElementById('smaquiequipo3').value  = "" ;
			  document.getElementById('oespecific2').value    = "" ;
		}

	function listarbienesss2()
		{
			listadobien2();
		}


	function listadobien()
	{ 
		var divResultado = document.getElementById('listbiennes');
		if(document.getElementById('listbiennes2'))
		{var divResultado2 = document.getElementById('listbiennes2');}
		
		var codkardex=document.frmprotocolares.codkardex.value;
		var _tipoactopatri = document.getElementById('tipactox').value;
		var ajax = objetoAjax();
	
		ajax.open("POST","listadobbiieenneess.php",true);
		ajax.onreadystatechange=function() {
			
			if (ajax.readyState==4 && ajax.status==200) {
				
				divResultado.innerHTML = ajax.responseText;
				if(document.getElementById('listbiennes2'))
				{divResultado2.innerHTML = ajax.responseText;}
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("codkardex="+codkardex+"&tipoactopatri="+_tipoactopatri);
	}

function fDest_DivBienesedita()
{
	$("#verbienesedit").html("");	
}

function MuesMinutaVie()
	{
		var _numkar = $("#codkardex").val();
		var url = "view_minuta.php?numkar="+_numkar;
		$("#frame_minutas").attr("src",url)
	}
	
function fVisualDocument()
	{
		var _numcarta = document.getElementById('codkardex').value;
		if(_numcarta == ''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_kardex.php?numcarta="+_numcarta+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);
			
	}


function validadnic1()
{
	 if($('#tidocu').val()==1)
		{
			$("#numdoc2").attr("maxlength", 8);
		}else if($('#tidocu').val()!=1)
		{
			$("#numdoc2").attr("maxlength", 16);
		}
}
function validarconyuge()
	{
	
		if	(!$('#tidocu2').val())
		{
			
			alert("debe seleccionar tipo de documento");
		}
		 if($('#tidocu2').val()==1)
		{
			$("#numdoc6").attr("maxlength", 8);
		}
		 if($('#tidocu2').val()!=1)
		{
			$("#numdoc6").attr("maxlength",16);
		}
		 if($('#tidocu2').val()==2)
		{
			$("#numdoc6").attr("maxlength",10);
		}
	}
	
//validador de cajas de texto leras y numero///////////////////////////////////////////////////////////
function soloLetrasynumeros(e){
 key = e.keyCode || e.which;
 
 //alert(key);
 
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " 1234567890áéíóúabcdefghijklmnñopqrstuvwxyz-:._'°#&*+/";
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

function evalDocumentorctm()
{
	buscaclientesrctm();
}





function seleccionacontraxxx(id){
	
	mostrarxisclie(id);
	}
function newclientrctm()
 {
	 buscaclientesrctm2();
	 }	
function newclientrucrctm() {
	
	buscaclientesrctm3();
	}

function limpiarnumedoc(){
document.getElementById('numdoc').value="";

}
function limpiartexto(){
document.getElementById('buscanombemp').value="";

}
	
</script>

<!--!>consulta reniec sunat-->
<script src="js/consulta_reniec_sunat.js"></script>

<style type="text/css">
<!--
.submenutitu {
	font-family: Calibri;
	font-size: 18px;
	font-style: italic;
	color:#FF9900;
}
.titubusca {
	font-family: Calibri;
	font-size: 13px;
	color: #333333;
	font-style: italic;
}
-->
</style>
<style type="text/css">

.ui-widget {
    font-family: Lucida Grande,Lucida Sans,Arial,sans-serif;
    font-size: 13px;
}

.ui-widget .ui-widget {
    font-size: 12px ;
}

<!--
#gridPatrimonial{
	width:100px;
	height:200px;}

.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }


ul.tabs {margin: 0;  padding: 0;  float: left;  list-style: none;  height: auto;  width: 760px; border-left:2px solid #264965; border-bottom:2px solid #777; }
ul.tabs li { background:#264965; font-family:Calibri; color:#FF9900; float: left;  margin-left: 0px;  padding: 0; border: 2px solid #777; overflow: hidden; position: relative; border-left:0px; margin-bottom:-2px;border-radius:8px 8px 0 0;}
ul.tabs li a {text-decoration: none; font-family:Calibri; color:#FF9900; background:#264965; display: block; font-size: 14px; font-weight:bold; padding: 4px 20px; }
ul.tabs li a:hover {background:#FF9900; font-family:Calibri; color:#264965}
ul.tabs li.active, html ul.tabs li.active a:hover  {background:#FF9900; border-bottom: 2px solid #eee; margin-bottom:-2px;}
ul.tabs li.active, html ul.tabs li.active a{
	background: #FF9900;
	color:#264965;
}
 
.Contenedor{border: 2px solid #777; border-top: none; overflow: hidden; clear: both; float: left; width: 760px; background: #ffff;
-webkit-border-bottom-right-radius: 8px;
-webkit-border-bottom-left-radius: 8px;
-moz-border-radius-bottomright: 8px;
-moz-border-radius-bottomleft: 8px;
border-bottom-right-radius: 8px;
border-bottom-left-radius: 8px;
}
.Contenido {padding: 15px; font-size: 12px;}
-->

<style type="text/css">
<!--

.slectcontratantes {
	font-family: Calibri;
	font-size: 12px;
	color: #FFFFFF;
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
	top: 180px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}

div.allcontrata {width:600px; height:150px; overflow:auto;}
div.newproto
{ 
background-color: #ffffff;
border: 1px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:818px; height:778px;
}




div.buscar{ width:620px; height:420px;
 background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }

div.mante{ width:310px; height:420px;
background-color: #264965;
border: 4px solid #264965;
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;  }

div.contratantes{ width:728px; height:250px; overflow:auto;  }

.editcampp {font-family: Calibri; font-style: italic; font-size: 14px; color: #FFFFFF; }

.titulomenuacto { font-family:Calibri; color:#FFFFFF; font-size:14px; font-style:italic;
}

div.tipoacto{ width:740px; height:150px; overflow:auto;}
div.newproto1 {  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:800px; height:600px;
}
.kardex{ font-family:Calibri; font-size:24px; font-style:italic; color:#003366}
div.menucondicion{
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:750px;
	height:220px;
	position:absolute;
	left: 460px;
	top: 95px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}

div.clienedit {
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
	left: 494px;
	top: 274px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
div.uifpdtparticip{
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
	top: 333px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}

div.menuactos {
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
	left: 490px;
	top: 179px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}
div.menuactos2 {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:759px;
	height:220px;
	position:absolute;
	left: 482px;
	top: 172px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}
div.asigna{ height:220px; width:1095px; overflow:auto;


}
div.tipoacto2 {width:740px; height:150px; overflow:auto;}
div.clienbus {
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
	left: 493px;
	top: 270px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
.Estilo15 {font-size: 12px; font-weight: bold; font-family: Calibri;}
.Estilo18 {font-family: Calibri; font-weight: bold; }
.Estilo21 {font-family: Calibri; color: #003399; }
.Estilo23 {font-family: Calibri; color: #003399; font-weight: bold; }
.Estilo31 {font-family: Calibri; font-size: 13px; font-style: italic; }
.style1 {
	font-size: 14px;
	font-weight: bold;
}
.style2 {
	font-family: Calibri;
	font-size: 14px;
	font-style: italic;
	font-weight: bold;
}
.Estilo40 {font-family: Calibri; color: #666666; }
.Estilo42 {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; font-weight: bold; }
.btnpatrimonial {color: #FFFFFF; font-family: Calibri; font-style: italic; font-weight: bold; }
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}
.Estilo43 {color: #333333}
.Contenedor1 {
	border: 2px solid #777; 
	border-top: none; overflow: hidden; 
	clear: both; float: left; 
	width: 760px;
 background: #ffff;
-webkit-border-bottom-right-radius: 8px;
-webkit-border-bottom-left-radius: 8px;
-moz-border-radius-bottomright: 8px;
-moz-border-radius-bottomleft: 8px;
border-bottom-right-radius: 8px;
border-bottom-left-radius: 8px;
    height: 310px;
    overflow: auto;
    overflow-x: hidden;
}
div.clienbus1 {
	background: #333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width: 760px;
	height: 450px;
	position: absolute;
	left: 493px;
	top: 270px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
div.clienedit1 {	background:#333333;
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
	left: 494px;
	top: 274px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
div.menuactos1 {
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
	top: 182px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}
div.menuactos21 {	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:759px;
	height:220px;
	position:absolute;
	left: 482px;
	top: 172px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}
div.uifpdtparticip1 {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:818px;
	height:334px;
	position:absolute;
	left: 467px;
	top: 311px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
#apDiv1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:21;
}
-->

.s {
	font-family: Verdana, Geneva, sans-serif;
	
}
strong {
	font-size: 16px;
}
.DSA {
	font-size: 18px;
}
.SS {
	font-size: 18px;
}

</style>
</head>

<body onLoad="FShowPagos_Kardex_result();cambiar();">
<div class="newproto" id="newproto">
<input name="tipactox" type="hidden" id="tipactox" />
<input name="itemmpx" type="hidden" id="itemmpx" />
<input name="evaluavehi" type="hidden" id="evaluavehi" />
















 <table width="813" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="813"><form id="frmprotocolares" name="frmprotocolares" method="post" action="actualizar_kardex.php">
          <table width="801" border="0" cellspacing="0" cellpadding="0">
          	<tr>
	          	<td colspan="2">
	          		<div id="confirmGenerateDocument" title="Mensaje al Usuario" style="display:none">El documento ya fue generado, ¿Que es lo que desea hacer?</div>
	          	</td>
            </tr>

            <tr>
              <td width="55" height="28" align="center" bgcolor="#264965"><img src="iconos/nuevo2.png" width="20" height="22" /></td>
              <td width="763" bgcolor="#264965"><span class="submenutitu">Nuevo Kardex</span></td>
            </tr>
            <tr>
              <td colspan="2"><table width="818" height="226" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="216" height="19" valign="bottom"><span class="camposss">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo de Kardex</span></td>
                    <td width="25" height="19" valign="bottom">&nbsp;</td>
                    <td width="179" height="19" valign="bottom"><span class="camposss">&nbsp;&nbsp;Fecha de Ingreso</span></td>
                    <td height="19" colspan="3" align="left" valign="bottom" class="camposss">&nbsp;&nbsp;Hora
                    <input name="nreferencia" style="text-transform:uppercase" type="hidden" id="nreferencia" size="80" /></td>
                  </tr>

                  <tr>
                    <td height="29" align="right">

                    <select name="idtipkar" id="idtipkar" onChange="cambiar()">
                    <option value="0">SELECCIONE TIPO KARDEX</option>
                    <?php
		  			while($row = mysql_fetch_array($sql)){
		    			echo "<option value = '".$row["idtipkar"]."' ";
		  
			 			if($_GET['tipoid']==$row["idtipkar"]){
				  			echo " selected='selected'";
			  			}
			  
		  				echo ">".nl2br($row["nomtipkar"])."</option>";  
		  			}
		?>
                    </select>

                    </td>

                    <td><input name="tipoescritura" type="hidden" id="tipoescritura" size="5"  value="<?php echo $tipoescritura; ?>" /></td>
                    <td height="29">

                    <input type="text" name="fechaingreso" class="tcal" id="fechaingreso"  size="15" value="<?php echo date("d/m/Y"); ?>" readonly 
 /></td>
 
 
                    <td width="193" align="left" valign="middle">

                    <input name="horaingreso" readonly type="text" value="<?php echo $horaingreso; ?>" id="horaingreso" size="11"  />
                    </td>

                    <td width="175" align="center" class="kardex">Nº Kardex - Año</td>
                    <td height="29" ></td>

                  </tr>
                  <tr>
                    <td height="28" colspan="5" valign="bottom"><table width="787" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="97" height="27" align="right"><span class="camposss">Referencia&nbsp;&nbsp;</span></td>
                          <td width="545"><span class="camposss">
                            <input name="referencia" type="text" id="referencia" style="text-transform:uppercase" onKeyPress="return soloLetrasynumeros(event)" onKeyUp="cambioampe()" size="90" maxlength="800" />
                          </span></td>
						  <td width="145" height="27"><div id="resultado" style="width:100px;"><span class="camposss"><a href='#' onClick="valida()"><img  src='imagenes/generar.jpg' alt="" width='90' height='29' border='0' title='Editar Usuario' /></a></span></div></td>
                        </tr>
                    </table></td>
                    <td width="30" align="center" valign="middle"></td>
                  </tr>
                  <tr>
                    <td height="22" colspan="6">
                    <table width="739" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="97" height="22" align="right"><span class="camposss">Código de  Actos&nbsp;&nbsp;</span></td>
                          <td width="116"><span class="camposss">
                            <input name="codactos" readonly  type="text" id="codactos" size="15" style="background:#B8E7DF" />
                          </span></td>
                          <td width="107" align="right" class="camposss">Derecho Notarial&nbsp;&nbsp;</td>
                          <td width="107"><label>
                            <input name="dnotarial" type="text" id="dnotarial" size="11" onChange="valornot(this.value)" value="0.00" onKeyUp="return numnot(this.value)"   />
                          </label></td>
                          <td width="120" align="right" class="camposss">Derecho Registral&nbsp;&nbsp;</td>
                          <td width="192"><input name="dregistral" type="text" id="dregistral" size="11" onChange="valorreg(this.value)" value="0.00" onKeyUp="return numregi(this.value)" /></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="33" colspan="6" align="left" valign="top" class="camposss">
					
					
					
					
					
					
					<table width="801" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="98" height="33" align="right" class="camposss">Contrato&nbsp;&nbsp;</td>
                          <td width="703"><table width="662" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="450" height="33"  valign="middle"><label>
                                  <input name="contrato" type="text" id="contrato" style="text-transform:uppercase" onKeyPress="return soloLetras(event)" size="80" maxlength="800" />
                                </label></td>
                                <td width="76" align="left" valign="top"><a onClick="asi3()"><img src="iconos/addacto.png" width="75" height="29" /></a>
                                  <div id="menuactos" class="menuactos1" style="display:none; z-index:2;" >
                                    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                          <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
										  	<tr>
                                                <td width="16">&nbsp;</td>
                                                <td width="180"><span class="titulomenuacto">Seleccione Acto(s)</span></td>
												<td width="16"><input type="text" style="position: absolute;width: 300px;left: 40%;background: white;" placeholder="FILTRAR ACTO" id="txtFiltrarGrupo"></td>
                                              </tr>
                                          </table></td>
                                          <td width="21" align="right" valign="middle">&nbsp;</td>
                                      </tr>
                                        <tr>
                                          <td height="50" colspan="3"><div id="tipoacto" class="tipoacto"></div></td>
                                        </tr>
                                        <tr>
                                          <td width="607" height="10">&nbsp;</td>
                                          <td width="132"><a href='#' onClick="ocultar_desc('menuactos')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                          <td height="10">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center" valign="middle"></td>
                                        </tr>
                                        <tr></tr>
                                    </table>
									
									
									
									
                                </div></td>
                                <td width="136" align="left" valign="top"><a onClick="asi4()"><img src="iconos/delacto.png" width="75" height="29" /></a>
                                  <div id="menuactos2" class="menuactos21" style="display:none; z-index:3;" >
                                    <table width="755" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                          <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="16">&nbsp;</td>
                                                <td width="180"><span class="titulomenuacto">Quitar Acto(s)</span></td>
                                              </tr>
                                          </table></td>
                                          <td width="21" align="right" valign="middle">&nbsp;</td>
                                      </tr>
                                        <tr>
                                          <td height="50" colspan="3"><div id="tipoacto2" class="tipoacto2"></div></td>
                                        </tr>
                                        <tr>
                                          <td width="607" height="10">&nbsp;</td>
                                          <td width="132"><a href='#' onClick="ocultar_desc('menuactos2')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                          <td height="10">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center" valign="middle"></td>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                </div></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="33" colspan="6"><table width="815" border="0">
                      <tr>
                        <td width="88" align="right" valign="baseline" class="camposss">Responsable&nbsp;&nbsp;</td>
                        <td width="336" valign="top">
                          <input name="responsable_new" type="text" id="responsable_new" style="text-transform:uppercase" onKeyPress="return soloLetrasynumeros(event)" size="56" maxlength="80" value="<?php echo $rowwuser["loginusuario"]; ?>" /></td>
                        <td width="64" align="right" valign="top"><span class="camposss">Recepción&nbsp;&nbsp;</span></td>
                        <td width="269" valign="top"><select  name="idusuarios" id="idusuarios"  >
                          <option value="0" >SELECCIONE </option>
                          <?php
						while($row_abog2=mysql_fetch_array($sqlusuarios)){
						echo "<option value = '".$row_abog2["idusuario"]."'";
						echo ">".nl2br($row_abog2["loginusuario"])."</option>";  
						}
						?>
                        </select></td>
                        </tr>
                      <tr>
                        <td width="88" height="26" align="right" class="camposss">Abogado&nbsp;&nbsp;</td>

                        <td height="26" colspan="3" > 

                        <select  name="idabogado" id="idabogado" >
                          <option value="0">SELECCIONE ABOGADO</option>
                          <?php
						while($row_abog=mysql_fetch_array($sql_abog)){
						echo "<option value = '".strtoupper($row_abog["idabogado"])."'";
						echo ">".nl2br(strtoupper($row_abog["razonsocial"]))."</option>";  
						}
						?>
                          </select>
                          <span class="camposss">Funcionario&nbsp;&nbsp;
                            <input name="funcionario_new" type="text" id="funcionario_new" style="text-transform:uppercase" onKeyPress="return soloLetrasynumeros(event)" size="57" maxlength="120" />
                          </span>
                          </td>


                        <td width="36" height="26" >&nbsp;</td>
                      </tr>

                      <tr>
                      	<td align="right"><span class="camposss">Presentante&nbsp;&nbsp;</span></td>
                      	<td width="40">
                      		  <select name="idPresentante" id="idPresentante" >
                      		  <option selected value="0" >Seleccione Presentante</option>
	                          <?php
							  while($rowPresentante = mysql_fetch_array($sqlPresentante)){ ?>
							  	 <?php if($rowPresentante['idPresentante'] == $rowvkardex['idPresentante']){ ?>
							  	 	<option selected value="<?php echo $rowPresentante['idPresentante'];?>" ><?php echo $rowPresentante['presentante']; ?></option>
							   	 <?php }else{?>
							   	 	<option  value="<?php echo $rowPresentante['idPresentante'];?>" ><?php echo $rowPresentante['presentante']; ?></option>
							  	 <?php } ?>
							  <?php } ?>
	                          </select>
                      	</td>
                        <td align=""><span class="camposss">Plantilla&nbsp;&nbsp;</span></td>
                      	<td width="40">
                      		  <select name="idTemplate" id="idTemplate" >
                      		  <option selected value="0" >Seleccione Plantilla</option>
	                         	<?php
								 	 while($row = mysql_fetch_array($reesult)){ ?>
								 	 	<?php if($row['codeActs'] == $rowvkardex['codactos']): ?>
								 	 		<option class="option-template" value="<?php echo $row['pkTemplate'];?>" ><?php echo $row['fileName']; ?></option>
								 	 	<?php endif ?>
								<?php } ?>
	                          </select>
                      	</td>


                      </tr>




					  
				    </table>
				    </tr>
                  <tr>
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
                    <td height="19" colspan="6"> ---------------------------------------------------------------------------------------------------------------------------------------</td>
                  </tr>
                  <tr>
                    <td height="19" colspan="6">
                    <!---------------------------aqui copiar al original --------------------------------------------------->
                    
                    <div id="editcontrata2" style="position:absolute; display:none; width:662px; height:275px; left: 87px; top: 362px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="614"><span class="camposss">Editar Contratante</span></td>
      <td width="21"><a href="#" onClick="ocultar_desc('editcontrata2')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="verclienterctm2" style="width:618px; height:220px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

<div id="buscacargooocnt" style="position:absolute; display:none; width:637px; height:223px; left: 111px; top: 406px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooocnt')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargoosscnt" type="text" id="buscacargoosscnt"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscacarguitosscnt()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargitocnt" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

<div id="buscaprofecntn" style="position:absolute; display:none; width:637px; height:223px; left: 97px; top: 404px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofecntn')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofescnt" type="text" id="buscaprofescnt" style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaprofesionescnt()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesionescnt" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------- -->
                    
                    <div id="editaclie" style="position:absolute; display:none; width:662px; height:275px; left: 87px; top: 362px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="614"><span class="camposss">Editar Cliente</span></td>
      <td width="21"><a href="#" onClick="ocultar_desc('editaclie')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="verclienterctm" style="width:618px; height:220px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="conyugesss2" style="position:absolute; display:none; width:662px; height:307px; left: 89px; top: 351px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="4" height="29">&nbsp;</td>
      <td width="130"><span class="Estilo42">Cambiar Conyuge </span></td>
      <td width="81" align="right" class="camposss">Documento</td>
      <td width="154" align="right" class="camposss"><select id="tidocu2" name="tidocu2" style="width:100px" onChange="validarconyuge()">
<option value="1" selected="selected">DOCUMENTO NACIONAL DE IDENTIDAD (DNI)</option>
<option value="2">CARNET DE EXTRANJERIA</option>
<option value="3">CARNET DE IDENTIDAD DE LAS FUERZAS POLICIALES</option>
<option value="4">CARNET DE IDENTIDAD DE LAS FUERZAS ARMADAS</option>
<option value="5">PASAPORTE</option>
<option value="6">CEDULA DE CIUDADANIA</option>
<option value="7">CEDULA DIPLOMATICA DE IDENTIDAD</option>
<option value="9">OTRO</option>
</select></td>
      <td width="75" align="right" class="camposss"></td>
      <td width="120"><input name="numdoc6" type="text" id="numdoc6" style="background:#FFFFFF" size="15"  /><input name="clieidconyu" type="hidden" id="clieidconyu" style="background:#FFFFFF" size="10"  /></td>
      <td width="72"><a  onclick="buscaclientes6()"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
      <td width="23"><a href="#" onClick="ocultar_desc('conyugesss2')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><div id="nuevaconyuge2" style="width:618px; height:220px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="conyugesss" style="position:absolute; display:none; width:662px; height:307px; left: 89px; top: 351px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="659" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="5" height="29">&nbsp;</td>
      <td width="122"><span class="Estilo42">Ingresar Conyuge </span></td>
      <td width="135" align="right" class="camposss">Documento</td>
      <td width="159" align="right" class="camposss"><select id="tidocu" name="tidocu" style="width:110px" onChange="validadnic1();">

<option value="1" selected="selected">DOCUMENTO NACIONAL DE IDENTIDAD (DNI)</option>
<option value="2">CARNET DE EXTRANJERIA</option>
<option value="3">CARNET DE IDENTIDAD DE LAS FUERZAS POLICIALES</option>
<option value="4">CARNET DE IDENTIDAD DE LAS FUERZAS ARMADAS</option>
<option value="5">PASAPORTE</option>
<option value="6">CEDULA DE CIUDADANIA</option>
<option value="7">CEDULA DIPLOMATICA DE IDENTIDAD</option>
<option value="9">OTRO</option>
</select></td>
      <td width="132" align="center"><input name="numdoc2" type="text" id="numdoc2" style="background:#FFFFFF" size="20" /></td>
      <td width="82"><a  onclick="buscaclientes2()"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
      <td width="24"><a href="#" onClick="ocultar_desc('conyugesss')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td colspan="5"><div id="nuevaconyuge" style="width:618px; height:220px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
                    <div id="buscacargooo" style="position:absolute; display:none; width:637px; height:223px; left: 111px; top: 406px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss" type="text" id="buscacargooss"  style="background:#FFFFFF;text-transform:uppercase;" size="50" onKeyPress="buscacarguitoss()" />
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
<div id="buscacargooo7" style="position:absolute; display:none; width:637px; height:223px; left: 111px; top: 406px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo7')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss7" type="text" id="buscacargooss7"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscacarguitoss7()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargito7" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="buscacargooo6" style="position:absolute; display:none; width:637px; height:223px; left: 111px; top: 406px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo6')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss6" type="text" id="buscacargooss6"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscacarguitoss6()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargito6" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="buscacargooo4" style="position:absolute; display:none; width:637px; height:223px; left: 111px; top: 406px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo4')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss4" type="text" id="buscacargooss4"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscacarguitoss4()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargito4" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="buscacargooo3" style="position:absolute; display:none; width:637px; height:223px; left: 111px; top: 406px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo3')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss3" type="text" id="buscacargooss3"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscacarguitoss3()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargito3" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

 <div id="buscacargooo2" style="position:absolute; display:none; width:637px; height:223px; left: 111px; top: 406px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Cargo:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscacargooo2')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscacargooss2" type="text" id="buscacargooss2"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscacarguitoss2()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulcargito2" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="buscaprofe" style="position:absolute; display:none; width:637px; height:223px; left: 97px; top: 404px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes" type="text" id="buscaprofes"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaprofesiones()" />
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
<div id="buscaprofe7" style="position:absolute; display:none; width:637px; height:223px; left: 97px; top: 404px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe7')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes7" type="text" id="buscaprofes7"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaprofesiones7()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesiones7" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="buscaprofe6" style="position:absolute; display:none; width:637px; height:223px; left: 97px; top: 404px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe6')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes6" type="text" id="buscaprofes6"  style="background:#FFFFFF; text-transform:uppercase; text-transform:uppercase;" size="50" onKeyPress="buscaprofesiones6()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesiones6" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="buscaprofe4" style="position:absolute; display:none; width:637px; height:223px; left: 97px; top: 404px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe4')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes4" type="text" id="buscaprofes4"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaprofesiones4()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesiones4" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div id="buscaprofe3" style="position:absolute; display:none; width:637px; height:223px; left: 97px; top: 404px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe3')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes3" type="text" id="buscaprofes3"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaprofesiones3()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesiones3" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

 <div id="buscaprofe2" style="position:absolute; display:none; width:637px; height:223px; left: 97px; top: 404px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><span class="camposss">Seleccionar Profesión:</span></td>
      <td width="28"><a href="#" onClick="ocultar_desc('buscaprofe2')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="buscaprofes2" type="text" id="buscaprofes2"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onKeyPress="buscaprofesiones2()" />
      </label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="resulprofesiones2" style="width:585px; height:150px; overflow:auto"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
                    <div id="firmasss" style="position:absolute; display:none; width:247px; height:91px; left: 410px; top: 389px; z-index:15; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                        <table width="241" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16" height="24">&nbsp;</td>
                            <td width="193" class="camposss">Fecha Firma:</td>
                            <td width="32"><a href="#" onClick="ocultar_desc('firmasss')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                          </tr>
                          <tr>
                            <td rowspan="2">&nbsp;</td>
                            <td height="30" colspan="2"><label>
                            <input name="fecfirmaa" type="text" class="tcal" style="background:#FFF;" id="fecfirmaa" size="20"  />
                            <input name="firmitaa" type="hidden" id="firmitaa" size="10" />
                            <input name="detmpx" type="hidden" id="detmpx" size="10" />
                            
                            </label></td>
                          </tr>
                          <tr>
                            <td colspan="2"><a href="#" onClick="CompareDates(frmprotocolares.fechaingreso.value,frmprotocolares.fecfirmaa.value,frmprotocolares.fechaescritura.value)"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
                          </tr>
                        </table>
                    </div>
                        <div id="patrimoniallll" style="position:absolute; display:none; width:745px; height:415px; left: 51px; top: 305px; z-index:17; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                          <table width="743" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="11" height="25">&nbsp;</td>
                              <td width="697"><img src="iconos/patri.png" width="300" height="25" border="0" usemap="#Map" /></td>
                              <td width="32"><a href="#" onClick="ocultar_desc('patrimoniallll')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="2"><div id="newpatrimonio" style="display:none;">
                                <table width="718" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333">
                                    <tr>
                                      <td width="359" height="35" align="center" bgcolor="#666666"><a onClick="validarpago()"><span class="btnpatrimonial">Medio de Pago/Tipo de Fondo</span></a></td>
                                      <td width="359" align="center" bgcolor="#666666"><a id="sp_infobien" onClick="validarbien()"><span  class="btnpatrimonial">Información del Bien</span></a></td>
                                    </tr>
                                    <tr>
                                      <td height="312" colspan="3" valign="top"><div id="vuif" style="display:none">
                                          <table width="680" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="24" height="30">&nbsp;</td>
                                              <td width="125">&nbsp;</td>
                                              <td width="224" height="30">&nbsp;</td>
                                              <td height="30" class="titupatrimo">&nbsp;</td>
                                            <td height="30">&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td height="30">&nbsp;</td>
                                              <td height="30"><span class="titupatrimo">Oport. de Pago</span></td>
                                              <td height="30"><span class="titupatrimo">
                                            <select name="oporpago" id="oporpago">
                                                  <?php
	       while($rowopor = mysql_fetch_array($sqloporpago)){

	         echo "<option value=".$rowopor['idoppago'].">".$rowopor['desoppago']."</option> \n";
             }
	     ?>
                                              </select>
                                              </span></td>
                                              <td width="116" height="30" valign="top"><span class="titupatrimo">Origen de Fondos</span></td>
                                              <td width="191" height="30"><span class="titupatrimo">
                                                <!--<input name="ofpago" style="background:#FFFFFF" type="text" id="ofpago" size="20" />-->
                                                <input name="ofpago" type="text" id="ofpago" style="background:#FFFFFF" value="" size="30" />
                                              </span></td>
                                            </tr>
                                            <tr>
                                              <td height="30" rowspan="2" class="titupatrimo">&nbsp;</td>
                                              <td height="30" class="titupatrimo">&nbsp;</td>
                                              <td height="30"><span class="titupatrimo">
                                                <label></label>
                                                </span></td>
                                              <td height="30">&nbsp;</td>
                                              <td height="30"><span class="titupatrimo">
                                                <label></label>
                                              </span></td>
                                            </tr>
                                            <tr>
                                              <td height="30" class="titupatrimo">&nbsp;</td>
                                              <td height="30"><span class="titupatrimo">
                                                <input name="nregis" style="background:#FFFFFF" type="hidden" id="nregis" size="20" />
                                              </span></td>
                                              <td height="30">&nbsp;</td>
                                              <td height="30"><div id="gbruifp" style="display:;"><a href="#" onClick="grabaruifp()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></div>
                                                  <div id="edituifp" style="display:none;"><a href="#" onClick="editarruifp()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></div></td>
                                            </tr>
                                          </table>
                                      </div>
                                        <div id="vpago" style="display:none">
                                            <table width="700" border="0" cellspacing="0" cellpadding="0">
                                           <!-- <tr><td><a href="#" onClick="refreshvpago();">Nuevo</a>&nbsp;&nbsp;<a href="#" onClick="listavpago();">Listar</a></td></tr> -->
                                              <tr>
                                                <td><table width="705" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td height="19">&nbsp;</td>
                                                      <td width="148" height="30" align="center"><span class="titupatrimo">Forma de Pago</span></td>
                                                      <td width="236" height="30"><select name="fpago" id="fpago">
                                                        <?php
echo "<option value=''></option>";
	       while($rowfpago = mysql_fetch_array($sqlfpago)){

	         echo "<option value=".$rowfpago['id_fpago'].">".$rowfpago['descripcion']."</option> \n";
             }
	     ?>  
                                                      </select></td>
                                                      <td width="130" height="19"><span class="titupatrimo">Oport. de Pago</span></td>
                                                      <td width="176" height="19"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT oporpago.codoppago AS 'id', oporpago.desoppago AS 'des' 
FROM oporpago"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "130"; 
			$oCombo->name       = "idoppago";
			$oCombo->style      = ""; 
			$oCombo->click      = "eval_idoppago(this.value)";   
			$oCombo->selected   =  "seleccionar";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?><div id="div_otroidoppago" style="display:none; width:350px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 450px; top: 100px; z-index:200">
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="79">&nbsp;</td>
                                                                  <td width="269" align="right"><a href="#" onClick="ocultar_desc('div_otroidoppago')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>                                                                    Descripcion</td>
                                                                  <td><span class="titupatrimo">
                                                                    <input name="otroidoppago" style="background:#FFFFFF; text-transform:uppercase;" type="text" id="otroidoppago" size="35" />
                                                                  </span></td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="2">&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                          </div>                                                     </td>
                                                    </tr>
                                                   <!-- <tr>
                                                      <td height="19">&nbsp;</td>
                                                      <td height="30" align="center"></td>
                                                      <td height="30"><span class="titupatrimo">
                                                       <!-- <select name="fpago" id="fpago">
                                                          <option value="C">CONTADO</option>
                                                          <option value="P">PLAZO</option>
                                                        </select>-->
                                                      <!--</span></td>
                                                      <td height="30" class="titupatrimo">&nbsp;</td>
                                                      <td height="30">&nbsp;</td>
                                                    </tr>-->
                                                    <tr>
                                                      <td height="19">&nbsp;</td>
                                                      <td height="30" align="center"><span class="titupatrimo">Tipo de Acto:</span></td>
                                                      <td height="30"><div id="tpacto" style="display:"></div></td>
                                                      <td height="30" class="titupatrimo">

                                                      <div class="_fecminutaEval">Fecha Minuta</div></td>
                                                      <td height="30"><div class="_fecminutaEval"><label>
                                                        <input name="nnminuta" type="text" 
style="background:#FFFFFF" class="tcal" id="nnminuta" size="20" value="<?php echo date("d/m/Y"); ?>" />
                                                      </label><span style="color:#F00">*</span></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="15" height="30">&nbsp;</td>
                                                      <td height="30" align="center"><span class="titupatrimo">Importe de laTransaccion:</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="imptrans" type="text" id="imptrans" size="20" style="background:#FFFFFF" class="text" onKeyPress="return NumCheck(event, this);" />
                                                      </span><span style="color:#F00">*</span></td>
                                                      <td height="30"><span class="titupatrimo">Tipo Moneda</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <select name="tipomoneda" id="tipomoneda">
			 											   <option value="">VACIO</option>
                                                          <?php
	       while($rowmoneda = mysql_fetch_array($sqlmon)){

	         echo "<option value=".$rowmoneda['idmon'].">".$rowmoneda['desmon']."</option> \n";
             }
	     ?>
                                                        </select>
                                                      </span></td>
                                                    </tr>
                                                    <tr>
                                                      <td height="30">&nbsp;</td>
                                                      <td height="30" align="center"><span class="titupatrimo">Exhibio medio de pago</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <select name="exibio" id="exibio" >
                                                          <option selected="selected" value="SI">SI</option>
                                                          <option value="NO">NO</option>
                                                        </select>
                                                      </span></td>
                                                      <td height="30"><span class="titupatrimo">Tipo de Cambio</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <input name="tipcambio" style="background:#FFFFFF" type="text" id="tipcambio" size="20" onKeyPress="return NumCheck(event, this);" onkeyup="validar_tc(this.value)"/>
                                                      </span> <a href="http://www.sbs.gob.pe/principal/categoria/tipo-de-cambio/147/c-147" target="_blank" onClick="window.open(this.href,this.target,'width=400,height=400,top=200,left=200,toolbar=no,location=no,status=no,menubar=no');return false;">Consultar</a></td>
                                                    </tr>
                                                    <tr>
                                                      <td height="30" rowspan="2">&nbsp;</td>
                                                      <td height="30" align="center">&nbsp;</td>
                                                      <td height="30"><div id="ittmp"></div></td>
                                                      <td height="30"><div id="cumbral"></div></td>
                                                      <td height="0"><div id="gbrmp" style="display:"><a id="sp_grabmpago" href="#" onClick="grabarmediopago()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a>
                                                        <input type="hidden" name="idttiippooacto" id="idttiippooacto" />
                                                    </div>
                                                          <div id="editmp" style="display:none"><a href="#" onClick="editarmediopago()"><img src="iconos/grabarmodi.png" width="94" height="29" border="0" /></a></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td height="30" colspan="5"><div id="newpagoo" style="display:none;">
                                                          <table width="671" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                              <td width="101" height="34"><a id="_RegMedPago" href="#" onClick="mmmppp()"><img src="iconos/neww2.png" width="94" height="29" border="0" /></a></td>
                                                              <td width="570"><a href="#" onClick="mostrar_desc('listmedpago');ocultar_desc('regmedpago')"><img src="iconos/neww3.png" width="94" height="29" border="0" /></a></td>
                                                            </tr>
                                                            <tr>
                                            <td colspan="2"><div id="regmedpago" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 2px; top: 94px; height:235px;">
                                                      <table width="726" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30" colspan="3" class="Estilo23 Estilo43">Nuevo M. Pago/T. fondo</td>
                                                                      <td height="30"><table width="200" border="0" cellpadding="0" cellspacing="0">
                                                                  <tr>
                                                                            <td width="176">&nbsp;</td>
                                                                            <td width="24"><a href="#" onClick="ocultar_desc('regmedpago')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
                                                                        </tr>
                                                                      </table></td>
                                                                </tr>
                                                                <tr>
                                                                  <td width="15">&nbsp;</td>
                                                                  <td width="116" height="30"><span class="titupatrimo">M. Pago/T. fondo</span></td>
                                                                  <td width="270" height="30"><select name="mediopago" id="mediopago">
                                                                  <option value="0">SELECCIONAR</option>
                                                                        <?php
	       while($rowtpago = mysql_fetch_array($sqltpago)){

	         echo "<option value=".$rowtpago['codmepag'].">".$rowtpago['sunat'].' - '.$rowtpago['desmpagos']."</option> \n";
             }
	     ?>
                                                                    </select>                                                                      </td>
                                                                  <td width="119" height="30"><span class="titupatrimo">Importe M. Pago/T. fondo</span></td>
                                                                  <td width="206" height="30"><span class="titupatrimo">
                                                                    <label></label>
                                                                      <input name="impmediopago" style="background:#FFFFFF" type="text" id="impmediopago" size="20" onKeyPress="return NumCheck(event, this);" />
                                                                  </span></td>
                                                                </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Entidad Financiera</span></td>
                                                                      <td height="30"><select name="entidadfinanciera" id="entidadfinanciera">
                                                                      <option value="0" selected="selected">SELECCIONAR </option>
                                                                        <?php
	       while($rowbanco = mysql_fetch_array($sqlbancos)){

	         echo "<option value=".$rowbanco['idbancos'].">".$rowbanco['desbanco']."</option> \n";
             }
	     ?>
                                                                      </select></td>
                                                                      <td height="30" class="titupatrimo">Fecha de Operación</td>
                                                                      <td height="30"><label><span class="titupatrimo">
                                                                      <input name="fechaoperacion" style="background:#FFFFFF" type="text" id="fechaoperacion" class="tcal" size="20" />
                                                                      </span></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Tipo Moneda</span></td>
                                                                    <td height="30"><select name="idmon_mp" id="idmon_mp">
			 														  <option value="0">VACIO</option>
                                                                      <option value="1">SOLES</option>
                                                                      <option value="2" selected="selected">DOLARES N.A.</option>
                                                                      <!--<option value="3">EUROS</option>-->
                                                                    </select></td>
                                                                      <td height="30">&nbsp;</td>
                                                                      <td height="30">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Documentos</span></td>
                                                                      <td height="30" colspan="2"><span class="titupatrimo">
                                                                        <input name="documentos" style="background:#FFFFFF; text-transform:uppercase;" type="text" id="documentos" size="50" />
                                                                      </span></td>
                                                                      <td height="30"><span class="titupatrimo"><a id="_saveNewMedPago" href="#"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></span></td>
                                                                    </tr>
                                                              </table>
                                                              </div>
                                                            <div id="listmedpago" style="display:none; width:680px; height:100px; overflow:auto;"></div>
                                                            <!-- DIV ACTUALIZAR MEDIO DE PAGO -->
                                                            <div id="vermediopagoedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div>                                                            </td>
                                                            </tr>
                                                          </table>
                                                      </div></td>
                                                    </tr>
                                                </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                            </table>
                                        </div>
                                        <div id="vbien" style="display:none">
                                            <table width="710" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18">&nbsp;</td>
                                                <td width="692"><img src="iconos/biennes.png" alt="" width="181" height="25" border="0" usemap="#Map2" /></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newbiennnes" style="display:none">
                                                  <table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                      </tr>
                                                      <tr>
                                                        <td width="135" height="30"><span class="titupatrimo">Tipo</span></td>
                                                        <td width="208" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                          <label>
                                                          <select name="tipob" id="tipob">
                                                            <option value="" selected="selected">SELECCIONAR </option>
                                                            <option value="BIENES">BIENES</option>
                                                            <option value="ACCIONES Y DERECHOS">ACCIONES Y DERECHOS</option>
                                                          </select>
                                                          </label>
                                                        </span></td>
                                                        <td width="118" height="30"><span class="titupatrimo">Partida Registral</span></td>
                                                        <td width="219" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                        <input name="pregis" style="background:#FFFFFF" type="text" id="pregis" size="20" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Bien-Acto Jurídico</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <label></label>
                                                          <select name="tipobien" id="tipobien" onChange="enviarvalores(this.value)">
                                                          <option value="" selected="selected">SELECCIONAR </option>
                                                            <?php
	       while($rowtbien = mysql_fetch_array($sqltbienn)){
	         echo "<option value=".$rowtbien['idtipbien'].">".$rowtbien['desestcivil']."</option> \n";
             }
	     ?>
                                                          </select>
                                                        </span>
                                                        <a href="#" id="linkactivaotrobienn" style="display:none" onClick="activaotrobienn()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>
         <a href="#" id="linkactivaotrobienvn"  style="display:none" onClick="activaotrobienvn()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>
          <a href="#" id="linkactivaotrobienmn" style="display:none" onClick="activaotrobienmn()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>                                                        </td>
                                                        <td height="30"><span class="titupatrimo">Sede Registral</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <select name="idsedereg2" id="idsedereg2">
                                                          <option value="" selected="selected">SELECCIONAR </option>
                                                            <?php
	       while($rowsedess = mysql_fetch_array($sqlsedess)){
	         echo "<option value=".$rowsedess['idsedereg'].">".$rowsedess['dessede']."</option> \n";
             }
	     ?>
                                                          </select>
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Ubigeo</span></td>
                                                        <td height="30" colspan="2"><input name="ubigens" type="text" id="ubigens" style="background:#FFFFFF" size="45" readonly="" /><span style="color:#F00"></span></td>
                                                        <td height="30"><a id="_clickBuscaUbis" href="#" onClick="mostrar_desc('div_buscaubis')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
                                                            <div id="div_buscaubis" style="position:absolute; display:none; width:637px; height:223px; left: 14px; top: 162px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="24" height="29">&nbsp;</td>
                                                                  <td width="585" class="titupatrimo">Seleccionar Ubigeo:</td>
                                                                  <td width="28"><a id="_CloseDivUbi" href="#" onClick="ocultar_desc('div_buscaubis')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td><label>
                                                                    <input name="buscaubis" type="text" style="background:#FFFFFF; text-transform:uppercase;" id="buscaubis" size="60" onKeyUp="buscaubigeoss()" />
                                                                  </label></td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td><div id="resulubis" style="width:585px; height:150px; overflow:auto"></div></td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                            </div>
                                                          <input name="codubis" type="hidden" id="codubis" size="15" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"><span class="titupatrimo">Fecha de Adq. o Cons.</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                          <label>
                                                          <input type="text" name="fechaconst" style="background:#FFFFFF" class="tcal" id="fechaconst" readonly="" />
                                                          </label>
                                                        </span><span style="color:#F00"></span></td>
                                                        <td height="30" align="center">&nbsp;</td>
                                                        <td height="30"><a id="_saveNewBien" href="#"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"><div id="vterrestres" style="display:none; width:691px; height:83px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 21px; top: 250px;">
                                                            <table width="671" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td width="26" >&nbsp;</td>
                                                                <td width="118">&nbsp;</td>
                                                                <td width="138">&nbsp;</td>
                                                                <td width="135">&nbsp;</td>
                                                                <td width="254" align="right"><a href="#" onClick="ocultar_desc('vterrestres')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                              </tr>
                                                              <tr>
                                                                <td><label></label></td>
                                                                <td class="titupatrimo"><input type="radio" name="radio3" id="radio3" value="P" onClick="selecpsm(this.value)" />
                                                                  N° de Placa </td>
                                                                <td class="titupatrimo"><input type="radio" name="radio3" id="radio4" value="S" onClick="selecpsm(this.value)" />
                                                                  N° de Serie</td>
                                                                <td class="titupatrimo"><input type="radio" name="radio3" id="radio5" value="M" onClick="selecpsm(this.value)" />
                                                                  N° de Motor</td>
                                                              <td><label>
                                                                  <input class="text" type="text" name="npsm" style="background:#FFFFFF;text-transform:uppercase;" id="npsm" />
                                                                </label></td>
                                                              </tr>
                                                              <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td><label>
                                                                  <input type="hidden" name="tpsm" id="tpsm" />
                                                                </label></td>
                                                              </tr>
                                                            </table>
                                                        </div>
                                                            <div id="mequipos" style="display:none; width:674px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 25px; top: 250px; z-index:2000;">
                                                              <table width="661" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32">&nbsp;</td>
                                                                  <td width="101">&nbsp;</td>
                                                                  <td width="128">&nbsp;</td>
                                                                  <td width="55">&nbsp;</td>
                                                                  <td width="345" align="right"><a href="#" onClick="ocultar_desc('mequipos')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td><label></label></td>
                                                                  <td colspan="3" align="center" class="titupatrimo"> N° de Serie para Maquinaris y Equipos</td>
                                                                  <td>
                                                                    <input class="text" type="text" name="smaquiequipo" style="text-transform:uppercase;background:#FFFFFF;" id="smaquiequipo" />                                                                 </td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                            </div>
                                                          <div id="oespecificos" style="display:none; width:652px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 23px; top: 250px; z-index:2000;">
                                                              <table width="629" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="69">&nbsp;</td>
                                                                  <td width="55">&nbsp;</td>
                                                                  <td width="120">&nbsp;</td>
                                                                  <td width="190">&nbsp;</td>
                                                                  <td width="195" align="right"><a href="#" onClick="ocultar_desc('oespecificos')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td><label></label></td>
                                                                  <td colspan="3" align="center" class="titupatrimo"> Detalle del bien materia del acto juridico</td>
                                                                  <td><label>
                                                                    <input class="text" type="text" name="oespecific" style=" text-transform:uppercase;background:#FFFFFF;" id="oespecific" />
                                                                  </label></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                          </div>
														
<div id="predio1" style="display:none; width:650px; height:450px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 23px; top: -10px; z-index:2000;">                          
      <table >
          <thead>
            <tr>
              <td width="69">&nbsp;</td>
              <td colspan="3"  class="titupatrimo">DATOS DEL PREDIO</td>
            
              <td width="195" align="right"><a href="#" onClick="ocultar_desc('predio1')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
            </tr>
          </thead>
          <tbody>
              
              <tr>
				<td class="titupatrimo">TIPO DE ZONA</td>
				<td colspan="3" class="titupatrimo">
					<select name="txtTipoZonaPredio" id="txtTipoZonaPredio">
						<option value="0" selected>.::Seleccione::.</option>
						<option value="URB.">URBANIZACION</option>
						<option value="BAR.">BARRIO</option>
						<option value="VLL.">VILLA</option>
					</select>			
				</td>  
              </tr>
              <tr>
              	<td class="titupatrimo">ZONA</td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtZonaPredio" name="txtZonaPredio"></td>  
              </tr>
              <tr>
              	<td class="titupatrimo">DENOMINACION</td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtDenominacionPredio" name="txtDenominacionPredio"></td>  
              </tr>
			  <tr>
			  	<td class="titupatrimo" width="200px">TIPO DE VIA *</td>
                <td class="titupatrimo">
					<select name="txtTipoViaPredio" id="txtTipoViaPredio">
						<option value="0" selected>.::Seleccione::.</option>
						<option value="AV.">AVENIDA</option>
						<option value="JR.">JIRON</option>
						<option value="CAL.">CALLE</option>
						<option value="PQ.">PARQUE</option>
						<option value="CAR.">CARRETERA</option>
						<option value="PRO.">PROLONGACION</option>
						<option value="PJ.">PASAJE</option>
						<option value="PZA.">PLAZA</option>
						<option value="GAL.">GALERIA</option>
						<option value="ALM.">ALAMEDA</option>
						<option value="BLV.">BULEVAR</option>
						<option value="BL.">BLOQUE</option>
						<option value="MLC.">MALECON.</option>
						<option value="VIA.">VIA.</option>
						<option value="OVL.">OVALO.</option>
					</select>			
				</td>
			  </tr>
              <tr>
              	<td class="titupatrimo">NOMBRE DE VIA </td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtNombreViaPredio" name="txtNombreViaPredio"></td>
				   
              </tr>
			  
              <tr>
                <td class="titupatrimo">NUMERO</td>
                <td class="titupatrimo"><input type="text" id="txtNumeroPredio" style="background:white" name="txtNumeroPredio"></td>
				<td class="titupatrimo">MANZANA</td>
                <td class="titupatrimo"><input type="text" id="txtManzanaPredio" style="background:white" name="txtManzanaPredio"></td>                             
              </tr>
			  <tr>
			  	<td class="titupatrimo">LOTE</td>
                <td class="titupatrimo"><input type="text" id="txtLotePredio" style="background:white" name="txtLotePredio"></td>
              </tr>
			  <tr>
			  		<td class="titupatrimo">&nbsp;</td>
					  <td class="titupatrimo"><a href="#" onclick="get_predios(null)"><img src="iconos/buscarclie.png" width="94" height="29" border="0" /></a></td>
					  <td class="titupatrimo">&nbsp;</td>
				  	<td class="titupatrimo"><a href="#" onclick="set_predios(document.getElementById('codkardex').value)"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
              </tr>
          </tbody>
      </table>
      <table border="1" style="width:98%; border-radius:5px;margin:5px;font-size:.9em" cellspacing="0" cellpadding="0">
          
          <thead>
              <tr>
                <td class="titupatrimo">N°</td>
                <td class="titupatrimo">TIPO DE ZONA</td>
                <td class="titupatrimo">ZONA</td>
                <td class="titupatrimo">DENOMINACION</td>
                <td class="titupatrimo">TIPO DE VIA</td>
                <td class="titupatrimo">NOMBRE DE VIA</td>
                <td class="titupatrimo">NUMERO</td>
                <td class="titupatrimo">MANZANA</td>
                <td class="titupatrimo">LOTE</td>
              </tr>
          </thead>
          <tbody id="tblPredios" class="text-center" style="background:white;font-size:.83em">

          </tbody>
      </table>
</div>														
														
														
														</td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15">&nbsp;</td>
                                                      </tr>
                                                  </table>
                                      </div>
                                                    <div id="listbiennes" style="display:"></div></td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="verbienesedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx" type="hidden" id="detbienx" />
                                              </tr>
                                            </table>
                                      </div>
                                      <div id="vvehicular" style="display:none">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18">&nbsp;</td>
                                                <td width="692"><a id="_newVehiculo" onClick="agregarVehiculo();" href="#"><img src="iconos/biennesnew.png" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a id="_listVehiculo" onClick="listarVehiculos();" href="#"><img src="iconos/bienneslist.png" border="0" /></a></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newvehiculo" style="display:none">
                                                  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19" align="right"><span class="titupatrimo">Tipo: </span></td>
                                                        <td height="19"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT det_placa.id_placa AS 'id', det_placa.descripcion AS 'des'
FROM det_placa"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "100"; 
			$oCombo->name       = "idplacav";
			$oCombo->style      = ""; 
			$oCombo->click      = "isConsultSunarp()";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?><!--<input name="idplacav" type="text"  id="idplacav" style="background:#FFFFFF" size="1" maxlength="2" />--></td>
                                                        <td height="19" align="right"><span class="titupatrimo">Carroceria :</span></td>
                                                        <td height="19"><input name="carroceriav" type="text"  id="carroceriav" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td width="246" height="30" align="right"><span class="titupatrimo">N. Placa / Poliza :</span></td>
                                                        <td width="252" height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="numplacav" type="text"  id="numplacav" size="15" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" />
                                                        <span style="color:#F00">*</span>
                                                        <!-- <a href="javascript:;" id="btn-consult-sunarp" onclick="consultSunarp()" style="display:none;"><img src="iconos/buscarclie.png" width="72" height="29" border="0"></a> -->
														<a href="javascript:;" id="btn-consult-sunarp" onclick="consultar_placa()" style="display:none;"><img src="iconos/buscarclie.png" width="72" height="29" border="0"></a>
                                                        </span></td>
                                                        <td width="186" height="30" align="right"><span class="titupatrimo">Color :</span></td>
                                                        <td width="563" height="30"><span class="titupatrimo">
                                                          <input name="colorv" type="text"  id="colorv" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30" align="right"><span class="titupatrimo">Clase :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="clasev" type="text"  id="clasev" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Motor :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input name="motorv" type="text"  id="motorv" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" />
                                                        <span style="color:#F00">*</span></span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30" align="right"><span class="titupatrimo">Marca :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="marcav" type="text"  id="marcav" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Cilindros :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <input name="numcilv" type="text"  id="numcilv" style="background:#FFFFFF" size="5" maxlength="3" class="text" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Año Fabric.:</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                        <input name="anofabv" type="text"  id="anofabv" style="background:#FFFFFF" size="10" maxlength="10" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Serie Nro.:</span></td>
                                                        <td height="30"></span><span class="titupatrimo">
                                                        <input name="numseriev" type="text"  id="numseriev" style="background:#FFFFFF" maxlength="20" class="text" />
                                                        </span></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Modelo :</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <input name="modelov" type="text"  id="modelov" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Ruedas :</span></td>
                                                        <td height="30"><input name="numruedav" type="text"  id="numruedav" style="background:#FFFFFF" size="5" maxlength="3" class="text" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Combustible :</span></td>
                                                        <td height="15"><input name="combustiblev" type="text"  id="combustiblev" style="background:#FFFFFF; text-transform:uppercase;" maxlength="20" class="text" /></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Fec. Inscrip:</span></td>
                                                        <td height="30"><input name="fecinscv" type="text"  class="tcal" id="fecinscv" style="background:#FFFFFF" size="10" maxlength="15" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Partida Registral:</span></td>
                                                        <td height="15"><input type="text" size="20" id="pregis_vehi" style="background:#FFFFFF; text-transform:uppercase;" name="pregis_vehi" class="text" maxlength="50"></td>
                                                        
                                                        <td height="30" align="right"><span class="titupatrimo">Sede Registral:</span></td>
                                                        <td height="30"><select name="idsedereg2_vehi" id="idsedereg2_vehi">
                                                          <option value="" selected="selected">SELECCIONAR </option>
                                                            <?php
	       															while($rowsedess_vehi = mysql_fetch_array($sqlsedess_vehi)){
															         echo "<option value=".$rowsedess_vehi['idsedereg'].">".$rowsedess_vehi['dessede']."</option> \n";
														             }
														     ?>
                                                          </select></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"></td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15"><a href="#" onClick="gbvehicular()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" />
                                                          <input name="idtipactov" type="hidden" id="idtipactov" />
                                                        <span class="titupatrimo">
                                                          <input name="codmepagv" type="hidden"  id="codmepagv" />
                                                        <input name="preciov" type="hidden"  id="preciov"  value="0.00" />
                                                        <input name="idmonv" type="hidden"  id="idmonv" />
                                                        <input name="detvehx" type="hidden" id="detvehx"  />
                                                        </span></a></td>
                                                      </tr>
                                                  </table>
</div>                                                    </td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="vervehiedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx" type="hidden" id="detbienx" />
                                              </tr>
                                              <tr>
                                              	<td colspan="2"><div id="listvehiculos" style="display:none">Listado de Vehiculos</div>                                              	</td>
                                              </tr>
                                            </table>
                                      </div>                                      </td>
                                  </tr>
                                </table>
                              </div>
                              <!-- EDICION DE DATOS DEL PATRIMONIAL -->
                              <div id="editpatrimonio" style="display:none"></div>
                              <!-- ################################ -->
                              
                              <!-- LISTADO DE PATRIMONOS --> 
                                  <div id="listpatrimonio" style="display"></div></td>
                            </tr>
                          </table>
                      </div>
                    <div id="mantecontra" style="position:absolute; display:none; width:740px; height:250px; left: 52px; top: 348px; z-index:16; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                          <table width="734" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="19" height="28">&nbsp;</td>
                              <td width="583" class="Estilo42">Editar Contratante</td>
                              <td width="108">&nbsp;</td>
                              <td width="24"><a onClick="limpiaredit();ocultar_desc('mantecontra')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td height="185">&nbsp;</td>
                              <td colspan="2"><div id="rptaedit" style=" height:180px; overflow:auto;"></div></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="33">&nbsp;</td>
                              <td><div id="msjee"></div></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                      </div>
                      <div id="editmrrpp" style="position:absolute; display:none; width:740px; height:272px; left: 54px; top: 337px; z-index:15; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="740" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="23" height="26">&nbsp;</td>
      <td width="273" class="Estilo15">Editar  Movimientos RR. PP</td>
      <td width="148">&nbsp;</td>
      <td width="268"><label></label></td>
      <td width="28"><a href="#" onClick="ocultar_desc('editmrrpp')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td colspan="3" rowspan="8" valign="top"><div id="edirrpp"></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="103">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
           <div id="newmrrpp" style="position:absolute; display:none; width:740px; height:360px; left: 50px; top: 385px; z-index:15; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">

                          <table width="740" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="23" height="26">&nbsp;</td>
                              <td width="273" class="Estilo15">Ingreso de Movimientos RR. PP</td>
                              <td width="148">&nbsp;</td>
                              <td width="268"><label>
                                <input name="conestado" type="hidden" id="conestado" value="P" size="10" />
                              </label></td>
                              <td width="28"><a href="#" onClick="ocultar_desc('newmrrpp')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td height="19">&nbsp;</td>
                              <td colspan="3" rowspan="8">

                              <table width="678" border="0" cellspacing="0" cellpadding="0">

                                  <tr>
                                    <td width="101" height="30" class="camposss">Fecha</td>
                                    <td width="170" height="30" class="camposss"><label>
                                      <input name="fechamov" id="fechamov" type="text"  class="tcal" size="20" style="background:#FFFFFF" value="<?php echo date("d/m/Y"); ?>"  onclick="aumenta2();" onChange="aumenta2();" readonly onBlur="aumenta2();" onMouseOut="aumenta2();" onKeyUp="aumenta2();" onMouseOver="aumenta2();"  />
                                    </label></td>
                                    <td width="94" height="30" class="camposss">Vencimiento</td>
                                    <td width="313" height="30"><label>
                                      <input name="vencimiento" readonly class="tcal" type="text" id="vencimiento"  size="20" style="background:#FFFFFF"  />
                                    </label></td>
                                  </tr>



                                  <tr>

                                  <td height="30" class="camposss">Titulo en RR.PP</td>
                                    <td height="30" class="camposss">
                                        <label>
                                          <input name="titulorp" type="text" id="titulorp" size="25" style="background:#FFFFFF" />
                                        </label>
                                    </td>
                                    


                                    <td height="30" class="camposss">Tramite</td>
                                    <td height="30"><select name="idtiptraoges" id="idtiptraoges">
                                    <option value="" selected="selected">SELECCIONAR</option> 
                                        <?php
									       while($rowstra = mysql_fetch_array($sqltra)){
									         echo "<option value=".$rowstra['idtiptraoges'].">".$rowstra['desctiptraoges']."</option> \n";
								             }
	  							   ?>
                                    </select>
                                    </td>
                                  </tr>



                                  <tr>

                                  <td height="30" class="camposss">Oficina Registral</td>
                                    <td height="30" class="camposss"><select name="idsedereg" id="idsedereg">
                                       <option value="" selected="selected">SELECCIONAR</option> 
                                        <?php
									       while($rowsede = mysql_fetch_array($sqlsede)){
									         echo "<option value=".$rowsede['idsedereg'].">".$rowsede['dessede']."</option> \n";
								             }
	    							 ?>
                                    </select></td>
                                    
                                    <td height="30" class="camposss">N° Partida</td>
                                    <td width="270">
                                            <label>
                                              <input type="text" name="numeroPartida" style="background:#FFF;" id="numeroPartida" />
                                            </label>
                                    </td>

                                  </tr>

                                  <tr>

                                  	<td height="30" class="camposss">Sección Registro</td>
                                    
                                    <td height="30" class="camposss">
	                                    <select name="idsecreg" id="idsecreg">
		                                    <option value="" selected="selected">SELECCIONAR</option> 
		                                     <?php
										       while($rowsec = mysql_fetch_array($sqlsec)){
										         echo "<option value=".$rowsec['idsecreg'].">".$rowsec['dessecc']."</option> \n";
									             }
			     							?>
	                                    </select>
                                    </td>
                                   <!--<td height="30" class="camposss">N° de Titulo</td>
                                    <td height="30" class="camposss">
                                        <input name="numeroTitulo"  type="hidden" id="numeroTitulo" size="15" style="background:#FFFFFF;"  />
                                    	
                                    </td>-->
                                    <td height="30" class="camposss">Asiento</td>
                                    <td width="270">
                                      <label>
                                     	  <input type="text" name="asiento" id="asiento" style="background:#FFF;" />
                                      </label>
                                    </td>


                                  </tr>



                                  <tr>

                                   
                                    <td height="30" class="camposss">Estado</td>
                                    <td height="30" class="camposss"><select name="idestreg" id="idestreg" onChange="estadorrpp(this.value)">
                                    <option value="" selected="selected">SELECCIONAR</option> 
                                      <?php
                                	       while($rowestreg = mysql_fetch_array($sqlestra)){
                                	         echo "<option value=".$rowestreg['idestreg'].">".$rowestreg['desestreg']."</option> \n";
                                             }
	                                   ?>
                                    </select>
                                    <input name="codusuario" type="hidden" id="codusuario" value="<?php echo $_SESSION["id_usu"]; ?>" size="15" />
                                    </td>


                                    <td height="30" class="camposss">Importe</td>
                                   	<td height="30">

                                   		<input name="importee" type="text" id="importee" size="15" style="background:#FFFFFF;" onKeyUp="return validacion(this.value)" />
                                    </td>

                                  </tr>


                                  <tr>
                                  	 
                                  	<td height="30" class="camposss">Encargado</td>
                                    <td height="30" class="camposss">
                                        <label>
                                          <input type="text" style="background:#FFFFFF" readonly name="encargado" value="<?php echo $rowwuser["prinom"]." ".$rowwuser["segnom"]." ".$rowwuser["apepat"]." ".$rowwuser["apemat"];
    	   ?>" id="encargado" />
                                        </label>
                                    </td>



                                    <td height="30" class="camposss">Recibo</td>
                                    <td height="30">
                                          <input name="recibo" type="text" id="recibo" size="15" style="background:#FFFFFF;"/>
                                    </td>
                                  </tr>




                                  <tr>
                                  	<td width="101" height="30" class="camposss">Fecha de Insc.</td>
                                    <td width="170" height="30" class="camposss"><label>
                                      <input name="fechaInscripcion" id="fechaInscripcion" type="text"  class="tcal" size="20" style="background:#FFFFFF" value="<?php echo date("d/m/Y"); ?>"  onclick="aumenta2();" onChange="aumenta2();" readonly onBlur="aumenta2();" onMouseOut="aumenta2();" onKeyUp="aumenta2();" onMouseOver="aumenta2();"  />
                                    </label></td>
                                    <td height="30" class="camposss">Observacion</td>
		                             <td height="30" rowspan="2">
                                        <label>
      		                                  <textarea name="observa" style="background:#FFFFFF; text-transform:uppercase;" id="observa" cols="40" rows="3"></textarea>
      		                             	</label>
		                            </td>


                                  </tr>

                                  <tr>
                                    <td height="30" class="camposss">Anotacion</td>
                                    <td height="30" class="camposss">
                                        <label>
                                          <input name="anotacion" type="text" id="anotacion" size="25" style="background:#FFFFFF" />
                                        </label>
                                    </td>
                                    <td colspan="2"></td>
                                   
                                  </tr>


                                  <tr>
                                    <td height="30" class="camposss">Registrador</td>
                                    <td height="30" colspan="3" class="camposss">
                                    <table width="564" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="120"><input name="registrador" type="text" id="registrador" size="40" style="background:#FFFFFF; text-transform:uppercase;" /></td>
                                          <td></td>
                                        </tr>
                                      </table>
                                        <label>
                                        	
                                        </label>

                                     </td>

                                  </tr>


                              </table>
                              <a href="#" onClick="validanewmovreg()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a>
                               <input type="hidden" name="action" id="action" value="1">
                              </td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="19">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>      


                      </div>
                      <div id="formurent" style="position:absolute; display:none; width:740px; height:134px; left: 49px; top: 423px; z-index:14; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                      <table width="740" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10" height="31">&nbsp;</td>
                              <td colspan="2" class="Estilo31"><span class="style1">Ingrese Formulario</span></td>
                              <td width="361" class="style2">Formularios</td>
                              <td width="41" class="style2"><a href="#" onClick="ocultar_desc('formurent')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                            </tr>
                            <tr>
                              <td rowspan="3">&nbsp;</td>
                              <td width="183" height="31" class="Estilo31">N° Op. Sunat /N° de Orden</td>
                            <td width="145"><label>
                                <input type="text" name="numformu" style="background:#FFFFFF" id="numformu" />
                              </label></td>
                              <td colspan="2" rowspan="3" valign="top"><table width="374" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="374"><table width='350' border='1' bordercolor="#333333" cellspacing='0' cellpadding='0'>
                                    <tr>
                                      <td width='200' class="Estilo15" >N° Op. Sunat/N° Orden</td>
                                      <td width='123' class="Estilo15" >Monto</td>
                                      <td width='19' >&nbsp;</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td><div id="listform" style="width:400px; height:70px; overflow:auto;"></div></td>
                                </tr>
                              </table></td>
                          </tr>
                            <tr>
                              <td height="34" class="Estilo31">Monto</td>
                              <td><input type="text" name="monto" style="background:#FFFFFF" id="monto" /></td>
                            </tr>
                            <tr>
                              <td class="Estilo31">&nbsp;</td>
                              <td><a href="#" onClick="grabarformulario()" ><img src="iconos/grabar.png" width="94" height="29" border="0" /></a><input name='idrentas' id='idrentas' type='hidden' /></td>
                            </tr>
                        </table>
                      </div>
                    <div id="preguntas" style="position:absolute; display:none; width:740px; height:150px; left: 48px; top: 322px; z-index:13; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                          <table width="740" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="19" height="26">&nbsp;</td>
                              <td width="690" class="camposss"><strong>Datos de Renta<span class="Estilo31">
                                <input type="hidden" name="idcontratantee" id="idcontratantee" />
                              </span></strong></td>
                              <td width="31" class="camposss"><a onClick="ocultar_desc('preguntas')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="2"><div id="formu_rent"></div></td>
                            </tr>
                            <tr>
                              <td colspan="3">&nbsp;</td>
                            </tr>
                          </table>
                      </div>
                      <div id="uifpdtparticip" class="uifpdtparticip1" style="display:none; z-index:6;">
                          <table width="816" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10" height="29">&nbsp;</td>
                              <td colspan="2" class="editcampp">UIF - PDT Participa
                              <input type="hidden" name="xasignaitem" id="xasignaitem" />
                              <input type="hidden" name="xasignacondi" id="xasignacondi" />
                              <input type="hidden" name="xasignavalor" id="xasignavalor" />
                              <input type="hidden" name="opagovalor" id="opagovalor" />
                              <input type="hidden" name="opagotitle" id="opagotitle" />
                              
                              <input type="hidden" name="fondovalor" id="fondovalor" />
                              <input type="hidden" name="fondotitle" id="fondotitle" />
                              
                              <input type="hidden" name="xasignaid" id="xasignaid" /></td>
                              <td width="26"><a  onclick="ocultar_desc('uifpdtparticip')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td colspan="3"><div id="centraluif" style="width:720px; height:270px; overflow:auto"><table width="1094" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td width="900"><table width="1000" bgcolor="#999999" borde	r="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
              <th width="160"><div style="width:160px; height:auto; border:0px;"><span class="Estilo15">ACTO</span></div></th>
        <th width="120"><div style="width:120px; height:auto; border:0px;"><span class="Estilo15">CONTRATANTE</span></div></th>
        <th width="210"><div style="width:210px; height:auto; border:0px;"><span class="Estilo15">CONDICION</span></div></th>
        <th width="80"><div style="width:80px; height:auto; border:0px;"><span class="Estilo15">PORCENTAJE</span></div></th>
        <th width="30"><div style="width:30px; height:auto; border:0px;"><span class="Estilo15">UIF</span></div></th>
        <th width="72"><div style="width:72px; height:auto; border:0px;"><span class="Estilo15">RENTA</span></div></th>
        <th width="73"><div style="width:73px; height:auto; border:0px;"><span class="Estilo15">MONTO</span></div></th>
        <th width="172"><div style="width:172px; height:auto; border:0px;"><span class="Estilo15">ORIGEN DE LOS FONDOS</span></div></th>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="220"><div id="asigna" class="asigna"> </div></td>
  </tr>
</table></div></td>
                            </tr>
                            <tr>
                              <td height="26">&nbsp;</td>
                              <td width="64"><input type="button" name="button4" id="button4" value="Generar" onClick="mostraruifpdtasigna()" /></td>
                              <td width="716"><div id="hjpt" style="font-family:Verdana, Geneva, sans-serif; color:#F90; font-size:11px; display:;"></div><div id="hjpt2" style="font-family:Verdana, Geneva, sans-serif; color:#F90; font-size:11px"></div></td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                      </div>
                      <div id="clienbus" class="clienbus1" style="display:none; z-index:7;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="editcampp">Agregar Contrante</td>
                              <td width="35"><a id="clieee"  onclick="ocultar_desc('clienbus');format();"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="26" bgcolor="#CCCCCC">&nbsp;</td>
                                    <td width="204" bgcolor="#CCCCCC"><div id="cbopersonas"></div></td>
                                    <td width="165" bgcolor="#CCCCCC"><div id="tipodocuR"></div></td>
                                    <td width="202" align="right" bgcolor="#CCCCCC"><input name="numdoc" type="text" id="numdoc" style="background:#FFF"  maxlength="11" /></td>
                                    <td width="127" align="center" bgcolor="#CCCCCC"><a id="_btn_buscaPersona"  onclick="evalDocumento()"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                                </tr>
                                <!-- RENIEC - SUNAT -->
                                <tr>
                               		 <td bgcolor="#CCCCCC" >&nbsp;</td>
                                	<td bgcolor="#CCCCCC" ><input type="text" name="" id="txtImageCaptcha" placeholder="CÓDIGO DE LA IMAGEN" style="background:#FFF;display:none;text-transform:uppercase;"></td>
                                	<td bgcolor="#CCCCCC"><img id="imgCaptchaReniec" style="width:125px;height:40px;display:none;" src="">
                                	<img id="imgCaptchaSunat" style="width:80px;height:40px;display:none;" src="">
                                	</td>
                                	<td bgcolor="#CCCCCC" >
                                	<!--<a id="btnRefreshCaptchaReniec" href="javascript:;">Refrescar Codigo</a>-->
                                	</td>
                                	<td bgcolor="#CCCCCC"></td>
                                </tr>
                                <!-- FIN RENIEC SUNAT -->
                                  <tr>
                                    <td height="47" colspan="5" bgcolor="#CCCCCC"><table width="675" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="333"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">Busqueda por Nombre, Apellidos / Razon Social</span></td>
                                        <td width="270"><input name="buscanombemp" type="text" id="buscanombemp" onClick="limpiarnumedoc();" style="text-transform:uppercase; background:#FFF" size="40" /></td>
                                        <td width="72"><a  onclick="evalDocumentorctm()"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td height="54" colspan="5" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:300px; overflow:auto"> </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table>
                      </div>
                      <div id="clienedit" class="clienedit1" style="display:none; z-index:8;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="editcampp">Mantenimiento Contrantes</td>
                              <td width="35"><a  onclick="oculistedi()"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="18"><label>
                                      <input type="hidden" name="idcontra" id="idcontra" />
                                    </label></td>
                                  </tr>
                                  <tr>
                                    <td height="54"><div id="manclie" style=" width:720px; height:240px; overflow:auto"> </div></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                      </div>
                      <div id="tabsss" style="display:none; z-index:1;">
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
                          <table width="755" border="0" cellspacing="0" cellpadding="0">
						  
						  
						  
                          <tr>
                              <td width="106" align="right" class="camposss">Kardex Conexo&nbsp;&nbsp;</td>
                              <td width="186"><input name="kardexconexo" type="text" id="kardexconexo" size="30" maxlength="10"  /></td>
                              <td width="6" align="right" class="camposss"></td>
                              <td width="60" align="right" class="camposss">Notaria&nbsp;&nbsp;</td>
                              <td width="166"><label>
                              <select name="idnotario" id="idnotario" style="background:#FFF;">
                                <option value="0">SELECCIONE NOTARIA</option>
                                
                                <?php
			 while($row2=mysql_fetch_array($not)){
		  echo "<option value = ".$row2["idnotario"].">".$row2["descon"].
		  "</option>";  
		  }
		?>
                              </select>
                              </label></td>
                              <td width="228"><input type="button" name="button" id="button" value="Grabar Cambios" onClick="actkardex()" /></td>
                            </tr>
							
							
							
							
							
							
                            <tr>
                              <td colspan="6">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="6"><ul class="tabs">
                                  <li><a onclick="ocultarDigitacion()" href="#tab1">Contratantes</a></li>
                                <li><a onclick="ocultarDigitacion()" href="#tab3">Facturación</a></li>
                                <li><a onclick="listarescrituraciondocs()" href="#tab8">Digitación</a></li>
                                <li><a onClick="ocultarDigitacion();label_escri();" href="#tab4">Escrituración</a></li>
                                <li><a onclick="ocultarDigitacion()" href="#tab6">Registros Públicos</a></li>
                                <li><a onclick="ocultarDigitacion()" href="#tab7">Otras Especificaciones</a></li>
                              </ul>
                                  <div class="Contenedor1">
                                    <div id="tab1" class="Contenido">
                                      <table width="739" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="730" height="15"><table width="700" border="1" bordercolor="#666666" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="234" bgcolor="#264965"><span class="btnpatrimonial">CONTRATANTES</span></td>
                                                <td width="154" align="center" bgcolor="#264965"><span class="btnpatrimonial">CONDICION</span></td>
                                                <td width="64" align="center" bgcolor="#264965"><span class="btnpatrimonial">FIRMA</span></td>
                                                <td width="97" align="center" bgcolor="#264965"><span class="btnpatrimonial">FECHA FIRMA</span></td>
                                                <td width="139" bgcolor="#264965"><span class="btnpatrimonial">RESPONSABLE</span></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="43" ><div id="contratantes" class="contratantes"></div></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td><table width="400" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="149"><a id="newcontratantee" onClick="asi1()"><img src="iconos/mostrarcontratantes.png" width="134" height="28" border="0" /></a></td>
                                                <td width="251"><a onClick="asi2()"><img src="iconos/editarcontratante.png" width="134" height="28" border="0" /></a></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                      </table>
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
									  
                                    </div>
                                    <div id="tab3" class="Contenido">
                                      <table width="732" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="53">&nbsp;</td>
                                          <td width="175">&nbsp;</td>
                                          <td width="175">&nbsp;</td>
                                          <td width="162">&nbsp;</td>
                                          <td width="167">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td colspan="5"><table width="727" height="209" border="0" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td colspan="5" rowspan="8" valign="top"><table width="468" height="30" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
                                                   
                                                    <tr>
                                                      <td colspan="6"><div id="divShowPagos" style='width:100%; height:180px; overflow:auto;'></div></td>
                                                    </tr>
                                                </table></td>
                                                <td width="91" height="26" align="center" bgcolor="#FFFF99"><span class="Estilo23">TNOT</span></td>
                                                <td width="32" align="center" bgcolor="#FFFF99"><span class="Estilo21">-</span></td>
                                                <td width="90" align="center" bgcolor="#FFFF99"><span class="Estilo23">TREG</span></td>
                                              </tr>
                                              <tr>
                                                <td colspan="3" align="center" bgcolor="#FFFF99"><span class="Estilo21">Presupuesto</span></td>
                                              </tr>
                                              <tr>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21">
                                                  <label>
                                                  <input name="pre1" type="text" id="pre1" size="10" style="text-align:right;" value="0.00" />
                                                  </label>
                                                </span> </td>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21"> -</span></td>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21">
                                                  <label>
                                                  <input name="pre2" type="text" id="pre2" size="10" style="text-align:right;" value="0.00" />
                                                  </label>
                                                </span> </td>
                                              </tr>
                                              <tr>
                                                <td colspan="3" align="center" bgcolor="#FFFF99"><span class="Estilo21">Cobrado</span></td>
                                              </tr>
                                              <tr>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21">
                                                  <label>
                                                  <input name="crobado1" type="text" id="crobado1" size="10" style="text-align:right;" />
                                                  </label>
                                                </span> </td>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21">-</span></td>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21">
                                                  <label>
                                                  <input name="cobrado2" type="text" id="cobrado2" size="10" style="text-align:right;" />
                                                  </label>
                                                </span> </td>
                                              </tr>
                                              <tr>
                                                <td colspan="3" align="center" bgcolor="#FFFF99"><span class="Estilo21">
                                                  <label></label>
                                                  Saldo </span></td>
                                              </tr>
                                              <tr>
                                                <td height="22" align="center" bgcolor="#FFFF99"><span class="Estilo21">
                                                  <label>
                                                  <input name="saldo1" type="text" id="saldo1" size="10" style="text-align:right;" />
                                                  </label>
                                                </span> </td>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21">-</span></td>
                                                <td align="center" bgcolor="#FFFF99"><span class="Estilo21">
                                                  <label>
                                                  <input name="saldo2" type="text" id="saldo2" size="10" style="text-align:right;" />
                                                  </label>
                                                </span> </td>
                                              </tr>
                                              <tr>
                                                <td height="52" align="center" bgcolor="#FFFF99">&nbsp;</td>
                                                <td align="center" bgcolor="#FFFF99">&nbsp;</td>
                                                <td align="center" bgcolor="#FFFF99">&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                      </table>
                                    </div>
                                    <div id="tab4" class="Contenido">
									
									
									
									
									
									
									
									
									
									
									
									
									
									  
									  
									  
						
									  
									  
									  
									  
									  
									  
									  <table width="730" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="132" height="28" align="right" class="camposss"><div id="min4"># de Minuta&nbsp;&nbsp;<span style="color:#F00"> </span></div>
        <div id="minsol" style="display:none;"># de Minuta/Sol&nbsp;&nbsp;<span style="color:#F00"></span></div></td>
    <td width="94" class="camposss"><input name="numminuta" type="text" id="numminuta" size="11" maxlength="7" />
    </td>
   

    	<td width="112" align="right" class="camposss" style="display:<?php echo $tipoid!=3?'block':'none'; ?>">Fecha Minuta&nbsp;&nbsp;</td>
   		<td width="103" class="camposss"><input name="fechaminuta" type="text" id="fechaminuta" class="tcal" size="11" style="display:<?php echo $tipoid!=3?'block':'none'; ?>"  /></td>
   		


   
    
    <td width="100" height="28" align="right" class="camposss"><div id="escri4"># Escritura&nbsp;&nbsp;</div>
        <div style="display:none" id="escri5"># Acta&nbsp;&nbsp;</div>
    <div style="display:none" id="numins"># Instrumento&nbsp;&nbsp;</div></td>
    <td width="197" class="camposss"><input name="numescritura" type="text" id="numescritura" onKeyPress="return NumCheck(event, this);" size="11" maxlength="7" />
        <span style="color:#F00">*</span></td>
    <td width="1" class="camposss"></td>
  </tr>
  <tr>
    <td colspan="7" class="camposss"><table width="740" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="132" height="30" align="right">#Folio del&nbsp;&nbsp;</td>
        <td width="88"><label></label>
              <input name="folioini" type="text" id="folioini" size="11" maxlength="10" /></td>
        <td width="23" align="center">al</td>
        <td width="198"><label></label>
              <input name="foliofin" type="text" id="foliofin" size="11" maxlength="10" /></td>
        <td><label></label></td>
        </tr>
    </table></td>
  </tr>
  <tr>

    <td colspan="7" class="camposss"><table width="740" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="132" height="30" align="right">Serie Notarial del&nbsp;&nbsp;</td>
        <td width="88"><label></label>
              <input name="papelini" type="text" id="papelini" size="11" /></td>
        <td width="24" align="center">al</td>
        <td width="197"><label></label>
              <input name="papelfin" type="text" id="papelfin" size="11" /></td>
        <td width="285"><div id="mela">
      <input name="fechaconclusion" type="hidden" id="fechaconclusion" value="" />
    </div>          <label></label>        </td>
        <td width="13">&nbsp;</td>
      </tr>
    </table>
    </td>

  </tr>
  <tr>
    <td colspan="7" class="camposss"><table width="740" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td  height="30" align="right"><div id="tom">Tomo&nbsp;&nbsp;</div></td>
        <td><label for="tomox"></label>
              <input name="tomox" type="text" id="tomox" size="11" maxlength="4" /></td>
        <td align="right"><div id="regisx">Registro&nbsp;&nbsp;</div></td>
        <td colspan="2"><label for="regx"></label>
              <input name="regx" type="text" id="regx" size="11" maxlength="8"/></td>
      </tr>

   	

     <tr>
      <td colspan="7" class="camposss"><table width="740" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="132" height="30" align="right">#Papel de Trasl. P.Notarial</td>
          <td width="89"><label></label>
            <input name="papelTrasladoIni" type="text" id="papelTrasladoIni" size="11" maxlength="10" value="<?php echo $rowvkardex['papelTrasladoIni']; ?>" /></td>
            <td width="24" align="center">al</td>
          <td width="212"><label></label>
            <input name="papelTrasladoFin" type="text" id="papelTrasladoFin" size="12" maxlength="10" value="<?php echo $rowvkardex['papelTrasladoFin']; ?>"/></td>
            <td width="134">&nbsp;</td>
            <td width="66">&nbsp;</td>
            <td width="20">&nbsp;</td>
            <td width="79">&nbsp;</td>
          </tr>
      </table></td>
    </tr>

	<style>
		.btnGenerarFecha{
			background:rgba(52,152,219,1);border-radius:5px;padding:.3em .6em;width:200px;box-shadow:0; color:white;border:none;width:140px;font-family:Calibri;cursor: pointer;text-decoration:none
		}
		.btnGenerarFecha:hover{
			background:rgba(52,152,150,1);
		}
	</style>



      <tr>
        <td width="131" height="28" align="right"><div id="fecesc">Fecha de Escritura&nbsp;&nbsp;</div>
              <div id="fecact" style="display:none;">Fecha de Acta&nbsp;&nbsp;</div>
          <div id="fecins" style="display:none;">Fecha de Instrumento&nbsp;&nbsp;</div></td>
        <td width="110"><label></label>
              <input name="fechaescritura" type="text" id="fechaescritura" class="tcal" size="11"  />
          <span style="color:#F00">*</span></td>
        <td width="103" align="right"> <a href="#" class="btnGenerarFecha" id="btnGenerarFecha" onclick="generarFechaEscritura()" >GEN. FECHA</a>       </td>
        <td width="202"><div id="verifyfirma"><input name="fechaconclusion" type="hidden" id="fechaconclusion" class="tcal" size="20" /></div></td>
        <td width="200"><input type="button" name="btngrabar" id="btngrabar" value="Grabar" onClick="gbrescri()" /></td>
      </tr>





    </table></td>
  </tr>
</table>
                                    </div>
                                    <div id="tab6" class="Contenido">
                                     	<table width="338" border="0" cellspacing="0" cellpadding="0">
											  <tr>
											    <td width="152"><a href="#" onClick="newmove();limpiarrpp()"><img src="iconos/neww.png" width="94" height="29" border="0" /></a></td>
											    <td width="72">&nbsp;</td>
											    <td width="114">&nbsp;</td>
											  </tr>
										</table>
                                      <table width="732" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="19">&nbsp;</td>
                                          <td width="208"><input name="codmovreg" type="hidden" /><input name="itemcodmovreg" id="itemcodmovreg" type="hidden" />                                          </td>
                                          <td width="174"><span class="Estilo40"> </span></td>
                                          <td width="109"><span class="Estilo40"> </span></td>
                                          <td width="220">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td height="236" colspan="5"><table width="727" height="217" border="0" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td height="63" colspan="5" valign="top"><table width="724" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td height="198" valign="top"><div id="rp" style="width:730px; height:320px; overflow:auto;">
                                                          <table width="710" height="29" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
                                                            <tr>
                                                              <td width="70" height="27" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Fecha Movi.</span></td>
                                                              <td width="153" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Tramite</span></td>
                                                              <td width="73" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Nº Titulo</span></td>
                                                              <td width="125" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Estado</span></td>
                                                              <td width="63" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Importe</span></td>
                                                              <td width="115" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Sede Reg</span></td>
                                                              <td width="95" align="center" bgcolor="#CCCCCC"><span class="Estilo18">Sec. Reg</span></td>
                                                              <td width='16' bgcolor="#CCCCCC">&nbsp;</td>
                                                              <td width='18' bgcolor="#CCCCCC">&nbsp;</td>
                                                            </tr>
                                                          </table>

                                                        <div id="vermovi">
                                                        	
                                                        </div>
                                                       

                                                      </div></td>
                                                    </tr>
                                                    <tr>
                                                      <td></td>
                                                    </tr>
                                                </table></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                      </table>
                                    </div>
                                    <div id="tab7" class="Contenido">
                                      <table width="596" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="79" colspan="5" class="camposss">Observación Notarial: </td>
                                          <td width="443" class="camposss"><textarea name="ob_nota" cols="70" rows="5" id="ob_nota" maxlength="6000" ></textarea></td>
                                        </tr>
                                        <tr>
                                          <td height="80" colspan="5" class="camposss">Instrucc. Especiales:</td>
                                          <td class="camposss"><textarea name="ins_espec" cols="70" rows="5" id="ins_espec" maxlength="6000"></textarea></td>
                                        </tr>
                                        <tr>                                        </tr>
                                      </table>
                                    </div>

                                     <div id="escrituracion" >
                                      
                                     </div>

                                  </div></td>
                            </tr>
                          </table>
                        <input type="button" name="button3" id="button3" value="UIF/PDT Patrimonial" onClick="mostrar_desc('patrimoniallll'); verlistpatri();"/>
                        <input type="button" name="button2" id="button2" value="UIF/PDT Participa"  onclick="validar4()"/>
                        <!--<input type="button" name="buttonminutas" id="buttonminutas" value="Minuta"   onClick="mostrar_desc('Minutass');"/>-->
                        <!-- <input type="button" name="button6" id="buttoninsertos" value="Insertos"   onClick="mostrar_desc('insertoss');"/>-->
                        
                       
                       <!-- <input type="button" name="button5" id="btngenerador" value="Generar Documento"  onclick="verifyDocument(1)"/>-->
   
   				      	<!--<input type="button" name="button5" id="btnGenerarParteNotarial" value="Parte Notarial"  onclick="verifyDocument(2)"/>-->
   				      	 <!--<button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onClick="verifyDocument(3);" ><img align="absmiddle" src="images/block.png" width="15" height="15" />Testimonio</button>-->

  <!--<button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onClick="fVisualDocument();" ><img align="absmiddle" src="images/block.png" width="15" height="15" />Ver</button>-->                      
                        <div id="verkardexdoc" style="display:none"><input type="button" name="button6" id="btnverkardexdocs" value="Ver Documento"  onclick="verDocum()"/>
                        </div>
                    </div><div id="rouif"></div></td>
                  </tr>
              </table></td>
            </tr>
          </table>
      </form></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
    </tr>
<tr></tr>
</table>
</div>
  <div id="Minutass" style="position:absolute; display:none; width:790px; height:700px; left: 30px; top: 50px; z-index:17; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="11" height="25">&nbsp;</td>
                              <td width="100%"></td>
                              <td width="32"><a href="#" onClick="ocultar_desc('Minutass')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                            </tr>
                            </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="11" height="25">&nbsp;Ingrese la Minuta:</td>
  </tr>
  <tr>
     <td width="11" height="25">&nbsp;
    <!-- <iframe name="frame_minutas" id="frame_minutas" src="view_minuta.php" frameborder="0" width="770" height="620" allowtransparency="true" scrolling="auto"></iframe>-->
	<textarea name="txa_minuta" cols="98" rows="37"  id="txa_minuta"></textarea></td>
  </tr>
</table>                     
                            
  </div>
 <div id="insertoss" style="position:absolute; display:none; width:500px; height:350px; left: 51px; top: 327px; z-index:17; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="11" height="25">&nbsp;</td>
                              <td width="100%"></td>
                              <td width="32"><a href="#" onClick="ocultar_desc('insertoss')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                            </tr>
                            </table>
                            
   <table  width="100%" >
  <tr>
    <td colspan="2" align="left"><label class="control-label" >Inserto Disponibles Legales:</label></td>
  </tr>
  <tr>
    <td width="30%" align="right"><label class="control-label"  >Codigo Civil:</label></td>
    <td width="70%"><label class="checkbox inline">
  <input type="checkbox" id="chk_155" value="CC155" onClick="Select_Inserto(this.checked,this.value);"> 155
</label>
<label class="checkbox inline">
  <input type="checkbox" id="chk_156" value="CC156" onClick="Select_Inserto(this.checked,this.value);"> 156
</label>
<label class="checkbox inline">
  <input type="checkbox" id="chk_315" value="CC315" onClick="Select_Inserto(this.checked,this.value);"> 315
</label></td>
  </tr>
  <tr>
    <td align="right"><label class="control-label"  >Codigo procesal civil: </label></td>
    <td><label class="checkbox inline">
  <input type="checkbox" id="chk_71" value="CPC71" onClick="Select_Inserto(this.checked,this.value);"> 71&nbsp;&nbsp;
</label>
<label class="checkbox inline">
   <input type="checkbox" id="chk_72" value="CPC72" onClick="Select_Inserto(this.checked,this.value);"> 72&nbsp;&nbsp;
</label>
<label class="checkbox inline">
  <input type="checkbox" id="chk_73" value="CPC73" onClick="Select_Inserto(this.checked,this.value);"> 73
</label></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><label class="checkbox inline">
  <input type="checkbox" id="chk_74" value="CPC74" onClick="Select_Inserto(this.checked,this.value);"> 74&nbsp;&nbsp;
</label>
<label class="checkbox inline">
  <input type="checkbox" id="chk_75" value="CPC75" onClick="Select_Inserto(this.checked,this.value);"> 75&nbsp;&nbsp;
</label>
<label class="checkbox inline">
  <input type="checkbox" id="chk_77" value="CPC77" onClick="Select_Inserto(this.checked,this.value);"> 77
</label>
<label class="checkbox inline">
  <input type="checkbox" id="chk_436" value="CPC436" onClick="Select_Inserto(this.checked,this.value);"> 436
</label></td>
  </tr>
  <tr>
    <td align="right"><label class="control-label"  >D.S. 006-72: </label></td>
    <td><label class="checkbox inline">
  <input type="checkbox" id="chk_3" value="DS6-03" onClick="Select_Inserto(this.checked,this.value);"> 3&nbsp;&nbsp;&nbsp;&nbsp;
</label>
<label class="checkbox inline">
  <input type="checkbox" id="chk_28" value="DS6-28" onClick="Select_Inserto(this.checked,this.value);"> 28
</label>
</td>
  </tr>
  <tr>
    <td align="right"><label class="control-label" >D.Leg: 1106</label></td>
    <td><label class="checkbox inline">
  <input type="checkbox" id="chk_1106" value="DL1106" onClick="Select_Inserto(this.checked,this.value);">
  &nbsp;&nbsp;&nbsp;&nbsp;
</label></td>
  </tr>
  <tr>
    <td align="right"><span class="control-label">D.Ley: 25593</span></td>
    <td><label class="checkbox inline">
      <input type="checkbox" id="chk_DL25593-48" value="DL25593-48" onClick="Select_Inserto(this.checked,this.value);" />
      48&nbsp;&nbsp;&nbsp;&nbsp; </label>
      <label class="checkbox inline">
        <input type="checkbox" id="chk_DL25593-49" value="DL25593-49" onClick="Select_Inserto(this.checked,this.value);" />
      49 </label></td>
  </tr>
  <tr>
    <td colspan="2"><hr></td>
  </tr>
  <tr>
    <td align="right"><label class="control-label" >Insertos de Ley N.:</label></td>
    <td colspan="3"><div class="input-append">
      <input name="num_inser" size="40" type="text" class="input-xlarge" id="num_inser" style=" background:#FFF;text-transform:uppercase" readonly>
      <input  value="grabar" name="grabar" type="button" id="grabar" onClick="grabainsertos();"/>
      </div>
      </td>
  </tr>
</table>                     
                            
  </div>
<map name="Map" id="Map">
<area shape="rect" coords="5,2,84,22" href="#" onClick="vernewpatri()" />
<area shape="rect" coords="92,2,182,22" href="#" onClick="verlistpatri()" />
</map>
<map name="Map2" id="Map2"><area shape="rect" coords="5,4,93,21" href="#" onClick="agregarbienes()" />
<area shape="rect" coords="103,5,176,22" href="#" onClick="listarbienesss()" />
</map>
<map name="Map_listado" id="Map_listado"><area shape="rect" coords="5,4,93,21" href="#" onClick="agregarbienes2()" />
<area shape="rect" coords="103,5,176,22" href="#" onClick="listarbienesss2();ocul_NewBienPatri()" />
</map>
<script language="javascript">
	$(document).ready(function(){
		$('#gridPatrimonial').scrollableFixedHeaderTable(700,620,null,null)
		});

		document.addEventListener('DOMContentLoaded',function(){

if(document.getElementById('txtFiltrarGrupo')){
	txtFiltrarGrupo.addEventListener('keyup',()=>{
		let texto = txtFiltrarGrupo.value.toUpperCase();
		for(let i=1 ; i<=5000 ; i++){

			if(document.getElementById('txtItems'+i)){
				/* console.log(document.getElementById('txtItems'+i)) */
				if(document.getElementById('txtItems'+i).textContent.includes(texto)){
					document.getElementById('txtItems'+i).style.display = 'block';
				}else{
					document.getElementById('txtItems'+i).style.display = 'none';
				}
			}
			
		}
	})
}

	// let usuario = '<?php echo $rowUsuarioError['loginusuario']?>'
	// let countClick1 = 0;
	// let n1=1;
	// document.addEventListener('click',()=>{

	// 	countClick1 += 1;
		
	// 	if(countClick1==(20*n1)){
	// 		consultar_ranking_usuarios(usuario,'LOW')
	// 		n1=n1+1
	// 		console.log('LOW')
	// 	}
	// 	console.log(countClick1)
	// })

	// let countClick2 = 0;
	// let n2=1;
	// document.addEventListener('click',()=>{

	// 	countClick2 += 1;
	// 	if(countClick2==(10*n2)){
	// 		consultar_ranking_usuarios(usuario,'MEDIUM')
	// 		n2=n2+1
	// 		console.log('MEDIUM')
	// 	}
	// 	console.log(countClick2)
	// })

	// let countClick3 = 0;
	// let n3=1;
	// document.addEventListener('click',()=>{

	// 	countClick3 += 1;
	// 	if(countClick3==(5*n3)){
	// 		consultar_ranking_usuarios(usuario,'HIGH')
	// 		n3=n3+1
	// 		console.log('HIGH')
	// 	}
	// 	console.log(countClick3)
	// })


})

const consultar_ranking_usuarios = (usuario, level)=>{
	console.log(usuario)
	let url =  'reportes/buscar_ranking_errores_pdt_usuario.php'
	const request=new XMLHttpRequest();
	request.open('POST',url,true);
	request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
	request.send('usuario='+usuario);
	request.onload=function(){
		if(request.status>=200 && request.status<400){
			let data = request.responseText;
			let registro =  JSON.parse(data);
			// console.log(countClick)
			
			if(registro[0]){
				if(level=='HIGH'){
					if(registro[0]['total']>30){
						alert(registro[0]['nombre']+' TIENES ('+registro[0]['total']+')ERRORES EN EXCESO EN EL PDT, CORRIJALOS POR FAVOR PARA QUE ESTE MENSAJE DEJE DE MOSTRARSE')
					}
				}
				if(level=='MEDIUM'){
					if(registro[0]['total']>20 && registro[0]['total']<30){
						alert(registro[0]['nombre']+' TIENES ('+registro[0]['total']+')ERRORES EN EL PDT, CORRIJALOS PARA QUE ESTE MENSAJE DEJE DE MOSTRARSE')
					}
				}
				if(level=='LOW'){
					if(registro[0]['total']>=10 && registro[0]['total']<=20){
						alert(registro[0]['nombre']+' TIENES POCOS ('+registro[0]['total']+')ERRORES EN EL PDT, CORRIJALOS PARA QUE ESTE MENSAJE DEJE DE MOSTRARSE')
					}
				}
			}
			// if(registro[0]['total']){

			// 	if(registro[0]['total']>20){
			// 		alert(registro[0]['nombre']+' TIENES ERRORES EN EXCESO CORRIJALOS POR FAVOR')
			// 	}
			// }
			
		}else{
			let data=request.responseText;
			console.log('No hubo respuesta')
			console.log(data);
		}
	}
	request.onerror=function(){
		console.log('No hay conexion')
	}
}

const generarFechaEscritura = ()=>{
		event.preventDefault();
		var fechaActual = new Date();
		let dia = fechaActual.getDate();
		let mes = (fechaActual.getMonth() +1);
		let anio = fechaActual.getFullYear();

		if (dia < 10) {
			dia = '0' + dia;
		}
		if (mes < 10) {
			mes = '0' + mes;
		}

		fechaescritura.value =  dia+ "/" + mes + "/" + anio;
	}

	function validar_tc(valor){
    	console.log(valor)
		if(tipcambio2.value>5){
			Swal.fire({
				icon: 'error',
				title: 'cuidado esta colocando un TIPO DE CAMBIO muy elevado',
				// text: 'Llene el numero de document',
			})
		}
	}
</script>
<script src="js/sweetalert2.min.js"></script>
<!--MODULOS NUEVOS DE PREDIOS-->
<script src="js/modulos/predios.js"></script>
<!-- <script>
	function set_predios(kardex,formulario=null){

		let url = 'models/set_predios.php';
		let tbl;
		let tipoZona;
		let zona;
		let denominacion;
		let tipoVia;
		let nombreVia;
		let numero;
		let lote;
		let manzana;		

		if(formulario==2){
			
			tbl = 'tblPredios22'
			tipoZona = document.getElementById('txtTipoZonaPredio22').value
			zona = document.getElementById('txtZonaPredio22').value
			denominacion = document.getElementById('txtDenominacionPredio22').value
			tipoVia = document.getElementById('txtTipoViaPredio22').value
			nombreVia = document.getElementById('txtNombreViaPredio22').value
			numero = document.getElementById('txtNumeroPredio22').value
			lote = document.getElementById('txtLotePredio22').value
			manzana = document.getElementById('txtManzanaPredio22').value

		}else if(formulario==3){
			
			tbl = 'tblPredios3'
			tipoZona = document.getElementById('txtTipoZonaPredio3').value
			zona = document.getElementById('txtZonaPredio3').value
			denominacion = document.getElementById('txtDenominacionPredio3').value
			tipoVia = document.getElementById('txtTipoViaPredio3').value
			nombreVia = document.getElementById('txtNombreViaPredio3').value
			numero = document.getElementById('txtNumeroPredio3').value
			lote = document.getElementById('txtLotePredio3').value
			manzana = document.getElementById('txtManzanaPredio3').value

		}else{

			tbl = 'tblPredios'
			tipoZona = document.getElementById('txtTipoZonaPredio').value
			zona = document.getElementById('txtZonaPredio').value
			denominacion = document.getElementById('txtDenominacionPredio').value
			tipoVia = document.getElementById('txtTipoViaPredio').value
			nombreVia = document.getElementById('txtNombreViaPredio').value
			numero = document.getElementById('txtNumeroPredio').value
			lote = document.getElementById('txtLotePredio').value
			manzana = document.getElementById('txtManzanaPredio').value
			
		}

		if(nombreVia==''){
			Swal.fire({
				icon: 'error',
				title: 'El nombre de la via es requerida',
				// text: 'Llene el numero de document',
			})
			return false;
		}

		Swal.fire({
			title: 'Esta seguro de que quiere registrar el predio?',
			// text: "Advertencia: Solo se usa esta opcion si hubo un error en el envio de este resumen diario, si ya envió su resumen consulte primero el ticket",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, registrar'
		}).then((result) => {
			if (result.value) {
				const request=new XMLHttpRequest();
				request.open('POST',url,true);
				request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
				request.send('tipoVia='+tipoVia+'&nombreVia='+nombreVia+'&numero='+numero+'&lote='+lote+'&manzana='+manzana+'&kardex='+kardex+'&tipoZona='+tipoZona+'&zona='+zona+'&denominacion='+denominacion);
				request.onload=function(){
					if(request.status>=200 && request.status<400){
						let data=request.responseText;
						// console.log(data)
						let registro=JSON.parse(data);
						// console.log(registro)
						if(registro['status']==false){
							
							//predio Ya registrado anteriormente
							if(registro['codigo']==1062){
								Swal.fire({
									position: 'center',
									type: 'error',
									icon: 'error',
									title: `${registro['codigo']}: El predio ya fue registrado anteriomente`,
									showConfirmButton: false,
									timer: 2500
								})
							}else{//OTRO ERRROR
								Swal.fire({
									position: 'center',
									type: 'error',
									icon: 'error',
									title: `${registro['codigo']}: ${registro['mensaje']}`,
									showConfirmButton: false,
									timer: 2500
								})
							}
						}else{

						// console.log(registro['renta'])
							htmlPredios(registro)

							if(document.getElementById(tbl)){
								let tblListado = document.getElementById(tbl);
								tblListado.innerHTML = html;
							}
						// ocultar_desc('predio3')
						}
						
					}else{
						let data=request.responseText;
						console.log('No hubo respuesta')
						console.log(data);
					}
				}
				request.onerror=function(){
					console.log('No hay conexion')
				}
			}else{
				Swal.fire({
					position: 'center',
					type: 'error',
					icon: 'error',
					title: 'Se cancelo el registro de predio',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

			
		}
		function get_predios(formulario=null){

		let url = 'models/get_predios.php';

		let tbl;
		let tipoZona;
		let zona;
		let denominacion;
		let tipoVia;
		let nombreVia;
		let numero;
		let lote;
		let manzana;
		let inputs={};

		if(formulario==2){
			
			tbl = 'tblPredios22'
			tipoZona = document.getElementById('txtTipoZonaPredio22').value
			zona = document.getElementById('txtZonaPredio22').value
			denominacion = document.getElementById('txtDenominacionPredio22').value
			tipoVia = document.getElementById('txtTipoViaPredio22').value
			nombreVia = document.getElementById('txtNombreViaPredio22').value
			numero = document.getElementById('txtNumeroPredio22').value
			lote = document.getElementById('txtLotePredio22').value
			manzana = document.getElementById('txtManzanaPredio22').value

		}else if(formulario==3){
			
			tbl = 'tblPredios3'
			tipoZona = document.getElementById('txtTipoZonaPredio3').value
			zona = document.getElementById('txtZonaPredio3').value
			denominacion = document.getElementById('txtDenominacionPredio3').value
			tipoVia = document.getElementById('txtTipoViaPredio3').value
			nombreVia = document.getElementById('txtNombreViaPredio3').value
			numero = document.getElementById('txtNumeroPredio3').value
			lote = document.getElementById('txtLotePredio3').value
			manzana = document.getElementById('txtManzanaPredio3').value

		}else{

			tbl = 'tblPredios'
			tipoZona = document.getElementById('txtTipoZonaPredio').value
			zona = document.getElementById('txtZonaPredio').value
			denominacion = document.getElementById('txtDenominacionPredio').value
			tipoVia = document.getElementById('txtTipoViaPredio').value
			nombreVia = document.getElementById('txtNombreViaPredio').value
			numero = document.getElementById('txtNumeroPredio').value
			lote = document.getElementById('txtLotePredio').value
			manzana = document.getElementById('txtManzanaPredio').value
			
		}

		inputs = {
			
			txtTipoZonaPredio : tipoZona,
			txtZonaPredio : zona,
			txtDenominacionPredio : denominacion,
			txtTipoViaPredio : tipoVia,
			txtNombreViaPredio : nombreVia,
			txtNumeroPredio : numero,
			txtLotePredio : lote,
			txtManzanaPredio : manzana,

		};

		if(nombreVia==''){
			Swal.fire({
				icon: 'error',
				title: 'El nombre de la via es requerida',
				// text: 'Llene el numero de document',
			})
			return false;
		}

		const datosSerializados=JSON.stringify(inputs);
		const request=new XMLHttpRequest();
		request.open('POST',url,true);
		request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
		request.send('datosSerializados='+datosSerializados);
		request.onload=function(){
			if(request.status>=200 && request.status<400){
				let data=request.responseText;
				// console.log(data)
				let registro=JSON.parse(data);
				// console.log(registro['renta'])
				htmlPredios(registro)

				if(document.getElementById(tbl)){
					let tblListado = document.getElementById(tbl);
					tblListado.innerHTML = html;
				}
				// ocultar_desc('predio3')
				
			}else{
				let data=request.responseText;
				console.log('No hubo respuesta')
				console.log(data);
			}
		}
		request.onerror=function(){
			console.log('No hay conexion')
		}	
		}

		function htmlPredios(registro){
		console.log(registro)
		if(registro==''){
			html=`<tbody>
					<tr>
						<td colspan="9">NO HAY NINGUN PREDIO</td>
					</tr>
				</tbody>`;
		}else{
			
			let j=1;
			html=`<tbody>`
				
				for(let value of registro['predio']){ 

					html+=`<tr>
						<td>${j}</td>
						<td>${value.tipoZona}</td>
						<td>${value.zona}</td>
						<td>${value.denominacion}</td>
						<td>${value.tipoVia}</td>
						<td>${value.nombreVia}</td>
						<td>${value.numero}</td>
						<td>${value.manzana}</td>
						<td>${value.lote}</td>
					</tr>`;
					j++;
				}
				
			html+=`</tbody>`
			
		}
}
</script> -->
</body>
</html>
