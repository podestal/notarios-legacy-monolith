<?php
    include('../conexion.php');

    $prediosString = $_POST['datosSerializados'];
    $prediosJson = json_decode($prediosString,true);

    $propietario =  $prediosJson['txtPropietario'];
   

    $queryGetPropietario = "SELECT CONCAT(c2.prinom, ' ', c2.segnom, IF(c2.segnom='','',' ') ,c2.apepat, ' ',c2.apemat) AS propietario,
                            con.kardex,k.idkardex
                        FROM cliente2 AS c2
                        INNER JOIN contratantes AS con ON con.idcontratante = c2.idcontratante
                        INNER JOIN kardex AS k ON k.kardex=con.kardex
                        WHERE  CONCAT(c2.prinom, ' ', c2.segnom, IF(c2.segnom='','',' ') ,c2.apepat, ' ',c2.apemat) LIKE '%$propietario%'";
    $resultPropietario = mysql_query($queryGetPropietario, $conn) or die(mysql_error());

    
    $arrPredio = array();

    while($rowPropietario = mysql_fetch_assoc($resultPropietario)){

        $kardexPropietario = $rowPropietario['kardex'];
        $queryGetPredio = "SELECT *  FROM predios WHERE kardex='$kardexPropietario'";
        $resultPredio = mysql_query($queryGetPredio, $conn) or die(mysql_error());

        while($row = mysql_fetch_assoc($resultPredio)){
            $arrPredio[] = array(
                'denominacion' => $row['denominacion'],
                'propietario' => $rowPropietario['propietario'],
                'tipoZona' => $row['tipo_zona'],
                'zona' => $row['zona'],
                'tipoVia' => $row['tipo_via'],
                'nombreVia' => $row['nombre_via'],
                'numero' => $row['numero'],
                'lote' => $row['lote'],
                'manzana' => $row['manzana'],
                'kardex' => $row['kardex'],
                'uri' => '../verkardex.php?kardex='.$row['kardex'].'&id='.$rowPropietario['idkardex'],
            ); 
        }
    }


    echo json_encode($arrPredio);
?>