<?php include('./template/header.php')?>
    <div class="container-fluid formSisnot" style="background:white">
        <div class="row headSisnot">
            <div class="col-md-12 text center"><h1>BUSQUEDA AVANZADA</h1></div>
        </div>
        <form action = "../models/getCorrelativePending.php"  method="POST" id="formCorrelativePending" >
            <div class="row" style="margin-top:.5em">
                <div class="col-md-12 col-lg-2 justify-content-center">
                    
                    <div class="md-form pt-0 pb-4">
                        <label for="" class="text-right">Filtro avanzado:</label>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-4 justify-content-center">
                    <div class="md-form">
                        <label for="txtBuscar">&nbsp;</label>
                        <select class="form-control"  id="cmbTipoKardexIndice" name="cmbTipoKardexIndice">
                            <!-- <option value="0">TIPOS DE KARDEX:</option> -->
                            <option value="1" selected>ESCRITURAS PUBLICAS</option>
                            <option value="2">ASUNTOS NO CONTENCIOSOS</option>
                            <option value="3">TRANSFERENCIAS VEHICULARES</option>
                            <option value="4">GARANTIAS MOBILIARIAS</option>
                            <option value="5">TESTAMENTOS</option>
                            
                        </select>
                    </div>
                    
                </div>
                <div class="col-md-4 justify-content-center">
                    <div class="">
                        <label for="txtDateFromCorrelative">Fecha desde:</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="date" placeholder="Fecha desde" aria-label="Search" id="txtDateFromCorrelative" name="txtDateFromCorrelative" value="<?php 
                        echo date("Y-m-01",strtotime(date('Y-m-d')."- 1 month"))
                        ?>" autocomplete="off">
                    </div>
                
                </div>
                <div class="col-md-4 justify-content-center">
                    <div class="">
                    <label for="txtDateToCorrelative">Fecha hasta:</label>
                        <input class="form-control form-control-sm mr-3 w-75 mb-1" style="width: 100% !important" type="date" placeholder="Fecha hasta" aria-label="Search" id="txtDateToCorrelative" name="txtDateToCorrelative" value="<?php echo date('Y-m-d')?>" autocomplete="off">
                    </div>
                
                </div>
            </div>
            
            <div class="row" style="margin-top:.5em">
                <div class="col-md-3 col-lg-6">
                    <button class="btn btn-success btn-block" type="submit" id="btnFilterCorrelativePending">BUSCAR <i class="fas fa-filter" aria-hidden="true" ></i></button>
                    <img id="loading" style="display: none" src="../../loading.gif">  
                </div>
            </div>
        </form>    
        <div class="row">
            <div class="col-md-12 ">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-m table-striped table-hover table-reports" id="tableListadoReportes" >
                            <thead class="text-center">
                                <th style="background:silver;font-weight:bold">ID</th>
                                <th style="background:silver;font-weight:bold">TipoKardex</th>
                                <th style="background:silver;font-weight:bold">N°Escritura.</th>
                                <th style="background:silver;font-weight:bold">Escaneo</th>
                                <th style="background:silver;font-weight:bold">Registro</th>
                            </thead>
                            <tbody id="tblListCorrelativePending" class="text-center">

                            </tbody>                    
                        </table> 
                    </div>
            </div> 
            <div class="col-md-12 text-center" id="pagination">
            </div>
        </div>
    </div>
<?php include('./template/footer.php')?>
