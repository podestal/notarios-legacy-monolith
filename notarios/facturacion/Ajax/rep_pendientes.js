
    function listar_rep_pendientes(pag){
		
		var flag = validar_fechas();
		
		if(flag==1){
		
			var fechade =$("fechade").value;
			var fechaa =$("fechaa").value;
				
			new Ajax.Updater("list_pendientes", "../consultas/list_rep_pendientes.php?fechade="+fechade+"&fechaa="+fechaa+"&pag="+pag);	
		
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
	
	function pdf_pendientes(){

		var flag = validar_fechas();
	
		if(flag==1){
			var campos =$("frm_fechas").serialize();
			window.open('../pdf/rep_pendientes.php?'+campos);
		}
	
	}

	function retorna(){
		location.reload();	
		$("fechade").value="";
		$("fechaa").value="";
	}