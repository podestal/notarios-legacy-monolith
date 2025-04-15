<?php
    require_once '../../reportes_word/Phpdocx/Create/CreateDocx.inc';
    include('../../includes/tbs_class.php');
    include('../../includes/tbs_plugin_opentbs.php');
    include('../../conexion.php');

    $input = json_decode($_POST['inputs']);
    $idContratante = $input->idContratante;
    $anexo = $input->anexo;
    
    $queryPersonaNatural = "SELECT 
                CONCAT(c2.prinom,' ',c2.segnom,' ',c2.apepat,' ',c2.apemat) as nombre_completo,
                CONCAT(c2.prinom,' ',c2.segnom) as nombres,
                c2.apepat as apellido_paterno,
                c2.apemat as apellido_materno,
                IF(c2.tipper='N',c2.numdoc,'') as numero_documento,
                c2.tipper,
                c2.idtipdoc,
                ac.condicion,
                CONCAT(u.nomdis,' ',u.nomprov,' ',u.nomdpto) as ubigeo,
                u.nomdis as distrito,
                u.nomprov as provincia,
                u.nomdpto as departamento,
                c2.natper as lugar_nacimiento,
                c2.direccion,
                c2.cumpclie as fecha_nacimiento,
                c2.telcel as telefono,
                IF(c2.tipper='N',c2.email,'') as correo,
                c2.profesion_plantilla as ocupacion,
                c2.profocupa as cargo,
                nac.desnacionalidad as nacionalidad,
                ec.desestcivil as estado_civil,
                IF(c2.tipper='N',cxa.ofondo,'') as origen_fondo,
                IF(c2.idestcivil='2',CONCAT(cc2.prinom,' ',cc2.segnom,' ',cc2.apepat,' ',cc2.apemat),'') as nombres_conyuge,
                cc2.numdoc as num_doc_conyuge,
                IF(c2.idestcivil='5',CONCAT(cc2.prinom,' ',cc2.segnom,' ',cc2.apepat,' ',cc2.apemat),'') as nombres_conviviente,
                cc2.numdoc as num_doc_conviviente,
                pa.idmon,
                pa.importetrans as precio_bien,
                con.fechafirma,
                k.fechaescritura
            FROM cliente2 AS c2
            LEFT JOIN ubigeo as u ON u.coddis = c2.idubigeo
            LEFT JOIN nacionalidades as nac on nac.idnacionalidad = c2.nacionalidad
            LEFT JOIN tipoestacivil as ec on ec.idestcivil = c2.idestcivil
            LEFT JOIN contratantesxacto as cxa on cxa.idcontratante = c2.idcontratante
            LEFT JOIN patrimonial as pa on pa.kardex = cxa.kardex
            LEFT JOIN cliente2 as cc2 on cc2.idcliente = c2.conyuge
            LEFT JOIN actocondicion as ac ON cxa.idcondicion=ac.idcondicion
            LEFT JOIN contratantes as con on con.idcontratante = c2.idcontratante
            LEFT JOIN kardex as k on k.kardex = con.kardex
            WHERE c2.idcontratante='$idContratante'";
    
    $resultPersonaNatural = mysql_query($queryPersonaNatural, $conn) or die(mysql_error());
    $personaNatural = mysql_fetch_assoc($resultPersonaNatural);
    
    
    
    $queryPersonaJuridica = "SELECT c2.razonsocial as razon_social,
                    IF(c2.tipper='J',c2.numdoc,'') as numero_documento,
                    c2.domfiscal as domicilio,                  
                    u.nomdis as distrito,
                    u.nomprov as provincia,
                    u.nomdpto as departamento,
                    c2.telempresa as telefono,
                    IF(c2.tipper='J',c2.email,'') as correo,
                    c2.contacempresa as objeto_social,
                    ciu.nombre as actividad_economica,
                    IF(c2.tipper='J',cxa.ofondo,'') as origen_fondo,
                    (SELECT CONCAT(cr2.prinom,' ',cr2.segnom,' ',cr2.apepat,' ',cr2.apemat) 
                        FROM contratantes as c
                        LEFT JOIN cliente2 as cr2 on cr2.idcontratante = c.idcontratante 
                        WHERE idcontratanterp='$idContratante' LIMIT 1) as nombres_representante,
                    k.fechaescritura
                FROM cliente2 AS c2
                LEFT JOIN ubigeo as u ON u.coddis = c2.idubigeo
                LEFT JOIN nacionalidades as nac on nac.idnacionalidad = c2.nacionalidad
                LEFT JOIN tipoestacivil as ec on ec.idestcivil = c2.idestcivil
                LEFT JOIN contratantesxacto as cxa on cxa.idcontratante = c2.idcontratante
                LEFT JOIN contratantes as c on c.idcontratanterp = c2.idcontratante
                LEFT JOIN kardex as k on k.kardex = c.kardex
                LEFT JOIN ciiu as ciu on ciu.coddivi = c2.actmunicipal
                WHERE c2.idcontratante='$idContratante'";
    
    $resultPersonaJuridica = mysql_query($queryPersonaJuridica, $conn) or die(mysql_error());
    $personaJuridica = mysql_fetch_assoc($resultPersonaJuridica);

    $queryRepresentante = "SELECT 
                CONCAT(c2.prinom,' ',c2.segnom,' ',c2.apepat,' ',c2.apemat) as nombre_completo,
                CONCAT(c2.prinom,' ',c2.segnom) as nombres,
                c2.apepat as apellido_paterno,
                c2.apemat as apellido_materno,
                IF(c2.tipper='N',c2.numdoc,'') as numero_documento,
                c2.tipper,
                c2.idtipdoc,
                ac.condicion,
                CONCAT(u.nomdis,' ',u.nomprov,' ',u.nomdpto) as ubigeo,
                u.nomdis as distrito,
                u.nomprov as provincia,
                u.nomdpto as departamento,
                c2.natper as lugar_nacimiento,
                c2.direccion,
                c2.cumpclie as fecha_nacimiento,
                c2.telcel as telefono,
                IF(c2.tipper='N',c2.email,'') as correo,
                c2.profesion_plantilla as ocupacion,
                c2.profocupa as cargo,
                nac.desnacionalidad as nacionalidad,
                ec.desestcivil as estado_civil,
                IF(c2.tipper='N',cxa.ofondo,'') as origen_fondo,
                IF(c2.idestcivil='2',CONCAT(cc2.prinom,' ',cc2.segnom,' ',cc2.apepat,' ',cc2.apemat),'') as nombres_conyuge,
                cc2.numdoc as num_doc_conyuge,
                IF(c2.idestcivil='5',CONCAT(cc2.prinom,' ',cc2.segnom,' ',cc2.apepat,' ',cc2.apemat),'') as nombres_conviviente,
                cc2.numdoc as num_doc_conviviente,
                pa.idmon,
                pa.importetrans as precio_bien,
                con.fechafirma,
                k.fechaescritura
            FROM cliente2 AS c2
            LEFT JOIN ubigeo as u ON u.coddis = c2.idubigeo
            LEFT JOIN nacionalidades as nac on nac.idnacionalidad = c2.nacionalidad
            LEFT JOIN tipoestacivil as ec on ec.idestcivil = c2.idestcivil
            LEFT JOIN contratantesxacto as cxa on cxa.idcontratante = c2.idcontratante
            LEFT JOIN patrimonial as pa on pa.kardex = cxa.kardex
            LEFT JOIN cliente2 as cc2 on cc2.idcliente = c2.conyuge
            LEFT JOIN actocondicion as ac ON cxa.idcondicion=ac.idcondicion
            LEFT JOIN contratantes as con on con.idcontratante = c2.idcontratante
            LEFT JOIN kardex as k on k.kardex = con.kardex
            WHERE con.idcontratanterp='$idContratante'";
    
    $resultRepresentante = mysql_query($queryRepresentante, $conn) or die(mysql_error());
    // $representante = mysql_fetch_assoc($resultRepresentante);
    
    $rutaPlantilla="D://plantillas/DECLARACIONES JURADAS/";

    //COMPROBACION DE SI EXISTE O NO EL DIRECTORIO DONDE SE CREARA EL DOCUMENTO
	if(!file_exists("C://Proyectos/DDJJ/".$anexo."/")){
		mkdir("C://Proyectos/DDJJ/".$anexo."/",0700);
	}

    $rutaDocumentoGenerado="C://Proyectos/DDJJ/".$anexo."/";
    // $rutaDocumentoGenerado="C://Proyectos/DDJJ/ANEXO5/";
    $plantilla = '';
    
    
    
    if($personaNatural['tipper']=='N'){
        $plantilla = $anexo.'.docx';
    }else{
        $plantilla = $anexo.'.docx';
        // $plantilla = 'ANEXO5.3.docx';
    }
    
    $dni = ' ';
    $pasaporte = ' ';
    $carnetExtranjeria = ' ';
    $otroDoc = ' ';
    if($personaNatural['idtipdoc']=='1'){
        $dni = 'X';
    }else if($personaNatural['idtipdoc']=='5'){
        $pasaporte = 'X';
    }else if($personaNatural['idtipdoc']=='2'){
        $carnetExtranjeria = 'X';
    }else{
        $otroDoc = 'X';
    }
    
    $template = $rutaPlantilla.$plantilla;
    
    $file_name  = $rutaDocumentoGenerado."__DECLARACION_JURADA_".$anexo."__".$idContratante."."."docx";
    
    
    $fechaFirma = explode('-',$personaNatural['fechaescritura']);
    $diaFirma = $fechaFirma[2];
    $mesFirma = $fechaFirma[1];
    $anioFirma = $fechaFirma[0];
    
    
    $soltero = '  ';
    $casado = '  ';
    $divorciado = '  ';
    $viudo = '  ';
    $otro = '  ';
    switch ($personaNatural['estado_civil']) {
        case 'SOLTERO':
            $soltero = 'X';
            break;
        case 'CASADO':
            $casado = 'X';
            break;
        case 'DIVORCIADO':
            $divorciado = 'X';
            break;
        case 'VIUDO':
            $viudo = 'X';
            break;
        
        default:
            $otro = "";
    }
        
    $vendedor = '  ';
    $comprador = '  ';
    $poderdante = '  ';
    $apoderado = '  ';
    $donante = '  ';
    $donatario = '  ';
    $adjudicante = '  ';
    $adjudicatario = '  ';
    $anticipante = ' ';
    $anticipado = '  ';
    $otorgante = '  ';
    $otro = '  ';
    switch ($personaNatural['condicion']) {
        case 'VENDEDOR':
            $vendedor = 'X';
            break;
        case 'COMPRADOR':
            $comprador = 'X';
            break;
        case 'PODERDANTE':
            $poderdante = 'X';
            break;
        case 'APODERADO':
            $apoderado = 'X';
            break;
        case 'DONANTE':
            $donante = 'X';
            break;
        case 'DONATARIO':
            $donatario = 'X';
        break;
        case 'ADJUDICANTE':
            $adjudicante = 'X';
            break;
        case 'ADJUDICATARIO':
            $adjudicatario = 'X';
            break;
        case 'ANTICIPANTE':
            $anticipante = 'X';
            break;
        case 'ANTICIPADO':
            $anticipado = 'X';
            break;
        case 'OTORGANTE':
            $otorgante = 'X';
            break;
        default:
            $otro = "X";
    }
    
    // $parentescoSI = ' ';
    // $parentescoNO = ' ';
    // if($personaNatural['parentesco'] == 'SI'){
    //     $parentescoSI = 'X';
    // }else if($personaNatural['parentesco'] == 'NO'){
    //     $parentescoNO = 'X';
    // }
    
    // $pepSI = ' ';
    // $pepNO = ' ';
    // if($personaNatural['pep'] == 'SI'){
    //     $pepSI = 'X';
    // }else if($personaNatural['pep'] == 'NO'){
    //     $pepNO = 'X';
    // }
    
    // $sisoy2 = ' ';
    // $sihesido2 = ' ';
    // $nosoy2 = ' ';
    // $nohesido2 = ' ';
    
    // if($personaNatural['pep2'] == 'SI SOY'){
    //     $sisoy2 = 'X';
    // }else if($personaNatural['pep2'] == 'SI HE SIDO'){
    //     $sihesido2 = 'X';
    // }else if($personaNatural['pep2'] == 'NO SOY'){
    //     $nosoy2 = 'X';
    // }else if($personaNatural['pep2'] == 'NO HE SIDO'){
    //     $nohesido2 = 'X';
    // }
    
    // $sisoy3 = ' ';
    // $sihesido3 = ' ';
    // $nosoy3 = ' ';
    // $nohesido3 = ' ';
    
    // if($personaNatural['pep3'] == 'SI SOY'){
    //     $sisoy3 = 'X';
    // }else if($personaNatural['pep3'] == 'SI HE SIDO'){
    //     $sihesido3 = 'X';
    // }else if($personaNatural['pep3'] == 'NO SOY'){
    //     $nosoy3= 'X';
    // }else if($personaNatural['pep3'] == 'NO HE SIDO'){
    //     $nohesido3 = 'X';
    // }
    
    // $uifSI1 = ' ';
    // $uifNO1 = ' ';
    // if($personaNatural['uif'] == 'SI'){
    //     $uifSI1 = 'X';
    // }else if($personaNatural['uif'] == 'NO'){
    //     $uifNO1 = 'X';
    // }
    
    // $uifSI2 = ' ';
    // $uifNO2 = ' ';
    // if($personaNatural['uif2'] == 'SI'){
    //     $uifSI2 = 'X';
    // }else if($personaNatural['uif2'] == 'NO'){
    //     $uifNO2 = 'X';
    // }
    
    if($personaNatural['idmon']=='1'){
        $moneda = 'S/.';
    }else if($personaNatural['idmon']=='2'){
        $moneda = '$. ';
    }

    $arrRepresentantes = array();
    while($representante = mysql_fetch_array($resultRepresentante)){
        $arrRepresentantes[] = array(
            'nombre_completo' => $representante['nombre_completo'],
            'nombres' => $representante['nombres'],
            'apellido_paterno' => $representante['apellido_paterno'],
            'apellido_materno' => $representante['apellido_materno'],
            'numero_documento' => $representante['numero_documento'],
            'lugar_nacimiento' => $representante['lugar_nacimiento'],
            'fecha_nacimiento' => $representante['fecha_nacimiento'],
            'nacionalidad' => $representante['nacionalidad'],
            'estado_civil' => $representante['estado_civil'],
            'condicion' => $representante['condicion'],
            'nombres_conyuge' => $representante['nombres_conyuge'],
            'num_doc_conyuge' => $representante['num_doc_conyuge'],
            'nombres_conviviente' => $representante['nombres_conviviente'],
            'num_doc_conviviente' => $representante['num_doc_conviviente'],
            'distrito' => $representante['distrito'],
            'provincia' => $representante['provincia'],
            'departamento' => $representante['departamento'],
            'direccion' => $representante['direccion'],
            'telefono' => $representante['telefono'],
            'correo' => $representante['correo'],
            'ocupacion' => $representante['ocupacion'],
            'cargo' => $representante['cargo'],
            'origen_fondo' => $representante['origen_fondo'],
            'precio_bien' => $representante['precio_bien'],
            'fechaescritura' => $representante['fechaescritura'],
        );    
    }

    $dataDocumento[] = array(
        'NOMBRE_COMPLETO' => $personaNatural['nombre_completo'],
        'NOMBRES' => $personaNatural['nombres'],
        'APE_PAT' => $personaNatural['apellido_paterno'],
        'APE_MAT' => $personaNatural['apellido_materno'],
        'NRO_DOC' => $personaNatural['numero_documento'],
        'LUGAR_NACIMIENTO' => $personaNatural['lugar_nacimiento'],
        'FECHA_NACIMIENTO' => $personaNatural['fecha_nacimiento'],
        'NACIONALIDAD' => $personaNatural['nacionalidad'],
        'ESTADO_CIVIL' => $personaNatural['estado_civil'],
        'CONDICION' => $personaNatural['condicion'],
        'NOMBRES_CONYUGE' => utf8_decode($personaNatural['nombres_conyuge']),
        'NUM_DOC_CONYUGE' => $personaNatural['num_doc_conyuge'],
        'NOMBRES_CONVIVIENTE' => utf8_decode($personaNatural['nombres_conviviente']),
        'NUM_DOC_CONVIVIENTE' => $personaNatural['num_doc_conviviente'],
        'DISTRITO' => utf8_decode($personaNatural['distrito']),
        'PROVINCIA' => utf8_decode($personaNatural['provincia']),
        'DEPARTAMENTO' => utf8_decode($personaNatural['departamento']),
        'DIRECCION' => utf8_decode($personaNatural['direccion']),
        'TELEFONO' => $personaNatural['telefono'],
        'CORREO' => $personaNatural['correo'],
        'OCUPACION' => $personaNatural['ocupacion'],
        'CARGO' => $personaNatural['cargo'],
        'ORIGEN_FONDO_NATURAL' => utf8_decode(strtoupper($personaNatural['origen_fondo'])),
        'PRECIO_BIEN_NATURAL' => $personaNatural['precio_bien'],
        'FECHA_FIRMA' => $personaNatural['fechaescritura'],
        'DIA' => $diaFirma,
        'MES' => $mesFirma,
        'ANIO' => $anioFirma,

        'RAZON_SOCIAL' => utf8_decode($personaJuridica['razon_social']),
        'RUC' => $personaJuridica['numero_documento'],
        'OBJETO_SOCIAL' => utf8_decode($personaJuridica['objeto_social']),
        'ACTIVIDAD_ECONOMICA' => utf8_decode($personaJuridica['actividad_economica']),
        'NOMBRES_REPRESENTANTE' => $personaJuridica['nombres_representante'],
        'DISTRITOE' => utf8_decode($personaJuridica['distrito']),
        'PROVINCIAE' => utf8_decode($personaJuridica['provincia']),
        'DEPARTAMENTOE' => utf8_decode($personaJuridica['departamento']),
        'DOMICILIO' => utf8_decode($personaJuridica['domicilio']),
        'TELEFONOE' => $personaJuridica['telefono'],
        'ORIGEN_FONDO_JURIDICA' => utf8_decode($personaJuridica['origen_fondo']),
    
        // 'CARGO_FUNCION_PUBLICA' => strtoupper($personaNatural['cargoFuncionPublica']), 
        // 'DESCRIPCION_BIEN' =>  strtoupper(utf8_decode($personaJuridica['descripcion_bien'])),

        'NOMBRE_COMPLETOR' => $arrRepresentantes[0]['nombre_completo'],
        'NOMBRESR' => $arrRepresentantes[0]['nombres'],
        'APE_PATR' => $arrRepresentantes[0]['apellido_paterno'],
        'APE_MATR' => $arrRepresentantes[0]['apellido_materno'],
        'NRO_DOCR' => $arrRepresentantes[0]['numero_documento'],
        'LUGAR_NACIMIENTOR' => $arrRepresentantes[0]['lugar_nacimiento'],
        'FECHA_NACIMIENTOR' => $arrRepresentantes[0]['fecha_nacimiento'],
        'NACIONALIDADR' => $arrRepresentantes[0]['nacionalidad'],
        'ESTADO_CIVILR' => $arrRepresentantes[0]['estado_civil'],
        'CONDICIONR' => $arrRepresentantes[0]['condicion'],
        'NOMBRES_CONYUGER' => utf8_decode($arrRepresentantes[0]['nombres_conyuge']),
        'NUM_DOC_CONYUGER' => $arrRepresentantes[0]['num_doc_conyuge'],
        'NOMBRES_CONVIVIENTER' => utf8_decode($arrRepresentantes[0]['nombres_conviviente']),
        'NUM_DOC_CONVIVIENTER' => $arrRepresentantes[0]['num_doc_conviviente'],
        'DISTRITOR' => utf8_decode($arrRepresentantes[0]['distrito']),
        'PROVINCIAR' => utf8_decode($arrRepresentantes[0]['provincia']),
        'DEPARTAMENTOR' => utf8_decode($arrRepresentantes[0]['departamento']),
        'DIRECCIONR' => utf8_decode($arrRepresentantes[0]['direccion']),
        'TELEFONOR' => $arrRepresentantes[0]['telefono'],
        'CORREOR' => $arrRepresentantes[0]['correo'],
        'OCUPACIONR' => $arrRepresentantes[0]['ocupacion'],
        'CARGOR' => $arrRepresentantes[0]['cargo'],
        'ORIGEN_FONDO_NATURALR' => utf8_decode(strtoupper($arrRepresentantes[0]['origen_fondo'])),
        'PRECIO_BIEN_NATURALR' => $arrRepresentantes[0]['precio_bien'],
        'FECHA_FIRMAR' => $arrRepresentantes[0]['fechaescritura'],

        'NOMBRE_COMPLETOR2' => $arrRepresentantes[1]['nombres'],
        'NOMBRE_COMPLETOR2' => $arrRepresentantes[1]['nombre_completo'],
        'NOMBRESR2' => $arrRepresentantes[1]['nombres'],
        'APE_PATR2' => $arrRepresentantes[1]['apellido_paterno'],
        'APE_MATR2' => $arrRepresentantes[1]['apellido_materno'],
        'NRO_DOCR2' => $arrRepresentantes[1]['numero_documento'],
        'LUGAR_NACIMIENTOR2' => $arrRepresentantes[1]['lugar_nacimiento'],
        'FECHA_NACIMIENTOR2' => $arrRepresentantes[1]['fecha_nacimiento'],
        'NACIONALIDADR2' => $arrRepresentantes[1]['nacionalidad'],
        'ESTADO_CIVILR2' => $arrRepresentantes[1]['estado_civil'],
        'CONDICIONR2' => $arrRepresentantes[1]['condicion'],
        'NOMBRES_CONYUGER2' => utf8_decode($arrRepresentantes[1]['nombres_conyuge']),
        'NUM_DOC_CONYUGER2' => $arrRepresentantes[1]['num_doc_conyuge'],
        'NOMBRES_CONVIVIENTER2' => utf8_decode($arrRepresentantes[1]['nombres_conviviente']),
        'NUM_DOC_CONVIVIENTER2' => $arrRepresentantes[1]['num_doc_conviviente'],
        'DISTRITOR2' => utf8_decode($arrRepresentantes[1]['distrito']),
        'PROVINCIAR2' => utf8_decode($arrRepresentantes[1]['provincia']),
        'DEPARTAMENTOR2' => utf8_decode($arrRepresentantes[1]['departamento']),
        'DIRECCIONR2' => utf8_decode($arrRepresentantes[1]['direccion']),
        'TELEFONOR2' => $arrRepresentantes[1]['telefono'],
        'CORREOR2' => $arrRepresentantes[1]['correo'],
        'OCUPACIONR2' => $arrRepresentantes[1]['ocupacion'],
        'CARGOR2' => $arrRepresentantes[1]['cargo'],
        'ORIGEN_FONDO_NATURALR2' => utf8_decode(strtoupper($arrRepresentantes[1]['origen_fondo'])),
        'PRECIO_BIEN_NATURALR2' => $arrRepresentantes[1]['precio_bien'],
        'FECHA_FIRMAR2' => $arrRepresentantes[1]['fechaescritura'],
   
    );
    
    ## 5.-CREAMOS EL OBJETO DONDE GENERAREMOS EL DOCUMENTO	
    $TBS = new clsTinyButStrong; 
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
    $TBS->NoErr = true;
    $TBS->LoadTemplate($template);
    $TBS->MergeBlock('E',$dataDocumento);
    $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
    $TBS->Show(TBSZIP_FILE, $file_name);
    
    $result['msg'] = "Se genero el archivo: ".$numContrato." satisfactoriamente.. !!";
    $result['numeroContrato'] = $numContrato;
    
    echo json_encode($dataDocumento);
?>