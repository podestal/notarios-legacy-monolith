<?php
include("../conexion.php");
include("../models/get_tipo_acto.php");

    session_start();
    $idUsuario = $_SESSION["id_usu"];
    $sqlUsuario  = mysql_query("SELECT * FROM usuarios where idusuario = '$idUsuario'",$conn) or die(mysql_error());
	$rowUsuario= mysql_fetch_assoc($sqlUsuario);
	// print_r($rowUsuario['loginusuario']);return false;
    //print_r($arrayActos); return false;

?>

<link rel="stylesheet" href="stylesglobal.css">
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
        .table-reports{
            
            font-size:.85em;
        }
</style>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Libs/bootstrap/css/bootstrap.min.css">
    <title>Busqueda de Registros Protocolares</title>
</head>


<body class="cyan-skin">

    <div class="load" id="loader">


    <hr/><hr/><hr/><hr/>
    </div>
    <div class="load" id="loaderModal" style="z-index:3000;display: none">

    
    <hr/><hr/><hr/><hr/>
    </div>
    <div class="contenido"   id="contenido"  style="display: none">


<div class="container-fluid formSisnot">
  <div class="row headSisnot">
        <div class="col-md-12 text center"><h1>LISTA DE DOCUMENTOS PROTOCOLARES</h1>
        </div>
    </div>
  <form action = "../models/get_busqueda_protocolares.php"  method="POST" id="formFiltrarIndices">
    <div class="row">
          <div class="col-md-12 col-lg-2 justify-content-center">
            <div class="md-form pt-0 pb-4">
                <label for="" class="text-right">&nbsp;</label>
            </div>
            <div class="md-form pt-0 pb-4">
                <label for="" class="text-right">Filtro avanzado:</label>
            </div>
          </div>

          <div class="col-md-4 justify-content-center">
            <div class="md-form">
                <select class="form-control"  id="cmbTipoKardexIndice" name="cmbTipoKardexIndice">
                    <option value="0">TIPOS DE KARDEX:</option>
                    <option value="1">ESCRITURAS PUBLICAS</option>
                    <option value="2">ASUNTOS NO CONTENCIOSOS</option>
                    <option value="3">TRANSFERENCIAS VEHICULARES</option>
                    <option value="4">GARANTIAS MOBILIARIAS</option>
                    <option value="5">TESTAMENTOS</option>
                    
                </select>
            </div>
            <div class="md-form pt-0 pb-4">
                <label for="" class="text-right">&nbsp;</label>
            </div>
          </div>
          <div class="col-md-2 justify-content-cente1r">
            <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                <select class="form-control"  id="cmbAnioKardexIndice" name="cmbAnioKardexIndice">
                    <option value="0">AÑO:</option>
                    <option value="2021">2021</option for="txtBuscar\n">
                    <option value="2022">2022</option for="txtBuscar\n"></label>
                    <option value="2023">2023</option for="txtBuscar\n"></label>
                    <option value="2024">2024</option for="txtBuscar\n"></label>
                </select>
                
            </div>        
          </div>
          <div class="col-md-5 justify-content-cente1r">
            <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                <select class="form-control"  id="cmbTipoActo" name="cmbTipoActo" style="width:100%">
                    <option value="0">Tipo de Contrato:</option>
                    <?php
                    foreach($arrayActos AS $value){
                        echo ('<option value="'.$value['actos']['idActos'].'">'.$value['actos']['acto'].'</option>');
                    }
                    
                    ?>
                    
                </select>
                
            </div>
            <div class="md-form pt-0 pb-4">
                <label for="" class="text-right">&nbsp;</label>
            </div>
          </div>
          
          <div class="col-md-4  justify-content-center">
              <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
      
              <label for="txtBuscar\n">CLIENTE</label>
                  <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar contratante" aria-label="Search" id="txtNombreClienteIndice" name="txtNombreClienteIndice" autocomplete="off">
                  <i class="fa fa-search" aria-hidden="true" style="position:absolute;bottom:15px;right:15px;color:gray"></i>
              </div>
              <div class="md-form pt-0 pb-4">
                <label for="" class="text-right">&nbsp;</label>
            </div>
              
          </div>
          <div class="col-md-2 justify-content-center">
              <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
              <label for="txtBuscar">DNI</label>
                  <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar numero de documento" aria-label="Search" id="txtNumeroDocumentoIndice" name="txtNumeroDocumentoIndice" autocomplete="off">
                  
                  <i class="fa fa-search" aria-hidden="true" style="position:absolute;bottom:15px;right:15px;color:gray"></i>
              </div>
        
          </div>
          <div class="col-md-2 justify-content-center">
              <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
              <label for="txtBuscar">N° Escritura/Acta</label>
                  <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar numero de Escritura" aria-label="Search" id="txtNumeroEscrituraIndice" name="txtNumeroEscrituraIndice" autocomplete="off" echo str_pad($input, 10);>
                  
                  <i class="fa fa-search" aria-hidden="true" style="position:absolute;bottom:15px;right:15px;color:gray"></i>
              </div>
        
          </div>
          <div class="col-md-2 justify-content-center">
              <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
              <label for="txtBuscar">N° Kardex</label>
                  <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar numero de Escritura" aria-label="Search" id="txtNumeroKardexIndice" name="txtNumeroKardexIndice" autocomplete="off" echo str_pad($input, 10);>
                  
                  <i class="fa fa-search" aria-hidden="true" style="position:absolute;bottom:15px;right:15px;color:gray"></i>
              </div>
        
          </div>
          
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-6">
              <div class="md-form mt-2">
                  <button class="btn btn-success btn-block" type="submit" id="btnFiltrarIndices">BUSCAR <i class="fas fa-filter" aria-hidden="true" ></i></button>
                  <img id="loaderIndices" style="display: none" src="../loading.gif">
                  
              </div>
          </div>
    </div>
  </form>    
    <div class="row">
       <div class="col-md-12 ">
          <div class="table-responsive">
               <table class="table table-bordered table-responsive-m table-striped table-hover table-reports" id="tableListadoReportes"><h3>
                     <thead class="text-center">
                     <th style="background:silver;font-weight:bold" class=" text-nowrap">Nº Esc/Act</th>
                        <th style="background:silver;font-weight:bold" class=" text-nowrap">Kardex</th>
                        <th style="background:silver;font-weight:bold" class="">Fec. Escritura</th>
                        <th style="background:silver;font-weight:bold" class="">Contratantes</th>
                        <th style="background:silver;font-weight:bold" class="">Actos</th>
                        <th style="background:silver;font-weight:bold" class="">Folio Ini.</th>
                        <th style="background:silver;font-weight:bold" class="">Folio Fin</th>
                        <th style="background:silver;font-weight:bold" class="">Responsable</th>
                        <th style="background:silver;font-weight:bold" class="">Escaneo</th>
                    </thead>
                    <tbody id="tblListadoIndices" class="text-center">

                    </tbody>                    
                </table> 
            </div>
       </div>
    </div>
 
    </div>

</div></main>


</div>
<script>
    window.addEventListener('load',function(){
        // setTimeout(carga,3000);
        carga()
        function carga(){
            let loader = document.getElementById('loader')
            let contenido = document.getElementById('contenido')
            loader.style.display='none'
            contenido.style.display='block'
        }
    })
</script>

<script>

   class Indices{
   constructor(){
       this.tbl='tblListadoIndices';
   }
   filter_indices(url,form,datos,tbl){


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
               if(document.getElementById('btnFiltrarIndices')){
                    btnFiltrarIndices.style.display='block';
                    loaderIndices.style.display='none';
                }
            //  console.log(data)
               let registro=JSON.parse(data);

               if(document.getElementById('tblListadoIndices')){
                   htmlIndices(registro);

               }
               tbl.innerHTML=html;

               
               
           } else {
               console.log(request.responseText);
               // alertify.error('No se pudo realizar el registro');
               if(document.getElementById('btnFiltrarIndices')){
                    btnFiltrarIndices.style.display='block';
                    loaderIndices.style.display='none';
                }
               
           }
       }
       request.onerror = function(){
           console.log('ERROR DE SERVIDOR')
           // alertify.error('Error de conexión en el servidor');
           if(document.getElementById('btnFiltrarIndices')){
                    btnFiltrarIndices.style.display='block';
                    loaderIndices.style.display='none';
                }
           
       }
   }
}
    document.addEventListener('DOMContentLoaded',()=>{

     let btnFiltrarIndices=document.getElementById('btnFiltrarIndices');
     btnFiltrarIndices.addEventListener('click', function(e){
         e.preventDefault();
         console.log("funcionando1");

        if(document.getElementById('btnFiltrarIndices')){
            btnFiltrarIndices.style.display='none';
            loaderIndices.style.display='block';
        }
        
         let tbl='';


        if(document.getElementById('tblListadoIndices')){
            tbl=document.getElementById('tblListadoIndices');
        }



        let url=document.getElementById('formFiltrarIndices').action;
        let form=document.getElementById('formFiltrarIndices');
        let datos=form.querySelectorAll('input,select,textarea');

        let filterIndices = new Indices();
        filterIndices.filter_indices(url,form,datos,tbl);

     })

     cmbTipoActo.addEventListener('change',()=>{

        cmbTipoKardexIndice.value = 0
        cmbAnioKardexIndice.value = 0
        txtNombreClienteIndice.value = ''
        txtNumeroDocumentoIndice.value = ''
        txtNumeroEscrituraIndice.value = ''
        txtNumeroKardexIndice.value = ''

     })

     cmbTipoKardexIndice.addEventListener('change',()=>{
        cmbTipoActo.value = 0
     })
     cmbAnioKardexIndice.addEventListener('change',()=>{
        cmbTipoActo.value = 0
     })
     txtNombreClienteIndice.addEventListener('keyup',()=>{
        cmbTipoActo.value = 0
     })
     txtNumeroDocumentoIndice.addEventListener('keyup',()=>{
        cmbTipoActo.value = 0
     })
     txtNumeroEscrituraIndice.addEventListener('keyup',()=>{
        cmbTipoActo.value = 0
     })
     txtNumeroKardexIndice.addEventListener('keyup',()=>{
        cmbTipoActo.value = 0
     })
 
})
function abrirPdf(kardex,dir,anio){
	
	let url = '../abrir_documento_pdf.php?kardex='+kardex+'&directorio='+dir+'&anio='+anio;

	window.location.href = url
}

function htmlIndices(registro){
       console.log(registro)
       if(registro==''){
           html=`<tbody>
                   <tr>
                       <td colspan="12">NO SE ENCONTRARON RESULTADOS</td>
                   </tr>
               </tbody>`;
       }else{
           html=`<tbody>`
               for(let value of registro['bus']){ 
                   html+=`<tr>
                       <td>${value.numEscAct}</td>
                       <td><a href='${value.URL}' target='_blank'>${value.kardexAnio}</a></td>
                       <td>${value.fecEscritura}</td>
                       <td>${value.contratantes}</td>
                       <td>${value.actos}</td>
                       <td>${value.folioIn}</td>
                       <td>${value.folioFin}</td>
                       <td>${value.responsable}</td>
                       <td>${value.escaneo}</td>
                   </tr>`;
               }
           html+=`</tbody>`
       }
   }

</script>

</body>
</html>