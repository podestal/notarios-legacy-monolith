<link rel="stylesheet" href="stylesglobal.css">

<?php 

	include('extraprotocolares/view/funciones.php');
	
	$conexion = Conectar();
	
	$num_acta = $_REQUEST['num_acta'];
	$participante = $_REQUEST['participante'];
	$nro_protesto = $_REQUEST['nro_protesto'];
	
	$fechade = $_REQUEST['fechade'];
	$fechaa = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 
	
	$fec_ing = $_REQUEST['fec_ing'];
	$fec_cons = $_REQUEST['fec_cons'];
	$fec_not = $_REQUEST['fec_not'];
	//$dateinicial = strtotime($fec_ing);

$dato = explode("/", $fec_ing); 

$anio=$dato[2];




//$anio=date ('Y',$dateinicial);
	
	$pag = $_REQUEST['pag'];

	$consulta_protesto = "SELECT 
						  protesto.id_protesto as id_protesto,
						  protesto.num_protesto as num_protesto,
						  protesto.numero as numero,
						  protesto.fec_ingreso as fec_ingreso,
						  protesto.fec_constancia as fec_constancia,
						  protesto.fec_notificacion as fec_notificacion,
						  tipo_protesto.des_tipop as des_tiprot, 
						  protesto_participantes.descri_parti as participante, 
						  monedas.desmon as tip_moneda, 
						  protesto.importe as importe,protesto.anio as anio
						  FROM protesto
						  LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
						  LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
						  LEFT OUTER JOIN protesto_participantes ON protesto_participantes.id_protesto = protesto.id_protesto AND protesto_participantes.anio=protesto.anio";
					  
	if($num_acta<>"" and $nro_protesto==""){
	
	   $consulta_protesto = $consulta_protesto." where protesto.num_protesto like '%$num_acta%'";	
		
	}
	
	if($num_acta=="" and $nro_protesto<>""){
	
	   $consulta_protesto = $consulta_protesto." where protesto.id_protesto= $nro_protesto";	
		
	}
					  
	if($num_acta<>"" and $nro_protesto<>""){
	
	   $consulta_protesto = $consulta_protesto." where protesto.id_protesto= $nro_protesto or protesto.num_protesto=$num_acta";	
		
	}

	if($num_acta=="" and $nro_protesto==""){
	
		if($participante<>"" and ($desde=="" or $hasta=="")){
		 $consulta_protesto = $consulta_protesto." where protesto_participantes.descri_parti like '%$participante%'";	
		}
		
		if($participante=="" and ($desde<>"" and $hasta<>"")){
			if($fec_ing=="1"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";	
			}
			if($fec_cons=="2"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";	
			}
			if($fec_not=="3"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";	
			}
		}
		
		if($participante<>"" and ($desde<>"" and $hasta<>"")){
			if($fec_ing=="1"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') and protesto_participantes.descri_parti like '%$participanteo%'";	
			}
			if($fec_cons=="2"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') and protesto_participantes.descri_parti like '%$participante%'";	
			}
			if($fec_not=="3"){
			   $consulta_protesto = $consulta_protesto." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') and protesto_participantes.descri_parti like '%$participante%'";	
			}
		}
	
	}

	$consulta_protesto = $consulta_protesto." GROUP BY protesto.num_protesto";

/*
if($desde<>"" and $hasta<>""){
	if($fec_ing=="on"){
		$consulta_protesto = $consulta_protesto." ORDER BY STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d')";
	}
	if($fec_cons=="on"){
		$consulta_protesto = $consulta_protesto." ORDER BY STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d')";
	}
	if($fec_not=="on"){
		$consulta_protesto = $consulta_protesto." ORDER BY STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d')";
	}
}else{*/
    $consulta_protesto = $consulta_protesto." ORDER BY protesto.num_protesto DESC";

//}

$ejecutar_protesto = mysql_query($consulta_protesto, $conexion);

$total_protesto = mysql_num_rows($ejecutar_protesto);
//echo $consulta_protesto;
$i=0;

while($protest = mysql_fetch_array($ejecutar_protesto)){

	$arr_protest[$i][0] = $protest["id_protesto"]; 
	$arr_protest[$i][1] = $protest["numero"]; 
	$arr_protest[$i][2] = $protest["fec_ingreso"]; 
	$arr_protest[$i][3] = $protest["fec_notificacion"];
	$arr_protest[$i][4] = $protest["fec_constancia"]; 
	$arr_protest[$i][5] = $protest["des_tiprot"]; 
	$arr_protest[$i][6] = $protest["participante"]; 
	$arr_protest[$i][7] = $protest["tip_moneda"]; 
	$arr_protest[$i][8] = $protest["importe"]; 
	$arr_protest[$i][9] = $protest["num_protesto"]; 
	$arr_protest[$i][10] = $protest["anio"]; 
	$i++; 
	  
}

$num_reg = 10;

$num_pag = ceil($total_protesto/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_protesto = $consulta_protesto." LIMIT $ini, $num_reg";

$ejecutar_protesto = mysql_query($consulta_protesto, $conexion);

$i=0;

while($protesto = mysql_fetch_array($ejecutar_protesto)){

	$arr_protesto[$i][0] = $protesto["id_protesto"]; 
	$arr_protesto[$i][1] = $protesto["numero"]; 
	$arr_protesto[$i][2] = $protesto["fec_ingreso"]; 
	$arr_protesto[$i][3] = $protesto["fec_notificacion"];
	$arr_protesto[$i][4] = $protesto["fec_constancia"]; 
	$arr_protesto[$i][5] = $protesto["des_tiprot"]; 
	$arr_protesto[$i][6] = $protesto["participante"]; 
	$arr_protesto[$i][7] = $protesto["tip_moneda"]; 
	$arr_protesto[$i][8] = $protesto["importe"]; 
	$arr_protesto[$i][9] = $protesto["num_protesto"]; 
	$arr_protesto[$i][10] = $protesto["anio"]; 
	$i++; 
	  
}
?>
	<form id="frm_lstprotesto" name="frm_lstprotesto">
	<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>

	  		<tr height='19'  bgcolor='#CCCCCC'>
              <td width='50' align='center'><span class='titubuskar0'>Nro.Protesto</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Nro. Acta</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Fec. Ingreso</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Fec. Notificacion</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Tipo Protesto</span></td>
              <td width='150' align='center'><span class='titubuskar0'>Participantes</span></td>
			  <td width='100' align='center'><span class='titubuskar0'>T.M</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Importe</span></td>
              <td width='100' align='center'><span class='titubuskar0'>Año</span></td>
            </tr>
	
	<?php		
	for($j=0; $j<count($arr_protesto); $j++) { 
    ?>
	 		<tr>
			  <td valign='top' align='center'>
			  <span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick="ver_poder('<?php echo $arr_protesto[$j][0]; ?>','<?php echo $arr_protesto[$j][10]; ?>')" ><?php echo $arr_protesto[$j][0]; ?></span>
              </td>
			  <td valign='top' align='center'><span class='reskar'><?php echo substr($arr_protesto[$j][9],4,6).'-'.substr($arr_protesto[$j][9],0,4); ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo fechabd_an($arr_protesto[$j][2]); ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo fechabd_an($arr_protesto[$j][3]); ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $arr_protesto[$j][5]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $arr_protesto[$j][6]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $arr_protesto[$j][7]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $arr_protesto[$j][8]; ?></span></td>
               <td valign='top' align='center'><span class='reskar'><?php echo $arr_protesto[$j][10]; ?></span></td>
			  


    <?php } ?>
    
    <tr height='25'>
            <td colspan='8' align='center' valign='bottom'>
                <table style='margin-bottom:4px'>
                   <tr class='paginacion'>
                    <?php if($pag>7){?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_protesto('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                    <?php } 
                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                        if($i <= $num_pag){ ?>
                        <td width='15'>
                            <?php	
                            if($i==$pag){ ?>
                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_protesto('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                            <?php	}else{ ?>
                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_protesto('<?php echo $i; ?>')"><?php echo $i; ?></div>
                            <?php } ?>
                        </td>
                        <?php }
                    }
                    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_protesto('<?php echo ($ini_pag+7); ?>')">--></div></td>
                    <?php
                    }
                    ?>	  
                    </tr>
                </table>
            </td>
		  </tr> 
          <tr>
          	<td colspan="8">
            	<input id="numprotestos" name="numprotestos" type="hidden" value="<?php echo $total_protesto; ?>"/>
                <?php for($i=0; $i<$total_protesto; $i++){?>
            	<input id="idprotesto<?php echo $i+1; ?>" name="idprotesto<?php echo $i+1; ?>" type="hidden" value="<?php echo $arr_protest[$i][0]; ?>"/>
                <?php }?>
            </td>
          </tr>
</table>
</form>



