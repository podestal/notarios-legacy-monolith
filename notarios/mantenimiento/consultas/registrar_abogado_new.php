	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
  
	//$idabogado = $_REQUEST['idabogado'];
	$razonsocial = $_REQUEST['razonsocial']; 
	$direccion = $_REQUEST['direccion'];
	$documento = $_REQUEST['documento'];
	$matricula = $_REQUEST['matricula'];
	$sede_colegio = $_REQUEST['sede_colegio'];
		$telefono = $_REQUEST['telefono'];
			$fax = $_REQUEST['fax'];
			
				$sql_idcli = "SELECT idabogado FROM tb_abogado ORDER BY CAST(tb_abogado.idabogado AS SIGNED) DESC";
	
	$exe_idcli = mysql_query($sql_idcli, $conexion);
	
	$row_lastcli = mysql_fetch_array($exe_idcli);
		
	$id_cli = $row_lastcli[0]+1;
	
	$idabogado = correlativo_numero10($id_cli);
	
	$sql_ncliente = "insert into tb_abogado(idabogado,razonsocial,direccion,documento,matricula,sede_colegio,telefono,fax) values ('$idabogado','$razonsocial','$direccion','$documento','$matricula','$sede_colegio','$telefono','$fax')";
	
    $exe_ncliente = mysql_query($sql_ncliente, $conexion) or die(mysql_error());
	
	?>