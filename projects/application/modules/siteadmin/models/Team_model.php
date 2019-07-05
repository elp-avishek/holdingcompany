<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Team_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function team_add($data){
//        echo "<pre>";
//        print_r($data);
//        die;
        $this->db->insert('sbs_team',$data['team']);
         if ($this->db->affected_rows() > 0) {
           
            $this->session->unset_userdata('team');
            return true;
        } else {
            return false;
        }
        
    }
    function team_list(){
        $query=$this->db->get('sbs_team');
        $i=0;
        $list=array();
        if ($query->num_rows() > 0){
        foreach($query->result_array() as $val){
            $list[$i]['name']=$val['name'];
            $list[$i]['url']=$val['url'];
            $list[$i]['description']=$val['description'];
            $list[$i]['status']=$val['status'];
            $list[$i]['image']=$val['image'];
            $list[$i]['social']=explode(',',$val['social']);
            $list[$i]['id']=$val['id'];
            $i++;
        }
        }
        return $list;
    }
    function team_edit($id){
        $this->db->where('id',$id);
        $query=$this->db->get('sbs_team');
        $data=$query->row_array();
        return $data;
    }
    function team_update($data,$id){
       
  
        $this->db->where('id',$id);
        $this->db->update('sbs_team',$data['team']);
        if($this->db->affected_rows()>0){
            
            return true;
        }
        else{
            return false;
        }
    }
}