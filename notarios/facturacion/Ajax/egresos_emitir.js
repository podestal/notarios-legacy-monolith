	
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
	
	function objetoAjax(){
		var xmlhttp=false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
	
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
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
	
	function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
	
	function myTrim(x){
		return x.replace(/^\s+|\s+$/gm,'');
	}
	
	function cargar_contenido(){
		
		new Ajax.Updater("div_numdoc", "../widgets/num_doc.php");	
		new Ajax.Updater("div_serie", "../widgets/serie.php");
		new Ajax.Updater("slc_tipdoc", "../widgets/tipodocumento_egreso.php");	
		new Ajax.Updater("div_datoscliente", "../widgets/datosproveedor.php");	
	
		new Ajax.Updater("div_checkpago", "../widgets/numero_comprobante.php");	
	/*	
		new Ajax.Updater("div_checkpago", "../widgets/egre_comprobante.php",
		{  
		  onComplete: 
		  function() { 
				new Ajax.Updater("slc_tippag", "../widgets/option_comprobante.php");	
									
		  }
		  },{method:'GET'}
		);	*/
	
		new Ajax.Updater("div_detalle", "../widgets/descripcion_egreso.php");
			
//		new Ajax.Updater("div_servicio", "../widgets/descripcion_egreso.php");	
		
	//	mostrar_servicio();
		
	}
	
		function cambiar_comprobante(){
		
		var tip_docu = $("tip_comp").value;
		
		if(tip_docu=="01"){
			$("select_doic").value=1;
			cambiar_doic('doic','1');
		}
		
		if(tip_docu=="02"){
			$("select_doic").value=8;
			cambiar_doic('doic','8');
		}
		
		new Ajax.Updater("div_serie", "../widgets/serie.php?tip_docu="+tip_docu);
		new Ajax.Updater("div_numdoc", "../widgets/num_doc.php?tip_docu="+tip_docu);	
		new Ajax.Updater("div_totales", "../widgets/totales.php?tip_docu="+tip_docu);	
		
		if($("slc_serv") !=  null){
			new Ajax.Updater("slc_serv", "../widgets/servicios.php?tip_docu="+tip_docu);
			
			
			$("precio").value="0.00";
			$("cantidad").value="0";
			$("tip_servicio").value=0;
		}
		
		//mostrar_servicio();
		
		//eliminar_detalles();
		
	}
	
		function cambiar_comprobante_edit(){
		
		var tip_docu = $("tip_comp").value;
		
		if(tip_docu=="01"){
			$("dni").value=1;
			cambiar_doic('dnicliente','1');
		}
		
		if(tip_docu=="02"){
			$("dni").value=8;
			cambiar_doic('dnicliente','8');
		}

		
	}
	
	function ver_login(){
		document.getElementById('div_login').style.display="block";
	}
	
	function habilitar_edicion(){
	
	  var divResultado = document.getElementById('valorusuario');
	  var usuario = document.getElementById('usuario').value;
	  var clave= document.getElementById('pass').value;
	  
		ajax=objetoAjax();
	
		ajax.open("POST","validar_cambio.php",true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4 && ajax.status==200) {
				divResultado.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&usuario="+usuario+"&clave="+clave);
		
		verificar_habilitar();
	
	}
	
	function verificar_habilitar(){
		
		alert("Edicion Habilitada");
		
		var valorusu = document.getElementById('valorusu').value;
		
		if(valorusu==1){
			alert("Edicion jjj Habilitada");
		
			document.getElementById("serie1").style.display = "block";
			document.getElementById("numdoc1").style.display = "block";
			document.getElementById("fecha_emision1").style.display = "block";
			document.getElementById("serie2").style.display = "none";	
			document.getElementById("numdoc2").style.display = "none";	
			document.getElementById("fecha_emision2").style.display = "none";	
			cerrar_login();
		}
	}
	
	function cerrar_login(){
		
		document.getElementById("div_login").style.display ="none";
		document.getElementById("usuario").value ="";
		document.getElementById("pass").value ="";
		
	}
	
	function cambiar_doic(id, valor){
		
		$(id).value ="";
	
		switch (valor){
			
			case '1':
			document.getElementById(id).maxLength= 8;
			break;
						
			case '2':
			document.getElementById(id).maxLength= 16;
			break;		
			
			case '3':
			document.getElementById(id).maxLength= 16;
			break;
			
			case '4':
			document.getElementById(id).maxLength= 16;
			break;
			
			case '5':
			document.getElementById(id).maxLength= 16;
			break;
			
			case '6':
			document.getElementById(id).maxLength= 20;
			break;
			
			case '7':
			document.getElementById(id).maxLength= 20;
			break;
			
			case '8':
			document.getElementById(id).maxLength= 11;
			break;
			
			case '9':
			document.getElementById(id).maxLength= 20;
			break;
			
			case '10':
			document.getElementById(id).maxLength= 20;
			break;
			
			case '11':
			document.getElementById(id).maxLength= 20;
			break;
		
		}	
	}
		
	function actualizar_datoscliente(key){
		
	var doic = $("doic").value;	
	var sdoic = $("select_doic").value;
	

		var unicode
		if (key.charCode)
		{unicode=key.charCode;}
		else
		{unicode=key.keyCode;}
		//alert(unicode); // Para saber que codigo de tecla presiono , descomentar
		
		if (unicode == 13){
			//alert('Presiono enter');
			
			if(doic==""){
				nuevo_cliente();
				return false;
			}
			
			new Ajax.Updater("div_datoscliente", "../widgets/datosproveedor.php?doic="+doic+"&sdoic="+sdoic,
			  {  
			  onComplete: 
			  
			  function() { 
			  		if($("flag_cliente").value==0){
						nuevo_cliente();

					}
			  }
			  },{method:'GET'}
			);	
			
		}
		
		if (unicode == 27){
			//alert('Presiono escape');
		}
	}
	
	function enviar_clidatos(){
		
		var doic;
		
		if($("cli_doic")!=null){
		   doic = $("cli_doic").value;	
		}
		
		var sdoic = $("select_doic").value;
		
		if(myTrim($("n_dni").value)!=null || myTrim($("n_ruc").value!=null) ){

			if(myTrim($("n_dni").value)!=""){
			   doic = $("n_dni").value;
			   sdoic = 2;
			}

			
			if(myTrim($("n_ruc").value)!=""){
				doic = $("n_ruc").value;
				sdoic = 1;
			}
			
		}
		
		new Ajax.Updater("div_datoscliente", "../widgets/datosproveedor.php?doic="+doic+"&sdoic="+sdoic,
			   { 
			   onComplete: 
			   function() { 
			     cerrar_ncliente();		   
			   }
			   },{method:'GET'}
		);
		
		cerrar_cliente();
		
	}
	
	function nuevo_cliente(){
		
		var sdoic = $("select_doic").value;
		var doic = $("doic").value;
		var valor1="1";
		var valor2="2";
		
		$("div_ncliente").style.display ="block";
		
		new Draggable('div_ncliente');
		
		if(sdoic!=8){
		   new Ajax.Updater("div_ncliente", "../consultas/nuevoproveedor.php?sdoic="+valor1+"&doic="+doic,
		       { 
			   onComplete: 
			   function() { 	   
					   mostrar_ingresocliente(1);
			   }
			   },{method:'GET'}
		   );	
		}else{
			new Ajax.Updater("div_ncliente", "../consultas/nuevoproveedor.php?sdoic="+valor2+"&doic="+doic,
		       { 
			   onComplete: 
			   function() { 	   
					   mostrar_ingresocliente(2);
			   }
			   },{method:'GET'}
		   );	
		}
		
	}
	
	function cerrar_ncliente(){
		$("div_ncliente").style.display ="none";
		new Ajax.Updater("div_ncliente", "../consultas/nuevoproveedor.php");	
	}
	
	function grabar_cliente(){
		
		var tip_per = $("n_tippersona").value;
		
		if(tip_per==1){
			
			if(myTrim($("n_prinom").value)=="" || myTrim($("n_apepat").value)=="" || myTrim($("n_doicn").value)=="" || myTrim($("n_idubigeon").value)==""){
				alert("Introduzca los campos oblicatorios");
				return false;

			}else{
				if(myTrim($("n_doicn").value).length<8){
				   alert("El formato de DNI es incorrecto");	
				   return false;
				}
			}

			
			
			var campos =$("frm_natural").serialize();
			
			
		}
		
		if(tip_per==2){
			
			if(myTrim($("n_razon").value)=="" || myTrim($("n_doicj").value)=="" || myTrim($("n_idubigeoj").value)==""){
				alert("Introduzca los campos oblicatorios");
				return false;
			}else{
				if(myTrim($("n_doicj").value).length<11){
				   alert("El formato de RUC es incorrecto");	
				   return false;
				}
			}

			
			var campos =$("frm_juridica").serialize();
			
		}
		
		new Ajax.Request("../consultas/registrar_proveedor.php?"+campos+"&tip_per="+tip_per,
		{  
		  onComplete: 
		  function() { 
		  	enviar_clidatos();
			
		  }
		},{method:'GET'});
		
		cerrar_ncliente();
		
		actualizar_datoscliente(13);
	}
	
	function mostrar_ingresocliente(valor){
        var sdoic = $("select_doic").value;
		var doic = $("doic").value;
		
		if(valor=="0"){
			$("fila_natural").style.display = "none";
			$("fila_juridica").style.display = "none";
			$("btn_ncliente").style.display = "none";
		}
		
		if(valor=="1"){
			if($("select_doic").value==2){
			   var doic = $("doic").value;	
			}
			
			if(typeof doic === 'undefined'){
				   doic = "";
			};
			
			new Ajax.Updater("fila_natural", "../consultas/filanat.php?doic="+doic+"&sdoic="+sdoic,
			{  
			  onComplete: 
			  
			  function() { 
			   fecha_ubigeo_n();
			  }
			  
			},{method:'GET'});
			
			$("fila_natural").style.display = "block";
			new Ajax.Updater("fila_juridica", "../consultas/filajud.php");	
			$("fila_juridica").style.display = "none";
			$("btn_ncliente").style.display = "block";
		}
		
		if(valor=="2"){
			new Ajax.Updater("fila_natural", "../consultas/filanat.php");
			$("fila_natural").style.display = "none";
			
			if($("select_doic").value==1){
			   var doic = $("doic").value;	
			}
			
			if(typeof doic === 'undefined'){
				   doic = "";
			};
			
			new Ajax.Updater("fila_juridica", "../consultas/filajud.php?doic="+doic+"&sdoic="+sdoic,
			{  
			  onComplete: 
			  
			  function() { 
			   fecha_ubigeo_j();
			  }

			},{method:'GET'});	
			
			$("fila_juridica").style.display = "block";
			$("btn_ncliente").style.display = "block";
		}
	}

	function fecha_ubigeo_n(){
		var j = jQuery.noConflict();
			   
			   j(function() {
					j( "#n_fecnac" ).datepicker();
			   });
			   
			   j(function(){
					j('#n_ubigeon').autocomplete({
					source:'../consultas/ubigeos.php',
					select: function(event, ui){
						$("n_idubigeon").value = ui.item.id;
					}
					});
			   });
	}

	function fecha_ubigeo_j(){
		var j = jQuery.noConflict();
			   
			   j(function() {
					j( "#n_feccons" ).datepicker();
			   });
			   
			   j(function(){
					j('#n_ubigeoj').autocomplete({
					source:'../consultas/ubigeos.php',
					select: function(event, ui){
						$("n_idubigeoj").value = ui.item.id;
					}
					});
			   });
		
	}


	function cambiar_tipopago(){

		var select = document.getElementById("slc_tippago");
		var id_tipago = select.options[select.selectedIndex].value; 

		if(id_tipago=='SI'){
		
			new Ajax.Updater("div_checkpago", "../widgets/numero_comprobante.php");
		
		}else {
		
			new Ajax.Updater("div_checkpago", "../widgets/blanck.php");
		
		}
		
	}

	
	function mostrar_servicio(){
		
		var tip_docu="";
		
		if($("tip_comp")!=null){
		   tip_docu = $("tip_comp").value;
		}
		
		//if($("tip_comp").value!=""){
		   $("div_servicio").style.display = "block";
		   new Ajax.Updater("div_servicio", "../widgets/descripcion_egreso.php",{  
			  onComplete: 
			  function() { 
			  new Ajax.Updater("slc_serv", "../widgets/servicios.php?tip_docu="+tip_docu);  
			  }
			  },{method:'GET'}
		   );
	   	   
		   new Ajax.Updater("slc_tipserv", "../widgets/tiposerv.php");	
		/*}else{
			alert("Debe elegir el tipo de documento");
		}*/
		
	   eliminar_detalles();
		
	}
	
	function cerrar_servicio(){
		//$("div_servicio").style.display = "none";
		new Ajax.Updater("div_servicio", "../widgets/servicio.php");
		eliminar_detalles();
	}
	
	function cambio_servicio(){
		
		var id_servicio = $("servicio").value;
		
		new Ajax.Updater("div_precio", "../widgets/precio.php?id_servicio="+id_servicio);
		new Ajax.Updater("div_numero", "../widgets/numeros.php?id_servicio="+id_servicio);
		
		var combo = document.getElementById("servicio");
		var selected = combo.options[combo.selectedIndex].text; 
		
		$("servicio_d").value = selected;
		$("cantidad").value = 1;
		
		$("comentarios").value = selected;
		
	}
	
	function mostrar_area(par){
		
		if(par==1){
		  $("div_textarea").style.display = "block";	
		  var kardex = document.getElementById("num_kardex").value;
		  $("comentarios").value+=" ("+kardex+")";
		}else{
		  cerrar_area();
		}
		
	}
	
	function cerrar_area(){
		$("div_textarea").style.display = "none";
		$("comentarios").value = "";
	}
	
	
	function currency(valor) {
		
		var num = parseFloat(valor).toFixed(2);
		
		$("precio").value = num;
	}
	
	var indice = 1;
	
	var id = new Array();
	var desc = new Array();
	var precio = new Array();
	var cantidad = new Array();
	var total = new Array();

	var num_kardex = new Array();
	var num_desde = new Array();
	var num_hasta = new Array();
	var coments = new Array();
	
	function myCreateFunction() {
		
		if($("servicio").value==0){
			alert("Elija el tipo de servicio");
			return false;
		}
		
		var j=indice;
		
		id[indice] = $("servicio").value;
		
		if(myTrim($("comentarios").value)!=""){
			desc[indice] = ($("comentarios").value).toUpperCase();
		}else{
			desc[indice] = $("servicio_d").value;			
		}
		
		//desc[indice] = $("servicio_d").value;
		precio[indice] = $("precio").value;
		cantidad[indice] = $("cantidad").value;
		
		if($("num_kardex")!=null){
		  num_kardex[indice] = $("num_kardex").value;
		}else{
			num_kardex[indice] = "";
	    }
		
		if($("num_desde")!=null){
		  num_desde[indice] = $("num_desde").value;
		}else{
			num_desde[indice] = "";
	    }
		
		if($("num_hasta")!=null){
		  num_hasta[indice] = $("num_hasta").value;
		}else{
			num_hasta[indice] = "";
	    }
		
		if($("comentarios")!=null){
		  coments[indice] = $("comentarios").value;
		}else{
			coments[indice] = "";
	    }
		
		total[indice] = precio[indice]*cantidad[indice];
	 
		var tabla = document.getElementById("myTable");
	   
		var fila = tabla.insertRow();
	   
		var celda1 = fila.insertCell(0); celda1.style.height="20px"; 
		var celda2 = fila.insertCell(1);
		var celda3 = fila.insertCell(2); 
		var celda4 = fila.insertCell(3); 
		var celda5 = fila.insertCell(4); celda5.align="right";
		var celda6 = fila.insertCell(5); celda6.align="center";
		
		var campo1 = document.createElement("label");
			campo1.innerHTML = id[indice];
			campo1.style.marginLeft  ="5px";
			
		var caja1 = document.createElement("input");
			caja1.setAttribute("type", "hidden");
			caja1.setAttribute("id", "det_cod"+indice);
			caja1.setAttribute("name", "det_cod"+indice);
			caja1.setAttribute("value", id[indice]);
		
		var campo2 = document.createElement("label");
			campo2.innerHTML =desc[indice];
			campo2.style.marginLeft  ="5px";
			
		var caja2 = document.createElement("input");
			caja2.setAttribute("type", "hidden");
			caja2.setAttribute("id", "det_desc"+indice);
			caja2.setAttribute("name", "det_desc"+indice);
			caja2.setAttribute("value", desc[indice]);
		
		var campo3 = document.createElement("input");
			campo3.id = "det_precio"+indice;
			campo3.name = "det_precio"+indice;
			campo3.value =precio[indice];
			campo3.style.marginRight  ="5px";
			campo3.style.width  ="100px";
			campo3.style.textAlign ="right"
			campo3.style.backgroundColor  ="transparent";

			campo3.onchange=function(){
				$("det_precio"+j).value = parseFloat($("det_precio"+j).value).toFixed(2);
			};

			campo3.onkeyup=function(){
				$("det_total"+j).value = parseFloat($("det_precio"+j).value*$("det_cantidad"+j).value).toFixed(2);
				total[j]=$("det_total"+j).value;
				actualizar_totales();
			};
			
			campo3.onkeypress=function(){
				//return isNumberKey(this.event);
			/*	var evt = $("det_precio"+j).event;
				
				var charCode = (evt.which) ? evt.which : event.keyCode;
				alert(charCode);*/
			};
		
		var campo4 = document.createElement("input");
			campo4.id = "det_cantidad"+indice;
			campo4.name = "det_cantidad"+indice;
			campo4.value =cantidad[indice];
			campo4.style.marginRight  ="5px";
			campo4.style.width  ="100px";
			campo4.style.textAlign ="right"
			campo4.style.backgroundColor  ="transparent";
			
			campo4.onkeyup=function(){
				$("det_total"+j).value = $("det_precio"+j).value*$("det_cantidad"+j).value;
				total[j]= $("det_total"+j).value;
				actualizar_totales();
			};
			
			campo4.onkeypress=function(){
				//return isNumberKey(this.event);
			};
			
			
		var campo5 = document.createElement("input");
			campo5.id = "det_total"+indice;
			campo5.name = "det_total"+indice;
			campo5.value =total[indice];
			campo5.style.marginRight  ="5px";
			campo5.style.width  ="100px";
			campo5.style.textAlign ="right"
			campo5.style.backgroundColor  ="transparent";
			campo5.readOnly=true
	
		var campo6 = document.createElement("input");
			campo6.type = "button";
			campo6.style.width  ="60px";
			campo6.value = "Eliminar";
			campo6.onclick = function() {
		   
				var fila = this.parentNode.parentNode;
				var tbody = tabla.getElementsByTagName("tbody")[0];
			    tbody.removeChild(fila);
			    total[j]= 0;
			    actualizar_totales();
			   
			}
			
		//Inputs que no figuran en el detalle	
		
		var caja3 = document.createElement("input");
			caja3.setAttribute("type", "hidden");
			caja3.setAttribute("id", "det_numkardex"+indice);
			caja3.setAttribute("name", "det_numkardex"+indice);
			caja3.setAttribute("value", num_kardex[indice]);
			
		var caja4 = document.createElement("input");
			caja4.setAttribute("type", "hidden");
			caja4.setAttribute("id", "det_desde"+indice);
			caja4.setAttribute("name", "det_desde"+indice);
			caja4.setAttribute("value", num_desde[indice]);
			
		var caja5 = document.createElement("input");
			caja5.setAttribute("type", "hidden");
			caja5.setAttribute("id", "det_hasta"+indice);
			caja5.setAttribute("name", "det_hasta"+indice);
			caja5.setAttribute("value", num_hasta[indice]);
			
		var caja6 = document.createElement("input");
			caja6.setAttribute("type", "hidden");
			caja6.setAttribute("id", "det_comentarios"+indice);
			caja6.setAttribute("name", "det_comentarios"+indice);
			caja6.setAttribute("value", coments[indice]);
		
		celda1.appendChild(campo1);
		celda2.appendChild(campo2);
		celda3.appendChild(campo3);
		celda4.appendChild(campo4);
		celda5.appendChild(campo5);
		celda6.appendChild(campo6);

		celda1.appendChild(caja1);
		celda1.appendChild(caja2);
		celda1.appendChild(caja3);
		celda1.appendChild(caja4);
		celda1.appendChild(caja5);
		celda1.appendChild(caja6);
		
		actualizar_totales();
	
		$("numero").value = indice;
		
		indice++;
		
}
	

function actualizar_totales(){
		
		var subtotal1 = 0;
			
		for(var i=1; i<=indice; i++){
			if(total[i] != null){subtotal1 = subtotal1 + Math.round(total[i]*100)/100;}
		}
		
		
		
		var number  = 0;
		
		number = subtotal1-(subtotal1/1.18);
		
		//$("subtotal").value = Math.round((subtotal1-number)*100)/100;
		
		if($("tip_comp").value == 01){

			$("subtotal").value = Math.round((subtotal1-number)*100)/100;
			$("igv").value = Math.round(number*100)/100;		
		}else if($("tip_comp").value == 02){

		$("subtotal").value = Math.round((subtotal1-number)*100)/100;
		$("igv").value = Math.round(number*100)/100;

		}else if($("tip_comp").value == 04){

		$("subtotal").value = Math.round(0);
		$("igv").value = Math.round(0);

		}
		
		//number = subtotal1*1.18

		var totales=Math.round(subtotal1*100)/100;

		
		if($("tip_comp").value == 04 || $("tip_comp").value == 01){$("total").value=totales;		
		}else{$("total").value = totales}
		
	}
	
	
	function eliminar_detalles(){

		cerrar_area();
		new Ajax.Updater("div_detalle", "../widgets/detalle.php");	
		new Ajax.Updater("div_totales", "../widgets/totales.php");	
		indice = 1;
		//$("numero").value = indice;

	}
	
	function grabar_comprobante(){
	
		var val = validar_comprobante();
		
		if(val==1){
			
			var campos =$("frm_comprobante").serialize();
			var validador = $("valorusu").value;
			new Ajax.Request('../consultas/grabar_egreso.php?'+campos+"&valorusu="+validador, 
			{
				method:'get',
				requestHeaders: {Accept: 'application/json'},
				onSuccess: function(transport){
							var json = transport.responseText.evalJSON(true);
							$("id_pdf").value = json[1];
							if(json[2]=="true"){
								alert(json[0]);
								cargar_contenido();
								
							//	mostrar_impresion();
							
								//$("div_gencomp").style.display = "block";	
							}else{
								alert(json[3]);
								
								
								//alert("El comprobante ya exite");
							}
			}
			});
			
			
		}
	}
	
	
		function guardarEditarCaja(){
	
		
			var r = confirm("¿Esta a punto de guardar los cambios, desea continuar?");

		if (r == true) {
			var campos =$("frm_comprobante").serialize();
			
			new Ajax.Request("../consultas/guardarEdit.php?"+campos,
		{  
		  onComplete: 
		  function() { 
		  	alert("El comprobante ha sido modificado con exito");
			window.location="AnulPagosVie.php";
		  }
		},{method:'GET'});
		}
	}
	
	
	function validar_comprobante(){
		
		var val = 1;
		
		if($("tip_comp").value==""){
			alert("Elija Tipo de Comprobante");
			val = 2;
		}
		
/*		if(val != 2){
			if($("serie1").value=="" || $("serie2").value==""){
				alert("Serie vacía");
				val = 2;
			}
		}*/
		
		
		if(val != 2){
			if($("select_doic").value==0){
				alert("Elija el tipo de Documento");
				val = 2;
			}
		}
		
/*		if(val != 2){
			if($("slc_tippago").value!=3 && ($("total").value==0)){
				alert("Solo pago gratuito tiene valor total cero");
				val = 2;
			}
		}*/
		
		return val;
		
	}
	
	function generar_comprobante(){
		
		var id_regventas = $("id_pdf").value;
		
		window.open('../pdf/comprobante.php?id_regventas='+id_regventas);
		
	}
	
	
   function cambiarazon(){
	   valor=$('razon').value;
       texto=valor.replace(/&/gi,"*");
       textod2=texto.replace(/'/gi,"?");
       textod4=textod2.replace(/#/gi,"QQ11QQ");
       textod5=textod4.replace(/°/gi,"QQ22KK");
        $('n_razon').value=textod5;
	}
	
	function cambiardireccionj(){
	   valor=$('fiscal').value;
       texto=valor.replace(/&/gi,"*");
       textod2=texto.replace(/'/gi,"?");
       textod4=textod2.replace(/#/gi,"QQ11QQ");
       textod5=textod4.replace(/°/gi,"QQ22KK");
        $('n_fiscal').value=textod5;
	}
 
	function cambiardireccionn(){
	    valor=$('dir').value;
       texto=valor.replace(/&/gi,"*");
       textod2=texto.replace(/'/gi,"?");
       textod4=textod2.replace(/#/gi,"QQ11QQ");
       textod5=textod4.replace(/°/gi,"QQ22KK");
        $('n_dir').value=textod5;
	}
	
	function mostrar_impresion(){
		
			var divResultado = document.getElementById('imprimir_todo');
			var tip_comp      = document.getElementById('tip_comp').value;

	ajax=objetoAjax();
	ajax.open("POST", "../pdf/imprimir2.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tip_comp="+tip_comp)
		
	}
	
	
	