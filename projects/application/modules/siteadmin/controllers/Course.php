<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Course extends CI_Controller {

    public function __construct() {
        parent::__construct();


        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('course_model');
        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    function index() {
        $data['title'] = 'Course';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
//        $data['javascripts'][] = 'admin/jquery.min.js';
        $this->load->view('header', $data);
        $this->load->view('course/course', $data);
        $this->load->view('footer');
    }

    function add_course() {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('detail', 'details', 'required');
        $this->form_validation->set_rules('price', 'price', 'required|max_length[25]');
        $this->session->set_userdata('course_add', $_POST);


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
//            $this->session->set_userdata('course_add', $_POST);
            redirect(base_url() . 'siteadmin/course', 'refresh');
        } else {
            if (!empty($this->input->post("price_break"))) {
                $sum = 0;
                foreach ($this->input->post("price_break") as $val) {
                    $sum = $sum + $val;
                }

                if ((float) $sum != (float) $this->input->post('price')) {
//                echo $sum;die;
                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>PriceBreak and Price miss match </small></div>');
//                $course_session = $this->session->userdata('course_id_validation');

                    redirect(base_url() . 'siteadmin/course', 'refresh');
                }
            }
            $imgdata = 'noimagedefault.jpg';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/course/';
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
                    redirect(base_url() . 'siteadmin/course', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/course/' . $image['file_name'];
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
            $dur = $this->input->post('duration');
            if (!empty($this->input->post("price_break"))) {
                $prb = implode(',', $this->input->post("price_break"));
            } else {
                $prb = '';
            }
//                for ($i = 0; $i < $dur; $i++) {
//                    $prb = $this->input->post("price_break[$i]") . ',';
//                   $prb=$prb.$prb;
//                }
            $data['course_info'] = array(
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'details' => $this->input->post('detail'),
                'duration_type' => $this->input->post('duration_type'),
                'duration' => $dur,
                'price' => $this->input->post('price'),
                'image' => $imgdata,
                'price_breakup' => $prb,
            );
            $course = $this->course_model->course_add($data);
            if ($course) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['course_info']['title'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/course/course_list', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/course', 'refresh');
            }
        }
    }

    function course_list() {
        $data['title'] = 'Course List';

        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['course'] = $this->course_model->course_list();
        $this->load->view('course/course_list', $data);
        $this->load->view('footer');
    }

    function course_edit($id) {
        $data['title'] = "Course Edit";
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $this->load->view('header', $data);
        $this->session->set_userdata('course_id_validation', $id);
        $data['c_edit'] = $this->course_model->course_edit($id);
        $this->load->view('course/course_edit', $data);
        $this->load->view('footer');
    }

    function course_edit_process() {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('detail', 'details', 'required');
        $this->form_validation->set_rules('price', 'price', 'required|max_length[25]');

        if (!empty($this->input->post("price_break"))) {
            $sum = 0;
            foreach ($this->input->post("price_break") as $val) {
                $sum = $sum + $val;
            }
            if ((float) $sum != (float) $this->input->post('price')) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>PriceBreak and Price mismatch</small></div>');
                $course_session = $this->session->userdata('course_id_validation');
                redirect(base_url() . 'siteadmin/course/course_edit/' . $course_session, 'refresh');
            }
        }
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $course_session = $this->session->userdata('course_id_validation');
            redirect(base_url() . 'siteadmin/course/course_edit/' . $course_session, 'refresh');
        } else {
            $imgdata = $this->input->post('img');
            if ($_FILES['image']['name'] != "") {
//               echo 'hello';die;
                $config['upload_path'] = './assets/course/';
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
                    redirect(base_url() . 'siteadmin/course/course_edit', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/course/' . $image['file_name'];
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
            $dur = $this->input->post('duration');
            if (!empty($this->input->post("price_break"))) {
                $prb = implode(',', $this->input->post("price_break"));
            } else {
                $prb = '';
            }
//                for ($i = 0; $i < $dur; $i++) {
//                    $prb = $this->input->post("price_break[$i]") . ',';
//                   $prb=$prb.$prb;
//                }
            $data['course_info'] = array(
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'details' => $this->input->post('detail'),
                'duration_type' => $this->input->post('duration_type'),
                'duration' => $dur,
                'price' => $this->input->post('price'),
                'image' => $imgdata,
                'price_breakup' => $prb,
                'status' => $this->input->post('status')
            );

            $course_update = $this->course_model->course_update($data);

            if ($course_update) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['course_info']['title'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/course/course_list', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/course/course_list', 'refresh');
            }
        }
    }

    function join_course() {
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $data['stylesheets'][] = 'admin/stylishalert/alert/css/alert.min.css';
        $data['stylesheets'][] = 'admin/stylishalert/alert/themes/dark/theme.min.css';
        $data['javascripts'][] = 'admin/stylishalert/alert/js/alert.min.js';
        $data['course'] = $this->course_model->course_list_join();
//      echo "<pre>";
//      print_r($data['course']);die;
        $data['stylist'] = $this->course_model->stylist();
        $this->load->view('header', $data);
        $this->load->view('course/course_join', $data);
        $this->load->view('footer');
    }

    function join_course_process() {
        $this->form_validation->set_rules('course', 'course_id', 'required');
        $this->form_validation->set_rules('stylist', 'stylish_id', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');

            redirect(base_url() . 'siteadmin/course/join_course', 'refresh');
        } else {
            $c_join = array(
                'course_id' => $this->input->post('course'),
                'stylish_id' => $this->input->post('stylist'),
                'id_code' => $this->input->post('idcode'),
                'date_join' => date("Y-m-d H:i:s"),
                'date_change_status' => date("Y-m-d H:i:s"),
                'status' => 'active'
            );
            $join_result = $this->course_model->joining($c_join);

            if ($join_result) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  save successfully </div>');
                redirect(base_url() . 'siteadmin/course/join_course', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/course/join_course', 'refresh');
            }
        }
    }

    function list_joining() {


        $result['joining_list'] = $this->course_model->course_joining_list();
        $this->load->view('course/course_joining_list', $result);
    }

    function joining_activation($id) {

        $result = $this->course_model->join_status_change($id);
    }

}
