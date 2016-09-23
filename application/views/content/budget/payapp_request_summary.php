<div class="col-xs-12">
   <div class="row datatable-bor">
      <div class="add-function">
         <div class="col-xs-3 pull-left">
            <a href="javascript:void(0);" id="pay_app_list_prev" class="pull-left"><button class="sprite">Prev</button></a>
         </div>
        <div class="col-xs-1 pull-right"> <!--<a href="javascript:void(0);"><img src="<?php echo IMAGESRC.'icon_excel1_1.png'; ?>"></a><a data-target="#ChecklistModal" data-toggle="modal" href="javascript:void(0);"><img src="<?php echo IMAGESRC.'icon_settings1_1.png'; ?>"></a>--></div>
		<div class="pull-right" id="payapp_status" >	
		<?php 
		$this->load->view('content/budget/payapp_status'); 
		 ?>
		 </div>
      </div>
   </div>
   <table class="table table-bordered datatable" id="budget_pay_app_list_details">		
    <thead>
      <tr>
		 <th>Type</th>
		 <!--<th>Item No</th>-->
         <th>Cost Code</th>
         <th>Budgeted Value</th>
         <th>Scheduled Value</th>
         <th>From Prev App</th>
         <th>This Period</th>
         <th>Value of Materials Stored(Not in work completed)</th>
         <th>Total Completed and stored till date</th>
         <th>% of work done</th>
         <th>Balance to be finished</th>
         <th>Retainage %</th>
         <th>Retainage amount</th>
      </tr>
   </thead>
   <tbody>
   </tbody>
   </table>
</div>
