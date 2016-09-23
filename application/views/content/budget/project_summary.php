<div class="row">
 <div class="col-xs-12">
	<div class="row datatable-bor">
	   <div class="add-function">    
			<?php 
			if(isset($this->user_role_access[strtolower('budget')][strtolower('export excel')]) && $this->user_role_access[strtolower('budget')][strtolower('export excel')] == 1)
			{
			?>
		  <div class="col-xs-3 pull-right"><a href="javascript:void(0);"><img id="export_file_project_summary" class="uni_excel" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></div>
		  <?php 
			}
			?>
	   </div>
	</div>
	
	<table class="table table-bordered datatable" id="budget_summary_list">
<thead>
		<tr>
			<?php 
			foreach($datatable_headers as $key => $column)
			{
				echo "<th>".ucwords($column)."</th>";
			}
		   ?>
		   <!--<th>Project Name</th>
		   <th>Budgeted Amount</th>
		   <th>Estimated Revenue</th>
		    <th>(+/-)Budget</th>
		   <th>Total Vendor Cost</th>		
		   <th>Estimated General Condition/Overhead</th>			
			<th>Estimated Profit</th>				
			<th>Billed To Client to Date</th>
			<th>Balance To Bill Client</th>			
			<th>Paid By Client to Date</th>				
			<th>Unpaid Client Billings</th>								
		   <th>Invoiced to Date by sub</th>				
		   <th>Amount Paid to sub</th>				
		   <th>Balance To be Invoiced by sub</th>				
		   <th>Total Balance Owed to sub</th>				
		   <!--<th>Overhead/In house</th>//		
		   <th>Total Cost</th>				
		   <th>Profit to Date</th>				
		   <th>Profit</th>				
		   <th>Profit %</th>-->
		</tr>
	 </thead>
	 <tbody>
	</tbody>	
	</table>
 </div>
</div>
<div>
	<h5>Summary</h5>
	<table class="table table-bordered datatable" id="budget_summary_total_list">
	   <thead>
		  <tr>
			<?php 
			foreach($datatable_headers_total_summary as $key => $column)
			{
				echo "<th>".ucwords($column)."</th>";
			}
		   ?>
			<!--<th>Budgeted Amount</th>
			<th>Estimated Revenue</th>
			<th>(+/-)Budget</th>
			<th>Total Vendor Cost</th>		
			<th>Estimated General Condition/Overhead</th>			
			<th>Estimated Profit</th>				
			<th>Billed To Client to Date</th>
			<th>Balance To Bill To Client</th>			
			<th>Paid By Client to Date</th>				
			<th>Unpaid Client Billings</th>								
			<th>Invoiced to Date by sub</th>				
			<th>Amount Paid to sub</th>				
			<th>Balance To be Invoiced by sub</th>				
			<th>Total Balance Owed to sub</th>							
			<th>Total Cost</th>				
			<th>Profit to Date</th>				
			<th>Overall Profit</th>		-->		
		  </tr>
	   </thead>
	   <tbody> 
	   </tbody>
	</table>
 </div>