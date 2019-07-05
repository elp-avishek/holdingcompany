<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home_model extends CI_Model {

    public function __construct() {
	parent::__construct();
	$this->load->database();
    }

 

 

    public function get_menu() {
	$this->db->order_by('cms_menu_order','ASC');
	$this->db->where('cms_id!=',1);
	$this->db->where('cms_menu','Y');
	$this->db->where("cms_status", "active");
	$query = $this->db->get('sbs_cms');
	return $query->result_array();
    }
    
    public function get_cms_details($id){
	$this->db->where("cms_id", $id);
	$this->db->where("cms_status", "active");
	$query = $this->db->get('sbs_cms');
	return $query->row_array();
    }

}
