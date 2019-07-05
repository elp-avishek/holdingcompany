<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class projects_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function addprojects($data) {

        $this->db->insert('rw_projects', $data);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('projects');
            return true;
        } else {
            return false;
        }
    }

    public function projectslist() {


        $this->db->order_by('projects_title DESC');
        $query = $this->db->get('rw_projects');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
        }
        return $list;
    }

    public function details($projectid) {

        $this->db->where('projects_id', $projectid);
        $this->db->order_by('projects_date DESC');
        $query = $this->db->get('rw_projects');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->row_array();
        }
        return $list;
    }
    public function editprojects($data,$id) {
        $this->db->where('projects_id', $id);
        $this->db->update('rw_projects', $data);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('projects');
            return true;
        } else {
            return false;
        }
    }

}
