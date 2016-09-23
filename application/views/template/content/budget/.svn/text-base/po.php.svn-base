<script>   
   this.data_table   						= '<?php echo $data_table; ?>';   
   this.budget_po_list    					= '<?php echo $budget_po_list; ?>';  
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li>PO</li>
      <li class="active">Select Project</li>
   </ol>
</div>
<div class="row <?php if($this->template_id == ''){ echo 'no_project_selected'; } ?>">
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
                        <div class="col-xs-3">
                              <label>Date</label>                        
								  <div class='input-group date' id='datetimepicker2'> 
									<input type="text" name="due_date_time" class="form-control"   value="<?php echo isset($search_session_array['due_date_time'])?$search_session_array['due_date_time']:''; ?>" id="due_date_time" readonly> 
								  <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
								  </div>                                                        
                           </div>
           
											 
                     
                     </div>
                     
                     <div class="row five-col">
                        <div class="col-xs-6">
                           <label>&nbsp;</label>
                           <div>
							  <button type="button" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                              <button type="button" class="btn btn-gray">Reset</button>
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
              
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="po">
					<?php $this->load->view('template/content/budget/po_list'); ?>
               </div>
               
            </div>
         </div>
      </div>
   </div>
</div>
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.editor.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo TEMPSRC.'budget_select.js';?>"></script>
