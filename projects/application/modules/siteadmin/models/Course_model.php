<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class course_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function course_add($data) {
        $this->db->insert('sbs_course', $data['course_info']);
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('course_add');
            return true;
        } else {
            return false;
        }
    }

    function course_list() {
        $query = $this->db->get('sbs_course');
        $i = 0;
        foreach ($query->result_array() as $var) {

            $cl[$i]['id'] = $var['id'];
            $cl[$i]['title'] = $var['title'];
            $cl[$i]['url'] = $var['url'];
            $cl[$i]['details'] = $var['details'];
            $cl[$i]['duration_type'] = $var['duration_type'];
            $cl[$i]['duration'] = $var['duration'];
            $cl[$i]['price'] = $var['price'];
            $cl[$i]['price_breakup'] = explode(',', $var['price_breakup']);
            $cl[$i]['image'] = $var['image'];
            $cl[$i]['status'] = $var['status'];
            $i++;
        }
        return $cl;
    }

    function course_edit($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sbs_course');
        $result = $query->row_array();
        return $result;
    }

    function course_update($update) {

        $this->db->where('id', $update['course_info']['id']);
        $this->db->update('sbs_course', $update['course_info']);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function course_list_join() {
        $list='';
        $this->db->select('title,id');
        $this->db->where('status', 'active');
        $query = $this->db->get('sbs_course');
        $i = 0;
        foreach ($query->result_array() as $val) {
            $list[$i]['id'] = $val['id'];
            $list[$i]['course_title'] = $val['title'];
            $i++;
        }
//        print_r($list);
        return $list;
        
    }

    function stylist() {
        $list='';
        $this->db->select('name,id');
        $this->db->where('status', 'active');
        $query = $this->db->get('sbs_stylist');
        $i = 0;
        foreach ($query->result_array() as $val) {
            $list[$i]['id'] = $val['id'];
            $list[$i]['name'] = $val['name'];
            $i++;
        }
        return $list;
    }
function joining( $c_join){
   
    $result=$this->db->insert('sbs_course_join_application',$c_join);
    
    if($result){
        return true;
    }else{
        return false;
    }
}
function course_joining_list(){
    
    $this->db->select('cj.*,c.title,s.name');
    $this->db->from('sbs_course_join_application as cj');
    $this->db->join('sbs_course as c','cj.course_id=c.id');
    $this->db->join('sbs_stylist as s','cj.stylish_id=s.id');
    $this->db->order_by('date_join','desc');
    $query=$this->db->get();
    $list=array();
    $i=0;
    foreach($query->result_array() as $cor){
        $list[$i]['cj_id']=$cor['id'];
        $list[$i]['course_name']=$cor['title'];
        $list[$i]['stylist_name']=$cor['name'];
        $list[$i]['date_join']=$cor['date_join'];
        $list[$i]['id_code']=$cor['id_code'];
        $list[$i]['date_change_status']=$cor['date_change_status'];
        $list[$i]['status']=$cor['status'];
        $i++;
    }
//    print_r($list);die;
   return $list;
}
function join_status_change($id){
   $this->db->select('status');
   $this->db->where('id',$id);
   $query=$this->db->get('sbs_course_join_application');
   $result=$query->row_array();
//   print_r($result);die;
   if($result['status']=='active'){
       $this->db->set('status','inactive');
       $this->db->set('date_change_status',date("Y-m-d H:i:s"));
   $this->db->where('id',$id);
   $this->db->update('sbs_course_join_application');
   echo 'inactive';
   }else{
       echo 'active';
        $this->db->set('status','active');
      $this->db->set('date_change_status',date("Y-m-d H:i:s"));
   $this->db->where('id',$id);
   $this->db->update('sbs_course_join_application');
   }
   
}
}
