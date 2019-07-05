<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Magazine extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('magazine_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('redwomenadminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

        $data['title'] = 'Magazine Add';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $this->load->view('header', $data);
        $this->load->view('magazine/magazine');
        $this->load->view('footer');
    }

    public function addmagazine() {

        $this->form_validation->set_rules('descr', 'Magazine Description', 'required');
        $this->form_validation->set_rules('bcost', 'Business Cost / month', 'required');
        $this->form_validation->set_rules('icost', 'Individual Cost / month', 'required');

        $this->form_validation->set_rules('status', 'Event status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('magazine', $_POST);
            redirect(base_url() . 'siteadmin/magazine', 'refresh');
        } else {
            $imgdata = $_POST['img'];
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/magazine/';
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
                    redirect(base_url() . 'siteadmin/magazine', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/magazine/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 200;
                    $config['height'] = 200;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
                $imgdata = $image['file_name'];
            }


            $data = array(
                'magazine_details' => $this->input->post('descr'),
                'magazine_business_cost' => $this->input->post('bcost'),
                'magazine_individual_cost' => $this->input->post('icost'),
                'magazine_img' => $imgdata,
                'magazine_status' => $this->input->post('status'),
                'create_date'=>date("Y-m-d H:i:s")
            );

            $return = $this->magazine_model->addmagazine($data);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>save successfully </div>');
                redirect(base_url() . 'siteadmin/magazine/magazinelist', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/magazine', 'refresh');
            }
        }
    }

    public function magazinelist() {
       
        $data['title'] = 'Magazine List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage']=$this->magazine_model->magazinelist();
        $this->load->view('magazine/magazine_list', $data);
        $this->load->view('footer');
    }
     public function magazineedit($id) {
        if (empty($id)) {

            show_404();
        }

        $data['title'] = 'Magazine Edit';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
       

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
       

        $data['details'] = $this->magazine_model->details($id);
        $this->session->set_userdata('magazine', $data['details']);

        $this->load->view('header', $data);
        $this->load->view('magazine/magazineedit');
        $this->load->view('footer');
    }
    public function subscriberlist() {
       
        $data['title'] = 'Subscriber List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage']=$this->magazine_model->subscriberlist();
        $this->load->view('magazine/subscriberlist', $data);
        $this->load->view('footer');
    }
    
}
