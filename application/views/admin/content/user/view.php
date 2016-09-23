<!-- inner content wrapper -->

<div class="wrapper">
  <div class="row">
    <ol class="breadcrumb">
      <li> <a href="javascript:;">Home</a> </li>
      <li class="active">View User</li>
    </ol>
  </div>
  
  <!-- Top Button -->
  <div class="row mb20 text-right"> <a href="YWRtaW4vdXNlci9hZgxf1R1c2Vy">
    <button class="btn btn-primary" type="button">Add User</button>
    </a> </div>
  <!-- /Top Button --> 
  
  
  
 <div class="row">
    <section class="main-content">
      <div class="content-wrap">
        <section class="panel">
          <table class="table table-bordered table-striped mg-t datatable"  id="user_list">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email Address Name</th>
                <th>Phne No</th>
                <th>Status</th>
              </tr>
            </thead>
		    <tbody>
           </tbody>
          </table>
        </section>
      </div>
    </section>
  </div>
  
</div>
<!-- /inner content wrapper --> 

<!-- page level plugin styles -->
<link rel="stylesheet" href="<?php echo ACJI.'scripts/plugins/chosen/chosen.min.css';?>">
<link rel="stylesheet" href="<?php echo ACJI.'scripts/plugins/datatables/jquery.dataTables.css';?>">
<!-- /page level plugin styles --> 

<!-- page level scripts --> 
<script src="<?php echo ACJI.'scripts/plugins/chosen/chosen.jquery.min.js';?>"></script> 
<script src="<?php echo ACJI.'scripts/plugins/datatables/jquery.dataTables.js';?>"></script> 
<!-- /page level scripts --> 
<!-- page script --> 
<script src="<?php echo ACJI.'scripts/js/bootstrap-datatables.js';?>"></script> 
<script type="text/javascript" src="<?php echo JSSRC.'ub-admin-datatable.js';?>"></script>
<script src="<?php echo ACJI.'scripts/js/user_list.js';?>"></script> 
<script type="text/javascript">        
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>';   
   this.displayStart   = '<?php echo isset($search_session_array['iDisplayStart'])?$search_session_array['iDisplayStart']:0; ?>';  
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';   
   
</script>


<!-- /page script --> 
