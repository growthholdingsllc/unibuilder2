<script>   
   this.data_table   						= '<?php echo $data_table; ?>';   
   this.budget_po_list    					= '<?php echo $budget_po_list; ?>'; 
   this.budget_co_list    					= '<?php echo $budget_co_list; ?>'; 
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li>Budget</li>
      <li class="active">Select Project</li>-->
   </ol>
</div>
<div class="row <?php if($this->project_id == ''){ echo 'no_project_selected'; } ?>">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <!--<div class="pull-right pay-app">
            <button type="button" class="sprite  "><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save " class="save"> Save</button>
            <button type="button" class="sprite "> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save Back " class="save_back"> Save &amp; Back</button>
            <button type="button" class="closing_back"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel " class="cancel_button"> Cancel</button>			
         </div>
         <div class="pull-right po">
            <a href="<?php echo base_url().$this->crypt->encrypt('budget/save_po_co/PO'); ?>"><button type="button" class="sprite"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus"> New</button></a>
         </div>
         <div class="pull-right co">
            <a href="<?php echo base_url().$this->crypt->encrypt('budget/save_po_co/CO'); ?>"><button type="button" class="sprite">
            <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus">
            New</button></a>		
         </div>-->
      </div>
   </div>
</div>
 <div class="row m-top">
	<div class="col-xs-12 error-message uni_message">
		<div class="alerts alert-danger"></div>
	</div>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12">
                     <div class="row five-col po">
                        <div class="col-xs-3 po">
                           <label>Date</label>                        
                           <div class='input-group date' id='datetimepicker3'> 
                              <input type="text" name="due_date_time" class="form-control"   value="<?php echo isset($po_search_session_array['due_date_time'])?$po_search_session_array['due_date_time']:''; ?>" id="due_date_time" readonly> 
                              <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
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
                     </div>
					  <div class="row five-col co">
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
                     </div>
                     <!-- Co search -->
                     <div class="row five-col">
                        <div class="col-xs-6">
                           <label>&nbsp;</label>
                           <div>
							  <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                              <button type="button" class="btn btn-gray" id="reset">Reset</button>
                               <button type="submit" class="btn btn-gray" id="save_filter">Save Filter</button>
                               <button class="btn btn-default btn-gray" type="button" id="apply_save_filter" style="display:none;">Apply Saved Filter</button>
							  <input type="hidden" value="po" id="current_tab" name="current_tab" />
							  <input type="hidden" value="" id="previous_tab" name="previous_tab" />
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
<div class="row m-top">
   <div class="col-xs-12">
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"> <a href="#po" aria-controls="po" data-toggle="tab">Po</a> </li>
               <li role="presentation"> <a href="#co" aria-controls="co" data-toggle="tab">Co</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="po">
					<?php $this->load->view('content/budget/po_list'); ?>
               </div>
               <div class="tab-pane" id="co">
					<?php $this->load->view('content/budget/co_list'); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
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
   this.po_apply_filter = '<?php if(isset($po_apply_filter)){ echo $po_apply_filter;}?>';
   this.co_apply_filter = '<?php if(isset($co_apply_filter)){ echo $co_apply_filter;}?>';
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.editor.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'sub_budget_select.js';?>"></script>
