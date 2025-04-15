// JavaScript Document
$(document).ready(function() {
	
	$(".sel_idcliente").live("click", function() {		
	
	var _idcliente = this.id;
	var data       = {idcliente : _idcliente}
	
		$.getJSON('BuscaCoinciDes.php',data,function(respuesta){

			var _Datos = respuesta;
			
			$("#razonsocial_sr").val(_Datos[0].razonsocial);		
			$("#domfiscal_sr").val(_Datos[0].domfiscal);
			$("#ubigen_sr").val(_Datos[0].idubigeo);
			$("#contacempresa_sr").val(_Datos[0].contacempresa);
			$("#fechaconstitu_sr").val(_Datos[0].fechaconstitu);
			$("#idsedereg3_sr").val(_Datos[0].idsedereg);
			$("#telempresa_sr").val(_Datos[0].telempresa);
			$("#mailempresa_sr").val(_Datos[0].mailempresa);
			$("#codubi_sr").val(_Datos[0].idubigeo);
			$("#numregistro_sr").val(_Datos[0].numregistro);
			$("#numpartida_sr").val(_Datos[0].numpartida);
			$("#actmunicipal_sr").val(_Datos[0].actmunicipal);
			
			// Campo Oculto Num Documento:
			$("#numdoc").val(_Datos[0].numdoc);	
			$("#_eval_idcliente").val(_Datos[0].idcliente);	
			$("#divResultado_save").removeAttr('style','display');	
		
		})		
	});

 $("#tipoper").live("click", function(){
	 var _tipoper = this.id;
	 //$('#txt_tipoper').val(_tipoper);
    });
	
	
  // keypress del campo razon social	
 $("#razonsocial_sr").live("keypress", function(){
	 
	 var _razonsocial = $("#razonsocial_sr").val();
	 
    });
	
  // boton busca coincidencia	
  $("#bus_coincidencia").live("click", function(){
	 
	 var _razonsocial = $("#razonsocial_sr").val();

	// metodo 1  X
	/*
	 var data=  { 
			   		 razonsocial		:  _razonsocial
				 };
							
	$.post('buscaCoincidencia.php',data,function(data){
				$("#razonsocial_sr").val(data);
				var _busqueda = data;
				
					if(_busqueda!='')
						{//$("#muesresulb").html("Encontrado");
						 alert('Encontrado');
						 $('#numdoc').removeAttr('style','display');
						 $('#numdoc').focus();
						}
							else {
									$('#numdoc').val("");
									$('#numdoc').attr('style','display:none');
								 } 				
			});
	*/	
	// metodo 2 
	
			//$(".ui-dialog-titlebar").hide();		
		$('#Bus_Coincidencia').removeAttr('style','display');	
		$('#div_busCoinci').load('buscaCoincidencia.php?razonsocial='+_razonsocial);	
		// Bus_Coincidencia									
    });		
	
 	
	
 
 $("#tipodoc").live("click", function(){
	 var _tipodoc = $("#tipodoc").val();
		 if(_tipodoc == '10')
		 {
			$('#busclie').load('newEmpresasinRuc.php');	 
			$('#numdoc').attr('style','display:none');
			$('#btn_busca').attr('style','display:none');
			$("#numdoc").val("");
			$("#numdocnew").val("");
		 }
		 else
		 {
			$('#numdoc').removeAttr('style','display');
			$('#btn_busca').removeAttr('style','display');
			$("#divResultado_save").attr('style','display:none');
			$("#numdoc").val("");
			$("#numdocnew").val("");	 
		 }
	 
    });
	
	$("#btn_saveEmpsinRuc").live("click", function(){
		
		var _divResultado  		=  $("#divResultado_save").html();  
		
		var _razonsocial_sr 	= $("#razonsocial_sr").val();
		var _domfiscal_sr		= $("#domfiscal_sr").val();
		var _ubigen_sr			= $("#ubigen_sr").val();
		var _contacempresa_sr	= $("#contacempresa_sr").val();
		var _fechaconstitu_sr	= $("#fechaconstitu_sr").val();
		var _idsedereg3_sr		= $("#idsedereg3_sr").val();
		var _telempresa_sr		= $("#telempresa_sr").val();
		var _mailempresa_sr		= $("#mailempresa_sr").val();
		var _codubi_sr			= $("#codubi_sr").val();
		var _numregistro_sr		= $("#numregistro_sr").val();
		var _numpartida_sr		= $("#numpartida_sr").val();
		var _actmunicipal_sr	= $("#actmunicipal_sr").val();
		var _eval_idcliente     = $("#_eval_idcliente").val();
		
		//EVALUA NUMERO DOCUMENTO
		var  _numdoc 			= $("#numdocnew").val();
		

		var data = {
					razonsocial_sr      :  _razonsocial_sr,
					domfiscal_sr		:  _domfiscal_sr,
					ubigen_sr			:  _ubigen_sr,
					contacempresa_sr	:  _contacempresa_sr,
					fechaconstitu_sr    :  _fechaconstitu_sr,
					idsedereg3_sr       :  _idsedereg3_sr,
					telempresa_sr       :  _telempresa_sr,
					mailempresa_sr      :  _mailempresa_sr,
					codubi_sr           :  _codubi_sr,
					numregistro_sr      :  _numregistro_sr,
					numpartida_sr       :  _numpartida_sr,
					actmunicipal_sr     :  _actmunicipal_sr,
					numdoc     			:  _numdoc,
					_eval_idcliente		:  _eval_idcliente
			   } ;
	
		$.post('saveEmpreSinRuc.php',data,function(data){
			
				//$("#divResultado_save").html("<div>"+data+"</div>");
				$("#busclie").html(data);
						
			});
		
		return false;
		})


});