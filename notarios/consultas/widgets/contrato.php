<?php
    
    include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
    
    $conexion = Conectar();
	
	$arr_actos = dame_actos();
	
	$cadena = $_REQUEST['cad'];
	
	/*
	for($i=1; $i<=count($arr_actos); $i++){
		echo $cod_acto[$i] = $_REQUEST['cod_cod'.$arr_actos[$i][0]];
		echo "</br>";
	}
	*/
	?>


<input id="n_contrato" name="n_contrato" type="text" style="width:400px" class="camposss" value="<?php echo $cadena; ?>" readonly />