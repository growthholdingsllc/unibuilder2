<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/** 
 * Task Class
 * 
 * @package: Task
 * @subpackage: Task
 * @category: Task
 * @author: Chandru 
 * @createdon(DD-MM-YYYY): 11-04-2015 
 */
class Checklist extends UNI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('url');	
        $this->load->model(array(
            'Mod_checklist',
            'Mod_general_value',
            'Mod_timezone',
            'Mod_user',
            'Mod_saved_search',
            'Mod_doc'
        ));
        $this->module;
        $this->load->helper('export');
    }
    public function index()
    {
        $data                 = array(
            'title' => "Checklist",
            'content' => 'content/checklist/checklist',
            'page_id' => 'Checklist',
            'data_table' => 'data_table',
            'docs_list' => 'docs_list',
            'date_all' => 'date_all',
            'check_list_table' => 'check_list_table',
            'search_session_array' => $this->uni_session_get('SEARCH')
        );
        //Get all projects list from project table with the builder_id
        $project_list         = $this->Mod_checklist->get_projects(array(
            'select_fields' => array(
                'PROJECT.ub_project_id',
                'PROJECT.project_name'
            ),
            'where_clause' => array(
                'PROJECT.builder_id' => $this->builder_id
            )
        ));
        $data['project_list'] = array();
        if (TRUE === $project_list['status']) {
            $data['project_list'] = $this->Mod_checklist->build_ci_dropdown_array($project_list['aaData'], 'ub_project_id', 'project_name');
        }
        
        //Tags from general value table
        $args                    = array(
            'classification' => 'checklist_tags',
            'where_clause' => '("int01" = 0 OR "int01" = ' . $this->builder_id . ')',
            'type' => 'dropdown'
        );
        $checklist_tags_array    = $this->Mod_general_value->get_general_value($args);
        $data['check_list_tags'] = array();
        //echo '<pre>';print_r($checklist_tags_array);exit;
        if (isset($checklist_tags_array['values'])) {
            $data['check_list_tags'] = $checklist_tags_array['values'];
            
        }
        
        //category from general value table
        $args                  = array(
            'classification' => 'checklist_category',
            'where_clause' => '("int01" = 0 OR "int01" = ' . $this->builder_id . ')',
            'type' => 'dropdown'
        );
        $category_tags_array   = $this->Mod_general_value->get_general_value($args);
        $data['category_tags'] = array();
        //echo '<pre>';print_r($category_tags_array);exit;
        if (isset($category_tags_array['values'])) {
            $data['category_tags'] = $category_tags_array['values'];
            
        }
        //Apply filter code
        $post_array  = array(
            'builder_id' => $this->user_session['builder_id'],
            'user_id' => $this->user_session['ub_user_id'],
            'module_name' => $this->module
        );
        $result_data = $this->Mod_saved_search->get_saved_search(array(
            'select_fields' => array(),
            'where_clause' => $post_array
        ));
        
        if ($result_data['status'] == true) {
            $apply_filter = true;
        } else {
            //echo '<pre>';print_r($result_data);exit;
            $apply_filter = false;
            ;
        }
        
        $data['apply_filter'] = $apply_filter;
        $this->template->view($data);
        
    }
    // Encoded url : Y2hlY2tsaXN0L3NhdmVfY2hlY2tsaXN0Lw--
    public function save_checklist($ub_checklist_id = 0,$bid = '',$ub_bid_id=0)
    {
		$this->encrypt_key = 'XYZ!@#$%';
        $results = $this->sanitize_input();
        $data    = array(
            'title' => "Checklist",
            'content' => 'content/checklist/save_checklist',
            'page_id' => 'Checklist',
            'data_table' => 'data_table',
            'docs_list' => 'docs_list',
            'date_all' => 'date_all',
            'bid' => $bid,
            'ub_bid_id' => $ub_bid_id
        );
		//get project id from task table 
		if(empty($this->project_id) && $ub_checklist_id > 0)
		{
		$where_args = array('ub_checklist_id' => $ub_checklist_id);
		$project_id = $this->Mod_project->get_project_id(UB_CHECKLIST,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		//end code for get project id
		/* file upload code starts here */
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
			{
				$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
			}
		/*code to create the temp dir and pass it to view*/
		$dir_response = $this->Mod_doc->create_default_dir();
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
			$data['temprory_dir_id'] = '1';
		}
		 // echo '<pre>';print_r($data['temprory_dir_id']);exit;
		/* file upload code ends here */
        //Edit code
		if(isset($results['data']['ub_checklist_id']) && !empty($results['data']['ub_checklist_id']))
		{
			$results['data']['ub_checklist_id'] = $this->ci_decrypt($results['data']['ub_checklist_id'], $this->encrypt_key);
		}
        if ($ub_checklist_id > 0 || isset($results['data']['ub_checklist_id']) && $results['data']['ub_checklist_id'] > 0) {
		/*Code for update file */
			$this->ub_checklist_id = (isset($results['data']['ub_checklist_id'])) ? $results['data']['ub_checklist_id'] : $ub_checklist_id;
			$checklist_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->ub_checklist_id,
								);
			$result_array = $this->Mod_doc->get_files_for_folder($checklist_data);

			//echo "<pre>";print_r($result_array);exit;

			$count = count($result_array);

			$session_id = $this->session->userdata('session_id');
			
			for ($i=0; $i < $count ; $i++)
			{
				if(isset($result_array[$i]['system_file_name']) && !empty($result_array[$i]['system_file_name']))
				{
					$exp = explode('/', DOC_PATH.$result_array[$i]['system_file_name']);

					//$image_path = $result_array[$i]['system_file_name'];
					copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);
				}

			}

			
			/*End Code for edit file */
            
            if (!empty($this->input->post())) {
                //Sanitize input
                $results                     = $this->sanitize_input();
				if(isset($results['data']['ub_checklist_id']) && !empty($results['data']['ub_checklist_id']))
				{
					$results['data']['ub_checklist_id'] = $this->ci_decrypt($results['data']['ub_checklist_id'], $this->encrypt_key);
				}
                /* $tags                        = "" . implode(",", $results['data']['tags']) . "";
                $category                    = "" . implode(",", $results['data']['category']) . ""; */
				if(!empty($results['data']['tags']))
				{
					$tags = "".implode(",", $results['data']['tags'])."";
				}else{
					$tags = '';
				}
				if(!empty($results['data']['category']))
				{
					$category = "".implode(",", $results['data']['category'])."";
				}else{
					$category = '';
				}
                $checklist_update_main_array = array(
                    'description' => $results['data']['description'],
                    'project_id' => $results['data']['project_id'],
                    'tags' => $tags,
                    'title' => $results['data']['title'],
                    'category' => $category,
                    'modified_by' => $this->user_session['ub_user_id'],
                    'modified_on' => TODAY,
                    'ub_checklist_id' => $results['data']['ub_checklist_id']
                );
                $response                    = $this->Mod_checklist->update_checklist($checklist_update_main_array);
                $this->Mod_checklist->response($response);
            }
            
            else {
                // Get inserted data with help of id
                $result_data         = $this->Mod_checklist->get_check_list(array(
                    'select_fields' => array(
                        'UB_CHECKLIST.ub_checklist_id',
                        'UB_CHECKLIST.builder_id',
                        'UB_CHECKLIST.project_id',
                        'UB_CHECKLIST.title',
                        'UB_CHECKLIST.tags',
                        'UB_CHECKLIST.category',
                        'UB_CHECKLIST.description',
                        'UB_CHECKLIST.created_on',
                        'UB_CHECKLIST.created_by',
                        'UB_CHECKLIST.modified_on',
                        'PROJECT.project_name'
                    ),
                    'join' => array(
                        'builder' => 'Yes'
                    ),
                    'where_clause' => (array(
                        'ub_checklist_id' => $ub_checklist_id
                    ))
                ));
                //echo '<pre>';print_r($result_data);exit;
                $data['result_data'] = $result_data['aaData'][0];
            }
            
        } else {
            //Insert code
            if (!empty($this->input->post())) {
                //Add check list code
                $results                   = $this->sanitize_input();
				if(!empty($results['data']['tags']))
				{
					$tags = "".implode(",", $results['data']['tags'])."";
				}else{
					$tags = '';
				}
				if(!empty($results['data']['category']))
				{
					$category = "".implode(",", $results['data']['category'])."";
				}else{
					$category = '';
				}
                $insert_in_check_list_code = array(
                    'title' => $results['data']['title'],
                    'description' => $results['data']['description'],
                    'builder_id' => $this->user_session['builder_id'],
                    'project_id' => $results['data']['project_id'],
                    'tags' => $tags,
                    'category' => $category,
                    'created_by' => $this->user_session['ub_user_id'],
                    'created_on' => TODAY,
                    'modified_by' => $this->user_session['ub_user_id'],
                    'modified_on' => TODAY
                );
                $response                  = $this->Mod_checklist->add_check_list($insert_in_check_list_code);
                $this->Mod_checklist->response($response);
            }
        }
        //Listdropdown, add page code
        //Add page list project
        //Get all projects list from project table with the builder_id
        $project_list         = $this->Mod_checklist->get_projects(array(
            'select_fields' => array(
                'PROJECT.ub_project_id',
                'PROJECT.project_name'
            ),
            'where_clause' => array(
                'PROJECT.builder_id' => $this->builder_id
            )
        ));
        $data['project_list'] = array();
        if (TRUE === $project_list['status']) {
            $data['project_list'] = $this->Mod_checklist->build_ci_dropdown_array($project_list['aaData'], 'ub_project_id', 'project_name');
        }
        
        //Tags from general value table
        $args                    = array(
            'classification' => 'checklist_tags',
            'where_clause' => '("int01" = 0 OR "int01" = ' . $this->builder_id . ')',
            'type' => 'dropdown'
        );
        $checklist_tags_array    = $this->Mod_general_value->get_general_value($args);
        $data['check_list_tags'] = array();
        //echo '<pre>';print_r($checklist_tags_array);exit;
        if (isset($checklist_tags_array['values'])) {
            $data['check_list_tags'] = $checklist_tags_array['values'];
            
        }
        //category from general value table
        $args                  = array(
            'classification' => 'checklist_category',
            'where_clause' => '("int01" = 0 OR "int01" = ' . $this->builder_id . ')',
            'type' => 'dropdown'
        );
        $category_tags_array   = $this->Mod_general_value->get_general_value($args);
        $data['category_tags'] = array();
        //echo '<pre>';print_r($category_tags_array);exit;
        if (isset($category_tags_array['values'])) {
            $data['category_tags'] = $category_tags_array['values'];
            
        }
        $this->template->view($data);
        
    }
    public function get_checklist($page_count = '')
    {
        //echo 'hai';exit;
        $post_array[]      = array(
            'field_name' => 'UB_CHECKLIST.builder_id',
            'value' => $this->user_session['builder_id'],
            'type' => '='
        );
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'UB_CHECKLIST.project_id',
							'value'=> $this->project_id, 
							'type' => '='
						);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'UB_CHECKLIST.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}	
        $total_count_array = array();
        if (!empty($this->input->post())) {
            // Sanitize input
            $result = $this->sanitize_input();
            
            if (TRUE === $result['status']) {
                // Tags search input
                // Search input - Search input parameter we are used to builder the where condition and will save it in session.
                $search_session_array = array();
                //echo '<pre>';print_r($result['data']);exit;
                if (isset($result['data']['project']) && $result['data']['project'] != '' && $result['data']['project'] != 'Nothing selected' && $result['data']['project'] != 'null') {
                    $post_array[]                       = array(
                        'field_name' => 'UB_CHECKLIST.project_id',
                        'value' => $result['data']['project'],
                        'type' => '||',
                        'classification' => 'dynamnic_text'
                    );
                    $search_session_array['project_id'] = $result['data']['project'];
                    //echo '<pre>';print_r($search_session_array);exit;
                }
                if (isset($result['data']['tagType']) && $result['data']['tagType'] != '' && $result['data']['tagType'] != 'Nothing selected' && $result['data']['tagType'] != 'null') {
                    $post_array[]                 = array(
                        'field_name' => 'UB_CHECKLIST.tags',
                        'value' => $result['data']['tagType'],
                        'type' => '||',
                        'classification' => 'dynamnic_text'
                    );
                    $search_session_array['tags'] = $result['data']['tagType'];
                    //echo '<pre>';print_r($search_session_array);exit;
                }
                if (isset($result['data']['categoryType']) && $result['data']['categoryType'] != '' && $result['data']['categoryType'] != 'Nothing selected' && $result['data']['categoryType'] != 'null') {
                    $post_array[]                     = array(
                        'field_name' => 'UB_CHECKLIST.category',
                        'value' => $result['data']['categoryType'],
                        'type' => '||',
                        'classification' => 'dynamnic_text'
                    );
                    $search_session_array['category'] = $result['data']['categoryType'];
                    //echo '<pre>';print_r($search_session_array);exit;
                }

                if($page_count == 'result_array')
                {
                    
                  if (isset($this->uni_session_get('SEARCH')['project_id']) && $this->uni_session_get('SEARCH')['project_id'] != '' && $this->uni_session_get('SEARCH')['project_id'] != 'Nothing selected' && $this->uni_session_get('SEARCH')['project_id'] != 'null') {
                    $post_array[]                       = array(
                        'field_name' => 'UB_CHECKLIST.project_id',
                        'value' => $this->uni_session_get('SEARCH')['project_id'],
                        'type' => '||',
                        'classification' => 'dynamnic_text'
                    );
                    //$search_session_array['project_id'] = $result['data']['project'];
                    //echo '<pre>';print_r($search_session_array);exit;
                }
                if (isset($this->uni_session_get('SEARCH')['tags']) && $this->uni_session_get('SEARCH')['tags'] != '' && $this->uni_session_get('SEARCH')['tags'] != 'Nothing selected' && $this->uni_session_get('SEARCH')['tags'] != 'null') {
                    $post_array[]                 = array(
                        'field_name' => 'UB_CHECKLIST.tags',
                        'value' => $this->uni_session_get('SEARCH')['tags'],
                        'type' => '||',
                        'classification' => 'dynamnic_text'
                    );
                    //$search_session_array['tags'] = $result['data']['tagType'];
                    //echo '<pre>';print_r($search_session_array);exit;
                }
                if (isset($this->uni_session_get('SEARCH')['category']) && $this->uni_session_get('SEARCH')['category'] != '' && $this->uni_session_get('SEARCH')['category'] != 'Nothing selected' && $this->uni_session_get('SEARCH')['category'] != 'null') {
                    $post_array[]                     = array(
                        'field_name' => 'UB_CHECKLIST.category',
                        'value' => $this->uni_session_get('SEARCH')['category'],
                        'type' => '||',
                        'classification' => 'dynamnic_text'
                    );
                    //$search_session_array['category'] = $result['data']['categoryType'];
                    //echo '<pre>';print_r($search_session_array);exit;
                }
                }
                /*
                    Paggination length stored in seesion code start here
                */
                $search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
                $search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
                // Setting session 
                $this->uni_set_session('search', $search_session_array);
				/* "ISDELETED" condition checking 06-10-2015 added by chandru */
				$post_array[]                     = array(
                        'field_name' => 'UB_CHECKLIST.is_delete',
                        'value' => 'No',
                        'type' => '='
                    );
                //echo '<pre>';print_r($this->session->userdata);exit;
                $where_str        = $this->Mod_checklist->build_where($post_array);
				
				//code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('checklist')][strtolower('view all')]) && $this->user_role_access[strtolower('checklist')][strtolower('view all')] == 0)
				{	
					if(isset($this->user_role_access[strtolower('checklist')][strtolower('view created by me')]) && $this->user_role_access[strtolower('checklist')][strtolower('view created by me')] == 1)
					{
						$where_str = $where_str.'AND UB_CHECKLIST.created_by = '. $this->user_id;					
					}
				}
				
                // Pagination Array
                $pagination_array = array();
                if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
                {
                    $pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);

                    $total_count_array = $this->Mod_checklist->get_check_list(array(
                        'select_fields' => array(
                            'COUNT(UB_CHECKLIST.ub_checklist_id) AS total_count'
                        ),
                        'where_clause' => $where_str
                        //'join'=> array('builder'=>'Yes')
                    ));
                }
                else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
                {
                    $pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

                    $total_count_array = $this->Mod_checklist->get_check_list(array(
                        'select_fields' => array(
                            'COUNT(UB_CHECKLIST.ub_checklist_id) AS total_count'
                        ),
                        'where_clause' => $where_str
                        //'join'=> array('builder'=>'Yes')
                    ));
                }
               /* if (isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho'])) {
                    $pagination_array  = array(
                        'iDisplayStart' => $result['data']['iDisplayStart'],
                        'iDisplayLength' => $result['data']['iDisplayLength'],
                        'sEcho' => $result['data']['sEcho']
                    );
                    // Get number of records
                    $total_count_array = $this->Mod_checklist->get_check_list(array(
                        'select_fields' => array(
                            'COUNT(UB_CHECKLIST.ub_checklist_id) AS total_count'
                        ),
                        'where_clause' => $where_str
                        //'join'=> array('builder'=>'Yes')
                    ));
                }*/
                // Order by
                $order_by_where = '';
                if (isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] > 0) {
                    // echo $result['data']['iSortCol_0'];
                    $sort_type            = $result['data']['sSortDir_0'];
                    $sort_filed_column_id = $result['data']['iSortCol_0'];
                    $dt_filed_name        = 'mDataProp_';
                    //echo $result['data'][$dt_filed_name.$sort_filed_column_id];
					// Get formatted sort name
					$format_sort_name = $this->Mod_checklist->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where       = 'UB_CHECKLIST.' . $result['data'][$dt_filed_name . $sort_filed_column_id] . ' ' . $sort_type;
					}
                }
				else
				{
				$order_by_where='UB_CHECKLIST.modified_on DESC';
				}
                
            } else {
                $this->Mod_role->response($result);
            }
        }
        // Fetch date format to display	
        $timezone          = $this->Mod_timezone->get_timezone();
        $args              = array(
            'classification' => 'user_date_format'
        );
        $date_format_array = $this->Mod_general_value->get_general_value($args);
        //$date_array = array('TASK.due_date'=> 'due_date');
        $query_array       = array(
            'select_fields' => array(
                'UB_CHECKLIST.ub_checklist_id',
                'UB_CHECKLIST.builder_id',
                'UB_CHECKLIST.project_id',
                'UB_CHECKLIST.title',
                'UB_CHECKLIST.tags',
                'UB_CHECKLIST.category',
                'UB_CHECKLIST.description',
                'UB_CHECKLIST.created_on',
                'UB_CHECKLIST.created_by',
                'UB_CHECKLIST.modified_on',
                'PROJECT.project_name'
            ),
            'join' => array(
                'builder' => 'Yes'
            ),
            'where_clause' => $where_str,
            'order_clause' => $order_by_where,
            'pagination' => $pagination_array
        );
        //echo '<pre>';print_r($result['data']);exit;
        if (isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export') {
            unset($query_array['pagination']);
        }
        
        $result_data = $this->Mod_checklist->get_check_list($query_array);
        if($page_count == 'result_array')
        {
          //print_r($result_data);exit;
          return $result_data;
        }
        // File export request  
        if ($result['data']['fetch_type'] == 'export') {
            $field_list_array = array(
                'title',
                'project_name',
                'tags',
                'category'
            );
            
            // Export file header column 
            $export_array['header'][0] = array(
                'Checklist',
                'Project',
                'Tags',
                'Category'
            );
            
            foreach ($result_data['aaData'] as $fields) {
                $line = array();
                foreach ($fields as $key => $item) {
                    if (in_array($key, $field_list_array)) {
                        $ab        = array_search($key, $field_list_array);
                        $line[$ab] = $item;
                    }
                }
                if (ksort($line)) {
                    $export_array['value'][] = $line;
                }
            }
            echo array_to_export($export_array, 'Checklist.xls', 'xls');
            exit;
        }
        
        // The following parameters required for data table
        
        if ($result_data['status'] == FALSE) {
            $result_data           = array();
            $result_data['aaData'] = array();
        } else {
            $result_data['iTotalRecords']        = isset($total_count_array['aaData'][0]['total_count']) ? $total_count_array['aaData'][0]['total_count'] : '';
            $result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count']) ? $total_count_array['aaData'][0]['total_count'] : '';
            $result_data['sEcho']                = isset($result['data']['sEcho']) ? $result['data']['sEcho'] : '';
        }
        // Response data
        $this->Mod_checklist->response($result_data);
    }
    /** 
     * Insert / Update General value
     * 
     * @method: update_general_value 
     * @access: public 
     * @param: ajax post array
     * @return: array 
     * @createdby: chandru
     * url encoded : dgxf1Fzay91cgxf1Rhdgxf1VfZ2VuZXJhbF92YWx1ZS8-
     */
    public function update_general_value()
    {
        if (!empty($this->input->post())) {
            // Sanitize input
            $result = $this->sanitize_input();
            //echo "<pre>";print_r($result);
            if (TRUE === $result['status']) {
                $args   = array(
                    'classification' => $result['data']['classification'],
                    'type' => $result['data']['type'],
                    'value' => $result['data']['value']
                );
                $result = $this->Mod_general_value->update_general_value($args);
            }
            $this->Mod_checklist->response($result);
        } else {
            $response['status']  = FALSE;
            $response['message'] = 'Delete Failed: Post array is empty';
        }
    }
    
    /** 
     * Destroy Session
     * 
     * @method: destroy_session 
     * @access: public 
     * @param:  ajax post array
     * @return: array 
     * @createdby: chandru
     */
    public function destroy_session()
    {
        if (!empty($this->input->post())) {
            // Sanitize input
            $result = $this->sanitize_input();
            if (TRUE === $result['status']) {
                $result = $this->Mod_checklist->destroy_session($result['data']);
            }
            $this->Mod_checklist->response($result);
        } else {
            $response['status']  = FALSE;
            $response['message'] = 'Delete Failed: Post array is empty';
        }
    }
    
    /** 
     * Apply Saved Search
     * 
     * @method: apply_saved_search 
     * @access: public 
     * @params: 
     * @return: array 
     * @created by: chandru 
     * @created on: 03/04/2015 
     * url encoded : cm9sZXMvZ2V0X3NhdmVkX3NlYXJjaC8-
     */
    public function apply_saved_search()
    {
        /* Apply Filter code starts here */
        $post_array  = array(
            'builder_id' => $this->user_session['builder_id'],
            'user_id' => $this->user_session['ub_user_id'],
            'module_name' => $this->module
        );
        $result_data = $this->Mod_saved_search->get_saved_search(array(
            'select_fields' => array(),
            'where_clause' => $post_array
        ));
        if (!empty($this->input->post())) {
            if ($result_data['status'] == true) {
                $save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
                $task_array     = $this->input->post();
                $post_array     = array(
                    'ub_saved_search_id' => $save_search_id,
                    'search_params' => "'" . serialize($task_array) . "'"
                );
                $response       = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
            } else {
                $task_array = $this->input->post();
                $post_array = array(
                    'search_params' => "'" . serialize($task_array) . "'"
                );
                $response   = $this->Mod_saved_search->update_saved_search($post_array);
                $this->Mod_saved_search->response($response);
            }
        } else {
            $serialized_data                           = $result_data['aaData'][0]['search_params'];
            $remove_single_quote                       = str_replace("'", '', $serialized_data);
            $unserialized_data                         = unserialize($remove_single_quote);
            $result_data['aaData'][0]['search_params'] = $unserialized_data;
            if (!empty($unserialized_data)) {
                if (!empty($unserialized_data['tags'])) {
                    $search_session_array['tags'] = $unserialized_data['tags'];
                }
                if (!empty($unserialized_data['project_id'])) {
                    $search_session_array['project_id'] = $unserialized_data['project_id'];
                }
                if (!empty($unserialized_data['category'])) {
                    $search_session_array['category'] = $unserialized_data['category'];
                }
                //$this->session->set_userdata('ACCOUNT', $this->account_session);
                $this->uni_set_session('search', $search_session_array);
                $this->Mod_checklist->response($result_data);
            }
        }
        /* Apply Filter code Ends here */
    }
    
    /** 
     * Delete Checklist
     * 
     * @method: delete_checklist 
     * @access: public 
     * @param:  ajax post array
     * @return: array 
     * @createdby: chandru
     */
    public function delete_checklist()
    {
        
        $result = $this->sanitize_input();
        if (TRUE === $result['status']) {
            $response = $this->Mod_checklist->delete_checklists($result['data']);
            $respoce_array = $this->get_checklist($page_count = 'result_array');
                //echo '<pre>';print_r($respoce_array);exit;
                if($respoce_array['status'] == FALSE)
                {
                    if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && $this->uni_session_get('SEARCH')['iDisplayStart'] > 0)
                    {
                        $search_session_array['iDisplayStart'] = (($this->uni_session_get('SEARCH')['iDisplayStart']) - ($this->uni_session_get('SEARCH')['iDisplayLength']));
                        $search_session_array['iDisplayLength'] = $this->uni_session_get('SEARCH')['iDisplayLength'];
                        $this->uni_set_session('search', $search_session_array);
                    }
                }
        } else {
            $this->Mod_checklist->response($result);
        }
        $res = $this->Mod_checklist->response($response);
        echo '<pre>';
        print_r($res);
        exit;
    }
}