<?php
   $count_cn = 1;
   if(!empty($builder_details['ub_setup_budget_documents_id']))
   {
     $document_id = explode(",",$builder_details['ub_setup_budget_documents_id']);
     $count_cn = count($document_id);
   }
   if(!empty($builder_details['name']))
   {
     $document_name = explode(",",$builder_details['name']);
   }
   if(!empty($builder_details['comments']))
   {
     $document_comments = explode(",",$builder_details['comments']);
   }
   ?>
<div class="row">
   <ol class="breadcrumb">
      <?php //$this->load->view('common/breadcrumbs'); ?>
      <!--<li class="active">Setup</li>-->
   </ol>
</div>
<form id="add_setup" class="form-horizontal" method="POST" enctype="multipart/form-data" name="add_setup">
   <div class="row">
      <div class="col-xs-12">
         <div class="top-search pull-right">
            <div class="pull-right">
               <!--<a href="#">
                  <button type="button" class="btn btn-gray  pull-right m-left-1"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> Cancel</button>
                  </a> 
                  <a href="#">
                  <button type="submit" class="btn btn-blue  pull-right m-left-1" id="" name="" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="go_back"/> Save &amp; Back </button>
                  </a>
                  <a href="#">
                  <button type="submit" class="btn btn-blue pull-right m-left-1" name="" id=""> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savestay"/> Save &amp; Stay</button>
                  </a> 
                  <a href="#">
                  <button type="submit" class="btn btn-blue  pull-right m-left-1" id="" name="" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="savenew"/> Save &amp; New</button>
                  </a>-->   
               <button type="submit" class="btn btn-blue  pull-right m-left-1" id="save_details" name="save_details" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_new"/> Save</button>
			   <?php 
			   if(isset($payment_details['subscription_id']) && !empty($payment_details['subscription_id']))
			   {
			   ?>
				<button type="button" class="btn btn-blue  pull-right m-left-1" id="cancel_subscription" onclick ="cancel_subscriptions(<?php echo $payment_details['subscription_id']; ?>)"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel subscription</button>
				<?php
				}
				?>                 
            </div>
         </div>
      </div>
   </div>
   <div class="row m-top">
      <div class="col-xs-12 error-message uni_message">
         <div class="alerts alert-danger"></div>
      </div>
   </div>
   <div class="row m-top">
      <div class="col-xs-12">
         <div class="tab-con pull-left">
            <div role="tabpanel">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"> <a href="#General" aria-controls="General" data-toggle="tab">General</a> </li>
                  <li role="presentation"> <a href="#my_fields" aria-controls="my_fields" data-toggle="tab">My Fields</a> </li>
                  <li role="presentation"> <a href="#Payments" aria-controls="payments" data-toggle="tab">Payments</a> </li>
                  <li role="presentation"> <a href="#changeplan" aria-controls="changeplan" data-toggle="tab">Change Plan</a> </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <!--<form id="save_builder_details" class="form-horizontal" method="post" name="save_builder_details"> -->
                  <div class="tab-pane active" id="General">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>COMPANY INFORMATION</h4>
                           <div class="box-content panel-content">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <div class="col-xs-2">
                                       <?php $this->load->view('common/thumbnail_upload.php');?>
                                    </div>
                                    <?php if(!empty($builder_details['ub_user_id'])) { ?>
                                    <input type="hidden" name="ub_user_id" id="ub_user_id" value="<?php if(isset($builder_details['ub_user_id'])) echo $builder_details['ub_user_id'];?>">
                                    <?php }?>
                                    <!--code added by satheesh kumar-->
                                    <?php if(!empty($builder_details['plan_id'])) { ?>
                                    <input type="hidden" name="ub_plan_id" id="ub_plan_id" value="<?php if(isset($builder_details['plan_id'])) echo $builder_details['plan_id'];?>">
                                    <?php }?>
                                    <?php if(!empty($builder_details['ub_user_plan_id'])) { ?>
                                    <input type="hidden" name="ub_user_plan_id" id="ub_plan_id" value="<?php if(isset($builder_details['ub_user_plan_id'])) echo $builder_details['ub_user_plan_id'];?>">
                                    <?php }?>
                                    <div class="col-xs-10">
                                       <div class="row">
                                          <div class="col-xs-3">
                                             <label>Company Name</label>
                                             <div class="col-xs-12">
                                                <div class="form-group">
                                                   <input type="text" name="builder_name" id="builder_name" class="form-control" value="<?php echo isset($builder_details['builder_name'])?$builder_details['builder_name']:'' ?>" />
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>First Name</label>
                                             <div class="col-xs-12">
                                                <div class="form-group">
                                                   <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo isset($builder_details['first_name'])?$builder_details['first_name']:'' ?>" />
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Last Name</label>
                                             <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo isset($builder_details['last_name'])?$builder_details['last_name']:'' ?>" />
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Email Address</label>
                                             <div class="col-xs-12">
                                                <div class="form-group">
                                                   <input type="text" name="primary_email" id="primary_email" class="form-control" value="<?php echo isset($builder_details['primary_email'])?$builder_details['primary_email']:'' ?>" />
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-xs-3">
                                             <label>Phone</label>
                                             <input type="text" name="desk_phone" id="desk_phone" class="form-control" value="<?php echo isset($builder_details['desk_phone'])?$builder_details['desk_phone']:'' ?>" />
                                          </div>
										  <input type="hidden" id="subscription_id" name="subscription_id" value="<?php if(isset($payment_details['subscription_id'])) echo $payment_details['subscription_id']; ?>" />
                                          <div class="col-xs-3">
                                             <label>Address</label>
                                             <input type="text" name="address" id="address" class="form-control" value="<?php echo isset($builder_details['address'])?$builder_details['address']:'' ?>" />
                                          </div>
                                          <div class="col-xs-3">
                                             <label>City</label>
                                             <input type="text" name="city" id="city" class="form-control" value="<?php echo isset($builder_details['city'])?$builder_details['city']:'' ?>" />
                                          </div>
                                          <div class="col-xs-3">
                                             <label>State</label>
                                             <input type="text" name="province" id="province" class="form-control" value="<?php echo isset($builder_details['province'])?$builder_details['province']:'' ?>" />
                                          </div>
                                       </div>
                                       <div class="row m-top">
                                          <div class="col-xs-3">
                                             <label>Country</label>
                                             <input type="text" name="country" id="country" class="form-control" value="<?php echo isset($builder_details['country'])?$builder_details['country']:'' ?>" />
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Zip/Postal</label>
                                             <input type="text" name="postal" id="postal" class="form-control" value="<?php echo isset($builder_details['postal'])?$builder_details['postal']:'' ?>" />
                                          </div>
                                          <div class="col-xs-3">
                                             <label>Currency</label>
                                             <div class="col-xs-12">
                                                <div class="form-group">
                                                   <?php       
                                                      $builder_currencys_selected = '';   
                                                      if(isset($builder_details['builder_currency']))
                                                      {
                                                      $builder_currencys_selected = $builder_details['builder_currency'];
                                                      }                        
                                                      echo form_dropdown('builder_currency', $builder_currency,$builder_currencys_selected, "class='selectpicker form-control' id='builder_currency' data-live-search='true'"); 
                                                      ?>
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
                  <div class="tab-pane" id="my_fields">

                     <div class="custom_list">
                      <?php //$this->load->view('content/setup/custom_field_list'); ?>
                     </div>

                  </div>                  

                    
                
                  <div class="tab-pane" id="Payments">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="box-content panel-content">
                              <div class="row card_details">
                                 <div  class="col-xs-12">
                                    <table class="col-xs-4">
                                       <tr>
                                          <td class="col-xs-3" height="30"><label>Card Details</label></td>
                                          <td class="col-xs-3" height="30"><a href="javascript:void(0);" id="change_card"><img class="uni_edit" src="<?php echo IMAGESRC.'strip.gif'; ?>"/> Change Card</a></td>
                                       </tr>
                                       <!--<tr>
                                          <td class="col-xs-3" height="30"><label>Name On Card:</label></td>
                                          <td class="col-xs-3" height="30">John Waite Jr.</td>
                                       </tr>-->
                                       <tr>
                                          <td class="col-xs-3" height="30"><label>Card number:</label></td>
                                          <td class="col-xs-3" height="30"><?php if(isset($payment_details['last_4digits'])) echo $payment_details['last_4digits']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td class="col-xs-3" height="30" colspan="2">
                                             <button class="btn btn-blue" type="button" id="upgrade_plan">Change Plan</button>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>                              
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="box-content panel-content">
                              <div class="row">
                                 <div class="col-xs-12">
                                    <label>Payment History</label>
                                    <table class="table table-bordered datatable" id="Payment_History">
                                       <thead>
                                          <tr>
                                             <th>Date</th>
                                             <th>Transaction ID</th>
                                             <th>For Plan</th>
                                             <th>Amount</th>
                                             <th>Billing Cycle</th>
                                             <th>Card</th>
                                             <th>Status</th>
                                             <th>Download Invoice</th>
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
                  <div class="tab-pane" id="changeplan">
					<div class="row make-new-plan">
						<div class="col-xs-12">
							<div class="col-xs-6">
								<h4>Current Plan</h4>
								<table class="plan_table">
									<tr>
										<th>Plan Name</th>
										<th>Plan Amount</th>
									</tr>
									<tr>
										<td><?php echo $current_plan_name; ?></td>
										<td><?php echo '$'.$current_plan_amount; ?></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="col-xs-6">
								<h4>New Plan</h4>
								<table class="plan_table">
									<tr>
										<th>Plan Name</th>
										<th>Plan Amount</th>
										<th>Prorata Amount</th>
									</tr>
									<tr>
										<td><?php echo $new_plan_name; ?></td>
										<td><?php echo '$'.$new_plan_amount; ?></td>
										<td><?php echo '$'.$updated_plan_amount; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row m-top make-new-plan">
						<div class="col-xs-12">
					 <div class="col-xs-4">								
						<div class="form-group row">
						   <label for="cardno" class="col-xs-4 control-label">Payment Amount<span class="mandatory-field">*</span></label>
						   <div class="col-xs-8 control-label">
							  <label><?php echo '$'.$updated_plan_amount; ?></label>
						   </div>
						</div>
						<div class="form-group row">
						   <label for="cardno" class="col-xs-4 control-label">Credit Card Number<span class="mandatory-field">*</span></label>
						   <div class="col-xs-8">
								<input type="hidden" class="form-control"  id="updated_plan_amount" name="updated_plan_amount" value="<?php if(isset($updated_plan_amount)) echo $updated_plan_amount; ?>">
							  <input type="text" class="form-control"  id="credit_card_numbers" name="credit_card_numbers" placeholder="Credit Card Number">
						   </div>
						</div>
						<div class="row add-function">
						   <label for="expiry" class="col-xs-4 control-label">Expiry<span class="mandatory-field">*</span></label>
						   <div class="col-xs-8">
							  <div class="expiry col-xs-7">
								 <div class="col-xs-12">
									<div class="form-group">
									   <select class="selectpicker" name="card_expiry_month" id="card_expiry_month">
										  <option value="">Month</option>
										  <option value="01">January</option>
										  <option value="02">February</option>
										  <option value="03">March</option>
										  <option value="04">April</option>
										  <option value="05">May</option>
										  <option value="06">June</option>
										  <option value="07">July</option>
										  <option value="08">August</option>
										  <option value="09">September</option>
										  <option value="10">October</option>
										  <option value="11">November</option>
										  <option value="12">December</option>
									   </select>
									</div>
								 </div>
							  </div>
							  <div class="years col-xs-5">
								 <div class="col-xs-12">
									<div class="form-group">
									   <select class="selectpicker" name="card_expiry_year" id="card_expiry_year">
										  <option value="">Year</option>
										  <option value="2015">2015</option>
										  <option value="2016">2016</option>
										  <option value="2017">2017</option>
										  <option value="2018">2018</option>
										  <option value="2019">2019</option>
										  <option value="2020">2020</option>
										  <option value="2021">2021</option>
										  <option value="2022">2022</option>
										  <option value="2023">2023</option>
										  <option value="2024">2024</option>
										  <option value="2025">2025</option>
									   </select>
									</div>
								 </div>
							  </div>
						   </div>
						</div>
						<div class="form-group row">
						   <label for="inputEmail3" class="col-xs-4 control-label">
						   CVV Number<span class="mandatory-field">*</span>
						   </label>
						   <div class="col-xs-8">
							  <input type="text" class="form-control" id="ccv_code" name="ccv_code" placeholder="Security Code">
						   </div>
						</div>
						<div class="form-group row">
						   <label for="cardname" class="col-xs-4 control-label">
						   Name On Card<span class="mandatory-field">*</span>
						   </label>
						   <div class="col-xs-8 ">
							  <input type="text" class="form-control" id="card_name" name="card_name" placeholder=" Name On Card">
						   </div>
						</div>
						<div class="col-xs-12 text-center">
						   <button class="btn btn-blue" type="button" id="make_payment" name="make_payment" onclick="make_payments()">Make Payment</button>
						   <button class="btn btn-gray" type="button" id="plan_card_details_cancel">Cancel</button>
						</div>
					 </div>
                </div>
					</div>
                    <div class="row m-top upgrade_plan_con">
                        <div class="col-xs-12">
							<table class="col-xs-9 change_plan">
								<tr>
									<td class="plan-color col-xs-4">Silver</td>
									<td class="plan-color col-xs-4">Gold</td>
									<td class="plan-color-green col-xs-4">Platinum</td>
								</tr>
								<tr>
									<td class="plan-details" height="150"> 
										<span class="et_pb_et_price"><span class="et_pb_dollar_sign">$</span><span class="et_pb_sum"><?php echo $plan_detail['0']['plan_amount'] ?></span>/mo</span>
									</td>
									<td class="plan-details">
										<span class="et_pb_et_price"><span class="et_pb_dollar_sign">$</span><span class="et_pb_sum"><?php echo $plan_detail['1']['plan_amount'] ?></span>/mo</span>
									</td>
									<td class="plan-details"><span class="et_pb_much">Much Cheaper!!</span></td>
								</tr>
								<tr>
									<td height="200" class="bor-o">
										<ul class="et_pb_pricing">
											<li><?php echo $plan_detail['0']['no_of_projects'] ?> project per year</li>
											<li><?php if($plan_detail['0']['no_of_users'] == -1){ echo "Unlimited"; }else{ echo $plan_detail['0']['no_of_users']; } ?> # users</li>
										</ul>
									</td>
									<td class="bor-o">
										<ul class="et_pb_pricing">
											<li><?php echo $plan_detail['1']['no_of_projects'] ?> project per year</li>
											<li><?php if($plan_detail['1']['no_of_users'] == -1){ echo "Unlimited"; }else{ echo $plan_detail['1']['no_of_users']; } ?> # users</li>
										</ul>
									</td>
									<td class="bor-o">
										<ul class="et_pb_pricing">
											<li>Contact us to tailor a package for your needs.</li>											
										</ul>
									</td>
								</tr>
								<tr>
									<td height="100" >
										<div class="text-center">
                                 <?php if (isset($plan_id) && $plan_id == $plan_detail['0']['ub_plan_id']) {
                                 ?>
                                    <a class="et_pb_pricing_table_button" href="javascript:void(0);">My Plan</a>
                                <?php }
                                 else
                                 { ?>
                                    <a class="et_pb_pricing_table_button" href="mailto:admin@unibuilder.com" >Downgrade to this plan</a>
                                 <?php }
                                 ?>
										</div>
									</td>
									<td>
										<div class="text-center">
                                 <input type="hidden" id="subscription_id" value="<?php if(isset($subscription_id)) echo $subscription_id;?>">
                                 <input type="hidden" id="plan_id" value="2">
                                 <?php if (isset($plan_id) && $plan_id == $plan_detail['1']['ub_plan_id']) {
                                 ?> 
                                    <a class="et_pb_pricing_table_button" href="javascript:void(0);">My Plan</a>
                                 <?php }
                                 else
                                 { ?>
                                    <a class="et_pb_pricing_table_button" id="upgrade_plan_to_gold" href="javascript:void(0);" > <!--href="mailto:admin@unibuilder.com"-->Upgrade to this plan</a>
                                <?php }
                                 ?>
											
										</div>
									</td>
									<td>
										<div class="text-center">
											<a class="et_pb_pricing_table_button" href="mailto:admin@unibuilder.com">Contact us</a>
										</div>
									</td>
								</tr>								
							</table>
                        </div>
                     </div>
					<div class="row m-top">
						<div class="col-xs-12">
							<label>Plan History</label>
							<table class="table table-bordered datatable" id="plan_history" name="plan_history">
							   <thead>
								  <tr>
									 <th>Plan Name</th>
									 <th>Contract number</th>
									 <th>Cost Per Month</th>
									 <th>Start date</th>
									 <th>End date</th>
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
      </div>
   </div>
   <input type="hidden" name="builder_currency_type" id="builder_currency_type">
   <input type="hidden" name="builder_currency_symbol_code" id="builder_currency_symbol">
   <div class="row m-top">
      <div class="col-xs-12">
         <div class="tab-con pull-left">
            <div role="tabpanel">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"> <a href="#Bids" aria-controls="Bids" data-toggle="tab">Bids</a> </li>
                  <li role="presentation" class=""> <a href="#Budget" aria-controls="Budget" data-toggle="tab">Budget</a> </li>
                  <!-- <li role="presentation" class=""> <a href="#Schedules" aria-controls="Schedules" data-toggle="tab">Schedules</a> </li> -->
                  <li role="presentation" class=""> <a href="#Selections" aria-controls="Selections" data-toggle="tab">Selections</a> </li>
                  <li role="presentation" class=""> <a href="#Account_Status" aria-controls="AccountStatus" data-toggle="tab">Account Status</a> </li>
                  <!--<li role="presentation" class=""> <a href="#My_plan" aria-controls="Myplan" data-toggle="tab">My Plan </a> </li>-->
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="Bids">
                     <div class="row">
                        <div class="col-xs-12">
                           <p class="status_payapp">Alert Subs</p>
                           <div class="bids_text">                             
                                 <input name="bid_alert_to_sub_before_deadline" type="text" class="Duration" value="<?php if(isset($builder_details['bid_alert_to_sub_before_deadline'])) { echo $builder_details['bid_alert_to_sub_before_deadline'] ; } else { echo "1" ;} ?>">                                                               
                           </div>
                           <p class="status_payapp">days before bidpackage deadline</p>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="Budget">
                     <div class="row">
                        <div class="col-xs-12">
                           <p class="status_payapp">PO Prefix</p>
                           <div class="col-xs-3">
                              <input type="text" class="form-control" name="po_prefix" value="<?php  echo $builder_details['po_prefix'] ; ?>" />
                           </div>
                           <p class="status_payapp">Notify users</p>
                           <div class="bids_text">
                             
                                 <input name="po_alert_before_deadline" type="text" class="Duration" value="<?php echo $builder_details['po_alert_before_deadline'] ; ?>" >                                 
                           </div>
                           <p class="status_payapp">days before PO deadline</p>
                        </div>
                     </div>
                     <div class="row m-top">
                        <div class="col-xs-12">
                           <p class="status_payapp">CO Prefix</p>
                           <div class="col-xs-3">
                              <input type="text" name="co_prefix" class="form-control" value="<?php echo $builder_details['co_prefix'] ; ?>" />
                           </div>
                           <p class="status_payapp">Notify users</p>
                           <div class="bids_text">                              
                                 <input name="co_alert_before_deadline" type="text" class="Duration" value="<?php echo $builder_details['co_alert_before_deadline'] ; ?>" >                                
                           </div>
                           <p class="status_payapp">days before CO deadline</p>
                        </div>
                     </div>
                     <div class="row m-top">
                        <div class="col-xs-12">
                           <p class="status_payapp">Documents required for requesting payment by Sub</p>
                        </div>
                     </div>
                     <div class="row m-top">
                        <div class="col-xs-12">
                           <div class="row">
                              <div class="col-xs-2">
                                 <p>&nbsp;</p>
                              </div>
                              <div class="col-xs-3">
                                 <label>Document Name</label>
                              </div>
                              <div class="col-xs-3">
                                 <label>Comments</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-12">
                           <div class="cointainer">
                              <?php 
                                 for($i=0; $i < $count_cn; $i++)
                                 {
                                 ?>              
                              <div class="content">
                                 <div class="row">
                                    <div class="col-xs-2">
                                       <p><a class="removeBtn clone-hide" href="javascript:void(0);"><img alt="delete" src="<?php echo IMAGESRC.'delete.png'; ?>" border="0"/></a></p>
                                       <input type="hidden" name="ub_setup_budget_documents_id[]"  value="<?php if(isset($document_id[$i])) echo $document_id[$i] ?>" />
                                    </div>
                                    <div class="col-xs-3">                           
                                       <input type="text" name="name[]" value="<?php if(isset($document_name[$i])) echo $document_name[$i] ?>" class="form-control" />
                                    </div>
                                    <div class="col-xs-3">
                                       <!-- <select class="form-control selectpicker" name="comments[]" >
                                          <option value="">Nothing selected</option>
                                          <option>option1</option>
                                          <option>option2</option>
                                          </select> -->
                                       <input type="text" name="comments[]" value="<?php if(isset($document_comments[$i])) echo $document_comments[$i] ?>" class="form-control" />
                                       <?php
                                          /* if(isset($document_id[$i])){ $comment_selected = $document_id[$i]; }else{$comment_selected = '';}
                                          echo form_dropdown('comments[]', $document_option, $comment_selected, "class='form-control' id='comments' data-live-search='true'"); */ ?>
                                    </div>
                                 </div>
                              </div>
                              <?php
                                 }
                                 ?>
                              <a href="javascript:void(0);" class="sprite addBtn">
                              <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Add" class="uni_new">
                              Add</a>                                   
                           </div>
                        </div>
                     </div>
                     <div class="row m-top">
                        <div class="col-xs-8">
                           <label>Default PO disclaimer</label>
                           <textarea class="ckeditor editor1" name="default_po_disclaimer"><?php echo $builder_details['default_po_disclaimer'] ; ?></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="Schedules">
                     <div class="row">
                        <div class="col-xs-12">
                           <p><input type="checkbox" name="schedule_item" />&nbsp;&nbsp;Automatically Mark Schedule Items Complete</p>
                           <p><input type="checkbox" name="schedule_item" />&nbsp;&nbsp;Include Header in Print outs</p>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="Selections">
                     <div class="row">
                        <div class="col-xs-12">
                           <!--    <p><input type="checkbox" name="schedule_item" />&nbsp;&nbsp;Show Allowances to Vendors</p>
                              <p><input type="checkbox" name="schedule_item" />&nbsp;&nbsp;Include Allowance as default in new Projects</p> -->
                        </div>
                     </div>
                     <div class="row m-top">
                        <div class="col-xs-8">
                           <label>Default Selection disclaimer</label>
                           <textarea class="ckeditor editor1" name="default_selection_disclaimer" id="default_selection_disclaimer">
                           <?php echo $builder_details['default_selection_disclaimer'] ; ?>
                           </textarea>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="Account_Status">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table table-stribbed">
                              <tr>
                                 <td>Total projects</td>
                                 <td class="text-center"><?php echo $account_status['total_projects']  ?></td>
                              </tr>
                              <tr>
                                 <td>Running projects</td>
                                 <td class="text-center"><?php echo $account_status['running_projects']  ?></td>
                              </tr>
                              <tr>
                                 <td>Remaining projects</td>
                                 <td class="text-center"><?php echo $account_status['remaining_projects']  ?></td>
                              </tr>
                              <tr>
                                 <td>Total number of users allowed for your plan</td>
                                 <td class="text-center"><?php echo $account_status['total_users']  ?></td>
                              </tr>
                              <tr>
                                 <td>Total users created (Includes Owner)</td>
                                 <td class="text-center"><?php echo $account_status['created_users']  ?></td>
                              </tr>
                              <tr>
                                 <td>Total users remaining</td>
                                 <td class="text-center"><?php echo $account_status['remaining_users']  ?></td>
                              </tr>
                              <!-- <tr>
                                 <td>Phone call supports remaining for this month</td>
                                 <td class="text-center">5</td>
                                 </tr> -->
                           </table>
                        </div>
                     </div>
                  </div>
                  <!--<div class="tab-pane" id="My_plan">
                     <div class="row">
                        <div class="col-xs-8">
                           <div class="col-xs-2">
                              <label>Silver</label>
                              <input type="radio" name="new_plan_id"  value="1" <?php if($builder_details['plan_id']==1) {echo "checked='checked'";}?>/>
                           </div>
                           <div class="col-xs-2">
                              <label>Gold</label>
                              <input type="radio" name="new_plan_id"  value="2" <?php if($builder_details['plan_id']==2){ echo "checked='checked'";}?>/>
                           </div>
                           <div class="col-xs-2">
                              <label>Platinum</label>
                              <input type="radio" name="new_plan_id"  value="3" <?php if($builder_details['plan_id']==3){ echo "checked='checked'";}?>/>
                           </div>
                        </div>
                     </div>
                  </div>-->
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
<!-- Type Add Modal -->
<div class="modal fade" id="TypeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Comments
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" id="project_group" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <a class="sprite pull-right" href="javascript:void(0);" id="save">
                                    <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="save">
                                    Save
                                    </a>                        
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
<div class="modal fade" id="TypeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Edit / Delete
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Title</td>
                                 <td><input type="text" id="Edit_project_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="Delete_project" class="btn btn-default btn-secondary pull-right">Delete</button>               
                                    <button type="button" id="Edit_project" class="btn btn-default btn-secondary pull-right" >Save</button>
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
<!-- /Type Map Modal -->
<!-- Edit Cost Code Modal -->
<div class="modal fade" id="edit_cost_code" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Cost Code Editor
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="col-xs-4">
                              <label>Active:</label>
                              <input type="checkbox" class="form-control"/>
                           </div>
                           <div class="col-xs-8 text-right"> <a class="closing_back pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="cancel_button"> Cancel </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save_new"> Save &amp; New </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save"> Save</a> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>Edit this CostCode</h4>
                        </div>
                        <div class="col-xs-12">
                           <div class="row ">
                              <div class="col-xs-6">
                                 <label>Title:</label>
                                 <input type="text" class="form-control" placeholder="001 interior Design consulting"/>
                              </div>
                              <div class="col-xs-6">
                                 <label>Cost Code Category:</label>
                                 <select class="selectpicker form-control" multiple data-live-search="true">
                                    <option></option>
                                    <option></option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-6 m-top">
                           <label>Sub code of:</label>
                           <select class="selectpicker form-control" multiple data-live-search="true">
                              <option></option>
                              <option></option>
                           </select>
                        </div>
                        <div class="col-xs-12 m-top">
                           <label>Details:</label>
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
<!-- /Edit Cost Code Modal -->
<!-- Edit Variance Code Modal -->
<div class="modal fade" id="edit_variance_code" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Cost Code Editor
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="col-xs-4">
                              <label>Active:</label>
                              <input type="checkbox" class="form-control"/>
                           </div>
                           <div class="col-xs-8 text-right"> <a class="closing_back pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="cancel_button"> Cancel </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save_new"> Save &amp; New </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save"> Save</a> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>Edit this CostCode</h4>
                        </div>
                        <div class="col-xs-12">
                           <div class="row ">
                              <div class="col-xs-6">
                                 <label>Title:</label>
                                 <input type="text" class="form-control" placeholder="001 interior Design consulting"/>
                              </div>
                              <div class="col-xs-6">
                                 <label>Cost Code Category:</label>
                                 <select class="selectpicker form-control" multiple data-live-search="true">
                                    <option></option>
                                    <option></option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-6 m-top">
                           <label>Sub code of:</label>
                           <select class="selectpicker form-control" multiple data-live-search="true">
                              <option></option>
                              <option></option>
                           </select>
                        </div>
                        <div class="col-xs-12 m-top">
                           <label>Details:</label>
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
<!-- /Edit Variance Code Modal -->
<!-- Add Cost Code Modal -->
<div class="modal fade" id="add_cost_code" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Cost Code Editor
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="col-xs-4">
                              <label>Active:</label>
                              <input type="checkbox" class="form-control"/>
                           </div>
                           <div class="col-xs-8 text-right"> <a class="closing_back pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="cancel_button"> Cancel </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save_new"> Save &amp; New </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save"> Save</a> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>Edit this CostCode</h4>
                        </div>
                        <div class="col-xs-12">
                           <div class="row ">
                              <div class="col-xs-6">
                                 <label>Title:</label>
                                 <input type="text" class="form-control" placeholder="001 interior Design consulting"/>
                              </div>
                              <div class="col-xs-6">
                                 <label>Cost Code Category:</label>
                                 <select class="selectpicker form-control" multiple data-live-search="true">
                                    <option></option>
                                    <option></option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-6 m-top">
                           <label>Sub code of:</label>
                           <select class="selectpicker form-control" multiple data-live-search="true">
                              <option></option>
                              <option></option>
                           </select>
                        </div>
                        <div class="col-xs-12 m-top">
                           <label>Details:</label>
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
<!-- /Add Cost Code Modal -->
<!-- Add Variance Code Modal -->
<div class="modal fade" id="add_variance_code" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Cost Code Editor
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="col-xs-4">
                              <label>Active:</label>
                              <input type="checkbox" class="form-control"/>
                           </div>
                           <div class="col-xs-8 text-right"> <a class="closing_back pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Cancel" class="cancel_button"> Cancel </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save_new"> Save &amp; New </a> <a class="sprite pull-right" href="javascript:void(0);"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="Save New" class="save"> Save</a> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <h4>Edit this CostCode</h4>
                        </div>
                        <div class="col-xs-12">
                           <div class="row ">
                              <div class="col-xs-6">
                                 <label>Title:</label>
                                 <input type="text" class="form-control" placeholder="001 interior Design consulting"/>
                              </div>
                              <div class="col-xs-6">
                                 <label>Cost Code Category:</label>
                                 <select class="selectpicker form-control" multiple data-live-search="true">
                                    <option></option>
                                    <option></option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-6 m-top">
                           <label>Sub code of:</label>
                           <select class="selectpicker form-control" multiple data-live-search="true">
                              <option></option>
                              <option></option>
                           </select>
                        </div>
                        <div class="col-xs-12 m-top">
                           <label>Details:</label>
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
<!-- /Add Variance Code Modal -->
<!-- Custom Filed Modal -->

   <?php $this->load->view('content/setup/save_custom_fields'); ?>


<!-- /Custom Filed Modal -->

<!-- Delete Comment -->
<div class="modal fade confirmModal" id="confirm_comment_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Are you sure you want to delete?       
         </h4>
         <div class="modal-body">
            <div class="row m-top">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row col-xs-12">                        
                        <button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
                        <button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_comment_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Confirmation</h4>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="modal-con"> 
			<div class="row col-xs-12">   			
				<label>Please confirm you want to upgrade to Silver</label>
			</div>
              <div class="row col-xs-12 m-top">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="upgrade_plan_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> Confirm</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>

<!-- Delete subscription -->
<div class="modal fade confirmModal" id="confirm_subscription_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>Are you sure you want to cancel your subscription? <br>If you are cancelling your subscription you will automatically get logged off.<br> All your users & projects will get deleted.     
         </h4>
         <div class="modal-body">
            <div class="row m-top">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row col-xs-12">                        
                        <button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_subscription"/> CANCEL</button>  
                        <button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_comment_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="Change_order_Info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Billing Details</h4>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
		  <form id="add_setup1" class="form-horizontal" method="POST" enctype="multipart/form-data" name="add_setup1">
            <div class="modal-con pull-left col-xs-12"> 
			  	<div class="col-xs-12">
					 <div class="new_billing_card_details col-xs-12">								
						<div class="form-group row">
						   <label for="cardno" class="col-xs-4 control-label">Credit Card Number<span class="mandatory-field">*</span></label>
						   <input type="hidden" id="subscription_id" name="subscription_id" value="<?php if(isset($payment_details['subscription_id'])) echo $payment_details['subscription_id']; ?>" />
						   <input type="hidden" id="ub_payment_id" name="ub_payment_id" value="<?php if(isset($payment_details['ub_payment_id'])) echo $payment_details['ub_payment_id']; ?>" />
						   <div class="col-xs-8">
							  <input type="text" class="form-control"  id="credit_card_number" name="credit_card_number" placeholder="Credit Card Number">
						   </div>
						</div>
						<div class="row add-function">
						   <label for="expiry" class="col-xs-4 control-label">Expiry<span class="mandatory-field">*</span></label>
						   <div class="col-xs-8">
							  <div class="expiry col-xs-7">
								 <div class="col-xs-12">
									<div class="form-group">
									   <select class="selectpicker" name="expiry_month" id="expiry_month">
										  <option value="">Month</option>
										  <option value="01">January</option>
										  <option value="02">February</option>
										  <option value="03">March</option>
										  <option value="04">April</option>
										  <option value="05">May</option>
										  <option value="06">June</option>
										  <option value="07">July</option>
										  <option value="08">August</option>
										  <option value="09">September</option>
										  <option value="10">October</option>
										  <option value="11">November</option>
										  <option value="12">December</option>
									   </select>
									</div>
								 </div>
							  </div>
							  <div class="years col-xs-5">
								 <div class="col-xs-12">
									<div class="form-group">
									   <select class="selectpicker" name="expiry_year" id="expiry_year">
										  <option value="">Year</option>
										  <option value="2015">2015</option>
										  <option value="2016">2016</option>
										  <option value="2017">2017</option>
										  <option value="2018">2018</option>
										  <option value="2019">2019</option>
										  <option value="2020">2020</option>
										  <option value="2021">2021</option>
										  <option value="2022">2022</option>
										  <option value="2023">2023</option>
										  <option value="2024">2024</option>
										  <option value="2025">2025</option>
									   </select>
									</div>
								 </div>
							  </div>
						   </div>
						</div>
						<div class="form-group row">
						   <label for="inputEmail3" class="col-xs-4 control-label">
						   CVV Number<span class="mandatory-field">*</span>
						   </label>
						   <div class="col-xs-8">
							  <input type="text" class="form-control" id="code" name="code" placeholder="Security Code">
						   </div>
						</div>
						<div class="form-group row">
						   <label for="cardname" class="col-xs-4 control-label">
						   Name On Card<span class="mandatory-field">*</span>
						   </label>
						   <div class="col-xs-8 ">
							  <input type="text" class="form-control" id="cardname" name="cardname" placeholder=" Name On Card">
						   </div>
						</div>
						<div class="col-xs-12 text-center">
						   <button class="btn btn-blue" type="submit" id="update_card_details">Update</button>
						   <button class="btn btn-gray" type="submit" id="card_details_cancel" data-dismiss="modal">Cancel</button>
						</div>
					 </div>
                </div>		
			
            </div>
		  </form>
		  </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<div class="modal fade confirmModal" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to cancel the subscription?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                            
            <button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal">
               <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL
            </button>  
            <button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm">
               <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK
            </button>            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<link rel="stylesheet" href="<?php echo CSSSRC.'dropzone.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'dropzone.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ckeditor/ckeditor.js';?>"></script>
<link rel="stylesheet" href="<?php echo CSSSRC.'jquery.jscrollpane.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'enscroll-0.6.0.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'save_setup.js';?>"></script>
<script>  
 this.logo_min_width  = '<?php echo LOGO_MIN_WIDTH; ?>'; 
 this.logo_max_width  = '<?php echo LOGO_MAX_WIDTH; ?>'; 
 this.logo_min_height  = '<?php echo LOGO_MIN_HEIGHT; ?>'; 
 this.logo_max_height  = '<?php echo LOGO_MAX_HEIGHT; ?>'; 
</script>
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; 
   this.displayStart   = '<?php echo 0 ?>';    
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';  
   this.controller = '<?php echo $this->module; ?>';   	
   this.list_page   = 'yes';    
</script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script data-sample="1">
   CKEDITOR.replace( 'default_po_disclaimer', {
     toolbar: [    
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] }
       ]
   	
   });
   CKEDITOR.replace( 'default_selection_disclaimer', {
     toolbar: [    
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] }
       ]
   	
   });
  
</script>