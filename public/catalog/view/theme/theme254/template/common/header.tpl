<?php
if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
    $base_url = $this->config->get('config_ssl');
} else {
    $base_url = $this->config->get('config_url');
}

$view_path = $base_url . 'catalog/view/';
$theme_path = $view_path . 'theme/' . $this->config->get('config_template') . '/';

?>
<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8" />

    <?php $currentpage = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; ?>

    <?php if ('case4you.com.br/index.php?route=common/home' == $currentpage || 'case4you.com.br/' == $currentpage): ?>
        <meta name="description" content="Crie Capinhas Personalizadas de forma simples e rápida, com fotos do seu Instagram, Facebook e direto do seu computador. Crie Já Sua Capinha!" />
        <meta name="keywords" content="capinha, capinha personalizada, capinhas, capinha celular, capa celular, case celular, capinha para celular, capinha de celular" />
        <meta name="company" content="Case4You" />
        <meta name="keywords" content="http://case4you.com.br" />
    <?php endif; ?>

    <?php if ('case4you.com.br/criar-capinha-personalizada' == $currentpage): ?>
        <meta name="description" content="Crie Capinhas Personalizadas de forma simples e rápida, com fotos do seu Instagram, Facebook e direto do seu computador. Crie Já Sua Capinha!" />
        <meta name="keywords" content="capinha personalizada, capinhas personalizadas, criar capinha, criar capinha personalizada, case personalizada" />
        <meta name="company" content="Case4You" />
        <meta name="keywords" content="http://case4you.com.br/criar-capinha-personalizada" />
    <?php endif; ?>

    <?php if ('case4you.com.br/capinhas-para-celular' == $currentpage): ?>
        <meta name="description" content="capa celular, capa de celular, capinha para celular, capinha de celular, capa smartphone, capinha iphone, capinha samsung, capinha motorola" />
        <meta name="keywords" content="Capinhas para Celular com o estilo ideal para você, encontre capinhas de diversos modelos para o seu Celular. Compre Sua Capinha na Case4You!" />
        <meta name="company" content="Case4You" />
        <meta name="keywords" content="http://case4you.com.br/capinhas-para-celular" />
    <?php endif; ?>

    <?php if ('case4you.com.br/quem-somos' == $currentpage): ?>
        <meta name="description" content="capinha, capinha personalizada, capinhas, capinha celular, capa celular, case celular, capinha para celular, capinha de celular" />
        <meta name="keywords" content="Crie Capinhas Personalizadas de forma simples e rápida, com fotos do seu Instagram, Facebook e direto do seu computador. Crie Já Sua Capinha!" />
        <meta name="company" content="Case4You" />
        <meta name="keywords" content="http://case4you.com.br/quem-somos" />
    <?php endif; ?>

    <?php if ('case4you.com.br/capinhas-para-empresas/' == $currentpage): ?>
        <meta name="description" content="Crie Capinhas Personalizadas de forma simples e rápida, para sua Empresa direto do seu computador. Crie Já Uma Capinha Personalizada para Sua Empresa!" />
        <meta name="keywords" content="capinha empresa, capinha para empresas, capinhas empresas, capinha personalizada empresa" />
        <meta name="company" content="Case4You" />
        <meta name="keywords" content="http://case4you.com.br/capinhas-para-empresas/" />
    <?php endif; ?>


    <?php if (isset($title) && !empty($title)): ?>
        <title><?php echo $title; ?></title>
    <?php else: ?>
        <title>Criar Capinhas Personalizadas | Case4You</title>
    <?php endif; ?>

    <base href="<?php echo $base; ?>" />

    <?php if (isset($description) && !empty($title)) { ?>
        <meta name="description" content="<?php echo $description; ?>" />
    <?php } else { ?>
        <meta name="description" content="Criar Sua Capinha Personalizada Ficou Fácil. Escolha o Seu Modelo e USe Fotos do Facebook e Instagram!" />
    <?php } ?>

    <?php if ($keywords) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php } ?>

    <link href="<?php echo $theme_path; ?>image/favicon.ico" rel="icon" />

    <?php foreach ($links as $link) { ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
    <?php } ?>

    <link href="<?php echo $theme_path; ?>stylesheet/cng_overload.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>stylesheet/stylesheet.css" />
    <link href="<?php echo $theme_path; ?>stylesheet/cloud-zoom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $theme_path; ?>stylesheet/superfish.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $theme_path; ?>stylesheet/slideshow.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $theme_path; ?>stylesheet/jquery.prettyPhoto.css" rel="stylesheet" type="text/css" />
    <?php foreach ($styles as $style) { ?>
        <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>

    <link rel="stylesheet" type="text/css" href="<?php echo $view_path; ?>javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
    <link href="<?php echo $theme_path; ?>stylesheet/skin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $view_path; ?>javascript/jquery/colorbox/colorbox.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>stylesheet/livesearch.css"/>
    <link rel="stylesheet" href="<?php echo $theme_path; ?>coin-slider/coin-slider-styles.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $theme_path; ?>stylesheet/redesign.css" type="text/css" />

    <link rel="stylesheet" href="<?php echo $theme_path; ?>stylesheet/builder4you.css" type="text/css" />

	<script type="text/javascript" src="<?php echo $theme_path; ?>fancybox/lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/ui/external/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/colorbox/jquery.colorbox.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/jquery.cycle.js"></script>
    <?php
        /*
        <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $view_path; ?>javascript/jquery/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        */
    ?>

	<script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>scripts/cng_overload.js"></script>

    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/jquery.jcarousel.min.js"></script>

    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!--[if IE]>
        <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/fancybox/jquery.fancybox-1.3.4-iefix.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div>
    <![endif]-->

    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/tabs.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/easyTooltip.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/common.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jQuery.equalHeights.js"></script>
    <script type="text/JavaScript" src="<?php echo $view_path; ?>javascript/cloud-zoom.1.0.2.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jscript_zjquery.anythingslider.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/superfish.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery.bxSlider.min.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/script.js"></script>
    <script type="text/javascript" src="<?php echo $view_path; ?>javascript/jquery/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <?php foreach ($scripts as $script) { ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php } ?>

    <!--[if  IE 8]>
    	<style>
    		.success, #header #cart .content  { border:1px solid #e7e7e7;}
    	</style>
    <![endif]-->

    <!--[if  IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>stylesheet/ie7.css" />
    <![endif]-->
    <!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>stylesheet/ie6.css" />
        <script type="text/javascript" src="<?php echo $view_path; ?>javascript/DD_belatedPNG_0.0.8a-min.js"></script>
        <script type="text/javascript">
        DD_belatedPNG.fix('#logo img');
        </script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo $theme_path; ?>coin-slider/coin-slider.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>scripts/plugins.js"></script>

    <script>
        var baseUrl = '<?php echo $base_url; ?>';
        var fbAppId = '<?php echo FB_APP_ID; ?>';
        var instagramAppId = '<?php echo INSTAGRAM_APP_ID; ?>';
    </script>

    <script type="text/javascript" src="<?php echo $theme_path; ?>scripts/main.js"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>scripts/compositron.js"></script>
    <script type="text/javascript" src="<?php echo $theme_path; ?>scripts/builder4you.js"></script>

    <?php if ($stores) { ?>
    <script type="text/javascript"><!--
        $(document).ready(function() {
            <?php foreach ($stores as $store) { ?>
                $('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
            <?php } ?>
        });
    //--></script>
    <?php } ?>
    <?php echo $google_analytics; ?>



    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
    $.src='//v2.zopim.com/?1ienaVIazwQoaYXdupEJy10rf2N0PJ3j';z.t=+new Date;$.
    type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
    </script>
    <!--End of Zopim Live Chat Script-->

    <!-- Start of Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-45324604-1', 'case4you.com.br');
      ga('send', 'pageview');

    </script>
    <!-- End of Google Analytics -->


</head>
<body class="<?php echo empty($this->request->get['route']) ? 'common-home' : str_replace('/', '-', $this->request->get['route']); ?>">

<div id="fb-root"></div>

<div class="bg-1">
<div class="main-shining">

<header class="main-header">
    <div class="rds-wrapper group">
        <div class="brand">
            <?php if ($logo): ?>
                <a href="<?php echo $home; ?>" title="Capinhas | Case4You"Voltar para a home">
                    <img src="<?php echo $logo; ?>" alt="Capinhas Personalizadas" width="159" height="71">
                </a>
            <?php endif; ?>
        </div>

        <nav class="main-menu">
	<ul class="link-list">
		<li><a href="http://case4you.com.br/criar-capinha-personalizada" title="Crie sua Capinha - Case4You">Criar Capinha</a></li>
		<li><a href="http://case4you.com.br/capinhas-para-celular" title="Mais Capinhas de Celular - Case4You">+ Capinhas</a></li>
		<li><a href="http://case4you.com.br/quem-somos" title="Saiba mais sobre a Case4You">Quem Somos</a></li>
		<li><a href="http://case4youblog.com" title="Mais do universo de capinhas e celulares" target="_blank">Blog</a></li>
	</ul>
</nav>

        <ul class="user-utilities link-list">
            <?php
                $account_item_classes = 'account-menu-item ';
                if (isset($this->request->get['route']) && $this->request->get['route']=="account/account") {
                    $account_item_classes .= ' active';
                }

                $cart_item_classes = 'cart-menu-item ';
                if (isset($this->request->get['route']) && $this->request->get['route']=="checkout/cartcustom") {
                    $cart_item_classes .= ' active';
                }
            ?>
            <li class="<?php echo $cart_item_classes; ?>"><a href="<?php echo $shopping_cart; ?>custom" title="Minhas Capinhas"><span class="icon icon-cart"><?php echo $text_shopcart; ?></span></a></li>
            <li class="<?php echo $account_item_classes; ?>"><a href="<?php echo $account; ?>" title="Acesse Sua Conta da Case4You"><?php echo $text_account; ?></a></li>
        </ul>
    </div>
</header>
