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

$consulta_escritura = "SELECT *, UPPER(contrato), CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='1' and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";

$ejecutar_escritura = mysql_query($consulta_escritura, $conexion);

$total_escrituras = mysql_num_rows($ejecutar_escritura);

$num_reg = 8;

$num_pag = ceil($total_escrituras/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_escritura = $consulta_escritura." order by fechaescritura, numescritura2, numminuta asc LIMIT $ini, $num_reg";

$ejecutar_escritura = mysql_query($consulta_escritura, $conexion);

$i=0;

while($escrituras = mysql_fetch_array($ejecutar_escritura)){

	$arr_escrituras[$i][0] = $escrituras["fechaescritura"]; 
	$arr_escrituras[$i][1] = $escrituras["kardex"]; 
	$arr_escrituras[$i][2] = $escrituras["kardex"]; 
	$arr_escrituras[$i][3] = $escrituras["contrato"]; 
	$arr_escrituras[$i][4] = $escrituras["numescritura"]; 
	$arr_escrituras[$i][5] = $escrituras["numminuta"]; 
	$arr_escrituras[$i][6] = $escrituras["folioini"]; 
	$i++; 
	  
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

		echo "<tr>
              <td width='70' height='19' bgcolor='#CCCCCC'><span class='Estilo14'>Fecha Escr.</span></td>
              <td width='50' bgcolor='#CCCCCC'><span class='Estilo14'>Kardex</span></td>
              <td width='275' bgcolor='#CCCCCC'><span class='Estilo14'>Contratantes</span></td>
              <td width='171' bgcolor='#CCCCCC'><span class='Estilo14'>Acto</span></td>
              <td width='93' bgcolor='#CCCCCC'><span class='Estilo14'>Instrumento</span></td>
              <td width='86' bgcolor='#CCCCCC'><span class='Estilo14'>Nº Minuta</span></td>
              <td width='89' bgcolor='#CCCCCC'><span class='Estilo14'>Nº Folio</span></td>
            </tr>";

	for($j=0; $j<count($arr_escrituras); $j++) { 


		$id_kardex = $arr_escrituras[$j][1];

		$consulta_clientes = "SELECT
							  UPPER(CONCAT(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat)) as nombre,
							  kardex.idkardex,
							  contratantes.idcontratante,
							  UPPER(cliente2.razonsocial) as empresa
							  FROM
							  contratantes
							  INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
							  INNER JOIN kardex ON contratantes.kardex = kardex.kardex
							  WHERE
							  contratantes.kardex = '$id_kardex'";

		$ejecuta_clientes= mysql_query($consulta_clientes, $conexion);

		echo "<tr>
				<td valign='top'><span class='Estilo12'>".fechabd_an($arr_escrituras[$j][0])."</span></td>
			    <td valign='top'><span class='Estilo12'>".$arr_escrituras[$j][1]."</span></td>
			    <td valign='top' cellpadding='0' cellspacing='0'>";
					
					while($clientes = mysql_fetch_array($ejecuta_clientes, MYSQL_ASSOC))
					{
						echo "<table><tr><td><span class='Estilo12'>".simbolos(strtoupper($clientes[nombre].$clientes[empresa]))."</span></td></tr></table>";	
						
					}

		echo   "</td>
				<td valign='top'><span class='Estilo12'>".strtoupper($arr_escrituras[$j][3])."</span></td>
			    <td valign='top'><span class='Estilo12'>".$arr_escrituras[$j][4]."</span></td>
			    <td valign='top'><span class='Estilo12'>".$arr_escrituras[$j][5]."</span></td>
			    <td valign='top'><span class='Estilo12'>".$arr_escrituras[$j][6]."</span></td>
		 	  </tr>";


	}

	echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_escritura(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_escritura(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_escritura(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_escritura(".($ini_pag+7).")'>--></div></td>";
						    }
						  
							
						echo "</tr>
		  	        </table>
				</td>
		    </tr>
	</table>";


?>