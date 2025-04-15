<?php
    include('../conexion.php');
    
    $busString = $_POST['datosSerializados'];
    $busJson = json_decode($busString,true);

    $tipoKardex=$busJson['cmbTipoKardexIndice'];
    $anio=$busJson['cmbAnioKardexIndice'];
  //echo json_encode($tipoKardex);

    $idActo=$busJson['cmbTipoActo'];

    $cliente=$busJson['txtNombreClienteIndice'];

    $numDoc=$busJson['txtNumeroDocumentoIndice'];
    $numEscAct=$busJson['txtNumeroEscrituraIndice'];
    $numKardex=$busJson['txtNumeroKardexIndice'];
    
    //todo 
    if($tipoKardex==0 && $anio==0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex=='')
       {$queryAdd="" ;}

       //kardex/
    if($tipoKardex!=0 && $anio==0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex=='')        
        {$queryAdd="WHERE kar.idtipkar = '$tipoKardex'";
        }
       //año// 
    if($tipoKardex==0 && $anio!=0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex=='')
        {$queryAdd="WHERE YEAR(kar.`fechaescritura`) = '$anio'";
        }
        
        //NumKard//
    if($tipoKardex==0 && $anio==0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex!='')
        {$queryAdd="WHERE kar.kardex LIKE '%$numKardex%'";
        }
//NumKard y kardex//
        if($tipoKardex!=0 && $anio==0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex!='')
        {$queryAdd="WHERE kar.kardex LIKE '%$numKardex%' AND  kar.idtipkar = '$tipoKardex'";
        }

        //NumKard y kardex y año/
        if($tipoKardex!=0 && $anio!=0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex!='')
        {$queryAdd="WHERE kar.kardex LIKE '%$numKardex%' AND  kar.idtipkar = '$tipoKardex' AND YEAR(kar.fechaescritura)='$anio'";
        }
        //NumKard y año//
    if($tipoKardex==0 && $anio!=0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex!='')
    {$queryAdd="WHERE kar.kardex LIKE '%$numKardex%' AND YEAR(kar.fechaescritura)='$anio'";
    }
    //NumKard numEsc//
    if($tipoKardex==0 && $anio==0 && $cliente=='' && $numDoc=='' && $numEscAct!='' && $numKardex!='')
        {$queryAdd="WHERE kar.kardex LIKE '%$numKardex%' AND  (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') ";
        }
//NumKard y DNI//
if($tipoKardex==0 && $anio==0 && $cliente=='' && $numDoc!='' && $numEscAct=='' && $numKardex!='')
{$queryAdd="WHERE kar.kardex LIKE '%$numKardex%' AND cl2.numdoc LIKE '%$numDoc%'";
}

//NumKard y año y cliente//
if($tipoKardex==0 && $anio!=0 && $cliente!='' && $numDoc=='' && $numEscAct=='' && $numKardex!='')
{$queryAdd="WHERE CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%' AND kar.kardex LIKE '%$numKardex%' AND YEAR(kar.fechaescritura)='$anio' ";
}

       //kardex y año// 
    if($tipoKardex!=0 && $anio!=0 && $cliente=='' && $numDoc=='' && $numEscAct=='' && $numKardex=='')        
        {$queryAdd="WHERE kar.idtipkar = '$tipoKardex' AND YEAR(kar.fechaescritura)='$anio'";
        }
//numero Escritura//
    if($tipoKardex==0 && $anio==0 && $cliente=='' && $numDoc=='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') ";
        }
        
        //año y numEsc//
    if($tipoKardex==0 && $anio!=0 && $cliente=='' && $numDoc=='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE YEAR(kar.fechaescritura)='$anio' AND (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') ";
        }



        //DNI//
    if($tipoKardex==0 && $anio==0 && $cliente=='' && $numDoc!='' && $numEscAct==0 && $numKardex=='')
        {$queryAdd="WHERE cl2.numdoc LIKE '%$numDoc%'";
        }
//año y DNI//
    if($tipoKardex==0 && $anio!=0 && $cliente=='' && $numDoc!='' && $numEscAct==0 && $numKardex=='')
        {$queryAdd="WHERE cl2.numdoc LIKE '%$numDoc%' AND YEAR(kar.fechaescritura)='$anio'";
        }
//DNI y numEsc//
    if($tipoKardex==0 && $anio==0 && $cliente=='' && $numDoc!='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE cl2.numdoc LIKE '%$numDoc%' AND (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0')";
        }
//kardex y DNI//
    if($tipoKardex!=0 && $anio==0 && $cliente=='' && $numDoc!='' && $numEscAct==0 && $numKardex=='')
        {$queryAdd="WHERE cl2.numdoc LIKE '%$numDoc%' AND kar.idtipkar = '$tipoKardex'";
        }
//kardex, año y DNI//
    if($tipoKardex!=0 && $anio!=0 && $cliente=='' && $numDoc!='' && $numEscAct==0 && $numKardex=='')
        {$queryAdd="WHERE cl2.numdoc LIKE '%$numDoc%' AND kar.idtipkar = '$tipoKardex' AND YEAR(kar.fechaescritura)='$anio'";
        }
//kardex, DNI y nuEsc//
    if($tipoKardex!=0 && $anio==0 && $cliente=='' && $numDoc!='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE cl2.numdoc LIKE '%$numDoc%' AND kar.idtipkar = '$tipoKardex' AND (LPAD(numescritura, 4, '0')) = LPAD($numEscAct, 4, '0')";
        }
        

//kardex y numEsc//
    if($tipoKardex!=0 && $anio==0 && $cliente=='' && $numDoc=='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE kar.idtipkar = '$tipoKardex' AND (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') ";
        }
        
    //kardex, año, numEsc//
    if($tipoKardex!=0 && $anio!=0 && $cliente=='' && $numDoc=='' && $numEscAct!='' && $numKardex=='')        
        {$queryAdd="WHERE kar.idtipkar = '$tipoKardex' AND YEAR(kar.fechaescritura)='$anio' AND (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') ";
        }

//cliente, año, numEsc//
    if($tipoKardex==0 && $anio!=0 && $cliente!='' && $numDoc=='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%' AND YEAR(kar.fechaescritura)='$anio' AND (LPAD(numescritura, 4, '0')) = LPAD($numEscAct, 4, '0')";
        }
//kardex, cliente, numEsc//
    if($tipoKardex!=0 && $anio==0 && $cliente!='' && $numDoc=='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%' AND (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') AND idtipkar = '$tipoKardex' AND";
        }
//año, cliente//
    if($tipoKardex==0 && $anio!=0 && $cliente!='' && $numDoc=='' && $numEscAct==0 && $numKardex=='')
        {$queryAdd="WHERE CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%'  AND YEAR(kar.fechaescritura)='$anio'";
        }
//cliente//
    if($tipoKardex==0 && $anio==0 && $cliente!='' && $numDoc=='' && $numEscAct==0 && $numKardex=='')
       {$queryAdd="WHERE CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%'  ";
        }

    //cliente yt numEsc//
    if($tipoKardex==0 && $anio==0 && $cliente!='' && $numDoc=='' && $numEscAct!=0 && $numKardex=='')
        {$queryAdd="WHERE (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') AND CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%' ";
        }

//cliente y kardex//
    if($tipoKardex!=0 && $anio==0 && $cliente!='' && $numDoc=='' && $numEscAct==0 && $numKardex=='')
        {$queryAdd="WHERE kar.idtipkar='$tipoKardex' AND CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%' ";
        }

//kardex, año y cliente// 
    if($tipoKardex!=0 && $anio!=0 && $cliente!='' && $numDoc=='' && $numEscAct=='' && $numKardex=='')        
        {$queryAdd="WHERE kar.idtipkar = '$tipoKardex' AND YEAR(kar.fechaescritura)='$anio' AND clientes LIKE '%".$cliente."%'";
        }

//kardex, año, cliente y numEsc//
    if($tipoKardex!=0 && $anio!=0 && $cliente!='' && $numDoc=='' && $numEscAct!='' && $numKardex=='')        
            {$queryAdd="WHERE CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' ') ,cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%'  AND kar.idtipkar = '$tipoKardex' AND YEAR(kar.fechaescritura)='$anio' AND (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0') ";
            }

    //tipo de acto
    if($idActo!=0){
        $queryAdd="WHERE tac.idtipoacto = '$idActo'";
    }
    //tipo de acto y kardex
    if($idActo!=0 && $tipoKardex!=0){
        $queryAdd="WHERE tac.idtipoacto = '$idActo' AND kar.idtipkar = '$tipoKardex'";
    }
    //tipo de acto y año
    if($idActo!=0 && $anio!=0){
        $queryAdd="WHERE tac.idtipoacto = '$idActo' AND YEAR(kar.fechaescritura)='$anio' ";
    }
    //tipo de acto y año y kardex
    if($idActo!=0 && $anio!=0 && $tipoKardex!=0){
        $queryAdd="WHERE tac.idtipoacto = '$idActo' AND YEAR(kar.fechaescritura)='$anio' AND kar.idtipkar = '$tipoKardex' ";
    }

            $queryGetBus = "SELECT 
            con.kardex,
            tac.idtipoacto,
            tac.desacto,
            cl2.razonsocial AS empresa,
            kar.idtipkar,
            kar.idkardex,
            kar.fechaescritura,
            kar.kardex,
            kar.contrato,
            kar.folioini,
            kar.foliofin,
            kar.responsable_new,
            kar.numescritura,
            GROUP_CONCAT(
              IF (
                cl2.tipper = 'J',
                cl2.`razonsocial`,
                CONCAT(
                  cl2.prinom,
                  ' ',
                  cl2.segnom,
                  IF (cl2.segnom = '', '', ' '),
                  cl2.apepat,
                  ' ',
                  cl2.apemat
                )
              ) SEPARATOR ' / '
            ) AS clientes 
          FROM
            kardex AS kar 
            LEFT JOIN tiposdeacto AS tac 
              ON kar.codactos = tac.idtipoacto 
            LEFT JOIN contratantes AS con 
              ON kar.kardex = con.kardex 
            LEFT JOIN cliente2 AS cl2 
              ON con.idcontratante = cl2.idcontratante 
              $queryAdd
          GROUP BY kar.numescritura,
            kar.kardex 
          ORDER BY CAST(kar.numescritura AS SIGNED) DESC";
            

            $resultBus = mysql_query($queryGetBus, $conn) or die(mysql_error());
            
            $arrBus = array();



while($row = mysql_fetch_array($resultBus)){
    $fechaEntera = strtotime($row["fechaescritura"]);
            $anio = date("Y", $fechaEntera);
            $numEscritura =  '';
            $dirEscritura =  '';
            if($row['idtipkar']==1){
                $numEscritura = 'E'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'ESCRITURAS';
            }
            if($row['idtipkar']==2){
                $numEscritura = 'N'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'NOCONTENCIOSOS';
            }
            if($row['idtipkar']==3){
                $numEscritura = 'A'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'ACTAS';
            }
            if($row['idtipkar']==4){
                $numEscritura = 'G'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'GARANTIAS';
            }
            if($row['idtipkar']==5){
                $numEscritura = 'T'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'TESTAMENTOS';
            }
                      
        
        if(file_exists('D:/escaneos/'.$anio.'/'.$dirEscritura.'/'.$numEscritura.'.pdf')){
            $imgPdf = '<a href=# onclick=abrirPdf('.'"'.$numEscritura.'"'.','.'"'.$dirEscritura.'"'.','.'"'.$anio.'"'.')><img src="../images/pdf.png" alt="" width="22px"></a>';

        }else{
            $imgPdf = 'FALTA SCANEO';
        }
    $arrBus['bus'][] = array(
        'numEscAct' => $row['numescritura'],
        'kardexAnio' => $row['kardex'],
        'URL' => '../verkardex.php?kardex='.$row['kardex'].'&id='.$row['idkardex'],
        'fecEscritura' => $row['fechaescritura'],
        'contratantes' =>  $row['clientes'],
        'actos' => $row['contrato'],
        'folioIn' => $row['folioini'],
        'folioFin' => $row['foliofin'],
        'responsable' => $row['responsable_new'],
        'escaneo' => $imgPdf,
    );

    
}
echo json_encode($arrBus);

?>