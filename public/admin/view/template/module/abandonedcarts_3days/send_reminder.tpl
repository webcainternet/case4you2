<?php $this->load->model('tool/image'); ?>

<div style="padding:10px 10px 0px 10px;">
	<div id="SendReminderSuccess"></div>
    <?php $result['customer_info'] = json_decode($result['customer_info'], true); ?>
    <form id="SendReminderCustomForm">
    	<input type="hidden" name="ABcart_id" value="<?php echo $_GET['id']; ?>" />
        <input type="hidden" name="AB_store" value="<?php echo $_GET['store_id']; ?>" />
        <table class="table">
            <tr>
              <td width="33%"><label>To: <strong><?php if(!empty($result['customer_info']['email'])) echo $result['customer_info']['email']; ?></strong></label></td>
              <td width="33%"><label>Name: <strong><?php echo $result['customer_info']['firstname']." ". $result['customer_info']['lastname']; ?></strong></label></td>
              <td width="33%"><label>Phone: <strong><?php echo $result['customer_info']['telephone']; ?></strong></label></td>
            </tr>
        </table>
    <table class="form">
      <tr>
       <td width="20%"><span class="required">* </span>Type of discount:</td>
       <td>
           <select name="DiscountType" >
               <option value="P" <?php if(!empty($data['AbandonedCarts']['DiscountType']) && $data['AbandonedCarts']['DiscountType'] == "P") echo "selected"; ?>>Percentage</option>
               <option value="F" <?php if(!empty($data['AbandonedCarts']['DiscountType']) && $data['AbandonedCarts']['DiscountType'] == "F") echo "selected"; ?>>Fixed amount</option>
			   <option value="N" <?php if(!empty($data['AbandonedCarts']['DiscountType']) && $data['AbandonedCarts']['DiscountType'] == "N") echo "selected"; ?>>No discount</option>
           </select>
       </td>
   </tr>
   <tbody id="discountSettings1">
           <tr>
               <td><span class="required">* </span>Discount:</td>
               <td>
                <div class="input-append">
                    <input type="text" name="Discount" value="<?php if(!empty($data['AbandonedCarts']['Discount'])) echo $data['AbandonedCarts']['Discount']?>">
                    <span class="add-on">
                       <p style="display:none;" id="currencyAddon_custom"><?php echo $currency ?></p>
                       <p style="display:none;" id="percentageAddon_custom">%</p>
                   </span>
               </div>
           </td>
        </tr>
        <tr>
           <td>Total amount: <span class="help">The total amount that must reached before the coupon is valid.</span></td>
           <td>
            <div class="input-append">
                <input type="text" name="TotalAmount" value="<?php if(!empty($data['AbandonedCarts']['TotalAmount'])) echo $data['AbandonedCarts']['TotalAmount']?>">
                <span class="add-on"><?php echo $currency ?></span>
            </div>
        </td>
        </tr>
        <tr>
            <td><span class="required">* </span>Discount validity:<span class="help">Define how many days the discount code will be active after sending the reminder.</span></td>
            <td><div class="input-append">
                <input type="text" value="<?php if(!empty($data['AbandonedCarts']['DiscountValidity'])) echo (int)$data['AbandonedCarts']['DiscountValidity']; else echo 7; ?>" name="DiscountValidity">
               <span class="add-on">days</span> </div></td>
        </tr>
		<tr>
            <td><span class="required">* </span>Apply the discount for:<span class="help">Choose the products that the discount will apply to:</span></td>
            <td>
                <select name="DiscountApply" >
                   <option value="all_products" <?php if(!empty($data['AbandonedCarts']['DiscountApply']) && $data['AbandonedCarts']['DiscountApply'] == "all_products") echo "selected"; ?>>All products in the store</option>
                   <option value="cart_products" <?php if(!empty($data['AbandonedCarts']['DiscountApply']) && $data['AbandonedCarts']['DiscountApply'] == "cart_products") echo "selected"; ?>>Products in the cart</option>
               </select></td>
        </tr>
</tbody>
<tr>
    <td><span class="required">*</span> Product image dimensions:</td>
    <td>
        <div class="input-append">
			<input class="input-mini" id="appendedInput" type="text" name="ProductWidth" value="<?php echo (isset($data['AbandonedCarts']['ProductWidth'])) ? $data['AbandonedCarts']['ProductWidth'] : '60' ?>">
          <span class="add-on">px</span>
        </div>
        <br />
		<div class="input-append">
			<input class="input-mini" id="appendedInput" type="text" name="ProductHeight" value="<?php echo (isset($data['AbandonedCarts']['ProductHeight'])) ? $data['AbandonedCarts']['ProductHeight'] : '60' ?>">
          <span class="add-on">px</span>
        </div>
   </td>
  </tr>
<tr>
   <td><span class="required">* </span>Subject: </td>
   <td><input placeholder="Mail subject" type="text" id="subject" name="Subject" value="<?php if (isset($result['customer_info']['language'])) echo $data['AbandonedCarts']['Subject'][$result['customer_info']['language']]; else echo $data['AbandonedCarts']['Subject'][$firstLanguageCode]; ?>" />
   </tr>
   <tr>
       <td><span class="required">* </span>Message to customer:<span class="help">Use the following shortcodes: <br /><br />
		{firstname} - First name<br />
		{lastname} - Last name<br />
        {cart content} - Cart content<br />
		{discount_code} - Discount code<br />
        {discount_value} - Discount code<br />
		{total_amount} - Total amount<br />
        {date_end} - End date of coupon validity</span></td>
       <td>
           <textarea id="Message_Custom1" name="CustomMessage">
               <?php if (isset($result['customer_info']['language'])) echo $data['AbandonedCarts']['Message'][$result['customer_info']['language']]; else echo $data['AbandonedCarts']['Message'][$firstLanguageCode]; ?>
           </textarea>
       </td>
   </tr>
   <tr>
    <td>Additional options:</td>
    <td>
        <label class="checkbox">
          <input type="checkbox" name="RemoveAfterSend" value="yes" <?php echo !empty($data['AbandonedCarts']['RemoveAfterSend']) ? 'checked="checked"' : ''; ?>/>
         Remove the abandoned cart after the email is sent
        </label>
   </td>
  </tr>
</table>
		<a class="btn btn-primary" id="sendMail">Send mail!</a>
    </form>
</div>
<script type="text/javascript">
CKEDITOR.replace('Message_Custom1', {
    filebrowserBrowseUrl: 'index.php?route=common/filemanager&token' + getURLVar('token'),
    filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserUploadUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token')
});
if($('select[name="DiscountType"]').val() == 'P'){
	$('#percentageAddon_custom').show();
} else {
	$('#currencyAddon_custom').show();
}
$('select[name="DiscountType"]').on('change', function(e){
	if($(this).val() == 'P') {
		$('#percentageAddon_custom').show();
		$('#currencyAddon_custom').hide();
	} else {
		$('#currencyAddon_custom').show();
		$('#percentageAddon_custom').hide();
	}
	if($(this).val() == 'N') {
		$('#discountSettings1').hide(300);
	} else {
		$('#discountSettings1').show(300);
	}
});

if($('select[name="DiscountType"]').val() == 'N'){
	$('#discountSettings1').hide();
} else {
	$('#discountSettings1').show();
}


$('#sendMail').on('click', function(){
  	CKEDITOR.instances.Message_Custom1.updateElement();
	var email_validate = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var email = "<?php echo $result['customer_info']['email']; ?>";
	if (!email.match(email_validate)) {
		alert("The email entered by the customer is invalid.")
	} else {
		$.ajax({
			url: 'index.php?route=module/abandonedcarts_3days/sendcustomemail&token=' + getURLVar('token'),
			type: 'post',
			data: $('#SendReminderCustomForm').serialize(),
			success: function(response) {
				parent.$.fn.colorbox.close();
				 $('#messageResult').show();
				 $('#messageResult').delay(3000).fadeOut(600, function(){
					  $(this).show().css({'visibility':'hidden'});
				 }).slideUp(600);
			}
		});
	}
});
</script>
