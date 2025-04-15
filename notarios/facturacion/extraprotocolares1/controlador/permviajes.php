<?
 require("../view/conexion.php");

 function devolver_viajes($par, $nro_control, $num_crono, $tip_permiso, $participante, $rango1, $rango2, $opcion, $pag){
 
 $conexion = Conectar();
 
 if($par=='1'){
     
       $query25=   "SELECT
					permi_viaje.id_viaje as cod_viaje,
					permi_viaje.fec_ingreso as fec_ingreso,
					viaje_contratantes.c_descontrat as participante,
					c_condiciones.des_condicion as cond,
					permi_viaje.fecha_crono as fec_crono,
					permi_viaje.num_kardex as kard,
					asunto_viaje.des_asunto as asunto
					FROM
					permi_viaje
					LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
					LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
					LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
					GROUP BY
					permi_viaje.id_viaje";

	  }elseif($par=='2'){
		
			if($nro_control <> "" and $num_crono <> ""){
				$query25 = "SELECT
							permi_viaje.id_viaje as cod_viaje,
							permi_viaje.fec_ingreso as fec_ingreso,
							viaje_contratantes.c_descontrat as participante,
							c_condiciones.des_condicion as cond,
							permi_viaje.fecha_crono as fec_crono,
							permi_viaje.num_kardex as kard,
							asunto_viaje.des_asunto as asunto
							FROM
							permi_viaje
							LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
							LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
							LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
							where permi_viaje.id_viaje = $nro_control or permi_viaje.num_kardex = $num_crono
							GROUP BY
							permi_viaje.id_viaje";		
			}

			if($nro_control <> "" and $num_crono == ""){
			    $query25 =  "SELECT
							permi_viaje.id_viaje as cod_viaje,
							permi_viaje.fec_ingreso as fec_ingreso,
							viaje_contratantes.c_descontrat as participante,
							c_condiciones.des_condicion as cond,
							permi_viaje.fecha_crono as fec_crono,
							permi_viaje.num_kardex as kard,
							asunto_viaje.des_asunto as asunto
							FROM
							permi_viaje
							LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
							LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
							LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
							where permi_viaje.id_viaje = $nro_control
							GROUP BY
							permi_viaje.id_viaje";
			}

			if($nro_control == "" and $num_crono <> ""){
				$query25 = "SELECT
							permi_viaje.id_viaje as cod_viaje,
							viaje_contratantes.c_descontrat as participante,
							c_condiciones.des_condicion as cond,
							permi_viaje.fec_ingreso as fec_ingreso,
							permi_viaje.fecha_crono as fec_crono,
							permi_viaje.num_kardex as kard,
							asunto_viaje.des_asunto as asunto
							FROM
							permi_viaje
							LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
							LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
							LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
							where permi_viaje.num_kardex = $num_crono
							GROUP BY
							permi_viaje.id_viaje";
			}
		
		    if($nro_control == "" and $num_crono == ""){
				if($opcion==""){
					if($tip_permiso== '' and $participante == ''){
						$query25 = "SELECT
									permi_viaje.id_viaje as cod_viaje,
									viaje_contratantes.c_descontrat as participante,
									c_condiciones.des_condicion as cond,
									permi_viaje.fec_ingreso as fec_ingreso,
									permi_viaje.fecha_crono as fec_crono,
									permi_viaje.num_kardex as kard,
									asunto_viaje.des_asunto as asunto
									FROM
									permi_viaje
									LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
									LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
									LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
									GROUP BY
									permi_viaje.id_viaje";
					}
					if($tip_permiso <> '' and $participante == ''){
					    $query25 = "SELECT
									permi_viaje.id_viaje as cod_viaje,
									viaje_contratantes.c_descontrat as participante,
									c_condiciones.des_condicion as cond,
									permi_viaje.fec_ingreso as fec_ingreso,
									permi_viaje.fecha_crono as fec_crono,
									permi_viaje.num_kardex as kard,
									asunto_viaje.id_asunto,
									asunto_viaje.des_asunto as asunto
									FROM
									permi_viaje
									LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
									LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
									LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
									where asunto_viaje.id_asunto = $tip_permiso
									GROUP BY
									permi_viaje.id_viaje";
					} 
					if($tip_permiso == '' and $participante <> ''){
						$query25 = "SELECT
									permi_viaje.id_viaje as cod_viaje,
									viaje_contratantes.c_descontrat as participante,
									c_condiciones.des_condicion as cond,
									permi_viaje.fec_ingreso as fec_ingreso,
									permi_viaje.fecha_crono as fec_crono,
									permi_viaje.num_kardex as kard,
									asunto_viaje.id_asunto,
									asunto_viaje.des_asunto as asunto
									FROM
									permi_viaje
									LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
									LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
									LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
									where viaje_contratantes.c_descontrat like '%$participante%'
									GROUP BY
									permi_viaje.id_viaje";
					}
					if($tip_permiso<> '' and $participante <> ''){
						$query25 = "SELECT
									permi_viaje.id_viaje as cod_viaje,
									viaje_contratantes.c_descontrat as participante,
									c_condiciones.des_condicion as cond,
									permi_viaje.fec_ingreso as fec_ingreso,
									permi_viaje.fecha_crono as fec_crono,
									permi_viaje.num_kardex as kard,
									asunto_viaje.id_asunto,
									asunto_viaje.des_asunto as asunto
									FROM
									permi_viaje
									LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
									LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
									LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
									where asunto_viaje.id_asunto = $tip_permiso and viaje_contratantes.c_descontrat like '%$participante%'
									GROUP BY
									permi_viaje.id_viaje";
					}
			   }
			   else{
					if($opcion1<>"" and $rango1<> "" and $rango2<> ""){
							if($tip_permiso== '' and $participante == ''){
							   $query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where permi_viaje.fec_ingreso >= '$rango1' and permi_viaje.fec_ingreso <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";
							}
							if($tip_permiso <> '' and $participante == ''){
							   $query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where asunto_viaje.id_asunto = $tip_permiso and permi_viaje.fec_ingreso >= '$rango1' and permi_viaje.fec_ingreso <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";
							} 
							if($tip_permiso == '' and $participante <> ''){
							   $query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where viaje_contratantes.c_descontrat like '%$participante%' and permi_viaje.fec_ingreso >= '$rango1' and permi_viaje.fec_ingreso <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";
							}
							if($tip_permiso<> '' and $participante <> ''){
								$query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where asunto_viaje.id_asunto = $tip_permiso and viaje_contratantes.c_descontrat like '%$participante%' and permi_viaje.fec_ingreso >= '$rango1' and permi_viaje.fec_ingreso <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";
							}  	
					}

					if($opcion<>"" and $rango1<> "" and $rango2<> ""){
							if($tip_permiso== '' and $participante == ''){
							   $query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where permi_viaje.fecha_crono >= '$rango1' and permi_viaje.fecha_crono <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";
							}				
							if($tip_permiso <> '' and $participante == ''){
							   $query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where asunto_viaje.id_asunto = $tip_permiso and permi_viaje.fecha_crono >= '$rango1' and permi_viaje.fecha_crono <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";
							} 
							if($tip_permiso == '' and $participante <> ''){
							   $query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where viaje_contratantes.c_descontrat like '%$participante%' and permi_viaje.fecha_crono >= '$rango1' and permi_viaje.fecha_crono <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";
							}
							if($tip_permiso<> '' and $participante <> ''){
							   $query25 =  "SELECT
											permi_viaje.id_viaje as cod_viaje,
											viaje_contratantes.c_descontrat as participante,
											c_condiciones.des_condicion as cond,
											permi_viaje.fec_ingreso as fec_ingreso,
											permi_viaje.fecha_crono as fec_crono,
											permi_viaje.num_kardex as kard,
											asunto_viaje.id_asunto,
											asunto_viaje.des_asunto as asunto
											FROM
											permi_viaje
											LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
											LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
											LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
											where asunto_viaje.id_asunto = $tip_permiso and viaje_contratantes.c_descontrat like '%$participante%' and permi_viaje.fecha_crono >= '$rango1' and permi_viaje.fecha_crono <= '$rango2'
											GROUP BY
											permi_viaje.id_viaje";						
						   }
					}

					if($rango1 == "" or $rango2 == "" and $opcion1 <> "" or $opcion1 <> ""){
						$query25 =  "SELECT
						permi_viaje.id_viaje as cod_viaje,
						permi_viaje.fec_ingreso as fec_ingreso,
						viaje_contratantes.c_descontrat as participante,
						c_condiciones.des_condicion as cond,
						permi_viaje.fecha_crono as fec_crono,
						permi_viaje.num_kardex as kard,
						asunto_viaje.des_asunto as asunto
						FROM
						permi_viaje
						LEFT JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
						LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id
						LEFT JOIN asunto_viaje ON asunto_viaje.id_asunto = permi_viaje.asunto
						GROUP BY
						permi_viaje.id_viaje";
					}
			   }		
	        }
	  }
	 
	  $ejecuta25 = mysql_query($query25, $conexion);
	  
	  $total_viajes = mysql_num_rows($ejecuta25);
	  
	  $pag=$pag-1;
	  
      $num_reg = 15;
	  
	  $inicio=$pag*$num_reg;
	  
	  $num_pag = ceil($total_viajes/$num_reg);
						   
	  $query25 = $query25." ORDER BY permi_viaje.id_viaje DESC LIMIT $inicio, $num_reg";
	  
	  //echo $query25;
	  
	  $ejecuta25 = mysql_query($query25, $conexion);
	  
	  $i=0;
	  
	  while($viajes = mysql_fetch_array($ejecuta25, MYSQL_ASSOC))
	  {
		$arr_pviajes[$i][0] = $viajes["cod_viaje"]; 
		$arr_pviajes[$i][1] = $viajes["participante"];
		$arr_pviajes[$i][2] = $viajes["cond"];
		$arr_pviajes[$i][3] = $viajes["fec_ingreso"];
		$arr_pviajes[$i][4] = $viajes["fec_crono"];
		$arr_pviajes[$i][5] = $viajes["kard"];
		$arr_pviajes[$i][6] = $viajes["asunto"];
		$i++; 
	  }
	  
	  return $arr_pviajes;
	  
 	  }

?>