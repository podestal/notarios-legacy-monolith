document.addEventListener('DOMContentLoaded',()=>{

    if(document.getElementById('btnFilterCorrelativePending')){
        const btnFilter = document.getElementById('btnFilterCorrelativePending')
        btnFilter.addEventListener('click', function(e){

            e.preventDefault();
            let tbl='';
            if(document.getElementById('tblListCorrelativePending')){
                tbl = document.getElementById('tblListCorrelativePending');
            }
            
            if(txtDateFromCorrelative.value == "" || txtDateFromCorrelative.value == "")
            {
                alert("Debe seleccionar un rango de Fechas válido");return false;	
            }	

            let url = document.getElementById('formCorrelativePending').action
            let form=document.getElementById('formCorrelativePending');
            let datos=form.querySelectorAll('input,select,textarea');
            const objSearchAdvanced = {
                url,
                form,
                datos,
                tbl,
                typeFilter: document.getElementById('cmbTipoFiltro') && document.getElementById('cmbTipoFiltro').value,
                idTable: 'tableListadoReportes',
                btnFilter,
                loading: document.getElementById('loading'),
                htmlDraw: htmlCorrelativePending,
            }
            // console.log(objSearchAdvanced);return false;
            let filterData = new Filter();
            filterData.getFilterData(objSearchAdvanced);
        })
    }
    
})

 
const htmlCorrelativePending = (registro) => {
    // console.log(registro)
        let i = 1;
        html=`<tbody>`
            for(let value of registro){ 
                html+=`<tr>
                    <td>${i}</td>
                    <td>${value.tipoKardex}</td>
                    <td>${value.numeroEscritura}</td>
                    <td>${value.escaneo}</td>
                    <td>${value.registro}</td>
                </tr>`;
                i++;
            }
        html+=`</tbody>`
    
}