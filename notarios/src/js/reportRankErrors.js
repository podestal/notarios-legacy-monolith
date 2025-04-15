class RankingErroresPDT{
    constructor(){
        this.tbl='tblListadoErroresPDT';
    }
    list(url, year, autorizathion=false){
        year.setAttribute('disabled','true');
        loading.style.opacity='1';
        let tbl=this.tbl
        if (!sessionStorage.getItem('rankingData') || autorizathion) {
            const request=new XMLHttpRequest();
            request.open('POST',url,true);
            request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
            request.send('year='+year.value);
            request.onload=function(){
                if(request.status>=200 && request.status<400){
                    let data=request.responseText;
                    console.log('RANKING OBTENDIO DE LA BASE DE DATOS: ',data)
                    let registro=JSON.parse(data);
                    htmlRankingErroresPDT(registro)
                    sessionStorage.setItem('rankingData', JSON.stringify(registro));
                    if(document.getElementById(tbl)){
                        let tblListado = document.getElementById(tbl);
                        tblListado.innerHTML = html;
                        year.removeAttribute('disabled');
                        loading.style.opacity='0';
                    }
                }else{
                    let data=request.responseText;
                    console.log('No hubo respuesta')
                    console.log(data);
                    year.removeAttribute('disabled');
                    loading.style.opacity='0';
                }
            }
            request.onerror=function(){
                console.log('No hay conexion')
                year.removeAttribute('disabled');
                loading.style.opacity='0';
            }
        }else{
            // Recuperar los datos del almacenamiento y mostrarlos
            const data = JSON.parse(sessionStorage.getItem('rankingData'));
            console.log('RANKING OBTENDIO DE LA SESSION STORAGE: ',data)
            htmlRankingErroresPDT(data)
            if(document.getElementById(tbl)){
                let tblListado = document.getElementById(tbl);
                tblListado.innerHTML = html;
                year.removeAttribute('disabled');
                loading.style.opacity='0';
            }
        }
        
    }
}
document.addEventListener('DOMContentLoaded',()=>{

    if(document.getElementById("tblListadoErroresPDT")){
        let yearRankError = document.getElementById('cmbYearRankError')
        let listRankingErroresPDT = new RankingErroresPDT();
        listRankingErroresPDT.list('../models/getRankErrors.php',yearRankError)
    }

    if(document.getElementById("cmbYearRankError")){
        let yearRankError = document.getElementById('cmbYearRankError')
        yearRankError.addEventListener('change',()=>{
            yearRankError = document.getElementById('cmbYearRankError')
            let autorizathion = true;
            let listRankingErroresPDT = new RankingErroresPDT();
            listRankingErroresPDT.list('../models/getRankErrors.php',yearRankError,autorizathion)
        })
    }

    let formClose = document.getElementById('formClose');
    formClose.addEventListener('click',function(){

        const formSisnot = window.parent.document.getElementById('ranking');
        // let formSisnot = document.getElementById('formSisnot');
        // console.log(formClose)
        formSisnot.style.display='none'
        formSisnot.style.opacity='0'
        
    })
    
    const formSisnot = window.parent.document.getElementById('ranking');
    let countClick1 = 0;
    let n1=1;
    window.parent.document.addEventListener('click',()=>{
        countClick1 += 1;
        if(countClick1==(4*n1)){
            n1=n1+1
            formSisnot.style.display='block'
            formSisnot.style.opacity='1'
            
        }
        console.log(countClick1)
        
    })
        
})

function htmlRankingErroresPDT(registro){
    let j=1;
    html=`<tbody>` 
        for(let value of registro){
            html+=`<tr>
                <td style="padding:3px;text-align:left;font-size:.8em">${j}</td>
                <td style="padding:3px;text-align:left;font-size:.8em">${value.nombre.slice(0, 25)}</td>
                <td style="padding:3px;text-align:left;width:130px;font-size:.8em"><a href="reportErrors.php?usuario=${value.user}"  target="_blank"><img width="24px" src="../../imagenes/ver.jpg"></a>${value.total}</td>
            </tr>`;
            j++;
        }
    html+=`</tbody>`     
}