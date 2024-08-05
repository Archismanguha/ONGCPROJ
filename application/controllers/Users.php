<?php

/**
 * Description of Users Controller
 *
 * @author Team TechArise
 *
 * @email info@techarise.com
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model', 'user');
	}
	// Dashboard method
	public function index()
	{
		if ($this->session->userdata('is_authenticated') == FALSE) {
			redirect('users/login'); // the user is not logged in, redirect them!
		} else {
			$data['title'] = 'Dashboard - Tech Arise';
			$data['metaDescription'] = 'Dashboard';
			$data['metaKeywords'] = 'Dashboard';
			//$this->user->setUserID($this->session->userdata('user_id'));
			$data['empid'] = $this->session->userdata('empid');
			$data['firstname'] = $this->session->userdata('firstname');
			$data['lastname'] = $this->session->userdata('lastname');
			$this->load->view('users/dashboard', $data);
		}
	}
	// Login method
	public function login()
	{
		if ($this->session->userdata('is_authenticated') == TRUE) {
			redirect('users/index'); // the user is not logged in, redirect them!
		} else {
			$data['title'] = 'Login - Tech Arise';
			$data['metaDescription'] = 'Login';
			$data['metaKeywords'] = 'Login';
			if($this->input->get('msg') == "1"){
				$data['loginErrMsg'] = 'Incorrect Name or Employee Id';
			}
			else{
				$data['loginErrMsg'] = '';
			}
			$this->load->view('users/index', $data);
		}
	}
	// Login Action 
	function doLogin()
	{
		// Check form  validation
		$this->load->library('form_validation');

			$sessArray = array();
			//Field validation succeeded.  Validate against database
			$name = $this->input->post('name');
			$empid = $this->input->post('empid');

			$this->user->setName($name);
			$this->user->setEmpId($empid);

			//query the database
			$result = $this->user->login();

			if ($result) {
				foreach ($result as $row) {
					$sessArray = array(
						'empid' => $row->emp_id,
						'firstname' => $row->FirstName,
						'lastname' => $row->LastName,
						'is_authenticated' => TRUE,
					);
					$this->session->set_userdata($sessArray);
				}
				//redirect('users');
				$data['empid'] = $this->session->userdata('empid');
				$data['firstname'] = $this->session->userdata('firstname');
				$data['lastname'] = $this->session->userdata('lastname');
				$this->load->view('users/dashboard', $data);
			} else {
				redirect('users/login?msg=1');
			}
	}

	public function upload()
	{
		if ($this->session->userdata('is_authenticated') == FALSE) {
			redirect('users/login'); // the user is not logged in, redirect them!
		} else {
			$data['title'] = 'Dashboard - Tech Arise';
			$data['metaDescription'] = 'Dashboard';
			$data['metaKeywords'] = 'Dashboard';
			$data['empid'] = $this->session->userdata('empid');
			$data['firstname'] = $this->session->userdata('firstname');
			$data['lastname'] = $this->session->userdata('lastname');
			$data['blockdtls'] = $this->user->getBlockDtls();
			$data['uploadmsg'] = "";
			$this->load->view('users/uploadview', $data);
		}
	}
	
	function uploadDtls()
	{
		$data['uploadmsg'] = "";
		$uploadresult = $this->uploadInPhysicalFolder();
		if($uploadresult != "ERR"){
			$blockid = $this->input->post('blocklst');
			$remarks = $this->input->post('remarks');
			$uploadFile = $uploadresult;
			$empid = $this->session->userdata('empid');

			$this->user->setUploadDtls($blockid, $empid, $remarks, $uploadFile);
			$result = $this->user->saveUploadDtls();
			$data['uploadmsg'] = "Details uploaded successfully";
		}
		else{
			$data['uploadmsg'] = "Error Occured";
		}

		$data['empid'] = $this->session->userdata('empid');
		$data['firstname'] = $this->session->userdata('firstname');
		$data['lastname'] = $this->session->userdata('lastname');
		$data['blockdtls'] = $this->user->getBlockDtls();
		$this->load->view('users/uploadview', $data);
	}
	public function uploadInPhysicalFolder(){
		$config['upload_path'] = $this->config->item('upload_path');
		$config['allowed_types'] = 'gif|jpg|png|jpeg|zip|pdf|doc|docx';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 
		if (!$this->upload->do_upload('uploadFile')) 
		{
			//log_message('debug',$this->upload->display_errors());
				//error message
				return "ERR";
		}
		else
		{
			//log_message('debug','1111');
			//$this->upload->do_upload('uploadFile');
			//upload process
			$data = array('upload_data' => $this->upload->data());
			if(!empty($data['upload_data']['file_name'])){
				return $data['upload_data']['file_name'];
			}
			else{
				return "ERR";
			}
		}
	}
	// Logout
	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('is_authenticated');
		$this->session->sess_destroy();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		redirect('/');
	}
	public function viewDetails()
	{
		if ($this->session->userdata('is_authenticated') == FALSE) {
			redirect('users/index'); // the user is not logged in, redirect them!
		} else {
			$data['alldtls'] = $this->user->getAllDetails();
			$this->load->view('users/viewDetails', $data);
		}
	}
}
