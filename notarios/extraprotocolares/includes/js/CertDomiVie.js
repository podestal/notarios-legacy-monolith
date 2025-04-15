// JavaScript Document

$(document).ready(function(){ 
	 $("#numdoc_solic").attr("maxlength", 8);
	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
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
					"Guardar": function() { fevalguarda();
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});			
		
	}

	function fevalguarda()
	{
		fgrabcertidomic();	
		$("#muesguarda").dialog("close");
	}


	function fborrar()
	{
		var _texto_cuerpo   = document.getElementById('texto_cuerpo');
		var _justifi_cuerpo	= document.getElementById('justifi_cuerpo');
		_texto_cuerpo.value = '';
	}

	function fjustificar()
	{
		var _texto_cuerpo   = document.getElementById('texto_cuerpo').value;
		var _justifi_cuerpo	= document.getElementById('justifi_cuerpo').value;
	}
	
	/*function enviar_cliente(){
		alert("Hola");
	}*/
	


	function fevalguardaRegistroFirmas()
	{
		fgrabarRegistroFirmas();
		$("#muesguarda").dialog("close");
	}
function fGrabaRegistroFirmas(){
		var direCertificado=getDataPorId('direCertificado');
		var numDoc=getDataPorId('numdoc_solic');
		


				$( "#muesguarda" ).dialog({
				height:140,
				position: { my: "center top", at: "center top", of: window },
				modal: true,
				buttons: { 
					"Guardar": function() { 
						fevalguardaRegistroFirmas();
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});	
	}
	

	function fGrabaLegalizacion()
	{
		var direCertificado=getDataPorId('direCertificado');
		var numDoc=getDataPorId('numdoc_solic');
		
		
		if(numDoc=='')
		{
				alert('Ingrese Número de Documento');
			return ;
				
		}


				$( "#muesguarda" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: { 
					"Guardar": function() { 
						fevalguardaLegalizacion();
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});		
	}

function fevalguardaLegalizacion()
	{
		fgrabarLegalizacion();	
		$("#muesguarda").dialog("close");
	}


	
	