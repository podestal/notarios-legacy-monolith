<?php 

  $total_consultas=0;

  function conection(){
	$server = "localhost";
	$user = "root";
	$pass = "12345";
	$bd = "notarios";
	
	$conn =mysql_connect ($server, $user, $pass) or die ('I cannot connect to the database because: ' . mysql_error());
	
	mysql_select_db ($bd); 
	
	return $conn;
  }

  function query($sql, $conn){ 
    $total_consultas++; 
	mysql_query("SET NAMES 'utf8'");
    $result = mysql_query($sql, $conn);
	if(!$result){ 
      echo 'MySQL Error: ' . mysql_error();
      exit;
    }
    return $result;
  }

  function fetch_array($sql){
   return mysql_fetch_array($sql);
  }

  function num_rows($sql){
   return mysql_num_rows($sql);
  }

  function close($conn){
  	mysql_close($conn);
  }
  
?>