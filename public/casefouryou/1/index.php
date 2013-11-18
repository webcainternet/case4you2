<html>
 
<head>
  <link rel="stylesheet" href="/case4you/0/jquery-ui.css" />
  <script src="/case4you/0/jquery-1.9.1.js"></script>
  <script src="/case4you/0/jquery-ui.js"></script>
  <link rel="stylesheet" href="/case4you/0/style.css" />




</head>
 
<body style="margin: 0px; padding: 0px;font-family: Arial, Helvetica, sans-serif; color: #222222;line-height: 1.3;font-size: 12px; ">


<?php
//incluindo a classe de conexão com o facebook
require '../facebook-php-sdk/src/facebook.php';

 
/*
* ID da App, vocé obteve isso na ultima
* página de geração do seu aplicativo no facebook
*/
$App_ID = '533870426700085';
/*
* App Secret, você obteve isso na ultima
* página de geração do seu aplicativo no facebook
*/
$App_Secret = 'd61ec652232c75af2667e8a2f5c2ba88';
 
//Instanciando o Objeto da classe do facebook
$facebook = new Facebook(array(
        'appId'  => $App_ID ,
        'secret' => $App_Secret
));
 
//Pegando Id do usuário Logado
$o_user = $facebook->getUser();

//echo $o_user; 
/*
* Verificando se está conectado
*/
if($o_user == 0)
{
    //Envia para a página de permissão do facebook, nela voce irá dar permissão ao aplicativo
    //acessar dados da sua conta
    $url = $facebook->getLoginUrl(array('scope' => array('user_about_me','user_hometown','user_photos','friends_photos','read_stream','friends_likes','photo_upload','publish_stream','status_update','video_upload')));
//    header("Location:".$url);
echo "<script language=javascript>location.href ='".$url."'</script>";
}
else
{
    //Verificando se o comando de logout foi enviado
    if($_GET['action'] == 'finish' )
    {
        //Retirando a permissão do Aplicativo à sua conta no facebook
        session_destroy();
        header('Location: '.$facebook->getLogoutUrl());
    }
    else
    {
        //pegando as publicações do seu mural
        //$feed = $facebook->api('/me/feed');
        //Use var_dump($feed) ou print_r($feed)
        //para ver todos os campos retornados
 
        //pegando as informações do usuário conectado
        //$me = $facebook->api('/me');
        //Use var_dump($me) ou print_r($me)
        //para ver todos os campos retornados
 
        //pegando as publicações da sua home
        //$home = $facebook->api('/me/home');
        //Use var_dump($home) ou print_r($home)
        //para ver todos os campos retornados
        $albums = $facebook->api('/me/albums');
        ?>

        <script type="text/javascript">
        function selecionaalbum(salbum) {
                window.location="http://case4you.com.br/casefouryou/2/?idalbum="salbum.value;
        }
        </script>
        
        <select  onchange="selecionaalbum(this)">
          <?php
          foreach($albums['data'] as $album) 
          {
          print ('<option value="'.$album['id'].'">'.$album['name'].'</option>' ) ;
          }
          ?>

          </select>
        <?php


    }
}
 
?>



</body>
 
</html>

