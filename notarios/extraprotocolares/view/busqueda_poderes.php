 <link rel="stylesheet" href="stylesglobal.css">

<?php 

	require("funciones.php");
	
	$conexion = Conectar();
	
	$nro_control=$_REQUEST['nro_control'];
	$num_crono=$_REQUEST['num_crono'];
	$contratante=$_REQUEST['contratante'];
	$rango1=$_REQUEST['rango1'];
	$rango2=$_REQUEST['rango2'];
	$opcion=$_REQUEST['opcion'];
	$pag = $_REQUEST['pag'];
	
	$num_crono = formato_crono_abd($num_crono);

	if($rango1<>""){$rango1 = fechan_abd($rango1);}
	
	if($rango2<>""){$rango2 = fechan_abd($rango2);}
	
	$query   = "SELECT
				ingreso_poderes.id_poder as cod_poder,
				ingreso_poderes.num_kardex as kardex,
				ingreso_poderes.fec_ingreso as fec_ingreso,
				ingreso_poderes.fec_crono as fec_crono, 
				ingreso_poderes.referencia as participante,
				c_condiciones.des_condicion as condicion,
				poderes_asunto.des_asunto as asunto,
				poderes_contratantes.c_descontrat as contratante
				FROM ingreso_poderes 
				INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
				LEFT OUTER JOIN poderes_contratantes ON poderes_contratantes.id_poder=ingreso_poderes.id_poder
				LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = poderes_contratantes.c_condicontrat";
		
			if($nro_control <> "" and $num_crono <> ""){

				$query = $query." where ingreso_poderes.id_poder like '%$nro_control%' or ingreso_poderes.num_kardex like '%$num_crono%'";

			}

			if($nro_control <> "" and $num_crono == ""){
			    
			    $query = $query." where ingreso_poderes.id_poder like '%$nro_control%'";

			}

			if($nro_control == "" and $num_crono <> ""){
				
				$query = $query." where ingreso_poderes.num_kardex like '%$num_crono%'";

			}
		
		    if($nro_control == "" and $num_crono == ""){
				
				if($opcion==""){
						if($contratante == ''){
						   $query = $query;
						}
						if($contratante <> ''){
						   $query = $query." where poderes_contratantes.c_descontrat like '%$contratante%'";
						   
						}
				}
			    
				if($opcion==1 and $rango1<> "" and $rango2<> ""){
						if($contratante == ''){
							$query = $query." where STR_TO_DATE(ingreso_poderes.fec_ingreso,'%Y-%m-%d')  >= STR_TO_DATE('$rango1','%Y-%m-%d') 
											  and STR_TO_DATE(ingreso_poderes.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
							
						}
						if($contratante <> ''){
							$query = $query." where poderes_contratantes.c_descontrat like '%$contratante%' 
											  and STR_TO_DATE(ingreso_poderes.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
											  and STR_TO_DATE(ingreso_poderes.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
						}
				}

				if($opcion==2 and $rango1<> "" and $rango2<> ""){
						if($contratante == ''){
							$query = $query." where STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
											  and STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
						}
						if($contratante <> ''){
							$query = $query." where poderes_contratantes.c_descontrat like '%$contratante%' 
											  and STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
											  and STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
							
						}
				}

			}


	  $query = $query." GROUP BY ingreso_poderes.id_poder ORDER BY ingreso_poderes.id_poder DESC"; 
	  
	  $ejecuta25 = mysql_query($query, $conexion);

	  $total_poderes = mysql_num_rows($ejecuta25);
	  
	  $num_reg = 10;
	  
	  $num_pag = ceil($total_poderes/$num_reg);
	  
	  $ini = 0;
    
      $ini = ($pag-1)*$num_reg;
	  
	  $ini_pag = floor(($pag-1)/7)*7 + 1;

      $query = $query."  LIMIT $ini, $num_reg";
	  
	  //echo $query;
	  
	  $ejecuta25 = mysql_query($query, $conexion);
	  
	  $i=0;
	  
	  while($poderes = mysql_fetch_array($ejecuta25, MYSQL_ASSOC)){
			$arr_poderes[$i][0] = $poderes["cod_poder"]; 
			$arr_poderes[$i][1] = $poderes["contratante"];
			$arr_poderes[$i][2] = $poderes["condicion"];
			$arr_poderes[$i][3] = $poderes["fec_ingreso"];
			$arr_poderes[$i][4] = $poderes["fec_crono"];
			$arr_poderes[$i][5] = $poderes["kardex"];
			$arr_poderes[$i][6] = $poderes["asunto"];
			$i++; 
	 }

	  //var_dump($arr_poderes);
	  
	  ?>
	

	  <table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>
    
      	<tr height='35' style='background-color:#CCCCCC;'>
            <td width='100' align='center'><span class='titubuskar0'>Nro.Control</span></td>
            <td width='100' align='center'><span class='titubuskar0'>Cronologico</span></td>
            <td width='200' align='center'><span class='titubuskar0'>Tip. Poder</span></td>
            <td width='100' align='center'><span class='titubuskar0'>Fec.Crono</span></td>
            <td width='240' align='center'><span class='titubuskar0'>Contratante</span></td>
            <td width='100' align='center'><span class='titubuskar0'>Fec.Ingreso</span></td>
        </tr>
            
      	<?php      
	  
	  	if(count($arr_poderes)>0){
	       
		for($j=0; $j<count($arr_poderes); $j++) { 
	  
	  	?>        

        <tr height='20'>
            <td height='20' width=10 align='center' ><span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick="ver_poderes('<?php echo $arr_poderes[$j][0]?>')"><?php echo $arr_poderes[$j][0]; ?></span></td>
            <td height='20' align='center'><span class='reskar'><?php echo formato_crono_agui($arr_poderes[$j][5]);?></span></td>
            <td height='20' align='center'><span class='reskar'><?php echo $arr_poderes[$j][6]; ?></span></td>
            <td height='20' align='center'><span class='reskar'><?php echo fechabd_an($arr_poderes[$j][4]); ?></span></td>
            <td height='20' align='center'>
            	<span class='reskar'>
				<?php 
				$sql_contratantes =     "SELECT
										c_condiciones.des_condicion AS condicion,
										poderes_contratantes.c_descontrat AS contratante,
										poderes_contratantes.id_poder
										FROM
										poderes_contratantes
										Left Outer Join c_condiciones ON c_condiciones.id_condicion = poderes_contratantes.c_condicontrat
										WHERE
										poderes_contratantes.id_poder =  '".$arr_poderes[$j][0]."'";
										
				$exe_contratantes = mysql_query($sql_contratantes, $conexion);
				
				while($contratantes = mysql_fetch_array($exe_contratantes, MYSQL_ASSOC)){echo $contratantes["contratante"];  echo "</br>";}
				
				?>
                </span>
            </td>
            <td height='20' align='center'><span class='reskar'><?php echo fechabd_an($arr_poderes[$j][3]); ?></span></td>
        </tr>
        
        <?php } ?>
        
        <tr height='25'>
            <td colspan='7' align='center' valign='bottom'>
                <table style='margin-bottom:4px'>
                   <tr class='paginacion'>
                    <?php if($pag>7){?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_poderes('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                    <?php } 
                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                        if($i <= $num_pag){ ?>
                        <td width='15'>
                            <?php	
                            if($i==$pag){ ?>
                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_poderes('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                            <?php	}else{ ?>
                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_poderes('<?php echo $i; ?>')"><?php echo $i; ?></div>
                            <?php } ?>
                        </td>
                        <?php }
                    }
                    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_poderes('<?php echo ($ini_pag+7); ?>')">--></div></td>
                    <?php
                    } 
                    ?>	  
                    </tr>
                </table>
           </td>
		 </tr> 
		
		<?php } ?>
	      
	 </table>
      
       
