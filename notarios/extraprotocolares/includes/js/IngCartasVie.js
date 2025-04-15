
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

// JavaScript Document

$(document).ready(function(){ 
	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	 $(".ui-dialog-titlebar").hide();
	})
	
	jQuery(function($){
		$("#fecentrega").mask("99/99/9999",{placeholder:"_"});
		$("#horaentrega").mask("99:99 aa",{placeholder:"_"});
		$("#fecrecogio").mask("99/99/9999",{placeholder:"_"});
		
	});	
	
	
	function crearbloque()
	{
		$('<div id="div_bloques" title="div_bloques"></div>').load('CrearBloque.php')
		.dialog({
						autoOpen: true,
						position :["center","top"],
						width   : 400,
						height  : 200,
						modal:false,
						resizable:false,
						buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {fcrearBloque();$(this).dialog("destroy").remove(); }},
						{text: "Cancelar",click: function() { $(this).dialog("destroy").remove(); }}],
						title:'Crear Bloque'
						}).width(400).height(200);	
						$(".ui-dialog-titlebar").hide();
		
			
	}
	
	function fGraba()
	{
		var _numdoc		= document.getElementById('numdoc');
		var _remitente  = document.getElementById('remitente'); 
		var _fec_ingreso    = document.getElementById('fecingreso');
		var _nom_destinatario = document.getElementById('destinatario');
		
		if(_remitente.value=='' || _fec_ingreso.value=='' || _nom_destinatario.value=='')
		{alert('Faltan ingresar datos');return;}
		
	 fguardaCarta();
	}

	function fGraba2()
	{
		var _numdoc		= document.getElementById('numdoc');
		var _remitente  = document.getElementById('remitente'); 
		var _fec_ingreso    = document.getElementById('fecingreso');
		var _nom_destinatario = document.getElementById('destinatario');
	
		if(_remitente.value=='' || _fec_ingreso.value=='')
		{alert('Faltan ingresar datosccc');return;}
		
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
						$( this ).dialog( "close" );
					}
				}
			});
		}	
	}
	
	function fevalguarda()
	{
		fguardaCarta();
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


    function fShowDatosProveeClick() //
		{			
			var _numdoc		= document.getElementById('numdoc').value;
			var _remitente  = document.getElementById('remitente');
			var _direccion  = document.getElementById('direccion_remi');
			var _telefono   = document.getElementById('telefono');

					
					if(_numdoc==''){alert('Ingrese un numero de documento');return;}
					
					var _des = fShowAjaxDato('../includes/remitente.php?numdoc='+_numdoc);
					document.getElementById('remitente').value = _des;
					
					var _direcc = fShowAjaxDato('../includes/direccion.php?numdoc='+_numdoc);
					document.getElementById('direccion_remi').value=_direcc;
					
					var _telf = fShowAjaxDato('../includes/telefono.php?numdoc='+_numdoc);
					document.getElementById('telefono').value=_telf;
					
					if(_remitente==''){alert('No se encuentra registrado');return;}
		}		

	function selectzona(_obj)
	{
		var _idzona = _obj.substring(4);
		document.getElementById('idzona').value = _idzona;
	}
	
	function fCreabloque(){ crearbloque();	}
	
	function fmuescontenido()
	{
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
					

	














	
	
		