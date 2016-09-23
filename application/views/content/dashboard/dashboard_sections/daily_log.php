<?php
	if(!empty($all_logs))
	{
		if(TRUE == $all_logs['status'])
		{
			foreach($all_logs['aaData'] as $val)
			{
			//echo '<pre>';print_r($val);exit;
?>				
			<div class="row-loop">
              <p><strong><a href='<?php echo $this->crypt->encrypt('logs/save_log/'.$val['ub_daily_log_id']); ?>' ><?php echo $val['creator'] ?></a> added a daily log on</strong> </p>
              <p class="text-muted"><?php echo $val['log_date'] ?></p>
            </div>
           
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

