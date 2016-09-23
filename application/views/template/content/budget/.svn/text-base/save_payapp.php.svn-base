<div class="col-xs-12">
	<?php 
	if(isset($this->user_role_access[strtolower('budget')][strtolower('add')]) && $this->user_role_access[strtolower('budget')][strtolower('add')] == 1)
	{
		if(isset($this->project_status) && $this->project_status != 'Closed' && $this->project_status != 'Disabled')
		{
	?>
      <a href="javascript:void(0);" id="new_payapp"><button type="button" class="
         sprite pull-right"> <img border="0" src="<?php echo IMAGESRC.'strip.gif'; ?>" alt="New" class="plus"> New Payapp</button></a>
	<?php 
		}
	}
	?>	
</div>
<form id="save_payapp" class="form-horizontal" method="post" name="save_payapp"> 
<input type="hidden" name="ub_payapp_id" id="ub_payapp_id" 
	  value="<?php echo isset($result_data['ub_payapp_id'])?$result_data['ub_payapp_id']:0; ?>" />  
   <div class="col-xs-12">
      <div class="col-xs-12 box-content new_payapp_con m-top">        
         <div class="col-xs-3">	
            <label>Pay App Name</label>
			<div class="col-xs-12">
				<div class="form-group">
					<input maxlength="75" name="payapp_name" id="payapp_name" type="text" class="form-control" value="<?php echo isset($result_data['name'])?$result_data['name']:''; ?>" />
				</div>
			</div>
         </div>
         <div class="col-xs-2">	
            <label>Period To</label>
			<div class="col-xs-12">
				<div class="form-group">
					<div class='input-group date' id='datetimepicker4'>
						<input type="text" class="form-control" id="period_to" name="period_to" value="<?php echo isset($result_data['period_to'])?$result_data['period_to']:''; ?>">
						<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> 
					</div>
				</div>         
			</div>         
         </div>         
         <div class="row m-top">
            <div class="col-xs-12 text-center">
               <button id="btn_save_payapp" name="btn_save_payapp" type="submit" class="btn btn-blue">
			   <img border="0" class="uni_save_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Save</button>
               <!--<button type="button" class="btn  btn-secondary">Save &amp; New</button>-->
			   <?php 
			  /*  if(isset($result_data['ub_payapp_id']) && $result_data['ub_payapp_id'] > 0)
			   { ?>
			   <button type="submit" class="btn  btn-secondary" name="del_payapp" id="del_payapp">Delete</button>
			   <?php 
			   }  */?>
			   
               <a href="javascript:void(0);" id="close_payapp">
			   <button type="button" class="btn btn-gray">
			   <img border="0" class="uni_cancel_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Cancel</button>
			   </a>
            </div>
         </div>
      </div>
   </div>
    <input type="hidden" id="save_type" name="save_type" value=""/>
   </form>
   <script type="text/javascript" src="<?php echo JSSRC.'bootstrap-datetimepicker.min.js';?>"></script> 
   <script>
   $(function(){
	$('#datetimepicker4').datetimepicker({pickTime: false});
   });
   </script>