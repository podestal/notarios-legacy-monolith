// JavaScript Document

	var pagina = 1;

	function buscar_incapaces(page){


		var flag = validar_fechas();
    	
		//alert(flag);
		
		if(flag ==1){
        
			
			var campos =$("frm_buscarincapaces").serialize();
			new Ajax.Updater("lista_incapaces", "busqueda_incapaz.php?" + campos+"&pag=" + page);
			  
			
			limpiar_incapaces();
		
    	}

		if(flag ==2){
		
			//alert("No Ejecuta operacion");  
		
		}

	}

	function ver_incapaces(id_supervivencia){
		document.location.href="EditPIncapazVie.php?id_supervivencia="+id_supervivencia;
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
	
	
	function limpiar_incapaces(){

		if($("num_crono").value!="" ){
		   $("nombre").value = "";  
		   $("rango1").value = "";
		   $("rango2").value = "";  
		}

	}
	
	function limpiar_cajas_incapaces(){
			
		$("num_crono").value!="";		
		$("nombre").value = "";  
		$("rango1").value = "";
		$("rango2").value = "";  
			
		buscar_incapaces(1);
			
	}
	