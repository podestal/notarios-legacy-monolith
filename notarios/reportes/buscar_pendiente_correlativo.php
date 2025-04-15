<?php 
include('../conexion.php');

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

$tipokar = $_POST['tipokar'];

	

if($tipokar==''){

	$query = "SELECT MAX(CAST(numescritura AS SIGNED)) AS max_escritura,
					MIN(CAST(numescritura AS SIGNED)) AS min_escritura
				FROM kardex
				WHERE fechaescritura BETWEEN '$desde' AND '$hasta' AND numescritura<>0";

	$query2 = "SELECT CAST(numescritura AS SIGNED) AS numero_escritura
							FROM kardex
							WHERE fechaescritura BETWEEN '$desde' AND '$hasta' ORDER BY numero_escritura";
}else{
	$query = "SELECT MAX(CAST(numescritura AS SIGNED)) AS max_escritura,
					MIN(CAST(numescritura AS SIGNED)) AS min_escritura
				FROM kardex
				WHERE idtipkar='$tipokar' AND fechaescritura BETWEEN '$desde' AND '$hasta' AND numescritura<>0";

	$query2 = "SELECT CAST(numescritura AS SIGNED) AS numero_escritura
							FROM kardex
							WHERE idtipkar='$tipokar' AND fechaescritura BETWEEN '$desde' AND '$hasta' ORDER BY numero_escritura";
}

$consultaTotal = mysql_query($query, $conn) or die(mysql_error());
$arrTotal=array();
while($row = mysql_fetch_assoc($consultaTotal)){
	$arrTotal=array_merge($arrTotal,range($row['min_escritura'],$row['max_escritura']));
	// $arrTotal = array_merge($arrTotal,range($row['min_escritura'],500));
	// print_r($row['max_escritura']);
}
// print_r($arrTotal);
// return false;

$consultaExistentes = mysql_query($query2, $conn) or die(mysql_error());
while($row2 = mysql_fetch_assoc($consultaExistentes)){
	$arrExistentes[] = $row2['numero_escritura'];
}

$diffArr = array_diff($arrTotal,$arrExistentes);
// print_r($diffArr);return false;

                          
                    

if($diffArr=='' || $diffArr==null){
	echo 'No hay correlativo faltante de Escritura / Acta notarial / Formulario registral';
}else{
	foreach($diffArr as $v){

		$fechaEntera = strtotime($hasta);
		$anio = date("Y", $fechaEntera);
		$numEscritura =  '';
		$dirEscritura =  '';

		switch ($tipokar) {
			case 1:
				$numEscritura = 'E'.$v.'-'.$anio;
				$dirEscritura = 'ESCRITURAS';
				break;
			case 2:
				$numEscritura = 'N'.$v.'-'.$anio;
				$dirEscritura = 'NOCONTENCIOSOS';
				break;
			case 3:
				$numEscritura = 'A'.$v.'-'.$anio;
				$dirEscritura = 'ACTAS';
				break;
			case 4:
				$numEscritura = 'G'.$v.'-'.$anio;
				$dirEscritura = 'GARANTIAS';
				break;
			case 5:
				$numEscritura = 'T'.$v.'-'.$anio;
				$dirEscritura = 'TESTAMENTOS';
				break;
			
		}              

		if(file_exists('D:/escaneos/'.$anio.'/'.$dirEscritura.'/'.$numEscritura.'.pdf')){
			$imgPdf = '<img src="../images/pdf.png" alt="" width="22px">';
		}else{
			$imgPdf = 'FALTA SCANEO';
		}
		
			$html =	'<table width="834" border="1" cellpadding="0" cellspacing="0" >';
			$html .= '<tr><td width="100">';
					if($tipokar=='1'){ $html .= "<span class='Estilo12'>Escrituras Publicas</span>"; 	}
					if($tipokar=='2'){ $html .= "<span class='Estilo12'>No Contenciosos</span>"; 	}
					if($tipokar=='3'){ $html .= "<span class='Estilo12'>Tranferencias Vehiculares</span>"; 	}
					if($tipokar=='4'){ $html .= "<span class='Estilo12'>Garantias Moviliarias</span>"; 	}
					if($tipokar=='5'){ $html .= "<span class='Estilo12'>Testamentos</span>"; 	}
			$html .= '</td>';
			$html .= '<td width="93"><span class="Estilo12">'.$v.'</span></td>';
			$html .= '<td width="93"><span class="Estilo12" ><a href="#" title="ABRIR REGISTRO" onclick="abrirPdf('."'".$numEscritura."'".','."'".$dirEscritura."'".','."'".$anio."'".')">'.$imgPdf.'</a></span></td>';
			$html .= '</tr></table>';
	
			echo $html;
	}
}
?>