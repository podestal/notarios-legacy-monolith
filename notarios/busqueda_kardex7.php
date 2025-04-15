<html> 
<head> 
<title>Ingreso de la Minuta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link rel="stylesheet" href="stylesglobal.css">
		<style>
    .titubuskarrct {font-family: Verdana; font-size: 10px;  font-weight: bold; color: #FFF; }
	
	.fila:hover{background-color:#0CF;}
    </style>
</head> 
<body  oncontextmenu="return false" >
<?php 

include("extraprotocolares/view/funciones.php");

 $conexion = Conectar();

	$idtipoacto 		   = $_POST['idtipoacto'];
	$tipoper	 		   = $_POST['tipoper'];
	$nombre				   = trim($_POST['nombre']);
	$rangof1   		  	   = $_POST['rangof1'];
	$rangof2		 	   = $_POST['rangof2'];
	$numdoc		 		   = $_POST['numdoc'];	
	
	$pag = $_REQUEST['pag'];
		
	$idtipkar		 	  = $_POST['idtipkar'];
	$radio7	 		 	  = $_POST['radio7'];
	$inconcluso		 	  = $_POST['inconcluso'];
	$responsable		  = $_POST['responsable'];
	$estudio			  = $_POST['estudio'];	
	$retenido		 	  = $_POST['retenido'];	
	$desistido		 	  = $_POST['desistido'];	
	$nopresentado		  = $_POST['nopresentado'];	
	$est_rrpp			  = $_POST['est_rrpp'];		
	$codkardex			  = $_POST['codkardex'];
	
	$concluso			  = $_POST['concluso'];
	$noescriturado		  = $_POST['noescriturado'];
	$escriturado		  = $_POST['escriturado'];
	$pagado			  	  = $_POST['pagado'];
	$nopagado			  = $_POST['nopagado'];
	$saldo			  	  = $_POST['saldo'];

	$cmbGrupoCliente			  	  = $_POST['cmbGrupoCliente'];
	$cmbProyecto			  	  = $_POST['cmbProyecto'];
	$empresacons			  	  = $_POST['empresacons'];	
	
	
	$consulta = 'SELECT 
	k.kardex AS kardex,
					  k.fechaingreso AS fec_ingreso,
					  k.contrato AS des_acto,
					  k.referencia AS referencia,
					  k.fechaescritura AS fec_escritura,
					  k.numescritura AS num_escritura,
					  k.folioini AS folioini,
					  k.foliofin AS foliofin,
					  k.papelini AS papelini,
					  k.papelfin AS papelfin,
					  k.fechaconclusion AS fec_conclusion,
					  k.idkardex,
					  k.nc,
					  k.retenido,
						k.desistido
	FROM kardex k
	LEFT outer JOIN contratantes co ON co.`kardex`=k.`kardex`
	LEFT outer JOIN tipokar tk ON tk.`idtipkar`=k.`idtipkar`
	LEFT outer JOIN cliente2 cl ON cl.`idcontratante`=co.`idcontratante`';
	
	if($idtipoacto!="")
	{
		$consulta.=" INNER JOIN detalle_actos_kardex dak ON k.kardex=dak.kardex ";
	}
	if($est_rrpp!=""){
		$consulta .='inner JOIN movirrpp mr ON mr.`kardex`=k.`kardex` ';
	}else{
		$consulta .='LEFT OUTER JOIN movirrpp mr ON mr.`kardex`=k.`kardex` ';
	}
	
	if($pagado=="true" || $saldo=="true" ){
		$consulta .='inner JOIN d_regventas ve ON ve.`kardex`=k.`kardex` ';
	}
	
	if($nopagado=="true" ){
		$consulta .='LEFT JOIN d_regventas ve ON ve.`kardex`=k.`kardex` ';
	}
			
	$consulta .='LEFT OUTER JOIN detallemovimiento dm ON dm.`idmovreg`=mr.`idmovreg`	WHERE 1 ';

	if($radio7==1){
			
	$consulta.="and STR_TO_DATE(k.`fechaingreso`,'%d/%m/%Y') >= STR_TO_DATE('$rangof1','%d/%m/%Y') 
				AND STR_TO_DATE(k.`fechaingreso`,'%d/%m/%Y') <= STR_TO_DATE('$rangof2','%d/%m/%Y') ";
						
	}else if($radio7==2){
	
		$fechade = $rangof1;
		$fecha=explode("/",$fechade);
		$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];
		
		$fechaa  = $rangof2;
		$fecha2=explode("/",$fechaa);
		$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
	
		$consulta.="and STR_TO_DATE(k.`fechaescritura`,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
		AND STR_TO_DATE(k.`fechaescritura`,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ";
			
	}else if($radio7==3){
			
		$consulta.="and STR_TO_DATE(k.`fechaconclusion`,'%d/%m/%Y') >= STR_TO_DATE('$rangof1','%d/%m/%Y') 
					AND STR_TO_DATE(k.`fechaconclusion`,'%d/%m/%Y') <= STR_TO_DATE('$rangof2','%d/%m/%Y') ";
	}				
		
		if($idtipkar!=""){
			$consulta.="and k.idtipkar= '".$idtipkar."' "; 
		 }
		 
		if(trim($nombre)!=""){
			$consulta.= "and (
			 TRIM(
			  REPLACE(
				CONCAT(
				  IFNULL(CONCAT(TRIM(cl.`apepat`), ' '), ''),
				  IFNULL(CONCAT(TRIM(cl.`apemat`), ' '), ''),
				  IFNULL(CONCAT(TRIM(cl.`prinom`), ' '), ''),
				  IFNULL(CONCAT(TRIM(cl.`segnom`), ' '), ''),
				  IFNULL(
					CONCAT(TRIM(cl.`razonsocial`), ''),
					''
				  )
				),
				'  ',
				' '
			  )
			) LIKE '".$nombre."%'
			) ";
		  
		}
		 
		 if($idtipoacto!=""){
			$consulta.= ' AND dak.idtipoacto = "'.$idtipoacto.'" ' ;
		}

		

		if($cmbProyecto!=""){
			$consulta.= ' AND k.idProyecto = "'.$cmbProyecto.'" ' ;
		}

		 if($cmbGrupoCliente!=""){
			$consulta.= ' AND k.grupo_cliente = "'.$cmbGrupoCliente.'" ' ;
		}

		 if($empresacons!=""){
			$consulta.= ' AND k.nomProducto LIKE "%'.$empresacons.'%" ' ;
		}


		
		 if($numdoc!=""){
			$consulta.= ' AND cl.numdoc = "'.$numdoc.'" ';
		}
		 
		 if($inconcluso=='true'){
		 $consulta.="and k.fechaconclusion='' ";
		 }
		 
		 if($responsable!=""){
		 $consulta.="and r.idabores='".$responsable."' ";
		 }
		 
		 if($estudio!=""){
		 $consulta.="and r.idestabo='".$estudio."' ";
		 }
		 
		 if($retenido=="true"){
		 $consulta.="and k.retenido=1 ";
		 }
		 
		 if($desistido=="true"){
		  $consulta.="and k.desistido=1 ";
		 }
		 
 		 if($codkardex!=""){
		  $consulta.='and k.kardex LIKE "%'.$codkardex.'" ';
		 }
		 
		 if($concluso=="true"){
		  $consulta.="and k.fechaconclusion!=''";
		 }
		 
		 
		 if($noescriturado=="true"){
		  $consulta.="and (k.fechaescritura='' or k.fechaescritura='0000-00-00')";
		 }
		 
		 if($escriturado=="true"){
		  $consulta.="and k.fechaescritura!='' and k.numescritura!=''";
		 }
		 
		 if($nopagado=="true"){
		  $consulta.="and ve.kardex is null";
		 }
		 
		 if($nopresentado=="true"){
			 
		 $consulta.=" AND mr.`idmovreg` IS  NULL and ( k.idtipkar<>'031' or  
													  k.idtipkar<>'038' or 
													  k.idtipkar<>'116' or 
													  k.idtipkar<>'033' or 
													  k.idtipkar<>'115' or 
													  k.idtipkar<>'084' or 
													  k.idtipkar<>'032' or 
													  k.idtipkar<>'004' or 
													  k.idtipkar<>'034' or 
													  k.idtipkar<>'035' or 
													  k.idtipkar<>'036' or 
													  k.idtipkar<>'037' or  
													  k.idtipkar<>'117' or 
													  k.idtipkar<>'114') ";
		 }
  
 		$consulta.=" GROUP BY k.`kardex` order BY k.`idkardex` desc ";
 		//die($consulta);
		//paginamos si no hay estado rrpp
		
		$sql = mysql_query($consulta,$conexion)  or die(mysql_error());
		
		$total_kardex = mysql_num_rows($sql);		
		$num_reg = 8;
		
		//echo "<span class='titubuskar' style='font-size:18px'>".$total_kardex." REGISTROS OBTENIDOS.</span><hr>";
		
		$num_pag = ceil($total_kardex/$num_reg);
		
		$ini = 0;
		
		$ini = ($pag-1)*$num_reg;
		
		$ini_pag = floor(($pag-1)/7)*7 + 1;
		
		$consulta = $consulta." LIMIT $ini, $num_reg";
		
//		die($consulta);
		$sql = mysql_query($consulta,$conexion)  or die(mysql_error());
	
		$total_kardex = mysql_num_rows($sql);
		if($total_kardex>0){
		$i=0;
		
//$sql=mysql_query($consulta, $conn) or die(mysql_error());
?>
<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>

	  	<tr height='20'  bgcolor='#264965'>
              <td width='6%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >KARDEX</span></td>
              <td width='6%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >INGRESO</span></td>
              <td width='11%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >CONTRATO</span></td>
              <td width='12%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >REFERENCIA</span></td>
              <td width='32%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >CONTRATANTES</span></td>
              <td width='13%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >ESTADO</span></td>
			<!--  <td width='12%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >PAGOS</span></td>  -->            
              <td width='8%' align='center'><span style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:11px;" class="titubuskarrct" >RESPONSABLE</span></td>
        </tr>
<?php

	while($fila=mysql_fetch_assoc($sql))
    {

		
		if($est_rrpp!=""){
			

			//$sql_estado=mysql_query("SELECT movirrpp.idmovreg, movirrpp.kardex, detallemovimiento.titulorp  FROM movirrpp INNER JOIN detallemovimiento ON movirrpp.idmovreg=detallemovimiento.idmovreg WHERE kardex='".$fila['kardex']."' GROUP BY detallemovimiento.titulorp",$conn) or die (mysql_error());
			$conteo=mysql_num_rows($sql_estado);
			
			//while($rowrp1=mysql_fetch_assoc($sql_estado)){
				
				$sql_estado_det=mysql_query("SELECT m.`idmovreg`,m.`kardex` ,d.titulorp AS titulo,d.`idestreg` AS estado,d.`idtiptraoges` AS tramite,d.fechamov AS fecha,d.idsedereg  
FROM movirrpp m
LEFT JOIN detallemovimiento d ON d.`idmovreg`=m.`idmovreg`
WHERE m.kardex='".$fila['kardex']."'
ORDER BY d.`itemmov` DESC
LIMIT 0,1",$conexion) or die (mysql_error());
					

				$conteo1=mysql_num_rows($sql_estado_det);
				
				while($rowrp2=mysql_fetch_assoc($sql_estado_det)){
						
						//echo "==>".$est_rrpp;
					if($conteo1>0 && $rowrp2['estado']==$est_rrpp){
						
                    
                    $ejecutar_contra = mysql_query("
					SELECT contratantes.kardex,   TRIM(
						CONCAT(
						  IFNULL(cliente2.`prinom`, ''),
						  ' ',
						  IFNULL(cliente2.`segnom`, ''),
						  ' ',
						  IFNULL(cliente2.`apepat`, ''),
						  ' ',
						  IFNULL(cliente2.`apemat`, ''),
						  IFNULL(cliente2.razonsocial, '')
						)
					  ) AS cliente, cliente2.razonsocial AS empresa,firma,fechafirma FROM contratantes 
						INNER JOIN cliente2 ON contratantes.idcontratante=cliente2.idcontratante WHERE contratantes.kardex='".$fila['kardex']."' limit 5",$conexion);

            		$ejecutar_contra1 = mysql_query("
					SELECT contratantes.kardex,   TRIM(
						CONCAT(
						  IFNULL(cliente2.`prinom`, ''),
						  ' ',
						  IFNULL(cliente2.`segnom`, ''),
						  ' ',
						  IFNULL(cliente2.`apepat`, ''),
						  ' ',
						  IFNULL(cliente2.`apemat`, ''),
						  IFNULL(cliente2.razonsocial, '')
						)
					  ) AS cliente, cliente2.razonsocial AS empresa FROM contratantes 
						INNER JOIN cliente2 ON contratantes.idcontratante=cliente2.idcontratante WHERE contratantes.kardex='".$fila['kardex']."' limit 5,99",$conexion);
		
			
			
        				?>
 
                        <tr class="fila"
                            <?php if($fila['nc']==1){
                            echo 'id="'.$fila["idkardex"].'" name="'.$fila["kardex"].'" style="cursor:not-allowed"';
                            }else{ 
                            ?>
                            
                            style="cursor:pointer" onClick="ver_kardex('<?php echo $fila["kardex"]; ?>','<?php echo $fila["idkardex"]; ?>')"
                            <?php }?>
                         height="80" >
                              
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php echo $fila["kardex"]; ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php echo $fila["fec_ingreso"]; ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php echo $fila["des_acto"]; ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php 
                              if(trim($fila['referencia'])!=""){
                                  echo holaacentos(str_replace("?","Ñ",strtoupper($fila['referencia']))); 
                              }else{
                                    echo "_____";  
                              }
                              
                              ?></span></td>
                              <td valign='middle' align='justify' style="padding-left:7px;padding-right:7px;"><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php 
                              if(mysql_num_rows($ejecutar_contra)>0){
                                  while ($rescontra=mysql_fetch_assoc($ejecutar_contra)){
                                      $var='';
                                      if($rescontra["firma"]==1 && $rescontra["fechafirma"]==''){
                                          $var="*";
                                      }
                                  echo str_replace("?","Ñ",strtoupper(holaacentos($rescontra["cliente"].$rescontra["empresa"]))).$var."<br />";
                                  }
                                  if(mysql_num_rows($ejecutar_contra1)>0) echo " Y OTROS ".mysql_num_rows($ejecutar_contra1)." MAS.";
                               }
                               ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php
                             if($fila["estadofinal"]=="ESCRITURADO" || $fila["estadofinal"]=="PEND. FIRMAR" || $fila["estadofinal"]=="CONCLUIDO" || $fila["estadofinal"]=="GENERADO PARTE." || $fila["estadofinal"]=="PRESENTADO RR.PP." || $fila["estadofinal"]=="INSCRITO RR.PP."){
                                  
                                  echo $fila["estadofinal"]."<BR>";
                                  
                                  if($fila["num_escritura"]!=""){
                                    echo "(".fechabd_an($fila["fec_escritura"]).")<br>INSTR: ".$fila["num_escritura"]."<br>";
                                  }
                                  
                                  if($fila["folioini"]!=""){
                                      
                                       echo "FOLIO: ";						   
                                       if($fila["folioini"]!=""){
                                           echo $fila["folioini"]." - ".$fila["folioini"];
                                       }else{
                                           echo $fila["folioini"];
                                       }					   
                                    
                                  }				  
                                  
                              }else{
                                  
                                  echo $fila["estadofinal"]."<BR>";
                              }
                              ?></span></td>
                            		             
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php 
                              
                             $consul_resp ="
							 SELECT * FROM usuarios u
                				INNER JOIN responsable r ON r.`idabores`=u.`idusuario`
                				WHERE r.`idkardex`='".$fila["kardex"]."' ORDER BY u.apepat ASC";
                              $ejec_resp = mysql_query($consul_resp,$conexion);
                              $row_res=mysql_fetch_array($ejec_resp);
                              echo holaacentos(strtoupper(utf8_encode($row_res['loginusuario'])));
                              
                               ?></span></td>
                      </tr>
      
                    <?php						
					}
					
				//}
			
			}
			
				
		}else{
		
		
		            $ejecutar_contra = mysql_query("
					SELECT contratantes.kardex,   TRIM(
						CONCAT(
						  IFNULL(cliente2.`prinom`, ''),
						  ' ',
						  IFNULL(cliente2.`segnom`, ''),
						  ' ',
						  IFNULL(cliente2.`apepat`, ''),
						  ' ',
						  IFNULL(cliente2.`apemat`, ''),
						  IFNULL(cliente2.razonsocial, '')
						)
					  ) AS cliente, cliente2.razonsocial AS empresa,firma,fechafirma FROM contratantes 
						INNER JOIN cliente2 ON contratantes.idcontratante=cliente2.idcontratante WHERE contratantes.kardex='".$fila['kardex']."' limit 5",$conexion);

            		$ejecutar_contra1 = mysql_query("
					SELECT contratantes.kardex,   TRIM(
						CONCAT(
						  IFNULL(cliente2.`prinom`, ''),
						  ' ',
						  IFNULL(cliente2.`segnom`, ''),
						  ' ',
						  IFNULL(cliente2.`apepat`, ''),
						  ' ',
						  IFNULL(cliente2.`apemat`, ''),
						  IFNULL(cliente2.razonsocial, '')
						)
					  ) AS cliente, cliente2.razonsocial AS empresa FROM contratantes 
						INNER JOIN cliente2 ON contratantes.idcontratante=cliente2.idcontratante WHERE contratantes.kardex='".$fila['kardex']."' limit 5,99",$conexion);
		
			
			
        				?>
 
                        <tr class="fila"
                            <?php if($fila['nc']==1){
                            echo 'id="'.$fila["idkardex"].'" name="'.$fila["kardex"].'" style="cursor:not-allowed"';
                            }else{ 
                            ?>
                            
                            style="cursor:pointer" onClick="ver_kardex('<?php echo $fila["kardex"]; ?>','<?php echo $fila["idkardex"];?>')"
                            <?php }?>
                         height="80" >
                              
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php echo $fila["kardex"]; ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php echo $fila["fec_ingreso"]; ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php echo $fila["des_acto"]; ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php 
                              if(trim($fila['referencia'])!=""){
                                  echo holaacentos(str_replace("?","Ñ",strtoupper($fila['referencia']))); 
                              }else{
                                    echo "_____";  
                              }
                              
                              ?></span></td>
                              <td valign='middle' align='justify' style="padding-left:7px;padding-right:7px;"><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php 
                              if(mysql_num_rows($ejecutar_contra)>0){
                                  while ($rescontra=mysql_fetch_assoc($ejecutar_contra)){
                                      $var='';
                                      if($rescontra["firma"]==1 && $rescontra["fechafirma"]==''){
                                          $var="*";
                                      }
                                  echo str_replace("?","Ñ",strtoupper(holaacentos($rescontra["cliente"]))).$var."<br />";
                                  }
                                  if(mysql_num_rows($ejecutar_contra1)>0) echo " Y OTROS ".mysql_num_rows($ejecutar_contra1)." MAS.";
                               }
                               ?></span></td>
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php
                             
                        /*     if($fila['retenido']==1)
								echo "RETENIDO";
							else if($fila['desistido']==1)
							    echo "DESISTIDO";
							else if($fila['aclarado']==1)
							    echo "ACLARADO";
							else if($fila['liberado']==1)
							    echo "LIBERADO";
							else if($fila['anulado']==1)
							    echo "ANULADO";
							else if($fila['cortesia']==1)
							    echo "CORTESIA";
							else{
								*/
							/*	$sqlUltimoEstadoRpp="
									  SELECT esr.desestreg as estadox,dm.idestreg,
									   dm.fechamov FROM movirrpp 
									   INNER JOIN detallemovimiento ON movirrpp.idmovreg=detallemovimiento.idmovreg
									   INNER JOIN detallemovimiento dm ON detallemovimiento.idmovreg=dm.idmovreg
									   INNER JOIN estadoregistral esr ON dm.idestreg=esr.idestreg
									    WHERE 
									   kardex='".$fila['kardex']."'  ORDER BY STR_TO_DATE(dm.fechamov,'%d/%m/%Y') DESC,dm.itemmov
									   DESC LIMIT 1
									";
									$quertUltimoEstadoRpp=mysqli_query($conn_i,$sqlUltimoEstadoRpp);
									$numUltimoEstadoRpp=mysqli_num_rows($quertUltimoEstadoRpp);
									if($numUltimoEstadoRpp>0)
									{
									  $rowUltimoEstaodRpp=mysqli_fetch_assoc($quertUltimoEstadoRpp);
									    echo $rowUltimoEstaodRpp["estadox"];
									     if($fila["folioini"]!=""){
	                                      
	                                      if($fila["num_escritura"]!=""){
		                                    echo "(".fechabd_an($fila["fec_escritura"]).")<br>INSTR: ".$fila["num_escritura"]."<br>";
		                                  }
	                                       echo "FOLIO: ";						   
	                                       if($fila["folioini"]!=""){
	                                           echo $fila["folioini"]." - ".$fila["foliofin"];
	                                       }else{
	                                           echo $fila["folioini"];
	                                       }					   
	                                    
	                                  }
									}else{*/
	                             if($fila["estadofinal"]=="ESCRITURADO" || $fila["estadofinal"]=="PEND. FIRMAR" || $fila["estadofinal"]=="CONCLUIDO" || $fila["estadofinal"]=="GENERADO PARTE." || $fila["estadofinal"]=="PRESENTADO RR.PP." || $fila["estadofinal"]=="INSCRITO RR.PP."){
	                                  
	                                  echo $fila["estadofinal"]."<BR>";
	                                  
	                                  if($fila["num_escritura"]!=""){
	                                    echo "(".fechabd_an($fila["fec_escritura"]).")<br>INSTR: ".$fila["num_escritura"]."<br>";
	                                  }
	                                  
	                                  if($fila["folioini"]!=""){
	                                      
	                                       echo "FOLIO: ";						   
	                                       if($fila["folioini"]!=""){
	                                           echo $fila["folioini"]." - ".$fila["foliofin"];
	                                       }else{
	                                           echo $fila["folioini"];
	                                       }					   
	                                    
	                                  }				  
	                                  
	                              }else{
	                                  
	                                  echo $fila["estadofinal"]."<BR>";

	                                  if($fila["num_escritura"]!=""){
	                                    echo "(".fechabd_an($fila["fec_escritura"]).")<br>INSTR: ".$fila["num_escritura"]."<br>";
	                                  }
	                                 	
	                              }
	                            // }
                           //  } 
                              ?></span></td>
                             <!-- <td valign='middle' align='justify' style="padding-left:3px;padding-right:3px;"><span style="font-family:Verdana, Geneva, sans-serif; font-size:9px; color:#333;"><?php 
                             
                                $queryfacn=mysqli_query($conn_i,"SELECT 
                                                                  GROUP_CONCAT(m.`id_regventas`) AS tipos
                                                                FROM
                                                                  m_regventas m 
                                                                  LEFT JOIN d_regventas d 
                                                                    ON d.`id_regventas` = m.`id_regventas` 
                                                                    LEFT JOIN servicios s ON s.`codigo`=d.`codigo`
                                                                WHERE d.`kardex` = '".$fila["kardex"]."' AND s.`tipo`='N'");
                                                                
                                $row=mysqli_fetch_assoc($queryfacn);								
                                if(!empty($row['tipos'])){
                                    $notarial="EMITIDO";
                                    $algun_credito=0;					
                                    $ids=explode(',',$row['tipos']);
                                    foreach($ids as $valor){
                                        $querynew=mysqli_query($conn_i,"
                                                                SELECT 
                                                                  m.`saldo` 
                                                                FROM
                                                                  m_cteventas m 
                                                                WHERE m.`id_regventas` = '".$valor."' 
                                                                  AND m.`tipo_movi` = 'C'");
                                        
                                        $rowalgo=mysqli_fetch_assoc($querynew);
                                        if($rowalgo['saldo']>0){
                                            $algun_credito++;							
                                        }				  
                                    }
                                    
                                    if($algun_credito>0){
                                        $notarial="PEND. CANC";
                                    }
                                    
                                }else{
                                    $notarial="NO EMITIDO";
                                }
                                                                
                                $queryfacr=mysqli_query($conn_i,"SELECT 
                                                                  GROUP_CONCAT(m.`id_regventas`) AS tipos
                                                                FROM
                                                                  m_regventas m 
                                                                  LEFT JOIN d_regventas d 
                                                                    ON d.`id_regventas` = m.`id_regventas` 
                                                                    LEFT JOIN servicios s ON s.`codigo`=d.`codigo`
                                                                WHERE d.`kardex` = '".$fila["kardex"]."' AND s.`tipo`='E'");
                                                                                                
                                $row=mysqli_fetch_assoc($queryfacr);
                                if(!empty($row['tipos'])){					
                                    $registral="EMITIDO";
                                    $algun_credito=0;					
                                    $ids=explode(',',$row['tipos']);
                                    
                                    foreach($ids as $valor){
                                        $querynew=mysqli_query($conn_i,"
                                                                SELECT 
                                                                  m.`saldo` 
                                                                FROM
                                                                  m_cteventas m 
                                                                WHERE m.`id_regventas` = '".$valor."' 
                                                                  AND m.`tipo_movi` = 'C'");
                                        
                                        $rowalgo=mysqli_fetch_assoc($querynew);
                                        if($rowalgo['saldo']>0){
                                            $algun_credito++;							
                                        }				  
                                    }
                                    
                                    if($algun_credito>0){
                                        $registral="PEND. CANC";
                                    }
                                    
                                }else{
                                    $registral="NO EMITIDO";
                                }
                                
                                ?>
                                <table width="100%" cellpadding="1" cellspacing="0">
                                    <tr>
                                        <td>NOT</td>
                                        <td>:</td>
                                        <td><?=$notarial?></td>
                                    </tr>
                                    <tr>
                                        <td>REG</td>
                                        <td>:</td>
                                        <td><?=$registral?></td>
                                    </tr>
                                </table>
                              </span></td>-->			             
                              <td valign='middle' align='center'><span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;"><?php 
                              
                             $consul_resp ="
							 SELECT * FROM usuarios u
                				INNER JOIN responsable r ON r.`idabores`=u.`idusuario`
                				WHERE r.`idkardex`='".$fila["kardex"]."' ORDER BY u.apepat ASC";
                              $ejec_resp = mysql_query($consul_resp,$conexion);
                              $row_res=mysql_fetch_array($ejec_resp);
                              echo holaacentos(strtoupper(utf8_encode($row_res['loginusuario'])));
                              
                               ?></span></td>
                      </tr>
                      <?php
		}
    }
?>
</table>
<table align="center" width="100%">
<tr height='25'>
                <td colspan='5' align='center' valign='bottom'>
                    <table style='margin-bottom:4px'>
                       <tr class='paginacion'>
                        <?php if($pag>7){?>
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onClick="buscarkardexavanzada3('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($p=$ini_pag; $p<$ini_pag+7; $p++){
                            if($p <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($p==$pag){ ?>
                                <div class='pagina' style='cursor:not-allowed; 14px; background-color:#525252; color:'white' ' title='Ir a' onClick="buscarkardexavanzada3('<?php echo $p; ?>')"><u><?php echo $p; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onClick="buscarkardexavanzada3('<?php echo $p; ?>')"><?php echo $p; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onClick="buscarkardexavanzada3('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
						
                        ?>	  
                        </tr>
                    </table>
                </td>
	        </tr> </TABLE>
 </body></html>
 <?php }
 if($total_kardex==0){

	
	echo 	"<br><span class='reskar' style='font-size:18px;'><B>&nbsp;No se han obtenido resultados en esta busqueda</B></span>";
		
	}?>  