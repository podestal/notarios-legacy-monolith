	<?php
    
    include("../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$itemmov = $_REQUEST['id_mov'];

	$fechamov = $_REQUEST['mov_mfecha'];
	$vencimiento = $_REQUEST['mov_mvenc'];
	$titulorp = $_REQUEST['mov_mtitulo'];
	$idsedereg = $_REQUEST['mov_mofreg'];
	$idsecreg = $_REQUEST['mov_msecreg'];
	$idtiptraoges = $_REQUEST['mov_mtramite'];
	$idestreg = $_REQUEST['mov_mestado'];
	$encargado = $_REQUEST['mov_mencargado'];
	$anotacion = $_REQUEST['mov_manotacion'];
	$importee = $_REQUEST['mov_mimporte'];
	$observa = $_REQUEST['mov_mobs'];
	
	$sql_updmov = "update detallemovimiento set fechamov='$fechamov', vencimiento='$vencimiento', titulorp='$titulorp', idsedereg='$idsedereg', idsecreg='$idsecreg', idtiptraoges='$idtiptraoges', idestreg='$idestreg', encargado='$encargado', anotacion='$anotacion', importee='$importee', observa='$observa', numeroo='$numeroo', mayorderecho='$mayorderecho' where detallemovimiento.itemmov ='$itemmov'";
	
    $exe_updmov = mysql_query($sql_updmov, $conexion);
	
	?>