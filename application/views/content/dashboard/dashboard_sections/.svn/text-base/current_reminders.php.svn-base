<?php
	if(!empty($all_reminder))
	{
		if(TRUE == $all_reminder['status'])
		{
			foreach($all_reminder['aaData'] as $key=>$val)
			{
			//echo '<pre>';print_r($val);exit;
?>	
<div class="row-loop"><a href='#<?php //echo $this->crypt->encrypt('schedules/save_schedule/'.$val['ub_schedule_id']); ?>'><?php echo $val['message']; ?>:</a><span class="pull-right text-muted">On <?php echo $val['reminder_end_time']; ?></span></div>
<?php
			}
		}
		else
		{
?>
		 <div class="text-center"><img src="<?php echo IMAGESRC.'no_info_found.png'; ?>" border="0"/></div>
 <?php			
		}
	}
?>