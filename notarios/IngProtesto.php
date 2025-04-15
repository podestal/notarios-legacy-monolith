<?php 
session_start();

	include("conexion.php");
	
	require_once("barramenu1.php") ;
	require_once("includes/gridView.php")  ;
	require_once("includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de poderes</title>
<link href="includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link rel="stylesheet" type="text/css" href="includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="protesto.css" />

<script type="text/javascript" src="tcal.js"></script> 
<script type="text/javascript" src="ajax.js"></script> 
<script src="includes/jquery-1.8.3.js"></script>
<script src="includes/js/jquery-ui-notarios.js"></script>
<script src="includes/jquery.uniform.min.js"></script>
<script src="includes/maskedinput.js"></script>

<script type="text/javascript">
$(document).ready(function(){ 

	 $("button").button();
	 $("#dialog").dialog();
	 $("input, textarea").uniform();
	 $( "#dialog:ui-dialog" ).dialog( "destroy" );
	 
	 
	$("#chk_si").prop("checked",true);
	
	})
	
	jQuery(function($){
		$("#fecentrega").mask("99/99/9999",{placeholder:"_"});
		$("#horaentrega").mask("99:99 aa",{placeholder:"_"});
		$("#fecrecogio").mask("99/99/9999",{placeholder:"_"});
		
	});
	
	function fEdita(){ feditaCarta(); }

	function fElimina()
	{
		var _numcarta = document.getElementById('numcarta').value;
		if(confirm('eliminar datos de la carta notarial N. '+_numcarta+' ?'))
		{	fElimCarta(); }	
		else{return;}
	}

	function fini(){	document.getElementById('idzona').value = '<?php echo $rowcarta['zona_destinatario']; ?>';	}


	function fmuescontenido()
	{
		var divobs = $('<div id="div_ayudacarta" title="div_ayudacarta"></div>');
		$('<div id="div_ayudacarta" title="div_ayudacarta"></div>').load('CartasAyuda.php')
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 550,
						height  : 250,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {pasadatos();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() { $(this).dialog("destroy").remove(); }}],
						title:'Ayuda Cartas'
						
						}).width(550).height(250);	
						$(".ui-dialog-titlebar").hide();		
	}

	function newParticipante()
	{
		$('<div id="div_newpartic" title="div_newpartic"></div>').load('NewRemitente.php')
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 720,
						height  : 350,
						modal:false,
						resizable:false,
						buttons: [{id: "btnAcepPartic2", text: "Aceptar",click: function() {evalGuardaParticipante();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Agregar participantes'
						
						}).width(720).height(350);	
						$(".ui-dialog-titlebar").hide();		
	}

	function fImprimir()
	{
		var _id_prote = document.getElementById('id_prote').value;
		if(_id_prote==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
		var _data = {
						id_prote       : _id_prote,
						usuario_imprime : _usuario_imprime,
						nom_notario     : _nom_notario
					}
		
		
		$.post("reportes_word/generador_protesto.php",_data,function(_respuesta){
						alert(_respuesta);
					});
			
	}


    function fShowDatosProvee(evento)
		{			
			var _numdoc		= document.getElementById('numdoc').value;
			var _remitente  = document.getElementById('remitente');
			var _direccion  = document.getElementById('direccion_remi');
			var _telefono   = document.getElementById('telefono');
			
			if(evento.keyCode==13) 
				{
					if(_numdoc==''){alert('Ingrese un numero de documento');return;}
					
					var _des = fShowAjaxDato('../includes/remitente.php?numdoc='+_numdoc);
					document.getElementById('remitente').value = _des;
					
					var _direcc = fShowAjaxDato('../includes/direccion.php?numdoc='+_numdoc);
					document.getElementById('direccion_remi').value=_direcc;
					
					var _telf = fShowAjaxDato('../includes/telefono.php?numdoc='+_numdoc);
					document.getElementById('telefono').value=_telf;
					
					if(_remitente.value==''){alert('No se encuentra registrado');
					$('#numdoc').val('');
					$('#remitente').val('');
					$('#direccion_remi').val('');
					$('#telefono').val('');
					return; }
				}
		}


function fVisualDocument()
	{
		var eval_numcarta = document.getElementById('numcarta').value;
		
		if(eval_numcarta == ''){alert('Debe guardar los datos primero');return;}
		var _numcarta     = document.getElementById('muesnumcarta').value;
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';

		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_carta.php?numcarta="+_numcarta+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);
			
	}

function remitente1(){
 valord=document.getElementById('remitente').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('remitente1').value=textod;

}
function direccionremi1(){
 valord=document.getElementById('direccion_remi').value;
 textod=valord.replace(/&/g,"*");
 document.getElementById('direccion_remi1').value=textod;

}

	function fGraba()
	{
				var _hora_recep = document.getElementById('hora_recep') ;
				var _id_asunto  = document.getElementById('cod_tipop') 	;
			
		if(  _hora_recep.value=='' || cod_tipop.value=='')
		{alert('Faltan Ingresar datos');return;}
		
		else {
		$( "#muesguarda" ).dialog({
					resizable: false,
					height:140,
					position :["center","top"],
					modal: true,
					buttons: {
						"Aceptar": function() { fevalguarda();
						},
						"Cancelar": function() {
							$( this ).dialog( "close" );
						}
					}
				});
		
		}
	} 
	
	function fevalguarda()
	{

		fSaveIngProtestos();
		$("#muesguarda").dialog("close");
	}

	function fadd(_obj)
	{
	if(_obj == true){
		
		document.getElementById('chk_no').checked = false;
	 	var _num = parseInt(document.getElementById('text_check').value);
			document.getElementById('text_check').value = 1;
		}
	else 	{
		

	 	var _num = parseInt(document.getElementById('text_check').value);
			document.getElementById('text_check').value = 0;
		}
	
	}
	function fadd1(_obj)
	{
	if(_obj == true){
		
		document.getElementById('chk_si').checked = false;
	 	var _num = parseInt(document.getElementById('text_check').value);
			document.getElementById('text_check').value = 0;
		}
	else 	{
		

	 	var _num = parseInt(document.getElementById('text_check').value);
			document.getElementById('text_check').value = 1;
		}
	
	}

	function fmuesContratantes()
	{
			var _id_prote = document.getElementById('id_prote');


			
			if(_id_prote.value=='')
			{alert('Debe ingresar y grabar los datos primero...');return;}
			
			var _id_prote = document.getElementById('id_prote').value;
			var _cod_tipop = document.getElementById('cod_tipop').value
			var _fec_ingreso = document.getElementById('fec_ingreso').value;
		$('<div id="div_pcontratantes" title="div_pcontratantes"></div>').load('ProteParticipantes.php?id_prote='+_id_prote+'&cod_tipop='+_cod_tipop+'&fec_ingreso='+_fec_ingreso)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 800,
						height  : 400,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() { $(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove();  }}],
						title:'Participantes'
						
						}).width(800).height(400);	
						$(".ui-dialog-titlebar").hide();
	}

	
	function fGenerar()
	{
	
		var _id_poder  = document.getElementById('id_prote');
		var _id_poder2 = document.getElementById('id_prote').value;
		
		if(_id_poder.value=='')
		{alert('Debe ingresar y grabar los datos primero...');return;}
	
	$('<div id="div_generacion" title="div_generacion"></div>').load('IngProtestoGenerar.php?id_poder='+_id_poder2)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 500,
					height  : 300,
					modal:false,
					resizable:false,
					buttons: [{id: "btnGenerar", text: "Generar",click: function() {pasadatosPod(); }},
					{id: "btnQuitGenerar", text: "Quitar Generacion",click: function() {QuitaPod(); }},
					//{id: "btnImprimir", text: "Imprimir",click: function() {fImprimir(); }},
					{id: "btnCerrar", text: "Cerrar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Generar Poder '
					
					}).width(500).height(300);	
					$(".ui-dialog-titlebar").hide();	
	}
	
function fmuescontenidop()
	{
		var divobs = $('<div id="div_ayudacarta" title="div_ayudacarta"></div>');
		$('<div id="div_ayudacarta" title="div_ayudacarta"></div>').load('ProtestoAyuda.php')
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 550,
						height  : 250,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {pasadatos();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() { $(this).dialog("destroy").remove(); }}],
						title:'Ayuda Cartas'
						
						}).width(550).height(250);	
						$(".ui-dialog-titlebar").hide();		
	}
	
function fNotificacion()
	{
		var _id_poder  = document.getElementById('id_prote');
		var _id_poder2 = document.getElementById('id_prote').value;
		
		if(_id_poder.value=='')
		{alert('Debe ingresar y grabar los datos primero...');return;}
		
	$('<div id="div_generacion" title="div_generacion"></div>').load('IngProtestoNotif.php?id_poder='+_id_poder2)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 400,
					modal:false,
					resizable:false,
					buttons: [{id: "btnGenerar", text: "Imprimir Deudor",click: function() {fImprimirdeudor(); }},
					{id: "btnQuitGenerar", text: "Imprimir Aval",click: function() {fImprimiraval(); }},
					{id: "btnCerrar", text: "Cerrar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Generar Poder '
					
					}).width (400);
					$(".ui-dialog-titlebar").hide();	
	}
	
	
	
function fImprimirdeudor()
	{
		var _id_prote = document.getElementById('id_poderG').value;
		if(_id_prote==''){alert('Debe guardar los datos primero');return;}
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
		var _data = {
						id_prote       : _id_prote,
						usuario_imprime : _usuario_imprime,
						nom_notario     : _nom_notario
					}
		
		
		$.post("reportes_word/generador_protesto_deudor.php",_data,function(_respuesta){
						alert(_respuesta);
					});
			
	}

function fImprimiraval()
	{
		var _id_prote = document.getElementById('id_poderG').value;
		if(_id_prote==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
	
		var _data = {
						id_prote       : _id_prote,
						usuario_imprime : _usuario_imprime,
						nom_notario     : _nom_notario
					}
		
		
		$.post("reportes_word/generador_protesto_aval.php",_data,function(_respuesta){
						alert(_respuesta);
					});	
	}
</script>

</head>

<body style="font-size:62.5%;">
<form id="form_poderes" action="IngPoderesVie.php" method="post" >
<div id="permisos_viaje">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="10%">
     <?php
				$oBarra->Graba       		 = "1"                ;
				$oBarra->GrabaClick  		 = "fGraba();"        ;
				//$oBarra->Genera       		 = "1"                ;
				//$oBarra->GeneraClick  		 = "fGenerar();"      ;
				//$oBarra->Notificacion        = "1"                ;
				//$oBarra->NotiClick   		 = "fNotificacion();" ;
				$oBarra->clase       		 = "css"      		  ; 
				$oBarra->widthtxt    		 = "20"				  ; 
				$oBarra->Show()  								  ; 
				?>
    
      <td width="14%" align="left"> <button  type="button" name="imprimir"    id="imprimir"  onclick="fImprimir();" ><img align="absmiddle" src="images/block.png" width="15" height="15" />Generar Acta</button></td>
      <td width="26%" align="left"> <button  type="button" name="nocorre"    id="nocorre" onclick="fVisualDocument();" ><img align="absmiddle" src="images/block.png" width="15" height="15" />Ver Acta</button></td>
      <td width="33%" align="left"><div id="div_muesStatusNC"></div></td>
<td width="17%"></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td>
    <fieldset id="cabecera">
    <legend></legend>
    <table  width="100%">
        <tr>
          <td colspan="8"><table  width="100%">
            <tr>
              <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar Protesto..?</div><div id="confirmaGuarda"></div></td>
            </tr>
            <tr>
              <td width="14%"><span class="camposss">Nro. de Protesto:</span></td>
              <td width="17%"><div id="resul_protesto" style="width:100px;">
                <input id="id_prote" name="id_prote" type="hidden" />
                </div><input name="num_prote" type="hidden" id="num_prote" size="15" readonly  placeholder="Autogenerado"/></td>
              <td width="20%" align="right"><span class="camposss">
                Hora:</span></td>
              <td width="27%"><input name="hora_recep" type="text" id="hora_recep" style="text-transform:uppercase" value="<?php echo date("H:i"); ?>" size="10" />
                <input name="nom_recep" type="hidden" id="nom_recep" style="text-transform:uppercase" size="15" /></td>
              <td width="6%">&nbsp;</td>
              <td width="16%">&nbsp;</td>
              
            </tr>
          </table></td>
          </tr>
        <tr>
         		 <td width="9%" height="22" valign="top"><span class="camposss">Tipo</span></td>
          		 <td colspan="2"><input name="idasunto" type="hidden" id="idasunto" style="text-transform:uppercase" size="2" readonly />
          		   <input name="des_asunto" type="hidden" id="des_asunto" style="text-transform:uppercase" size="2" readonly />
          		   &nbsp;
       		    <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipo_protesto.cod_tipop AS 'id', tipo_protesto.des_tipop AS 'des'
			FROM  tipo_protesto 
			ORDER BY  tipo_protesto.des_tipop ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "250"; 
			$oCombo->name       = "cod_tipop";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
			?></td>
          		 <td align="right"><span class="camposss">INF. CAMARA :</span></td>
          		 <td width="2%"><label for="d"><span class="camposss">SI</span></label></td>
          		 <td width="3%"><input onClick="fadd(this.checked);" checked  type="checkbox" name="chk_si" id="chk_si">
   		        </td>
          		 <td width="3%"><label for="d"><span class="camposss">NO</span></label></td>
          		 <td width="32%"><input onClick="fadd1(this.checked);"  type="checkbox" name="chk_no" id="chk_no"></td>
                   
       		  </tr>
        <tr>
          <td valign="top"><span class="camposss">A solicitud de:</span></td>
      
          <td width="30%"><input name="solicitante" type="text" id="solicitante" style="text-transform:uppercase" size="30" maxlength="500" /></td>

    <td colspan="4">&nbsp;</td>
      <td width="3%">&nbsp;</td>
        </tr>
        <tr>
          <td><span class="camposss">Fec. Ingreso</span></td>
          <td colspan="2"><input name="fec_ingreso" type="text" id="fec_ingreso" style="text-transform:uppercase" value="<?php echo date("d/m/Y"); ?>" size="10" class="tcal" /></td>
          <td width="15%" align="right"><span class="camposss">Número:</span></td>
          <td colspan="4"><input name="numero" type="text" id="numero" style="text-transform:uppercase" size="30" maxlength="500" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Lugar de giro</span></td>
          <td colspan="2"><input name="lugarg" type="text" id="lugarg" style="text-transform:uppercase" size="30" maxlength="500" /></td>
          <td align="right"><span class="camposss">Referencia Girador :</span></td>
          <td colspan="4"><input name="referenciap" type="text" id="referenciap" style="text-transform:uppercase" size="50"  /></td>
        </tr>
        <tr>
          <td><span class="camposss">Fec. Giro</span></td>
          <td colspan="2"><input name="fecgiro" type="text" id="fecgiro" style="text-transform:uppercase" size="15" class="tcal" /></td>
          <td align="right"><span class="camposss">Fec. Vencimiento</span></td>
          <td colspan="4"><input name="fecvence" type="text" id="fecvence" style="text-transform:uppercase" size="15" class="tcal" /></td>
        </tr>
        <tr>
          <td valign="top"><span class="camposss">Moneda</span></td>
          <td colspan="2"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT monedas.idmon AS 'id', monedas.desmon AS 'des'
FROM monedas 
ORDER BY monedas.desmon ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "250"; 
			$oCombo->name       = "idmon";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td align="right"><span class="camposss">Importe</span></td>
          <td colspan="4"><input name="importe" value="0.00" type="text" id="importe" style="text-transform:uppercase" size="10" onKeyPress="return NumCheck(event, this);" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Diligencia</span>
          <a href="#" onClick="fmuescontenidop()"><img src="images/help.png" width="12" height="12" alt="" /></a>
          </td>
          <td colspan="7"><textarea onkeypress="return maxLengthX(event,this,1000);" name="diligencia" style="text-transform:uppercase;" id="diligencia" cols="57" rows="3"></textarea></td>
          </tr>
        <tr>
          <td><span class="camposss">Fec. Notificacion</span></td>
          <td colspan="2"><input name="fecnoti" type="text" id="fecnoti" style="text-transform:uppercase" size="15" class="tcal" /></td>
          <td align="right"><span class="camposss">Fec. Constancia</span></td>
          <td colspan="4"><input name="fecconst" type="text" id="fecconst" style="text-transform:uppercase" size="15" class="tcal" /></td>
        </tr>
        <tr>
          <td valign="top"><span class="camposss">Responsable Not.</span></td>
          <td colspan="7"><input name="id_respon" type="text" id="id_respon" style="text-transform:uppercase" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" size="25" readonly /></td>
        </tr>
        <tr>
          <td valign="top"></td>
          
          <td>&nbsp;</td>
          <td width="6%">&nbsp;</td> 
          <td>&nbsp;</td>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="8" align="center">
          <div id="btn_poderes" style="display:none">
           <button title="Contratantes" type="button" name="btncontratantes"    id="btncontratantes" value="contratantes" onclick="fmuesContratantes();" ><img src="images/newuser.png" width="20" height="20" align="absmiddle" />&nbsp; Participantes</button>  &nbsp;&nbsp;
            
            </div>     
                      </td>
          </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30" >
    <input name="num_cronoG" type="hidden" id="num_cronoG" />
    <input name="text_check" type="hidden" id="text_check" value="1"/>
    <input name="fecha_cronoG" type="hidden" id="fecha_cronoG" />
    <input name="num_formuG" type="hidden" id="num_formuG" />
    <input name="lugar_formuG" type="hidden" id="lugar_formuG" />
    <input name="observacionG" type="hidden" id="observacionG" />
    <input name="doc_presen" type="hidden" id="doc_presen" />
    <input name="fec_ofre" type="hidden" id="fec_ofre" style="text-transform:uppercase" value="<?php echo date("d/m/Y"); ?>" size="15" class="tcal" />
    <input name="documento" type="hidden" id="documento" style="text-transform:uppercase" value="0.00" size="20" />
    <input name="hora_ofre" type="hidden" id="hora_ofre" style="text-transform:uppercase" value="<?php echo date("H:i"); ?>" size="10" />
    <input name="des_respon" type="hidden" id="des_respon" style="text-transform:uppercase" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" size="25" /></td>
  </tr>
</table>
</div>
</form>
</body>
</html>