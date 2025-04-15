class Filter{
    constructor(){
        this.tbl='tblListadoIndices';
    }
    getFilterData({url,form,datos,tbl,typeFilter=null,idTable,btnFilter,loading,htmlDraw}){

        btnFilter.style.display='none';
        loading.style.display='block';
        $("#"+idTable).dataTable().fnDestroy();

        let inputs={};
        for(const item of datos){
            let name=item.name;
            let value=item.value;
            if(item.getAttribute('type')=='checkbox'){
                inputs[name]=item.checked
            }else{
                inputs[name] = value;
            }
        }
        
        const datosSerializados=JSON.stringify(inputs);
     //    console.log(datosSerializados);return false;
        const request=new XMLHttpRequest();
        request.open('POST',url,true);
        request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
        request.send('datosSerializados='+datosSerializados);
        request.onload=function(){
            if (request.status>=200 && request.status<400) {
                let data=request.responseText;
                console.log(data)
                if(tbl){
                    let registro=JSON.parse(data);
                    console.log(registro)
                    htmlDraw(registro,typeFilter);
                    tbl.innerHTML=html; 
                    datatablesTotal(idTable)

                    btnFilter.style.display='block';
                    loading.style.display='none';
                 }
                
            } else {
                console.log(request.responseText);
                btnFilter.style.display='block';
                loading.style.display='none';
                
            }
        }
        request.onerror = function(){
            console.log('ERROR DE SERVIDOR')
            btnFilter.style.display='block';
            loading.style.display='none';
            
        }
    }
 }

 function abrirPdf(kardex,dir,anio){
    let url = '../controllers/openPdf.php?kardex='+kardex+'&directorio='+dir+'&anio='+anio;
    window.location.href = url
}


function abrirWord(kardex,anio,directorio){
	// if(kardex=='EXTRAPROTOCOLAR'){
	// 	kardex=orden
	// }
	
	event.preventDefault();
	let url = `../controllers/openWord.php?kardex=${kardex}&anio=${anio}&directorio=${directorio}`;
	window.location.href = url
}