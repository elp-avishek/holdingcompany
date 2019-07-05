<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gallery_model extends CI_Model {
	
	 public function __construct() {
        parent::__construct();
		$this->load->database();
    }
    public function addgallery($data) {

        $this->db->insert('rw_gallery', $data);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            
            $this->session->unset_userdata('banner');
            return true;
        } else {
            return false;
        }
    }
     public function listgallery() {

       $this->db->order_by('gallery_id DESC');
        $query = $this->db->get('rw_gallery');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
        }
        return $list;
    }
      public function changestatus($id){
        
        $this->db->where('gallery_id',$id);
        $qry = $this->db->get('rw_gallery');
        if ($qry->num_rows() > 0) {
            $status = $qry->row_array();
            if($status['gallery_status']=='active'){
                $st = 'inactive';
            }
            if($status['gallery_status']=='inactive'){
                $st = 'active';
            }
            $this->db->where('gallery_id',$id);
            $this->db->update('rw_gallery',array("gallery_status"=>$st));
            return true;
            
        }
        
    }

}