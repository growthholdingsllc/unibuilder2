<?php
	if(!empty($all_schedule))
	{
		if(TRUE == $all_schedule['status'])
		{
			foreach($all_schedule['aaData'] as $key=>$val)
			{
			//echo '<pre>';print_r($val);exit;
?>				
<div class="row-loop"><a href='<?php echo $this->crypt->encrypt('schedules/save_schedule/'.$val['ub_schedule_id']); ?>'><?php echo $val['title']; ?>:</a><span class="pull-right text-muted">On <?php echo $val['start_date']; ?></span></div>
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

