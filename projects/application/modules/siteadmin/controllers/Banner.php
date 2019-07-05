<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('banner_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('date');

        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

        $pagetitle = array('title' => 'Banner');
        $this->load->view('header', $pagetitle);
        $data['banner'] = $this->banner_model->listbanner();
        $this->load->view('banner/banner',$data);
        $this->load->view('footer');
    }

    public function addbanner() {

        $this->form_validation->set_rules('banner_type', 'Banner Type', 'required');

        if ($this->input->post('banner_type') == 'img') {

            $imgdata = '';
        }
        if ($this->input->post('banner_type') == 'video') {

            $this->form_validation->set_rules('videourl', 'Video Url', 'required');
             $imgdata = $this->input->post('videourl');
        }
       

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('banner', $_POST);
            redirect(base_url() . 'siteadmin/banner', 'refresh');
        } else {
            
            if ($_FILES['banner']['name'] != "" && $this->input->post('banner_type') == 'img') {
                $config['upload_path'] = './assets/banner/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('banner')) {
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                    redirect(base_url() . 'siteadmin/banner', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/banner/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 1009;
                    $config['height'] = 411;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
                $imgdata = $image['file_name'];
            }
            if($imgdata){
            $data = array(
                'banner_type' => $this->input->post('banner_type'),
                'banner_data' => $imgdata,
                'banner_status' => 'active'
                
            );
           
            $return = $this->banner_model->addbanner($data);
             }
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> save successfully </div>');
                redirect(base_url() . 'siteadmin/banner', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/banner', 'refresh');
            }
        }
    }
    
    
    public function changestatus($id){
        
        if (empty($id)) {

            show_404();
        }else{
             $return = $this->banner_model->changestatus($id);
            
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Status Changed</div>');
                redirect(base_url() . 'siteadmin/banner', 'refresh');
            }
            
        }
        
    }

}
