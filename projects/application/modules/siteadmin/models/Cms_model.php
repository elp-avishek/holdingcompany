<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cms_model extends CI_Model {

    function __construct() {
	parent::__construct();
	$this->load->database();
    }

    function list_cms() {
	$this->db->where('cms_file', '');
	$query = $this->db->get('sbs_cms');
	$i = 0;
	$list = array();
	foreach ($query->result_array() as $val) {
	    $list[$i]['cms_id'] = $val['cms_id'];
	    $list[$i]['cms_title'] = $val['cms_title'];
	    $list[$i]['cms_status'] = $val['cms_status'];
	    $list[$i]['cms_menu'] = $val['cms_menu'];
	    $list[$i]['cms_menu_order'] = $val['cms_menu_order'];
	    $i++;
	}
//        print_r($list);die;
	return $list;
    }

    function list_cms_pdf() {
	$this->db->where('cms_file <>', '');
	$query = $this->db->get('sbs_cms');
	//echo $this->db->last_query();die;
	$i = 0;
	$list = array();
	foreach ($query->result_array() as $val) {
	    $list[$i]['cms_id'] = $val['cms_id'];
	    $list[$i]['cms_title'] = $val['cms_title'];
	    $list[$i]['cms_status'] = $val['cms_status'];
	    $list[$i]['cms_menu'] = $val['cms_menu'];
	    $list[$i]['cms_menu_order'] = $val['cms_menu_order'];
	    $list[$i]['cms_file'] = $val['cms_file'];
	    $i++;
	}
//        print_r($list);die;
	return $list;
    }

    function edit_detail($id) {
	$this->db->where('cms_id', $id);
	$query = $this->db->get('sbs_cms');
	$result = $query->row_array();
	return $result;
    }

    function update_cms($id, $cms_data) {
	$this->db->where('cms_id', $id);
	$this->db->update('sbs_cms', $cms_data);
	//echo $this->db->last_query();die;
	if ($this->db->affected_rows() > 0) {

	    return true;
	} else {
	    return false;
	}
    }

    function cms_pdf_update_process($id, $cms_data) {
	$this->db->where('cms_id', $id);
	$this->db->update('sbs_cms', $cms_data);
	if ($this->db->affected_rows() > 0) {

	    return true;
	} else {
	    return false;
	}
    }

    function add_cms($cms_data) {
	$this->db->insert('sbs_cms', $cms_data);
	if ($this->db->insert_id() > 0) {

	    return true;
	} else {
	    return false;
	}
    }

    function cms_pdf_add_process($cms_data) {
	$this->db->insert('sbs_cms', $cms_data);
	if ($this->db->insert_id() > 0) {

	    return true;
	} else {
	    return false;
	}
    }

    public function delete_img($id, $img) {
	$this->db->where('cms_id', $id);
	$this->db->select('cms_file');
	$query = $this->db->get('sbs_cms');
	$data = $query->row_array();
	if (!empty($data['cms_file'])) {
	     $str = str_replace($img, " ", $data['cms_file']);
	    $cms_file_arr = explode(",", trim($str));
	    $new = array_filter($cms_file_arr);
	    $newcms_file['cms_file'] = implode(",", $new);
	    $this->db->where('cms_id', $id);
	    $this->db->update('sbs_cms', $newcms_file);
	   // echo $this->db->last_query();die;
	    if ($this->db->affected_rows() > 0) {

		return true;
	    } else {
		return false;
	    }
	}
	else{
	    return false;
	}
    }

}
