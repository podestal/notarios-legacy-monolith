<link rel="stylesheet" href="stylesglobal.css">

<?php 

include('conexion.php');

include('extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta);

$consulta_incapaces = "SELECT
					  cert_supervivencia.num_crono as num_crono,
					  cert_supervivencia.fecha as fecha,
					  cert_supervivencia.nombre as nombre,
					  cert_supervivencia.direccion as direccion
					  FROM cert_supervivencia
					  WHERE cert_supervivencia.swt_capacidad = 'I'
 					  AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					  AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					
$ejecutar_incapaces = mysql_query($consulta_incapaces, $conexion);

$total_incapaces = mysql_num_rows($ejecutar_incapaces);

$num_reg = 8;

$num_pag = ceil($total_incapaces/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_incapaces = $consulta_incapaces." ORDER BY cert_supervivencia.id_supervivencia DESC LIMIT $ini, $num_reg";

$ejecutar_incapaces = mysql_query($consulta_incapaces, $conexion);

$i=0;

while($incapaces = mysql_fetch_array($ejecutar_incapaces)){

	$arr_incapaces[$i][0] = $incapaces["num_crono"]; 
	$arr_incapaces[$i][1] = $incapaces["fecha"]; 
	$arr_incapaces[$i][2] = $incapaces["nombre"]; 
	$arr_incapaces[$i][3] = $incapaces["direccion"]; 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

	echo "<tr>
             <td width='65' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Cronologico</span></td>
             <td width='84' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Fecha</span></td>
             <td width='150' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Nombre</span></td>
             <td width='86' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Dirección</span></td>
         </tr>";

	for($j=0; $j<count($arr_incapaces); $j++) { 

	echo "<tr>
			<td width='63' valign='top'><span class='Estilo12'>".formato_crono_agui($arr_incapaces[$j][0])."</span></td>
			<td width='86' valign='top'><span class='Estilo12'>".fechabd_an($arr_incapaces[$j][1])."</span></td>
			<td width='150' valign='top'><span class='Estilo12'>".$arr_incapaces[$j][2]."</span></td>
			<td width='86' valign='top'><span class='Estilo12'>".$arr_incapaces[$j][3]."</span></td>
 	</tr>";
   }
   
	echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_incapaces(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_incapaces(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_incapaces(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_incapaces(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";


?>

