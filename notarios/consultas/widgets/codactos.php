
	<?php
    
    include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
    
    $conexion = Conectar();
	
	$arr_actos = dame_actos();
	
	$cadena = $_REQUEST['cad'];
	
	?>

<input id="n_codactos" name="n_codactos" value="<?php echo $cadena; ?>" type="text" style="width:100px; background-color:#B8E7DF" class="camposss" readonly />