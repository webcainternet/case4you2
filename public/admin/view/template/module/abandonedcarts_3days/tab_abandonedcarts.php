<div id="abandonedCartsWrapper<?php echo $store['store_id']; ?>"> </div>
<script>
    $(document).ready(function(){
         $.ajax({
            url: "index.php?route=module/abandonedcarts_3days/getabandonedcarts&token=<?php echo $this->session->data['token']; ?>&page=1&store_id=<?php echo $store['store_id']; ?>",
            type: 'get',
            dataType: 'html',
            success: function(data) {
                $("#abandonedCartsWrapper<?php echo $store['store_id']; ?>").html(data);
            }

         });
    });
</script>
<script>
	$('a[data-event-id]').live('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		$.colorbox({
			href:$(this).attr('href'),
			width: "90%",
			height: "90%",
			onCleanup: function() {
				CKEDITOR.instances['Message_Custom1'].destroy();
			}
		});
	});
	function removeItem(cartID) {
				var r=confirm("Are you sure you want to remove this entry?");
				if (r==true) {
					$.ajax({
						url: 'index.php?route=module/abandonedcarts_3days/removeabandonedcart&token=<?php echo $this->session->data['token']; ?>',
						type: 'post',
						data: {'cart_id': cartID},
						success: function(response) {
						location.reload();
					}
				});
			 }
			}
</script>
