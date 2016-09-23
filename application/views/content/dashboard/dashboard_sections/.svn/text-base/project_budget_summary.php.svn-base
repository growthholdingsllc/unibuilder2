<?php
	if(isset($project_cost_summary) && !empty($project_cost_summary))
	{
		if(TRUE == $project_cost_summary['status'])
		{
?>
<div class="form-group"><strong>Estimated Revenue:</strong><span class="pull-right"><?php echo $project_cost_summary['aaData'][0]['total_contract_price'];?></span></div>
<div class="form-group"><strong>Change Orders:</strong><span class="pull-right"><?php echo $project_cost_summary['aaData'][0]['co_awarded_amount'];?></span></div>
<div class="form-group"><strong>Paid By Client Till Date:</strong><span class="pull-right"><?php echo $project_cost_summary['aaData'][0]['total_paid_by_client_to_date'];?></span></div>
<div class="form-group"><strong>Paid To Vendors:</strong><span class="pull-right"><?php echo $project_cost_summary['aaData'][0]['total_amount_paid_to_sub'];?></span></div>
<div class="form-group"><strong>Unpaid Paid Client Billing:</strong><span class="pull-right text-danger"><?php echo $project_cost_summary['aaData'][0]['unpaid_client_billing'];?></span></div>
<div class="form-group"><strong>Owed To Sub:</strong><span class="pull-right text-danger"><?php echo $project_cost_summary['aaData'][0]['balance_owed_to_sub'];?></span></div>
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