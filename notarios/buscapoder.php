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

$consulta_poderes = "SELECT
					ingreso_poderes.id_poder  as id_poder,
					ingreso_poderes.num_kardex as kardex,
					poderes_asunto.des_asunto as tip_poder,
					ingreso_poderes.fec_crono as fec_crono,
					ingreso_poderes.referencia as referencia,
					ingreso_poderes.fec_ingreso as fec_ingreso,
					ingreso_poderes.swt_est as estado
					FROM ingreso_poderes 
					INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
					where STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
				    AND STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";

if($nocorre<>''){					
	$consulta_poderes = $consulta_poderes." AND ingreso_poderes.swt_est = 'NC'"; 					
}else{
    $consulta_poderes = $consulta_poderes." AND (ingreso_poderes.swt_est <> 'NC' or  ISNULL(ingreso_poderes.swt_est) )"; 					
}
					
$ejecutar_poderes = mysql_query($consulta_poderes, $conexion);

$total_poderes = mysql_num_rows($ejecutar_poderes);

$num_reg = 8;

$num_pag = ceil($total_poderes/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_poderes = $consulta_poderes." ORDER BY ingreso_poderes.id_poder DESC LIMIT $ini, $num_reg";

$ejecutar_poderes = mysql_query($consulta_poderes, $conn);

$i=0;

while($poderes = mysql_fetch_array($ejecutar_poderes)){

	$arr_poderes[$i][0] = $poderes["id_poder"]; 
	$arr_poderes[$i][1] = $poderes["kardex"]; 
	$arr_poderes[$i][2] = $poderes["tip_poder"]; 
	$arr_poderes[$i][3] = $poderes["fec_crono"]; 
	$arr_poderes[$i][4] = $poderes["referencia"]; 
	$arr_poderes[$i][5] = $poderes["fec_ingreso"]; 
	$arr_poderes[$i][6] = $poderes["estado"]; 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
		  <tr height='19' bgcolor='#CCCCCC'>
              <td width='30' align='center'><span class='Estilo14'>Nro.Control</span></td>
              <td width='86'  align='center'><span class='Estilo14'>Cronologico</span></td>
              <td width='150' align='center'><span class='Estilo14'>Tip. Poder</span></td>
              <td width='86' align='center'><span class='Estilo14'>Fec.Crono</span></td>
              <td width='150' align='center'><span class='Estilo14'>Referencia</span></td>
              <td width='86' align='center'><span class='Estilo14'>Fec.Ingreso</span></td>
              <td width='86' align='center'><span class='Estilo14'>Estado</span></td>
          </tr>";
			
	for($j=0; $j<count($arr_poderes); $j++) { 

	echo "<tr height='auto'>
			<td valign='top' align='center'><span class='Estilo12' width='65'>".$arr_poderes[$j][0]."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='70'>".formato_crono_agui($arr_poderes[$j][1])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='129'>".$arr_poderes[$j][2]."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='95'>".fechabd_an($arr_poderes[$j][3])."</span></td>";
			
	?>		
			
            <td valign='top' align='center'>
                <?php
                
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
                                     poderes_contratantes.id_poder =".$arr_poderes[$j][0];
                                     
                $exe_contratantes = mysql_query($sql_contratantes, $conn);
                
                $k=0;
				
				?>
				<span class='Estilo12' width='165'>
				<?php
                while($contratantes = mysql_fetch_array($exe_contratantes)){
                
                    $arr_contratantes[$k][0] = $contratantes["id"]; 
                    $arr_contratantes[$k][1] = $contratantes["prinom"]; 
                    $arr_contratantes[$k][2] = $contratantes["segnom"]; 
                    $arr_contratantes[$k][3] = $contratantes["apepat"]; 
                    $arr_contratantes[$k][4] = $contratantes["apemat"]; 
					echo "-".$arr_contratantes[$k][5] = $arr_contratantes[$k][3].' '.$arr_contratantes[$k][4].' '.$arr_contratantes[$k][1].' '.$arr_contratantes[$k][2]; 
					$k++; 
					echo "</br>";
                }
				
				
				?>
                </span>
            </td>
			
	<?php		
	
	
	echo    "<td valign='top' align='center'><span class='Estilo12' width='95'>".fechabd_an($arr_poderes[$j][5])."</span></td>
			<td valign='top' align='center'><span class='Estilo12' width='9'>".$arr_poderes[$j][6]."</span></td>
			</tr>";
   }
   
   echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_poderes(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_poderes(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_poderes(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
							
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_poderes(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";

?>




