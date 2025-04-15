<?php

$backUpFolder	= "backup"; // The folder which the sql file stored. It is needed

@mkdir($backUpFolder);	//Create  Back Up Directory
@chmod($backUpFolder,0777); // Make it writable. In Case it already there.

//Database Server Details*

$server['host']	= "localhost";	//The hostname
$server['port']	= "";	//Give the port number allocated for MySQL. Leave blank if it is default[3306]
$server['user']	= "root";	//MySQLDatabase Username. Need to have all permission to the database.
$server['pass']	= "12345";	//MySQLDatabase Password.
$server['database']	= "notarios";	//MySQLDatabase Name.

//Mailing Details*
$mailer["FromMail"]	= ""; //From e-mail address. If you don't want to specify leave it blank
$mailer["ToMail"]	= ""; // Address which the mail should send. If no mailing is needed, Please leave it blank.
$mailer["MailBody"]	= "";	//Body of the mail
$mailer["DAS"]	= false;	//Change it to true when the file in the server needs to remove after finish sending mail. Default is false.
//For more details Please visit: http://is.gd/5b3Xk
?>
