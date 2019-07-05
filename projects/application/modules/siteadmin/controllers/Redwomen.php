<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Redwomen extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('redwomen_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('redwomenadminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

        $data['title'] = 'Redwomen Add';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';


        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/js/textarea/autosize.min.js';


        $this->load->view('header', $data);
        $this->load->view('redwomen/redwomen');
        $this->load->view('footer');
    }

    public function addredwomen() {

        $this->form_validation->set_rules('name', 'Redwomen name', 'required');
        $this->form_validation->set_rules('title', 'Redwomen title', 'required');
        $this->form_validation->set_rules('company', 'Redwomen company', 'required');
        $this->form_validation->set_rules('email', 'Redwomen email', 'required');
        $this->form_validation->set_rules('phone', 'Redwomen phone', 'required');


        $this->form_validation->set_rules('country', 'Redwomen country', 'required');
        $this->form_validation->set_rules('state', 'Redwomen state', 'required');
        $this->form_validation->set_rules('city', 'Redwomen city', 'required');
        $this->form_validation->set_rules('zip', 'Redwomen zip', 'required');
        $this->form_validation->set_rules('services', 'Redwomen services', 'required');
        $this->form_validation->set_rules('descr', 'Redwomen description', 'required');




        $this->form_validation->set_rules('status', 'Redwomen status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('redwomen', $_POST);
            redirect(base_url() . 'siteadmin/redwomen', 'refresh');
        } else {
            $imgdata = '';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/redwomen/';
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
                    redirect(base_url() . 'siteadmin/redwomen', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/redwomen/' . $image['file_name'];
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

            $data['red_women'] = array(
                'red_women_name' => $this->input->post('name'),
                'red_women_title' => $this->input->post('title'),
                'red_women_company' => $this->input->post('company'),
                'red_women_img' => $imgdata,
                'red_women_email' => $this->input->post('email'),
                'red_women_city' => $this->input->post('city'),
                'red_women_state' => $this->input->post('state'),
                'red_women_country' => $this->input->post('country'),
                'red_women_zip' => $this->input->post('zip'),
                'red_women_phone' => $this->input->post('phone'),
                'red_women_services' => $this->input->post('services'),
                'red_women_about' => $this->input->post('descr'),
                'red_women_status' => $this->input->post('status')
            );
            $data['red_women_social'] = array(
                'red_women_social_type' => 'facebook,twitter,google-plus,pinterest,linkedin,youtube,instagram',
                'red_women_social_link' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
            );
            $return = $this->redwomen_model->addredwomen($data);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> save successfully </div>');
                redirect(base_url() . 'siteadmin/redwomen/redwomenlist', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/redwomen', 'refresh');
            }
        }
    }

    public function redwomenlist() {

        $data['title'] = 'Redwomen List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage'] = $this->redwomen_model->redwomenlist();
        $this->load->view('redwomen/redwomen_list', $data);
        $this->load->view('footer');
    }

    public function redwomenedit($id) {

        if (empty($id)) {

            show_404();
        }

        $data['title'] = 'Redwomen Edit';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';


        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/js/textarea/autosize.min.js';


        $this->load->view('header', $data);

        $data['details'] = $this->redwomen_model->details($id);
        $this->session->set_userdata('redwomen', $data['details']);

        $this->load->view('redwomen/redwomenedit');
        $this->load->view('footer');
    }

    public function editredwomen($id) {
        if (empty($id)) {

            show_404();
        } else {
            $this->form_validation->set_rules('red_women_id', 'Redwomen Id', 'required');
            $this->form_validation->set_rules('name', 'Redwomen name', 'required');
            $this->form_validation->set_rules('title', 'Redwomen title', 'required');
            $this->form_validation->set_rules('company', 'Redwomen company', 'required');
            $this->form_validation->set_rules('email', 'Redwomen email', 'required');
            $this->form_validation->set_rules('phone', 'Redwomen phone', 'required');


            $this->form_validation->set_rules('country', 'Redwomen country', 'required');
            $this->form_validation->set_rules('state', 'Redwomen state', 'required');
            $this->form_validation->set_rules('city', 'Redwomen city', 'required');
            $this->form_validation->set_rules('zip', 'Redwomen zip', 'required');
            $this->form_validation->set_rules('services', 'Redwomen services', 'required');
            $this->form_validation->set_rules('descr', 'Redwomen description', 'required');




            $this->form_validation->set_rules('status', 'Redwomen status', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
                $this->session->set_userdata('redwomen', $_POST);
                redirect(base_url() . 'siteadmin/redwomen/redwomenedit/'.$id, 'refresh');
            } else {
                $imgdata = $this->input->post('img');
                if ($_FILES['image']['name'] != "") {
                    $config['upload_path'] = './assets/redwomen/';
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
                        redirect(base_url() . 'siteadmin/redwomen/redwomenedit/'.$id, 'refresh');
                        die;
                    } else {
                        $image = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/redwomen/' . $image['file_name'];
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

                $data['red_women'] = array(
                    'red_women_name' => $this->input->post('name'),
                    'red_women_title' => $this->input->post('title'),
                    'red_women_company' => $this->input->post('company'),
                    'red_women_img' => $imgdata,
                    'red_women_email' => $this->input->post('email'),
                    'red_women_city' => $this->input->post('city'),
                    'red_women_state' => $this->input->post('state'),
                    'red_women_country' => $this->input->post('country'),
                    'red_women_zip' => $this->input->post('zip'),
                    'red_women_phone' => $this->input->post('phone'),
                    'red_women_services' => $this->input->post('services'),
                    'red_women_about' => $this->input->post('descr'),
                    'red_women_status' => $this->input->post('status')
                );
                $data['red_women_social'] = array(
                    'red_women_social_type' => 'facebook,twitter,google-plus,pinterest,linkedin,youtube,instagram',
                    'red_women_social_link' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
                );
                $return = $this->redwomen_model->editredwomen($data,$id);
                if ($return) {

                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> save successfully </div>');
                    redirect(base_url() . 'siteadmin/redwomen/redwomenlist', 'refresh');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No changes found</div>');
                    redirect(base_url() . 'siteadmin/redwomen/redwomenedit/'.$id, 'refresh');
                }
            }
        }
    }

}
