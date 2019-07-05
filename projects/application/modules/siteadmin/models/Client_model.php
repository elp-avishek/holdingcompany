<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class client_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function list_client(){
        $query=$this->db->get('sbs_client');
        $i=0;
        $list=array();
        foreach($query->result_array() as $list){
            $result[$i]['id']=$list['id'];
            $result[$i]['name']=$list['name'];
            $result[$i]['email']=$list['email'];
           $result[$i]['date_added']=$list['date_added'];
           $result[$i]['status']=$list['status'];
           $result[$i]['phone']=$list['phone'];
            $i++;
        }
        return $result;
    }
    function changestat($id){
        $this->db->select('status');
        $this->db->where('id',$id);
        $query=$this->db->get('sbs_client');
        $result=$query->row_array();
        if($result['status']=='active'){
            $this->db->set('status','inactive');
        }else{
            $this->db->set('status','active');
        }
        $this->db->where('id',$id);
        $this->db->update('sbs_client');
    }
}
