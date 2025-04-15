<?php

	session_start();
	
	include("../../extraprotocolares/view/funciones.php");
		
	$conexion = Conectar();
	
	$tip_comp = $_REQUEST['tip_comp'];
	$serie1 =  $_REQUEST['serie1'];
	$numdoc1 = $_REQUEST['numdoc1'];
	$fecha_emision1 = $_REQUEST['fecha_emision1'];
	$serie2 = $_REQUEST['serie2'];
	$numdoc2 = $_REQUEST['numdoc2'];
	$fecha_emision2 = $_REQUEST['fecha_emision2'];
	$select_doc = $_REQUEST['select_doc'];
	$doic = $_REQUEST['doic'];
	$telefono = $_REQUEST['telefono'];
	$nom_cliente = strtoupper(str_replace("'","?",$_REQUEST['nom_cliente']));
	$direccion = $_REQUEST['direccion'];
	$slc_tippag = $_REQUEST['slc_tippago'];
	$slc_area = $_REQUEST['slc_area'];
	$slc_usuario = $_REQUEST['slc_usuario'];
    $tipo_docu=$_REQUEST['select_doic'];

    $subtotal = $_REQUEST['subtotal'];
	$igv = $_REQUEST['igv'];
	$total = $_REQUEST['total'];
	
	
	if($total>=700){
	$detraccion=round(10*$total/100);
	}else{
	$detraccion=0;
	}
	

/*
	$subtotal = $_REQUEST['subtotal'];
	$igv = $_REQUEST['igv'];
	$total = $_REQUEST['total'];*/

	
	
	if(isset($_REQUEST['banco'])){
        $banco = $_REQUEST['banco'];
    }

    if(isset($_REQUEST['cheque'])){
        $numero_banco = $_REQUEST['cheque'];
    }

    if(isset($_REQUEST['d_tipcomp'])){
        $tip_ncre = $_REQUEST['d_tipcomp'];
    }

    if(isset($_REQUEST['d_serie'])){
        $ser_ncre = $_REQUEST['d_serie'];
    }

    if(isset($_REQUEST['d_ndoc'])){
        $doc_ncre = $_REQUEST['d_ndoc'];
    }

	$comentarios = strtoupper($_REQUEST['comentarios']);
	
	if($serie1==""){
	   $serie = $serie2;	
	}else{
	   $serie = $serie1;	
	}
	
	if($numdoc1==""){
	   $numdoc = $numdoc2;	
	}else{
	   $numdoc = $numdoc1;	
	}
	
	if($fecha_emision1==""){
	   $fecha_emision = $fecha_emision2;	
	}else{
	   $fecha_emision = $fecha_emision1;	
	}
	
	$fecha_emision = fechan_abd($fecha_emision);
	
	
	if($slc_usuario=="" OR $slc_usuario=="--Atendido por--"){
		$slc_usuario = $_REQUEST['usuario_sesion'];
	}
	

	$consulta_idregventas = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(m_regventas.id_regventas,6) AS DECIMAL))+1))),
	(MAX(CAST(RIGHT(m_regventas.id_regventas,6) AS DECIMAL))+1)) AS idregventas FROM m_regventas";
	
	$resultado_idregventas = mysql_query($consulta_idregventas, $conexion);
	
	$row_idregventas = mysql_fetch_array($resultado_idregventas);
	
	$new_idregventas = $row_idregventas[0];
	
		if($new_idregventas == '')
		{
			$new_idregventas =  date('Y').'000001';
		}
		
		if($new_idregventas != '')
		{
			$id_regventas = $new_idregventas;
		}
		
		$id_regventas =  $id_regventas;
		
	// verficar si existe
	
	$numero_docu = $tip_comp.'-'.$serie.'-'.$numdoc;
	
	$sql_buscardoc = "SELECT concat(m_regventas.tipo_docu,'-',m_regventas.serie,'-',m_regventas.factura) as numero_docu FROM m_regventas where concat(m_regventas.tipo_docu,'-',m_regventas.serie,'-',m_regventas.factura)='$numero_docu'";
	
	$resultado_buscardoc = mysql_query($sql_buscardoc, $conexion);
	
	$existe_doc = mysql_num_rows($resultado_buscardoc);
	
	$doic=utf8_decode($doic);
	if($existe_doc==0){
	    // si no tiene igv y subtotal

	    if($total<>0 && ( $subtotal==0 || $subtotal=='')){
		 $subtotal=  round($total/1.18,2);
		 $igv=  $total-$subtotal;
		}
	    
	
	

		 $sql_insertregventas = "INSERT 
								INTO m_regventas
								(id_regventas, tipo_docu, serie, factura, fecha, num_docu, concepto, tipopago, empleado, subtotal, impuesto, imp_total, estado, monedatipo, banco, numero_banco, tip_ncre, ser_ncre, doc_ncre,direccion,telefono,detraccion,tip_doc)
								VALUES 
								('$id_regventas', '$tip_comp', '$serie', '$numdoc', '$fecha_emision', '$doic', '$nom_cliente', '$slc_tippag', '$slc_usuario', '$subtotal', '$igv', '$total', 'ACTIVO', '01', '$banco', '$numero_banco', '$tip_ncre', '$ser_ncre', '$doc_ncre','$direccion','$telefono','$detraccion','$tipo_docu')";
								
		$resultado_insertregventas = mysql_query($sql_insertregventas, $conexion);
		
	
		
		/*
		$sql_insertregventas = "INSERT  INTO m_regventas(id_regventas,tipo_docu,serie,factura,fecha) VALUES ('2015999999','02','0001','096285','2015-12-14')";
		$resultado_insertregventas = mysql_query($sql_insertregventas, $conexion);
		*/
		
		
		
		
		$numero = $_REQUEST['numero'];
		$kardex_numero="";
		
		for($i=1; $i<=$numero; $i++){
			
			$det_cod[$i] = $_REQUEST['det_cod'.$i];
			$det_desc[$i] = $_REQUEST['det_desc'.$i];
			$det_precio[$i] = $_REQUEST['det_precio'.$i];
			$det_cantidad[$i] = $_REQUEST['det_cantidad'.$i];
			if($det_cantidad[$i]==""){$det_cantidad[$i]=="0.00";}
			if($_REQUEST['det_numkardex'.$i]!="" )
			{
			if($kardex_numero==""){
			$kardex_numero=$_REQUEST['det_numkardex'.$i];
			}			
			}
			
			
			//$det_numkardex[$i] = $_REQUEST['det_numkardex'.$i];
			//$kardex_numero="123";
			$det_desde[$i] = $_REQUEST['det_desde'.$i];
			$det_hasta[$i] = $_REQUEST['det_hasta'.$i];
			$det_comentarios[$i] = $_REQUEST['det_comentarios'.$i];
			$det_total[$i] = $_REQUEST['det_total'.$i];
			if($det_total[$i]==""){ $det_total[$i]=="0.00";}
			$det_igv[$i] = 0.18*$det_total[$i];
			
		}
		
		$i=0;
	
		for($j=1; $j<=$numero; $j++){
		    $serv="";
		//busca servicio
			$sql_buscarservi = "SELECT descrip FROM  servicios WHERE codigo = '$det_cod[$j]'";
	        $resultado_buscarserv = mysql_query($sql_buscarservi, $conexion);
	        $array_buscaserv = mysql_fetch_array($resultado_buscarserv);
            $serv1=$array_buscaserv[0];
			
			
			
		  
		       if($serv1!=$comentarios && $serv1!=$det_comentarios[$j] ){
			   $serv2=$det_comentarios[$j];
			   $serv3=$det_comentarios[$j];
			   }else{
			   $serv2="";
			   $serv3="";
				   
			   }
		    
			$sql_insertdetventas = "INSERT 
								INTO d_regventas
								(id_regventas, tipo_docu, serie, codigo,  documento,  detalle, precio, cantidad, monto_igv, total, detalle_fac, monedatipo, comentarios, kardex, desde, hasta)
								VALUES 
								('$id_regventas', '$tip_comp', '$serie', '$det_cod[$j]', '$doic', '$serv1', '$det_precio[$j]', '$det_cantidad[$j]', '$det_igv[$j]', '$det_total[$j]', '$serv2','01', '$serv3', '$kardex_numero', '$det_desde[$j]', '$det_hasta[$j]')";
								
			$resultado_insertdetventas = mysql_query($sql_insertdetventas, $conexion);	

			
		}
	
		
		
		
		if($_REQUEST["valorusu"]==1){
		$sql_lastcomp = "SELECT CONCAT(REPEAT('0',6-LENGTH((MAX(CAST(t_params.grp_item AS DECIMAL))))),
	(MAX(CAST(t_params.grp_item AS DECIMAL)))) AS grpitem FROM t_params WHERE t_params.num_item = '$tip_comp' ";
	}else if($_REQUEST["valorusu"]==""){
	   $sql_lastcomp = "SELECT CONCAT(REPEAT('0',6-LENGTH((MAX(CAST(t_params.grp_item AS DECIMAL))+1))),
	(MAX(CAST(t_params.grp_item AS DECIMAL))+1)) AS grpitem FROM t_params WHERE t_params.num_item = '$tip_comp' ";
	}
		
		$resultado_lastcomp = mysql_query($sql_lastcomp, $conexion);
		
		$row_lastcomp = mysql_fetch_array($resultado_lastcomp);
		
		$lastcomp = $row_lastcomp[0];
		
		$sql_upparams = "UPDATE t_params SET t_params.grp_item = '$lastcomp' WHERE t_params.num_item = '$tip_comp'";
	
		$resultado_upparams = mysql_query($sql_upparams, $conexion);


		if($slc_tippag == '2'){

			// Id de ctaventas //
 
			$sql_idcredito = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(m_cteventas.id_ctaventas,6) AS DECIMAL))+1))),
			(MAX(CAST(RIGHT(m_cteventas.id_ctaventas,6) AS DECIMAL))+1)) AS idctaventas FROM m_cteventas";

			$res_idcredito = mysql_query($sql_idcredito, $conexion);

			$row_idcredito = mysql_fetch_array($res_idcredito);

			$id_credito = $row_idcredito[0];

			if($id_credito == '')
			{
				$new_idcredito =  date('Y').'000001';
			}
			
			if($id_credito != '')
			{
				$new_idcredito = $id_credito;
			}

			//.................//

			$sql_credito = "INSERT INTO m_cteventas(id_ctaventas, num_docu_cli, codigo_cli, tipo_movi, fecha, tipo_docu, serie, documento, kardex, concepto, importe, saldo, swt_est, swt_anul, observacion, monedatipo, tipopago, banco, cheque, monto_igv, codiempl) 
	VALUES ('$new_idcredito', '$doic', '', 'C', '$fecha_emision', '$tip_comp', '$serie', '$numdoc', '', '$nom_cliente', '$total', '$total', '', '', '', '01', '$slc_tippag', '$banco', '$cheque', '$igv', '$slc_usuario')";

		    $res_credito = mysql_query($sql_credito, $conexion);

		}

		if($slc_tippag == '1' || $slc_tippag == '4' || $slc_tippag == '5' || $slc_tippag == '7' || $slc_tippag == '8'){

			// Id de m_regpagos //

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

			$sql_pagos = "INSERT INTO m_regpagos(id_regpagos, num_vouc, num_doc_cli, fec_pago, tipo_docu, serie, numero, imp_pago, id_mon, swt_est, usu_pago)
						  VALUES ('$id_pagos', '$v_pagos', '$doic', '$fecha_emision', '$tip_comp', '$serie', '$numdoc', '$total ', '01', '', '$slc_usuario')";
	 		
			$res_pagos = mysql_query($sql_pagos, $conexion);
		
		}
		
		$arr_ventas[0] = "Se Guardo Satisfactoriamente";
		$arr_ventas[1] = $id_regventas;
		$arr_ventas[2] = "true";
		echo json_encode($arr_ventas);
		
		
	}else{
		$arr_ventas[3] = "El comprobante ya exite";
		echo json_encode($arr_ventas);
	}
	
	
	

?>