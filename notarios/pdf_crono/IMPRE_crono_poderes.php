<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 


$consulta_poder = "SELECT
						ingreso_poderes.id_poder  as id_poder,
						ingreso_poderes.num_kardex as kardex,
						poderes_asunto.des_asunto as tip_poder,
						ingreso_poderes.fec_crono as fec_crono,
						ingreso_poderes.referencia as referencia,
						ingreso_poderes.fec_ingreso as fec_ingreso,
						ingreso_poderes.swt_est as estado
						FROM ingreso_poderes 
						INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
						WHERE STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						AND STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					
$ejecutar_poder = mysql_query($consulta_poder, $conexion);

$i=0;

while($poder = mysql_fetch_array($ejecutar_poder)){

	$arr_poder[$i][0] = $poder["id_poder"]; 
	$arr_poder[$i][1] = $poder["kardex"]; 
	$arr_poder[$i][2] = $poder["tip_poder"]; 
	$arr_poder[$i][3] = $poder["fec_crono"]; 
	$arr_poder[$i][4] = $poder["referencia"]; 
	$arr_poder[$i][5] = $poder["fec_ingreso"]; 
	$arr_poder[$i][6] = $poder["estado"]; 
	
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";

	for($j=0; $j<count($arr_poder); $j++) { 

	echo "<tr>
			<td width='67' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][0]."</span></td>
			<td width='56' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][1]."</span></td>
			<td width='128' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][2]."</span></td>
			<td width='128' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][3]."</span></td>
			<td width='264' valign='top' align='center'><span class='Estilo12'>";
			
			$sql_contratantes = "SELECT
                                     cliente2.idcontratante AS id,
                                     cliente2.prinom AS prinom,
                                     cliente2.segnom AS segnom,
                                     cliente2.apemat AS apepat,
                                     cliente2.apepat AS apemat
                                     FROM
                                     poderes_contratantes
                                     Inner Join contratantes ON contratantes.idcontratante = poderes_contratantes.id_contrata
                                     Inner Join cliente2 ON contratantes.idcontratante = cliente2.idcontratante
                                     WHERE
                                     poderes_contratantes.id_poder =".$arr_poder[$j][0];
                                     
                $exe_contratantes = mysql_query($sql_contratantes, $conexion);
				
				 while($contratantes = mysql_fetch_array($exe_contratantes)){
                
                    $arr_contratantes[$k][0] = $contratantes["id"]; 
                    $arr_contratantes[$k][1] = $contratantes["prinom"]; 
                    $arr_contratantes[$k][2] = $contratantes["segnom"]; 
                    $arr_contratantes[$k][3] = $contratantes["apepat"]; 
                    $arr_contratantes[$k][4] = $contratantes["apemat"]; 
					echo "-".$arr_contratantes[$k][5] = $arr_contratantes[$k][3].' '.$arr_contratantes[$k][4].' '.$arr_contratantes[$k][1].' '.$arr_contratantes[$k][2]; 
					$k++; 
					echo "<br><br>";;
                }
				

			echo "</span></td>
			<td width='84' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][5]."</span></td>
			<td width='91' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][6]."</span></td>
 	</tr>";
   }
   
echo"</table>";


?>