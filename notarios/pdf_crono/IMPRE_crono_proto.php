<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$fec_cons = $_REQUEST['fec_cons'];
$fec_not = $_REQUEST['fec_not'];
$fec_ing = $_REQUEST['fec_ing'];


$consulta_protestos =  "SELECT 
						protesto.id_protesto as id_protesto,
						CAST(protesto.num_protesto AS SIGNED) as num_protesto,
						protesto.fec_ingreso AS 'fec_ingreso', 
						protesto.fec_notificacion AS 'fec_notificacion',
						protesto.solicitante as solicitante,
						protesto.fec_constancia AS 'fec_constancia',
						monedas.desmon as moneda,
						protesto.importe as importe
						FROM
						protesto
						LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda";
						
if($fec_cons=='true'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ORDER BY fec_constancia, num_protesto ASC";
}

if($fec_not=='true'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ORDER BY fec_notificacion, id_protesto ASC";
}

if($fec_ing=='true'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ORDER BY fec_ingreso, id_protesto ASC"; 
}

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
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' align='center' bordercolor='#000000'>";
			
	for($j=0; $j<count($arr_protestos); $j++) { 
	
	$id_protesto = $arr_protestos[$j][0];
	
	$consulta_participantes =   "SELECT
								protesto_participantes.descri_parti,
								c_protesto.des_condicionp
								FROM
								protesto_participantes
								LEFT JOIN c_protesto ON protesto_participantes.tip_condi = c_protesto.id_condicionp
								WHERE
								protesto_participantes.id_protesto = $id_protesto";
								
	$ejecutar_participantes = mysql_query($consulta_participantes, $conexion);

	echo "<tr >
			<td width=48  align='center'><span class='Estilo12' >".$arr_protestos[$j][0]."</span></td>
			<td width=64  align='center'><span class='Estilo12' >".substr(formato_crono_agui($arr_protestos[$j][1]),0,-5)."</span></td>
			<td width=51  align='center'><span class='Estilo12' >".fechabd_an($arr_protestos[$j][2])."</span></td>
			<td width=69  align='center'><span class='Estilo12' >".fechabd_an($arr_protestos[$j][3])."</span></td>
			<td width=172  align='center'><span class='Estilo12' >".strtoupper ($arr_protestos[$j][4])."</span></td>";
			
	
	echo   "<td width=203 valign='top' align='center'>
			<table>";
			
	
	while($participantes = mysql_fetch_array($ejecutar_participantes)){				
    		echo "<tr><td><span class='Estilo12' >".strtoupper ($participantes['descri_parti']." : ".$participantes['des_condicionp'])."</span></td></tr>";
	}
			
	echo    "</table>
			</td>";
			
			
			
	echo   "<td width=89  align='center'><span class='Estilo12' >".fechabd_an($arr_protestos[$j][5])."</span></td>
			<td width=83  align='center'><span class='Estilo12' >".$arr_protestos[$j][6]."</span></td>
			<td width=71 align='center'><span class='Estilo12' >".$arr_protestos[$j][7]."</span></td>
		  </tr>";
   }
   
   echo "</table>";

?>