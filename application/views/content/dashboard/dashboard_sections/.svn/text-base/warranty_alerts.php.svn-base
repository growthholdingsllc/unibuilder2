<?php
	if(!empty($all_warranty))
	{
		if(TRUE == $all_warranty['status'])
		{
			$new_count = 0;
			$Reschedule_count = 0;
			$Needs_Rework_count = 0;
			$new_status = '';
			$Reschedule_status = '';
			$Rework_status = '';
			foreach($all_warranty['aaData'] as $key=>$val)
			{
				if(isset($val['status']) && $val['status'] == "New")
				{
					$new_count = $val['count'];
					$new_status = $val['status'];
					
				}elseif(isset($val['status']) && $val['status'] == "Reschedule Appt.")
				{
					$Reschedule_count = $val['count'];
					$Reschedule_status = $val['status'];
				}elseif(isset($val['status']) && $val['status'] == "Needs Rework")
				{
					$Needs_Rework_count = $val['count'];
					$Rework_status = $val['status'];
				}
			}
?>	
	<div class="row form-group">
	  <div class="col-xs-10"><strong>New Claims:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='javascript:void(0);' id="<?php echo $new_status; ?>"  onclick="warranty_index(this.id)"><?php echo $new_count; ?></a></div>
	</div>
	<div class="row form-group">
	  <div class="col-xs-10"><strong>Reschedule Request:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='javascript:void(0);' id="<?php echo $Reschedule_status; ?>" onclick="warranty_index(this.id)"><?php echo $Reschedule_count; ?></a></div>
	</div>
	<div class="row form-group">
	  <div class="col-xs-10"><strong>Feedback Needing Rework:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='javascript:void(0);' id="<?php echo $Rework_status; ?>" onclick="warranty_index(this.id)"><?php echo $Needs_Rework_count; ?></a></div>
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

