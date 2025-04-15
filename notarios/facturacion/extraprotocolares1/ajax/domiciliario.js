// JavaScript Document

	var pagina = 1;
	

	function buscar_domiciliarios(page){

		pagina = page;

		var flag = validar_fechas();
    	
		//alert(flag);
		
		if(flag ==1){
        
			
		   var campos =$("frm_buscardomiciliarios").serialize();
		   new Ajax.Updater("lista_domiciliarios", "busqueda_domiciliarios.php?" + campos+"&pag=" + page);
			
		   limpiar_domiciliarios();
		
    	}

		if(flag ==2){
		
			//alert("No Ejecuta operacion");  
		
		}

	}

	function ver_domiciliarios(id_domiciliario){
		document.location.href="EdiCertDomiVie.php?id_domiciliario="+id_domiciliario;
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
	
	
	function limpiar_domiciliarios(){

		if($("num_crono").value!="" ){
		   $("solicitante").value = "";  
		   $("rango1").value = "";
		   $("rango2").value = "";  
		}

	}
	
	function limpiar_cajas_domiciliarios(){
			
		$("num_crono").value!="";		
		$("solicitante").value = "";  
		$("rango1").value = "";
		$("rango2").value = "";  
			
		buscar_domiciliarios(1);
			
	}
	
	
	function cambiar_doc(id, valor){
		
		$(id).value ="";
		
		switch (valor){
			
			case '0':
			document.getElementById(id).maxLength=20; 
			break;
			
			case '1':
			document.getElementById(id).maxLength=8; 
			break;
						
			case '2':
			document.getElementById(id).maxLength=16;
			break;		
			
			case '3':
			document.getElementById(id).maxLength=16;
			break;
			
			case '4':
			document.getElementById(id).maxLength=16;
			break;
			
			case '5':
			document.getElementById(id).maxLength=16;
			break;
			
			case '6':
			document.getElementById(id).maxLength=16;
			break;
			
			case '7':
			document.getElementById(id).maxLength=16;
			break;
			
			case '8':
			document.getElementById(id).maxLength=11;
			break;
			
			case '9':
			document.getElementById(id).maxLength=20;
			break;
			
			case '10':
			document.getElementById(id).maxLength=20;
			break;
			
			case '11':
			document.getElementById(id).maxLength=20;
			break;
		
		}	
	}
	
	function mostrar_solicitante(){
		var par = 1;
		new Ajax.Updater("div_solicitante", "../consultas/busqueda_doc.php?par="+par,
			{  
			  onComplete: 
			  function() { 
				ubigeo_n();		
				profesion_n();
			  }
		},{method:'GET'});
	}
	
	var ubigeo = "";
	var profesion = "";
	
	function ubigeo_n(){
		var j = jQuery.noConflict();
			   
			   j(function(){
					j('#n_ubigeo').autocomplete({
					source:'../consultas/ubigeos.php',
					select: function(event, ui){
						$("n_idubigeo").value = ui.item.id;
						ubigeo = ui.item.value;
					}
					});
			   });
	}
	
	function profesion_n(){
		var j = jQuery.noConflict();
			   
			   j(function(){
					j('#n_profesion').autocomplete({
					source:'../consultas/profesiones.php',
					select: function(event, ui){
						$("n_idprofesion").value = ui.item.id;
						profesion = ui.item.value;
					}
					});
			   });
	}
	
	function buscar_doc(id, key){
		
		var unicode
		if (key.charCode){unicode=key.charCode;}
		else {unicode=key.keyCode;}
		
		if (unicode == 13){
			//alert('Presiono enter');
			var doc = $(id).value;
			new Ajax.Updater("div_solicitante", "../consultas/busqueda_doc.php?numdoc="+doc);
		}
		
	}
	
	function evaluar_distrito(){
		if($("n_idubigeo").value==""){alert("Nombre de distrito no valido");}
		$("n_ubigeo").value = ubigeo;
	}
	
	function evaluar_ocupacion(){
		if($("n_idprofesion").value==""){alert("Nombre de profesión no valido");}
			$("n_profesion").value = profesion;
	}
	
	function grabar_domiciliario(){
	
	var flag = validar_domiciliario();
	
	//var flag=1;
	
	if(flag==1){
	
		var campos =$("frm_ndomiciliario").serialize();
		
		new Ajax.Request("../consultas/registrar_domiciliario.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 //listar_condicion(1,0);
				 alert("Los datos se han registrado exitosamente");
				 //cerrar_ncondicion();
			  }
		},{method:'GET'});
	
		}
	}
	
	
	function mostrar_solicitantem(){
		
		var par = 1;
		
		var id_dom = $("m_iddomi").value;
		
		new Ajax.Updater("div_solicitante", "../consultas/busqueda_docm.php?par="+par+"&id_domiciliario="+id_dom,
			{  
			  onComplete: 
			  function() { 
				ubigeo_m();		
				profesion_m();
			  }
		},{method:'GET'});
	}
	
	var m_ubigeo = "";
	var m_profesion = "";
	
	function ubigeo_m(){
		var j = jQuery.noConflict();
			   
			   j(function(){
					j('#m_ubigeo').autocomplete({
					source:'../consultas/ubigeos.php',
					select: function(event, ui){
						$("m_idubigeo").value = ui.item.id;
						ubigeo = ui.item.value;
					}
					});
			   });
	}
	
	function profesion_m(){
		var j = jQuery.noConflict();
			   
			   j(function(){
					j('#m_profesion').autocomplete({
					source:'../consultas/profesiones.php',
					select: function(event, ui){
						$("m_idprofesion").value = ui.item.id;
						profesion = ui.item.value;
					}
					});
			   });
	}
	
	function buscar_docm(id, key){
		
		var unicode
		if (key.charCode){unicode=key.charCode;}
		else {unicode=key.keyCode;}
		
		if (unicode == 13){
			//alert('Presiono enter');
			var doc = $(id).value;
			new Ajax.Updater("div_solicitante", "../consultas/busqueda_docm.php?numdoc="+doc);
		}
		
	}
	
	function evaluar_distrito(){
		if($("m_idubigeo").value==""){alert("Nombre de distrito no valido");}
		$("m_ubigeo").value = ubigeo;
	}
	
	function evaluar_ocupacion(){
		if($("m_idprofesion").value==""){alert("Nombre de profesión no valido");}
			$("m_profesion").value = profesion;
	}
	
	function mod_domiciliario(id){

	var flag = validar_domiciliario();

		if(flag==1){	
			var campos =$("frm_mdomiciliario").serialize();
			
			new Ajax.Request("../consultas/modificar_domiciliario.php?"+campos+"&id_condicion="+id,
				{  
				  onComplete: 
				  function() { 
					//listar_condicion(pagina,0);
				  }
			},{method:'GET'});
		}
	
	}
	
	
	function myTrim(x){
			return x.replace(/^\s+|\s+$/gm,'');
	}
	
	
	function validar_domiciliario(){

		var flag = 1
		
		
		if($("n_tipdocus")!=null){
			if($("n_tipdocus").value==0 || $("n_numdocus").value=="" || $("n_solicitante").value=="" || $("n_domicilio").value=="" || $("n_idubigeo").value==""){
				 flag = 2;		
				 alert("Ingrese campos obligatorios");
			}
		}
		
		
		if($("m_tipdocus")!=null){
			if($("m_tipdocus").value==0 || $("m_numdocus").value=="" || $("m_solicitante").value=="" || $("m_domicilio").value=="" || $("m_idubigeo").value==""){
				 flag = 2;		
				 alert("Ingrese campos obligatorios");
			}
		}
			
		return flag;
	
	}
	
	
	function crear_odt(){
		alert("ODT Creado");
	}
	
	
	
	
	
	
	
	