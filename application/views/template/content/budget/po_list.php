<div class="row">
	 <div class="col-xs-12">
	 	<?php if($this->user_account_type == BUILDERADMIN){?>
		<div class="row datatable-bor">
		   <div class="add-function">
				<?php 
				if(isset($this->user_role_access[strtolower('budget')][strtolower('export excel')]) && $this->user_role_access[strtolower('budget')][strtolower('export excel')] == 1)
				{
				?>
				<!-- <div class="col-xs-3 pull-right"><a href="javascript:void(0);"><img id="export_file" class="uni_excel" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></div> -->
				<?php 
				}
				?>
		   </div>
		</div>
		<?php } ?>
		
		
		<table class="table table-bordered datatable" id="budget_po_list">	<thead>
			<tr>
			   <th>Title</th>
			   <th>Po#</th>
			   <!--<th>Related BID</th>
			   <th>Performed By</th>	-->	
			   <th>Est. Completion Date</th>			
				<th>Status</th>				
				<!--<th>Work Completed</th>				
				<th>Paid</th>	-->			
				<th>Cost</th>				
			   <!--<th>Total Paid</th> -->
			</tr>
		 </thead>
		 <tbody>
		</tbody>						 
		</table>
	 </div>
</div>