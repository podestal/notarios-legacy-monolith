	<?php
	include('../../conexion.php');	
	
	$id_poder        = $_POST["id_poder"];
	$e_crono         = $_POST["e_crono"];
	$e_fecha         = $_POST["e_fecha"];
	$e_numformu      = $_POST["e_numformu"];
	$e_domicilio     = $_POST["e_domicilio"];
	$e_montosep      = $_POST["e_montosep"];
	$e_montomater    = $_POST["e_montomater"];
	$e_montolact     = $_POST["e_montolact"];
	$e_montototal    = $_POST["e_montototal"];
	$e_plazopoder    = $_POST["e_plazopoder"];
	$e_fecotor       = $_POST["e_fecotor"];
	$e_fecvcto       = $_POST["e_fecvcto"];
	$e_presauto      = $_POST["e_presauto"];
	$e_monto         = $_POST["e_monto"];


	$consulpoderes = mysql_query("SELECT * FROM poderes_essalud WHERE poderes_essalud.id_poder='$id_poder'", $conn) or die(mysql_error());
	$rowpoderes = mysql_fetch_array($consulpoderes);
	
	$select_id_poder = $rowpoderes['id_poder'];
	
	if($select_id_poder == '')
		{
			## id_essalud = autogenerado
			$saveEssaludpoder = "INSERT INTO poderes_essalud(id_poder, id_essalud, e_crono, e_fecha, e_numformu, e_domicilio, e_montosep, e_montomater, e_montolact,
e_montototal, e_plazopoder, e_fecotor, e_fecvcto, e_presauto, e_monto) VALUES('$id_poder', NULL, '$e_crono', '$e_fecha', '$e_numformu', '$e_domicilio', '$e_montosep', '$e_montomater', '$e_montolact', '$e_montototal', '$e_plazopoder', '$e_fecotor', '$e_fecvcto', '$e_presauto', '$e_monto')";

			mysql_query($saveEssaludpoder, $conn) or die(mysql_error());
		}
		else if($select_id_poder != '')
		{
		/*
			e_montosep
			e_montomater
			e_montolact
			e_plazopoder
			e_fecotor
			e_fecvcto
			e_presauto
			e_monto
		*/	
			$editEssaludpoder = "UPDATE poderes_essalud SET e_montosep = '$e_montosep', e_montomater = '$e_montomater' , e_montolact = '$e_montolact', e_plazopoder = '$e_plazopoder', e_fecotor = '$e_fecotor', e_fecvcto = '$e_fecvcto', e_presauto = '$e_presauto', e_monto = '$e_monto' WHERE id_poder = '$id_poder' ";
			mysql_query($editEssaludpoder, $conn) or die(mysql_error());		
		
		}
		
	mysql_close($conn);
	?>
