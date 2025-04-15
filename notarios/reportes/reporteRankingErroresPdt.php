<style>
        .formSisnot{
            border-radius:13px;
            border:4px solid #264965;
            box-shadow: 0px 0px 5px #000000;
            min-height:900px;
            /* font-size:.6em; */
            padding-right:15px !important;
            padding-left:15px !important;
            background:white;
        }
        .headSisnot{
            background: #264965;
            color:white;
            border-radius:5px;
            padding:.3em 0;
            /* font-size:1em; */
        }
        .headSisnot__close{
            /* font-size:1em; */
            color:tomato;
            cursor:pointer;
        }
        .headSisnot__title h4{
           
            font-size:.9em;
        }
        .bodySisnot table{
            font-size:.85em;
            padding:0;
        }
        .bodySisnot table th{
            font-size:.9em;
            /* padding:0; */
        }
        .bodyIframe{
            background:transparent !important;
        }
        .formClose{
            font-size:1.8em;
            color:tomato;
            /* font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; */
            cursor:pointer;
        }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="Libs/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="../Libs/bootstrap/css/bootstrap.min.css">
    <title>RANKING DE TRABAJADORES CON MAS ERRORES</title>
</head>

<body class="bodyIframe">
    <div class="container formSisnot" id="formSisnot">
        <div class="row headSisnot" style="display:flex;justify-content:space-between; align-items:center">
            <!-- <div class="col-md-12 text-center headSisnot__title"><h4>RANKING DE TRABAJADORES <br>CON MAS ERRORES</h4></div>         -->
            <div class="text-center headSisnot__title"><h4>RANKING DE TRABAJADORES CON MAS ERRORES</h4></div>
            <div class="col-md-1 formClose" id="formClose">X</div>    
        </div>
        <div class="row bodySisnot">
            <div class="">
                <div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tblListErrors">
                        <thead>
                            <tr>
                                <th style="padding:3px;" class="text-center">N°</th>
                                <th style="padding:3px;" class="text-center">TRABAJADOR</th>
                                <th style="padding:3px;" class="text-center">ERROR</th>
                                <!-- <th class="text-center">ACCION</th> -->
                            </tr>
                        </thead>
                        <tbody id="tblListadoErroresPDT" class="text-center">

                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    </div>
<script>
    class RankingErroresPDT{
        constructor(){
            this.tbl='tblListadoErroresPDT';
        }
        list(url,usuario){
            let tbl=this.tbl
            if (!sessionStorage.getItem('rankingData')) {
                const request=new XMLHttpRequest();
                request.open('POST',url,true);
                request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
                request.send('usuario='+usuario);
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
                        }
                    }else{
                        let data=request.responseText;
                        console.log('No hubo respuesta')
                        console.log(data);
                    }
                }
                request.onerror=function(){
                    console.log('No hay conexion')
                }
            }else{
                // Recuperar los datos del almacenamiento y mostrarlos
                const data = JSON.parse(sessionStorage.getItem('rankingData'));
                console.log('RANKING OBTENDIO DE LA SESSION STORAGE: ',data)
                htmlRankingErroresPDT(data)
                if(document.getElementById(tbl)){
                    let tblListado = document.getElementById(tbl);
                    tblListado.innerHTML = html;
                }
            }
            
        }
    }
    document.addEventListener('DOMContentLoaded',()=>{

        if(document.getElementById("tblListadoErroresPDT")){
            let listRankingErroresPDT = new RankingErroresPDT();
            listRankingErroresPDT.list('buscar_ranking_errores_pdt.php')
        }
   
        let formClose = document.getElementById('formClose');
        formClose.addEventListener('click',function(){
            let formSisnot = document.getElementById('formSisnot');
            console.log(formClose)
            formSisnot.style.display='none'
            formSisnot.style.opacity='0'
            
        })
        

        let countClick1 = 0;
        let n1=1;
        document.addEventListener('click',()=>{
            countClick1 += 1;
            if(countClick1==(3*n1)){
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
                    <td style="padding:3px;width:130px;font-size:.8em"><a href="reporteErroresPDT.php?usuario=${value.user}"  target="_blank"><img width="24px" src="../imagenes/ver.jpg"></a>${value.total}</td>
                </tr>`;
                j++;
            }
        html+=`</tbody>`     
    }

    function verErrores(usuario){
        let url = `reporteErroresPDT.php?usuario=${usuario}`;
        window.location.href = url
     }
</script>
</body>
</html>