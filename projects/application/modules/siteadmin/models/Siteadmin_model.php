<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class siteadmin_model extends CI_Model{
    function __construct(){
        parent::__construct();
		$this->load->database();
    }
    
    public function process($data){
		  $now = now('Asia/Calcutta');
          $tday = date("Y-m-d H:i:s",$now);
   
		   $this->db->select('admin_id,admin_username');
		   $this->db->from('sbs_admin');
           $this->db->where('admin_username',$data['username']);
           $this->db->where('admin_password',md5($data['password']));
		   $this->db->where('admin_status','active');
		   $this->db-> limit(1);
           $query = $this->db->get();
            
       if ($query->num_rows() > 0)
          {
			  
            $row =  $query->row_array();
            $data =array_merge($row,array('sbs_adminlogin'=>TRUE));		
            $this->session->set_userdata($data);
	   return $data;
         }else {
		  return false;	 
			 
		 }
    }
}
