<?php

/**
 * Description of Users Model 
 *
 * @author Team TechArise
 *
 * @email info@techarise.com
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
	// declare private variable
	private $_name;
	private $_empid;
	private $_blockid;
	private $_remarks;
	private $_uploadFile;

	public function setName($name)
	{
		$this->_name = $name;
	}
	public function setEmpId($empid)
	{
		$this->_empid = $empid;
	}

	public function setUploadDtls($blockid, $empid, $remarks, $uploadFile){
		$this->_blockid = $blockid;
		$this->_remarks = $remarks;
		$this->_uploadFile = $uploadFile;
		$this->_empid = $empid;
	}

	public function getBlockDtls()
	{
		$sql = "select * from tbl_block";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function login()
	{
		// $this->db->select('user_id, name, email');
		// $this->db->from('users');
		// $this->db->where('email', $this->_email);
		// $this->db->where('password', $this->_password);
		// $this->db->limit(1);
		// $query = $this->db->get();
		$sql = "select * from tbl_employee where emp_id = ".$this->_empid." and concat(FirstName,' ',LastName) = '".$this->_name."' limit 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	function saveUploadDtls(){
		$sql = "INSERT INTO tbl_upload_dtls (block_id, emp_id, remarks, filename) VALUES(".$this->_blockid.", ".$this->_empid.", '".$this->_remarks."', '".$this->_uploadFile."')";
		$query = $this->db->query($sql);
	}
	function getAllDetails()
	{
		$sql = "select te.FirstName, te.LastName, tb.block_name, tud.remarks, tud.filename from tbl_upload_dtls tud inner join tbl_employee te ON tud.emp_id = te.emp_id inner join tbl_block tb ON tud.block_id = tb.block_id order by tud.id";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
