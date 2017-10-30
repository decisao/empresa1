<?php

  require_once("nusoap.php");

  $ns = "http://www.empresa1.net/ws";

  $server = new soap_server();

  $server->configureWSDL('TaligentWS', $ns);

  $server->wsdl->schemaTargetNamespace = $ns;

  /*******************************************************
   ** getCustomerName
   *******************************************************/

  $server->register('getCustomerName',
    array('id' => 'xsd:string'),
    array('return' => 'xsd:string'),  
    $ns); 

  function getCustomerName($id) {

     $host = "localhost";
     $user = "elieser";
     $pass = "m0ra15r315";
     $db   = "empresa1_net_-_customers";

     $connection = mysql_connect("$host", "$user", "$pass");

     if ($connection) {
  
        mysql_select_db("$db");

        $query = "SELECT `empresa` FROM `empresa1_clientes` WHERE `id` = '$id'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $return = $row['empresa'];
		
     } else $return = 'ERRO!'; 

    return new soapval('return', 'xsd:string', $return);
	
  } 

  /*******************************************************
   ** getCustomerList
   *******************************************************/

  $server->register('getCustomerList'); 

  function getCustomerList() {

     $host = "localhost";
     $user = "elieser";
     $pass = "m0ra15r315";
     $db   = "empresa1_net_-_customers";

     $connection = mysql_connect("$host", "$user", "$pass");

     if ($connection) {
  
        mysql_select_db("$db");

        $query = "SELECT `id`, `empresa`, `email`, `telefone`, `ativo`, `atualizacao` FROM `empresa1_clientes`";
        $result = mysql_query($query);
        $num = mysql_num_rows($result);

        for ($i = 0; $i<$num; $i++) {

           $val = array(
              "id"          => mysql_result($result, $i, "id"),
              "empresa"     => mysql_result($result, $i, "empresa"),
              "email"       => mysql_result($result, $i, "email"),
              "telefone"    => mysql_result($result, $i, "telefone"),
              "ativo"       => mysql_result($result, $i, "ativo"),
              "atualizacao" => mysql_result($result, $i, "atualizacao")
           );
		   
		}

        $return[$i] = new soapval("row", "x:row", $val);
		
     } else $return = 'ERRO!';

    return $return;
	
  } 

  $server->service($HTTP_RAW_POST_DATA);

?>
