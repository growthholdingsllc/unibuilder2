<script>   
   this.data_table   = '<?php echo $data_table; ?>';
   this.date_all     = '<?php echo $date_all; ?>'; 
   this.budget_list   = '<?php echo $budget_list; ?>';     
   this.po_list       = '<?php echo $po_list; ?>';     
   this.payment_list  = '<?php echo $payment_list; ?>';
</script>

<div class="row">
  <ol class="breadcrumb">
  <?php $this->load->view('template/common/breadcrumbs'); ?> 
    <li>Budget</li>
    <li class="active">Purchase Orders (NJ Home)</li>
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="col-xs-3 pull-right">
        <select class="selectpicker form-control">
          <option>Import</option>
          <option>Estimate From Excel</option>
          <option>Estimate From Template</option>
          <option>POs From Template</option>
        </select>
      </div>
      <div class="col-xs-3 pull-right">
        <select class="selectpicker form-control">
          <option>PO Actions</option>
          <option>Delete Checked POs</option>
          <option>Released All Checked</option>
          <option>Unreleased All Checked</option>
          <option>Print All Checked</option>
          <option>Copy POs</option>
        </select>
      </div>
      <div class="col-xs-3 pull-right">
        <div class="btn-group pull-right ">
          <button data-toggle="dropdown" class="btn btn-success btn-sm btn-flat dropdown-toggle" type="button"> New <span class="caret"></span> </button>
          <ul role="menu" class="dropdown-menu">
            <li><a href="#"  >Estimated Item</a></li>
            <li class="divider"></li>
            <li><a href="#" >PO</a></li>
            <li class="divider"></li>
            <li><a href="#">Variance PO</a></li>
          </ul>
        </div>
      </div>
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
              <div class="row five-col">
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All Work Complete Statuses --</option>
                    <option>Not Complete</option>
                    <option>Work Complete</option>
                    <option>Open</option>
                    <option>Payment Requested</option>
                    <option>Voided</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All Payment Statuses --</option>
                    <option>Not Paid</option>
                    <option>Partially paid</option>
                    <option>Fully Paid</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All Approval Statuses --</option>
                    <option>Assigned To Internal Use</option>
                    <option>Released To Sub-Pending</option>
                    <option>Sub Approved</option>
                    <option>Sub Declined</option>
                    <option>Unreleased</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>All Subs</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- No Performing Users --</option>
                    <optgroup label="Internal Users">
                    <option>John</option>
                    </optgroup>
                    <optgroup label="Subs">
                    <option>Metal Works</option>
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="row five-col">
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <input type='text' class="form-control"  placeholder="Text"/>
                </div>
                <div class="col-xs-3">
                  <label>Estimation Completed</label>
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
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All POs --</option>
                    <option>Variance Only</option>
                    <option>Non Variance</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- Materials or Labour --</option>
                    <option>Materials</option>
                    <option>Labour</option>
                  </select>
                </div>
              </div>
              <div class="row five-col">
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All Cost Codes --</option>
                    <option>1010 - Building Permits</option>
                    <option>1020 - HBA Assessment</option>
                    <option>1100 - Blueprints</option>
                    <option>1120 - Surveys</option>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>&nbsp;</label>
                  <select class="selectpicker form-control">
                    <option>-- All variance Codes --</option>
                    <option>01 - Dimensioning Error</option>
                    <option>02 - Unclear Detail</option>
                    <option>03 - Code Violation</option>
                  </select>
                </div>
                <div class="col-xs-6">
                  <label>&nbsp;</label>
                  <div>
                    <button type="button" class="btn  btn-secondary">Update Results</button>
                    <button type="button" class="btn btn-default btn-primary">Reset</button>
                    <button type="button" class="btn btn-default btn-primary">Save Filter</button>
					<button type="button" class="btn btn-default btn-primary">Apply Saved Filter</button>
                  </div>
                </div>
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
          <li role="presentation" class="active"> <a href="#budget-view" aria-controls="budget-view" data-toggle="tab">Budget</a> </li>
          <li role="presentation"> <a href="#POs-View" aria-controls="POs-View" data-toggle="tab">POs</a> </li>
          <li role="presentation"> <a href="#Payments-view" aria-controls="Payments-view" data-toggle="tab">Payments</a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="budget-view">
            <table class="table table-bordered datatable" id="budget_view">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Code</th>
                  <th>Estimate</th>
                  <th>POs</th>
                  <th>Builder Variance</th>
                  <th>Total PO Cost</th>
                  <th>+/- Estimate</th>
                  <th>Customer Variance</th>
                  <th>Total</th>
                  <th>Paid</th>
                  <th>Outstanding</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="POs-View">
            <table class="table table-bordered datatable" id="POs_View">
              <thead>
                <tr>
                  <th><input type="checkbox" /></th>
                  <th>PO#</th>
                  <th>Title</th>
                  <th>Files</th>
                  <th>Variance</th>
                  <th>Job</th>
                  <th>Cost Code</th>
                  <th>Performed by</th>
                  <th>Est. Complete</th>
                  <th>Approved</th>
                  <th>Work Complete</th>
                  <th>Paid</th>
                  <th>Cost</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="Payments-view">
            <table class="table table-bordered datatable" id="Payments_view">
              <thead>
                <tr>
                  <th><input type="checkbox"/></th>
                  <th>Payment Title</th>
                  <th>PO Title</th>
                  <th>Job</th>
                  <th>Pay To</th>
                  <th>Amount</th>
                  <th>Invoice Date</th>
                  <th>Reminder Date</th>
                  <th>Status</th>
                  <th>Linked Item Status</th>
                  <th>Date Paid</th>
                  <th>Paid By</th>
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

<!-- Modal -->
<div class="modal fade" id="estimated" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select A Job</h4>
      </div>
      <div class="col-xs-12 ">
        <div class="btn-group">
          <button data-toggle="dropdown" class="btn btn-success btn-sm btn-flat dropdown-toggle" type="button"> Select a jobsite <span class="caret"></span> </button>
          <ul role="menu" class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>bids/newbid">NJ New home</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>bids/newbid">Building Repair</a></li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="po" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select A Job</h4>
      </div>
      <div class="col-xs-12 ">
        <div class="modal-body col-xs-3">&nbsp;</div>
        <div class="modal-body col-xs-6 ">
          <label>Please Select A Jobsite</label>
          <select class="selectpicker form-control">
            <option>Select A Job</option>
          </select>
        </div>
        <div class="modal-body col-xs-3">&nbsp;</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--button type="button" class="btn btn-primary">Save</button--> 
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="variance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select A Job</h4>
      </div>
      <div class="col-xs-12 ">
        <div class="modal-body col-xs-3">&nbsp;</div>
        <div class="modal-body col-xs-6 ">
          <label>Please Select A Jobsite</label>
          <select class="selectpicker form-control">
            <option>Select A Job</option>
          </select>
        </div>
        <div class="modal-body col-xs-3">&nbsp;</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--button type="button" class="btn btn-primary">Save</button--> 
      </div>
    </div>
  </div>
</div>
