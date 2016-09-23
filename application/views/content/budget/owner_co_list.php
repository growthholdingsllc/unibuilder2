<div class="row">
 <div class="col-xs-12">
 	<?php if($this->user_account_type == BUILDERADMIN){?>
	<div class="row datatable-bor">
	   <div class="add-function">    
			<?php 
			if(isset($this->user_role_access[strtolower('budget')][strtolower('export excel')]) && $this->user_role_access[strtolower('budget')][strtolower('export excel')] == 1)
			{
			?>
			<div class="col-xs-3 pull-right"> <a href="javascript:void(0);"><img id="export_file_owner_co" class="uni_excel" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a> </div>
			<?php 
			}
			?>
	   </div>
	</div>
	<?php } ?>
	<table class="table table-bordered datatable" id="budget_owner_co_list">	 
		<thead>
		<tr>
		  <th>Title</th>	
		   <th>Description</th>
		   <th>Status</th>
		   <th>Date Created</th>		
		   <th>Expected Completion</th>			
			<th>Assign to Sub</th>
														   
		</tr>
	 </thead>
	 <tbody>
	</tbody>						 
	</table>		
 </div>
</div>