<?php 
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
	$num_crono   = $_REQUEST["num_crono"];
	$fecha_crono = $_REQUEST["fecha_crono"];
	$num_formu   = $_REQUEST["num_formu"];
	$lugar_formu = $_REQUEST["lugar_formu"];
	$observacion = $_REQUEST["observacion"];
	
?>
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
	 $("#dialog").dialog();

	})
	function fguardaObservacion(){ pasadatos();}

	function pasadatos()
	{
		var _num_crono = document.getElementById('num_crono').value;
		var _fecha_crono = document.getElementById('fecha_crono').value;
		var _num_formu = document.getElementById('num_formu').value;
		var _lugar_formu = document.getElementById('lugar_formu').value;
		var _observacion = document.getElementById('observacion').value;
		
		document.getElementById('num_cronoG').value = _num_crono;
		document.getElementById('fecha_cronoG').value = _fecha_crono;
		document.getElementById('num_formuG').value = _num_formu;
		document.getElementById('lugar_formuG').value = _lugar_formu;
		document.getElementById('observacionG').value = _observacion;
		
		document.getElementById('num_crono').value = '';
		document.getElementById('fecha_crono').value = '';
		document.getElementById('num_formu').value = '';
		document.getElementById('lugar_formu').value = '';
		document.getElementById('observacion').value = '';
		
		alert('Se agregaron los datos satisfactoriamente');
	}


</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
  <td>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td >
    <fieldset>
    <legend></legend>
    <table  width="100%">
        <tr>
          <td colspan="4"><table  width="100%">
            <tr>
              <td colspan="6" align="center">.::PERMISOS DE VIAJE::.</td>
              </tr>
            <tr>
              <td width="14%"></td>
              <td width="17%"><input name="num_crono" type="hidden" id="num_crono" style="text-transform:uppercase" size="15"  value="<?php echo $num_crono; ?>" />
                <input name="num_formu" type="hidden" id="num_formu" style="text-transform:uppercase" size="10" value="<?php echo $num_formu; ?>" /></td>
              <td width="17%"><!--Fecha:--></td>
              <td width="20%"><input name="fecha_crono" type="hidden" id="fecha_crono" style="text-transform:uppercase" size="15" value="<?php echo $fecha_crono; ?>" /></td>
              <td width="16%">&nbsp;</td>
              <td width="16%">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td width="14%"> <span class="camposss">A:</span></td>
          <td colspan="3"><input name="lugar_formu" type="text" id="lugar_formu" style="text-transform:uppercase" size="60" value="<?php echo $lugar_formu; ?>" /></td>
          </tr>
        <tr>
          <td> <span class="camposss">Observaciones</span></td>
          <td colspan="3" rowspan="2" valign="top"><label for="obs"></label>
            <textarea name="observacion" style="text-transform:uppercase;" id="observacion" cols="57" rows="3"><?php echo $observacion; ?></textarea></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="center">&nbsp;</td>
          </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30" align="right" >&nbsp;</td>
  </tr>
</table>
