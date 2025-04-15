// JavaScript Document

var pagina = 1;

function listar_servicios(pag){
	
	pagina=pag;
	
	if($("frm_servicio")!=null){var campos =$("frm_servicio").serialize();}
	
	new Ajax.Updater("lst_servicios", "../consultas/list_abogados.php?"+campos+"&pag="+pag,
	{  
	  onComplete: 
	  
	  function() { 
	  	//if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }
	  
	},{method:'GET'});	
}

function nuevo_servicio(){
	
	if($("div_mservicio").style.display =="block"){
		cerrar_mservicio();
	}
	
	$("div_nservicio").style.display ="block";
	new Ajax.Updater("div_nservicio", "../consultas/n_abogado.php",
	{  
	  onComplete: 
	  function(){
	  	ubigeos();
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_nservicio');
	
}

function validacheck()
 {
	if (document.getElementById('n_incpre').checked)
  {
		document.getElementById('n_incpre').value="1"
	  
	   
	   }else{
	   
	   document.getElementById('n_incpre').value=""
	  
	   
	   }
	
	 }
	 
	 
function validacheck2()
 {
	if (document.getElementById('m_incpre').checked)
  {
		document.getElementById('m_incpre').value="1"
	  
	   
	   }else{
	   
	   document.getElementById('m_incpre').value=""
	  
	   
	   }
	
	 }
	 

function cerrar_nservicio(){

	$("div_nservicio").style.display ="none";

}

function registrar_servicio(){
	
	
		var campos =$("frm_nservicio").serialize(); 
		
		new Ajax.Request("../consultas/registrar_abogado.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_servicios(1);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_nservicio();
			  }
		},{method:'GET'});
	

	
}

function validar_servicio(){

	var flag = 1
	
	if($("div_nservicio").style.display=="block"){
		
		if($("n_tipserv").value==0 || myTrim($("n_desc").value)=="" || $("n_precio1").value==""  ){
			flag = 2;		
		   alert("Ingrese campos obligatorios");
		}
		
	}
	
	if($("div_mservicio").style.display=="block"){
		if($("m_tipserv").value==0 || myTrim($("m_desc").value)=="" || $("m_precio1").value==""  ){
			flag = 2;		
		   alert("Ingrese campos obligatorios");
		}
	}

	return flag;

}


function modificar_servicio(id){
	
	cerrar_nservicio();
	$("div_mservicio").style.display ="block";
	new Ajax.Updater("div_mservicio", "../consultas/m_abogado.php?id_servicio="+id,
	{  
	  onComplete: 
	  function(){
		  
	  }
	},{method:'GET'}
	);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_mservicio');
	
}

function mod_servicio(id){

	
		var campos =$("frm_mservicio").serialize();
		
		new Ajax.Request("../consultas/modificar_abogado.php?"+campos+"&id_servicio="+id,
			{  
			  onComplete: 
			  function() { 
			  	listar_servicios(pagina);
			  	alert("Los datos se han registrado exitosamente");
			    cerrar_mservicio();
				
			  }
		},{method:'GET'});
	
	
}

function eliminar_servicio(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_nservicio();
		
		if($("div_mservicio").style.display =="block"){
			cerrar_mservicio();
		}
	
		new Ajax.Request("../consultas/eliminar_abogado.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_servicios(pagina);
				}
		},{method:'GET'});
		
	} 

}

function cerrar_mservicio(){
	
	$("div_mservicio").style.display ="none";
	limpiar_color();
	
}

var color = 0;

function cambiar_colorfila(id){

	if(color!= 0){if($("fila"+color)!=null){$("fila"+color).style.backgroundColor = "white";}}
	
	color = id;
	
	$("fila"+id).style.backgroundColor="#66ff33"; 
	
}

function limpiar_color(){
	$("fila"+color).style.backgroundColor = "white";
	color = 0;
}

function currency(id, valor) {
		
		var num = parseFloat(valor).toFixed(2);
		
		$(id).value = num;
}

function numerosdecimales(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 
		 
		 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
			return false;
 
		 return true;
}

function myTrim(x){
		return x.replace(/^\s+|\s+$/gm,'');
}





