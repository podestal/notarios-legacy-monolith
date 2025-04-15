// JavaScript Document

	var pagina = 1;
	
	var modulo = 1;

	function buscar_legalizaciones(page){
		
		var flag = validar_fechas();
    	
		//alert(flag);
		
		if(flag ==1){
        
		   var campos =$("frm_buscarcartas").serialize();
		   new Ajax.Updater("lista_legalizaciones", "busqueda_legalizaciones.php?" + campos+"&pag=" + page);

			limpiar_cartas();
		
    	}

		if(flag ==2){
		
		  //alert("No Ejecuta operacion");  
		
		}

	}
	
	function ver_legalizaciones(id_firma){
		document.location.href="EditLegalizacionesView.php?numfirma="+id_firma;
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

    if($("num_carta").value==""){

        if($("rango1").value == ""  && $("rango2").value != ""){
  			   alert("Debe ingresar el rango 1"); 
  			   return 2;
  			}
  			if($("rango1").value != ""  && $("rango2").value == ""){
  			   alert("Debe ingresar el rango 2"); 
  			   return 2;
  			}
  			if($("rango1").value != ""  && $("rango2").value != ""){
  			  if($("opcion1").checked == false &&  $("opcion2").checked == false) {
  				  alert("Debe escoger alguna de las opciones");
  				  return 2;
  			  }       
  			}
  			if($("rango1").value != "" && $("rango2").value != ""){
  			  if($("opcion1").checked == true ||  $("opcion2").checked == true) {
  				  if(range1>range2){
  					  alert("El primer rango de fechas debe de ser menor o igual que el segundo");
  					  return 2;  
  				  }
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
	
	function limpiar_cartas(){

		if($("num_carta").value!="" ){
		   $("destinatario").value = "";  
		   $("remitente").value = "";  
		   $("rango1").value = "";
		   $("rango2").value = "";  
		   $("opcion1").checked = false;
		   $("opcion2").checked = false;
		}

	}
	
	function limpiar_cajas_cartas(){
			
		$("num_carta").value!="";		
		$("destinatario").value = "";  
		$("remitente").value = "";  
		$("rango1").value = "";
		$("rango2").value = "";  
		$("opcion1").checked = false;
		$("opcion2").checked = false;
			
		buscar_cartas(1);
			
	}
	