<div class="row">
	<div class="col-xs-12">
		<div class="error-con">
		<!--<img src="<?php echo IMAGESRC.'error_404.png'; ?>" />-->
		<?php
		$dashboard = '';
		if($this->user_account_type == BUILDERADMIN)
		{
		$dashboard = 'builder_dashboard/index/';
		}
		else if($this->user_account_type == SUBCONTRACTOR)
		{
		$dashboard = 'subcontractor_dashboard/index/';
		}
		else if($this->user_account_type == OWNER)
		{
		$dashboard = 'owner_dashboard/index/';
		}
		?>
		<p>Please upgrade your plan to create more user.<a href="<?php echo base_url().$this->crypt->encrypt($dashboard); ?>">Dashboard</a></p>
		</div>
	</div>
</div>