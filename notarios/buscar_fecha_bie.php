<?php
$sqladd = "SELECT * FROM temp_bie where kardex='".$row['kardex']."'";
					$resuladdt=mysql_query($sqladd,$conn);
					$rowadd = mysql_fetch_array($resuladdt);

if(!empty($rowadd)){
						
						
						$fechaadd=explode("/", $rowadd['fechaadd']);
						$numfecha=intval($fechaadd[2].$fechaadd[1].$fechaadd[0]);
						$fechalim=20140101;
						if($rowadd['fechaadd']!=""){
							if($numfecha<$fechalim){
								 $pregunta1="0";
								 $pregunta2="0";
								 $pregunta3="1";
								 $idrenta="";
								}
							if($numfecha>=$fechalim){
								$pregunta1=$rowrenta['pregu1'];
								 $pregunta2=$rowrenta['pregu2'];
								 $pregunta3=$rowrenta['pregu3'];
								 $idrenta=$rowrenta['idrenta'];
								}
							}
						if($rowadd['fechaadd']==""){
							$pregunta1=$rowrenta['pregu1'];
							 $pregunta2=$rowrenta['pregu2'];
							 $pregunta3=$rowrenta['pregu3'];
							 $idrenta=$rowrenta['idrenta'];
							
							}
						}
						
					if(empty($rowadd)){
					
					 $pregunta1=$rowrenta['pregu1'];
				     $pregunta2=$rowrenta['pregu2'];
				     $pregunta3=$rowrenta['pregu3'];
				     $idrenta=$rowrenta['idrenta'];
						
						}
						
						?>