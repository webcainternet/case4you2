<?php /*
<div class="slideshow">
  <div id="slideshow<?php echo $module; ?>" class="nivoSlider" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
    <?php foreach ($banners as $banner) { ?>
    <?php if ($banner['link']) { ?>
    <a title="<?php echo $banner['title']; ?>" href="<?php echo $banner['link']; ?>"><img title="<?php echo $banner['description']; ?>" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
    <?php } else { ?>
    <img title="<?php echo $banner['description']; ?>" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
    <?php } ?>
    <?php } ?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
        $('#slideshow<?php echo $module; ?>').nivoSlider({
        	effect: 'fade',
		animSpeed: 500 ,
        pauseTime:5000,
		slices:20,
		captionOpacity:1,
		controlNavThumbs:false,
        controlNavThumbsFromRel:false,
		controlNavThumbsSearch: '.jpg',
		controlNavThumbsReplace: '_thumb.jpg',
		directionNav:false,
		controlNav: true,
		prevText: false,
		nextText: false
        });
	$('.nivo-controlNav a').eq(0).addClass('first');
	$('.nivo-controlNav a').eq(1).addClass('second');
	$('.nivo-controlNav a').eq(2).addClass('third');
	$('.nivo-controlNav a').eq(3).addClass('four');
});
</script>
*/
?>


<div id='coin-slider'>

	<a class="fancybox fancybox.iframe"  href="http://case4you.com.br/case4you/0/"><img src='image/data/banner/banner3.png' ></a>
	<a href="http://case4you.com.br/capas-prontas"><img src='image/data/banner/banner2.png' ></a>
	<a class="fancybox fancybox.iframe"  href="http://case4you.com.br/case4you/0/"><img src='image/data/banner/banner4.png' ></a>
	<a href="http://case4you.com.br/acessorios"><img src='image/data/banner/banner1.png' ></a>
	
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider({ width: 1024, height: 450, navigation: true, delay: 5000 });
	});
</script>


<div class="passos">
	<div class="passositem">
		<div class="passotitle">SELECIONE UM MODELO</div>
		<div class="passotexto">Temos os modelos dispon&iacute;veis para Iphone 4/4S, Iphone 5, Samsung S3 e Samsung S4</div>
		<div class="passoimg1"><div class="passonumero">1</div></div>
	</div>
	<div class="passositem" style="margin-left: 10px; margin-right: 10px;">
		<div class="passotitle">ESCOLHA SUAS FOTOS</div>
		<div class="passotexto">Selecione suas fotos diretamente das redes sociais (Facebook, Instagram) ou de seu computador</div>
		<div class="passoimg2"><div class="passonumero">2</div></div>
	</div>
	<div class="passositem">
		<div class="passotitle">RECEBA EM CASA</div>
		<div class="passotexto">Voc&ecirc; recebe seu produto em casa com toda comodidade e seguran&ccedil;a</div>
		<div class="passoimg3"><div class="passonumero">3</div></div>
	</div>
</div>