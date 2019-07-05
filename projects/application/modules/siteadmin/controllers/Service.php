<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('service_model');
        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    function index() {
        $data['title'] = 'Services';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';

        $this->load->view('header', $data);
        $this->load->view('service/service', $data);
        $this->load->view('footer');
    }

    function add_service() {
        $this->form_validation->set_rules('title', 'name', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('detail', 'detail', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('service', $_POST);
            redirect(base_url() . 'siteadmin/service', 'refresh');
        } else {
            $imgdata = 'noimagedefault.jpg';
            if ($_FILES['image']['name'] !== "") {
                $config['upload_path'] = './assets/service/';
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
                    redirect(base_url() . 'siteadmin/service', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/service/' . $image['file_name'];
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

            $data['service_add'] = array(
                'name' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'details' => $this->input->post('detail'),
                'price' => $this->input->post('price'),
                'image' => $imgdata
            );
            $data = $this->service_model->add_service($data);
            if ($data) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['service_add']['name'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/service/service_list', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/service', 'refresh');
            }
        }
    }

    function service_list() {
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $data['title'] = 'Services List';
        $this->load->view('header', $data);
        $data['service'] = $this->service_model->service_list();
//         print_r($data);die;

        $this->load->view('service/service_list_view', $data);
        $this->load->view('footer');
    }

    function service_edit($id) {
        $data['title'] = 'Service Edit';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $this->load->view('header', $data);
        $data['service_edit'] = $this->service_model->service_edit($id);
        $this->load->view('service/service_edit', $data);
        $this->load->view('footer');
    }

    function edit_service() {
        $this->form_validation->set_rules('title', 'name', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('detail', 'detail', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $id = $this->input->post('id');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('service', $_POST);
            redirect(base_url() . 'siteadmin/service/service_edit/' . $id, 'refresh');
        } else {
            $imgdata = $this->input->post('img');
            if ($_FILES['image']['name'] !== "") {
                $config['upload_path'] = './assets/service/';
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
                    redirect(base_url() . 'siteadmin/service', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/service/' . $image['file_name'];
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

            $data['service_edit'] = array(
                'name' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'details' => $this->input->post('detail'),
                'price' => $this->input->post('price'),
                'image' => $imgdata,
                'status' => $this->input->post('status')
            );
//           print_r($data);die;
            $data = $this->service_model->update_service($data, $id);
            if ($data) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['service_add']['name'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/service/service_list', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/service/service_edit/' . $id, 'refresh');
            }
        }
    }

    function service_tag($id) {

        $data['stylesheets'][] = 'admin/css/magic-check-master/css/magic-check.css';
//        $data['stylesheets'][] = 'admin/datetimepicker/css/jquery.datetimepicker.css';
//        $data['javascripts'][] = 'admin/datetimepicker/js/jquery.datetimepicker.full.min.js';
        $data['title'] = 'Service Tag';
        $this->load->view('header', $data);

        $data['service_tag'] = $this->service_model->service_edit($id);
        $data['service_stylist'] = $this->service_model->get_stylist();
        $data['check_stylist'] = $this->service_model->check_stylist($id);
//        print_r($data['check_stylist']);die;
        $this->load->view('service/service_tag', $data);
        $this->load->view('footer');
    }

    function service_taging($id) {

        $data = $this->input->post('tag');
//        print_r($data);die;
        if (!empty($data)) {
            $tag_done = $this->service_model->service_tag($data, $id);
            if ($tag_done) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . ' Save successfully </div>');
                redirect(base_url() . 'siteadmin/service/service_list', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No Taging</div>');
            redirect(base_url() . 'siteadmin/service/service_list', 'refresh');
        }
    }

    function closedate($id) {
        $data['stylesheets'][] = 'admin/multipledatepicker/css/jquery-ui.css';
        $data['stylesheets'][] = 'admin/multipledatepicker/css/jquery-ui.theme.css';
        $data['stylesheets'][] = 'admin/multipledatepicker/css/jquery-ui.structure.css';
        $data['stylesheets'][] = 'admin/multipledatepicker/css/pepper-ginder-custom.css';
//         $data['stylesheets'][] = 'admin/multipledatepicker/css/mdp.css';
        $data['stylesheets'][] = 'admin/multipledatepicker/css/prettify.css';
        $data['javascripts'][] = 'admin/multipledatepicker/js/jquery-2.1.1.js';
        $data['javascripts'][] = 'admin/multipledatepicker/js/prettify.js';

        $data['javascripts'][] = 'admin/multipledatepicker/js/jquery-1.11.1.js';
        $data['javascripts'][] = 'admin/multipledatepicker/js/jquery-ui-1.11.1.js';
        $data['javascripts'][] = 'admin/multipledatepicker/jquery-ui.multidatespicker.js';
        $data['service_id'] = $id;
        $data['title'] = 'Service Tag';
        $this->load->view('header', $data);

        $data['close_info'] = $this->service_model->close_info($id);
//        print_r($data['close_info']);die;
        $this->load->view('cloasedate/closedate', $data);
        $this->load->view('footer');
    }

    function close_date($id) {
        $data = $this->input->post('altField');
        $updata = $this->service_model->update_close_date($data, $id);

        redirect(base_url('siteadmin/service/service_list'), 'refresh');
    }

    function service_period($id) {
        $data['javascripts'][] = 'admin/timepicker/jquery.timepicker.min.js';
        $data['stylesheets'][] = 'admin/timepicker/jquery.timepicker.css';
        $data['title'] = 'Service Period';
        $data['id'] = $id;
        $this->load->view('header', $data);
        $this->load->view('service/service_period', $data);
        $this->load->view('footer');
    }

// function service_period_process($id){
//   
//     $period=$this->input->post();
////     echo "<pre>";
////     print_r($period);die;
//     $this->service_model->upload_shedule($id,$period);
// }
    function service_edit_period($id) {
        $data['javascripts'][] = 'admin/timepicker/jquery.timepicker.min.js';
        $data['stylesheets'][] = 'admin/timepicker/jquery.timepicker.css';
        $data['title'] = 'Service Period';
        $data['id'] = $id;
        $this->load->view('header', $data);
        $this->load->view('service/service_period_edit', $data);
        $this->load->view('footer');
    }

    function service_edit_period_process($id, $day) {
//    echo 'helo';
        $data['javascripts'][] = 'admin/timepicker/jquery.timepicker.min.js';
        $data['stylesheets'][] = 'admin/timepicker/jquery.timepicker.css';
        $info = $this->service_model->get_service_time($id, $day);
        if (!empty($info['from_time'])) {
            $data['from'] = explode(',', $info['from_time']);
        }
        $data['to'] = explode(',', $info['to_time']);
        $data['s_id'] = $id;
        $data['day'] = $day;
        $this->load->view('service/service_period_show', $data);
//   print_r($period);die;
    }

    function add_service_period($s_id, $day, $f,$t) {
        $result = $this->service_model->service_period_add($s_id, $day, $f, $t);
    }
function remove_service_period($s_id,$day,$a){
    $result=$this->service_model->service_period_remove($s_id,$day,$a);
}
}
