<script type="text/javascript" src="<?php echo JSSRC.'lightbox-plus-jquery.min.js';?>"></script>
<div class="row">
  <ol class="breadcrumb">
  </ol>
</div>
<div class="row">
  <div class="col-xs-12 ">    			
    <div class="pull-left inner">
      <ol class="breadcrumb">
        <!--<li><a href="<?php echo base_url();?>agxf19tZS9pbmRleC8-">Home</a></li>-->
         <?php
          $breadcrumb_count = count($breadcrum_value);
          for ($i=0; $i < $breadcrumb_count ; $i++) 
            { ?>
          <li <?php if ($i == $breadcrumb_count) { echo 'class="active"';}?>><a href="<?php echo base_url().$breadcrum_value[$i]['link'];?>"><?php echo $breadcrum_value[$i]['name'];?></a></li>
        <?php      }
        ?>
      </ol>
    </div>
	<?php 
	if (isset($photo_folder_id) && $photo_folder_id == 0) 
	{
		if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
		{
	?>
        <!--<a class="btn btn-blue  pull-right" href="javascript:void(0);" data-target="#TypeNewFolderModal" data-toggle="modal">
          <img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>"> New Album</a>-->
	<?php 
		}
	}
	else
	{
	?>
		<a id="back_to_folder" href="javascript:void(0);" class="btn btn-blue pull-right m-left-1"><img class="uni_reset" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Back to Album</a>
		<?php 
		if(isset($this->user_account_type) && $this->user_account_type == BUILDERADMIN)
		{
		?>
		<button type="button" data-toggle="modal" data-target="#UploadModal" class="btn btn-blue pull-right m-left-1">Upload Image(s)</button> 		
		<a class="btn btn-blue  pull-right" href="javascript:void(0);" data-target="#TypeNewFolderModal" data-toggle="modal">
		<img class="uni_new" src="<?php echo IMAGESRC.'strip.gif'; ?>"> New Album</a>
		<?php 
		}
		?>
    <?php
	}
    ?>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 pull-left m-top">
    <div class="row datatable-bor">
      <div class="add-function">
        <!--<div class="col-xs-3 pull-left">
          <select class="selectpicker form-control">
            <option value="">Nothing selected</option>
            <option>Bulk Actions</option>
            <option>Download Docs</option>
          </select>
        </div>-->
        <?php 
      if (isset($photo_folder_id) && $photo_folder_id > 0) 
      { ?>
       <!-- <div class="col-xs-3 pull-right"><a href="javascript:void(0);" id="zip_download"><img class="uni_zip_download" src="<?php echo IMAGESRC.'strip.gif'; ?>"></a></div>-->
      <?php } ?>
      </div>
    </div>
    <table class="table table-bordered datatable" id="Photos" width="100%">
      <thead>
        <tr>
          <th>Name</th>
          <th>Viewable By</th>
          <th>Photos</th>
          <th>Actions</th>
          <th>Last Updated</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<input type="hidden" name="folder_id" id="folder_id" value="<?php if(isset($folder_id)){ echo $folder_id;} ?>">
<input type="hidden" name="project_id" id="project_id" value="<?php if(isset($project_id)){ echo $project_id;} ?>">
<!-- Import Modal -->
<div class="modal fade" id="ImportAlbum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Import Album
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
                      <td height="20" colspan="2">Choose Album</td>
                    </tr>
                    <tr>
                      <td colspan="2"><select class="selectpicker form-control">
                          <option>Choose from Album</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td height="20" colspan="2"><button type="button" data-dismiss="modal" class="btn btn-default btn-primary pull-right">cancel</button>
                        <button type="button" class="btn btn-default btn-secondary pull-right">Import Folders</button></td>
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
<!-- Type New Folder Modal -->
<div class="modal fade" id="TypeNewFolderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Create a New Album
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
	  <div class="row m-top">
			<div class="col-xs-12 error-message uni_message">
				<div class="alerts alert-danger"></div>
			</div>
		</div>
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">
              <div class="row">
                <div class="col-xs-12">
                  <form id="add_album" class="form-horizontal" method="post" name="add_album">
                  <table width="100%" class="table border-none">
                    <tr>
                      <td height="20" colspan="2">Enter Album Name</td>
                    </tr>
                    <tr>
                      <td colspan="2">
						<div class="col-xs-12">
							<div class="form-group">
								<input type="text" class="form-control" id="album_name" name="album_name" />
							</div>
						</div>
					  </td>
                    </tr>
                    <tr>
                      <td height="20" colspan="2">          							
						<button type="submit" id="create_album" class="btn btn-blue pull-left">
						<img border="0" class="uni_save_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Save
						</button>									
						<button type="button" class="btn btn-gray closing_back" data-dismiss="modal">
						<img border="0" class="uni_cancel_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Cancel
						</button>
          			</td>	
                    </tr>
                  </table>
                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Check List Modal -->
<div class="modal fade" id="PhotosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!-- Upload Modal -->
<div class="modal fade" id="UploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Upload Image(s)
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
        <div class="modal-con-upload">
          <?php $this->load->view('content/photos/upload.php');?>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-xs-12">
            <button type="button" data-dismiss="modal" class="btn btn-gray "> 
				<img border="0" class="uni_cancel_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Close 
			</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Check List Modal -->
<!-- Edit_Album_Modal Modal -->
<div class="modal fade" id="Edit_Album_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Edit Photos Folder
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <!--<div class="modal-con">
              <div class="row">
                <div class="col-xs-12">
                  <ol class="breadcrumb">
                    <li>Main</li>
                    <li>Test Folder</li>
                    <li>Check Folder</li>
                  </ol>
                </div>
              </div>
            </div>-->
            <div class="modal-con">
              <div class="row">
                <div class="col-xs-12">
                  <div class="row m-top">
                    <div class="col-xs-12 error-message uni_message">
                       <div class="alerts alert-danger"></div>
                     </div>
                  </div>
                  <form id="update_folder_permission" class="form-horizontal" method="post" name="update_folder_permission">
                    
                    <table width="100%" class="table border-none">
                      <tr>
                        <td height="20" class="text-danger">Name :</td>
                        <td>
                          <input type="text" name="folder_name" id="change_folder_name" class="form-control" placeholder="Check Folder" <?php if(isset($project_id) && $project_id == 0){ echo 'readonly="readonly"'; }?> />
                          <input type="hidden" name="folderid" id="folderid" />
                          <input type="hidden" name="fileid" id="fileid" />
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4"><hr/></td>
                      </tr>
                      <tr>
                        <td colspan="2">Permissions</td><td colspan="2" class="display_for_file">Sub List</td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="checkbox" name="sub" id="sub_per"  value="No" />
                          Show Subs</td>
                          <td colspan="2" class="display_for_file col-xs-4">
                           <div class="col-xs-12">
                              <div class="form-group">
                                <?php 
                                   $subcontractor_selected = '';
                                      /*if(isset($search_session_array['sales_person']))
                                      {
                                      $subcontractor_selected = $search_session_array['sales_person'];
                                      }*/
                                    echo form_dropdown('allowed_users[]', $subcontractor,$subcontractor_selected, "class='selectpicker form-control' id='allowed_users' data-live-search='true' multiple"); 
                                ?>
                              </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"><input type="checkbox" name="owner" id="owner_per" value="No"/>
                          Show Owner</td>
                      </tr>
                      <tr>
                        <td colspan="4"><hr/></td>
                      </tr>
                      <tr>
                        <td height="20" colspan="4" class="text-center">
                          <button type="button" id="update_folder" class="btn btn-blue">
            						    <img border="0" class="uni_save_new" alt="" src="<?php echo IMAGESRC.'strip.gif'; ?>"> Save
            						  </button>
                        </td>
                      </tr>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="albumModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Album
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </h4>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="modal-con1"> <img alt="home" id="album-img" src="<?php echo IMAGESRC.'logs-lightbox.png'; ?>" border="0"/> </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-xs-12">
            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Close </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade confirmModal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h4>Are you sure you want to delete?       
      </h4>
      <div class="modal-body">
        <div class="row m-top">
          <div class="col-xs-12">
            <div class="modal-con">              
              <div class="row col-xs-12">                				
				<button class="btn btn-gray m-left-1 pull-right" type="button" data-dismiss="modal"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="cancel_icon"/> CANCEL</button>  
				<button class="btn btn-blue m-left-1 pull-right" type="button" id="delete_confirm"><img src="<?php echo IMAGESRC.'strip.gif'; ?>" class="uni_dick"/> OK</button>				
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
<script type="text/javascript">   
   this.folder_id   = '<?php if(isset($folder_id)){ echo $folder_id;} ?>'; 
   this.account_type   = '<?php if(isset($this->user_account_type)){ echo $this->user_account_type;} ?>';
   this.default_file_path   = '<?php echo DOC_URL; ?>';      
   this.default_pagination_length   = '<?php echo DEFAULT_PAGINATION_LENGTH; ?>'; 
   this.displayStart   = '<?php echo 0 ?>';    
   this.pagination_length_one   = '<?php echo PAGINATION_LENGTH_ONE; ?>';     
   this.pagination_length_two   = '<?php echo PAGINATION_LENGTH_TWO; ?>';     
   this.pagination_length_three   = '<?php echo PAGINATION_LENGTH_THREE; ?>';     
   this.pagination_length_four   = '<?php echo PAGINATION_LENGTH_FOUR; ?>';     
   this.list_page   = 'yes';     
</script>
<link rel="stylesheet" href="<?php echo CSSSRC.'lightbox.css';?>">	
<script type="text/javascript" src="<?php echo JSSRC.'jquery.dataTables.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'dataTables.bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'ub-datatable.js';?>"></script>
<script type="text/javascript" src="<?php echo JSSRC.'photos.js';?>"></script>
<script src="<?php echo JSSRC.'fileupload/photoes.js' ?>"></script>
