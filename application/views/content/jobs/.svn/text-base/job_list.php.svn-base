<script>   
   this.data_table   = '<?php echo $data_table; ?>';   
   this.joblist      = '<?php echo $joblist; ?>';
   this.map          = '<?php echo $map; ?>';
</script>
<div class="row">
	<ol class="breadcrumb">
	   <?php //$this->load->view('common/breadcrumbs'); ?> 
	   <!--<li class="active">Jobs</li>-->
	</ol>
</div>
<div class="row">
   <div class="col-xs-12">
   <div class="top-search pull-right">
      <div class="btn-group pull-right">
        <button type="button" class="btn btn-secondary btn-sm btn-flat dropdown-toggle" data-toggle="dropdown"> New Jobs <span class="caret"></span> </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="<?php echo base_url(); ?>jobs/jobsdetails">From Scratch</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url(); ?>jobs/newjobtemplate">From Template</a></li>
        </ul>
      </div>
    </div>
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title">
                     <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     FILTER YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span>
                     </a>
                  </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12 ">
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>-- Any Job Group --</option>                              
                           </select>
                        </div>
                        <div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>-- Any Project Manager --</option>                              
                              <option>Unassigned</option>                              
                              <option>A,John</option>                              
                              <option>Brant,Mitchel</option>                              
                           </select>
                        </div>
                        <div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>-- Open or Closed --</option>                              
                              <option>Open Jobsite Only</option>                              
                              <option>Closed Jobsite Only</option>                              
                           </select>
                        </div>
                         <div class="col-xs-3">
                           <label>Keyword Search</label>
                           <div class="right-inner-addon">        
                              <i class="glyphicon glyphicon-search"></i>
                              <input type="search" class="form-control" placeholder="Search" />
                           </div>
                        </div>
						  <div class="col-xs-3">
                           <label>Mapped Status</label>
                           <select class="selectpicker form-control">
                              <option>All Jobs</option>                              
                              <option>Mapped Jobs</option>                              
                              <option>Unmapped Jobs</option>                              
                           </select>
                        </div>
                     </div>
                     <div class="row text-center">
                        <button type="button" class="btn  btn-secondary">Update Results</button>
                        <button type="button" class="btn btn-default btn-primary">Reset</button>							 
                        <button type="button" class="btn btn-default btn-primary">Save Filter</button>							 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-con pull-left">
         <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active">
					<a href="#Jobs-List" aria-controls="Jobs-List" data-toggle="tab">List</a>
			   </li>
				<li role="presentation">
					<a href="#Jobs-Map" aria-controls="Jobs-Map" data-toggle="tab">Map</a>
				</li>              
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="Jobs-List">
					<table class="table table-bordered datatable" id="Jobs_List">
						 <thead>
							<tr>							   
							   <th><input type="checkbox"/></th>
							   <th>Jobs Name</th>
							   <th>Address</th>
							   <th>City</th>
							   <th>State</th>
							   <th>Zip</th>
							   <th>Project Manager</th>
							   <th>Owner</th>
							   <th>Phone</th>
							   <th>Cell Phone</th>
							   <th>Call Status</th>
							   <th>Map</th>							   
							</tr>
						 </thead>
						 <tbody>
						 </tbody>
					</table>									
                </div>
               <div class="tab-pane" id="Jobs-Map">
                  <div id="jobs-map">
				  </div>
               </div>
            </div>
         </div>
      </div>
   </div>    
</div>
<!-- /Job List Modal -->
<div class="modal fade" id="JobslistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!-- /Job List Modal -->