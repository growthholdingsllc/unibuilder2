<?php
   $count_cn = 1;
   /*if(!empty($cost_code_data['cost_code_id']))
   {
     $cost_code_id = explode(",",$cost_code_data['cost_code_id']);
     $count_cn = count($cost_code_id);
   }
   if(!empty($cost_code_data['ub_estimate_id']))
   {
     $ub_estimate_id = explode(",",$cost_code_data['ub_estimate_id']);
     $count_cn = count($ub_estimate_id);
   }
   if(!empty($cost_code_data['cost_code_name']))
   {
     $cost_code_name = explode(",",$cost_code_data['cost_code_name']);
   }
   if(!empty($cost_code_data['quantity']))
   {
     $quantity = explode(",",$cost_code_data['quantity']);
   }
   if(!empty($cost_code_data['unit_cost']))
   {
     $unit_cost = explode(",",$cost_code_data['unit_cost']);
   }
   if(!empty($cost_code_data['description']))
   {
     $description = explode(",",$cost_code_data['description']);
   }
   if(!empty($cost_code_data['total']))
   {
     $total = explode(",",$cost_code_data['total']);
   }
   if(!empty($cost_code_data['overhead_cost']))
   {
     $overhead_cost = explode(",",$cost_code_data['overhead_cost']);
   }*/
   if(!empty($cost_code_data))
   {
	   $count_cn = count($cost_code_data);
   }
   ?>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li>Budget</li>
      <li class="active">Select Project</li>-->
   </ol>
</div>
<form id="estimate_multiple_items" name="estimate_multiple_items" method="post">
<input type='hidden' id="pro_id" name="pro_id" value="<?php echo $pro_id; ?>"/>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
        <div class="pull-right "> 
			<a href="<?php echo base_url().$this->crypt->encrypt('budget/project_budget').'#jobs';?>">		
			<button type="button" class="btn btn-gray pull-right m-left-1">
				<img class="uni_cancel_new" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Cancel
			</button>
			</a>
			<a href="<?php echo base_url().$this->crypt->encrypt('budget/project_budget');?>">	
			<?php if(!empty($cost_code_data) ||  $pro_id == 0) {?>
			<button type="submit" id="save_estimate_multiple_items" class="btn btn-blue pull-right m-left-1">
				<img class="uni_save_and_back" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Save &amp; Back
			</button>
			<?php } ?>
			</a>
		</div>
    </div>
  </div>
</div>
<div class="row m-top">
   <div class="col-xs-12 error-message uni_message">
      <div class="alerts alert-danger"></div>
   </div>
</div>
<?php if($pro_id == 0){ ?>
<div class="row">
 <div class="col-xs-12">                     
	<div class="box-content panel-content">
		<div class="row">
			<div class="col-xs-12">				
				<label>Add New Estimate Items</label>
			</div>			
		</div>
		<div class="row five-col">
			<div class="col-xs-3 cost_code">
			<label>Cost Code</label>	
			<?php
				$cost_code_options = isset($cost_code_options)?$cost_code_options:'';				
				$array_value = false;
			    echo form_dropdown('cost_code_id[]', $cost_code_options,$array_value, "class='selectpicker form-control' id='cost_code_id' data-live-search='true' multiple multiple data-size='5' data-selected-text-format='count>5'");
			?>		
				
			</div>	
			<div class="col-xs-3 description">	
				<label>Description</label>
				<input type="text" id="description" name="description[]" class="form-control" placeholder="Description" />
			</div>
			<div class="col-xs-3 quantity">	
				<label>Quantity</label>
				<input type="text" value="1" id="quantity" name="quantity[]" class="form-control"  placeholder="Qty" autocomplete="off" />
			</div>
			<div class="col-xs-3 unit_cost">	
				<label>Unit Cost($)</label>
				<input type="text" id="unit_cost" name="unit_cost[]" class="form-control"  placeholder="Unit Cost($)" autocomplete="off" />
			</div>
			<div class="col-xs-3 budget_amount">
				<label>Total</label>
				<input type="text" id="budget_amount" name="budget_amount[]" class="form-control"  placeholder="Total" readonly value="" />
			</div>			
		</div>
		<div class="row five-col m-top">				
			<div class="col-xs-3 overhead_cost">
				<label>Estimated Overhead($)</label>
				<input type="text" id="overhead_cost" name="overhead_cost[]" class="form-control"  placeholder="Estimated Overhead($)" />
			</div>
			<div class="col-xs-3">	
				<label>&nbsp;</label>
				<div>
				<a href="javascript:void(0);" class="add_estimate_new"><button type="button" class="btn btn-blue"><img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>" /> Add</button></a>
				</div>
			</div>			
		</div>	
	 </div>
   </div>
 </div>
 <?php } ?>
 <input type="hidden" name="costcode_id[]" />
 <div class="row estimate_multiple_items">
	 <div class="col-xs-12">                     
		<div class="box-content panel-content">
			<?php if(!empty($cost_code_data) ||  $pro_id == 0) {?>
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-3"><label>Cost Code</label></div>				
					<div class="col-xs-3"><label>Description</label></div>				
					<div class="col-xs-1"><label>Quantity</label></div>				
					<div class="col-xs-1"><label>Unit Cost($)</label></div>				
					<div class="col-xs-1"><label>Total</label></div>				
					<div class="col-xs-2"><label>Estimated Overhead</label></div>			
					<div class="col-xs-1">&nbsp;</div>				
				</div>
			</div>
			<?php if($pro_id == 0){ ?>
			<div class="row m-top added_estimate_multiple_items">
				
			</div>
			<?php }else{ ?>

			 <div class="row m-top added_estimate_multiple_items">			   
			   <?php foreach($cost_code_data as $key=>$cost_code_val) { ?>
			   <div class="clon col-xs-12">

               	<input type="hidden" id="ub_estimate_id" name="ub_estimate_id[]" class="form-control"   value="<?php echo $cost_code_val['ub_estimate_id']; ?>" readonly />

				<div class="col-xs-3"><select class="form-control selectpicker" id="cost_code_ids" name="cost_code_id[]" ><option value="<?php echo $cost_code_val['cost_code_id']?>"><?php echo $cost_code_val['cost_code_name']; ?></option></select>
				</div>
				<div class="col-xs-3"><input type="text" id="description" name="description[]" class="form-control" placeholder="Description" value="<?php echo (isset($cost_code_val['description']))?$cost_code_val['description']:''; ?>" />
				</div>
				<div class="col-xs-1"><input type="text" id="quantity" name="quantity[]" class="form-control"  placeholder="Qty" value="<?php echo $cost_code_val['quantity']; ?>" />
				</div>
				<div class="col-xs-1"><input type="text" id="unit_cost" name="unit_cost[]" class="form-control"  placeholder="Unit Cost($)" value="<?php echo $cost_code_val['unit_cost']; ?>" />
				</div>
				<div class="col-xs-1"><input type="text" id="budget_amount" name="budget_amount[]" class="form-control"  placeholder="Total" value="<?php echo $cost_code_val['total']; ?>" readonly />
				</div>
				<div class="col-xs-2"><input type="text" id="overhead_cost" name="overhead_cost[]" class="form-control"  placeholder="Estimated Overhead($)" value="<?php echo $cost_code_val['overhead_cost']; ?>" /></div>
				<div class="col-xs-1"><a href="javascript:void(0);" class="remove_field pull-right"><img src="<?php echo IMAGESRC . 'delete.png'; ?>"/></a></div>
				</div>
               <?php } ?>
				
			</div>

			<?php } ?>
			<?php if($pro_id == 0){ ?>
			<div class="row m-top">
				<div class="col-xs-12">
						<div class="pull-right">
							<a href="javascript:void(0);" class="add_estimate"><button class="btn btn-blue"><img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>" /> Add</button></a>
						</div>
					</div>
			 </div>
			 <?php } ?>
		</div>
		<?php }else{ ?>
		  <div align="center">
		   <span>No Cost Codes Found For This Project</span>
		  </div>
		<?php } ?>
	 </div>
 </div>
 </form>
 <script type="text/javascript" src="<?php echo JSSRC.'save_estimate_multi_items.js';?>"></script>