<?php
class User_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
	
	public function get_user($id = FALSE) {
		if ($id === FALSE)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}
	
		$query = $this->db->get_where('user', array('id' => $id));
		return $query->row_array();
	}
	
	public function delete_user($id) {
		$this->db->delete('user', array('id' => $id)); 
	}

	public function exist_email($email = FALSE) {
		$this->db->select('id');
		$this->db->from('user');
		$this->db->where('email', $email);
		$result = $this->db->get()->result_array();
		if (!empty($result)) {
			$result = $result[0]['id'];
		}
		else {
			$result = null;
		}
		return $result;
	}
	
	public function empty_user() {
		$user['name'] = '';
		$user['birthdate'] = '';
		$user['email'] = '';
		$user['favorite_color'] = '';
		return $user;		
	}
	
	public function set_user() {
    	$this->load->helper('url');

	    $data = array(
	        'name' => $this->input->post('name'),
	    	'email' => $this->input->post('email'),
	    	'birthdate' => $this->input->post('birthdate'),
	    	'favorite_color' => $this->input->post('favcolor')
	    );

    	return $this->db->insert('user', $data);
	}
	

	public function edit_user() {
		$this->load->helper('url');
	
		$data = array(
				'id'  => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'birthdate' => $this->input->post('birthdate'),
				'favorite_color' => $this->input->post('favcolor')
		);
	
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('user', $data);
	}
}