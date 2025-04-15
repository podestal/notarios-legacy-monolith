<link rel="stylesheet" href="stylesglobal.css">

<?php 

include('conexion.php');

include('extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];
$nocorre = $_REQUEST['nocorre'];

if($nocorre=='on'){
	$nocorre = "NC";
}

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_viajes = "SELECT
				permi_viaje.id_viaje as cod_viaje,
				permi_viaje.fec_ingreso as fec_ingreso,
				permi_viaje.fecha_crono as fec_crono,
				permi_viaje.num_kardex as kard,
				(CASE WHEN(permi_viaje.asunto=001) THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) as asunto,
				permi_viaje.lugar_formu as lugar,
				permi_viaje.swt_est as estado
					FROM
					permi_viaje
					where STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
				    AND STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ";

					
$ejecutar_viajes = mysql_query($consulta_viajes, $conexion);

$total_viajes = mysql_num_rows($ejecutar_viajes);

$num_reg = 8;

$num_pag = ceil($total_viajes/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_viajes = $consulta_viajes." order by fec_crono,num_kardex asc LIMIT $ini, $num_reg";

$ejecutar_viajes = mysql_query($consulta_viajes, $conexion);

$i=0;

while($viajes = mysql_fetch_array($ejecutar_viajes)){

	$arr_viajes[$i][0] = $viajes["cod_viaje"]; 
	$arr_viajes[$i][1] = $viajes["kard"]; 
	$arr_viajes[$i][2] = $viajes["lugar"]; 
	$arr_viajes[$i][3] = $viajes["fec_crono"]; 
	$arr_viajes[$i][4] = $viajes["asunto"]; 
	$arr_viajes[$i][5] = $viajes["fec_ingreso"]; 
	$arr_viajes[$i][6] = $viajes["estado"]; 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
		  <tr>
			<td width='65' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Nro Control</span></td>
			<td width='70' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Cronologico</span></td>
			<td width='229' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Participantes</span></td>
			<td width='95' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Fecha Crono.</span></td>
			<td width='165' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Tip.Permiso</span></td>
			<td width='95' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Destino</span></td>
			<td width='99' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Estado</span></td>    
		  </tr>";
			
	for($j=0; $j<count($arr_viajes); $j++) { 

	echo "<tr height='auto'>
			<td valign='top' align='center'><span class='Estilo12' width='65'>".$arr_viajes[$j][0]."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='70'>".formato_crono_agui($arr_viajes[$j][1])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='129'>"; 
				$sql = mysql_query("SELECT viaje_contratantes.id_viaje, viaje_contratantes.c_descontrat, c_condiciones.des_condicion FROM viaje_contratantes LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id_condicion
WHERE viaje_contratantes.id_viaje='".$arr_viajes[$j][0]."'",$conexion) or die(mysql_error());
while($rowe2 = mysql_fetch_array($sql)){
	
	echo strtoupper ($rowe2['des_condicion']." : ".$rowe2['c_descontrat'])."</br>";
	}

				echo"</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='95'>".fechabd_an($arr_viajes[$j][3])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='165'>".$arr_viajes[$j][4]."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='95'>".strtoupper ($arr_viajes[$j][2])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='9'>".$arr_viajes[$j][6]."</span></td>
			</tr>";
   }
   
   echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_viajes(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_viajes(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_viajes(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_viajes(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";


?>









