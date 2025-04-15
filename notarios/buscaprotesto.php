<link rel="stylesheet" href="stylesglobal.css">

<?php 

include('conexion.php');

include('extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$fec_cons = $_REQUEST['fec_cons'];
$fec_not = $_REQUEST['fec_not'];
$fec_ing = $_REQUEST['fec_ing'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_protestos =  "SELECT 
						protesto.id_protesto as id_protesto,
						CAST(protesto.num_protesto AS SIGNED) as num_protesto,
						protesto.fec_ingreso AS 'fec_ingreso', 
						protesto.fec_notificacion AS 'fec_notificacion',
						protesto.solicitante as solicitante,
						protesto.fec_constancia AS 'fec_constancia',
						monedas.desmon as moneda,
						protesto.importe as importe,
						protesto.anio as anio
						FROM
						protesto
						LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda";
						
if($fec_cons=='on'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ORDER BY fec_constancia, num_protesto ASC";
}

if($fec_not=='on'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ORDER BY fec_notificacion, id_protesto ASC";
}

if($fec_ing=='on'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ORDER BY fec_ingreso, id_protesto ASC"; 
}

$ejecutar_protestos = mysql_query($consulta_protestos, $conexion);

$total_protestos = mysql_num_rows($ejecutar_protestos);

$num_reg = 4;

$num_pag = ceil($total_protestos/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_protestos = $consulta_protestos." LIMIT $ini, $num_reg";

$ejecutar_protestos = mysql_query($consulta_protestos, $conexion);

$i=0;

while($protestos = mysql_fetch_array($ejecutar_protestos)){

	$arr_protestos[$i][0] = $protestos["id_protesto"]; 
	$arr_protestos[$i][1] = $protestos["num_protesto"]; 
	$arr_protestos[$i][2] = $protestos["fec_ingreso"]; 
	$arr_protestos[$i][3] = $protestos["fec_notificacion"]; 
	$arr_protestos[$i][4] = $protestos["solicitante"]; 
	$arr_protestos[$i][5] = $protestos["fec_constancia"]; 
	$arr_protestos[$i][6] = $protestos["moneda"]; 
	$arr_protestos[$i][7] = $protestos["importe"]; 
	$arr_protestos[$i][8] = $protestos["anio"]; 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
		 <tr>
			<td width='40' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>No Tit. Valor</span></td>
			<td width='60' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>No. Acta</span></td>
			<td width='40' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Fec. Ingreso</span></td>
			<td width='60' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Fec, Notific.</span></td>
			<td width='145' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Solicitante</span></td>
			<td width='145' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Participantes</span></td>
			<td width='70' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Fec. Constancia</span></td>
			<td width='70' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Tipo Moneda</span></td>
			<td width='60' bgcolor='#CCCCCC' align='center'><span class='Estilo14'>Importe</span></td>
         </tr>";
			
	for($j=0; $j<count($arr_protestos); $j++) { 
	
	$id_protesto = $arr_protestos[$j][0];
	$anio = $arr_protestos[$j][8];
	
	$consulta_participantes =   "SELECT
								protesto_participantes.descri_parti,
								c_protesto.des_condicionp
								FROM
								protesto_participantes
								LEFT JOIN c_protesto ON protesto_participantes.tip_condi = c_protesto.id_condicionp
								WHERE
								protesto_participantes.id_protesto = $id_protesto and protesto_participantes.anio='$anio'";
								
	$ejecutar_participantes = mysql_query($consulta_participantes, $conexion);

	echo "<tr height='auto'>
			<td valign='top' align='center'><span class='Estilo12' width='65'>".$arr_protestos[$j][0]."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='70'>".formato_crono_agui($arr_protestos[$j][1])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='129'>".fechabd_an($arr_protestos[$j][2])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='95'>".fechabd_an($arr_protestos[$j][3])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='165'>".strtoupper ($arr_protestos[$j][4])."</span></td>";
			
	
	echo   "<td valign='top' align='center'>
			<table>";
			
	
	while($participantes = mysql_fetch_array($ejecutar_participantes)){				
    		echo "<tr><td><span class='Estilo12' width='95'>".strtoupper ($participantes['descri_parti']." : ".$participantes['des_condicionp'])."</span></td></tr>";
	}
			
	echo    "</table>
			</td>";
			
			
			
	echo   "<td valign='top' align='center'><span class='Estilo12' width='9'>".fechabd_an($arr_protestos[$j][5])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='9'>".$arr_protestos[$j][6]."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='9'>".$arr_protestos[$j][7]."</span></td>
		  </tr>";
   }
   
   echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_protesto(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_protesto(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_protesto(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_protesto(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";


?>



