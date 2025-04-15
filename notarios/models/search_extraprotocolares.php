<?php

    include('../conexion.php');

    $contratanteString = $_POST['datosSerializados'];

    $contratanteJson = json_decode($contratanteString,true);
    $contratante =  $contratanteJson['txtContratante'];
    $numero =  $contratanteJson['txtNumeroDocumento'];

    if(empty($contratanteJson['txtContratante']) && empty($contratanteJson['txtNumeroDocumento'])){

        $queryCartasAdd = "";
        $queryViajesAdd = "";
        $queryDomiciliarioAdd = "";
        $queryLibrosAdd = "";
        $queryPoderesAdd = "";

    }else if(empty($contratanteJson['txtContratante']) && !empty($contratanteJson['txtNumeroDocumento'])){

        $queryCartasAdd = "WHERE id_remitente='$numero'";
        $queryViajesAdd = "WHERE vc.c_codcontrat='$numero'";
        $queryDomiciliarioAdd = "WHERE numdoc_solic='$numero'";
        $queryLibrosAdd = "WHERE ruc='$numero' or  dni='$numero'";
        $queryPoderesAdd = "WHERE c_codcontrat='$numero'";

    }else if(!empty($contratanteJson['txtContratante']) && empty($contratanteJson['txtNumeroDocumento'])){

        $queryCartasAdd = "WHERE nom_remitente LIKE upper('%$contratante%') or nom_destinatario LIKE upper('%$contratante%')";
        $queryViajesAdd = "WHERE vc.c_descontrat LIKE upper('%$contratante%')";
        // $queryDomiciliarioAdd = "WHERE nombre_solic LIKE upper('%$contratante%') or propietario LIKE upper('%$contratante%')";
        $queryDomiciliarioAdd = "WHERE nombre_solic LIKE upper('%$contratante%')";
        $queryLibrosAdd = "WHERE empresa LIKE upper('%$contratante%') or solicitante LIKE upper('%$contratante%')";
        $queryPoderesAdd = "WHERE c_descontrat LIKE upper('%$contratante%')";

    }else if(!empty($contratanteJson['txtContratante']) && !empty($contratanteJson['txtNumeroDocumento'])){

        $queryCartasAdd = "WHERE id_remitente='$numero' or nom_remitente LIKE upper('%$contratante%') or nom_destinatario LIKE upper('%$contratante%')";
        $queryViajesAdd = "WHERE vc.c_codcontrat='$numero' or vc.c_descontrat LIKE upper('%$contratante%')";
        // $queryDomiciliarioAdd = "WHERE numdoc_solic='$numero' or nombre_solic LIKE upper('%$contratante%') or propietario LIKE upper('%$contratante%')";
        $queryDomiciliarioAdd = "WHERE numdoc_solic='$numero' or nombre_solic LIKE upper('%$contratante%')";
        $queryLibrosAdd = "WHERE ruc='$numero' or  dni='$numero' or empresa LIKE upper('%$contratante%') or solicitante LIKE upper('%$contratante%')";
        $queryPoderesAdd = "WHERE c_codcontrat='$numero' or c_descontrat LIKE upper('%$contratante%')";

    }

    //  echo json_encode($queryPoderesAdd);return false;
    $arrExtraprotcolares = array();

    // $queryCartas = "SELECT id_carta AS id,num_carta AS num_kardex ,id_remitente AS documentos,CONCAT(nom_remitente,',,',nom_destinatario) AS contratantes, 'CARTA NOTARIAL' AS denominacion
    // FROM ingreso_cartas 
    // $queryCartasAdd";

    // $resultCartas = mysql_query($queryCartas, $conn) or die(mysql_error());
    // $arrCartas = array();

    // while($row1 = mysql_fetch_assoc($resultCartas)){
    //     $arrCartas[] = array(
    //         'idnum' => $row1['id'],
    //         'num' => $row1['num_kardex'],
    //         'docs' => $row1['documentos'],
    //         'cont' => $row1['contratantes'],
    //         'deno' => $row1['denominacion'],
    //     ); 
    // }


    // $queryViajes = "SELECT pv.id_viaje AS id,pv.num_kardex, GROUP_CONCAT(vc.c_codcontrat SEPARATOR ',,') AS documentos, GROUP_CONCAT(vc.c_descontrat SEPARATOR ',,') AS contratantes, av.des_asunto AS denominacion
    // FROM viaje_contratantes AS vc
    // INNER JOIN permi_viaje AS pv ON pv.id_viaje = vc.id_viaje
    // INNER JOIN asunto_viaje AS av ON av.cod_asunto = pv.asunto
    // $queryViajesAdd
    // GROUP BY pv.id_viaje";

    // $resultViajes = mysql_query($queryViajes, $conn) or die(mysql_error());
    // $arrViajes = array();

    // while($row1 = mysql_fetch_assoc($resultViajes)){
    //     $arrViajes[] = array(
    //         'idnum' => $row1['id'],
    //         'num' => $row1['num_kardex'],
    //         'docs' => $row1['documentos'],
    //         'cont' => $row1['contratantes'],
    //         'deno' => $row1['denominacion'],
    //     ); 
    // }


    // $queryDomiciliario = "SELECT id_domiciliario AS id, numdoc_solic AS documentos, num_certificado AS num_kardex, CONCAT(nombre_solic,',,',propietario) AS contratantes , 'CERTIFICADO DOMICILIARIO' AS denominacion
    // FROM cert_domiciliario 
    // $queryDomiciliarioAdd";

    // $resultDomiciliario = mysql_query($queryDomiciliario, $conn) or die(mysql_error());
    // $arrDomiciliario = array();

    // while($row1 = mysql_fetch_assoc($resultDomiciliario)){
    //     $arrDomiciliario[] = array(
    //         'idnum' => $row1['id'],
    //         'num' => $row1['num_kardex'],
    //         'docs' => $row1['documentos'],
    //         'cont' => $row1['contratantes'],
    //         'deno' => $row1['denominacion'],
    //     ); 
    // }


    // $queryLibros = "SELECT numlibro AS id,numlibro AS num_kardex,  CONCAT(ruc,',,',dni) AS documentos, CONCAT(empresa,',,',solicitante) AS contratantes, descritiplib AS denominacion
    // FROM libros 
    // $queryLibrosAdd";

    // $resultLibros = mysql_query($queryLibros, $conn) or die(mysql_error());
    // $arrLibros = array();

    // while($row1 = mysql_fetch_assoc($resultLibros)){
    //     $arrLibros[] = array(
    //         'idnum' => $row1['id'],
    //         'num' => $row1['num_kardex'],
    //         'docs' => $row1['documentos'],
    //         'cont' => $row1['contratantes'],
    //         'deno' => $row1['denominacion'],
    //     ); 
    // }


    // $queryPoderes = "SELECT ip.id_poder as id,ip.num_kardex,GROUP_CONCAT(c_codcontrat SEPARATOR ',,') AS documentos,GROUP_CONCAT(c_descontrat SEPARATOR ',,') AS contratantes, pa.des_asunto AS denominacion
    // FROM ingreso_poderes AS ip
    // INNER JOIN poderes_contratantes AS pc ON pc.id_poder=ip.id_poder 
    // INNER JOIN poderes_asunto AS pa ON pa.id_asunto = ip.id_asunto
    // $queryPoderesAdd
    // GROUP BY ip.id_poder";

    // $resultPoderes = mysql_query($queryPoderes, $conn) or die(mysql_error());
    // $arrPoderes = array();

    // while($row1 = mysql_fetch_assoc($resultPoderes)){
    //     $arrPoderes[] = array(
    //         'idnum' => $row1['id'],
    //         'num' => $row1['num_kardex'],
    //         'docs' => $row1['documentos'],
    //         'cont' => $row1['contratantes'],
    //         'deno' => $row1['denominacion'],
    //     ); 
    // }
    

    // $arrExtraprotcolares += $arrPoderes;
    // $arrExtraprotcolares += $arrLibros;
    // $arrExtraprotcolares += $arrDomiciliario;
    // $arrExtraprotcolares += $arrCartas;
	// $arrExtraprotcolares += $arrViajes;

    // echo json_encode($arrExtraprotcolares);


    $queryExtraprotocolares = "SELECT id_carta AS id,
                                        num_carta AS num_kardex,
                                        id_remitente AS documentos,
                                        CONCAT(nom_remitente,',,',nom_destinatario) AS contratantes, 
                                        'CARTA NOTARIAL' AS denominacion,
                                        '1' as tipo
                                FROM ingreso_cartas 
                                $queryCartasAdd
    
                                UNION ALL
                                
                                SELECT pv.id_viaje AS id,
                                        pv.num_kardex, 
                                        GROUP_CONCAT(vc.c_codcontrat SEPARATOR ',,') AS documentos, 
                                        GROUP_CONCAT(vc.c_descontrat SEPARATOR ',,') AS contratantes, 
                                        av.des_asunto AS denominacion,
                                        '2' as tipo
                                FROM viaje_contratantes AS vc
                                INNER JOIN permi_viaje AS pv ON pv.id_viaje = vc.id_viaje
                                INNER JOIN asunto_viaje AS av ON av.cod_asunto = pv.asunto
                                $queryViajesAdd
                                GROUP BY pv.id_viaje
                                
                                UNION ALL
                                
                                SELECT id_domiciliario AS id, 
                                        num_certificado AS num_kardex,
                                        numdoc_solic AS documentos,
                                        nombre_solic AS contratantes, 
                                        'CERTIFICADO DOMICILIARIO' AS denominacion,
                                        '3' as tipo
                                FROM cert_domiciliario 
                                $queryDomiciliarioAdd
                                
                                UNION ALL
                                
                                SELECT CONCAT(numlibro,'-',ano) AS id,
                                        numlibro AS num_kardex,  
                                        CONCAT(ruc,',,',dni) AS documentos, 
                                        CONCAT(empresa,',,',solicitante) AS contratantes, 
                                        CONCAT('LIBRO - ',descritiplib) AS denominacion,
                                        '4' as tipo
                                FROM libros 
                                $queryLibrosAdd
                                UNION ALL
                                
                                SELECT ip.id_poder AS id,
                                        ip.num_kardex,
                                        GROUP_CONCAT(c_codcontrat SEPARATOR ',,') AS documentos,
                                        GROUP_CONCAT(c_descontrat SEPARATOR ',,') AS contratantes, 
                                        pa.des_asunto AS denominacion,
                                        '5' as tipo
                                FROM ingreso_poderes AS ip
                                INNER JOIN poderes_contratantes AS pc ON pc.id_poder=ip.id_poder 
                                INNER JOIN poderes_asunto AS pa ON pa.id_asunto = ip.id_asunto
                                $queryPoderesAdd
                                GROUP BY ip.id_poder";

    $resultExtraprotocolares = mysql_query($queryExtraprotocolares, $conn) or die(mysql_error());
    $arrPoderes = array();
    
    while($row1 = mysql_fetch_assoc($resultExtraprotocolares)){

        switch ($row1['tipo']) {
			case '1':
				$url = "../extraprotocolares/view/EditCartasVie.php?numcarta=".$row1['num_kardex'];
				break;
			case '2':
				$url = "../extraprotocolares/view/EditPermiViajeVie.php?id_viaje=".$row1['id'];
				break;
			case '3':
				$url = "../extraprotocolares/view/EdiCertDomiVie.php?id_domiciliario=".$row1['id'];
				break;
			case '4':
				$url = "../verlibro.php?numlibro=".$row1['id'];
				break;
			case '5':
				$url = "../extraprotocolares/view/EditPoderesVie.php?id_poder=".$row1['id'];
				break;
			
			default:
				$url = "sin-url";
		}

        $arrExtraprotcolares[] = array(
            'idnum' => $row1['id'],
            'url' => $url,
            'num' => $row1['num_kardex'],
            'docs' => $row1['documentos'],
            'cont' => $row1['contratantes'],
            'deno' => $row1['denominacion'],
        ); 
    }

     echo json_encode($arrExtraprotcolares);
?>