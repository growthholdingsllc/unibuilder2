<script>   
   this.data_table   						= '<?php echo $data_table; ?>';   
   this.budget_summary_list    				= '<?php echo $budget_summary_list; ?>'; 
   this.budget_jobs_list    				= '<?php echo $budget_jobs_list; ?>'; 
   this.budget_pay_app_list    				= '<?php echo $budget_pay_app_list; ?>'; 
   this.budget_po_list    					= '<?php echo $budget_po_list; ?>'; 
   this.budget_co_list    					= '<?php echo $budget_co_list; ?>'; 
   this.budget_pay_app_list_details    		= '<?php echo $budget_pay_app_list_details; ?>'; 
   //All project summary
   this.datatable_column = <?php if(isset($datatable_column)){ echo json_encode($datatable_column);} ?>;
   this.total_estimated_profit_amount_index = '<?php echo isset($total_estimated_profit_amount_index)?$total_estimated_profit_amount_index:''; ?>';
   this.total_plus_minus_budget_index = '<?php echo isset($total_plus_minus_budget_index)?$total_plus_minus_budget_index:''; ?>';
   this.total_profit_to_date_index = '<?php echo isset($total_profit_to_date_index)?$total_profit_to_date_index:''; ?>';
   this.total_overall_profit_index = '<?php echo isset($total_overall_profit_index)?$total_overall_profit_index:''; ?>';
   
   //All project total summary
   this.datatable_column_total_summary = <?php if(isset($datatable_column_total_summary)){ echo json_encode($datatable_column_total_summary);} ?>;
   this.project_total_estimated_profit_amount_index = '<?php echo isset($project_total_estimated_profit_amount_index)?$project_total_estimated_profit_amount_index:''; ?>';
   this.project_total_plus_minus_budget_index = '<?php echo isset($project_total_plus_minus_budget_index)?$project_total_plus_minus_budget_index:''; ?>';
   this.project_total_profit_to_date_index = '<?php echo isset($project_total_profit_to_date_index)?$project_total_profit_to_date_index:''; ?>';
   this.project_total_overall_profit_index = '<?php echo isset($project_total_overall_profit_index)?$project_total_overall_profit_index:''; ?>';
   
   //Budget summary list
   this.datatable_column_budget_summary = <?php if(isset($datatable_column_budget_summary)){ echo json_encode($datatable_column_budget_summary);} ?>;
   this.budget_summary_total_estimated_profit_amount_index = '<?php echo isset($budget_summary_total_estimated_profit_amount_index)?$budget_summary_total_estimated_profit_amount_index:''; ?>';
   this.budget_summary_total_plus_minus_budget_index = '<?php echo isset($budget_summary_total_plus_minus_budget_index)?$budget_summary_total_plus_minus_budget_index:''; ?>';
   this.budget_summary_total_profit_to_date_index = '<?php echo isset($budget_summary_total_profit_to_date_index)?$budget_summary_total_profit_to_date_index:''; ?>';
   this.budget_summary_total_overall_profit_index = '<?php echo isset($budget_summary_total_overall_profit_index)?$budget_summary_total_overall_profit_index:''; ?>';
   this.budget_summary_total_contract_price_index = '<?php echo isset($budget_summary_total_contract_price_index)?$budget_summary_total_contract_price_index:''; ?>';
   this.budget_summary_total_revised_contract_index = '<?php echo isset($budget_summary_total_revised_contract_index)?$budget_summary_total_revised_contract_index:''; ?>';
   
   //Budget summary list
   this.datatable_column_budget_jobs = <?php if(isset($datatable_column_budget_jobs)){ echo json_encode($datatable_column_budget_jobs);} ?>;
   this.budget_jobs_client_contract_count_index = '<?php echo isset($budget_jobs_client_contract_count_index)?$budget_jobs_client_contract_count_index:''; ?>';
   this.budget_jobs_estimated_profit_amount_index = '<?php echo isset($budget_jobs_estimated_profit_amount_index)?$budget_jobs_estimated_profit_amount_index:''; ?>';
   this.budget_jobs_client_co_count_index = '<?php echo isset($budget_jobs_client_co_count_index)?$budget_jobs_client_co_count_index:''; ?>';
   this.budget_jobs_overall_profit_index = '<?php echo isset($budget_jobs_overall_profit_index)?$budget_jobs_overall_profit_index:''; ?>';
   this.budget_jobs_plus_minus_budget_index = '<?php echo isset($budget_jobs_plus_minus_budget_index)?$budget_jobs_plus_minus_budget_index:''; ?>';
   this.budget_jobs_total_vendor_cost_index = '<?php echo isset($budget_jobs_total_vendor_cost_index)?$budget_jobs_total_vendor_cost_index:''; ?>';
   this.budget_jobs_estimated_revenue_index = '<?php echo isset($budget_jobs_estimated_revenue_index)?$budget_jobs_estimated_revenue_index:''; ?>';
   this.budget_jobs_co_count_index = '<?php echo isset($budget_jobs_co_count_index)?$budget_jobs_co_count_index:''; ?>';
   this.budget_jobs_po_count_index = '<?php echo isset($budget_jobs_po_count_index)?$budget_jobs_po_count_index:''; ?>';
   this.budget_jobs_profit_to_date_index = '<?php echo isset($budget_jobs_profit_to_date_index)?$budget_jobs_profit_to_date_index:''; ?>';
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li>Budget</li>
      <li class="active">Select Project</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">         
         <div class="pull-right po">
			<?php 
			if(isset($this->user_role_access[strtolower('budget')][strtolower('add')]) && $this->user_role_access[strtolower('budget')][strtolower('add')] == 1)
			{
				if(isset($this->project_status_check) && $this->project_status_check == 1)
				{
			?>
            <a href="<?php echo base_url().$this->crypt->encrypt('budget/save_po_co/PO'); ?>"><button type="button" class="btn btn-blue pull-right"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="uni_new"> New</button></a>
			<?php 
			if($this->user_account_type == BUILDERADMIN) 
			{ 
				$this->load->view('common/import_template'); 
			} 
			?>
			<?php 
				}
			}
			?>
         </div>

         <div class="pull-right co">
			<?php 
			if(isset($this->user_role_access[strtolower('budget')][strtolower('add')]) && $this->user_role_access[strtolower('budget')][strtolower('add')] == 1)
			{	
				if(isset($this->project_status_check) && $this->project_status_check == 1)
				{
			?>
            <a href="<?php echo base_url().$this->crypt->encrypt('budget/save_po_co/CO'); ?>"><button type="button" class="sprite">
            <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus">
            New</button></a>
			<?php 
				}
			}
			?>			
         </div>

         <div class="pull-right owner_po">
         <?php 
         if(isset($this->user_role_access[strtolower('budget')][strtolower('add')]) && $this->user_role_access[strtolower('budget')][strtolower('add')] == 1 || $this->user_account_type == OWNER)
         {  
            if(isset($this->project_status_check) && $this->project_status_check == 1)
            {
         ?>
            <a href="<?php echo base_url().$this->crypt->encrypt('budget/save_po_co/OWNER PO'); ?>"><button type="button" class="sprite">
            <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus">
            New</button></a>
         <?php 
            }
         }
         ?>       
         </div>

         <div class="pull-right owner_co">
         <?php 
         if(isset($this->user_role_access[strtolower('budget')][strtolower('add')]) && $this->user_role_access[strtolower('budget')][strtolower('add')] == 1 || $this->user_account_type == OWNER)
         {  
            if(isset($this->project_status_check) && $this->project_status_check == 1)
            {
         ?>
            <a href="<?php echo base_url().$this->crypt->encrypt('budget/save_po_co/OWNER CO'); ?>"><button type="button" class="sprite">
            <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus">
            New</button></a>
         <?php 
            }
         }
         ?>       
         </div>
      </div>
   </div>
</div>
<div class="row m-top">
	  <div class="col-xs-12 error-message uni_message">
		 <div class="alerts alert-danger"></div>
	   </div>
</div>
<form id="Search_Result" name="Search_Result" method="post">
<div class="row filter_none m-top">
   <div class="col-xs-12">
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12">
                     <div class="row five-col">
                        <div class="col-xs-3 pay-app">
                           <label>Date</label>                        
                           <div class='input-group date' id='datetimepicker2'> 
                              <input type="text" name="due_date" class="form-control"   value="<?php echo isset($payapp_search_session_array['period_to'])?$payapp_search_session_array['period_to']:''; ?>" id="due_date" readonly> 
                              <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
                           </div>
                        </div>
						
						<div class="col-xs-3 po">
                           <label>Date</label>                        
                           <div class='input-group date' id='datetimepicker3'> 
                              <input type="text" name="due_date_time" class="form-control"   value="<?php echo isset($po_search_session_array['due_date_time'])?$po_search_session_array['due_date_time']:''; ?>" id="due_date_time" readonly> 
                              <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
                           </div>
                        </div>						
                        <div class="col-xs-3 pay-app">
                           <label>Pay App Name</label>
						   <div class="col-xs-12">
							   <div class="form-group">
							   <input type="text" id="pay_app_name" name="pay_app_name" class="form-control" value="<?php echo isset($payapp_search_session_array['pay_app_name'])?$payapp_search_session_array['pay_app_name']:'' ?>"/>
							   </div>
						   </div>
                        </div>
                        <div class="col-xs-3 po">
                           <label>PO Status</label> 
                           <?php 
                              $status_selected = '';
                              if(isset($po_search_session_array['po_status']))
                              {
                              $status_selected = explode(",",$po_search_session_array['po_status']);
                              }
                              echo form_dropdown('po_status', $status_result, $status_selected, "class='selectpicker form-control' id='po_status' data-live-search='true'"); 
                              
                              ?>	
                        </div>
                        <div class="col-xs-3 po">
                           <label>PO Payment Status</label>
                           <?php 
                              $payment_status_selected = '';
                              if(isset($po_search_session_array['payment_status']))
                              {
                              $payment_status_selected = explode(",",$po_search_session_array['payment_status']);
                              }
                              echo form_dropdown('payment_result', $payment_result, $payment_status_selected, "class='selectpicker form-control' id='payment_result' data-live-search='true'"); 
                              ?>
                        </div>
						 <div class="col-xs-3 po">
							<label>PO CostCode</label>
							<div class="col-xs-12">
							<div class="form-group">
							<?php 
							$costcode_selected = '';
							 $search_session_array['costcode'] = (isset($cost_code_id)) ? $cost_code_id : $search_session_array['costcode'];
							if(isset($search_session_array['costcode']))
							{
								$costcode_selected = $search_session_array['costcode'];
							}
							echo form_dropdown('ub_bid_cost_code_id', $cost_code_options, $costcode_selected, "class='selectpicker form-control' id='costcode' data-live-search='true'"); 
							?>
						</div>
						</div>
						</div>
						
                        <div class="col-xs-3 co">
                              <label>Date</label>                        
								  <div class='input-group date' id='datetimepicker5'> 
									<input type="text" name="co_due_date_time" class="form-control"   value="<?php echo isset($co_search_session_array['co_due_date_time'])?$co_search_session_array['co_due_date_time']:''; ?>" id="co_due_date_time" readonly> 
								  <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
								  </div>                                                        
                           </div>
						   
						   
                         <div class="col-xs-3 co">
					   <label>CO Status</label> 
					   <?php 
						   $status_selected = '';
						   if(isset($co_search_session_array['co_status']))
						   {
							$status_selected = explode(",",$co_search_session_array['co_status']);
						   }
							 echo form_dropdown('co_status', $status_result, $status_selected, "class='selectpicker form-control' id='co_status' data-live-search='true'"); 
							 
							?>	
                        </div>
                        
                        <div class="col-xs-3 co">
                           <label>CO Payment Status</label>
                            <?php 
						   $payment_status_selected = '';
						   if(isset($co_search_session_array['co_payment_status']))
						   {
							$payment_status_selected = explode(",",$co_search_session_array['co_payment_status']);
						   }
							 echo form_dropdown('co_payment_result', $payment_result, $payment_status_selected, "class='selectpicker form-control' id='co_payment_result' data-live-search='true'"); 
							?>
                        </div>
						 <div class="col-xs-3 co">
							<label>CO CostCode</label>
							<div class="col-xs-12">
							<div class="form-group">
							<?php 
							$costcode_selected = '';
							$search_session_array['costcode'] = (isset($cost_code_id)) ? $cost_code_id : $search_session_array['costcode'];
								if(isset($search_session_array['costcode']))
							{
								$costcode_selected = $search_session_array['costcode'];
							}
							echo form_dropdown('ub_bid_cost_code_id', $cost_code_options, $costcode_selected, "class='selectpicker form-control' id='cocostcode' data-live-search='true'"); 
							?>
						</div>
						</div>
						</div>
						<div class="col-xs-3 owner_co">
                              <label>Date</label>                        
								  <div class='input-group date' id='datetimepicker6'> 
									<input type="text" name="owner_co_due_date_time" class="form-control"   value="<?php echo isset($owner_co_search_session_array['owner_co_due_date_time'])?$owner_co_search_session_array['owner_co_due_date_time']:''; ?>" id="owner_co_due_date_time" readonly> 
								  <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
								  </div>                                                        
                          </div>
						 <div class="col-xs-3 owner_co">
					   <label>CO Status</label> 
					   <?php 
						   $status_selected = '';
						   if(isset($owner_co_search_session_array['owner_co_status']))
						   {
							$status_selected = explode(",",$owner_co_search_session_array['owner_co_status']);
						   }
							 echo form_dropdown('owner_co_status', $co_status_result, $status_selected, "class='selectpicker form-control' id='owner_co_status' data-live-search='true'"); 
							 
						?>	
                        </div>
						 <div class="col-xs-3 owner_co">
							<label>CO CostCode</label>
							<div class="col-xs-12">
							<div class="form-group">
							<?php 
							$costcode_selected = '';
							/*  $search_session_array['costcode'] = (isset($cost_code_id)) ? $cost_code_id : $search_session_array['costcode']; */
								if(isset($owner_co_search_session_array['costcode']))
							{
								$costcode_selected = $owner_co_search_session_array['costcode'];
							}
							echo form_dropdown('costcode', $cost_code_options, $costcode_selected, "class='selectpicker form-control' id='ownercocostcode' data-live-search='true'"); 
							?>
						</div>
						</div>
						</div>
						<div class="col-xs-3 owner_po">
                              <label>Date</label>                        
								  <div class='input-group date' id='datetimepicker7'> 
									<input type="text" name="owner_po_due_date_time" class="form-control"   value="<?php echo isset($owner_po_search_session_array['owner_po_due_date_time'])?$owner_po_search_session_array['owner_po_due_date_time']:''; ?>" id="owner_po_due_date_time" readonly> 
								  <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
								  </div>                                                        
                          </div>
						 <div class="col-xs-3 owner_po">
					   <label>PO Status</label> 
					   <?php 
						   $status_selected = '';
						   if(isset($owner_po_search_session_array['owner_po_status']))
						   {
							$status_selected = explode(",",$owner_po_search_session_array['owner_po_status']);
						   }
							 echo form_dropdown('ownerpostatus', $co_status_result, $status_selected, "class='selectpicker form-control' id='owner_po_status' data-live-search='true'"); 
							 
						?>	
                        </div>
						 <div class="col-xs-3 owner_po">
							<label>PO CostCode</label>
							<div class="col-xs-12">
							<div class="form-group">
							<?php 
							$costcode_selected = '';
								if(isset($owner_po_search_session_array['costcode']))
							{
								$costcode_selected = $owner_po_search_session_array['costcode'];
							}
							echo form_dropdown('costcode', $cost_code_options, $costcode_selected, "class='selectpicker form-control' id='ownerpocostcodee' data-live-search='true'"); 
							?>
						</div>
						</div>
						</div>
					 </div>
                     <div class="row five-col">
                        <div class="col-xs-6">
                           <label>&nbsp;</label>
                           <div>
                              <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                              <button type="button" class="btn btn-gray" id="reset">Reset</button>
                               <button type="submit" class="btn btn-gray" id="save_filter">Save Filter</button>
                               <button class="btn btn-default btn-gray" type="button" id="apply_save_filter" style="display:none;">Apply Saved Filter</button>
                              <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
							  <input type="hidden" id="budget_index" value="" />
							  <input type="hidden" value="<?php if(!empty($this->project_id))
								{echo 'job';}else{echo 'summary';}?>" id="current_tab" name="current_tab" />
							  <input type="hidden" value="" id="previous_tab" name="previous_tab" />
                      <!--  <input type="hidden" value="export" id="fetch_type" name="fetch_type" /> -->

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</form>
<div class="row new_estimate m-top">
   <!-- Loading New Estimate file -->   
   <?php $this->load->view('content/budget/save_estimate',array('cost_code_options' => $cost_code_options,'category_options' => $category_options)); ?>
   <!-- Loading New Estimate file End -->
</div>
<!--checking role access // by satheesh kumar -->
<?php 
if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
{
?>
<div class="row new_payapp">
   <!-- Loading New Payapp file -->
   <?php $this->load->view('content/budget/save_payapp'); ?>
   <!-- Loading New Payapp file END -->
</div>
<?php 
}
?>
<div class="row m-top">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
				<!--checking role access // by satheesh kumar -->
				<?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <li role="presentation" class="<?php if(empty($this->project_id))
				{echo 'active';}else{echo '';}?>"> <a href="#summary" aria-controls="summary" data-toggle="tab"> All Project Summary</a> </li>
               <li role="presentation" class="<?php if(!empty($this->project_id))
				{echo 'active';}else{echo '';}?>"> <a href="#jobs" aria-controls="jobs" data-toggle="tab">Jobs</a> </li>
			   <?php 
			   }
			   ?>
			    <li role="presentation"> <a href="#owner_po" aria-controls="co" data-toggle="tab">Client PO</a> </li>
			    <li role="presentation"> <a href="#owner_co" aria-controls="co" data-toggle="tab">Client CO</a> </li>
               <li role="presentation"  class="<?php if(isset($this->user_account_type) && $this->user_account_type == OWNER){ echo 'active'; } ?>"> <a href="#pay_app" aria-controls="pay_app" data-toggle="tab">Pay App</a> </li>
			   <?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <li role="presentation"> <a href="#po" aria-controls="po" data-toggle="tab">Vendor PO</a> </li>
               <li role="presentation"> <a href="#co" aria-controls="co" data-toggle="tab">Vendor CO</a> </li>
			   <?php 
			   }
			   ?>
            
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
				<?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <div class="tab-pane <?php if(empty($this->project_id))
				{echo 'active';}else{echo '';}?>" id="summary">
                  <?php $this->load->view('content/budget/project_summary'); ?>
               </div>
               <div class="tab-pane <?php if(!empty($this->project_id))
				{echo 'active';}else{echo '';}?>" id="jobs">
                  <?php $this->load->view('content/budget/estimate'); ?>
               </div>
			   <?php 
			   }
			   ?>
               <div class="tab-pane <?php if(isset($this->user_account_type) && $this->user_account_type == OWNER){ echo 'active'; } ?>" id="pay_app">
                  <div class="row budget_pay_app_list">
                     <?php $this->load->view('content/budget/payapp_list'); ?>
                  </div>
                  <div class="row pay-app-list-content">
                     <?php //$this->load->view('content/budget/payapp_certificate'); ?>
                  </div>
                  <div class="row budget_pay_app_list_details">
                     <?php $this->load->view('content/budget/payapp_request_summary'); ?>
                  </div>
               </div>
			   <?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <div class="tab-pane" id="po">
                  <?php $this->load->view('content/budget/po_list'); ?>
               </div>
               <div class="tab-pane" id="co">
                  <?php $this->load->view('content/budget/co_list'); ?>
               </div>
			   <?php 
			   }
			   ?>
		        <div class="tab-pane" id="owner_co">
		              <?php $this->load->view('content/budget/owner_co_list'); ?>
		        </div>
		        <div class="tab-pane" id="owner_po">
		              <?php $this->load->view('content/budget/owner_po_list'); ?>
		        </div>
            </div>
         </div>
      </div>
   </div>
   <input type="hidden" name="selected_payapp_id" id="selected_payapp_id" 
	  value="" />
   <input type="hidden" name="selected_payapp_status" id="selected_payapp_status" 
	  value="" />
	  
</div>
<!-- Estimated_Revenue_Modal -->
<div class="modal fade Estimated_Revenue" id="Estimated_Revenue_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="text-left">Estimated Revenue</h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
              <div class="modal-con col-xs-12 pull-left">
			  <div class="col-xs-12">                								 
				<table class="table table-bordered" id="Estimated_Revenue_List">		
					<thead>
						<tr>
						<th>Client Contract</th>						
						<th>Client Contract Count</th>						
						<th>Client CO</th>
						<th>Client CO Count</th>
						<th>Estimated Revenue</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="client_contract"></span></td>						
							<td><span class="client_contract_count"></span></td>						
							<td><span class="client_co"></span></td>						
							<td><span class="client_co_count"></span></td>						
							<td><span class="estimated_revenue"></span></td>						
						</tr>
					</tbody>
				</table>		
              </div>			
              <div class="col-xs-12 text-center">                								 
				<button class="btn btn-gray" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<!-- /Estimated_Revenue_Modal -->
<!-- Total_Vendor_Cost_Modal -->
<div class="modal fade total_vendor_cost" id="Total_Vendor_Cost_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="text-left">Total Vendor Cost</h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
              <div class="modal-con col-xs-12 pull-left">
			  <div class="col-xs-12">                								 
				<table class="table table-bordered" id="Total_Vendor_Cost_List">		
					<thead>
						<tr>
						<th>Vendor Contract</th>						
						<th>Change Order</th>
						<th>Total Vendor Cost</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="vendor_contract"></span></td>						
							<td><span class="change_order"></span></td>																		
							<td><span class="total_vendor_cost"></span></td>						
						</tr>
					</tbody>
				</table>		
              </div>			
              <div class="col-xs-12 text-center">                								 
				<button class="btn btn-gray" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<!-- /Total_Vendor_Cost_Modal -->
<!-- Summary_Estimated_Revenue_Modal -->
<div class="modal fade summary_estimated_revenue_modal" id="summary_estimated_revenue_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="text-left">Estimated Revenue</h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
              <div class="modal-con col-xs-12 pull-left">
			  <div class="col-xs-12">                								 
				<table class="table table-bordered" id="summary_estimated_revenue_list">		
					<thead>
						<tr>
							<th>Client contract</th>						
							<th>Client CO</th>						
							<th>Estimated Revenue</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="summary_client_contract"></span></td>						
							<td><span class="summary_client_co"></span></td>
							<td><span class="summary_estimated_revenue"></span></td>						
						</tr>
					</tbody>
				</table>		
              </div>			
              <div class="col-xs-12 text-center">                								 
				<button class="btn btn-gray" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<!-- /Summary_Estimated_Revenue_Modal -->
<!-- Total_Vendor_Cost_Modal -->
<div class="modal fade summary_total_vendor_cost_modal" id="summary_total_vendor_cost_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="text-left">Total Vendor Cost</h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
              <div class="modal-con col-xs-12 pull-left">
			  <div class="col-xs-12">                								 
				<table class="table table-bordered" id="summary_total_vendor_cost_list">		
					<thead>
						<tr>
						<th>Vendor Contract</th>						
						<th>Change Order</th>
						<th>Total Vendor Cost</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="summary_vendor_contract"></span></td>						
							<td><span class="summary_vendor_co"></span></td>																		
							<td><span class="summary_total_vendor_cost"></span></td>						
						</tr>
					</tbody>
				</table>		
              </div>			
              <div class="col-xs-12 text-center">                								 
				<button class="btn btn-gray" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<!-- /Total_Vendor_Cost_Modal -->
<div class="modal fade confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to delete?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>  
<?php $this->load->view('content/budget/save_cost_code_popup'); ?>

<div id="pagination_area">

   <input type="hidden" value="<?php echo isset($po_search_session_array['iDisplayLength'])?$po_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="po_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($po_search_session_array['iDisplayStart'])?$po_search_session_array['iDisplayStart']:0; ?>" id="po_displayStart" />

   <input type="hidden" value="<?php echo isset($co_search_session_array['iDisplayLength'])?$co_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="co_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($co_search_session_array['iDisplayStart'])?$co_search_session_array['iDisplayStart']:0; ?>" id="co_displayStart" />

   <input type="hidden" value="<?php echo isset($owner_po_search_session_array['iDisplayLength'])?$owner_po_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="client_po_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($owner_po_search_session_array['iDisplayStart'])?$owner_po_search_session_array['iDisplayStart']:0; ?>" id="client_po_displayStart" />

   <input type="hidden" value="<?php echo isset($owner_co_search_session_array['iDisplayLength'])?$owner_co_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="client_co_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($owner_co_search_session_array['iDisplayStart'])?$owner_co_search_session_array['iDisplayStart']:0; ?>" id="client_co_displayStart" />

   <input type="hidden" value="<?php echo isset($payapp_search_session_array['iDisplayLength'])?$payapp_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="payapp_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($payapp_search_session_array['iDisplayStart'])?$payapp_search_session_array['iDisplayStart']:0; ?>" id="payapp_displayStart" />


   <input type="hidden" value="<?php echo isset($jobs_search_session_array['iDisplayLength'])?$jobs_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="jobs_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($jobs_search_session_array['iDisplayStart'])?$jobs_search_session_array['iDisplayStart']:0; ?>" id="jobs_displayStart" />

   
</div>
<link rel="stylesheet" href="<?php echo CSSSRC.'fixedColumns.dataTables.min.css';?>">
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript">  
    
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; 
   this.displayStart   = '<?php echo 0 ?>';
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes'; 
   this.user_account_type   = '<?php echo $this->user_account_type; ?>';     //code added by satheesh
   this.payapp_apply_filter = '<?php echo $payapp_apply_filter; ?>';
   this.po_apply_filter = '<?php echo $po_apply_filter; ?>';
   this.co_apply_filter = '<?php echo $co_apply_filter; ?>';
   this.owner_po_apply_filter = '<?php echo $owner_po_apply_filter; ?>';
   this.owner_co_apply_filter = '<?php echo $owner_co_apply_filter; ?>';
   this.budget_project_id = '<?php echo $this->project_id; ?>';
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.editor.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.fixedColumns.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'pay_app.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'estimate.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'budget_select.js';?>"></script>
