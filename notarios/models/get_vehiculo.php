<?php
   
    include('../conexion.php');

    $placa = $_POST['placa'];
    $placa = trim($placa);

    $queryVehiculo = "SELECT * FROM detallevehicular WHERE numplaca='$placa' AND idtipacto<>''";
        
    $resultVehiculo = mysql_query($queryVehiculo, $conn) or die(mysql_error());
    $arrVehiculo = array();
    while($row = mysql_fetch_assoc($resultVehiculo)){
        $arrVehiculo['vehiculo'][] = array(
            'placa' => $row['numplaca'],
            'anio_fabricacion' => $row['anofab'],
            'clase' => $row['clase'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'combustible' => $row['combustible'],
            'carroceria' => $row['carroceria'],
            'fecha_inscripcion' => $row['fecinsc'],
            'color' => $row['color'],
            'motor' => $row['motor'],
            'numero_serie' => $row['numserie'],
            'partida_registral' => $row['pregistral'],
            'id_sede_registral' => $row['idsedereg'],
        ); 
    }

    echo json_encode($arrVehiculo);

?>