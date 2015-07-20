<div class="flexslider">
    <ul class="slides">
        <?php foreach ($banners as $banner): ?>
            <?php if ($banner['link']): ?>
                <li><a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<div class="newsletter-row">
    <div class="rds-wrapper group">
        <div class="newsletter-text">
            <p><strong>Assine case4you</strong></p>
            <p>Receba nossas ofertas por e-mail!</p>
        </div>

        <form action="#" class="newsletter-form group" method="POST" accept-chartset="utf-8">
            <input type="email" name="txtnews" placeholder="Insira seu e-mail">
            <button class="rds-send-button" type="submit">Enviar</button>
        </form>
    </div>
</div>

<div class="header-modules"></div>

<?php
$theme_path = 'catalog/view/theme/' . $this->config->get('config_template');
?>

<section class="how-it-works" id="como-funciona">
    <h2 style="width:100%;text-align:center;"><a style="text-decoration:none;font-size: 45px;" href="http://case4you.com.br/criar-capinha-personalizada" title"Capinhas Personalizadas">Capinhas Personalizadas</a></h2>

    <ol class="group rds-wrapper">
        <li>
          <a style="text-decoration: none;" href="http://case4you.com.br/criar-capinha-personalizada" title="Criar capinha">
            <img src="<?php echo $theme_path; ?>/image/hiw-step1.png" alt="Selecione um modelo" width="295" height="270">
            <h2><span>1.</span> Selecione um modelo</h2>
            <p>Temos Diversos modelos de Capas para Celular, escolha o seu.</p>
          </a>
        </li>

        <li>
          <a style="text-decoration: none;" href="http://case4you.com.br/criar-capinha-personalizada" title="Criar capinha">
            <img src="<?php echo $theme_path; ?>/image/hiw-step2.png" alt="Escolha suas fotos" width="295" height="270">
            <h2><span>2.</span> Escolha suas fotos</h2>
            <p>Selecione Fotos do Seu Facebook, Instagram ou Computador e cria sua capinha personalizada</p>
          </a>
        </li>

        <li>
          <a style="text-decoration: none;" href="http://case4you.com.br/criar-capinha-personalizada" title="Criar capinha">
            <img src="<?php echo $theme_path; ?>/image/hiw-step3.png" alt="Receba em casa" width="295" height="270">
            <h2><span>3.</span> Receba em casa</h2>
            <p>Você recebe sua capinha em casa, com toda comodidade e segurança</p>
          </a>
        </li>
    </ol>
</section>

<section class="contact-us">
    <div class="rds-wrapper">
        <h3>Fale conosco</h3>
        <p>Envie suas dúvidas, sugestões, elogios ou reclamações, queremos ouvi-lo!</p>

        <form action="#" method="post" class="rds-wrapper contact-form" accept-charset="utf-8">
            <div class="group">
                <input type="text" name="name" class="name-field" placeholder="Nome">
                <input type="text" name="surname" class="surname-field" placeholder="Sobrenome">
            </div>

            <input type="email" name="email" class="email-field" placeholder="E-mail">

            <div class="group">
                <input type="text" name="message" class="message-field" placeholder="Mensagem">
                <button class="rds-send-button" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</section>
