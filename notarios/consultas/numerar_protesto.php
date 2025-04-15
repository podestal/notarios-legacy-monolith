	<?php
		
	include("../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();
	
	$par = $_REQUEST['par'];
	
	$num_acta = $_REQUEST['num_acta'];
	$participante = $_REQUEST['participante'];
	$nro_protesto = $_REQUEST['nro_protesto'];
	
	$fechade = $_REQUEST['fechade'];
	$fechaa = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 
	
	$fec_ing = $_REQUEST['fec_ing'];
	$fec_cons = $_REQUEST['fec_cons'];
	$fec_not = $_REQUEST['fec_not'];
	
	$pag = $_REQUEST['pag'];

	$consulta_protesto = "SELECT 
						  protesto.id_protesto as id_protesto,
						  protesto.num_protesto as num_protesto,
						  protesto.numero as numero,
						  protesto.fec_ingreso as fec_ingreso,
						  protesto.fec_constancia as fec_constancia,
						  protesto.fec_notificacion as fec_notificacion,
						  tipo_protesto.des_tipop as des_tiprot, 
						  protesto_participantes.descri_parti as participante, 
						  monedas.desmon as tip_moneda, 
						  protesto.importe as importe
						  FROM protesto
						  LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
						  LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
						  LEFT OUTER JOIN protesto_participantes ON protesto_participantes.id_protesto = protesto.id_protesto";
					  
	if($num_acta<>"" and $nro_protesto==""){
	
	   $consulta_protesto = $consulta_protesto." where protesto.num_protesto like '%$num_acta%'";	
		
	}
	
	if($num_acta=="" and $nro_protesto<>""){
	
	   $consulta_protesto = $consulta_protesto." where protesto.id_protesto= $nro_protesto";	
		
	}
					  
	if($num_acta<>"" and $nro_protesto<>""){
	
	   $consulta_protesto = $consulta_protesto." where protesto.id_protesto= $nro_protesto or protesto.num_protesto=$num_acta";	
		
	}

	if($num_acta=="" and $nro_protesto==""){
	
		if($participante<>"" and ($desde=="" or $hasta=="")){
		 $consulta_protesto = $consulta_protesto." where protesto_participantes.descri_parti like '%$participante%'";	
		}
		
		if($participante=="" and ($desde<>"" and $hasta<>"")){
			if($fec_ing=="1"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";	
			}
			if($fec_cons=="2"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";	
			}
			if($fec_not=="3"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";	
			}
		}
		
		if($participante<>"" and ($desde<>"" and $hasta<>"")){
			if($fec_ing=="1"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') and protesto_participantes.descri_parti like '%$participanteo%'";	
			}
			if($fec_cons=="2"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') and protesto_participantes.descri_parti like '%$participante%'";	
			}
			if($fec_not=="3"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') and protesto_participantes.descri_parti like '%$participante%'";	
			}
		}
	
	}

	$consulta_protesto = $consulta_protesto." GROUP BY protesto.id_protesto";

/*
if($desde<>"" and $hasta<>""){
	if($fec_ing=="on"){
		$consulta_protesto = $consulta_protesto." ORDER BY STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d')";
	}
	if($fec_cons=="on"){
		$consulta_protesto = $consulta_protesto." ORDER BY STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d')";
	}
	if($fec_not=="on"){
		$consulta_protesto = $consulta_protesto." ORDER BY STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d')";
	}
}else{*/
	$consulta_protesto = $consulta_protesto." ORDER BY protesto.id_protesto";

//}

	$ejecutar_protesto = mysql_query($consulta_protesto, $conexion);
	
	$total_protesto = mysql_num_rows($ejecutar_protesto);
	
	$i=0;
	
	while($protest = mysql_fetch_array($ejecutar_protesto)){
	
		$arr_protest[$i][0] = $protest["id_protesto"]; 
		$arr_protest[$i][1] = $protest["numero"]; 
		$arr_protest[$i][2] = $protest["fec_ingreso"]; 
		$arr_protest[$i][3] = $protest["fec_notificacion"];
		$arr_protest[$i][4] = $protest["fec_constancia"]; 
		$arr_protest[$i][5] = $protest["des_tiprot"]; 
		$arr_protest[$i][6] = $protest["participante"]; 
		$arr_protest[$i][7] = $protest["tip_moneda"]; 
		$arr_protest[$i][8] = $protest["importe"]; 
		$arr_protest[$i][9] = $protest["num_protesto"]; 
		$i++; 
		  
	}

	if($par==1){
		/*for($i=0; $i<$total_protesto; $i++){
			$number = "2015".correlativo_numero($i+1);
			$sql_numprotesto =  "update protesto set num_protesto='$number' where protesto.id_protesto ='".$arr_protest[$i][0]."'";	
			$exe_numprotesto = mysql_query($sql_numprotesto, $conexion);	
			
		}*/
		$num=0;
		for($i=$total_protesto; $i>=0; $i--){
			$number = "2015".correlativo_numero($i+1);
			$sql_numprotesto =  "update protesto set num_protesto='$number' where protesto.id_protesto ='".$arr_protest[$i][0]."'";
			//$sql_numprotesto =  "update protesto set num_protesto='$number' WHERE id_protesto ='7'";	
			$exe_numprotesto = mysql_query($sql_numprotesto, $conexion);
			if($num==10){
				break;
			}
			$num++;
		}
	}
	
	if($par==2){
		for($i=0; $i<$total_protesto; $i++){
			$sql_numprotesto =  "update protesto set num_protesto='' where protesto.id_protesto ='".$arr_protest[$i][0]."'";	
			$exe_numprotesto = mysql_query($sql_numprotesto, $conexion);
		}
	}
	

?>
