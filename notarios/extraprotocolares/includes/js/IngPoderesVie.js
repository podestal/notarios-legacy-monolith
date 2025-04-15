// JavaScript Document
$(document).ready(function(){ 

	 $("button").button();
	 $("#dialog").dialog();
	 $("input, textarea").uniform();
	 $( "#dialog:ui-dialog" ).dialog( "destroy" );
	 
	})
	
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

	function fGraba()
	{		
				var _hora_recep = document.getElementById('hora_recep') ;
				var _id_asunto  = document.getElementById('id_asunto') 	;
			
		if(  _hora_recep.value=='' || _id_asunto.value=='')
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
		fSaveIngPoderes();
		$("#muesguarda").dialog("close");
	}



	function agregar()
	{
		if(confirm('Nuevo..?'))
			 { 		
				$("#form_poderes").submit();	
			 }
		else {return;}	 
	}



// MUESTRA BOTONES SEGUN OPCION ESCOGIDA
	function selectAsunto(_obj)
	{
		if(_obj=='004')
		{
			document.getElementById('btnessalud').disabled=false;
			document.getElementById('btnessalud').style.display="";
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnpensiones').style.display="none";
			document.getElementById('btnobs').disabled=true;
			document.getElementById('btnobs').style.display="none";
			
		}	
		if(_obj=='003')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnessalud').style.display="none";
			document.getElementById('btnpensiones').disabled=false;
			document.getElementById('btnpensiones').style.display="";
			document.getElementById('btnobs').disabled=true;
			document.getElementById('btnobs').style.display="none";
		}
		if(_obj=='001' || _obj=='002')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnessalud').style.display="none";
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnpensiones').style.display="none";
			document.getElementById('btnobs').disabled=false;
			document.getElementById('btnobs').style.display="";
		}	
	}


	function fini()
	{
		var _obj  = document.getElementById('id_asunto').value;
		if(_obj=='004')
		{
			document.getElementById('btnessalud').disabled=false;
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnobs').disabled=true;
		}
		
		if(_obj=='003')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnpensiones').disabled=false;
			document.getElementById('btnobs').disabled=true;
		}
		
		if(_obj=='001' || _obj=='002')
		{
			document.getElementById('btnessalud').disabled=true;
			document.getElementById('btnpensiones').disabled=true;
			document.getElementById('btnobs').disabled=false;
		}
	}



// #=======================================
// #= DIVS SEGUN TIPO DE PODER SELECCIONADO.

// #==================================
// #=== MUESTRA CONTRATANTES - PODERES
	function fmuesContratantes()
	{
			var _id_poder = document.getElementById('id_poder');
			if(_id_poder.value=='')
			{alert('Debe ingresar y grabar los datos primero...');return;}
			
			var _id_poder = document.getElementById('id_poder').value;
			var _tip_poder = document.getElementById('id_asunto').value
			 
		$('<div id="div_pcontratantes" title="div_pcontratantes"></div>').load('PoderContratantes.php?id_poder='+_id_poder+'&tip_poder='+_tip_poder)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 980,
						height  : 400,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() { $(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove();  }}],
						title:'Participantes'
						
						}).width(980).height(400);	
						$(".ui-dialog-titlebar").hide();
	}


// #=====================
// #=== ESSALUD - PODERES
	function fmuesEssalud(){
		
		var _id_poder = document.getElementById('id_poder').value;
		$('<div id="div_pessalud" title="div_pessalud"></div>').load('PoderEssalud.php?id_poder='+_id_poder)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 600,
						height  : 350, // 270
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {fguardaPEssalud();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Observaciones'
						
						}).width(600).height(350);	
						$(".ui-dialog-titlebar").hide();
		}



// #=======================
// #=== PENSIONES - PODERES
	function fmuesPensiones(){
		
		var _id_poder = document.getElementById('id_poder').value;
		
		$('<div id="div_ppensiones" title="div_ppensiones"></div>').load('PoderPensiones.php?id_poder='+_id_poder)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 600,
						height  : 230,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {fguardaPPensiones();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Observaciones'
						
						}).width(600).height(230);	    
						$(".ui-dialog-titlebar").hide();
		}



// #===================================
// #=== MUESTRA BOTON GENERAR - PODERES
	function fmuesObservacion()
	{
		var _id_poder = document.getElementById('id_poder').value;
		$('<div id="div_generador" title="div_generador"></div>').load('PoderGenerador.php?id_poder='+_id_poder)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 980,
						height  : 300,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {fguardaPFueraReg();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
						title:'Observaciones'
						
						}).width(980).height(300);	
						$(".ui-dialog-titlebar").hide();			
	}


// #===================================
// #=== MUESTRA GENERACION   -  PODERES
	function fGenerar()
	{
		
			var _id_poder  = document.getElementById('id_poder');
			var _id_poder2 = document.getElementById('id_poder').value;
			
			if(_id_poder.value=='')
			{alert('Debe ingresar y grabar los datos primero...');return;}
		
		$('<div id="div_generacion" title="div_generacion"></div>').load('IngPoderGenerar.php?id_poder='+_id_poder2)
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 600,
						height  : 300,
						modal:false,
						resizable:false,
						buttons: [{id: "btnGenerar", text: "Generar",click: function() {pasadatosPod(); }},
						{id: "btnQuitGenerar", text: "Actualizar Formulario",click: function() {QuitaPod(); }},
						//{id: "btnImprimir", text: "Imprimir",click: function() { fImprimir();  }},
						{id: "btnCerrar", text: "Cerrar",click: function() {$(this).dialog("destroy").remove();}}],
						title:'Generar Poder'
						
						}).width(600).height(300);	
						$(".ui-dialog-titlebar").hide();	
	}
	