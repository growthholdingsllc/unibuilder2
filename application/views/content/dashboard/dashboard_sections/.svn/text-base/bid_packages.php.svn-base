<?php
	if(!empty($all_bid_request))
	{
		if(TRUE == $all_bid_request['status'])
		{
			$response_required_count = 0;
			$won_count = 0;
			$lost_count = 0;
			$response_required_status = '';
			$won_status = '';
			$lost_status = '';
			foreach($all_bid_request['aaData'] as $key=>$val)
			{
				if(isset($val['bid_sub_status']) && strtolower($val['bid_sub_status']) == strtolower("Released"))
				{
					$response_required_count = $val['count'];
					$response_required_status = $val['bid_sub_status'];
					
				}
				else if(isset($val['bid_sub_status']) && strtolower($val['bid_sub_status']) == strtolower("Accepted"))
				{
					$won_count = $val['count'];
					$won_status = $val['bid_sub_status'];
				}
				else if(isset($val['bid_sub_status']) && strtolower($val['bid_sub_status']) == strtolower("Rejected"))
				{
					$lost_count = $val['count'];
					$lost_status = $val['bid_sub_status'];
				}
			}
?>	
	<div class="row form-group">
	<div class="col-xs-10"><strong>Response required:</strong></div>
	 <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('bids/bid_request_list/'); ?>' id="<?php echo $response_required_status; ?>"><?php echo $response_required_count; ?></a></div>
</div>
<div class="row form-group">
	<div class="col-xs-10"><strong>Won:</strong></div>
	 <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('bids/bid_request_list/'); ?>' id="<?php echo $won_status; ?>"  ><?php echo $won_count; ?></a></div>
</div>
<div class="row form-group">
	<div class="col-xs-10"><strong>Lost:</strong></div>
	 <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('bids/bid_request_list/'); ?>' id="<?php echo $lost_status; ?>"  ><?php echo $lost_count; ?></a></div>
</div>
<?php
		}
		else
		{
?>
		 <div class="text-center"><img src="<?php echo IMAGESRC.'no_info_found.png'; ?>" border="0"/></div>
 <?php			
		}
	}
?>


