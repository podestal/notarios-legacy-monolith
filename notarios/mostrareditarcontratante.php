<style type="text/css">
<!--
.edititu {
	font-family: Calibri;
	font-weight: bold;
	font-size: 14px;
	font-style: italic;
}
.editcam2 {font-family: Calibri; font-style: italic; font-size: 12px; }
.editcam {font-family: Calibri; font-style: italic; font-size: 12px; font-weight: bold; }
-->
</style>

<?php 
include('conexion.php');
$idcontra=$_POST['idcontra'];
$codkardex=$_POST['codkardex'];

$consul=mysql_query("Select * from cliente2 where idcontratante='$idcontra' ", $conn) or die(mysql_error());
$row2 = mysql_fetch_array($consul);

$consule=mysql_query("Select * from contratantes where idcontratante='$idcontra' ", $conn) or die(mysql_error());
$rowe2 = mysql_fetch_array($consule);

echo"<table width='650' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td colspan='2'><span class='edititu'>";if($row2['tipper']=="N") {
		 
    $nomyape= strtoupper($row2['apepat']." ".$row2['apemat'].", ".$row2['prinom']." ".$row2['segnom']);
	$textorefe=str_replace("?","'",$nomyape);
	$textoampers=str_replace("*","&",$textorefe);
	$textoamperss=str_replace("ñ","Ñ",$textoampers);
		 
		 echo strtoupper($textoamperss)." <a onclick='editcontratante2()'><img src='iconos/editacontratantes3.png' width='19' height='19' border='0' /></a><input name='coddcontrata2' type='hidden' value='".$idcontra."' /> "; 
		 
		 
		 }else { 
		 
		 $empresita=strtoupper($row2['razonsocial']);
	         $textorefe=str_replace("?","'",$empresita);
						  $textoampers=str_replace("*","&",$textorefe);
						  $textoamperss=str_replace("ñ","Ñ",$textoampers);
						  echo strtoupper($textoamperss)." <a onclick='editcontratanteemp()'><img src='iconos/editacontratantes3.png' width='19' height='19' border='0' /></a><input name='coddcontrata2' type='hidden' value='".$idcontra."' /> ";
		 
		 
		  } 
		  
		  
		  echo"</span><input name='codconn' type='hidden' value='".$rowe2['condicion']."'><input name='firmaa' type='hidden' value='".$rowe2['firma']."'><input name='indice2' type='hidden' value='".$rowe2['indice']."'><input name='repre2' type='hidden' value='".$rowe2['tiporepresentacion']."'><input name='representaa2' type='hidden' value='".$rowe2['idcontratanterp']."'><br>Representa a: "; if($rowe2['idcontratanterp']!=""){$numero=$rowe2['idcontratanterp'];
$cantidad= strlen($numero);
$suma=$numero;
 switch ($cantidad) {
	case "1":
	$ncontratante="000000000".$suma;
	break;
	case "2":
	$ncontratante="00000000".$suma;	
	break;
	case "3":
	$ncontratante="0000000".$suma;
	break;
	case "4":
	$ncontratante="000000".$suma;	
	break;
	case "5":
	$ncontratante="00000".$suma;
	break;
	case "6":
	$ncontratante="0000".$suma;	
	break;		
	case "7":
	$ncontratante="000".$suma;	
	break;	
	case "8":
	$ncontratante="00".$suma;	
	break;	
	case "9":
	$ncontratante="0".$suma;	
	break;
	case "10":
	$ncontratante=$suma;	
	break;			
}
$consulf=mysql_query("Select * from cliente2 where idcontratante='$ncontratante' ", $conn) or die(mysql_error());
$row2f = mysql_fetch_array($consulf);
if($row2f['tipper']=="N") { 
 
$nomyape1= strtoupper($row2f['apepat']." ".$row2f['apemat'].", ".$row2f['prinom']." ".$row2f['segnom']);
	$textorefe1=str_replace("?","'",$nomyape1);
	$textoampers1=str_replace("*","&",$textorefe1);
	$textoamperss1=str_replace("ñ","Ñ",$textoampers1); 
		 
		 echo strtoupper($textoamperss1);
}else { 
 
 $nomyape1= strtoupper($row2f['razonsocial']);
	$textorefe1=str_replace("?","'",$nomyape1);
	$textoampers1=str_replace("*","&",$textorefe1);
	$textoamperss1=str_replace("ñ","Ñ",$textoampers1); 
		 
		 echo strtoupper($textoamperss1);
  }

} echo"</td></tr>
  <tr>
	 <td height='30'><span class='editcam'>";if($rowe2['firma']=="1"){echo"<input name='fir' type='checkbox' id='fir' onClick='mostrarfirma2(this.checked, this.value)' value='1' checked='checked' />";}else{if($rowe2['firma']=="0"){echo"<input name='fir' type='checkbox' id='fir' onClick='mostrarfirma3(this.checked, this.value)' value='0' />";}} echo"Firma</span></td>
	 <td height='30'><span class='editcam'>";if($rowe2['indice']=="1"){echo"<input name='indi' type='checkbox' id='indi' onClick='mostrarindice2(this.checked, this.value)' value='1' checked='checked' />";}else{if($rowe2['indice']=="0"){echo"<input name='indi' type='checkbox' id='indi' onClick='mostrarindice3(this.checked, this.value)' value='0' />";}} echo"Indice</span></td>
  </tr>
  <tr><td colspan='2' height='40'>"; if($rowe2['tiporepresentacion']=="0")
  {echo "<table width='589' border='0' cellspacing='0' cellpadding='0'>
             <tr>
            <td width='149'>
<input name='radio' type='radio' id='radio' value='0' checked onclick='buttonsc(0)' />            
<span class='camposss'>Derecho Propio</span></td>
            <td width='161'><input type='radio' name='radio' id='radio2' value='1' onclick='buttons23c(1)' />
              <span class='camposss'>Representante</span>
           <div id='representantee' class='representante' style='display:none; z-index:2;' >
                  <table width='604' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='201' height='29' class='style30'><table width='196' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td width='16'>&nbsp;</td>
                          <td width='180'><span class='titulomenuacto'>Contratantes</span></td>
                        </tr>
                      </table></td>
                      <td width='403' align='right' valign='middle'><a  onclick='cerrardiv()'><img src='iconos/cerrar.png' width='21' height='20' border='0' /></a></td>
                    </tr>
                    <tr>
                     <td height='25' colspan='2'><table width='600' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td width='72'><span class='titulomenuacto'>Facultadesa:</span></td>
                          <td width='293'><label>
                            <input name='facultadess' type='text' id='facultadess' value='".$rowe2['facultades']."' style='text-transform:uppercase;' size='60' />
                          </label></td>
                          <td width='63'><span class='titulomenuacto'>Inscrito:</span></td>
                          <td width='172'><select name='inscrito' id='inscrito'>
                          <option selected='selected' value='0'></option>";
						  if($rowe2['inscrito']=='1'){
                            echo"<option selected='selected' value='1'>SI</option>";
                            echo"<option value='0'>NO</option>";
							}else{
								echo"<option  value='1'>SI</option>";
                            echo"<option selected='selected' value='0'>NO</option>";
								
								}
                          echo"</select></td>
                      
                       </tr>
                       <tr>
                          <td height='8' colspan='4'><div id='verinscrit' style='display:;'>
                            <table width='584' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='102'><span class='titulomenuacto'>Sede Registral:</span></td>
                                <td width='171'><select name='idsederegerp' id='idsederegerp'>";
					  
								$sqlregrp2=mysql_query('SELECT * FROM sedesregistrales where idsedereg="'.$rowe2['idsedereg'].'"',$conn) or die(mysql_error()); 
                                $rowsederegrp2 = mysql_fetch_array($sqlregrp2);
                          echo"<option selected='selected' value='".$rowsederegrp2['idsedereg']."'>".$rowsederegrp2['dessede']."</option>";
                       
                           $sqlregrp=mysql_query('SELECT * FROM sedesregistrales',$conn) or die(mysql_error()); 
                           while($rowsederegrp = mysql_fetch_array($sqlregrp)){
                             echo '<option value='.$rowsederegrp['idsedereg'].'>'.$rowsederegrp['dessede'].'</option> \n';
                             }
                         
                     echo"</select>
      </td>
                                <td width='70'><span class='titulomenuacto'>N° Partida:</span></td>
                                <td width='241'>
                                <input name='nparti' type='text' id='nparti' size='10' value='".$rowe2['numpartida']."' style='text-transform:uppercase;' maxlength='15'></td>
                              </tr>
                            </table>
                          </div></td>
                       </tr>
                       <tr>
                     <td height='25' colspan='4'><div id='contratanc' class='allcontrata'></div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan='2' align='center' valign='middle'></td>
                    </tr>
                  </table>
                </div></td>
            <td width='307'><input type='radio' name='radio' id='radio3' value='2' onclick='buttons23c(2)' />
            <span class='camposss'>Por Derecho Propio y Representación</span></td>
  </tr>
        </table>";}else{if($rowe2['tiporepresentacion']=="1"){
			echo "<table width='589' border='0' cellspacing='0' cellpadding='0'>
<tr>
            <td width='149'>
<input name='radio' type='radio' id='radio' value='0'  onclick='buttonsc(0)' />            
<span class='camposss'>Derecho Propio</span></td>
            <td width='161'><input type='radio' name='radio' id='radio2' value='1' checked onclick='buttons23c(1)' />
              <span class='camposss'>Representante</span>
               <div id='representantee' class='representante' style='display:none; z-index:2;' >
                  <table width='604' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='201' height='29' class='style30'><table width='196' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td width='16'>&nbsp;</td>
                          <td width='180'><span class='titulomenuacto'>Contratantes</span></td>
                        </tr>
                      </table></td>
                      <td width='403' align='right' valign='middle'><a href='#' onclick='cerrardiv()'><img src='iconos/cerrar.png' width='21' height='20' border='0' /></a></td>
                    </tr>
                    <tr>
                     <td height='25' colspan='2'><table width='600' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td width='72'><span class='titulomenuacto'>Facultades:</span></td>
                          <td width='72'><label>
                            <input name='facultadess' type='text' id='facultadess' value='".$rowe2['facultades']."' style='text-transform:uppercase;' size='40' />
                          </label></td>
						  
                          <td width='63'><span class='titulomenuacto'>Inscrito:</span></td>
                          <td width='172'><select name='inscrito' id='inscrito' >";
						  if($rowe2['inscrito']=='1'){
                            echo"<option selected='selected' value='1'>SI</option>";
                            echo"<option value='0'>NO</option>";
							}else{
								echo"<option  value='1'>SI</option>";
                            echo"<option selected='selected' value='0'>NO</option>";
								
								}
                          echo"</select></td>
                 
            </tr>
                       <tr>
                          <td height='8' colspan='4'><div id='verinscrit' style='display:;'>
                            <table width='584' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='102'><span class='titulomenuacto'>Sede Registral:</span></td>
                                <td width='171'>
								<select name='idsederegerp' id='idsederegerp'>";
								$sqlregrp2=mysql_query('SELECT * FROM sedesregistrales where idsedereg="'.$rowe2['idsedereg'].'"',$conn) or die(mysql_error()); 
                                $rowsederegrp2 = mysql_fetch_array($sqlregrp2);
                          echo"<option selected='selected' value='".$rowsederegrp2['idsedereg']."'>".$rowsederegrp2['dessede']."</option>";
                     
                           $sqlregrp=mysql_query('SELECT * FROM sedesregistrales',$conn) or die(mysql_error()); 
                           while($rowsederegrp = mysql_fetch_array($sqlregrp)){
                             echo '<option value='.$rowsederegrp['idsedereg'].'>'.$rowsederegrp['dessede'].'</option> \n';
                             }
                        
                      echo"</select>
      </td>
                                <td width='70'><span class='titulomenuacto'>N° Partida:</span></td>
                                <td width='241'>
                                <input name='nparti' type='text' id='nparti' size='10' value='".$rowe2['numpartida']."' style='text-transform:uppercase;' maxlength='15'></td>
                              </tr>
                            </table>
                          </div></td>
                       </tr>
                       <tr>
                     <td height='25' colspan='4'><div id='contratanc' class='allcontrata'></div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan='2' align='center' valign='middle'></td>
                    </tr>
                  </table>
                </div></td>
            <td width='307'><input type='radio' name='radio' id='radio3' value='2' onclick='buttons23c(2)' />
            <span class='camposss'>Por Derecho Propio y Representación</span></td>
  </tr>
        </table>";}else{if($rowe2['tiporepresentacion']=="2"){echo "<table width='589' border='0' cellspacing='0' cellpadding='0'>
<tr>
            <td width='149'>
<input name='radio' type='radio' id='radio' value='0'  onclick='buttonsc(0)' />            
<span class='camposss'>Derecho Propio</span></td>
            <td width='161'><input type='radio' name='radio' id='radio2' value='1' onclick='buttons23c(1)' />
              <span class='camposss'>Representante</span>
               <div id='representantee' class='representante' style='display:none; z-index:2;' >
                  <table width='604' border='0' align='center' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='201' height='29' class='style30'><table width='196' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td width='16'>&nbsp;</td>
                          <td width='180'><span class='titulomenuacto'>Contratantes</span></td>
                        </tr>
                      </table></td>
                      <td width='403' align='right' valign='middle'><a href='#' onclick='cerrardiv()'><img src='iconos/cerrar.png' width='21' height='20' border='0' /></a></td>
                    </tr>
                    <tr>
                     <td height='25' colspan='2'><table width='600' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td width='72'><span class='titulomenuacto'>Facultadesc:</span></td>
                          <td width='293'><label>
                            <input name='facultadess' type='text' id='facultadess' style='text-transform:uppercase;' value='".$rowe2['facultades']."' size='40' />
                          </label></td>
                          <td width='63'><span class='titulomenuacto'>Inscrito:</span></td>
                          <td width='172'><select name='inscrito' id='inscrito' >";
						  if($rowe2['inscrito']=='1'){
                            echo"<option selected='selected' value='1'>SI</option>";
                            echo"<option value='0'>NO</option>";
							}else{
								echo"<option  value='1'>SI</option>";
                            echo"<option selected='selected' value='0'>NO</option>";
								
								}
                          echo"</select></td>
                      
                       </tr>
                       <tr>
                          <td height='8' colspan='4'><div id='verinscrit' style='display:;'>
                            <table width='584' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td width='102'><span class='titulomenuacto'>Sede Registral:</span></td>
                                <td width='171'><select name='idsederegerp' id='idsederegerp'>";
                        
						$sqlregrp2=mysql_query('SELECT * FROM sedesregistrales where idsedereg="'.$rowe2['idsedereg'].'"',$conn) or die(mysql_error()); 
                                $rowsederegrp2 = mysql_fetch_array($sqlregrp2);
                          echo"<option selected='selected' value='".$rowsederegrp2['idsedereg']."'>".$rowsederegrp2['dessede']."</option>";
						
                           $sqlregrp=mysql_query('SELECT * FROM sedesregistrales',$conn) or die(mysql_error()); 
                           while($rowsederegrp = mysql_fetch_array($sqlregrp)){
                             echo '<option value='.$rowsederegrp['idsedereg'].'>'.$rowsederegrp['dessede'].'</option> \n';
                             }
                         echo"
                      </select>
      </td>
                                <td width='70'><span class='titulomenuacto'>N° Partida:</span></td>
                                <td width='241'>
                                <input name='nparti' type='text' id='nparti' value='".$rowe2['numpartida']."' size='10' maxlength='15'></td>
                              </tr>
                            </table>
                          </div></td>
                       </tr>
                       <tr>
                     <td height='25' colspan='4'><div id='contratanc' class='allcontrata'></div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan='2' align='center' valign='middle'></td>
                    </tr>
                  </table>
                </div></td>
            <td width='307'><input type='radio' name='radio' id='radio3' value='2' checked onclick='buttons23c(2)' />
            <span class='camposss'>Por Derecho Propio y Representación</span></td>
  </tr>
        </table>";}}} echo"</td></tr>
  <tr><td colspan='2'>"; $consulta = mysql_query("SELECT * from  detalle_actos_kardex where kardex='$codkardex'", $conn) or die(mysql_error());
		 while($row = mysql_fetch_array($consulta)){
  
        echo"<table width='325' border='0' cellspacing='0' cellpadding='0'>
			  <tr>
				<td><span class='editcam'>"; 
				$consulact=mysql_query("Select * from tiposdeacto where idtipoacto='".$row['idtipoacto']."' ", $conn) or die(mysql_error());
				$rowact = mysql_fetch_array($consulact); 
				echo $rowact['desacto'];echo"</span></td>
			  </tr>
			  <tr>
				<td><span class='editcam2'>"; 
		        $condiciones=explode("/",$rowe2['condicion']);
				$condi1=$condiciones[0];
				$condi2=$condiciones[1];
				$condi3=$condiciones[2];
				$condi4=$condiciones[3];
				$condi5=$condiciones[4];
				$condi6=$condiciones[5];
				$condi7=$condiciones[6];
				$condi8=$condiciones[7];
				$condi9=$condiciones[8];
				$condi10=$condiciones[9];
				
				
				$ressepa=explode(".",$condi1);
				$codcondi=$ressepa[0]; $item0=$ressepa[1];
				
				$ressepa1=explode(".",$condi2);
				$codcondi1=$ressepa1[0]; $item1=$ressepa1[1];
				
				$ressepa2=explode(".",$condi3);
				$codcondi2=$ressepa2[0]; $item2=$ressepa2[1];
				
				$ressepa3=explode(".",$condi4);
				$codcondi3=$ressepa3[0]; $item3=$ressepa3[1];
				
				$ressepa4=explode(".",$condi5);
				$codcondi4=$ressepa4[0]; $item4=$ressepa4[1];
				
				$ressepa5=explode(".",$condi6);
				$codcondi5=$ressepa5[0]; $item5=$ressepa5[1];
				
				$ressepa6=explode(".",$condi7);
				$codcondi6=$ressepa6[0]; $item6=$ressepa6[1];
				
				$ressepa7=explode(".",$condi8);
				$codcondi7=$ressepa7[0]; $item7=$ressepa7[1];
				
				$ressepa8=explode(".",$condi9);
				$codcondi8=$ressepa8[0]; $item8=$ressepa8[1];
				
				$ressepa9=explode(".",$condi10);
				$codcondi9=$ressepa9[0]; $item9=$ressepa9[1];
				
				$condicionesss = array($codcondi,$codcondi1,$codcondi2,$codcondi3,$codcondi4,$codcondi5,$codcondi6,$codcondi7,$codcondi8,$codcondi9);
				$itemsss= array($item0,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9);
				
				$consulta2n=mysql_query("Select * from actocondicion where idtipoacto = '".$row['idtipoacto']."' ", $conn) or die(mysql_error());
					
		while($row2n=mysql_fetch_array($consulta2n)){
					  
					 if($row2n['idcondicion']==$condicionesss[0] && $row['item']==$itemsss[0] ){
						  
						  echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";		  
				      }else{ 
						  if($row2n['idcondicion']==$condicionesss[1]  && $row['item']==$itemsss[1]){
					echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
							  }else{
								  if($row2n['idcondicion']==$condicionesss[2]  && $row['item']==$itemsss[2]){
					echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
							      }else{
								      if($row2n['idcondicion']==$condicionesss[3]  && $row['item']==$itemsss[3]){
									echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
											  }else{
								                   if($row2n['idcondicion']==$condicionesss[4]  && $row['item']==$itemsss[4]){
													echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
															  }else{
																
																if($row2n['idcondicion']==$condicionesss[5]  && $row['item']==$itemsss[5]){
																	echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
																			  }else{
																				  if($row2n['idcondicion']==$condicionesss[6]  && $row['item']==$itemsss[6]){
																					echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
																							  }else{
																								  if($row2n['idcondicion']==$condicionesss[7]  && $row['item']==$itemsss[7]){
																						echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
																								  }else{
																									  if($row2n['idcondicion']==$condicionesss[8]  && $row['item']==$itemsss[8]){
																										echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
																												  }else{
																													  if($row2n['idcondicion']==$condicionesss[9]  && $row['item']==$itemsss[9]){
																															echo "<input type='checkbox' checked='checked' name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>";
																																	  }else{
																																		 echo "<input type='checkbox'  name='".$row2n['idcondicion']."' id='".$row['item']."' value='".$row2n['idcondicion']."' onClick='mostrarcon(this.checked, this.name, this.id)'>".$row2n['condicion']."<br>"; 
																																		  
																																		  }
																													  
																													  }
																									  
																									  }
																								  
																								  }
																				  
																				  }  
																  
																  }
																  
								                 }
								  
								     }
								  
								  }
					 }
			 }
				  
				echo"</span></td>
			  </tr>
			  
			</table>"; 
         }
  
  echo"</td></tr>
  <tr><td><a onclick='grabareditarcontratante()'><img src='iconos/grabar.png' width='94' height='29' border='0' /></a></td></tr>
</table>";



?>