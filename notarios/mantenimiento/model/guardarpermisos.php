<?php
include('../../conexion.php');

$id_usuario = $_POST["id_usuario"];
$numcampos = $_POST["numcampos"];
$chk1 = $_POST["chk1"]; //
$chk2 = $_POST["chk2"];
$chk3 = $_POST["chk3"];
$chk4 = $_POST["chk4"];
$chk5 = $_POST["chk5"];
$chk6 = $_POST["chk6"];
$chk7 = $_POST["chk7"];


	if($chk1=='1')
	{
		// pre condiciones:
		$selectpusuario1 = "SELECT m_permi.cdg_usr FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '1'";
		$rowdevuelve1 = mysql_query($selectpusuario1,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rowdevuelve1);	
		$existe1 = $rownum[0];
		
		if($existe1=='')
		{
			// agrega nuevo permiso:	
			$grabaractos = "INSERT INTO m_permi (id_permi,cdg_usr,menuid,id_tip,swt_nue,swt_gra,swt_imp,swt_eli,swt_est,usr_crea,fec_crea) 
					VALUES (null,'$id_usuario','1','1', '1','1','1','1','1',null,null)";
			mysql_query($grabaractos,$conn) or die(mysql_error());	
		}	
	// permiso ya grabado:
	 	// NO HAGO NADA
	}
			else if($chk1=='0')
			{
			$DELETEactos1 = "DELETE FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '1' ";
			mysql_query($DELETEactos1,$conn) or die(mysql_error());	
			}
			
///////////////////////////////////////////////////////////////////////////////////			
	if($chk2=='1')
	{
		// pre condiciones:
		$selectpusuario2 = "SELECT m_permi.cdg_usr FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '2'";
		$rowdevuelve2 = mysql_query($selectpusuario2,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rowdevuelve2);	
		$existe2 = $rownum[0];
		
		if($existe2=='')
		{
			// agrega nuevo permiso:	
			$grabaractos = "INSERT INTO m_permi (id_permi,cdg_usr,menuid,id_tip,swt_nue,swt_gra,swt_imp,swt_eli,swt_est,usr_crea,fec_crea) 
					VALUES (null,'$id_usuario','2','1', '1','1','1','1','1',null,null)";
			mysql_query($grabaractos,$conn) or die(mysql_error());	
		}	
	// permiso ya grabado:
	 	// NO HAGO NADA
	}
			else if($chk2=='0')
			{
			$DELETEactos2 = "DELETE FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '2' ";
			mysql_query($DELETEactos2,$conn) or die(mysql_error());	
			}		
/////////////////////////////////////////////////////////////////////////////////////
	if($chk3=='1')
	{
		// pre condiciones:
		$selectpusuario3 = "SELECT m_permi.cdg_usr FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '3'";
		$rowdevuelve3 = mysql_query($selectpusuario3,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rowdevuelve3);	
		$existe3 = $rownum[0];
		
		if($existe3=='')
		{
			// agrega nuevo permiso:	
			$grabaractos = "INSERT INTO m_permi (id_permi,cdg_usr,menuid,id_tip,swt_nue,swt_gra,swt_imp,swt_eli,swt_est,usr_crea,fec_crea) 
					VALUES (null,'$id_usuario','3','1', '1','1','1','1','1',null,null)";
			mysql_query($grabaractos,$conn) or die(mysql_error());	
		}	
	// permiso ya grabado:
	}
			else if($chk3=='0')
			{
			// eliminno si esta deschekeado cuando el chk3 es menu 3	
			$DELETEactos3= "DELETE FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '3' ";
			mysql_query($DELETEactos3,$conn) or die(mysql_error());	
			}		
/////////////////////////////////////////////////////////////////////////////////////	

	if($chk4=='1')
	{
		// pre condiciones:
		$selectpusuario4 = "SELECT m_permi.cdg_usr FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '4'";
		$rowdevuelve4 = mysql_query($selectpusuario4,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rowdevuelve4);	
		$existe4 = $rownum[0];
		
		if($existe4=='')
		{
			// agrega nuevo permiso:	
			$grabaractos = "INSERT INTO m_permi (id_permi,cdg_usr,menuid,id_tip,swt_nue,swt_gra,swt_imp,swt_eli,swt_est,usr_crea,fec_crea) 
					VALUES (null,'$id_usuario','4','1', '1','1','1','1','1',null,null)";
			mysql_query($grabaractos,$conn) or die(mysql_error());	
		}	
	// permiso ya grabado:
	}
			else if($chk4=='0')
			{
			// eliminno si esta deschekeado cuando el chk3 es menu 3	
			$DELETEactos4= "DELETE FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '4' ";
			mysql_query($DELETEactos4,$conn) or die(mysql_error());	
			}		
/////////////////////////////////////////////////////////////////////////////////////	

	if($chk5=='1')
	{
		// pre condiciones:
		$selectpusuario5 = "SELECT m_permi.cdg_usr FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '5'";
		$rowdevuelve5 = mysql_query($selectpusuario5,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rowdevuelve5);	
		$existe5 = $rownum[0];
		
		if($existe5=='')
		{
			// agrega nuevo permiso:	
			$grabaractos = "INSERT INTO m_permi (id_permi,cdg_usr,menuid,id_tip,swt_nue,swt_gra,swt_imp,swt_eli,swt_est,usr_crea,fec_crea) 
					VALUES (null,'$id_usuario','5','1', '1','1','1','1','1',null,null)";
			mysql_query($grabaractos,$conn) or die(mysql_error());	
		}	
	// permiso ya grabado:
	}
			else if($chk5=='0')
			{
			// eliminno si esta deschekeado cuando el chk3 es menu 3	
			$DELETEactos5= "DELETE FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '5' ";
			mysql_query($DELETEactos5,$conn) or die(mysql_error());	
			}	
/////////////////////////////////////////////////////////////////////////////////////

	if($chk6=='1')
	{
		// pre condiciones:
		$selectpusuario6 = "SELECT m_permi.cdg_usr FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '6'";
		$rowdevuelve6 = mysql_query($selectpusuario6,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rowdevuelve6);	
		$existe6 = $rownum[0];
		
		if($existe6=='')
		{
			// agrega nuevo permiso:	
			$grabaractos = "INSERT INTO m_permi (id_permi,cdg_usr,menuid,id_tip,swt_nue,swt_gra,swt_imp,swt_eli,swt_est,usr_crea,fec_crea) 
					VALUES (null,'$id_usuario','6','1', '1','1','1','1','1',null,null)";
			mysql_query($grabaractos,$conn) or die(mysql_error());	
		}	
	// permiso ya grabado:
	}
			else if($chk6=='0')
			{
			// eliminno si esta deschekeado cuando el chk3 es menu 3	
			$DELETEactos6= "DELETE FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '6' ";
			mysql_query($DELETEactos6,$conn) or die(mysql_error());	
			}	
/////////////////////////////////////////////////////////////////////////////////////
			
if($chk7=='1')
	{
		// pre condiciones:
		$selectpusuario7 = "SELECT m_permi.cdg_usr FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '7'";
		$rowdevuelve7 = mysql_query($selectpusuario7,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rowdevuelve7);	
		$existe7 = $rownum[0];
		
		if($existe7=='')
		{
			// agrega nuevo permiso:	
			$grabaractos = "INSERT INTO m_permi (id_permi,cdg_usr,menuid,id_tip,swt_nue,swt_gra,swt_imp,swt_eli,swt_est,usr_crea,fec_crea) 
					VALUES (null,'$id_usuario','7','1', '1','1','1','1','1',null,null)";
			mysql_query($grabaractos,$conn) or die(mysql_error());	
		}	
	// permiso ya grabado:
	}
			else if($chk7=='0')
			{
			// eliminno si esta deschekeado cuando el chk3 es menu 3	
			$DELETEactos7= "DELETE FROM m_permi WHERE m_permi.cdg_usr = '$id_usuario' AND  m_permi.menuid = '7' ";
			mysql_query($DELETEactos7,$conn) or die(mysql_error());	
			}	
mysql_close($conn);

?>