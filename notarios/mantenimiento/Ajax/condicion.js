// JavaScript Document// JavaScript Document

var pagina = 1;

function listar_condicion(pag){
	
	pagina=pag;
	
	var campos =$("frm_cliente").serialize();
	
	new Ajax.Updater("list_cond", "../consultas/list_condicion.php?"+campos+"&pag="+pagina,
	{  
	  onComplete: 
	  
	  function() { 
		if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }
	  
	},{method:'GET'});	
}

function nueva_condicion(){
	
	if($("div_mcondicion").style.display =="block"){
		cerrar_mcondicion();
	}
	
	$("div_ncondicion").style.display ="block";
	new Ajax.Updater("div_ncondicion", "../consultas/n_condicion.php",
	{  
	  onComplete: 
	  function(){
		  cambiar_tipacto(1);
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_ncondicion');
	
}

function cambiar_tipacto(opt){
	
	if(opt==1){
		var id_kardex = $("n_tipkar").value;
	
		new Ajax.Updater("div_tipacto", "../consultas/slc_tipodeacto.php?id_kardex="+id_kardex+"&opt="+opt);		
	}
	
	if(opt==2){
		var id_kardex = $("m_tipkar").value;
	
		new Ajax.Updater("div_tipacto", "../consultas/slc_tipodeacto.php?id_kardex="+id_kardex+"&opt="+opt);		
	}
	
}

function cerrar_ncondicion(){

	$("div_ncondicion").style.display ="none";

}

function registrar_condicion(){
	
	var flag = validar_condicion();
	
	if(flag==1){
	
		var campos =$("frm_ncond").serialize();
		
		new Ajax.Request("../consultas/registrar_condicion.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_condicion(1,0);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_ncondicion();
			  }
		},{method:'GET'});
	
	}
	
}

function validar_condicion(){

	var flag = 1
	
	if($("n_tipact")!=null){
		if($("n_tipact").value==0 || myTrim($("n_cond").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
	}
	
	if($("m_tipact")!=null){
		if(myTrim($("m_cond").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");
		}
	}
		
	return flag;

}

function modificar_condicion(id){
	
	cerrar_ncondicion();
	$("div_mcondicion").style.display ="block";
	new Ajax.Updater("div_mcondicion", "../consultas/m_condicion.php?id_condicion="+id,
	{  
	  onComplete: 
	  function(){/*cambiar_tipacto();*/}
	},{method:'GET'}
	);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_mcondicion');
	
}

function cerrar_mcondicion(){
	
	$("div_mcondicion").style.display ="none";
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

function mod_condicion(id){

	var flag = validar_condicion();

	if(flag==1){	
		var campos =$("frm_mcond").serialize();
		
		new Ajax.Request("../consultas/modificar_condicion.php?"+campos+"&id_condicion="+id,
			{  
			  onComplete: 
			  function() { 
				listar_condicion(pagina,0);
			  }
		},{method:'GET'});
	}
	
}

function eliminar_condicion(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_ncondicion();
		
		if($("div_mcondicion").style.display =="block"){
			cerrar_mcondicion();
		}
	
		new Ajax.Request("../consultas/eliminar_condicion.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_condicion(pagina);
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
	
	
function actualiza(){
		new Ajax.Request("../consultas/actualiza.php");
}