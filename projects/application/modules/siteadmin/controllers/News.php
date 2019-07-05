<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('news_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

        $data['title'] = 'News Add';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';


        $this->load->view('header', $data);
        $this->load->view('news/news');
        $this->load->view('footer');
    }

    public function addnews() {

        $this->form_validation->set_rules('title', 'News Title', 'required');
        $this->form_validation->set_rules('url', 'News Url', 'required');
        $this->form_validation->set_rules('descr', 'News Description', 'required');
        $this->form_validation->set_rules('pdate', 'News Published Date', 'required');
        $this->form_validation->set_rules('author', 'News Author', 'required');
        $this->form_validation->set_rules('status', 'News status', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('news', $_POST);
            redirect(base_url() . 'siteadmin/news', 'refresh');
        } else {
            $imgdata = '';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/news/';
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
                    redirect(base_url() . 'siteadmin/news', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/news/' . $image['file_name'];
                    $config['create_thumb'] = true;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 200;
                    $config['height'] = 200;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
                $imgdata = $image['file_name'];
            }



            $data['news'] = array(
                'news_title' => $this->input->post('title'),
                'news_url' => $this->input->post('url'),
                'news_description' => $this->input->post('descr'),
                'news_img' => $imgdata,
                'news_author' => $this->input->post('author'),
                'news_create_date' => $this->input->post('pdate'),
                'news_status' => $this->input->post('status')
            );
            $data['author_social'] = array(
                'news_author_social_type' => 'facebook,twitter,google-plus,pinterest,linkedin,youtube,instagram',
                'news_author_social_link' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
            );
            $return = $this->news_model->addnews($data);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['news']['news_title'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/news/newslist', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/news', 'refresh');
            }
        }
    }

    public function newslist() {

        $data['title'] = 'News List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage'] = $this->news_model->newslist();
        $this->load->view('news/news_list', $data);
        $this->load->view('footer');
    }

    public function newsedit($id) {
        if (empty($id)) {

            show_404();
        }


        $data['title'] = 'News Edit';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';


        $this->load->view('header', $data);
        $data['details'] = $this->news_model->details($id);
        $this->session->set_userdata('news', $data['details']);
        $this->load->view('news/newsedit');
        $this->load->view('footer');
    }

    public function editnews($id) {

        if (empty($id)) {

            show_404();
        } else {

            $this->form_validation->set_rules('news_id', 'News Id', 'required');
            $this->form_validation->set_rules('title', 'News Title', 'required');
            $this->form_validation->set_rules('url', 'News Url', 'required');
            $this->form_validation->set_rules('descr', 'News Description', 'required');
            $this->form_validation->set_rules('pdate', 'News Published Date', 'required');
            $this->form_validation->set_rules('author', 'News Author', 'required');
            $this->form_validation->set_rules('status', 'News status', 'required');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
                $this->session->set_userdata('news', $_POST);
                redirect(base_url() . 'siteadmin/news/newsedit/'.$id, 'refresh');
            } else {
                $imgdata = $this->input->post('img');
                if ($_FILES['image']['name'] != "") {
                    $config['upload_path'] = './assets/news/';
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
                        redirect(base_url() . 'siteadmin/news/newsedit/'.$id, 'refresh');
                        die;
                    } else {
                        $image = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/news/' . $image['file_name'];
                        $config['create_thumb'] = true;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 200;
                        $config['height'] = 200;

                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                    $imgdata = $image['file_name'];
                }



                $data['news'] = array(
                    'news_title' => $this->input->post('title'),
                    'news_url' => $this->input->post('url'),
                    'news_description' => $this->input->post('descr'),
                    'news_img' => $imgdata,
                    'news_author' => $this->input->post('author'),
                    'news_create_date' => $this->input->post('pdate'),
                    'news_status' => $this->input->post('status')
                );
                $data['author_social'] = array(
                    'news_author_social_type' => 'facebook,twitter,google-plus,pinterest,linkedin,youtube,instagram',
                    'news_author_social_link' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
                );
                $return = $this->news_model->editnews($data,$this->input->post('news_id'));
                if ($return) {

                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['news']['news_title'] . '  save successfully </div>');
                    redirect(base_url() . 'siteadmin/news/newslist', 'refresh');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No changes found</div>');
                    redirect(base_url() . 'siteadmin/news/newsedit/'.$id, 'refresh');
                }
            }
        }
    }

}
