<div class="row">
   <ol class="breadcrumb">
      <?php $this->load->view('template/common/breadcrumbs'); ?>
      <li class="active">Template</li>
   </ol>
</div>

<div class="row">
   <div class="col-xs-12">
      <div class="top-search pull-right">
        <div class="pull-right ">			
			<a href="<?php echo base_url().$this->crypt->encrypt('template/projects/save_templates'); ?>">
			<button class="btn btn-blue pull-right" type="button">
				<img border="0" class="uni_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> New Template
			</button></a>			
        </div>
      </div>
    </div>
</div>
<div class="row m-top">
   <div class="col-xs-12 pull-left">
      <table class="table table-bordered datatable" id="Template_List" width="100%">
         <thead>
            <tr>
               
               <th>Template Name</th>
               <th>Template Created By</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
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
<script type="text/javascript" src="<?php echo JSSRC.'ub-template-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo TEMPSRC.'template.js';?>"></script>