<link rel="stylesheet" href="stylesglobal.css">

<?php 

include('conexion.php');

include('extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

/*$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); */

$consulta_cartas = "SELECT
					ingreso_cartas.fec_entrega as fec_entrega,
					ingreso_cartas.nom_remitente as remitente,
					ingreso_cartas.nom_destinatario as destinatario,
					ingreso_cartas.zona_destinatario as id_zona,
					ingreso_cartas.num_carta as num_carta,
					ingreso_cartas.fec_ingreso as fec_ingreso,
					ubigeo.nomdis as zona
					FROM
					ingreso_cartas
					INNER JOIN ubigeo ON ingreso_cartas.zona_destinatario = ubigeo.coddis
					WHERE STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') >= STR_TO_DATE('$desde','%d/%m/%Y') 
					AND STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') <= STR_TO_DATE('$hasta','%d/%m/%Y')";


$ejecutar_cartas = mysql_query($consulta_cartas, $conexion);

$total_cartas = mysql_num_rows($ejecutar_cartas);

$num_reg = 15;

$num_pag = ceil($total_cartas/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_cartas = $consulta_cartas." ORDER BY ingreso_cartas.fec_ingreso asc, ingreso_cartas.num_carta asc LIMIT $ini, $num_reg";

$ejecutar_cartas = mysql_query($consulta_cartas, $conexion);

$i=0;

while($cartas = mysql_fetch_array($ejecutar_cartas)){

	$arr_cartas[$i][0] = $cartas["num_carta"]; 
	$arr_cartas[$i][1] = $cartas["fec_ingreso"]; 
	$arr_cartas[$i][2] = $cartas["fec_entrega"]; 
	$arr_cartas[$i][3] = $cartas["zona"]; 
	$arr_cartas[$i][4] = strtoupper($cartas["remitente"]); 
	$arr_cartas[$i][5] = strtoupper($cartas["destinatario"]); 
	$i++; 
	  
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

	  echo "<tr height='19'>
              <td width='70' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Numero</span></td>
              <td width='86' bgcolor='#CCCCCC'><span class='Estilo14'>Fec. Ingr.</span></td>
              <td width='86' bgcolor='#CCCCCC'><span class='Estilo14'>Fec. Dilig.</span></td>
              <td width='93' bgcolor='#CCCCCC'><span class='Estilo14'>Zona</span></td>
              <td width='171' bgcolor='#CCCCCC'><span class='Estilo14'>Remitente</span></td>
              <td width='275' bgcolor='#CCCCCC'><span class='Estilo14'>Destinatario</span></td>
            </tr>";

	for($j=0; $j<count($arr_cartas); $j++) { 

		echo "<tr>
			  <td valign='top'><span class='Estilo12'>".formato_crono_agui($arr_cartas[$j][0])."</span></td>
			  <td valign='top'><span class='Estilo12'>".$arr_cartas[$j][1]."</span></td>
			  <td valign='top'><span class='Estilo12'>".$arr_cartas[$j][2]."</span></td>
			  <td valign='top'><span class='Estilo12'>".$arr_cartas[$j][3]."</span></td>
			  <td valign='top'><span class='Estilo12'>".simbolos($arr_cartas[$j][4])."</span></td>
			  <td valign='top'><span class='Estilo12'>".simbolos($arr_cartas[$j][5])."</span></td>
			  </tr>";
			  
			  
	}

	echo "<tr height='25'>
				    <td colspan='11' align='center' valign='bottom'>
					    <table style='margin-bottom:4px'>
						   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_cartas(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_cartas(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_cartas(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_cartas(".($ini_pag+7).")'>--></div></td>";
						    }
						  
							
						echo "</tr>
			  	        </table>
					</td>
			    </tr>";
	echo	"</table>";	



?>

