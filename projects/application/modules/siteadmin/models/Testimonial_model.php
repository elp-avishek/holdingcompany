<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class testimonial_model extends CI_Model{
    function __construct() {
        parent::__construct();
         $this->load->database();
    }
    function add_testimonial($data){
        $this->db->insert('sbs_testimonial',$data);
        if($this->db->affected_rows()>0){
            $this->session->unset_userdata('testimonial');
            return true;
        }else{
            return false;
        }
        
        }
        function testimonial_list(){
            $query=$this->db->get('sbs_testimonial');
           $i=0;
           foreach($query->result_array() as $var){
               $list['$i']['id']=$var['id'];
               $list['$i']['name']=$var['name'];
               $list['$i']['email']=$var['email'];
               $list['$i']['name']=$var['name'];
               $list['$i']['status']=$var['status'];
               $i++;
           }
            return $list;
        }
        function testimonial_update($id){
            $this->db->where('id',$id);
           $up= $this->db->get('sbs_testimonial');
            $data=$up->row_array();
            return $data;
        }
        function update_testimonial($data){
            $this->db->where('id',$data['id']);
            $this->db->update('sbs_testimonial',$data);
            if($this->db->affected_rows()>0){
                return true;
        }else{
            return false;
        }
        }
}