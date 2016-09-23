<script>   
   this.data_table     = '<?php echo $data_table; ?>';      
   this.internal_user  = '<?php echo $internal_user; ?>';     
   this.sub_vendors    = '<?php echo $sub_vendors; ?>';     
</script>

<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Users</li>-->
  </ol>
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
			<form id="Search_Result" class="form-horizontal" method="post" name="Search_Result"> 
              <div class="row internal-user">
                <div class="col-xs-3">
                  <label>Keyword Search</label>
                  <div class="right-inner-addon"> <i class="glyphicon glyphicon-search"></i>
                    <input type="search" class="form-control" placeholder="Search" id="first_name" name="first_name" value="<?php echo $sess_first_name; ?>"/>
                  </div>
                </div>
				<div class="col-xs-6">
					<label>&nbsp;</label>
					<div>
						<button type="button" class="btn  btn-secondary" id="update_result">Update Resultss</button>
						<button type="button" class="btn btn-default btn-primary" id="user_search_reset" name="user_search_reset">Reset</button>
						<button type="button" class="btn btn-default btn-primary" id="save_filter" name="save_filter">Save Filter</button>
						<?php if($apply_filter == TRUE){ ?>
						<button type="button" class="btn btn-default btn-primary" id="apply_save_filter" name="apply_save_filter" >Apply Filter</button>
						<?php } ?>
					</div>
				</div>
              </div>
			  <div class="row sub-vendors">
				<div class="col-xs-3">
					<?php 
					echo form_dropdown('subcontractor_department', $subcontractor_department,'', "class='selectpicker form-control' id='subcontractor_department' data-live-search='true'"); 
					?>
				</div>
				<div class="col-xs-3">
					<?php 
					echo form_dropdown('user_status', $user_status,'', "class='selectpicker form-control' id='user_status' data-live-search='true'"); 
					?>
				</div>
				<div class="col-xs-3">
					<input type="text" class="form-control"/>
				</div>
				<div class="col-xs-12">
					<label>&nbsp;</label>
					<div>
						<button type="button" class="btn  btn-secondary" id="update_contractor_result">Update Results</button>
						<button type="button" class="btn btn-default btn-primary" id="contractor_search_reset" name="contractor_search_reset">Reset</button>
						<button type="button" class="btn btn-default btn-primary" id="save_contractor_filter" name="save_contractor_filter">Save Filter</button>
					</div>
				</div>
              </div>
			  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-con pull-left">
      <div role="tabpanel"> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="Internal active"> <a href="#Internal-Users" aria-controls="Internal-Users" data-toggle="tab" id="internal">Internal Users</a> </li>
          <li role="presentation" class="vendors"> <a href="#Sub-Vendors" aria-controls="Sub-Vendors" data-toggle="tab" id="vendors">Sub Vendors</a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="Internal-Users">
            <table class="table table-bordered datatable" id="Internal_Users">
              <thead>
                <tr>
				  <th><input type="checkbox" name="selectall" id="selectall"/></th>
                  <th>Name</th>
                  <th>Mobile Number</th>
                  <th>Email</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
             
            </table>
          </div>
          <div class="tab-pane" id="Sub-Vendors">
            <table class="table table-bordered datatable" id="Sub_Vendors">
              <thead>
                <tr>
                  <th><input type="checkbox"/></th>
                  <th>Company</th>
                  <th>Division</th>
				  <th>Cell</th>
				  <th>Phone</th>
				  <th>Email</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
         
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Internalusers Modal -->
<div class="modal fade" id="internalusersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
	   <h4>Grid Settings <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
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
									<td>
									<input type='text' class="form-control" placeholder="Standard View234" />
									</td>
								</tr>
								<tr>
									<td>Is Default</td>
									<td><input type="checkbox" /> Is Default</td>
								</tr>
								<tr>
									<td class="text-center" colspan="2"><button class="btn btn-default btn-primary" type="button">APPLY VIEW</button> <button class="btn btn-default btn-primary" type="button">SAVE AS VIEW</button> <button class="btn btn-default btn-primary" type="button">UPDATE SELECTED</button></td>
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
<!-- /Internalusers Modal -->
<!-- SubvendorsusersModal Modal -->
<div class="modal fade" id="subvendorsusersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
	   <h4>Grid Settings <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
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
									<select class="selectpicker form-control" multiple>
										<option>Company Name</option>
										<option>Sub Divisions</option>
										<option>Activation Status</option>
										<option>Primary Contact</option>
										<option>Trade Agreement Status</option>
										<option>Liability Expiration Date</option>
										<option>Workman's Compensation Expiration Date</option>
										<option>Cell</option>
										<option>Phone</option>
										<option>Email</option>
										<option>Address</option>
										<option>City</option>
										<option>Fax</option>
										<option>State</option>
										<option>Zip</option>
									</select>
									</td>
								</tr>								
								<tr>
									<td height="30">View Name</td>
									<td>
									<input type='text' class="form-control" placeholder="Standard View234" />
									</td>
								</tr>
								<tr>
									<td>Is Default</td>
									<td><input type="checkbox" /> Is Default</td>
								</tr>
								<tr>
									<td class="text-center" colspan="2"><button class="btn btn-default btn-primary" type="button">APPLY VIEW</button> <button class="btn btn-default btn-primary" type="button">SAVE AS VIEW</button> <button class="btn btn-default btn-primary" type="button">UPDATE SELECTED</button></td>
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
<!-- /SubvendorsusersModal Modal -->
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo 0 ?>';     
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'user.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>