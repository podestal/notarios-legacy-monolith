<?php
    include('../../conexion.php');

    $year = $_POST['year'];
    // print_r($year);
    $queryRentaTerceraCategoria = "SELECT t.usuario,
                                    SUM(t.total_kardex) AS gran_total,
                                    t.responsable
                                    FROM (  
                                            SELECT 
                                                k.responsable_new AS usuario,
                                                CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
                                                COUNT(k.kardex) AS total_kardex
                                            FROM kardex AS k 
                                            LEFT JOIN detallebienes AS db ON db.kardex = k.kardex
                                            INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
                                            WHERE k.codactos IN ('030', '084', '033', '036', '037', '047', '024') 
                                                    AND (db.detbien IS NULL OR db.idtipbien = 0 OR tipob = '')
                                                    AND year(k.fechaescritura)='$year'
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
                                            WHERE k.codactos = '094' 
                                                    AND (cxa.ofondo='') 
                                                    AND cxa.parte IN ('1', '2')
                                                    AND year(k.fechaescritura)='$year'
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
                                            WHERE cxa.parte=1 
                                                    AND k.codactos = '030' 
                                                    AND NOT EXISTS (SELECT 1 FROM renta ren 
                                                                        WHERE ren.idcontratante = con.idcontratante
                                                                        AND ren.pregu1 IS NOT NULL
                                                                        AND ren.pregu2 IS NOT NULL
                                                                        AND ren.pregu3 IS NOT NULL)
                                                    AND year(k.fechaescritura)='$year'
                                            GROUP BY k.responsable_new

                                            UNION ALL 

                                            SELECT 
                                                k.responsable_new AS usuario,
                                                CONCAT(usu.prinom,' ',usu.segnom,' ',usu.apepat,' ',usu.apemat) as responsable,
                                                COUNT(k.kardex) AS total_kardex
                                            FROM kardex AS k
                                            INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
                                            WHERE k.fechaconclusion='' AND YEAR(k.fechaescritura)='$year'
                                            GROUP BY k.responsable_new
                                        ) AS t
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

?>