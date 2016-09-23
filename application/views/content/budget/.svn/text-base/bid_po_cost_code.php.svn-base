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

<div class="row m-top change_cost_code_list">
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
	      	
	         
	      	<!-- <a class="removeBtn" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC . 'delete.png'; ?>" border="0"/></a> --></p>
	      	
	   </div>
	   <div class="col-xs-2">    
	   <input type="hidden" name="ub_po_co_cost_code_id[]" id="ub_po_co_cost_code_id" value="0" />
	       <?php
               if(isset($cost_code_id[$i])){ $cost_code_selected = $cost_code_id[$i]; }else{$cost_code_selected = '';}
               $cost_codes = $cost_code_options;
               foreach ($cost_code_options as $key => $value) {
               	if($cost_code_selected != $key)
               	{
               		unset($cost_codes[$key]);
               	}
               }
               echo form_dropdown('cost_code_id[]', $cost_codes, $cost_code_selected, "class='form-control selectpicker' id='cost_code_id' data-live-search='true'"); ?>
	   </div>
	   <div class="col-xs-2">                             
	     <input type="text" class="form-control varian" placeholder="Quantity" name="quantity[]" id="quantity" value="1" />
	   </div>    
	     <div class="col-xs-2">                             
	     <input type="text" class="form-control varian" placeholder="Unit Cost($)" name="unit_cost[]" id="unit_cost" value="0" />
	   </div>  
	   <div class="col-xs-2">                             
	    <input type="text" class="form-control total" placeholder="Total($)" name="total[]" id="total" value="0" readonly/>
	   </div>                          
	</div>
	 </div>  
	<?php } ?>  
	<div class="row">
	<div class="col-xs-12">
	 
	<!-- <a href="javascript:void(0);" class="sprite addBtn">
	<img border="0" src="<?php echo IMAGESRC . 'strip.gif'; ?>" alt="Add" class="plus">
	Add</a> -->   
	                               
	</div>
	</div>
	</div>
	   
	</div>
	</div>
	</div>