<?php
include("../conexion.php");
    session_start();
    $idUsuario = $_SESSION["id_usu"];
    $sqlUsuario  = mysql_query("SELECT * FROM usuarios where idusuario = '$idUsuario'",$conn) or die(mysql_error());
	$rowUsuario= mysql_fetch_assoc($sqlUsuario);
	// print_r($rowUsuario['loginusuario']);return false;
?>
<style>
        .formSisnot{
            border-radius:13px;
            border:4px solid #264965;
            box-shadow: 0px 0px 5px #000000;
            min-height:900px;
        }
        .headSisnot{
            background: #264965;
            color:white;
            
        }
        .headSisnot h1{
            
            font-size:1.3em;
        }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Libs/bootstrap/css/bootstrap.min.css">
    <title>BUSQUEDA AVANZADA EXTRAPROTOCOLARES</title>
</head>
<body class="">
    <div class="container-fluid formSisnot">
        <div class="row headSisnot">
            <div class="col-md-12 text-center"><h1>BUSQUEDA AVANZADA EXTRAPROTOCOLARES</h1></div>        
        </div>
        <form action="../models/search_extraprotocolares.php" method="POST" id="formFiltrarExtraprotocolares">
        <div class="row">
            <div class="col-md-12 col-lg-2">
                <label for="" class="text-right">Filtro avanzado:</label>
            </div>
            <div class="col-md-6 col-lg-2">
                <label for="txtContratante">Cliente</label>
                <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar usuario" aria-label="Search" id="txtContratante" name="txtContratante" autocomplete="off">
            </div>
            <div class="col-md-3 col-lg-1">
                <label for="txtNumeroDocumento" class="active">Nro. Documento</label>
                <input type="text" class="form-control" name="txtNumeroDocumento" id="txtNumeroDocumento" value="">
            </div>
            <div class="col-md-3 col-lg-2" style="margin-top:24px">
                <button class="btn btn-info" type="submit" id="btnFiltrarExtraprotocolares">FILTRAR</button>
                <img id="loader" style="display: none" src="../loading.gif">
            </div>      
        </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tblListErrors">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center">KARDEX</th>
                                <th class="text-center text-nowrap">NRO. DOC.</th>
                                <th class="text-center">CONTRATANTES</th>
                                <th class="text-center">CONTRATO</th>
                            </tr>
                        </thead>
                        <tbody id="tblListadoExtraprotocolares" class="text-center">

                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    </div>

<script>
    class Extraprotocolares{
        constructor(){
            this.tbl='tblListadoExtraprotocolares';
        }
        
        filter_protocolares(url,form,datos,tbl){

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
            // console.log(url);return false;
            const request=new XMLHttpRequest();
            request.open('POST',url,true);
            request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
            request.send('datosSerializados='+datosSerializados);

            request.onload=function(){
                if (request.status>=200 && request.status<400) {
                    let data=request.responseText;
                    console.log(data)
                    let registro=JSON.parse(data);

                    if(document.getElementById('tblListadoExtraprotocolares')){
                        htmlExtraprotocolares(registro);
                    }
                    
                    tbl.innerHTML=html;
                    if(document.getElementById('btnFiltrarExtraprotocolares')){
                        btnFiltrarExtraprotocolares.style.display='block';
                        loader.style.display='none';
                    }
                    
                } else {
                    console.log(request.responseText);
                    console.log('No se pudo realizar el registro');
                    if(document.getElementById('btnFiltrarExtraprotocolares')){
                        btnFiltrarExtraprotocolares.style.display='block';
                        loader.style.display='none';
                    }
                }
            }
            request.onerror = function(){
                // alertify.error('Error de conexión en el servidor');
                console.log('error de conecion en el servidor')
                if(document.getElementById('btnFiltrarExtraprotocolares')){
                        btnFiltrarExtraprotocolares.style.display='block';
                        loader.style.display='none';
                    }
            }
        }

    }


    if(document.getElementById("btnFiltrarExtraprotocolares")){
		let btnFiltrarExtraprotocolares=document.getElementById('btnFiltrarExtraprotocolares');
		btnFiltrarExtraprotocolares.addEventListener('click',function(e){
			e.preventDefault();
			let tbl='';
			
            if(document.getElementById('btnFiltrarExtraprotocolares')){
                btnFiltrarExtraprotocolares.style.display='none';
                loader.style.display='block';
            }
            
            
			if(document.getElementById('tblListadoExtraprotocolares')){
				tbl=document.getElementById('tblListadoExtraprotocolares');
			}
			let url=document.getElementById('formFiltrarExtraprotocolares').action;
			let form=document.getElementById('formFiltrarExtraprotocolares');
			let datos=form.querySelectorAll('input,select,textarea');

			let filterIndices = new Extraprotocolares();
			filterIndices.filter_protocolares(url,form,datos,tbl);
		})
	}

    function htmlExtraprotocolares(registro){
        // console.log(registro)
        if(registro==''){
            html=`<tbody>
                    <tr>
                        <td colspan="7">NO HAY NINGUNA COINCIDENCIA</td>
                    </tr>
                </tbody>`;
        }else{
            
            let j=1;
            html=`<tbody>`   
            for(let value of registro){ 

                html+=`<tr>
                    <td>${j}</td>
                    <td><a  href="${value.url}" title="ABRIR REGISTRO" target="_blank" >${value.num}</a></td>
                    <td>${value.docs.replace(",,","<br>")}</td>
                    <td style="text-align:left">${value.cont.replace(",,","<br>")}</td>
                    <td>${value.deno}</td>
                </tr>`;
                j++;
            }   
            html+=`</tbody>` 
        }
    }
</script>
</body>
</html>