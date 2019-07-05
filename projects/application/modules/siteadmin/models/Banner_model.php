<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class banner_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function addbanner($data) {

        $this->db->insert('sbs_banner', $data);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            
            $this->session->unset_userdata('banner');
            return true;
        } else {
            return false;
        }
    }
     public function listbanner() {

       $this->db->order_by('banner_id DESC');
        $query = $this->db->get('sbs_banner');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
        }
        return $list;
    }
    public function changestatus($id){
        
        $this->db->where('banner_id',$id);
        $qry = $this->db->get('sbs_banner');
        if ($qry->num_rows() > 0) {
            $status = $qry->row_array();
            if($status['banner_status']=='active'){
                $st = 'inactive';
            }
            if($status['banner_status']=='inactive'){
                $st = 'active';
            }
            $this->db->where('banner_id',$id);
            $this->db->update('sbs_banner',array("banner_status"=>$st));
            return true;
            
        }
        
    }

}
