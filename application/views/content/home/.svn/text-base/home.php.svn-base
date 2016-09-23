<script>   
   this.data_table   = '<?php echo $data_table; ?>';
   this.fullcalendar = '<?php echo $fullcalendar; ?>';     
   this.listview     = '<?php echo $listview; ?>';     
   this.activityview = '<?php echo $activityview; ?>';     
   this.Activity_Calendar = '<?php echo $Activity_Calendar; ?>';     
</script>
<div class="row">
	<ol class="breadcrumb">
	   <?php //$this->load->view('common/breadcrumbs'); ?> 
	   <!--<li class="active">Leads</li>-->
	</ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">         
         <div class="col-xs-3 pull-right">
            <select class="selectpicker form-control">
               <option>Lead Actions</option>
               <option>Import Leads</option>
               <option>Delete Checked Leads</option>
               <option>Print All Checked</option>
               <option>Import Activity</option>
               <option>Assign All Checked</option>
            </select>
         </div>
         <a href="<?php echo base_url(); ?>home/newlead"><button type="button" class="btn btn-blue pull-right">
		  <img border="0" src="<?=$this->config->item("image_url");?>strip.gif" alt="New Lead" class="addnew">
		 New Lead</button></a>
      </div>
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title">
                     <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span>
                     </a>
                  </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12">
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>Status</label>
                           <select class="selectpicker form-control">
                              <option>Open</option>
                              <option>Lost</option>
                              <option>Sold</option>
                              <option>No Opportunity</option>
                              <option>Activity Template</option>
                           </select>
                        </div>
                        <div class="col-xs-3">
                           <label>Sales Person</label>
                           <select class="selectpicker form-control">
                              <option>-- All Sales People --</option>
                              <option>Unassigned</option>
                              <option>John</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                           <p>&nbsp;</p>
                           <input type="checkbox"/> Has valid email id
                        </div>
                        <div class="col-xs-3">
                           <label>Age</label>
                           <select class="selectpicker form-control">
                              <option>-- All Dates --</option>
                              <option>-- Custom Dates --</option>
                              <option>Today</option>
                              <option>Today &amp; Yesterday</option>
                              <option>Past 7 days</option>
                              <option>Past 14 days</option>
                              <option>Past 30 days</option>
                              <option>Past 45 days</option>
                              <option>Past 60 days</option>
                              <option>Past 90 days</option>
                              <option>Past 180 days</option>
                              <option>Past 365 days</option>
                            </select>
                        </div>
						<div class="col-xs-3">
                           <label>Keyword Search</label>
                           <div class="right-inner-addon">        
                              <i class="glyphicon glyphicon-search"></i>
                              <input type="search" class="form-control" placeholder="Search" />
                           </div>
                        </div>
                     </div>
                     <div class="row five-col">
                        
                        <div class="col-xs-3">
                           <label>Tags</label>
                           <select class="selectpicker form-control">
                              <option>-- No Lead Tags --</option>
                              <option>East Coast</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                           <label>Source</label>
                           <select class="selectpicker form-control">
                              <option>-- No Lead Sources --</option>
                              <option>Contact Form</option>
                              <option>Google</option>
                              <option>Referral</option>
                           </select>
                        </div>
                        <div class="col-xs-3">
                           <label>Project Type</label>
                           <select class="selectpicker form-control">
						     <option>-- No Project Type --</option>
						     <option>Remodel</option>
						     <option>Scratch</option>
                           </select>
                        </div>
						 <div class="col-xs-3">
                           <label>Proposal Status</label>
                           <select class="selectpicker form-control">
                              <option>-- No Proposal Statuses  --</option>
                              <option>Pending not released</option>
                              <option>Pending</option>
                              <option>Approved</option>
                              <option>Declined</option>
                              <option>None</option>
                            </select>
                        </div>
						
                     </div>
                     <div class="row text-center">
                        <button type="button" class="btn btn-secondary">Update Results</button>
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
					<a href="#List-View" aria-controls="List-View" data-toggle="tab">List View</a>
			   </li>
				<li role="presentation">
					<a href="#Activity-View" class="activity_view" aria-controls="Activity-View" data-toggle="tab">Activity View</a>
				</li>
               <li role="presentation">
				<a href="#Activity-Calendar" class="Activity-Calendar" aria-controls="Activity-Calendar" data-toggle="tab">Activity Calendar</a>
				</li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="List-View">
					<table class="table table-bordered datatable" id="list_view">
						 <thead>
							<tr>
							   <th><input type="checkbox"/></th>							   
							   <th>Name</th>
							   <th>&nbsp;</th>
							   <th>Status</th>
							   <th>Age</th>
							   <th>Confidence</th>
							   <th>Est.Revenue</th>							  
							   <th>Last Contacted</th>
							   <th>Sales Person</th>							   
							   <th>Lead Source</th>							   
							   <th>Proposal Status</th>							   
							   <th>Project Type</th>							   
							</tr>
						 </thead>
						 <tbody>
						 </tbody>
																			 
					  </table>
                </div>
               <div class="tab-pane" id="Activity-View">
                  <table class="table table-bordered datatable" id="activity_view">
                     <thead>
                        <tr>
                           <th><input type="checkbox"/></th>
                           <th>Status</th>
                           <th>Type</th>
                           <th>&nbsp;</th>
                           <th>Lead Name</th>
                           <th>Employee</th>
                           <th>Contact Date</th>
                           <th>Notes</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane" id="Activity-Calendar">
					<div id='calendar'></div>
			   </div>
            </div>
         </div>
      </div>
   </div>    
</div>
<!-- /List Modal -->
<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!-- /List Modal -->
<!-- Calendar Modal -->
<div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		<h4>Event Management <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
			
			<div class="modal-body">
			<div class="row">
               <div class="col-xs-12">
				<div class="modal-con1">
				</div>
				</div>
				</div>
			</div>
			<div class="modal-footer">
			<div class="row">
               <div class="col-xs-12">
				<button type="button" data-dismiss="modal" class="btn btn-light-grey">
					Close
				</button>
				<button type="button" class="btn btn-danger remove-event no-display">
					<i class='icon-trash'></i> Delete Event
				</button>
				<button type='submit' class='btn btn-success save-event'>
					<i class='icon-ok'></i> Save
				</button>
			</div>
			</div>
			</div>
		</div>
	</div>
</div>
<!-- /Calendar Modal -->