<?php
include("../conexion.php");
    session_start();
    $idUsuario = $_SESSION["id_usu"];
    $sqlUsuario  = mysql_query("SELECT * FROM usuarios where idusuario = '$idUsuario'",$conn) or die(mysql_error());
	$rowUsuario= mysql_fetch_assoc($sqlUsuario);
	// print_r($rowUsuario['loginusuario']);return false;
    if(isset($_GET['usuario'])){
        $usuario = $_GET['usuario'];
        // print_r($usuario);return false;
    }else{
        $usuario = $rowUsuario['loginusuario'];
    }
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
    <title>MIS ERRORES PDT</title>
</head>
<body>
    <div class="container-fluid formSisnot">
        <div class="row headSisnot">
            <div class="col-md-12 text-center"><h1>MIS ERRORES EN EL PDT NOTARIOS</h1></div>        
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tblListErrors">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center">KARDEX</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">ACTO</th>
                                <th class="text-center text-nowrap">DESCRIPCION DEL ERROR</th>
                                <th class="text-center">USUARIO</th>
                                <th class="text-center">ESTADO</th>
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
    class ErroresPDT{
        constructor(){
            this.tbl='tblListadoErroresPDT';
        }
        list(url,usuario){
            let tbl=this.tbl
            const request=new XMLHttpRequest();
            request.open('POST',url,true);
            request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
            request.send('usuario='+usuario);
            request.onload=function(){
                if(request.status>=200 && request.status<400){
                    let data=request.responseText;
                     let registro=JSON.parse(data);
                    // console.log(registro['renta'])
                    htmlErroresPDT(registro)

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
        }
    }
    document.addEventListener('DOMContentLoaded',()=>{
        if(document.getElementById("tblListadoErroresPDT")){
             let usuario = '<?php echo $usuario;?>'
            // console.log(usuario,'hola')
            let listErroresPDT = new ErroresPDT();
            listErroresPDT.list('buscar_errores_pdt.php',usuario)
        }
    })

    function htmlErroresPDT(registro){
        console.log(registro)
        if(registro==''){
            html=`<tbody>
                    <tr>
                        <td colspan="7">FELICIDADES NO TIENES NINGUN ERROR POR EL MOMENTO</td>
                    </tr>
                </tbody>`;
        }else{
            
            let j=1;
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
                            textoEstado = `TE QUEDAN ${20 - dias} dias`
                        }else if(dias < 15){
                            styleEstado = 'background:greenyellow'
                            colorEstado = 'color:green'
                            textoEstado = `QUEDAN ${20 - dias} dias`
                        }else{
                            styleEstado = 'background:tomato'
                            colorEstado = 'color:white'
                            textoEstado = `CORREGIR URGENTE`
                        }

                        html+=`<tr>
                            <td>${j}</td>
                            <td><a  href="../verkardex.php?kardex=${value.kardex}&id=${value.idkardex}" title="ABRIR REGISTRO" target="_blank">${value.kardex}</a></td>
                            <td>${value.fechaescritura}</td>
                            <td>${value.contrato}</td>
                            <td>${value.error}</td>
                            <td class="text-nowrap">${value.responsable}</td>
                            <td class="text-nowrap"><span class="badge badge-danger" style="${styleEstado};${colorEstado}">${textoEstado}</span></td>
                        </tr>`;
                        j++;
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
                            textoEstado = `TE QUEDAN ${20 - dias} dias`
                        }else if(dias < 15){
                            styleEstado = 'background:greenyellow'
                            colorEstado = 'color:green'
                            textoEstado = `QUEDAN ${20 - dias} dias`
                        }else{
                            styleEstado = 'background:tomato'
                            colorEstado = 'color:white'
                            textoEstado = `CORREGIR URGENTE`
                        }

                        html+=`<tr>
                            <td>${j}</td>
                            <td><a  href="../verkardex.php?kardex=${value.kardex}&id=${value.idkardex}" title="ABRIR REGISTRO" target="_blank">${value.kardex}</a></td>
                            <td>${value.fechaescritura}</td>
                            <td>${value.contrato}</td>
                            <td>${value.error}</td>
                            <td class="text-nowrap">${value.responsable}</td>
                            <td class="text-nowrap"><span class="badge badge-danger" style="${styleEstado};${colorEstado}">${textoEstado}</span></td>
                        </tr>`;
                        j++;
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
                            textoEstado = `TE QUEDAN ${20 - dias} dias`
                        }else if(dias < 15){
                            styleEstado = 'background:greenyellow'
                            colorEstado = 'color:green'
                            textoEstado = `QUEDAN ${20 - dias} dias`
                        }else{
                            styleEstado = 'background:tomato'
                            colorEstado = 'color:white'
                            textoEstado = `CORREGIR URGENTE`
                        }

                        html+=`<tr>
                            <td>${j}</td>
                            <td><a  href="../verkardex.php?kardex=${value.kardex}&id=${value.idkardex}" title="ABRIR REGISTRO" target="_blank">${value.kardex}</a></td>
                            <td>${value.fechaescritura}</td>
                            <td>${value.contrato}</td>
                            <td>${value.error}</td>
                            <td class="text-nowrap">${value.responsable}</td>
                            <td class="text-nowrap"><span class="badge badge-danger" style="${styleEstado};${colorEstado}">${textoEstado}</span></td>
                        </tr>`;
                        j++;
                        }
                }
            html+=`</tbody>`
            
        }
    }
</script>
</body>
</html>