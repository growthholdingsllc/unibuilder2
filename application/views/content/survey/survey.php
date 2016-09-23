<div class="row">
    <ol class="breadcrumb">
    </ol>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="top-search pull-right"> 
			<?php
			if(isset($this->user_role_access['survey'][strtolower('add')]) && $this->user_role_access['survey'][strtolower('add')] == 1)
			{
			?>
            <a class="new_template" href="<?php echo base_url().$this->crypt->encrypt('survey/new_template/'); ?>">
            <button type="button" class="btn btn-blue  pull-right"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New Template" class="uni_new" /> New Template</button>
            </a>
            <button type="button" id="release_survey" class="btn btn-blue  pull-right"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New Template" class="uni_new" /> Release Survey</button>
			<?php 
			}
			?>	
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
        <div class="panel-content pull-left">
            <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                <div class="panel panel-default">
                    <div id="filter" role="tab" class="panel-heading">
                        <h4 class="panel-title">
                            <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
                            FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                            </a>
                        </h4>
                    </div>
                    <input type="hidden" id="survey_template" value="" />
                    <div class="panel-collapse collapse in" id="collapseOne" role="tabpanel" aria-labelledby="filter">
                        <form class="form-horizontal" method="post" name="Search_Result" id="Search_Result">
                            <div class="panel-body col-xs-12">
                                <div class="row">
                                    <div class="col-xs-3 tags">
                                        <label>Tags</label>
                                        <?php 
                                            $tags_selected = '';
											if(isset($template_search_session_array['tags']))
											{
												$tags_selected = explode(",",$template_search_session_array['tags']);
											}
											echo form_dropdown('tags[]', $survey_tags, $tags_selected, "class='selectpicker form-control' id='tags' data-live-search='true' multiple"); 
										?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 Status">
                                        <label>Status</label>
                                        <select class="form-control selectpicker" id="status" name="status">
                                            <option value="">Nothing selected</option>
                                            <option value="New" <?php if(isset($request_search_session_array['status'])&& $request_search_session_array['status'] == 'New'){ ?> selected <?php } ?>>New</option>
                                            <option value="Released" <?php if(isset($request_search_session_array['status'])&& $request_search_session_array['status'] == 'Released'){ ?> selected <?php } ?>>Released</option>
                                            <option value="Closed" <?php if(isset($request_search_session_array['status'])&& $request_search_session_array['status'] == 'Closed'){ ?> selected <?php } ?>>Closed</option>
                                        </select>
                                    </div>
                                    <!--<div class="col-xs-3 Project">
                                        <label>Project</label>
                                        <select class="form-control selectpicker">
                                            <option value="">Nothing selected</option>
                                        </select>
                                    </div>-->
									<div class="col-xs-3 tags2">
                                        <label>Tags</label>
                                        <?php 
                                            $tags_selected = '';
											if(isset($response_search_session_array['tags']))
											{
												$tags_selected = explode(",",$response_search_session_array['tags']);
											}
											echo form_dropdown('respone_tags[]', $survey_tags, $tags_selected, "class='selectpicker form-control' id='respone_tags' data-live-search='true' multiple"); 
										?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 released">
                                        <label>Released to</label>
                                        <?php 
                                            $users_selected = '';
											if(isset($response_search_session_array['user_id']))
											{
												$users_selected = explode(",",$response_search_session_array['user_id']);
											}
                                             echo form_dropdown('user_id[]', $get_all_users, $users_selected, "class='selectpicker form-control' id='user_id' data-live-search='true' multiple"); 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row text-center m-top">     
                                    <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                                    <button type="button" class="btn btn-gray" id="reset" name="reset" >Reset</button>
                                    <button type="submit" class="btn btn-gray" id="save_filter" name="save_filter" >Save Filter</button>
                                    <button type="button" class="btn btn-gray" id="apply_saved_filter" name="apply_saved_filter" style="display:none;">Apply Saved Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-con pull-left">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <?php 
                        // this code is for sub/owner portal added by satheesh kumar 
                        if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
                        {
                        ?>
                    <li role="presentation" class="active">
                        <a href="#Templates" aria-controls="Templates" data-toggle="tab">Templates</a>
                    </li>
                    <li role="presentation">
                        <a href="#Response"  aria-controls="Response" data-toggle="tab">Response(s)</a>
                    </li>
                    <?php 
                        }
                        ?>
                    <li role="presentation" class="<?php if(isset($this->user_account_type) && $this->user_account_type != BUILDERADMIN){ echo 'active'; } ?>">
                        <a href="#Survey"  aria-controls="Survey" data-toggle="tab">Survey Request</a>
                    </li>
                </ul>
                <!-- /Nav tabs -->
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php 
                        // this code is for sub/owner portal added by satheesh kumar 
                        if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
                        {
                        ?>
                    <div class="tab-pane active" id="Templates">
                        <table class="table table-bordered datatable" id="survey_template_table" name="survey_template_table" width="100%">
                            <thead>
                                <tr>
                                    <th>Survey Template Name</th>
                                    <th>Tags</th>
                                    <th>Created By</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="Response">
                        <table class="table table-bordered datatable" id="response_table" name="response_table"  width="100%">
                            <thead>
                                <tr>
                                    <th>Survey Name</th>
                                    <th>Project Name</th>
                                    <th>Released on</th>
                                    <th>Released By</th>
                                    <th>Released to</th>
                                    <th>View Response</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <?php 
                        }
                        ?>
                    <div class="tab-pane <?php if(isset($this->user_account_type) && $this->user_account_type != BUILDERADMIN){ echo 'active'; } ?>" id="Survey">
                        <table class="table table-bordered datatable" id="Survey_list" width="100%">
                            <thead>
                                <tr>
                                    <th>Survey Name</th>
                                    <th>For Project</th>
                                    <th>Released on</th>
                                    <th>Released By</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Tab panes -->
            </div>
        </div>
    </div>
</div>
<!-- Add Question -->
<div class="modal fade" id="<?php if(!empty($this->project_id)) echo 'release_survey_modal'; else echo '';?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4><span class="title">Release Survey</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </h4>
            <div class="modal-body">
                <form class="form-horizontal" method="post" name="release_survey" id="release_survey">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="modal-con">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table width="100%" class="table border-none">
                                            <tr>
                                                <td colspan="2">Project Name: <?php echo $this->project_name;?></td>
                                            </tr>
                                            <tr>
                                                <td>Survey Name</td>
                                                <td>
                                                    <input type="text" class="form-control" id="survey_name" name="survey_name" />									
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Select Template</td>
                                                <td>
                                                    <?php 
                                                        $template_selected = '';
                                                        if(isset($template_data['template']))
                                                        {
                                                        $template_selected = explode(",",$template_data['template']);
                                                        }
                                                        echo form_dropdown('template_id', $template_name, $template_selected, "class='selectpicker form-control2' id='template_id' data-live-search='true'");?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p>(selecting sub will release the survey to all the subs in this project)</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="20" colspan="2">								 
                                                    <button type="button" id="cancel_survey_popup" class="btn btn-gray pull-right" data-dismiss="modal"><img src="<?php echo IMAGESRC.	'strip.gif'; ?>" class="uni_cancel_new" /> Cancel</button>									
                                                    <button type="button" class="btn btn-blue pull-right" id="add_table" name="add_table"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new"/> Add </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="pagination_area">

   <input type="hidden" value="<?php echo isset($template_search_session_array['iDisplayLength'])?$template_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="template_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($template_search_session_array['iDisplayStart'])?$template_search_session_array['iDisplayStart']:0; ?>" id="template_displayStart" />

   <input type="hidden" value="<?php echo isset($response_search_session_array['iDisplayLength'])?$response_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="response_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($response_search_session_array['iDisplayStart'])?$response_search_session_array['iDisplayStart']:0; ?>" id="response_displayStart" />

   <input type="hidden" value="<?php echo isset($request_search_session_array['iDisplayLength'])?$request_search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="request_default_pagination_length" />
   <input type="hidden" value="<?php echo isset($request_search_session_array['iDisplayStart'])?$request_search_session_array['iDisplayStart']:0; ?>" id="request_displayStart" />

   
   
</div>

<script type="text/javascript">        
    this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';  
    this.displayStart   = '<?php echo 0 ?>';   
    this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
    this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
    this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
    this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
    this.list_page   = 'yes';
	this.project_id  = '<?php echo $this->project_id; ?>'; 
    this.template_apply_filter = '<?php echo $template_apply_filter; ?>';
	this.response_apply_filter = '<?php echo $response_apply_filter; ?>';
    this.request_apply_filter = '<?php echo $request_apply_filter; ?>';
</script>
<!-- /Add Question -->
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'survey.js';?>"></script>
