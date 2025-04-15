// JavaScript Document// JavaScript Document


	var j = jQuery.noConflict();
	
	j.datepicker.regional['es'] = {
								 closeText: 'Cerrar',
								 prevText: '<Ant',
								 nextText: 'Sig>',
								 currentText: 'Hoy',
								 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
								 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
								 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
								 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
								 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
								 weekHeader: 'Sm',
								 dateFormat: 'dd/mm/yy',
								 firstDay: 1,
								 isRTL: false,
								 showMonthAfterYear: false,
								 yearSuffix: ''
								 };

    j.datepicker.setDefaults(j.datepicker.regional['es']);
	

var pagina = 1;

function listar_abogado(pag){
	
	pagina=pag;
	
	var campos =$("frm_abogado").serialize();
	
	new Ajax.Updater("lst_abogado", "../consultas/list_abogado_new.php?"+campos+"&pag="+pag,
	{  
	  onComplete: 
	  
	  function() { 
		if($("fila"+color)!=null){cambiar_colorfila(color);}
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
						if(json==1){eliminar_abogado(id);}
						if(json==2){alert("Clave o Password Incorrecto");}
	}
	});
	}else{
		alert("Ingrese usuario y password");
	}
	
}


function nuevo_abogado(){
	
	if($("div_mabogado").style.display =="block"){
		cerrar_mcliente();
	}
	
	$("div_nabogado").style.display ="block";
	new Ajax.Updater("div_nabogado", "../consultas/n_abogado_new.php",
	{  
	  onComplete: 
	  function(){
	  	ubigeos();
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_nabogado');
	
}

function cerrar_nabogado(){
	$("div_nabogado").style.display ="none";
	
}

function cambiar_doic(par, valor){
	
	if(par==1){doc = $("n_doc"); $(doc).value = "";}
	if(par==2){doc = $("m_doc");}
	if(par==3){doc = $("c_doc");}
	
	switch (valor){
		
		case '1':
		$(doc).maxLength=8; 
		break;
					
		case '2':
		$(doc).maxLength=16;
		break;		
		
		case '3':
		$(doc).maxLength=16;
		break;
		
		case '4':
		$(doc).maxLength=16;
		break;
		
		case '5':
		$(doc).maxLength=16;
		break;
		
		case '6':
		$(doc).maxLength=16;
		break;
		
		case '7':
		$(doc).maxLength=20;
		break;
		
		case '8':
		$(doc).maxLength=11;
		break;
		
		case '9':
		$(doc).maxLength=20;
		break;
		
		case '10':
		$(doc).maxLength=20;
		break;
		
		case '11':
		$(doc).maxLength=20;
		break;
	
	}
}

function ubigeos(){

	j(function(){
			j('#n_ubigeo').autocomplete({
			source:'../consultas/ubigeos.php',
			select: function(event, ui){
				$("n_idubigeo").value = ui.item.id;
			}
			});
	   });

}

function m_ubigeos(){

	j(function(){
			j('#m_ubigeo').autocomplete({
			source:'../consultas/ubigeos.php',
			select: function(event, ui){
				$("m_idubigeo").value = ui.item.id;
			}
			});
	   });

}

function c_ubigeos(){

	j(function(){
			j('#c_ubigeo').autocomplete({
			source:'../consultas/ubigeos.php',
			select: function(event, ui){
				$("c_idubigeo").value = ui.item.id;
			}
			});
	   });

}

function open_row(){
	
	var tipper = $("tip_per").value; 
	
	if(tipper==0){	$("fila_juridica").style.display='none'; $("fila_natural").style.display='none';}
	
	if(tipper=="N"){ 
	
		Effect.toggle('fila_natural', 'slide', { delay: 0.0 }); 

		$("fila_juridica").style.display='none';

		fecha_nac_n();
	
	}
	
	if(tipper=="J"){ 
	
		Effect.toggle('fila_juridica', 'slide', { delay: 0.0 }); 
		
		$("fila_natural").style.display='none';

		fecha_cons_n();

	}
	
}

function fecha_nac_n(){
	
	var j = jQuery.noConflict();
			   
	 j(function() {
		j( "#n_fecnac" ).datepicker();
	 });
	   
}

function fecha_cons_n(){
		
	var j = jQuery.noConflict();
			   
	j(function() {
		j( "#n_feccons" ).datepicker();
	});
	   
}

function fecha_nac_m(){
	
	var j = jQuery.noConflict();
			   
	 j(function() {
		j( "#m_fecnac" ).datepicker();
	 });
	   
}

function fecha_cons_m(){
		
	var j = jQuery.noConflict();
			   
	j(function() {
		j( "#m_feccons" ).datepicker();
	});
	   
}

function mostrar_impedidos(){
	Effect.toggle('n_filaimpedidos', 'slide', { delay: 0.0 });
}

function registrar_abogado(){
	
	var flag = validar_abogado();

	if(flag==1){
	
		var campos =$("frm_nabogado").serialize(); 
		
		new Ajax.Request("../consultas/registrar_abogado_new.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_abogado(1);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_nabogado();
			  }
		},{method:'GET'});
	
	}
	
}

function mod_impedido(valor){
	
	var idabogado= valor;
	var campos =$("frm_mabogado").serialize(); 
		
		new Ajax.Request("../consultas/modificar_abogado_new.php?"+campos+'&idabogado='+idabogado,
			{  
			  onComplete: 
			  function() { 
				 listar_abogado(1);
				 alert("Los datos se han modificado exitosamente");
				 $("div_mabogado").style.display ="none";
	
			  }
		},{method:'GET'});
	
	}

function validar_abogado(){

	var flag = 1
	
	if($("div_nabogado").style.display=="block"){
		
		if(myTrim($("razonsocial").value)==""){
		   flag = 2;		
		   alert("Ingrese campos obligatorios");
		}
		
	}

	return flag;

}

function modificar_abogado(id){
	
	cerrar_nabogado();
	$("div_mabogado").style.display ="block";
	new Ajax.Updater("div_mabogado", "../consultas/m_abogado_new.php?idabogado="+id);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_mabogado');
	
}


function m_openrow(){

	var tipper = $("m_tipper").value; 
	
	if(tipper==0){	$("m_filanatural").style.display='none'; $("m_filajuridica").style.display='none';}
	
	if(tipper=="N"){ 
	
		//Effect.toggle('m_filanatural', 'slide', { delay: 0.0 }); 
		
		$("m_filanatural").style.display='block';
		$("m_filajuridica").style.display='none';

		fecha_nac_m();
	
	}
	
	if(tipper=="J"){ 
	
		//Effect.toggle('m_filajuridica', 'slide', { delay: 0.0 }); 
		
		$("m_filajuridica").style.display='block';
		$("m_filanatural").style.display='none';

		fecha_cons_m();

	}
	
	if($("m_tipcliente").checked==true){
		mostrar_impedidosm();
	}

}

function open_conyugue(){
	
	var estado = $("n_civil").value;
	
	if(estado==2){
		$("btn_conyugue").style.display='block';
	}
	else{
		$("btn_conyugue").style.display='none';
		$("btn_conyugue2").style.display = "none";
		$("txt_conyugue").value = "";
	}
	
}


function nuevo_conyugue(id){

	if($("div_ncliente").style.display =="block"){
		var prinom = myTrim($("n_prinom").value); 
		var apepat = myTrim($("n_apepat").value); 
	}
	
	if($("div_mcliente").style.display =="block"){
		var prinom = myTrim($("m_prinom").value); 
		var apepat = myTrim($("m_apepat").value); 
	}

	if(prinom=="" || apepat==""){
		alert("Ingrese nombre y apellidos");
		return false;
	}	

	$("div_nconyugue").style.display ="block";
	
	new Ajax.Updater("div_nconyugue", "../consultas/n_conyugue.php?id="+id+"&prinom="+prinom+"&apepat="+apepat);
	new Draggable('div_nconyugue');
}


function registrar_conyugue(){
	
	var flag = validar_conyugue();
	
	if(flag==1){
	
				var campos =$("frm_nconyugue").serialize(); 
				
				new Ajax.Request("../consultas/registrar_conyugue.php?"+campos,
					{  
					  onComplete: 
					  function() { 
					  
					  	if($("div_ncliente").style.display=="block"){					
							 $("btn_conyugue").style.display = "none";
							 $("btn_conyugue2").style.display = "block";
							 
							 $("txt_conyugue").value =  $("c_apepat").value+", "+$("c_prinom").value;
							 $("n_conyugue").value = $("c_cod").value; 
							 
							 if($("txt_conyugue").value!="" && $("n_conyugue").value!=""){cerrar_nconyugue();}
						}
						
						if($("div_mcliente").style.display=="block"){	
							 //$("btm_conyugue").style.display = "none";
							 $("btm_conyugue2").style.display = "block";
							 $("txt_mconyugue").value =  $("c_apepat").value+", "+$("c_prinom").value;
							 $("m_conyugue").value =$("c_cod").value;
							 
						}
					}
				},{method:'GET'});
	
	}
	
}


function validar_conyugue(){

	var flag = 1
	
	if($("div_nconyugue").style.display=="block"){
		if($("c_tipdoc").value==0 || myTrim($("c_doc").value)=="" || myTrim($("c_prinom").value)=="" || myTrim($("c_apepat").value)==""){
		   flag = 2;		
		   alert("Ingrese campos obligatorios");
		}
	}
	
	/*
	if($("div_mcliente").style.display=="block"){
		if($("m_tipper").value==0 || $("m_tipdoc").value==0 || myTrim($("m_doc").value)==""){
		   flag = 2;		
		   alert("Ingrese campos obligatorios");
		}
		
		if(flag==1 && $("m_tipper").value=="N"){
			if(myTrim($("m_prinom").value)=="" || myTrim($("m_apepat").value)==""){
				flag = 2;		
				alert("Ingrese campos obligatorios");   
			}
		}
		
		if(flag==1 && $("m_tipper").value=="J"){
			if(myTrim($("m_razon").value)==""){
				flag = 2;		
				alert("Ingrese campos obligatorios");   
			}
		}
	}*/

	return flag;

}


function cerrar_nconyugue(){
	$("div_nconyugue").style.display ="none";
}

function cambiar_civil(){
	if($("m_civil").value==2){
		$("txt_mconyugue").style.display = "block";
	}else{
		$("txt_mconyugue").style.display = "none";
		$("btm_conyugue").style.display = "block";
	}
}


function mostrar_impedidosm(){
	Effect.toggle('m_filaimpedidos', 'slide', { delay: 0.0 });
}

function cerrar_mabogado(){
	
	$("div_mabogado").style.display ="none";
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

function mod_abogado(id){

	var flag = validar_abogado();

	if(flag==1){	
		var campos =$("frm_mabogado").serialize();
		
		new Ajax.Request("../consultas/modificar_abogado_new.php?"+campos+"&idabogado="+id,
			{  
			  onComplete: 
			  function() { 
				listar_abogado(pagina);
			  }
		},{method:'GET'});
	}
	
}

function eliminar_abogado(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_nabogado();
		
		if($("div_mabogado").style.display =="block"){
			cerrar_mabogado();
		}
	
		new Ajax.Request("../consultas/eliminar_abogado_new.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_abogado(pagina);
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
	