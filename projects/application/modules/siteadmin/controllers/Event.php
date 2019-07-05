<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('event_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('redwomenadminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {
        $data['title'] = 'Event Add';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datetimepicker/css/jquery.datetimepicker.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datetimepicker/js/jquery.datetimepicker.full.min.js';




        $this->load->view('header', $data);
        $this->load->view('event/event');
        $this->load->view('footer');
    }

    public function addevent() {

        $this->form_validation->set_rules('title', 'Event Title', 'required');
        $this->form_validation->set_rules('url', 'Event Url', 'required');
        $this->form_validation->set_rules('descr', 'Event Description', 'required');
        $this->form_validation->set_rules('sdate', 'Event Start Date', 'required');
        $this->form_validation->set_rules('edate', 'Event End Date', 'required');
        $this->form_validation->set_rules('location', 'Event location', 'required');
        $this->form_validation->set_rules('link', 'Event link', 'required');
        $this->form_validation->set_rules('status', 'Event status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('event', $_POST);
            redirect(base_url() . 'siteadmin/event', 'refresh');
        } else {
            $imgdata = '';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/event/';
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
                    redirect(base_url() . 'siteadmin/event', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/event/' . $image['file_name'];
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
                'event_title' => $this->input->post('title'),
                'event_url' => $this->input->post('url'),
                'event_description' => $this->input->post('descr'),
                'event_img' => $imgdata,
                'event_start_date' => date("Y-m-d H:i:s", strtotime($this->input->post('sdate'))),
                'event_end_date' => date("Y-m-d H:i:s", strtotime($this->input->post('edate'))),
                'event_location' => $this->input->post('location'),
                'event_status' => $this->input->post('status'),
                'event_link' => $this->input->post('link')
            );

            $return = $this->event_model->addevent($data);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['event_title'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/event/eventlist', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/event', 'refresh');
            }
        }
    }

    public function eventlist() {

        $data['title'] = 'Event List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage'] = $this->event_model->eventlist();
        $this->load->view('event/event_list', $data);
        $this->load->view('footer');
    }

    public function eventedit($id) {
        if (empty($id)) {

            show_404();
        }
        $data['title'] = 'Event Edit';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datetimepicker/css/jquery.datetimepicker.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datetimepicker/js/jquery.datetimepicker.full.min.js';




        $this->load->view('header', $data);
        $data['details'] = $this->event_model->details($id);
        $this->session->set_userdata('event', $data['details']);

        $this->load->view('event/eventedit');
        $this->load->view('footer');
    }

    public function editevent($id) {
        if (empty($id)) {

            show_404();
        } else {

            $this->form_validation->set_rules('event_id', 'Event Id', 'required');
            $this->form_validation->set_rules('title', 'Event Title', 'required');
            $this->form_validation->set_rules('url', 'Event Url', 'required');
            $this->form_validation->set_rules('descr', 'Event Description', 'required');
            $this->form_validation->set_rules('sdate', 'Event Start Date', 'required');
            $this->form_validation->set_rules('edate', 'Event End Date', 'required');
            $this->form_validation->set_rules('location', 'Event location', 'required');
            $this->form_validation->set_rules('link', 'Event link', 'required');
            $this->form_validation->set_rules('status', 'Event status', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
                //$this->session->set_userdata('event', $_POST);
                redirect(base_url() . 'siteadmin/event/eventedit/'.$id, 'refresh');
            } else {
                $imgdata = $this->input->post('img');
                if ($_FILES['image']['name'] != "") {
                    $config['upload_path'] = './assets/event/';
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
                        redirect(base_url() . 'siteadmin/event/eventedit/'.$id, 'refresh');
                        die;
                    } else {
                        $image = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/event/' . $image['file_name'];
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
                    'event_title' => $this->input->post('title'),
                    'event_url' => $this->input->post('url'),
                    'event_description' => $this->input->post('descr'),
                    'event_img' => $imgdata,
                    'event_start_date' => date("Y-m-d H:i:s", strtotime($this->input->post('sdate'))),
                    'event_end_date' => date("Y-m-d H:i:s", strtotime($this->input->post('edate'))),
                    'event_location' => $this->input->post('location'),
                    'event_status' => $this->input->post('status'),
                    'event_link' => $this->input->post('link')
                );

                $return = $this->event_model->editevent($data,$id);
                if ($return) {

                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['event_title'] . '  save successfully </div>');
                    redirect(base_url() . 'siteadmin/event/eventlist', 'refresh');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No changes found</div>');
                    redirect(base_url() . 'siteadmin/event/eventedit/'.$id, 'refresh');
                }
            }
        }
    }

}
