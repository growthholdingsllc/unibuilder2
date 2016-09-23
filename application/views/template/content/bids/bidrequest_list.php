<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li class="active">Bid Request</li>
   </ol>
</div>
<div class="row m-top">
   <div class="col-xs-12 error-message uni_message">
      <div class="alerts alert-danger"></div>
   </div>
</div>
 <form id="Search_Result" name="Search_Result" method="post" class="form-horizontal">
<div class="row">
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
                     <div class="row text-center m-top">
                        <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                        <button type="submit" class="btn btn-gray" id="bidrequest_search_reset">Reset</button>
                        <button type="submit" class="btn btn-gray" id="save_filter">Save Filter</button>
                        <?php if($apply_filter == TRUE){ ?>
                        <button class="btn btn-gray" type="button" id="apply_save_filter">Apply Saved Filter</button>
                        <?php }else { ?>
                        <button class="btn btn-gray" type="button" id="apply_save_filter" style="display:none;">Apply Saved Filter</button>
                        <?php } ?>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</form>
<div class="row">
   <div class="col-xs-12 pull-left">
      <div class="row datatable-bor">
         <div class="add-function">
            <!--checking role access  // by satheesh -->
            <?php 
               if(isset($this->user_role_access[strtolower('bids')][strtolower('delete')]) && $this->user_role_access[strtolower('bids')][strtolower('delete')] == 1)
               {
               ?>
            <div class="col-xs-3 pull-left">
               <select class="selectpicker form-control" onchange="delete_all_checked_warranty(this.value)" title="Task Actions">
                  <option value="">Bulk Actions</option>
                  <option value="delete_multi_warranty">Delete Checked Warranty</option>
               </select>
            </div>
            <?php 
               }
               ?>
         </div>
      </div>
   </div>
</div>
<div class="row roles m-top">
   <div class="col-xs-12 pull-left">
      <table class="table table-bordered datatable" id="Bidsrequest_List" width="100%">
         <thead>
            <tr>
               <th>Bid Request Name</th>
               <th>Date Requested</th>
               <th>Deadline</th>
               <th>Will Bid?</th>
               <th>Project</th>
               <th>Bid Amount</th>
               <th>Status</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
<div class="modal fade" id="ChecklistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Grid Settings
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="border-none">
                              <tr>
                                 <td height="30">Saved Views</td>
                                 <td>
                                    <select class="selectpicker form-control">
                                       <option>Standard View</option>
                                    </select>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row m-top">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>Current View</h4>
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="30">Column</td>
                                 <td>
                                    <select class="selectpicker form-control">
                                       <option>All Items Selected</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td height="30">View Name</td>
                                 <td><input type='text' class="form-control" placeholder="Standard View234" /></td>
                              </tr>
                              <tr>
                                 <td>Is Default</td>
                                 <td><input type="checkbox" />
                                    Is Default
                                 </td>
                              </tr>
                              <tr>
                                 <td class="text-center" colspan="2"><button class="btn btn-default btn-primary" type="button">APPLY VIEW</button>
                                    <button class="btn btn-default btn-primary" type="button">SAVE AS VIEW</button>
                                    <button class="btn btn-default btn-primary" type="button">UPDATE SELECTED</button>
                                 </td>
                                 <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<input type="hidden" id="bids_index" value="" />
<!-- /Check List Modal -->
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script> 
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';   
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'bidsrequest_list.js';?>"></script>