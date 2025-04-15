
var pagina = 1;

function listar_presentante(pag){
	
	pagina = pag;
	
	var campos = $("frm_presentante").serialize();
	
	new Ajax.Updater("list-presentante", "../consultas/list_presentantes.php?"+campos+"&pag="+pag,
	{  
	  onComplete: 
	  
	  function() { 
		if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }
	  
	},{method:'GET'});	
}


function nuevo_presentante(){
	
	if($("div_mpresentante").style.display =="block"){
		cerrar_npresentante();
	}
	
	$("div_npresentante").style.display ="block";
	new Ajax.Updater("div_npresentante", "../consultas/nuevo_presentante.php",
	{  
	  onComplete: 
	  function(){
	  	//ubigeos();
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_npresentante');
	
}

function cerrar_npresentante(){
	$("div_npresentante").style.display = "none";
	
}


function registrar_presentante(){
	
	var flag = validar_presentante();

	if(flag==1){
	
		var campos =$("frm_npresentante").serialize(); 
		
		new Ajax.Request("../consultas/registrar_presentante.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_presentante(1);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_npresentante();
			  }
		},{method:'GET'});
	
	}
	
}

function validar_presentante(){

	var flag = 1
	
	if($("div_npresentante").style.display=="block"){
		
		if(myTrim($("txtDni").value) == ""){
		   flag = 2;		
		   alert("Ingrese Numero de Documento");
		}
		if(myTrim($("txtApellidoPaterno").value)==""){
		   flag = 3;		
		   alert("Ingrese Apellido Paterno");
		}
		if(myTrim($("txtApellidoMaterno").value)==""){
		   flag = 4;		
		   alert("Ingrese Apellido Materno");
		}
		if(myTrim($("txtPrimerNombre").value)==""){
		   flag = 5;		
		   alert("Ingrese Primer Nombre");
		}
		
	}
	return flag;

}

function myTrim(x){
		return x.replace(/^\s+|\s+$/gm,'');
}

function  mostrarTodos(){
	$('txtNumeroDocumento').value = '';
	listar_presentante(1);
}


function modificar_presentante(id){
	
	cerrar_mpresentante();
	$("div_mpresentante").style.display ="block";
	new Ajax.Updater("div_mpresentante", "../consultas/modificar_presentante.php?idPresentante="+id);		
	
	
	
	new Draggable('div_mpresentante');
	
}

function cerrar_mpresentante(){
	$("div_mpresentante").style.display = "none";
}

function actualizar_presentante(valor){
	
	var idPresentante = valor;
	var campos =$("frm_mpresentante").serialize(); 
		
		new Ajax.Request("../consultas/actualizar_presentante.php?"+campos+'&idPresentante='+idPresentante,
			{  
			  onComplete: 
			  function() { 
				 listar_presentante(1);
				 alert("Los datos se han modificado exitosamente");
				 $("div_mpresentante").style.display ="none";
	
			  }
		},{method:'GET'});
	
	}

	function open_login(id){
		$("div_login").style.display = "block";

		new Draggable('div_login');
		new Ajax.Updater("div_login", "../widgets/login.php?id="+id,
		{  
	 		onComplete: 
	  	function() {

	  	}
	},{method:'GET'});
}

function cerrar_login(){
	$("div_login").style.display = "none";
}

function login(id){
	
	var usuario = $("usuario").value;
	var clave = $("clave").value;
	
	if(myTrim(usuario)!="" && myTrim(clave)!=""){
		new Ajax.Request('../consultas/login.php?user='+usuario+'&pass='+clave, 
		{
			method:'get',
			requestHeaders: {Accept: 'application/json'},
			onSuccess: function(transport){
						var json = transport.responseText.evalJSON(true);
						if(json==1){
							cerrar_login();
							eliminar_presentante(id);
						}
						if(json==2){alert("Clave o Password Incorrecto");}
	}
	});

	}else{
		alert("Ingrese usuario y password");
	}
	
}
function eliminar_presentante(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_npresentante();
		
		if($("div_mpresentante").style.display =="block"){
			cerrar_mpresentante();
		}
	
		new Ajax.Request("../consultas/eliminar_presentante.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_presentante(pagina);
				}
		},{method:'GET'});
		
	} 

}

function buscarDniReniec(){

	vdni = $('txtDni').value;
	vimgCaptcha = $('txtImgCaptcha').value;

	$('txtApellidoPaterno').value ='';
	$('txtApellidoMaterno').value = '';
	$('txtPrimerNombre').value = '';
	$('txtSegundoNombre').value = '';
	$('txtTercerNombre').value = '';

	new Ajax.Request('../../reniec_sunat/get_data_persona_natural.php?dni='+vdni+'&imgCaptcha='+vimgCaptcha, 
		{
			method:'get',
			requestHeaders: {Accept: 'application/json'},
			onSuccess: function(transport){

				var json = transport.responseText.evalJSON(true);

				if(json.error == 0){
					$('txtApellidoPaterno').value = json.surname1;
					$('txtApellidoMaterno').value = json.surname2;
					$('txtPrimerNombre').value = json.name1;
					$('txtSegundoNombre').value = json.name2;
					$('txtTercerNombre').value = json.name3;
				}else{
					alert(json.messageDescription);
				}

				

			}
	});


}