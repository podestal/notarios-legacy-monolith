  <?php
  
    include("../../extraprotocolares/view/funciones.php");
		
    $conexion = Conectar();
	
	$id = $_REQUEST['canc_id'];	
	$doic = $_REQUEST['canc_doic'];	
	$tip_comp = $_REQUEST['canc_idtipcomp'];
	$serie = $_REQUEST['canc_serie'];
	$numero = $_REQUEST['canc_num'];
	$cliente = $_REQUEST['canc_cliente'];
	$usuario = $_REQUEST['canc_usuario'];
	$fecha = fechan_abd($_REQUEST['canc_fecha']);
	$tip_pago = $_REQUEST['canc_tippago'];
	$banco = $_REQUEST['canc_banco'];
	$cheque = $_REQUEST['canc_numero'];
	$monto = $_REQUEST['canc_monto'];
   
    $sql_idcredito = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(m_cteventas.id_ctaventas,6) AS DECIMAL))+1))),
			(MAX(CAST(RIGHT(m_cteventas.id_ctaventas,6) AS DECIMAL))+1)) AS idctaventas FROM m_cteventas";
    
    $res_idcredito = mysql_query($sql_idcredito, $conexion);

	$row_idcredito = mysql_fetch_array($res_idcredito);
	
	$id_credito = $row_idcredito[0];
	
	if($id_credito == ''){$new_idcredito = '2013000001';}
	
	if($id_credito != ''){$new_idcredito = $id_credito;}
	
	$sql_credito = "INSERT INTO m_cteventas(id_ctaventas, num_docu_cli, codigo_cli, tipo_movi, fecha, tipo_docu, serie, documento, kardex, concepto, importe, saldo, swt_est, swt_anul, observacion, monedatipo, tipopago, banco, cheque, monto_igv, codiempl) 
		VALUES ('$new_idcredito', '$doic', '', 'A', '$fecha', '$tip_comp', '$serie', '$numero', '', '$cliente', '$monto', '0', '', '', '', '01', '$tip_pago', '$banco', '$cheque', '0', '$usuario')";
	
    $res_credito = mysql_query($sql_credito, $conexion);
	
	$sql_saldo = "update m_cteventas set saldo= saldo-$monto where id_ctaventas='$id'";
	
    $res_saldo = mysql_query($sql_saldo, $conexion);
	
	$sql_versaldo =   "SELECT  
					   m_cteventas.saldo as saldo
					   from m_cteventas
					   where m_cteventas.id_ctaventas='$id'";
					
    $res_versaldo = mysql_query($sql_versaldo, $conexion);
	
	$row_versaldo = mysql_fetch_array($res_versaldo);
	
	$nuevo_saldo = $row_versaldo[0];
	
	$nuevo_saldo = 0;
	
	if($nuevo_saldo<=0){
		
			// Id y Voucher de m_regpagos //

			$sql_vpagos = "SELECT CONCAT(REPEAT('0',10-LENGTH((MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1))),
			(MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1)) AS numvouc FROM m_regpagos";

			$res_vpagos = mysql_query($sql_vpagos, $conexion);

			$row_vpagos = mysql_fetch_array($res_vpagos);

			$v_pagos = $row_vpagos[0];

			$sql_idpagos = "SELECT MAX(CAST(m_regpagos.num_vouc AS signed))+2  AS numvouc FROM m_regpagos";

			$res_idpagos = mysql_query($sql_idpagos, $conexion);

			$row_idpagos = mysql_fetch_array($res_idpagos);

			$id_pagos = $row_idpagos[0];
			
			//.................//
			
			// Imp total en el registro de ventas //
			
			$sql_total = "select imp_total from m_regventas where tipo_docu=$tip_comp and serie=$serie and factura=$numero";

			$exe_total = mysql_query($sql_total, $conexion);
			
			$row_total = mysql_fetch_array($exe_total);

			$imp_total = $row_total[0];
			
			//-----------------------------------//
			
			$sql_pagos = "INSERT INTO m_regpagos(id_regpagos, num_vouc, num_doc_cli, fec_pago, tipo_docu, serie, numero, imp_pago, id_mon, swt_est, usu_pago)
						  VALUES('$id_pagos', '$v_pagos', '$doic', '$fecha', '$tip_comp', '$serie', '$numero', '$imp_total', '01', 'A', '$usuario')";
	 		
			$res_pagos = mysql_query($sql_pagos, $conexion);
			
	}
	
   ?>
