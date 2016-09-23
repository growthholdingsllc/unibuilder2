<div class="row">
	<div class="col-xs-12">  
		<?php if($this->user_account_type == BUILDERADMIN) { ?>
		<p class="text-primary col-xs-12"><a href="javascript:void(0);" class="text-primary" data-target="#docs_upload_Modal" data-toggle="modal"><u>Click Here</u></a>  to Choose from Unibuilder docs</p>
		<label class="col-xs-12">Photo(s)</label>		
		<?php 
		}
		?>
		<?php if($this->user_account_type == BUILDERADMIN) $this->load->view('common/upload')?>
		<?php if($this->user_account_type == OWNER || $this->user_account_type == SUBCONTRACTOR) $this->load->view('common/uploaded_content.php'); ?>
	</div>                  
</div>
