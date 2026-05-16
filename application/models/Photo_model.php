<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_photos($id = FALSE) {
        if ($id === FALSE) {
            $this->db->select('photos.*, categories.name as category_name');
            $this->db->from('photos');
            $this->db->join('categories', 'categories.id = photos.category_id', 'left');
            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('photos', array('id' => $id));
        return $query->row_array();
    }

    public function set_photo($file_name = null) {
        $data = array(
            'title' => $this->input->post('title'),
            'category_id' => $this->input->post('category_id'),
            'description' => $this->input->post('description')
        );

        if ($file_name) {
            $data['file_name'] = $file_name;
        }

        if ($this->input->post('id')) {
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('photos', $data);
        }

        return $this->db->insert('photos', $data);
    }

    public function delete_photo($id) {
        $photo = $this->get_photos($id);
        
        $this->db->where('id', $id);
        if ($this->db->delete('photos')) {
            return $photo;
        }
        return false;
    }
}