<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['categories'] = $this->Category_model->get_categories();
        $data['title'] = 'Category Management';

        $this->load->view('layout/header', $data);
        $this->load->view('categories/index', $data);
        $this->load->view('layout/footer');
    }

    public function create() {
        $data['title'] = 'Create a new category';

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('categories/create', $data);
            $this->load->view('layout/footer');
        } else {
            $this->Category_model->set_category();
            $this->session->set_flashdata('success', 'Category created successfully.');
            redirect('categories');
        }
    }

    public function edit($id) {
        $data['category'] = $this->Category_model->get_categories($id);
        
        if (empty($data['category'])) {
            show_404();
        }

        $data['title'] = 'Edit category';

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('categories/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $this->Category_model->set_category();
            $this->session->set_flashdata('success', 'Category updated successfully.');
            redirect('categories');
        }
    }

    public function delete($id) {
        $this->Category_model->delete_category($id);
        $this->session->set_flashdata('success', 'Category deleted successfully.');
        redirect('categories');
    }
}
