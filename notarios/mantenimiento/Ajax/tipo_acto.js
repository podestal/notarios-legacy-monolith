// JavaScript Document

var pagina = 1;

function listar_tipactos(pag){
	
	pagina=pag;
	
	var campos =$("frm_cliente").serialize();
	
	new Ajax.Updater("list_tipoactos", "../consultas/list_tipactos.php?"+campos+" &pag="+pagina,
	{  
	  onComplete: 
	  
	  function() { 
		if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }

	},{method:'GET'});	
}

function nuevo_acto(){
	
	if($("div_macto").style.display =="block"){
		cerrar_macto();
	}
	
	$("div_nacto").style.display ="block";
	new Ajax.Updater("div_nacto", "../consultas/n_tipoacto.php");	
	
	new Draggable('div_nacto');
	
}

function cerrar_nacto(){

	$("div_nacto").style.display ="none";

}

function registrar_acto(){
	
	var flag = validar_regacto();
	
	if(flag==1){
	
		var campos =$("frm_nacto").serialize();
		
		new Ajax.Request("../consultas/registrar_acto.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_tipactos(1,0);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_nacto();
			  }
		},{method:'GET'});
	
	}
	
}



function validar_regacto(){

	var flag = 1

	if($("n_tipkar")!=null){	
		if($("n_tipkar").value==0 || myTrim($("n_desc").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
	}else{
		if(myTrim($("m_desc").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
	}
	
	return flag;

}

function modificar_acto(id){
	
	cerrar_nacto();
	$("div_macto").style.display ="block";
	new Ajax.Updater("div_macto", "../consultas/m_tipoacto.php?id_acto="+id);	
	cambiar_colorfila(id);
	
	new Draggable('div_macto');
	
}

function cerrar_macto(){
	
	$("div_macto").style.display ="none";
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

function mod_acto(){

	var flag = validar_regacto();
	
	if(flag==1){
		var campos =$("frm_macto").serialize();
		
		new Ajax.Request("../consultas/modificar_acto.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				listar_tipactos(pagina);
			  }
		},{method:'GET'});
	}
	
}

function eliminar_acto(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
	
		cerrar_nacto();
		
		if($("div_macto").style.display =="block"){
			cerrar_macto();
		}
	
		new Ajax.Request("../consultas/eliminar_acto.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_tipactos(pagina);
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
	