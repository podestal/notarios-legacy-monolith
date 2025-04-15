<link rel="stylesheet" href="stylesglobal.css">

<?php 
	
	require("funciones.php");
	
	$conexion = Conectar();
	
	$par = $_REQUEST['par'];
	$id_carta=$_REQUEST['id_carta'];
	$num_carta=$_REQUEST['num_carta'];
	$destinatario=$_REQUEST['destinatario'];
	$remitente=$_REQUEST['remitente'];
	$rango1=$_REQUEST['rango1'];
	$rango2=$_REQUEST['rango2'];
	$opcion=$_REQUEST['opcion'];
	$pag = $_REQUEST['pag'];
	$num_carta = formato_crono_abd($num_carta);

	$query   = "SELECT  
						l.id as cod_legalizacion,
						l.num_firma as num_firma, 
						l.fec_ingreso as fec_ingreso,
						l.id_parte as id_parte,
						l.nombre as nombre
				FROM legalizaciones as l";
	
			if($num_carta <> "" ){

				$query = $query." where l.num_firma  like '%$num_carta%'";

			}

		    if($num_carta == "" ){
				
				if($opcion==""){
				
					if($remitente == '' and $destinatario == ''){
					   $query = $query;
					}

					if($remitente <> '' and $destinatario == ''){
					   $query = $query." where ingreso_cartas.nom_remitente like '%$remitente%'";
					}

					if($remitente == '' and $destinatario <> ''){
					   $query = $query." where ingreso_cartas.nom_destinatario like '%$destinatario%'";
					}

					if($remitente <> '' and $destinatario <> ''){
					   $query = $query." where ingreso_cartas.nom_remitente like '%$remitente%' and ingreso_cartas.nom_destinatario like '%$destinatario%'";
					}


				}
			    
				if($opcion==1 and $rango1<> "" and $rango2<> ""){

					if($remitente == '' and $destinatario == ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y')";
					}

					if($remitente <> '' and $destinatario == ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y') and ingreso_cartas.nom_remitente like '%$remitente%'";
					}

					if($remitente == '' and $destinatario <> ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_ingreso),'%d/%m/%Y' >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y') and ingreso_cartas.nom_destinatario like '%$destinatario%'";
					}

					if($remitente <> '' and $destinatario <> ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_ingreso,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y') and ingreso_cartas.nom_remitente like '%$remitente%' and ingreso_cartas.nom_destinatario like '%$destinatario%'";
					}

				
				}

				if($opcion==2 and $rango1<> "" and $rango2<> ""){

					if($remitente == '' and $destinatario == ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y')";
					}

					if($remitente <> '' and $destinatario == ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y') and ingreso_cartas.nom_remitente like '%$remitente%'";
					}

					if($remitente == '' and $destinatario <> ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y') and ingreso_cartas.nom_destinatario like '%$destinatario%'";
					}

					if($remitente <> '' and $destinatario <> ''){
					   $query = $query." where STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') >= STR_TO_DATE('$rango1','%d/%m/%Y') and STR_TO_DATE(ingreso_cartas.fec_entrega,'%d/%m/%Y') <= STR_TO_DATE('$rango2','%d/%m/%Y') and ingreso_cartas.nom_remitente like '%$remitente%' and ingreso_cartas.nom_destinatario like '%$destinatario%'";
					}
				}
	        }

	  $query = $query." GROUP BY l.id ORDER BY l.id DESC"; 
	  $ejecuta25 = mysql_query($query, $conexion);
	  
	  $total_cartas = mysql_num_rows($ejecuta25);
	  
	  
	  $num_reg = 10;
	 
	  
	  $num_pag = ceil($total_cartas/$num_reg);
	  
	  $ini = 0;
    
      $ini = ($pag-1)*$num_reg;
	  
	  $ini_pag = floor(($pag-1)/7)*7 + 1;
	  
	  $query = $query." LIMIT $ini, $num_reg";
	  
	  //echo $query;
	  
	  $ejecuta = mysql_query($query, $conexion);
	  
	  $i=0;
	  
	  while($cartas = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
	  {
		$arr_cartas[$i][0] = $cartas["cod_legalizacion"]; 
		$arr_cartas[$i][1] = $cartas["num_firma"]; 
		$arr_cartas[$i][2] = $cartas["fec_ingreso"]; 
		$arr_cartas[$i][4] = strtoupper($cartas["nombre"]); 
		$i++; 
	  }
	  
	  ?>
	  <table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
            <tr>
              <td colspan='5'>
              <table width='858' cellpadding='0' cellspacing='0' bordercolor='#333333' bgcolor='#CCCCCC'>
                <tr>
                  <td width='63' align='center'><span class='titubuskar0'>N° Firma</span></td>
                  <td width='86' align='center'><span class='titubuskar0'>Fecha Ingreso</span></td>
                  <td width='200' align='center'><span class='titubuskar0'>Parte</span></td>
                  <td width='200' align='center'><span class='titubuskar0'>Contraparte</span></td>
                </tr>
              </table>
              </td>
            </tr>

		<?php 
		if(count($arr_cartas)>0){
	       
		for($j=0; $j<count($arr_cartas); $j++) {       
		?>

		<tr height='20'>
			<td width='63' align='center' >
			    	<span class='reskar'title='Ver' style='color:#06C; cursor:pointer' onclick="ver_legalizaciones('<?php echo $arr_cartas[$j][1]; ?>')"><?php echo formato_crono_agui($arr_cartas[$j][1]); ?></span>
			</td>
			<td width='86' align='center' ><span class='reskar'><?php echo $arr_cartas[$j][2]; ?></span></td>
			<td width='224' align='center'><span class='reskar'><?php echo simbolos($arr_cartas[$j][4]); ?></span></td>
			<td width='86' align='center' ><span class='reskar'><?php echo $arr_cartas[$j][3]; ?></span></td>
		</tr>
        <?php } ?>     
         
		<tr height='25'>
            <td colspan='7' align='center' valign='bottom'>
                <table style='margin-bottom:4px'>
                   <tr class='paginacion'>
                    <?php if($pag>7){?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_cartas('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                    <?php } 
                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                        if($i <= $num_pag){ ?>
                        <td width='15'>
                            <?php	
                            if($i==$pag){ ?>
                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_cartas('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                            <?php	}else{ ?>
                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_cartas('<?php echo $i; ?>')"><?php echo $i; ?></div>
                            <?php } ?>
                        </td>
                        <?php }
                    }
                    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_cartas('<?php echo ($ini_pag+7); ?>')">--></div></td>
                    <?php
                    }
                    ?>	  
                    </tr>
                </table>
           </td>
		 </tr> 
         
         <?php } ?>     
        </table>
