<?php
// multiple recipients
$to  = 'contato@case4you.com.br';

// subject
$subject = 'Case4you - Contato atrav&eacute;s do site';

// message

$nome = $_POST["nome"];
$email = $_POST["email"];
$assunto = $_POST["assunto"];
$mensagem = $_POST["mensagem"];

$message = '
<html>

<body>

Nome: '.$nome.'<br />
Email: '.$email.'<br />
Assunto: '.$assunto.'<br />
Mensagem: '.$mensagem.'<br />

--

<p>Ol&aacute;,</p>

<p>Recebemos a sua mensagem!<br>

<p>A sua solicita&ccedil;&atilde;o &eacute; muito importante para n&oacute;s e retornaremos o mais breve poss&iacute;vel.</p>

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
$headers .= 'To: Case4you - Contato <contato@case4you.com.br>' . "\r\n";
$headers .= 'From: Case4you - Contato <contato@case4you.com.br>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);






$to  = $_POST["email"];

// subject
$subject = 'Case4you - Contato atrav&eacute;s do site';

// message
$message = '
<html>

<body>

<p>Ol&aacute;,</p>

<p>Recebemos a sua mensagem!<br>

<p>A sua solicita&ccedil;&atilde;o &eacute; muito importante para n&oacute;s e retornaremos o mais breve poss&iacute;vel.</p>

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
$headers .= 'To: '.$to. "\r\n";
$headers .= 'From: Case4you - Contato <contato@case4you.com.br>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);






header("Location: http://case4you.com.br/contato-sucesso");



?>