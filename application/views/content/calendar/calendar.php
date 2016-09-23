<script>   
   this.data_table   			 = '<?php echo $data_table; ?>';
   this.all_calendar 			 = '<?php echo $all_calendar; ?>';                    
   this.gantt        			 = '<?php echo $gantt; ?>';                                           
   this.calendar_listview        = '<?php echo $calendar_listview; ?>';                                           
   this.calendar_baselineview    = '<?php echo $calendar_baselineview; ?>';                                           
   this.calendar_workdays    	 = '<?php echo $calendar_workdays; ?>';                                           
   this.calendar_phaselist    	 = '<?php echo $calendar_phaselist; ?>';                                           
</script>
<div class="row">
	<ol class="breadcrumb">
	   <?php //$this->load->view('common/breadcrumbs'); ?> 
	   <!--<li class="active">Calendar</li>-->
	</ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">         
         <div class="col-xs-3 pull-right">
            <select class="selectpicker form-control">
               <option>Calendar	Actions</option>
               <option>Track Collisions</option>
            </select>
         </div> 
		<div class="col-xs-3 pull-right">
            <select class="selectpicker form-control">
               <option>Print</option>
               <option>Landscape</option>
               <option>Portrait</option>
            </select>
         </div>		 
		<div class="col-xs-3 pull-right">
            <select class="selectpicker form-control">
               <option>New</option>
               <option>Schedule Item</option>
               <option>Workday Exception</option>
            </select>
         </div>		 
      </div>
      <div class="panel-content pull-left">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
               <div class="panel-heading" role="tab" id="filter">
                  <h4 class="panel-title">
                     <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span>
                     </a>
                  </h4>
               </div>
               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                  <div class="panel-body col-xs-12">
                     <div class="row five-col">
                        <div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>-- No Performing Users --</option>
                              <optgroup label="Internal User">
							   <option>John</option>
							  </optgroup>
							   <optgroup label="Subs">
							   <option>Metal Works</option>
							  </optgroup>
                           </select>
                        </div>
                        <div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>All Schedule Items</option>
                              <option>No Schedule Items</option>
                              <option>Upcoming Items</option>
                              <option>Completed Items</option>
                              <option>In Progress Items</option>
                              <option>Unconfirmed Items</option>
                           </select>
                        </div>
						<div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>All Schedule Items Tag</option>
                           </select>
                        </div>
						<div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>-- All Phase --</option>
                              <option>Painting</option>
                           </select>
                        </div>
						<div class="col-xs-3">
                           <label>&nbsp;</label>
                           <select class="selectpicker form-control">
                              <option>-- No Other Items --</option>
							  <option>Change Orders</option>
							  <option>Option  Deadlines</option>
							  <option>Selection  Deadlines</option>
							  <option>Warranty  Services</option>
							  <option>Daily  Logs</option>
							  <option>To Dos</option>
							  <option>Owner Payments</option>
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
					<a href="#Month" aria-controls="Month" data-toggle="tab">Month</a>
			   </li>
				<li role="presentation">
					<a href="#Week" aria-controls="Week" data-toggle="tab">Week</a>
				</li>
               <li role="presentation">
				<a href="#Day" aria-controls="Day" data-toggle="tab">Day</a>
				</li>
				<li role="presentation">
					<a href="#listview" aria-controls="listview" data-toggle="tab">List View</a>
				</li>
				<li role="presentation">
					<a href="#Gantt" aria-controls="Gantt" data-toggle="tab">Gantt</a>
				</li>
				<li role="presentation">
					<a href="#baselineview" aria-controls="baselineview" data-toggle="tab">Baseline View</a>
				</li>
				<li role="presentation">
					<a href="#workdays" aria-controls="workdays" data-toggle="tab">Work Days</a>
				</li>
				<li role="presentation">
					<a href="#phaselist" aria-controls="phaselist" data-toggle="tab">Phase List</a>
				</li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="Month">
				<div id="month-calendar"></div>
			   </div>
               <div class="tab-pane" id="Week">
					<div id="week-calendar"></div>
			   </div>
               <div class="tab-pane" id="Day">
					<div id="day-calendar"></div>
			   </div>
               <div class="tab-pane" id="listview">
				<table class="table table-bordered datatable" id="calendar_listview" width="100%">
					<thead>
						<tr>					
							<th>ID</th>
							<th>Status</th>
							<th><img src="<?=$this->config->item('image_url').'icon_home_global1_2.png'?>"/></th>
							<th>Title</th>
							<th>Phase</th>							   
							<th>Files</th>							   
							<th>Duration</th>							   
							<th>Start</th>							   
							<th>Finish</th>							   
							<th>Assigned to</th>							   
							<th>Confirm?</th>							   
							<th>Pred</th>							   
						</tr>
					</thead>
					<tbody>
					</tbody>
				
				</table>
			   </div>
               <div class="tab-pane" id="Gantt">
				<div class="gantt"></div>
			   </div>
               <div class="tab-pane" id="baselineview">
				<table class="table table-bordered datatable" id="Calendar_Baselineview" width="100%">
					<thead>
						<tr>					
							<th>Status</th>
							<th>Title</th>
							<th>(Base)Dur</th>
							<th>(Base)Start Date</th>
							<th>(Base)End Date</th>							   
							<th>Direct Shifts</th>							   
							<th>Duration Chang</th>							   
							<th>Overall Slip</th>							   
							<th>Assigned to</th>						   
						</tr>
					</thead>
					<tbody>
					</tbody>
				
				</table>
			   </div>
               <div class="tab-pane" id="workdays">
				<table class="table table-bordered datatable" id="calendar_workdays" width="100%">
					<thead>
						<tr>					
							<th>Some Every Year</th>
							<th>All Jobs</th>
							<th>Title</th>
							<th>Notes</th>
							<th>Start Date</th>							   
							<th>Days</th>							   
							<th>Type</th>							   
							<th>Category</th>							   
						</tr>
					</thead>
					<tbody>
					</tbody>
				
				</table>
			   </div>
               <div class="tab-pane" id="phaselist">
				<table class="table table-bordered datatable" id="calendar_phaselist" width="100%">
					<thead>
						<tr>					
							<th>&nbsp;</th>
							 <th><input type="checkbox"/></th>
							<th>Phase Title</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Status</th>
							<th># of Items</th>							   
							<th>Completed</th>						   
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
<div id="month-event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		<h4>Month Event Management <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
			
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
<div id="week-event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		<h4>Week Event Management <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
			
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
<div id="day-event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
		<h4>Day Event Management <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
			
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