<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<p><?php echo $text_shipping_method; ?></p>
<table class="form">
  <?php foreach ($shipping_methods as $shipping_method) { ?>
  <tr>
    <td colspan="3"><b><?php echo $shipping_method['title']; ?></b></td>
  </tr>
  <?php if (!$shipping_method['error']) { ?>
  <?php foreach ($shipping_method['quote'] as $quote) { ?>
  <tr>
    <td style="width: 1px;"><?php if ($quote['code'] == $code || !$code) { ?>
      <?php $code = $quote['code']; ?>
      <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
      <?php } else { ?>
      <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" />
      <?php } ?></td>
    <td><label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label></td>
    <td style="text-align: right;"><label for="<?php echo $quote['code']; ?>"><?php echo $quote['text']; ?></label></td>
  </tr>
  <?php } ?>
  <?php } else { ?>
  <tr>
    <td colspan="3">
      <?php
        if (
            $shipping_method['error'] != "PAC: CEP de destino invalido." && 
            $shipping_method['error'] != "SEDEX: CEP de destino invalido." && 
            $shipping_method['error'] != "SEDEX 10: CEP de destino invalido."
          ) { ?>
          <div class="error"><?php echo $shipping_method['error']; ?></div>    
        <?php } else { ?>
          <div style="color: #8e8e8e;" >
          CEP deve ser preenchido corretamente.
          </div>    
        <?php }
      
    </td>
  </tr>
  <?php } ?>
  <?php } ?>
</table>
<?php } ?>