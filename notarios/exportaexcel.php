<?php 
header("Content-type: application/vnd.ms-excel" ) ; 
header("Content-Disposition: attachment; filename=archivo.xls" ) ; 
include('conexion.php'); 
$qry=mysql_query("select * from cliente", $conn) or die(mysql_error());
$campos = mysql_num_fields($qry) ; 
$i=0; 
echo "<table><tr>"; 
while($i<$campos){ 
echo "<td>". mysql_field_name ($qry, $i) ; 
echo "</td>"; 
$i++; 
} 
echo "</tr>"; 
while($row=mysql_fetch_array($qry)){ 
echo "<tr>"; 
for($j=0; $j<$campos; $j++) { 
echo "<td>".$row[$j]."</td>"; 
} 
echo "</tr>"; 
} 
echo "</table>"; 
?> 