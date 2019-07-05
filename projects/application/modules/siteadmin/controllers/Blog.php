<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('blog_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

        $data['title'] = 'Blog Add';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';


        $this->load->view('header', $data);
        $this->load->view('blog/blog');
        $this->load->view('footer');
    }

    public function addblog() {

        $this->form_validation->set_rules('title', 'Blog Title', 'required');
        $this->form_validation->set_rules('url', 'Blog Url', 'required');
        $this->form_validation->set_rules('descr', 'Blog Description', 'required');
        $this->form_validation->set_rules('pdate', 'Blog Published Date', 'required');
        $this->form_validation->set_rules('author', 'Blog Author', 'required');
        $this->form_validation->set_rules('status', 'Blog status', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('blog', $_POST);
            redirect(base_url() . 'siteadmin/blog', 'refresh');
        } else {
            $imgdata = '';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/blog/';
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
                    redirect(base_url() . 'siteadmin/blog', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/blog/' . $image['file_name'];
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



            $data['blog'] = array(
                'blog_title' => $this->input->post('title'),
                'blog_url' => $this->input->post('url'),
                'blog_description' => $this->input->post('descr'),
                'blog_img' => $imgdata,
                'blog_author' => $this->input->post('author'),
                'blog_create_date' => date("Y-m-d H:i:s",strtotime($this->input->post('pdate'))),
                'blog_status' => $this->input->post('status'),
                'blog_author_type' => 'admin',
                'blog_user_id' => 0,
            );
            $data['author_social'] = array(
                'blog_author_social_type' => 'facebook,twitter,google-plus,pinterest,linkedin,youtube,instagram',
                'blog_author_social_link' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
            );
            $return = $this->blog_model->addblog($data);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['blog']['blog_title'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/blog/bloglist', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/blog', 'refresh');
            }
        }
    }

    public function bloglist() {

        $data['title'] = 'Blog List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage'] = $this->blog_model->bloglist();
        $this->load->view('blog/blog_list', $data);
        $this->load->view('footer');
    }

    public function blogedit($id) {
        if (empty($id)) {

            show_404();
        }

        $data['title'] = 'Blog Edit';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';

        $data['details'] = $this->blog_model->details($id);
        $this->session->set_userdata('blog', $data['details']);

        $this->load->view('header', $data);
        $this->load->view('blog/blogedit');
        $this->load->view('footer');
    }

    public function editblog($id) {
        if (empty($id)) {

            show_404();
        } else {
            
            $this->form_validation->set_rules('blog_id', 'Blog Id', 'required');
            $this->form_validation->set_rules('title', 'Blog Title', 'required');
            $this->form_validation->set_rules('url', 'Blog Url', 'required');
            $this->form_validation->set_rules('descr', 'Blog Description', 'required');
            $this->form_validation->set_rules('pdate', 'Blog Published Date', 'required');
            $this->form_validation->set_rules('author', 'Blog Author', 'required');
            $this->form_validation->set_rules('status', 'Blog status', 'required');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
                redirect(base_url() . 'siteadmin/blog/blogedit/'.$id, 'refresh');
            } else {
                $imgdata = $this->input->post('img');
                if ($_FILES['image']['name'] != "") {
                    $config['upload_path'] = './assets/blog/';
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
                        redirect(base_url() . 'siteadmin/blog/blogedit/'.$id, 'refresh');
                        die;
                    } else {
                        $image = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/blog/' . $image['file_name'];
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



                $data['blog'] = array(
                    'blog_title' => $this->input->post('title'),
                    'blog_url' => $this->input->post('url'),
                    'blog_description' => $this->input->post('descr'),
                    'blog_img' => $imgdata,
                    'blog_author' => $this->input->post('author'),
                    'blog_create_date' => date("Y-m-d H:i:s",strtotime($this->input->post('pdate'))),
                    'blog_status' => $this->input->post('status')
                );
                $data['author_social'] = array(
                    'blog_author_social_type' => 'facebook,twitter,google-plus,pinterest,linkedin,youtube,instagram',
                    'blog_author_social_link' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
                );
                $return = $this->blog_model->editblog($data,$this->input->post('blog_id'));
                if ($return) {

                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['blog']['blog_title'] . '  Update successfully </div>');
                    redirect(base_url() . 'siteadmin/blog/bloglist', 'refresh');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No changes found</div>');
                    redirect(base_url() . 'siteadmin/blog/blogedit/'.$id, 'refresh');
                }
            }
        }
    }

}
