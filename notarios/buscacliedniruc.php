<?php 


include("conexion.php");
// include_once 'Cpu/Person.php';
$tipoper = $_POST['tipoper'];
$tipodoc = $_POST['tipodoc'];
$numdoc  = $_POST['numdoc'];
// $captcha = strtoupper($_POST['image']);
// $consultReniecSunat = $_POST['consult_sunat_reniec'];





if($tipodoc != '10'){
$sqlclie = mysql_query("select * from cliente where  numdoc = '$numdoc' and (tipper='$tipoper' and idtipdoc='$tipodoc')", $conn) or die(mysql_error());
$row = mysql_fetch_array($sqlclie);



if (!empty($row)){//no hay rgistro

	 if ($row['tipocli']=="0"){//no selecciona documento

	    if ($row['tipper']=="N"){//es natural
		


		 	include("mostrarcliente.php");

		}else{
			  if($row['numdoc']==''){
				  include("mostrarnewclienteruc.php");
			  
	          }else{ 
	          	include ("mostrarempresa.php");
				}    
		} 
	 }else{

	   if ($row['tipper']=="N"){
		 include("mostrarimpedido.php");
		}else{ 
		  include ("mostrarempresa2.php");}
	 }
}else{
    if ($tipoper!="N"){

    	// if($consultReniecSunat == 1 && $captcha == ''){
	
	 	// 	//echo '2';
	 	// 	include("mostrarnewclienteruc.php");
	 	// }else{
	 		
	 		include("mostrarnewclienteruc.php"); 
	 	// }
	  	

	 }else{
		// $consultReniecSunat = 0;
	 	// if($consultReniecSunat == 1 && $captcha == ''){
	 	
	 	// 	echo '1';
	 	// }else{
	 		include("mostrarnewclientedni.php");
	 	// }
	 

	 }
}
}

 if($tipodoc=='10'){
	if($tipoper!="N"){ 
	include("mostrarnewclienteruc.php"); 
	}
	else {
	   include("mostrarnewclientedni.php");
	 }
	}

