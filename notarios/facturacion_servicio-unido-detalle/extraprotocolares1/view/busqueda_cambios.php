 <link rel="stylesheet" href="stylesglobal.css">

<?php 

  require("funciones.php");
  
  $conexion = Conectar();
  
  $num_crono=$_REQUEST['num_crono'];
  $solicitante=$_REQUEST['solicitante'];
  $rango1=$_REQUEST['rango1'];
  $rango2=$_REQUEST['rango2'];
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
        	  ccaracter_solicitantes.descri_solicitante as solicitante,
			  ccaracter_solicitantes.id_cambio,
			  cambio_caracter.num_crono as num_crono,
			  cambio_caracter.fec_ingreso as fec_ingreso,
			  cambio_caracter.num_formu as num_formu,
			  cambio_caracter.nombre,
			  cambio_caracter.id_cambio as cod_cambio
			  FROM cambio_caracter  
			  left outer join ccaracter_solicitantes ON ccaracter_solicitantes.id_cambio = cambio_caracter.id_cambio
			  WHERE cambio_caracter.id_cambio <> '' ";


        if($num_crono <>""){

          $query = $query." and cambio_caracter.num_crono like '%$num_crono%'";

        }

        if($num_crono == ""){
        
        if($solicitante== ''){
          if($rango1== "" or $rango2== ""){ 
            $query = $query;  
          }
          if($rango1<> "" and $rango2<> ""){  
            $query = 
            $query." and STR_TO_DATE(cambio_caracter.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
                     and STR_TO_DATE(cambio_caracter.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
          } 

        }

        if($solicitante<> ''){
          if($rango1== "" or $rango2== ""){ 
            $query = $query."and ccaracter_solicitantes.descri_solicitante like '%$solicitante%'";  
          }
          if($rango1<> "" and $rango2<> ""){  
            $query = $query." and ccaracter_solicitantes.descri_solicitante like '$solicitante%' 
                              and STR_TO_DATE(cambio_caracter.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
                              and STR_TO_DATE(cambio_caracter.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";  
          } 

        }
          
      }
	  
	
	
	$query = $query." GROUP BY cambio_caracter.id_cambio ORDER BY cambio_caracter.id_cambio DESC";
	 
	$ejecuta = mysql_query($query, $conexion);

	$total_caracteristicas = mysql_num_rows($ejecuta);
	  
    $num_reg = 10;
	  
	$num_pag = ceil($total_caracteristicas/$num_reg);
	  
	$ini = 0;
	  
	$ini = ($pag-1)*$num_reg;
	  
	$ini_pag = floor(($pag-1)/7)*7 + 1;
						   
	$query = $query." LIMIT $ini, $num_reg";  
	 
    //echo $query;
    
    $ejecuta = mysql_query($query, $conexion);
    
    $i=0;
    
    while($caracteristicas = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
    {
    $arr_caracteristicas[$i][0] = $caracteristicas["cod_cambio"]; 
    $arr_caracteristicas[$i][1] = $caracteristicas["num_crono"];
    $arr_caracteristicas[$i][2] = $caracteristicas["fec_ingreso"];
    $arr_caracteristicas[$i][3] = $caracteristicas["num_formu"];
    $arr_caracteristicas[$i][4] = $caracteristicas["solicitante"];
    $i++; 
    }
	
	?>
  

	<table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>
    	
        <tr height='25' bgcolor='#CCCCCC'>
          <td width='63' align='center'><span class='titubuskar0'>N° Cronologico</span></td>
          <td width='86' align='center'><span class='titubuskar0'>Fecha Ingreso</span></td>
          <td width='70' align='center'><span class='titubuskar0'>N.Formulario</span></td>
          <td width='200' align='center'><span class='titubuskar0'>Solicitante</span></td>
        </tr>
        
    <?php
    if(count($arr_caracteristicas)>0){
         
      for($j=0; $j<count($arr_caracteristicas); $j++) { 
	  
	?>  
            
	    <tr height='20'>
            <td  height='20' width=63 align='center'>
              <span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick="ver_caracteristicas('<?php echo $arr_caracteristicas[$j][1]; ?>')"><?php echo formato_crono_agui($arr_caracteristicas[$j][1]); ?></span>
            </td>
            <td height='20' width=86 align='center'><span class='reskar'><?php echo fechabd_an($arr_caracteristicas[$j][2]); ?></span></td>
            <td height='20' width=86 align='center'><span class='reskar'><?php echo $arr_caracteristicas[$j][3]; ?></span></td>
        	<td height='20' width=100 align='center'><span class='reskar'><?php echo $arr_caracteristicas[$j][4]; ?></span></td>
         </tr>
        
     <?php } ?>
     
     <tr height='25'>
            <td colspan='7' align='center' valign='bottom'>
                <table style='margin-bottom:4px'>
                   <tr class='paginacion'>
                    <?php if($pag>7){?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_caracteristicas('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                    <?php } 
                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                        if($i <= $num_pag){ ?>
                        <td width='15'>
                            <?php	
                            if($i==$pag){ ?>
                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_caracteristicas('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                            <?php	}else{ ?>
                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_caracteristicas('<?php echo $i; ?>')"><?php echo $i; ?></div>
                            <?php } ?>
                        </td>
                        <?php }
                    }
                    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_caracteristicas('<?php echo ($ini_pag+7); ?>')">--></div></td>
                    <?php
                    }
                    ?>	  
                    </tr>
                </table>
           </td>
	</tr>
     
      <?php } ?>   
        
    
    
    
     