<?php

	include("../../extraprotocolares/view/funciones.php");
		
	$conexion = Conectar();

	$n_doic = $_REQUEST['n_doicn'];
	$n_doicj = $_REQUEST['n_doicj'];
	$n_prinom = strtoupper($_REQUEST['n_prinom']);
	$n_segnom = strtoupper($_REQUEST['n_segnom']);
	$n_apepat = strtoupper($_REQUEST['n_apepat']);
	$n_apemat = strtoupper($_REQUEST['n_apemat']);
	$n_nombre = strtoupper($n_apepat.' '.$n_apemat.' ,'.$n_prinom.' '.$n_segnom);
	$n_telf = $_REQUEST['n_telf'];
	$n_celn = $_REQUEST['n_celn'];
	$n_dir = strtoupper($_REQUEST['n_dir']);
	$n_email = $_REQUEST['n_email'];
	$n_sexo = $_REQUEST['n_sexo'];
	$n_civil = $_REQUEST['n_civil']; if($n_civil == ""){$n_civil=1;} 
	$n_nac = $_REQUEST['n_nac'];
	$n_fecnac = $_REQUEST['n_fecnac'];
	$n_ubigeon = $_REQUEST['n_ubigeon'];
	$n_resde = $_REQUEST['n_resde'];
	$n_natde = $_REQUEST['n_natde'];
	$n_idubigeon = $_REQUEST['n_idubigeon'];
	$per_natural = $_REQUEST['per_natural'];
	$n_razon = $_REQUEST['n_razon'];
	$n_fiscal = $_REQUEST['n_fiscal'];
	$n_mail = $_REQUEST['n_mail'];
	$n_teleofi = $_REQUEST['n_teleofi'];
	$n_celj = $_REQUEST['n_celj'];
	$n_feccons = $_REQUEST['n_feccons'];
	$n_ubigeoj = $_REQUEST['n_ubigeoj'];
	$n_idubigeoj = $_REQUEST['n_idubigeoj'];
	
	$per_juridica = $_REQUEST['per_juridica'];
	$sql_idcliente = "SELECT tb_proveedor.idproveedor AS idcliente FROM tb_proveedor ORDER BY cast(tb_proveedor.idproveedor as unsigned) DESC";
	$resultado_idcliente = mysql_query($sql_idcliente, $conexion);
	$row_idcliente = mysql_fetch_array($resultado_idcliente);
	$new_idcliente = $row_idcliente[0] + 1;
	$new_idcliente = correlativo_numero10($new_idcliente);
	
	$sql_buscardoc = "SELECT tb_proveedor.idproveedor, tb_proveedor.numdoc AS idcliente FROM tb_proveedor where tb_proveedor.numdoc=$numero_doc"; 
	$resultado_buscardoc = mysql_query($sql_buscardoc, $conexion);
	$existe_doc = mysql_num_rows($resultado_buscardoc);
	
	if($existe_doc==0){
		
		if($per_natural<>""){
		   echo $sql_insertclientes = "INSERT 
								  INTO tb_proveedor
								(idproveedor, prinom, segnom, apepat, apemat, nombre, numdoc, telfijo, telcel, direccion, email, sexo, idestcivil,  nacionalidad, cumpclie, idubigeo, residente, natper, tipper, idtipdoc,docpaisemi,tipocli)
								VALUES 
							('$new_idcliente', '$n_prinom','$n_segnom','$n_apepat','$n_apemat','$n_nombre','$n_doic','$n_telf','$n_celn','$n_dir','$n_email','$n_sexo','$n_civil','$n_nac','$n_fecnac','$n_idubigeon','$n_resde','$n_natde','N','1','PERU','0')";
		}
		
		if($per_juridica <>""){
		   $sql_insertclientes = "INSERT 
								  INTO tb_proveedor
								  (idproveedor, razonsocial, domfiscal, mailempresa, telofi, telcel, numdoc, fechaconstitu, idubigeo, tipper, idestcivil, tipocli)
								  VALUES 
								  ('$new_idcliente','$n_razon', '$n_fiscal', '$n_mail', '$n_teleofi', '$n_celj', '$n_doicj', '$n_feccons', '$n_idubigeoj', 'J', 0, '0')";
							 
		}
						
	$resultado_insertclientes = mysql_query($sql_insertclientes, $conexion);
	
	}


?>