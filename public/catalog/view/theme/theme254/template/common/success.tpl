<?php echo $header; ?>
<!-- Google Code for Compra Conversion Page -->

<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 981933754;
    var google_conversion_language = "en";
    var google_conversion_format = "2";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "-AjECOabiAgQur2c1AM";
    var google_remarketing_only = false;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/981933754/?label=-AjECOabiAgQur2c1AM&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>

<?php echo $content_top; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>

  <div class="box-container">
    <h1><?php echo $heading_title; ?></h1>
    <?php echo $text_message; ?>

    <a id="bannerEbit"><img src="https://www.ebitempresa.com.br/bitrate/banners/b1614955.gif"></a>
    <script type="text/javascript" id="getSelo" src="https://imgs.ebit.com.br/ebitBR/selo-ebit/js/getSelo.js?61495">
    </script>
    <div class="buttons">
      <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
    </div>
  </div>
  </div>


<?php echo $footer; ?>
