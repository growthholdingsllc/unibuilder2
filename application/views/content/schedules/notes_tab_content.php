<div class="row">
 <div class="col-xs-12">
	<div class="tab-con pull-left">
	   <div class="tabpanel">
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			 <?php 
			 if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
			 {
			 ?>
			 <li role="all" class="active"> <a href="#all" data-toggle="tab">All</a> </li>
			 <li role="internal"> <a href="#internal" data-toggle="tab">Internal</a> </li>
			 <?php 
			 }
			 if(isset($this->user_account_type) && (BUILDERADMIN == $this->user_account_type || SUBCONTRACTOR == $this->user_account_type))
			 {
			 ?>
			 <li role="subs" class="<?php if(isset($this->user_account_type) && SUBCONTRACTOR == $this->user_account_type){ echo 'active'; } ?>"> <a href="#subs" data-toggle="tab">Subs</a> </li>
			 <?php 
			 }
			 if(isset($this->user_account_type) && (BUILDERADMIN == $this->user_account_type || OWNER == $this->user_account_type))
			 {
			 ?>
			 <li role="owner" class="<?php if(isset($this->user_account_type) && OWNER == $this->user_account_type){ echo 'active'; } ?>"> <a href="#owner" data-toggle="tab">Owner</a> </li>
			 <?php 
			 }
			 ?>
		  </ul>
		  <!-- Tab panes -->
		  <div class="tab-content">
			<?php 
			 if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
			 {
			 ?>
			 <div class="tab-pane active" id="all">
				<div class="row">
				   <div class="col-xs-12">
					  <textarea id="all_notes" name="all_notes" class="form-control"><?php echo isset($schedule_details['all_notes'])?$schedule_details['all_notes']:'';?></textarea>
				   </div>
				</div>
			 </div>
			 <div class="tab-pane" id="internal">
				<div class="row">
				   <div class="col-xs-12">
					  <textarea id="builder_notes" name="builder_notes" class="form-control"><?php echo isset($schedule_details['builder_notes'])?$schedule_details['builder_notes']:'';?></textarea>
				   </div>
				</div>
			 </div>
			 <?php 
			 }
			 if(isset($this->user_account_type) && (BUILDERADMIN == $this->user_account_type || SUBCONTRACTOR == $this->user_account_type))
			 {
			 ?>
			 <div class="tab-pane <?php if(isset($this->user_account_type) && SUBCONTRACTOR == $this->user_account_type){ echo 'active'; } ?>" id="subs">
				<div class="row">
				   <div class="col-xs-12">
					  <textarea id="subcontractor_notes" name="subcontractor_notes" class="form-control"><?php echo isset($schedule_details['subcontractor_notes'])?$schedule_details['subcontractor_notes']:'';?></textarea>
				   </div>
				</div>
			 </div>
			 <?php 
			 }
			 if(isset($this->user_account_type) && (BUILDERADMIN == $this->user_account_type || OWNER == $this->user_account_type))
			 {
			 ?>
			 <div class="tab-pane <?php if(isset($this->user_account_type) && OWNER == $this->user_account_type){ echo 'active'; } ?>" id="owner">
				<div class="row">
				   <div class="col-xs-12">
					  <textarea id="owner_notes" name="owner_notes" class="form-control"><?php echo isset($schedule_details['owner_notes'])?$schedule_details['owner_notes']:'';?></textarea>
				   </div>
				</div>
			 </div>
			 <?php 
			 }
			 ?>
		  </div>
	   </div>
	</div>
 </div>
</div>
