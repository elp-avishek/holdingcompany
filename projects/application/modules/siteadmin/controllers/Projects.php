<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projects extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('projects_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('redwomenadminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

        $data['title'] = 'Projects Add';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';


        $this->load->view('header', $data);
        $this->load->view('projects/projects');
        $this->load->view('footer');
    }

    public function addprojects() {

        $this->form_validation->set_rules('title', 'Project Title', 'required');
        $this->form_validation->set_rules('url', 'Project Url', 'required');
        $this->form_validation->set_rules('descr', 'Project Description', 'required');
        $this->form_validation->set_rules('pdate', 'Project Date', 'required');
        $this->form_validation->set_rules('location', 'Project location', 'required');

        $this->form_validation->set_rules('status', 'Event status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('projects', $_POST);
            redirect(base_url() . 'siteadmin/projects', 'refresh');
        } else {
            $imgdata = '';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/projects/';
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
                    redirect(base_url() . 'siteadmin/projects', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/projects/' . $image['file_name'];
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
                'projects_title' => $this->input->post('title'),
                'projects_url' => $this->input->post('url'),
                'projects_details' => $this->input->post('descr'),
                'projects_img' => $imgdata,
                'projects_date' => $this->input->post('pdate'),
                'projects_where' => $this->input->post('location'),
                'projects_status' => $this->input->post('status')
            );

            $return = $this->projects_model->addprojects($data);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> save successfully </div>');
                redirect(base_url() . 'siteadmin/projects/projectslist', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/projects', 'refresh');
            }
        }
    }

    public function projectslist() {

        $data['title'] = 'Projects List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage'] = $this->projects_model->projectslist();
        $this->load->view('projects/projects_list', $data);
        $this->load->view('footer');
    }

    public function projectsedit($id) {

        if (empty($id)) {

            show_404();
        }

        $data['title'] = 'Projects Edit';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';


        $this->load->view('header', $data);
        $data['details'] = $this->projects_model->details($id);
        $this->session->set_userdata('projects', $data['details']);

        $this->load->view('projects/projectsedit');
        $this->load->view('footer');
    }

    public function editprojects($id) {
        if (empty($id)) {

            show_404();
        } else {
            $this->form_validation->set_rules('projects_id', 'projects id', 'required');
            $this->form_validation->set_rules('title', 'Project Title', 'required');
            $this->form_validation->set_rules('url', 'Project Url', 'required');
            $this->form_validation->set_rules('descr', 'Project Description', 'required');
            $this->form_validation->set_rules('pdate', 'Project Date', 'required');
            $this->form_validation->set_rules('location', 'Project location', 'required');

            $this->form_validation->set_rules('status', 'Event status', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
                $this->session->set_userdata('projects', $_POST);
                redirect(base_url() . 'siteadmin/projects/projectsedit/'.$id, 'refresh');
            } else {
                $imgdata = $this->input->post('img');
                if ($_FILES['image']['name'] != "") {
                    $config['upload_path'] = './assets/projects/';
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
                        redirect(base_url() . 'siteadmin/projects/projectsedit/'.$id, 'refresh');
                        die;
                    } else {
                        $image = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/projects/' . $image['file_name'];
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
                    'projects_title' => $this->input->post('title'),
                    'projects_url' => $this->input->post('url'),
                    'projects_details' => $this->input->post('descr'),
                    'projects_img' => $imgdata,
                    'projects_date' => $this->input->post('pdate'),
                    'projects_where' => $this->input->post('location'),
                    'projects_status' => $this->input->post('status')
                );

                $return = $this->projects_model->editprojects($data,$id);
                if ($return) {

                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> save successfully </div>');
                    redirect(base_url() . 'siteadmin/projects/projectslist', 'refresh');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No changes found</div>');
                    redirect(base_url() . 'siteadmin/projects/projectsedit/'.$id, 'refresh');
                }
            }
        }
    }

}
