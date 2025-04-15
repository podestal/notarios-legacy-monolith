<link rel="stylesheet" href="stylesglobal.css">

<?php 

include('conexion.php');

include('extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
 $desde = $_REQUEST['fechade'];
 $hasta = $_REQUEST['fechaa'];

$desdec = fechan_abd($desde);
$hastac = fechan_abd($hasta); 

$consulta_escritura = "SELECT DISTINCT impedidos.idimpedido AS 'id',impedidos.fechaing,
impedidos.origen AS 'entidad',impedidos.motivo AS 'motivo' FROM impedidos 
WHERE  STR_TO_DATE(impedidos.fechaing,'%d/%m/%Y') >= STR_TO_DATE('$desde','%d/%m/%Y') 
AND STR_TO_DATE(impedidos.fechaing,'%d/%m/%Y') <= STR_TO_DATE('$hasta','%d/%m/%Y')
";

$ejecutar_escritura = mysql_query($consulta_escritura, $conexion);

$total_escrituras = mysql_num_rows($ejecutar_escritura);

$num_reg = 8;

$num_pag = ceil($total_escrituras/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_escritura = $consulta_escritura." ORDER BY impedidos.idimpedido DESC LIMIT $ini, $num_reg";

$ejecutar_escritura = mysql_query($consulta_escritura, $conexion);

$i=0;

while($escrituras = mysql_fetch_array($ejecutar_escritura)){

	$arr_escrituras[$i][0] = $escrituras["id"]; 
	$arr_escrituras[$i][1] = $escrituras["fechaing"]; 
	$arr_escrituras[$i][2] = $escrituras["entidad"]; 
	$arr_escrituras[$i][3] = $escrituras["motivo"]; 
	$i++; 
	  
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

		echo "<tr>
              
              <td width='50' bgcolor='#CCCCCC' align='center' style='font-size:11px'><span class='Estilo14'>Nro </span></td>
              <td width='70' bgcolor='#CCCCCC' align='center' style='font-size:11px'><span class='Estilo14'>Fec Ingreso</span></td>
              <td width='200' bgcolor='#CCCCCC' align='center' style='font-size:11px'><span class='Estilo14'>Cliente</span></td>
           <td width='100' bgcolor='#CCCCCC' align='center' style='font-size:11px'><span class='Estilo14'>Entidad</span></td>
              <td width='180' bgcolor='#CCCCCC' align='center' style='font-size:11px'><span class='Estilo14'>Motivo</span></td> 
            </tr>";
			
	for($j=0; $j<count($arr_escrituras); $j++) { 


		$id_kardex = $arr_escrituras[$j][0];

		$consulta_clientes = "SELECT deta_impe.`idimpedido`,CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat,' ') AS   nombre,cliente.`razonsocial` AS empresa
FROM cliente
INNER JOIN deta_impe ON cliente.`idcliente` = `deta_impe`.`idcliente`
WHERE deta_impe.`idimpedido`= '".$id_kardex."'";

		$ejecuta_clientes= mysql_query($consulta_clientes, $conexion);

		echo "<tr>
				<td valign='top' align='center'><span class='Estilo12'>".($arr_escrituras[$j][0])."</span></td>
			    <td valign='top' align='center'><span class='Estilo12'>".$arr_escrituras[$j][1]."</span></td>
			    <td valign='top' cellpadding='0' cellspacing='0'>";
					
					while($clientes = mysql_fetch_array($ejecuta_clientes, MYSQL_ASSOC))
					{
						echo "<table><tr><td><span class='Estilo12'>".simbolos(strtoupper($clientes[nombre].$clientes[empresa]))."</span></td></tr></table>";	
						
					}

		echo   "</td>
				<td valign='top' align='center'><span class='Estilo12'>".strtoupper($arr_escrituras[$j][2])."</span></td>
			    <td valign='top' ><span class='Estilo12'>".strtoupper($arr_escrituras[$j][3])."</span></td>
			   
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