 <link rel="stylesheet" href="stylesglobal.css">

<?php 

	require("funciones.php");
	
	$conexion = Conectar();
	
	//$num_crono=$_REQUEST['num_crono'];
	//$nombre=$_REQUEST['solicitante'];
	$rango1=$_REQUEST['rango1'];
	$rango2=$_REQUEST['rango2'];
	//$opcion=$_REQUEST['opcion'];
	$pag = $_REQUEST['pag'];
	
	//$num_crono = formato_crono_abd($num_crono);

	if($rango1<>""){
		$rango1 = fechan_abd($rango1); 
	}
	
	if($rango2<>""){
		$rango2 = fechan_abd($rango2);
	}
	
	$between="";
	 	if($rango1!='' AND $rango2!='')
	 	{
	 		$between=" WHERE (fechaIngreso  BETWEEN '".$rango1."' AND '".$rango2."')  ";
	 	}
	 $query  =  "SELECT 
				fechaingreso,
				direccionCertificado,
				idLegalizacion,
				fncClienteLegalizacion(l.`idLegalizacion`)as cliente
		        FROM 
		        legalizacion as l
		         ".$between." ";
	  
	  $query = $query." ORDER BY l.idLegalizacion  DESC ";
	 
	  $ejecuta = mysql_query($query, $conexion);

	  $total_domiciliarios = mysql_num_rows($ejecuta);
	  
      $num_reg = 10;
	  
	  $num_pag = ceil($total_domiciliarios/$num_reg);
	  
	  $ini = 0;
	  
	  $ini = ($pag-1)*$num_reg;
	  
	  $ini_pag = floor(($pag-1)/7)*7 + 1;
						   
	  $query = $query." LIMIT $ini, $num_reg";
	  
	  //echo $query;
	  
	  $ejecuta = mysql_query($query, $conexion) or die(mysql_error());
	  
	  $i=0;
	  
	  while($domiciliarios = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
	  {
		$arr_domiciliarios[$i][0] = $domiciliarios["fechaingreso"]; 
		$arr_domiciliarios[$i][1] = $domiciliarios["direccionCertificado"];
		$arr_domiciliarios[$i][2] = $domiciliarios["idLegalizacion"];
		$arr_domiciliarios[$i][3] = $domiciliarios["cliente"];
		$i++; 
	  }
	  ?>		
		
	  <table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>
    
	  	   <tr height='25' bgcolor='#CCCCCC'>
	  	   	  <td width='5' align='center'><span class='titubuskar0'>Nro. Legalización</span></td>
              <td width='30' align='center'><span class='titubuskar0'>Fecha de Ingreso</span></td>
              <td width='30' align='center'><span class='titubuskar0'>Cliente</span></td>
			  
			  
            </tr>
	  
      <?php
	  if(count($arr_domiciliarios)>0){
	       
		  for($j=0; $j<count($arr_domiciliarios); $j++) { ?>
	          
			<tr height='20'>
				<td height='10' width="5" align='center'>
					  <span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick="verLegalizaciones(<?php echo $arr_domiciliarios[$j][2]; ?>)"><?php echo ($arr_domiciliarios[$j][2]); ?></span>
</td>
	            <td  height='20' width=63 align='center'>
	            <span class='reskar' title='Ver' > <?php echo ($arr_domiciliarios[$j][0]); ?></span>
	            </td>
	            <td height='20' width=86 align='center'><span class='reskar'><?php echo ($arr_domiciliarios[$j][3]); ?></span></td>

			</tr>
		  
		  
	 <?php } ?>
     
             <tr height='25'>
                    <td colspan='8' align='center' valign='bottom'>
                        <table style='margin-bottom:4px'>
                           <tr class='paginacion'>
                            <?php if($pag>7){?>
                                <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscarLegalizacion('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                            <?php } 
                            for($i=$ini_pag; $i<$ini_pag+7; $i++){
                                if($i <= $num_pag){ ?>
                                <td width='15'>
                                    <?php	
                                    if($i==$pag){ ?>
                                    <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscarLegalizacion('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                                    <?php	}else{ ?>
                                    <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscarLegalizacion('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                    <?php } ?>
                                </td>
                                <?php }
                            }
                            if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscarLegalizacion('<?php echo ($ini_pag+7); ?>')">--></div></td>
                            <?php
                            }
                            ?>	  
                            </tr>
                        </table>
                   </td>
            </tr>
    
     <?php } ?>	 
     
     </table>
	 
	 
	  
	 
    
	 
	  
	
      
       






