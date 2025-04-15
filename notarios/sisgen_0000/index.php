<?php
require_once 'conexion.php';
$sql = "SELECT apellido FROM confinotario LIMIT 1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$notario = $row['apellido'];
?>



<!DOCTYPE html>
<html>
<head>
	<title>SISGEN - BASE CENTRALIZADA</title>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../Libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
    <link href="dist/css/select2.min.css" rel="stylesheet" />

    <style type="text/css">
        .guardado{
            color: green;
            font-weight: bold;
        }
        .fallido{
            color: red;
            font-weight: bold;
        }
        .observado{
            color: #ff7b1e;
            font-weight: bold;
        }
        .mensaje-envio{
            color: red;
        }
    </style>
</head>
<body>
<br>
<div class="container">
	<div class="row">

		<div class="col-sm-2">
			<h3 style="">SISNOT ENVIO V1.13</h3>
		</div>
		<div class="col-sm-6">
			
		</div>
		<div class="col-sm-4">
            <h3>NOTARIA: <?php echo $notario; ?></h3>
        </div>
		
	</div>
	<div class="row">
		
		<div class="col-sm-12">
			<nav class="navbar navbar-inverse" style="background-color: #184d71;border-color: #184d71;"> 
				<div class="container-fluid"> 
					<div class="navbar-header">
					 <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false"> 
					 	<span class="sr-only">Toggle navigation</span> 
					 	<span class="icon-bar"></span> 
					 	<span class="icon-bar"></span>
					 	 <span class="icon-bar"></span> 
					 <!--</button> <a href="#" class="navbar-brand">ESCRITURAS</a>--> </div>
					  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9"> 
					  	<ul class="nav navbar-nav"> 
					  		<li id="navEscritura" class="active"><a  href="javascript:;" id="mnuEscritura">ESCRITURAS</a></li> 
					  		<li id="navTransferencia" ><a href="javascript:;" id="mnuTransferencia">TRANSFERENCIAS</a></li> 
					  		<li id="navGarantia"><a href="javascript:;" id="mnuGarantia">GARANTIAS</a></li> 
					  		<li id="navNoContencioso"><a href="javascript:;" id="mnuNoContencioso">NO CONTENCIOSOS</a></li>
                            <!--<li id="navTestamento"><a href="javascript:;" id="mnumTestamento">TESTAMENTOS</a></li>-->

					  		<li id="navLibro"><a href="javascript:;" id="mnuLibro">LIBROS</a></li>
					  	 </ul> 
					  </div>
				</div>
	 		</nav>
		</div>
		
	</div>
	<div class="row">
		<div class="col-sm-12">
            <div style="border-bottom: 2px solid #e0e0e0;">
                 <h3 id="tituloTipoDocumento" style="color:#f28b3c;font-family: Arial, Helvetica, sans-serif;font-weight: bold;">Escrituras Públicas</h3>
            </div>
           
        </div>
		
	</div>
    <br>
	<div class="row">
		<div class="col-sm-1">
			
		</div>
		<div class="col-sm-1">
			<label>Desde:</label>
		</div>
		<div class="col-sm-3">
			<input type="date" id="fechaDesde" class="form-control" name="">
		</div>
		<div class="col-sm-1">
			<label>Hasta:</label>
		</div>
		<div class="col-sm-3">
			<input type="date" id="fechaHasta" class="form-control" name="">
		</div>
		<div class="col-sm-1">
			<button class="btn btn-primary" id="btnBuscarE">Buscar</button>
		</div>
		<div class="col-sm-1">
			
		</div>
	</div>
		<div class="row">
		<section>
        <div class="wizard">
            <div class="wizard-inner" style="display: none;">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li id="step-documentos" role="presentation" class="disabled">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Documentos Notariales">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Validaciones">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-hourglass"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="XML">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-equalizer"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Reporte de Envios">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-check"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
		
            <form role="form">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                         <div class="row">
                            <div class="col-sm-1">
                               <label>Estado:</label> 
                            </div>
                            <div class="col-sm-2">
                                 <select id="cmbEstado" class="form-control">
                                    <option value="-1">Todos</option>
                                    <option value="0">No Enviados</option>
                                    <option value="1">Enviados</option>
                                    <option value="2">Enviados (Observados)</option>
                                    <option value="3">No Enviados (Fallidos)</option>
                                    <option value="4">No codificados</option>
                                    <option value="5">Inst. No Registrados</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select class="list-actos form-control">
                                    

                                </select>
                            </div>
                            <div class="col-sm-4">          
                                <a id="btn-enviar-todos" href="javascript:;" class="btn btn-danger"><span class="glyphicon glyphicon-cloud-upload"></span> Enviar Todos al Sisgen</a>
                            </div>
                        </div>
                       
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step" style="display: none;">Validar Informacion</button></li>
                        </ul>
                        <br>
                        <div id="idProtocolar" >
                            <div id="divErrores" style="display: none;position: relative;height: 300px;overflow: auto;">
                                <h3 id="totalErrores">  Errores encontrados(Estos kardex no son enviados)</h3>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Kardex</th>
                                            <th>Acto</th>
                                            <th>Error</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblErrores">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <h3 id="totalObservaciones" style="display: none;position: relative;overflow: auto;">  Observaciones (Estos kardex se consideran en el envío)</h3>
                            <div id="divObservaciones" style="display: none;position: relative;height: 250px;overflow: auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Kardex</th>
                                            <th>Acto</th>
                                            <th>Error</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblObservaciones">
                                        
                                    </tbody>
                                </table>
                            </div> 
                            <h3 style="display: none;" id="totalDocumentosNotariales"></h3>
                            
                            <div id="protocolar" style="display: block;position: relative;height: 500px;overflow: auto;">
                            <br>
                                <div id="msgError" style="display: none;" class="alert alert-warning">No se encontraron Escrituras Públicas</div>
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Kardex</th>
                                            <th>Num.Instr.</th>
                                            <th>Fec. de Instr.</th>
                                            <th width="9%">Cod. Sisgen</th>
                                            <th>Acto Sunat</th>
                                            <th>Acto Uif</th>
                                            <th>Estado Sisgen</th>
                                            <th width="30%">Contrato</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>                                        
                                        </tr>
                                    </thead>
                                    <tbody id="tblDocumentoNotariales">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                        <div id="extraprotocolar" style="display: none;">
                            <h3 style="display: none;" id="totalLibrosContables"></h3>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th># Cronol.</th>
                                        <th>Tip. Per</th>
                                        <th>Ruc</th>
                                        <th width="25%">Cliente</th>
                                        <th width="25%">Tipo de Libro</th>
                                         <th >Estado Sisgen</th>
                                         <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="tblExtraprotocolar">
                                    
                                </tbody>
                            </table>
                        </div>
                        

                        
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <h3>Step two</h3>
                        
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Atraz</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Generar XML</button></li>
                        </ul>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Kardex</th>
                                    <th>Num.Instr.</th>
                                    <th>Fec. de Instr.</th>
                                    <th width="30%">Contrato</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Step three</h3>
                        <p>Third step</p>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Atras</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Enviar a la Base Centraliza</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Complete steps</h3>
                        <p>You have successfully completed every steps.</p>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Atraz</button></li>
                            <!--<li><button type="button" class="btn btn-primary btn-info-full next-step">Submit</button></li>-->
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
   </div>
</div>


<div id="modal-correct-errors" class="modal fade">
    <div id="modal-dialog-correct-errors" class="modal-dialog modal-sm">
        <div class="modal-content">

            <div id="modal-delete-header" class="modal-header" style="display:none;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">MENSAJE AL USUARIO</h4>
            </div>

            <div  class="modal-body">
                <input id="txt-pk-type-user" type="hidden" />
                <div id="modal-delete-body" style="display:none;">¿Estas seguro que deseas autocorregir los <span id="modal-total-errors" ></span> errores?</div>

                <div id="msg-correct-error" class="alert alert-success" style="display:none;">
                    <span id="icon-delete-type-user" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <span id="msg"></span>
                </div>
                <div id="error-xml-sisgen" style="display: none;" class="alert alert-danger">
                    <span class='letraerror'> Error Interno del XML </span><span class='letraerror'>
                    <a target='blank' href='erroresSISGEN.xml' download='erroresSisgen.xml'>(Ver Errores)</a>
                    <div id="error-xml-detalle"></div>
                </span>
                </div>
                
                <div id="loading-delete-correct-error">
                   <div class="loader"></div>
                   <div style="text-align: center;"><b id="text-loader">CARGANDO INFORMACION...</b></div>
                  
                </div>

                <div class="table-resposive" id="container-table-error"  style="display: none;height:350px;overflow-x: auto;">
                    <table class="table table-hover" id="tblResponse">
                        <thead id="tprotocolares">
                            <th>Nº</th>
                            <th>Kardex</th>
                            <th>Contrato</th>
                            <th>Estado</th>
                            <th>Mensaje</th>
                        </thead>
                        <thead id="tlibros" style="display: none;">
                            <th>Nº</th>
                            <th>Nº Cronol.</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Mensaje</th>
                            <th>Respuesta</th>
                        </thead>
                        <tbody id="tblErrors">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="modal-delete-ok" style="text-align:right;display:none;">
                    <button id="close" type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>

            </div>



            <div id="modal-delete-footer" class="modal-footer" style="display:none;">
                <a id="btn-yes-correct-errors" type="button" class="btn btn-success">SI</a>
               
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE CODIFICAR ACTO-->
<div id="modal-code-act" class="modal fade">
    <div id="modal-dialog-correct-errors" class="modal-dialog modal-lg">
        <div class="modal-content">

            <div id="modal-delete-header" class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">CONFIGURACION DE ACTO</h4>
            </div>

            <div  class="modal-body">
                <fieldset>
                    <legend style="color:#e21f1f;font-weight: bold;">Acto</legend>

                   
                        <div class="row">
                        <div class="col-sm-2"><label>Contrato:</label></div>
                        <div class="col-sm-6">
                            <select id="cmbActos" class="form-control">
                                <option value="0">Seleccionar Acto</option>
                            </select>
                            <input type="hidden" id="txtCodTipoActo" name="">
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-3">
                                <button class="btn btn-primary" id="btnGuardarActo">Guardar Cambios Acto</button>
                        </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><label>UIF:</label></div>
                            <div class="col-sm-2">
                                <input type="text" id="codUif"  class="form-control" name="">
                            </div>
                            <div class="col-sm-1"><label>SUNAT:</label></div>
                            <div class="col-sm-2">
                                <input type="text" id="codSunat" class="form-control" name="">
                            </div>
                            <div class="col-sm-1"><label>CNL(BC):</label></div>
                            <div class="col-sm-2">
                                <input type="text" style="background: #baffb2;" id="codCnl" class="form-control" name="">
                            </div>
                        </div>
                        <br>
                       
                        
                        
                    
                </fieldset>
                <fieldset>
                    <legend style="color:#e21f1f;font-weight: bold;">Condición</legend>
                   
                        <div class="row">
                        <div class="col-sm-2"><label>Condicion:</label></div>
                        <div class="col-sm-4">
                            <input type="hidden" id="txtIdCondicion" name="">
                            <input type="text" id="condicion" class="form-control" name="">
                        </div>
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3">
                               
                        </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><label>PARTE:</label></div>
                            <div class="col-sm-2">
                                <select id="parte" class="form-control">
                                    <option value="-1">Selecciona</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="col-sm-1"><label>UIF:</label></div>
                            <div class="col-sm-2">
                                <select id="uif" class="form-control">
                                    <option value="-1">Selecciona</option>
                                    <option value="O">O</option>
                                    <option value="B">B</option>
                                    <option value="G">G</option>
                                    <option value="R">R</option>
                                    <option value="N">N(Testigos,Interviniente)</option>
                                </select>
                            </div>
                            <div class="col-sm-1"><label>MONTO:</label></div>
                            <div class="col-sm-2">
                                <select id="montop" class="form-control">
                                    <option value="-1">Selecciona</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2"><label>Codigo Sisgen:</label></div>
                            <div class="col-sm-2">
                                <input type="text" id="codigoCnl" style="background: #baffb2;" class="form-control" name="">
                            </div>

                             <div class="col-sm-4">
                                <button id="btnGuardarCondicion" class="btn btn-success">Guardar Condicion</button>
                                <button id="btnCancelar" style="display: none;" class="btn btn-danger">Cancelar</button>
                            </div>
                           
                        </div>
                       
                        
                        
                  
                </fieldset>  
                 <fieldset>
                    <legend style="color:#e21f1f;font-weight: bold;">Lista de Condiciones</legend>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-resposive" style="height: 250px;overflow-y: auto;">
                                <table id="tblCondiciones" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Condicion</th>
                                            <th>Parte</th>
                                            <th>UIF</th>
                                            <th>Monto</th>
                                            <th>Codigo Sisgen</th>
                                            <th></th>
                                        </tr>

                                    </thead>
                                    <tbody id="tbl-list-condiciones">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                 </fieldset>    
            </div>



            <div id="modal-delete-footer" class="modal-footer" style="display:none;">
                <a id="btn-yes-correct-errors" type="button" class="btn btn-success">SI</a>
               
            </div>
        </div>
    </div>
</div>


<script src="../Libs/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="../Libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="dist/js/select2.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
         /*$('#modal-correct-errors').modal({'show':true,"backdrop"  : "static",
             "keyboard"  : true});*/
        tipoInstrumento = 1;
        accion = 1;     
        $('.list-actos').select2();    


        loadActos(tipoInstrumento);

        $('#mnuEscritura').on('click',function(e){

            $('#tituloTipoDocumento').text('Escrituras Públicas');
            tipoInstrumento = 1;
            loadActos(tipoInstrumento);
            $('#idProtocolar').show();
            $('#totalDocumentosNotariales').show();
            $('#divErrores').show();
            $('#extraprotocolar').hide();
            $('#navTestamento').removeClass('active');
            $('#navEscritura').addClass('active');
            $('#navTransferencia').removeClass('active');
            $('#navGarantia').removeClass('active');
            $('#navNoContencioso').removeClass('active');
            $('#navLibro').removeClass('active');

        });
        $('#mnuTransferencia').on('click',function(e){

            $('#tituloTipoDocumento').text('Transferencias Vehiculares');
            tipoInstrumento = 3;
            loadActos(tipoInstrumento);
            $('#idProtocolar').show();
            $('#totalDocumentosNotariales').show();
            $('#divErrores').show();
            $('#extraprotocolar').hide();
            $('#navTransferencia').addClass('active');
            $('#navTestamento').removeClass('active');
            $('#navEscritura').removeClass('active');
            $('#navGarantia').removeClass('active');
            $('#navNoContencioso').removeClass('active');
            $('#navLibro').removeClass('active');
        });
        $('#mnuGarantia').on('click',function(e){
            $('#tituloTipoDocumento').text('Garantias Mobiliarias');
            tipoInstrumento = 4;
            loadActos(tipoInstrumento);
            $('#idProtocolar').show();
            $('#extraprotocolar').hide();
            $('#totalDocumentosNotariales').show();
            $('#divErrores').show();
            $('#navGarantia').addClass('active');
            $('#navEscritura').removeClass('active');
            $('#navTransferencia').removeClass('active');
            $('#navNoContencioso').removeClass('active');
            $('#navTestamento').removeClass('active');
            $('#navLibro').removeClass('active');
        });

         $('#mnumTestamento').on('click',function(e){
            $('#tituloTipoDocumento').text('Testamentos');
            tipoInstrumento = 5;
            loadActos(tipoInstrumento);
            $('#idProtocolar').show();
            $('#extraprotocolar').hide();
            $('#totalDocumentosNotariales').show();
            $('#divErrores').show();
            $('#navTestamento').addClass('active');
            $('#navGarantia').removeClass('active');
            $('#navEscritura').removeClass('active');
            $('#navTransferencia').removeClass('active');
            $('#navNoContencioso').removeClass('active');
            $('#navLibro').removeClass('active');
        });



        $('#mnuNoContencioso').on('click',function(e){
            $('#tituloTipoDocumento').text('No Contenciosos');
            tipoInstrumento = 2;
            loadActos(tipoInstrumento);
            $('#idProtocolar').show();
            $('#extraprotocolar').hide();
            $('#totalDocumentosNotariales').show();
            $('#divErrores').show();
            $('#navNoContencioso').addClass('active');
            $('#navEscritura').removeClass('active');
            $('#navGarantia').removeClass('active');
            $('#navTransferencia').removeClass('active');
            $('#navLibro').removeClass('active');
            $('#navTestamento').removeClass('active');

        });
        $('#mnuLibro').on('click',function(e){
            $('#tituloTipoDocumento').text('Libros Contables');
            tipoInstrumento = 0;
            $('#idProtocolar').hide();
            $('#extraprotocolar').show();
            $('#navLibro').addClass('active');
            $('#navEscritura').removeClass('active');
            $('#navGarantia').removeClass('active');
            $('#navTransferencia').removeClass('active');
            $('#navNoContencioso').removeClass('active');
            $('#navTestamento').removeClass('active');
        });

    //Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip(); 
	    $('.nav-tabs > li a[title]').tooltip();

	    
	    //Wizard
	    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

	        var $target = $(e.target);
	    
	        if ($target.parent().hasClass('disabled')) {
	            return false;
	        }
	    });


	    $(".next-step").click(function (e) {

	        var $active = $('.wizard .nav-tabs li.active');
	        $active.next().removeClass('disabled');
	        nextTab($active);

	    });
	    $(".prev-step").click(function (e) {

	        var $active = $('.wizard .nav-tabs li.active');
	        prevTab($active);

	    });





	});

	function nextTab(elem) {
	    $(elem).next().find('a[data-toggle="tab"]').click();
	}
	function prevTab(elem) {
	    $(elem).prev().find('a[data-toggle="tab"]').click();
	}

	$('#btnBuscarE').on('click',function(e){
		if(tipoInstrumento != 0){
            loadData();
        }else{
            loadDataLibro();
        }

	});
    $('#cmbEstado').on('change',function(){
        if(tipoInstrumento != 0){
            loadData();
        }
        
    });

    $('.list-actos').on('change',function(){
        loadData();
    });

    function loadActos(tipoInstrumento){
        $.ajax({
            url:'get_list_actos.php',
            dataType:'json',
            type:'POST',
            data:{idTipoKardex:tipoInstrumento},
            success:function(response){
                $('.list-actos option').remove();
                html = '<option value="0" selected="selected">Todos</option>';
                data = response.data;
                for(i in data){
                    html = html +'<option value="'+data[i].idtipoacto+'">'+data[i].desacto+'</option>';
                }
                $('.list-actos').append(html);
            }
        }); 
    }

    function loadData(){
        $('#loading-delete-correct-error').show();
        $('#divErrores').hide();        
        $('#text-loader').text('CARGANDO INFORMACION...');
        $('#totalObservaciones').hide(); 
        $('#modal-dialog-correct-errors').removeClass('modal-lg');
        $('#modal-dialog-correct-errors').addClass('modal-sm');
        $('#modal-delete-header').hide();
        $('#error-xml-sisgen').hide();
        $('#container-table-error').hide();
        $('#tblDocumentoNotariales tr').remove();
        $('#tblErrores tr').remove();
        $('#tblObservaciones tr').remove();
        fechaDesde = $('#fechaDesde').val();
        fechaHasta = $('#fechaHasta').val();
        $('#msgError').hide();
        $('#totalDocumentosNotariales').hide();
        estado = $('#cmbEstado').val();
        codigoActo = $('.list-actos').val();
        $.ajax({
            url:'buscar_documentos_notariales.php',
            dataType:'json',
            type:'POST',
            data:{fechaDesde:fechaDesde,fechaHasta:fechaHasta,tipoInstrumento:tipoInstrumento,estado:estado,codigoActo:codigoActo},
            beforeSend:function(){
                $('#modal-correct-errors').modal({'show':true,"backdrop"  : "static",
                 "keyboard"  : true});
            },
            success:function(response){
                html = '';
                html2 = '';
                list = response.data;
                listerror = response.errores==null?[]:response.errores;
                listObservaciones = response.observaciones==null?[]:response.observaciones;
                 $('#modal-correct-errors').modal('hide');
                if(list.length == 0){
                    $('#msgError').text('No se encontraron '+$('#tituloTipoDocumento').text());
                    $('#msgError').show();
                }else{
                    var x = 1;
                    $('#totalDocumentosNotariales').text(response.total+' '+$('#tituloTipoDocumento').text()+' encontradas');
                    $('#totalDocumentosNotariales').show();
                    for(i in list){
                        codAncert = list[i].cod_ancert;
                        codActos = list[i].codactos;
                        classRow = '';
                        sunat = '<a href="javascript:;" data-toggle="tooltip" data-placement="top" title="Compra y venta">'+list[i].actosunat+'</a>';
                        uif = list[i].actouif;
                        if(codAncert == ''){
                            codAncert = '';
                            classRow = 'warning';
                        }else
                        if(codAncert == '-1'){
                           // codAncert = '<a class="show-cod-ancert" data-codactos="'+codActos+'" href="javascript:;"><span style="font-size:20px;color:red;" class="glyphicon glyphicon-cog"></span></a>';
                            classRow = 'danger';
                        }else if(codAncert == '-2'){
                           // codAncert = '<a class="show-cod-ancert" data-codactos="'+codActos+'" href="javascript:;"><span style="font-size:20px;color:red;" class="glyphicon glyphicon-cog"></span></a>';
                            classRow = 'success';
                        }
                        if(list[i].actosunat == ''){
                            sunat = '<span style="color:red;font-weight:bold;">NO</span>';
                        }
                        if(list[i].actouif == ''){
                           uif = '<span style="color:red;font-weight:bold;">NO</span>';
                        }
                        html = html +'<tr class="'+classRow+'">';
                        
                        html = html + '<td>'+x+'</td>';
                        html = html +'<td><a target="_blank" href="../verkardex.php?kardex='+list[i].kardex+'&id='+list[i].idkardex+'">'+list[i].kardex+'</a></td>';
                        html = html +'<td>'+list[i].numescritura+'</td>';
                        html = html +'<td>'+list[i].fechaescritura+'</td>';
                        html = html +'<td align="right">'+codAncert+' <a class="show-cod-ancert" data-codactos="'+codActos+'" href="javascript:;"><span style="font-size:20px;color:red;" class="glyphicon glyphicon-cog"></span></a></td>';
                        html = html +'<td>'+sunat+'</td>';
                        html = html +'<td>'+uif+'</td>';
                        html = html +'<td>'+list[i].estado_sisgen+'</td>';
                        html = html +'<td>'+list[i].contrato+'</td>';
                       /*html = html + '<td><a class="refresh-kardex" data-kardex="'+list[i].kardex+'" data-idkardex="'+list[i].idkardex+'"  href="javascript:;"><span style="font-size:20px;color:green;" class="glyphicon glyphicon-refresh"><a></td>';*/
                       html = html + '<td><a data-kardex="'+list[i].kardex+'" data-idkardex="'+list[i].idkardex+'" href="javascript:;" class="descargar-xml"><span  class="glyphicon glyphicon-save-file" style="font-size:20px;display:none;"></span>XML</a></td>';
                        html = html  +'<td><a href="javascript:;" data-idkardex="'+list[i].idkardex+'"  data-kardex="'+list[i].kardex+'" class="btn btn-warning documento-notarial" style="color: #fff;background-color: #bf532a;border-color: #bf532a;" > <i class="glyphicon glyphicon-cloud-upload"></i> Enviar a Sisgen</a></td></tr>';
                        x++;
                    }
                    $('#tblDocumentoNotariales').append(html);
                    $('#step-documentos').removeClass('disabled');
                    $('#step-documentos').addClass('active');
                }               
                if(listerror.length > 0){
                    $('#divErrores').show();
                    var x = 1;
                    for(i in listerror){
                        html2 = html2 +'<tr class="'+classRow+'">';
                        html2 = html2 + '<td>'+x+'</td>';
                        html2 = html2 +'<td><a target="_blank" href="../verkardex.php?kardex='+listerror[i].kardex+'&id='+listerror[i].idkardex+'">'+listerror[i].kardex+'</a></td>';
                        html2 = html2 +'<td>'+listerror[i].acto+'</td>';
                        html2 = html2 +'<td>'+listerror[i].error+'</td>';
                        x++; 
                    }
                     $('#tblErrores').append(html2);
                }
                if(listObservaciones.length > 0){
                    $('#divObservaciones').show();
                    $('#totalObservaciones').show();
                    var x = 1;
                    for(i in listObservaciones){
                        html3 = html3 +'<tr class="'+classRow+'">';
                        html3 = html3 + '<td>'+x+'</td>';
                        html3 = html3 +'<td><a target="_blank" href="../verkardex.php?kardex='+listObservaciones[i].kardex+'&id='+listObservaciones[i].idkardex+'">'+listObservaciones[i].kardex+'</a></td>';
                        html3 = html3 +'<td>'+listObservaciones[i].acto+'</td>';
                        html3 = html3 +'<td>'+listObservaciones[i].error+'</td>';
                        x++; 
                    }
                     $('#tblObservaciones').append(html3);
                }
            }
        });
    }

    function loadDataLibro(){
        fechaDesde = $('#fechaDesde').val();
        fechaHasta = $('#fechaHasta').val();
        $('#divErrores').hide();        
        $('#text-loader').text('CARGANDO INFORMACION...');
        $('#modal-dialog-correct-errors').removeClass('modal-lg');
        $('#modal-dialog-correct-errors').addClass('modal-sm');
        $('#modal-delete-header').hide();
        $('#error-xml-sisgen').hide();
        $('#container-table-error').hide();
        $('#loading-delete-correct-error').show();
        $('#tblExtraprotocolar tr').remove();
        $('#tblErrores tr').remove();
        $('#totalDocumentosNotariales').hide();
        estado = $('#cmbEstado').val();
        $.ajax({
            url:'buscar_libros.php',
            dataType:'json',
            type:'POST',
            data:{fechaDesde:fechaDesde,fechaHasta:fechaHasta,estado:estado},
            beforeSend:function(){
                $('#modal-correct-errors').modal({'show':true,"backdrop"  : "static",
             "keyboard"  : true});
            },
            success:function(response){
                html = '';
                list = response.data;
                 $('#modal-correct-errors').modal('hide');
                if(list.length == 0){
                    $('#msgError').text('No se encontraron '+$('#tituloTipoDocumento').text());
                    $('#msgError').show();
                }else{
                    $('#totalLibrosContables').text(response.total+' '+$('#tituloTipoDocumento').text()+' encontrados'); 
                    $('#totalLibrosContables').show();
                    var x = 1;
                     for(i in list){
                        html = html + '<tr><td>'+x+'</td>';
                        html = html +'<td><a target="_blank" href="../verlibro.php?numlibro='+list[i].libro+'">'+list[i].libro+'</a></td>';
                        html = html +'<td>'+list[i].tipoPersona+'</td>';
                        html = html +'<td>'+list[i].ruc+'</td>';
                        html = html +'<td>'+list[i].empresa+'</td>';
                        html = html +'<td>'+list[i].descripcionTipoLibro+'</td>';
                        html = html +'<td>'+list[i].estadoSisgen+'</td>';

                          html = html + '<td><a data-numlibro="'+list[i].libro+'" data-idlibro="'+list[i].id+'" href="javascript:;" class="descargar-xml"><span  class="glyphicon glyphicon-save-file" style="font-size:20px;display:none;"></span>XML</a></td>';

                        html = html  +'<td><a href="javascript:;" data-idlibro="'+list[i].id+'"  data-libro="'+list[i].libro+'" class="btn btn-warning documento-notarial" style="color: #fff;background-color: #bf532a;border-color: #bf532a;" > <i class="glyphicon glyphicon-cloud-upload"></i> Enviar a Sisgen</a></td></tr>';
                        x++;  
                     }
                     $('#tblExtraprotocolar').append(html);
                    
                }
            }
        });
    }

        function enviarDataSisgenLibros(idlibro,libro,all){
        $('#text-loader').text('ENVIANDO INFORMACION...');
        $('#modal-dialog-correct-errors').removeClass('modal-lg');
        $('#modal-dialog-correct-errors').addClass('modal-sm');
        $('#modal-delete-header').hide();
        $('#container-table-error').hide();
        $('#error-xml-sisgen').hide();
        $('#loading-delete-correct-error').show();
        $.ajax({  
            url:"enviar_xml_libros.php",
            dataType:'json',
            type:'POST',
            data:{idlibro:idlibro,libro:libro,all:all},
            beforeSend:function(){
                 $('#modal-correct-errors').modal({'show':true,"backdrop"  : "static",
             "keyboard"  : true});
            },
            success:function(response){
                $('#tblErrors tr').remove();
                $('#modal-dialog-correct-errors').removeClass('modal-sm');
                $('#modal-dialog-correct-errors').addClass('modal-lg');
                $('#modal-delete-header').show();
                $('#loading-delete-correct-error').hide();
                if(response.error == 1){
                    $('#error-xml-sisgen').show();
                }else{
                    data = response;
                    var statusClass = '';
                    var mensajeClass ='';
                    if(data.length != 0){
                        html = '';
                        x = 1;
                        $("#tlibros").css("display","");
                        $("#tprotocolares").css("display","none");

                        $('#container-table-error').show();
                        for(i in data){
                            if(data[i].estado == 3){
                                statusClass = 'fallido';
                                mensajeClass = 'mensaje-envio';
                            }else
                            if(data[i].estado == 2){
                                statusClass = 'observado';
                                mensajeClass = '';
                            }else
                            if(data[i].estado == 1){
                                statusClass = 'guardado';
                                mensajeClass = '';
                            }

                            html = html + '<tr><td>'+x+'</td>';
                            html = html + '<td><a target="_blank" href="../verlibro.php?numlibro='+data[i].libro+'">'+data[i].libro+'</a></td>';
                            html = html + '<td>'+data[i].cliente+'</td>';

                            html = html + '<td><span class="'+statusClass+'">'+data[i].status+'</span></td>';
                            html = html + '<td><span class="'+mensajeClass+'">'+data[i].mensaje+'</span></td>';
  
                              html = html + '<td><a  data-libro="'+data[i].libro+'" data-idlibro="'+data[i].idkardex+'" href="javascript:;" class="descargar-xml"><span  class="glyphicon glyphicon-save-file" style="font-size:20px;display:none;"></span><span style="display:none;" id="rspXml">'+escapeHtml(data[i].response)+'</span>XML</a>';
                            html=html+'</td>';
                            html=html+'</tr>';

                            x++;
                        }
                        $('#tblErrors').append(html);
                    }
                }
            }
        });
    }


var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};

function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}

    function enviarDataSisgen(idkardex,kardex,all,url){
        $('#text-loader').text('ENVIANDO INFORMACION...');
        $('#modal-dialog-correct-errors').removeClass('modal-lg');
        $('#modal-dialog-correct-errors').addClass('modal-sm');
        $('#modal-delete-header').hide();
        $('#container-table-error').hide();
        $('#error-xml-sisgen').hide();
        $('#loading-delete-correct-error').show();
        $.ajax({  
            url:'enviar_xml_por_kardex.php',
            dataType:'json',
            type:'POST',
            data:{idkardex:idkardex,kardex:kardex,all:all},
            beforeSend:function(){
                 $('#modal-correct-errors').modal({'show':true,"backdrop"  : "static",
             "keyboard"  : true});
            },
            success:function(response){
                $('#tblErrors tr').remove();
                $('#modal-dialog-correct-errors').removeClass('modal-sm');
                $('#modal-dialog-correct-errors').addClass('modal-lg');
                $('#modal-delete-header').show();
                $('#loading-delete-correct-error').hide();
                listerror = response.errores==null?[]:response.errores;
                listObservaciones = response.observaciones==null?[]:response.observaciones;
                data = response.data;
                if(response.error == 1){
                    $('#error-xml-sisgen').show();
                    html='';
                    if(listerror.length > 0){
                        var x = 1;
                        for(i in listerror){                       
                          html+= listerror[i].kardex+'->'+listerror[i].acto+'->'+listerror[i].error+'<br>';
                        }
                    }
                    $('#error-xml-detalle').append(html);
                }else{
					var statusClass = '';
                    var mensajeClass ='';
                    if(data.length != 0){
                        html = '';
                        x = 1;
                        $('#container-table-error').show();
                        for(i in data){
                            if(data[i].estado == 3){
                                statusClass = 'fallido';
                                mensajeClass = 'mensaje-envio';
                            }else
                            if(data[i].estado == 2){
                                statusClass = 'observado';
                                mensajeClass = '';
                            }else
                            if(data[i].estado == 1){
                                statusClass = 'guardado';
                                mensajeClass = '';
                            }

                            html = html + '<tr><td>'+x+'</td>';
                            html = html + '<td>'+data[i].kardex+'</td>';
                            html = html + '<td>'+data[i].contrato+'</td>';

                            html = html + '<td><span class="'+statusClass+'">'+data[i].status+'</span></td>';
                            html = html + '<td><span class="'+mensajeClass+'">'+data[i].mensaje+'</span></td></tr>';
                            x++;
                        }
                        $('#tblErrors').append(html);
                    }else{
                        $('#container-table-error').show();
                        $('#tblErrors').append('<tr><td Colspan="5">No se han enviado kardex, existen kardex con errores en el xml</td></tr>');
                    }                 
                    if(listerror.length > 0){
                        var x = 1;
                        for(i in listerror){                       
                            console.log(listerror[i].kardex+'->'+listerror[i].acto+'->'+listerror[i].error);
                        }
                    }
                }
            }
        });
    }

    $("#tblExtraprotocolar").on('click','.documento-notarial', function(e){
             idlibro = $(this).data('idlibro');
             enviarDataSisgenLibros(idlibro,null,0);
    });

    $('#tblDocumentoNotariales').on('click','.documento-notarial',function(e){
        idkardex = $(this).data('idkardex');
        kardex = $(this).data('kardex');
        enviarDataSisgen(idkardex,kardex,0);
    });

    $('#tblDocumentoNotariales').on('click','.show-cod-ancert',function(e){
         $('#modal-code-act').modal({'show':true,"backdrop"  : "static",
             "keyboard"  : true});
         codActos = $(this).data('codactos');
        $('#tbl-list-condiciones tr').remove();
         $.ajax({
            url:'get_actos.php',
            dataType:'json',
            type:'POST',
            data:{codActos:codActos},
            success:function(response){
                data = response.data;
                
                $('#cmbActos option').remove();
                html =  '<option selected value="0">Seleccione Acto</option>';
                for(i in data){
                    html = html + '<option value="'+data[i].idtipoacto+'">'+data[i].desacto+'</option>';
                }
                 $('#cmbActos').append(html);

            }
         });


    });

    $('#cmbActos').on('change',function(e){
        codActo = this.value;
        loadActoCondicion(codActo);
    });


    function loadActoCondicion(codActo){
        $('#txtCodTipoActo').val(codActo);
        $('#tbl-list-condiciones tr').remove();
        $.ajax({
            url:'get_acto_condicionbyacto.php',
            dataType:'json',
            type:'POST',
            data:{codActos:codActo},
            success:function(response){
                dataActo = response.dataActo;
                dataCondicion = response.dataCondicion;
                if(dataActo.length != 0){
                    $('#codUif').val(dataActo[0].actouif);
                    $('#codSunat').val(dataActo[0].actosunat);
                    $('#codCnl').val(dataActo[0].cod_ancert);
                }
               
                
                html = '';
                for(i in dataCondicion){

                    parte = dataCondicion[i].parte;
                    montop = dataCondicion[i].montop;
                    uif = dataCondicion[i].uif;

                    if(parte == -1){
                        parte = '';
                    }
                    if(montop == -1){
                        montop = '';
                    }
                    if(uif == -1){
                        uif = '';
                    }

                     html = html + '<tr><td>'+dataCondicion[i].condicion+'</td>';
                     html = html + '<td>'+parte+'</td>';
                      html = html + '<td>'+uif+'</td>';
                     html = html + '<td>'+montop+'</td>';

                     html = html + '<td>'+dataCondicion[i].codconsisgen+'</td>';
                     html = html + '<td><a data-id="'+dataCondicion[i].idcondicion+'" class="btn btn-primary editar-condicion" data-uif="'+dataCondicion[i].uif+'" data-parte="'+dataCondicion[i].parte+'" data-montop="'+dataCondicion[i].montop+'" data-codigocnl="'+dataCondicion[i].codconsisgen+'" data-condicion="'+dataCondicion[i].condicion+'"  href="javascript:;">Editar</a></td>';
                }
                $('#tbl-list-condiciones').append(html);

            }
         });
    }

    $('#btnGuardarActo').on('click',function(e){
        codActo = $('#txtCodTipoActo').val();
        codSunat = $('#codSunat').val();
        codUif = $('#codUif').val();
        codCnl = $('#codCnl').val();
        $.ajax({
            url:'update_tipoacto.php',
            dataType:'json',
            type:'POST',
            data:{codActos:codActo,codSunat:codSunat,codUif:codUif,codCnl:codCnl},
            success:function(response){


            }
       });     
    });

     $('#tbl-list-condiciones').on('click','.editar-condicion',function(e){
       idCondicion = $(this).data('id');
        condicion = $(this).data('condicion');
        uif = $(this).data('uif');
        montop = $(this).data('montop');
        parte = $(this).data('parte');
        codigoCnl = $(this).data('codigocnl');
       $('#txtIdCondicion').val(idCondicion);
        $('#condicion').val(condicion);
        $('#montop').val(montop);
        $('#uif').val(uif);
        $('#parte').val(parte);
        $('#codigoCnl').val(codigoCnl);
        $('#btnGuardarCondicion').text('Actualizar Condicion');
        $('#btnCancelar').show();

     });

     $('#btnCancelar').on('click',function(){
        $('#btnGuardarCondicion').text('Guardar Condicion');
        $('#btnCancelar').hide();
        $('#condicion').val('');
        $('#montop').val('-1');
        $('#uif').val('-1');
        $('#parte').val('-1');
        $('#codigoCnl').val('');



     });

     $('#btnGuardarCondicion').on('click',function(){
        idCondicion = $('#txtIdCondicion').val();
        condicion = $('#condicion').val();
        parte = $('#parte').val();
        uif = $('#uif').val();
        montop = $('#montop').val();
        codigoCnl = $('#codigoCnl').val();
        $.ajax({
            url:'update_condicion.php',
            dataType:'json',
            type:'POST',
            data:{idCondicion:idCondicion,uif:uif,
                montop:montop,parte:parte,condicion:condicion,codigoCnl:codigoCnl},
            success:function(response){
                codActo = $('#cmbActos').val();
                $('#btnCancelar').hide();
                $('#condicion').val('');
                $('#montop').val('-1');
                $('#uif').val('-1');
                $('#parte').val('-1');
                $('#codigoCnl').val('');
                $('#btnGuardarCondicion').text('Guardar Condicion');
                loadActoCondicion(codActo);
            }

       });     
     });
     $('#tblExtraprotocolar').on('click','.descargar-xml',function(e){
        idLibro = $(this).data('idlibro'); 
        numlibro = $(this).data('numlibro'); 
         $.ajax({
            url:'generate_xml_by_libro.php',
            dataType:'json',
            type:'POST',
            data:{numlibro:numlibro,idLibro:idLibro},
            success:function(response){
                if(response.error == 0){
                    window.open('libro.xml');
                }
            }
       }); 
     });


     $('#tblResponse').on('click','.descargar-xml',function(e){
          var respon=$(this).find("span");
          var text=$(respon[1])[0].outerText;
          alert(text);
     });

     
     $('#tblDocumentoNotariales').on('click','.descargar-xml',function(e){
        kardex = $(this).data('kardex');
        idKardex = $(this).data('idkardex');
        $.ajax({
            url:'generate_xml_by_kardex.php',
            dataType:'json',
            type:'POST',
            data:{kardex:kardex,idKardex:idKardex},
            success:function(response){
                if(response.error == 0){
                    window.open('documento_notarial.xml');
                }
                listerror = response.errores==null?[]:response.errores;
                listObservaciones = response.observaciones;
                if(listerror.length > 0){
                    var x = 1;
                    for(i in listerror){                       
                        console.log(listerror[i].kardex+'->'+listerror[i].acto+'->'+listerror[i].error);
                    }
                }
            }
       });     
     });

     function refreshKardex(all,kardex,idKardex){
        $('#text-loader').text('ACTUALIZANDO INFORMACION...');
        $('#modal-dialog-correct-errors').removeClass('modal-lg');
        $('#modal-dialog-correct-errors').addClass('modal-sm');
        $('#modal-delete-header').hide();
        $('#container-table-error').hide();
        $('#error-xml-sisgen').hide();
        $('#loading-delete-correct-error').show();
        $.ajax({
            url:'update_contratantesxacto_kardex.php',
            dataType:'json',
            type:'POST',
            data:{kardex:kardex,idKardex:idKardex,all:all},
             beforeSend:function(){
                 $('#modal-correct-errors').modal({'show':true,"backdrop"  : "static",
             "keyboard"  : true});
    
            },
            success:function(response){
                if(response.error == 0){
                    $('#modal-correct-errors').modal('hide');
                }
            }

       });     
     }

      $('#tblDocumentoNotariales').on('click','.refresh-kardex',function(e){
        kardex = $(this).data('kardex');
        idKardex = $(this).data('idkardex');
        refreshKardex(0,kardex,idKardex);   
     });


     $('#btn-enviar-todos').on('click',function(e){
          url="enviar_xml_libros.php";
        if(tipoInstrumento==0)
            enviarDataSisgenLibros(null,null,1);
        else
            enviarDataSisgen(null,null,1);
     });

     $('#btn-refresh-todos').on('click',function(e){
        refreshKardex(1,0,0);
     });





</script>
</body>
</html>