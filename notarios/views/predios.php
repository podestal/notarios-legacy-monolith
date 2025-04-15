<?php
include("../conexion.php");
    session_start();
    $idUsuario = $_SESSION["id_usu"];
    $sqlUsuario  = mysql_query("SELECT * FROM usuarios where idusuario = '$idUsuario'",$conn) or die(mysql_error());
	$rowUsuario= mysql_fetch_assoc($sqlUsuario);
	// print_r($rowUsuario['loginusuario']);return false;
?>
<style>
           .btnRadio{
        background: #557588 !important;
        margin-top:1em;
        padding:1.2em 1.3em;
        color:white;
        border-radius:10px 10px 0 0;
        cursor:pointer;
        /* display:block; */
    }
    .btnRadio:hover{
        background: #8AB7D2 !important;
    }
    .rbtnPredio{
        /* display:none; */
        position:relative;
        left:-20px;
    }
    table{
        font-size:.83em;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Libs/bootstrap/css/bootstrap.min.css">
    <title>PREDIOS</title> -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda de Registros Protocolares</title>
    <link rel="stylesheet" href="../src/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../src/assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../src/css/styles.css">
</head>
<body>
    <div class="container-fluid formSisnot">
        <div class="row headSisnot">
            <div class="col-md-12 text-center"><h1>LISTADO DE PREDIOS REGISTRADOS</h1></div>        
        </div>
        <div class="row">
            <div class="col-md-12 text-center menuPredio">
                <label for="rbtnPredioPropietario" class="btnRadio">BUSQUEDA POR PROPIETARIO</label>
                <input type="radio" id="rbtnPredioPropietario" name="rbtnPredio" class="rbtnPredio" checked>
                <label for="rbtnPredio" class="btnRadio">BUSQUEDA POR PREDIO</label>
                <input type="radio" id="rbtnPredio" name="rbtnPredio" class="rbtnPredio" >
            </div>        
        </div>
        <form action="../models/get_predios.php" method="POST" id="formFiltrarPredios" style="display:none">
            <div class="row">
                <div class="col-md-12 col-lg-2 justify-content-center">
                    <div class="md-form pt-0 pb-4">
                        <label for="" class="text-right">Filtro avanzado:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 justify-content-center">
                    <div class="md-form">
                        <select class="form-control"  id="txtTipoZonaPredio" name="txtTipoZonaPredio">
                            <option value="0">TIPO DE ZONA::.</option>
                            <option value="URB.">URBANIZACION</option>
                            <option value="BAR.">BARRIO</option>
                            <option value="VLL.">VILLA</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                        
                        <!-- <label for="txtBuscar"></label> -->
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="ZONA" aria-label="Search" id="txtZonaPredio" name="txtZonaPredio" autocomplete="off">
                    </div>
                    
                </div>
                <div class="col-md-6  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                        
                        <!-- <label for="txtBuscar"></label> -->
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="DENOMINACION" aria-label="Search" id="txtDenominacionPredio" name="txtDenominacionPredio" autocomplete="off">
                    </div>
                    
                </div>
                <div class="col-md-2 justify-content-center">
                    <div class="md-form">
                        <label for="">&nbsp;</label>
                        <select class="form-control"  id="txtTipoViaPredio" name="txtTipoViaPredio">
                            <option value="0">TIPO DE VIA::.</option>
                            <option value="AV.">AVENIDA</option>
                            <option value="JR.">JIRON</option>
                            <option value="CAL.">CALLE</option>
                            <option value="PQ.">PARQUE</option>
                            <option value="CAR.">CARRETERA</option>
                            <option value="PRO.">PROLONGACION</option>
                            <option value="PJ.">PASAJE</option>
                            <option value="PZA.">PLAZA</option>
                            <option value="GAL.">GALERIA</option>
                            <option value="ALM.">ALAMEDA</option>
                            <option value="BLV.">BULEVAR</option>
                            <option value="BL.">BLOQUE</option>
                            <option value="MLC.">MALECON.</option>
                            <option value="VIA.">VIA.</option>
                            <option value="OVL.">OVALO.</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                        
                        <label for="txtBuscar">&nbsp;</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="NOMBRE DE LA VIA" aria-label="Search" id="txtNombreViaPredio" name="txtNombreViaPredio" autocomplete="off">
                    </div>
                    
                </div>
                <div class="col-md-2  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                        
                        <label for="txtBuscar">&nbsp;</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="NUMERO" aria-label="Search" id="txtNumeroPredio" name="txtNumeroPredio" autocomplete="off">
                    </div>
                    
                </div>
                <div class="col-md-2  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                        
                        <label for="txtBuscar">&nbsp;</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="MANZANA" aria-label="Search" id="txtManzanaPredio" name="txtManzanaPredio" autocomplete="off">
                    </div>
                    
                </div>
                <div class="col-md-2  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                        
                        <label for="txtBuscar">&nbsp;</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="LOTE" aria-label="Search" id="txtLotePredio" name="txtLotePredio" autocomplete="off">
                    </div>
                    
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="md-form mt-2">
                        <label for="">&nbsp;</label>
                        <button class="btn btn-success btn-block" type="submit" id="btnFiltrarPredios">FILTRAR <i class="fas fa-filter" aria-hidden="true"></i></button>
                        <img id="loader1" style="display: none" src="../loading.gif">
                    </div>
                </div>
                <div class="col-md-8">
                    
                </div>
            </div>
        </form> 
        <form action="../models/get_predios_propietarios.php" method="POST" id="formFiltrarPrediosPropietarios">
            <div class="row">
                <div class="col-md-12 col-lg-2 justify-content-center">
                    <div class="md-form pt-0 pb-4">
                        <label for="" class="text-right">Filtro por propietario:</label>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="PROPIETARIO" aria-label="Search" id="txtPropietario" name="txtPropietario" autocomplete="off">
                    </div>
                </div>
   
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="md-form mt-2">
                        <label for="">&nbsp;</label>
                        <button class="btn btn-success btn-block" type="submit" id="btnFiltrarPrediosPropietarios">FILTRAR <i class="fas fa-filter" aria-hidden="true"></i></button>
                        <img id="loader2" style="display: none" src="../loading.gif">
                    </div>
                </div>
                <div class="col-md-8">
                    
                </div>
            </div>
        </form> 
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="tblListErrors">
                        <thead class="">
                            <tr>
                                <th class="titupatrimo bg-info text-center">KARDEX</th>
                                <th class="titupatrimo bg-info text-center">PROPIETARIO</th>
                                <th class="titupatrimo bg-info text-center">TIP.ZONA</th>
                                <th class="titupatrimo bg-info text-center">ZONA</th>
                                <th class="titupatrimo bg-info text-center">DENOMINACION</th>
                                <th class="titupatrimo bg-info text-center">TIP.VIA</th>
                                <th class="titupatrimo bg-info text-center">NOMBRE VIA</th>
                                <th class="titupatrimo bg-info text-center">NRO</th>
                                <th class="titupatrimo bg-info text-center">MZN</th>
                                <th class="titupatrimo bg-info text-center">LOTE</th>
                            </tr>
                        </thead>
                        <tbody id="tblListadoPredios" class="">

                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    </div>

<script src="../src/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../src/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../src/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../src/assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.js"></script>
<script src="../src/assets/plugins/datatables/datatables.bootstrap.min.js"></script>
<script src="../src/assets/plugins/datatables/extensions/Buttons/js/buttons.flash.js"></script>
<script src="../src/assets/bower_components/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../src/assets/bower_components/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="../src/assets/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="../src/assets/plugins/datatables/extensions/Buttons/js/buttons.print.js"></script>
<script src="../src/js/helpers.js"></script>
<script src="../src/js/pagination.js"></script>
<script>

class Predios{
	constructor(){
		this.tbl='tblListadoPredios';
	}
	filter_invoice(url,form,datos,tbl){
        $("#tblListErrors").dataTable().fnDestroy();
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
		// console.log(datosSerializados);return false;
		const request=new XMLHttpRequest();
		request.open('POST',url,true);
		request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
		request.send('datosSerializados='+datosSerializados);

		request.onload=function(){
			if (request.status>=200 && request.status<400) {
				let data=request.responseText;
				console.log(data)
                if(document.getElementById('btnFiltrarPredios')){
                    btnFiltrarPredios.style.display='block';
                    loader1.style.display='none';
                }
                if(document.getElementById('btnFiltrarPrediosPropietarios')){
                    btnFiltrarPrediosPropietarios.style.display='block';
                    loader2.style.display='none';
                }
				let registro=JSON.parse(data);

				if(document.getElementById('tblListadoPredios')){
					htmlPredios(registro);
				}
				tbl.innerHTML=html;
                datatablesTotal('tblListErrors')

				
			} else {
				console.log(request.responseText);
				// alertify.error('No se pudo realizar el registro');
                if(document.getElementById('btnFiltrarPredios')){
                    btnFiltrarPredios.style.display='block';
                    loader1.style.display='none';
                }
                if(document.getElementById('btnFiltrarPrediosPropietarios')){
                    btnFiltrarPrediosPropietarios.style.display='block';
                    loader2.style.display='none';
                }
				
			}
		}
		request.onerror = function(){
            console.log('ERROR DE SERVIDOR')
			// alertify.error('Error de conexión en el servidor');
            if(document.getElementById('btnFiltrarPredios')){
                btnFiltrarPredios.style.display='block';
                loader1.style.display='none';
            }
            if(document.getElementById('btnFiltrarPrediosPropietarios')){
                btnFiltrarPrediosPropietarios.style.display='block';
                loader2.style.display='none';
            }	
		}
	}


}

//instancias de clases
document.addEventListener('DOMContentLoaded',()=>{

	if(document.getElementById("btnFiltrarPredios")){
		let btnFiltrarPredios=document.getElementById('btnFiltrarPredios');
		btnFiltrarPredios.addEventListener('click',function(e){
			e.preventDefault();

            if(document.getElementById('btnFiltrarPredios')){
                btnFiltrarPredios.style.display='none';
                loader1.style.display='block';
            }
            

			let tbl='';
			if(document.getElementById('tblListadoPredios')){
				tbl=document.getElementById('tblListadoPredios');
			}
			let url=document.getElementById('formFiltrarPredios').action;
			let form=document.getElementById('formFiltrarPredios');
			let datos=form.querySelectorAll('input,select,textarea');

			let filterPredios = new Predios();
			filterPredios.filter_invoice(url,form,datos,tbl);
		})
	}
	if(document.getElementById("btnFiltrarPrediosPropietarios")){
		let btnFiltrarPrediosPropietarios=document.getElementById('btnFiltrarPrediosPropietarios');
		btnFiltrarPrediosPropietarios.addEventListener('click',function(e){
			e.preventDefault();

            if(document.getElementById('btnFiltrarPrediosPropietarios')){
                btnFiltrarPrediosPropietarios.style.display='none';
                loader2.style.display='block';
            }

			let tbl='';
			if(document.getElementById('tblListadoPredios')){
				tbl=document.getElementById('tblListadoPredios');
			}
			let url=document.getElementById('formFiltrarPrediosPropietarios').action;
			let form=document.getElementById('formFiltrarPrediosPropietarios');
			let datos=form.querySelectorAll('input,select,textarea');

            if(document.getElementById('txtPropietario').value==''){
                alert('Ingrese un propietario para buscar');
                if(document.getElementById('btnFiltrarPrediosPropietarios')){
                    btnFiltrarPrediosPropietarios.style.display='block';
                    loader2.style.display='none';
                }
                return false;
            }

			let filterPredios = new Predios();
			filterPredios.filter_invoice(url,form,datos,tbl);
		})
	}

    if(document.getElementById('rbtnPredioPropietario')){
        
       let rbtnPredioPropietario = document.getElementById('rbtnPredioPropietario');
       rbtnPredioPropietario.addEventListener('click',(e)=>{
            // console.log(rbtnPredio)
            // console.log(rbtnPredioPropietario)
            formFiltrarPrediosPropietarios.style.display='block'
            formFiltrarPredios.style.display='none'
       })
    }
    if(document.getElementById('rbtnPredio')){

       let rbtnPredio = document.getElementById('rbtnPredio');
        rbtnPredio.addEventListener('click',(e)=>{
            // console.log(rbtnPredio)
            // console.log(rbtnPredioPropietario)
            formFiltrarPrediosPropietarios.style.display='none'
            formFiltrarPredios.style.display='block'
        })
    }
})

function htmlPredios(registro){
        console.log('1:',registro)
    html=`<tbody>`
        for(let value of registro){ 
            html+=`<tr>
                <td><a href="${value.uri}" target="_blank">${value.kardex}</a></td>
                <td>${value.propietario}</td>
                <td>${value.tipoZona}</td>
                <td>${value.zona}</td>
                <td>${value.denominacion}</td>
                <td>${value.tipoVia}</td>
                <td>${value.nombreVia}</td>
                <td>${value.numero}</td>
                <td>${value.manzana}</td>
                <td>${value.lote}</td>
            </tr>`;
        }
    html+=`</tbody>`
        
    }

</script>
</body>
</html>