<?php
	if(!empty($selections))
	{
?>	
	<div class="row form-group">
	  <div class="col-xs-10"><strong>Upcoming:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('selections/index/'); ?>' id="upcoming"><?php echo $selections['upcome']; ?></a></div>
	</div>
	<div class="row form-group">
	  <div class="col-xs-10"><strong>Overdue:</strong></div>
	  <div class="col-xs-2 text-center warranty-count"><a href='<?php echo $this->crypt->encrypt('selections/index/'); ?>' id="overdue"><?php echo $selections['overdue']; ?></a></div>
	</div>
<?php
	}
	else
	{
?>
	<div class="text-center"><img src="<?php echo IMAGESRC.'no_info_found.png'; ?>" border="0"/></div>
 <?php			
	}
?>

