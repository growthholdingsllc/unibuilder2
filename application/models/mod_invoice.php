<?php

/**
 * Invoice Class
 *
 * @package:	Invoice
 * @subpackage: Invoice
 * @category:	Invoice
 * @author:		NalinR
 * @createdon(DD-MM-YYYY): 25-04-2015
*/

class Mod_invoice extends UNI_Model
{
	/**
	 * @property:	$invoice_id
	 * @access:		public
	 */
	public $invoice_id;

	/**
	 * @property: $user_id
	 * @access: public
	 */
	public $user_id;


	/**
	 * @constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * Get invoice information
	 *
	 * $args['select_fields']		- can get all or specific filed information by giving values for the key "select_fields"
	 * $args['join']['builder']		- join builder table with invoice table
	 * $args['join']['payment']		- join payment table with invoice table
	 * $args['join']['user_plan']	- join user_plan table with invoice table
	 * $args['where_clause']		- can pass where conditions as an array
	 * $args['order_clause']		- sorting option
	 * $args['pagination']			- pagination option
	 *
	 * @method:	get_invoice_details
	 * @access:	public
	 * @param:	args
	 * @return:	array
	 */
	public function get_invoice_details($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',', $args['select_fields']) : '*', FALSE);
		$this->read_db->from(UB_INVOICE . ' AS INVOICE_DETAILS');

		// Join tables
		if (isset($args['join']) && 'yes' === strtolower($args['join']['builder'])) {
			$this->read_db->join(UB_BUILDER . ' AS BUILDER_DETAILS', 'INVOICE_DETAILS.builder_id = BUILDER_DETAILS.ub_builder_id', 'left');
		}
		if (isset($args['join']) && 'yes' === strtolower($args['join']['payment'])) {
			$this->read_db->join(UB_PAYMENT . ' AS PAYMENT_DETAILS', 'INVOICE_DETAILS.payment_id = PAYMENT_DETAILS.ub_payment_id', 'left');
		}
		if (isset($args['join']) && 'yes' === strtolower($args['join']['user_plan'])) {
			$this->read_db->join(UB_USER_PLAN . ' AS USER_PLAN_DETAILS', 'INVOICE_DETAILS.user_plan_id = USER_PLAN_DETAILS.ub_user_plan_id', 'left');
		}

		// Where condition
		if (isset($args['where_clause'])) {
			$this->read_db->where($args['where_clause']);
		}

		// Order by condition
		if (isset($args['order_clause']) && $args['order_clause'] != '') {
			$this->read_db->order_by($args['order_clause']);
		}

		// Pagination
		if (isset($args['pagination']) && !empty($args['pagination'])) {
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}

		$res	=	$this->read_db->get();
		$data	=	array();

		if ($res->num_rows() > 0) {
			$data['aaData']		=	$res->result_array();
			$data['status']		=	TRUE;
			$data['message']	=	'Data retrieved successfully';
		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'No record found';
		}
		// echo $this->read_db->last_query();
		return $data;
	}


	/**
	 *
	 * Add invoice
	 *
	 * @method:	add_invoice
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_invoice($post_array = array())
	{
		if (!empty($post_array)) {
			// If invoice id is passing, then will take that invoice id / will take the session id, this will work fine for both invoice admin and uni admin
			// $this->invoice_id = (isset($post_array['invoice_id'])) ? $post_array['invoice_id'] : $this->invoice_id;
			// if ($this->invoice_id > 0) {
				if ($this->write_db->insert(UB_INVOICE, $post_array)) {
					//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Invoice(s) inserted successfully';
				} else {
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the Invoice(s)';
				}
			/* } else {
				$data['status']  = FALSE;
				$data['message'] = 'Insert Failed: Not a valid invoice';
			} */
		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
	}


	/**
	 *
	 * Update invoice
	 *
	 * @method:	update_invoice
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	public function update_invoice($post_array = array())
	{
		if (!empty($post_array)) {
			$this->ub_invoice_id = isset($post_array['ub_invoice_id']) ? $post_array['ub_invoice_id'] : $this->ub_invoice_id;
			if ($this->ub_invoice_id > 0) {

				$this->write_db->where('ub_invoice_id', $this->ub_invoice_id);
				if ($this->write_db->update(UB_INVOICE, $post_array)) {
					$data['insert_id'] = $this->ub_invoice_id;
					$data['status']    = TRUE;
					$data['message']   = 'Updated successfully';
				} else {
					$data['status']  = FALSE;
					$data['message'] = 'Update failed';
				}
			}

		} else {
			$data['status']  = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}


	/**
	 *
	 * Delete invoice
	 *
	 * @method:	delete_invoice
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	public function delete_invoice($delete_array)
	{
		if (isset($delete_array['ub_invoice_id'])) {
			foreach ($delete_array['ub_invoice_id'] as $key => $ub_invoice_id) {
				$this->write_db->delete(UB_INVOICE, array(
					'ub_invoice_id' => $ub_invoice_id
				));
			}
			$data['status']  = TRUE;
			$data['message'] = 'Invoice(s) deleted successfully';
		} else {
			$data['status']  = FALSE;
			$data['message'] = 'Invoice id is not set';
		}
		return $data;
	}
}

/* End of file mod_invoice.php */
/* Location: ./application/models/mod_invoice.php */