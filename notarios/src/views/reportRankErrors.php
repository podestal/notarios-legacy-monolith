<?php include('./template/header.php')?>
<div class="container-fluid formSisnot" style="background:white" id="formSisnot">
    <div class="row headSisnot" style="display:flex;justify-content:space-between; align-items:center;">
        <div class="text-center">RANKING DE TRABAJADORES CON MAS ERRORES
                    
            <?php
                $currentYear = date('Y');
                $startYear = 2021;
                $endYear = date('Y');
            ?>
            <select class=""  id="cmbYearRankError" name="cmbYearRankError" style="color:black">
                <?php for ($year = $startYear; $year <= $endYear; $year++) { 
                    $selected = ($year == $currentYear) ? 'selected' : '';?>
                    <option value='<?php echo $year?>' <?php echo $selected?>><?php echo$year?></option>
                    <?php }?>
                </select>
                        
        </div>
      
        <div class="formClose" style="color:tomato;cursor:pointer;font-size:1.5em" id="formClose">X<img id="loading"  width="20px" style="diplay:none" src="../../loading.gif"></div>
         
    </div>
       
    <div class="row">
        <div class="">
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-m table-striped table-hover table-reports" id="tableRankErrors" >
                        <thead class="text-center">
                            <th style="background:silver;font-weight:bold">N°</th>
                            <th style="background:silver;font-weight:bold">Trabajador</th>
                            <th style="background:silver;font-weight:bold">Error</th>
                        </thead>
                        <tbody id="tblListadoErroresPDT" class="text-center">

                        </tbody>                    
                    </table> 
                </div>
        </div> 
        <div class="col-md-12 text-center" id="pagination">
        </div>
    </div>
</div>

<?php include('./template/footer.php')?>

