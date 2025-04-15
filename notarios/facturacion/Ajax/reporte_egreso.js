// JavaScript Document

	
	function listar_reporte_e(pag){
		
		var flag = validar_fechas();
		
		if(flag==1){
		
			var fechade =$("fechade").value;
			var fechaa =$("fechaa").value;
			
			var filtro =$("filtro_e").value;
			
			new Ajax.Updater("list_reporte_e", "../consultas/list_comprobantes_egreso.php?fechade="+fechade+"&fechaa="+fechaa+"&pag="+pag+"&filtro="+filtro);	
		
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
	
	function pdf_reporte(){

		var flag = validar_fechas();
	
		if(flag==1){
			var campos =$("frm_fechas").serialize();
			window.open('../pdf/reporte_egreso_pdf.php?'+campos);
		}
	
	}


	function pdf_reportec(){

			var campos =$("frm_fechas").serialize();
			window.open('../pdf/reporte_rc.php?'+campos);
		
	
	}

	function retorna(){
		location.reload();	
		$("fechade").value="";
		$("fechaa").value="";
		
	}
	
	