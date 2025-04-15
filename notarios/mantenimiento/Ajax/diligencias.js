// JavaScript Document// JavaScript Document

var pagina = 1;

function listar_diligencias(pag){
	
	pagina=pag;
	
	new Ajax.Updater("lst_diligencias", "../consultas/list_diligencias.php?pag="+pag,
	{  
	  onComplete: 
	  
	  function() { 
		if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }
	  
	},{method:'GET'});	
}

function nueva_diligencia(){
	
	if($("div_mdiligencia").style.display =="block"){
		cerrar_mdiligencia();
	}
	
	$("div_ndiligencia").style.display ="block";
	new Ajax.Updater("div_ndiligencia", "../consultas/n_diligencia.php",
	{  
	  onComplete: 
	  function(){
		  
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_ndiligencia');
	
}

function cerrar_ndiligencia(){

	$("div_ndiligencia").style.display ="none";

}

function registrar_diligencia(){
	
	var flag = validar_diligencia();
	
	if(flag==1){
	
		var campos =$("frm_ndiligencia").serialize();
		
		new Ajax.Request("../consultas/registrar_diligencia.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_diligencias(1);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_ndiligencia();
			  }
		},{method:'GET'});
	
	}
	
}

function modificar_diligencia(id){
	
	cerrar_ndiligencia();
	$("div_mdiligencia").style.display ="block";
	new Ajax.Updater("div_mdiligencia", "../consultas/m_diligencia.php?id_diligencia="+id,
	{  
	  onComplete: 
	  function(){/*cambiar_tipacto();*/}
	},{method:'GET'}
	);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_mdiligencia');
	
}

function cerrar_mdiligencia(){
	
	$("div_mdiligencia").style.display ="none";
	limpiar_color();
	
}

function mod_diligencia(id){

	var flag = validar_diligencia();

	if(flag==1){	
		var campos =$("frm_mdiligencia").serialize();
		
		new Ajax.Request("../consultas/modificar_diligencia.php?"+campos+"&id="+id,
			{  
			  onComplete: 
			  function() { 
			  	alert("Los datos han sido actualizados");
				listar_diligencias(pagina);
			  }
		},{method:'GET'});
	}
	
}

function eliminar_diligencia(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_ndiligencia();
		
		if($("div_mdiligencia").style.display =="block"){
			cerrar_mdiligencia();
		}
	
		new Ajax.Request("../consultas/eliminar_diligencia.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_diligencias(pagina);
			  }
		},{method:'GET'});
		
	} 

}

function validar_diligencia(){

	var flag = 1
	
	if($("div_ndiligencia").style.display =="block"){
		
		if(myTrim($("n_desc").value)=="" || myTrim($("n_cont").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
		
	}
	
	if($("div_mdiligencia").style.display =="block"){
		
		if($("m_desc").value==0 || myTrim($("m_cont").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
		
	}
		
	return flag;

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

function isNumberKey(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
 
		 return true;
}

function myTrim(x){
		return x.replace(/^\s+|\s+$/gm,'');
}
	