<div class="row">
 <div class="col-xs-12">
	<div class="row datatable-bor">
	   <div class="add-function">   
			<?php 
			if(isset($this->user_role_access[strtolower('budget')][strtolower('export excel')]) && $this->user_role_access[strtolower('budget')][strtolower('export excel')] == 1)
			{
			?>
		  <div class="col-xs-3 pull-right"><a href="javascript:void(0);"><img id="export_file_estimate" class="uni_excel" name="export_file" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></div>
			<?php 
			}
			?>
	   </div>
	</div>
	

	<table class="table table-bordered datatable" id="budget_jobs_list">
	<thead>
		<tr>
			<?php 
			foreach($datatable_headers_budget_jobs as $key => $column)
			{
				 if($column == 'Budget')
				{
					/*echo "<th>Budget <a href=".base_url().$this->crypt->encrypt('budget/add_multiple_items/'.$this->project_id)."><img src='../uni/assets/images/plus_header.png'></a></th>";*/

					echo "<th>Budget <a href=".base_url().$this->crypt->encrypt('budget/add_multiple_items/'.$this->project_id)."><img src='".IMAGESRC."plus_header.png'></a></th>";
				} 
				else  if($column == strtolower('Client Contract'))
				{
					echo "<th>Client Contract <a href=".base_url().$this->crypt->encrypt('budget/save_po_co/OWNER PO')."><img src='".IMAGESRC."plus_header.png'></a></th>";
				} 
				else if($column == strtolower('Client CO'))
				{
					echo "<th>Client CO <a href=".base_url().$this->crypt->encrypt('budget/save_po_co/OWNER CO')."><img src='".IMAGESRC."plus_header.png'></a></th>";
				}
				else if($column == strtolower('Client CO Count'))
				{
					echo "<th>Client CO Count</th>";
				}
				else if($column == strtolower('PO'))
				{
					echo "<th>PO <a href=".base_url().$this->crypt->encrypt('budget/save_po_co/PO')."><img src='".IMAGESRC."plus_header.png'></a></th>";
				}
				else if($column == strtolower('CO'))
				{
					echo "<th>CO <a href=".base_url().$this->crypt->encrypt('budget/save_po_co/CO')."><img src='".IMAGESRC."plus_header.png'></a></th>";
				}
				else
				{
					echo "<th>".ucwords($column)."</th>";
				}	
			}
		   ?>
		   <!--<th>Cost Code Item</th>
		   <th>Budget</th>
		   <th>Client Contract</th>
		   <th>Client Contract Count</th>
		   <th>Client CO</th>
		   <th>Client CO Count</th>
		   <th>	Estimated Revenue</th>
		   <th>	(+/-)Budget</th>
		    <th>Vendor Contract</th>		
		   <th>PO</th>			
			<th>Change Order(+/-)</th>				
			<th>CO</th>				
			<th>Total Vendor Cost</th>				
			<th>Overhead/Inhouse</th>				
		   <th>Estimated Profit</th>				
		   <th>Billed To Client to Date</th>
			<th>Balance TO Bill To Client</th>		   
		   <th>Paid By Client to Date</th>				
		   <th>Unpaid Client Billings</th>								
		   <th>Invoiced by Sub to Date</th>				
		   <th>Amount Paid To Sub</th>				
		   <th>Balance to be Invoiced By Sub</th>				
		   <th>Total Balance Owed To Sub</th>				
		   <th>Total Cost</th>				
		   <th>Profit To Date</th>				
		   <th>Overall Profit</th>	-->			
								   
		</tr>
	 </thead>
	 <tbody>
	</tbody>						 
	</table>
	</div>
	</div>
<div>
	<h5>Summary</h5>
	<table class="table table-bordered datatable" id="budget_cost_summary_list">
	   <thead>
		  <tr>
			<?php 
			foreach($datatable_headers_budget_summary as $key => $column)
			{
				if($column == strtolower('Client CO'))
				{
					echo "<th>Client CO</th>";
				}
				else if($column == strtolower('Vendor CO'))
				{
					echo "<th>Vendor CO</th>";
				}
				else
				{
					echo "<th>".ucwords($column)."</th>";
				}
			}
		   ?>
			<!--<th>Project Name</th>
		   <th>Budgeted Amount</th>
		   <th>Client contract</th>
		   <th>Client CO</th>
		   <th>Estimated Revenue</th>
		   <th>(+/-)Budget</th>
		   <th>Vendor Contract</th>
		   <th>Vendor CO</th>
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
		   <!--<th>Overhead/In house</th>				
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