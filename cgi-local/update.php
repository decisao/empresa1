<?php 

  // IP do usuário
  $ip = getenv("REMOTE_ADDR"); 

  // Envio de e-mail
  $nl = "<BR>";

  $assunto = 'Consulta de Atualização do Sistema';
  $nome_remetente  = 'empresa1.net';
  $email_remetente = 'suporte@empresa1.net';

  $headers  = "From: $nome_remetente <$email_remetente>\n"; 
  $headers .= "Reply-To: <$email_remetente>\n"; 
  $headers .= "MIME-Version: 1.0\n"; 
  $headers .= "Return-Path: <$email_remetente>\n"; 
  $headers .= "Content-type: text/html; charset=iso-8859-1\n"; 

  $body  = "Olá!" . $nl . $nl; 
  $body .= "Recebemos um pedido de atualização via Internet, seguem os dados abaixo:" . $nl . $nl;
  $body .= "Empresa: $empresa" . $nl;
  $body .= "Data: $data" . $nl;
  $body .= "Sistema: $sistema" . $nl;
  $body .= "Usuário: $usuario" . $nl;
  $body .= "Computador: $maquina" . $nl;
  $body .= "IP: $ip" . $nl;
  $body .= "Resultado: $resultado" . $nl;
  $body .= "ID: $id" . $nl . $nl;
  $body .= "Agradecemos a confiança em nossos serviços on-line." . $nl . $nl;
  $body .= "atensiosamente," . $nl . $nl;
  $body .= "Eliéser Morais" . $nl;
  $body .= "Suporte" . $nl;
	
  $me = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"';
  $me.= '"http://www.w3.org/TR/html4/loose.dtd">';
  $me.= '<html>';
  $me.= '<head>';
  $me.= '<title>Untitled Document</title>';
  $me.= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
  $me.= '<style type="text/css">';
  $me.= '<!--';
  $me.= '.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}';
  $me.= '.style2 {font-size: x-small}';
  $me.= '.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; }';
  $me.= '-->';
  $me.= '</style>';
  $me.= '</head>';
  $me.= '<body>';
  $me.= '<table width="100%"  border="0">';
  $me.= '  <tr>';
  $me.= '    <td width="80%"><a href="http://www.empresa1.net"><img src="http://www.empresa1.net/images/slogan.gif" width="471" height="75" border="0"></a></td>'; 
  $me.= '    <td width="20%"><p class="style1 style2">Caixa Postal 321<br>';
  $me.= '    Franca, SP  14400-970</p>    </td>';
  $me.= '  </tr>';
  $me.= '</table>';
  $me.= '<table width="100%"  border="0">';
  $me.= '  <tr>'; 
  $me.= '    <td width="8%">&nbsp;</td>';
  $me.= '    <td width="92%"><p class="style1">' . $body . '</p>';
  $me.= '    </td>';
  $me.= '  </tr>';
  $me.= '</table>';
  $me.= '<br>';
  $me.= '<hr>';
  $me.= '<span class="style3">Copyright &copy; 1999-2005 <a href="http://www.empresa1.net">empresa1.net</a>&reg; Todos os direitos reservados </span>';
  $me.= '<p>&nbsp;</p>';
  $me.= '</body>';
  $me.= '</html>';

  /* envio */
  mail("webmaster@empresa1.net", "[empresa1.net] UPDATE: $resultado", $me, $headers); 
  
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
    $query = "INSERT INTO `empresa1_updates` ( `id` , `data` , `sistema` , `usuario` , `maquina` , `ip` , `resultado` ) ";
    $query.= "VALUES ('$id', NOW(), '$sistema', '$usuario', '$maquina', '$ip', '$resultado'); "; 
    $result = mysql_query($query); 

    if ($resultado=="ATUALIZADO") {
	
      $query = "SELECT `email` FROM `empresa1_clientes` WHERE `id` = '$id'";
      $result = mysql_query($query);
      $line = mysql_fetch_array($result);
      $email_cliente = $line['email'];
	  
      /* envio */
      $assunto = 'Consulta de Atualização do Sistema';
      $nome_remetente  = 'empresa1.net'; 
      $email_remetente = 'suporte@empresa1.net';

      $headers  = "From: $nome_remetente <$email_remetente>\n"; 
      $headers .= "Reply-To: <$email_remetente>\n"; 
      $headers .= "MIME-Version: 1.0\n"; 
      $headers .= "Return-Path: <$email_remetente>\n"; 
      $headers .= "Content-type: text/html; charset=iso-8859-1\n"; 

      $body  = "Saudações!" . $nl . $nl; 
      $body .= "Estamos contentes por ter recebido um pedido para atualizar o sistema de um computador da sua empresa! Seguem abaixo os dados referentes a essa transação:" . $nl . $nl;
      $body .= "Empresa: $empresa" . $nl;
      $body .= "Data: $data" . $nl;
      $body .= "Versão anterior do sistema: $sistema" . $nl;
      $body .= "Usuário: $usuario" . $nl;
      $body .= "Computador: $maquina" . $nl . $nl;
      $body .= "Agradecemos a confiança em nossos serviços on-line." . $nl . $nl;
      $body .= "atensiosamente," . $nl . $nl;
      $body .= "Eliéser Morais" . $nl;
      $body .= "Suporte" . $nl;
	
      $me = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"';
      $me.= '"http://www.w3.org/TR/html4/loose.dtd">';
      $me.= '<html>';
      $me.= '<head>';
      $me.= '<title>Untitled Document</title>';
      $me.= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
      $me.= '<style type="text/css">';
      $me.= '<!--';
      $me.= '.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}';
      $me.= '.style2 {font-size: x-small}';
      $me.= '.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; }';
      $me.= '-->';
      $me.= '</style>';
      $me.= '</head>';
      $me.= '<body>';
      $me.= '<table width="100%"  border="0">';
      $me.= '  <tr>';
      $me.= '    <td width="80%"><a href="http://www.empresa1.net"><img src="http://www.empresa1.net/images/slogan.gif" width="471" height="75" border="0"></a></td>'; 
      $me.= '    <td width="20%"><p class="style1 style2">Caixa Postal 321<br>';
      $me.= '    Franca, SP  14400-970</p>    </td>';
      $me.= '  </tr>';
      $me.= '</table>';
      $me.= '<table width="100%"  border="0">';
      $me.= '  <tr>'; 
      $me.= '    <td width="8%">&nbsp;</td>';
      $me.= '    <td width="92%"><p class="style1">' . $body . '</p>';
      $me.= '    </td>';
      $me.= '  </tr>';
      $me.= '</table>';
      $me.= '<br>';
      $me.= '<hr>';
      $me.= '<span class="style3">Copyright &copy; 1999-2005 <a href="http://www.empresa1.net">empresa1.net</a>&reg; Todos os direitos reservados </span>';
      $me.= '<p>&nbsp;</p>';
      $me.= '</body>';
      $me.= '</html>';

      /* envio */
      mail("$email_cliente", "[empresa1.net] Obrigado por atualizar seu sistema!", $me, $headers); 
  
    }

    // Desconectar
    mysql_free_result($result);
    mysql_close($connection);
	
  }

?>
