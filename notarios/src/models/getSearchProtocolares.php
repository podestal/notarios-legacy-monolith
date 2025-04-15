<?php
    include('../../conexion.php');
    
    $busString = $_POST['datosSerializados'];
    $busJson = json_decode($busString,true);
    
    $tipoKardex=$busJson['cmbTipoKardexIndice'];
    $anio=$busJson['cmbAnioKardexIndice'];
    $acto=$busJson['cmbTipoActo'];
    $cliente=$busJson['txtNombreClienteIndice'];
    $numDoc=$busJson['txtNumeroDocumentoIndice'];
    $numEscAct=$busJson['txtNumeroEscrituraIndice'];
    $numKardex=$busJson['txtNumeroKardexIndice'];

    $queryTipoKardex = ($tipoKardex==0)?'':"AND kar.idtipkar = '$tipoKardex'";
    $queryAnio = ($anio==0)?'':"AND YEAR(kar.fechaescritura) = '$anio'";
    $queryActo = ($acto==0)?'':"AND tac.idtipoacto = '$acto'";
    $queryCliente = ($cliente=='')?'':"AND (CONCAT(cl2.prinom, ' ', cl2.segnom, IF(cl2.segnom='','',' '),cl2.apepat, ' ',cl2.apemat) LIKE '%$cliente%' OR cl2.razonsocial LIKE '%$cliente%')";
    $queryNumDoc = ($numDoc=='')?'':"AND cl2.numdoc LIKE '%$numDoc%'";
    $queryNumEscritura = ($numEscAct=='')?'':"AND (LPAD(kar.numescritura, 4, '0')) = LPAD($numEscAct, 4, '0')";
    $numKardex = ($numKardex=='')?'':"AND kar.kardex LIKE '%$numKardex%'";

    
    
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
                            GROUP_CONCAT(IF (cl2.tipper = 'J', cl2.`razonsocial`, CONCAT(cl2.prinom,' ',cl2.segnom,IF (cl2.segnom = '', '', ' '),cl2.apepat,' ',cl2.apemat)) SEPARATOR ' / ') AS clientes 
        FROM kardex AS kar 
        LEFT JOIN tiposdeacto AS tac ON kar.codactos = tac.idtipoacto 
        LEFT JOIN contratantes AS con ON kar.kardex = con.kardex 
        LEFT JOIN cliente2 AS cl2 ON con.idcontratante = cl2.idcontratante 
        WHERE CAST(kar.numescritura AS SIGNED) >= 1  $queryTipoKardex $queryAnio $queryActo $queryCliente $queryNumDoc $queryNumEscritura $numKardex
        GROUP BY kar.numescritura, kar.kardex 
        ORDER BY CAST(kar.numescritura AS SIGNED) DESC";
  
$queryGetBusTotal = "SELECT 
                        count(*) as total
                    FROM(
                        SELECT 
                            count(*) as total
                        FROM kardex AS kar 
                        LEFT JOIN tiposdeacto AS tac ON kar.codactos = tac.idtipoacto 
                        LEFT JOIN contratantes AS con ON kar.kardex = con.kardex 
                        LEFT JOIN cliente2 AS cl2 ON con.idcontratante = cl2.idcontratante 
                        WHERE CAST(kar.numescritura AS SIGNED) >= 1
                        GROUP BY kar.numescritura, kar.kardex 
                        ORDER BY CAST(kar.numescritura AS SIGNED) DESC) as t";
        
$arrBus = array();
// $resultBusTotal = mysql_query($queryGetBusTotal, $conn) or die(mysql_error());
// while($rowTotal = mysql_fetch_array($resultBusTotal)){
//     $arrBus['numRows'] = $rowTotal['total'];
// }
        
$resultBus = mysql_query($queryGetBus, $conn) or die(mysql_error());
while($row = mysql_fetch_array($resultBus)){
    $fechaEntera = strtotime($row["fechaescritura"]);
            $anio = date("Y", $fechaEntera);
            $numEscritura =  '';
            $dirEscritura =  '';
            if($row['idtipkar']==1){
                $numEscritura = 'E'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'ESCRITURAS';
                $dirProyecto = 'Escrituras';
                $acto = 'Escrituras Publicas';
            }
            if($row['idtipkar']==2){
                $numEscritura = 'N'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'NOCONTENCIOSOS';
                $dirProyecto = 'NoContenciosos';
                $acto = 'Asuntos no Contenciosos';
            }
            if($row['idtipkar']==3){
                $numEscritura = 'A'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'ACTAS';
                $dirProyecto = 'Vehicular';
                $acto = 'Transferencia Vehicular';
            }
            if($row['idtipkar']==4){
                $numEscritura = 'G'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'GARANTIAS';
                $dirProyecto = 'GarantiasMobiliarias';
                $acto = 'Garantia Mobiliaria';
            }
            if($row['idtipkar']==5){
                $numEscritura = 'T'.$row["numescritura"].'-'.$anio;
                $dirEscritura = 'TESTAMENTOS';
                $dirProyecto = 'Testamentos';
                $acto = 'Testamento';
            }
                      
        
        if(file_exists('D:/escaneos/'.$anio.'/'.$dirEscritura.'/'.$numEscritura.'.pdf')){
            $imgPdf = '<a href=# onclick=abrirPdf('.'"'.$numEscritura.'"'.','.'"'.$dirEscritura.'"'.','.'"'.$anio.'"'.')><img src="../../images/pdf.png" alt="" width="22px"></a>';
        }else{
            $imgPdf = 'FALTA SCANEO';
        }

        if(file_exists('C:/Proyectos/'.$dirProyecto.'/'.$anio.'/__PROY__'.$row["kardex"].'.docx')){
            $imgWord = '<img id="srcImg" src="../../iconos/word2.png" alt="" width="22px">';
        }else{
            $imgWord = 'FALTA REG.';
        }

    $arrBus[] = array(
        'numEscAct' => $row['numescritura'],
        'kardexAnio' => $row['kardex'],
        'URL' => '../../verkardex.php?kardex='.$row['kardex'].'&id='.$row['idkardex'],
        'fecEscritura' => $row['fechaescritura'],
        'contratantes' =>  $row['clientes'],
        'actos' => $row['contrato'],
        'folioIn' => $row['folioini'],
        'folioFin' => $row['foliofin'],
        'responsable' => $row['responsable_new'],
        'escaneo' => $imgPdf,
        'registro' => $imgWord,
        'anio' => $anio,
        'directorio' => $dirProyecto,
    );    
}
echo json_encode($arrBus);

?>