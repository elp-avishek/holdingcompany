<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimonial  extends CI_Controller{
     
    function __construct() {
        parent::__construct();
        $this->load->database();
          $this->load->model('testimonial_model');
          $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }
    function index() {
        $data['title'] = 'Testimonial';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
//        $data['javascripts'][] = 'admin/jquery.min.js';
        $this->load->view('header', $data);
        $this->load->view('testimonial/testimonial', $data);
        $this->load->view('footer');
    }
    function add_testimonial(){
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('email','email','required|valid_email');
        $this->form_validation->set_rules('comment','comment','required');
        if($this->form_validation->run()==FALSE){
             $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
             $this->session->set_userdata('testimonial', $_POST);
            redirect(base_url('siteadmin/testimonial'), 'refresh');
        }
        $data=array(
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
        'comment'=>$this->input->post('comment')
        );
//        print_r($data);
        $insert=$this-> testimonial_model->add_testimonial($data);
         if($insert){

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['name'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/testimonial', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No Change </div>');
                redirect(base_url() . 'siteadmin/testimonial', 'refresh');
            }
    }
    function testimonial_list(){
        $data['title']='Testimonial';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
         $this->load->view('header', $data);
         $data['t_list']=$this->testimonial_model->testimonial_list();
        $this->load->view('testimonial/testimonial_list',$data);
        $this->load->view('footer');
       
    }
    function testimonial_update($id){
        $data['title']='Update Testimonial';
         $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $this->load->view('header',$data);
       $data['update']=$this->testimonial_model->testimonial_update($id);
        $this->load->view('testimonial/testimonial_update',$data);
         $this->load->view('footer');
        
    }
    function testimonial_update_process($id){
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('email','email','required|valid_email');
        $this->form_validation->set_rules('comment','comment','required');
        if($this->form_validation->run()==FALSE){
             $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
             $this->session->set_userdata('testimonial', $_POST);
            redirect(base_url('siteadmin/testimonial/testimonial_update/'.$id), 'refresh');
        }
        $data=array(
            'id'=>$id,
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
        'comment'=>$this->input->post('comment'),
        'status'=>$this->input->post('status')
        );
        $update=$this-> testimonial_model->update_testimonial($data);
         if($update){

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['name'] . ' updated successfully </div>');
                redirect(base_url() . 'siteadmin/testimonial/testimonial_list', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No Change </div>');
                redirect(base_url() . 'siteadmin/testimonial/testimonial_list', 'refresh');
            }
    }
}