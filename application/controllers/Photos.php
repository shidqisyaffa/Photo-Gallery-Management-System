<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Photo_model');
        $this->load->model('Category_model');
        $this->load->helper(array('url_helper', 'form'));
        $this->load->library(array('form_validation', 'session'));
    }

    public function index() {
        $data['photos'] = $this->Photo_model->get_photos();
        $data['title'] = 'Photo Gallery Management';

        $this->load->view('layout/header', $data);
        $this->load->view('photos/index', $data);
        $this->load->view('layout/footer');
    }

    public function create() {
        $data['categories'] = $this->Category_model->get_categories();
        $data['title'] = 'Upload a new photo';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('photos/create', $data);
            $this->load->view('layout/footer');
        } else {
            // Check if file is selected
            if (empty($_FILES['userfile']['name'])) {
                $data['error'] = 'Please select a file to upload.';
                $this->load->view('layout/header', $data);
                $this->load->view('photos/create', $data);
                $this->load->view('layout/footer');
                return;
            }

            $upload_data = $this->_do_upload();
            if (isset($upload_data['error'])) {
                $data['error'] = $upload_data['error'];
                $this->load->view('layout/header', $data);
                $this->load->view('photos/create', $data);
                $this->load->view('layout/footer');
            } else {
                $file_name = $upload_data['upload_data']['file_name'];
                $this->Photo_model->set_photo($file_name);
                $this->session->set_flashdata('success', 'Photo uploaded successfully.');
                redirect('photos');
            }
        }
    }

    public function edit($id) {
        $data['photo'] = $this->Photo_model->get_photos($id);
        $data['categories'] = $this->Category_model->get_categories();
        
        if (empty($data['photo'])) {
            show_404();
        }

        $data['title'] = 'Edit photo details';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('photos/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $file_name = null;

            // Handle file upload if a new file is provided
            if (!empty($_FILES['userfile']['name'])) {
                $upload_data = $this->_do_upload();
                if (isset($upload_data['error'])) {
                    $data['error'] = $upload_data['error'];
                    $this->load->view('layout/header', $data);
                    $this->load->view('photos/edit', $data);
                    $this->load->view('layout/footer');
                    return;
                }
                $file_name = $upload_data['upload_data']['file_name'];
                
                // Delete old physical file if exists
                if (!empty($data['photo']['file_name']) && file_exists('./uploads/' . $data['photo']['file_name'])) {
                    unlink('./uploads/' . $data['photo']['file_name']);
                }
            }

            $this->Photo_model->set_photo($file_name);
            $this->session->set_flashdata('success', 'Photo details updated successfully.');
            redirect('photos');
        }
    }

    public function delete($id) {
        $photo = $this->Photo_model->delete_photo($id);
        if ($photo) {
            // Delete the physical file
            if (!empty($photo['file_name']) && file_exists('./uploads/' . $photo['file_name'])) {
                unlink('./uploads/' . $photo['file_name']);
            }
            $this->session->set_flashdata('success', 'Photo deleted successfully.');
        }
        redirect('photos');
    }

    private function _do_upload() {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = TRUE; // Encrypt the file name

        // Create directory if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            return array('error' => $this->upload->display_errors());
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }
}
