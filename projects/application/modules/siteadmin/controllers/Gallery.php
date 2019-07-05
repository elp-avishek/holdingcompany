<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('gallery_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

       if (!$this->session->userdata('redwomenadminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

        $pagetitle = array('title' => 'Gallery');
        $this->load->view('header', $pagetitle);
         $data['gallery'] = $this->gallery_model->listgallery();
        $this->load->view('gallery/gallery',$data);
        $this->load->view('footer');
    }

    public function addgallery() {

      
            $imgdata ='';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/gallery/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                    redirect(base_url() . 'siteadmin/gallery', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/gallery/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 400;
                    $config['height'] = 400;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
                $imgdata = $image['file_name'];
            }
            if($imgdata){
            $data = array(
                'gallery_img_credit' => $this->input->post('photocredit'),
                'gallery_img' => $imgdata,
                'gallery_status' => 'active'
                
            );
           
            $return = $this->gallery_model->addgallery($data);
             }
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> save successfully </div>');
                redirect(base_url() . 'siteadmin/gallery', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/gallery', 'refresh');
            }
        }
        
         public function changestatus($id){
        
        if (empty($id)) {

            show_404();
        }else{
             $return = $this->gallery_model->changestatus($id);
            
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Status Changed</div>');
                redirect(base_url() . 'siteadmin/gallery', 'refresh');
            }
            
        }
        
    }
    }

