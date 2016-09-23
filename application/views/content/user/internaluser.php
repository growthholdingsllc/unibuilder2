<script type="text/javascript">
this.ckeditor='<?php echo $ckeditor; ?>';
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
        <button class="btn btn-default btn-primary pull-right m-left-1" type="button">Save as New</button>
        <button class="btn btn-default btn-primary pull-right m-left-1" type="button">Send</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <h4>LOGIN INFORMATION</h4>
    <div class="box-content panel-content">
      <div class="row">
        <div class="col-xs-4">
          <label>First Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>Last Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>Contact Info</label>
          <textarea class="form-control"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <label>Email</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>Cell Email (SMS Text) <a href="#" class="glyphicon glyphicon-question-sign"></a></label>
          <input type='text' class="form-control" />
        </div>
        <div class="col-xs-4">
          <p>&nbsp;</p>
          <span class="glyphicon glyphicon-phone"></span> Text </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <label>Usename</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <label>Password</label>
          <input type='text' class="form-control" />
        </div>
        <div class="col-xs-4">
          <p>&nbsp;</p>
          <input name="" type="checkbox" value="" />
          Login Enabled </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <label>Learning Community Handle
            <input name="" type="checkbox" value="" />
            Enabled <a href="#" class="glyphicon glyphicon-question-sign"></a></label>
          <input type="text" class="form-control">
        </div>
        <div class="col-xs-4">
          <p>&nbsp;</p>
          <input name="" type="checkbox" value="" />
          Automatically Permit access to New Jobsite I added <a href="#" class="glyphicon glyphicon-question-sign"></a></div>
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
          <li role="presentation" class="active"> <a href="#Detailed_Permissions" aria-controls="Detailed_Permissions" data-toggle="tab">Detailed Permissions</a> </li>
          <li role="presentation"> <a href="#Jobsite_Access" aria-controls="Jobsite_Access" data-toggle="tab">Jobsite Access</a> </li>
          <li role="presentation"> <a href="#User_Preferences" aria-controls="User_Preferences" data-toggle="tab">User Preferences</a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="Detailed_Permissions">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="table table-bordered">
              <tr>
                <td width="50%"> PERMISSIONS <a href="#" class="glyphicon glyphicon-question-sign"></a>
                  <button class="btn btn-default btn-primary" type="button" data-toggle="modal" data-target="#importpremissions">Import Permissions</button></td>
                <td width="50%"> NOTFICATIONS
                  <button class="btn btn-default btn-primary" type="button">Import Notfications</button></td>
              </tr>
              <tr>
                <td height="30" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                    <tr>
                      <td width="130" rowspan="2" align="center" valign="middle"><strong>Check All</strong></td>
                      <td width="40" height="25" align="center">View</td>
                      <td width="40" align="center">Add</td>
                      <td width="40" align="center">Edit </td>
                      <td width="40" align="center">Delete</td>
                      <td width="20">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Jobsits</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>View Oner Site <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Price Viewing <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Leads</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Assign Sales Persion <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Sales Persion Leads &amp; Activites <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Convert to Jobsite <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>To-Do</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Assign Users <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Global <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Logs</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Bids</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Calender</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Assign Users <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Set Baseline <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Documents</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Photos</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Messages</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Global <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Change Order</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Price Viewing <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Selections</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Price Viewing <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Purchase Order</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Accounting <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>No Price Limit <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                      <td><input type="checkbox" name="checkbox5" id="checkbox5" /></td>
                      <td>Price Viewing <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Estimates</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Warrenty</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40"><strong>Subs</strong></td>
                      <td height="25" align="center"><input type="checkbox" name="checkbox" id="checkbox" />
                        <label for="checkbox"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
                      <td align="center"><input type="checkbox" name="checkbox3" id="checkbox3" /></td>
                      <td align="center"><input type="checkbox" name="checkbox4" id="checkbox4" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                    <tr>
                      <td width="130" rowspan="2" align="right" valign="middle">&nbsp;</td>
                      <td width="40" height="25" align="center">Email</td>
                      <td width="40" align="center">Text</td>
                      <td width="80" align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td rowspan="2" align="right">Owner Activated</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="center"><input type="checkbox" name="checkbox7" id="checkbox8" /></td>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">All Users</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Other Employee Contact</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">New Lead from Contact Form</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Lead Notify Sales person Changed</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Activity Reminder</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center"><input type="checkbox" name="checkbox8" id="checkbox10" />
                        <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Email Quota Alerts</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">To-Do Completed/Re-opened By Others</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Others</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Schedule item Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Daily Log Notification</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Daily Log Discussion Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Bid Submitted By Sub</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Sub Confirmation Status Changed</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Bid Resubmitted by Sub</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">RFI Created</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">RFI Assigned</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">RFI Answered</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Bid Discussion Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">RFI Answer By Reminder</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Bid Accepted</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Schelude Remainder</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Sub Needs to Confirm Change</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Sub Confirmed a change</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Sub Declined a Change</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Schedule item Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">All Users</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">New Message</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center"><input type="checkbox" name="checkbox9" id="checkbox9" />
                        <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">All Users</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Change Order Approved</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Change Order Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Change Order Discussion Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center"><input type="checkbox" name="checkbox10" id="checkbox11" />
                        <a href="#" class="glyphicon glyphicon-question-sign"></a></td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Change Order Approved(Internally)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Owner Requested change Order</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Selection Approved</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Selection Deadline Remainder</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Selection Discussion Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Selection Choice Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Selection Owner Price Requested</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Selection Approved(Internally)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Selection Sub Price Submitted</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Approved</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Approved (Internally)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Declined</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Assigned Internally</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Inspection/Payment/Requested</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Work Completed (Ready for Accounting)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Payment Made</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Discussion Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Inspection Remainder</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">PO Work Complete (Internally)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Warranty Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Warranty Followup</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Warranty Updated Appt (By Owner)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Warranty Has Feedback</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Warranty Updated Appt (By Sub)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Warranty Added (Internally)</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Warranty Discussion Added</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">&nbsp;</td>
                      <td height="40" align="center">Email</td>
                      <td align="center">Text</td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Sub Insurance Remainder</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Sub Activated</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="40" align="right">Trade Agreement Action Taken</td>
                      <td height="40" align="center"><input type="checkbox" name="checkbox6" id="checkbox6" />
                        <label for="checkbox6"></label></td>
                      <td align="center"><input type="checkbox" name="checkbox6" id="checkbox7" /></td>
                      <td align="center">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="30">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="tab-pane" id="Jobsite_Access">
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
                              <label>Select Job Statuses</label>
                              <select class="selectpicker  form-control">
                                <option>-- None --</option>
                                <option>Open Jobsite </option>
                                <option>Closed Jobsite </option>
                                <option>Standalone Templates</option>
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <label>Job Group</label>
                              <select class="selectpicker  form-control">
                                <option>Any job group</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
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
                
                
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered">
  <tr>
    <td width="50" height="30"><input name="input" type="checkbox" value="" /></td>
    <th width="25%">Job Name</th>
    <th width="25%">Job Status</th>
    <th width="25%">Job Group</th>
    <th width="25%">Job Opened</th>
  </tr>
  <tr>
    <td height="30"><input name="input2" type="checkbox" value="" /></td>
    <td>NJ New Home</td>
    <td>Open</td>
    <td>-</td>
    <td>10-15-2014</td>
  </tr>
  <tr>
    <td height="30"><input name="input3" type="checkbox" value="" /></td>
    <td>NJ New Home</td>
    <td>Open</td>
    <td>-</td>
    <td>10-15-2014</td>
  </tr>
  <tr>
    <td height="30"><input name="input4" type="checkbox" value="" /></td>
    <td>NJ New Home</td>
    <td>Open</td>
    <td>-</td>
    <td>10-15-2014</td>
  </tr>
  <tr>
    <td height="30"><input name="input5" type="checkbox" value="" /></td>
    <td>NJ New Home</td>
    <td>Open</td>
    <td>-</td>
    <td>10-15-2014</td>
  </tr>
</table>
                
              </div>
              
              
              
              
            </div>
          </div>
          <div class="tab-pane" id="User_Preferences">
            <div class="row">
              <div class="col-xs-12">
                <div class="col-xs-6">
                  <h4>Messages Preferences</h4>
                  <textarea class="ckeditor" name="newmail"></textarea>
                </div>
                <div class="col-xs-6">
                  <h4>Signaure Image <small>(Displays below any text)</small></h4>
                  <p><img alt="140x140" class="img-rounded" data-src="holder.js/140x140" style="width: 140px; height: 140px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQzLjUiIHk9IjcwIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTQweDE0MDwvdGV4dD48L2c+PC9zdmc+" data-holder-rendered="true"></p>
                  <div class="btn btn-success btn-file"> <i class="glyphicon glyphicon-paperclip"></i> Attachment
                    <input type="file" name="attachment">
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

<!-- Import Permissions -->
<div class="modal fade" id="importpremissions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPORT PERMISSIONS FROM USER</h4>
      </div>
      <div class="modal-body">
        <label>Import Permissions</label>
        <p>
          <select class="selectpicker  form-control">
            <option>No Item Selected</option>
            <option>Option 1</option>
            <option>Option 2</option>
          </select>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Apply</button>
      </div>
    </div>
  </div>
</div>
