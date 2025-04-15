 <link rel="stylesheet" href="stylesglobal.css">

<?php 

	require("conexion.php");
	require("funciones.php");
	
	
	$conexion = Conectar();
	
	$num_crono=$_REQUEST['num_crono'];
	$nombre=$_REQUEST['nombre'];
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

	$query   = "SELECT
				cert_supervivencia.id_supervivencia,
				cert_supervivencia.num_crono,
				cert_supervivencia.nombre,
				cert_supervivencia.direccion,
				cert_supervivencia.swt_capacidad,
				cert_supervivencia.fecha,
				cert_supervivencia.observaciones
				FROM cert_supervivencia
				WHERE
		    	cert_supervivencia.swt_capacidad = 'C'";
	

	    	if($num_crono <>""){

	    		$query = $query." and cert_supervivencia.num_crono like '%$num_crono%'";

	    	}

		    if($num_crono == ""){
				
				if($nombre== ''){
					if($rango1== "" or $rango2== ""){	
						$query = $query;	
					}
					if($rango1<> "" and $rango2<> ""){	
						$query = 
						$query." and STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
						         and STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
					}	

				}

				if($nombre<> ''){
					if($rango1== "" or $rango2== ""){	
						$query = $query."and cert_supervivencia.nombre like '%$nombre%'";	
					}
					if($rango1<> "" and $rango2<> ""){	
						$query = $query." and cert_supervivencia.nombre like '%$nombre%' 
						                  and STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
						                  and STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";	
					}	

				}
					
			}
	 
	  $query = $query." ORDER BY cert_supervivencia.id_supervivencia DESC";
	 
	  $ejecuta = mysql_query($query, $conexion);

	  $total_capaces = mysql_num_rows($ejecuta);
	  
      $num_reg = 10;
	  
	  $num_pag = ceil($total_capaces/$num_reg);
	  
	  $ini = 0;
	  
	  $ini = ($pag-1)*$num_reg;
	  
	  $ini_pag = floor(($pag-1)/7)*7 + 1;
						   
	  $query = $query." LIMIT $ini, $num_reg";
	  
	  //echo $query;
	  
	  $ejecuta = mysql_query($query, $conexion);
	  
	  $i=0;
	  
	  while($capaces = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
	  {
		$arr_capaces[$i][0] = $capaces["id_supervivencia"]; 
		$arr_capaces[$i][1] = $capaces["num_crono"];
		$arr_capaces[$i][2] = strtoupper($capaces["nombre"]);
		$arr_capaces[$i][3] = $capaces["fecha"];
		$arr_capaces[$i][4] = strtoupper($capaces["direccion"]);
		$arr_capaces[$i][5] = $capaces["swt_capacidad"];
		$arr_capaces[$i][6] = $capaces["observaciones"];
		$i++; 
	  }
	
	 ?>
     
     <table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>
    		<tr height='35' style='background-color:#CCCCCC;'>
              <td width='63' align='center'><span class='titubuskar0'>Cronologico</span></td>
              <td width='86' align='center'><span class='titubuskar0'>Fecha</span></td>
              <td width='150' align='center'><span class='titubuskar0'>Nombre</span></td>
              <td width='172' align='center'><span class='titubuskar0'>Direccion</span></td>
              <!--<td width='86' align='center'><span class='titubuskar0'>Tipo persona</span></td>-->
            </tr>
	  
	  <?php
	  if(count($arr_capaces)>0){
	       
		  for($j=0; $j<count($arr_capaces); $j++) { 	
		  ?>
	          
		  <tr height='20'>
	            <td height='20' width=10 align='center'>
	            <span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick="ver_capaces('<?php echo $arr_capaces[$j][0]; ?>')"><?php echo formato_crono_agui($arr_capaces[$j][1]); ?></span>
	            </td>
	            <td height='20' width=20 align='center'><span class='reskar'><?php echo fechabd_an($arr_capaces[$j][3]);?></span></td>
	            <td height='20' width=30 align='center'><span class='reskar'><?php echo strtoupper ($arr_capaces[$j][2]);?></span></td>
				<td height='20' width=30 align='center'><span class='reskar'><?php echo simbolos(strtoupper ($arr_capaces[$j][4]));?></span></td>
				<!--<td height='20' width=30 align='center'><span class='reskar'><?php echo strtoupper($arr_capaces[$j][6]);?></span></td>-->
				</tr>
		  
	<?php } ?>
    
    <tr height='25'>
            <td colspan='7' align='center' valign='bottom'>
                <table style='margin-bottom:4px'>
                   <tr class='paginacion'>
                    <?php if($pag>7){?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_capaces('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                    <?php } 
                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                        if($i <= $num_pag){ ?>
                        <td width='15'>
                            <?php	
                            if($i==$pag){ ?>
                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_capaces('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                            <?php	}else{ ?>
                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_capaces('<?php echo $i; ?>')"><?php echo $i; ?></div>
                            <?php } ?>
                        </td>
                        <?php }
                    }
                    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_capaces('<?php echo ($ini_pag+7); ?>')">--></div></td>
                    <?php
                    }
                    ?>	  
                    </tr>
                </table>
           </td>
	</tr>
    
    <?php } ?>
	  
	</table>
    
	 
	  
   
      
       
