// JavaScript Document// JavaScript Document

var pagina = 1;

function listar_poderes(pag){
	
	pagina=pag;
	
	new Ajax.Updater("lst_poderes", "../consultas/list_poderes.php?pag="+pag,
	{  
	  onComplete: 
	  
	  function() { 
		if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }
	  
	},{method:'GET'});	
}

function nuevo_poder(){
	
	if($("div_mpoder").style.display =="block"){
		cerrar_mpoder();
	}
	
	$("div_npoder").style.display ="block";
	new Ajax.Updater("div_npoder", "../consultas/n_poder.php",
	{  
	  onComplete: 
	  function(){
		  
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_npoder');
	
}

function cerrar_npoder(){

	$("div_npoder").style.display ="none";

}

function registrar_poder(){
	
	var flag = validar_poder();
	
	if(flag==1){
	
		var campos =$("frm_npoder").serialize();
		
		new Ajax.Request("../consultas/registrar_poder.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_poderes(1);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_npoder();
			  }
		},{method:'GET'});
	
	}
	
}

function validar_poder(){

	var flag = 1
	
	if($("div_npoder").style.display =="block"){
		
		if(myTrim($("n_desc").value)=="" || myTrim($("n_cont").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
		
	}
	
	if($("div_mpoder").style.display =="block"){
		
		if($("m_desc").value==0 || myTrim($("m_cont").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
		
	}
		
	return flag;

}

function modificar_poder(id){
	
	cerrar_npoder();
	$("div_mpoder").style.display ="block";
	new Ajax.Updater("div_mpoder", "../consultas/m_poder.php?id_poder="+id,
	{  
	  onComplete: 
	  function(){/*cambiar_tipacto();*/}
	},{method:'GET'}
	);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_mpoder');
	
}

function cerrar_mpoder(){
	
	$("div_mpoder").style.display ="none";
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

function mod_poder(id){

	var flag = validar_poder();

	if(flag==1){	
		var campos =$("frm_mpoder").serialize();
		
		new Ajax.Request("../consultas/modificar_poder.php?"+campos+"&id_poder="+id,
		{  
			  onComplete: 
			  function() { 
			  	alert("Los datos han sido actualizados");
				listar_poderes(pagina);
			   }
		},{method:'GET'});
	}
	
}

function eliminar_poder(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_npoder();
		
		if($("div_mpoder").style.display =="block"){
			cerrar_mpoder();
		}
	
		new Ajax.Request("../consultas/eliminar_poder.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_poderes(pagina);
			  }
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
	