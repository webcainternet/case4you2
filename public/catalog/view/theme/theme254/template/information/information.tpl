<?php echo $header; ?>
<?php echo $content_top; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php
      if (strrpos(strtolower($breadcrumb['text']), 'personalizadas') !== FALSE) {
        echo $breadcrumb['separator'];
        echo '<a href="' . E_HTTP . 'criar-capinha-personalizada" title="Criar Capinha Personalizada">Criar Capinha Personalizada</a>';
      }
    ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php
    if (strtolower($breadcrumb['text']) == 'principal') {
      $breadcrumb['text'] = 'Case4You';
    }


    echo $breadcrumb['text'];
    ?></a>
    <?php } ?>
  </div>

  <div class="box-container">
    <h1><?php echo $heading_title; ?></h1>
    <?php echo $description; ?>
    <div class="buttons">
      <div class="right"><a href="<?php echo $continue; ?>" class="button-inf-left"><span>Criar capinha personalizada</span></a></div>
    </div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>
