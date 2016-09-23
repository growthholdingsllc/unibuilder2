<h5><label>Predecessor Information</label></h5>                  
<div class="row" id="predecessor_div_header">
<div class="col-xs-2">
	<p>&nbsp;</p>
</div>
<div class="col-xs-3">
	<p><label>Name</label></p>
</div>
<div class="col-xs-3">
	<p>&nbsp;</p>
</div>
<div class="col-xs-3">
	<p><label>Lag(Days)</label></p>
</div>
</div>
<div class="cointainer" id="predecessor_div">	
	<?php 
	if(isset($assigned_predecessors) && count($assigned_predecessors)>0)
	{
	foreach($assigned_predecessors as $predecessor)
	{ ?>
	<div class="content">
		<div class="row">
		   <div class="col-xs-2">                             
			  <p><a class="removeBtn clone" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC.'delete.png'; ?>" border="0"/></a></p>
		   </div>
		   <div class="col-xs-3">                           
			 <!-- <select class="form-control selectpicker">
				 <option value="">Nothing selected</option>
				 <option>Schedule1</option>
				 <option>Schedule2</option>
				 <option>Schedule3</option>
			  </select>--> 
				 <?php 
				 $predecessor_selected = '';
				 $predecessor_selected = (isset($predecessor['parent_id']))?$predecessor['parent_id']:'';
				 $schedule_predecessor_dropdown = (isset($schedule_predecessor_dropdown))?$schedule_predecessor_dropdown:array(''=>'Noting Selected');
				echo form_dropdown('predecessor_list[]', $schedule_predecessor_dropdown, $predecessor_selected, "class='selectpicker form-control' id='predecessor_list'");	 
				?>		 
			  
		   </div>
		   <div class="col-xs-3">      
			<?php
				$predecessor_type_selected = (isset($predecessor['predecessor_type']))?$predecessor['predecessor_type']:'';

				echo form_dropdown('predecessor_type[]', $predecessor_type, $predecessor_type_selected, "class='selectpicker form-control' id='predecessor_type' data-live-search='true'");
			?> 
		   </div>
		   <div class="col-xs-3">								
				<div class="input-group spinner">
					<input maxlength="4" type="text" name="lag[]" id="lag[]" class="form-control Lag" value="<?php echo (isset($predecessor['lag']))?$predecessor['lag']:'';?>">
					<!--<div class="input-group-btn-vertical">
						<button class="btn btn-default"><i class="glyphicon glyphicon-chevron-up"></i></button>
						<button class="btn btn-default"><i class="glyphicon glyphicon-chevron-down"></i></button>
					</div>-->
				</div>
		   </div>
		</div>
	
		<input type="hidden" value="<?php  echo (isset($predecessor['parent_id']))?$predecessor['parent_id']:'';?>" name="hide_predecessor_list[]" id="hide_predecessor_list[]"/>
		<input type="hidden" value="<?php echo (isset($predecessor['predecessor_type']))?$predecessor['predecessor_type']:'';?>" name="hide_predecessor_type[]" id="hide_predecessor_type[]"/>
		<input type="hidden" value="<?php echo (isset($predecessor['lag']))?$predecessor['lag']:'0';?>" name="hide_lag[]" id="hide_lag[]"/>
	</div>		
<?php }
	}
	else
	{ 
 ?>	
 	<div class="content">
		<div class="row">
		   <div class="col-xs-2">                             
			  <p><a class="removeBtn clone-show" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC.'delete.png'; ?>" border="0"/></a></p>
		   </div>
		   <div class="col-xs-3">                           
				 <?php 
				 $predecessor_selected = '';
				 echo $predecessor_selected = (isset($predecessor['parent_id']))?$predecessor['parent_id']:'';
				 $schedule_predecessor_dropdown = (isset($schedule_predecessor_dropdown))?$schedule_predecessor_dropdown:array(''=>'Noting Selected');
				echo form_dropdown('predecessor_list[]', $schedule_predecessor_dropdown, $predecessor_selected, "class='selectpicker form-control' id='predecessor_list'");	 
				?>		 
			  
		   </div>
		   <div class="col-xs-3">      
			<?php
				echo $predecessor_type_selected = (isset($predecessor['predecessor_type']))?$predecessor['predecessor_type']:'';

				echo form_dropdown('predecessor_type[]', $predecessor_type, $predecessor_type_selected, "class='selectpicker form-control' id='predecessor_type' data-live-search='true''");
			?> 
		   </div>
		   <div class="col-xs-3">								
				<div class="input-group spinner">
					<input maxlength="4" type="text" name="lag[]" id="lag[]" class="form-control Lag" value="<?php echo (isset($predecessor['lag']))?$predecessor['lag']:'0';?>" >
					<!--<div class="input-group-btn-vertical">
						<button class="btn btn-default"><i class="glyphicon glyphicon-chevron-up"></i></button>
						<button class="btn btn-default"><i class="glyphicon glyphicon-chevron-down"></i></button>
					</div>-->
				</div>
		   </div>
		</div>
	</div>		

 <?php }
 
 ?>
 <?php $allow_add = (isset($assigned_predecessors) && count($assigned_predecessors)>0)?count($assigned_predecessors):0;
	
 ?>
	
	<a href="javascript:void(0);" class="sprite addBtn <?php if($allow_add < 3)
	{echo "show";}else{ echo "hide";}?>" >
		<img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Add" class="plus">
		Add More Predecessor</a> 

</div>                  
<div class="row m-top">
 <div class="col-xs-12">
	<h5><label>Link Follow this Schedule Item</label></h5>
	<table class="table table-bordered datatable" id="link_follows_schedule"></table>
 </div>
</div>
