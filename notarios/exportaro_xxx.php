<?php
include('conexion.php');
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano=date('Y');

$fechade=$_GET["fec_desde"];
$fechaha=$_GET["fec_hasta"];

$archivo = "RO del ".$fechade." hasta ".$fechaha."txt";
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: binary');  
header('Content-Length: '.filesize($archivo));

include($archivo);
$sec=0;
$correlativo=0;

$sqlkardex = "SELECT kardex, idtipkar, numescritura, fechaescritura, fechaconclusion, uif, codactos FROM kardex_ro";
$result=mysql_query($sqlkardex,$conn);
//aqui empieza el while de seleccion de kardex
while($row = mysql_fetch_array($result)) {
      
  $kardex=$row['kardex']; $idtipkar=$row['idtipkar']; $numescritura=$row['numescritura']; $fechaescritura=$row['fechaescritura']; 
  $uif=$row['uif']; $fechaconclusion=$row['fechaconclusion']; $codactos=$row['codactos']; $tipoenvio='I'; $modalidad="U";
  
  $fec_mes_next = explode ("/", $fechaha);
  $fecha_mes =  intval($fec_mes_next[1]);
  $fecha_ano =  intval($fec_mes_next[2]);
  
  if($fecha_mes<>12){
	 $mes_next=$fecha_mes+1;
	 if(strlen($mes_next)<>2){$cadena_mes="0".$mes_next;}else{$cadena_mes=$mes_next;}
	 $fecha_next="01/".$cadena_mes."/".$fecha_ano; 
	 }
  else{
	 $cadena2=$fecha_ano+1;
	 $fecha_next="01/01/".$cadena2; 
	 }

  if($fechaconclusion==""){
     $conclu='N';
  }else{
	 $fecha1=strtotime($fechaconclusion); $fec1 = date('d-m-Y',$fecha1);
	 $fecha2=strtotime($fecha_next); $fec2 = date('d-m-Y',$fecha2);
	 if ( strtotime($fec1) < strtotime($fec2) ) {
		$conclu='C';
		}else{
		$conclu='N';	
			}
	 }

   
  $sqlpatrimonial="SELECT patrimonial.kardex, patrimonial.idtipoacto, patrimonial.importetrans, patrimonial.exhibiomp, patrimonial.idmon, patrimonial.fpago, patrimonial.idoppago 
                   FROM patrimonial WHERE patrimonial.kardex='$kardex' and patrimonial.idtipoacto='$codactos'";

  $resultpatri=mysql_query($sqlpatrimonial,$conn);
  $valor_patri= mysql_num_rows($resultpatri);
  if($valor_patri!=0){//Aqui pregunto si el kardex tiene ingresado patrimonial
	  //Aqui comienza el while de patrimonial
	  while($rowpatri = mysql_fetch_array($resultpatri)){
		  
			$idtipoacto=$rowpatri['idtipoacto']; $importetotal=$rowpatri['importetrans']; $exibiomp=$rowpatri['exhibiomp'];  $tipomoneda=$rowpatri['idmon']; 
			$formadepagoo=$rowpatri['fpago']; $oprtunidaddepagoo=$rowpatri['idoppago']; $tipoopera=$row['uif']; 
			
			if($tipoopera!='001' || $tipoopera!='002' || $tipoopera!='003' || $tipoopera!='004' || $tipoopera!='005' || $tipoopera!='006' || $tipoopera!='007' || $tipoopera!='008' ||               $tipoopera!='016' || $tipoopera!='042' || $tipoopera!='044' || $tipoopera!='047' || $tipoopera!='051' || $tipoopera!='053' || $tipoopera!='055' || $tipoopera!='020'){
			   $oprtunidaddepago=$oprtunidaddepagoo;}else{$oprtunidaddepago=""; }
			   
			if($tipoopera=='026' || $tipoopera=='027' || $tipoopera=='020' ){$formadepago="";}else{$formadepago=$formadepagoo;}
			
			if($importetotal!='0.00'){
				if($tipomoneda=='2'){ $monedita="USD"; }
				if($tipomoneda=='1'){ $monedita="PEN"; }
			}else{
				$monedita="";
				}  
						
			if($oprtunidaddepago=='99'){ $detalleoppago="NO PRECISA"; }else{ $detalleoppago=""; }
		    
			if($idtipkar=='3'){
		
			$regis2="SELECT detallevehicular.pregistral, detallevehicular.idsedereg FROM detallevehicular WHERE detallevehicular.kardex='$kardex' 
			         AND detallevehicular.idtipacto='$idtipoacto'";
			$resregis2=mysql_query($regis2,$conn);
			$valor_detalle=mysql_num_rows($resregis2);
				
				if($valor_detalle!=0){
					 $rowregis2 = mysql_fetch_array($resregis2);
					 $numpartida=$rowregis2['pregistral']; $sedereg=$rowregis2['idsedereg'];
					 if($rowregis['pregistral']!=""){
						$incri="I";
					 }else{$incri="N";}

				 }else{$incri="X";}
			
			}else{
			$regis="SELECT detallebienes.pregistral, detallebienes.idsedereg FROM detallebienes WHERE detallebienes.kardex='$kardex' AND detallebienes.idtipacto='$idtipoacto'";
			$resregis=mysql_query($regis,$conn);
			$valor_detalle2=mysql_num_rows($resregis);
			$rowregis = mysql_fetch_array($resregis);
			    if($valor_detalle2!=0){
					$numpartida=$rowregis['pregistral']; $sedereg=$rowregis['idsedereg'];
					if($rowregis['pregistral']!=""){
						$incri="I";
						}else{ $incri="N";}
					
			    }else{$incri="X";}
	        }
			
			$sqlmedipago="SELECT DISTINCT detallemediopago.kardex, detallemediopago.tipacto, detallemediopago.codmepag, detallemediopago.fpago, detallemediopago.idbancos,
			              SUM(detallemediopago.importemp) AS sumamp, detallemediopago.idmon, mediospago.uif, fpago_uif.codigo FROM detallemediopago 
						  INNER JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
						  LEFT JOIN fpago_uif ON fpago_uif.id_fpago=detallemediopago.fpago
						  WHERE detallemediopago.kardex='$kardex' AND detallemediopago.tipacto='$idtipoacto' GROUP BY detallemediopago.codmepag, detallemediopago.tipacto";

		    $sec=$sec + 1;
		    $resmp=mysql_query($sqlmedipago,$conn);
		    $valor_medio_pago=mysql_num_rows($resmp);
			if($valor_medio_pago!=0){
				while($rowmp1 = mysql_fetch_array($resmp)) {
				$correlativo=$correlativo+1;	
				$codigomp=$rowmp1['codmepag']; $sumamp=$rowmp1['sumamp']; $money=$rowmp1['idmon']; $tpoacto=$rowmp1['tipacto']; $vacio=""; $tipofondo=$rowmp1['uif']; 
				$formapago=$rowmp1['codigo']; $vaciomonto='0.00';
				
				//aqui va la estructura de la cabecera del ro
	
	                /*1*/ echo str_pad(substr($correlativo,0,8),'8'," ",STR_PAD_LEFT).		# cdg_fil				|	N
					/*2*/	   str_pad(substr($sec,0,8) ,'8'," ",STR_PAD_LEFT).		# num_reg_ope_			|	N
					/*3*/	   str_pad(substr($tipoenvio,0,1),'1'," ",STR_PAD_LEFT).		# tipo_envio			|	C
					/*4*/	   str_pad(substr($idtipkar,0,2),'2'," ",STR_PAD_RIGHT).					# ipnp_tipo				|	C
					/*5*/	   str_pad(substr($numescritura,0,6),'6'," ",STR_PAD_RIGHT).		# ipnp_numero			|	N
					/*6*/	   str_pad(substr($fechas,0,8),'8'," ",STR_PAD_LEFT).					# ipnp_fecha			|	DATE
					/*7*/	   str_pad(substr($vacio,0,6),'6'," ",STR_PAD_LEFT).		# ipnp_num_acla			|	N
				    /*8*/	   str_pad(substr($vacio,0,8),'8'," ",STR_PAD_LEFT).		# ipnp_fec_acla			|	DATE
					/*9*/	   str_pad(substr($conclu,0,1),'1'," ",STR_PAD_LEFT).		# ipnp_conclu			|	C
					/*10*/	   str_pad(substr($vacio,0,8),'8'," ",STR_PAD_LEFT).		# ipnp_fec_firma		|	DATE
					/*11*/	   str_pad(substr($modalidad,0,1),'1'," ",STR_PAD_LEFT).		# mod_operacion			|	C
					/*12*/	   str_pad(substr($vacio,0,4),'4'," ",STR_PAD_LEFT).		# can_operaciones		|	N
					/*13*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# par_repre				|	C
					/*14*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# par_ordenante			|	C
					/*15*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# par_benef				|	C
					/*16*/     str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# par_rep_a				|	C
					/*17*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# par_tip_rep			|	C
					/*18*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# residencia			|	C
					/*19*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# tip_persona			|	C
					/*20*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# doc_tipo				|	C
					/*21*/	   str_pad(substr($vacio,0,20),'20'," ",STR_PAD_RIGHT).					# doc_numero			|	C
					/*22*/	   str_pad(substr($vacio,0,11),'11'," ",STR_PAD_LEFT).					# ruc					|	N
					/*23*/	   str_pad(substr($vacio,0,120),'120'," ",STR_PAD_RIGHT).					# per_pater_razon		|	C
					/*24*/	   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).					# per_mater				|	C
					/*25*/	   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).	    			# per_nombres			|	C
					/*26*/	   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# nacionalidad			|	C
					/*27*/	   str_pad(substr($vacio,0,8),'8'," ",STR_PAD_LEFT).		# fec_nac				|	DATE
					/*28*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# est_civil				|	C
					/*29*/	   str_pad(substr($vacio,0,3),'3'," ",STR_PAD_LEFT).		# cod_ocupac			|	C
					/*30*/	   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).		# objeto_soc			|	C
				    /*31*/     str_pad(substr($vacio,0,4),'4'," ",STR_PAD_LEFT).					# cod_ciiu				|	C
					/*32*/	   str_pad(substr($vacio,0,3),'3'," ",STR_PAD_LEFT).		# cod_cargo				|	C
					/*33*/	   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# cod_zonareg			|	N
					/*34*/	   str_pad(substr($vacio,0,12),'12'," ",STR_PAD_LEFT).		# num_ficreg			|	N
					/*35*/	   str_pad(substr($vacio,0,150),'150'," ",STR_PAD_RIGHT).					# direccion				|	C
					/*36*/	   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# cod_ubi_dpto			|	C
					/*37*/	   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# cod_ubi_prov			|	C
					/*38*/	   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# cod_ubi_dist			|	C
					/*39*/	   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).		# telefono				|	C
					/*40*/	   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# par_conyugue			|	C
					/*41*/	   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).					# con_apepat			|	C
					/*42*/	   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).					# con_apemat			|	C
					/*43*/	   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).					# con_nombres			|	C
					/*44*/	   str_pad(substr($tipofondo,0,2),'2'," ",STR_PAD_LEFT).		# tipo_fondos			|	C
					/*45*/	   str_pad(substr($tipoopera,0,3),'3'," ",STR_PAD_LEFT).		# tip_operacion			|	C
				    /*46*/     str_pad(substr($formapago,0,1),'1'," ",STR_PAD_LEFT).		# for_pago				|	C
					/*47*/	   str_pad(substr($oprtunidaddepago,0,2),'2'," ",STR_PAD_LEFT).		# opor_pago				|	C
					/*48*/	   str_pad(substr(strtoupper($detalleoppago),0,40),'40'," ",STR_PAD_RIGHT).		# des_oporpago			|	C
					/*49*/	   str_pad(substr(strtoupper($vacio),0,40),'40'," ",STR_PAD_RIGHT).					# ori_fondos			|	C
					/*50*/	   str_pad(substr($monedita,0,3),'3'," ",STR_PAD_LEFT).		# moneda				|	C
					/*51*/	   str_pad(substr($importetotal,0,18),'18'," ",STR_PAD_LEFT).		# monto_tot_ope			|	N
					/*52*/	   str_pad(substr($vaciomonto,0,18),'18'," ",STR_PAD_LEFT).		# monto_x_participante	|	N
					/*53*/	   str_pad(substr($importetotal,0,18),'18'," ",STR_PAD_LEFT).		# monto_medio_pago		|	N
					/*54*/	   str_pad(substr($vaciomonto,0,6),'6'," ",STR_PAD_LEFT).		# tip_cambio			|	N
					/*55*/	   str_pad(substr($incri,0,1),'1'," ",STR_PAD_LEFT).		# insc_regis			|	C
					/*56*/	   str_pad(substr($sedereg,0,2),'2'," ",STR_PAD_LEFT).		# bien_cod_zonareg		|	N
					/*57*/	   str_pad(substr($numpartida,0,12),'12'," ",STR_PAD_LEFT).chr(13).chr(10);		# num_partida			|	N 
				}
			}else{
				echo str_pad("Este ".$kardex." NO Tiene Fila de Operacion",'100'," ",STR_PAD_LEFT).chr(13).chr(10);
			}
			
			$sql_contratantes="SELECT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.uif, contratantesxacto.monto, contratantesxacto.ofondo,
			                   contratantesxacto.opago, contratantesxacto.idcontratante, cliente2.apemat, cliente2.apepat,  cliente2.prinom, cliente2.segnom, cliente2.numdoc,
							   cliente2.razonsocial, cliente2.direccion, cliente2.domfiscal, cliente2.tipper, cliente2.idtipdoc, cliente2.residente, cliente2.nacionalidad,
							   cliente2.idestcivil, cliente2.cumpclie, cliente2.idprofesion, cliente2.idcargoprofe, cliente2.actmunicipal, cliente2.idubigeo, cliente2.conyuge,
							   cliente2.idsedereg, cliente2.numpartida FROM contratantesxacto
							   INNER JOIN cliente2 ON contratantesxacto.idcontratante= cliente2.idcontratante
							   WHERE contratantesxacto.kardex='$kardex' AND contratantesxacto.idtipoacto='$tpoacto' AND contratantesxacto.uif <> '' AND (contratantesxacto.uif='O' 
							   OR contratantesxacto.uif='B' OR contratantesxacto.uif='R') ORDER BY contratantesxacto.uif DESC";	
 
            $rescontra=mysql_query($sql_contratantes,$conn);
			$valor_contratantes=mysql_num_rows($rescontra);
			if($valor_contratantes!=0){
			    
				while($rowcontrata = mysql_fetch_array($rescontra)) {
				 $correlativo=$correlativo+1;
				 
				 $uif=$rowcontrata['uif']; $monto=$rowcontrata['monto'];  $numdocu=$rowcontrata['numdoc']; $tipoppersona=$rowcontrata['tipper']; $td=$rowcontrata['idtipdoc']; 
				 $ofondo=$rowcontrata['ofondo']; $idcontratantee=$rowcontrata['idcontratante']; $residente=$rowcontrata['residente']; $estado_civil=$rowcontrata['idestcivil'];
				 $cumpleclie=$rowcontrata['cumpclie']; $nacionalidad=$rowcontrata['nacionalidad']; $profe=$rowcontrata['idcargoprofe']; $ciiu=$rowcontrata['actmunicipal']; 
				 $cargoprofe=$rowcontrata['idcargoprofe']; $sederegparti=$rowcontrata['idsedereg']; $numpartiparti=$rowcontrata['numpartida']; $ubigeo=$rowcontrata['idubigeo']; 
				 $esposa=$rowcontrata['conyuge']; $kardexx=$rowcontrata['kardex']; $tipoactosss=$rowcontrata['idtipoacto'];
				 
				 
					if($monto!=''){
						if($tipomoneda=='2'){ $monedita2="USD"; }
						if($tipomoneda=='1'){ $monedita2="PEN";	}
					}else{ $monedita2=""; }  
				 
				 				 
					 if($esposa!=""){
						 $sqlespo=mysql_query("select idcontratante from contratantesxacto where idcontratante='$esposa' and (kardex='$kardexx' and idtipoacto='$tipoactosss')",$conn);
						 $rowespo = mysql_fetch_array($sqlespo);
						 $esposita=$rowespo['idcontratante'];
						 if($esposita!=""){ $paricipaesposa="S";}else{$paricipaesposa="N";}
					 }else{$paricipaesposa="";}
				 
				 
				 if($ubigeo!=""){
				 $departamento=substr($ubigeo,0,2);
				 $provincia=substr($ubigeo,2,2);
				 $distrito=substr($ubigeo,4,2);
				 }else{
				 $departamento="XX";
				 $provincia="YY";
				 $distrito="DD"; }
				 
				 $sqlcargoprofe=mysql_query("select codcargoprofe from cargoprofe where idcargoprofe='$cargoprofe'",$conn);
				 $rowcarprofe = mysql_fetch_array($sqlcargoprofe);
				 $cargoprof=$rowcarprofe['codcargoprofe'];
				 
				 $sqlprofe=mysql_query("select codprof from profesiones where idprofesion='$profe'",$conn);
				 $rowprofe = mysql_fetch_array($sqlprofe);
				 $profecion=$rowprofe['codprof'];
				 
				 $sqluifobjeto=mysql_query("select nombre from ciiu where coddivi='$ciiu'",$conn);
				 $rowciiuobj = mysql_fetch_array($sqluifobjeto);
				 $objciiu=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowciiuobj['nombre'])))))))))))));
				 
				 $sqlnacionalidad=mysql_query("select codnacion from nacionalidades where idnacionalidad='$nacionalidad'",$conn);
				 $rownacionalidad = mysql_fetch_array($sqlnacionalidad);
				 
				 
				 $fech_cumple = explode ("/", $cumpleclie);
				 $fechitacumple= $fech_cumple[2] . "" . $fech_cumple[1] . "" . $fech_cumple[0];
				  
				/////////////////////aqui la fecha de firma////////////////////////////
				
				$sqlfirmita=mysql_query("select fechafirma from contratantes where idcontratante='$idcontratantee' and kardex='$kardex'",$conn);
				$rowfirmita = mysql_fetch_array($sqlfirmita);
				$firmasino=$rowfirmita['fechafirma'];
				
				
				$fec_firma=strtotime($fecha_next); $fec1a = date('d-m-Y',$fec_firma);
				$fec_firma2=strtotime($firmasino); $fec2b = date('d-m-Y',$fec_firma2);
				if ( strtotime($fec2b) < strtotime($fec1a) ) {
					$fechatxt2 = explode ("/", $firmasino);
				    $firmass = $fechatxt2[2] . "" . $fechatxt2[1] . "" . $fechatxt2[0];;
					}else{
					$firmass ='';	
					}
				
				
				  
				 
				if($tipoppersona=="N"){$tp="1"; $numeruc=""; $feccumpleclie = $fechitacumple; $autografo=$firmass;  $ciius="";$codnacion=$rownacionalidad['codnacion']; $numedoc=$numdocu; $apepat_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['apepat']))))))))))))); $apemat=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['apemat']))))))))))))); $direc_per_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['direccion']))))))))))))); $nombres=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['prinom']." ".$rowcontrata['segnom']))))))))))))); $estciv=$estado_civil; if($profecion!=''){$profis=$profecion;}else{$profis="051";} if($cargoprof!=""){$cargoprofis=$cargoprof;}else{$cargoprofis="036";} }else{$numedoc=""; $nombres=""; $codnacion=""; $estciv=""; $profis=""; $cargoprofis=""; $nombres=""; $feccumpleclie = ""; $autografo=""; }
				 
				 if($tipoppersona=="J"){$tp="3";$numeruc=$numdocu; $codnacion=""; $apemat=""; $apepat_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['razonsocial']))))))))))))); $direc_per_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['domfiscal']))))))))))))); $estciv=""; $profis=""; $cargoprofis=""; $nombres="";
				 if($ciiu!=""){$ciius=$ciiu;}else{$ciius="X";}
				 
				 if($tipoopera!='037' || $tipoopera!='038' || $tipoopera!='039' || $tipoopera!='040' || $tipoopera!='041' || $tipoopera!='042' || $tipoopera!='043' || $tipoopera!='044' ){  
				 if($sederegparti!="0"){if(strlen($sederegparti)>1){$srparti=$sederegparti;}else{$srparti="0".$sederegparti;}}else{$srparti="FF";}
				 if($numpartiparti!=""){$nparti=$numpartiparti;}else{$nparti="FNPARTIDAFFF";}
				 }else{$numeruc=""; $srparti=""; $nparti="";}
				 }else{
					 $srparti=""; $nparti="";
					 }
				 if($td!="8"){$tipdoc=$td;}else{$tipdoc="";}
				 if($uif=='R'){
				  $repre="R";
				  $sqlreprede=mysql_query("select idcontratanterp, inscrito from contratantes where idcontratante='$idcontratantee' and kardex='$kardex'",$conn);
				  $rowreprede = mysql_fetch_array($sqlreprede);
				  $representaa=$rowreprede['idcontratanterp'];
				  $inscrito=$rowreprede['inscrito'];
				 //aqui coloque 2 de no inscrito pk el sistema no tiene actualizado el inscrito y ede registral ni numeor de partida
				  if($inscrito=='1'){$inscri="2";} if($inscrito=='0'){$inscri="2";} if($inscrito==''){$inscri="2";}
				  if($residente=='1'){$resi="1";} if($residente=='0'){$resi="2";} if($residente==''){$resi="F";}
				 
				  if($representaa!=''){
					  $sqldatouif=mysql_query("select uif from contratantesxacto where idcontratante='$representaa'",$conn);
					  $rowrepreaa = mysql_fetch_array($sqldatouif);
					  $rpa=$rowrepreaa['uif'];
					  }else{$rpa="F";}
				  }else{$repre=""; $rpa="";}  
				
				  if($uif=='O'){$orde="O"; $inscri=""; $repre=""; $rpa="";}else{$orde="";}  
				  if($uif=='B'){$bene="B"; $inscri=""; $repre=""; $rpa="";}else{$bene="";} 
							 
					   echo /*1*/          str_pad(substr($correlativo,0,8),'8'," ",STR_PAD_LEFT).		# cdg_fil				|	N
							/*2*/		   str_pad(substr($sec,0,8),'8'," ",STR_PAD_LEFT).		# num_reg_ope_			|	N
							/*3*/		   str_pad(substr($tipoenvio,0,1),'1'," ",STR_PAD_LEFT).		# tipo_envio			|	C
							/*4*/		   str_pad(substr($idtipkar,0,2),'2'," ",STR_PAD_RIGHT).					# ipnp_tipo				|	C
							/*5*/		   str_pad(substr($numescritura,0,6),'6'," ",STR_PAD_RIGHT).		# ipnp_numero			|	N
							/*6*/		   str_pad(substr($fechas,0,8),'8'," ",STR_PAD_LEFT).					# ipnp_fecha			|	DATE
							/*7*/		   str_pad(substr($vacio,0,6),'6'," ",STR_PAD_LEFT).		# ipnp_num_acla			|	N
							/*8*/		   str_pad(substr($vacio,0,8),'8'," ",STR_PAD_LEFT).		# ipnp_fec_acla			|	DATE
							/*9*/		   str_pad(substr($conclu,0,1),'1'," ",STR_PAD_LEFT).		# ipnp_conclu			|	C
							/*10*/		   str_pad(substr($autografo,0,8),'8'," ",STR_PAD_LEFT).		# ipnp_fec_firma		|	DATE
							/*11*/		   str_pad(substr($modalidad,0,1),'1'," ",STR_PAD_LEFT).		# mod_operacion			|	C
							/*12*/		   str_pad(substr($vacio,0,4),'4'," ",STR_PAD_LEFT).		# can_operaciones		|	N
							/*13*/		   str_pad(substr($repre,0,1),'1'," ",STR_PAD_LEFT).		# par_repre				|	C
							/*14*/		   str_pad(substr($orde,0,1),'1'," ",STR_PAD_LEFT).		# par_ordenante			|	C
							/*15*/		   str_pad(substr($bene,0,1),'1'," ",STR_PAD_LEFT).		# par_benef				|	C
							/*16*/	       str_pad(substr($rpa,0,1),'1'," ",STR_PAD_LEFT).		# par_rep_a				|	C
							/*17*/		   str_pad(substr($inscri,0,1),'1'," ",STR_PAD_LEFT).		# par_tip_rep			|	C
							/*18*/		   str_pad(substr($resi,0,1),'1'," ",STR_PAD_LEFT).		# residencia			|	C
							/*19*/		   str_pad(substr($tp,0,1),'1'," ",STR_PAD_LEFT).		# tip_persona			|	C
							/*20*/		   str_pad(substr($tipdoc,0,1),'1'," ",STR_PAD_LEFT).		# doc_tipo				|	C
							/*21*/		   str_pad(substr($numedoc,0,20),'20'," ",STR_PAD_RIGHT).					# doc_numero			|	C
							/*22*/		   str_pad(substr($numeruc,0,11),'11'," ",STR_PAD_LEFT).					# ruc					|	N
							/*23*/		   str_pad(substr(strtoupper(str_replace('Ñ','#',str_replace('ñ','#',$apepat_empre))),0,120),'120'," ",STR_PAD_RIGHT).	# per_pater_razon|	C
							/*24*/		   str_pad(substr(strtoupper(str_replace('Ñ','#',str_replace('ñ','#',$apemat))),0,40),'40'," ",STR_PAD_RIGHT).			# per_mater		|	C
							/*25*/		   str_pad(substr(strtoupper(str_replace('Ñ','#',str_replace('ñ','#',$nombres))),0,40),'40'," ",STR_PAD_RIGHT).	    	# per_nombres	|	C
							/*26*/		   str_pad(substr($codnacion,0,2),'2'," ",STR_PAD_LEFT).		# nacionalidad			|	C
							/*27*/		   str_pad(substr($feccumpleclie,0,8),'8'," ",STR_PAD_LEFT). # fec_nac				|	DATE
							/*28*/		   str_pad(substr($estciv,0,1),'1'," ",STR_PAD_LEFT).	 # est_civil				|	C
							/*29*/		   str_pad(substr($profis,0,3),'3'," ",STR_PAD_LEFT).		# cod_ocupac			|	C
							/*30*/		   str_pad(substr($objciiu,0,40),'40'," ",STR_PAD_RIGHT).		# objeto_soc			|	C
							/*31*/         str_pad(substr($ciius,0,4),'4'," ",STR_PAD_LEFT).		# cod_ciiu				|	C
							/*32*/		   str_pad(substr($cargoprofis,0,3),'3'," ",STR_PAD_LEFT).		# cod_cargo				|	C
							/*33*/		   str_pad(substr($srparti,0,2),'2'," ",STR_PAD_LEFT).		# cod_zonareg			|	N
							/*34*/		   str_pad(substr($nparti,0,12),'12'," ",STR_PAD_LEFT).		# num_ficreg			|	N
							/*35*/		   str_pad(substr(str_replace('Ñ','#',str_replace('ñ','#',$direc_per_empre)),0,150),'150'," ",STR_PAD_RIGHT).		# direccion		|	C
							/*36*/		   str_pad(substr($departamento,0,2),'2'," ",STR_PAD_LEFT).		# cod_ubi_dpto			|	C
							/*37*/		   str_pad(substr($provincia,0,2),'2'," ",STR_PAD_LEFT).		# cod_ubi_prov			|	C
							/*38*/		   str_pad(substr($distrito,0,2),'2'," ",STR_PAD_LEFT).		# cod_ubi_dist			|	C
							/*39*/		   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).		# telefono				|	C
							/*40*/		   str_pad(substr($paricipaesposa,0,1),'1'," ",STR_PAD_LEFT).		# par_conyugue			|	C
							/*41*/		   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).					# con_apepat			|	C
							/*42*/		   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).					# con_apemat			|	C
							/*43*/		   str_pad(substr($vacio,0,40),'40'," ",STR_PAD_RIGHT).					# con_nombres			|	C
							/*44*/		   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# tipo_fondos			|	C
							/*45*/		   str_pad(substr($tipoopera,0,3),'3'," ",STR_PAD_LEFT).		# tip_operacion			|	C
							/*46*/         str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# for_pago				|	C
							/*47*/		   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# opor_pago				|	C
							/*48*/		   str_pad(substr(strtoupper($vacio),0,40),'40'," ",STR_PAD_RIGHT).		# des_oporpago			|	C
							/*49*/		   str_pad(substr(strtoupper($ofondo),0,40),'40'," ",STR_PAD_RIGHT).					# ori_fondos			|	C
							/*50*/		   str_pad(substr($monedita2,0,3),'3'," ",STR_PAD_LEFT).		# moneda				|	C
							/*51*/		   str_pad(substr($vaciomonto,0,18),'18'," ",STR_PAD_LEFT).		# monto_tot_ope			|	N
							/*52*/		   str_pad(substr($monto,0,18),'18'," ",STR_PAD_LEFT).		# monto_x_participante	|	N
							/*53*/		   str_pad(substr($vaciomonto,0,18),'18'," ",STR_PAD_LEFT).		# monto_medio_pago		|	N
							/*54*/		   str_pad(substr($vaciomonto,0,6),'6'," ",STR_PAD_LEFT).		# tip_cambio			|	N
							/*55*/		   str_pad(substr($vacio,0,1),'1'," ",STR_PAD_LEFT).		# insc_regis			|	C
							/*56*/		   str_pad(substr($vacio,0,2),'2'," ",STR_PAD_LEFT).		# bien_cod_zonareg		|	N
							/*57*/	       str_pad(substr($vacio,0,12),'12'," ",STR_PAD_LEFT).chr(13).chr(10);		# num_partida			|	N
							  
								}	
				
			}else{
			 echo str_pad("Este ".$kardex." NO Tiene Contrantates",'60'," ",STR_PAD_LEFT).chr(13).chr(10);
			}
			
	  }// Aqui termina el while de patrimonial
	  
  }else{
	  
	   echo str_pad("Este ".$kardex." NO Tiene Patrimonial",'60'," ",STR_PAD_LEFT).chr(13).chr(10);
  }
  


  
}//aqui termina el while de seleccion de kardex

mysql_free_result($result);
mysql_close($conn);  

?>