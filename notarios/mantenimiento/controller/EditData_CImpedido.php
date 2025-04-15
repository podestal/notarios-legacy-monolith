<?php
	include('../../conexion.php');
	
	//$idkar = $_POST["idkar"];
	
	$id_cliente_edit = $_POST["id_cliente_edit"];
	$fechaing2 		 = $_POST["fechaing2"]; 
	$origen2   		 = $_POST["origen2"];
	$entidad2  		 = $_POST["entidad2"];
	$remite2   		 = $_POST["remite2"];
	$motivo2   		 = $_POST["motivo2"];
	$oficio2   		 = $_POST["oficio2"];
	$pep2      		 = 0;
	$laft2     		 = 0;

// actualiza tabla clientes : 
	$grabartipkardex = "UPDATE cliente SET cliente.tipocli = '1', cliente.impeingre = '$fechaing2', cliente.impnumof = '$oficio2', cliente.impeorigen = '$origen2', cliente.impentidad = '$entidad2', cliente.impremite = '$remite2', cliente.impmotivo = '$motivo2' WHERE cliente.idcliente = '$id_cliente_edit'";
	mysql_query($grabartipkardex,$conn) or die(mysql_error());
	

// verifica si existe en la tabla impedidos:
	$busimpedido = "SELECT impedidos.idimpedido FROM impedidos WHERE impedidos.idcliente = '$id_cliente_edit'";
	$numimpedido = mysql_query($busimpedido,$conn) or die(mysql_error());
	$rownum = mysql_fetch_array($numimpedido);
	$newnumimpedido  = $rownum[0];


	if($newnumimpedido=='')
	{
	// crea el ID del impedido : 
		$creaimpedido = "SELECT CONCAT(REPEAT('0',10-LENGTH((MAX(CAST(RIGHT(impedidos.idimpedido,10) AS DECIMAL))+1))),(MAX(CAST(RIGHT(impedidos.idimpedido,10) AS DECIMAL))+1)) AS idimpedido FROM impedidos
";
		$nuevoimpedido = mysql_query($creaimpedido,$conn) or die(mysql_error());
		$rowimpe = mysql_fetch_array($nuevoimpedido);
		$id_new_impedido  = $rowimpe[0];
		
	// graba en impedidos      : 
		$grabarimpedido = "INSERT INTO impedidos(idimpedido, idcliente, fechaing, oficio, origen, motivo, pep, laft) VALUES('$id_new_impedido', '$id_cliente_edit', '$fechaing2', '$oficio2', '$origen2', '$motivo2', '$pep2', '$laft2')";
		mysql_query($grabarimpedido,$conn) or die(mysql_error());
	}
	else if ($newnumimpedido!='')
	{
	// actualiza el impedido : 	
		$actualizaimpedido = "UPDATE impedidos SET fechaing = '$fechaing2', oficio = '$oficio2', origen = '$origen2', motivo = '$motivo2', pep = '$pep2', laft = '$laft2' WHERE idcliente = '$id_cliente_edit' ";
		mysql_query($actualizaimpedido,$conn) or die(mysql_error());	
	}

	mysql_close($conn);
?>