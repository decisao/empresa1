<?php 

  // IP do usuário
  $ip = getenv("REMOTE_ADDR"); 

  // Parâmetros
  $host = "localhost";
  $user = "admin_elieser";
  $pass = "m0ra15r315";
  $db   = "admin_customers";

  // Conexão
  $connection = mysql_connect("$host", "$user", "$pass");

  if ($connection)
  {
  	
    mysql_select_db("$db");

    // Gravação dos dados
    $query = "INSERT INTO `empresa1_logs` ( `empresa` , `data` , `usuario` , `sistema` , `maquina` , `ip` , `id` ) ";
    $query.= "VALUES ('$empresa', NOW(), '$usuario', '$sistema', '$maquina', '$ip', '$id'); "; 
    $result = mysql_query($query); 
    
    // Verificação da Licença
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
