<div class="row">
	<div class="col-xs-12">
		<div class="error-con">
		<img src="<?php echo IMAGESRC.'error_404.png'; ?>" />
		<p>The page you are looking for could have been deleted or never have existed go back 
		<?php
		if(isset($this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['TEMPLATE']['VIEW_NAME']['display_type']) && $this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['TEMPLATE']['VIEW_NAME']['display_type'] == 'template_view')
		{
		?>
			<a href="<?php echo base_url().$this->crypt->encrypt('template/projects/index/'); ?>">Template List</a>
		<?php
		}		
		else if($this->user_account_type == BUILDERADMIN)
		{
		?>
			<a href="<?php echo base_url().$this->crypt->encrypt('builder_dashboard/index/'); ?>">Dashboard</a> 
		<?php 
		}
		else if($this->user_account_type == SUBCONTRACTOR)
		{
		?>
			<a href="<?php echo base_url().$this->crypt->encrypt('subcontractor_dashboard/index/'); ?>">Dashboard</a>
		<?php 
		}
		else if($this->user_account_type == OWNER)
		{
		?>
			<a href="<?php echo base_url().$this->crypt->encrypt('owner_dashboard/index/'); ?>">Dashboard</a>
		<?php 
		}
		?>
		</p>
		</div>
	</div>
</div>