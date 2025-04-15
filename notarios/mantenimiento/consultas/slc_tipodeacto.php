	<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_kardex = $_REQUEST['id_kardex'];
	$opt = $_REQUEST['opt'];
	
	$sql_tipoacto = "SELECT
					 tiposdeacto.idtipoacto,
					 tiposdeacto.idtipkar,
					 tiposdeacto.desacto
					 FROM
					 tiposdeacto
					 WHERE
					 tiposdeacto.idtipkar =  '$id_kardex'
					 order by tiposdeacto.desacto asc";
	
	$exe_tipoacto = mysql_query($sql_tipoacto, $conexion);
	
    $i=0;

    while($tipoacto = mysql_fetch_array($exe_tipoacto)){ 
		$arr_tipacto[$i][0] = $tipoacto["idtipoacto"];
		$arr_tipacto[$i][1] = $tipoacto["desacto"];
		$i++; 
	}
	
	if($opt==1){ 
	
	?>
			
        <select id="n_tipact" name="n_tipact" style="width:197px;" class="Estilo7">
        <option value="0">--Tipo de Acto --</option>
        <?php
		for($i=0; $i<count($arr_tipacto); $i++){
		?>
        <option value="<?php echo $arr_tipacto[$i][0]; ?>"><?php echo $arr_tipacto[$i][1]; ?></option>
    
    	<?php
		}
        ?>
        </select> 
            
		
    <?php 
	} if($opt==2){ 

	?>
    
    	<select id="m_tipact" name="m_tipact" style="width:197px;" class="Estilo7">
        <?php
		for($i=0; $i<count($arr_tipacto); $i++){
		?>
        <option value="<?php echo $arr_tipacto[$i][0]; ?>"><?php echo $arr_tipacto[$i][1]; ?></option>
        <?php
		}
        ?>
    	</select> 
    
    <?php 
	} ?>
	