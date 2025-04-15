$(document).ready(function(){ 

	  $("button").button();
	  $("#dialog").dialog();
	  
	  // Oculta el botón participantes
	  $("#mues_btnparticipantes").attr("style","display:none");
	  
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

/*	function fNoCorreViaje()
	{
		var _id_viaje = document.getElementById('id_viaje');
		if(_id_viaje.selectedIndex=='0'){alert('No se ha grabado el permiso');return;}
		
		else 
		{
			$( "#muesguarda" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: {
					"Aceptar": function() { fevalguarda();
					},
					"Cancelar": function() {
						$(this).dialog("destroy").remove();
					}
				}
			});
		}	
	}
*/
	function fElimina()
	{
		var _id_viaje  = document.getElementById('id_viaje') 	;
			
		if( _id_viaje.value=='')
		{alert('No se ha creado el Permiso');return;}
		
		else {
		$( "#mueselim" ).dialog({
					resizable: false,
					height:140,
					position :["center","top"],
					modal: true,
					buttons: {
						"Aceptar": function() { fevalElim();
						},
						"Cancelar": function() {
							$(this).dialog("destroy").remove();
						}
					}
				});
		}		
		
	}

	function agregar()
	{
		if(confirm('Agregar nuevo Permiso..?'))
		{document.getElementById('form_permisos').submit();}
		else{return;}
	}

	function fevalElim()
	{
		fElimPermiviaje2();	
		$("#mueselim").dialog("close");	
		document.getElementById('confirmaGuarda').innerHTML = '';
	}

	function fGenerar()
	{
		var _id_viaje  = document.getElementById('id_viaje');
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
					buttons: [{id: "btnGenerar", text: "Generar",click: function() {generarFunct(); }},
					{id: "btnQuitGenerar", text: "Actualizar Generacion",click: function() {QuitaPod(); }},
					//{id: "btnImprimir", text: "Imprimir",click: function() { fImprimir(); }},
					{id: "btnCerrar", text: "Cerrar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Generar Permiso'
					
					}).width(500).height(300);	
					$(".ui-dialog-titlebar").hide();	
	}

	function fmuesContratantes()
	{
		var _id_viaje  = document.getElementById('id_viaje');
		var _id_viaje2 = document.getElementById('id_viaje').value;
		if(_id_viaje.value=='')
		{alert('Debe ingresar y grabar los datos primero...');return;}
		
	$('<div id="div_participantes" title="div_participantes"></div>').load('PermiParticipantes.php?id_viaje='+_id_viaje2)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 850,
					height  : 400,
					modal:false,
					resizable:false,
					buttons: [{id: "bntAcepPartic", text: "Aceptar",click: function() {$(this).dialog("destroy").remove(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Participantes'
					
					}).width(850).height(400);	
					$(".ui-dialog-titlebar").hide();
		
	}

	function fevalguarda()
	{
		fguardapermiviaje();
		$("#muesguarda").dialog("close");

		//
		$("#mues_btnparticipantes").attr("style","");
	}


	function fGraba()
	{
		var _asunto = document.getElementById('idasunto');
		if(_asunto.selectedIndex=='0'){alert('Debe seleccionar el tipo de permiso');return;}
		
		else 
		{
			$( "#muesguarda" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: {
					"Aceptar": function() { fevalguarda();
					},
					"Cancelar": function() {
						$(this).dialog("destroy").remove();
					}
				}
			});
		}	
	}

	function fmuesObservacion(){
		
		var _num_crono2   = document.getElementById('num_cronoG').value;
		var _fecha_crono2 = document.getElementById('fecha_cronoG').value;
		var _num_formu2   = document.getElementById('num_formuG').value;
		var _lugar_formu2 = document.getElementById('lugar_formuG').value;
		var _observacion2 = document.getElementById('observacionG').value;
		
	$('<div id="div_observaciones" title="div_observaciones"></div>').load('PermiObserva.php?num_crono='+_num_crono2+'&fecha_crono='+_fecha_crono2+'&num_formu='+_num_formu2+'&lugar_formu='+_lugar_formu2+'&observacion='+_observacion2)
	.dialog({
					autoOpen: true,
					position :["center","top"],
					width   : 550,
					height  : 240,
					modal:false,
					resizable:false,
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {pasadatos(); $(this).dialog("destroy").remove(); }},
					{text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Observaciones'
					
					}).width(550).height(240);	
					$(".ui-dialog-titlebar").hide();
		}
		