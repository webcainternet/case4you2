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
    }
}
 
?>




<html>
 
<head>
<meta charset="utf-8" />

<style type="text/css">
@font-face {
  font-family: "c4y1";
  src: url(http://capamaniacos.com.br/css/fontes/alrightsans-regularitalic-v3.ttf);
}
@font-face {
  font-family: "c4y2";
  src: url(http://capamaniacos.com.br/css/fontes/alrightsans-bolditalic-v3.ttf);
}
.fontc4y1 { 
  font-family: "c4y1", Arial, Verdana;
  font-size: 12px;
}

.fontc4y2 { 
  font-family: "c4y2", Arial, Verdana;
  font-size: 14px;
  color: #6aa11a;
}
body, p {
font-family: "c4y1", Arial, Verdana;
}

</style>

  <link rel="stylesheet" href="/case4you/0/jquery-ui.css" />
  <script src="/case4you/0/jquery-1.9.1.js"></script>
  <script src="/case4you/0/jquery-ui.js"></script>
  <link rel="stylesheet" href="/case4you/0/style.css" />
 
	<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="dropzone.min.js"></script>>
</head>
 
<body style="margin: 0px; padding: 0px;font-family: Arial, Helvetica, sans-serif; color: #222222;line-height: 1.3;font-size: 12px; ">
<div style="float: left; width: 350px; height: 550px;">


<div style="margin: 20px;">

<a href="http://case4you.com.br/casefouryou/2/?l=<?php echo $_GET["l"]; ?>&m=<?php echo $_GET["m"]; ?>"><img src="http://case4you.com.br/image/data/login_facebook.jpg" alt="" border="0"></a>

<?php /* <script type="text/javascript">
function selecionaalbum(salbum) {
        window.location="http://case4you.com.br/casefouryou/2/?l=<?php echo $_GET["l"]; ?>&m=<?php echo $_GET["m"]; ?>";
}
</script>

<select  onchange="selecionaalbum(this)">

<-php
foreach($albums['data'] as $album) 
{
print ('<option value="'.$album['id'].'">'.$album['name'].'</option>' ) ;
}
->

</select>

*/ ?>
</div>


</div>


<div id="p1-dvfoto-img" style="float: left; width: 348px; border-left: solid 1px #CCC; height: 540px; text-align: left; background-repeat: no-repeat; background-position: 15px 10px;">
      <div style="float: left;
                  width: 15px;
                  height: 20px;
                  margin-left: 20px;
                  margin-top: 20px;
                  background-color: #6aa11a;
                  border-radius: 20px;
                  padding: 5px;
                  padding-left: 10px;
                  padding-top: 5px;
                  color: #FFFFFF;
                  font-size: 14px;
                  font-weight: bold;">3</div>

      <div class="fontc4y2" style="float: left;
                  width: 260px;
                  margin-left: 10px;
                  margin-top: 13px;
                  padding: 5px;
                  color: #6aa11a;
                  font-size: 14px;
                  font-weight: bold;">
ESCOLHA O ALBUM DE SEU FACEBOOK!
	</div>
      <div class="fontc4y1" style="float: left; width: 320px; margin-left: 20px; margin-top: 20px;">
        AJUDA: Faça o login com o Facebook e escolha as fotos de seus albuns.
        <br /><br />
        OBS: Para obter qualidade na impressão é importante o upload de imagens em alta qualidade. Recomendamos fotos com pelo menos 1900x1200 pixels e 300dpi.
	</div>

    </div>



</body>
 
</html>

