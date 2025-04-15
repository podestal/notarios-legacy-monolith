<?php
require("../../includes/_ClsCon.php");

$fec_desde  = $_REQUEST["fec_desde"];
$fec_hasta  = $_REQUEST["fec_hasta"];
$nom        = $_REQUEST["nom"];

$nomarchivo = $nom;
$obj = new _ClsCon();

$data = $obj->_rs("CALL ExportaRO_txt('".$fec_desde."', '".$fec_hasta."','');");

#Se escoge el disco
$disk = "C:/";
#Se escoge la carpeta base
$mainfile = "RO/";

$ruta    = $disk.$mainfile;
$archivo = $nomarchivo;//.".txt"; 
fopen($ruta.$archivo, 'w+'); 
$fp      = fopen($ruta.$archivo, 'w+'); 
		
			## CABECERA DEL DOCUMENTO:
			//$cab  = $data->fetch_array(MYSQL_BOTH);			
			
			//CREAR CABECERA:
			#=============================
			# 050104     20130831012               00000999900000009999
			$cabecera = ""; // DATOS DEL OFICIAL DE CUMPLIMIENTO, FECHA, ETC.
			
			#=============================
			fwrite($fp,$cabecera);
			fwrite($fp , chr(13).chr(10));
			
			## DETALLE DEL DOCUMENTO
			while($var  = $data->fetch_array(MYSQL_BOTH))
			{
				
				#=============================
	
				#=============================							  NOMBRE                |  TIPO UIF
				$detalle = str_pad($var[0] ,'8'," ",STR_PAD_LEFT).		# cdg_fil				|	N
						   str_pad($var[1] ,'8'," ",STR_PAD_LEFT).		# num_reg_ope_			|	N
						   str_pad($var[2] ,'1'," ",STR_PAD_LEFT).		# tipo_envio			|	C
						   str_pad($var[3] ,'2'," ").					# ipnp_tipo				|	C
						   str_pad($var[4] ,'6'," ",STR_PAD_LEFT).		# ipnp_numero			|	N
						   str_pad($var[5] ,'8'," ").					# ipnp_fecha			|	DATE
						   str_pad($var[6] ,'6'," ",STR_PAD_LEFT).		# ipnp_num_acla			|	N
						   str_pad($var[7] ,'8'," ",STR_PAD_LEFT).		# ipnp_fec_acla			|	DATE
						   str_pad($var[8] ,'1'," ",STR_PAD_LEFT).		# ipnp_conclu			|	C
						   str_pad($var[9] ,'8'," ",STR_PAD_LEFT).		# ipnp_fec_firma		|	DATE
						   str_pad($var[10],'1'," ",STR_PAD_LEFT).		# mod_operacion			|	C
						   str_pad($var[11],'4'," ",STR_PAD_LEFT).		# can_operaciones		|	N
						   str_pad($var[12],'1'," ",STR_PAD_LEFT).		# par_repre				|	C
						   str_pad($var[13],'1'," ",STR_PAD_LEFT).		# par_ordenante			|	C
						   str_pad($var[14],'1'," ",STR_PAD_LEFT).		# par_benef				|	C
					       str_pad($var[15],'1'," ",STR_PAD_LEFT).		# par_rep_a				|	C
						   str_pad($var[16],'1'," ",STR_PAD_LEFT).		# par_tip_rep			|	C
						   str_pad($var[17],'1'," ",STR_PAD_LEFT).		# residencia			|	C
						   str_pad($var[18],'1'," ",STR_PAD_LEFT).		# tip_persona			|	C
						   str_pad($var[19],'1'," ",STR_PAD_LEFT).		# doc_tipo				|	C
						   str_pad($var[20],'20'," ").					# doc_numero			|	C
						   str_pad($var[21],'11'," ").					# ruc					|	N
						   str_pad($var[22],'120'," ").					# per_pater_razon		|	C
						   str_pad($var[23],'40'," ").					# per_mater				|	C
						   str_pad($var[24],'40'," ").	    			# per_nombres			|	C
						   str_pad($var[25],'2'," ",STR_PAD_LEFT).		# nacionalidad			|	C
						   str_pad($var[26],'8'," ",STR_PAD_LEFT).		# fec_nac				|	DATE
						   str_pad($var[27],'1'," ",STR_PAD_LEFT).		# est_civil				|	C
						   str_pad($var[28],'3'," ",STR_PAD_LEFT).		# cod_ocupac			|	C
						   str_pad($var[29],'40'," ",STR_PAD_LEFT).		# objeto_soc			|	C
				           str_pad($var[30],'4'," ").					# cod_ciiu				|	C
						   str_pad($var[31],'3'," ",STR_PAD_LEFT).		# cod_cargo				|	C
						   str_pad($var[32],'2'," ",STR_PAD_LEFT).		# cod_zonareg			|	N
						   str_pad($var[33],'12'," ",STR_PAD_LEFT).		# num_ficreg			|	N
						   str_pad($var[34],'150'," ").					# direccion				|	C
						   str_pad($var[35],'2'," ",STR_PAD_LEFT).		# cod_ubi_dpto			|	C
						   str_pad($var[36],'2'," ",STR_PAD_LEFT).		# cod_ubi_prov			|	C
						   str_pad($var[37],'2'," ",STR_PAD_LEFT).		# cod_ubi_dist			|	C
						   str_pad($var[38],'40'," ",STR_PAD_LEFT).		# telefono				|	C
						   str_pad($var[39],'1'," ",STR_PAD_LEFT).		# par_conyugue			|	C
						   str_pad($var[40],'40'," ").					# con_apepat			|	C
						   str_pad($var[41],'40'," ").					# con_apemat			|	C
						   str_pad($var[42],'40'," ").					# con_nombres			|	C
						   str_pad($var[43],'2'," ",STR_PAD_LEFT).		# tipo_fondos			|	C
						   str_pad($var[44],'3'," ",STR_PAD_LEFT).		# tip_operacion			|	C
				           str_pad($var[45],'1'," ",STR_PAD_LEFT).		# for_pago				|	C
						   str_pad($var[46],'2'," ",STR_PAD_LEFT).		# opor_pago				|	C
						   str_pad($var[47],'40'," ",STR_PAD_LEFT).		# des_oporpago			|	C
						   str_pad($var[48],'40'," ").					# ori_fondos			|	C
						   str_pad($var[49],'3'," ",STR_PAD_LEFT).		# moneda				|	C
						   str_pad($var[50],'18'," ",STR_PAD_LEFT).		# monto_tot_ope			|	N
						   str_pad($var[51],'18'," ",STR_PAD_LEFT).		# monto_x_participante	|	N
						   str_pad($var[52],'18'," ",STR_PAD_LEFT).		# monto_medio_pago		|	N
						   str_pad($var[53],'6'," ",STR_PAD_LEFT).		# tip_cambio			|	N
						   str_pad($var[54],'1'," ",STR_PAD_LEFT).		# insc_regis			|	C
						   str_pad($var[55],'2'," ",STR_PAD_LEFT).		# bien_cod_zonareg		|	N
						   str_pad($var[56],'12'," ",STR_PAD_LEFT);		# num_partida			|	N

				fwrite($fp,$detalle);
				fwrite($fp , chr(13).chr(10));
				
			}
			fclose($fp);
?>