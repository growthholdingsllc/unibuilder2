<!-- inner content wrapper -->

<div class="wrapper">
<form role="form" class="parsley-form" data-parsley-validate>
  <div class="row">
    <ol class="breadcrumb">
      <li> <a href="javascript:;">Home</a> </li>
      <li class="active">View Payments</li>
    </ol>
  </div>
  
  <!-- Field Search -->
  
  <div class="row">
    <section class="panel bg-none">
      <div class="panel-group" id="accordion">
        <div class="panel">
          <div class="panel-heading"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Search </a> </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
              <form role="form">
                <div class="form-group col-lg-3">
                  <label>Plan</label>
                  <!-- <select class="form-control" data-parsley-required="true" data-parsley-trigger="change">
                    <option value="">Nothing selected</option>
                    <option>Plan A</option>
                    <option>Plan B</option>
                    <option>Plan C</option>
                    <option>Plan D</option>
                  </select> -->
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
                  <label for="exampleInputPassword1">Payments Status</label>
                  <!-- <select class="form-control" data-parsley-required="true" data-parsley-trigger="change">
                    <option value="">Nothing selected</option>
                    <option>Active</option>
                    <option>In Active</option>
                  </select> -->
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
                  <label for="exampleInputPassword1">Membership ID</label>
                  <input type="text" placeholder="Search" id="membership_id" name="membership_number" class="form-control" data-parsley-required="true" data-parsley-trigger="change" value="<?php echo isset($search_session_array['membership_number'])?$search_session_array['membership_number']:''; ?>">
                </div>
                <div class="form-group col-lg-3">
                  <label for="exampleInputPassword1">Company Name</label>
                  <input type="text" placeholder="Enter company name" id="company-name" name="	builder_name" class="form-control" data-parsley-required="true" data-parsley-trigger="change" value="<?php echo isset($search_session_array['builder_name'])?$search_session_array['builder_name']:''; ?>" >
                </div>
              </form>
            </div>
            <div class="row mb20 text-center">
              <button class="btn btn-info btn-sm mr5" id="update_result">Search</button>
              <button class="btn btn-default btn-sm mr5" id="reset">Reset</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  </form>
  <!-- /Field Search --> 
  
  <!-- main content -->
  <div class="row">
    <section class="main-content">
      <div class="content-wrap">
        <section class="panel">
          <table class="table table-bordered table-striped mg-t datatable" id="payment_list">
            <thead>
              <tr>
                <th>Membership ID</th>
                <th>Company Name</th>
                <th>Billing Period</th>
                <th>Plan</th>
                <th>Payment Type</th>
                <th>Payment Status</th>
                <th>Amount</th>
                <th>Transaction ID</th>
                <th>Remarks</th>
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
<script src="<?php echo ACJI.'scripts/js/payment-view-datatables.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ub-admin-datatable.js';?>"></script>
<script src="<?php echo ACJI.'scripts/plugins/parsley.min.js';?>"></script> 
<!-- /page script --> 
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo isset($search_session_array['iDisplayLength'])?$search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>';    
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';   
   
</script>