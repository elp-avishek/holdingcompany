<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class news_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function addnews($data) {

        $this->db->insert('sbs_news', $data['news']);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $data['author_social']['news_id'] = $item_id;
            $this->db->insert('sbs_news_author_social', $data['author_social']);
            $this->session->unset_userdata('news');
            return true;
        } else {
            return false;
        }
    }

    
    public function newslist() {
        
        $this->db->order_by('news_create_date DESC');
        $query = $this->db->get('sbs_news');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $news) {

                $list[$i]['social'] = $this->social($news['news_id']);
                $list[$i]['news_id'] = $news['news_id'];
                $list[$i]['news_title'] = $news['news_title'];
                $list[$i]['news_url'] = $news['news_url'];
                $list[$i]['news_description'] = $news['news_description'];
                $list[$i]['news_img'] = $news['news_img'];
                $list[$i]['news_author'] = $news['news_author'];
                  $list[$i]['news_status'] = $news['news_status'];
                $list[$i]['news_create_date'] = $news['news_create_date'];
                $i++;
            }
        }
        return $list;
    }

    public function social($id) {
        $socialsite = array('facebook', 'twitter', 'google-plus', 'pinterest', 'linkedin', 'youtube', 'instagram');
        $this->db->where('news_id', $id);
        $querysaocial = $this->db->get('sbs_news_author_social');
        $social = array();
        $sociallink = array();
        if ($querysaocial->num_rows() > 0) {

            $sociallink = $querysaocial->row_array();
        }
        if (!empty($sociallink)) {
            $sociallink = explode(",", $sociallink['news_author_social_link']);

            foreach ($socialsite as $index => $sos) {
                if (!empty($sociallink[$index])) {
                    $social[$sos] = $sociallink[$index];
                }
            }
        }
        return $social;
    }
    public function details($newsid) {
        $this->db->where('news_id', $newsid);
        $this->db->order_by('news_create_date DESC');
        $this->db->limit('5');
        $query = $this->db->get('sbs_news');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list=$query->row_array();
            $list['social'] = $this->social($newsid);
            
          
        }
        return $list;
    }
    
     public function editnews($data,$newsid) {
        $this->db->where('news_id',$newsid);
        $this->db->update('sbs_news', $data['news']);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            if(empty($data['author_social'])){
                
            return false;
            
            }
            
            $this->db->where('news_id', $newsid);
            $social_qry = $this->db->get('sbs_news_author_social');
            if($social_qry->num_rows() > 0){
                $this->db->where('news_id', $newsid);
                $this->db->update('sbs_news_author_social', $data['author_social']); 
                
            }else{
              $data['author_social']['news_id'] = $newsid;
              $this->db->insert('sbs_news_author_social', $data['author_social']);  
            }
                                 
            $this->session->unset_userdata('news');
            return true;
        } else {
             if(empty($data['author_social'])){
                
            return false;
            
            }
            
            $this->db->where('news_id', $newsid);
            $social_qry = $this->db->get('sbs_news_author_social');
            if($social_qry->num_rows() > 0){
                $this->db->where('news_id', $newsid);
                $this->db->update('sbs_news_author_social', $data['author_social']); 
                
            }else{
              $data['author_social']['news_id'] = $newsid;
              $this->db->insert('sbs_news_author_social', $data['author_social']);  
            }
                                 
            $this->session->unset_userdata('news');
            return true;
        }
    }

}
