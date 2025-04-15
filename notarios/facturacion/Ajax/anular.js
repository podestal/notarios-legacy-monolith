// JavaScript Document
	
	var pagina = 1;

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
			
			eliminar_venta(at, as, ad, id);
			
			alert("Registro Eliminado");
			
			cerrar_login();
			
		}
	}


	function listar_anular(pag){
		
		pagina = pag;
		
		var campos =$("frm_anulados").serialize();
		
		new Ajax.Updater("div_anular", "../consultas/list_anulacion.php?"+campos+"&pag="+pagina);	

	}
	
	function isNumberKey(evt){
		 var charCode = (evt.which) ? evt.which : event.keyCode
		 if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
 
		 return true;
	}
	
	function desactivar_venta(at, as, ad, id){
		
		var r = confirm("¿Seguro Desea Anular el Comprobante?");

		if (r == true) {
			
			new Ajax.Request("../consultas/desactivar.php?a_t="+at+"&a_s="+as+"&a_d="+ad+"&id="+id,
		    {  
		    onComplete: 
		    function() { 
		  	 	listar_anular(pagina);
		    }
		    },{method:'GET'});
			
		} 
		
	}
	
	function eliminar_venta(at, as, ad, id){
		
		new Ajax.Request("../consultas/eliminar.php?a_t="+at+"&a_s="+as+"&a_d="+ad+"&id="+id,
		{  
		  onComplete: 
		  function() { 
		  	listar_anular(pagina);
		  }
		},{method:'GET'});
		
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
	
	function editar_comprobrante(id){
		location.href="editar_comprobante.php?id="+id;
	}
	
	function mod_comprobante(id){
		
		var kardex = $("kardex").value;
		
		new Ajax.Request('../consultas/modificar_kardex.php?id='+id+'&kardex='+kardex, {
			method:'get',
			requestHeaders: {Accept: 'application/json'},
			onSuccess: function(transport){
						var json = transport.responseText.evalJSON(true);
						/*if(json!="NO"){
							agregar_contratante(json,1);
						}else{
							alert("El documento ya existe");
						}*/
			}
		});
		
	}
	
	
	
	
function print ()  { 
    var iframe = document . getElementById ( 'textfile' ); 
    iframe . contentWindow . print (); 
} 
	
	
	function mostrar_impresion_editar(idregventas){
		
			var divResultado = document.getElementById('imprimir_todo');


	ajax=objetoAjax();
	ajax.open("POST", "../pdf/imprimir1.php?id="+idregventas,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("idregventas="+idregventas)
		
	}
	
	
	
	function imprimir_comprobante(id){
		
		mostrar_impresion_editar(id);	
		
		var r = confirm("¿Desea Reimprimir el Documento?");

		if (r == true) {
			
		  	 	print ();	  
			
		} 
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	