<form class="form mailForm">
    <table class="form">
      <tr>
       <td width="20%"><span class="required">* </span>Type of discount:<span class="help">If you choose the option 'No discount', you will have to remove the following codes from the mail template: {discount_code}, {discount_value}, {total_amount} and {date_end}.</span></td>
       <td>
           <select name="AbandonedCarts[DiscountType]" > 
               <option value="P" <?php if(!empty($data['AbandonedCarts']['DiscountType']) && $data['AbandonedCarts']['DiscountType'] == "P") echo "selected"; ?>>Percentage</option>
               <option value="F" <?php if(!empty($data['AbandonedCarts']['DiscountType']) && $data['AbandonedCarts']['DiscountType'] == "F") echo "selected"; ?>>Fixed amount</option>
               <option value="N" <?php if(!empty($data['AbandonedCarts']['DiscountType']) && $data['AbandonedCarts']['DiscountType'] == "N") echo "selected"; ?>>No discount</option>
           </select>
       </td>
   </tr>
   <tbody id="discountSettings">
       <tr>
           <td><span class="required">* </span>Discount: <span class="help">Enter the discount percent or value.</span></td>
           <td>
                <div class="input-append">
                    <input type="text" name="AbandonedCarts[Discount]" value="<?php if(!empty($data['AbandonedCarts']['Discount'])) echo $data['AbandonedCarts']['Discount']; else echo '10'; ?>">
                    <span class="add-on">
                       <p style="display:none;" id="currencyAddon"><?php echo $currency ?></p>
                       <p style="display:none;" id="percentageAddon">%</p>
                   </span>
                </div>
           </td>	
        </tr>
        <tr>
           <td>Total amount: <span class="help">The total amount that must reached before the coupon is valid.</span></td>
           <td>
            <div class="input-append">
        <input type="text" name="AbandonedCarts[TotalAmount]" value="<?php if(!empty($data['AbandonedCarts']['TotalAmount'])) echo $data['AbandonedCarts']['TotalAmount']; else echo '20'; ?>">
                <span class="add-on"><?php echo $currency ?></span>
            </div>
        </td>
        </tr>
        <tr>
            <td><span class="required">* </span>Discount validity:<span class="help">Define how many days the discount code will be active after sending the reminder.</span></td>
            <td><div class="input-append">
                <input type="text" value="<?php if(!empty($data['AbandonedCarts']['DiscountValidity'])) echo (int)$data['AbandonedCarts']['DiscountValidity']; else echo 7; ?>" name="AbandonedCarts[DiscountValidity]">
               <span class="add-on">days</span> </div></td>
        </tr>
		<tr>
            <td><span class="required">* </span>Apply the discount for:<span class="help">Choose the products that the discount will apply to:</span></td>
            <td>
                <select name="AbandonedCarts[DiscountApply]" > 
                   <option value="all_products" <?php if(!empty($data['AbandonedCarts']['DiscountApply']) && $data['AbandonedCarts']['DiscountApply'] == "all_products") echo "selected"; ?>>All products in the store</option>
                   <option value="cart_products" <?php if(!empty($data['AbandonedCarts']['DiscountApply']) && $data['AbandonedCarts']['DiscountApply'] == "cart_products") echo "selected"; ?>>Products in the cart</option>
               </select></td>
        </tr>
	</tbody>
    <tr>
    <td><span class="required">*</span> Product image dimensions:<span class="help">Define the width the height of the product images.</span></td>
    <td>
        <div class="input-append">
            <input class="input-mini" id="appendedInput" type="text" name="AbandonedCarts[ProductWidth]" value="<?php echo (isset($data['AbandonedCarts']['ProductWidth'])) ? $data['AbandonedCarts']['ProductWidth'] : '60' ?>">
          <span class="add-on">px</span>
        </div>
        <br />
        <div class="input-append">
            <input class="input-mini" id="appendedInput" type="text" name="AbandonedCarts[ProductHeight]" value="<?php echo (isset($data['AbandonedCarts']['ProductHeight'])) ? $data['AbandonedCarts']['ProductHeight'] : '60' ?>">
          <span class="add-on">px</span>
        </div>
    </td>
    </tr>
    <tr>
        <td style="vertical-align:top;"><span class="required">* </span>Message to customer:<span class="help">Use the following shortcodes: <br /><br />
        {firstname} - First name<br />
        {lastname} - Last name<br />
        {cart_content} - Cart content<br />
        {discount_code} - Discount code<br />
        {discount_value} - Discount code<br />
        {total_amount} - Total amount<br />
        {date_end} - End date of coupon validity</span></td> 
        <td>
            <ul class="nav nav-tabs mainMenuTabs">
            <?php $class="active";  foreach ($languages as $language) { ?>
              <li class="<?php echo $class; ?>"><a href="#tab-<?php echo $language['code']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>"/> <?php echo $language['name']; ?></a></li>
            <?php  $class="";}?>
            </ul>
         <div class="tab-content">
        
			<?php $class=" active"; foreach ($languages as $language) { ?>
            <div id="tab-<?php echo $language['code']; ?>" language-id="<?php echo $language['code']; ?>" class="row-fluid tab-pane<?php echo $class; ?> language">
                <div class="emailLanguageWrapper">
                    Subject: <input placeholder="Mail subject" type="text" id="subject" name="AbandonedCarts[Subject][<?php echo $language['code']; ?>]" value="<?php if(!empty($data['AbandonedCarts']['Subject'][$language['code']])) echo $data['AbandonedCarts']['Subject'][$language['code']]; else echo "You abandoned your cart :("; ?>" />
                    <textarea id="DefaultMessage[<?php echo $language['code']; ?>]" name="AbandonedCarts[Message][<?php echo $language['code']; ?>]">
                        <?php if(!empty($data['AbandonedCarts']['Message'][$language['code']])) echo $data['AbandonedCarts']['Message'][$language['code']]; else echo '<table style="width:100%">
            <tbody>
                <tr>
                    <td align="center">
                    <table style="width:650px;margin:0 auto;border:1px solid #f0f0f0;padding:10px;line-height:1.8">
                        <tbody>
                            <tr>
                                <td>
                                <p>Hello <strong>{firstname} {lastname}</strong>,</p>
            
                                <p>We noticed that during you last visit to our store you placed the following products to you shopping cart and proceeded through checkout, but for some reason you did not complete the order:</p>
                                {cart_content}
            
                                <p>We do not know why you decided not to purchase this time, but we want to give you a special discount code - <strong>{discount_code}</strong> - which gives you <strong>{discount_value}% OFF</strong>. The code applies after you spent <strong>${total_amount}</strong>. This promotion is just for you and expires on <strong>{date_end}</strong>.</p>
            
                                <p>Kind Regards,</p>
            
                                <p>YourStore<br />
                                <a href="http://www.example.com" target="_blank">http://www.example.com</a></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
            </tbody>
            </table>'; ?>
               </textarea><br />
            </div>
            </div>
            <?php $class="";} ?>
        </div>
        </td>
    </tr>
    <tr>
        <td>Additional options:</td>
        <td>
            <label class="checkbox">
              <input type="checkbox" name="AbandonedCarts[RemoveAfterSend]" value="yes" <?php echo !empty($data['AbandonedCarts']['RemoveAfterSend']) ? 'checked="checked"' : ''; ?>/> Remove the abandoned cart record after the email is sent
            </label>
        </td>
    </tr>
</table>
</form>
<script type="text/javascript" >
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('DefaultMessage[<?php echo $language['code']; ?>]', { 
    filebrowserBrowseUrl: 'index.php?route=common/filemanager&token' + getURLVar('token'),
    filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserUploadUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
    filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
	height: '450px'
});
<?php } ?>
if($('select[name="AbandonedCarts[DiscountType]"]').val() == 'P'){
	$('#percentageAddon').show();
} else {
	$('#currencyAddon').show();
}
$('select[name="AbandonedCarts[DiscountType]').on('change', function(e){ 
	if($(this).val() == 'P') {
		$('#percentageAddon').show();
		$('#currencyAddon').hide();
	} else {
		$('#currencyAddon').show();
		$('#percentageAddon').hide();
	}	
	if($(this).val() == 'N') {
		$('#discountSettings').hide(300);
	} else {
		$('#discountSettings').show(300);
	}
});
if($('select[name="AbandonedCarts[DiscountType]"]').val() == 'N'){
	$('#discountSettings').hide();
} else {
	$('#discountSettings').show();
}
</script>