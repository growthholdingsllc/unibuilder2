<?php
if(!empty($all_tasks))
{
	if(TRUE == $all_tasks['status'])
	{
		foreach($all_tasks['aaData'] as $val)
		{
			if($val['DiffDate'] > 0)
			{
				$class = 'danger pull-right';
				$task_date = 'Over due';
			}
			if($val['DiffDate'] == 0)
			{
				$class = 'success pull-right';
				$task_date = 'Today';
			}
			if($val['DiffDate'] < 0)
			{
				$class = 'warning pull-right';
				$task_date = 'Tomorrow';
			}
?>
	<div class="task-alert"> <span class="task-name"><a href='<?php echo $this->crypt->encrypt('task/save_task/'.$val['ub_task_id']); ?>' ><?php echo $val['title'] ?></a></span> <span class="<?php echo $class;?>" role="alert"><strong><?php echo $task_date;?></strong></span> </div>
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

