<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// application/controllers/Customer.php
class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('Customer_model');
    }

    public function index() {
        $data['customers'] = $this->Customer_model->get_customers();
        $this->load->view('customer_list', $data);
    }

    public function add_customer() {
        $data = array(
            'nama' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'desa' => $this->input->post('desa')
        );
        

        $customer_id = $this->Customer_model->add_customer($data);
        echo json_encode(array("status" => "success", "id" => $customer_id));
    }

    public function get_customer() {
        $customer_id = $this->input->post('customer_id');
        $customer = $this->Customer_model->get_customer_by_id($customer_id);
        echo json_encode($customer);
    }

    public function update_customer() {
        $customer_id = $this->input->post('customer_id');
        $data = array(
            'nama' => $this->input->post('nama'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'pekerjaan' => $this->input->post('pekerjaan')
        );

        $this->Customer_model->update_customer($customer_id, $data);
        echo json_encode(array("status" => "success"));
    }

    public function delete_customer() {
        $customer_id = $this->input->post('customer_id');
        $this->Customer_model->delete_customer($customer_id);
        echo json_encode(array("status" => "success"));
    }
}


