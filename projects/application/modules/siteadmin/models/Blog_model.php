<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class blog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function addblog($data) {

        $this->db->insert('rw_blog', $data['blog']);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $data['author_social']['blog_id'] = $item_id;
            $this->db->insert('rw_blog_author_social', $data['author_social']);
            $this->session->unset_userdata('blog');
            return true;
        } else {
            return false;
        }
    }

    public function bloglist() {
        $this->db->order_by('blog_create_date DESC');
        $query = $this->db->get('rw_blog');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $news) {

                $list[$i]['social'] = $this->social($news['blog_id']);
                $list[$i]['blog_id'] = $news['blog_id'];
                $list[$i]['blog_title'] = $news['blog_title'];
                $list[$i]['blog_url'] = $news['blog_url'];
                $list[$i]['blog_description'] = $news['blog_description'];
                $list[$i]['blog_img'] = $news['blog_img'];
                $list[$i]['blog_author'] = $news['blog_author'];
                $list[$i]['blog_status'] = $news['blog_status'];
                $list[$i]['blog_author_type'] = $news['blog_author_type'];
                $list[$i]['blog_user_email'] = $this->userdetails($news['blog_user_id']);
                $list[$i]['blog_create_date'] = $news['blog_create_date'];
                $i++;
            }
        }
        return $list;
    }

    public function social($id) {
        $socialsite = array('facebook', 'twitter', 'google-plus', 'pinterest', 'linkedin', 'youtube', 'instagram');
        $this->db->where('blog_id', $id);
        $querysaocial = $this->db->get('rw_blog_author_social');
        $social = array();
        $sociallink = array();
        if ($querysaocial->num_rows() > 0) {

            $sociallink = $querysaocial->row_array();
        }
        if (!empty($sociallink)) {
            $sociallink = explode(",", $sociallink['blog_author_social_link']);

            foreach ($socialsite as $index => $sos) {
                if (!empty($sociallink[$index])) {
                    $social[$sos] = $sociallink[$index];
                }
            }
        }
        return $social;
    }

    public function details($blogid) {
        $this->db->where('blog_id', $blogid);
        $this->db->order_by('blog_create_date DESC');
        $query = $this->db->get('rw_blog');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->row_array();
            $list['social'] = $this->social($blogid);
        }
        return $list;
    }

    public function editblog($data, $blog_id) {
        $this->db->where('blog_id', $blog_id);
        $this->db->update('rw_blog', $data['blog']);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            if(empty($data['author_social'])){
                
            return false;
            
            }
            
            $this->db->where('blog_id', $blog_id);
            $social_qry = $this->db->get('rw_blog_author_social');
            if($social_qry->num_rows() > 0){
                $this->db->where('blog_id', $blog_id);
                $this->db->update('rw_blog_author_social', $data['author_social']); 
                
            }else{
              $data['author_social']['blog_id'] = $blog_id;
              $this->db->insert('rw_blog_author_social', $data['author_social']);  
            }
                                 
            $this->session->unset_userdata('blog');
            return true;
        } else {
             if(empty($data['author_social'])){
                
            return false;
            
            }
            
            $this->db->where('blog_id', $blog_id);
            $social_qry = $this->db->get('rw_blog_author_social');
            if($social_qry->num_rows() > 0){
                $this->db->where('blog_id', $blog_id);
                $this->db->update('rw_blog_author_social', $data['author_social']); 
                
            }else{
              $data['author_social']['blog_id'] = $blog_id;
              $this->db->insert('rw_blog_author_social', $data['author_social']);  
            }
                                 
            $this->session->unset_userdata('blog');
            return true;
        }
    }
    
    public function userdetails($id){
        $userdata = '';
        $this->db->where('id',$id);
        $qry = $this->db->get('rw_user');
        if($qry->num_rows() > 0){
          $data =  $qry->row_array();
          $userdata = $data['user_email'];
        }
        return $userdata;
    }

}
