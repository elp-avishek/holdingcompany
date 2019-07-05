<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class magazine_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addmagazine($data) {

        $this->db->insert('rw_magazine', $data);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('magazine');
            return true;
        } else {
            return false;
        }
    }
    
     public function magazinelist() {
          
       
        $this->db->order_by('magazine_id DESC');
        $query = $this->db->get('rw_magazine');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
        }
        return $list;
    }
    public function details($id) {
          
       
        $this->db->where('magazine_id',$id);
        $query = $this->db->get('rw_magazine');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->row_array();
        }
        return $list;
    }
    
    
    public function subscriberlist() {
          
       
        $this->db->order_by('id DESC');
        $query = $this->db->get('rw_magazine_subscriber');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
        }
        return $list;
    }

}
