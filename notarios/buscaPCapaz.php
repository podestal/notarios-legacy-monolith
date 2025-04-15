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

$consulta_capaces = "SELECT
					 cert_supervivencia.num_crono as num_crono,
					 cert_supervivencia.fecha as fecha,
					 cert_supervivencia.nombre as nombre,
					 cert_supervivencia.direccion as direccion
					 FROM cert_supervivencia
					 WHERE cert_supervivencia.swt_capacidad = 'C'
					 AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					 AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					
$ejecutar_capaces = mysql_query($consulta_capaces, $conexion);

$total_capaces = mysql_num_rows($ejecutar_capaces);

$num_reg = 8;

$num_pag = ceil($total_capaces/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_capaces = $consulta_capaces." ORDER BY cert_supervivencia.id_supervivencia DESC LIMIT $ini, $num_reg";

$ejecutar_capaces = mysql_query($consulta_capaces, $conexion);

$i=0;

while($capaces = mysql_fetch_array($ejecutar_capaces)){

	$arr_capaces[$i][0] = $capaces["num_crono"]; 
	$arr_capaces[$i][1] = $capaces["fecha"]; 
	$arr_capaces[$i][2] = $capaces["nombre"]; 
	$arr_capaces[$i][3] = $capaces["direccion"]; 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

	echo "<tr>
              <td width='65' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Cronologico</span></td>
              <td width='84' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Fecha</span></td>
              <td width='150' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Nombre</span></td>
              <td width='86' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Dirección</span></td>
          </tr>";
			
	for($j=0; $j<count($arr_capaces); $j++) { 

	echo "<tr>
			<td width='65' valign='top'><span class='Estilo12'>".formato_crono_agui($arr_capaces[$j][0])."</span></td>
			<td width='84' valign='top'><span class='Estilo12'>".fechabd_an($arr_capaces[$j][1])."</span></td>
			<td width='150' valign='top'><span class='Estilo12'>".$arr_capaces[$j][2]."</span></td>
			<td width='86' valign='top'><span class='Estilo12'>".$arr_capaces[$j][3]."</span></td>
 	</tr>";
   }
   
	echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_capaces(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_capaces(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_capaces(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_capaces(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";


?>

