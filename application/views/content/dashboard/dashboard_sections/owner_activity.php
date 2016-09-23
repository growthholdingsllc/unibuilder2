<?php
	if(isset($all_owner_activity) && !empty($all_owner_activity))
	{
		if(TRUE == $all_owner_activity['status'])
		{
			foreach($all_owner_activity['aaData'] as $key=>$val)
			{
			//echo '<pre>';print_r($val);exit;
?>
<div class="col-xs-12 row-loop">
<h5><?php echo $val['project_name'];?> project owner last logged in on</h5>
<h6><?php echo $val['last_login_time'];?></h6>
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