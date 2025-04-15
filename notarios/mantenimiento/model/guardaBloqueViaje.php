<?php

require_once("../../includes/_ClsCon.php");
$_obj   = new _ClsCon()                    ;

$num_registros    = $_POST["num_registros"];
//$num_kinicial     = $_POST["num_kinicial"];
$fec_ingreso 	  = $_POST["fec_ingreso"];

				$spAsignaKardex = "CALL spAsignaNumero_viaje( '".$fec_ingreso."' ,  '".$num_registros."' );";	
				$_obj->_trans($spAsignaKardex);
?>