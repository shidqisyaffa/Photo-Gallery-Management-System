<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_categories($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('categories');
            return $query->result_array();
        }

        $query = $this->db->get_where('categories', array('id' => $id));
        return $query->row_array();
    }

    public function set_category() {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        );

        if ($this->input->post('id')) {
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('categories', $data);
        }

        return $this->db->insert('categories', $data);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }
}