<?php
    include('../conexion.php');

    $usuario = $_POST['usuario'];
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
                                WHERE (k.codactos = '030' OR k.codactos = '084' OR k.codactos = '033' OR k.codactos = '036' OR k.codactos = '037' OR k.codactos = '047' OR k.codactos = '024') AND (db.detbien IS NULL OR db.idtipbien = 0 OR tipob = '') and k.responsable_new ='$usuario'
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
                                WHERE k.codactos = '094'  AND (cxa.ofondo='') AND fechaescritura > '2021-05-01' and (cxa.parte='1' or cxa.parte='2') and k.responsable_new ='$usuario'
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
                                LEFT JOIN renta AS re ON re.`idcontratante`= con.idcontratante
                                INNER JOIN usuarios as usu ON usu.loginusuario = k.responsable_new
                                WHERE cxa.parte=1 AND k.codactos = '030' AND (re.pregu1 IS NULL OR re.pregu2 IS NULL OR re.pregu3 IS NULL)
                                and k.responsable_new ='$usuario'
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
?>