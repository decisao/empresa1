<?php 

  // IP do usu�rio
  $ip = getenv("REMOTE_ADDR"); 

  // Par�metros
  $host = "localhost";
  $user = "admin_elieser";
  $pass = "m0ra15r315";
  $db   = "admin_customers";

  // Conex�o
  $connection = mysql_connect("$host", "$user", "$pass");

  if ($connection)
  {
  	
    mysql_select_db("$db");

    // Grava��o dos dados
    $query = "INSERT INTO `empresa1_logs` ( `empresa` , `data` , `usuario` , `sistema` , `maquina` , `ip` , `id` ) ";
    $query.= "VALUES ('$empresa', NOW(), '$usuario', '$sistema', '$maquina', '$ip', '$id'); "; 
    $result = mysql_query($query); 
    
    // Verifica��o da Licen�a
    $query = "SELECT `ativo`, `atualizacao` FROM `empresa1_clientes` WHERE `id` = '$id'";
    $result = mysql_query($query);
    $line = mysql_fetch_array($result);
    $licenca = $line['ativo'] . $line['atualizacao'];

    echo $licenca;
    
    // Desconectar
    mysql_free_result($result);
    mysql_close($connection);

  }

?>
