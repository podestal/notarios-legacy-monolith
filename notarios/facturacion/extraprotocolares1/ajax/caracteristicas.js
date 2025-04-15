// JavaScript Document

	var pagina = 1;
	
	var modulo = 1;


	function buscar_caracteristicas(page){


		var flag = validar_fechas();
    	
		//alert(flag);
		
		if(flag ==1){
        
		   var campos =$("frm_buscarcaracteristicas").serialize();
			new Ajax.Updater("lista_caracteristicas", "busqueda_cambios.php?" + campos+"&pag=" + page);
	
			
			limpiar_caracteristicas();
		
    	}

		if(flag ==2){
		
			 alert("No Ejecuta operacion");  
		
		}

	}

	function ver_caracteristicas(num_crono){
		document.location.href="editCambioCaracVie.php?num_crono="+num_crono;
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
	
	
	function limpiar_caracteristicas(){

		if($("num_crono").value!="" ){
		   $("solicitante").value = "";  
		   $("rango1").value = "";
		   $("rango2").value = "";  
		}

	}
	
	function limpiar_cajas_caracteristicas(){
			
		$("num_crono").value!="";		
		$("solicitante").value = "";  
		$("rango1").value = "";
		$("rango2").value = "";  
			
		buscar_caracteristicas(1);
			
	}
	