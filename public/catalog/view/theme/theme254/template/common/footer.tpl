<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="outer" id="content-bottom">
<?php echo $content_bottom; ?>
</div>

<!-- border-top: solid 1px #6aa11a; C8E59C -->
	<div class="wrapper" style="background-color: #71B01A; background-repeat: repeat-x; padding-bottom: 10px; background-image: url('/image/data/rodapebg.png');">
		<div style="margin: auto; width: 1024px;">
			<a href="http://www.facebook.com/case4youoficial" target="_blank"><div class="footer-social fs-face">
				&nbsp;
			</div></a>
			<a href="http://twitter.com/case4youoficial" target="_blank"><div class="footer-social fs-twitter">
				&nbsp;
			</div></a>
			<a href="http://instagram.com/case4youoficial" target="_blank"><div class="footer-social fs-instagram">
				&nbsp;
			</div></a>
		</div>
	</div>

<div class="footer-wrap">
<div class="outer">

<div id="footer">
	

	<div class="wrapper">
    <?php if ($informations) { ?>
      <div class="column col-1">
        <h3><?php echo $text_information; ?></h3>
        <ul>
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
      <div class="column col-2">
        <h3><?php echo $text_service; ?></h3>
        <ul>
          <li><a href="/duvidas">Dúvidas</a></li>
          <li><a href="/fale-conosco">Fale Conosco</a></li>
          <?php /* <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>*/ ?>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
        </ul>
      </div>
      <div class="column col-3">
        <h3><?php echo $text_extra; ?></h3>
        <ul>
          <!-- <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li> 
          <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
          <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li> -->
          <li><a class="fancybox fancybox.iframe" href="http://case4you.com.br/app/">Crie sua capinha</a></li>
        </ul>
      </div>
      <div class="column col-4">
        <h3><?php echo $text_account; ?></h3>
        <ul>
          <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
      </div>
	  
	  <div class="column col-4">
        <h3>Site Seguro</h3>
        <img src="image/data/Selo-SSL-grande.png" alt="Site Seguro" style="width: 90px; margin-top: -5px;">
      </div>
      
  </div>

  <div style="height: 100px;">
  <div style="width: 1024px; margin: auto;">
    <div style="float: right; width: 678px; margin-top: 20px; text-align: right;">
      <img src="image/data/banner_pagseguro.png" style="width: 500px;" alt="PagSeguro" />
    </div>
    
    <div style="float: left; width: 250px; margin-top: 20px; margin-left: 15px; text-align: left;">
      <img src="image/data/SVGlogoAI_verde3_footer.png" alt="Case4You" style="width: 100px;margin-top: 35px;margin-left: -10px;" />
    </div>
  </div>

  <div style="width: 1024px; margin: auto; text-align: center; float: left; color: #9da9b6; font-size: 10px;">
    Case4You &copy; Texto direitos reservados - Sob CNPJ 18.672.112/0001-54 - Desenvolvido por <a style=" color: #9da9b6; font-size: 10px;" href="http://webca.com.br/" target="_blank">WebCA Internet</a> 
  </div>
  
</div>
  
</div>
</div>

<?php /*
<div class="wrapper">
      <div id="powered"><?php echo $powered; ?>
        
      </div><!-- [[%FOOTER_LINK]] -->
  </div>
</div>
*/
?>

<!-- 
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->

<!-- 
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
<script type="text/javascript" 	src="catalog/view/javascript/livesearch.js"></script>
</div>
</div>


<div style="display: none;">
<img src="http://case4you.com.br/catalog/view/theme/theme254/image/fs_instagram_hover.png">
<img src="http://case4you.com.br/catalog/view/theme/theme254/image/fs_twitter_hover.png">
<img src="http://case4you.com.br/catalog/view/theme/theme254/image/fs_face2_hover.png">

</div>

<!--
<div id="popmsg" style="position: absolute; top: 30px; left: 30px; width: 200px; height: 20px; border: solid 10px #FF6060; border-radius: 22px; padding: 20px; z-index: 100; font-family: c4y1, Arial, Verdana; font-size: 16px; background-color: #FFFFFF;">
Estamos em manutenção!<br />
<a href="#" onclick="document.getElementById('popmsg').style.display = 'none';">Fechar</a>
</div>
-->
</body></html>