<table class="form">
  <tr>
    <td><span class="required">*</span> <?php echo $entry_code; ?></td>
    <td>
        <select name="AbandonedCarts[Enabled]" class="AbandonedCartsEnabled">
          <option value="yes" <?php echo (!empty($data['AbandonedCarts']['Enabled']) && $data['AbandonedCarts']['Enabled'] == 'yes') ? 'selected=selected' : '' ?>>Enabled</option>
          <option value="no"  <?php echo (empty($data['AbandonedCarts']['Enabled']) || $data['AbandonedCarts']['Enabled']== 'no') ? 'selected=selected' : '' ?>>Disabled</option>
        </select>
   </td>
  </tr>
	<tr>
      <td><span class="required">*</span> Scheduled tasks:<span class="help">When activated, this function will send automatically emails to the customers who abandoned their carts.</span></td>
      <td><select id ="ScheduleToggle" name="AbandonedCarts[ScheduleEnabled]">
          <option value="yes" <?php echo (!empty($data['AbandonedCarts']['ScheduleEnabled']) && $data['AbandonedCarts']['ScheduleEnabled'] == 'yes') ? 'selected=selected' : '' ?>>Enabled</option>
          <option value="no"  <?php echo (empty($data['AbandonedCarts']['ScheduleEnabled']) || $data['AbandonedCarts']['ScheduleEnabled']== 'no') ? 'selected=selected' : '' ?>>Disabled</option>
        </select></td>
    </tr>
</table>
<table class="form cronForm" id="mainSettings" style="<? echo (!empty($data['AbandonedCarts']['ScheduleEnabled']) && $data['AbandonedCarts']['ScheduleEnabled'] == 'yes') ? '' : 'display:none;'; ?>">
	<tr>
    <td width="25%"><span class="required">*</span> Delay:<span class="help">After the defined days in the field the cart will be considered abandoned and can be sent a reminder</span></td>
    <td>
        <div class="input-append">
                    <input class="input-mini" id="appendedInput" type="text" name="AbandonedCarts[Delay]" value="<?php echo (isset($data['AbandonedCarts']['Delay'])) ? $data['AbandonedCarts']['Delay'] : '3' ?>">
                  <span class="add-on">days</span>
		</div>
   </td>
  </tr>
  <tr>
  <tr>
    <td width="25%"><span class="required">*</span> Type:</td>
    <td><select name="AbandonedCarts[ScheduleType]">
        <option value="F" <?php if(!empty($data['AbandonedCarts']['ScheduleType']) && $data['AbandonedCarts']['ScheduleType'] == 'F') echo "selected" ?>>Fixed dates</option>
        <option value="P" <?php if(!empty($data['AbandonedCarts']['ScheduleType']) && $data['AbandonedCarts']['ScheduleType'] == 'P') echo "selected" ?>>Periodic</option>
      </select></td>
  </tr>
  <tr>
    <td><span class="required">*</span> Schedule:</td>
    <td><div id="FixedDateOptions">
		<div class="input-prepend">
           <span class="add-on"><i class="icon-calendar"></i></span>
           <input type="text" id="FixedDate" class="input-small" value="" placeholder="Date..." readonly />
        </div>
        <div class="input-prepend">
           <span class="add-on"><i class="icon-time"></i></span>
        <input type="text" id="FixedDateTime" class="timepicker input-small" placeholder="Time..." readonly />
        </div>
        <button class="btn addDate" style="margin-top:-10px;"><i class="icon-plus"></i> Add</button>
        <div class="scrollbox dateList">
        	<?php if(isset($data['AbandonedCarts']['FixedDates'])) { 
					foreach($data['AbandonedCarts']['FixedDates'] as $date) {?>
          	<div id="date<?php  $id = explode( '/', $date); $id=explode('.' , $id[0]); echo $id[0].$id[1].$id[2]; ?>"><?php echo $date ?> 
            <i class="icon-minus-sign removeIcon"></i>
            <input type="hidden" name="AbandonedCarts[FixedDates][]" value="<?php echo $date ?>" />
            </div>
					<?php } } ?> 
         </div>
      </div>
      <div id="PeriodicOptions">
        <div id="CronSelector"></div>
        <input type="hidden" name="AbandonedCarts[PeriodicCronValue]" value="">
      </div></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;">
      <button id="TestCronAvailablity" class="btn btn-warning"><i class="icon-asterisk"></i> Test Cron</button>
	</td>
	<td>
	  <div class="well">
      	<i class="icon-question-sign"></i> If you want to use the scheduling features, your server has to support <strong>Cron</strong> functions.<br /><br />The cron daemon is a long running process that executes commands at specific dates and times. By clicking on the button <strong>Test Cron</strong> you can check if your server supports <strong>Cron</strong> commands<br /><br />If your server does support Cron jobs, but this script shows that the feature is disabled, this means that the automatic creation of Cron commands is disabled. In that case, you can use this URL string - <strong>vendors/abandonedcarts/sendReminder.php</strong> - in your hosting config panel.
      </div>  
    </td>
  </tr>
</table>
<script>
$('#TestCronAvailablity').colorbox({
	href: 'index.php?route=module/abandonedcarts/testcron&token=' + getURLVar('token'),
	width: "50%",
	height: "65%"
});
// Date & Time picker
$(document).ready(function() {	
	$('#FixedDate').datepicker({ dateFormat: "dd.mm.yy" });
	$('.timepicker').timepicker();
	$('#CronSelector').cron({
		  initial: "<?php if(!empty($data['AbandonedCarts']['PeriodicCronValue'])) echo $data['AbandonedCarts']['PeriodicCronValue']; else echo "* * * * *";  ?>",
    onChange: function() {
        $('input[name="AbandonedCarts[PeriodicCronValue]"').val($(this).cron("value"));		 
    },
		});
});
	if($('select[name="AbandonedCarts[ScheduleType]"]').val() == 'P') {
		$('#FixedDateOptions').hide();
	 	$('#PeriodicOptions').show(200);
	} else {
		$('#PeriodicOptions').hide();
		$('#fixedDateOptions').show(200);	
	}
$('select[name="AbandonedCarts[ScheduleType]"]').on('change', function(e){ 
	if($(this).val() == 'P') {
		$('#FixedDateOptions').hide();
	 	$('#PeriodicOptions').show(200);	
	} else {
		$('#PeriodicOptions').hide();
		$('#FixedDateOptions').show(200);	
		}	
});
$('.btn.addDate').on('click', function(e){
		e.preventDefault();
		if($('#FixedDate').val() && $('#FixedDateTime').val() ){
		//	$('#date' + $('#FixedDate').val().replace(/\./g, '')).remove();
			$('.scrollbox.dateList').append('<div id="date' + $('#FixedDate').val().replace(/\./g,'') + '">' + $('#FixedDate').val() + '/' + $('#FixedDateTime').val() +'<i class="icon-minus-sign removeIcon"></i><input type="hidden" name="AbandonedCarts[FixedDates][]" value="' + $('#FixedDate').val() + '/' + $('#FixedDateTime').val() + '" /></div>');
			$('#FixedDate').val('');
			$('#FixedDateTime').val('');
		} else {
				alert('Please fill date and time!');
			}
});
$('.scrollbox.dateList div .removeIcon').live('click', function() {
	$(this).parent().remove();
});
// Hide & Show Scheduled table
$(function() {
    var $typeSelector = $('#ScheduleToggle');
    var $toggleArea = $('#mainSettings');
	 
    $typeSelector.change(function(){
        if ($typeSelector.val() === 'yes') {
            $toggleArea.show(500) 
        }
        else {
            $toggleArea.hide(500);
        }
    });
});
</script>