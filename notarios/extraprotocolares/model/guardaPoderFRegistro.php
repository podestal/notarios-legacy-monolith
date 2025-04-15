	<?php
	include('../../conexion.php');
	
	$id_poder        = $_POST["id_poder"];
	$id_fuerareg     = $_POST["id_fuerareg"];
	$f_crono         = $_POST["f_crono"];
	$f_fecha         = $_POST["f_fecha"];
	$f_numformu      = $_POST["f_numformu"];
	$id_tipo         = $_POST["id_tipo"];
	
	$f_plazopoder    = $_POST["f_plazopoder"];
	$f_fecotor       = $_POST["f_fecotor"];
	$f_fecvcto       = $_POST["f_fecvcto"];
	$f_presauto      = $_POST["f_presauto"];
	$f_observ        = $_POST["f_observ"];
	$f_solicita      = $_POST["f_solicita"];
	
## id_essalud = autogenerado
	$consulpoderes = mysql_query("SELECT * FROM poderes_fuerareg WHERE poderes_fuerareg.id_poder='$id_poder'", $conn) or die(mysql_error());
	$rowpoderes = mysql_fetch_array($consulpoderes);
	
	$select_id_poder = $rowpoderes['id_poder'];

	if($select_id_poder == '')
		{
			
	$saveFRegidtroPoder = "INSERT INTO poderes_fuerareg(id_poder, id_fuerareg, id_tipo, f_fecha, f_plazopoder, f_fecotor, f_fecvcto, f_solicita, f_observ) VALUES('$id_poder', NULL, '$id_tipo', '$f_fecha', '$f_plazopoder', '$f_fecotor', '$f_fecvcto', '$f_solicita', '$f_observ')";
	mysql_query($saveFRegidtroPoder, $conn) or die(mysql_error());
	
		}
	else if($select_id_poder != '')
		{
		/*
			  
			   
			   
			
			 
		*/	
			$editFRegistropoder = "UPDATE poderes_fuerareg SET id_tipo = '$id_tipo', f_plazopoder = '$f_plazopoder' , f_fecotor = '$f_fecotor', f_fecvcto = '$f_fecvcto', f_solicita = '$f_solicita', f_observ = '$f_observ' WHERE id_poder = '$id_poder' ";
			mysql_query($editFRegistropoder, $conn) or die(mysql_error());		
		
		}	
	
	
	mysql_close($conn);
	
	?>








