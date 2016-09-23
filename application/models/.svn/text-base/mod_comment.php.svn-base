<?php
/** 
 * Comment Model
 * 
 * @package: Comment Model
 * @subpackage: Comment Model 
 * @category: Comment
 * @author: Sidhartha
 * @createdon(DD-MM-YYYY): 28-04-2015
*/
class Mod_comment extends UNI_Model
{
	/**
	 * @property: $module_name
	 * @access: public
	 */

	public $module_name;
	/**
	 * @property: $module_pk_id
	 * @access: public
	 */

	public $module_pk_id;
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		parent::__construct();
    }
	
	/**
	*
	* Add Comment
	*
	* @method: add_comment
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdon(DD-MM-YYYY): 30-03-2015
	* @createdby: sidhartha
	*/
	public function add_comment($post_array = array(),$notification_data = array())
	{
		if( ! empty($post_array))
		{	 
			 $this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->write_db->insert(UB_COMMENTS, $post_array))
			{
				$comment_table_insertid = $this->write_db->insert_id();

				if($this->module != 'messages'){
				if($post_array['module_name'] == 'logs')
				{
					$send_notification = $this->Mod_log->send_mail_for_notification($post_array,'',$comment_table_insertid);
				}
				if($post_array['module_name'] == 'warranty')
				{
					//print_r($notification_data);
					$post_array['title'] = $notification_data['title'];
					$send_notification = $this->Mod_warranty->send_mail_for_notification($post_array,'',$comment_table_insertid);
				}
				if($post_array['module_name'] == 'bids')
				{
					if($this->user_account_type == BUILDERADMIN){
					$post_array['insert_id'] = $comment_table_insertid;
					$this->Mod_bid->send_notification_bid_comments($post_array,$notification_data);}
				}
				}
				$data['insert_id'] =  $comment_table_insertid;
				$data['comment'] =  $post_array['comments'];
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
				$post_array['insert_id'] = $data['insert_id'] ;
				
				
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
			
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
	}
	/**
	*
	* Delete comment
	*
	* @method: delete_comment
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: sidhartha
	*/
	public function delete_comment($delete_array)
	{
		if(isset($delete_array['ub_comments_id']))
		{
			foreach($delete_array['ub_comments_id'] as $key=>$ub_comments_id)
			{
				$this->write_db->delete(UB_COMMENTS, array('ub_comments_id' => $ub_comments_id));
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Comment deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Log id is not set';
		}
		return $data;

	}
	
	/** 
	* Get comments information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_comments
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_comment($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_COMMENTS.' AS COMMENT');
		//Join Tables
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','COMMENT.created_by = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
		 }
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		// Group by condition
		if(isset($args['group_clause']) && $args['group_clause'] !='')
		{
		  $this->read_db->group_by($args['group_clause']);
		}
		$res = $this->read_db->get();
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		return $data;
	}
	/** 
	* Get userinfo information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	*
	* @method: get_userinfo
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_userinfo($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT_ASSIGNED_USERS.' AS PROJECT_ASSIGNED_USERS');
		// Join Tables
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','PROJECT_ASSIGNED_USERS.assigned_to = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
		 }
		 // Group by condition
		if(isset($args['group_clause']) && $args['group_clause'] !='')
		{
			$this->read_db->group_by($args['group_clause']);
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		$res = $this->read_db->get();
		$data = array();
		$data_arry = array();
		if($res->num_rows() > 0)
		{
			foreach ($res->result_array() as $row)
			{
				$level2_array[] = $row['first_name'].EMAIL_SEPERATOR_LEVEL2.$row['primary_email'].EMAIL_SEPERATOR_LEVEL2.'bcc';
				
			}
			$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);

			$email_array= array(
				'SET_PARSER' => 'Testing Parser',
				'SEND_MAIL_INFO' => $level1_string
			);
			$this->Mod_mail->send_mail('SEND_NOTIFICATION_EMAIL', $email_array);
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		return $data;
	}
}
	
/* End of file mod_project.php */
/* Location: ./application/models/mod_project.php */