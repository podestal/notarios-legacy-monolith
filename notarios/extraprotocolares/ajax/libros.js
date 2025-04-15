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
								 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sab'],
								 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
								 weekHeader: 'Sm',
								 dateFormat: 'dd/mm/yy',
								 firstDay: 1,
								 isRTL: false,
								 showMonthAfterYear: false,
								 yearSuffix: ''
								 };

    j.datepicker.setDefaults(j.datepicker.regional['es']);

	var pagina = 1;
	
	var modulo = 1;


	function buscar_libros(page){

		pagina = page;
		
		var flag = validar_fechas();
    	
		//alert(flag);
		
		if(flag ==1){
        
			var campos =$("frm_buscarlibros").serialize();
			new Ajax.Updater("lista_libros", "busquedalibro.php?" + campos+"&pag=" + page);
			
			limpiar_libros();
		
    	}

		if(flag ==2){ //alert("No Ejecuta operacion");  
		}
	}

	function ver_libros(numlibro){
		//alert(numlibro);
		document.location.href="../../verlibro.php?numlibro="+numlibro;
	}

	
	function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 
         return true;
	}
	

	function validar_fechas(){
		
	var range1;
	var range2;
	
		if($("rango1").value){
		  range1 = formato_date($("rango1").value);	
		}

		if($("rango2").value){
		  range2 = formato_date($("rango2").value);	
		}

	    if($("num_crono").value==""){

	    		if($("rango1").value != ""  && $("rango2").value == ""){
	  			   alert("Debe ingresar el rango 2"); 
	  			   return 2;
	  			}
	  			if($("rango1").value == ""  && $("rango2").value != ""){
				  alert("Debe ingresar el rango 1");
		  		  return 2;
		  			  
	  			}
	  			if($("rango1").value != "" && $("rango2").value != ""){
				  	  if(range1>range2){
						  alert("El primer rango de fechas debe de ser menor o igual que el segundo");
						  return 2;  
					  }
	  			}

		}

		return 1;

	}
	
	function formato_date(date){
    
		var fecha = date.split('/'); 
		
		dia = fecha[0];
		mes = fecha[1];
		anio = fecha[2];
		
		var newdate;
		
		newdate = anio.concat(mes.concat(dia));
		
		return newdate;
	
	}
	
	function limpiar_libros(){

		if($("num_crono").value!="" ){
		   $("cliente").value = "";  
		   $("rn").value = "";  
		   $("rango1").value = "";
		   $("rango2").value = "";  
		}
		
	}
	
	function limpiar_cajas_libros(){
			
		$("cliente").value = "";  
		$("rn").value = "";  
		$("rango1").value = "";
		$("rango2").value = "";  
			
		buscar_libros(1);
			
	}
	
	function abrir_recoger(){
		
		$("div_recojo").style.display = "block";
		
		new Draggable('div_recojo');
		
		new Ajax.Updater("div_recojo", "../widgets/datosrecojolibros.php",
		{  
		  onComplete: 
		  function() { 
		  			var j = jQuery.noConflict();
	   
					j(function() {
						j( "#l_fecha" ).datepicker();
					});
		  }
		},{method:'GET'});
		
	}
	
	function cerrar_recoger(){
		$("div_recojo").style.display = "none";
	}
	
	function actualizar_chk(id){
		
		if($("idlibro"+id).checked==true){
			$("idlibro"+id).checked = false; 
			return;
		}
		
		if($("idlibro"+id).checked==false){
			$("idlibro"+id).checked = true; 
			return;
		}
		
	}
	
	function recoger_libro(){
		
		var campos =$("frm_lstlibros").serialize();
		var campos1 =$("frm_recojo").serialize();
		
		new Ajax.Request('../consultas/modrecoger.php?'+campos+'&'+campos1, 
		{
			method:'get',
			requestHeaders: {Accept: 'application/json'},
			onSuccess: function(transport){
						var json = transport.responseText.evalJSON(true);
						alert(json[0]);
						
			}
		});
			
	}
	