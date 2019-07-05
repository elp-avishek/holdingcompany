<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class stylist_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function stylist_list(){
        $this->db->order_by('date_added DESC');
        $query=$this->db->get('sbs_stylist');
        $result=$query->result_array();
        $i=0;
        $list=array();
        foreach($result as $val){
            $list[$i]['id']=$val['id'];
            $list[$i]['name']=$val['name'];
            $list[$i]['url']=$val['url'];
            $list[$i]['email']=$val['email'];
            $list[$i]['password']=$val['password'];
            $list[$i]['image']=$val['image'];
            $list[$i]['social']=explode(',',$val['social']);
            $list[$i]['school_completed']=$val['school_completed'];
            $list[$i]['license_number']=$val['license_number'];
            $list[$i]['how_did_you_find_us']=$val['how_did_you_find_us'];
            $list[$i]['date_added']=$val['date_added'];
            $list[$i]['status']=$val['status'];
            $i++ ;
        }
        return $list;
    }
    public function stylist_add($data){
        
        $this->db->insert('sbs_stylist',$data['stylist']);
        if($this->db->affected_rows()>0){
            $this->session->unset_userdata('stylist');
            return true;
        }else {
            return false;
        }
    }
    public function stylist_edit($id){
//        echo $id;die;
        $this->db->where('id',$id);
        $res=$this->db->get('sbs_stylist');
        $data=$res->row_array();
        return $data;
    }
    public function stylist_update($data){
        $this->db->where('id',$data['stylist']['id']);
        $this->db->update('sbs_stylist',$data['stylist']);
        if($this->db->affected_rows()>0){
              $this->session->unset_userdata('stylist');
            return true;
        }else{
            return false;
        }
    }
}

