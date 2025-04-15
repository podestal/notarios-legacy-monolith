<?php
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();

	$tipdocu = $_REQUEST["tip_docu"];
	
	if($tipdocu=="01" || $tipdocu=="02" || $tipdocu=="04")
	{
		$tipo="N";	
	}
	else if($tipdocu=="03")
	{
		$tipo="C";
	}
	else if($tipdocu=="")
	{
		$tipo="";
	}

    $consulta_serv =   "SELECT
						servicios.id_servicio as id ,
						servicios.descrip as des
						FROM
						servicios";
						
	$consulta_serv = $consulta_serv. " WHERE servicios.tipo = '$tipo'";	
	
	$consulta_serv = $consulta_serv. " ORDER BY servicios.descrip ASC";
						
	$ejecuta_serv = mysql_query($consulta_serv, $conexion);
		
	$i=0;

	while($serv = mysql_fetch_array($ejecuta_serv, MYSQL_ASSOC))
	{
		$arr_serv[$i][0] =  correlativo_numero4($serv["id"]); 
		$arr_serv[$i][1] = $serv["des"];
		$i++; 
	}
	?>
	
	<select id="servicio" name="servicio" style='width:450px;' class='camposss' onchange="cambio_servicio()">
		<option value="0">--Servicio--</option>
        <?php for($j=0;$j<count($arr_serv); $j++){ ?>
		<option value='<?php echo $arr_serv[$j][0]; ?>'><?php echo $arr_serv[$j][1]; ?></option>
		<?php } ?>
	
	</select>
    
    <input id="servicio_d" name="servicio_d" type="hidden" value="<?php echo $arr_serv[$j][1]; ?>"  />
