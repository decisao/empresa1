<?php

  require_once("nusoap.php");

  $ns = "http://www.empresa1.net/ws";

  $server = new soap_server();

  $server->configureWSDL('TaligentWebServices', $ns);

  $server->wsdl->schemaTargetNamespace = $ns;

  $server->register('CalculateOntarioTax',
    array('amount' => 'xsd:string'),
    array('return' => 'xsd:string'),  
    $ns); 

  function CalculateOntarioTax($amount) {
    $taxcalc = $amount * .15;
    return new soapval('return', 'xsd:string', $taxcalc);
  } 

  $server->service($HTTP_RAW_POST_DATA);

?>
