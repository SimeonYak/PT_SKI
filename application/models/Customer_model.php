<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/models/Customer_model.php
class Customer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_customers() {
        return $this->db->get('customers')->result();
    }

    public function add_customer($data) {
        
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }

    public function get_customer_by_id($id) {
        return $this->db->get_where('customers', array('id' => $id))->row();
    }

    public function update_customer($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('customers', $data);
    }

    public function delete_customer($id) {
        $this->db->where('id', $id);
        $this->db->delete('customers');
    }
}

