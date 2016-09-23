<script>   
   this.data_table = '<?php echo $data_table; ?>';   
   this.budget_project_list = '<?php echo $budget_project_list; ?>'; 
</script>
<div class="row">
  <ol class="breadcrumb">
    <?php //$this->load->view('common/breadcrumbs'); ?> 
    <!--<li>Budget</li>
    <li class="active">All Projects</li>-->
  </ol>
</div>
<form id="Search_Result" name="Search_Result" method="post">
<?php $this->load->view('content/budget/project_summary'); ?>
<!--<div class="row">
	<div class="col-xs-12">
		<div class="row datatable-bor">
      <div class="add-function">
        <div class="col-xs-3 pull-left">
          <select class="selectpicker form-control">
            <option value="">Nothing selected</option>
            <option>Bulk Actions</option>
            <option>Delete Checked</option>
          </select>
        </div>
        <div class="col-xs-3 pull-right"><a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'icon_excel1_1.png'; ?>"></a><a data-target="#ChecklistModal" data-toggle="modal" href="javascript:void(0);"><img src="<?php echo IMAGESRC.'icon_settings1_1.png'; ?>"></a></div>
      </div>
    </div>
		<table class="table table-bordered datatable" id="budget_projects_view">			
		</table>
	</div>
</div>
<!-- Check List Modal -->
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
                      <td><select class="selectpicker form-control">
                          <option>Standard View</option>
                        </select></td>
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
                      <td><select class="selectpicker form-control">
                          <option>All Items Selected</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td height="30">View Name</td>
                      <td><input type='text' class="form-control" placeholder="Standard View234" /></td>
                    </tr>
                    <tr>
                      <td>Is Default</td>
                      <td><input type="checkbox" />
                        Is Default</td>
                    </tr>
                    <tr>
                      <td class="text-center" colspan="2"><button class="btn btn-default btn-primary" type="button">APPLY VIEW</button>
                        <button class="btn btn-default btn-primary" type="button">SAVE AS VIEW</button>
                        <button class="btn btn-default btn-primary" type="button">UPDATE SELECTED</button></td>
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
</form>
<!-- /Check List Modal -->
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
<script src="<?php echo JSSRC.'budget.js';?>"></script>