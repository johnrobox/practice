<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct(){
            parent::__construct();  
        $this->load->model('UserModel');   
        }
//===========================================================================================
    public function index(){
        $data['title'] = "Jellyfish Education Consultancy - Seminar and Events";
        $this->load->view('userPage/userTemplate/header',$data);
        $this->load->view('userPage/navbar'); 
                $data['query_seminar'] =   $this->UserModel->getSeminar();
            $this->load->view('userPage/main',$data);
        $this->load->view('userPage/userTemplate/footer');
    }
//===========================================================================================
    public function success(){
        $data['title'] = "Success";
        $this->load->view('userPage/userTemplate/header',$data); 
        $this->load->view('userPage/success');
        $this->load->view('userPage/userTemplate/footer');
    }
//===========================================================================================
    public function error(){
        $data['title'] = "Multiple Data Entry";
        $this->load->view('userPage/userTemplate/header',$data); 
        $this->load->view('userPage/error');
        $this->load->view('userPage/userTemplate/footer');
    }
//===========================================================================================
    public function registrationForm(){
        $data['title'] = 'Registration Form - '.ucwords(str_replace('-',' ',strtolower($this->uri->segment(2))));
        $this->load->view('userPage/userTemplate/header',$data);

            $seminar_location_url = $this->uri->segment(3);  
            $data['query_seminar_selected'] = $this->UserModel->getSeminarSelected($seminar_location_url);

        $this->load->view('userPage/registrationForm',$data);
        $this->load->view('userPage/userTemplate/footer');
    }
//===========================================================================================
    public function confirmation(){
        $data['title'] = "Confirmation | JEC Seminar and Events";
        $this->load->view('userPage/userTemplate/header',$data); 
        $newData =   array(
                array( 
                    'field' =>  'firstname',
                    'label' =>  'firstname',
                    'rules' =>  'trim|required|min_length[2]'
                ),
                array( 
                    'field' =>  'middlename',
                    'label' =>  'middlename',
                    'rules' =>  'trim|required|min_length[2]'
                ),
                array( 
                    'field' =>  'lastname',
                    'label' =>  'lastname',
                    'rules' =>  'trim|required|min_length[2]'
                ), 
                array( 
                    'field' =>  'age',
                    'label' =>  'age',
                    'rules' =>  'required'
                ), 
                array( 
                    'field' =>  'address',
                    'label' =>  'address',
                    'rules' =>  'trim|required|max_length[50]'
                ), 
                array( 
                    'field' =>  'contactnumber',
                    'label' =>  'contactnumber',
                    'rules' =>  'trim|required|min_length[8]'
                ), 
                array( 
                    'field' =>  'emailaddress',
                    'label' =>  'emailaddress',
                    'rules' =>  'trim|required|valid_email'
                ), 
                array( 
                    'field' =>  'found',
                    'label' =>  'found',
                    'rules' =>  'required'
                ), 
            );
            $this->form_validation->set_rules($newData);
            if($this->form_validation->run()==FALSE){
               $this->registrationForm();
            }else{
                $data['cs_id'] = $this->input->post('cs_id');
                $data['firstname'] = $this->input->post('firstname');
                $data['middlename'] = $this->input->post('middlename');
                $data['lastname'] = $this->input->post('lastname');
                $data['age'] = $this->input->post('age');
                $data['address'] = $this->input->post('address');
                $data['contactnumber'] = $this->input->post('contactnumber');
                $data['emailaddress'] = $this->input->post('emailaddress'); 
                $data['found'] = $this->input->post('found'); 

                $cs_id = $this->input->post('cs_id'); 
                $data['query_seminar_selected'] = $this->UserModel->getSeminarSelectedbyId($cs_id);

                $this->load->view('userPage/confirmation',$data);
                $this->load->view('userPage/userTemplate/footer'); 
            }
    }
//===========================================================================================
    public function registrationEdit(){
        $data['title'] = "Edit Registration | JEC Seminar and Events";
        $this->load->view('userPage/userTemplate/header',$data); 
        $newData =   array(
                array( 
                    'field' =>  'firstname',
                    'label' =>  'firstname',
                    'rules' =>  'trim|required|min_length[2]'
                ),
                array( 
                    'field' =>  'middlename',
                    'label' =>  'middlename',
                    'rules' =>  'trim|required|min_length[2]'
                ),
                array( 
                    'field' =>  'lastname',
                    'label' =>  'lastname',
                    'rules' =>  'trim|required|min_length[2]'
                ), 
                array( 
                    'field' =>  'age',
                    'label' =>  'age',
                    'rules' =>  'required'
                ), 
                array( 
                    'field' =>  'address',
                    'label' =>  'address',
                    'rules' =>  'trim|required|max_length[50]'
                ), 
                array( 
                    'field' =>  'contactnumber',
                    'label' =>  'contactnumber',
                    'rules' =>  'trim|required|min_length[8]'
                ), 
                array( 
                    'field' =>  'emailaddress',
                    'label' =>  'emailaddress',
                    'rules' =>  'trim|required|valid_email'
                ), 
                array( 
                    'field' =>  'found',
                    'label' =>  'found',
                    'rules' =>  'required'
                ), 
            );
            $this->form_validation->set_rules($newData);
            if($this->form_validation->run()==FALSE){
               $this->registrationEdit();
            }else{
                $data['cs_id'] = $this->input->post('cs_id');
                $data['firstname'] = $this->input->post('firstname');
                $data['middlename'] = $this->input->post('middlename');
                $data['lastname'] = $this->input->post('lastname');
                $data['age'] = $this->input->post('age');
                $data['address'] = $this->input->post('address');
                $data['contactnumber'] = $this->input->post('contactnumber');
                $data['emailaddress'] = $this->input->post('emailaddress'); 
                $data['found'] = $this->input->post('found'); 

                $cs_id = $this->input->post('cs_id'); 
                $data['query_seminar_selected'] = $this->UserModel->getSeminarSelectedbyId($cs_id);

                $this->load->view('userPage/registrationEdit',$data);
                $this->load->view('userPage/userTemplate/footer'); 
            }
    }
//================================================================================================
    public function submitInfo(){ 
                $cs_id = $this->input->post('cs_id');
                $firstname = $this->input->post('firstname');
                $middlename = $this->input->post('middlename');
                $lastname = $this->input->post('lastname');
                $age = $this->input->post('age');
                $address = $this->input->post('address');
                $contactnumber = $this->input->post('contactnumber');
                $emailaddress = $this->input->post('emailaddress'); 
                $found = $this->input->post('found'); 
 
                $this->UserModel->insertNewRegistrants($cs_id, $firstname, $middlename, $lastname, $age, $address, $contactnumber, $emailaddress, $found);

    }
//================================================================================================
}
