<?php 
session_start();
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
	
$codigo  = $_REQUEST['codigo'];	

$consulpoder = mysql_query("SELECT * FROM servicios WHERE servicios.codigo='$codigo'", $conn) or die(mysql_error());
$rowpoder = mysql_fetch_array($consulpoder);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mantenimiento de Servicios</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/ext_script1.js"></script> 
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
	 
	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	 $('#tiposervi').val('<?php echo $rowpoder['tipo']; ?>');
	 
	})

	jQuery(function($){
		$("#fec_ingreso").mask("99/99/9999",{placeholder:" "});
	});

function agregar()
{
	document.getElementById('id_domiciliario').value = '';
	document.getElementById('num_certificado').value = '';
	document.getElementById('fec_ingreso').value = '';
	document.getElementById('num_formu').value = '';
	document.getElementById('nombre_solic').value = '';
	document.getElementById('tipdoc_solic').value = '';
	document.getElementById('numdoc_solic').value = '';
	document.getElementById('domic_solic').value = '';
	document.getElementById('motivo_solic').value = '';
	document.getElementById('distrito_solic').value = '';
	document.getElementById('texto_cuerpo').value = '';
	document.getElementById('justifi_cuerpo').value = '';
}

	function fGraba()
	{
		$( "#muesguarda" ).dialog({
					resizable: false,
					height:140,
					position :["center","top"],
					modal: true,
					buttons: {
						"Aceptar": function() { fevalguarda(); },
						"Cancelar": function() {$( this ).dialog( "close" );}
							 }
				});			
	}
	
	function fElimina()
	{
		$( "#mueselim" ).dialog({
					resizable: false,
					height:140,
					position :["center","top"],
					modal: true,
					buttons: {
						"Aceptar": function() { fevalElimina(); },
						"Cancelar": function() {$( this ).dialog( "close" );}
							 }
				});			
	}

	function fevalguarda()
	{
		fgrabservicios2();	
		$("#muesguarda").dialog("close");
	}
	
	function fevalElimina()
	{
		var _codigoservi = $("#codigoservi").val();
		
		// evalua si el servicio ha sido usado anteriormente.
		$.post("../model/evalServicio.php",{codigoservi : _codigoservi}, function(_respuesta){
				if(_respuesta != '')  // no elimina si esta siendo utilizado
				{
						alert("El servicio se encuentra utilizado \n No se puede eliminar..!!");
						$("#mueselim").dialog("close");
						return;
				}
				else{// elimina si no esta siendo utilizado
						$.post("../model/elimServicio.php", {codigoservi : _codigoservi}, function(){
							$("#mueselim").dialog("close");			
							$("#confirmaGuarda").html("<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;margin:0 auto;border: 2px solid #ddd; border-radius: 10px;padding: 2px; box-shadow: #ccc 5px 0 5px; margin-bottom:0px;'><center>Eliminado satisfactoriamente</center></div>");
							$("#Grabar").attr("style","display:none");
							$("#Elimi").attr("style","display:none");
						});
					
					}
			})

		
	}


	function focus1(evento)
	  {if(evento.keyCode==13){document.getElementById('servcant').select();}} 


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

</script>
</head>

<body style="font-size:62.5%;">
<div id="carta_content">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
    <tr><td>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
     <?php
				$oBarra->Graba        = "1"               ;
				$oBarra->GrabaClick   = "fGraba();"       ;
				$oBarra->Elimi        = "1"           	  ;
				$oBarra->ElimiClick   = "fElimina();"  	  ;
				$oBarra->clase        = "css"      		  ; 
				$oBarra->widthtxt     = "20"			  ; 
				$oBarra->Show()  						  ; 
				?>
    </td>
</tr>
</table>
  </td></tr>
  <tr>
    <td ><table  width="100%">
      <tr>
        <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar el Servicio..?</div><div id="mueselim" title="Confirmacion" style="display:none">Desea Eliminar el Servicio..?</div><div id="confirmaGuarda">
          <input name="id_domiciliario" type="hidden" id="id_domiciliario" />
          <span class="camposss">
          <input name="justifi_cuerpo" type="hidden" id="justifi_cuerpo" />
          </span></div></td>
        </tr>
      <tr>
        <td width="13%"><span class="camposss">Codigo</span></td>
        <td width="19%"><div id="resul_certi" style="width:100px;"><input name="codigoservi" type="text" id="codigoservi" style="text-transform:uppercase" value="<?php echo $codigo; ?>" size="15" readonly="readonly"/></div></td>
        <td width="11%">&nbsp;</td>
        <td width="23%">&nbsp;</td>
        <td width="14%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <fieldset>
    <legend><strong><span class="camposss"></span></strong></legend>
    <table  width="100%">
        <tr>
          <td width="10%"><span class="camposss">Descripcion:</span></td>
          <td colspan="3"><input name="descriservi" type="text" id="descriservi" style="text-transform:uppercase" size="100" value="<?php echo $rowpoder['descrip']; ?>"/></td>
          </tr>
         
        <tr>
          <td><span class="camposss">Tipo :</span></td>
          <td width="27%" colspan="-1">
            <select name="tiposervi" id="tiposervi" style="text-transform:uppercase;">
              <option value = "0" >SELECCIONE ESTADO</option>
              <option value = "N" <?php if($rowpoder['tipo']=="N"){echo "selected='selected'";}?> >Notarial</option>
              <option value = "R" <?php if($rowpoder['tipo']=="R"){echo "selected='selected'";}?> >Registral</option>
              </select>
            </td>
          <td width="13%" colspan="-1" align="right"><span class="camposss">precio 1 :</span></td>
          <td width="50%" colspan="-1"><input name="servprecio1" type="text" id="servprecio1" style="text-transform:uppercase; text-align:right;" size="15" onkeypress="focus1(event); return NumCheck(event, this);"  value="<?php echo $rowpoder['precio1']; ?>"/>
</td>
        </tr>
        <tr>
          <td><span class="camposss">Abrev :</span></td>
          <td colspan="-1"><input type="text" name="abrevservi" id="abrevservi"value="<?php echo $rowpoder['abrev']; ?>" /></td>
          <td colspan="-1" align="right"><span class="camposss">precio 2:</span></td>
          <td colspan="-1"><input name="servprecio2" type="text" id="servprecio2" style="text-transform:uppercase; text-align:right;"  size="15" onkeypress="focus1(event); return NumCheck(event, this);" value="<?php echo $rowpoder['precio2']; ?>" />
</td>
        </tr>
        <tr>
          <td><span class="camposss">Grupo: </span></td>
          <td colspan="-1"><input type="text" name="gruposervi" id="gruposervi" value="<?php echo $rowpoder['grupo']; ?>"/></td>
          <td colspan="-1" align="right"><span class="camposss">Porcentaje:</span></td>
          <td colspan="-1"><input name="porcenservi" type="text" id="porcenservi" style="text-transform:uppercase" size="15" value="<?php echo $rowpoder['porcentaje']; ?>"/></td>
        </tr>
        <tr>
          <td><span class="camposss">Kardex:</span></td>
          <td colspan="-1"><input type="text" name="kardexservi" id="kardexservi" value="<?php echo $rowpoder['kardex']; ?>" /></td>
          <td colspan="-1" align="right"><span class="camposss">infrrpp:</span></td>
          <td colspan="-1"><input name="infservi" type="text" id="infservi" style="text-transform:uppercase" size="15" value="<?php echo $rowpoder['infrrpp']; ?>"/></td>
        </tr>
        <tr>
          <td><span class="camposss">Activo: 
            
          </span></td>
          <td colspan="-1"><input type="text" name="actiservi" id="actiservi" value="<?php echo $rowpoder['activo']; ?>"/></td>
          <td colspan="-1" align="right"><span class="camposss">Area:</span></td>
          <td colspan="-1"><input name="areaservi" type="text" id="areaservi" style="text-transform:uppercase" size="15" value="<?php echo $rowpoder['area1']; ?>" /></td>
        </tr>
          <tr>
          <td>&nbsp;</td>
          <td colspan="-1">
            <input name="ctaserv" type="hidden" id="ctaserv" />
</td>
          <td colspan="-1" align="right"><span class="camposss">SerArea::</span></td>
          <td colspan="-1"><input name="serarea" type="text" id="serarea" style="text-transform:uppercase" size="15" value="<?php echo $rowpoder['serarea']; ?>"/></td>
        </tr>
        
        </table>
    </fieldset>  
      </td>
    </tr>
 
</table>
</div>
</body>
</html>