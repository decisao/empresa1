<?php

require_once('nusoap.php'); 

$wsdl="http://www.empresa1.net/ws/server.php?wsdl"; 

$client = new soapclient($wsdl, true); 

$param=array('amount'=>'15.00'); 

$Response = $client->call('CalculateOntarioTax', $param, '', '', false, true); 

echo $Response; 


?>
