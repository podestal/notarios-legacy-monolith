<?php

	function dame_kardex($id){
		
		$conexion = Conectar();

		$consulta_kardex = "SELECT
							kardex.idkardex,
							kardex.kardex,
							tipokar.idtipkar,
							tipokar.nomtipkar,
							kardex.fechaingreso,
							kardex.referencia,
							kardex.codactos,
							kardex.dnotarial,
							kardex.dregistral,
							kardex.contrato,
							kardex.kardexconexo,
							notarios.idnotario,
						    notarios.descon
							FROM
							kardex
							Left Join notarios ON kardex.idnotario = notarios.idnotario
							Inner Join tipokar ON tipokar.idtipkar = kardex.idtipkar 
							where kardex.kardex= '$id'";
							
	  $exe_kardex = mysql_query($consulta_kardex, $conexion);
	  
	  while($kardex = mysql_fetch_array($exe_kardex, MYSQL_ASSOC))
	  {
			$arr_kardex[0] = $kardex["idkardex"];
			$arr_kardex[1] = $kardex["kardex"];
			$arr_kardex[2] = $kardex["idtipkar"];
			$arr_kardex[3] = $kardex["nomtipkar"];
			$arr_kardex[4] = $kardex["fechaingreso"];
			$arr_kardex[5] = $kardex["referencia"];
			$arr_kardex[6] = $kardex["codactos"];
			$arr_kardex[7] = $kardex["dnotarial"];
			$arr_kardex[8] = $kardex["dregistral"];
			$arr_kardex[9] = $kardex["contrato"];
			$arr_kardex[10] = $kardex["kardexconexo"];
			$arr_kardex[11] = $kardex["idnotario"];
			$arr_kardex[12] = $kardex["descon"];
	  }
	  
	  return $arr_kardex;
		
	}
	
	function dame_tipkar(){
		
		$conexion = Conectar();
		
	    $sql_tipkar = "SELECT
					   tipokar.idtipkar,
					   tipokar.nomtipkar,
					   tipokar.tipkar
					   FROM
					   tipokar";
					   
		$exe_tipkar = mysql_query($sql_tipkar, $conexion);
		
		$i=0;
		
		while($tipkar = mysql_fetch_array($exe_tipkar, MYSQL_ASSOC))
	    {
			$arr_tipkar[$i][0] = $tipkar["idtipkar"];
			$arr_tipkar[$i][1] = $tipkar["nomtipkar"];
			$arr_tipkar[$i][2] = $tipkar["tipkar"];
			$i++;
	    }
		
		return $arr_tipkar;
		
	}
	
	function dame_notarias(){
		
		$conexion = Conectar();
		
	    $sql_notarias = "SELECT
						 notarios.idnotario,
						 notarios.descon
						 FROM
						 notarios
						 order by notarios.descon asc";
					   
		$exe_notarias = mysql_query($sql_notarias, $conexion);
		
		$i=0;
		
		while($notarias = mysql_fetch_array($exe_notarias, MYSQL_ASSOC))
	    {
			$arr_notarias[$i][0] = $notarias["idnotario"];
			$arr_notarias[$i][1] = $notarias["descon"];
			$i++;
	    }
		
		return $arr_notarias;
		
	}
	
	
	function dame_actos($tipkar){
		
		$conexion = Conectar();
		
		$sql_actos = "SELECT
					  tiposdeacto.idtipoacto,
					  tiposdeacto.actosunat,
					  tiposdeacto.actouif,
					  tiposdeacto.idtipkar,
				 	  tiposdeacto.desacto,
					  tiposdeacto.umbral,
					  tiposdeacto.impuestos,
					  tiposdeacto.idcalnot,
					  tiposdeacto.idecalreg,
					  tiposdeacto.idmodelo,
					  tiposdeacto.rol_part
					  FROM
					  tiposdeacto 
					  where tiposdeacto.idtipkar = $tipkar
					  order by tiposdeacto.desacto asc";
				
		$exe_actos = mysql_query($sql_actos, $conexion);
		 
		$i=0; 
		 
		while($actos = mysql_fetch_array($exe_actos, MYSQL_ASSOC))
		{
			$arr_actos[$i][0] = $actos["idtipoacto"];
			$arr_actos[$i][1] = $actos["desacto"];
			$i++;
		}
		
		return $arr_actos;

	}
	
	function dame_actoskardex($kardex){
		
		$conexion = Conectar();
		
		$sql_detactos = "SELECT
					     detalle_actos_kardex.item,
						 detalle_actos_kardex.kardex,
						 detalle_actos_kardex.idtipoacto,
						 detalle_actos_kardex.actosunat,
						 detalle_actos_kardex.actouif,
						 detalle_actos_kardex.idtipkar,
						 detalle_actos_kardex.desacto
						 FROM
						 detalle_actos_kardex
						 WHERE
						 detalle_actos_kardex.kardex =  '$kardex'
						 ORDER BY
						 detalle_actos_kardex.desacto ASC";
				
		$exe_detactos = mysql_query($sql_detactos, $conexion);
		 
		$i=0; 
		 
		while($detactos = mysql_fetch_array($exe_detactos, MYSQL_ASSOC))
		{
			$arr_detactos[$i][0] = $detactos["idtipoacto"];
			$arr_detactos[$i][1] = $detactos["desacto"];
			$i++;
		}
		
		return $arr_detactos;

	}
	
	function dame_actoscadena($cadena){
		
		$indice = 0;
		
		$longitud = strlen($cadena);
		
		for($i=0; $i<$longitud; $i=$i+3){
			$arr_cad[$indice] = substr($cadena,$i,3);
			$indice++;
		}
		
		$conexion = Conectar();
		
		$sql_actosc = "SELECT
						   tiposdeacto.idtipoacto,
						   tiposdeacto.desacto
						   FROM
						   tiposdeacto
						   ORDER BY
						   tiposdeacto.idtipoacto ASC";
				
		$exe_actosc = mysql_query($sql_actosc, $conexion);
		 
		$i=0; 
		
		while($actosc = mysql_fetch_array($exe_actosc, MYSQL_ASSOC))
		{
			$arr_actosc[$i][0] = $actosc["idtipoacto"];
			$arr_actosc[$i][1] = $actosc["desacto"];
			$i++;
		}
		
		$n=0;
		
		for($j=0; $j<count($arr_actosc); $j++){
			for($k=0; $k<count($arr_cad); $k++){
				if($arr_cad[$k]==$arr_actosc[$j][0]){
					$array_actos[$n][0] = $arr_actosc[$j][0];
					$array_actos[$n][1] = $arr_actosc[$j][1];
					$n++;
				}		
			}

		}
		
		return $array_actos;
		
		

	}
	
	function dame_notreg($id){
		
		$conexion = Conectar();
		
		$i=0;
		 
		$sql_notreg =   "SELECT
						 d_regventas.id_regventas,
						 d_regventas.kardex,
						 m_regventas.fecha,
						 tipo_pago.descrip,
						 m_regventas.serie,
						 m_regventas.factura,
						 m_cteventas.saldo,
						 SUM(d_regventas.precio) AS imp_total,
						 tipocomprobante.descompro,
						 tipocomprobante.idcompro
						 FROM
						 d_regventas
						 Inner Join m_regventas ON m_regventas.id_regventas = d_regventas.id_regventas
						 Inner Join tipo_pago ON tipo_pago.codigo = m_regventas.tipopago
						 Left Join m_cteventas ON m_cteventas.id_regventas = m_regventas.id_regventas
						 Inner Join tipocomprobante ON tipocomprobante.idcompro = m_regventas.tipo_docu
						 where d_regventas.kardex = '$id'";
			
		$exe_notreg = mysql_query($sql_notreg, $conexion);
		 
		$i=0; 
		 
		while($notreg = mysql_fetch_array($exe_notreg, MYSQL_ASSOC))
		{
			$arr_notreg[$i]["id_regventas"] = $notreg["id_regventas"];
			$arr_notreg[$i]["idcompro"] = $notreg["idcompro"];
			$arr_notreg[$i]["imp_total"] = $notreg["imp_total"];
			$i++;
		}
	
		$not=0;
		$reg=0;
		
		//var_dump($arr_notreg);
		
		for($j=0; $j<count($arr_notreg); $j++){
			
			if($arr_notreg[$j]["idcompro"]==1 or $arr_notreg[$j]["idcompro"]==2 or $arr_notreg[$j]["idcompro"]==3){
			   	
				if($arr_notreg[$j]["idcompro"]==1 or $arr_notreg[$j]["idcompro"]==2){
					$not = $not + $arr_notreg[$j]["imp_total"];
				}

				if($arr_notreg[$j]["idcompro"]==3){
					$not = $not - $arr_notreg[$j]["imp_total"];
				}
				
			}
			
			if($arr_notreg[$j]["idcompro"]==4){
				
			   	$reg = $reg + $arr_notreg[$j]["imp_total"];
			}
			
		}
		 
		$arr_nr[0] = number_format($not, 2, ".", " ");
		$arr_nr[1] = number_format($reg, 2, ".", " ");
		  
		return $arr_nr;
	
	}
	
	function facturas_kardex($codkardex){
		
		$conexion = Conectar();
		
		$sql_fact = "SELECT
					d_regventas.id_regventas,
					d_regventas.kardex,
					m_regventas.fecha,
					tipo_pago.descrip,
					m_regventas.serie,
					m_regventas.factura,
					m_cteventas.saldo,
					m_regventas.imp_total,
					tipocomprobante.descompro
					FROM
					d_regventas
					Inner Join m_regventas ON m_regventas.id_regventas = d_regventas.id_regventas
					Inner Join tipo_pago ON tipo_pago.codigo = m_regventas.tipopago
					Left Join m_cteventas ON m_cteventas.id_regventas = m_regventas.id_regventas
					Inner Join tipocomprobante ON tipocomprobante.idcompro = m_regventas.tipo_docu
					where d_regventas.kardex = '$codkardex'";
	
		$exe_fact = mysql_query($sql_fact, $conexion);
		
		$i=0; 
		 
		while($facts = mysql_fetch_array($exe_fact, MYSQL_ASSOC))
		{
			$arr_facts[$i][0] = $facts["descompro"];
			$arr_facts[$i][1] = $facts["serie"];
			$arr_facts[$i][2] = $facts["factura"];
			$arr_facts[$i][3] = $facts["fecha"];
			$arr_facts[$i][4] = $facts["descrip"];
			$arr_facts[$i][5] = $facts["imp_total"];
			$arr_facts[$i][6] = $facts["saldo"];
			$i++;
		}
		
		return $arr_facts;
	
	}
	
	function detalle_movs($kardex){
		
		$conexion = Conectar();
		
		$sql = "SELECT 
				movirrpp.idmovreg,
				movirrpp.kardex
				FROM movirrpp
				WHERE
				movirrpp.kardex =  $kardex";
		
		$exe = mysql_query($sql, $conexion);
		
		$rows = mysql_fetch_array($exe, MYSQL_ASSOC);

		$id_mov = correlativo_numero10($rows['idmovreg']);
		
		$sql_dmovs =    "SELECT
						 detallemovimiento.fechamov,
						 detallemovimiento.titulorp,
						 detallemovimiento.importee,
						 estadoregistral.desestreg,
						 sedesregistrales.dessede,
						 seccionesregistrales.dessecc,
						 tipotramogestion.desctiptraoges,
						 detallemovimiento.idmovreg,
						 detallemovimiento.itemmov,
						 detallemovimiento.idestreg
						 FROM
						 detallemovimiento
						 Inner Join estadoregistral ON estadoregistral.idestreg = detallemovimiento.idestreg
						 Inner Join sedesregistrales ON sedesregistrales.idsedereg = detallemovimiento.idsedereg
						 Left Join seccionesregistrales ON seccionesregistrales.idsecreg = detallemovimiento.idsecreg
						 Inner Join tipotramogestion ON tipotramogestion.idtiptraoges = detallemovimiento.idtiptraoges
						 where detallemovimiento.idmovreg= $id_mov
						 order by cast(detallemovimiento.titulorp as unsigned) asc, detallemovimiento.fechamov asc, detallemovimiento.idestreg asc";
						 
		$exe_dmovs = mysql_query($sql_dmovs, $conexion);
		
		$i=0; 
		
		$total_importe = 0;
		$mayor_derecho = 0;
		 
		while($dmovs = mysql_fetch_array($exe_dmovs, MYSQL_ASSOC))
		{
			$arr_dmovs[$i][0] = $dmovs["fechamov"];
			$arr_dmovs[$i][1] = $dmovs["desctiptraoges"];
			$arr_dmovs[$i][2] = $dmovs["titulorp"];
			$arr_dmovs[$i][3] = $dmovs["desestreg"];
			$arr_dmovs[$i][4] = $dmovs["importee"];
			$arr_dmovs[$i][5] = $dmovs["dessede"];
			$arr_dmovs[$i][6] = $dmovs["dessecc"];
			$arr_dmovs[$i][7] = $dmovs["idmovreg"];
			$arr_dmovs[$i][8] = $dmovs["itemmov"];
			$arr_dmovs[$i][9] = $dmovs["idestreg"];
			if($arr_dmovs[$i][9]<>"L"){$total_importe = $total_importe + $arr_dmovs[$i][4];}
			if($arr_dmovs[$i][9]=="L"){$mayor_derecho = $mayor_derecho + $arr_dmovs[$i][4];}
			$arr_dmovs[0]['total_importe'] = round($total_importe* 100)/100;
			$arr_dmovs[0]['mayor_derecho'] = round($mayor_derecho* 100)/100;
			$i++;
		}
		
		return $arr_dmovs;
		
	}
	
	function detalle_mov($id_dmov){
		
		$conexion = Conectar();
		
		$sql_dmov  =    "SELECT
						 detallemovimiento.fechamov,
						 detallemovimiento.titulorp,
						 detallemovimiento.importee,
						 estadoregistral.desestreg,
						 sedesregistrales.dessede,
						 seccionesregistrales.dessecc,
						 tipotramogestion.desctiptraoges,
						 detallemovimiento.idmovreg,
						 detallemovimiento.itemmov,
						 detallemovimiento.vencimiento,
						 detallemovimiento.observa,
						 detallemovimiento.encargado,
						 detallemovimiento.anotacion,
						 detallemovimiento.idsedereg,
						 detallemovimiento.idsecreg,
						 detallemovimiento.idtiptraoges,
						 detallemovimiento.idestreg,
						 detallemovimiento.itemmov
						 FROM
						 detallemovimiento
						 Inner Join estadoregistral ON estadoregistral.idestreg = detallemovimiento.idestreg
						 Inner Join sedesregistrales ON sedesregistrales.idsedereg = detallemovimiento.idsedereg
						 Left Join seccionesregistrales ON seccionesregistrales.idsecreg = detallemovimiento.idsecreg
						 Inner Join tipotramogestion ON tipotramogestion.idtiptraoges = detallemovimiento.idtiptraoges
						 where detallemovimiento.itemmov = $id_dmov";
						 
		$exe_dmov = mysql_query($sql_dmov, $conexion);
		
		$i=0; 
		 
		while($dmov = mysql_fetch_array($exe_dmov, MYSQL_ASSOC))
		{
			$arr_dmov[0] = $dmov["fechamov"];
			$arr_dmov[1] = $dmov["desctiptraoges"];
			$arr_dmov[2] = $dmov["titulorp"];
			$arr_dmov[3] = $dmov["desestreg"];
			$arr_dmov[4] = $dmov["importee"];
			$arr_dmov[5] = $dmov["dessede"];
			$arr_dmov[6] = $dmov["dessecc"];
			$arr_dmov[7] = $dmov["idmovreg"];
			$arr_dmov[8] = $dmov["vencimiento"];
			$arr_dmov[9] = $dmov["observa"];
			$arr_dmov[10] = $dmov["encargado"];
			$arr_dmov[11] = $dmov["anotacion"];
			$arr_dmov[12] = $dmov["idsedereg"];
			$arr_dmov[13] = $dmov["idsecreg"];
			$arr_dmov[14] = $dmov["idtiptraoges"];
			$arr_dmov[15] = $dmov["idestreg"];
			$arr_dmov[16] = $dmov["itemmov"];

			$i++;
		}
		
		return $arr_dmov;
		
	}
	
	
	function dame_contratantes($kardex){
		
		$conexion = Conectar();   
		   
		$sql_contratantes =  "SELECT
							  contratantes.idcontratante,
							  cliente2.nombre,
							  cliente2.razonsocial,
							  cliente2.prinom as nom1,
							  cliente2.segnom as nom2,
							  cliente2.apepat as ape1,
							  cliente2.apemat as ape2,
							  contratantes.kardex,
							  contratantes.condicion,
							  contratantes.firma,
							  contratantes.fechafirma,
							  contratantes.resfirma,
							  usuarios.prinom,
							  usuarios.apepat,
							  usuarios.apemat
							  FROM
							  contratantes
							  Inner Join cliente2 ON cliente2.idcontratante = contratantes.idcontratante
							  Left Join usuarios ON usuarios.idusuario = contratantes.resfirma
							  WHERE
							  contratantes.kardex =  '$kardex'";  
							  
							  

		$exe_contratantes = mysql_query($sql_contratantes, $conexion);	
		
		$i=0;
		
		while($contratantes = mysql_fetch_array($exe_contratantes, MYSQL_ASSOC))
	    {
			$arr_contratantes[$i][0] = $contratantes["nombre"];
			$arr_contratantes[$i][1] = $contratantes["razonsocial"];
			if($contratantes["firma"]==1){$arr_contratantes[$i][2] = "SI";}
			if($contratantes["firma"]==0){$arr_contratantes[$i][2] = "NO";}
			$arr_contratantes[$i][3] = $contratantes["fechafirma"];
			$arr_contratantes[$i][4] = $contratantes["resfirma"];
			$arr_contratantes[$i][5] = $contratantes["apepat"].' '.$contratantes["apemat"].' '.$contratantes["prinom"];
			$arr_contratantes[$i][6] = $contratantes["idcontratante"];
			$arr_contratantes[$i][7] = $contratantes["condicion"];
			$arr_contratantes[$i][8] = $contratantes["ape1"].' '.$contratantes["ape2"].' '.$contratantes["nom1"].' '.$contratantes["nom2"];
			$i++;
	    }
		
		return $arr_contratantes;
			
	}
	
	
	function dame_contratante($id_contratante){
		
		$conexion = Conectar();   
		   
		$sql_contratante = "SELECT
							contratantes.idcontratante,
							contratantes.idtipkar,
							contratantes.kardex,
							contratantes.condicion,
							contratantes.firma,
							contratantes.fechafirma,
							contratantes.resfirma,
							contratantes.tiporepresentacion,
							contratantes.idcontratanterp,
							contratantes.idsedereg,
							contratantes.numpartida,
							contratantes.facultades,
							contratantes.indice,
							contratantes.visita,
							contratantes.inscrito,
							cliente2.idcliente,
							cliente2.nombre,
							cliente2.razonsocial,
							cliente2.tipper,
							cliente2.apepat as ape1,
							cliente2.apemat as ape2,
							cliente2.prinom as nom1,
							cliente2.segnom as nom2,
							cliente2.direccion,
							cliente2.idtipdoc,
							cliente2.numdoc,
							cliente2.email,
							cliente2.telfijo,
							cliente2.telcel,
							cliente2.telofi,
							cliente2.sexo,
							cliente2.idestcivil,
							cliente2.natper,
							cliente2.conyuge,
							cliente2.nacionalidad,
							cliente2.idprofesion,
							cliente2.detaprofesion,
							cliente2.idcargoprofe,
							cliente2.profocupa,
							cliente2.idubigeo,
							cliente2.cumpclie,
							cliente2.domfiscal,
							cliente2.telempresa,
							cliente2.mailempresa,
							cliente2.contacempresa,
							cliente2.fechaconstitu,
							cliente2.idsedereg,
							cliente2.numregistro,
							cliente2.numpartida,
							cliente2.residente,
							cliente2.docpaisemi
							FROM
							contratantes
							Inner Join cliente2 ON cliente2.idcontratante = contratantes.idcontratante
							WHERE
							contratantes.idcontratante =  '$id_contratante'";  

		$exe_contratante = mysql_query($sql_contratante, $conexion);	
		
		while($contratante = mysql_fetch_array($exe_contratante, MYSQL_ASSOC))
	    {
			$arr_contratante[0] = $contratante["idcontratante"];			
			$arr_contratante[1] = $contratante["firma"];			
			$arr_contratante[2] = $contratante["indice"];			
			$arr_contratante[3] = $contratante["tiporepresentacion"];			
			$arr_contratante[4] = $contratante["nombre"];
			$arr_contratante[5] = $contratante["razonsocial"];
			$arr_contratante[6] = $contratante["tipper"];
			$arr_contratante[7] = $contratante["nom1"];
			$arr_contratante[8] = $contratante["nom2"];
			$arr_contratante[9] = $contratante["ape1"];
			$arr_contratante[10] = $contratante["ape2"];
			$arr_contratante[11] = $contratante["direccion"];
			$arr_contratante[12] = $contratante["idtipdoc"];
			$arr_contratante[13] = $contratante["numdoc"];
			$arr_contratante[14] = $contratante["email"];
			$arr_contratante[15] = $contratante["telfijo"];
			$arr_contratante[16] = $contratante["telcel"];
			$arr_contratante[17] = $contratante["telofi"];
			$arr_contratante[18] = $contratante["sexo"];
			$arr_contratante[19] = $contratante["idestcivil"];
			$arr_contratante[20] = $contratante["natper"];
			$arr_contratante[21] = $contratante["conyuge"];
			$arr_contratante[22] = $contratante["nacionalidad"];
			$arr_contratante[23] = $contratante["idprofesion"];
			$arr_contratante[24] = $contratante["detaprofesion"];
			$arr_contratante[25] = $contratante["idcargoprofe"];
			$arr_contratante[26] = $contratante["profocupa"];
			$arr_contratante[27] = $contratante["idubigeo"];
			$arr_contratante[28] = $contratante["cumpclie"];
			$arr_contratante[29] = $contratante["domfiscal"];
			$arr_contratante[30] = $contratante["telempresa"];
			$arr_contratante[31] = $contratante["mailempresa"];
			$arr_contratante[32] = $contratante["contacempresa"];
			$arr_contratante[33] = $contratante["fechaconstitu"];
			$arr_contratante[34] = $contratante["idsedereg"];
			$arr_contratante[35] = $contratante["numregistro"];
			$arr_contratante[36] = $contratante["numpartida"];
			$arr_contratante[37] = $contratante["residente"];
			$arr_contratante[38] = $contratante["docpaisemi"];
			$arr_contratante[39] = $contratante["ape1"].' '.$contratante["ape2"].' '.$contratante["nom1"].' '.$contratante["nom2"];
			$arr_contratante[40] = $contratante["idcliente"];
			
		}
		
		return $arr_contratante;
			
	}
	
	function dame_cliente($id_cliente){
		
		$conexion = Conectar();   
		   
		$sql_cliente =  "SELECT
						 cliente.idcliente,
						 cliente.tipper,
						 cliente.apepat,
						 cliente.apemat,
						 cliente.prinom,
						 cliente.segnom,
						 cliente.direccion,
						 cliente.nombre,
						 cliente.razonsocial,
						 cliente.domfiscal,
						 cliente.idtipdoc,
						 cliente.numdoc,
						 cliente.email,
						 cliente.telfijo,
						 cliente.telcel,
						 cliente.telofi,
						 cliente.sexo,
						 cliente.idestcivil,
						 cliente.natper,
						 cliente.conyuge,
						 cliente.nacionalidad,
						 cliente.idprofesion,
						 cliente.detaprofesion,
						 cliente.idcargoprofe,
						 cliente.profocupa,
						 cliente.dirfer,
						 cliente.idubigeo,
						 cliente.cumpclie,
						 cliente.fechaing,
						 cliente.telempresa,
						 cliente.mailempresa,
						 cliente.contacempresa,
						 cliente.fechaconstitu,
						 cliente.idsedereg,
						 cliente.numregistro,
						 cliente.numpartida,
						 cliente.actmunicipal,
						 cliente.tipocli,
						 cliente.impeingre,
						 cliente.impnumof,
						 cliente.impeorigen,
						 cliente.impentidad,
						 cliente.impremite,
						 cliente.impmotivo,
						 cliente.residente,
						 cliente.docpaisemi
						 FROM
						 cliente
						 WHERE
						 cliente.idcliente =  '$id_cliente'";  

		$exe_cliente = mysql_query($sql_cliente, $conexion);	
		
		while($cliente = mysql_fetch_array($exe_cliente, MYSQL_ASSOC))
	    {
			$arr_cliente[0] = $cliente["idcliente"];
			$arr_cliente[1] = $cliente["tipper"];
			$arr_cliente[2] = $cliente["apepat"];
			$arr_cliente[3] = $cliente["apemat"];
			$arr_cliente[4] = $cliente["prinom"];
			$arr_cliente[5] = $cliente["segnom"];
			$arr_cliente[6] = $cliente["direccion"];
			$arr_cliente[7] = $cliente["nombre"];
			$arr_cliente[8] = $cliente["razonsocial"];
			$arr_cliente[9] = $cliente["domfiscal"];
			$arr_cliente[10] = $cliente["numdoc"];
			$arr_cliente[11] = $cliente["email"];
			$arr_cliente[12] = $cliente["telfijo"];
			$arr_cliente[13] = $cliente["telcel"];
			$arr_cliente[14] = $cliente["telofi"];
			$arr_cliente[15] = $cliente["sexo"];
			$arr_cliente[16] = $cliente["idestcivil"];
			$arr_cliente[17] = $cliente["natper"];
			$arr_cliente[18] = $cliente["conyuge"];
			$arr_cliente[19] = $cliente["nacionalidad"];
			$arr_cliente[20] = $cliente["idprofesion"];
			$arr_cliente[21] = $cliente["detaprofesion"];
			$arr_cliente[22] = $cliente["idcargoprofe"];
			$arr_cliente[23] = $cliente["profocupa"];
			$arr_cliente[24] = $cliente["dirfer"];
			$arr_cliente[25] = $cliente["idubigeo"];
			$arr_cliente[26] = $cliente["cumpclie"];			
			$arr_cliente[27] = $cliente["fechaing"];			
			$arr_cliente[28] = $cliente["telempresa"];			
			$arr_cliente[29] = $cliente["mailempresa"];			
			$arr_cliente[30] = $cliente["contacempresa"];			
			$arr_cliente[31] = $cliente["fechaconstitu"];			
			$arr_cliente[32] = $cliente["idsedereg"];			
			$arr_cliente[33] = $cliente["numregistro"];			
			$arr_cliente[34] = $cliente["numpartida"];			
			$arr_cliente[35] = $cliente["actmunicipal"];			
			$arr_cliente[36] = $cliente["tipocli"];			
			$arr_cliente[37] = $cliente["impeingre"];			
			$arr_cliente[38] = $cliente["impnumof"];			
			$arr_cliente[39] = $cliente["impeorigen"];			
			$arr_cliente[40] = $cliente["impentidad"];			
			$arr_cliente[41] = $cliente["impremite"];			
			$arr_cliente[42] = $cliente["impmotivo"];			
			$arr_cliente[43] = $cliente["residente"];
			$arr_cliente[44] = $cliente["docpaisemi"];			
			$arr_cliente[45] = $cliente["idtipdoc"];
			
	    }
		
		return $arr_cliente;
		
	}
	
		   
	
	function dame_estregistrales(){
		
		$conexion = Conectar();
		
	    $sql_estados = 	"SELECT
						 estadoregistral.idestreg,
						 estadoregistral.desestreg
						 FROM
						 estadoregistral";
					   
		$exe_estados = mysql_query($sql_estados, $conexion);
		
		$i=0;
		
		while($estados = mysql_fetch_array($exe_estados, MYSQL_ASSOC))
	    {
			$arr_estados[$i][0] = $estados["idestreg"];
			$arr_estados[$i][1] = $estados["desestreg"];
			$i++;
	    }
		
		return $arr_estados;
		
	}
	
	function dame_sedesregistrales(){
		
		$conexion = Conectar();
		
	    $sql_sedes = 	"SELECT
						 sedesregistrales.idsedereg,
						 sedesregistrales.dessede,
						 sedesregistrales.num_zona,
						 sedesregistrales.zona_depar
						 FROM
						 sedesregistrales";
					   
		$exe_sedes = mysql_query($sql_sedes, $conexion);
		
		$i=0;
		
		while($sedes = mysql_fetch_array($exe_sedes, MYSQL_ASSOC))
	    {
			$arr_sedes[$i][0] = $sedes["idsedereg"];
			$arr_sedes[$i][1] = $sedes["dessede"];
			$i++;
	    }
		
		return $arr_sedes;
		
	}
	
	function dame_seccionesregistrales(){
		
		$conexion = Conectar();
		
	    $sql_secciones =   "SELECT
							seccionesregistrales.idsecreg,
							seccionesregistrales.dessecc
							FROM
							seccionesregistrales";
					   
		$exe_secciones = mysql_query($sql_secciones, $conexion);
		
		$i=0;
		
		while($secciones = mysql_fetch_array($exe_secciones, MYSQL_ASSOC))
	    {
			$arr_secciones[$i][0] = $secciones["idsecreg"];
			$arr_secciones[$i][1] = $secciones["dessecc"];
			$i++;
	    }
		
		return $arr_secciones;
		
	}
	
	function dame_tramos(){
		
		$conexion = Conectar();
		
	    $sql_tramos =   "SELECT
						 tipotramogestion.idtiptraoges,
						 tipotramogestion.desctiptraoges
						 FROM
						 tipotramogestion";
					   
		$exe_tramos = mysql_query($sql_tramos, $conexion);
		
		$i=0;
		
		while($tramos = mysql_fetch_array($exe_tramos, MYSQL_ASSOC))
	    {
			$arr_tramos[$i][0] = $tramos["idtiptraoges"];
			$arr_tramos[$i][1] = $tramos["desctiptraoges"];
			$i++;
	    }
		
		return $arr_tramos;
		
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
	
	function dame_estciviles(){
		
		$conexion = Conectar();
		
		$sql_estciviles =  "SELECT
							tipoestacivil.idestcivil,
							tipoestacivil.codestcivil,
							tipoestacivil.desestcivil
							FROM
							tipoestacivil";		
						  
		$exe_estciviles = mysql_query($sql_estciviles, $conexion);
		
		$i=0;
		
		while($estciviles = mysql_fetch_array($exe_estciviles, MYSQL_ASSOC))
	    {
			$arr_estciviles[$i][0] = $estciviles["idestcivil"];
			$arr_estciviles[$i][1] = $estciviles["codestcivil"];
			$arr_estciviles[$i][2] = $estciviles["desestcivil"];
			$i++;
	    }
		
		return $arr_estciviles;
		
	}
	
	function dame_paises(){
		
		$conexion = Conectar();
		
		$sql_paises = "SELECT
						nacionalidades.idnacionalidad,
						nacionalidades.codnacion,
						nacionalidades.desnacionalidad,
						nacionalidades.descripcion
						FROM
						nacionalidades";		
						  
		$exe_paises = mysql_query($sql_paises, $conexion);
		
		$i=0;
		
		while($paises = mysql_fetch_array($exe_paises, MYSQL_ASSOC))
	    {
			$arr_paises[$i][0] = $paises["idnacionalidad"];
			$arr_paises[$i][1] = $paises["codnacion"];
			$arr_paises[$i][2] = $paises["desnacionalidad"];
			$arr_paises[$i][3] = $paises["descripcion"];
			$i++;
	    }
		
		return $arr_paises;
		
	}
	
	function dame_nacionalidades(){
		
		$conexion = Conectar();
		
		$sql_paises =  "SELECT
						nacionalidades.idnacionalidad,
						nacionalidades.codnacion,
						nacionalidades.desnacionalidad,
						nacionalidades.descripcion
						FROM
						nacionalidades
						order by nacionalidades.idnacionalidad asc";		
						  
		$exe_paises = mysql_query($sql_paises, $conexion);
		
		$i=0;
		
		while($paises = mysql_fetch_array($exe_paises, MYSQL_ASSOC))
	    {
			$arr_paises[$i][0] = $paises["idnacionalidad"];
			$arr_paises[$i][1] = $paises["codnacion"];
			$arr_paises[$i][2] = $paises["desnacionalidad"];
			$arr_paises[$i][3] = $paises["descripcion"];
			$i++;
	    }
		
		return $arr_paises;
		
	}
	
	function dame_cargos(){
		
		$conexion = Conectar();
		
		$sql_cargos =  "SELECT
						cargoprofe.idcargoprofe,
						cargoprofe.codcargoprofe,
						cargoprofe.descripcrapro
						FROM
						cargoprofe
						order by cargoprofe.descripcrapro asc";		
						  
		$exe_cargos = mysql_query($sql_cargos, $conexion);
		
		$i=0;
		
		while($cargos = mysql_fetch_array($exe_cargos, MYSQL_ASSOC))
	    {
			$arr_cargos[$i][0] = $cargos["idcargoprofe"];
			$arr_cargos[$i][1] = $cargos["codcargoprofe"];
			$arr_cargos[$i][2] = $cargos["descripcrapro"];
			$i++;
	    }
		
		return $arr_cargos;
		
	}
	
	function dame_ocupaciones(){
		
		$conexion = Conectar();
		
		$sql_ocupaciones = "SELECT
							profesiones.idprofesion,
							profesiones.codprof,
							profesiones.desprofesion
							FROM
							profesiones
							order by profesiones.desprofesion asc";		
						  
		$exe_ocupaciones = mysql_query($sql_ocupaciones, $conexion);
		
		$i=0;
		
		while($ocupaciones = mysql_fetch_array($exe_ocupaciones, MYSQL_ASSOC))
	    {
			$arr_ocupaciones[$i][0] = $ocupaciones["idprofesion"];
			$arr_ocupaciones[$i][1] = $ocupaciones["codprof"];
			$arr_ocupaciones[$i][2] = $ocupaciones["desprofesion"];
			$i++;
	    }
		
		return $arr_ocupaciones;
		
	}
	
	function dame_ciiu(){
		
		$conexion = Conectar();
		
		$sql_ciiu = "SELECT
					 ciiu.coddivi,
					 ciiu.nombre,
					 ciiu.codrevi
					 FROM
					 ciiu
					 order by ciiu.nombre";		
						  
		$exe_ciiu = mysql_query($sql_ciiu, $conexion);
		
		$i=0;
		
		while($ciiu = mysql_fetch_array($exe_ciiu, MYSQL_ASSOC))
	    {
			$arr_ciiu[$i][0] = $ciiu["coddivi"];
			$arr_ciiu[$i][1] = $ciiu["nombre"];
			$arr_ciiu[$i][2] = $ciiu["codrevi"];
			$i++;
	    }
		
		return $arr_ciiu;
		
	}
	


	function dame_ubigeos($nom){

		$conexion = Conectar();
		
		$i=0;
		 
		$sql_ubigeos =  "SELECT
						 ubigeo.coddis as id,
						 ubigeo.nomdpto as departamento,
						 ubigeo.nomprov as provincia,
						 ubigeo.nomdis as distrito,
						 ubigeo.codpto as id_dpto,
						 ubigeo.codprov as id_prov,
						 ubigeo.coddist as id_dist
						 FROM
						 ubigeo
						 WHERE 
						 concat(ubigeo.nomdis,'/',ubigeo.nomprov,'/',ubigeo.nomdpto) like '%$nom%' 
						 ORDER BY ubigeo.nomdis,ubigeo.nomprov,ubigeo.nomdpto ASC";
		 
		$exe_ubigeos = mysql_query($sql_ubigeos, $conexion);
		 
		while($ubigeos = mysql_fetch_array($exe_ubigeos, MYSQL_ASSOC))
		{
			$arr_ubigeos[$i][0] = $ubigeos["id"];
			$arr_ubigeos[$i][1] = $ubigeos["departamento"];
			$arr_ubigeos[$i][2] = $ubigeos["provincia"];
			$arr_ubigeos[$i][3] = $ubigeos["distrito"];
			$arr_ubigeos[$i][4] = $ubigeos['distrito'].'/'.$ubigeos['provincia'].'/'.$ubigeos['departamento'];
			$i++;
		}
		

		return $arr_ubigeos;
		
	}
	
	function dame_ubigeo($id_ubigeo){

		$conexion = Conectar();
		
		$i=0;
		 
		$sql_ubigeo =  "SELECT
						 ubigeo.coddis as id,
						 ubigeo.nomdpto as departamento,
						 ubigeo.nomprov as provincia,
						 ubigeo.nomdis as distrito,
						 ubigeo.codpto as id_dpto,
						 ubigeo.codprov as id_prov,
						 ubigeo.coddist as id_dist
						 FROM
						 ubigeo
						 WHERE 
						 ubigeo.coddis = $id_ubigeo";
		 
		$exe_ubigeo = mysql_query($sql_ubigeo, $conexion);
		 
		while($ubigeo = mysql_fetch_array($exe_ubigeo, MYSQL_ASSOC))
		{
			$arr_ubigeo[0] = $ubigeo["id"];
			$arr_ubigeo[1] = $ubigeo["departamento"];
			$arr_ubigeo[2] = $ubigeo["provincia"];
			$arr_ubigeo[3] = $ubigeo["distrito"];
			$arr_ubigeo[4] = $ubigeo['distrito'].'/'.$ubigeo['provincia'].'/'.$ubigeo['departamento'];
			$i++;
		}
		
		return $arr_ubigeo;
		
	}
	
	function dame_ocupacionesdesc($nom){

		$conexion = Conectar();
		
		$i=0;
		 
		$sql_ocupaciones =  "SELECT
							 profesiones.idprofesion,
							 profesiones.codprof,
							 profesiones.desprofesion
							 FROM
							 profesiones
							 WHERE 
							 profesiones.desprofesion like '%$nom%' 
							 ORDER BY profesiones.desprofesion ASC";
		 
		$exe_ocupaciones = mysql_query($sql_ocupaciones, $conexion);
		 
		while($ocupaciones = mysql_fetch_array($exe_ocupaciones, MYSQL_ASSOC))
		{
			$arr_ocupaciones[$i][0] = $ocupaciones["idprofesion"];
			$arr_ocupaciones[$i][1] = $ocupaciones["codprof"];
			$arr_ocupaciones[$i][2] = $ocupaciones["desprofesion"];
			$i++;
		}
		

		return $arr_ocupaciones;
		
	}
	
	function dame_ocupaciondesc($id_ocupacion){

		$conexion = Conectar();
		
		$i=0;
		 
		$sql_ocupacion =  "SELECT
						   profesiones.idprofesion,
						   profesiones.codprof,
						   profesiones.desprofesion
						   FROM
						   profesiones
						   WHERE 
						   profesiones.idprofesion = $id_ocupacion";
		 
		$exe_ocupacion = mysql_query($sql_ocupacion, $conexion);
		 
		while($ocupacion = mysql_fetch_array($exe_ocupacion, MYSQL_ASSOC))
		{
			$arr_ocupacion[0] = $ocupacion["idprofesion"];
			$arr_ocupacion[1] = $ocupacion["codprof"];
			$arr_ocupacion[2] = $ocupacion["desprofesion"];
			$i++;
		}
		
		return $arr_ocupacion;
		
	}
	
	function dame_cargosdesc($nom){

		$conexion = Conectar();
		
		$i=0;
		 
		$sql_cargos =  "SELECT
						cargoprofe.idcargoprofe,
						cargoprofe.codcargoprofe,
						cargoprofe.descripcrapro
						FROM
						cargoprofe
						WHERE 
						cargoprofe.descripcrapro like '%$nom%' 
						ORDER BY cargoprofe.descripcrapro ASC";
		 
		$exe_cargos = mysql_query($sql_cargos, $conexion);
		 
		while($cargos = mysql_fetch_array($exe_cargos, MYSQL_ASSOC))
		{
			$arr_cargos[$i][0] = $cargos["idcargoprofe"];
			$arr_cargos[$i][1] = $cargos["codcargoprofe"];
			$arr_cargos[$i][2] = $cargos["descripcrapro"];
			$i++;
		}
		
		return $arr_cargos;
		
	}
	
	function dame_cargodesc($id_cargo){

		$conexion = Conectar();
		
		$i=0;
		 
		$sql_cargo =  "SELECT
					   cargoprofe.idcargoprofe,
					   cargoprofe.codcargoprofe,
					   cargoprofe.descripcrapro
					   FROM
					   cargoprofe
					   WHERE 
					   cargoprofe.idcargoprofe = $id_cargo";
		 
		$exe_cargo = mysql_query($sql_cargo, $conexion);
		 
		while($cargo = mysql_fetch_array($exe_cargo, MYSQL_ASSOC))
		{
			$arr_cargo[0] = $cargo["idcargoprofe"];
			$arr_cargo[1] = $cargo["codcargoprofe"];
			$arr_cargo[2] = $cargo["descripcrapro"];
			$i++;
		}
		
		return $arr_cargo;
		
	}

 
?>
