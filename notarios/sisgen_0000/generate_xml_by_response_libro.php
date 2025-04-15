<?php 

$request_body = file_get_contents('php://input');

//var_dump($request_body);

$objResponse = new stdClass();
$objResponse->error = 0;
echo json_encode($objResponse);

$gestor = fopen("response_libro.xml", 'w+');
fwrite($gestor, $request_body);
fclose($gestor);

 ?>