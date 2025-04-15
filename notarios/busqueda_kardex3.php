<link rel="stylesheet" href="stylesglobal.css">
    
    <?php 
    
    include('extraprotocolares/view/funciones.php');
    
    $conexion = Conectar();
    
    $num_kardex = $_REQUEST['num_kardex'];
	
	$nro_acta = $_REQUEST['nroacta'];
    
    $nombre = $_REQUEST['nombre'];
    
    $doi=$_REQUEST["doi"];


    $pag = $_REQUEST['pag'];
    
    if(true){
			
		if($nombre!='' or $doi!='' ){
		$consulta_kardexInner.="  
		  LEFT JOIN contratantes c 
			ON c.`kardex` = kardex.`kardex` 
		  LEFT JOIN cliente2 c2 
			ON c2.`idcontratante` = c.`idcontratante` ";

		}

		$consulta_kardex = "SELECT
							kardex.kardex AS kardex,
							tipokar.nomtipkar AS nom_tipkar,
							kardex.fechaingreso AS fec_ingreso,
							kardex.contrato AS des_acto,
							kardex.referencia AS referencia,
							kardex.fechaescritura AS fec_escritura,
							kardex.numescritura AS num_escritura,
							kardex.folioini AS folio,
							kardex.fechaconclusion AS fec_conclusion,
							kardex.idkardex,
							kardex.idtipkar,
							SUBSTRING_INDEX(kardex.kardex,'-',1) AS temp_kardex,
							kardex.responsable_new as usuario
							FROM
							kardex
							Inner Join tipokar ON kardex.idtipkar = tipokar.idtipkar";
		
		$consulta_kardex=$consulta_kardex." ".$consulta_kardexInner;

		$consulta_kardex = $consulta_kardex." WHERE kardex.kardex like '%$num_kardex%' and kardex.idtipkar='3'";
		
		if(trim($nro_acta)!=""){$consulta_kardex = $consulta_kardex." AND CAST(kardex.numescritura AS UNSIGNED)= '$nro_acta'";}
		
		if($nombre!=''){
			$consulta_kardex = $consulta_kardex." AND ( CONCAT(trim(c2.apepat),' ',trim(c2.apemat),' ',trim(c2.prinom)) like '".$nombre."%' OR c2.razonsocial like  '".$nombre."%' ) ";
		}

		if($doi!='')
		{
			$consulta_kardex = $consulta_kardex." AND c2.numdoc='".$doi."'";
		}


		$consulta_kardex = $consulta_kardex." GROUP BY kardex.idkardex";
		
	
		$ejecutar_kardex = mysql_query($consulta_kardex, $conexion);
		
		$total_kardex = mysql_num_rows($ejecutar_kardex);
		
		$num_reg = 15;
		
		$num_pag = ceil($total_kardex/$num_reg);
		
		$ini = 0;
		
		$ini = ($pag-1)*$num_reg;
		
		$ini_pag = floor(($pag-1)/7)*7 + 1;
		
		$consulta_kardex = $consulta_kardex." ORDER BY kardex.idkardex DESC,  kardex.fechaingreso DESC LIMIT $ini, $num_reg ";
		
		$ejecutar_kardex = mysql_query($consulta_kardex, $conexion);
		
		$i=0;
		
	 ?>
	
	 <table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>

	  	<tr height='19'  bgcolor='#CCCCCC'>
              <td width='75' align='center'><span class='titubuskar0'>N° Kard - Año</span></td>
              
              <td width='200' align='center'><span class='titubuskar0'>Tip. Kardex</span></td>
              <td width='86' align='center'><span class='titubuskar0'>Fec. Ingreso</span></td>
              <td width='233' align='center'><span class='titubuskar0'>Actos</span></td>
              <td width='257' align='center'><span class='titubuskar0'>Contratantes</span></td>
              <td width='90' align='center'><span class='titubuskar0'>Fec. Escrit.</span></td>
			  <td width='96' align='center'><span class='titubuskar0'>Nº Escrit.</span></td>
              <td width='70' align='center'><span class='titubuskar0'>Folio</span></td>
              <td width='90' align='center'><span class='titubuskar0'>Fec. Conclus.</span></td>
              <td width='90' align='center'><span class='titubuskar0'>Usuario</span></td>
              <td width='90' align='center'><span class='titubuskar0'>Escaneo</span></td>
        </tr>

		<?php
		while($kardex = mysql_fetch_array($ejecutar_kardex)){
			$sqlcontra="SELECT contratantes.kardex, cliente2.nombre AS cliente, cliente2.razonsocial AS empresa FROM contratantes 
    INNER JOIN cliente2 ON contratantes.idcontratante=cliente2.idcontratante WHERE contratantes.kardex='".$kardex['kardex']."'";
    
            $ejecutar_contra = mysql_query($sqlcontra, $conexion);
        ?>
 
 		<tr>
			  <td valign='top' align='center'>
			  	 <a class='reskar' id="<?php echo $kardex["idkardex"]; ?>" name="<?php echo $kardex["kardex"]; ?>" style='color:#06C; cursor:pointer' onclick="ver_kardex(this.name,this.id); return false"><?php echo $kardex["kardex"]; ?></a>
			  </td>
             
			  <td valign='top' align='center'><span class='reskar'><?php echo $kardex["nom_tipkar"]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $kardex["fec_ingreso"]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $kardex["des_acto"]; ?></span></td>
			   <td valign='top' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php 
			  
			  while ($rescontra=mysql_fetch_assoc($ejecutar_contra)){
			  echo str_replace("?","Ñ",strtoupper(($rescontra["cliente"].$rescontra["empresa"])))."<br />";
			  }
			   ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo fechabd_an($kardex["fec_escritura"]); ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $kardex["num_escritura"]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $kardex["folio"]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $kardex["fec_conclusion"]; ?></span></td>
			  <td valign='top' align='center'><span class='reskar'><?php echo $kardex["usuario"]; ?></span></td>
			  <?php 

$fechaEntera = strtotime($kardex["fec_escritura"]);
$anio = date("Y", $fechaEntera);
$numEscritura =  '';
$dirEscritura =  '';

switch ($kardex["idtipkar"]) {
	case 1:
		$numEscritura = 'E'.$kardex["num_escritura"].'-'.$anio;
		$dirEscritura = 'ESCRITURAS';
		break;
	case 2:
		$numEscritura = 'N'.$kardex["num_escritura"].'-'.$anio;
		$dirEscritura = 'NOCONTENCIOSOS';
		break;
	case 3:
		$numEscritura = 'A'.$kardex["num_escritura"].'-'.$anio;
		$dirEscritura = 'ACTAS';
		break;
	case 4:
		$numEscritura = 'G'.$kardex["num_escritura"].'-'.$anio;
		$dirEscritura = 'GARANTIAS';
		break;
	case 5:
		$numEscritura = 'T'.$kardex["num_escritura"].'-'.$anio;
		$dirEscritura = 'TESTAMENTOS';
		break;
	
}
if(file_exists('D:/escaneos/'.$anio.'/'.$dirEscritura.'/'.$numEscritura.'.pdf')){
	$imgPdf = '<img src="images/pdf.png" alt="" width="22px">';
}else{
	$imgPdf = 'FALTA SCANEO';
}                            
?>

			  <td valign='top' align='center'><span class='reskar'><a href="#" title="ABRIR REGISTRO" onclick="abrirPdf('<?php echo $numEscritura; ?>','<?php echo $dirEscritura; ?>','<?php echo $anio; ?>')"><?php echo $imgPdf;?></a></span></td>
	  </tr>
      
      <?php } ?>
      
      <tr height='25'>
            <td colspan='9' align='center' valign='bottom'>
                <table style='margin-bottom:4px'>
                   <tr class='paginacion'>
                    <?php if($pag>7){?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_kardex3('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                    <?php } 
                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                        if($i <= $num_pag){ ?>
                        <td width='15'>
                            <?php	
                            if($i==$pag){ ?>
                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_kardex3('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                            <?php	}else{ ?>
                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_kardex3('<?php echo $i; ?>')"><?php echo $i; ?></div>
                            <?php } ?>
                        </td>
                        <?php }
                    }
                    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_kardex3('<?php echo ($ini_pag+7); ?>')">--></div></td>
                    <?php
                    }
                    ?>	  
                    </tr>
                </table>
           </td>
	   </tr> 

	   
	</table>
	<?php } ?>
	