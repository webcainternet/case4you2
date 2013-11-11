<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  <?php if ($orders) { ?>
  <div class="box-container">
    <h1><?php echo $heading_title; ?></h1>
    <div class="count-item">
      <?php foreach ($orders as $order) { ?>
      <div class="order-list">
        <div class="heading-order-list">
          <div class="order-id"><b><?php echo $text_order_id; ?></b> <span>#<?php echo $order['order_id']; ?></span></div>
          <div class="order-status"><b><?php echo $text_status; ?></b> <span><?php echo $order['status']; ?></span></div>
        </div>
        <div class="order-content">
          <div><b><?php echo $text_date_added; ?></b> <span><?php echo $order['date_added']; ?></span><br />
            <b><?php echo $text_products; ?></b> <strong><?php echo $order['products']; ?></strong></div>
          <div><b><?php echo $text_customer; ?></b> <span><?php echo $order['name']; ?></span><br />
            <b><?php echo $text_total; ?></b> <span class="or-price"><?php echo $order['total']; ?></span></div>
          <div class="order-info"><a class="button" href="<?php echo $order['href']; ?>"><span><?php echo $button_view; ?></span></a>&nbsp;&nbsp;<a href="<?php echo $order['reorder']; ?>"><img src="catalog/view/theme/theme254/image/reorder.png" alt="<?php echo $button_reorder; ?>" title="<?php echo $button_reorder; ?>" /></a></div>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="buttons">
      <div class="right"><a href="<?php echo $continue; ?>" class="button-cont-right"><span><?php echo $button_continue; ?></span></a></div>
    </div>
      <div class="pagination"><?php echo $pagination; ?></div>
  </div>
  
  <?php } else { ?>
  <div class="box-container">
    <div class="content"><?php echo $text_empty; ?></div>
    <div class="buttons">
      <div class="right"><a href="<?php echo $continue; ?>" class="button-cont-right"><span><?php echo $button_continue; ?></span></a></div>
    </div>
   </div>
    <?php } ?>
  
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>