<!-- File with the button redirect to PagSeguro  -->
 <?php /*
<script type="text/javascript">
$(window).load(function() {
    $("#psconfirm").click();
  });
</script>
*/ ?> 

<form name="frps1" id="frps1" action="<?php echo $action; ?>" method="post">
    <div class="buttons">
    <div class="right">
      <input id="psconfirm" type="submit" value="AAA<?php echo $button_confirm; ?>" class="button" />
    </div>
  </div>
     <input type="hidden" id="url_ps" name="url_ps" value="<?php echo $url_ps; ?>">
</form>

<script type="text/javascript">
//document.getElementById("frps1").submit();
</script> 