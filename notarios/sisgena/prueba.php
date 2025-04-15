<?php
$dato = '1.  VENTA DE REPUESTOS            PARA VEHICULOS AUTOMOTORES AUTOMOTORES AUTOMOTORES AUTOMOTORES AUTOMOTORES AUTOMOTORES AUTOMOTORES AUTOMOTORES AUTOMOTORES';
	$result =  preg_match('/\s\s/', $dato);
	$result +=  preg_match('/\t/', $dato);
	$result +=  preg_match('/\</', $dato);
	$result +=  preg_match('/\>/', $dato);
	$info=trim($dato," \t.");
	
	echo $dato;
	echo '<br>';
	echo $info;
	
	
?>