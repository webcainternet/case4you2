<?php
if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
    $base_url = $this->config->get('config_ssl');
} else {
    $base_url = $this->config->get('config_url');
}

$view_path = $base_url . 'catalog/view/';
$theme_path = $view_path . 'theme/' . $this->config->get('config_template') . '/';

?>
<div class="clear"></div>
</div>

<section class="keep-in-touch">
    <div class="rds-wrapper">
        <a href="http://case4you.com.br/criar-capinha-personalizada"style="text-decoration:none"><h1>Capinha Personalizada</h1></a>
        <p>Siga-nos, temos muito para compartilhar com você!</p>

        <ul class="link-list social-link-list">
            <li><a href="http://www.facebook.com/case4youoficial" title="Nos curta no Facebook" target="_blank"><img src="<?php echo $theme_path; ?>/image/rds-facebook.png" alt="Facebook" width="120" height="100"></a></li>
            <li><a href="http://twitter.com/case4youoficial" title="Nos siga no Twitter" target="_blank"><img src="<?php echo $theme_path; ?>/image/rds-twitter.png" alt="Twitter" width="120" height="100"></a></li>
            <li><a href="http://instagram.com/case4youoficial" title="Nos siga no Instagram" target="_blank"><img src="<?php echo $theme_path; ?>/image/rds-instagram.png" alt="Instagram" width="120" height="100"></a></li>
            <li><a href="http://www.pinterest.com/case4youoficial/pins/" title="Nos siga no Pinterest" target="_blank"><img src="<?php echo $theme_path; ?>/image/rds-pinterest.png" alt="Pinterest" width="120" height="100"></a></li>
        </ul>
    </div>
</section>

<footer class="main-footer">
    <section class="all-site-links">
        <div class="rds-wrapper group list-of-links">
            <?php if ($informations): ?>
                <div class="information-belt">
                    <h3><?php echo $text_information; ?></h3>
                    <ul>
			<li><a href="http://case4you.com.br/capinhas-para-celular" title="Capinhas para Celular">Capinhas para Celular</a></li>
                        <li><a href="http://case4you.com.br/criar-capinha-personalizada" title="Criar capinha">Capas para celular</a></li>
                        <?php foreach ($informations as $information) { ?>
                        <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="faq-belt">
                <h3><?php echo $text_service; ?></h3>
                <ul>
                    <li><a href="/duvidas">Dúvidas</a></li>
                    <li><a href="/contato">Contato</a></li>
                </ul>
            </div>

            <div class="cta-belt">
                <h3><?php echo $text_extra; ?></h3>
                <ul>
                    <li><a href="<?php echo $base_url; ?>capinhas-para-empresas/">Capinha para empresas</a></li>
                    <li><a href="<?php echo $base_url; ?>revendas/">Revendas</a></li>
                </ul>
            </div>

            <div>
                <h3><?php echo $text_account; ?></h3>
                <ul>
                    <li><a href="<?php echo $account; ?>">Minhas Capinhas</a></li>
                    <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                    <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                    <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
                </ul>
            </div>

            <div class="safety-belt">
                <h3>Site Seguro</h3>
                <div style="float: left; width: 110px;"><img src="<?php echo $base_url; ?>image/data/Selo-SSL-grande.png" alt="Site Seguro" style="width: 90px; margin-top: -5px;"></div>
                <div style="float: left; width: 90px;"><img src="<?php echo $theme_path; ?>image/positivessl-icon.png" alt="Positive SSL" style="width: 65px; margin-top: -5px;"></div>
		<a id="seloEbit" href="http://www.ebit.com.br/#case4you" target="_blank" onclick="redir(this.href);"></a> 
		<script type="text/javascript" id="getSelo" src="https://imgs.ebit.com.br/ebitBR/selo-ebit/js/getSelo.js?62341"> 
		</script>
            </div>
        </div>
    </section>

    <div class="payment-types">
        <img src="<?php echo $theme_path; ?>image/rds-pagseguro.jpg" alt="Tipos de pagamento aceitos">
    </div>

    <div class="copyright">
        <div class="rds-wrapper">
            <small>Case4You &copy; Capinhas Personalizadas © Todos os direitos reservados - Sob CNPJ 18.672.112/0001-5</small>
        </div>
    </div>
</footer>


<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
<script type="text/javascript" 	src="<?php echo $view_path; ?>javascript/livesearch.js"></script>
</div>

<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '832246660140651']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=832246660140651&amp;ev=PixelInitialized" /></noscript>

</body>
</html>
