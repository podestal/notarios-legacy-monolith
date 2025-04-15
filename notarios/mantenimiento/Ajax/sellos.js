// JavaScript Document// JavaScript Document

var pagina = 1;

function listar_sellos(pag){
	
	pagina=pag;
	
	new Ajax.Updater("lst_sellos", "../consultas/list_sellos.php?pag="+pag,
	{  
	  onComplete: 
	  
	  function() { 
	  	if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }
	  
	},{method:'GET'});	
}

function nuevo_sello(){
	
	if($("div_msello").style.display =="block"){
		cerrar_msello();
	}
	
	$("div_nsello").style.display ="block";
	new Ajax.Updater("div_nsello", "../consultas/n_sello.php",
	{  
	  onComplete: 
	  function(){
		  
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_nsello');
	
}

function cerrar_nsello(){

	$("div_nsello").style.display ="none";

}

function registrar_sello(){
	
	var flag = validar_sello();
	
	if(flag==1){
	
		var campos =$("frm_nsello").serialize();
		
		new Ajax.Request("../consultas/registrar_sello.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_sellos(1);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_nsello();
			  }
		},{method:'GET'});
	
	}
	
}

function validar_sello(){

	var flag = 1
	
	if($("div_nsello").style.display =="block"){
		
		if(myTrim($("n_desc").value)=="" || myTrim($("n_cont").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
		
	}
	
	if($("div_msello").style.display =="block"){
		
		if(myTrim($("m_desc").value)=="" || myTrim($("m_cont").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
		
	}
		
	return flag;

}

function modifica_sello(id){
	
	cerrar_nsello();
	$("div_msello").style.display ="block";
	new Ajax.Updater("div_msello", "../consultas/m_sello.php?id="+id,
	{  
	  onComplete: 
	  function(){/*cambiar_tipacto();*/}
	},{method:'GET'}
	);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_msellos');
	
}

function cerrar_msello(){
	
	$("div_msello").style.display ="none";
	limpiar_color();
	
}

var color = 0;

function cambiar_colorfila(id){

	if(color!= 0){if($("fila"+color)!=null){$("fila"+color).style.backgroundColor = "white";}}
	
	color = id;
	
	$("fila"+id).style.backgroundColor="#66ff33"; 
	
	return false;
	
}

function limpiar_color(){
	$("fila"+color).style.backgroundColor = "white";
	color = 0;
}

function mod_sello(id){

	var flag = validar_sello();

	if(flag==1){	
		var campos =$("frm_msello").serialize();
		
		new Ajax.Request("../consultas/modificar_sello.php?"+campos+"&id="+id,
			{  
			  onComplete: 
			  function() { 
			    //cerrar_msello();
				alert("Los datos han sido actualizados");
				listar_sellos(pagina);
			  }
		},{method:'GET'});
	}
	
}

function eliminar_sello(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_nsello();
		
		if($("div_msello").style.display =="block"){
			cerrar_msello();
		}
	
		new Ajax.Request("../consultas/eliminar_sello.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_sellos(pagina);
			  s}
		},{method:'GET'});
		
	} 

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
	