

var pagina;

function buscar_protesto(page){
     
	pagina = page; 
	    
	if($("num_acta").value!="" || $("nro_protesto").value!=""){
		limpiar_protesto();
	}
	
	var flag = validar_fechas();	

	if(flag==1){	
		var campos =$("frm_protesto").serialize();
		new Ajax.Updater("lista_protesto","busqueda_protesto.php?" + campos+"&pag=" + pagina);
	}
	   
}

function limpiar_protesto(){
   
   $("participante").value = "";
   $("fechade").value = "";
   $("fechaa").value = "";
   $("fec_ing").checked = false;
   $("fec_cons").checked = false;
   $("fec_not").checked = false;

}

function ver_poder(id_poder,anio){
		document.location.href="EditProtesto.php?id_poder="+id_poder+"&anio="+anio;
}

function limpiar_checks(id){
	
	$("fec_ing").checked = false;
	$("fec_cons").checked = false;
	$("fec_not").checked = false;
	
	
	$(id).checked = true;
	
}

function limpiar_check(id){
	
	$("tre").checked = false;
	$("cuatro").checked = false;
	
	
	
	$(id).checked = true;
	
}


function validar_fechas(){
	
	var flag = 1;
	
	if($("fechade").value!="" || $("fechaa").value !=""){
		if($("fechade").value=="" || $("fechaa").value ==""){
			alert("Debe ingresar ambas fechas para realizar la busqueda");
			flag = 2;
		}
		
		if($("fechade").value!="" && $("fechaa").value !=""){
			date1 = formato_date($("fechade").value);
			date2 = formato_date($("fechaa").value);
			if(date1 > date2){
				alert("El primer campo de fechas debe ser menor o igual al primero");
				flag = 2;
			}else{
				if($("fec_ing").checked == false && $("fec_cons").checked == false && $("fec_not").checked == false){
					alert("Debe seleccionar alguna de las opciones");
				}
			}
		}
	}
	
	return flag;
	
}


function numerar(par){
	
	var flag = validar_fechas();
	
	var campos =$("frm_protesto").serialize();
	
	if(flag==1){
		new Ajax.Request('consultas/numerar_protesto.php?'+campos+"&par="+par, {
			method:'get',
			requestHeaders: {Accept: 'application/json'},
			onSuccess: function(transport){
						//var json = transport.responseText.evalJSON(true);
					   buscar_protesto(pagina);
			}
		});
	}

}


function formato_date(date){
    
		var fecha = date.split('/'); 
		
		dia = fecha[0];
		mes = fecha[1];
		anio = fecha[2];
		
		var newdate;
		
		newdate = anio.concat(mes.concat(dia));
		
		return newdate;
	
}

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
 
         return true;
}

