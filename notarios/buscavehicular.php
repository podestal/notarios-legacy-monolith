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

$consulta_vehicular = "SELECT *, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='3' and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					
$ejecutar_vehicular = mysql_query($consulta_vehicular, $conn);

$total_vehicular = mysql_num_rows($ejecutar_vehicular);

$num_reg = 8;

$num_pag = ceil($total_vehicular/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_vehicular = $consulta_vehicular." order by fechaescritura, numescritura2, numminuta asc LIMIT $ini, $num_reg";

$ejecutar_vehicular = mysql_query($consulta_vehicular, $conn);

$i=0;

while($vehicular = mysql_fetch_array($ejecutar_vehicular)){

	$arr_vehicular[$i][0] = $vehicular["fechaescritura"]; 
	$arr_vehicular[$i][1] = $vehicular["kardex"]; 
	$arr_vehicular[$i][2] = $vehicular["contrato"]; 
	$arr_vehicular[$i][3] = $vehicular["numescritura"]; 
	$arr_vehicular[$i][4] = $vehicular["numminuta"]; 
	$arr_vehicular[$i][5] = $vehicular["folioini"]; 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

	   echo "<tr>
              <td width='70' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Fecha Escr.</span></td>
              <td width='50' bgcolor='#CCCCCC'><span class='Estilo14'>Kardex</span></td>
              <td width='275' bgcolor='#CCCCCC'><span class='Estilo14'>Contratantes</span></td>
              <td width='171' bgcolor='#CCCCCC'><span class='Estilo14'>Acto</span></td>
              <td width='93' bgcolor='#CCCCCC'><span class='Estilo14'>Nº Acta</span></td>
              <td width='89' bgcolor='#CCCCCC'><span class='Estilo14'>Nº Folio</span></td>
            </tr>";

	for($j=0; $j<count($arr_vehicular); $j++) { 

	echo "<tr>
			<td valign='top'><span class='Estilo12'>".fechabd_an($arr_vehicular[$j][0])."</span></td>
			<td valign='top'><span class='Estilo12'>".$arr_vehicular[$j][1]."</span></td>
			<td valign='top'><span class='Estilo12'>"; 
			
			$id_kardex = $arr_vehicular[$j][1];
			$consulta_clientes = "SELECT
							  CONCAT(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat) as nombre,
							  kardex.idkardex,
							  contratantes.idcontratante,
							  cliente2.razonsocial as empresa
							  FROM
							  contratantes
							  INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
							  INNER JOIN kardex ON contratantes.kardex = kardex.kardex
							  WHERE
							  contratantes.kardex = '".$id_kardex."'";

		$ejecuta_clientes= mysql_query($consulta_clientes, $conn);
			while($rowcliente=mysql_fetch_array($ejecuta_clientes)){
			 echo $rowcliente['nombre'].$rowcliente['empresa']."</br>";
			}
			echo"</span></td>
			<td valign='top'><span class='Estilo12'>".$arr_vehicular[$j][2]."</span></td>
			<td valign='top'><span class='Estilo12'>".$arr_vehicular[$j][3]."</span></td>
			<td valign='top'><span class='Estilo12'>".$arr_vehicular[$j][5]."</span></td>
 	</tr>";
   }
   

	echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_vehicular(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_vehicular(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_vehicular(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_vehicular(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";


?>