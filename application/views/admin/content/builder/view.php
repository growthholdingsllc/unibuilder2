<!-- inner content wrapper -->

<div class="wrapper">
  <div class="row">
    <ol class="breadcrumb">
      <li> <a href="javascript:;">Home</a> </li>
      <li class="active">Builder View</li>
    </ol>
  </div>
  
  <!-- Top Button -->
  <div class="row mb20"> 
	<a href="<?php echo base_url(); ?>YWRtaW4vYnVpbgxf1Rlci9zYXZlX2J1aWxkZXIv">
		<button class="btn btn-primary pull-right" type="button">New Builder</button>
    </a> 
  </div>
  <!-- /Top Button --> 
  <div class="row mb10">
	  <div class="col-xs-12 error-message uni_message">
		 <div class="alerts alert-danger"></div>
	   </div>
  </div>
  <!-- Field Search -->
  
  <div class="row">
    <section class="panel bg-none">
      <div class="panel-group" id="accordion">
        <div class="panel">
          <div class="panel-heading"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> FILTER ALL YOUR ACTIONS </a> </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <form role="form" class="parsley-form" method="post" name="Search_Result" id="Search_Result">
              <div class="panel-body">
                <div class="form-group col-lg-3">
                  <label>Current Plan</label>
                  <?php 
                              $plan_selected = '';
                              if(isset($search_session_array['plan_id']))
                              {
                                 $plan_selected = explode(",",$search_session_array['plan_id']);
                              }
                              echo form_dropdown('plan_id', $plan,$plan_selected, "class='selectpicker form-control' id='plan_id' data-live-search='true'"); 
                              ?>
                </div>
                <div class="form-group col-lg-3">
                  <label for="exampleInputPassword1">Status</label>
                  <?php 
                              $status_selected = '';
                              if(isset($search_session_array['status_id']))
                              {
                                 $status_selected = explode(",",$search_session_array['status_id']);
                              }
                              echo form_dropdown('status_id', $status_dropdown_list,$status_selected, "class='selectpicker form-control' id='status_id' data-live-search='true'"); 
                              ?>
                </div>
                <div class="form-group col-lg-3">
                  <label for="exampleInputPassword1">Company Name</label>
                  <input type="text" placeholder="Enter company name" id="company_name" name="company_name" class="form-control" value="<?php echo isset($search_session_array['company_name'])?$search_session_array['company_name']:''; ?>" />
                </div>
              </div>
              <div class="row mb20 text-center">
                <button type="submit" class="btn btn-info btn-sm mr5" id="update_result" name="update_result">Search</button>
                <button type="submit" class="btn btn-default btn-sm mr5" id="reset" name="reset">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /Field Search --> 
  
  <!-- main content -->
  <div class="row">
    <section class="main-content">
      <div class="content-wrap">
        <section class="panel">
          <table class="table table-bordered table-striped mg-t datatable" id="builder_List_table" name="builder_List_table">
            <thead>
              <tr>
                <th>Membership ID</th>
                <th>Company Name</th>
                <th>Contact Name</th>
                <th>Current Plan</th>
                <th>Account Status</th>
                <th>City</th>
               <!--  <th>Last Payment Status</th> --> 
              </tr>
            </thead>
          </table>
        </section>
      </div>
    </section>
  </div>
  <!-- /main content --> 
  
</div>
<!-- /inner content wrapper --> 

<!-- page level plugin styles -->
<link rel="stylesheet" href="<?php echo ACJI.'scripts/plugins/chosen/chosen.min.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'scripts/plugins/datatables/jquery.dataTables.css';?>">
<!-- /page level plugin styles --> 

<!-- page level scripts --> 
<script src="<?php echo ACJI.'scripts/plugins/chosen/chosen.jquery.min.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/datatables/jquery.dataTables.js';?>"></script> 
<!-- /page level scripts --> 

<!-- page script --> 
<script src="<?php echo ACJI.'scripts/js/bootstrap-datatables.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/js/builder_list.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/parsley.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ub-admin-datatable.js';?>"></script>
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo isset($search_session_array['iDisplayLength'])?$search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>';   
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>

<!-- /page script --> 