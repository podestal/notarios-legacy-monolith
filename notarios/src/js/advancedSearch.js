

document.addEventListener('DOMContentLoaded',()=>{

    if(document.getElementById('btnFilterAdvanced')){
        btnFilterAdvanced.addEventListener('click', function(e){

            e.preventDefault();
            let tbl='';
            if(document.getElementById('tblListAdvancedSearch')){
                tbl = document.getElementById('tblListAdvancedSearch');
            }
            let url;
            if(document.getElementById('cmbTipoFiltro')){
                url = (cmbTipoFiltro.value==1)
                    ? document.getElementById('formFiltrarIndices').action
                    : '../models/getSearchExtraprotocolares.php'   
            }
            
            let form=document.getElementById('formFiltrarIndices');
            let datos=form.querySelectorAll('input,select,textarea');
            const objSearchAdvanced = {
                url,
                form,
                datos,
                tbl,
                typeFilter: document.getElementById('cmbTipoFiltro').value,
                idTable: 'tableListadoReportes',
                btnFilter: document.getElementById('btnFilterAdvanced'),
                loading: document.getElementById('loading'),
                htmlDraw: htmlAdvancedSearch,
            }
            // console.log(objSearchAdvanced);return false;
            let filterData = new Filter();
            filterData.getFilterData(objSearchAdvanced);
        })
    }
    

    if(document.getElementById('cmbTipoFiltro')){
        cmbTipoFiltro.addEventListener('change',()=>{

            if(cmbTipoFiltro.value==1){
                cmbAnioKardexIndice.removeAttribute('disabled')
                cmbTipoActo.removeAttribute('disabled')
                // txtNumeroDocumentoIndice.removeAttribute('disabled')
                txtNumeroEscrituraIndice.removeAttribute('disabled')
                txtNumeroKardexIndice.removeAttribute('disabled')
                cmbTipoKardexIndice.removeAttribute('disabled')
                tdFechaDoc.textContent = 'FecEscr.'
                tdEscrNum.textContent = 'N°Escr.'
            }else{
                cmbAnioKardexIndice.setAttribute('disabled','true')
                cmbTipoActo.setAttribute('disabled','true')
                // txtNumeroDocumentoIndice.setAttribute('disabled','true')
                txtNumeroEscrituraIndice.setAttribute('disabled','true')
                txtNumeroKardexIndice.setAttribute('disabled','true')
                cmbTipoKardexIndice.setAttribute('disabled','true')
                tdFechaDoc.textContent = 'DNI/RUC'
                tdEscrNum.textContent = 'N°'
            }
        })
    }
})


 
function htmlAdvancedSearch(registro,typeFilter){
    // console.log(registro)
        html=`<tbody>`
            for(let value of registro){ 

                let fechaAndDoc = (typeFilter == 1)
                                    ? (value.fecEscritura)
                                    : (value.fecEscritura).replace(/,,/g,'<br>')
                let contratantes = (typeFilter == 1)
                                    ? (value.contratantes)
                                    : (value.contratantes).replace(/,,/g,'<br>')

                html+=`<tr>
                    <td>${value.numEscAct}</td>
                    <td style="min-width:80px"><a href='${value.URL}' target='_blank'>${value.kardexAnio}</a></td>
                    <td>${fechaAndDoc}</td>
                    <td style="min-width:220px">${contratantes}</td>
                    <td style="min-width:200px">${value.actos}</td>
                    <td>${value.folioIn}</td>
                    <td>${value.folioFin}</td>
                    <td>${value.responsable}</td>
                    <td>${value.escaneo}</td>
                    <td>
                        <a href="#" title="ABRIR REGISTRO" target="_blank" onclick="abrirWord('${value.kardexAnio}','${value.anio}','${value.directorio}')">${value.registro}</a>
                        </td>
                </tr>`;
            }
        html+=`</tbody>`
    
}


// const change_page = (page)=>{

//     event.preventDefault();
//         if(document.getElementById('btnFiltrarIndices')){
//              btnFiltrarIndices.style.display='none';
//              loaderSeach.style.display='block';
//         }
//         let tbl='';
//         if(document.getElementById('tblListadoIndices')){
//             tbl=document.getElementById('tblListadoIndices');
//         }
//         let url=document.getElementById('formFiltrarIndices').action;
//         let form=document.getElementById('formFiltrarIndices');
//         let datos=form.querySelectorAll('input,select,textarea');
//         let filterIndices = new Indices();
//         filterIndices.advancedSearch(url,form,datos,tbl,page);

// }