<div class="col-xs-12">
	<?php 
	if(isset($this->user_role_access[strtolower('budget')][strtolower('add')]) && $this->user_role_access[strtolower('budget')][strtolower('add')] == 1)
	{
		
	?>
		<a href="javascript:void(0);" id="new_estimate">
		<button type="button" class="sprite pull-right"> 
		<img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus"> New Estimate Item</button>
		</a>
		<?php //$this->load->view('common/import_template_jobs'); ?>
	<?php 
		
	}
	?>
</div>
<form id="save_estimate" class="form-horizontal" method="post" name="save_estimate">
<input type="hidden" name="save_type" id="save_type" value="" />
<input type="hidden" name="check_estimate" id="check_estimate" value="<?php echo isset($proj_estimate_list)?implode(",",array_keys($proj_estimate_list)):'';?>"/>
<input type="hidden" name="ub_template_estimate_id" id="ub_template_estimate_id" value="<?php echo isset($result_data['ub_template_estimate_id'])?$result_data['ub_template_estimate_id']:0 ?>" />

<div class="col-xs-12">
	<!-- New Estimate Form Begin -->
	<div class="col-xs-12 box-content new_estimate_con m-top">
	<div class="row">
	<div class="col-xs-3">
		<label>Add a New Estimate Item</label>
		<div class="col-xs-12">
			<div class="form-group">
				<div class="input-group right-group">
				   <?php				   
					$cost_code_selected = '';
					if(isset($result_data['cost_code_id']))
					{
						$cost_code_selected = $result_data['cost_code_id'];
					}
					$cost_code_options = isset($cost_code_options)?$cost_code_options:'';
					if($cost_code_selected>0)
					{
						echo form_dropdown('hidden_cost_code_id', $cost_code_options,$cost_code_selected, "class='selectpicker form-control' id='hidden_cost_code_id' DISABLED");
				?>
						<input type="hidden" name="cost_code_id" id="cost_code_id" value="<?php echo $cost_code_selected; ?>" />
				<?php
					}else{
						echo form_dropdown('cost_code_id', $cost_code_options,$cost_code_selected, "class='selectpicker form-control' id='cost_code_id' data-live-search='true'");

					}
					if($cost_code_selected == '')
					{ ?>
				  
				   <?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-3">	
		<label>&nbsp;</label>
		<input type="text" class="form-control" placeholder="Description" id="description" name="description" value="<?php echo isset($result_data['description'])?$result_data['description']:'' ?>"/>
	</div>
	<div class="col-xs-2">	
		<label>&nbsp;</label>
		<div class="col-xs-12">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Quantity" id="quantity" name="quantity" value="<?php echo isset($result_data['quantity'])?$result_data['quantity']:'' ?>"/>
			</div>
		</div>
	</div>
	<div class="col-xs-2">	
		<label>&nbsp;</label>
		<div class="col-xs-12">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Unit Cost($)" id="unit_cost" name="unit_cost" value="<?php echo isset($result_data['unit_cost'])?$result_data['unit_cost']:'' ?>"/>
			</div>
		</div>
	</div>
	<div class="col-xs-2">	
		<label>&nbsp;</label>
		<input type="text" class="form-control" placeholder="Total($)" id="budget_amount" name="budget_amount" readonly value="<?php echo isset($result_data['budget_amount'])?$result_data['budget_amount']:'' ?>"/>
	</div>
	</div>
	<div class="row m-top">
		<div class="col-xs-3">				
			<input type="text" class="form-control" placeholder="overhead cost($)" id="overhead_cost" name="overhead_cost" value="<?php echo isset($result_data['overhead_cost'])?$result_data['overhead_cost']:'' ?>"/>
		</div>
		<div class="col-xs-8">
			
		   <button type="submit" class="btn btn-blue" name="add_estimate_new_stay" id="add_estimate_new_stay">
			<img border="0" class="uni_save_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Save
		   </button>
		   <?php
			
		   if(isset($result_data['ub_template_estimate_id']) && $result_data['ub_template_estimate_id'] > 0)
		   { 
				
		   ?>
		   <button type="button" class="btn btn-blue" name="del_estimate" id="del_estimate">
			<img border="0" class="uni_delete" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Delete
		   </button>
		   <?php 
				
		   } 
		   ?>
		   <a href="javascript:void(0);" id="close_estimate">
		   <button type="button" class="btn btn-gray">
		   <img border="0" class="uni_cancel_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Cancel
		   </button>
		   </a>
		</div>
	</div>
	</div>
<!-- New Estimate Form END -->
</div>
</form>