<script>   
   this.data_table   = '<?php echo $data_table; ?>';
   this.photos_docs_list	 = '<?php echo $photos_docs_list; ?>'; 
        
</script>
<div class="row">
	<ol class="breadcrumb">
	   <?php $this->load->view('common/breadcrumbs'); ?> 
	   <li class="active">Photos&amp;Docs</li>
	</ol>
</div>
<div class="row">
   <div class="col-xs-12">     
	 <div class="top-search pull-right">
      <div class="btn-group pull-right">
        <button type="button" class="btn btn-secondary btn-sm btn-flat dropdown-toggle" data-toggle="dropdown"> New <span class="caret"></span> </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Import Album</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url(); ?>photosdocs/newalbums">New Album</a></li>
		  <li class="divider"></li>
		  <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Import Folder</a></li>
		  <li class="divider"></li>
		  <li><a href="<?php echo base_url(); ?>photosdocs/newfolder">New Folder</a></li>
        </ul>
      </div>
    </div>
      </div>
 </div>
   
<div class="row">
	<br><div class="col-xs-12 pull-left">
		<table class="table table-bordered datatable" id="Photos_docs_List" width="100%">
			<thead>
				<tr>					
					<th><input type="checkbox"></th>
					<th>Album Name</th>
					<th>Viewable By</th>
					<th>Contains</th>							   
					<th>Size</th>							   
					<th>Photos</td> 
					<th>Last Updated</th>							   
					<th>Actions</th>							   
				</tr>
			</thead>
			<tbody>
			</tbody>
		
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Import Folder From Template</h4>
      </div>
      <div class="modal-body">
        <label>Source Template</label>
        <p>
          <select class="selectpicker form-control">
            <option>Choose from template</option>
          </select>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Import Folders</button>
      </div>
    </div>
  </div>
</div>