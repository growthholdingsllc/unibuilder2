<script>   
   this.data_table   	    = '<?php echo $data_table; ?>';       
   this.date_all   	        = '<?php echo $date_all; ?>';           
   this.selection_list 	    = '<?php echo $selection_list; ?>';     
   this.selection_category 	= '<?php echo $selection_category; ?>';     
   this.selection_location 	= '<?php echo $selection_location; ?>';     
</script>

<div class="row">
  <ol class="breadcrumb">
    <?php $this->load->view('template/common/breadcrumbs'); ?>
    <li class="active">Selections</li>
  </ol>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="top-search pull-right">
		<!--checking role access // by satheesh kumar -->
		<?php
		if(isset($this->user_role_access[strtolower('selections')][strtolower('add')]) && $this->user_role_access[strtolower('selections')][strtolower('add')] == 1)
		{
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
		?>
      <div class="pull-right "> <a href="<?php echo base_url().$this->crypt->encrypt('template/selections/save_selection/'); ?>">
        <button type="button" class="btn btn-blue pull-right"><img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_new" /> New Selection </button>
        </a> </div>
		<?php 
			}
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
<div class="row m-top">
  <div class="col-xs-12">
  <form id="Search_Result" class="form-horizontal" method="post" name="Search_Result">
    <div class="panel-content pull-left">
      <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="filter">
            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> FILTER ALL YOUR RESULTS &nbsp;&nbsp; <span aria-hidden="true" class="glyphicon glyphicon-chevron-up"></span> </a> </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
            <div class="panel-body col-xs-12">
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
						   echo form_dropdown('status[]', $status_array, $status_selected, "class='selectpicker form-control' id='status' data-live-search='true'"); 
						 ?>
						</div>
					</div>
                </div>
                <div class="col-xs-3">
                  <label>Title</label>
                  <input type="text" class="form-control" id='title' value="<?php echo isset($search_session_array['title'])?$search_session_array['title']:''; ?>" />
                </div>
                <div class="col-xs-3">
                  <label>Location</label>
                  <?php 
				  $location_selected = '';
				   if(isset($search_session_array['location']))
				   {
						$location_selected = $search_session_array['location'];
				   }
				   echo form_dropdown('location[]',$locations_array,$location_selected, "class='selectpicker form-control' id='location' data-live-search='true' multiple"); 
				 ?>
                  </select>
                </div>
                <div class="col-xs-3">
                  <label>Categories</label>
                  <?php
				   $category_selected = '';
				   if(isset($search_session_array['category']))
				   {
						$category_selected = explode(",",$search_session_array['category']);
				   }
				   echo form_dropdown('category[]',$category_array,$category_selected, "class='selectpicker form-control' id='category' data-live-search='true' multiple"); 
				   ?>
                </div>
                
              </div>
			  <div class="row five-col">
			  <div class="col-xs-3">
                  <label>Date Range</label>
                  <div class="input-prepend input-group">
                    <input type="text" name="daterange" id="daterange" class="form-control" value="<?php echo isset($search_session_array['daterange'])?$search_session_array['daterange']:''; ?>" readonly />
                    <span class="input-group-addon"> <span class="glyphicon-calendar glyphicon daterange"></span></span> </div>
                </div>
                <div class="col-xs-4">
                  <label>&nbsp;</label>
                  <div>
                    <button type="submit" class="btn btn-blue" id="update_result" name="update_result">Update Results</button>
                    <button type="submit" class="btn btn-gray" id="selections_search_reset">Reset</button>
					<input type="hidden" value="export" id="fetch_type" name="fetch_type" />
                  </div>
                </div>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	</form>
    <div class="tab-con pull-left">
      <div role="tabpanel"> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"> <a href="#Category" aria-controls="Category" data-toggle="tab">Category</a> </li>
          <li role="presentation"> <a href="#Location" aria-controls="Location" data-toggle="tab">Location</a> </li>
          <li role="presentation"> <a href="#List" aria-controls="List" data-toggle="tab">List</a> </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="Category">
            <table class="table table-bordered datatable" id="Category_Selections" width="100%">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Category</th>
                  <th>Choices</th>
                  <th>Price</th>
                  <th>Remaining from Allowance</th>
                  <th>Deadline</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="Location">
            <table class="table table-bordered datatable" id="Category_Locations" width="100%">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>name</th>
                  <th>Category</th>
                  <th>Location</th>
                  <th>Choices</th>
                  <th>Price</th>
                  <th>Remaining from Allowance</th>
                  <th>Deadline</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="List">
            <table class="table table-bordered datatable" id="Selection_List" width="100%">
              <thead>
                <tr>
                  <th><input type="checkbox" id="selectall" name="all"/></th>
                  <th>Selection</th>
                  <th>Category</th>
                  <th>Location</th>
                  <th>Choices</th>
                  <th>Allow</th>
                  <th>Price</th>
                  <th>Diff +-</th>
                  <th>Deadline</th>
                  <th>Status</th>
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

<!-- /Check List Modal -->
<input type="hidden" id="selection_index" value="" />
<div id="pagination_area">

   <input type="hidden" value="<?php echo isset($search_session_array['categoty_iDisplayLength'])?$search_session_array['categoty_iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="categoty_iDisplayLength" />
   <input type="hidden" value="<?php echo isset($search_session_array['categoty_iDisplayStart'])?$search_session_array['categoty_iDisplayStart']:0; ?>" id="categoty_iDisplayStart" />

   <input type="hidden" value="<?php echo isset($search_session_array['location_iDisplayLength'])?$search_session_array['location_iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="location_iDisplayLength" />
   <input type="hidden" value="<?php echo isset($search_session_array['location_iDisplayStart'])?$search_session_array['location_iDisplayStart']:0; ?>" id="location_iDisplayStart" />

   <input type="hidden" value="<?php echo isset($search_session_array['list_iDisplayLength'])?$search_session_array['list_iDisplayLength']:DEFAULT_PAGINATION_LENGTH; ?>" id="list_iDisplayLength" />
   <input type="hidden" value="<?php echo isset($search_session_array['list_iDisplayStart'])?$search_session_array['list_iDisplayStart']:0; ?>" id="list_iDisplayStart" />


   
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
</script> 
<link rel="stylesheet" href="<?php echo CSSSRC.'daterangepicker-bs3.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'date_moment.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'daterangepicker.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script> 
<script type="text/javascript" src="<?php echo TEMPSRC.'selections.js';?>"></script> 