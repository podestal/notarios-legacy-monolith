// JavaScript Document

	var j = jQuery.noConflict();
	
	j.datepicker.regional['es'] = {
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

    j.datepicker.setDefaults(j.datepicker.regional['es']);
	
	var pagina = 1;

	function listar_cancelar(pag){
		
		pagina = pag;
		
		var campos =$("frm_cancelados").serialize();
		
		new Ajax.Updater("list_cancelar", "../consultas/list_cancelacion.php?"+campos+"&pag="+pagina,
		{  
		  onComplete: 
		  
		  function() { 
			if($("fila_cancelar"+color)!=null){cambiar_colorfila(color);}
		  }

		},{method:'GET'});	
		
	

	}
	
	function isNumberKey(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
 
		 return true;
	}
	
	function numerosdecimales(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 
		 
		 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
			return false;
 
		 return true;
	}
	
	function cancelar_comp(id){
		new Ajax.Updater("div_cancelar", "../widgets/cancelar_comprobante.php?id_ctaventas="+id,
		{  
		  onComplete: 
		  
		  function() { 
		   fecha_abono();
		  }

		},{method:'GET'});	
			
		$("div_cancelar").style.display="block";
		
		cambiar_colorfila(id);
	}

	var color = 0;

	function cambiar_colorfila(id){


		if(color!= 0){
			$("fila_cancelar"+color).style.backgroundColor = "white";
		}
		
		color = id;
		
		$("fila_cancelar"+id).style.backgroundColor="#66ff33"; 
		
	}
	
	function limpiar_color(){
		$("fila_cancelar"+color).style.backgroundColor = "white";
		color = 0;
	}
	
	function fecha_abono(){
		
		var j = jQuery.noConflict();
			   
	    j(function() {
		   j( "#canc_fecha" ).datepicker();
	     });
			   
	}
	
	function cerrar_abonar(){
		$("div_cancelar").style.display ="none";
		limpiar_color();
	}
	
	function crear_abono(){
	
		var campos =$("frm_abono").serialize();
	
		new Ajax.Request("../consultas/registrar_abono.php?"+campos,
		{  
		onComplete: 
		  function() { 
		  	var pag = pagina;
			listar_cancelar(pag);
		  	alert("Abono realizado");
		  }
		},{method:'GET'});
		
	}
	
	
	

	
	
	
	
	