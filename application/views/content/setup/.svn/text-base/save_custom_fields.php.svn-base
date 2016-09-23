
<div class="modal fade" id="custom_field_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
  <form id="custom_field_form" class="form-horizontal" method="post" name="custom_field_form">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4><span class="custom_title"></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </h4>

         <input type="hidden" name="module_name" id="module_name" value="" />
	      <input type="hidden" name="classification" id="classification" value="" />
         <input type="hidden" name="ub_custom_field_id" id="ub_custom_field_id" value="" />

         <div class="modal-body">
            <div class="row">
               <div class="col-xs-12">
                  <div class="modal-con">
                     <div class="row">
                        <div class="col-xs-12">
                           <table width="100%" class="table border-none">
                              <tr>
                                 <td height="20">Field Label</td>
                                 <td>
                                 	<div class="col-xs-12">
									 <div class="form-group">
                                 	<input type="text" name="label_name" id="label_name" class="form-control" />
                                   </div>
                                  </div>
                                 </td>
                              </tr>
							  <tr>
                                 <td height="20">Field Type</td>
                                 <td>
                                 	<div class="col-xs-12">
									 <div class="form-group">
									<?php 
									
									echo form_dropdown('data_type', $data_type_array, '', "class='selectpicker form-control' id='data_type' data-live-search='true'");
									
									?>
								  </div>
								</div>
								 </td>
                              </tr>
							  <tr>
                                 <td height="20">Tool Tip text</td>
                                 <td><input type="text" name="tooltip" id="tooltip" class="form-control" /></td>
                              </tr>
							  <tr>
                                 <td height="20"><input type="checkbox" id="mandatory" name="mandatory" /> Required field?</td>
                                 <td>Display Order <input type="text" name="display_order" id="display_order" class="form-control3" /></td>
                              </tr>
							  <tr>
								<td colspan="2" class="custom_adding_values">
									<div class="box-content panel-content">
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group add_val">
												Add Value <input type="text" name="add_custom_val" class="form-control5" maxlength="35" id="add_custom_val" /> <button class="btn btn-blue" id="add_value" type="button"><img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>" /> Add</button>
												<span class="text-danger"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="box-content panel-content scroll-pane">
													<label>Added Values (Drag & Drop to rearrange)</label>
													<ul id="custom_field_list" class="list-unstyled">
                                           <!--   <li class="panel panel-info">
                                                <div class="panel-heading">
                                                   <span class="add_val_con">dddddddd</span> <span class="pull-right"><a class="edit_custom_val" href="javascript:void(0);"><img src="http://10.0.0.149/sidhartha.s/uniBuilder/assets/images/strip.gif" class="uni_edit"></a> <a class="delete_custom_val" href="javascript:void(0);"><img src="http://10.0.0.149/sidhartha.s/uniBuilder/assets/images/strip.gif" class="uni_delete"></a></span>
                                                </div>
                                             </li> -->
                                       </ul>
													<!--<button class="btn btn-blue" id="save_custom_field">Save</button>-->

												</div>
											</div>
										</div>
									</div>
								</td>
							  </tr>
                              <tr>
                                 <td height="20" colspan="2">

								<!-- 	<button class="btn btn-gray pull-right" id="cancel"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"> Cancel</button>
									<button class="btn btn-blue pull-right" id="delete"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete"> Delete</button> --> 

									<button class="btn btn-blue pull-right" id="save_custom_field" type="submit"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_new"> Save</button>
																		
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
  </form>
</div>
<!-- /Custom Filed Modal