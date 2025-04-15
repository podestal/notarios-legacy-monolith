<?php

	function dame_comprobante($id){
		
		$conexion = Conectar();
		
		$i=0;
		 
		$sql_regventa  =   "SELECT
							m_regventas.id_regventas,
							m_regventas.tipo_docu,
							m_regventas.serie,
							m_regventas.factura,
							m_regventas.fecha,
							m_regventas.codigo_cli,
							m_regventas.concepto,
							m_regventas.num_docu,
							m_regventas.direccion,
							m_regventas.telefono,
							tipo_pago.descrip,
							m_regventas.detalle,
							m_regventas.monedatipo,
							m_regventas.empleado,
							m_regventas.subtotal,
							m_regventas.impuesto,
							m_regventas.imp_total,
							m_regventas.tip_doc,
							m_regventas.tipopago
							FROM
							m_regventas
							Left Join cliente ON m_regventas.codigo_cli = cliente.idcliente
							INNER JOIN tipo_pago ON m_regventas.tipopago = tipo_pago.codigo
							WHERE
							m_regventas.id_regventas =  '$id'";
			
		$exe_regventa = mysql_query($sql_regventa, $conexion);
		 
		while($regventa = mysql_fetch_array($exe_regventa, MYSQL_ASSOC))
		{
			$arr_regventa[0] = $regventa["id_regventas"];
			$arr_regventa[1] = $regventa["tipo_docu"];
			$arr_regventa[2] = $regventa["serie"];
			$arr_regventa[3] = $regventa["factura"];
			$arr_regventa[4] = $regventa["fecha"];
			$arr_regventa[5] = $regventa["codigo_cli"];
			$arr_regventa[6] = $regventa["concepto"];
			$arr_regventa[7] = $regventa["num_docu"];
			$arr_regventa[8] = $regventa["direccion"];
			$arr_regventa[9] = $regventa["telefono"];
			$arr_regventa[10] = $regventa["descrip"];
			$arr_regventa[11] = $regventa["detalle"];
			$arr_regventa[12] = $regventa["monedatipo"];
			$arr_regventa[13] = $regventa["empleado"];
			$arr_regventa[14] = $regventa["subtotal"];
			$arr_regventa[15] = $regventa["impuesto"];
			$arr_regventa[16] = $regventa["imp_total"];
			$arr_regventa[17] = $regventa["tipopago"];
			$arr_regventa[18] = $regventa["tip_doc"];
			$i++;
		}
		  
		return $arr_regventa;
	
	}
	
	function dame_documentos(){
		
		$conexion = Conectar();
		
		$sql_tipdocumento = "SELECT
							 tipodocumento.idtipdoc,
							 tipodocumento.codtipdoc,
							 tipodocumento.destipdoc
						     FROM
							 tipodocumento";		
						  
		$exe_tipdocumento = mysql_query($sql_tipdocumento, $conexion);
		
		$i=0;
		
		while($tipdocumento = mysql_fetch_array($exe_tipdocumento, MYSQL_ASSOC))
	    {
			$arr_tipdocumento[$i][0] = $tipdocumento["idtipdoc"];
			$arr_tipdocumento[$i][1] = $tipdocumento["codtipdoc"];
			$arr_tipdocumento[$i][2] = $tipdocumento["destipdoc"];
			$i++;
	    }
		
		return $arr_tipdocumento;
		
	}
	
	function dame_comprobantes(){
		
		$conexion = Conectar();
		
		$sql_tipcomprobante = "SELECT
							   tipocomprobante.idcompro,
							   tipocomprobante.descompro,
							   tipocomprobante.serie,
							   tipocomprobante.correlativo
							   FROM
							   tipocomprobante";		
						  
		$exe_tipcomprobante = mysql_query($sql_tipcomprobante, $conexion);
		
		$i=0;
		
		while($tipcomprobante = mysql_fetch_array($exe_tipcomprobante, MYSQL_ASSOC))
	    {
			$arr_tipcomprobante[$i][0] = $tipcomprobante["idcompro"];
			$arr_tipcomprobante[$i][1] = $tipcomprobante["descompro"];
			$i++;
	    }
		
		return $arr_tipcomprobante;
		
	}
	
	function dame_tipopagos($id){
		
		$conexion = Conectar();
		
		$sql_tipopagos = "SELECT
						  tipo_pago.codigo,
						  tipo_pago.descrip
						  FROM
						  tipo_pago
						where tipo_pago.codigo=$id";		
						  
		$exe_tipopagos = mysql_query($sql_tipopagos, $conexion);
		
		$i=0;
		
		while($tipopagos = mysql_fetch_array($exe_tipopagos, MYSQL_ASSOC))
	    {
			$arr_tipopagos[0] = $tipopagos["codigo"];
			$arr_tipopagos[1] = $tipopagos["descrip"];
			$i++;
	    }
		
		return $arr_tipopagos;
		
	}
	
	function dame_servicios(){
		
		$conexion = Conectar();
		
		$sql_servicios =   "SELECT
							servicios.id_servicio,
							servicios.codigo,
							servicios.descrip,
							servicios.tipo,
							servicios.abrev,
							servicios.grupo,
							servicios.precio1,
							servicios.precio2,
							servicios.porcentaje,
							servicios.kardex,
							servicios.infrrpp,
							servicios.activo,
							servicios.area1,
							servicios.serarea,
							servicios.ctaserv
							FROM
							servicios";		
						  
		$exe_servicios = mysql_query($sql_servicios, $conexion);
		
		$i=0;
		
		while($servicios = mysql_fetch_array($exe_servicios, MYSQL_ASSOC))
	    {
			$arr_servicios[$i][0] = $servicios["id_servicio"];
			$arr_servicios[$i][1] = $servicios["codigo"];
			$arr_servicios[$i][2] = $servicios["descrip"];
			$i++;
	    }
		
		return $arr_servicios;
		
	}
	
	function dame_usuarios(){
		
		$conexion = Conectar();
		
		$sql_usuarios =   "SELECT
							usuarios.idusuario,
							usuarios.loginusuario,
							usuarios.password,
							usuarios.apepat,
							usuarios.apemat,
							usuarios.prinom,
							usuarios.segnom,
							usuarios.fecnac,
							usuarios.estado,
							usuarios.domicilio,
							usuarios.idubigeo,
							usuarios.telefono,
							usuarios.idcargo
							FROM
							usuarios";		
						  
		$exe_usuarios = mysql_query($sql_usuarios, $conexion);
		
		$i=0;
		
		while($usuarios = mysql_fetch_array($exe_usuarios, MYSQL_ASSOC))
	    {
			$arr_usuarios[$i][0] = $usuarios["idusuario"];
			$arr_usuarios[$i][1] = $usuarios["loginusuario"];
			$arr_usuarios[$i][2] = $usuarios["prinom"];
			$arr_usuarios[$i][3] = $usuarios["segnom"];
			$arr_usuarios[$i][4] = $usuarios["apepat"];
			$arr_usuarios[$i][5] = $usuarios["apemat"];
			$i++;
	    }
		
		return $arr_usuarios;
		
	}
	
	
	function dame_dregventas($id){
		
		$conexion = Conectar();
		
		$sql_dregventas =   "SELECT
							d_regventas.id_regventas,
							d_regventas.codigo,
							d_regventas.serie,
							d_regventas.documento,
							d_regventas.tipo_docu,
							d_regventas.kardex,
							d_regventas.detalle,
							d_regventas.precio,
							d_regventas.cantidad,
							d_regventas.grupo,
							d_regventas.monedatipo,
							d_regventas.monto_igv,
							d_regventas.grupempl,
							d_regventas.total,
							d_regventas.detalle_fac,
							d_regventas.comentarios,
							d_regventas.num_kardex,
							d_regventas.desde,
							d_regventas.hasta,
							d_regventas.id_dregventas
							FROM
							d_regventas
							WHERE
							d_regventas.id_regventas =  '$id'";		
						  
		$exe_dregventas = mysql_query($sql_dregventas, $conexion);
		
		$i=0;
		
		while($dregventas = mysql_fetch_array($exe_dregventas, MYSQL_ASSOC))
	    {
			$arr_dregventas[$i][0] = $dregventas["kardex"];
			$arr_dregventas[$i][1] = $dregventas["desde"];
			$arr_dregventas[$i][2] = $dregventas["hasta"];
			$arr_dregventas[$i][3] = $dregventas["codigo"];
			$arr_dregventas[$i][4] = $dregventas["detalle"];
			$arr_dregventas[$i][5] = $dregventas["precio"];
			$arr_dregventas[$i][6] = $dregventas["cantidad"];
			$arr_dregventas[$i][7] = $dregventas["total"];
			$arr_dregventas[$i][8] = $dregventas["id_dregventas"];
			$arr_dregventas[$i][9] = $dregventas["detalle_fac"];
			$i++;
	    }
		
		return $arr_dregventas;
		
	}
	
	
	
 
?>
