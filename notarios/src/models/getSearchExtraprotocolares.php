<?php

    include('../../conexion.php');

    $contratanteString = $_POST['datosSerializados'];

    $contratanteJson = json_decode($contratanteString,true);
    $contratante =  $contratanteJson['txtNombreClienteIndice'];
    $numero =  $contratanteJson['txtNumeroDocumentoIndice'];
    // $contratante =  $contratanteJson['txtContratante'];
    // $numero =  $contratanteJson['txtNumeroDocumento'];

    if(empty($contratanteJson['txtNombreClienteIndice']) && empty($contratanteJson['txtNumeroDocumentoIndice'])){

        $queryCartasAdd = "";
        $queryViajesAdd = "";
        $queryDomiciliarioAdd = "";
        $queryLibrosAdd = "";
        $queryPoderesAdd = "";

    }else if(empty($contratanteJson['txtNombreClienteIndice']) && !empty($contratanteJson['txtNumeroDocumentoIndice'])){

        $queryCartasAdd = "WHERE id_remitente='$numero'";
        $queryViajesAdd = "WHERE vc.c_codcontrat='$numero'";
        $queryDomiciliarioAdd = "WHERE cd.numdoc_solic='$numero'";
        $queryLibrosAdd = "WHERE li.ruc='$numero' or  li.dni='$numero'";
        $queryPoderesAdd = "WHERE c_codcontrat='$numero'";

    }else if(!empty($contratanteJson['txtNombreClienteIndice']) && empty($contratanteJson['txtNumeroDocumentoIndice'])){

        $queryCartasAdd = "WHERE nom_remitente LIKE upper('%$contratante%') or nom_destinatario LIKE upper('%$contratante%')";
        $queryViajesAdd = "WHERE vc.c_descontrat LIKE upper('%$contratante%')";
        // $queryDomiciliarioAdd = "WHERE nombre_solic LIKE upper('%$contratante%') or propietario LIKE upper('%$contratante%')";
        $queryDomiciliarioAdd = "WHERE cd.nombre_solic LIKE upper('%$contratante%')";
        $queryLibrosAdd = "WHERE li.empresa LIKE upper('%$contratante%') or li.solicitante LIKE upper('%$contratante%')";
        $queryPoderesAdd = "WHERE c_descontrat LIKE upper('%$contratante%')";

    }else if(!empty($contratanteJson['txtNombreClienteIndice']) && !empty($contratanteJson['txtNumeroDocumentoIndice'])){

        $queryCartasAdd = "WHERE id_remitente='$numero' or nom_remitente LIKE upper('%$contratante%') or nom_destinatario LIKE upper('%$contratante%')";
        $queryViajesAdd = "WHERE vc.c_codcontrat='$numero' or vc.c_descontrat LIKE upper('%$contratante%')";
        // $queryDomiciliarioAdd = "WHERE numdoc_solic='$numero' or nombre_solic LIKE upper('%$contratante%') or propietario LIKE upper('%$contratante%')";
        $queryDomiciliarioAdd = "WHERE cd.numdoc_solic='$numero' or cd.nombre_solic LIKE upper('%$contratante%')";
        $queryLibrosAdd = "WHERE li.ruc='$numero' or  li.dni='$numero' or li.empresa LIKE upper('%$contratante%') or li.solicitante LIKE upper('%$contratante%')";
        $queryPoderesAdd = "WHERE c_codcontrat='$numero' or c_descontrat LIKE upper('%$contratante%')";

    }

    //  echo json_encode($queryPoderesAdd);return false;
    $arrExtraprotcolares = array();
    $queryExtraprotocolares = "SELECT id_carta AS id,
                                        num_carta AS num_kardex,
                                        id_remitente AS documentos,
                                        CONCAT(nom_remitente,',,',nom_destinatario) AS contratantes, 
                                        'CARTA NOTARIAL' AS denominacion,
                                        '1' as tipo,
                                        des_encargado as usuario
                                FROM ingreso_cartas 
                                $queryCartasAdd
    
                                UNION ALL
                                
                                SELECT pv.id_viaje AS id,
                                        pv.num_kardex, 
                                        GROUP_CONCAT(vc.c_codcontrat SEPARATOR ',,') AS documentos, 
                                        GROUP_CONCAT(vc.c_descontrat SEPARATOR ',,') AS contratantes, 
                                        av.des_asunto AS denominacion,
                                        '2' as tipo,
                                        u.loginusuario as usuario
                                FROM viaje_contratantes AS vc
                                INNER JOIN permi_viaje AS pv ON pv.id_viaje = vc.id_viaje
                                INNER JOIN asunto_viaje AS av ON av.cod_asunto = pv.asunto
                                LEFT JOIN usuarios as u on u.idusuario = pv.nom_recep
                                $queryViajesAdd
                                GROUP BY pv.id_viaje
                                
                                UNION ALL
                                
                                SELECT cd.id_domiciliario AS id, 
                                        cd.num_certificado AS num_kardex,
                                        cd.numdoc_solic AS documentos,
                                        cd.nombre_solic AS contratantes, 
                                        'CERTIFICADO DOMICILIARIO' AS denominacion,
                                        '3' as tipo,
                                        u.loginusuario as usuario
                                FROM cert_domiciliario as cd
                                LEFT JOIN usuarios as u on u.idusuario = cd.idusuario
                                $queryDomiciliarioAdd
                                
                                UNION ALL
                                
                                SELECT CONCAT(li.numlibro,'-',li.ano) AS id,
                                        li.numlibro AS num_kardex,  
                                        CONCAT(li.ruc,',,',li.dni) AS documentos, 
                                        CONCAT(li.empresa,',,',li.solicitante) AS contratantes, 
                                        CONCAT('LIBRO - ',li.descritiplib) AS denominacion,
                                        '4' as tipo,
                                        u.loginusuario as usuario
                                FROM libros as li
                                LEFT JOIN usuarios as u on u.idusuario = li.idusuario
                                $queryLibrosAdd
                                UNION ALL
                                
                                SELECT ip.id_poder AS id,
                                        ip.num_kardex,
                                        GROUP_CONCAT(c_codcontrat SEPARATOR ',,') AS documentos,
                                        GROUP_CONCAT(c_descontrat SEPARATOR ',,') AS contratantes, 
                                        pa.des_asunto AS denominacion,
                                        '5' as tipo,
                                        ip.des_respon as ususario
                                FROM ingreso_poderes AS ip
                                INNER JOIN poderes_contratantes AS pc ON pc.id_poder=ip.id_poder 
                                INNER JOIN poderes_asunto AS pa ON pa.id_asunto = ip.id_asunto
                                $queryPoderesAdd
                                GROUP BY ip.id_poder";

    $resultExtraprotocolares = mysql_query($queryExtraprotocolares, $conn) or die(mysql_error());
    $arrPoderes = array();
    $cont=0;
    while($row1 = mysql_fetch_assoc($resultExtraprotocolares)){

        switch ($row1['tipo']) {
			case '1':
				$url = "../../extraprotocolares/view/EditCartasVie.php?numcarta=".$row1['num_kardex'];
				break;
			case '2':
				$url = "../../extraprotocolares/view/EditPermiViajeVie.php?id_viaje=".$row1['id'];
				break;
			case '3':
				$url = "../../extraprotocolares/view/EdiCertDomiVie.php?id_domiciliario=".$row1['id'];
				break;
			case '4':
				$url = "../../verlibro.php?numlibro=".$row1['id'];
				break;
			case '5':
				$url = "../../extraprotocolares/view/EditPoderesVie.php?id_poder=".$row1['id'];
				break;
			
			default:
				$url = "sin-url";
		}

        // $arrExtraprotcolares[] = array(
        //     'idnum' => $row1['id'],
        //     'url' => $url,
        //     'num' => $row1['num_kardex'],
        //     'docs' => $row1['documentos'],
        //     'cont' => $row1['contratantes'],
        //     'deno' => $row1['denominacion'],
        // );

        $arrExtraprotcolares[] = array(
            
            'numEscAct' => $cont,
            'kardexAnio' => $row1['num_kardex'],
            'URL' => $url,
            'fecEscritura' => $row1['documentos'],
            'contratantes' =>  $row1['contratantes'],
            'actos' => $row1['denominacion'],
            'folioIn' => 'NO APLICA',
            'folioFin' => 'NO APLICA',
            'responsable' => $row1['usuario'],
            'escaneo' => 'NO APLICA',
            'idnum' => $row1['id'],
            'docs' => $row1['documentos'],
        ); 
        $cont++;   
    }

     echo json_encode($arrExtraprotcolares);
?>