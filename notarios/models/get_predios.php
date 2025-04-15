<?php
    include('../conexion.php');

    $prediosString = $_POST['datosSerializados'];
    $prediosJson = json_decode($prediosString,true);

    $tipoZona =  $prediosJson['txtTipoZonaPredio'];
    $zona = $prediosJson['txtZonaPredio'];
    $denominacion = $prediosJson['txtDenominacionPredio'];
    $tipoVia = $prediosJson['txtTipoViaPredio'];
    $nombreVia = $prediosJson['txtNombreViaPredio'];
    $numero = $prediosJson['txtNumeroPredio'];
    $lote = $prediosJson['txtLotePredio'];
    $manzana = $prediosJson['txtManzanaPredio'];

    $queryTipoZona =  ($tipoZona==0)?'':"AND tipo_zona='".$tipoZona."'";
    $queryZona = ($zona=='')?'':"AND zona LIKE '%".$zona."%'";
    $queryDenominacion = ($denominacion=='')?'':"AND denominacion LIKE '%".$denominacion."%'";
    $queryTipoVia = ($tipoVia==0)?'':"AND tipo_via='".$tipoVia."'";
    $queryNombreVia = ($nombreVia=='')?'':"AND nombre_via LIKE '%".$nombreVia."%'";
    $queryNumero = ($numero=='')?'':"AND numero='".$numero."'";
    $queryLote = ($lote=='')?'':"AND lote like '%".$lote."%'";
    $queryManzana = ($manzana=='')?'':"AND manzana='".$manzana."'";
    

    $arrPredio = array();

    // if($queryAdd=='ERROR'){
    //     $arrPredio['predio'][]=array('error'=>'error');
    // }else{
        $queryGetPredio = "SELECT pre.*,k.idkardex 
                            FROM predios as pre 
                            INNER JOIN kardex as k on k.kardex=pre.kardex 
                            WHERE id_predio>0 
                            $queryTipoZona
                            $queryZona
                            $queryDenominacion
                            $queryTipoVia
                            $queryNombreVia 
                            $queryNumero
                            $queryLote
                            $queryManzana";
        // print_r($queryGetPredio);return false;

        $resultPredio = mysql_query($queryGetPredio, $conn) or die(mysql_error());
       
        while($row = mysql_fetch_assoc($resultPredio)){
            $arrPredio[] = array(
                'denominacion' => $row['denominacion'],
                'propietario' => '<<<<< VEA EN EL KARDEX',
                'tipoZona' => $row['tipo_zona'],
                'zona' => $row['zona'],
                'tipoVia' => $row['tipo_via'],
                'nombreVia' => $row['nombre_via'],
                'numero' => $row['numero'],
                'lote' => $row['lote'],
                'manzana' => $row['manzana'],
                'kardex' => $row['kardex'],
                'uri' => '../verkardex.php?kardex='.$row['kardex'].'&id='.$row['idkardex'],
            ); 
        }
    // }

    echo json_encode($arrPredio);
?>