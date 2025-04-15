
function buscar_garantias(page){
	
	var flag = validar_fechas();
	
	if(flag==1){
		var campos =$("frmescri").serialize();
		new Ajax.Updater("lst_garantias", "consultas/alfabeticos/garantias.php?" + campos+"&pag=" + page);	
	}
	
}

function validar_fechas(){
	
	var flag = 1;
	
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
		}
	}
	
	return flag;
	
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

function pdf_garantias(){
	
	var flag = validar_fechas();
	
	if(flag==1){
		var campos =$("frmescri").serialize();
		window.open('pdf_crono/alfabetico/pdf_crono_garantias.php?'+campos);
	}

}
