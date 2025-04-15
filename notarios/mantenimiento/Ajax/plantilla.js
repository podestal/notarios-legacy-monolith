


function listarPlantilla(vPage){

	vFkTypeKardex = jQuery('#cmbSearchFkTypeKardex').val(); 
	vNameTemplate = jQuery('#txtSearchNameTemplate').val(); 
	jQuery.ajax({
		url:'../consultas/list_template.php?page='+vPage+'&fkTypeKardex='+vFkTypeKardex+'&nameTemplate='+vNameTemplate,
		type:'POST',
		dataType:'html',
		success:function(response){

			jQuery('#list-plantilla').html(response);

		}
	});

}

 action = 1;
function showFrmAddTemplate(){

	jQuery('#div_mplantilla').hide();
	jQuery('#div_aplantilla').hide();

	jQuery('.form-template').remove();
	

	action = 1;
	jQuery.ajax({
		url:'../consultas/nueva_plantilla.php',
		type:'GET',
		dataType:'html',
		success:function(response){


			jQuery('#div_nplantilla').html(response);
			jQuery('#div_nplantilla').show();
		}
	});

	

}

function showTypeActs(argAction){


	if(argAction == 1){
		jQuery('#title-menu-acts').text('Seleccione Acto(s)');
	}else{

		jQuery('#title-menu-acts').text('Quitar Acto(s)');	
	}
	var vurl = argAction== 1?'../../mostraractos.php':'../../quitaractos.php';

	jQuery('#menuactos').show();
	vcodeActs = jQuery('#codeActs').val();
	vFkTypeKardex = jQuery('#fkTypeKardex').val();

	jQuery.ajax({
		url:vurl,
		type:'POST',
		dataType:'html',
		data:{idtipkar:vFkTypeKardex,codactos:vcodeActs},
		success:function(response){
			jQuery('#tipoacto').html(response);
		}
	});


}





function mostrar(isChecked, myValue)
{	

	total = jQuery('#contract').val();

	separador = " / ";
	quitar = myValue + separador;
	nuevoStr = "";
	if (isChecked) 
		jQuery('#contract').val(total + myValue + separador);
	else {

		jQuery('#contract').val(total.replace(quitar,nuevoStr));
	}
}

function mostrar2(isChecked, name)
{
	total2 = jQuery('#codeActs').val();
    
    quitar2 = name;
	if (isChecked) 
		jQuery('#codeActs').val(total2 + name);

	else
	 jQuery('#codeActs').val(total2.replace(quitar2,""));
}




function closeAddTemplate(){
	jQuery('#div_nplantilla').hide();
	jQuery('.form-template').remove();
}

function  closeActs(){
	jQuery('#menuactos').hide();
}

function  addTemplate(){

	vNameTemplate = jQuery('#nameTemplate').val();
	vCodeActs = jQuery('#codeActs').val();
	// templateFile = jQuery('#fileTemplate')[0].files[0];
	vFkTypeKardex = jQuery('#fkTypeKardex').val();
	vContract = jQuery('#contract').val();
	directorio = jQuery('#txtDirectorio').val();

	jQuery('#msg-error').hide();
	

	if(vFkTypeKardex == 0){
		alert('Seleciona el tipo de kardex');
	}else if(vNameTemplate == ''){
		alert('No ha ingresado el nombre de plantilla');
		jQuery('#nameTemplate').focus();
	}else if(vCodeActs == ''){
    	alert('No ha selecionado actos');
    }else /*if(templateFile == null){
    	alert('No ha selecionado ningun archivo');
    }else*/{
    	var formData  = new FormData();
	
		formData.append('fkTypeKardex',vFkTypeKardex);
		formData.append('nameTemplate',vNameTemplate);
		// formData.append('fileTemplate',templateFile);
		formData.append('codeActs',vCodeActs);
		formData.append('contract',vContract);
		formData.append('action',1);
		formData.append('directorio',directorio);

		jQuery.ajax({
			url:'../consultas/TplTemplate.php',
			type:'POST',
			dataType:'json',
			data:formData,
			cache:false,
		    contentType:false,
		    processData:false,
			success:function(response){

				console.log(response.responseText)
				if(response.error == 0){
					jQuery('#div_nplantilla').hide();
					listarPlantilla(1);
				}else{
				
					jQuery('#msg-error').text(response.descriptionError);
					jQuery('#msg-error').show();
				}
				//jQuery('#tipoacto').html(response);
				
			}
		});	

    }

}


function  changeTemplate(){
	var formData  = new FormData();
	vPkTemplate = jQuery('#pkTemplate').val();
	vNameTemplate = jQuery('#nameTemplate').val();
	vCodeActs = jQuery('#codeActs').val();
	vFkTypeKardex = jQuery('#fkTypeKardex').val();
	vContract = jQuery('#contract').val();
	directorio = jQuery('#txtDirectorio').val();

	jQuery('#msg-error').hide();
	jQuery('#msg-success').hide();

	if(vFkTypeKardex == 0){
		alert('Seleciona el tipo de kardex');
	}else 

	if(vCodeActs == ''){
    	alert('No ha selecionado actos');
    }else{

		
    	jQuery.ajax({
			url:'../consultas/TplTemplate.php',
			type:'POST',
			dataType:'json',
			data:{pkTemplate:vPkTemplate,fkTypeKardex:vFkTypeKardex,nameTemplate:vNameTemplate,codeActs:vCodeActs,
				contract:vContract,action:2,directorio:directorio},
			success:function(response){
				if(response.error == 0){
					//jQuery('#div_mplantilla').hide();
					jQuery('#msg-success').text(response.descriptionError);
					jQuery('#msg-success').show();
					listarPlantilla(1);
				}else{
					jQuery('#msg-error').text(response.descriptionError);
					jQuery('#msg-error').show();
				}
				//jQuery('#tipoacto').html(response);
				
			}
		});	

    }


}

function displayAllTemplate(){
	jQuery('#cmbSearchFkTypeKardex').val(0);
	jQuery('#txtSearchNameTemplate').val('');
	listarPlantilla(1);
}

function showFrmEditTemplate(argPkTemplate){
	action = 2;
	jQuery('#div_nplantilla').hide();
	jQuery('#div_aplantilla').hide();
	jQuery('.form-template').remove();

	jQuery.ajax({
		url:'../consultas/modificar_plantilla.php?pkTemplate='+argPkTemplate,
		type:'GET',
		dataType:'html',
		success:function(response){


			jQuery('#div_mplantilla').html(response);
			jQuery('#div_mplantilla').show();
		}
	});

	

}

function  closeChangeTemplate(){
		jQuery('#div_mplantilla').hide();
		jQuery('.form-template').remove();
}
function  showFrmAdjuntarTemplate(argPkTemplate){
	jQuery('#div_mplantilla').hide();
	jQuery('#div_nplantilla').hide();

	jQuery.ajax({
		url:'../consultas/adjuntar_plantilla.php?pkTemplate='+argPkTemplate,
		type:'GET',
		dataType:'html',
		success:function(response){
			jQuery('#div_aplantilla').html(response);
			jQuery('#div_aplantilla').show();
		}
	});	

}
function  closeUploadTemplate(){
		jQuery('#div_aplantilla').hide();
}

function changeFileTemplate(){

	vPkTemplate = jQuery('#pkTemplate').val();
	templateFile = jQuery('#fileTemplate')[0].files[0];
	vNameTemplate = jQuery('#nameTemplate').val();

	jQuery('#msg-error').hide();
	jQuery('#msg-success').hide();

	if(templateFile == null){
    	alert('No ha selecionado ningun archivo');
    }else{
    	var formData  = new FormData();
	
		formData.append('pkTemplate',vPkTemplate);
		formData.append('nameTemplate',vNameTemplate);
		formData.append('fileTemplate',templateFile);

		formData.append('action',4);

		jQuery.ajax({
			url:'../consultas/TplTemplate.php',
			type:'POST',
			dataType:'json',
			data:formData,
			cache:false,
		    contentType:false,
		    processData:false,
			success:function(response){
				if(response.error == 0){
					jQuery('#msg-success').text(response.descriptionError);
					jQuery('#msg-success').show();
					//jQuery('#div_aplantilla').hide();
					listarPlantilla(1);
				}else{
					jQuery('#msg-error').text(response.descriptionError);
					jQuery('#msg-error').show();
				}
				//jQuery('#tipoacto').html(response);
				
			}
		});	

    }

}

function openLogin(id){


	jQuery('#div_login').show();

	new Draggable('div_login');

	jQuery.ajax({
			url:'../widgets/login.php?id='+id,
			type:'GET',
			dataType:'html',
			success:function(response){
				jQuery('#div_login').html(response);
			
				
			}
		});	

}

function cerrar_login(){
	jQuery('#div_login').hide();
}


		
function login(id){
	
	var usuario = jQuery("#usuario").val();
	var clave = jQuery("#clave").val();
	
	if(usuario != '' && clave != ''){

		jQuery.ajax({
			url:'../consultas/login.php?user='+usuario+'&pass='+clave,
			type:'GET',
			dataType:'json',
			success:function(response){
				if(response == 1){
					cerrar_login();
					deleteTemplate(id);
				}
				if(response == 2){
					alert("Clave o Password Incorrecto");
				}
				
				
			}
		});	
	}

}

function deleteTemplate(argPkTemplate){
	
	jQuery.ajax({
			url:'../consultas/TplTemplate.php',
			type:'POST',
			dataType:'json',
			data:{pkTemplate:argPkTemplate,action:3},
			success:function(response){
				if(response.error == 0){
					cerrar_login();
					listarPlantilla(1);
				}
				
			}
		});	


}