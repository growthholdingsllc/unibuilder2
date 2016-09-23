<?php
$builder = BUILDERADMIN;
$owner = OWNER;
$subcontractor = SUBCONTRACTOR;
if(!empty($all_comments))
{
	if(TRUE == $all_comments['status'])
	{
		$comment_image = '';
		foreach($all_comments['aaData'] as $val)
		{
			if($val['account_type'] == $owner)
			{
				$comment_image = 'uni_owner';
			}
			if($val['account_type'] == $subcontractor)
			{
				$comment_image = 'uni_sub';
			}
			if($val['account_type'] == $builder)
			{
				$comment_image = 'uni_builder';
			}
?>
<div class="col-xs-12 row-loop">
  <div class="col-xs-1"><img border="0" class="<?php echo $comment_image;?>" src="<?php echo IMAGESRC.'strip.gif'; ?>"></div>
  <div class="col-xs-10">
	<p id="comment_description"><strong><a href='<?php echo base_url().$this->crypt->encrypt('messages/index/').'#comments'; ?>'><?php echo $val['creator']; ?></a> Posted on <?php echo $val['created_on']; ?></strong> </p>
	<p class="text-muted"><?php echo $val['comments']; if($val['length']>75) echo ".......";?></p>
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

