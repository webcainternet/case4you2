<?php $this->load->model('tool/image'); ?>
<div id="colorbox" style="display: none;"></div>
<table id="abandonedCartsWrapper<?php echo $this->request->get['store_id']; ?>" class="table table-bordered table-hover" width="100%" >
      <thead>
        <tr class="table-header">
          <td class="left" width="3%"><strong>ID</strong></td>
          <td class="left" width="15%"><strong>Customer Info</strong></td>
          <td class="left" width="20%"><strong>Cart</strong></td>
          <td class="left" width="10%"><strong>Date & Time</strong></td>
          <td class="left" width="10%"><strong>Last Visited Page</strong></td>
          <td class="left" width="5%"><strong>IP</strong></td>
          <td class="left" width="6%"><strong>Actons</strong></td>
        </tr>
      </thead>
    <?php  $this->load->model('sale/customer'); ?>
	<?php if (!empty($sources)) { ?>
		<?php $i=0; foreach ($sources as $ab) { ?>
              <tbody>
				<tr>
				  <td class="left">
                  	<?php echo $ab['id']; ?>
                  </td>
                  <td>
                 	 <?php $ab['customer_info'] = json_decode($ab['customer_info'], true); ?>
                     <table class="table table-bordered">
                     	<?php if (empty($ab['customer_info'])) { ?>
                        <tr><td class="name"><i class="icon-user"></i> (not provided)</td></tr>
						<tr><td class="email"><i class="icon-envelope"></i> (not provided)</td></tr>
						<tr><td class="telephone"><i class="icon-phone"></i> (not provided)</td></tr>
                        <tr><td class="language"><i class="icon-flag"></i> (not provided)</td></tr>
                        <tr><td class="language"><i class="icon-book"></i> Guest</td></tr>
                       	<?php } else { ?>
						<tr><td class="name"><i class="icon-user"></i> <?php echo $ab['customer_info']['firstname']." ". $ab['customer_info']['lastname']; ?></td></tr>
						<tr><td class="email"><i class="icon-envelope"></i> <?php echo $ab['customer_info']['email']; ?></td></tr>
						<tr><td class="telephone"><i class="icon-phone"></i> <?php echo $ab['customer_info']['telephone']; ?></td></tr>
                        <tr><td class="language"><i class="icon-flag"></i> Language: <?php echo isset($ab['customer_info']['language']) ? $ab['customer_info']['language'] : '(not provided)'; ?></td></tr>
                        <tr><td class="language"><i class="icon-book"></i> <?php $customerCheck = $this->model_sale_customer->getCustomerByEmail($ab['customer_info']['email']); if (!empty($customerCheck)) echo "Existing customer"; else echo "Guest customer"; ?></td></tr>
                        <?php } ?>
                     </table>
                  </td>
                  <td>
                	 <?php $ab['cart'] = json_decode($ab['cart'], true); ?>
                      <table class="table table-bordered">
                         <?php if (is_array($ab['cart'])) { ?>
                           <?php foreach ($ab['cart'] as $product) { ?>
                            <?php if ($product['image']) {
                                $image_thumb = $this->model_tool_image->resize($product['image'], 30, 30);
                                $image = $this->model_tool_image->resize($product['image'], 125, 125);
                                } else {
                                $image_thumb = false;
                                $image = false;
                                }
                            ?>
                            <tr>
                        <script>
                        $( "#picture<?php echo $i; ?>" ).mouseleave(function() {
                           $("#picture-hover<?php echo $i; ?>").fadeOut( 200 );
                        });
                        $( "#picture<?php echo $i; ?>" ).mouseenter(function() {
                           $("#picture-hover<?php echo $i; ?>").fadeIn( 200 );
                        });
                        </script>
                              <td width="70%" class="name"><div id="picture<?php echo $i; ?>" style="float:left;padding-right:3px;"><a href="<?php echo '../index.php?route=product/product&product_id='. $product['product_id']; ?>" target="_blank"><div id="picture-hover<?php echo $i; ?>" style="position:absolute;z-index:99999;padding-top:18px;display:none;"><img src="<?php echo $image; ?>" class="img-polaroid" /></div><img src="<?php echo $image_thumb; ?>" /></a></div> <a href="<?php echo HTTP_CATALOG.'index.php?route=product/product&product_id='. $product['product_id']; ?>" target="_blank"><?php echo $product['name']; ?></a>
                                <div>
                                  <?php foreach ($product['option'] as $option) { ?>
                                  - <small><?php echo $option['name']; ?> <?php echo $option['option_value']; ?></small><br />
                                  <?php } ?>
                                </div></td>
                              <td width="15%" class="quantity">x&nbsp;<?php echo $product['quantity']; ?></td>
                              <td width="15%" class="price"><?php $price = $this->currency->format($product['price']); echo $price; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          <?php } ?>
                      </table>
                  </td>
                  <td>
                  	First visit:<br /><?php echo $ab['date_created'] ?><br /><br />
                    Last visit:<br /><?php echo $ab['date_modified'] ?><br /><br />
                	Total time spent:<br /><?php $time = strtotime($ab['date_modified']) - strtotime($ab['date_created']); echo gmdate("H:i:s", $time) ?>
                  </td>
                  <td> 
					  <?php $link = "...".substr($ab['last_page'], -30); ?>
                	  <a href="..<?php echo $ab['last_page']; ?>" target="_blank"><?php echo $link; ?></a> 
                  </td>
                  <td> 
                	  <?php echo $ab['ip']; ?> 
                  </td>
                  <td>
					  <?php if (!empty($ab['customer_info']['email'])) { ?>
					  <a data-event-id="<?php echo $ab['id']; ?>" href="<?php echo $this->url->link('module/abandonedcarts/sendreminder', 'token=' . $this->session->data['token']."&id=".$ab['id']."&store_id=".$this->request->get['store_id'], 'SSL'); ?>" class="btn btn-small"><i class="icon-envelope"></i> Send reminder</a>
					  <?php } else { ?>
					  <a class="btn btn-small disabled" disabled="disabled"><i class="icon-envelope"></i> Send reminder</a>
					  <?php } ?>
					  <br /> <br />
                      <a onclick="removeItem('<?php echo $ab['id']; ?>')" class="btn btn-small btn-danger"><i class="icon-remove"></i> Remove</a>
                  </td>
                </tr>
              </tbody>
        <?php } ?>
	<?php } ?>
    <tfoot><tr><td colspan="10"><div class="pagination"><?php echo $pagination; ?></div></td></tr></tfoot>
</table>
<div style="float:right;padding: 5px;">
	<a onclick="removeAllEmpty()" class="btn btn-small btn-info"><i class="icon-trash"></i>&nbsp;&nbsp;Remove all empty records</a>  | <a onclick="removeAll()" class="btn btn-small btn-danger"><i class="icon-trash"></i>&nbsp;&nbsp;Remove all</a> 
</div>
<script>
	$(document).ready(function(){
		 $('#abandonedCartsWrapper<?php echo $this->request->get['store_id']; ?> .links a').click(function(e){
				e.preventDefault();
				$.ajax({
					url: this.href,
					type: 'get',
					dataType: 'html',
					success: function(data) {				
						$("#abandonedCartsWrapper<?php echo $this->request->get['store_id']; ?>").html(data);
					}
				});
			 });		 
		   });
   function removeAll() {      
		var r=confirm("Are you sure that you want to remove all records from this store?");
		if (r==true) {
			$.ajax({
				url: 'index.php?route=module/abandonedcarts/removeallrecords&store=<?php echo $this->request->get['store_id']; ?>&token=<?php echo $this->session->data['token']; ?>',
				type: 'post',
				data: {'remove': r, 'store' : <?php echo $this->request->get['store_id']; ?> },
				success: function(response) {
				location.reload();
			}
		});
	 }
	}
   function removeAllEmpty() {      
		var r=confirm("Are you sure that you want to remove all empty records (with no emails) from this store?");
		if (r==true) {
			$.ajax({
				url: 'index.php?route=module/abandonedcarts/removeallemptyrecords&store=<?php echo $this->request->get['store_id']; ?>&token=<?php echo $this->session->data['token']; ?>',
				type: 'post',
				data: {'remove': r, 'store' : <?php echo $this->request->get['store_id']; ?> },
				success: function(response) {
				location.reload();
			}
		});
	 }
	}
</script>