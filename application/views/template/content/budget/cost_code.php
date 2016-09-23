<?php
$count_cn = 1;
if(!empty($cost_code_data[0]['cost_code_id']))
{
  $cost_code_id = explode(",",$cost_code_data[0]['cost_code_id']);
  $count_cn = count($cost_code_id);
}
if(!empty($cost_code_data[0]['ub_po_co_cost_code_id']))
{
  $ub_po_co_cost_code_id = explode(",",$cost_code_data[0]['ub_po_co_cost_code_id']);
}
if(!empty($cost_code_data[0]['quantity']))
{
  $quantity = explode(",",$cost_code_data[0]['quantity']);
}
if(!empty($cost_code_data[0]['unit_cost']))
{
  $unit_cost = explode(",",$cost_code_data[0]['unit_cost']);
}
if(!empty($cost_code_data[0]['total']))
{
  $total = explode(",",$cost_code_data[0]['total']);
}
if(!empty($cost_code_data[0]['cost_variance_code']))
{
  $cost_variance_code = explode(",",$cost_code_data[0]['cost_variance_code']);
}
?>

<?php
if(isset($cost_code_data[0]['created_by']) && ($cost_code_data[0]['created_by'] != $this->user_session['ub_user_id']))
{
?>
<div class="row m-top">
	<div class="col-xs-12">
	<div class="box-content">
	   <div class="row">
	      <div class="col-xs-12">
	         <h5><label>Cost</label></h5>
	      </div>
	   </div>
	   <div class="row">
	      <div class="col-xs-2">
	         <label>&nbsp;</label>
	      </div>
		  <div class="col-xs-2">
	         <label>Cost Code</label>
	      </div>
		   <div class="col-xs-2">
	         <label>Quantity</label>
	      </div>
		   <div class="col-xs-2">
	         <label>Unit Cost</label>
	      </div>
		  <div class="col-xs-2">
	         <label>Total</label>
	      </div>
	   </div>
	   <div class="cointainer " id="cost_code_view">
	<?php 
	for($i=0; $i < $count_cn; $i++)
	{
	?>           
	<div class="content">
	<div class="row">
	   <div class="col-xs-2">                             
	      
	   </div>
	   <div class="col-xs-2">    
	   <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
		
		<input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>"/>

		<label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label>
	   		 
	   </div>
	   <div class="col-xs-2">                             
	     <input type="text" class="form-control varian" placeholder="Quantity" name="quantity[]" id="quantity" value="<?php if(isset($quantity[$i])) echo $quantity[$i] ?>" readonly/>
	   </div>    
	     <div class="col-xs-2">                             
	     <input type="text" class="form-control varian" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="<?php if(isset($unit_cost[$i])) echo $unit_cost[$i] ?>" readonly/>
	   </div>  
	   <div class="col-xs-2">                             
	    <input type="text" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="<?php if(isset($total[$i])) echo $total[$i] ?>" readonly/>
	   </div>                          
	</div>
	 </div>  
	<?php } ?>  
	<div class="row">
	<div class="col-xs-12">
	                             
	</div>
	</div>
	</div>
	   
	</div>
	</div>
	</div>
<?php } else{ ?>
<div class="row m-top">
	<div class="col-xs-12">
	<div class="box-content">
	   <div class="row">
	      <div class="col-xs-12">
	         <h5><label>Cost</label></h5>
	      </div>
	   </div>
	   <div class="row">
	      <div class="col-xs-2">
	         <label>&nbsp;</label>
	      </div>
		  <div class="col-xs-2">
	         <label>Cost Code</label>
	      </div>
		   <div class="col-xs-2">
	         <label>Quantity</label>
	      </div>
		   <div class="col-xs-2">
	         <label>Unit Cost</label>
	      </div>
		  <div class="col-xs-2">
	         <label>Total</label>
	      </div>
	   </div>
	   <div class="cointainer " id="cost_code_view">
	<?php 
	for($i=0; $i < $count_cn; $i++)
	{
	?>           
	<div class="content">
	<div class="row">
	   <div class="col-xs-2">                             
	      <p>
	      	<?php
	         if($cost_code_data[0]['po_status'] != 'Released' && $cost_code_data[0]['po_status'] != 'Accepted by Sub' && $cost_code_data[0]['po_status'] != 'Accepted by Builder' && $cost_code_data[0]['po_status'] != 'Work Completed') { 
              ?>
	      	<a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a></p>
	      	<?php } ?>
	   </div>
	   <div class="col-xs-2">    
	   <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="<?php if(isset($ub_po_co_cost_code_id[$i])) echo $ub_po_co_cost_code_id[$i] ?>" />
	       <?php
               if(isset($cost_code_id[$i])){ $cost_code_selected = $cost_code_id[$i]; }else{$cost_code_selected = '';}
               if(!isset($cost_code_data[0]['po_status']) || $cost_code_data[0]['po_status'] == 'Not Released'){ 

               	echo form_dropdown('cost_code_id[]', $cost_code_options, $cost_code_selected, "class='form-control selectpicker' id='cost_code_id' data-live-search='true'");
               }else{
               	?>

               

               <input type="hidden" class="form-control varian"  name="cost_code_id[]" id="cost_code_id" value="<?php if(isset($cost_code_id[$i])) echo $cost_code_id[$i] ?>"/>

		<label><?php if(isset($cost_variance_code[$i])) echo $cost_variance_code[$i] ?></label>

               	<?php 
               } ?>
	   </div>
	   <div class="col-xs-2">                             
	     <input type="text" class="form-control varian" placeholder="Quantity" name="quantity[]" id="quantity" value="<?php if(isset($quantity[$i])) echo $quantity[$i] ?>" <?php if($cost_code_data[0]['po_status'] == 'Released' || $cost_code_data[0]['po_status'] == 'Accepted by Sub' || $cost_code_data[0]['po_status'] == 'Accepted by Builder' || $cost_code_data[0]['po_status'] == 'Work Completed' || (isset($cost_code_data[0]['created_by']) && $cost_code_data[0]['created_by'] != $this->user_session['ub_user_id'])) { echo "readonly='readonly'"; }?>/>
	   </div>    
	     <div class="col-xs-2">                             
	     <input type="text" class="form-control varian" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="<?php if(isset($unit_cost[$i])) echo $unit_cost[$i] ?>" <?php if($cost_code_data[0]['po_status'] == 'Released' || $cost_code_data[0]['po_status'] == 'Accepted by Sub' || $cost_code_data[0]['po_status'] == 'Accepted by Builder' || $cost_code_data[0]['po_status'] == 'Work Completed' || (isset($cost_code_data[0]['created_by']) && $cost_code_data[0]['created_by'] != $this->user_session['ub_user_id'])) { echo "readonly='readonly'"; }?>/>
	   </div>  
	   <div class="col-xs-2">                             
	    <input type="text" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="<?php if(isset($total[$i])) echo $total[$i] ?>" readonly/>
	   </div>                          
	</div>
	 </div>  
	<?php } ?>  
	<div class="row">
	<div class="col-xs-12">
	 <?php
	 if($cost_code_data[0]['po_status'] != 'Released' && $cost_code_data[0]['po_status'] != 'Accepted by Sub' && $cost_code_data[0]['po_status'] != 'Accepted by Builder' && $cost_code_data[0]['po_status'] != 'Work Completed') { 
     ?>
	<a href="javascript:void(0);" class="sprite addBtn">
	<img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
	Add</a>   
	<?php } ?>                                
	</div>
	</div>
	</div>
	   
	</div>
	</div>
	</div>
	<?php } ?>