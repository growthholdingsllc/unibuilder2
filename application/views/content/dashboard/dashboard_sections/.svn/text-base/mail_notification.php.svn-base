<?php
	if(!empty($all_mail_notification))
	{
		if(TRUE == $all_mail_notification['status'])
		{
			foreach($all_mail_notification['aaData'] as $key=>$val)
			{
			//echo '<pre>';print_r($val);exit;
?>
<div class="col-xs-12 row-loop">
  <div class="col-xs-1"><img border="0" src="<?php echo IMAGESRC.'msg.png'; ?>"></div>
  <div class="col-xs-10">
	<p class="owner-name"><strong><?php echo $val['creator'];?> - <?php echo $val['role_name'];?></strong></p>
	<p class="text-muted"><a href="<?php echo base_url().$this->crypt->encrypt('messages/index/').'#notfication'; ?>">Sub: <?php echo $val['subject']; ?></a></p>
  </div>
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