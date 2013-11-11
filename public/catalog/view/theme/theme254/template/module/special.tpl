<div class="box specials">
  <div class="box-heading special-heading"><span><?php echo $heading_title; ?></span></div>
  <div class="box-content">
	<div class="box-product">
		<ul>
		  <?php $i=0; foreach ($products as $product) { $i++ ?>
			<?php 
							if ($i%4==1) {
								$a='class="first-in-line"';
							}
							elseif ($i%4==0) {
								$a='class="last-in-line"';
							}
							else {
								$a='';
							}
						?>
		  <li <?php echo $a;?>>
			
			<?php if ($product['thumb']) { ?>
			<div class="image2"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
			<?php } ?>
			<div class="inner">
					<div class="f-left">
						<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo mb_substr($product['name'],0,20,'UTF-8').'...'; ?></a></div>
						<!--<?php// if ($product['description']) {?>
							<div class="description"><?php// echo mb_substr($product['description1'],0,70,'UTF-8').'...';?></div>
						<?php// } ?>-->
						<?php if ($product['price']) { ?>
						<div class="price">
						  <?php if (!$product['special']) { ?>
						  <?php echo $product['price']; ?>
						  <?php } else { ?>
						  <span class="price-new"><?php echo $product['special']; ?></span><span class="price-old"><?php echo $product['price']; ?></span> 
						  <?php } ?>
						</div>
						<?php } ?>
						
						
					</div>
					<div class="cart">
						<a data-id="<?php echo $product['product_id']; ?>;" class="button addToCart"><span><?php echo $button_cart; ?></span></a>
						<!--<a href="<?php// echo $product['href']; ?>" class="button details"><span><?php// echo $button_details; ?></span></a>-->
					</div>
					<?php if ($product['rating']) { ?>
							<div class="rating">
							<img height="13" src="catalog/view/theme/theme254/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
							</div>
						<?php } ?>
						<div class="clear"></div>
					</div>
					
		  </li>
		  <?php } ?>
	   </ul>
	</div>
  </div>
</div>
