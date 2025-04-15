<?php 
session_start();

	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
	$id_viaje = $_REQUEST["id_viaje"];
	$fecha_crono = $_REQUEST["fecha_crono"];
	$num_formu = $_REQUEST["num_formu"];
	$lugar_formu = $_REQUEST["lugar_formu"];
	$observacion = $_REQUEST["observacion"];

	$consulpermiviaje = mysql_query("SELECT permi_viaje.*, DATE_FORMAT(permi_viaje.fecha_crono,'%d/%m/%Y') AS 'eval_fechacrono' FROM permi_viaje WHERE permi_viaje.id_viaje='$id_viaje'", $conn) or die(mysql_error());
	$rowcpermiso = mysql_fetch_array($consulpermiviaje);
	$numkar = $rowcpermiso['num_kardex'];
	$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);
	
	## Comprobar numero de formulario:
	$consulnumformu = mysql_query("SELECT MAX(permi_viaje.num_formu) FROM permi_viaje", $conn) or die(mysql_error());
	$rownumformu = mysql_fetch_array($consulnumformu);
	$formu_anterior = $rownumformu[0];

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
	 $("button").button();
	 $("#dialog").dialog();
	})


	function pasadatos()
	{
		var _eval = document.getElementById('num_crono').value; 
			if(_eval=='')
			{	
				fGenerapermiviaje();
			}
			else{alert('Ya se encuentra generado...');return;}	
	}

	function generarFunct()
	{
		// Verifica Nro. Formulario Existente.
		var _numformu     = document.getElementById('num_formu');
		var _numformu_ant = document.getElementById('num_formu_ant');
		
			if(_numformu.value == '')
				{   alert('Debe ingresar el Nro.Formulario');return;}
			else
				{   pasadatos();	}
	}
//// quita el numero de cronologico
	function QuitaPod(){
		var _numformu 	  = document.getElementById('num_formu');
		var _numformu_ant = document.getElementById('num_formu_ant');
		
			if(_numformu.value != '')
				{ pasadatosQuitar(); }
			else
				{
				 alert('No existe Nro.Formulario a Eliminar');return; 	
				}
	}
	function pasadatosQuitar()
	{
		var _eval = document.getElementById('num_crono').value;
		if(_eval!='')
			{fGeneraNumPoderQuitar();}
		else
			{alert('Todavia no se encuentra Generado..!');return;}
			
	}
	
	
	
	
function fGeneraNumPoderQuitar()
{
	var _id_viaje    = $("#id_viajeG").val(); 
	var _fecha_crono = $("#fecha_crono").val();
	var _num_formu   = $("#num_formu").val();  //num_crono
	var _num_crono   = $("#num_crono").val();
	
	$.post("../model/quitaGeneraViaje.php",{ id_viaje : _id_viaje, num_formu : _num_formu , num_crono : _num_crono , fecha_crono : _fecha_crono}, function(_response){
		
		//$("#div_numcrono").html(_response);
		$("#div_confirmacion").html("<div class='ui-state-highlight' style='font-family: Calibri; font-style: italic; font-size: 15px; color: #333333;'><center>Se Actualizo Satisfactoriamente</center></div>");
		//$("#div_numcrono").val("ssssssss");
			//
		})	;
}
		$('#btnCerrar').click( function() { 
	
		$("#div_generacion").remove();//.destroy();	
	});
	
	
	
	
	
	
	function pasadatosPod_quit(){
		var _numformu 	  = document.getElementById('num_formu');
		var _numformu_ant = document.getElementById('num_formu_ant');
		
			if(_numformu.value == '')
				{alert('Debe ingresar el Nro.Formulario');return;}
			else
				{
				  pasadatos();	
				}
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
          <td colspan="5">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="5" align="center"> .::GENERAR PERMISO DE VIAJE::. </td>
          </tr>
        <tr>
          <td><span class="camposss">Nro Formulario:</span></td>
          <td colspan="3"><div id="div_numform" style="width:100px;"><input name="num_formu" type="text" id="num_formu" style="text-transform:uppercase" value="<?php echo $rowcpermiso['num_formu']; ?>" size="15" /></div></td>
          <td align="left">
            <input name="num_formu_ant" type="hidden" disabled="disabled" id="num_formu_ant" style="color:#F00; cursor:pointer; border:none; border-color:transparent; text-shadow:#000; font:bold; font-size:15px" value="<?php echo $rownumformu[0]; ?>" size="4" readonly="readonly" /></td>
        </tr>
        <tr>
          <td width="20%"><span class="camposss">Nro. Cronologico:</span></td>
          <td colspan="3"><div id="div_numcrono" style="width:100px;"><input name="num_crono" type="text" id="num_crono" style="text-transform:uppercase" value="<?php if($rowcpermiso['fecha_crono']=='' or $rowcpermiso['eval_fechacrono']=='0000-00-00' or $rowcpermiso['eval_fechacrono']=='00/00/0000'){echo "";}else {echo $numkar2;} ?>" size="15"  placeholder="Autogenerado" /></div></td>
          <td width="51%">&nbsp;</td>
          </tr>
        <tr>
          <td><span class="camposss">Fecha:</span></td>
          <td colspan="3" valign="top"><label for="obs">
            <input name="fecha_crono" type="text" id="fecha_crono" style="text-transform:uppercase" size="15" value="<?php if($rowcpermiso['eval_fechacrono']=='' or $rowcpermiso['eval_fechacrono']=='0000-00-00' or $rowcpermiso['eval_fechacrono']=='00/00/0000' ){echo date("d/m/Y");}else {echo $rowcpermiso['eval_fechacrono']; } ?>" />
          </label></td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5" align="center"><span style="width:100px;">
            <input name="id_viajeG" type="hidden" id="id_viajeG" style="text-transform:uppercase" value="<?php echo $id_viaje;?>" size="15" />
          </span></td>
        </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30" align="center" ><div style="width:80%;" id="div_confirmacion"></div></td>
  </tr>
</table>
