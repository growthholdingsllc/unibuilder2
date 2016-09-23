<script>
   this.boot_slider = '<?php echo $boot_slider; ?>';   
   this.drop_upload = '<?php echo $drop_upload; ?>';   
   this.date_all = '<?php echo $date_all; ?>';   
</script>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?> 
      <!--<li class="active">Lead Details</li>-->
   </ol>
</div>
<form id="add_new_lead" class="form-horizontal" method="post" name="add_new_lead">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">         
         <div class="pull-right ">		 
            <!--<button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save &amp; New</button>-->
            <button class="btn btn-default btn-secondary pull-right m-left-1" type="submit" id="add_check_list_new_new" name="add_check_list_new_new" >Save &amp; New</button>
            <a href="<?php echo base_url();?>home"><button type="button" class="btn btn-default btn-secondary pull-right m-left-1">Save</button></a>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-xs-12">
      <h4>PRIMARY INFO</h4>
      <div class="box-content panel-content">
         <div class="row five-col">
            <div class="col-xs-3">
               <label>Name</label>
               <input type="text" name="name" class="form-control">
            </div>
            <div class="col-xs-3">
               <label>Phone</label>
               <input type="text" name="phone" class="form-control">
            </div>
            <div class="col-xs-3">
               <label>Cell</label>
               <input type="text" name="cell" class="form-control">
            </div>
			<div class="col-xs-3">
               <label>&nbsp;</label><br/>
               <input type="text" name="confidence_level" class="span2" value="5" id="sl1">
            </div>
            <div class="col-xs-3">
               <label>Projected Sales Date</label>
			   <div class='input-group date' id='datetimepicker5'>
					<input type='text' name="projected_sales_date" class="form-control" />
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
            </div>
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
					<a href="#General-View" aria-controls="General-View" data-toggle="tab">General</a>
			   </li>
				<li role="presentation">
					<a href="#Activities" aria-controls="Activities" data-toggle="tab">Activities</a>
				</li>
               <li role="presentation">
				<a href="#Files" aria-controls="Files" data-toggle="tab">Files</a>
				</li>
				<li role="presentation">
				<a href="#Notes" aria-controls="Notes" data-toggle="tab">Notes</a>
				</li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="General-View">		
					<table class="table lead-table">
						<tr>
							<td>Email Address</td>
							<td>Address</td>
							<td>City</td>
							<td>State</td>
							<td>Zip</td>
						</tr>
						<tr>
							<td><input type="text" name="email" class="form-control" /></td>
							<td><input type="text" name="address" class="form-control" /></td>
							<td><input type="text" name="city" class="form-control" /></td>
							<td><input type="text" name="province" class="form-control" /></td>
							<td><input type="text" name="postal_code" class="form-control" /></td>
						</tr>
					</table>
					<table class="table lead-table">
						<tr>
							<td width="200">Sales Person</td>
							<td width="200">Project Type</td>
							<td width="200">&nbsp;</td>
						</tr>
						<tr>
							<td>
								<select name="sales_person" class="selectpicker form-control">
									<option>-- None --</option>
									<option>John</option>
								</select>
							</td>
							<td>
								<select name="project_type" class="selectpicker form-control">
									
									<option>-- Plase Select -- </option>
									<option>None</option>
									<option>Remodel</option>
									<option>Scratch</option>
								</select>
							</td>
							<td><img alt="home" src="<?=$this->config->item('image_url').'add.png'?>" border="0"/></td>
						</tr>
						<tr>
							<td colspan="2">Tags</td>							
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<select name="tags" class="selectpicker form-control">
									<option>-- No Lead Tags --</option>
									<option>East Coast</option>
								</select>
							</td>							
							<td><img alt="home" src="<?=$this->config->item('image_url').'add.png'?>" border="0"/></td>
						</tr>
						<tr>
							<td colspan="2">Source</td>							
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<select name="source" class="selectpicker form-control">
									<option>-- No Lead Sources --</option>
									<option>Contact Form</option>
									<option>Google</option>
									<option>Referral</option>
								</select>
							</td>							
							<td><img alt="home" src="<?=$this->config->item('image_url').'add.png'?>" border="0"/></td>
						</tr>
						<tr>
							<td>Status</td>							
							<td colspan="2">Estimated Revenue</td>														
						</tr>
						<tr>
							<td>
								<select name="status" class="selectpicker form-control">
									<option>Open</option>
									<option>Lost</option>
									<option>Sold</option>
									<option>No Opportunity</option>
									<option>Activity Template</option>
								</select>
							</td>							
							<td colspan="2">$ <input type="text" name="estimated_revenue_min" class="general form-control" /> To $ <input type="text" name="estimated_reveniu_max" class="general form-control" /></td>														
						</tr>
					</table>
					<h4>Custom Fields</h4>
					<table class="table lead-table">
						<tr>
							<td>Test Items</td>
							<td>Sample</td>							
						</tr>
						<tr>
							<td>
								<select name="" class="selectpicker form-control">
									<option>1</option>
								</select>	
							</td>
							<td><input type="text" name="" class="form-control" /></td>						
						</tr>
					</table>
				</div>
</form>
               <div class="tab-pane" id="Activities"> 
					<div class="row">		 
						<div class="col-xs-12">		 
							<div class="pull-left">		 
								<button type="button" class="btn btn-default btn-primary pull-right m-left-1" data-target="#ImportActivityModal" data-toggle="modal">Import Activity</button>
								<a href="<?php echo base_url();?>home/general-activity">
								<button type="button" class="btn btn-default btn-primary pull-right m-left-1">Schedule New Activity</button>
								</a>								
								<a href="<?php echo base_url();?>home/general-activity">
									<button type="button" class="btn btn-default btn-primary pull-right m-left-1">Log Completed Activity</button>
								</a>
							</div>						
						</div>
						<div class="col-xs-12">	
							<hr/>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="col-xs-3">
								<input type="checkbox"/> Email<br/><br/>
								<p>Shooting Star Technology</p>
								<p>Subject test email lead</p>
							</div>
							<div class="col-xs-3">
								&nbsp;
							</div>
							<div class="col-xs-3">
								<p>Bhaskar</p>
							</div>
							<div class="col-xs-3">
								<p>10-30-2014</p>
								<p>Marked Complete 10-30-2014</p>
							</div>
							<div class="dotted">&nbsp;</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="col-xs-3">
								<input type="checkbox"/> Email<br/><br/>
								<p>Shooting Star Technology</p>
								<p>Subject test email lead</p>
							</div>
							<div class="col-xs-3">
								&nbsp;
							</div>
							<div class="col-xs-3">
								<p>Bhaskar</p>
							</div>
							<div class="col-xs-3">
								<p>10-30-2014</p>
								<p>Marked Complete 10-30-2014</p>
							</div>
							<div class="dotted">&nbsp;</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="col-xs-3">
								<input type="checkbox"/> Email<br/><br/>
								<p>Shooting Star Technology</p>
								<p>Subject test email lead</p>
							</div>
							<div class="col-xs-3">
								&nbsp;
							</div>
							<div class="col-xs-3">
								<p>Bhaskar</p>
							</div>
							<div class="col-xs-3">
								<p>10-30-2014</p>
								<p>Marked Complete 10-30-2014</p>
							</div>							
						</div>
					</div>
               </div>
               <div class="tab-pane" id="Files">	
					<div class="row">
						<div class="col-xs-12">
							<form action="<?=base_url()?>home/testupload" class="dropzone" id="my-awesome-dropzone"></form>
						</div>
					</div>
			   </div>
			   <div class="tab-pane" id="Notes">
					<div class="row">
						<div class="col-xs-12">
							<textarea class="form-control"></textarea>
						</div>
					</div>
			   </div>
            </div>
         </div>
      </div>
	</div>
</div>
<!-- Type Add Modal -->
<div class="modal fade" id="ImportActivityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
	   <h4>Import Activity From Template <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                 
                  <div class="modal-con">
                      <div class="row">                       
						 <div class="col-xs-12">                       
							<table width="100%" class="table border-none">
							<tr>
								<td height="30">Source Template</td>
								<td>1st Activity Start Date</td>
							</tr>							
							<tr>
								<td height="30">
								<select class="selectpicker form-control">
									<option>Choose a Template</option>
								</select>
								</td>
								<td height="30">
								<div class='input-group date' id='datetimepicker6'>
									<input type='text' class="form-control" />
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
								</td>
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