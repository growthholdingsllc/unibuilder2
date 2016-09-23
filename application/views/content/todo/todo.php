<script>   
   this.data_table   = '<?php echo $data_table; ?>';
   this.todo_list 	 = '<?php echo $todo_list; ?>'; 
   this.date_all     = '<?php echo $date_all; ?>';     
</script>

<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">To DO</li>-->
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right ">
        <button type="button" href="#" class="btn btn-default btn-primary pull-right m-left-1 " data-toggle="modal" data-target="#myModal">Import To Dos</button>
        <a href="<?php echo base_url(); ?>todo/newtodo" class="btn btn-default btn-secondary pull-right">New To Do</a> </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 pull-left">
    <div class="panel-content pull-left">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
            <div class="panel-body col-xs-12">
              <div class="row five-col">
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>Assigned Me</option>
                    <option>Assigned to / Created by me</option>
                    <option>Created By Me</option>
                    <option>All To-Do's</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All Assigned Users --</option>
                    <optgroup label="Internal Users">
					      <option>John</option>
					</optgroup>
					<optgroup label="Owners">
					      <option>Owner</option>
					</optgroup>
						<optgroup label="Subs">
					      <option>Metal Work</option>
					</optgroup>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>Completed</option>
                    <option>Not Complete</option>
                    <option>All Statuses</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All Priorities Selected --</option>
                    <option>None</option>
                    <option>High</option>
                    <option>Low</option>
                    <option>Highest</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- No To Do Tag Filter --</option>
                    <option>Bathroom</option>
                    <option>kitchen</option>
                  </select>
                </div>
              </div>
              <div class="row five-col">
                <div class="col-xs-3">
                  <label>Due</label>
                  <div class='input-group date' id='datetimepicker5'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                </div>
                <div class="col-xs-3">
                  <label>To</label>
                  <div class='input-group date' id='datetimepicker6'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                </div>
                <div class="col-xs-6">
                  <label>&nbsp;</label>
                  <div >
                    <button type="button" class="btn  btn-secondary">Update Results</button>
                    <button type="button" class="btn btn-default btn-primary">Reset</button>
                    <button type="button" class="btn btn-default btn-primary">Save Filter</button>
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
<div class="row">
  <div class="col-xs-12 pull-left">
    <table class="table table-bordered datatable" id="ToDo_List" width="100%">
      <thead>
        <tr>
          <th><input type="checkbox"/></th>
          <th>Title</th>
          <th>Priority</th>
          <th>Assigned to</th>
          <th>Due</th>
          <th>Created by</th>
          <th>Tag</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
     
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4 class="modal-title" id="myModalLabel">Import To Do From Template <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
      <div class="modal-body">
	  <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
        <label>Source Template</label>
        <p>
          <select class="selectpicker form-control">
            <option>Choose from template</option>
          </select>
        </p>
		 <div class="text-right">
        <button type="button" class="btn btn-primary">Import To Dos</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      </div>
      </div>
      </div>
      </div>
     
    </div>
  </div>
</div>
