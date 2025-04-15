<?php
   
    include('../conexion.php');

    $tipoZona = $_POST['tipoZona'];
    $zona = strtoupper($_POST['zona']);
    $denominacion = strtoupper($_POST['denominacion']);
    $tipoVia = $_POST['tipoVia'];
    $nombreVia = strtoupper($_POST['nombreVia']);
    $numero = $_POST['numero'];
    $lote = strtoupper($_POST['lote']);
    $manzana = strtoupper($_POST['manzana']);
    $kardex = $_POST['kardex'];
    $fechaRegistro = date('Y-m-d G:i:s');

    $querySetPredio = "INSERT INTO predios(tipo,denominacion,zona,tipo_zona,tipo_via,nombre_via,numero,lote,manzana,kardex,fecha_registro) VALUES('URBANO','$denominacion','$zona','$tipoZona','$tipoVia','$nombreVia','$numero','$lote','$manzana','$kardex','$fechaRegistro')";

    //  mysql_query($querySetPredio, $conn) or die(mysql_error());

    mysql_query($querySetPredio, $conn);
    
    if (mysql_error()) {
        $list=  array(
			'status' => false,
			'mensaje' => mysql_error(),
			'codigo' => mysql_errno(),
        );
		echo json_encode($list);
    }else{

        $queryGetPredio = "SELECT * FROM predios where kardex='$kardex'";
        
        $resultPredio = mysql_query($queryGetPredio, $conn) or die(mysql_error());
        $arrPredio = array();
        while($row = mysql_fetch_assoc($resultPredio)){
            $arrPredio['predio'][] = array(
                'denominacion' => $row['denominacion'],
                'tipoZona' => $row['tipo_zona'],
                'zona' => $row['zona'],
                'tipoVia' => $row['tipo_via'],
                'nombreVia' => $row['nombre_via'],
                'numero' => $row['numero'],
                'lote' => $row['lote'],
                'manzana' => $row['manzana'],
                'kardex' => $row['kardex'],
            ); 
        }
    
    
        echo json_encode($arrPredio);
    }

    
?>