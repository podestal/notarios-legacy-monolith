// JavaScript Document

	var pagina = 1;
	
	var modulo = 1;

	function buscar_poderes(page){
		
		var flag = validar_fechas();
    	
		//alert(flag);
		
		if(flag==1){
        
			  var campos =$("frm_poderes").serialize();
			  new Ajax.Updater("lista_poderes", "busqueda_poderes.php?" + campos+"&pag=" + page);
		
			limpiar_poderes();
		
    	}

		if(flag ==2){
		
		  //alert("No Ejecuta operacion");  
		
		}

		


	}
	
	function ver_poderes(id_poder){

		document.location.href="EditPoderesVie.php?id_poder="+id_poder;

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

    if($("num_crono").value=="" || $("nro_control").value==""){

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
	
	
	function limpiar_poderes(){

		if($("num_crono").value!="" && $("nro_control").value!="" ){
		   $("contratante").value = "";  
		   $("rango1").value = "";
		   $("rango2").value = "";  
		   $("opcion1").checked = false;
		   $("opcion2").checked = false;
		}

		if($("num_crono").value!="" && $("nro_control").value=="" ){
		   $("nro_control").value = "";
		   $("contratante").value = "";	
		   $("rango1").value = "";
		   $("rango2").value = "";	
		   $("opcion1").checked = false;
		   $("opcion2").checked = false;
		}
		
		if($("nro_control").value!="" && $("num_crono").value==""){
		    $("num_crono").value = "";
		    $("contratante").value = "";	
			$("rango1").value = "";
			$("rango2").value = "";	
			$("opcion1").checked = false;
			$("opcion2").checked = false;
		}
		
	}
	
	function limpiar_cajas_poderes(){
			$("nro_control").value = "";
			$("num_crono").value = "";
		    $("contratante").value = "";	
			$("rango1").value = "";
			$("rango2").value = "";	
			$("opcion1").checked = false;
			$("opcion2").checked = false;
			
			buscar_poderes(1);
			
	}
	