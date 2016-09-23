<script>   
   this.date_all     = '<?php echo $date_all; ?>';         
</script>
<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li class="active">Users</li>-->
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
      <div class="pull-right ">
        <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Delete</button>
        <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Save &amp; New</button>
        <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <h4>SUBCONTRACTOR DETAILS</h4>
    <div class="box-content panel-content">
      <div class="row">
        <div class="col-xs-4">
          <label>Company</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>Primary Contact</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>Division</label>
          <select class="selectpicker form-control" >
            <option>Hot Leads</option>
            <option>Import Leads</option>
            <option>Delete Checked Leads</option>
            <option>Print All Checked</option>
            <option>Import Activity</option>
            <option>Assign All Checked</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <label>Address</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>City</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <div class="col-xs-6">
            <label>State</label>
            <input type="text" class="form-control">
          </div>
          <div class="col-xs-6">
            <label>Zip</label>
            <input type="text" class="form-control">
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-xs-4">
          <label>Bussiness phone</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>Cell Phone</label>
          <input type='text' class="form-control" />
        </div>
        <div class="col-xs-4">
          <label>Fax</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <p>&nbsp;</p>
          <input type="checkbox" class="span2" >
          Automatically permit access to NEW jopsites I add <a class="glyphicon glyphicon-question-sign" href="#"></a> </div>
        <div class="col-xs-4">
          <p>&nbsp;</p>
          <input type="checkbox" class="span2" >
          Allow Sub to View Owner Information <a class="glyphicon glyphicon-question-sign" href="#"></a> </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="tab-con pull-left">
      <div role="tabpanel"> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"> <a href="#General-info" aria-controls="General-info" data-toggle="tab">General Info</a> </li>
          <li role="presentation"> <a href="#Jopsite_access" aria-controls="Jopsite_access" data-toggle="tab">Jobsite Access</a> </li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="General-info">
            <div class="row">
              <div class="col-xs-12">
                <h4>COMMUNICATION PREFFERENCES</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-4">
                      <label>Email</label>
                      <input type="text" class="form-control">
                      <label>- Separete multiple mail with a semicolon(;)</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12"> Builder TREND activation Status: <span class="text-success">Active</span> Since: Tue,oct 21' 14 Send Sub Invitiation? <a class="glyphicon glyphicon-question-sign" href="#"></a>
                      <button type="button" class="btn btn-default btn-primary m-left-1">Deactivate Sub</button>
                      <button type="button" class="btn btn-default btn-primary m-left-1">Disable sub</button>
                      <a class="glyphicon glyphicon-question-sign" href="#"></a> </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-xs-4">
                      <label>Cell Email (SMS Text) <a class="glyphicon glyphicon-question-sign" href="#"></a></label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="col-xs-4">
                      <p>&nbsp;</p>
                      <span class="glyphicon glyphicon-phone"></span> Text </div>
                  </div>
                  <hr />
                  <div class="row">
                    <div class="col-xs-4"> Allow Sub to View Owner Information </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h4>SCHEDULING INFO</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-4">
                      <label>Sub Activity</label>
                      <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Open Assigned Item Report</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">
                      <label>Alert On Schedule Conflicts:
                        <input name="" type="checkbox" value="" />
                        # of  crew(s) <a class="glyphicon glyphicon-question-sign" href="#"></a></label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h4>ADDITIONAL  INFO</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-4">
                      <p>General Liablity Certficate</p>
                      <div class="btn btn-success btn-file"> <i class="glyphicon glyphicon-paperclip"></i> Attachment
                        <input type="file" name="attachment">
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <p>Expires</p>
                      <div class='input-group date' id='datetimepicker6'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                    </div>
                    <div class="col-xs-4">
                      <p>Reminds</p>
                      <div class="col-xs-2">
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-xs-5">
                        <div class="col-xs-6">
                          <p> Day(s)</p>
                        </div>
                        <div class="col-xs-6">
                          <select class="selectpicker form-control">
                            <option>Hot Leads</option>
                            <option>Import Leads</option>
                            <option>Delete Checked Leads</option>
                            <option>Print All Checked</option>
                            <option>Import Activity</option>
                            <option>Assign All Checked</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-5">
                        <div class="col-xs-4">
                          <p>(max)</p>
                        </div>
                        <div class="col-xs-6">
                          <select class="selectpicker form-control">
                            <option>Hot Leads</option>
                            <option>Import Leads</option>
                            <option>Delete Checked Leads</option>
                            <option>Print All Checked</option>
                            <option>Import Activity</option>
                            <option>Assign All Checked</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">
                      <p>Workman's comp Certficate</p>
                      <div class="btn btn-success btn-file"> <i class="glyphicon glyphicon-paperclip"></i> Attachment
                        <input type="file" name="attachment">
                      </div>
                    </div>
                    <div class="col-xs-4">
                      <p>Expires</p>
                      <div class='input-group date' id='datetimepicker5'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                    </div>
                    <div class="col-xs-4">
                      <p>Reminds</p>
                      <div class="col-xs-2">
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-xs-5">
                        <div class="col-xs-6">
                          <p> Day(s)</p>
                        </div>
                        <div class="col-xs-6">
                          <select class="selectpicker form-control">
                            <option>Hot Leads</option>
                            <option>Import Leads</option>
                            <option>Delete Checked Leads</option>
                            <option>Print All Checked</option>
                            <option>Import Activity</option>
                            <option>Assign All Checked</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-5">
                        <div class="col-xs-4">
                          <p>(max)</p>
                        </div>
                        <div class="col-xs-6">
                          <select class="selectpicker form-control">
                            <option>Hot Leads</option>
                            <option>Import Leads</option>
                            <option>Delete Checked Leads</option>
                            <option>Print All Checked</option>
                            <option>Import Activity</option>
                            <option>Assign All Checked</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr />
                  <div class="row">
                    <div class="col-xs-12">
                      <label>Other Notes</label>
                      <textarea class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h4>TRADE MANAGEMENT</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-12"> Trade agreement contract <a href="#" class="glyphicon glyphicon-trash text-danger"></a>
                      <div class="btn btn-success btn-file"> <i class="glyphicon glyphicon-paperclip"></i> Attachment
                        <input type="file" name="attachment">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h4>CUSTOM FIELDS</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-12"> <span>No custom fields to create one, go to the custom fields tab in the setup area.</span> </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h4>PAYMENT INFO</h4>
                <div class="box-content panel-content">
                  <div class="row">
                    <div class="col-xs-4">
                      <label>Hold Payments
                        <input name="" type="checkbox" value="" />
                      </label>
                    </div>
                    <div class="col-xs-4">
                      <label>Notes </label>
                      <textarea class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="Jopsite_access">
            <div class="row">
              <div class="col-xs-12">
                <div class="panel-content">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                        <div class="panel-body col-xs-12">
                          <div class="row">
                            <div class="col-xs-3">
                              <label>
                                <input name="" type="checkbox" value="" />
                                Open Jobsite</label>
                            </div>
                            <div class="col-xs-3">
                              <label>
                                <input name="" type="checkbox" value="" />
                                Closed Jobsite</label>
                            </div>
                          </div>
                          <div class="row text-center">
                            <button type="button" class="btn  btn-secondary">Update Results</button>
                            <button type="button" class="btn btn-default btn-primary">Reset</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered">
                  <tr>
                    <td width="50" height="30"><input name="input" type="checkbox" value="" /></td>
                    <th width="30%">Job Name</th>
                    <th width="30%">Job Status</th>
                    <th width="30%">Job Opened</th>
                  </tr>
                  <tr>
                    <td height="30"><input name="input2" type="checkbox" value="" /></td>
                    <td>NJ New Home</td>
                    <td>Open</td>
                    <td>20-10-2014</td>
                  </tr>
                  <tr>
                    <td height="30"><input name="input3" type="checkbox" value="" /></td>
                    <td>NJ New Home</td>
                    <td>Open</td>
                    <td>20-10-2014</td>
                  </tr>
                  <tr>
                    <td height="30"><input name="input4" type="checkbox" value="" /></td>
                    <td>NJ New Home</td>
                    <td>Open</td>
                    <td>20-10-2014</td>
                  </tr>
                  <tr>
                    <td height="30"><input name="input5" type="checkbox" value="" /></td>
                    <td>NJ New Home</td>
                    <td>Open</td>
                    <td>20-10-2014</td>
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
