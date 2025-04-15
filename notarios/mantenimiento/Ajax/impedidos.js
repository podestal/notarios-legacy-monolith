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

function listar_impedidos(pag){
	
	pagina=pag;

	var campos =$("frm_cliente").serialize();
	
	new Ajax.Updater("lst_cliente", "../consultas/list_impedidos.php?"+campos+"&pag="+pag,
	{  
	  onComplete: 
	  
	  function() { 
		if($("fila"+color)!=null){cambiar_colorfila(color);}
	  }
	  
	},{method:'GET'});	
}

function nuevo_impedido(){
	
	if($("div_mimpedido").style.display =="block"){
		cerrar_mcliente();
	}
	
	$("div_nimpedido").style.display ="block";
	new Ajax.Updater("div_nimpedido", "../consultas/n_impedido.php",
	{  
	  onComplete: 
	  function(){
	  	ubigeos();
	  }
	},{method:'GET'}
	);	
	
	new Draggable('div_nimpedido');
	
}

function cerrar_nimpedido(){

	$("div_nimpedido").style.display ="none";

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

/*
function registrar_impedido(){
	
	var flag = validar_impedido();

	if(flag==1){
	
		var campos =$("frm_ncli").serialize(); 
		
		new Ajax.Request("../consultas/registrar_cliente.php?"+campos,
			{  
			  onComplete: 
			  function() { 
				 listar_impedidos(1);
				 alert("Los datos se han registrado exitosamente");
				 cerrar_nimpedido();
			  }
		},{method:'GET'});
	
	}
	
}
*/


function registrar_impedido(){
	
	   regimpedido_cabe();
	   alert("Registro Grabado Satisfactoriamente..!!!");
	
	 }

function regimpedido_cabe()
{
	document.getElementById('list_impe').style.display="";
	n_cod=document.getElementById('n_cod').value;
	n_fecha=document.getElementById('n_fecha').value;
	n_impentidad=document.getElementById('n_impentidad').value;
	n_impmotivo=document.getElementById('n_impmotivo').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","../consultas/registrar_impedido_cabe.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			alert("Registro Grabado Satisfactoriamente..!!!");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("n_cod="+n_cod+"&n_fecha="+n_fecha+"&n_impentidad="+n_impentidad+"&n_impmotivo="+n_impmotivo);


}

function regimpedido()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tacha');
	//tomamos el valor de la lista desplegable
	n_cod=document.getElementById('n_cod').value;
	idcliente=document.getElementById('idcliente').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","../consultas/registrar_impedido.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.getElementById('n_doc').value="";
			document.getElementById('tip_doc').value="0";
			document.getElementById('tip_per').value="0";
			document.getElementById('cliente').value="";
			document.getElementById('idcliente').value="";
			ocultar_desc("respuesta");
			
			mostrar_tachados(n_cod);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("n_cod="+n_cod+"&idcliente="+idcliente);


}

function regimpedido_m()
{
	//donde se mostrará el resultado
	divResultado = document.getElementById('tacha_m');
	//tomamos el valor de la lista desplegable
	m_cod=document.getElementById('m_cod').value;
	
	idcliente=document.getElementById('idcliente_m').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","../consultas/registrar_impedido.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			document.getElementById('n_doc1').value="";
			document.getElementById('tip_doc2').value="";
			document.getElementById('tip_per2').value="";
			document.getElementById('cliente1').value="";
			document.getElementById('idcliente_m').value="";
			ocultar_desc("respuesta2");
			mostrar_tachados_m(m_cod);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("n_cod="+m_cod+"&idcliente="+idcliente);


}

function eliminar_tachado(id,name){
	//var clie=document.getElementById("idcli").id;

	var r = confirm("¿Seguro Desea Eliminar al cliente?");

	if (r == true) {
		
		
		new Ajax.Request("../consultas/eliminar_impedido_control.php?id="+name+"&clie="+id,
			{  
			  onComplete: 
			  function() { 
	
				mostrar_tachados(name);
			  }
		},{method:'GET'});
	}


}

function eliminar_tachado_m(id,name){
	//var clie=document.getElementById("idcli").id;

	var r = confirm("¿Seguro Desea Eliminar al cliente?");

	if (r == true) {
		
		
		new Ajax.Request("../consultas/eliminar_impedido_control.php?id="+name+"&clie="+id,
			{  
			  onComplete: 
			  function() { 
				mostrar_tachados_m(name);
		
			  }
		},{method:'GET'});
	}


}

function mostrar_tachados_m(n_cod){

	divResultado = document.getElementById('tacha_m');

	//tomamos el valor de la lista desplegable
	//n_cod=document.getElementById('m_cod').value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","../consultas/mostrar_lis_tacha_m.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("n_cod="+n_cod);
	}
	
	function mostrar_tachados(n_cod){
	divResultado = document.getElementById('tacha');

	//tomamos el valor de la lista desplegable

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","../consultas/mostrar_lis_tacha.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("n_cod="+n_cod);
	}
/*function validar_impedido(){

	var flag = 1
	
	if($("div_nimpedido").style.display=="block"){
		
		if($("tip_per").value==0 || $("tip_doc").value==0 || myTrim($("n_doc").value)==""){
		   flag = 2;		
		   alert("Ingrese campos obligatorios");
		}
		
		if(flag==1 && $("tip_per").value=="N"){
			if(myTrim($("n_prinom").value)=="" || myTrim($("n_apepat").value)==""){
				flag = 2;		
				alert("Ingrese campos obligatorios");   
			}
		}
		
		if(flag==1 && $("tip_per").value=="J"){
			if(myTrim($("n_razon").value)==""){
				flag = 2;		
				alert("Ingrese campos obligatorios");   
			}
		}
	}
	
	
	if($("div_mimpedido").style.display=="block"){
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
	}

	return flag;

}
*/

function modificar_impedido(id){
	
	cerrar_nimpedido();
	$("div_mimpedido").style.display ="block";
	new Ajax.Updater("div_mimpedido", "../consultas/m_impedido.php?id_cliente="+id,
	{  
	  onComplete: 
	  function(){
		  m_ubigeos();
		  m_openrow();
		  var tipdoc = $("m_tipdoc").value;
		  cambiar_doic(2, tipdoc);
		  
		  if($("m_conyugue").value!=""){
			 $("btm_conyugue").style.display="block";
			 $("btm_conyugue2").style.display="block";
		  }else{
			  $("btm_conyugue").style.display="block";
		  }
		  
		  
	   }
	},{method:'GET'}
	);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_mimpedido');
	
}

function modificar_impedido_control(id){
	
	cerrar_nimpedido();
	$("div_mimpedido_control").style.display ="block";
	new Ajax.Updater("div_mimpedido_control", "../consultas/m_impedido_control.php?id_cliente="+id,
	{  
	  onComplete: 
	  function(){
		  m_ubigeos();
		  m_openrow();
		  mostrar_tachados();
		  var tipdoc = $("m_tipdoc").value;
		  cambiar_doic(2, tipdoc);
		  
		  if($("m_conyugue").value!=""){
			 $("btm_conyugue").style.display="block";
			 $("btm_conyugue2").style.display="block";
		  }else{
			  $("btm_conyugue").style.display="block";
		  }
		  
		  
	   }
	},{method:'GET'}
	);		
	
	cambiar_colorfila(id);
	
	new Draggable('div_mimpedido_control');
	
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

	if($("div_nimpedido").style.display =="block"){
		var prinom = myTrim($("n_prinom").value); 
		var apepat = myTrim($("n_apepat").value); 
	}
	
	if($("div_mimpedido").style.display =="block"){
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
					  
					  	if($("div_nimpedido").style.display=="block"){					
							 $("btn_conyugue").style.display = "none";
							 $("btn_conyugue2").style.display = "block";
							 
							 $("txt_conyugue").value =  $("c_apepat").value+", "+$("c_prinom").value;
							 $("n_conyugue").value = $("c_cod").value; 
							 
							 if($("txt_conyugue").value!="" && $("n_conyugue").value!=""){cerrar_nconyugue();}
						}
						
						if($("div_mimpedido").style.display=="block"){	
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
	
	
	if($("div_mimpedido").style.display=="block"){
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
	}

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

function cerrar_mimpedido(){
	
	$("div_mimpedido").style.display ="none";
	limpiar_color();
	
}

function cerrar_mimpedido_control(){
	
	$("div_mimpedido_control").style.display ="none";
	buscar_imp_control();
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

function mod_impedido(id){

	
		var campos =$("frm_mcli").serialize();
		
		new Ajax.Request("../consultas/modificar_cliente.php?"+campos,
			{  
			  onComplete: 
			  function() { 
			  alert("el cliente ha sido modificado con exito");
			    document.getElementById("div_mimpedido").style.display="none";
				listar_impedidos(pagina);
			  }
		},{method:'GET'});
	
	
}

function mod_impedido_cab(id){

	
		var campos =$("frm_mcli").serialize();
		
		new Ajax.Request("../consultas/modificar_imp_cab.php?"+campos,
			{  
			  onComplete: 
			  function() { 
			  alert("el registro se ha sido modificado con exito");
			 				
			  }
		},{method:'GET'});
	
	
}

function eliminar_impedido(id){
	
	var r = confirm("¿Seguro Desea Eliminar el registro?");

	if (r == true) {
		
		cerrar_nimpedido();
		
		if($("div_mimpedido").style.display =="block"){
			cerrar_mcliente();
		}
	
		new Ajax.Request("../consultas/eliminar_impedido.php?id="+id,
			{  
			  onComplete: 
			  function() { 
				listar_impedidos(pagina);
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


function mostar_enti(valor){
	if(valor=="OTROS"){
		document.getElementById('n_impentidad').readOnly=false;
		document.getElementById('n_impentidad').value=valor;
		
		}else{
			
			document.getElementById('n_impentidad').readOnly=true;
		document.getElementById('n_impentidad').value=valor;
			}   
	
	}