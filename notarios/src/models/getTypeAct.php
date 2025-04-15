<?php

    $tipoActo='SELECT ta.idtipoacto, ta.desacto
    FROM tiposdeacto AS ta
    ORDER BY ta.desacto';

    $ejecutarTipoActo= mysql_query($tipoActo, $conn) or die(mysql_error());
    while ($row = mysql_fetch_array($ejecutarTipoActo)){
        $arrayActos[]['actos'] = array(
            'acto'=>$row['desacto'],
            'idActos'=>$row['idtipoacto']
        );
    }

?>