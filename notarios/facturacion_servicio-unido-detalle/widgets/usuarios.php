<?php
	session_start();
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();

    $consulta_usuarios =   "SELECT
u.idusuario AS cod,
u.loginusuario AS id,
UPPER(CONCAT(u.apepat,' ',u.apemat, ', ',u.prinom)) AS des,
u.idusuario
FROM usuarios u, permisos_usuarios pu
WHERE u.idusuario=pu.idusuario AND emicompro='1'";
		
	$ejecuta_usuarios = mysql_query($consulta_usuarios, $conexion);
		
	$i=0;

	while($usuarios = mysql_fetch_array($ejecuta_usuarios, MYSQL_ASSOC))
	{
		$arr_usuarios[$i][0] = $usuarios["id"]; 
		$arr_usuarios[$i][1] = $usuarios["des"];
		$arr_usuarios[$i][2] = $usuarios["cod"]; 
		$i++; 
	}
	?>
    
	<select style='width:185px;' class='camposss' name="slc_usuario" id="slc_usuario">
		 <option>--Atendido por--</option>
          
         <?php for($j=0;$j<count($arr_usuarios); $j++){ ?>
		 <option value='<?php echo $arr_usuarios[$j][2]; ?>'
         
      
         ><?php echo $arr_usuarios[$j][1]." (".$arr_usuarios[$j][2].")";  ?></option> 
         <?php }?>
        
	</select>
	
	
