<script>   
   this.data_table   = '<?php echo $data_table; ?>';
   this.bids_list 	 = '<?php echo $bids_list; ?>'; 
   this.date_all     = '<?php echo $date_all; ?>';     
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Bids</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <table class="pull-right col-xs-12">
            <tr>
               <td class="col-xs-6">&nbsp;</td>
               <td class="col-xs-3" valign="middle">
                  <!--checking role access // by satheesh kumar -->
                  <?php
                     if(isset($this->user_role_access[strtolower('bids')][strtolower('add')]) && $this->user_role_access[strtolower('bids')][strtolower('add')] == 1)
                     {
						if(isset($this->project_status_check) && $this->project_status_check == 1)
						{
                     ?>
                  <a href="<?php echo base_url(); ?>Ymlkcy9zYXZlX2JpZC8-">
                  <button type="button" class="btn btn-blue  pull-right"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New Lead" class="uni_new" />
                  New Bid Package
                  </button>
                  </a>
                  <?php 
						}
                     }
                     ?>
					<?php 
					if($this->user_account_type == BUILDERADMIN) 
					{ 
						if(isset($this->project_status_check) && $this->project_status_check == 1)
						{
							$this->load->view('common/import_template');
						}
					} 
					?>
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>
<div class="row m-top">
   <div class="col-xs-12 error-message uni_message">
      <div class="alerts alert-danger"></div>
   </div>
</div>
<div class="row m-top">
   <form id="Search_Result" name="Search_Result" method="post" class="form-horizontal">
      <div class="col-xs-12">
         <div class="panel-content pull-left">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="filter">
                     <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                     <div class="panel-body col-xs-12">
                        <div class="row">
                           <div class="col-xs-3">
                              <label>Bid Package Status</label>
                              <div class="col-xs-12">
                                 <div class="form-group">
                                    <?php
                                       $packagestatus_selected = '';
                                       if(isset($search_session_array['bid_package_status']))
                                       {
                                       $packagestatus_selected = $search_session_array['bid_package_status'];
                                       }
                                       echo form_dropdown('bid_package_status[]',$packagestatus_array,$packagestatus_selected, "class='selectpicker form-control' id='bid_package_status' data-live-search='true'"); 
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xs-3">
                              <label>Bid Status</label>
                              <?php
                                 $bidstatus_selected = '';
                                 if(isset($search_session_array['bid_status']))
                                 {
                                 $bidstatus_selected = $search_session_array['bid_status'];
                                 }
                                 echo form_dropdown('bid_status[]',$bidstatus_array,$bidstatus_selected, "class='selectpicker form-control' id='bid_status' data-live-search='true'"); 
                                 ?>
                           </div>
                           <div class="col-xs-3">
                              <label>Date Range</label>
                              <div class="input-prepend input-group">
                                 <input type="text" name="daterange" id="daterange" class="form-control " value="<?php echo isset($search_session_array['daterange'])?$search_session_array['daterange']:''; ?>" readonly />
                                 <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span> 
                              </div>
                           </div>
                        </div>
                        <div class="row text-center">
                           <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                           <button type="submit" class="btn btn-gray" id="bids_search_reset" >Reset</button>
						   <button type="submit" class="btn btn-gray" id="save_filter">Save Filter</button>
                           <?php if($apply_filter == TRUE){ ?>
                           <button class="btn btn-default btn-gray" type="button" id="apply_save_filter">Apply Saved Filter</button>
                           <?php }else { ?>
                           <button class="btn btn-default btn-gray" type="button" id="apply_save_filter" style="display:none;">Apply Saved Filter</button>
                           <?php } ?>
                           <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</form>
</div>
<div class="row">
   <div class="col-xs-12 pull-left">
      <table class="table table-bordered datatable" id="Bids_List" width="100%">
         <thead>
            <tr>
               <th>&nbsp;</th>
               <th>Package Title</th>
               <th>Response(s)</th>
               <th>Accepted</th>
               <th>Released</th>
               <th>Deadline</th>
               <th>Status</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
<input type="hidden" id="bids_index" value="" />
<!-- /Check List Modal -->
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo isset($search_session_array['iDisplayLength'])?$search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';
   this.project_id  = '<?php echo $this->project_id; ?>';  
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bids_list.js';?>"></script>