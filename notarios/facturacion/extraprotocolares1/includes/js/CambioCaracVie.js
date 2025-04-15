// JavaScript Document

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
	 $("#num_docu").attr("maxlength", 8);
	 $("#numdocu_representante").attr("maxlength", 11);
	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	 $(".ui-dialog-titlebar").hide();
	 ShowCCarac();
	 $('#div_newsolicitante').attr('style','display:none'); 
	 $('#div_editar').attr('style','display:none'); 
	 $('#contienepersona').attr('style','display:none'); 


	 
	})

function ocultar_desc(objac2)
		{
			if(document.getElementById(objac2).style.display=="")
				document.getElementById(objac2).style.display="none";
			else
				document.getElementById(objac2).style.display="none";
		}	
	
	function mostrar_desc(objac)
		{
			if(document.getElementById(objac).style.display=="none")
				document.getElementById(objac).style.display=""
			else
				document.getElementById(objac).style.display="";
		}
	function fGraba2()
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

	function fevalguarda()
	{	
		fguardaCambio();
		$("#muesguarda").dialog("close");
		//
		$("#div_show_btnSolic").attr("style","");
	}

	function ShowCCarac() { $('#div_cambiocar').load('listdetCCarac.php');	}

	function fAddDetalle()
	{
		var _id_cambio = document.getElementById('id_cambio').value;
		var _detalle = document.getElementById('detalle_cambios').value;
		
		if(_id_cambio == '')
		{
			alert('Debe ingresar y grabar los datos primero...');return;
		}
		else if(_id_cambio != '')	
		{
			if(_detalle == ''){alert('Debe seleccionar la caracteristica');return;}
			fPassData();
		}
		
	}

	function fPassData2()
	{
		var _id_cambio = document.getElementById('id_cambio').value;
		var _detalle = document.getElementById('detalle_cambios').value;
		$('#div_cambiocar').load('listdetCCarac.php?detalle='+_detalle+'&id_cambio='+_id_cambio);	
	}

	function fElimDetalle()
	{
		var _id_cambio = document.getElementById('id_cambio').value;
		var _detalle = document.getElementById('detalle_cambios').value;
		
		if(_id_cambio == '')
		{
			alert('Debe ingresar y grabar los datos primero...');return;
		}
		else if(_id_cambio != '')	
		{
			if(_detalle == ''){alert('Debe seleccionar la caracteristica a eliminar');return;}
			fElimData();
		}
		
	}

	function fElimData2()
	{
		var _id_cambio = document.getElementById('id_cambio').value;
		var _detalle = document.getElementById('detalle_cambios').value;
		$('#div_cambiocar').load('listdetCCarac.php?detalle='+_detalle+'&id_cambio='+_id_cambio);	
	
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
						buttons: [{id: "btnAcepPartic2", text: "Aceptar",click: function() {/*$(this).dialog("close");*/ }},
						{text: "Cancelar",click: function() {$(this).dialog("close"); }}],
						title:'Agregar participantes'
						
						}).width(720).height(350);	
						$(".ui-dialog-titlebar").hide();		
	}


	function fImprimir()
	{
		var _num_crono = document.getElementById('num_crono').value;
		if(_num_crono==''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = document.getElementById('usuario_imprime').value;
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		var _id_cambio = document.getElementById('id_cambio').value;
		
		_data =
		{
			num_crono : _num_crono,
			usuario_imprime : _usuario_imprime,
			nom_notario : _nom_notario,
			id_cambio : _id_cambio
		}
	
		$.post("../../reportes_word/generador_cambio_caracteristicas.php",_data,function(_respuesta){
						alert(_respuesta);
					});
	
	}




	function agregarpersona()
	{
		var _id_cambio  = document.getElementById('id_cambio');
		var _id_cambio2 = document.getElementById('id_cambio').value;
		if(_id_cambio2=='')
		{alert('Debe guardar nro cronologico primero....');return;}
		$("#div_newsolicitante").removeAttr("style","display:none");
			$("#nombre").val("");
			$("#nnombre").val("");
			$("#direccion").val("");
			$("#ndireccion").val("");
			$("#num_docu").val("");
			$("#representacion").val("");+
			$("#nrepresentacion").val("");
			$("#poder_inscrito").val("");
			$("#int_legitimo").val("");
			$("#tipo_carta").val("");
			$("#rep2").val("");
			
			$("#llamaphp").attr("style","display:none");
			$("#contienepersona").attr("style","display:none");
		
	}




	
	
	///////////////////////////////////////////////////
	
	function grabarclientecambio()
	{
	
	ajax = objetoAjax();
	ajax.open("POST","../model/grabar_clientecambio.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_cambio="+id_cambio+"&nombre="+nombre+"&tipdoc="+tipdoc+"&num_docu="+num_docu+"&direccion="+direccion
	+"&ecivil="+ecivil+"&representacion="+representacion+"&poder_inscrito="+poder_inscrito+"&int_legitimo="+int_legitimo+"&tipo_carta="+tipo_carta+"&rep2="+rep2);}
	///////////////////////////////////////////////////
	
	
	
	
	
	
	
	
	
	function ggpcambiocarac2()
	{
		 	 ocultar_desc('div_newsolicitante');
			 mostrar_desc('llamaphp');
			 $("#contienepersona").removeAttr("style","display:none");
			 
			 $('#llamaphp').load('list_cambios.php?id_cambio='+_id_cambio+             'id_solicitante='+_id_solicitante);
			
		
	}
	

	function ggpcambiocarac3()
	{
			 ocultar_desc('div_editsolicitante');
			 mostrar_desc('llamaphp');
			 $("#contienepersona").removeAttr("style","display:none");
			 
			 $('#llamaphp').load('list_cambios.php?id_cambio='+_id_cambio);
	}

		function fbuscaaa()
	{
		 $("#contienepersona").removeAttr("style","display:none");
			  	 $("#llamaphp").removeAttr("style","display:none");
			var _id_cambio = document.getElementById('id_cambio').value;

			$('#llamaphp').load('list_cambios.php?id_cambio='+_id_cambio);

	}	

	function mostrareditsolic(){
	 ocultar_desc('llamaphp');
	 ocultar_desc('contienepersona');
	 
	 $("#div_editsolicitante").removeAttr("style","display:none");

	}


	function Recargar()
	{
	var _id_cambio = document.getElementById('id_cambio').value;
	$('#llamaphp').load('list_cambios.php?id_cambio='+_id_cambio);
	}