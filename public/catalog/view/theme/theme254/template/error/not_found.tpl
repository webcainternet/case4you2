<?php echo $header; ?>
<?php echo $content_top; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>

  <div class="box-container">
    <h1><?php echo $heading_title; ?></h1>
    <div class="content"><?php echo $text_error; ?></div>
    <div class="buttons">
      <div class="right"><a href="<?php echo $continue; ?>" ><span class="button-return-right"><?php echo $button_continue; ?></span></a></div>
    </div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>