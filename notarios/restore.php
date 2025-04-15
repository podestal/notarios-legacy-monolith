<?php
/*$conecta = mysql_connect('localhost', 'root', '12345');
if (!$conecta) {
die('No conectat : ' . mysql_error());
}
$db_selected = mysql_select_db('notarios', $conecta);
if (!$db_selected) {
echo 'No es troba la base de dades',$db_selected,'<br/>';
die (mysql_error());
}
else {
$texto = file_get_contents("C:\temp\notarios.txt");
$sentencia = explode("      ;", $texto);
echo(count($sentencia));
for($i = 0; $i < (count($sentencia)-1); $i++){
$db_selected = mysql_query ("$sentencia[$i];") or die(mysql_error());
}
} 
*/


$file = "C:\temp\notarios.txt";

$sql = implode('', file($file));
$sql_sentencias=explode('      ;',$sql);
//echo $sql_sentencias[0];
echo(count($sql));
$link= mysql_connect("localhost","root","12345");
mysql_select_db("notarios");
foreach ($sql_sentencias as $sentencia_sql){
echo(count($sql_sentencias));
	
mysql_query($sentencia_sql) or die ('Error ejecutando:'.$sentencia_sql.'<br>Mysql dice: '.mysql_error());
}

?>
