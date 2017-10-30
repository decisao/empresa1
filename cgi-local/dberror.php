<?php 

  // IP do usuário
  $ip = getenv("REMOTE_ADDR"); 

  // Envio de e-mail
  $nl = "<BR>";

  $assunto = 'Erro no Empresa1 Reloaded';
  $nome_remetente  = 'empresa1.net';
  $email_remetente = 'webmaster@empresa1.net';

  $headers  = "From: $nome_remetente <$email_remetente>\n"; 
  $headers .= "Reply-To: <$email_remetente>\n"; 
  $headers .= "MIME-Version: 1.0\n"; 
  $headers .= "Return-Path: <$email_remetente>\n"; 
  $headers .= "Content-type: text/html; charset=iso-8859-1\n"; 

  $body  = "Olá Eliéser!" . $nl; 
  $body .= "Ocorreu um erro de banco de dados durante uma sessão do Empresa1 Reloaded:" . $nl . $nl;
  $body .= "Empresa: $empresa" . $nl;
  $body .= "Data: $data" . $nl;
  $body .= "Sistema: $sistema" . $nl;
  $body .= "Usuário: $usuario" . $nl;
  $body .= "Máquina: $maquina" . $nl;
  $body .= "Endereço IP: $ip" . $nl;
  $body .= "Formulário: $form" . $nl;
  $body .= "Mensagem: $msg" . $nl;
  $body .= "ID: $id" . $nl . $nl;

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

  mail("webmaster@empresa1.net", "[empresa1.net] Erro no Empresa1 Reloaded", $me, $headers); 

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
    $query = "INSERT INTO `empresa1_bugs` ( `id` , `data` , `sistema` , `usuario` , `maquina` , `ip` , `form` , `msg` ) ";
    $query.= "VALUES ('$id', NOW(), '$sistema', '$usuario', '$maquina', '$ip', '$form', '$msg'); "; 
    $result = mysql_query($query); 

    $query = "SELECT `email` FROM `empresa1_clientes` WHERE `id` = '$id'";
    $result = mysql_query($query);
    $line = mysql_fetch_array($result);
    $email_cliente = $line['email'];
    
    // Desconectar
    mysql_free_result($result);
    mysql_close($connection);

    $assunto = 'Erro no Empresa1 Reloaded'; 
    $nome_remetente  = 'empresa1.net';
    $email_remetente = 'suporte@empresa1.net';

    $headers  = "From: $nome_remetente <$email_remetente>\n"; 
    $headers .= "Reply-To: <$email_remetente>\n"; 
    $headers .= "MIME-Version: 1.0\n"; 
    $headers .= "Return-Path: <$email_remetente>\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\n"; 

    $body  = "Olá!" . $nl; 
    $body .= "Recebemos a notificação de um erro ocorrido no sistema da sua empresa e encaminhamos o assunto automaticamente para o Suporte Técnico. Fique tranquilo, um consultor de suporte irá analisar o erro e tomar as medidas necessárias. Segue abaixo o informe que recebemos:" . $nl . $nl;
    $body .= "Empresa: $empresa" . $nl;
    $body .= "Data: $data" . $nl;
    $body .= "Versão do Sistema: $sistema" . $nl;
    $body .= "Usuário: $usuario" . $nl;
    $body .= "Máquina: $maquina" . $nl;
    $body .= "Local do erro: $form" . $nl;
    $body .= "Mensagem do erro: $msg" . $nl . $nl;
    $body .= "Agradecemos a confiança em nossos serviços." . $nl . $nl;
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

    mail("$email_cliente", "[empresa1.net] Solicitação automática enviada ao Suporte", $me, $headers); 

  }

?>
