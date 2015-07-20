<?php echo $header; ?>
<?php echo $content_top; ?>

<script>
jQuery(document).ready(function() {
	$(".videoyt").click(function() {
		$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'width'			: 854,
			'height'		: 510,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			'wmode'				: 'transparent',
			'allowfullscreen'	: 'true'
			}
		});

		return false;
	});
});
</script>
<style>
.breadcrumb {
  margin: 0;
  border-radius: 0;
}
</style>
<div class="breadcrumb">
            <a href="http://localhost:8000/index.php?route=common/home">Case4You</a>
         » <a href="http://localhost:8000/criar-capinha-personalizada" title="Criar Capinha Personalizada">Criar Capinha Personalizada</a>
      </div>

<div class="rds-wrapper group builder-4-you">
    <div class="b4y-left-column b4y-column">
        <div class="b4yslider b4y-product-types">
            <ul class="slides">
                <?php $first_active = false; ?>
                <?php foreach ($entries as $key => $value): ?>
                    <?php
                        $classes = '';
                        if (!$first_active) {
                            $classes .= 'active';
                            $first_active = true;
                        }
                    ?>
                    <li>
                        <a href="#category-<?php echo $key; ?>" class="<?php echo $classes; ?>" data-products='<?php echo json_encode($value['products']); ?>' data-layouts='<?php echo json_encode($value['layouts']); ?>' data-proportion="<?php echo $value['proportion']; ?>" data-price="<?php echo $value['price']; ?>" data-denomination="<?php echo $value['denomination']; ?>">
                            <img src="<?php echo $value['icon_preview'] ?>" alt="<?php echo $value['name']; ?>" width="60" height="60">
                            <span><?php echo $value['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div> <!-- .b4yslider -->

        <div class="b4ystepper group">
            <ul>
                <li><a href="#product-options" class="active" data-offset="0" data-stepper="b4yoptions-container">Produtos</a></li>
                <li><a href="#picture-options" data-offset="336" data-stepper="b4yoptions-container">Fotos</a></li>
                <li><a href="#filter-options" data-offset="672" data-stepper="b4yoptions-container" class="filtro-btn">Filtros</a></li>
            </ul>
        </div> <!-- .b4ystepper -->

        <div class="b4yoptions">
            <div class="b4yoptions-container group">
                <div id="product-options" class="b4y-option b4y-product-option">
                    <div class="b4y-suboptions">
                        <ul class="group">
                            <li><a href="#model-options" class="active" data-offset="0" data-stepper="b4y-products-stepper .b4y-option-contents-wrapper">Modelo</a></li>
                            <li><a href="#layout-options" data-offset="336" data-stepper="b4y-products-stepper .b4y-option-contents-wrapper">Layout</a></li>
                        </ul>
                    </div>

                    <div class="b4y-option-contents b4y-products-stepper">
                        <div class="b4y-option-contents-wrapper group">
                            <div class="b4y-option-content no-overflow">
                                <div class="device-chooser b4y-products-header">
                                    <input type="text" name="device-picker" placeholder="Escolha seu modelo"><span class="icon icon-search"></span>
                                </div>
                                <div class="b4y-scrollable b4y-devices-scrollable">
                                    <ul class="b4y-devices"></ul>
                                </div>
                            </div>

                            <div class="b4y-option-content">
                                <div class="b4y-products-header">
                                    <h3>Selecione seu layout</h3>
                                </div>
                                <ul class="b4y-layouts group"></ul>
                            </div>
                        </div>
                    </div>

                </div> <!-- #product-options -->

                <div id="picture-options" class="b4y-option">
                    <div class="b4y-suboptions b4y-picture-option">
                        <ul class="group">
                            <li><a href="#instagram-options" class="active" data-offset="0" data-stepper="b4y-picture-stepper .b4y-option-contents-wrapper">Instagram</a></li>
                            <li><a href="#facebook-options"data-offset="336" data-stepper="b4y-picture-stepper .b4y-option-contents-wrapper">Facebook</a></li>
                            <li><a href="#computer-options"data-offset="672" data-stepper="b4y-picture-stepper .b4y-option-contents-wrapper">Computador</a></li>
                            <li><a href="#gallery-options"data-offset="1008" data-stepper="b4y-picture-stepper .b4y-option-contents-wrapper">Galeria</a></li>
                        </ul>
                    </div>

                    <div class="b4y-option-contents b4y-picture-stepper">
                        <div class="b4y-option-contents-wrapper group">
                            <div class="b4y-option-content">
                                <div class="b4y-social-upload b4y-picture-box b4y-insta-upload-box">
                                    <div class="b4y-social-cta">
                                        <h3>Conectar com Instagram.</h3>

                                        <p>Conecte com sua conta do instagram para personalizar sua capinha.</p>

                                        <a href="#" class="js-instagram-auth auth-button"><span class="icon icon-instagram"></span><span class="auth-title">Instagram</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="b4y-option-content">
                                <div class="b4y-social-upload b4y-picture-box">
                                    <div class="b4y-social-cta">
                                        <h3>Conectar com Facebook.</h3>

                                        <p>Conecte com sua conta do facebook para personalizar sua capinha.</p>

                                        <a href="#" class="js-facebook-auth auth-button auth-facebook"><span class="icon icon-facebook"></span><span class="auth-title">Facebook</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="b4y-option-content b4y-upload-option-content no-overflow">
                                <div class="b4y-social-upload b4y-picture-box">
                                    <div class="b4y-social-cta">
                                        <h3>Carregue as fotos de seu computador.</h3>

                                        <div class="upload-btn-container">
                                            <span class="auth-button auth-uploader">
                                                <input class="js-upload-pictures" type="file" name="files[]" multiple>
                                                <span class="auth-title">Computador</span>
                                            </span>
                                        </div>

                                        <small>Limite de tamanho: 5mb</small>

                                    </div>
                                </div>
                            </div>

                            <div class="b4y-option-content gallery-picture-container">

                                <div class="b4y-social-upload b4y-picture-box gallery-picture-box">
                                    <div class="header_container">
                                        <h3>Escolha a galeria</h3>
                                    </div>

                                    <?php foreach ($galleries as $key => $gallery): ?>
                                        <div class="b4y-gallery-item">
                                            <a href="#" class="b4y-gallery-item-wrapper js-load-gallery" data-pictures='<?php echo json_encode($gallery['pictures']); ?>'>
                                                <img class="b4y-gallery-thumb" src="<?php echo $gallery['thumbnail']; ?>">
                                                <div class="b4y-gallery-title"><span><?php echo $gallery['title']; ?></span></div>
                                                <span href="#" class="b4y-gallery-btn"></span>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- #picture-options -->

                <div id="filter-options" class="b4y-option">
                </div> <!-- #filter-options -->
            </div> <!-- .b4yoptions-container -->
        </div> <!-- .b4yoptions -->
    </div> <!-- .b4y-left-column -->

    <div class="b4y-middle-column b4y-column">
        <a href="#" class="js-clear-pics clear-pics"><span class="clear-pics-txt">Limpar tudo</span> <span class="clear-pictures"></span></a>

        <div class="b4y-device-container">
            <div class="b4y-device-composition b4y-device-grid visible-grid"></div>

            <img class="b4y-device-composition b4y-device-overlay">

            <div class="b4y-device-composition canvas-bg" data-mask=""></div>

            <img class="b4y-device-composition b4y-device-background">

            <div class="b4y-device-composition canvas-bg-enforcer" data-mask=""></div>

            <div class="b4y-device-composition b4y-device-picture">
                <div class="b4y-device-composition b4y-device-grid invisible-grid"></div>
            </div>
        </div>
    </div>

    <form class="b4y-right-column b4y-column" method="post" action="<?php echo HTTP_SERVER ?>index.php/?route=module/builder_4_you/post_product" accept-charset="utf8">
        <input type="hidden" name="idcsession" value="<?php echo $this->data['idcsession']; ?>">
        <input type="hidden" name="desc" value="">
        <input type="hidden" name="type" value="">
        <input type="hidden" name="image" value="">
        <input type="hidden" name="product_id" value="">
        <input type="hidden" name="layout_id" value="">
        <div class="hidden-dynamic-inputs"></div>
        <div class="space-area"></div>
        <h3 class="js-product-name"></h3>
        <h3 class="js-product-price">R$ 59.90</h3>
        <a class="videoyt" href="https://www.youtube.com/watch?v=_Zd22oD_w-0" class="need-help"><div class="need-help2">Precisa de ajuda?</div><div  class="need-help2b">(Assista o vídeo)</div></a>
        <button type="submit" class="buy-now">Comprar</button>

        <small>OBS.: Para obter qualidade na impressão é importante o upload de imagens em alta qualidade. Recomendamos fotos com pelo menos 1900x1200 pixels e 300dpi.</small>

        <a href="#" class="js-share-button fb-share-button">Compartilhar</a>
    </form>
</div>

<?php echo $footer; ?>
