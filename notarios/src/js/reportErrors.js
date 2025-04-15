class ErroresPDT{
    constructor(){
        this.tbl='tblListErrors';
    }
    list(url,usuario,year){

        year.setAttribute('disabled','true');
        loading.style.display='block';
        let tbl=this.tbl
        const request=new XMLHttpRequest();
        request.open('POST',url,true);
        request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
        request.send('usuario='+usuario+'&year='+year.value);
        request.onload=function(){
            if(request.status>=200 && request.status<400){
                $("#tableErrors").dataTable().fnDestroy();
                let data=request.responseText;
                 let registro=JSON.parse(data);
                // console.log(registro['renta'])
                htmlErroresPDT(registro)

                if(document.getElementById(tbl)){
                    let tblListado = document.getElementById(tbl);
                    tblListado.innerHTML = html;
                    datatablesTotal('tableErrors')
                    year.removeAttribute('disabled');
                    loading.style.display='none';
                }
                
            }else{
                let data=request.responseText;
                console.log('No hubo respuesta')
                console.log(data);
                year.removeAttribute('disabled');
                loading.style.display='none';
            }
        }
        request.onerror=function(){
            console.log('No hay conexion')
            year.removeAttribute('disabled');
            loading.style.display='none';
        }
    }
}
document.addEventListener('DOMContentLoaded',()=>{
    if(document.getElementById("tblListErrors")){
         
        // console.log(usuario,'hola')
        let yearError = document.getElementById('cmbYearError')
        let listErroresPDT = new ErroresPDT();
        listErroresPDT.list('../models/getErrors.php',usuario,yearError)
    }

    if(document.getElementById("cmbYearError")){
        let yearError = document.getElementById('cmbYearError')
        yearError.addEventListener('change',()=>{

            yearError = document.getElementById('cmbYearError')
            let listErroresPDT = new ErroresPDT();
            listErroresPDT.list('../models/getErrors.php',usuario,yearError)
        })
    }
})

function htmlErroresPDT(registro){
    console.log(registro)
    
        html=`<tbody>`
            if(registro['renta']){
                for(let value of registro['renta']){ 

                    let fecha = new Date();
                    let fechaActual = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
                    let fechaInicio = new Date(value.fechaescritura).getTime();
                    let fechaFin = new Date(fechaActual).getTime();
                    let  diff = fechaFin - fechaInicio;
                    let dias = diff/(1000*60*60*24);
                    let styleEstado = ''
                    let colorEstado = ''
                    let textoEstado = ''

                    if(dias>20){
                        styleEstado = 'background:red'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }else if (dias < 20 && dias > 15){
                        styleEstado = 'background:yellow'
                        colorEstado = 'color:black'
                        textoEstado = `TE QUEDAN ${parseInt(20 - dias)} dias`
                    }else if(dias < 15){
                        styleEstado = 'background:greenyellow'
                        colorEstado = 'color:green'
                        textoEstado = `QUEDAN ${parseInt(20 - dias)} dias`
                    }else{
                        styleEstado = 'background:tomato'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }

                    html+=`<tr>
                        <td>${value.idkardex}</td>
                        <td><a  href="../../verkardex.php?kardex=${value.kardex}&id=${value.idkardex}" title="ABRIR REGISTRO" target="_blank">${value.kardex}</a></td>
                        <td>${value.fechaescritura}</td>
                        <td width="300px">${value.contrato.replace('/','')}</td>
                        <td>${value.error}</td>
                        <td class="text-nowrap">${value.responsable}</td>
                        <td class="text-nowrap"><span class="badge badge-danger" style="${styleEstado};${colorEstado}">${textoEstado}</span></td>
                    </tr>`;
                    
                    }
            }
            if(registro['bien']){
                for(let value of registro['bien']){ 

                    let fecha = new Date();
                    let fechaActual = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
                    let fechaInicio = new Date(value.fechaescritura).getTime();
                    let fechaFin = new Date(fechaActual).getTime();
                    let  diff = fechaFin - fechaInicio;
                    let dias = diff/(1000*60*60*24);
                    let styleEstado = ''
                    let colorEstado = ''
                    let textoEstado = ''

                    if(dias>20){
                        styleEstado = 'background:red'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }else if (dias < 20 && dias > 15){
                        styleEstado = 'background:yellow'
                        colorEstado = 'color:black'
                        textoEstado = `TE QUEDAN ${parseInt(20 - dias)} dias`
                    }else if(dias < 15){
                        styleEstado = 'background:greenyellow'
                        colorEstado = 'color:green'
                        textoEstado = `QUEDAN ${parseInt(20 - dias)} dias`
                    }else{
                        styleEstado = 'background:tomato'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }

                    html+=`<tr>
                        <td>${value.idkardex}</td>
                        <td><a  href="../../verkardex.php?kardex=${value.kardex}&id=${value.idkardex}" title="ABRIR REGISTRO" target="_blank">${value.kardex}</a></td>
                        <td>${value.fechaescritura}</td>
                        <td width="300px">${(value.contrato).replace('/','')}</td>
                        <td>${value.error}</td>
                        <td class="text-nowrap">${value.responsable}</td>
                        <td class="text-nowrap"><span class="badge badge-danger" style="${styleEstado};${colorEstado}">${textoEstado}</span></td>
                    </tr>`;
                    
                    }
            }
            if(registro['ofondo']){
                for(let value of registro['ofondo']){ 

                    let fecha = new Date();
                    let fechaActual = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
                    let fechaInicio = new Date(value.fechaescritura).getTime();
                    let fechaFin = new Date(fechaActual).getTime();
                    let  diff = fechaFin - fechaInicio;
                    let dias = diff/(1000*60*60*24);
                    let styleEstado = ''
                    let colorEstado = ''
                    let textoEstado = ''

                    if(dias>20){
                        styleEstado = 'background:red'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }else if (dias < 20 && dias > 15){
                        styleEstado = 'background:yellow'
                        colorEstado = 'color:black'
                        textoEstado = `TE QUEDAN ${parseInt(20 - dias)} dias`
                    }else if(dias < 15){
                        styleEstado = 'background:greenyellow'
                        colorEstado = 'color:green'
                        textoEstado = `QUEDAN ${parseInt(20 - dias)} dias`
                    }else{
                        styleEstado = 'background:tomato'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }

                    html+=`<tr>
                        <td>${value.idkardex}</td>
                        <td><a  href="../../verkardex.php?kardex=${value.kardex}&id=${value.idkardex}" title="ABRIR REGISTRO" target="_blank">${value.kardex}</a></td>
                        <td>${value.fechaescritura}</td>
                        <td width="300px">${(value.contrato).replace('/','')}</td>
                        <td>${value.error}</td>
                        <td class="text-nowrap">${value.responsable}</td>
                        <td class="text-nowrap"><span class="badge badge-danger" style="${styleEstado};${colorEstado}">${textoEstado}</span></td>
                    </tr>`;
                    
                    }
            }

            if(registro['conclusion']){
                for(let value of registro['conclusion']){ 

                    let fecha = new Date();
                    let fechaActual = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
                    let fechaInicio = new Date(value.fechaescritura).getTime();
                    let fechaFin = new Date(fechaActual).getTime();
                    let  diff = fechaFin - fechaInicio;
                    let dias = diff/(1000*60*60*24);
                    let styleEstado = ''
                    let colorEstado = ''
                    let textoEstado = ''

                    if(dias>20){
                        styleEstado = 'background:red'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }else if (dias < 20 && dias > 15){
                        styleEstado = 'background:yellow'
                        colorEstado = 'color:black'
                        textoEstado = `TE QUEDAN ${parseInt(20 - dias)} dias`
                    }else if(dias < 15){
                        styleEstado = 'background:greenyellow'
                        colorEstado = 'color:green'
                        textoEstado = `QUEDAN ${parseInt(20 - dias)} dias`
                    }else{
                        styleEstado = 'background:tomato'
                        colorEstado = 'color:white'
                        textoEstado = `CORREGIR URGENTE`
                    }

                    html+=`<tr>
                        <td>${value.idkardex}</td>
                        <td><a  href="../../verkardex.php?kardex=${value.kardex}&id=${value.idkardex}" title="ABRIR REGISTRO" target="_blank">${value.kardex}</a></td>
                        <td>${value.fechaescritura}</td>
                        <td width="300px">${(value.contrato).replace('/','')}</td>
                        <td>${value.error}</td>
                        <td class="text-nowrap">${value.responsable}</td>
                        <td class="text-nowrap"><span class="badge badge-danger" style="${styleEstado};${colorEstado}">${textoEstado}</span></td>
                    </tr>`;
                    
                    }
            }
        html+=`</tbody>`
        
    
}