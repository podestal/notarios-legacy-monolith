
var pagina=1;

function buscar_kardex(page,tipkarbanco){
        
	pagina = page;
		
	if($("num_kardex").value!=""){
		limpiar_kardex();
	}
		
	var campos =$("frm_kardex").serialize();
	
	new Ajax.Updater("lista_kardex","busqueda_kardex.php?" + campos+"&pag=" + page + "&tipkarbanco=" + tipkarbanco,
	{  
		onComplete: 
		function() { 
			
		}
	},{method:'GET'});
			   
}

/*
function buscar_kardex(page){
        
	pagina = page;
		
	if($("num_kardex").value!=""){
		limpiar_kardex();
	}
		
	var campos =$("frm_kardex").serialize();
	
	new Ajax.Updater("lista_kardex","busqueda_kardex.php?" + campos+"&pag=" + page,
	{  
		onComplete: 
		function() { 
			
		}
	},{method:'GET'});
			   
}

*/

function buscar_kardex2(page){
        
	pagina = page;
		
	if($("num_kardex").value!=""){
		limpiar_kardex();
	}
		
	var campos =$("frm_kardex").serialize();
	
	new Ajax.Updater("lista_kardex","busqueda_kardex2.php?" + campos+"&pag=" + page,
	{  
		onComplete: 
		function() { 
			
		}
	},{method:'GET'});
			   
}

function buscar_kardex3(page){
        
	pagina = page;
		
	if($("num_kardex").value!=""){
		limpiar_kardex();
	}
		
	var campos =$("frm_kardex").serialize();
	
	new Ajax.Updater("lista_kardex","busqueda_kardex3.php?" + campos+"&pag=" + page,
	{  
		onComplete: 
		function() { 
			
		}
	},{method:'GET'});
			   
}

function buscar_kardex4(page){
        
	pagina = page;
		
	if($("num_kardex").value!=""){
		limpiar_kardex();
	}
		
	var campos =$("frm_kardex").serialize();
	
	new Ajax.Updater("lista_kardex","busqueda_kardex4.php?" + campos+"&pag=" + page,
	{  
		onComplete: 
		function() { 
			
		}
	},{method:'GET'});
			   
}

function buscar_kardex5(page){
        
	pagina = page;
		
	if($("num_kardex").value!=""){
		limpiar_kardex();
	}
		
	var campos =$("frm_kardex").serialize();
	
	new Ajax.Updater("lista_kardex","busqueda_kardex5.php?" + campos+"&pag=" + page,
	{  
		onComplete: 
		function() { 
			
		}
	},{method:'GET'});
			   
}


function limpiar_kardex(){
   
   $("nombre").value = "";

}

function grabar_kardex(){
	
	var campos =$("frm_nkardex").serialize();
	
	flag = validar_kardex();
	
	if(flag==1){
		new Ajax.Request("../consultas/registrar_kardex.php?"+campos,
		{
			method:'get',
			requestHeaders: {Accept: 'application/json'},
			onSuccess: function(transport){
						var json = transport.responseText.evalJSON(true);
						document.getElementById("div_codigo").innerHTML=json;
						mostrar_nsecciones();
			}
		});	
	}
	
}

function mostrar_nsecciones(){
	$("div_nsecciones").style.display = "block";
	new Ajax.Updater("div_nsecciones","widgets/secciones.php");
}

function validar_kardex(){
	
	var flag = 1
	
	if($("frm_nkardex")!= null){
		if($("n_tipkardex").value==0 || $("n_codactos").value==""){
		   alert("Ingrese Tipo de Kardex o Actos");
		   flag = 2;
		}
	}
	
	if($("frm_mkardex")!= null){
		if($("m_codactos").value==""){
		   alert("Todavía no ha ingresado Actos");
		   flag = 2;
		}
	}
		
	return flag;
	
}

function ver_kardex(name,id){
	//document.location.href="consultas/verkardex.php?kardex="+kardex;
	
	document.location.href="verkardex.php?kardex="+name+"&id="+id;
}


function mostrar_actos(id, par){
	
	if($("n_tipkardex")!=null){var tipkar = $("n_tipkardex").value;}
	
	if($("m_tipkardex")!=null){
		var tipkar = $("m_tipkardex").value;
			cad_codacto = $("m_codactos").value;
			//$("m_contrato").value;
	}
	
	if(tipkar!=0){
		
		if(par==1){
			$("div_actos1").style.display="block";
			$("div_actos2").style.display="none";
		}
		
		if(par==2){
			$("div_actos1").style.display="none";
			if(cad_codacto!=""){
				$("div_actos2").style.display="block";
			}
		}
		
		if(par==1){
			if(cad_codacto!=""){
				new Ajax.Updater("div_actos1","widgets/agregar_actos.php?tipkar="+tipkar+"&cad="+cad_codacto);
			}else{
				new Ajax.Updater("div_actos1","widgets/agregar_actos.php?id="+id+"&tipkar="+tipkar);
			}
		}
		
		if(par==2){
			if(cad_codacto!=""){
				new Ajax.Updater("div_actos2","widgets/quitar_actos.php?cad="+cad_codacto);
			}else{
				alert("Todavía no se han agregado actos");
			}
		}
		
	}else{
		alert("Debe escoger un tipo de Kardex");
	}
	
}

function cambiar_kardex(){
	cad_codacto = "";
	cad_contrato = "";
	$("n_codactos").value="";
	$("n_contrato").value="";
}

var cad_codacto = "";

var cad_contrato = "";

function actualiza_actos(id, value){
	
	var descacto = $("desc_acto"+value).value;
	
	if(document.getElementById(id).checked == true){
		
		if(cad_codacto!=""){
			for(var i=0; i<cad_codacto.length; i=i+3){
				if(cad_codacto.substring(i, i+3) == value){return false;}	
			}
		}
		
		cad_codacto = cad_codacto + value;
		
		cad_contrato = cad_contrato + descacto+"/";
		
		
	}
	
	new_cadcodacto = "";
	new_cadcontrato = "";
	
	if(document.getElementById(id).checked == false){
		
		var count=0;
		
		for(var i=0; i<cad_codacto.length; i=i+3){
			if(cad_codacto.substring(i, i+3) != value){
				new_cadcodacto = new_cadcodacto + cad_codacto.substring(i, i+3);
				
			}else{
				var indice = count;
			}
			
			count++;
			
		}
		
		cad_codacto = new_cadcodacto; 
		
		var arr_cadcon = cad_contrato.split("/"); 
		
		for(var j=0; j<arr_cadcon.length-1; j++){
			if(j!=indice){
				new_cadcontrato = new_cadcontrato + arr_cadcon[j]+"/"; 
			}
		}
		
		cad_contrato = new_cadcontrato;
		
	}
	
	if($("frm_nkardex")!=null){
		new Ajax.Updater("div_codactos","widgets/codactos.php?cad="+cad_codacto);
		new Ajax.Updater("div_contrato","widgets/contrato.php?cad="+cad_contrato);
	}
	
	if($("frm_mkardex")!=null){
		$("m_codactos").value = cad_codacto;
		$("m_contrato").value = cad_contrato;
	}
	
}

function actualizar_actos(par){
	
	if(par==1){$("div_actos1").style.display="none";}
	
	if(par==2){$("div_actos2").style.display="none";}
	
}

function grabar_cambios(id){
	
	var flag = validar_kardex();
	
	var campos =$("frm_mkardex").serialize();
	
	if(flag==1){
		new Ajax.Request("../consultas/modificar_kardex.php?"+campos+"&id="+id,
			{  
			onComplete: 
			function() { 
				menus_editar(menu, id);		
			}
		},{method:'GET'});
	}
	
}

var menu=0;

function menus_editar(par, id){
	
	switch(par){
		case 1: 
		new Ajax.Updater("menus","widgets/contratantes.php?id=" + id);
		menu = 1;
		break;
		
		case 2: 
		new Ajax.Updater("menus","widgets/facturacion.php?id=" + id
		,
		{  
		  onComplete: 
		  function() { 
		  
		  	var pre1 = $("m_notarial").value;
			
			$("pre1").value = pre1;
		  	
			var saldo1 = $("m_notarial").value - $("cobrado1").value;
		  	$("saldo1").value = saldo1.toFixed(2);
			
			var pre2 = $("m_registral").value;
			
			$("pre2").value = pre2;
			
			var saldo2 = $("m_registral").value - $("cobrado2").value;
		  	$("saldo2").value = saldo2.toFixed(2);
			
		  }
		
		},{method:'GET'}
		);
		menu = 2;
		
		break;
		
		case 3: 
		new Ajax.Updater("menus","widgets/escrituracion.php?id=" + id);
		menu = 3;
		
		break;
		
		case 4: 
		new Ajax.Updater("menus","widgets/registros.php?id=" + id
		,
		{  
		  onComplete: 
		  function() { 
		  	var reg = $("m_registral").value;
			$("txt_presupuesto").value = reg;
			
		  }
		
		},{method:'GET'}
		);
		menu = 4;
		
		break;
		
		default:
		break;
	}
	
}

function mostrar_firma(){
	$("div_firma").style.display= "block";
	new Ajax.Updater("div_firma","widgets/firma.php");
}

function cerrar_firma(){
	$("div_firma").style.display= "none";
}

function nuevo_contratante(){
	$("div_ncontratante").style.display= "block";
	new Ajax.Updater("div_ncontratante","widgets/nuevo_contratante.php");
}

function cerrar_contratante(){
	$("div_ncontratante").style.display= "none";
}

function buscar_contratante(){
	
	var campos =$("frm_bcontratante").serialize();
	
	new Ajax.Updater("cuerpo_contratante","widgets/lista_contratantes.php?"+campos);
	
}

function agregar_contratante(id, tipo){
	if(tipo==1){new Ajax.Updater("cuerpo_contratante","widgets/agregar_contratante.php?id="+id);}
	if(tipo==2){new Ajax.Updater("cuerpo_contratante","widgets/agregar_contratante2.php?id="+id);}
	
}

function grabar_contratante(par){
	
	var codkardex = $("codkardex").value;
	var tipkardex = $("m_tipkardex").value;
	
	if(par==1){var campos =$("frm_agrecont1").serialize();}
	if(par==2){var campos =$("frm_agrecont2").serialize();}
	
	new Ajax.Request("../consultas/registrar_contratante.php?"+campos+"&codkardex="+codkardex+"&tipkardex="+tipkardex,
	{  
		onComplete: 
		function() { 
			menus_editar(1, codkardex);
		}
	},{method:'GET'});
	
}

function mod_contratante(id_contratante, par){
	
	if(par==1){var campos =$("frm_mcontratante1").serialize();}
	if(par==2){var campos =$("frm_mcontratante2").serialize();}
	
	new Ajax.Request("../consultas/actualizar_contratante.php?"+campos+"&id="+id_contratante,
	{  
		onComplete: 
		function() { 
			//menus_editar(1, codkardex);
		}
	},{method:'GET'});
	
}

function ingresar_cliente(par){
	
	if(par==1){
		new Ajax.Updater("cuerpo_contratante","widgets/filanat.php",
		{  
		  onComplete: 
		  function() { 
			fecha_nac_n();
		  }
		
		},{method:'GET'}
		);
	}
	if(par==2){
		new Ajax.Updater("cuerpo_contratante","widgets/filajud.php",
		{  
		  onComplete: 
		  function() { 
			fecha_cons_n();
		  }
		
		},{method:'GET'}
		);
	}
	
}


function grabar_cliente(par){
	
	var flag = validar_cliente(par);

	if(flag==1){
			if(par==1){
				
				var campos =$("frm_natural").serialize();
				
				new Ajax.Request('../consultas/registrar_cliente.php?'+campos, {
					method:'get',
					requestHeaders: {Accept: 'application/json'},
					onSuccess: function(transport){
								var json = transport.responseText.evalJSON(true);
								if(json!="NO"){
									agregar_contratante(json,1);
								}else{
									alert("El documento ya existe");
								}
					}
				});
				
			}
			
			if(par==2){
				
				var campos =$("frm_juridica").serialize();
				
				new Ajax.Request('../consultas/registrar_cliente.php?'+campos, {
					method:'get',
					requestHeaders: {Accept: 'application/json'},
					onSuccess: function(transport){
								var json = transport.responseText.evalJSON(true);
								if(json!="NO"){
									agregar_contratante(json,2);
								}else{
									alert("El documento ya existe");
								}
								
					}
				});
				
			}
	}
	
}



function validar_cliente(par){

	var flag = 1
	
	if(par==1){
		if($("n_tipdoc").value==0 || myTrim($("n_numdoc").value)=="" || myTrim($("n_prinom").value)=="" || myTrim($("n_apepat").value)==""){
		   flag = 2;		
		   alert("Ingrese campos obligatorios");
		}
	}
	
	if(par==2){
		if($("n_tipdoc").value==0 || myTrim($("n_numdoc").value)=="" || myTrim($("n_razon").value)==""){
			flag = 2;		
			alert("Ingrese campos obligatorios");   
		}
	}

	return flag;

}


/*Declaración de fechas*/

function fecha_nac_n(){
	
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
			   
	 j(function() {
		j( "#n_fecnac" ).datepicker();
	 });
	   
}

function fecha_cons_n(){
		
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
			   
	j(function() {
		j( "#n_feccons" ).datepicker();
	});
	   
}

/*-------------------*/


function editar_contratante(id){
	$("div_mcontratante").style.display= "block";
	new Ajax.Updater("div_mcontratante","widgets/editar_contratante.php?id="+id);
}

function cerrar_mcontratante(){
	$("div_mcontratante").style.display= "none";
}

function modificar_contratante(id){
	$("div_modicontratante").style.display= "block";
	new Ajax.Updater("div_modicontratante","widgets/modificar_contratante.php?id="+id);	
}

function cerrar_modicontratante(){
	$("div_modicontratante").style.display= "none";
}

function eliminar_contratante(id){
	
	var codkardex = $("codkardex").value;
	
	var r = confirm("¿Seguro Desea Eliminar el contratante?");

	if (r == true) {
		
		new Ajax.Request("../consultas/eliminar_contratante.php?id="+id,
		{  
			onComplete: 
			function() { 
				editar_contratante(codkardex);
				menus_editar(1, codkardex);
			}
		},{method:'GET'});
		
	} 
	
}

function modificar_contratante2(id, tipper){
	
	if(tipper=="N"){
		$("div_modicontratante2").style.display= "block";
		new Ajax.Updater("div_modicontratante2","widgets/modificar_contratante2.php?id="+id);	
	}
	
	if(tipper=="J"){
		$("div_modicontratante2").style.display= "block";
		new Ajax.Updater("div_modicontratante2","widgets/modificar_contratante3.php?id="+id);	
	}
	
}

function cerrar_modicontratante2(){
	$("div_modicontratante2").style.display= "none";
}

function nuevo_conyugue(){
	$("div_nconyugue").style.display= "block";
	new Ajax.Updater("div_nconyugue","widgets/nuevo_conyugue.php");	
}

function cerrar_conyugue(){
	$("div_nconyugue").style.display= "none";
}


function buscar_ubigeos(){
	$("div_ubigeos").style.display= "block";
	new Ajax.Updater("div_ubigeos","widgets/ubigeos.php");	
}

function cerrar_ubigeos(){
	$("div_ubigeos").style.display= "none";
}

function listar_ubigeos(nom){
	new Ajax.Updater("list_ubigeos","widgets/lista_ubigeos.php?nom="+nom);	
}

function escoger_ubigeo(id, nom, par){
	
	if($("n_idubigeo")!=null){
	   $("n_idubigeo").value = id;
	   $("n_ubigeo").value = nom;
	}
	
	if($("m_idubigeo")!=null){
	   $("m_idubigeo").value = id;
	   $("m_ubigeo").value = nom;
	}
	
	cerrar_ubigeos();
	
}

function buscar_ocupaciones(){
	$("div_ocupaciones").style.display= "block";
	new Ajax.Updater("div_ocupaciones","widgets/ocupaciones.php");	
}

function cerrar_ocupaciones(){
	$("div_ocupaciones").style.display= "none";
}

function listar_ocupaciones(nom){
	new Ajax.Updater("list_ocupaciones","widgets/lista_ocupaciones.php?nom="+nom);	
}

function escoger_ocupacion(id, nom){
	
	if($("n_idocupacion")!=null){
		$("n_idocupacion").value = id;
		$("n_ocupacion").value = nom;
	}
	
	if($("m_idocupacion")!=null){
		$("m_idocupacion").value = id;
		$("m_ocupacion").value = nom;
	}
	
	cerrar_ocupaciones();
	
}

function buscar_cargos(){
	$("div_cargos").style.display= "block";
	new Ajax.Updater("div_cargos","widgets/cargos.php");	
}

function cerrar_cargos(){
	$("div_cargos").style.display= "none";
}

function listar_cargos(nom){
	new Ajax.Updater("list_cargos","widgets/lista_cargos.php?nom="+nom);	
}

function escoger_cargo(id, nom){
	
	if($("n_idcargo")!=null){
		$("n_idcargo").value = id;
		$("n_cargo").value = nom;
	}
	
	if($("m_idcargo")!=null){
		$("m_idcargo").value = id;
		$("m_cargo").value = nom;
	}
	
	cerrar_cargos();
	
}

function nuevo_movimiento(){
	
	if($("div_mmovimiento").style.display=="block"){$("div_mmovimiento").style.display="none";}
	
	$("div_movimiento").style.display= "block";
	
	new Draggable('div_movimiento');
	
	new Ajax.Updater("div_movimiento","widgets/nuevo_movimiento.php",
	{  
		onComplete: 
		function(){ 
			var j = jQuery.noConflict();
			/*
			j(function() {
				
				j( "#mov_fecha" ).datepicker();
			});*/
		}
	},{method:'GET'});
	
}

function registrar_movimiento(){
	
	var flag = validar_movimiento();
	
	var codkardex = $("codkardex").value; 
	
	if(flag==1){
	
		var campos =$("frm_movimiento").serialize(); 
		
		new Ajax.Request("../consultas/registrar_movimiento.php?"+campos+"&codkardex="+codkardex,
			{  
			  onComplete: 
			  function() { 
				 menus_editar(4, codkardex)
				 alert("Los datos se han registrado exitosamente");
				 //cerrar_ncliente();
			  }
		},{method:'GET'});
	
	}
	
}

function cerrar_movimiento(){
	$("div_movimiento").style.display= "none";
}

function validar_movimiento(){

	var flag = 1
	
	if($("frm_movimiento")!= null){
		if($("mov_fecha").value=="" || $("mov_ofreg").value==0 || $("mov_tramite").value==0 || $("mov_estado").value==0){
		   alert("Ingrese fecha, oficina, tramite y estado");
		   flag = 2;
		}
	}
	
	if($("frm_mmovimiento")!= null){
		if($("mov_mfecha").value=="" || $("mov_mofreg").value==0 || $("mov_mtramite").value==0 || $("mov_mestado").value==0){
		   alert("Ingrese fecha, oficina, tramite y estado");
		   flag = 2;
		}
	}
		
	return flag;
	
}

function modificar_movimiento(cod){
	
	if($("div_movimiento").style.display=="block"){$("div_movimiento").style.display="none";}
	
	$("div_mmovimiento").style.display= "block";
	
	new Draggable('div_mmovimiento');
	
	new Ajax.Updater("div_mmovimiento","widgets/m_movimiento.php?cod="+cod,
	{  
		onComplete: 
		function() { 
			var j = jQuery.noConflict();
			/*
			j(function() {
				
				j( "#mov_fecha" ).datepicker();
			});*/
		}
	},{method:'GET'});
	
}

function mod_movimiento(id_mov){
	
	var flag = validar_movimiento();
	
	var codkardex = $("codkardex").value; 
	
	if(flag==1){
	
		var campos =$("frm_mmovimiento").serialize(); 
		
		new Ajax.Request("../consultas/modificar_movimiento.php?"+campos+"&id_mov="+id_mov,
			{  
			onComplete: 
			function() { 
				menus_editar(4, codkardex)
				alert("Los datos se han modificado exitosamente");
				//cerrar_ncliente();
			}
		},{method:'GET'});
	
	}
	
}




function eliminar_movimiento(id_mov){
	
	var codkardex = $("codkardex").value; 
	
	var r = confirm("¿Seguro Desea Eliminar el movimiento?");

	if (r == true) {
		
		cerrar_movimiento();
		
		if($("div_mmovimiento").style.display =="block"){
			cerrar_movimiento2();
		}
	
		new Ajax.Request("../consultas/eliminar_movimiento.php?id_mov="+id_mov,
			{  
			onComplete: 
			function() { 
				menus_editar(4, codkardex)
				alert("El registro ha sido eliminado");
				//cerrar_ncliente();
			}
		},{method:'GET'});
		
	} 

}


function cerrar_movimiento2(){
	$("div_mmovimiento").style.display= "none";
}



function cambiar_celda(id){
	
	$(id).style.color	= "#264965";
	$(id).style.backgroundColor = "#FF9900";

}

function restaurar_celda(id){
	
	$(id).style.color	= "#FF9900";
	$(id).style.backgroundColor = "#264965";
	
}

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 
         return true;
}

function numerosdecimales(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 
		 
		 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
			return false;
 
		 return true;
}

function currency(id) {
	
		var valor = $(id).value;
		
		var num = parseFloat(valor).toFixed(2);
		
		$(id).value = num;
		
}

function myTrim(x){
		return x.replace(/^\s+|\s+$/gm,'');
}





