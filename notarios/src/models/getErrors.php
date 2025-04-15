<?php
    include('../../conexion.php');

    $usuario = $_POST['usuario'];
    $year = $_POST['year'];


    $queryRentaTerceraCategoria = "SELECT 
                k.idkardex as id_kardex,
                k.kardex as kardex_esc,
                k.idtipkar,
                k.fechaingreso,
                k.contrato as acto,
                k.idusuario,
                k.responsable,
                k.responsable_new AS responsable,
                c2.idcontratante,
                IF(c2.tipper='J',c2.razonsocial,c2.nombre) AS contratante,
                cxa.parte,
                k.codactos,
                k.fechaescritura
            FROM kardex AS k
            INNER JOIN contratantes AS con ON con.kardex = k.kardex
            INNER JOIN cliente2 AS c2 ON c2.idcontratante = con.idcontratante
            INNER JOIN contratantesxacto AS cxa ON cxa.idcontratante = con.idcontratante
            LEFT JOIN renta AS re ON re.`idcontratante`= con.idcontratante
            WHERE cxa.parte=1 
                    and (k.responsable_new = '$usuario') 
                    and k.codactos = '030' 
                    AND (re.pregu1 IS NULL OR re.pregu2 IS NULL OR re.pregu3 IS NULL)
                    AND year(k.fechaescritura)='$year'
            ORDER BY k.idkardex asc";

    $resultRentaTerceraCategoria = mysql_query($queryRentaTerceraCategoria, $conn) or die(mysql_error());
    $arrRentaTerceraCategoria = array();


    $queryDetalleBienes = "SELECT 
                    k.idkardex AS id_kardex,
                    k.kardex AS kardex_esc,
                    k.idtipkar,
                    k.fechaingreso,
                    k.contrato AS acto,
                    k.idusuario,
                    k.responsable,
                    k.responsable_new AS responsable,
                    k.codactos,
                    k.fechaescritura
                FROM kardex AS k
                LEFT JOIN  detallebienes AS db ON db.kardex= k.kardex
                WHERE k.responsable_new = '$usuario' 
                        AND (k.codactos = '030' 
                                OR k.codactos = '084' 
                                OR k.codactos = '033' 
                                OR k.codactos = '036' 
                                OR k.codactos = '037' 
                                OR k.codactos = '047' 
                                OR k.codactos = '024')
                        AND (db.detbien IS NULL OR db.idtipbien=0 OR tipob='')
                        AND year(k.fechaescritura)='$year'
                ORDER BY k.idkardex ASC";

    $resultDetalleBienes = mysql_query($queryDetalleBienes, $conn) or die(mysql_error());


$queryOrigenFondo = "SELECT 
                        k.idkardex AS id_kardex,
                        k.kardex AS kardex_esc,
                        k.idtipkar,
                        k.fechaingreso,
                        k.contrato AS acto,
                        k.idusuario,
                        k.responsable,
                        k.responsable_new AS responsable,
                        k.codactos,
                        k.fechaescritura,
                        cxa.ofondo,
                        c2.nombre as contratante
                    FROM kardex AS k
                    LEFT JOIN  contratantesxacto AS cxa ON cxa.kardex= k.kardex
                    LEFT JOIN cliente2 AS c2 ON c2.idcontratante = cxa.idcontratante
                    WHERE k.responsable_new = '$usuario' 
                            AND (k.codactos = '094') AND (cxa.ofondo='') 
                            and (cxa.parte='1' or cxa.parte='2')
                            AND year(k.fechaescritura)='$year' 
                    ORDER BY k.idkardex ASC";

    $resultOrigenFondo = mysql_query($queryOrigenFondo, $conn) or die(mysql_error());

$queryFechaConclusion = "SELECT 
                            k.idkardex AS id_kardex,
                            k.kardex AS kardex_esc,
                            k.idtipkar,
                            k.fechaingreso,
                            k.contrato AS acto,
                            k.idusuario,
                            k.responsable,
                            k.responsable_new AS responsable,
                            k.codactos,
                            k.fechaescritura,
                            k.fechaconclusion
                        FROM kardex AS k
                        WHERE k.responsable_new = '$usuario' AND k.fechaconclusion='' AND YEAR(k.fechaescritura)='2025'
                        ORDER BY k.idkardex ASC";

    $resultFechaConclusion = mysql_query($queryFechaConclusion, $conn) or die(mysql_error());
    
    

    while($row1 = mysql_fetch_assoc($resultRentaTerceraCategoria)){
        $arrRentaTerceraCategoria['renta'][] = array(
            'idkardex' => $row1['id_kardex'],
            'contrato' => $row1['acto'],
            'kardex' => $row1['kardex_esc'],
            'responsable' => $row1['responsable'],
            'fechaescritura' => $row1['fechaescritura'],
            'contratante' => $row1['contratante'],
            'error' => $row1['contratante']. '- Ingrese renta de tercera categoria',
        ); 
    }
    while($row2 = mysql_fetch_assoc($resultDetalleBienes)){
        $arrRentaTerceraCategoria['bien'][] = array(
            'idkardex' => $row2['id_kardex'],
            'contrato' => $row2['acto'],
            'kardex' => $row2['kardex_esc'],
            'responsable' => $row2['responsable'],
            'fechaescritura' => $row2['fechaescritura'],
            'contratante' => $row2['contratante'],
            'error' => 'No existe bien, ingrese un bien',
        ); 
    }
    while($row3 = mysql_fetch_assoc($resultOrigenFondo)){
        $arrRentaTerceraCategoria['ofondo'][] = array(
            'idkardex' => $row3['id_kardex'],
            'contrato' => $row3['acto'],
            'kardex' => $row3['kardex_esc'],
            'responsable' => $row3['responsable'],
            'fechaescritura' => $row3['fechaescritura'],
            'contratante' => $row3['contratante'],
            'error' => $row3['contratante']. '- Falta llenar el origen de los fondos',
        ); 
    }

    while($row4 = mysql_fetch_assoc($resultFechaConclusion)){
        $arrRentaTerceraCategoria['conclusion'][] = array(
            'idkardex' => $row4['id_kardex'],
            'contrato' => $row4['acto'],
            'kardex' => $row4['kardex_esc'],
            'responsable' => $row4['responsable'],
            'fechaescritura' => $row4['fechaescritura'],
            'contratante' => '',
            'error' => 'Falta concluir el instrumento con la firma de los contratantes',
        ); 
    }
    

    echo json_encode($arrRentaTerceraCategoria);
?>