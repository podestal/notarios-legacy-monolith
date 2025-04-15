<?php
    include('conexion.php');
    $idContratante = $_GET['idContratante'];
    // Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
    require_once ('dompdf/dompdf_config.inc.php');
    
    $ocuif = $_GET['ocuif'];
    $oiuif = $_GET['oiuif'];
    
    $ocuif2='';
    $oiuif2='';

    if($ocuif=='true'){
        $ocuif2='SI( &nbsp;&nbsp;&nbsp; ) NO(&nbsp;&nbsp;&nbsp;)';
        // $ocuif2='SI( <span style="color:steelblue">X</span> ) NO(&nbsp;&nbsp;&nbsp;)';
    }else{
        $ocuif2='SI(&nbsp;&nbsp;&nbsp;) NO(&nbsp;&nbsp;&nbsp;)';
        // $ocuif2='SI(&nbsp;&nbsp;&nbsp;) NO( <span style="color:steelblue">X</span> )';
    }

    if($oiuif=='true'){
        $oiuif2='SI(&nbsp;&nbsp;&nbsp;) NO(&nbsp;&nbsp;&nbsp;)';
        // $oiuif2='SI( <span style="color:steelblue">X</span> ) NO(&nbsp;&nbsp;&nbsp;)';
    }else{
        $oiuif2='SI(&nbsp;&nbsp;&nbsp;) NO(&nbsp;&nbsp;&nbsp;)';
        // $oiuif2='SI(&nbsp;&nbsp;&nbsp;) NO( <span style="color:steelblue">X</span> )';
    }

    $queryPersonaNatural = "SELECT CONCAT(c2.prinom,' ',c2.segnom,' ',c2.apepat,' ',c2.apemat) as nombres,
                    IF(c2.tipper='N',c2.numdoc,'') as numero_documento,
                    -- CONCAT(u.nomdis,' ',u.nomprov,' ',u.nomdpto) as ubigeo,
                    c2.natper as lugar_nacimiento,
                    c2.direccion,
                    c2.cumpclie as fecha_nacimiento,
                    c2.telcel as telefono,
                    IF(c2.tipper='N',c2.email,'') as correo,
                    c2.profesion_plantilla as ocupacion,
                    nac.desnacionalidad as nacionalidad,
                    ec.desestcivil as estado_civil,
                    IF(c2.tipper='N',cxa.ofondo,'') as origen_fondo,
                    IF(c2.idestcivil='2',CONCAT(cc2.prinom,' ',cc2.segnom,' ',cc2.apepat,' ',cc2.apemat),'') as nombres_conyuge,
                    IF(c2.idestcivil='5',CONCAT(cc2.prinom,' ',cc2.segnom,' ',cc2.apepat,' ',cc2.apemat),'') as nombres_conviviente
                FROM cliente2 AS c2
                LEFT JOIN ubigeo as u ON u.coddis = c2.idubigeo
                LEFT JOIN nacionalidades as nac on nac.idnacionalidad = c2.nacionalidad
                LEFT JOIN tipoestacivil as ec on ec.idestcivil = c2.idestcivil
                LEFT JOIN contratantesxacto as cxa on cxa.idcontratante = c2.idcontratante
                LEFT JOIN cliente2 as cc2 on cc2.idcliente = c2.conyuge
                WHERE c2.idcontratante='$idContratante'";

    $resultPersonaNatural = mysql_query($queryPersonaNatural, $conn) or die(mysql_error());
    $personaNatural = mysql_fetch_assoc($resultPersonaNatural);


    $queryPersonaJuridica = "SELECT c2.razonsocial as razon_social,
                    IF(c2.tipper='J',c2.numdoc,'') as numero_documento,
                    c2.domfiscal as domicilio,                  
                    CONCAT(u.nomdis,' ',u.nomprov,' ',u.nomdpto) as ubigeo,
                    c2.telempresa as telefono,
                    IF(c2.tipper='J',c2.email,'') as correo,
                    c2.contacempresa as objeto_social,
                    IF(c2.tipper='J',cxa.ofondo,'') as origen_fondo,
                    (SELECT CONCAT(cr2.prinom,' ',cr2.segnom,' ',cr2.apepat,' ',cr2.apemat) 
                        FROM contratantes as c
                        LEFT JOIN cliente2 as cr2 on cr2.idcontratante = c.idcontratante 
                        WHERE idcontratanterp='$idContratante' LIMIT 1) as nombres_representante
                FROM cliente2 AS c2
                LEFT JOIN ubigeo as u ON u.coddis = c2.idubigeo
                LEFT JOIN nacionalidades as nac on nac.idnacionalidad = c2.nacionalidad
                LEFT JOIN tipoestacivil as ec on ec.idestcivil = c2.idestcivil
                LEFT JOIN contratantesxacto as cxa on cxa.idcontratante = c2.idcontratante
                LEFT JOIN contratantes as c on c.idcontratanterp = c2.idcontratante
                WHERE c2.idcontratante='$idContratante'";

    $resultPersonaJuridica = mysql_query($queryPersonaJuridica, $conn) or die(mysql_error());
    $personaJuridica = mysql_fetch_assoc($resultPersonaJuridica);

    // Introducimos HTML
    $html='<body>';
        $html='<table border=1 style="font-family:Helvetica;font-size:.8em;border-collapse:collapse;width:100%;">';
            $html.='<thead>';
                $html.='<tr>';
                    $html.='<th  style="border:1px solid white;text-align: left"><img src="images/logo-nrz.jpg"  width="120px"></th>';
                    $html.='<th  style="border:1px solid white;font-size:1.5em"><b><i>ANEXO N° 5</i></b></th>';
                    $html.='<th  colspan="2" style="border:1px solid white;font-size:.75em"><b>Para uso exclusivo de la Notaría Rodriguez Zea</b></th>';
                $html.='</tr>';
            $html.='</thead>';
            $html.='<tbody >';
                $html.='<tr >';
                    $html.='<td colspan="4" style="text-align:center;background:rgb(190,190,190)">
                    <b style="font-size:1.2em;">DECLARACIÓN JURADA DE CONOCIMIENTO DE CLIENTE</b>
                            </td>';
                $html.='</tr>';
            
                $html.='<tr>';
                    $html.='<td colspan="4">Por el presente documento, declaro bajo juramento, lo siguiente:</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4" style="text-align:center;background:rgb(190,190,190),"><b>PERSONA NATURAL</b></td>';    
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">a) Nombres y Apellidos: '.$personaNatural['nombres'].'</td>';    
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">b) Tipo y número de documento de identidad: '. $personaNatural['numero_documento'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">c) Lugar y fecha de nacimiento: '.$personaNatural['lugar_nacimiento'].' - '.$personaNatural['fecha_nacimiento'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">d) Nacionalidad: '.$personaNatural['nacionalidad'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">e) Estado civil: '.$personaNatural['estado_civil'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;1) Nombre del cónyuge de ser casado: '.$personaNatural['nombres_conyuge'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;2) Si declara ser conviviente, consignar nombres y apellidos: '.$personaNatural['nombres_conviviente'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">f) Domicilio declarado (lugar de residencia): '.$personaNatural['direccion'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">g) Numero de teléfono (fijo y celular): '.$personaNatural['telefono'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">h) Correo electrónico: '.$personaNatural['correo'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">i) Profesión u ocupación: '.$personaNatural['ocupacion'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">j) 
                    Cargo, función pública o función prominente que desempeña o que haya<br> 
                    desempeñado en los últimos cinco(5) años, en el Peru o en el extranjero, indicando<br>
                    el nombre del organismo público u organización internacional. Asimismo, el nombre<br> 
                    de sus parientes hasta el segundo grado de consanguinidad, segundo de afinidad.                    
                    </td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="3">k) Es sujeto obligado informar a la UIF-Perú</td>';
                    $html .= '<td style="text-align:right;">'.$oiuif2.'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="3">En caso marcó SI, indique si designó a su Oficial de Cumplimiento:</td>';
                    $html .= '<td style="text-align:right;">'.$ocuif2.'</td>';
                $html.='</tr>';
                
                $html.='<tr>';
                    $html .= '<td colspan="4">l) 
                                El origen de los fondos, bienes u otros activos involucrados en dicha <br>
                                transacción (especifique): '.$personaNatural['origen_fondo'].'
                            </td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html .= '<td colspan="4">m) 
                                Nombres y Apellidos de la persona natural a la que representa, de ser el caso:

                            </td>';
                $html.='</tr>';
           

                $html.='<tr>';
                    $html.= '<td colspan="4" style="text-align:center;background:rgb(190,190,190)"><b>PERSONA JURIDICA</b></td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="4">a) Denominación o razón social: '.$personaJuridica['razon_social'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="4">b) Registro Único de Contribuyentes (RUC), de ser el caso: '.$personaJuridica['numero_documento'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="4">
                            c) Objeto social y actividad económica principal (comercial, industrial, construcción,<br>
                            transporte,etc): '.$personaJuridica['objeto_social'].'
                    </td>';
                $html.='</tr>';
            
                $html.='<tr>';
                    $html.= '<td colspan="4">
                            d) Identificación del representante legal o de quien comparece con facultades de<br>
                            representación y/o disposición de la persona jurídica: '.$personaJuridica['nombres_representante'].'
                    
                    </td>';
                $html.='</tr>';
              
                $html.='<tr>';
                    $html.= '<td colspan="4">e) Domicilio: '.$personaJuridica['domicilio'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="4">f) Número de teléfono: '.$personaJuridica['telefono'].'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="3">g) Es sujeto obligado a informar a la UIF-Perú?</td>';
                    $html.= '<td style="text-align:right;">'.$oiuif2.'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;En caso marcó SI, indique si designó a su Oficial de Cumplimiento:</td>';
                    $html.= '<td style="text-align:right;">'.$ocuif2.'</td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="4">
                            h) El origen de los fondos, bienes u otros activos involucrado en dicha transacción
                            (especifique): '.$personaJuridica['origen_fondo'].'<br>
                    </td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="4">
                            Me afirmo y ratifíco en todo lo manifestado en la presente declarácion jurada, en señal de lo cual la firmo en la fecha que se indica.
                    </td>';
                $html.='</tr>';
                $html.='<tr>';
                    $html.= '<td colspan="2" style="text-align:center;font-size:.9em;"><br><br><br><br><br><br><span style="border-top:1px dotted black">FIRMA DEL CLIENTE Y HUELLA DACTILAR</span></td>';
                    $html.= '<td colspan="2" style="text-align:center;font-size:.9em"><br><br><br><br><br><br><span style="border-top:1px solid black">FECHA (dd/mm/aaaa)</span></td>';
                $html.='</tr>';
            $html.='</tbody>';
        $html.='</table>';
    $html.='</body>';

    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("A4", "portrait");
    
    // Cargamos el contenido HTML.
    $pdf->load_html(utf8_decode($html));
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('Declaración Jurada.pdf',array("Attachment" => 0));

?>