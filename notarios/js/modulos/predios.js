function set_predios(kardex,formulario=null){

    let url = 'models/set_predios.php';
    let tbl;
    let tipoZona;
    let zona;
    let denominacion;
    let tipoVia;
    let nombreVia;
    let numero;
    let lote;
    let manzana;		

    if(formulario==2){
        
        tbl = 'tblPredios22'
        tipoZona = document.getElementById('txtTipoZonaPredio22').value
        zona = document.getElementById('txtZonaPredio22').value
        denominacion = document.getElementById('txtDenominacionPredio22').value
        tipoVia = document.getElementById('txtTipoViaPredio22').value
        nombreVia = document.getElementById('txtNombreViaPredio22').value
        numero = document.getElementById('txtNumeroPredio22').value
        lote = document.getElementById('txtLotePredio22').value
        manzana = document.getElementById('txtManzanaPredio22').value

    }else if(formulario==3){
        
        tbl = 'tblPredios3'
        tipoZona = document.getElementById('txtTipoZonaPredio3').value
        zona = document.getElementById('txtZonaPredio3').value
        denominacion = document.getElementById('txtDenominacionPredio3').value
        tipoVia = document.getElementById('txtTipoViaPredio3').value
        nombreVia = document.getElementById('txtNombreViaPredio3').value
        numero = document.getElementById('txtNumeroPredio3').value
        lote = document.getElementById('txtLotePredio3').value
        manzana = document.getElementById('txtManzanaPredio3').value

    }else{

        tbl = 'tblPredios'
        tipoZona = document.getElementById('txtTipoZonaPredio').value
        zona = document.getElementById('txtZonaPredio').value
        denominacion = document.getElementById('txtDenominacionPredio').value
        tipoVia = document.getElementById('txtTipoViaPredio').value
        nombreVia = document.getElementById('txtNombreViaPredio').value
        numero = document.getElementById('txtNumeroPredio').value
        lote = document.getElementById('txtLotePredio').value
        manzana = document.getElementById('txtManzanaPredio').value
        
    }
    

    if(nombreVia==''){
        Swal.fire({
            icon: 'error',
            title: 'El nombre de la via es requerida',
            // text: 'Llene el numero de document',
        })
        return false;
    }

    Swal.fire({
        title: 'Esta seguro de que quiere registrar el predio?',
        // text: "Advertencia: Solo se usa esta opcion si hubo un error en el envio de este resumen diario, si ya envió su resumen consulte primero el ticket",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, registrar'
    }).then((result) => {
        if (result.value) {
            const request=new XMLHttpRequest();
            request.open('POST',url,true);
            request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
            request.send('tipoVia='+tipoVia+'&nombreVia='+nombreVia+'&numero='+numero+'&lote='+lote+'&manzana='+manzana+'&kardex='+kardex+'&tipoZona='+tipoZona+'&zona='+zona+'&denominacion='+denominacion);
            request.onload=function(){
                if(request.status>=200 && request.status<400){
                    let data=request.responseText;
                    // console.log(data)
                    let registro=JSON.parse(data);
                    // console.log(registro)
                    if(registro['status']==false){
                        
                        //predio Ya registrado anteriormente
                        if(registro['codigo']==1062){
                            Swal.fire({
                                position: 'center',
                                type: 'error',
                                icon: 'error',
                                title: `${registro['codigo']}: El predio ya fue registrado anteriomente`,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }else{//OTRO ERRROR
                            Swal.fire({
                                position: 'center',
                                type: 'error',
                                icon: 'error',
                                title: `${registro['codigo']}: ${registro['mensaje']}`,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    }else{

                    // console.log(registro['renta'])
                        htmlPredios(registro)

                        if(document.getElementById(tbl)){
                            let tblListado = document.getElementById(tbl);
                            tblListado.innerHTML = html;
                        }
                    // ocultar_desc('predio3')
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
            Swal.fire({
                position: 'center',
                type: 'error',
                icon: 'error',
                title: 'Se cancelo el registro de predio',
                showConfirmButton: false,
                timer: 1500
            })
        }
    })       
}


function get_predios(formulario=null){

    let url = 'models/get_predios.php';
    
    let tbl;
    let tipoZona;
    let zona;
    let denominacion;
    let tipoVia;
    let nombreVia;
    let numero;
    let lote;
    let manzana;
    let inputs={};
    
    if(formulario==2){
        
        tbl = 'tblPredios22'
        tipoZona = document.getElementById('txtTipoZonaPredio22').value
        zona = document.getElementById('txtZonaPredio22').value
        denominacion = document.getElementById('txtDenominacionPredio22').value
        tipoVia = document.getElementById('txtTipoViaPredio22').value
        nombreVia = document.getElementById('txtNombreViaPredio22').value
        numero = document.getElementById('txtNumeroPredio22').value
        lote = document.getElementById('txtLotePredio22').value
        manzana = document.getElementById('txtManzanaPredio22').value

    }else if(formulario==3){
        
        tbl = 'tblPredios3'
        tipoZona = document.getElementById('txtTipoZonaPredio3').value
        zona = document.getElementById('txtZonaPredio3').value
        denominacion = document.getElementById('txtDenominacionPredio3').value
        tipoVia = document.getElementById('txtTipoViaPredio3').value
        nombreVia = document.getElementById('txtNombreViaPredio3').value
        numero = document.getElementById('txtNumeroPredio3').value
        lote = document.getElementById('txtLotePredio3').value
        manzana = document.getElementById('txtManzanaPredio3').value

    }else{

        tbl = 'tblPredios'
        tipoZona = document.getElementById('txtTipoZonaPredio').value
        zona = document.getElementById('txtZonaPredio').value
        denominacion = document.getElementById('txtDenominacionPredio').value
        tipoVia = document.getElementById('txtTipoViaPredio').value
        nombreVia = document.getElementById('txtNombreViaPredio').value
        numero = document.getElementById('txtNumeroPredio').value
        lote = document.getElementById('txtLotePredio').value
        manzana = document.getElementById('txtManzanaPredio').value
        
    }
    
    inputs = {
        
        txtTipoZonaPredio : tipoZona,
        txtZonaPredio : zona,
        txtDenominacionPredio : denominacion,
        txtTipoViaPredio : tipoVia,
        txtNombreViaPredio : nombreVia,
        txtNumeroPredio : numero,
        txtLotePredio : lote,
        txtManzanaPredio : manzana,

    };
    
    if(nombreVia==''){
        Swal.fire({
            icon: 'error',
            title: 'El nombre de la via es requerida',
            // text: 'Llene el numero de document',
        })
        return false;
    }
    
    const datosSerializados=JSON.stringify(inputs);
    const request=new XMLHttpRequest();
    request.open('POST',url,true);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
    request.send('datosSerializados='+datosSerializados);
    request.onload=function(){
        if(request.status>=200 && request.status<400){
            let data=request.responseText;
            // console.log(data)
            let registro=JSON.parse(data);
            // console.log(registro['renta'])
            htmlPredios(registro)

            if(document.getElementById(tbl)){
                let tblListado = document.getElementById(tbl);
                tblListado.innerHTML = html;
            }
            // ocultar_desc('predio3')
            
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

function list_predios(){

    let kardex = document.getElementById('codkardex').value;
    // console.log(kardex)
    let url = 'models/list_predios.php';

    const request=new XMLHttpRequest();
    request.open('POST',url,true);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
    request.send('&kardex='+kardex);
    request.onload=function(){
        if(request.status>=200 && request.status<400){
            let data=request.responseText;
            // console.log(data)
            let registro=JSON.parse(data);
            
            htmlPredios(registro)
            console.log(html)
            if(document.getElementById('tblPredios22')){
                let tblListado = document.getElementById('tblPredios22');
                tblListado.innerHTML = html;
            }
            if(document.getElementById('tblPredios3')){
                let tblListado = document.getElementById('tblPredios3');
                tblListado.innerHTML = html;
            }
            if(document.getElementById('tblPredios')){
                let tblListado = document.getElementById('tblPredios');
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


function htmlPredios(registro){
    console.log(registro)
    if(registro==''){
        html=`<tbody>
                <tr>
                    <td colspan="9">NO HAY NINGUN PREDIO</td>
                </tr>
            </tbody>`;
    }else{
        
        let j=1;
        html=`<tbody>`
            
            for(let value of registro['predio']){ 
                html+=`<tr>
                    <td>${j}</td>
                    <td>${value.tipoZona}</td>
                    <td>${value.zona}</td>
                    <td>${value.denominacion}</td>
                    <td>${value.tipoVia}</td>
                    <td>${value.nombreVia}</td>
                    <td>${value.numero}</td>
                    <td>${value.manzana}</td>
                    <td>${value.lote}</td>
                </tr>`;
                j++;
            }
            
        html+=`</tbody>`
        
    }
}