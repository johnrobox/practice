<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller {

	public function __construct() {

	}

	public function index() {

		$this->load->model('StudentModel');
		$this->load->library("pagination");
        $this->load->library("paginatedesign");

		$config = $this->paginatedesign->bootstrapPagination();
        $config['base_url'] = base_url() . "admin_page_houseareas/index";
        $config['total_rows'] = $this->StudentModel->record_count();
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->StudentModel->fetch_student($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('student-view',$data);

	}
}