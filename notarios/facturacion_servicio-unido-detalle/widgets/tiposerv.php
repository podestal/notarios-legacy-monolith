<?php
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();

    $consulta_tipserv = "SELECT tipo_serv.id_serv AS 'id', tipo_serv.des_tipserv AS 'des' FROM tipo_serv ORDER BY tipo_serv.des_tipserv ASC";
		
	$ejecuta_tipserv = mysql_query($consulta_tipserv, $conexion);
		
	$i=0;

	while($tipserv = mysql_fetch_array($ejecuta_tipserv, MYSQL_ASSOC))
	{
		$arr_tipserv[$i][0] = $tipserv["id"]; 
		$arr_tipserv[$i][1] = $tipserv["des"];
		$i++; 
	} ?>
	
	<select id="tip_servicio" name="tip_servicio" style='width:130px;' class='camposss' onchange="mostrar_area(this.value);">
	   <option value="1">DETALLAR</option>
       <option value="2" selected="selected">ESPECIFICO</option>
	</select>