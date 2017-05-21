<?php
class User extends CI_Controller {

	private $validationConfig = array(
        array(	
                'field' => 'name',
        		'label' => 'name',
                'rules' => 'required'
        ),
        array(
                'field' => 'birthdate',
        		'label' => 'birthdate',
        		'rules' => 'required'
        ),
        array(
                'field' => 'favcolor',
        		'label' => 'favorite color',
                'rules' => 'required'
        ));
	
        public function __construct()
        {
                parent::__construct();
                $this->load->model('user_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['users'] = $this->user_model->get_user();
                $data['title'] = 'Users';
                
                $this->load->view('templates/header', $data);
                $this->load->view('user/index', $data);
                $this->load->view('templates/footer');
        }

        public function action($id = null)
        {
        	$this->load->helper('form');
        	
        	if ($id !== 'create') {
	        	$data['action'] = 'edit/'.$id;
	        	$data['title'] = 'User edit';
                $data['user_item'] = $this->user_model->get_user($id);
        	} else {
        		$data['action'] = 'add';
        		$data['title'] = 'User create';
        		$data['user_item'] = $this->user_model->empty_user();
        	}
                
            $this->load->view('templates/header', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        }
        
        public function add() {
        	$this->load->library('form_validation');
        	$this->form_validation->set_rules($this->validationConfig);
        	$this->form_validation->set_rules('email', 'email', 'callback_email_check[null]');
        	if ($this->form_validation->run() == false)
        	{
        		$data['result'] = 'fail';
        		$data['errors'] = validation_errors();
        	}
        	else
        	{
        		$this->user_model->set_user();
        		$data['result'] = 'success';
        	}

        	header('Content-type: text/plain');
        	header('Content-type: application/json');
        	echo json_encode($data);
        }
        
        public function edit($id = null) {
        	$this->load->library('form_validation');
        	$this->form_validation->set_rules($this->validationConfig);
        	$this->form_validation->set_rules('email', 'email', 'callback_email_check['.$id.']');
        	
        	if ($this->form_validation->run() == false)
        	{
        		$data['result'] = 'fail';
        		$data['errors'] = validation_errors();
        	}
        	else
        	{
        		$this->user_model->edit_user();
        		$data['result'] = 'success';
        	}
        	
        	header('Content-type: text/plain');
        	header('Content-type: application/json');
        	echo json_encode($data);
        }
        
        public function delete($id = null) {
        	$this->user_model->delete_user($id);
        	$this->index();
        }
        
        public function email_check($value=null, $id=null) {
        	if ($value == null){
        		$this->form_validation->set_message('email_check', 'The {field} can not be empty');
        		return false;
        	}
        	
        	if(filter_var($value, FILTER_VALIDATE_EMAIL) == false){
        		$this->form_validation->set_message('email_check', 'The {field} field has an incorrect format');
        		return false;
        	} 
        	
        	if ($this->user_model->exist_email($value) != $id) {
        		$this->form_validation->set_message('email_check', '{field} already exists');
        		return false;
        	} 
        	
        	return true;
        }
}