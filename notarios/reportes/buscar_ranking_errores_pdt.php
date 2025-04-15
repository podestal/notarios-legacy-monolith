<?php
    include('../conexion.php');

    $queryRentaTerceraCategoria = "SELECT 	t.usuario,
                                    SUM(t.total_kardex) AS gran_total,
                                    t.responsable
                                FROM (SELECT 
                                    k.responsable_new AS usuario,
                                    CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
                                    COUNT(k.kardex) AS total_kardex
                                FROM kardex AS k 
                                LEFT JOIN detallebienes AS db ON db.kardex = k.kardex
                                INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
                                WHERE k.codactos IN ('030', '084', '033', '036', '037', '047', '024') AND (db.detbien IS NULL OR db.idtipbien = 0 OR tipob = '') 
                                GROUP BY k.responsable_new 

                                UNION ALL

                                SELECT 
                                    k.responsable_new AS usuario,
                                    CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
                                    COUNT(k.kardex) AS total_kardex
                                FROM kardex AS k
                                INNER JOIN contratantes AS con ON con.kardex = k.kardex
                                INNER JOIN cliente2 AS c2 ON c2.idcontratante = con.idcontratante
                                INNER JOIN contratantesxacto AS cxa ON cxa.idcontratante = con.idcontratante
                                INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
                                WHERE k.codactos = '094'  AND (cxa.ofondo='') AND fechaescritura > '2021-05-01' AND cxa.parte IN ('1', '2')
                                GROUP BY k.responsable_new

                                UNION ALL

                                SELECT 
                                    k.responsable_new AS usuario,
                                    CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
                                    COUNT(k.kardex) AS total_kardex
                                FROM kardex AS k
                                INNER JOIN contratantes AS con ON con.kardex = k.kardex
                                INNER JOIN cliente2 AS c2 ON c2.idcontratante = con.idcontratante
                                INNER JOIN contratantesxacto AS cxa ON cxa.idcontratante = con.idcontratante
                                LEFT JOIN renta AS re ON re.idcontratante= con.idcontratante
                                INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
                                WHERE cxa.parte=1 AND k.codactos = '030' AND NOT EXISTS (
                                                                                        SELECT 1 FROM renta ren 
                                                                                        WHERE ren.idcontratante = con.idcontratante
                                                                                        AND ren.pregu1 IS NOT NULL
                                                                                        AND ren.pregu2 IS NOT NULL
                                                                                        AND ren.pregu3 IS NOT NULL
                                                                                    )
                                GROUP BY k.responsable_new) AS t
                                GROUP BY t.usuario,t.responsable
                                ORDER BY gran_total DESC";

    $resultRankingErrores = mysql_query($queryRentaTerceraCategoria, $conn) or die(mysql_error());
    $arrRankingErrores = array();

      while($row1 = mysql_fetch_assoc($resultRankingErrores)){
        $arrRankingErrores[] = array(
            'nombre' => $row1['responsable'],
            'total' => $row1['gran_total'],
            'user' => $row1['usuario'],
        ); 
    }

    echo json_encode($arrRankingErrores);

    // $arrTotal = array();
        
    // $queryBien = "SELECT 
    //                 k.responsable_new AS usuario,
    //                 CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
    //                 COUNT(k.kardex) AS total_kardex
    //             FROM kardex AS k 
    //             LEFT JOIN detallebienes AS db ON db.kardex = k.kardex
    //             INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
    //             WHERE (k.codactos = '030' OR k.codactos = '084' OR k.codactos = '033' OR k.codactos = '036' OR k.codactos = '037' OR k.codactos = '047' OR k.codactos = '024') AND (db.detbien IS NULL OR db.idtipbien = 0 OR tipob = '') 
    //             GROUP BY k.responsable_new";

    // $resultBien = mysql_query($queryBien, $conn) or die(mysql_error());

    // $queryOFondo = "SELECT 
    //                     k.responsable_new AS usuario,
    //                     CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
    //                     COUNT(k.kardex) AS total_kardex
    //                 FROM kardex AS k
    //                 INNER JOIN contratantes AS con ON con.kardex = k.kardex
    //                 INNER JOIN cliente2 AS c2 ON c2.idcontratante = con.idcontratante
    //                 INNER JOIN contratantesxacto AS cxa ON cxa.idcontratante = con.idcontratante
    //                 INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
    //                 WHERE k.codactos = '094'  AND (cxa.ofondo='') AND fechaescritura > '2021-05-01' and (cxa.parte='1' or cxa.parte='2')
    //                 GROUP BY k.responsable_new";
    // $resultOFondo = mysql_query($queryOFondo, $conn) or die(mysql_error());

    // $queryRenta = " SELECT 
    //                     k.responsable_new AS usuario,
    //                     CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
    //                     COUNT(k.kardex) AS total_kardex
    //                 FROM kardex AS k
    //                 INNER JOIN contratantes AS con ON con.kardex = k.kardex
    //                 INNER JOIN cliente2 AS c2 ON c2.idcontratante = con.idcontratante
    //                 INNER JOIN contratantesxacto AS cxa ON cxa.idcontratante = con.idcontratante
    //                 LEFT JOIN renta AS re ON re.`idcontratante`= con.idcontratante
    //                 INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
    //                 WHERE cxa.parte=1 AND k.codactos = '030' AND (re.pregu1 IS NULL OR re.pregu2 IS NULL OR re.pregu3 IS NULL)
    //                 GROUP BY k.responsable_new";
    // $resultRenta = mysql_query($queryRenta, $conn) or die(mysql_error());

    
    // while($row1 = mysql_fetch_assoc($resultBien)){
    //     $arrTotal[] = array(
    //         'nombre' => $row1['usuario'],
    //         'total' => $row1['total_kardex'],
    //         'user' => $row1['responsable'],
            
    //     ); 
    // }
    // while($row2 = mysql_fetch_assoc($resultOFondo)){
    //     array_push($arrTotal, array(
    //         'nombre'=>$row2['usuario'],
    //         'total'=>$row2['total_kardex'],
    //         'user'=>$row2['responsable']
    //     )); 
       
    // }

    // while($row3 = mysql_fetch_assoc($resultRenta)){
    //     array_push($arrTotal, array(
    //         'nombre'=>$row3['usuario'],
    //         'total'=>$row3['total_kardex'],
    //         'user'=>$row3['responsable']
    //     )); 
       
    // }

    // $resultadoAgrupado = [];

    // foreach ($arrTotal as $item) {
    //     $nombre = $item['nombre'];
        
    //     // Si el nombre ya existe, suma el total
    //     if (isset($resultadoAgrupado[$nombre])) {
    //         $resultadoAgrupado[$nombre]['total'] += $item['total'];
    //     } else {
    //         // Si no existe, inicializa el valor
    //         $resultadoAgrupado[$nombre] = [
    //             'nombre' => $item['nombre'],
    //             'total' => $item['total'],
    //             'user' => $item['user']
    //         ];
    //     }
    // }

    // // Convertir de nuevo a un array de objetos si es necesario
    // $resultadoFinal = array_values($resultadoAgrupado);

    // echo json_encode($resultadoFinal);
?>