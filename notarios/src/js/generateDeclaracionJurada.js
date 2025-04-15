// const showDeclaracionJurada = (idContratante,declaracionJurada)=>{
    
//     if(declaracionJurada=='ANEXO5'){
//         mostrar_desc('anexo5')
//         getAnexo5(idContratante)
//         let txtContratante = document.getElementById('txtIdContratante')
//         txtContratante.value=idContratante
//     }else{
//         mostrar_desc('pep')
//         getPep(idContratante)
//         let txtContratante = document.getElementById('txtIdContratantePep')
//         txtContratante.value=idContratante
//     };
    
// }

const generateDeclaracionJurada = (idContratante)=>{
    
    event.preventDefault();
    let anexo = document.getElementById('cmbAnexo'+idContratante);
    let anexos = document.getElementsByClassName('cmbAnexo');
    let loading = document.getElementById('loading'+idContratante) 

    for(let anex of anexos){
        anex.setAttribute('disabled','true');
    }

    anexo.style.display='none';
    loading.style.display='block';
    
    if(anexo.value==0){
        for(let anex of anexos){
            anex.removeAttribute('disabled');
        }
        anexo.style.display='block';
        loading.style.display='none';
        //alert('Elija un anexo para generarlo');
        return false;
    }
    let url = '';
    let ocuif = '';
	let oiuif = '';
    if(anexo.value=='ANEXO5'){
        // ocuif = document.getElementById('ocuif').checked
		// oiuif = document.getElementById('oiuif').checked
        url = 'generar_declaracion_jurada.php'
    }else{
        url = 'src/models/generateDeclaracionJurada.php'
    }
    // console.log(url)
    let inputs = {};
     
    inputs['anexo'] = anexo.value;
    inputs['idContratante'] = idContratante;

    // console.log(inputs)
    const request=new XMLHttpRequest();
    request.open('POST',url,true);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
    request.send('inputs='+JSON.stringify(inputs))

    request.onload=function(){
        if (request.status>=200 && request.status<400) {
            let data=request.responseText;
            console.log(data)  
        
            if(anexo.value=='ANEXO5'){
                console.log('PDF generado correctamente');
				// location.href =(baseurl+'Cgastos/generar_pdf/'+id)
				let modalPdf=document.getElementById('modalPdfContent');
				var iframe = document.createElement('iframe');
				if(document.getElementById('framePdf')){
					var iframe = document.createElement('iframe');
					modalPdf.replaceChild(iframe,document.getElementById('framePdf'));
					iframe.setAttribute('id','framePdf')  
				}else{
					modalPdf.appendChild(iframe);
					iframe.setAttribute('id','framePdf')  
				}
				iframe.src = url+'?idContratante='+idContratante+'&ocuif='+ocuif+'&oiuif='+oiuif;
				iframe.setAttribute('style','position:absolute;right:0; top:30px; bottom:0; height:87vh; width:100%');
				mostrar_desc('clienteDecJu');
            }else{
                openDeclaracionJurada(idContratante,anexo.value)
            }
        

            for(let anex of anexos){
                anex.removeAttribute('disabled');
            }
        
            anexo.style.display='block';
            loading.style.display='none';

        } else {
            console.log(request.responseText);
            console.error('No se pudo generar el PDF');
            for(let anex of anexos){
                anex.removeAttribute('disabled');
            }
        
            anexo.style.display='block';
            loading.style.display='none';
        }
    }
    request.onerror = function(){
        console.error('Error de conexión en el servidor')
        for(let anex of anexos){
            anex.removeAttribute('disabled');
        }
    
        anexo.style.display='block';
        loading.style.display='none';
    }
    
    
}

// const setDeclaracionJurada = (url,form,data) => {
//     event.preventDefault();

//     let inputs = {};
//     for(const item of data){
//         let name=item.name;
//         let value=item.value;
//         inputs[name] = value;
//     }

//     for(const item of data){
//         let name=item.name;
//         let value=item.value;
//         let check = item.checked

//         if(check!=false){
            
//             inputs[name]=value
            
//         }
        
//     }
    
//     // console.log(inputs)
//     const request=new XMLHttpRequest();
//     request.open('POST',url,true);
//     request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
//     request.send('inputs='+JSON.stringify(inputs))

//     request.onload=function(){
//         if (request.status>=200 && request.status<400) {
//             let data=request.responseText;
//             console.log(data)  
//             if(inputs['txtIdContratante']){
                
//                 openDeclaracionJurada(inputs['txtIdContratante'],'ANEXO5')
//                 if(document.getElementById('txtIdDeclaracionJurada')){
//                     let registro=JSON.parse(data);
//                     let anexo5 = document.getElementById('txtIdDeclaracionJurada');
//                     anexo5.value = registro[0].id_anexo
//                 }
//             }
//             if(inputs['txtIdContratantePep']){
                
//                 openDeclaracionJurada(inputs['txtIdContratantePep'],'PEP')
//             }

//         } else {
//             console.log(request.responseText);
//             console.error('No se pudo generar el PDF');
//         }
//     }
//     request.onerror = function(){
//         console.error('Error de conexión en el servidor')
//     }
// }
const openDeclaracionJurada = async (idContratante,directorio)=>{
	console.log(idContratante)
	console.log(directorio)
	let url = 'src/controllers/openDeclaracionJurada.php?idContratante='+idContratante+'&directorio='+directorio;
	window.open(url);
}

// const getAnexo5 = (idContratante) => {
    
//     let url = 'src/models/getAnexo5.php'
//     const request=new XMLHttpRequest();
//     request.open('POST',url,true);
//     request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
//     request.send('idContratante='+idContratante)

//     request.onload=function(){
//         if (request.status>=200 && request.status<400) {
//             let data=request.responseText;
//             let registro = JSON.parse(data)
//             // console.log('GET',registro)  
//             // console.log('GET',registro[0])  
            
//                 txtIdDeclaracionJurada.value = registro[0].id_anexo5;
//                 // txtIdContratante.value = registro[0].contratante_id;
//                 txtCargoFuncionPublica.value = registro[0].cargoFuncionPublica;
//                 txtDescripcionBien.value = registro[0].descripcion_bien;
//                 // txtParentesco1.checked = registro[0].parentesco;
//                 if(registro[0].parentesco=='SI'){
//                     txtParentesco1.setAttribute('checked', '')
//                     txtParentesco1.parentNode.setAttribute('class', 'checked')
//                     txtParentesco2.removeAttribute('checked')
//                     txtParentesco2.parentNode.removeAttribute('class')
//                 }else{
//                     txtParentesco1.removeAttribute('checked')
//                     txtParentesco1.parentNode.removeAttribute('class')
//                     txtParentesco2.setAttribute('checked', '')
//                     txtParentesco2.parentNode.setAttribute('class', 'checked')
//                 }

//                 if(registro[0].pep=='SI'){
//                     txtPEP1.setAttribute('checked', '')
//                     txtPEP1.parentNode.setAttribute('class', 'checked')
//                     txtPEP2.removeAttribute('checked')
//                     txtPEP2.parentNode.removeAttribute('class')
//                 }else{
//                     txtPEP1.removeAttribute('checked')
//                     txtPEP1.parentNode.removeAttribute('class')
//                     txtPEP2.setAttribute('checked', '')
//                     txtPEP2.parentNode.setAttribute('class', 'checked')
//                 }
                
//                 if(registro[0].pep2=='SI SOY'){
//                     txtPEP21.setAttribute('checked', '')
//                     txtPEP21.parentNode.setAttribute('class', 'checked')
//                     txtPEP22.removeAttribute('checked')
//                     txtPEP22.parentNode.removeAttribute('class')
//                     txtPEP23.removeAttribute('checked')
//                     txtPEP23.parentNode.removeAttribute('class')
//                     txtPEP24.removeAttribute('checked')
//                     txtPEP24.parentNode.removeAttribute('class')
//                 }else if(registro[0].pep2=='SI HE SIDO'){
//                     txtPEP21.removeAttribute('checked')
//                     txtPEP21.parentNode.removeAttribute('class')
//                     txtPEP22.setAttribute('checked', '')
//                     txtPEP22.parentNode.setAttribute('class', 'checked')
//                     txtPEP23.removeAttribute('checked')
//                     txtPEP23.parentNode.removeAttribute('class')
//                     txtPEP24.removeAttribute('checked')
//                     txtPEP24.parentNode.removeAttribute('class')
//                 }else if(registro[0].pep2=='NO SOY'){
//                     txtPEP21.removeAttribute('checked')
//                     txtPEP21.parentNode.removeAttribute('class')
//                     txtPEP22.removeAttribute('checked')
//                     txtPEP22.parentNode.removeAttribute('class')
//                     txtPEP23.setAttribute('checked', '')
//                     txtPEP23.parentNode.setAttribute('class', 'checked')
//                     txtPEP24.removeAttribute('checked')
//                     txtPEP24.parentNode.removeAttribute('class')
//                 }else{
//                     txtPEP21.removeAttribute('checked')
//                     txtPEP21.parentNode.removeAttribute('class')
//                     txtPEP22.removeAttribute('checked')
//                     txtPEP22.parentNode.removeAttribute('class')
//                     txtPEP23.removeAttribute('checked')
//                     txtPEP23.parentNode.removeAttribute('class')
//                     txtPEP24.setAttribute('checked', '')
//                     txtPEP24.parentNode.setAttribute('class', 'checked')
//                 }

//                 txtPEP2Especify.value = registro[0].pep2Especify;

//                 if(registro[0].pep2=='SI SOY'){
//                     txtPEP31.setAttribute('checked', '')
//                     txtPEP31.parentNode.setAttribute('class', 'checked')
//                     txtPEP32.removeAttribute('checked')
//                     txtPEP32.parentNode.removeAttribute('class')
//                     txtPEP33.removeAttribute('checked')
//                     txtPEP33.parentNode.removeAttribute('class')
//                     txtPEP34.removeAttribute('checked')
//                     txtPEP34.parentNode.removeAttribute('class')
//                 }else if(registro[0].pep2=='SI HE SIDO'){
//                     txtPEP31.removeAttribute('checked')
//                     txtPEP31.parentNode.removeAttribute('class')
//                     txtPEP32.setAttribute('checked', '')
//                     txtPEP32.parentNode.setAttribute('class', 'checked')
//                     txtPEP33.removeAttribute('checked')
//                     txtPEP33.parentNode.removeAttribute('class')
//                     txtPEP34.removeAttribute('checked')
//                     txtPEP34.parentNode.removeAttribute('class')
//                 }else if(registro[0].pep2=='NO SOY'){
//                     txtPEP31.removeAttribute('checked')
//                     txtPEP31.parentNode.removeAttribute('class')
//                     txtPEP32.removeAttribute('checked')
//                     txtPEP32.parentNode.removeAttribute('class')
//                     txtPEP33.setAttribute('checked', '')
//                     txtPEP33.parentNode.setAttribute('class', 'checked')
//                     txtPEP34.removeAttribute('checked')
//                     txtPEP34.parentNode.removeAttribute('class')
//                 }else{
//                     txtPEP31.removeAttribute('checked')
//                     txtPEP31.parentNode.removeAttribute('class')
//                     txtPEP32.removeAttribute('checked')
//                     txtPEP32.parentNode.removeAttribute('class')
//                     txtPEP33.removeAttribute('checked')
//                     txtPEP33.parentNode.removeAttribute('class')
//                     txtPEP34.setAttribute('checked', '')
//                     txtPEP34.parentNode.setAttribute('class', 'checked')
//                 }
//                 txtPEP3Especify.value = registro[0].pep3Especify;

//                 if(registro[0].pep=='SI'){
//                     txtUIF1.setAttribute('checked', '')
//                     txtUIF1.parentNode.setAttribute('class', 'checked')
//                     txtUIF2.removeAttribute('checked')
//                     txtUIF2.parentNode.removeAttribute('class')
//                 }else{
//                     txtUIF1.removeAttribute('checked')
//                     txtUIF1.parentNode.removeAttribute('class')
//                     txtUIF2.setAttribute('checked', '')
//                     txtUIF2.parentNode.setAttribute('class', 'checked')
//                 }

//                 if(registro[0].pep=='SI'){
//                     txtUIF21.setAttribute('checked', '')
//                     txtUIF21.parentNode.setAttribute('class', 'checked')
//                     txtUIF22.removeAttribute('checked')
//                     txtUIF22.parentNode.removeAttribute('class')
//                 }else{
//                     txtUIF21.removeAttribute('checked')
//                     txtUIF21.parentNode.removeAttribute('class')
//                     txtUIF22.setAttribute('checked', '')
//                     txtUIF22.parentNode.setAttribute('class', 'checked')
//                 }
            

//         } else {
//             console.log(request.responseText);
//             console.error('No se pudo generar el PDF');
//         }
//     }
//     request.onerror = function(){
//         console.error('Error de conexión en el servidor')
//     }
// }

// const getPep = (idContratante) => {
    
//     let url = 'src/models/getPep.php'
//     const request=new XMLHttpRequest();
//     request.open('POST',url,true);
//     request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
//     request.send('idContratante='+idContratante)

//     request.onload=function(){
//         if (request.status>=200 && request.status<400) {
//             let data=request.responseText;
//             console.log('data',data)  
//             let registro = JSON.parse(data)
//             // console.log('GET',registro)  
//             // console.log('GET',registro[0])
//             let tipos = registro[0].tipo.split(',');
//             let codigos = registro[0].codigo.split(',');
//             let nombres = registro[0].nombres.split(',');
//             let apellidoPaterno = registro[0].apellido_paterno.split(',');
//             let apellidoMaterno = registro[0].apellido_materno.split(',');
//             let razonSocial = registro[0].razon_social.split(',');
//             let ruc = registro[0].ruc.split(',');
//             let porcentajeCapital = registro[0].porcentaje_capital.split(',');

//             // const a = servicios.find((noti)=>noti.url === servicio)
//             // const objParientes = {
//             //     title:a.metatitle,
//             //     description:a.metadescription
//             // }

//             let objParientes = [];
//             let objConyuges = [];
//             let objEmpresas = [];
//             for(let i = 0; i <= 9; i++){
//                 if(tipos[i] == 'PARIENTE'){
//                     objParientes.push({
//                         'codigos' : codigos[i],
//                         'nombre' : nombres[i],
//                         'apellidoPaterno' : apellidoPaterno[i],
//                         'apellidoMaterno' : apellidoMaterno[i]
//                     })
//                 }
//                 if(tipos[i] == 'CONYUGE'){
//                     objConyuges.push({
//                         'codigos' : codigos[i],
//                         'nombre' : nombres[i],
//                         'apellidoPaterno' : apellidoPaterno[i],
//                         'apellidoMaterno' : apellidoMaterno[i]
//                     })
//                 }
//                 if(tipos[i] == 'EMPRESA'){
//                     objEmpresas.push({
//                         'razonSocial' : razonSocial[i],
//                         'ruc' : ruc[i],
//                         'porcentajeCapital' : porcentajeCapital[i],
//                     })
//                 }
//             }

//             // console.log(objParientes)
//             // console.log(objConyuges)
//             // console.log(objEmpresas)
//             if(objParientes.length == 0){
//                 for(let i = 0; i <= 9; i++){
//                     let codigoParienteText = document.getElementById('uniform-cmbParientes'+(i+1))
//                     codigoParienteText.firstElementChild.textContent = '.::CODIGO::.'
//                     let codigoPariente = document.getElementById('cmbParientes'+(i+1))
//                     codigoPariente.value = ''
//                     let nombresPariente = document.getElementById('txtNombresParientes'+(i+1))
//                     nombresPariente.value = ''
//                     let apellidoPaternoParientes = document.getElementById('txtApellidoPaternoParientes'+(i+1))
//                     apellidoPaternoParientes.value = ''
//                     let apellidoMaternoParientes = document.getElementById('txtApellidoMaternoParientes'+(i+1))
//                     apellidoMaternoParientes.value = ''
//                 }
//             }

//             if(objConyuges.length == 0){
//                 for(let i = 0; i <= 9; i++){
//                     let codigoParienteText = document.getElementById('uniform-cmbParientesConyuge'+(i+1))
//                     codigoParienteText.firstElementChild.textContent = '.::CODIGO::.'
//                     let codigoPariente = document.getElementById('cmbParientesConyuge'+(i+1))
//                     codigoPariente.value = ''
//                     let nombresPariente = document.getElementById('txtNombresParientesConyuge'+(i+1))
//                     nombresPariente.value = ''
//                     let apellidoPaternoParientes = document.getElementById('txtApellidoPaternoParientesConyuge'+(i+1))
//                     apellidoPaternoParientes.value = ''
//                     let apellidoMaternoParientes = document.getElementById('txtApellidoMaternoParientesConyuge'+(i+1))
//                     apellidoMaternoParientes.value = ''
//                 }
//             }
//             if(objConyuges.length == 0){
//                 for(let i = 0; i <= 3; i++){
//                     let empresaRazonSocial = document.getElementById('txtEmpresaRazonSocial'+(i+1))
//                     empresaRazonSocial.value = ''
//                     let empresaPorcentaje = document.getElementById('txtEmpresaPorcentaje'+(i+1))
//                     empresaPorcentaje.value = ''
//                     let empresaRuc = document.getElementById('txtEmpresaRuc'+(i+1))
//                     empresaRuc.value = ''
//                 }
//             }

//             objParientes.map((pariente,i)=>{
//                 let codigoParienteText = document.getElementById('uniform-cmbParientes'+(i+1))
//                 codigoParienteText.firstElementChild.textContent = pariente.codigos
//                 let codigoPariente = document.getElementById('cmbParientes'+(i+1))
//                 codigoPariente.value = pariente.codigos
//                 let nombresPariente = document.getElementById('txtNombresParientes'+(i+1))
//                 nombresPariente.value = pariente.nombre
//                 let apellidoPaternoParientes = document.getElementById('txtApellidoPaternoParientes'+(i+1))
//                 apellidoPaternoParientes.value = pariente.apellidoPaterno
//                 let apellidoMaternoParientes = document.getElementById('txtApellidoMaternoParientes'+(i+1))
//                 apellidoMaternoParientes.value = pariente.apellidoMaterno
//             })
            
//             objConyuges.map((pariente,i)=>{
//                 // console.log(pariente.codigos)
//                 let codigoParienteText = document.getElementById('uniform-cmbParientesConyuge'+(i+1))
//                 codigoParienteText.firstElementChild.textContent = pariente.codigos
//                 let codigoPariente = document.getElementById('cmbParientesConyuge'+(i+1))
//                 codigoPariente.value = pariente.codigos
//                 let nombresPariente = document.getElementById('txtNombresParientesConyuge'+(i+1))
//                 nombresPariente.value = pariente.nombre
//                 let apellidoPaternoParientes = document.getElementById('txtApellidoPaternoParientesConyuge'+(i+1))
//                 apellidoPaternoParientes.value = pariente.apellidoPaterno
//                 let apellidoMaternoParientes = document.getElementById('txtApellidoMaternoParientesConyuge'+(i+1))
//                 apellidoMaternoParientes.value = pariente.apellidoMaterno
//             })

//             objEmpresas.map((pariente,i)=>{
//                 let empresaRazonSocial = document.getElementById('txtEmpresaRazonSocial'+(i+1))
//                 empresaRazonSocial.value = pariente.razonSocial
//                 let empresaPorcentaje = document.getElementById('txtEmpresaPorcentaje'+(i+1))
//                 empresaPorcentaje.value = pariente.porcentajeCapital
//                 let empresaRuc = document.getElementById('txtEmpresaRuc'+(i+1))
//                 empresaRuc.value = pariente.ruc
                
//             })
 
//         } else {
//             console.log(request.responseText);
//             console.error('No se pudo generar el PDF');
//         }
//     }
//     request.onerror = function(){
//         console.error('Error de conexión en el servidor')
//     }
// }

document.addEventListener('DOMContentLoaded',()=>{
    // if(document.getElementById('btnDeclaracionJurada')){

    //     let btnDecJu = document.getElementById('btnDeclaracionJurada')
    //     let url = document.getElementById('formDeclaracionJurada').action;
    //     let form = document.getElementById('formDeclaracionJurada');
    //     let data = form.querySelectorAll('input,select,textarea');
                    
    //     btnDecJu.addEventListener('click',()=>{
    //         setDeclaracionJurada(url,form,data)
    //     })
    // }    
    
    // if(document.getElementById('btnDeclaracionJuradaPep')){

    //     let btnDecJu = document.getElementById('btnDeclaracionJuradaPep')
    //     let url = document.getElementById('formDeclaracionJuradaPep').action;
    //     let form = document.getElementById('formDeclaracionJuradaPep');
    //     let data = form.querySelectorAll('input,select,textarea');
                    
    //     btnDecJu.addEventListener('click',()=>{
    //         setDeclaracionJurada(url,form,data)
    //     })
    // }


    var selectoredElements = document.querySelectorAll('#sinEstilos .selector');
    // Recorre los elementos y elimina la clase "selector"
    selectoredElements.forEach(function(element) {
        element.classList.remove('selector');
    });

    var elementsWithStyle = document.querySelectorAll('#sinEstilos  select[style]');
    // Recorre los elementos y elimina el atributo 'style'
    elementsWithStyle.forEach(function(element) {
        element.removeAttribute('style');
       
        element.style.fontSize = '12px'; // Agregar padding
        element.style.width = '60px'; // Agregar padding

    });


    var spans = document.querySelectorAll('#sinEstilos span');
    // Recorre los elementos y elimina aquellos que contienen solo el texto "ANEXO"
    spans.forEach(function(element) {
        // console.log(element.textContent)
        if (element.textContent.includes('.::DDJJ::.')) {
            element.remove();
        }
    });

    // var selectoredElements = document.querySelectorAll('#sinEstilos .button');
    // // Recorre los elementos y elimina la clase "selector"
    // selectoredElements.forEach(function(element) {
    //     element.classList.remove('button');
    // });

    // var elementsWithStyle = document.querySelectorAll('#sinEstilos  button[style]');
    // // Recorre los elementos y elimina el atributo 'style'
    // elementsWithStyle.forEach(function(element) {
    //     element.removeAttribute('style');
    // });


    // var spans = document.querySelectorAll('#sinEstilos span');
    // // Recorre los elementos y elimina aquellos que contienen solo el texto "ANEXO"
    // spans.forEach(function(element) {
        
    //     if (element.textContent.includes('Generar')) {
    //         element.remove();
    //     }
    // });

})