<link rel="stylesheet" href="stylesglobal.css">

<?php 

include('conexion.php');

include('extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$fec_not = $_REQUEST['fec_not'];
$fec_cons = $_REQUEST['fec_cons'];
$fec_ing = $_REQUEST['fec_ing'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_camara = "SELECT
					protesto.id_protesto AS id_protesto,
					protesto.fec_notificacion AS fec_notificacion,
					protesto.fec_constancia AS fec_constancia,
					protesto.fec_ingreso AS fec_ingreso,
					tipo_protesto.des_tipop AS tip_prot,
					protesto.importe AS importe,
					protesto.solicitante AS solicitante,
					protesto_participantes.descri_parti AS participante,
					protesto_participantes.num_docparti AS dni,
					protesto_participantes.direccion AS direccion
					FROM protesto
					LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
					LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
					LEFT OUTER JOIN protesto_participantes ON protesto_participantes.id_protesto = protesto.id_protesto and protesto_participantes.anio=protesto.anio";
					
if($fec_not=='on'){						
	$consulta_camara = $consulta_camara." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
}

if($fec_cons=='on'){						
	$consulta_camara = $consulta_camara." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
}
if($fec_ing=='on'){						
	$consulta_camara = $consulta_camara." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
}
					
$ejecutar_camara = mysql_query($consulta_camara, $conexion);

$total_camara = mysql_num_rows($ejecutar_camara);

$num_reg = 8;

$num_pag = ceil($total_camara/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_camara = $consulta_camara." ORDER BY protesto.id_protesto DESC LIMIT $ini, $num_reg";

$ejecutar_camara = mysql_query($consulta_camara, $conexion);

$i=0;

while($camara = mysql_fetch_array($ejecutar_camara)){

	$arr_camara[$i][0] = $camara["id_protesto"]; 
	$arr_camara[$i][1] = $camara["fec_notificacion"]; 
	$arr_camara[$i][2] = $camara["fec_constancia"]; 
	$arr_camara[$i][9] = $camara["fec_ingreso"]; 
	$arr_camara[$i][3] = $camara["tip_prot"]; 
	$arr_camara[$i][4] = $camara["importe"]; 
	$arr_camara[$i][5] = $camara["solicitante"]; 
	$arr_camara[$i][6] = $camara["participante"]; 
	$arr_camara[$i][7] = $camara["dni"]; 
	$arr_camara[$i][8] = $camara["direccion"]; 
	$i++; 
	
	
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

    echo "<tr>
                <td width='25' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>C.P</span></td>
                <td width='60' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Fec. No3333t.</span></td>
                <td width='60' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Fec. Prot.</span></td>
				<td width='60' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Fec. Ingreso.</span></td>
                <td width='40' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>TIT Val</span></td>
                <td width='60' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Monto</span></td>
                <td width='130' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Solicitante</span></td>
                <td width='140' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Aceptante/Aval</span></td>
                <td width='70' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Ruc/DNI</span></td>
             	<td width='150' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Direccion Obligado o Aval</span></td>
          </tr>";

	for($j=0; $j<count($arr_camara); $j++) { 

	echo "<tr height='auto'>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][0]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".fechabd_an($arr_camara[$j][1])."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".fechabd_an($arr_camara[$j][2])."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".fechabd_an($arr_camara[$j][9])."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][3]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][4]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][5]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][6]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][7]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][7]."</span></td>
		   </tr>";
   
   }
   
   echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_camara(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_camara(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_camara(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_camara(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";

?>






