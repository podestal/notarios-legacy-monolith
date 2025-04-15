 <link rel="stylesheet" href="stylesglobal.css">

<?php 

	require("funciones.php");
	
	$conexion = Conectar();
	
	$num_crono=$_REQUEST['num_crono'];
	$nombre=$_REQUEST['solicitante'];
	$rango1=$_REQUEST['rango1'];
	$rango2=$_REQUEST['rango2'];
	$opcion=$_REQUEST['opcion'];
	$pag = $_REQUEST['pag'];
	
	$num_crono = formato_crono_abd($num_crono);

	if($rango1<>""){
		$rango1 = fechan_abd($rango1); 
	}
	
	if($rango2<>""){
		$rango2 = fechan_abd($rango2);
	}
	
	//echo "</BR>";

	$query  =  "SELECT 
				cert_domiciliario.id_domiciliario,
				cert_domiciliario.num_certificado,
				cert_domiciliario.fec_ingreso,
		        cert_domiciliario.nombre_solic,
		        cert_domiciliario.domic_solic,
				cert_domiciliario.motivo_solic
		        FROM 
		        cert_domiciliario 
		        WHERE 
		        cert_domiciliario.id_domiciliario <> '' ";
	


	    	if($num_crono <>""){

	    		$query = $query." and cert_domiciliario.num_certificado like '%$num_crono%'";

	    	}

		    if($num_crono == ""){
				
				if($nombre== ''){
					if($rango1== "" or $rango2== ""){	
						$query = $query;	
					}
					if($rango1<> "" and $rango2<> ""){	
						$query = 
						$query." and STR_TO_DATE(cert_domiciliario.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
						         and STR_TO_DATE(cert_domiciliario.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
					}	

				}

				if($nombre<> ''){
					if($rango1== "" or $rango2== ""){	
						$query = $query."and cert_domiciliario.nombre_solic like '%$nombre%'";	
					}
					if($rango1<> "" and $rango2<> ""){	
						$query = $query." and cert_domiciliario.nombre_solic like '%$nombre%' 
						                  and STR_TO_DATE(cert_domiciliario.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
						                  and STR_TO_DATE(cert_domiciliario.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";	
					}	

				}
					
			}
	  
	  $query = $query." ORDER BY cert_domiciliario.id_domiciliario DESC";
	 
	  $ejecuta = mysql_query($query, $conexion);

	  $total_domiciliarios = mysql_num_rows($ejecuta);
	  
      $num_reg = 10;
	  
	  $num_pag = ceil($total_domiciliarios/$num_reg);
	  
	  $ini = 0;
	  
	  $ini = ($pag-1)*$num_reg;
	  
	  $ini_pag = floor(($pag-1)/7)*7 + 1;
						   
	  $query = $query." LIMIT $ini, $num_reg";
	  
	  //echo $query;
	  
	  $ejecuta = mysql_query($query, $conexion);
	  
	  $i=0;
	  
	  while($domiciliarios = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
	  {
		$arr_domiciliarios[$i][0] = $domiciliarios["id_domiciliario"]; 
		$arr_domiciliarios[$i][1] = $domiciliarios["num_certificado"];
		$arr_domiciliarios[$i][2] = $domiciliarios["fec_ingreso"];
		$arr_domiciliarios[$i][3] = strtoupper($domiciliarios["domic_solic"]);
		$arr_domiciliarios[$i][4] = strtoupper($domiciliarios["nombre_solic"]);
		$arr_domiciliarios[$i][5] = strtoupper($domiciliarios["motivo_solic"]);
		$i++; 
	  }
	  ?>		
		
	  <table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>
    
	  	   <tr height='25' bgcolor='#CCCCCC'>
              <td width='30' align='center'><span class='titubuskar0'>Nro. Certificado</span></td>
              <td width='30' align='center'><span class='titubuskar0'>Fecha Ingreso</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Solicitante</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Motivo</span></td>
			  <td width='100' align='center'><span class='titubuskar0'>Direccion</span></td>
            </tr>
	  
      <?php
	  if(count($arr_domiciliarios)>0){
	       
		  for($j=0; $j<count($arr_domiciliarios); $j++) { ?>
	          
			<tr height='20'>
	            <td  height='20' width=63 align='center'>
	            <span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick="ver_domiciliarios(<?php echo $arr_domiciliarios[$j][0]; ?>)"><?php echo formato_crono_agui($arr_domiciliarios[$j][1]); ?></span>
	            </td>
	            <td height='20' width=86 align='center'><span class='reskar'><?php echo fechabd_an($arr_domiciliarios[$j][2]); ?></span></td>
	            <td height='20' width=86 align='center'><span class='reskar'><?php echo $arr_domiciliarios[$j][4]; ?></span></td>
				<td height='20' width=100 align='center'><span class='reskar'><?php echo $arr_domiciliarios[$j][5]; ?></span></td>
				<td height='20' width=100 align='center'><span class='reskar'><?php echo $arr_domiciliarios[$j][3]; ?></span></td>
			</tr>
		  
		  
	 <?php } ?>
     
             <tr height='25'>
                    <td colspan='7' align='center' valign='bottom'>
                        <table style='margin-bottom:4px'>
                           <tr class='paginacion'>
                            <?php if($pag>7){?>
                                <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_domiciliarios('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                            <?php } 
                            for($i=$ini_pag; $i<$ini_pag+7; $i++){
                                if($i <= $num_pag){ ?>
                                <td width='15'>
                                    <?php	
                                    if($i==$pag){ ?>
                                    <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_domiciliarios('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                                    <?php	}else{ ?>
                                    <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_domiciliarios('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                    <?php } ?>
                                </td>
                                <?php }
                            }
                            if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_domiciliarios('<?php echo ($ini_pag+7); ?>')">--></div></td>
                            <?php
                            }
                            ?>	  
                            </tr>
                        </table>
                   </td>
            </tr>
    
     <?php } ?>	 
     
     </table>
	 
	 
	  
	 
    
	 
	  
	
      
       






