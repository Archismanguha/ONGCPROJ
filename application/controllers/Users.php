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
			$data['blockdtls'] = $this->user->getBlockDtls();
			$this->load->view('users/thank-you', $data);
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
				redirect('users');
			} else {
				redirect('users/login?msg=1');
			}
	}
	
	function uploadDtls()
	{
		$blockid = $this->input->post('blocklst');
		$remarks = $this->input->post('remarks');
		$uploadFile = $_FILES['uploadFile']['name'];
		$empid = $this->session->userdata('empid');

		$this->user->setUploadDtls($blockid, $empid, $remarks, $uploadFile);
		$result = $this->user->saveUploadDtls();

		$this->uploadInPhysicalFolder();


		$data['empid'] = $this->session->userdata('empid');
		$data['firstname'] = $this->session->userdata('firstname');
		$data['lastname'] = $this->session->userdata('lastname');
		$data['blockdtls'] = $this->user->getBlockDtls();
		$this->load->view('users/thank-you', $data);
	}
	public function uploadInPhysicalFolder(){
		$config['upload_path'] = $this->config->item('upload_path');
		$config['allowed_types'] = 'gif|jpg|png|jpeg|zip|pdf|doc|docx';
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 
		if (!$this->upload->do_upload('uploadFile')) 
		{
			//log_message('debug',$this->upload->display_errors());
				//error message
		}
		else
		{
			log_message('debug','1111');
			//$this->upload->do_upload('uploadFile');
			//upload process
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
}
