
	
	
	var pagina=1;

	function habilitar_edicion(){
	
	  var divResultado = document.getElementById('valorusuario');
	  var usuario = document.getElementById('usuario').value;
	  var clave= document.getElementById('pass').value;
	  
	  	new Ajax.Updater("valorusuario", "../view/validar_cambio.php?usuario="+usuario+"&clave="+clave,
		{  
		  onComplete: 
		  function() { 
		  	verificar_habilitar();
		  }
		
		},{method:'GET'}
		);
		
	}
	
	function verificar_habilitar(){
		
		var valorusu = $('valorusu').value;
		
		if(valorusu==1){
			
			var at = $("n_tc").value;		
			var as = $("n_s").value;		
			var ad = $("n_num").value;		
			var id = $("n_id").value;		

			extornar_abono(at, as, ad, id);
			
			alert("Abono extornado");
			
			cerrar_login();
			
		}
	}

	function listar_rep_cancelados(pag){

		pagina = pag;
		
		var flag = validar_fechas();
		
		if(flag==1){
		
			var fechade =$("fechade").value;
			var fechaa =$("fechaa").value;
			
			new Ajax.Updater("list_cancelados", "../consultas/list_rep_cancelados.php?fechade="+fechade+"&fechaa="+fechaa+"&pag="+pag);	
		
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
	
	function pdf_cancelados(){

		var flag = validar_fechas();
	
		if(flag==1){
			var campos =$("frm_fechas").serialize();
			window.open('../pdf/rep_cancelados.php?'+campos);
		}
	
	}
	
	function extornar_abono(at, as, ad, id){
		new Ajax.Request("../consultas/extornar.php?a_t="+at+"&a_s="+as+"&a_d="+ad+"&id="+id,
		{  
		  onComplete: 
		  function() { 
		  	listar_rep_cancelados(pagina);
		  }
		},{method:'GET'});
	}


	function retorna(){
		location.reload();	
		$("fechade").value="";
		$("fechaa").value="";
		
	}

	function login(at,as,ad,id){
		
		new Ajax.Updater("div_login", "../widgets/login.php",{ 
		onComplete: 
		  function() { 
		  	$("n_tc").value = at;		
			$("n_s").value = as;		
			$("n_num").value = ad;		
			$("n_id").value = id;		
		  }
		
		},{method:'GET'}
		);	
		
		$("div_login").style.display = "block";
		
	}
	
	function cerrar_login(){
		
		$("div_login").style.display ="none";
		$("usuario").value ="";
		$("pass").value ="";
		
		$("n_tc").value = "";		
		$("n_s").value = "";		
		$("n_num").value = "";		
		$("n_id").value = "";		
		
		
	}