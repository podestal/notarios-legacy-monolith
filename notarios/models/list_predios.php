<?php
   
    include('../conexion.php');

    $kardex = $_POST['kardex'];

    $queryListPredio = "SELECT * FROM predios where kardex='$kardex'";
        
    $resultPredio = mysql_query($queryListPredio, $conn) or die(mysql_error());
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

?>