<?php 
session_start();
include("conexion.php");

$sqlnlibro=mysql_query("SELECT * FROM nlibro",$conn) or die(mysql_error());
$sqltlibro=mysql_query("SELECT * FROM tipolibro",$conn) or die(mysql_error());
$sqltlegal=mysql_query("SELECT * FROM tipolegal",$conn) or die(mysql_error());
$sqltfol=mysql_query("SELECT * FROM tipofolio",$conn) or die(mysql_error());
$not =mysql_query("SELECT * FROM notarios",$conn) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Libros</title>
<script language="JavaScript" type="text/javascript" src="ajaxlibro.js"></script>
<script type="text/javascript">

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


$("#buscaubbigeoo").live( "click", function(){
			$("#_buscaubi").val("");
			$("#_buscaubi").focus();
		})


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
	
function grabarlibrocant(){
	
	fecing=document.getElementById('fecing').value;
	cantidad=document.getElementById('cantidad').value;
	solicitante=document.getElementById('solicitante').value;
	dni=document.getElementById('dni').value;
	idusuario=document.getElementById('idusuario').value;
	codclie=document.getElementById('codclie').value;
			
	ajax=objetoAjax();
	ajax.open("POST","grabarbloquelibro.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//divResultado.innerHTML = ajax.responseText;
			alert("Se crearon los Bloques de libros");
			window.open('listadolibro.php', 'protocolar');
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fecing="+fecing+"&cantidad="+cantidad+"&solicitante="+solicitante+"&dni="+dni+"&idusuario="+idusuario+"&codclie="+codclie)
	
	
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
		
function mostrarboton(valor){
	if(valor=="1"){
		ocultar_desc('datoslibb');	
		ocultar_desc('datolib');
		//limpiartext('');	
		}
	if (valor!="1"){
		mostrar_desc('datolib');
		verboton();
		}	
	}
	
function lanterior(){
	
	mostrar_desc('datoslibb');
	}
	
function vercliente(){
	buscarcliente();
	}
function newclientempresa()
    {
	mostrar_desc('clientenew');
	
	}	
function newclient()
    {
	mostrar_desc('clientenewdni');
	
	}	

function btngrabaremp()
{
	grabarempresa();
	//limpiarempresa();
	ocultar_desc('clientenew');	
	
}
 function ggclie1()
 {
	 var _apepat = document.getElementById('apepat');
	var _prinom = document.getElementById('prinom');
	var _apemat = document.getElementById('apemat');
	var _codubisc= document.getElementById('codubisc');
	var _direccion= document.getElementById('direccion');
	if( _apepat.value == '' || _prinom.value == '' || _apemat.value == '' || _codubisc.value == '' || _direccion.value == '')
	
	{alert('Faltan ingresar datos');return;}
	else{
	   grabarcliente();
	   alert("Cliente grabado satisfactoriamente");
	   ocultar_desc('clientenewdni');
		}
  
	 }

function mostrarubigeoo(id,name)
    {
  document.getElementById('ubigen').value = id;
  document.getElementById('codubi').value = name;  
  ocultar_desc('buscaubi');     
        
    }
	
function mostrarubigeoosc(id,name)
    {
  document.getElementById('ubigensc').value = id;
  document.getElementById('codubisc').value = name;  
  ocultar_desc('buscaubisc');        
    }
function mostrarprofesioness(id,name)
    {
  document.getElementById('idprofesion').value = id;
  document.getElementById('nomprofesiones').value = name;  
  ocultar_desc('buscaprofe');        
    }
	
function mostrarcargoos(id,name)
    {
  document.getElementById('idcargoo').value = id;
  document.getElementById('nomcargoss').value = name;  
  ocultar_desc('buscacargooo');        
    }	
	
function mostrartipolibro(){

	var num = document.getElementById('tlibro')[document.getElementById('tlibro').options.selectedIndex].text; 
	document.getElementById('tipolib').value = num;
	ocultar_desc('tlibros');
	}
	
function gbrlibro()
{
	grabarlibro();
		
	}	
	
function gbrlibrocant()
{  
  var _numdoc   = document.getElementById('numdoc');
  var _tipoper = document.getElementById('tipoper');
  var _codclie = document.getElementById('codclie');
  var _cantidad = document.getElementById('cantidad');
		 if(_tipoper.selectedIndex == '0'){
		          alert('Falta seleccionar Tipo de Persona');return;
	             }else{
					   if(_cantidad.value== ''){
							   alert('Falta agregar cantidad de libros a generar');return;
							   }else{ grabarlibrocant(); }
							   }
					 
				

	}
	
		
	
function cuentadni()
{   
	var _dnicuenta = document.getElementById('numdoc');
    var _tipoper = document.getElementById('tipoper');
	
	if(_tipoper.selectedIndex == '0')
	     {alert('Falta seleccionar Tipo de Persona');return;
	     }else{
	      vercliente();
		 }
  
}

function limpiaruc(){
	document.getElementById('numdoc').value="";
	}
function limpianombre(){
	document.getElementById('nombrebus').value="";
	}
	function seleccionacliente(id){
	
	mostrarxisclie(id);
	}
</script>

<style type="text/css">
<!--

.Estilo1 {color: #000033}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo10 {
	color: #333333;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo11 {color: #333333}
.Estilo12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

div.newlibro
{ 
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:820px; height:600px;
}
.submenutitu {	font-family: Calibri;
	font-size: 18px;
	font-style: italic;
	color:#FF9900;
}

div.clienbus1 {
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
	left: 496px;
	top: 335px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}

div.dalib {
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
	top: 162px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}

div.dalib2 {
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
	top: 163px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
}
div.dalib3 {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:760px;
	height:223px;
	position:absolute;
	left: 487px;
	top: 277px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=70)"; /* expected to work in IE 8 */
	filter: alpha(opacity=70);   /* IE 4-7 */
	zoom: 1;
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

.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
#newproto table tr td #frmlibro table tr td table tr td strong {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<div class="newlibro" id="newproto">
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><form id="frmlibro" name="frmprotocolares" method="post" action="actualizar_kardex.php">
        <table width="820" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="36" height="28" align="center" bgcolor="#264965"><img src="iconos/nuevo2.png" width="20" height="22" /></td>
            <td width="745" bgcolor="#264965"><span class="submenutitu">Libros en Bloque</span></td>
          </tr>
          <tr>
            <td colspan="2"><table width="793" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <th height="28" colspan="7" align="right" scope="col">&nbsp;</th>
              </tr>
              <tr>
                <td width="126" height="30" align="right"><span class="Estilo10">Número de Libros</span></td>
                <td width="10">&nbsp;</td>
                <td width="152">
                  <input name="cantidad" type="text" id="cantidad" size="5" /></td>
                <td width="75"><span class="Estilo10">Fecha de ingreso</span></td>
                <td width="148"><input type="text" name="fecing" id="fecing"  size="18" value="<?php echo date("d/m/Y"); ?>"  class="tcal" /></td>
                <td width="105">&nbsp;</td>
                <td width="177">&nbsp;</td>
                </tr>
              <tr>
                <td height="26" colspan="7" align="center">----------------------------------------------------------------------------------------------------------------------------------</td>
                </tr>
              <tr>
                <td height="26" colspan="3" align="center"><strong>Busqueda de Cliente</strong></td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
                <td height="26" align="right">&nbsp;</td>
              </tr>
              <tr>
                <td height="63" colspan="7" align="right"><table width="750" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="22" rowspan="2">&nbsp;</td>
                    <td width="647"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="223" bgcolor="#FFFFFF"><label>
                          <select name="tipoper" id="tipoper" >
                            <option value = "A" selected="selected">TIPO DE PERSONA</option>
                            <option value="N">Natural</option>
                            <option value="J">Jurídica</option>
                          </select>
                        </label></td>
                        <td width="61" bgcolor="#FFFFFF"><span class="Estilo10">N° RUC</span></td>
                        <td width="122" align="right" bgcolor="#FFFFFF"><input name="numdoc" type="text" id="numdoc" size="18"  maxlength="11" onclick="limpianombre();"  /></td>
                        <td width="94" align="center" bgcolor="#FFFFFF"><a  onclick="cuentadni();"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                      </tr>
                    </table></td>
                    <td width="81" rowspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="30"><table width="528" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="217"><span style="font-family:Verdana, Geneva, sans-serif; font-size:8px; color:#333;"><strong>Apellidos y Nombres / Empresa</strong></span></td>
                        <td width="10">&nbsp;</td>
                        <td width="301"><input name="nombrebus" type="text" id="nombrebus" style="text-transform:uppercase" size="45" maxlength="300" onclick="limpiaruc();" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td height="33" colspan="7" align="right"><table width="750" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="27">&nbsp;</td>
                    <td width="723"><div id="datos" style="height:130px"><input type="hidden" name="codclie" id="codclie" value=""   /></div></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td height="33" colspan="7" align="center" class="Estilo10">--------------------------------------------------------------------------------------------------------------------------------</td>
                </tr>
              <tr>
                <td height="33" align="right" class="Estilo10">A solicitud de:</td>
                <td>&nbsp;</td>
                <td colspan="5"><input name="solicitante" type="text" id="solicitante" size="60" style=" text-transform:uppercase;" /></td>
              </tr>
              <tr>
                <td height="34" align="right" class="Estilo10">D.N.I</td>
                <td rowspan="2">&nbsp;</td>
                <td colspan="5"><table width="654" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="163"><input name="dni" type="text" id="dni" size="15" maxlength="8" /></td>
                    <td width="326">&nbsp;</td>
                    <td width="165">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="34" align="right" class="Estilo10">Responsable</td>
                <td colspan="5"><input name="usuario" type="text" id="usuario" value="<?php echo $_SESSION["apepat_usu"]." ".$_SESSION["apemat_usu"]." ".$_SESSION["nom1_usu"]." ".$_SESSION["nom2_usu"];?>" size="60" readonly="readonly" />
                  <label for="idusuario"></label>
                  <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $_SESSION["id_usu"];?>" /></td>
              </tr>
              <tr>
                <td height="46" align="right">&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="5"><a onclick="gbrlibrocant();"><img src="iconos/grabar.png" border="0" width="94" height="29" /></a></td>
              </tr>
            </table></td>
          </tr>
        </table>
      </form></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr></tr>
  </table>
</div>
<div id="datoslibb" class="dalib2" style="display:none; font-family: Calibri; font-size: 12px; color: #FFF; font-family: Verdana, Geneva, sans-serif; font-style: italic;">
<table width="757" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25" height="31">&nbsp;</td>
    <td width="708" class="submenutitu">Datos del Libro Anterior</td>
    <td width="24"><a  onclick="ocultar_desc('datoslibb')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123">&nbsp;</td>
        <td width="343">&nbsp;</td>
        <td width="234">&nbsp;</td>
      </tr>
      <tr>
        <td height="30">Notario:</td>
        <td><select name="idnotario" id="idnotario" style="background:#FFF;">
                                <option value="0">SELECCIONE NOTARIA</option>
                                
                                <?php
			 while($row2=mysql_fetch_array($not)){
		  echo "<option value = ".$row2["idnotario"].">".$row2["descon"]."</option>";  
		  }
		?>
                              </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30">Fecha Legalización</td>
        <td><label for="flegal"></label>
          <input type="text" name="flegal" id="flegal" />          <label for="comentarios"></label></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30">Comentario:</td>
        <td colspan="2" rowspan="3" valign="top"><textarea name="comentarios" id="comentarios" cols="60" rows="5"></textarea></td>
        </tr>
      <tr>
        <td height="15" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" valign="top">&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>


<!--------------------------------------------------------------------------------------------------------------------->

<div id="comentario" class="dalib3" style="display:none; font-family: Calibri; font-size: 12px; color: #FFF; font-family: Verdana, Geneva, sans-serif; font-style: italic;">
<table width="757" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25" height="31">&nbsp;</td>
    <td width="708" class="submenutitu">Comentario</td>
    <td width="24"><a  onclick="ocultar_desc('comentario')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123">&nbsp;</td>
        <td width="343">&nbsp;</td>
        <td width="234">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><textarea name="comentarios2" id="comentarios2" cols="80" rows="10"></textarea></td>
        </tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>

<!--------------------------------------------------------------------------------------------------------->
<div id="clientenew" class="dalib" style="display:none; z-index:7; color: #F90; font-weight: bold; font-family: Calibri; font-style: italic;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="editcampp">Agregar Cliente</td>
                              <td width="35"><a  onclick="ocultar_desc('clientenew')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td height="233" colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                      <table width="637" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                                        <tr>
                                          <td height="32" align="right" ><span class="camposss">Razón Social</span></td>
                                          <td height="32" >&nbsp;</td>
                                          <td height="32" colspan="5"><label>
                                          <input name="nrazonsocial" type="text" style="text-transform:uppercase" id="nrazonsocial" size="60" onkeyup="razonsociall();" />  <input name="razonsocial" type="hidden" style="text-transform:uppercase" id="razonsocial" size="60" />
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
                                        </tr>
                                        <tr>
                                          <td height="26" align="right" ><span class="camposss">Domicilio Fiscal</span></td>
                                          <td height="26" >&nbsp;</td>
                                          <td height="26" colspan="5"><input name="ndomfiscal" style="text-transform:uppercase" type="text" onkeyup="domfiscall();" id="ndomfiscal" size="60" /><input name="domfiscal" style="text-transform:uppercase" type="hidden" id="domfiscal" size="60" />
                                            <span style="color:#F00">*</span></td>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" ><span class="camposss">Ubigeo</span></td>
                                          <td height="0" >&nbsp;</td>
                                          <td height="0" colspan="5" valign="middle"><table width="500" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="381"><input name="ubigen" type="text" id="ubigen" size="50" />
                                                <span style="color:#F00">*</span></td>
                                              <td width="119"><a id="buscaubbigeoo" href="#" onclick="mostrar_desc('buscaubi')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
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
                                          <td width="155" height="30"><input type="text" name="fechaconstitu" class="tcal" style="text-transform:uppercase" id="fechaconstitu" /></td>
                                          <td width="15" height="30" >&nbsp;</td>
                                          <td width="138" height="30" align="right" ><span class="camposss">Nº de Registro</span></td>
                                          <td width="14" height="30" >&nbsp;</td>
                                          <td height="30" ><input type="text" name="numregistro" style="text-transform:uppercase" id="numregistro" /></td>
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
                                          <td width="141" height="30" align="right" ><span class="camposss">Telefono</span></td>
                                          <td width="10" height="30" >&nbsp;</td>
                                          <td height="30"><label>
                                            <input type="text" name="telempresa" style="text-transform:uppercase" id="telempresa" />
                                          </label></td>
                                          <td height="30">&nbsp;</td>
                                          <td height="30" align="right" ><span class="camposss">CIIU</span></td>
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
                                          </label>
                                            <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 8px; top: 110px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="24" height="29">&nbsp;</td>
                                                  <td width="585" class="camposss">Seleccionar Ubigeo:</td>
                                                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td><label>
                                                    <input name="_buscaubi" type="text" id="_buscaubi" size="50" onkeypress="buscaubigeos()" style="text-transform:uppercase; background:#FFF;" />
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
                                          <td height="30" colspan="5" ><a  onclick="btngrabaremp()"><img src="iconos/grabar.png" width="94" height="29" border="0" />
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
<!---------------------------------------------------------------------------------------->                      
<div id="clientenewdni" class="dalib" style="display:none; z-index:7;">
                          <table width="760" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18" height="29">&nbsp;</td>
                              <td width="707" class="submenutitu">Agregar Cliente</td>
                              <td width="35"><a  onclick="ocultar_desc('clientenewdni')"><img src="iconos/cerrar.png" width="21" height="20" /></a></td>
                            </tr>
                            <tr>
                              <td colspan="3"><table width="724" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="724" height="54" bgcolor="#FFFFFF"><div id="busclie" style=" width:720px; height:230px; overflow:auto">
                                    <table width="607" border="0" align="center" cellpadding="0" cellspacing="0">
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
    <td height="30" colspan="3"><input name="direccion" style="text-transform:uppercase" type="text" id="direccion" size="55" /><span style="color:#F00">*</span></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td height="44" align="right"><span class="camposss">Ubigeo :</span></td>
    <td height="44" colspan="3"><table width="471" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="336"><input name="ubigensc" readonly="readonly" type="text" id="ubigensc" size="25" /><span style="color:#F00">*</span></td>
        <td width="135"><a href="#" onclick="mostrar_desc('buscaubisc')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
      <div id="buscaubisc" style="position:absolute; display:none; width:637px; height:223px; left: -8px; top: 146px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
        <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Ubigeo:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaubisc')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <input name="_buscaubisc" type="text" id="_buscaubisc"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onkeypress="buscaubigeossc()" /></td>
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
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Estado Civil :</span></td>
    <td height="30"><select name="idestcivil" id="idestcivil">
      <option value = "0" selected="selected">SELECCIONE ESTADO</option>
      <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil",$conn) or die(mysql_error());
		  while($rowcicil=mysql_fetch_array($civil)){
		  echo "<option value = ".$rowcicil["idestcivil"].">".nl2br($rowcicil["desestcivil"])."</option>";  
		  }
		?>
    </select></td>
    <td height="30" colspan="2" align="left"><div id="casado" style="display:none">
      <table width="272" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139" align="right"><span class="camposss">Conyuge :</span></td>
          <td width="133"><a href="#" onclick="mostrar_desc('conyugesss')"><img src="iconos/grabarconyuge.png" width="111" height="29" border="0" /></a></td>
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
    </select></td>
    <td height="30" align="right">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Nacionalidad :</span></td>
    <td height="30"><select name="nacionalidad" id="nacionalidad" style="width:150px;">
      <option value = "23" selected="selected">PERUANA</option>
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
    <td height="30" align="right"><span class="camposss">Telefono Cel. :</span></td>
    <td height="30"><input name="telcel" type="text" id="telcel" size="20" /></td>
    <td height="30" align="right"><span class="camposss">Telefono Oficina :</span></td>
    <td height="30"><input name="telofi" type="text" id="telofi" size="20" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30" align="right"><span class="camposss">Telefono Fijo :</span></td>
    <td height="30"><input name="telfijo" type="text" id="telfijo" size="20" /></td>
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
    <td height="30"><a  onclick="ggclie1()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
    <td height="30">&nbsp;</td>
    <td height="30"><input name="codubisc" type="hidden" id="codubisc" size="15" /><input name="idprofesion" type="hidden" id="idprofesion" size="15" value="0" /><input name="idcargoo" type="hidden" id="idcargoo" size="15" value="0" />
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

<!-------------------------------------------------------------------------------------------->

<div id="tlibros" style="position:absolute; display:none; width:637px; height:110px; left: 87px; top: 339px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
  <table width="637" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24" height="29">&nbsp;</td>
      <td width="585"><strong><span class="camposss">Seleccionar Tipo Libro:</span></strong></td>
      <td width="28"><a href="#" onClick="ocultar_desc('tlibros')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><select name="tlibro" id="tlibro" onchange="mostrartipolibro()" >
                  <option value="Ninguno" selected="selected">Seleccionar</option>
                  <?php 
				  
				   while($rowtlibro=mysql_fetch_array($sqltlibro)){
		          echo "<option value = ".$rowtlibro['idtiplib'].">".nl2br($rowtlibro['destiplib'])."</option>";  
		           }
				  ?>
                </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
</body>
</html>
