<?php //echo '<pre>';print_r($result_data);exit; ?>
<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?> 
      <li class="active">Workday Exception</li>
   </ol>
</div>
<form id="save_workday_exception" class="form-horizontal" method="post" name="save_workday_exception">
<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
		<?php
		if(isset($this->user_role_access[strtolower('schedules')][strtolower('Edit Exception')]) && $this->user_role_access[strtolower('schedules')][strtolower('Edit Exception')] == 1 && $this->first_argument > 0)
		{
			if(isset($this->project_status_check) && $this->project_status_check == 1)
			{
		?>  
         <div class="pull-right"> 
		 <a href="#">
        <button type="button" class="btn btn-gray  pull-right m-left-1" id="workday_exception_cancel" name="workday_exception_cancel"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
        </a> <a href="#" >
        <button type="submit" class="btn btn-blue  pull-right m-left-1" id="workday_exception_save_and_back"  name="workday_exception_save_and_back" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
        </a> <a href="#">
        <button type="submit" class="btn btn-blue pull-right m-left-1" name="workday_exception_save_and_stay" id="workday_exception_save_and_stay"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
        </a> <a href="#">
        <button type="submit" class="btn btn-blue  pull-right m-left-1" id="workday_exception_save_and_new" name="workday_exception_save_and_new" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
        </a></div>
		<?php 
			}
		}
		else if((isset($this->user_role_access[strtolower('schedules')][strtolower('Add Exception')]) && $this->user_role_access[strtolower('schedules')][strtolower('Add Exception')] == 1) && $this->first_argument == 0)
		{ 
		?>
		<div class="pull-right"> 
		 <a href="#">
        <button type="button" class="btn btn-gray  pull-right m-left-1" id="workday_exception_cancel" name="workday_exception_cancel"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_cancel_new"/> Cancel</button>
        </a> <a href="#" >
        <button type="submit" class="btn btn-blue  pull-right m-left-1" id="workday_exception_save_and_back"  name="workday_exception_save_and_back" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_back"/> Save &amp; Back </button>
        </a> <a href="#">
        <button type="submit" class="btn btn-blue pull-right m-left-1" name="workday_exception_save_and_stay" id="workday_exception_save_and_stay"> <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_stay"/> Save &amp; Stay</button>
        </a> <a href="#">
        <button type="submit" class="btn btn-blue  pull-right m-left-1" id="workday_exception_save_and_new" name="workday_exception_save_and_new" > <img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_save_and_new"/> Save &amp; New</button>
        </a></div>
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
<div class="row <?php if($this->project_id == '' && !isset($result_data['project_id'])){ echo 'no_project_selected'; } ?>">
	<input type="hidden" name="ub_workday_exception_id" id="ub_workday_exception_id" value="<?php if(isset($result_data['ub_workday_exception_id'])) echo $result_data['ub_workday_exception_id'];?>">
   <div class="col-xs-3">
      <label>Title</label>
	  <div class="col-xs-12">
		  <div class="form-group">
			  <input type="text" class="form-control" id="title" name="title" maxlength="128" value="<?php echo isset($result_data['title'])?$result_data['title']:'' ?>" />
			   <input type="hidden" class="form-control" id="offdays" name="offdays" value=",1,2,3,"/>
		  </div>
	  </div>
   </div>
   <div class="col-xs-3">
      <label>Category</label>
      <div class="col-xs">
         <?php 
			$category_selected = '';
			if(isset($result_data['category']))
			{
				// $category_selected = $result_data['category'];
				$category_selected = explode(",",$result_data['category']);
			}
			echo form_dropdown('category[]', $get_work_day_exception_list_result,$category_selected, "class='selectpicker form-control2' id='category' data-live-search='true' multiple");
		?>    
         <span class="right-group input-group-addon"><a href="javascript:void(0);" data-target="#CategoryAddModal" data-toggle="modal"><img alt="plus" src="<?php echo IMAGESRC.'icon_plus1_1.png'; ?>" border="0"/></a>
		 <a href="javascript:void(0);" class="CategoryEditModal"><img alt="minus" src="<?php echo IMAGESRC.'icon_minus1_1.png'; ?>" border="0"/></a></span> 
      </div>
   </div>
    <div class="col-xs-3">
      <label>Starts</label>
	  <div class="col-xs-12">
		  <div class="form-group">
			  <div class='input-group date' id='datetimepicker5'>
				 <input type='text' class="form-control" id="start_date" name="start_date" readonly value="<?php echo isset($result_data['start_date'])?date("m/d/Y", strtotime($result_data['start_date'])):'' ?>" />
				 <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
			  </div>
		  </div>
	   </div>
   </div>
   <div class="col-xs-3">
      <label>Ends</label>
      <div class='input-group date' id='datetimepicker6'>
         <input type='text' class="form-control" id="end_date" name="end_date" readonly value="<?php echo isset($result_data['end_date'])?date("m/d/Y", strtotime($result_data['end_date'])):'' ?>" />
         <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
      </div>
   </div>
</div>
<?php //echo $result_data['exception_type'];exit; ?>
<div class="row m-top">  
   <div class="col-xs-3">
      <label>Type</label>
      <select class="form-control selectpicker" id="type" name="type">
         <option value="">Nothing selected</option>
		 
		<option value="-1" <?php if(isset($result_data['exception_type'])&& $result_data['exception_type'] == -1){ ?>  selected <?php } ?>>Non Workday</option>
		<option value="1" <?php if(isset($result_data['exception_type'])&& $result_data['exception_type'] == 1){ ?> selected <?php } ?>>Extra Workday</option>
      </select>
   </div>
   <div class="col-xs-3">
      <p>&nbsp;</p>
      <p>Repeats Every Year <input type="checkbox" id="repeat_year" name="repeat_year" <?php if(isset($result_data['same_every_year']) && $result_data['same_every_year']==='Yes') echo  "checked='checked'"; ?>></p>
   </div>
   <!-- Below check box was added by chandru  -->
    <div class="col-xs-3">
      <p>&nbsp;</p>
      <p>Save For All Project <input type="checkbox" id="save_for_all_project" name="save_for_all_project" <?php if(isset($result_data['project_id']) && $result_data['project_id'] == 0) { ?> disabled="disabled" <?php echo  "checked='checked'"; } ?>></p>
   </div>
</div>
<div class="row m-top">   
   <div class="col-xs-12 m-top">
      <label>Notes</label>
      <textarea class="form-control" id="notes" name="notes"><?php echo isset($result_data['notes'])?$result_data['notes']:'' ?></textarea>
   </div>
   <input type="hidden" id="save_type" name="save_type" />
</div>
</form>
<!-- Category Add Modal -->
<div class="modal fade" id="CategoryAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <h4>New Category Group
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
                                 <td><input type="text" id="category_save" class="form-control" /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
								  <a class="sprite pull-right" href="javascript:void(0);" id="category_saveing">
		                           <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt=" Save" class="save"> Save
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
<div class="modal fade" id="CategoryEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 <td><input type="text" id="Edit_category_group" class="form-control" /><input type="hidden" id="selected" class="form-control"  /></td>
                              </tr>
                              <tr>
                                 <td height="20" colspan="2">
                                    <button type="button" id="Delete_category" class="btn btn-default btn-secondary pull-right">Delete</button>					 
                                    <button type="button" id="Edit_category" class="btn btn-default btn-secondary pull-right" >Save</button>
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
<!-- /Category Add Modal -->
<link rel="stylesheet" href="<?php echo CSSSRC.'bootstrap-datetimepicker.min.css';?>">
<script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script>
<script src="<?php echo JSSRC.'schedules_workday.js';?>"></script>