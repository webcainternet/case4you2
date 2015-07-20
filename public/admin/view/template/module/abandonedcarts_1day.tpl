<?php echo $header; ?>
<div id="content">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php echo (empty($data['AbandonedCarts']['LicensedOn'])) ? base64_decode('PGRpdiBjbGFzcz0iYWxlcnQgYWxlcnQtZXJyb3IiPjxpIGNsYXNzPSJpY29uLWV4Y2xhbWF0aW9uLXNpZ24iPjwvaT4gWW91IGFyZSBydW5uaW5nIGFuIHVubGljZW5zZWQgdmVyc2lvbiBvZiB0aGlzIG1vZHVsZSEgPGEgaHJlZj0iamF2YXNjcmlwdDp2b2lkKDApIiBvbmNsaWNrPSIkKCdhW2hyZWY9I3N1cHBdJykudHJpZ2dlcignY2xpY2snKSI+Q2xpY2sgaGVyZSB0byBlbnRlciB5b3VyIGxpY2Vuc2UgY29kZTwvYT4gdG8gZW5zdXJlIHByb3BlciBmdW5jdGlvbmluZywgYWNjZXNzIHRvIHN1cHBvcnQgYW5kIHVwZGF0ZXMuPC9kaXY+') : '' ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-error"><i class="icon-exclamation-sign"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
    <?php if (!empty($this->session->data['success'])) { ?>
    <div class="alert alert-success autoSlideUp"><i class="icon-ok-sign"></i> <?php echo $this->session->data['success']; ?></div>
    <script> $('.autoSlideUp').delay(3000).fadeOut(600, function(){ $(this).show().css({'visibility':'hidden'}); }).slideUp(600);</script>
    <?php $this->session->data['success'] = null; } ?>
    <div id="messageResult" style="display:none;"><div class="alert alert-success autoSlideUp2">The message was sent successfully!</div></div>
    <!--UPDATE INFO-->
	<?php if(!isset($data['AbandonedCarts']['Updated'])) { ?>
   		<div class="alert alert-error"><i class="icon-exclamation-sign"></i> This version of AbandonedCarts require changes in the database. <a onclick="upgrade();">Click here to update the database</a>.</div>
    <?php } ?>
	<!--UPDATE INFO-->
  <div class="box">
    <div class="box-heading">
    	<div class="currentStoreName btn-group">
        	<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
        		<?php echo $store['name']; if($store['store_id'] == 0) echo ' <strong>('.$text_default.')</strong>'; ?>&nbsp;<span class="caret"></span>
        	</a>
        	<ul class="dropdown-menu">
            	<?php foreach ($stores as $st) { ?>
            		<li <?php if($store['store_id'] == $st['store_id']){ echo 'class="disabled"';}?>>
            			<a href="index.php?route=module/abandonedcarts_1day&store_id=<?php echo $st['store_id'];?>&token=<?php echo $this->session->data['token']; ?>">
            				<?php echo $st['name']; ?>
            			</a>
            		</li>
            	<?php } ?>
        	</ul>
    	</div>
      <h1><i class="icon-shopping-cart"></i> <?php echo $heading_title; ?></h1>
    </div>
    <div class="content fadeInOnLoad">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<input type="hidden" name="store_id" value="<?php echo $store['store_id']; ?>">
        <?php if (isset($data['AbandonedCarts']['Updated'])) { ?>
        <input type="hidden" name="AbandonedCarts[Updated]" value="<?php echo $data['AbandonedCarts']['Updated']; ?>">
        <?php } ?>
        <div class="tabbable">
		  <div class="tab-navigation">
          <ul class="nav nav-tabs mainMenuTabs">
          	<li><a href="#controlpanel" data-toggle="tab"><i class="icon-wrench"></i> Control Panel</a></li>
            <li><a href="#abandonedCarts" data-toggle="tab" class="active"><i class="icon-shopping-cart"></i> Abandoned Carts</a></li>
            <li><a href="#mail" data-toggle="tab"><i class="icon-envelope"></i> Mail</a></li>
            <li class="dropdown">
              <a href="#"  data-toggle="dropdown" class="dropdown-toggle"><i class="icon-gift"></i> Coupons<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#givenCoupons" data-toggle="tab"/><i class="icon-gift"></i>Given Coupons</a></li>
                <li><a href="#usedCoupons" data-toggle="tab"/><i class="icon-ok"></i>Used Coupons</a></li>
              </ul>
            </li>
            <li><a href="#supp" data-toggle="tab"><i class="icon-share"></i> Support</a></li>
          </ul>
          <div class="tab-buttons">
            <button type="submit" class="btn btn-primary save-changes"><i class="icon-ok"></i> Save changes</button>
            <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="icon-remove"></i> Cancel</a>
          </div>
          </div>
         <div class="tab-content">
        	<div id="abandonedCarts" class="tab-pane active">
              <?php require_once(DIR_APPLICATION.'view/template/module/abandonedcarts_1day/tab_abandonedcarts.php'); ?>
            </div>
            <div id="mail" class="tab-pane">
              <?php require_once(DIR_APPLICATION.'view/template/module/abandonedcarts_1day/tab_mail.php'); ?>
            </div>
			<div id="controlpanel" class="tab-pane">
              <?php require_once(DIR_APPLICATION.'view/template/module/abandonedcarts_1day/tab_panel.php'); ?>
            </div>
            <div id="givenCoupons" class="tab-pane"></div>
            <div id="usedCoupons" class="tab-pane"></div>
			<div id="supp" class="tab-pane">
              <?php require_once(DIR_APPLICATION.'view/template/module/abandonedcarts_1day/tab_support.php'); ?>
            </div>
          </div><!-- /.tab-content -->
        </div><!-- /.tabbable -->
      </form>
    </div>
  </div>
</div>
<script>
if (window.localStorage && window.localStorage['currentTab']) {
	$('.mainMenuTabs a[href='+window.localStorage['currentTab']+']').trigger('click');
}
if (window.localStorage && window.localStorage['currentSubTab']) {
	$('a[href='+window.localStorage['currentSubTab']+']').trigger('click');
}
$('.fadeInOnLoad').css('visibility','visible');
$('.mainMenuTabs a[data-toggle="tab"]').click(function() {
	if (window.localStorage) {
		window.localStorage['currentTab'] = $(this).attr('href');
	}
});
$('a[data-toggle="tab"]:not(.mainMenuTabs a[data-toggle="tab"])').click(function() {
	if (window.localStorage) {
		window.localStorage['currentSubTab'] = $(this).attr('href');
	}
});
</script>
<script>
$(document).ready(refreshData());
  function refreshData(){
      $.ajax({
         url: "index.php?route=module/abandonedcarts_1day/givenCoupons&token=<?php echo $this->session->data['token']; ?>",
         type: 'get',
         dataType: 'html',
         success: function(data) {
          $('#givenCoupons').html(data);
         }
      });
      $.ajax({
         url: "index.php?route=module/abandonedcarts_1day/usedCoupons&token=<?php echo $this->session->data['token']; ?>",
         type: 'get',
         dataType: 'html',
         success: function(data) {
          $('#usedCoupons').html(data);
         }
      });
    }
</script>
<script>
function upgrade() {
	$.ajax({
		url: "index.php?route=module/abandonedcarts_1day/upgrade&token=<?php echo $this->session->data['token']; ?>",
		type: 'get',
		dataType: 'json',
		success: function(json) {
			if (json) {
				alert("The database was updated successfully!");
				location.reload();
			} else {
				alert("There was an unexpected error!");
			}
		}
	});
}
</script>
<?php echo $footer; ?>
