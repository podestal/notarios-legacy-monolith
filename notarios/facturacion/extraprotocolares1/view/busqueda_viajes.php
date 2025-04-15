 <link rel="stylesheet" href="stylesglobal.css">

<?php 

	require("funciones.php");
	
	$conexion = Conectar();
	
	$nro_control=$_REQUEST['nro_control'];
	$num_crono=$_REQUEST['num_crono'];
	$tip_permiso = $_REQUEST['tip_permiso'];
	$participante=$_REQUEST['participante'];
	$rango1=$_REQUEST['rango1'];
	$rango2=$_REQUEST['rango2'];
	$opcion=$_REQUEST['opcion'];
	
	$pag = $_REQUEST['pag'];
	
	$num_crono = formato_crono_abd($num_crono);
	
if($participante!=""){
		
		$sqlcontra="SELECT id_viaje, c_descontrat FROM viaje_contratantes WHERE c_descontrat LIKE '%$participante%' group by id_viaje";

		$ejecutar_contra = mysql_query($sqlcontra, $conexion);
		

		echo "<table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>";
		
			  echo "<tr height='35' style='background-color:#CCCCCC;'>
					<td width='30' align='center'><span class='titubuskar0'>Nro Control</span></td>
					<td width='60' align='center'><span class='titubuskar0'>Cronologico</span></td>
					<td width='236' align='center'><span class='titubuskar0' style='max-width:150px;'>Participantes</span></td>
					<td width='86' align='center'><span class='titubuskar0'>Fecha Crono.</span></td>
					<td width='150' align='center'><span class='titubuskar0'>Tip.Permiso</span></td>
					<td width='86' align='center'><span class='titubuskar0'>Fec. Ingreso</span></td>
					<td width='86' align='center'><span class='titubuskar0'>Descripcion</span></td>
				  </tr>";
					
		while($contratantes = mysql_fetch_array($ejecutar_contra)){
			
		$consulta_kardex = "SELECT
				permi_viaje.id_viaje as cod_viaje,
				permi_viaje.fec_ingreso as fec_ingreso,
				permi_viaje.fecha_crono as fec_crono,
				permi_viaje.num_kardex as kard,
				(CASE WHEN(permi_viaje.asunto=001) THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) as asunto,
				permi_viaje.lugar_formu as lugar
				FROM
				permi_viaje WHERE permi_viaje.id_viaje = '".$contratantes['id_viaje']."' group by permi_viaje.id_viaje ";
					
					$ejecutar_kardex = mysql_query($consulta_kardex, $conexion);
					
					while($kardex = mysql_fetch_array($ejecutar_kardex)){
					
					 echo "<tr>
        <td width='30' align='center'><span class='reskar'><span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick=ver_viajes('".$kardex['cod_viaje']."')>".$kardex['cod_viaje']."</span></td>
        <td width='60' align='center'><span class='reskar'>".formato_crono_agui($kardex['kard'])."</span></td>
        <td width='236' align='center'><span class='reskar' style='max-width:150px;'>"; 
		$sql = mysql_query("SELECT viaje_contratantes.id_viaje, viaje_contratantes.c_descontrat, c_condiciones.des_condicion FROM viaje_contratantes LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id_condicion
WHERE viaje_contratantes.id_viaje='".$kardex['cod_viaje']."'",$conexion) or die(mysql_error());

            while($rowe2 = mysql_fetch_array($sql)){
				 echo strtoupper ($rowe2['des_condicion']." : ".$rowe2['c_descontrat'])."</br>";
            }
		echo"</span></td>
        <td width='86' align='center'><span class='reskar'>".fechabd_an($kardex['fec_crono'])."</span></td>
        <td width='150' align='center'><span class='reskar'>".$kardex['asunto']."</span></td>
        <td width='86' align='center'><span class='reskar'>".fechabd_an($kardex['fec_ingreso'])."</span></td>
        <td width='86' align='center'><span class='reskar'>".strtoupper ($kardex['lugar'])."</span></td>
      </tr>";
					
					}
			}
			
				   
			echo	"</table>";		
		
			exit();
	


}else{
	
	if($rango1<>""){$rango1 = fechan_abd($rango1);}
	
	if($rango2<>""){$rango2 = fechan_abd($rango2);}
	
	$query =  "SELECT
				permi_viaje.id_viaje as cod_viaje,
				permi_viaje.fec_ingreso as fec_ingreso,
				permi_viaje.fecha_crono as fec_crono,
				permi_viaje.num_kardex as kard,
				(CASE WHEN(permi_viaje.asunto=001) THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) as asunto,
				permi_viaje.lugar_formu as lugar
				FROM
				permi_viaje";	
				
				
	if($nro_control <> "" and $num_crono <> ""){
		$query = $query." where permi_viaje.id_viaje like '%$nro_control%' or permi_viaje.num_kardex like '%$num_crono%'";
	}
	
	if($nro_control <> "" and $num_crono == ""){
		$query = $query." where permi_viaje.id_viaje like '%$nro_control%'";
	}

	if($nro_control == "" and $num_crono <> ""){
		$query = $query." where permi_viaje.num_kardex like '%$num_crono%'";	
	}
	
	if($nro_control == "" and $num_crono == ""){
		if($opcion==""){
			if($tip_permiso <> '' and $participante == ''){
				$query = $query." where permi_viaje.asunto = $tip_permiso";	
			} 
			if($tip_permiso == '' and $participante <> ''){
				$query = $query." where viaje_contratantes.c_descontrat like '%$participante%'";		
			}
			if($tip_permiso<> '' and $participante <> ''){
				$query = $query." where asunto_viaje.id_asunto = $tip_permiso and viaje_contratantes.c_descontrat like '%$participante%'";		
			}
		}
			   
		if($opcion==1 and $rango1<> "" and $rango2<> ""){
			if($tip_permiso== '' and $participante == ''){
				$query = $query." where STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";				

			}

			if($tip_permiso <> '' and $participante == ''){
				$query = $query." where asunto_viaje.id_asunto = $tip_permiso 
								  and STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";					
			} 

			if($tip_permiso == '' and $participante <> ''){
				$query = $query." where viaje_contratantes.c_descontrat like '%$participante%' 
								  and STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
			}
			
			if($tip_permiso<> '' and $participante <> ''){
				$query = $query." where asunto_viaje.id_asunto = $tip_permiso and viaje_contratantes.c_descontrat like '%$participante%'
								  and STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";						
			}  	
		}

		
		if($opcion==2 and $rango1<> "" and $rango2<> ""){
				
			if($tip_permiso== '' and $participante == ''){
				$query = $query." where STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";	 	
			}				

			if($tip_permiso <> '' and $participante == ''){
				$query = $query." where asunto_viaje.id_asunto = $tip_permiso 
								  and STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";	 			
			} 

			if($tip_permiso == '' and $participante <> ''){
				$query = $query." where viaje_contratantes.c_descontrat like '%$participante%' 
								  and STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";	 				
			}

			if($tip_permiso<> '' and $participante <> ''){
				$query = $query." where asunto_viaje.id_asunto = $tip_permiso and viaje_contratantes.c_descontrat like '%$participante%' 
								  and STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";	 					
			}
		}
	}

	  
	$query = $query." order by cast(permi_viaje.id_viaje as signed) desc"; 
	  
	 $ejecuta25 = mysql_query($query, $conexion);

	 $total_viajes = mysql_num_rows($ejecuta25);
	  
	 $num_reg = 8;
	 
	 $num_pag = ceil($total_viajes/$num_reg);
	  
	 $ini = 0;
    
     $ini = ($pag-1)*$num_reg;
	  
	 $ini_pag = floor(($pag-1)/7)*7 + 1;
	  
	 $query = $query." LIMIT $ini, $num_reg";

	 $ejecuta25 = mysql_query($query, $conexion);
	  
	 $i=0;
	  
	 while($viajes = mysql_fetch_array($ejecuta25, MYSQL_ASSOC))
	 {
		$arr_viajes[$i][0] = $viajes["cod_viaje"]; 
		$arr_viajes[$i][1] = $viajes["lugar"];
		$arr_viajes[$i][2] = $viajes["fec_ingreso"];
		$arr_viajes[$i][3] = $viajes["fec_crono"];
		$arr_viajes[$i][4] = $viajes["kard"];
		$arr_viajes[$i][5] = $viajes["asunto"];
		$i++; 
	}
	?>
	
	<table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>
    
	 <tr height='35' style='background-color:#CCCCCC;'>
        <td width='30' align='center'><span class='titubuskar0'>Nro Control</span></td>
        <td width='60' align='center'><span class='titubuskar0'>Cronologico</span></td>
        <td width='236' align='center'><span class='titubuskar0' style='max-width:150px;'>Participantes</span></td>
        <td width='86' align='center'><span class='titubuskar0'>Fecha Crono.</span></td>
        <td width='150' align='center'><span class='titubuskar0'>Tip.Permiso</span></td>
        <td width='86' align='center'><span class='titubuskar0'>Fec. Ingreso</span></td>
        <td width='86' align='center'><span class='titubuskar0'>Descripcion</span></td>
      </tr>
     
	  <?php
	  if(count($arr_viajes)>0){
	       
		 for($j=0; $j<count($arr_viajes); $j++) { 
		 ?>  
	          
		 <tr height='20'>
            <td height='20' width=10 align='center' ><span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick=ver_viajes('<?php echo $arr_viajes[$j][0]; ?>')><?php echo $arr_viajes[$j][0]; ?></span></td>
            <td height='20' width=20 align='center'><span class='reskar'><?php echo formato_crono_agui($arr_viajes[$j][4])?></span></td>
            <td height='20' width=30><span class='reskar'>
            <?php 
            $sql = mysql_query("SELECT viaje_contratantes.id_viaje, viaje_contratantes.c_descontrat, c_condiciones.des_condicion FROM viaje_contratantes LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id_condicion
WHERE viaje_contratantes.id_viaje='".$arr_viajes[$j][0]."'",$conexion) or die(mysql_error());

            while($rowe2 = mysql_fetch_array($sql)){
				 echo strtoupper ($rowe2['des_condicion']." : ".$rowe2['c_descontrat'])."</br>";
            }
			?>
             </span></td>
            <td height='20' width=12 align='center'><span class='reskar'><?php echo fechabd_an($arr_viajes[$j][3]);?></span></td>
            <td height='20' width=10 align='center'><span class='reskar'><?php echo $arr_viajes[$j][5];?></span></td>
            <td height='20' width=16 align='center'><span class='reskar'><?php echo fechabd_an($arr_viajes[$j][2]);?></span></td>
            <td height='20' width=6 align='center'><span class='reskar'><?php echo  strtoupper ($arr_viajes[$j][1]);?></span></td>
        </tr>
         
        <?php } ?>
		<tr height='25'>
            <td colspan='7' align='center' valign='bottom'>
                <table style='margin-bottom:4px'>
                   <tr class='paginacion'>
                    <?php if($pag>7){?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_viaje('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                    <?php } 
                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                        if($i <= $num_pag){ ?>
                        <td width='15'>
                            <?php	
                            if($i==$pag){ ?>
                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_viaje('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                            <?php	}else{ ?>
                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_viaje('<?php echo $i; ?>')"><?php echo $i; ?></div>
                            <?php } ?>
                        </td>
                        <?php }
                    }
                    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_viaje('<?php echo ($ini_pag+7); ?>')">--></div></td>
                    <?php
                    }
                    ?>	  
                    </tr>
                </table>
           </td>
		 </tr> 
         <?php }
	
		 ?>
         
         </table>
         

  <?php
	}
  ?>     
