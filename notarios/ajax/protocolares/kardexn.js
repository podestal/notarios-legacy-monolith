// JavaScript Document

	//var j = jQuery.noConflict();
	
	$(function($){
		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '<Ant',
			nextText: 'Sig>',
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			weekHeader: 'Sm',
			dateFormat: 'dd/mm/yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);
	});

	function  abrir_tabs(par, id){
		
		/*document.getElementById("tab1").style.display="none";
		document.getElementById("tab3").style.display="none";
		document.getElementById("tab4").style.display="none";
		document.getElementById("tab5").style.display="none";*/
		
		$("#tab1").hide();
		$("#tab3").hide();
		$("#tab4").hide();
		$("#tab5").hide();
		
		if(document.getElementById("codkardex")!=null){id = document.getElementById("codkardex").value;	}
		
		if(par==5){$("#tab5").load("consultas/widgets/registros.php?id=" + id);}
		
		//document.getElementById("tab"+par).style.display="block";
		
		$("#tab"+par).show();
	}
	
	function nuevo_movimiento(){
		
		cerrar_movimiento2();
		$("#div_movimiento").show();
		$("#div_movimiento").load("consultas/widgets/nuevo_movimiento.php",
			function(responseTxt,statusTxt,xhr){
				if(statusTxt=="success")
				  $("#mov_fecha" ).datepicker();
				  $("#mov_venc" ).datepicker();
				if(statusTxt=="error")
				  alert("Error: "+xhr.status+": "+xhr.statusText);
		  	}
		);
		
	}
	
	function cerrar_movimiento(){
		$("#div_movimiento").hide();
	}
	
	function registrar_movimiento(){
		
		var url = "consultas/registrar_movimiento.php";
		
		var flag = validar_movimiento();
		
		var codkardex = document.getElementById("codkardex").value;
		
		if(flag==1){
			$.ajax({
               type: "POST",
	           url: url,
	           data: $("#frm_movimiento").serialize()+"&codkardex="+codkardex, // Adjuntar los campos del formulario enviado.
	           success: function(data)
	           {
				   //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.
				   abrir_tabs(5, codkardex);
			   }
	    	});
		}
		
		
	}
	
	function modificar_movimiento(cod){
		
		cerrar_movimiento();
		$("#div_mmovimiento").show();
		$("#div_mmovimiento").load("consultas/widgets/m_movimiento.php?cod="+cod,
			function(responseTxt,statusTxt,xhr){
				if(statusTxt=="success")
				  $("#mov_mfecha" ).datepicker();
				  $("#mov_mvenc" ).datepicker();
				if(statusTxt=="error")
				  alert("Error: "+xhr.status+": "+xhr.statusText);
		  	}
		);
		
	}
	
	function cerrar_movimiento2(){
		$("#div_mmovimiento").hide();
	}
	
	function validar_movimiento(){

		var flag = 1
	
		if(document.getElementById("frm_movimiento")!= null){
			if(document.getElementById("mov_fecha").value=="" || document.getElementById("mov_ofreg").value==0 || document.getElementById("mov_tramite").value==0 || document.getElementById("mov_estado").value==0){
			   alert("Ingrese fecha, oficina, tramite y estado");
			   flag = 2;
			}
		}
		
		if(document.getElementById("frm_mmovimiento")!= null){
			if(document.getElementById("mov_mfecha").value=="" || document.getElementById("mov_mofreg").value==0 || document.getElementById("mov_mtramite").value==0 || document.getElementById("mov_mestado").value==0){
			   alert("Ingrese fecha, oficina, tramite y estado");
			   flag = 2;
			}
		}
			
		return flag;
		
	}
	
	function mod_movimiento(id_mov){
	
		var url = "consultas/modificar_movimiento.php";
			
		var flag = validar_movimiento();
			
		var codkardex = document.getElementById("codkardex").value;
			
		if(flag==1){
			$.ajax({
				   type: "POST",
				   url: url,
				   data: $("#frm_mmovimiento").serialize()+"&id_mov="+id_mov, // Adjuntar los campos del formulario enviado.
				   success: function(data)
				   {
					   //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.
					   abrir_tabs(5, codkardex);
				   }
			});
		}
		
	}
	
	function eliminar_movimiento(id_mov){
	
		var url = "consultas/eliminar_movimiento.php";
		
		var codkardex = document.getElementById("codkardex").value;
		
		var r = confirm("¿Seguro Desea Eliminar el movimiento?");
	
		if (r == true) {
			
			cerrar_movimiento();
			cerrar_movimiento2();
			
			$.ajax({
				   type: "POST",
				   url: url,
				   data: "id_mov="+id_mov, // Adjuntar los campos del formulario enviado.
				   success: function(data)
				   {
					   //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.
					   abrir_tabs(5, codkardex);
				   }
			});
			
		} 
	
	}
	
	function mostrar_menus(){
		$("#tabs").hide();
		$("#contenedor").hide();
	}
	
	function numerosdecimales(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 
		 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
			return false;
 
		 return true;
	}
	
	function currency(id) {

			var valor = document.getElementById(id).value;
			
			var num = parseFloat(valor).toFixed(2);
			
			document.getElementById(id).value = num;
			
	}
	
	function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 
         return true;
	}

