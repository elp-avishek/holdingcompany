<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class redwomen_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function addredwomen($data) {

        $this->db->insert('rw_red_women', $data['red_women']);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
             $data['red_women_social']['red_women_id'] = $item_id;
            $this->db->insert('rw_red_women_social', $data['red_women_social']);
            $this->session->unset_userdata('redwomen');
            return true;
        } else {
            return false;
        }
    }

    public function redwomenlist() {


        $this->db->order_by('red_women_id DESC');
        $query = $this->db->get('rw_red_women');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
        }
        return $list;
    }
    public function details($redwomenid) {
       
        $this->db->where('red_women_id',$redwomenid);
       $this->db->order_by('red_women_name ASC');
        $query = $this->db->get('rw_red_women');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->row_array();
            $list['social'] = $this->social($redwomenid);
        }
        return $list;

    }
    public function social($id) {
        $socialsite = array('facebook', 'twitter', 'google-plus', 'pinterest', 'linkedin', 'youtube', 'instagram');
        $this->db->where('red_women_id', $id);
        $querysaocial = $this->db->get('rw_red_women_social');
        $social = array();
        $sociallink = array();
        if ($querysaocial->num_rows() > 0) {

            $sociallink = $querysaocial->row_array();
        }
        if (!empty($sociallink)) {
           @ $sociallink = explode(",", $sociallink['red_women_social_link']);

            foreach ($socialsite as $index => $sos) {
                if (!empty($sociallink[$index])) {
                    $social[$sos] = $sociallink[$index];
                }
            }
        }
        return $social;
    }
    public function editredwomen($data,$id) {
        $this->db->where('red_women_id', $id);
        $this->db->update('rw_red_women', $data['red_women']);
        $item_id = $this->db->insert_id();
       if ($this->db->affected_rows() > 0) {
            if(empty($data['red_women_social'])){
                
            return false;
            
            }
            
            $this->db->where('red_women_id', $id);
            $social_qry = $this->db->get('rw_red_women_social');
            if($social_qry->num_rows() > 0){
                $this->db->where('red_women_id', $id);
                $this->db->update('rw_red_women_social', $data['red_women_social']); 
                
            }else{
              $data['red_women_social']['red_women_id'] = $id;
              $this->db->insert('rw_red_women_social', $data['red_women_social']);  
            }
                                 
            $this->session->unset_userdata('redwomen');
            return true;
        } else {
             if(empty($data['red_women_social'])){
                
            return false;
            
            }
            
            $this->db->where('red_women_id', $id);
            $social_qry = $this->db->get('rw_red_women_social');
            if($social_qry->num_rows() > 0){
                $this->db->where('red_women_id', $id);
                $this->db->update('rw_red_women_social', $data['red_women_social']); 
                
            }else{
              $data['red_women_social']['red_women_id'] = $id;
              $this->db->insert('rw_red_women_social', $data['red_women_social']);  
            }
                                 
            $this->session->unset_userdata('redwomen');
            return true;
        }
    }
}

