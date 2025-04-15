 <?php
include('conexion.php');
function quitar_sim($dato){
	$dato1=str_replace("?"," ",$dato);
    $dato2=str_replace("*"," ",$dato1);
    $dato3=str_replace("QQ11QQ"," ",$dato2);
	$dato4=str_replace("Ñ","N",$dato3);
	$dato5=str_replace("ñ","n",$dato4);
	$dato6=str_replace("°"," ",$dato5);
	$dato7=str_replace("#"," ",$dato6);
	$dato8=str_replace("é"," ",$dato7);
	$dato9=str_replace("á"," ",$dato8);
	$dato10=str_replace("í"," ",$dato9);
	$dato11=str_replace("ó"," ",$dato10);
	$dato12=str_replace("ú"," ",$dato11);
	$dato13=str_replace("'"," ",$dato12);
	$dato14=str_replace("&"," ",$dato13);
	$dato15=str_replace("É"," ",$dato14);
	$dato16=str_replace("Á"," ",$dato15);
	$dato17=str_replace("Ó"," ",$dato16);
	$dato18=str_replace("Ú"," ",$dato17);
	$dato19=str_replace("Í"," ",$dato18);
    $resultado=str_replace("QQ22KK"," ",$dato19); 
    return $resultado;	
}
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano=date('Y');

$archivo = "3520".$ano.$rowarchi['ruc'].".Otg";
header('Content-Type:text/plain'); // txt, html, etc
header('Content-Type: application/force-download');
header('Pragma:public');
header('Expires:0');
header('Cache-Control:no-cache,must-revalidate,post-check=0,pre-check=0');
header('Cache-Control:private,false');
header('Content-Disposition: attachment; filename='.$archivo);
header('Content-Transfer-Encoding: utf8'); 
 
//include($archivo);
$secuencial=0;


$sql = "SELECT * FROM temp_act";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {
	$acto_sunat=$row['actosunat'];
	$sqldetalle="select * from contratantesxacto where kardex='".$row['kardex']."' AND idtipoacto='".$row['tipoacto']."' AND (parte='2' OR parte='1')";
	$resultdet=mysql_query($sqldetalle,$conn);
	while($rowdet = mysql_fetch_array($resultdet)) {
     
        $sql2="select * from cliente2 where idcontratante='".$rowdet['idcontratante']."'"; 
		$result2=mysql_query($sql2,$conn); 
		$row2 = mysql_fetch_array($result2);
		
		$fecha=$row["fechaescritura"]; 
		$numdocus=$row2["numdoc"]; 
		if($numdocus!=''){
		$numdocu=$row2["numdoc"];
		$tipdocum=$row2["idtipdoc"];
		switch ($tipdocum) {
		case "1":
		$tipdocu="01";
		break;
		case "2":
		$tipdocu="04";	
		break;
		case "8":
		$tipdocu="06";
		break;
		case "5":
		$tipdocu="07";	
		break;
		case "9":
		$tipdocu="-";	
		break;								
	     }
		}else{
			$numdocu='';
			$tipdocu="-";
			}
		$tippersonas=$row2["tipper"];
		switch ($tippersonas) {
		case "N":
		$tippersona="1";
		break;
		case "J":
		$tippersona="2";	
		break;						
	     }
		
		
		//$tipdocu=$row2["idtipdoc"];
        	
			if ($row["idtipkar"]==1){
				$tipokardex='1';			
			}else{
				if ($row["idtipkar"]==3){
					$tipokardex='2';				
				}else{
					$tipokardex= $row["idtipkar"];
					}
				}

		 $numeroescritura=$row["numescritura"]; $secuacto=$row["secuencialacto"];  $secuencial=$secuencial+1;  

			if(stristr($rowdet["porcentaje"], '.') === FALSE){  
			  $porcentaje=$rowdet["porcentaje"].".00";			  
		  }else{
			  $porcentaje=$rowdet["porcentaje"];
			}
		   
		   $ubigeox=$row2["idubigeo"]; $razonsocial=substr($row2["razonsocial"],0,40); $apepat=substr($row2["apepat"],0,15); $apemat=substr($row2["apemat"],0,15);  $prinom=substr($row2["prinom"],0,15); $segnom=substr($row2["segnom"],0,30); $kardex=$row['kardex'];
		    
			if($ubigeox=='999999'){$ubigeo='';}else{$ubigeo=$ubigeox;}
		
		
		// tipo de otorgante 
		
		$sqlotor="select * from actocondicion where idcondicion='".$rowdet['idcondicion']."'";
	    $resulotot=mysql_query($sqlotor,$conn);
		$rowoto = mysql_fetch_array($resulotot);
		$tipootorgante=$rowoto['totorgante'];
		
		if($tipootorgante=='28'){
			$secubien=$row["secubien"];
		}else{
			$secubien="";
			}
		// preguntas
		
		$sqlrenta="select * from renta where idcontratante='".$rowdet['idcontratante']."' AND kardex='".$row['kardex']."'";
	    $resulrent=mysql_query($sqlrenta,$conn);
		$rowrenta = mysql_fetch_array($resulrent);
		
	
       if($acto_sunat=='24'){$pregunta1="";
					$pregunta2="";
					$pregunta3="";
					$idrenta="";}	
					
	   if($acto_sunat=='22' || $acto_sunat=='01' ){
			if($row2["tipper"]=='J' ){
					$pregunta1="";
					$pregunta2="";
					$pregunta3="";
					$idrenta="";
				   }
		     if($row2["tipper"]=='N'){
					  if($rowdet['parte']=='1'){
						 $pregunta1="0";
						  $pregunta2="0";
						  $pregunta3="1";
						  $idrenta=""; 
						 }
					  if($rowdet['parte']=='2'){
						   $pregunta1="";
						   $pregunta2="";
						   $pregunta3="";
						   $idrenta="";
						 }
			        }
			
		}
		
		if($acto_sunat=='04'|| $acto_sunat=='03'  ){
			if($row2["tipper"]=='J'){
				$pregunta1="";
				$pregunta2="";
				$pregunta3="";
		        $idrenta="";
			   }
			 if($row2["tipper"]=='N'){
				  if($rowdet['parte']=='1'){
				//aqui esta para colacar la fecha de adquis y poner condicion si es menor al 2004
					 
				    $sqladd = "SELECT * FROM detallebienes where kardex='".$row['kardex']."'";
					$resuladdt=mysql_query($sqladd,$conn);
					$rowadd = mysql_fetch_array($resuladdt);

						$fechaadd=explode("/", $rowadd['fechaconst']);
						$numfecha=$fechaadd[2].$fechaadd[1].$fechaadd[0];
						
						
						if($rowadd['fechaconst']!=""){
							if(intval($numfecha)<20040101){
								 $pregunta1="0";
								 $pregunta2="0";
								 $pregunta3="1";
								 $idrenta="";
								
								}
							if(intval($numfecha)>=20040101){
								$pregunta1=$rowrenta['pregu1'];
								 $pregunta2=$rowrenta['pregu2'];
								 $pregunta3=$rowrenta['pregu3'];
								 $idrenta=$rowrenta['idrenta'];
								 
								}
						}else{
							    $pregunta1="0";
								 $pregunta2="0";
								 $pregunta3="1";
								 $idrenta="";
								  
						}
						
						
						
					

				////////////////////////////////////////////////////////////////////////////////////
					 }
				  if($rowdet['parte']=='2'){
						 $pregunta1="";
				         $pregunta2="";
				         $pregunta3="";
				         $idrenta="";
					 }
				}
			
			}
		
		if($acto_sunat!='04' && $acto_sunat!='22' && $acto_sunat!='01' && $acto_sunat!='03' ){
			$pregunta1="";
			$pregunta2="";
			$pregunta3="";
			$idrenta="";
			
			}	
			
echo str_pad(substr(intval($tipokardex),0,1),1," ",STR_PAD_LEFT)."|".
str_pad(substr(intval($numeroescritura),0,5),5," ",STR_PAD_LEFT)."|".
str_pad(substr($fecha,0,10),10," ",STR_PAD_LEFT)."|".
str_pad(substr($secuacto,0,5),5," ",STR_PAD_RIGHT)."|".
str_pad(substr($secubien,0,5),5," ",STR_PAD_RIGHT)."|".
str_pad(substr($secuencial,0,5),5," ",STR_PAD_RIGHT)."|".
str_pad(substr($tipdocu,0,2),2," ",STR_PAD_RIGHT)."|".
str_pad(substr($numdocu,0,12),12," ",STR_PAD_RIGHT)."|".
str_pad(substr($tipootorgante,0,2),2," ",STR_PAD_RIGHT)."|".
str_pad(substr($tippersona,0,1),1," ",STR_PAD_RIGHT)."|".
str_pad(substr($ubigeo,0,6),6," ",STR_PAD_RIGHT)."|".
str_pad(substr($porcentaje,0,6),6," ",STR_PAD_RIGHT)."|".
str_pad(substr(quitar_sim($razonsocial),0,40),40," ",STR_PAD_RIGHT)."|".
str_pad(substr(quitar_sim($apepat),0,20),20," ",STR_PAD_RIGHT)."|".
str_pad(substr(quitar_sim($apemat),0,20),20," ",STR_PAD_RIGHT)."|".
str_pad(substr(quitar_sim($prinom),0,20),20," ",STR_PAD_RIGHT)."|".
str_pad(substr(quitar_sim($segnom),0,30),30," ",STR_PAD_RIGHT)."|".
str_pad($pregunta1,1," ",STR_PAD_RIGHT)."|".str_pad($pregunta2,1," ",STR_PAD_RIGHT)."|".
str_pad($pregunta3,1," ",STR_PAD_RIGHT)."|".chr(13).chr(10);
				

mysql_query("INSERT INTO temp_otg(idotg, idtipkar, numescritura, fechaescritura, secuencialacto, secubien, secuencialoto, tipodocu, numdocu, tipootorgante, tipper, ubigeo, porcentaje, razonsocial, apepat, apemat, prinom, segnom, pregu1, pregu2, pregu3, idrenta) VALUES (NULL,'$tipokardex','$numeroescritura','$fecha','$secuacto','$secubien','$secuencial','$tipdocu','$numdocu','$tipootorgante','$tippersona','$ubigeo','$porcentaje','$razonsocial','$apepat','$apemat','$prinom','$segnom','$pregunta1','$pregunta2','$pregunta3','$idrenta')",$conn); 
	
      }

}
mysql_free_result($result);
mysql_close($conn);

