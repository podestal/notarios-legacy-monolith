	<?php
	include('../../conexion.php');

	$id_poder        = $_POST["id_poder"];
	$p_crono         = $_POST["p_crono"];
	$p_fecha         = $_POST["p_fecha"];
	$p_numformu      = $_POST["p_numformu"];
	$p_domicilio     = $_POST["p_domicilio"];
	$p_pension       = $_POST["p_pension"];
	$p_mespension    = $_POST["p_mespension"];
	$p_anopension    = $_POST["p_anopension"];
	$p_plazopoder    = $_POST["p_plazopoder"];
	$p_fecotor       = $_POST["p_fecotor"];
	$p_fecvcto       = $_POST["p_fecvcto"];
	$p_presauto      = $_POST["p_presauto"];
	$p_observ        = $_POST["p_observ"];


	$consulpoderes = mysql_query("SELECT * FROM poderes_pension WHERE poderes_pension.id_poder='$id_poder'", $conn) or die(mysql_error());
	$rowpoderes = mysql_fetch_array($consulpoderes);
	
	$select_id_poder = $rowpoderes['id_poder'];
	
	if($select_id_poder == '')
	{
		## id_pension = autogenerado
		$savepensionpoder = "INSERT INTO poderes_pension(id_poder, id_pension, p_crono, p_fecha, p_numformu, p_domicilio, p_pension, p_mespension, p_anopension,
p_plazopoder, p_fecotor, p_fecvcto, p_presauto, p_observ) VALUES ('$id_poder', NULL, '$p_crono', '$p_fecha', '$p_numformu', '$p_domicilio', '$p_pension', '$p_mespension', '$p_anopension', '$p_plazopoder', '$p_fecotor', '$p_fecvcto', '$p_presauto', '$p_observ') ";

	mysql_query($savepensionpoder, $conn) or die(mysql_error());
	}
		else if($select_id_poder != '')
		{
			/*
			p_pension
			p_plazopoder
			p_fecotor
			p_fecvcto
			p_presauto
		
		*/	
			$editpensionpoder = "UPDATE poderes_pension SET p_pension = '$p_pension', p_plazopoder = '$p_plazopoder' , p_fecotor = '$p_fecotor', p_fecvcto = '$p_fecvcto', p_presauto = '$p_presauto' WHERE id_poder = '$id_poder' ";
			mysql_query($editpensionpoder, $conn) or die(mysql_error());		
		
		}
	
	mysql_close($conn);
	?>
