<?php
include("../../conexion.php");
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


    <?php include('./template/header.php')?>
    <div class="container-fluid formSisnot" style="background:white">
        <div class="row headSisnot">
            <div class="col-sm-9 text center"><h1>MIS ERRORES EN EL PDT NOTARIOS</h1></div>
            
            <div class="col-sm-1"><img id="loading" style="display: none" src="../../loading.gif"> </div>
            <div class="col-sm-2">
                <div class="form-inline md-form form-sm active-cyan-2 pb-0 mb-0" style="margin-top:.4em">
                    <label for="" class="text-right">Año: </label>
                    <?php
                        $currentYear = date('Y');
                        $startYear = 2021;
                        $endYear = date('Y');
                    ?>
                    <select class="form-control"  id="cmbYearError" name="cmbYearError">
                        <?php for ($year = $startYear; $year <= $endYear; $year++) { 
                            $selected = ($year == $currentYear) ? 'selected' : '';?>
                            <option value='<?php echo $year?>' <?php echo $selected?>><?php echo$year?></option>
                        <?php }?>
                    </select>
                    
                </div>        
            </div>
        </div>
        <form action = "../models/getCorrelativePending.php"  method="POST" id="formCorrelativePending" >
            <div class="row" style="margin-top:.5em">
                <div class="col-sm-3">
                    
                    <div class="md-form pt-0 pt-4">
                        <label for="" class="text-right">Tareas pendientes: </label>
                    </div>
                </div>
                
                
            </div>
         
    
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-m table-striped table-hover table-reports" id="tableErrors" >
                            <thead class="text-center">
                                <th style="background:silver;font-weight:bold">N°.</th>
                                <th style="background:silver;font-weight:bold">KARDEX</th>
                                <th style="background:silver;font-weight:bold">FECHA</th>
                                <th style="background:silver;font-weight:bold">ACTO</th>
                                <th style="background:silver;font-weight:bold">DESCRIPCION DEL ERROR</th>
                                <th style="background:silver;font-weight:bold">USUARIO</th>
                                <th style="background:silver;font-weight:bold">ESTADO.</th>
                            </thead>
                            <tbody id="tblListErrors" class="text-center">

                            </tbody>                    
                        </table> 
                    </div>
            </div> 
            <div class="col-md-12 text-center" id="pagination">
            </div>
        </div>
    </div>
<?php include('./template/footer.php')?>

<script>
    let usuario = '<?php echo $usuario;?>'
</script>
</body>
</html>