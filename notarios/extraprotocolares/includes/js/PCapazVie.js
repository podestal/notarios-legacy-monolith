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
$("#numdocu").attr("maxlength", 8);
$("#ndocu_testigo").attr("maxlength", 8);

	 $("input, textarea").uniform();
	 $("button").button();
	 $("#dialog").dialog();
	})
	
	function agregar()
	{
		document.getElementById('num_crono').value = '';
		document.getElementById('fecha').value = '';
		document.getElementById('num_formu').value = '';
		document.getElementById('documento').value = '';
		document.getElementById('nombre').value = '';
		document.getElementById('tipdocu').value = '';
		document.getElementById('numdocu').value = '';
		document.getElementById('nacionalidad').value = '';
		document.getElementById('ecivil').value = '';
		document.getElementById('direccion').value = '';
		document.getElementById('observaciones').value = '';
		document.getElementById('idzona').value = '';
	}
	
	
	
	function fGraba()
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
		fgrabpersonazapaz();
		$("#muesguarda").dialog("close");
	}







	
		
	
	
	
	
	
	
	
	
	
	
	
	