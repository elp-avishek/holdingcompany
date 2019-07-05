<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact_model extends CI_Model {
	
	 public function __construct() {
        parent::__construct();
		$this->load->database();
    }
	public function contact_list(){
            
            $this->db->order_by('date_added DESC');
        $query = $this->db->get('sbs_contact');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
           $list = $query->result_array();
        }
        return $list;
        }
        
        public function info($data){
            
            $this->db->where('id',$data);
          $query=$this->db->get('sbs_contact');
            $info=$query->row_array();
            return $info; 
        }
	
}