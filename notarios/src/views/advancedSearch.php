<?php include('./template/header.php')?>
    <div class="container-fluid formSisnot" style="background:white">
        <div class="row headSisnot">
            <div class="col-md-12 text center"><h1>BUSQUEDA AVANZADA</h1></div>
        </div>
        <form action = "../models/getSearchProtocolares.php"  method="POST" id="formFiltrarIndices" >
            <div class="row" style="margin-top:.5em">
                <div class="col-md-12 col-lg-2 justify-content-center">
                    
                    <div class="md-form pt-0 pb-4">
                        <label for="" class="text-right">Filtro avanzado:</label>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-3 justify-content-center">
                    <div class="md-form">
                        <select class="form-control"  id="cmbTipoFiltro" name="cmbTipoFiltro">
                            <option value="1">PROTOCOLARES</option>
                            <option value="2">EXTRAPROTOCOLARES</option>
                        </select>
                    </div>
                    
                </div>
                <div class="col-md-3 justify-content-center">
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
                    
                </div>
                <div class="col-md-1 justify-content-center">
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
                    
                </div>
            </div>
            <div class="row" style="margin-top:.5em">
                <div class="col-md-4  justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
            
                    <label for="txtBuscar\n">CLIENTE</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar contratante" aria-label="Search" id="txtNombreClienteIndice" name="txtNombreClienteIndice" autocomplete="off">
                        <i class="fa fa-search" aria-hidden="true" style="position:absolute;bottom:15px;right:15px;color:gray"></i>
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
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar numero de Escritura" aria-label="Search" id="txtNumeroEscrituraIndice" name="txtNumeroEscrituraIndice" autocomplete="off">
                        
                        <i class="fa fa-search" aria-hidden="true" style="position:absolute;bottom:15px;right:15px;color:gray"></i>
                    </div>
                
                </div>
                <div class="col-md-2 justify-content-center">
                    <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0">
                    <label for="txtBuscar">N° Kardex</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="text" placeholder="Buscar numero de Escritura" aria-label="Search" id="txtNumeroKardexIndice" name="txtNumeroKardexIndice" autocomplete="off">
                        
                        <i class="fa fa-search" aria-hidden="true" style="position:absolute;bottom:15px;right:15px;color:gray"></i>
                    </div>
                
                </div>
            </div>
            <div class="row" style="margin-top:.5em">
                <div class="col-md-3 col-lg-6">
                    <button class="btn btn-success btn-block" type="submit" id="btnFilterAdvanced">BUSCAR <i class="fas fa-filter" aria-hidden="true" ></i></button>
                    <img id="loading" style="display: none" src="../../loading.gif">  
                </div>
            </div>
        </form>    
        <div class="row">
            <div class="col-md-12 ">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-m table-striped table-hover table-reports" id="tableListadoReportes" >
                            <thead class="text-center">
                            <th style="background:silver;font-weight:bold" id="tdEscrNum">N°Escr.</th>
                                <th style="background:silver;font-weight:bold">Kardex</th>
                                <th style="background:silver;font-weight:bold" id="tdFechaDoc">Fec.Escr.</th>
                                <th style="background:silver;font-weight:bold">Contratantes</th>
                                <th style="background:silver;font-weight:bold">Actos</th>
                                <th style="background:silver;font-weight:bold">FolioIni.</th>
                                <th style="background:silver;font-weight:bold">FolioFin</th>
                                <th style="background:silver;font-weight:bold">Responsable</th>
                                <th style="background:silver;font-weight:bold">Escaneo</th>
                                <th style="background:silver;font-weight:bold">Registro</th>
                            </thead>
                            <tbody id="tblListAdvancedSearch" class="text-center">

                            </tbody>                    
                        </table> 
                    </div>
            </div> 
            <div class="col-md-12 text-center" id="pagination">
            </div>
        </div>
    </div>
<?php include('./template/footer.php')?>
