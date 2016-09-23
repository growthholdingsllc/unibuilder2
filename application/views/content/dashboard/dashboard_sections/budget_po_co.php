<?php
	if(!empty($all_po_co))
	{
		if(TRUE == $all_po_co['status'])
		{	
			$approval_count = 0;
			$received_count = 0;
			$pending_count = 0;
			$approval = '';
			$received = '';
			$pending = '';
			foreach($all_po_co['aaData'] as $key=>$val)
			{
				if(isset($val['payment_status']) && strtolower($val['payment_status']) == strtolower("Ready For Payment"))
				{
					$approval_count = $val['count'];
					$approval = $val['payment_status'];	
				}
				else if(isset($val['payment_status']) && (strtolower($val['payment_status']) == strtolower("Paid") || strtolower($val['payment_status']) == strtolower("Partial payment done")))
				{
					$received_count = $received_count + $val['count'];
					$received = $val['payment_status'];
				}
				else if(isset($val['payment_status']) && (strtolower($val['payment_status']) == strtolower("Approved") || strtolower($val['payment_status']) == strtolower("Rejected")))
				{
					$pending_count = $pending_count + $val['count'];
					$pending = $val['payment_status'];
				}
			}
?>	
	<div class="row form-group">
	  <div class="col-xs-10"><strong>Waiting for approval:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('budget/subcontractor_po/'); ?>' id="<?php echo $approval; ?>"><?php echo $approval_count; ?></a></div>
	</div>
	<div class="row form-group">
	  <div class="col-xs-10"><strong>Payment Received:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('budget/subcontractor_po/'); ?>' id="<?php echo $received; ?>"><?php echo $received_count; ?></a></div>
	</div>
	<div class="row form-group">
	  <div class="col-xs-10"><strong>Payment Pending:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('budget/subcontractor_po/'); ?>' id="<?php echo $pending; ?>"><?php echo $pending_count; ?></a></div>
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


