<?php 
	include("conexion.php");
	
	$id_poder = $_REQUEST["id_poder"];
	$id_contrata = $_REQUEST["id_contrata"];
	$fecha_crono = $_REQUEST["fecha_crono"];
	$num_formu = $_REQUEST["num_formu"];
	$lugar_formu = $_REQUEST["lugar_formu"];
	$observacion = $_REQUEST["observacion"];
	$anio = $_REQUEST["anio"];


	$consulpermiviaje = mysql_query("SELECT protesto.*, DATE_FORMAT(protesto.fec_notificacion,'%d/%m/%Y') AS 'fec_notificacion2' FROM protesto WHERE protesto.id_protesto='$id_poder' and protesto.anio='$anio'", $conn) or die(mysql_error());
	$rowcpermiso = mysql_fetch_array($consulpermiviaje);
	$numkar = $rowcpermiso['num_protesto'];
	$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);



	## Comprobar numero acta anterior:
	$consulnumformu = mysql_query("SELECT MAX(protesto.num_protesto) FROM protesto", $conn) or die(mysql_error());
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
	 $("#dialog").dialog();
	})
function fImprimiraval()
	{
		var _id_prote = document.getElementById('id_poderG').value;
		var _id_contrata = document.getElementById('id_contrataG').value;
		var _anio = document.getElementById('anio').value;
		if(_id_prote==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
		var _data = {
						id_prote       : _id_prote,
						id_contrata	   : _id_contrata,
						usuario_imprime : _usuario_imprime,
						nom_notario     : _nom_notario,
						anio     : _anio
					}
		
		
		$.post("reportes_word/generador_protesto_aval.php",_data,function(_respuesta){
						alert(_respuesta);
					});	
	}

	function fImprimirdeudor()
	{
		var _id_prote = document.getElementById('id_poderG').value;
		var _id_contrata = document.getElementById('id_contrataG').value;
		var _anio = document.getElementById('anio').value;
		if(_id_prote==''){alert('Debe guardar los datos primero');return;}
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
		var _data = {
						id_prote       : _id_prote,
						id_contrata	   : _id_contrata,
						usuario_imprime : _usuario_imprime,
						nom_notario     : _nom_notario,
						anio     : _anio
					}
		
		
		$.post("reportes_word/generador_protesto_deudor.php",_data,function(_respuesta){
						alert(_respuesta);
					});
			
	}
	
function fVisualDocument1()
	{
		var eval_numprote = document.getElementById('id_prote').value;
		var _anio = document.getElementById('anio').value;
		if(eval_numprote == ''){alert('Debe generar Nro Control');return;}

	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';

		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_protesto_deudor.php?num_protesto="+eval_numprote+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&anio="+_anio);		
	}
	
	
function fVisualDocument2()
	{
		var eval_numprote = document.getElementById('id_prote').value;
		var _anio = document.getElementById('anio').value;
		if(eval_numprote == ''){alert('Debe generar Nro Control');return;}

	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';

		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_protesto_aval.php?num_protesto="+eval_numprote+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&anio="+_anio);		
	}


	$('#btnCerrar').click( function() { 
	
		$("#div_generacion").remove();//.destroy();	
	});
	
</script>
<table width="95%" border="0" BGCOLOR="#CCCCCC" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
  <td>
  <table width="95%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td >

    <table  width="95%" BGCOLOR="#CCCCCC">
     <tr><td>&nbsp;</td></tr>
        <tr>
          <td width="71%" align="right"><SPAN style="color:#333;font-size:24px; font-weight:bold; font-style:italic">NOTIFICACIONES</SPAN></td>
		  <td><input name="id_poderG" type="hidden" id="id_poderG" value="<?php echo $id_poder;?>" size="15" /><input name="anio" type="hidden" id="anio" value="<?php echo $anio;?>" size="15" />
          	  <input name="id_contrataG" type="hidden" id="id_contrataG" value="<?php echo $id_contrata;?>" size="15" /></td>
          </tr>
           <tr><td>&nbsp;</td></tr>
        </table>

      </td>
    </tr>
  <tr>
    <td height="30" align="center" ><div style="width:80%;" id="div_confirmacion"></div></td>
  </tr>
</table>
