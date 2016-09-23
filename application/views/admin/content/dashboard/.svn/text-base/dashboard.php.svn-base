<!-- inner content wrapper -->
<?php
//echo "<pre>"; print_r($response_plan); exit;
?>
<div class="wrapper">
  <div class="row">
    <ol class="breadcrumb">
      <li> <a href="javascript:;">Home</a> </li>
      <li class="active">Dashboard</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-5">
      <section class="panel panel-primary  post-comments">
        <div class="panel-heading"> Last 10 Builders Signup <a class="widget-refresh" href="javascript:void(0);"><i class="ti-reload pull-right"></i></a></div>
        <div class="media p15">
          <table class="table table-bordered table-striped no-m">
            <thead>
              <tr>
                <th>Company</th>
                <th>Signup Date</th>
                <th>City</th>
                <th>Plan</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  if(!empty($response))
			  {
			  foreach ($response as $builderdetails)
			  {
			  ?>
			  <tr>
			  <td><?php echo $builderdetails['builder_name'] ; ?></td>
			  <td><?php echo $builderdetails['created_on'] ; ?></td>
			  <td><?php echo $builderdetails['city'] ; ?></td>
			  <td><?php echo $builderdetails['plan_name'] ; ?></td>
			  </tr>
			  <?php
			  } 
			  }
			  ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <div class="col-md-12 col-lg-7">
      <section class="panel">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 mb25">
              <h5><b>Signup</b> - Trend</h5>
              
              
              <div id="line-chart" class="chart"></div>
              
                           
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6">
      <section class="panel panel-primary  post-comments">
        <div class="panel-heading"> Last 10 Payments <a class="widget-refresh" href="javascript:void(0);"><i class="ti-reload pull-right"></i></a></div>
        <div class="media p15">
          <table class="table table-bordered table-striped no-m" id="payment_list" name="payment_list" >
            <thead>
              <tr>
                <th>Company</th>
                <th>Plan</th>
                <th>Amount</th>
                <th> Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php
			 foreach($response_payment as $payment)
			 {
			 ?>
			 <tr>
			 <td>
			 <?php echo $payment['builder_name'] ;  ?>
			 </td>
			  <td>
			 <?php echo $payment['plan_name'] ;  ?>
			 </td>
			  <td>
			 <?php if(isset($payment['amount'])){ echo '$'.$payment['amount'] ; } ?>
			 </td> 
			 <td>
			 <?php echo $payment['payment_date'] ;  ?>
			 </td>
			 <?php if($payment['payment_status'] == 'Success'){ ?>
			 <td class="text-success">
			 <?php } else {?>
			  <td class="text-danger">
			 <?php } 
               echo $payment['payment_status'] ;  ?>
			 </td>
			 </tr>
			 <?php
			 }
			 ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <div class="col-lg-6">
      <section class="panel panel-primary  post-comments">
        <div class="panel-heading"> Plan Changes <a class="widget-refresh" href="javascript:;"><i class="ti-reload pull-right"></i></a></div>
        <div class="media p15">
          <table class="table table-bordered table-striped no-m">
            <thead>
              <tr>
                <th> Company</th>
                <th> Old Plan</th>
                <th> New Plan</th>
                <th> Effective From</th>
              </tr>
            </thead>
            <tbody>
             <?php
			 foreach($response_plan as $plan)
			 {
			 ?>
			 <tr>
			 <td>
			 <?php echo $plan['builder_name'] ;  ?>
			 </td>
			  <td>
			 <?php echo $plan['oldplan'] ;  ?>
			 </td>
			  <td>
			 <?php echo $plan['newplan'] ;  ?>
			 </td> 
			 <td>
			 <?php echo $plan['created_on'] ;  ?>
			 </td>
			 </tr>
			 <?php
			 }
			 ?>
			 
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- /inner content wrapper --> 

<!-- page level scripts --> 
<script src="<?php echo ACJI.'scripts/plugins/flot/jquery.flot.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/flot/jquery.flot.time.js';?>"></script> 
<!-- /page level scripts --> 
<!-- page script --> 
<script src="<?php echo ACJI.'scripts/js/chart.js';?>"></script> 
<!-- /page script --> 
<script>
$('.widget-refresh').click(function(e) {
location.reload(); 
});
</script>

