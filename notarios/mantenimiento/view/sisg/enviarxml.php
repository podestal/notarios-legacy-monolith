<?php

include("conexion.php");

$formu=$_POST['formu'];

//$formu='2';




$fechini=$_POST['fec_desde'];
$fechfin=$_POST['fec_hasta'];

/*
$fechini='13/06/2016';
$fechfin='13/06/2016';
*/

$soap_request .= "<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'>\n";
$soap_request .= "\t<SOAP-ENV:Body>\n";
$soap_request .= "\t\t<setDocumentosNotariales xmlns='http://ws.sisgen.ancert.notariado.org/'>\n";
$soap_request .= "\t\t\t<arg0 xmlns=''><![CDATA[";


$file = fopen("text.xml", "r") or exit("Unable to open file!");

while(!feof($file))
{
$soap_request .=fgets($file);
}
fclose($file);

$soap_request .= "\t\t\t]]></arg0>";
$soap_request .= "\t\t</setDocumentosNotariales>\n";
$soap_request .= "\t</SOAP-ENV:Body>\n";
$soap_request .= "</SOAP-ENV:Envelope>\n";


  $header = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
	"Accept-Encoding: gzip",
	//"Content-Encoding: gzip",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: \"http://ws.sisgen.ancert.notariado.org/DocumentosNotarialesSOAPService/setDocumentosNotariales\"",
    "Content-length: ".strlen($soap_request),
  );

  $soap_do = curl_init();
  curl_setopt($soap_do, CURLOPT_URL, "https://test.www.notariado.org/sisgen-web/DocumentosNotarialesService" );
  curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($soap_do, CURLOPT_TIMEOUT,        500);
  curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, true); 
  curl_setopt($soap_do, CURLOPT_CAINFO, "ancert.cer");
  curl_setopt($soap_do, CURLOPT_POST,           1 );
  curl_setopt($soap_do, CURLOPT_ENCODING , "gzip");
  curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
  curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);

 	$response = curl_exec($soap_do);
	
	//$resultado = $response;
	//$resultado = substr($response,-400);
   
  //print_r(utf8_encode($response));
 
 // print_r ('Proceso OK');
   
   $xml2='<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><ns2:setDocumentosNotarialesResponse xmlns:ns2="http://ws.sisgen.ancert.notariado.org/" xmlns:ns3="http://ancert.notariado.org/SISGEN/XML"><return>';
   $xml3='</return></ns2:setDocumentosNotarialesResponse></soap:Body></soap:Envelope>';
   
   $xmlraul= str_replace('ns3:','',str_replace($xml3,'',str_replace($xml2,'',$response)));

   
   
   
  
  // print_r ($xmlraul);

 function XMLtoArray($XML) { 
 $xml_parser = xml_parser_create(); 
 xml_parse_into_struct($xml_parser, $XML, $vals); 
 xml_parser_free($xml_parser); 
 // wyznaczamy tablice z powtarzajacymi sie tagami na tym samym poziomie 
 $_tmp=''; 
 foreach ($vals as $xml_elem) { 
 $x_tag=$xml_elem['tag']; 
 $x_level=$xml_elem['level']; 
 $x_type=$xml_elem['type']; 
 if ($x_level!=1 && $x_type == 'close') { 
 if (isset($multi_key[$x_tag][$x_level])) 
	 $multi_key[$x_tag][$x_level]=1; 
 else $multi_key[$x_tag][$x_level]=0; 
 } 
 if ($x_level!=1 && $x_type == 'complete') { 
 if ($_tmp==$x_tag) $multi_key[$x_tag][$x_level]=1; 
 $_tmp=$x_tag; } } // jedziemy po tablicy 
 foreach ($vals as $xml_elem) { 
 $x_tag=$xml_elem['tag']; 
 $x_level=$xml_elem['level']; 
 $x_type=$xml_elem['type']; 
 if ($x_type == 'open') 
	 $level[$x_level] = $x_tag; 
 $start_level = 1; 
 $php_stmt = '$xml_array'; 
 if ($x_type=='close' && $x_level!=1) 
	 $multi_key[$x_tag][$x_level]++; 
 while ($start_level < $x_level) { 
 $php_stmt .= '[$level['.$start_level.']]'; 
 if (isset($multi_key[$level[$start_level]][$start_level]) && $multi_key[$level[$start_level]][$start_level]) 
	 $php_stmt .= '['.($multi_key[$level[$start_level]][$start_level]-1).']'; 
 $start_level++; 
 } 
 $add='';
 if (isset($multi_key[$x_tag][$x_level]) && $multi_key[$x_tag][$x_level] && ($x_type=='open' || $x_type=='complete')) { 
 if (!isset($multi_key2[$x_tag][$x_level])) $multi_key2[$x_tag][$x_level]=0; 
 else $multi_key2[$x_tag][$x_level]++; 
 $add='['.$multi_key2[$x_tag][$x_level].']'; 
 } 
 if (isset($xml_elem['value']) && trim($xml_elem['value'])!='' && !array_key_exists('attributes', $xml_elem)) {
	 if ($x_type == 'open') $php_stmt_main=$php_stmt.'[$x_type]'.$add.'[\'content\'] = $xml_elem[\'value\'];';
	 else $php_stmt_main=$php_stmt.'[$x_tag]'.$add.' = $xml_elem[\'value\'];';
	 eval($php_stmt_main); 
	 } 
	 if (array_key_exists('attributes', $xml_elem)) { if (isset($xml_elem['value'])) { 
	 $php_stmt_main=$php_stmt.'[$x_tag]'.$add.'[\'content\'] = $xml_elem[\'value\'];'; 
	 eval($php_stmt_main); 
	 } 
	 foreach ($xml_elem['attributes'] as $key=>$value) { 
	 $php_stmt_att=$php_stmt.'[$x_tag]'.$add.'[$key] = $value;'; 
	 eval($php_stmt_att); 
	 } 
	 } 
	 } 
	 return $xml_array; 
	 } 


	
	$arrayimpecab= XMLtoArray($xmlraul);
	
	// insertamos a la base de datos
	
	function dame_fecha_corto()
{ 
   
    $months = array ("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("d");  
    $date = $day_now . "/" . $months[$month_now] . "/" . substr($year_now,0,4);   
    return $date;    

}
	
	
	$num_kardex='';
	$num_escritura='';
	$tipo_kardex='';
	$fecha=dame_fecha_corto();

	$Hora= time();
	$horaingreso=date( "H:i:s",$Hora);

 
	//print_r($arrayimpecab);
	// 1 si es mas de una acto
	
	$xmll =  substr($response, strpos($response,'<message>'), strpos($response,'</message>')-strpos($response,'<message>'));
    $xmll2 =  substr($response, strpos($response,'<status>'), strpos($response,'</status>')-strpos($response,'<status>'));

	 //echo $xmll; //IMPRIMIR MENSAJE
	// echo  (" Proceso " );
	 //echo $xmll2; //IMPRIMIR RESULKTDASOS
	 
	$trun_sisgen_mensaje="TRUNCATE sisgen_mensaje"; 
            mysql_query($trun_sisgen_mensaje,$conn) or die(mysql_error());
			
	$trun_sisgen="TRUNCATE sisgen"; 
            mysql_query($trun_sisgen,$conn) or die(mysql_error());


	$fallido=0;
	$guardado=0;
	$observado=0;
	
	if($formu<>1)
	{
		
		echo "<ul>";	

	//DOCUMENTOSNOTARIALES	
	//GENERADORDATOS
	//DOCUMENTONOTARIAL
	
	foreach($arrayimpecab as $impe_cab => $campos_cab2){	
		
		
		if(is_array($campos_cab2)){
			 //print_r ($campos_cab2);
			 
			foreach($campos_cab2['SOAP:BODY'] as $impe_det => $campos_detsoap) {
			
			//echo ($campos_detsoap['XMLNS:NS2']);
			//print_r ($campos_detsoap);
			
			foreach($campos_detsoap['RETURN'] as $impe_det => $campos_detresponse) {
				
					//print_r ($campos_detresponse);
				
		            if(is_array($campos_detresponse['DOCUMENTONOTARIAL'])){
                  //      echo '<ul>';
				  
		                foreach($campos_detresponse['DOCUMENTONOTARIAL'] as $impe_det => $campos_det){
							
							//echo "<li>".$campos_det['STATUS']."</li>";
							$dato =	$campos_det['STATUS'];
							
		            //    echo '<ul>';
								foreach($campos_det['DOCUMENTO'] as $impe_det => $campos_det2){
                                          
                                          
                                    //         echo "<li>".$campos_det2['NUMKARDEX']."</li>";   
											 $numkardex =	$campos_det2['NUMKARDEX'];
                                    //         echo "<li>".$campos_det2['TIPOINSTRUMENTO']."</li>";
											 $tipoinstrumento =	$campos_det2['TIPOINSTRUMENTO'];
                                    //         echo "<li>".$campos_det2['NUMDOCUMENTO']."</li>";
											 $numdocumento =	$campos_det2['NUMDOCUMENTO'];
                                    //         echo "<li>".$campos_det2['FECHAINSTRUMENTO']."</li>";
											 $fechainstrumento =	$campos_det2['FECHAINSTRUMENTO'];
                                         
									//		 echo '<ul>';
											 foreach($campos_det2['ERRORS'] as $impe_det => $campos_det3){
												 if(is_array($campos_det3)){
									//			 echo '<ul>';
                                                 foreach($campos_det3 as $impe_det => $campos_det4){
									//			 echo "<li>".$campos_det4."</li>";//error  documentonotarial/documento/error
												 
												 if(is_array($campos_det4)){
													 foreach($campos_det4 as $impe_det => $campos_det5){
													$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_det5')"; 
													mysql_query($sqlwsdl,$conn) or die(mysql_error());
													 }
													 }else{
														 
													$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_det4')"; 
													mysql_query($sqlwsdl,$conn) or die(mysql_error());
													
												 }
												 
												 
												 }
												 
												 //echo '</ul>';	
                                                 }else{
													 $sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_det3')"; 
														mysql_query($sqlwsdl,$conn) or die(mysql_error());
													 
													// echo "<li>".$campos_det3."</li>";
												 }
											 }
										//	echo '</ul>';
									
										if ($dato=='FALLIDO'){$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
										('$tipoinstrumento','$numkardex','$numdocumento','$fechainstrumento','$fecha','$horaingreso','$dato','3')"; 
										mysql_query($sqlinsertsisgen,$conn) or die(mysql_error());

										$sqlinsertsisgenr="insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
										('$tipoinstrumento','$numkardex','$numdocumento','$fechainstrumento','$fecha','$horaingreso','$dato','3')"; 
										mysql_query($sqlinsertsisgenr,$conn) or die(mysql_error());
										
										$sqlupdateestado="UPDATE kardex SET estado_sisgen ='3' WHERE kardex='$numkardex'";
										mysql_query($sqlupdateestado,$conn) or die(mysql_error());

										$fallido++;
										}
										if ($dato=='GUARDADO'){$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
										('$tipoinstrumento','$numkardex','$numdocumento','$fechainstrumento','$fecha','$horaingreso','$dato','1')"; 
										mysql_query($sqlinsertsisgen,$conn) or die(mysql_error());

										$sqlinsertsisgenr="insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
										('$tipoinstrumento','$numkardex','$numdocumento','$fechainstrumento','$fecha','$horaingreso','$dato','1')"; 
										mysql_query($sqlinsertsisgenr,$conn) or die(mysql_error());

										$sqlupdateestado="UPDATE kardex SET estado_sisgen ='1' WHERE kardex='$numkardex'";
										mysql_query($sqlupdateestado,$conn) or die(mysql_error());

										$guardado++;
										}
										if ($dato=='CON OBSERVACIONES'){$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
										('$tipoinstrumento','$numkardex','$numdocumento','$fechainstrumento','$fecha','$horaingreso','$dato','2')"; 
										mysql_query($sqlinsertsisgen,$conn) or die(mysql_error());

										$sqlinsertsisgenr="insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
										('$tipoinstrumento','$numkardex','$numdocumento','$fechainstrumento','$fecha','$horaingreso','$dato','2')"; 
										mysql_query($sqlinsertsisgenr,$conn) or die(mysql_error());
										
										$sqlupdateestado="UPDATE kardex SET estado_sisgen ='2' WHERE kardex='$numkardex'";
										mysql_query($sqlupdateestado,$conn) or die(mysql_error());
										
										$observado++;
										}
										
								}	//foreach($campos_det['DOCUMENTO'] 
								
								foreach($campos_det['MAESTROS'] as $impe_det => $campos_maestro){
									
												foreach($campos_maestro['ERRORS'] as $impe_det => $campos_det3){
														if(is_array($campos_det3)){
														 
															// echo '<ul>';
															 foreach($campos_det3 as $impe_det => $campos_det4){
															// echo "<li>".$campos_det4."</li>";//error  documentonotarial/documento/error
															 
																	if(is_array($campos_det4)){
																		 foreach($campos_det4 as $impe_det => $campos_detmaestros){
																			$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_detmaestros')"; 
																			mysql_query($sqlwsdl,$conn) or die(mysql_error());
																		 }													 
																	}else{
																		$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_det4')"; 
																		mysql_query($sqlwsdl,$conn) or die(mysql_error());
																	}
																																 
															 }/*
																	$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_det4')"; 
																	mysql_query($sqlwsdl,$conn) or die(mysql_error()); */
														}else{
																// echo "<li>"."HOLA2".$campos_det3."</li>";
																$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_det3')"; 
																mysql_query($sqlwsdl,$conn) or die(mysql_error()); 
															}
												
												}
								}
					foreach($campos_det['OPERACIONES'] as $impe_det => $campo_operacion){ 
							  

							foreach($campo_operacion['OPERACION'] as $impe_det => $campo_operacion2){ 
							        
											foreach($campo_operacion2['OPERANTES'] as $impe_det => $campo_operacion3){ 
										 
												//	      echo "<li>".$campo_operacion3['IDMAESTRO']."</li>";
													
													 echo '<ul>';
													 foreach($campo_operacion3['INTERVENCIONES'] as $impe_det => $campo_operacion4){
													 
												//	      echo "<li>".$campo_operacion4['TIPOINTERVENCION']."</li>";
												//		  echo "<li>".$campo_operacion4['DESCRIPCIONINTERVENCION']."</li>";

													 echo '<ul>';
													 foreach($campo_operacion4['SUJETOS'] as $impe_det => $campo_operacion5){ 
													 
												//	      echo "<li>".$campo_operacion5['IDMAESTRO']."</li>";
												//		  echo "<li>".$campo_operacion5['ORIGENFONDOS']."</li>";

													 }
												   echo '</ul>';

													 }
												   echo '</ul>';

												   
													 foreach($campo_operacion2['CUANTIAOPERACION'] as $impe_det => $campo_cuantia){ 
												  
												//        echo "<li>".$campo_cuantia['CUANTIA']."</li>";
												//		echo "<li>".$campo_cuantia['TIPOMONEDA']."</li>";

													 }
													 
													 foreach($campo_operacion2['MEDIOSPAGO'] as $impe_det => $campo_mediopago){ 
												  
												//        echo "<li>".$campo_mediopago['MEDIOPAGO']."</li>";
												//		echo "<li>".$campo_mediopago['MOMENTOPAGO']."</li>";
												//		echo "<li>".$campo_mediopago['CUANTIAPAGO']."</li>";
												//		echo "<li>".$campo_mediopago['TIPOMONEDAPAGO']."</li>";
												//		echo "<li>".$campo_mediopago['JUSTIFICADOMANIFESTADO']."</li>";
														
												   foreach($campo_mediopago['ERRORS'] as $impe_det => $campo_mediopago2){
																	 
												//					 echo '<ul>';
																
																	 
																	 foreach($campo_mediopago2['ERROR'] as $impe_det => $campo_mediopago3){
																	  
												//					  echo "<li>".$campo_mediopago3."</li>";//error  documentonotarial/documento/error
																	 }
																	 

												//					echo '</ul>';	 
																	 
																 }

													 }
													 //validar
													
													 foreach($campo_operacion3['ERRORS'] as $impe_det => $campo_operanteserror){
																	 
																		 if(is_array($campo_operanteserror)){
													//					 echo '<ul>';
																		 foreach($campo_operanteserror['ERROR'] as $impe_det => $campo_operanteserror2){
													//					  echo "<li>".$campo_operanteserror2."</li>";//error  documentonotarial/documento/error
																		 }echo '</ul>';	 
																		 }else{
													//						 echo "<li>".$campo_operanteserror."</li>";
																		 }
																		 
																		 
																		 if(is_array($campo_operanteserror)){
																		// echo '<ul>';
																		 foreach($campo_operanteserror as $impe_det => $campos_operantes){
																		// echo "<li>".$campos_detoperacion."</li>";//error  documentonotarial/documento/error
																		 
																		 if(is_array($campos_operantes)){
																			 foreach($campos_operantes as $impe_det => $campos_detresultadooperantes){
																			$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_detresultadooperantes')"; 
																			mysql_query($sqlwsdl,$conn) or die(mysql_error());
																			 }													 
																			}else{
																			$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_operantes')"; 
																			mysql_query($sqlwsdl,$conn) or die(mysql_error());
																		}
																			
																		 
																		 }//echo '</ul>';
																		 
																		 
																		 }else{
																		//	 echo "<li>"."HOLA2".$campo_operacion3."</li>";
																			$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_operantes')"; 
																			mysql_query($sqlwsdl,$conn) or die(mysql_error()); 
																		}
																		 
																		 
																		 
																		 
																		 
																	 }
														 
										 //   echo '</ul>';
											}
															  
											 foreach($campo_operacion2['ERRORS'] as $impe_det => $campo_operacion3){
													
												 if(is_array($campo_operacion3)){
															// echo '<ul>';
															 foreach($campo_operacion3 as $impe_det => $campos_detoperacion){
															// echo "<li>".$campos_detoperacion."</li>";//error  documentonotarial/documento/error
															 
															 if(is_array($campos_detoperacion)){
																 foreach($campos_detoperacion as $impe_det => $campos_detresultado){
																$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_detresultado')"; 
																mysql_query($sqlwsdl,$conn) or die(mysql_error());
																 }													 
																}else{
																$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_detoperacion')"; 
																mysql_query($sqlwsdl,$conn) or die(mysql_error());
															}
																
															 
															 }//echo '</ul>';
															 /*
																$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campos_detoperacion')"; 
																mysql_query($sqlwsdl,$conn) or die(mysql_error()); 
															 */
															 }else{
															//	 echo "<li>"."HOLA2".$campo_operacion3."</li>";
																$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$campo_operacion3')"; 
																mysql_query($sqlwsdl,$conn) or die(mysql_error()); 
															}
												   
													
												}
														 
													  
														 
		 
																					  
							}

								//  echo '</ul>';

					}//FIN OPERACIONES
					
						
						
						
						
					//	echo '</ul>';
		                }//is_array($campos_cab['DOCUMENTONOTARIAL']
						
						
					// echo '</ul>';
					}
			
			}// BODY
		}
			//is_array($campos_cab)
			
	}	
					
	 }//arrayimpecab

		
	}else{// 0 un acto
		
echo "<ul>";	
	
	//print_r($arrayimpecab);
	
		foreach($arrayimpecab as $impe_cab => $campos_cab){
				foreach($campos_cab['SOAP:BODY'] as $impe_det => $campos_detsoap) {
					//$i =0;
					foreach($campos_detsoap['RETURN'] as $impe_det => $campos_detresponse) {
						
						//var_dump ($campos_detresponse);
						//var_dump ($campos_detresponse["DOCUMENTONOTARIAL"]);
						
						//var_dump ($campos_detresponse["STATUS"]);
						
						if(is_array($campos_detresponse)){
									
								foreach($campos_detresponse['DOCUMENTONOTARIAL'] as $impe_det => $campos_detresponse3){
									if(is_array($campos_detresponse3)){
										
										foreach($campos_detresponse3 as $impe_det => $campos_detresponse4){
											
											if(is_array($campos_detresponse4)){
												
												
												
											}else{
												
												
													//var_dump($campos_detresponse4['NUMKARDEX']);
													$numkardex =	$campos_detresponse4['NUMKARDEX'];
													//var_dump($numkardex);
											}
											
										}
										
									}else{
										$status=$campos_detresponse3;
											if ($status=='FALLIDO'){$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
											('','','','','','','$status','0')"; 
											mysql_query($sqlinsertsisgen,$conn) or die(mysql_error());

											$sqlinsertsisgenr="insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
											('','','','','','','$status','0')"; 
											mysql_query($sqlinsertsisgenr,$conn) or die(mysql_error());
											
											//$sqlupdateestado="UPDATE kardex SET estado_sisgen ='3' WHERE kardex='$numkardex'";
											//mysql_query($sqlupdateestado,$conn) or die(mysql_error());

											$fallido++;
											}
											
											
											if ($status=='GUARDADO'){$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
											('','','','','','','$status','1')"; 
											mysql_query($sqlinsertsisgen,$conn) or die(mysql_error());

											$sqlinsertsisgenr="insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
											('','','','','','','$status','1')"; 
											mysql_query($sqlinsertsisgenr,$conn) or die(mysql_error());

											//$sqlupdateestado="UPDATE kardex SET estado_sisgen ='1' WHERE kardex='$numkardex'";
											//mysql_query($sqlupdateestado,$conn) or die(mysql_error());

											$guardado++;
											
											}
											if ($status=='CON OBSERVACIONES'){$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
											('','','','','','','$status','2')"; 
											mysql_query($sqlinsertsisgen,$conn) or die(mysql_error());

											$sqlinsertsisgenr="insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
											('','','','','','','$status','2')"; 
											mysql_query($sqlinsertsisgenr,$conn) or die(mysql_error());
											
											//$sqlupdateestado="UPDATE kardex SET estado_sisgen ='2' WHERE kardex='$numkardex'";
											//mysql_query($sqlupdateestado,$conn) or die(mysql_error());
											
											$observado++;
											}
											
									}
									//var_dump($campos_detresponse3);
								}
								
								}else{
									//var_dump($campos_detresponse);
								}
						
						
						//echo $i;
						
						/*						
							foreach($campos_detresponse['DOCUMENTONOTARIAL']['DOCUMENTO'] as $impe_det => $campos_detresponse2){
									
								//	$dato =	$campos_detresponse2['STATUS'];
								//	echo $dato;
								//	var_dump ($campos_detresponse2['STATUS']);
								//DOCUMENTO	
								if(is_array($campos_detresponse2['DOCUMENTO'])){
									echo'22';
								foreach($campos_detresponse2['DOCUMENTO'] as $impe_det => $campos_detresponse3){
									echo'www';
									//	print_r ($campos_detresponse3);
								}
								}
						}	
						var_dump ($campos_detresponse['DOCUMENTONOTARIAL']['STATUS']);*/
						//$i++;
					} 					
				}
			
		}
		echo "</ul>";
	
	}
	// actualizamos el estado de los envios el sisgen
	//consultamos los kardex enviados
	$sql_estadosisgen=mysql_query("SELECT s.kardex,(SELECT COUNT(m.kardex) FROM sisgen_mensaje m WHERE m.kardex=s.kardex )  AS cant_error FROM sisgen s WHERE 
                              STR_TO_DATE(s.fech_envio,'%Y/%m/%d') >= STR_TO_DATE('$fechini','%Y/%m/%d')
                              AND STR_TO_DATE(s.fech_envio,'%Y/%m/%d') <= STR_TO_DATE('$fechfin','%Y/%m/%d')", $conn) or die(mysql_error());

	 while($rowbb=mysql_fetch_array($sql_estadosisgen)){
		if($rowbb[1]>=1){
			$sql_sisgenupdate="UPDATE sisgen SET sisgen.estado=0 WHERE sisgen.kardex='".$rowbb[0]."'"; 
            mysql_query($sql_sisgenupdate,$conn) or die(mysql_error());
		}else{
			$sql_sisgenupdate="UPDATE sisgen SET sisgen.estado=1 WHERE sisgen.kardex='".$rowbb[0]."'"; 
            mysql_query($sql_sisgenupdate,$conn) or die(mysql_error());
		}
	 }
	 
	if($xmll2=="<status>OK"){
	
		
	$contenedorTXT=$response.$contenedorTXT;
	$nuevoarchivo = fopen("ArchivosEnviados\REPORTEENVIO_".date("d-m-Y H-i-s",time()).".xml", "w+");
	fwrite($nuevoarchivo,$contenedorTXT);
	fclose($nuevoarchivo);
	
	// echo "No se han detectado errores";
	
	}else{
	
	$contenedorTXT=$response.$contenedorTXT;
	$nuevoarchivo = fopen("erroresSISGEN.xml", "w+");
	fwrite($nuevoarchivo,$contenedorTXT);
	fclose($nuevoarchivo);
	
	$contenedorTXT=$response.$contenedorTXT;
	$nuevoarchivo = fopen("ArchivosEnviados\REPORTEENVIO_".date("d-m-Y H-i-s",time()).".xml", "w+");
	fwrite($nuevoarchivo,$contenedorTXT);
	fclose($nuevoarchivo);

	
	}


	if ($xmll2=='<status>INTERNAL_SERVER_ERROR') {

		echo "<span class='letraerror'> Error Interno XML </span><span class='letraerror'><a target='blank' href='erroresSISGEN.xml' download='erroresSisgen.xml'>(Ver Errores)</a></span>";

	}else{

	echo "Kardex Correctos ($guardado), Kardex Con Observaciones ($observado), Kardex con Errores ($fallido)";
	
	}
	//echo "</br>"
	

?>
