<?php 
session_start();

include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
$id_viaje  = $_REQUEST['id_viaje'];	

$consulpermiviaje = mysql_query("SELECT permi_viaje.*, DATE_FORMAT(permi_viaje.fec_ingreso,'%d/%m/%Y') as 'eval_fecingreso', DATE_FORMAT(permi_viaje.fecha_crono,'%d/%m/%Y') AS 'eval_fechacrono' FROM permi_viaje WHERE permi_viaje.id_viaje='$id_viaje'", $conn) or die(mysql_error());
$rowcpermiso = mysql_fetch_array($consulpermiviaje);

$numkar = $rowcpermiso['num_kardex'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

#####
$numpermiso = "01-2013.odt";	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de permisos de viaje</title>
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
	
	
	
body {
	background-color: #FFF;
}
</style>
<script type="text/javascript">


// NUMEROS
	function NumCheck(e, field) 
	{
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


$(document).ready(function(){ 

	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	 
	 $(".ui-dialog-titlebar").hide();
	 
	 var _idviaje = $("#id_viaje").val();
	 
	 $("#div_muesStatusNC").load("../model/statusNOCORRE.php",{ idviaje : _idviaje }, function(){
		 		if($("#div_muesStatusNC").html()!='')
					{
						$("#Grabar").attr('disabled','disabled');
						$("#Generar").attr('disabled','disabled');
						$("#nocorre").attr('disabled','disabled');	
					}
		 });
	
	// div ver documento	 
		//$("#verdocumen").attr('style','display:none');	 
		 
	})

	
	function fGraba()
	{
			$( "#muesguarda" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: {
					"Actualizar": function() { fevalguarda();
						//$( this ).dialog( "close" );
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
	}

	function fevalguarda()
	{
		feditaPermiviaje();
		$("#muesguarda").dialog("close");
	}


	function fShowDatosProvee(evento) //
	{			
				var _numdoc		= document.getElementById('numdoc').value;
				var _remitente  = document.getElementById('remitente');
				var _direccion  = document.getElementById('direccion_remi');
				var _telefono  = document.getElementById('telefono');
				
				if(evento.keyCode==13) 
					{
						
						if(_numdoc==''){alert('Ingrese un numero de documento');return;}
						
						var _des = fShowAjaxDato('../includes/remitente.php?numdoc='+_numdoc);
						document.getElementById('remitente').value=_des;
						
						var _direcc = fShowAjaxDato('../includes/direccion.php?numdoc='+_numdoc);
						document.getElementById('direccion_remi').value=_direcc;
						
						var _telf = fShowAjaxDato('../includes/telefono.php?numdoc='+_numdoc);
						document.getElementById('telefono').value=_telf;
						
						if(_remitente==''){alert('No se encuentra registrado');return;}
					}
	}


	function fElimina()
	{
		if(confirm('Desea eliminar este permiso de viaje...?'))
		{
			fElimPermiviaje();	
		}
		else 	{return;}
	}

	function fmuesContratantes()
	{	
		var _id_viaje = document.getElementById('id_viaje').value;
	
		$('<div id="div_participantes" title="div_participantes"></div>').load('PermiParticipantes.php?id_viaje='+_id_viaje)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 800,
					height  : 400,
					modal   : false,
					resizable:false,
					buttons: [{text: "bntAcepPartic", text: "Aceptar", click: function() { $(this).dialog("destroy").remove(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Participantes'
					
					}).width(800).height(400);	
					$(".ui-dialog-titlebar").hide();
		
	}

	function fEditObservacion(){
		
		var _num_crono2   = document.getElementById('num_cronoG').value;
		var _fecha_crono2 = document.getElementById('fecha_cronoG').value;
		var _num_formu2   = document.getElementById('num_formuG').value;
		var _lugar_formu2 = document.getElementById('lugar_formuG').value;
		var _observacion2 = document.getElementById('observacionG').value;
	
	$('<div id="div_editobserv"></div>').load('EditPermiObserva.php?num_crono='+_num_crono2+'&fecha_crono='+_fecha_crono2+'&num_formu='+_num_formu2+'&lugar_formu='+_lugar_formu2+'&observacion='+_observacion2)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 550,
					height  : 240,
					modal:false,
					resizable:false,
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {pasadatos();$(this).dialog("destroy").remove(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Observaciones'
					
					}).width(550).height(240);	
					$(".ui-dialog-titlebar").hide();
	}


	function fGenerar()
	{
		var _id_viaje = document.getElementById('id_viaje');
		var _id_viaje2 = document.getElementById('id_viaje').value;
		
		if(_id_viaje.value=='')
		{alert('Debe ingresar y grabar los datos primero...');return;}
	
	$('<div id="div_generacion" title="div_generacion"></div>').load('PermiViajeGenerar.php?id_viaje='+_id_viaje2)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 500,
					height  : 300,
					modal:false,
					resizable:false,
					buttons: [{id: "btnGenerar", text: "Generar",click: function() {generarFunct();}},
					{id: "btnQuitGenerar", text: "Quitar Generacion",click: function() {QuitaPer(); }},
					//{id: "btnImprimir", text: "Imprimir",click: function() {fImprimir(); }},
										{id: "btnCerrar", text: "Cerrar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Generar Permiso'
					
					}).width(500).height(300);	
					$(".ui-dialog-titlebar").hide();	
	}

	function fImprimir()
		{
			var _tip_permi = document.getElementById('idasunto').value;
			
			
			var _id_viaje = document.getElementById('id_viaje').value;
			if(_id_viaje==''){alert('Debe guardar los datos primero');return;}
		
			var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
			var _nom_notario     = 'Nombre del notario';
			
			var _data = {
							id_viaje        : _id_viaje,
							usuario_imprime : _usuario_imprime,
							nom_notario     : _nom_notario
						}
			
		// #= Evalua el tipo de Permiso:	
		if(_tip_permi=='001')
			{
				$.post("../../reportes_word/generador_permiviaje_interior.php",_data,function(_respuesta){
						alert(_respuesta);
					});
			}
		else if(_tip_permi=='002')
			{
				$.post("../../reportes_word/generador_permiviaje_exterior.php",_data, function(_respuesta){
						alert(_respuesta);
					});	
			}
	}
	
	function fNoCorreViaje()
	{
		var _id_viaje = document.getElementById('id_viaje');
		if(_id_viaje.selectedIndex=='0'){alert('No se ha grabado el permiso');return;}
		
		else 
		{
			$( "#mues_nocorre" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: {
					"Aceptar": function() { fevalNocorre();
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}	
	}

	function fevalNocorre()
	{
		fNocorreAction();
		$("#mues_nocorre").dialog("close");
	}


	function fVisualDocument()
	{
		var _tip_permi = $("#idasunto").val();
		var _id_viaje  = $("#id_viaje").val();
		
		if(_id_viaje==''){alert('Debe guardar los datos primero');return;}
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		var _numdocu         = '<?php echo $numpermiso; ?>';
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);

		if(_tip_permi=='001')
		{
			window.open("genera_permiviaje.php?id_viaje="+_id_viaje+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&numdocu="+_numdocu);
		}
		if(_tip_permi=='002')
		{
			window.open("genera_permiviaje.php?id_viaje="+_id_viaje+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&numdocu="+_numdocu);
		}
		
		
			
	}
// ################################
	function CreateObjectAjax(){
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
		return xmlhttp; }
		
	function AjaxReturn(url,_nom){
		  ajax = CreateObjectAjax();
		  var _pag = '';
		    ajax.open('GET', url,true);
		    ajax.onreadystatechange = function(){
		    if(ajax.readyState == 4 && ajax.status==200)
			{
				if(ajax.responseText=='' )
					{
						alert('Generado Correctamente..!');
						// #= Evalua el tipo de Permiso:	
						if(_tip_permi=='001')
							{
								window.open('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario,'_blank','toolbars=no, scrollbars=no, menubar=no, resizable=no, width=300, height=250');	
							}
						else if(_tip_permi=='002')
							{    
								window.open('../../reportes_word/generador_permiviaje_exterior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario,'_blank','toolbars=no, scrollbars=no, menubar=no, resizable=no, width=300, height=250');			
							}
						
					}
		     _pag = ajax.responseText;
		    }
		  }
	  ajax.send(null);
	}	
// ################################

function maxLengthX(e,obj,num) {
    k = (document.all) ? e.keyCode : e.which;
    if (k==8 || k==0){ return true; }
    else{ return obj.value.length<num; }
}
</script>
</head>
<body style="font-size:62.5%;">
<div id="permisos_viaje">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="35%">
     <?php
				$oBarra->Graba          = "1"                 ;
				$oBarra->GrabaClick     = "fGraba();"         ;
				$oBarra->Genera         = "1"                 ;
				$oBarra->GeneraClick    = "fGenerar();"       ;
				$oBarra->Impri          = "1"                 ;
				$oBarra->ImpriClick     = "fImprimir();"      ;
				$oBarra->clase          = "css"      		  ; 
				$oBarra->widthtxt       = "20"				  ; 
				$oBarra->Show()  						      ; 
				?>
    </td>
   
    <td width="13%" align="left"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
    <td width="24%" align="left"><?php
	  
	  $numcartanext = intval($_REQUEST['id_viaje']) + 1;
	  $numcartaante = intval($_REQUEST['id_viaje']) - 1;
	  echo"<a href='EditPermiViajeVie.php?id_viaje=".$numcartaante."'><img src='../../imagenes/ante.fw.png' width='29' height='29'></a> ";
	  echo " | ";
	  echo"<a href='EditPermiViajeVie.php?id_viaje=".$numcartanext."'><img src='../../imagenes/next.fw.png' width='29' height='29'></a> ";?></td>
    <td width="17%" align="left"><div id="div_muesStatusNC"></div></td>
    <td width="16%">
	  <input name="numcartabusca" type="text" id="numcartabusca" size="17"> 
	  -</td>
	<td width="10%"><label for="anio"></label>
	  <input name="anio" type="text" id="anio" size="10" maxlength="4" value="2014"></td>
	<td width="7%"><a onClick="busca_num_carta();"><img src="../../imagenes/lupa.fw.png" width="29" height="29" ></a></td>   
     <td width="11%" align="right"> <button title="No corre" type="button" name="nocorre"    id="nocorre" value="no corre" onclick="fNoCorreViaje();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />No Corre</button></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td>
    <fieldset>
    <legend></legend>
    <table  width="100%">
        <tr>
          <td colspan="4"><table  width="100%">
            <tr>
              <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea actualizar el Permiso..?</div><div id="mues_nocorre" title="Confirmacion" style="display:none">Se cambiara el estado del permiso a : NO CORRE</div><div id="confirmaGuarda"></div></td>
            </tr>
            <tr>
              <td width="14%"><span class="camposss">Nro Control:</span></td>
              <td width="17%">
              <input name="id_viaje" type="text" id="id_viaje" value="<?php echo $rowcpermiso['id_viaje']; ?>" size="15" readonly />
              <input name="numkardex" type="hidden" id="numkardex" style="text-transform:uppercase" value="<?php echo $rowcpermiso['num_kardex']; ?>" size="15" readonly />
              <input name="muescronologico" type="hidden" id="muescronologico" style="text-transform:uppercase" value="<?php echo $numkar2; ?>" size="15" readonly />
              </td>
              <td width="22%" align="right"><span class="camposss">Encargado:</span></td>
              <td width="25%"><input name="recepcionado" type="text" id="recepcionado" style="text-transform:uppercase" value="<?php echo $rowcpermiso['nom_recep']; ?>" size="15" /></td>
              <td width="6%"><span class="camposss">Hora:</span></td>
              <td width="16%"><input name="horarecep" type="text" id="horarecep" style="text-transform:uppercase" value="<?php echo $rowcpermiso['hora_recep']; ?>" size="10" /></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td width="19%"><span class="camposss">Tipo Permiso:</span></td>
          <td colspan="3"><?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT asunto_viaje.cod_asunto AS 'id', asunto_viaje.des_asunto AS 'des' FROM asunto_viaje"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "idasunto";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   = $rowcpermiso['asunto'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
<input name="idasunto" type="hidden" id="idasunto" style="text-transform:uppercase" value="<?php echo $rowcpermiso['asunto']; ?>" size="2" />&nbsp;<input name="desasunto" type="hidden" id="desasunto" style="text-transform:uppercase" value="<?php echo $rowcpermiso['asunto']; ?>" size="7" /> <input name="asunto" type="hidden" id="asunto" style="text-transform:uppercase" value="<?php echo $rowcpermiso['asunto']; ?>" size="40" /></td>
          </tr>
        <tr>
          <td><span class="camposss">Fec. Ingreso</span></td>
          <td width="10%"><input name="fecingreso" class="tcal" type="text" id="fecingreso" style="text-transform:uppercase" value="<?php echo $rowcpermiso['eval_fecingreso']; ?>" size="10" /></td>
          <td width="14%"><span class="camposss">Referencia:</span> </td>
          <td width="57%"><input name="referencia" type="text" id="referencia" style="text-transform:uppercase" value="<?php echo $rowcpermiso['referencia']; ?>" size="50" maxlength="400" /></td>
          </tr>
        <tr>
          <td><span class="camposss">Comunicarse con:</span> </td>
          <td><input name="nom_comu" type="text" id="nom_comu" style="text-transform:uppercase" value="<?php echo $rowcpermiso['nom_comu']; ?>" size="30" maxlength="400" /></td>
          <td><span class="camposss">Telefono:</span> </td>
          <td><input name="tel_comu" type="text" id="tel_comu" style="text-transform:uppercase" value="<?php echo $rowcpermiso['tel_comu']; ?>" size="10" onKeyPress="return NumCheck(event, this);" maxlength="200" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Email:</span></td>
          <td><input name="email_comu" type="text" id="email_comu"  value="<?php echo $rowcpermiso['email_comu']; ?>" size="30" maxlength="200" /></td>
          <td><!--Documento (pagado):--></td>
          <td><input name="doc_comu" type="hidden" id="doc_comu" style="text-transform:uppercase" value="<?php echo $rowcpermiso['documento']; ?>" size="20" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Viaja a: </span></td>
          <td><input style="text-transform:uppercase" name="lugar_formuG" type="text" id="lugar_formuG" size="30" value="<?php echo $rowcpermiso['lugar_formu']; ?>" maxlength="400" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><span class="camposss">Observaciones: </span></td>
          <td colspan="3"><textarea onkeypress="return maxLengthX(event,this,1000);" name="observacionG" style="text-transform:uppercase;" id="observacionG" cols="100" rows="3"><?php echo $rowcpermiso['observacion']; ?></textarea></td>
          </tr>
        <tr>
          <td colspan="2" align="center"><button title="Contratantes" type="button" name="btncontratantes"    id="btncontratantes" value="contratantes" onclick="fmuesContratantes();" ><img src="../../images/newuser.png" width="20" height="20" align="absmiddle" />&nbsp; Participantes</button></td>
          <td colspan="2" align="center"><!--<button title="Observacion" type="button" name="btnobs"    id="btnobs" value="observacion" onclick="fEditObservacion();" ><img src="../../images/obs.png" width="20" height="20" align="absmiddle" />&nbsp; Observacion</button>--></td>
          </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30" align="right" >
    <input name="num_cronoG" type="hidden" id="num_cronoG" value="<?php echo $rowcpermiso['num_crono']; ?>" />
    <input name="fecha_cronoG" type="hidden" id="fecha_cronoG" value="<?php echo $rowcpermiso['eval_fechacrono']; ?>" />
    <input name="num_formuG" type="hidden" id="num_formuG" value="<?php echo $rowcpermiso['num_formu']; ?>" />
    <!--<input name="lugar_formuG" type="hidden" id="lugar_formuG" value="<?php echo $rowcpermiso['lugar_formu']; ?>" />-->
    <!--<input name="observacionG" type="hidden" id="observacionG" value="<?php echo $rowcpermiso['observacion']; ?>" />-->
</td>
  </tr>
</table>
</div>
</body>
</html>