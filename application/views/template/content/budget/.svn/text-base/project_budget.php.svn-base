<script>   
   this.data_table   						= '<?php echo $data_table; ?>';   
   this.budget_summary_list    				= '<?php echo $budget_summary_list; ?>'; 
   this.budget_jobs_list    				= '<?php echo $budget_jobs_list; ?>'; 
   this.budget_pay_app_list    				= '<?php echo $budget_pay_app_list; ?>'; 
   this.budget_po_list    					= '<?php echo $budget_po_list; ?>'; 
   this.budget_co_list    					= '<?php echo $budget_co_list; ?>'; 
   this.budget_pay_app_list_details    		= '<?php echo $budget_pay_app_list_details; ?>'; 
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li>Budget</li>
      <li class="active">Select Project</li>
   </ol>
</div>
<div class="row <?php if($this->template_id == ''){ echo 'no_project_selected'; } ?>">
   <div class="col-xs-12">
      <div class="top-search pull-right">         
         <div class="pull-right po">
			<?php 
			if(isset($this->user_role_access[strtolower('budget')][strtolower('add')]) && $this->user_role_access[strtolower('budget')][strtolower('add')] == 1)
			{
				
			?>
            <a href="<?php echo base_url().$this->crypt->encrypt('template/budget/save_po_co/PO'); ?>"><button type="button" class="btn btn-blue pull-right"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="uni_new"> New</button></a>
			<?php 
			if($this->user_account_type == BUILDERADMIN) 
			{ 
				//$this->load->view('common/import_template'); 
			} 
			?>
			<?php 
				
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
            <!-- <a href="<?php echo base_url().$this->crypt->encrypt('budget/save_po_co/CO'); ?>"><button type="button" class="sprite">
            <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus">
            New</button></a> -->
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
                       
						<div class="col-xs-3 po">
                           <label>Date</label>                        
                           <div class='input-group date' id='datetimepicker3'> 
                              <input type="text" name="due_date_time" class="form-control"   value="<?php echo isset($po_search_session_array['due_date_time'])?$po_search_session_array['due_date_time']:''; ?>" id="due_date_time" readonly> 
                              <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
                           </div>
                        </div>						
                 
                

                     </div>
                     <div class="row five-col">
                        <div class="col-xs-6">
                           <label>&nbsp;</label>
                           <div>
                              <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                              <button type="button" class="btn btn-gray" id="reset">Reset</button>
                               
                              <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
							  <input type="hidden" id="budget_index" value="" />
							  <input type="hidden" value="job" id="current_tab" name="current_tab" />
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
   <?php $this->load->view('template/content/budget/save_estimate',array('cost_code_options' => $cost_code_options,'category_options' => $category_options)); ?>
   <!-- Loading New Estimate file End -->
</div>
<!--checking role access // by satheesh kumar -->
<?php 
if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
{
?>
<div class="row new_payapp">
   <!-- Loading New Payapp file -->
   <?php //$this->load->view('content/budget/save_payapp'); ?>
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
              <!--  <li role="presentation"> <a href="#summary" aria-controls="summary" data-toggle="tab">Summary</a> </li> -->
               <li role="presentation" class="active"> <a href="#jobs" aria-controls="jobs" data-toggle="tab">Jobs</a> </li>
			   <?php 
			   }
			   ?>
               <!-- <li role="presentation"  class="<?php if(isset($this->user_account_type) && $this->user_account_type == OWNER){ echo 'active'; } ?>"> <a href="#pay_app" aria-controls="pay_app" data-toggle="tab">Pay App</a> </li> -->
			   <?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <li role="presentation"> <a href="#po" aria-controls="po" data-toggle="tab">Vendor PO</a> </li>
               <!-- <li role="presentation"> <a href="#co" aria-controls="co" data-toggle="tab">Co</a> </li> -->
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
               <div class="tab-pane" id="summary">
                  <?php //$this->load->view('content/budget/project_summary'); ?>
               </div>
               <div class="tab-pane active" id="jobs">
                  <?php $this->load->view('template/content/budget/estimate'); ?>
               </div>
			   <?php 
			   }
			   ?>
               <div class="tab-pane <?php if(isset($this->user_account_type) && $this->user_account_type == OWNER){ echo 'active'; } ?>" id="pay_app">
                  <div class="row budget_pay_app_list">
                     <?php //$this->load->view('content/budget/payapp_list'); ?>
                  </div>
                  <div class="row pay-app-list-content">
                     <?php //$this->load->view('content/budget/payapp_certificate'); ?>
                  </div>
                  <div class="row budget_pay_app_list_details">
                     <?php //$this->load->view('content/budget/payapp_request_summary'); ?>
                  </div>
               </div>
			   <?php 
				if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
				{
				?>
               <div class="tab-pane" id="po">
                  <?php $this->load->view('template/content/budget/po_list'); ?>
               </div>
               <div class="tab-pane" id="co">
                  <?php //$this->load->view('content/budget/co_list'); ?>
               </div>
			   <?php 
			   }
			   ?>
            </div>
         </div>
      </div>
   </div>
   <input type="hidden" name="selected_payapp_id" id="selected_payapp_id" 
	  value="" />
   <input type="hidden" name="selected_payapp_status" id="selected_payapp_status" 
	  value="" />
	  
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
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.editor.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'pay_app.js';?>"></script>
<script type="text/javascript" src="<?php echo TEMPSRC.'estimate.js';?>"></script>
<script type="text/javascript" src="<?php echo TEMPSRC.'budget_select.js';?>"></script>
