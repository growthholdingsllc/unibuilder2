<script>  
   this.date_all = '<?php echo $date_all; ?>';   
</script>
<div class="row">
   <ol class="breadcrumb">
	  <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Job Details</li>-->
   </ol>
</div>
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
         <div class="pull-right ">		             
            <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Print</button>
            <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Copy to Standalone Template</button>
            <button type="button" class="btn btn-default btn-primary pull-right m-left-1">Delete</button>
            <button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save &amp; Select Jobsite</button>
            <a href="<?php echo base_url();?>jobs"><button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save</button></a>
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
               <li role="presentation" class="active">
                  <a href="#jobinfo" aria-controls="General-View" data-toggle="tab">Job Info</a>
               </li>
               <li role="presentation">
                  <a href="#ownerinfo" aria-controls="Activities" data-toggle="tab">Owner Info</a>
               </li>
               <li role="presentation">
                  <a href="#viewingaccess" aria-controls="Activities" data-toggle="tab">Viewing Access</a>
               </li>
               <li role="presentation">
                  <a href="#options" aria-controls="Activities" data-toggle="tab">Options</a>
               </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content ">
               <div class="tab-pane active" id="jobinfo">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Jobsite Information</h4>
                     </div>
                     <div class="panel-body">
                        <div class="row panel-content five-col">
                           <div class="col-xs-3">
                              <label>Job Name</label>
                              <input type="text" class="form-control"/>
                           </div>
                           <div class="col-xs-3">
                              <label>Status</label>
                              <select class="selectpicker form-control">
                                 <option>Open</option>
                                 <option>Closed</option>
                              </select>
                           </div>
                           <div class="col-xs-3">
                              <label>Job Group</label>
							  <div class="input-group right-group">
                              <select class="selectpicker form-control" multiple>
                                 <option>Apartment Type</option>
                              </select>
							  <span class="input-group-addon"><a href="javascript:void(0);" data-target="#TypeAddModal" data-toggle="modal"><img alt="plus" src="<?=$this->config->item('image_url').'icon_plus1_1.png'?>" border="0"/></a> <img alt="minus" src="<?=$this->config->item('image_url').'icon_minus1_1.png'?>" border="0"/></span>
							  </div>
                           </div>
                           <div class="col-xs-3">
                              <label>Project Manager(s)</label>
                              <select class="selectpicker form-control" multiple>
                                 <option>All Managers</option>
                              </select>
                           </div>
						   <div class="col-xs-3">
                              <label>Address</label>
                              <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Address"/>
                                 <span class="input-group-addon">
                                 <i class="glyphicon glyphicon-map-marker"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="row panel-content five-col">
                           
                           <div class="col-xs-3">
                              <label>Lot Info</label>
                              <input type="text" class="form-control"/>
                           </div>
                           <div class="col-xs-3">
                              <label>City</label>
                              <input type="text" class="form-control"/>
                           </div>
                           <div class="col-xs-3">
                              <label>Permit #</label>
                              <input type="text" class="form-control"/>
                           </div>
                           <div class="col-xs-3">
                              <label>Prov</label>
                              <input type="text" class="form-control"/>
                           </div>
						   <div class="col-xs-3">
                              <label>Postal</label>
                              <input type="text" class="form-control"/>
                           </div>
                        </div>
                        <div class="row panel-content five-col">
                           
                           <div class="col-xs-3">
                              <label>Contract Price</label>
                              <div class="input-group">
                                 <span class="input-group-addon">
                                 <i class="glyphicon dollar"></i>
                                 </span> 
                                 <input type="text" name="loginname" placeholder="0" class="form-control">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Job Notes</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row">
                              <div class="col-xs-12">
                                 <div class="tab-con pull-left">
                                    <div role="tabpanel">
                                       <!-- Nav tabs -->
                                       <ul class="nav nav-tabs" role="tablist">
                                          <li role="presentation" class="active">
                                             <a href="#InternalNotes" aria-controls="General-View" data-toggle="tab">Internal Notes</a>
                                          </li>
                                          <li role="presentation">
                                             <a href="#SubNotes" aria-controls="Activities" data-toggle="tab">Sub Notes</a>
                                          </li>
                                       </ul>
                                       <div class="tab-content ">
                                          <div class="tab-pane active" id="InternalNotes">
                                             <textarea class="form-control"></textarea>
                                          </div>
                                          <div class="tab-pane" id="SubNotes">
                                             <textarea class="form-control"></textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Job Schedule Information</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row five-col">
                              <div class="col-xs-3">
                                 <label>Projected Start</label>
                                 <div class='input-group date' id='datetimepicker5'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Actual Start</label>
                                 <div class='input-group date' id='datetimepicker6'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Projected Completion</label>
                                 <div class='input-group date' id='datetimepicker7'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Actual Completion</label>
                                 <div class='input-group date' id='datetimepicker8'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Limit Owner Calendar</label>
                                 <input type="text" class="form-control"/>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-3">
                                 <label>Job Color</label>
                                 <select class="selectpicker form-control">
                                    <option value="#442121" style="background-color: rgb(68, 33, 33);">Maroon</option>
                                    <option value="#572A2A" style="background-color: rgb(87, 42, 42);">Merlot</option>
                                    <option value="#8C4343" style="background-color: rgb(140, 67, 67);">Tuscan Red</option>
                                    <option value="#AD5252" style="background-color: rgb(173, 82, 82);">Rose</option>
                                    <option value="#C78888" style="background-color: rgb(199, 136, 136);">Victoria</option>
                                    <option value="#542C10" style="background-color: rgb(84, 44, 16);">Brown</option>
                                    <option value="#6C3815" style="background-color: rgb(108, 56, 21);">Coffee</option>
                                    <option value="#AD5A21" style="background-color: rgb(173, 90, 33);">Amber</option>
                                    <option value="#D67029" style="background-color: rgb(214, 112, 41);">Peach</option>
                                    <option value="#E39D6C" style="background-color: rgb(227, 157, 108);">Cream</option>
                                    <option value="#353F26" style="background-color: rgb(53, 63, 38);">Forest</option>
                                    <option value="#435130" style="background-color: rgb(67, 81, 48);">Olive</option>
                                    <option value="#6C824D" style="background-color: rgb(108, 130, 77);">Green</option>
                                    <option value="#84A05E" style="background-color: rgb(132, 160, 94);">Mint</option>
                                    <option value="#ABBE91" style="background-color: rgb(171, 190, 145);">Cucumber</option>
                                    <option value="#2D263E" style="background-color: rgb(45, 38, 62);">Plum</option>
                                    <option value="#3A3150" style="background-color: rgb(58, 49, 80);">Purple</option>
                                    <option value="#5C4E81" style="background-color: rgb(92, 78, 129);">Lavendar</option>
                                    <option value="#72609F" style="background-color: rgb(114, 96, 159);">Iris</option>
                                    <option value="#9E92BD" style="background-color: rgb(158, 146, 189);">Violet</option>
                                    <option value="#213444" style="background-color: rgb(33, 52, 68);">Navy</option>
                                    <option value="#2A4257" style="background-color: rgb(42, 66, 87);">Levi</option>
                                    <option value="#436A8C" style="background-color: rgb(67, 106, 140);">Ocean</option>
                                    <option value="#5283AD" style="background-color: rgb(82, 131, 173);">Ice</option>
                                    <option value="#88AAC7" style="background-color: rgb(136, 170, 199);">Sky</option>
                                    <option value="#323232" style="background-color: rgb(50, 50, 50);">Graphite</option>
                                    <option value="#404040" style="background-color: rgb(64, 64, 64);">Gunmetal</option>
                                    <option value="#676767" style="background-color: rgb(103, 103, 103);">Silver</option>
                                    <option value="#7F7F7F" style="background-color: rgb(127, 127, 127);">Gray</option>
                                    <option value="#A7A7A7" style="background-color: rgb(167, 167, 167);">Full Moon</option>
                                    <option value="#1D1D1D" style="background-color: rgb(29, 29, 29);">Black</option>
                                    <option value="#DD2222" style="background-color: rgb(221, 34, 34);">Alarm Red</option>
                                    <option value="#ED2591" style="background-color: rgb(237, 37, 145);">Alarm Pink</option>
                                    <option value="#2222DD" style="background-color: rgb(34, 34, 221);">Alarm Blue</option>
                                    <option value="#008000" style="background-color: rgb(0, 128, 0);">Alarm Green</option>
                                    <option value="#6F116F" style="background-color: rgb(111, 17, 111);">Alarm Purple</option>
                                    <option value="#FF9600" style="background-color: rgb(255, 150, 0);">Alarm Orange</option>
                                    <option value="#2CD1D2" style="background-color: rgb(44, 209, 210);">Alarm Aqua</option>
                                    <option value="#9FC62A" style="background-color: rgb(159, 198, 42);">Alarm Lime</option>
                                    <option value="#DDC817" style="background-color: rgb(221, 200, 23);">Alarm Gold</option>
                                 </select>
                              </div>
                              <div class="col-xs-7 checklist">
                                 <p>Work Days</p>
                                 <span>Sun <input type="checkbox"/></span>
                                 <span>Mon <input type="checkbox"/></span>
                                 <span>Tue <input type="checkbox"/></span>
                                 <span>Wed <input type="checkbox"/></span>
                                 <span>Thu <input type="checkbox"/></span>
                                 <span>Fri <input type="checkbox"/></span>
                                 <span>Sat <input type="checkbox"/></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Custom Fields</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <p>No Custom Fields. To create one, go to the Custom Fields tab in the setup area.</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="ownerinfo">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Owner Information</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <label>Last Name</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>First Name</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Home Phone</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Cell Phone</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Cell Email</label>
                                 <input type="text" class="form-control"/>
                              </div>
                           </div>
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <label>Current Address</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <p>&nbsp;</p>
                                 <input type="checkbox"/> Same as Job Address
                              </div>
                              <div class="col-xs-3">
                                 <label>City</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Prov</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Postal</label>
                                 <input type="text" class="form-control"/>
                              </div>
                           </div>
                           <div class="row panel-content five-col">
                              <div class="col-xs-3 text-center">
                                 <img alt="photo" src="<?=$this->config->item('image_url').'uploadphoto.png'?>" border="0"/>
                              </div>
                              <div class="col-xs-3">
                                 <p>Profile Picture</p>
                                 <div class="btn btn-default btn-file">
                                    Choose Photo <input type="file">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Owner Activation <button type="button" class="btn btn-default btn-primary">View Owner Site</button></h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <label>Access Method</label>
                                 <div class="input-group right-group">
                                    <select class="selectpicker form-control">
                                       <option>Email Invite</option>
                                       <option>Configure Manually</option>
                                    </select>
                                    <span class="input-group-addon">
                                    <a href="javascript:void(0);" data-toggle="tooltip" title="Select the method in which you want the owner to access the site."><i class="glyphicon glyphicon-question-sign"></i></a>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <p>&nbsp;</p>
                                 <input type="checkbox" checked /> Login Enabled
                              </div>
                              <div class="col-xs-3">
                                 <label>User Name</label>
                                 <input type="text" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Password</label>
                                 <input type="password" class="form-control"/>
                              </div>
                              <div class="col-xs-3">
                                 <label>Email</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" placeholder="sathish@gmail.com" />
                                    <span class="input-group-addon">
                                    <a href="javascript:void(0);" data-toggle="tooltip" title="Enter more than one email address: Multiple client email addresses can be added to the system. Simply separate the email addresses with a semicolon. (ie: bob@aol.com;bill@aol.com)"><i class="glyphicon glyphicon-question-sign"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Custom Fields</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <p>No Custom Fields. To create one, go to the Custom Fields tab in the setup area.</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="viewingaccess">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Viewing Access</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <table width="50%">
                              <tr>
                                 <td>SUBS PERMITTED <a href="javascript:void(0);" data-toggle="tooltip" title="The Subs Permitted Select List in the Job Sitetab allows you to select the subcontractors that are working on a particular JobSite. Once the subs permitted are selected for a particular Job Site, you will beable to notify and allow access to these subs when adding tasks, photos, documents,emails, etc. to the particular Job Site. To select multiple subs, you canhold the Ctrl-key and select each sub, or click the icon and and select the subs. Be sure to click the SAVE button whenfinished.Click Here forthe online Job Site tutorial"><i class="glyphicon glyphicon-question-sign"></i></a></td>
                                 <td>USERS PERMITTED <a href="javascript:void(0);" data-toggle="tooltip" title="TheUsers Permitted Select List in the Job Site tab allows you to select theemployees and other users that have access to a particular Job Site. Once the userspermitted are selected for a particular Job Site, you will be able to notify andallow access to these users when adding tasks, photos, documents, emails, etc. tothe particular Job Site. To select multiple users, you can hold the Ctrl-keyand select each user, or click the icon and and select the users. Be sure to click the SAVE button when finished. Click Here for the online Job Sitetutorial"><i class="glyphicon glyphicon-question-sign"></i></a></td>
                              </tr>
                              <tr>
                                 <td><a href="javascript:void(0);" class="selector-access"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Sub Selector</a></td>
                                 <td><a href="javascript:void(0);" class="selector-access"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> User Selector</a></td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class='drag-ele'>
                                       <p>Metal Works</p>
                                       <p>Shaun Metal supplies</p>
                                    </div>
                                 </td>
                                 <td>
                                    <div class='drag-ele'>
                                       <p>Sathish</p>
                                       <p>Raj</p>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="selector-access-con">
                                 <td colspan="2" >
                                    <table width="100%">
                                       <tr>
                                          <td width="45%">
                                             <ul class='list1 drag-ele'>
                                                <li>Metal Works</li>
                                                <li>Shaun Metal supplies</li>
                                             </ul>
                                          </td>
                                          <td width="15%" align="center">
                                             <span id='move_left' class="btn btn-primary glyphicon glyphicon-backward" aria-hidden="true"></span>
                                             <span id='move_right' class="btn btn-primary glyphicon glyphicon-forward" aria-hidden="true"></span>							
                                          <td width="45%">
                                             <ul class='list2 drag-ele'>
                                                <li>Sathish</li>
                                                <li>Raj</li>
                                             </ul>
                                          </td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="options">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Other Jobsite Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content five-col">
                              <div class="col-xs-6">
                                 <p>&nbsp;</p>
                                 <span>Show Project Cost Summary & Running Total to Owner?</span> <input type="checkbox"/> <a href="javascript:void(0);" data-toggle="tooltip" title="The Show Project Cost Summary & Running Total to Owner? checkbox allows you to show/hide all project pricing information across all tabs.Click Here for the online jobsite tutorial"><i class="glyphicon glyphicon-question-sign"></i></a>
                              </div>
                              <div class="col-xs-3">
                                 <label>Jobsite Prefix</label>
                                 <div class="input-group">
                                    <input type="text" class="form-control" placeholder=""/><span class="input-group-addon">
                                    <a href="javascript:void(0);" data-toggle="tooltip" title="The Show Project Cost Summary & Running Total to Owner? checkbox allows you to show/hide all project pricing information across all tabs.Click Here for the online jobsite tutorial"><i class="glyphicon glyphicon-question-sign"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">PO Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <label>Individual PO limit</label>
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="glyphicon dollar"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Unlimited"/>									
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Overall jobsite PO limit</label>
                                 <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="glyphicon dollar"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Unlimited"/>									
                                 </div>
                              </div>
                              <div class="col-xs-6">
                                 <p>&nbsp;</p>
                                 <span>Show Budget and Purchase Orders to Owner</span> <input type="checkbox"/>  <a href="javascript:void(0);" data-toggle="tooltip" title="When checked, the Budget and Purchase order information will be available for the owner to view. Administrators can disable this feature for all jobs in the Setup page."><i class="glyphicon glyphicon-question-sign"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">CO Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content">
                              <div class="col-xs-6">
                                 <span>Allow Owner to Add Claims?</span> <input type="checkbox"/>  
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Warranty Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content">
                              <div class="col-xs-6">
                                 <span>Allow Owner to Add Claims?</span> <input type="checkbox"/>  
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Jobsite Copy Information</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content five-col">
                              <div class="col-xs-3">
                                 <label>Jobsite Copy Status</label>
                                 <div class="input-group right-group">
                                    <select class="selectpicker form-control">
                                       <option>Not Available</option>
                                       <option>Working Template</option>
                                    </select>
                                    <span class="input-group-addon"><a href="javascript:void(0);" data-toggle="tooltip" title="When checked, the Budget and Purchase order information will be available for the owner to view. Administrators can disable this feature for all jobs in the Setup page."><i class="glyphicon glyphicon-question-sign"></i></a></span>
                                 </div>
                              </div>
                              <div class="col-xs-3">
                                 <label>Template Name</label>
                                 <input type="text" placeholder="Pitton Working" />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Selection Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content">
                              <div class="col-xs-6">
                                 <span>Include Allowances</span> <input type="checkbox"/>  
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title">Owner Payment Options</h4>
                     </div>
                     <div class="panel-body">
                        <div class="panel-content">
                           <div class="row panel-content">
                              <div class="col-xs-6">
                                 <span>Allow Home Owner to See Payments Tab</span> <input type="checkbox"/>  
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
</div>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Job Group <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td>
                                    <input type="text" class="form-control" />
                                 </td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2"><button type="button" class="btn btn-default btn-secondary pull-right">Save</button></td>
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