<div class="row">
    <ol class="breadcrumb">
        <?php //$this->load->view('common/breadcrumbs'); ?> 
        <!--<li class="active">Minutes of Meeting</li>-->
    </ol>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="top-search pull-right">
            <?php 
                if(isset($this->project_status_check) && $this->project_status_check == 1)
                {
                ?>	
            <div class="pull-right "> 
                <a href="<?php echo base_url(); ?>cHJvamVjdHMvc2F2ZV9tZWV0aW5nLw--">			
                <button class="btn btn-blue pull-right" type="button">
                <img border="0" class="uni_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Add MOM
                </button>
                </a>
            </div>
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
    <div class="col-xs-12 pull-left">
        <div class="panel-content pull-left">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="filter">
                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR ACTIONS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                        <div class="panel-body col-xs-12">
                            <form id="Search_Result" class="form-horizontal" method="post" name="Search_Result">
                                <div class="row five-col">
                                    <div class="col-xs-3">
                                        <label>Date Range</label>
                                        <div class="input-prepend input-group">                      
                                            <input type="text" name="daterange" id="daterange" class="form-control" value="<?php echo isset($search_session_array['daterange'])?$search_session_array['daterange']:''; ?>"  readonly /> 					    
                                            <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
                                        </div>
                                    </div>
                                    <!--<div class="col-xs-3">
                                        <label>Project</label>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <?php 
                                                    $project_selected = '';
                                                     if(isset($search_session_array['project']))
                                                     {
                                                    $project_selected = $search_session_array['project'];
                                                     }
                                                     echo form_dropdown('project_id', $project_list, $project_selected, "class='selectpicker form-control' id='project' data-live-search='true'"); 
                                                    ?>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="col-xs-3">
                                        <label>Type</label>
                                        <?php 
                                            $type_selected = '';
                                            if(isset($search_session_array['meetingType']))
                                            {
                                            $type_selected = $search_session_array['meetingType'];
                                            }
                                            echo form_dropdown('type[]', $mom_type, $type_selected, "class='selectpicker form-control' id='meetingType' data-live-search='true' multiple"); 
                                            ?>
                                    </div>
                                    <div class="col-xs-3">
                                        <label>Attendees</label>
                                        <?php 
                                            $attendees_selected = '';
                                            if(isset($search_session_array['attendees']))
                                            {
                                            $attendees_selected = explode(",",$search_session_array['attendees']);
                                            }
                                            echo form_dropdown('attendees[]', $all_type_users, $attendees_selected, "class='selectpicker form-control' id='attendees' data-live-search='true' multiple"); 
                                            ?> 
                                    </div>
									<div class="col-xs-3">
                                        <label>Conducted By</label>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <?php 
                                                    $conducted_by_selected = '';
                                                    if(isset($search_session_array['conducted_by']))
                                                    {
                                                    $conducted_by_selected = $search_session_array['conducted_by'];
                                                    }
                                                    array_unshift($all_type_users,"Nothing Selected");
                                                    echo form_dropdown('conducted_by', $all_type_users, $conducted_by_selected, "class='selectpicker form-control' id='conducted_by' data-live-search='true'"); 
                                                    ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row five-col">
                                    <div class="col-xs-3">
                                        <label>Status</label>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <?php 
                                                    $status_selected = '';
                                                     if(isset($search_session_array['status']))
                                                     {
                                                    $status_selected = $search_session_array['status'];
                                                     }
                                                    echo form_dropdown('status', $mom_status,$status_selected, "class='selectpicker form-control' id='status' data-live-search='true'"); 
                                                    ?>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <label>Tags</label>
                                        <?php 
                                            $tags_selected = '';
                                             if(isset($search_session_array['tagType']))
                                             {
                                            $tags_selected = $search_session_array['tagType'];
                                             }
                                             echo form_dropdown('tagType[]', $mom_tags, $tags_selected, "class='selectpicker form-control' id='tagType' data-live-search='true' multiple"); 
                                             ?>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                                    <button type="submit" class="btn btn-gray" id="mom_search_reset" >Reset</button>
                                    <button type="submit" class="btn btn-gray" id="save_filter">Save Filter</button>
                                    <?php if($apply_filter == TRUE){ ?>
                                    <button class="btn btn-default btn-gray" type="button" id="apply_save_filter">Apply Saved Filter</button>
                                    <?php }else { ?>
                                    <button class="btn btn-default btn-gray" type="button" id="apply_save_filter" style="display:none;">Apply Saved Filter</button>
                                    <?php } ?>
                                    <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 pull-left">
        <div class="add-function">
            <div class="padding_left_0 col-xs-3  pull-left">
                <select class="selectpicker form-control" onchange="delete_all_checked_mom(this.value)" title="Task Actions">
                    <option value="">Bulk Actions</option>
                    <option value="delete_multi_mom">Delete Checked MOM</option>
                </select>
            </div>
        </div>
        <!--<div class="row datatable-bor">
            <div class="add-function">
              <div class="col-xs-3 pull-left">
                 <select class="selectpicker form-control" onchange="delete_all_checked_mom(this.value)" 
                 title="Mom Actions"><option value="">Bulk Actions</option>         
                  <option value="delete_multi_mom">Delete Checked mom</select>
                </select>
              </div>
              <div class="col-xs-3 pull-right">
            <a href="javascript:void(0);"><img id="export_file" name="export_file" src="<?php echo IMAGESRC.'icon_excel1_1.png'; ?>"></a>
            <a data-target="#ChecklistModal" data-toggle="modal" href="javascript:void(0);"><img src="<?php echo IMAGESRC.'icon_settings1_1.png'; ?>"></a></div>
            </div>
            </div>-->
        <table class="table table-bordered datatable" id="meeting_list" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectall" name="all"/></th>
                    <th>Title</th>
                    <th>Agenda</th>
                    <th>Date Held</th>
                    <th>Conducted By</th>
                    <th>Attendees</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Project</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4 class="modal-title" id="myModalLabel">Import Task From Template
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </h4>
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
                                <button type="button" class="btn btn-primary">Import Tasks</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Check List Modal -->
<div class="modal fade" id="ChecklistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4>Grid Settings
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </h4>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="modal-con">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table width="100%" class="border-none">
                                        <tr>
                                            <td height="30">Saved Views</td>
                                            <td>
                                                <select class="selectpicker form-control">
                                                    <option>Standard View</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-top">
                    <div class="col-xs-12">
                        <div class="modal-con">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Current View</h4>
                                    <table width="100%" class="table border-none">
                                        <tr>
                                            <td height="30">Column</td>
                                            <td>
                                                <select class="selectpicker form-control">
                                                    <option>All Items Selected</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30">View Name</td>
                                            <td><input type='text' class="form-control" placeholder="Standard View234" /></td>
                                        </tr>
                                        <tr>
                                            <td>Is Default</td>
                                            <td><input type="checkbox" />
                                                Is Default
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="2"><button class="btn btn-default btn-primary" type="button">APPLY VIEW</button>
                                                <button class="btn btn-default btn-primary" type="button">SAVE AS VIEW</button>
                                                <button class="btn btn-default btn-primary" type="button">UPDATE SELECTED</button>
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
<input type="hidden" id="project_mom" value="" />
<form id="Search_Result_export" class="form-horizontal hide" method="post" name="Search_Result_export">
    <div class="row five-col">
        <div class="col-xs-3">
            <label>Date Range</label>
            <div class="input-prepend input-group">                      
                <input type="text" name="daterange"  class="form-control" value="<?php echo $sess_fromandto_date; ?>" id="daterange" readonly /> 					    
                <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span>
            </div>
        </div>
        <div class="col-xs-3">
            <label>Project</label>
            <div class="col-xs-12">
                <div class="form-group">
                    <?php 
                        $project_selected = '';
                         if(isset($search_session_array['project']))
                         {
                        $project_selected = $search_session_array['project'];
                         }
                         echo form_dropdown('project_id', $project_list, $project_selected, "class='selectpicker form-control' id='project' data-live-search='true'"); 
                        ?>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <label>Type</label>
            <?php 
                $type_selected = '';
                  if(isset($search_session_array['meetingType']))
                  {
                	$type_selected = $search_session_array['meetingType'];
                  }
                  echo form_dropdown('type[]', $mom_type, $type_selected, "class='selectpicker form-control' id='meetingType' data-live-search='true' multiple"); 
                  ?>
        </div>
        <div class="col-xs-3">
            <label>Attendees</label>
            <?php 
                $attendees_selected = '';
                if(isset($search_session_array['attendees']))
                {
                $attendees_selected = explode(",",$search_session_array['attendees']);
                }
                echo form_dropdown('attendees[]', $all_type_users, $attendees_selected, "class='selectpicker form-control' id='attendees' data-live-search='true' multiple"); 
                ?> 
        </div>
    </div>
    <div class="row five-col">
        <div class="col-xs-3">
            <label>Conducted By</label>
            <?php 
                $conducted_by_selected = '';
                if(isset($mom_data['conducted_by']))
                {
                $conducted_by_selected = $mom_data['conducted_by'];
                }
                array_unshift($all_type_users,"Nothing Selected");
                echo form_dropdown('conducted_by', $all_type_users, $conducted_by_selected, "class='selectpicker form-control' id='conducted_by' data-live-search='true'"); 
                ?> 
        </div>
        <div class="col-xs-3">
            <label>Status</label>
            <div class="col-xs-12">
                <div class="form-group">
                    <?php 
                        $status_selected = '';
                         if(isset($search_session_array['status']))
                         {
                        $status_selected = $search_session_array['status'];
                         }
                        echo form_dropdown('status', $mom_status,$status_selected, "class='selectpicker form-control' id='status' data-live-search='true'"); 
                        ?>    
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <label>Tags</label>
            <?php 
                $tags_selected = '';
                 if(isset($search_session_array['tagType']))
                 {
                $tags_selected = explode(",",$search_session_array['tagType']);
                 }
                 echo form_dropdown('tags[]', $mom_tags, $tags_selected, "class='selectpicker form-control' id='tagType' data-live-search='true' multiple"); 
                 ?>
        </div>
    </div>
    <div class="row text-center">
        <button type="submit" class="btn  btn-secondary" id="update_result" name="update_result">Update Results</button>
        <button type="submit" class="btn btn-default btn-primary" id="mom_search_reset" >Reset</button>
        <button type="submit" class="btn btn-default btn-primary" id="save_filter">Save Filter</button>
        <?php if($apply_filter == TRUE){ ?>
        <button class="btn btn-default btn-primary" type="button" id="apply_save_filter">Apply Saved Filter</button>
        <?php }else { ?>
        <button class="btn btn-default btn-primary" type="button" id="apply_save_filter" style="display:none;">Apply Saved Filter</button>
        <?php } ?>
        <input type="hidden" value="export" id="fetch_type" name="fetch_type" />
    </div>
</form>
<!-- /Check List Modal -->
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'icheck.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script> 
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo isset($search_session_array['iDisplayLength'])?$search_session_array['iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>';
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>';        
    this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
    this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
    this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
    this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
    this.list_page   = 'yes';     
    
</script>
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'mom.js';?>"></script>
