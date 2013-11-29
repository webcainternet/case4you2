<script type="text/javascript" src="/catalog/view/javascript/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $("#clickface").click();
  });
</script> 

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
    //header("Location:".$url);
    //echo "<script language=javascript>location.href ='".$url."'</script>";
    ?>
    <style>
    .botaof {
        display: inline-block;
        text-decoration: none;
        cursor: pointer;
        background: url('/catalog/view/theme/theme254/image/button.png') repeat-x left top;
        font-size: 12px;
        line-height: 18px;
        border-radius: 5px;
    }
    </style>
    <div style="text-align: center;">Voc&ecirc; precisa estar logado no facebook para conseguir utilizar suas fotos!
    <?php
    echo "<a id=\"clickface\" class=\"botaof button\" href=\"$url\">Entrar com Facebook</a>";
    ?> 
    <script>
        setTimeout("getalbum()", 2000);
    </script>
    <?php

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
            <div>Autentica&ccedil;&atilde;o efetuada!</div>
        <?php


    }
}
 
?>