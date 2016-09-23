<?php //echo'<pre>';print_r($question_response_data);?>
<div class="row">
    <ol class="breadcrumb">
    </ol>
</div>
<form name="save_survey_form" id="save_survey_form" method="post">
    <div class="row">
        <div class="col-xs-12">
            <div class="top-search pull-right">
                <div class="pull-right">
					<input type="hidden" name="save_type" id="save_type" value="" />
					<input type="hidden" name="status" id="status" value="<?php echo (isset($survey_data['status'])?$survey_data['status']:'New') ?>" />
					<input type="hidden" name="project_id" id="project_id" value="<?php echo (isset($survey_data['project_id']))?$survey_data['project_id']:0 ?>" />
                    <a class="new_template" href="<?php echo base_url().$this->crypt->encrypt('survey/index/').'#Response'; ?>">
                    <button type="button" class="btn btn-gray  pull-right m-left-1" id="survey_cancel" name="survey_cancel" ><img src="<?php echo IMAGESRC.	'strip.gif'; ?>" class="uni_cancel_new"/> Cancel </button>
                    </a>
					<?php 
					if(isset($this->user_role_access['survey'][strtolower('delete')]) && $this->user_role_access['survey'][strtolower('delete')] == 1)
					{
					?>
                    <button class="btn btn-blue  pull-right m-left-1" type="button"  id="<?php if(isset($survey_data['ub_survey_id'])) echo $survey_data['ub_survey_id']; ?>" name="survey_delete" onclick="deletesurvey(this.id)" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_delete" /> Delete</button>
					<?php 
					}
					if(isset($this->user_role_access['survey'][strtolower('edit')]) && $this->user_role_access['survey'][strtolower('edit')] == 1 && $this->first_argument > 0)
					{ 
					?>
                    <a class="new_template" href="<?php echo base_url().$this->crypt->encrypt('survey/index/').'#Response'; ?>">		
                    <button type="submit" class="btn btn-blue  pull-right m-left-1" id="survey_save_and_back" name="survey_save_back" ><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>	
                    </a>
                    <button type="submit" class="btn btn-blue pull-right m-left-1" name="survey_save_stay" id="survey_save_and_stay"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
                    <button type="submit" class="btn btn-blue  pull-right m-left-1"  id="survey_save_release"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_release"> Save &amp; Release </button>
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
    <div class="row">
        <div class="col-xs-12">
            <h4>SURVEY INFO</h4>
            <div class="box-content panel-content">
                <div class="row">
                    <div class="col-xs-3">
                        <label>Name</label>
                        <input type="text" id="name" name="name" class="form-control" name="name" value="<?php echo isset($survey_data['name'])?$survey_data['name']:'' ?>"/>
                        <input type="hidden" name="ub_survey_id" id="ub_survey_id" value="<?php echo (isset($survey_data['ub_survey_id']) && $survey_data['ub_survey_id'] > 0)? $survey_data['ub_survey_id']:0 ?>" />
                    </div>
                    <div class="col-xs-3">
                        <label>Assigned Users</label>
                        <?php 
                            $user_selected = '';
                            if(isset($survey_data['assigned_users']))
                            {
                            $user_selected = explode(",",$survey_data['assigned_users']);
                            }
                            echo form_dropdown('assigned_users[]', $get_all_users, $user_selected, "class='selectpicker form-control' id='assigned_user' data-live-search='true' multiple"); 
                            ?> 
                    </div>
					<div class="col-xs-3">
                        <label>Tags</label>
                        <div class="col-xs">						   
                            <?php 
							$tag_selected = '';
							if(isset($survey_data['tags']))
							{
								$tag_selected = explode(",",$survey_data['tags']);
							}
							echo form_dropdown('tags[]', $survey_tags, $tag_selected, "class='selectpicker form-control2' id='tags' data-live-search='true' multiple");
							?>
                            <span class="right-group input-group-addon"> 
                            <a href="javascript:void(0);" data-target="#survey_tags" data-toggle="modal"> <img border="0" alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>"> </a> 
                            <a href="javascript:void(0);" class="edit_survey_tags"> <img border="0" alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>"> </a> 
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="notes" id="notes"><?php echo isset($survey_data['notes'])?$survey_data['notes']:'' ?></textarea>					
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4>SURVEY TEMPLATE</h4>
            <div class="box-content panel-content">
                <div class="row">
                    <div class="col-xs-12">
                        <label>Survey Description</label>
                        <textarea class="form-control" name="description" id="description" ><?php echo isset($survey_data['description'])?$survey_data['description']:'' ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box-content panel-content">
                            <label>Questionaire</label>
							<?php
							if(isset($this->user_role_access['survey'][strtolower('add')]) && $this->user_role_access['survey'][strtolower('add')] == 1)
							{
								if(isset($survey_data['status']) && $survey_data['status'] != 'Released')
								{	
							?>
                            <button type="button" class="btn btn-blue pull-right add_question" ><img border="0" class="uni_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Add Question</button>
							<?php 
								}
							}
							?>
                            <p>Drag and drop the questions to change order</p>
                            <h4 class="no_ques text-center hide">No Questions Found</h4>
                            <ul id="survey_field_list" class="list-unstyled">
                                <?php if(isset($question_response_data)){?>
                                <?php foreach ($question_response_data as $key => $value) {?>
                                <li class="panel panel-info">
                                    <div class="panel-heading">
                                        <table width="100%" class="table borderless">
                                            <tr>
                                                <td width="50" rowspan="3"><img border="0" alt="sort" class="sort_img" src="<?php echo IMAGESRC;?>sort.png"></td>
                                                <td width="150"><label>Answer Type:</label></td>
                                                <td width="150"><span class="ans_type_field"><?php echo $value['answer_type'];?></span></td>
                                                <td width="120"><label>Response Field:</label></td>
                                                <td width="300"><span class="res_col_name_field"><?php echo $value['question_column_name'];?></span></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="question_box">
                                                    <p><label>Question:</label> <span class="question_id hide"><?php echo $value['ub_survey_question_id'];?></span><span class="q_notes_field"> <?php echo $value['question'];?></span></p>
                                                </td>
                                                <td>
                                                    <div class="pull-right">
													<?php if(isset($survey_data['status']) && $survey_data['status'] != 'Released')
													{	
													?>
													<button type="button" class="btn btn-blue edit_survey_question" id=""><img border="0" alt="edit" class="uni_edit" src="<?php echo IMAGESRC;?>strip.gif"> Edit</button>
													<?php 
													if(isset($this->user_role_access['survey'][strtolower('delete')]) && $this->user_role_access['survey'][strtolower('delete')] == 1)
													{
													?>
													<button type="button" class="btn btn-blue" id="<?php if(isset($value['ub_survey_question_id'])) echo $value['ub_survey_question_id']; ?>" name="survey_question_delete" onclick="deletesurveyquestion(this.id)" ><img border="0" alt="edit" class="uni_delete" src="<?php echo IMAGESRC;?>strip.gif"> Delete</button>
													<?php 
													}
													?>
													<?php 
													}
													?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="150"><label>Include Not applicable:</label></td>
                                                <td colspan="4"><span class="inlcude_app_field"><?php echo $value['include_not_applicable'];?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <?php }} ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Survey Tags Modal -->
<div class="modal fade" id="survey_tags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4>New Tags
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
                                            <td><input type="text" id="tags_group" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td height="20" colspan="2"><button type="submit" class="btn btn-default btn-secondary pull-right" id="save_tags">Save</button></td>
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
<div class="modal fade" id="edit_survey_tags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <td><input type="text" id="Edit_tags_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20" colspan="2">
                                                <button type="button" id="tags_group_delete" class="btn btn-default btn-secondary pull-right">Delete</button>
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
<!-- /Survey Tags Modal -->
<!-- Add Question -->
<div class="modal fade" id="add_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4><span class="title">Add Question</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </h4>
            <div class="modal-body">
				<div class="row grid_settings">
				    <div class="col-xs-12">
						<div class="modal-con">
							<div class="row">
								<div class="col-xs-12">
									<table width="100%" class="border-none">
										<tbody><tr>
											<td height="30" colspan="2">
												<div class="col-xs-12 error-message uni_message">
												<div class="alerts alert-danger"></div>
												</div>		
											</td>
										</tr></tbody>
									</table>
							    </div>
						    </div>
					    </div>
				    </div>
				</div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="modal-con">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form name="question_form" id="question_form" method="post" class="form-horizontal">
                                        <div class="col-xs-12">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Question</label>
                                                    <textarea class="form-control" id="question_notes" name="question_notes"></textarea>
                                                    <input type="hidden" name="ub_survey_id" id="ub_survey_id" value="<?php echo (isset($survey_data['ub_survey_id']) && $survey_data['ub_survey_id'] > 0)? $survey_data['ub_survey_id']:0 ?>" />
                                                    <input type="hidden" name="ub_survey_question_id" id="ub_survey_question_id" value="<?php echo (isset($survey_question_data['ub_survey_question_id']) && $survey_question_data['ub_survey_question_id'] > 0)? $survey_question_data['ub_survey_question_id']:0 ?>" class="ub_survey_question_id"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 m-top">
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Response Column Name</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="res_col_name" name="res_col_name" value="<?php echo isset($survey_question_data['question_column_name'])?$survey_question_data['question_column_name']:'' ?>"/>
                                                    <p><small>(Above name will be the  field name for this question in responses)</small></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 m-top">
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Answer Type</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <select id="ans_type" class="form-control selectpicker" name="ans_type">
                                                        <option value="">Nothing selected</option>
                                                        <option value="Numeric Scale">Numeric Scale(1-10)</option>
                                                        <option value="Yes/No">Yes/No</option>
                                                        <option value="Open Ended">Open Ended</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 m-top">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <input type="checkbox" id="inc_app" name='include_not_applicable' value="No" /> Include Not Applicable?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 m-top">
                                            <div class="col-xs-12 text-center">																		
                                                <button type="submit" class="btn btn-blue" id="save_survey_question"><img src="<?php echo IMAGESRC.	'strip.gif'; ?>" class="uni_new"/> Add</button>									
                                                <button type="submit" class="btn btn-blue" id="edit_save_survey_question"><img src="<?php echo IMAGESRC.	'strip.gif'; ?>" class="uni_new"/> Save</button>
                                                <button type="button" class="btn btn-gray" id="question_cancel" data-dismiss="modal"><img src="<?php echo IMAGESRC.	'strip.gif'; ?>" class="uni_cancel_new" /> Cancel</button>

                                              

                                            </div>
                                        </div>
                                          <input type="hidden" name="save_question_type" id="save_question_type" value="" />
                                    </form>
                                </div>
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
            <h4>Are you sure you want to delete?       
            </h4>
            <div class="modal-body">
                <div class="row m-top">
                    <div class="col-xs-12">
                        <div class="modal-con">
                            <div class="row col-xs-12">                				
                                <button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> CANCEL</button>  
                                <button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_approved"/> OK</button>				
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add Question -->
<script type="text/javascript" src="<?php echo JSSRC.'save_survey.js';?>"></script>
