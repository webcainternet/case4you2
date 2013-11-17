<?php
// multiple recipients
$to  = 'fernando.mendes@webca.com.br';

// subject
$subject = 'Case4you - Contato através do site';

// message
$message = '
<html>

<body>



<p>Olá,</p>

<p>Recebemos a sua mensagem!<br>

<p>A sua solicitação é muito importante para nós e retornaremos o mais breve possível.</p>

<p>Obrigado por entrar em contato com a Case4you.</p>

<p>Atenciosamente,<br />Equipe Case4you</p>
<p><img src="http://case4you.com.br/image/data/SVGlogoAI_verde3.png" alt="" width="150" /</p>

</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Case4you - Contato <fernando.mendes@webca.com.br>' . "\r\n";
$headers .= 'From: Case4you - Contato <fernando.mendes@webca.com.br>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>