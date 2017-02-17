<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
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
             
        $this->load->model('AdminModel');  
        $this->load->library("pagination");

             if($this->session->userdata('is_logged_in')){
                $this->is_logged_in = true;
            }else{
                $this->is_logged_in = false;
            }  
        }
//=====================================================================================================
    public function restrictionAccess(){
        $data['title'] = "Restricted Access";
        $this->load->view('adminPage/adminTemplate/header',$data);
        $this->load->view('adminPage/restriction/restrictedAccess');
    }
//=====================================================================================================
    public function index(){
        $this->login();
    }
//=====================================================================================================
    public function login(){
        $data['title'] = "JecPhils | Seminar | Login";
        $this->load->view('adminPage/adminTemplate/header',$data);
        $this->load->view('adminPage/index');
        $this->load->view('adminPage/adminTemplate/footer');
    }
//=====================================================================================================
    public function login_admin(){
        $validate = array(
            array(
            'field' =>  'username',
            'label' =>  'Username',
            'rules' =>  'required'
                ),
            array(
                'field' =>  'password',
                'label' =>  'Password',
                'rules' =>  'required'
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run()==FALSE){
            $this->index();
        }
        else{
            $username   =   $this->input->post('username');
            $password   =   $this->input->post('password'); 
            $result = $this->AdminModel->admin_login_exec($username,$password);  
            if($result){
                header('location:'.base_url().'dashboard');
            }
            else{
                $this->index();
            }
        }
    }
//=====================================================================================================
    public function logout(){
        $id = $this->input->get_post('id');
        $data = array('is_logged_in' => 0 );
        $this->db->where('id',$id);
        $this->db->update('admin_account',$data);
        $this->session->sess_destroy();
        redirect(base_url().'admin');
    }
//=====================================================================================================
    public function register(){
        $data['title'] = "Seminar | Register";
        $this->load->view('adminPage/adminTemplate/header',$data);
        $this->load->view('adminPage/register');
        $this->load->view('adminPage/adminTemplate/footer');
    }
//=====================================================================================================
    public function register_new_admin(){
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
                    'field' =>  'Username',
                    'label' =>  'Username',
                    'rules' =>  'trim|required|min_length[3]|max_length[12]|is_unique[admin_account.username]'
                ),
                array(
                    'field' =>  'EmailAdd',
                    'label' =>  'Email Address',
                    'rules' =>  'required|valid_email|is_unique[admin_account.user_email]'
                ),
                array(
                    'field' =>  'Password',
                    'label' =>  'Password',
                    'rules' =>  'trim|required|min_length[8]|matches[CPassword]'
                ),
                array(
                    'field' =>  'CPassword',
                    'label' =>  'Confirm Password',
                    'rules' =>  'trim|required'
                )
            );
            $this->form_validation->set_rules($newData);
            if($this->form_validation->run()==FALSE){
                $this->register();
            }else{
                $firstname = $this->input->post('firstname');
                $middlename = $this->input->post('middlename');
                $lastname = $this->input->post('lastname');
                $username = $this->input->post('Username');
                $email = $this->input->post('EmailAdd');
                $Password = $this->input->post('Password'); 
                $this->AdminModel->reg_new_admin($firstname,$middlename,$lastname,$username,$email,$Password);
            }
    }
//=====================================================================================================
    public function register_success(){
        $data['title'] = "Registration Success";
        $this->load->view('adminPage/adminTemplate/header',$data);
        $this->load->view('adminPage/success');
        $this->load->view('adminPage/adminTemplate/footer');
    }
//=====================================================================================================
    public function dashboard(){        
        if($this->session->userdata('is_logged_in') == TRUE){
            $data['title'] = "Dashboard | Seminar";
            $this->load->view('adminPage/adminTemplate/header',$data,array('is_logged_in' => $this->is_logged_in));
            $this->load->view('adminPage/adminTemplate/navbar'); 
                $data['query_seminar'] =   $this->AdminModel->getSeminar();
            $this->load->view('adminPage/seminar',$data);
            $this->load->view('adminPage/modals/modalSeminar/createSeminar');
            $this->load->view('adminPage/adminTemplate/footer');
        }else{
            redirect(base_url().'restricted-access');
        }
    }
//=====================================================================================================
    public function manageUser(){
        if(($this->session->userdata('is_logged_in') == TRUE) && ($this->session->userdata('role') == 'superAdmin')){
            $data['title'] = "Manage User | Seminar";
            $this->load->view('adminPage/adminTemplate/header',$data,array('is_logged_in' => $this->is_logged_in));
            $this->load->view('adminPage/adminTemplate/navbar'); 
                $data['query_user'] =   $this->AdminModel->admin_users_getall();
            $this->load->view('adminPage/manageUser',$data);
            $this->load->view('adminPage/modals/modalAccount/statusUser');
            $this->load->view('adminPage/modals/modalAccount/deleteUser');
            $this->load->view('adminPage/adminTemplate/footer');
        }else{
            redirect(base_url().'restricted-access');
        }
    }
//=====================================================================================================
    public function deleteUser(){
            $id = $this->input->get_post('id');
            $this->AdminModel->deleteUser($id);
    }
//=====================================================================================================
    public function activateUser(){
            $id = $this->input->get_post('id');
            $this->AdminModel->activateUser($id);
    }   
//=====================================================================================================
    public function deactivateUser(){
            $id = $this->input->get_post('id');
            $this->AdminModel->deactivateUser($id);
    }
//=====================================================================================================
    public function seminar(){
        if($this->session->userdata('is_logged_in') == TRUE){
            $data['title'] = "Seminars";
            $this->load->view('adminPage/adminTemplate/header',$data,array('is_logged_in' => $this->is_logged_in));
            $this->load->view('adminPage/adminTemplate/navbar'); 
                $data['query_seminar'] =   $this->AdminModel->getSeminar();
            $this->load->view('adminPage/seminar',$data);
            $this->load->view('adminPage/adminTemplate/footer');
        }else{
            redirect(base_url().'restricted-access');
        }
    }
//=====================================================================================================
    public  function createSeminar() {
        if($this->session->userdata('is_logged_in') == TRUE){
            $data['title'] = "Create Seminar";
            $this->load->view('adminPage/adminTemplate/header',$data,array('is_logged_in' => $this->is_logged_in));
            $this->load->view('adminPage/adminTemplate/navbar'); 
                $data['query_seminar'] =   $this->AdminModel->getSeminar();
            $this->load->view('adminPage/create-seminar',$data);
            $this->load->view('adminPage/adminTemplate/footer');
        }else{
            redirect(base_url().'restricted-access');
        }
    }
//=====================================================================================================
    public function seminarProfile(){
        if($this->session->userdata('is_logged_in') == TRUE){
            $data['title'] =ucwords(str_replace('-',' ',strtolower($this->uri->segment(2))));
            $this->load->view('adminPage/adminTemplate/header',$data,array('is_logged_in' => $this->is_logged_in));
            $this->load->view('adminPage/adminTemplate/navbar');
  
                $seminar_name = $this->uri->segment(1);
                $seminar_location_url = $this->uri->segment(2);
                $this->db->select('*');
                $this->db->from('seminar');
                $this->db->where('seminar_location_url',$seminar_location_url);
                $data['query_seminar_result'] = $this->db->get();

                $data['query_seminar'] = $this->AdminModel->getSeminar(); 

            $config = array(
                        'full_tag_open' => '<div class="text-center"><ul class="pagination">',
                        'full_tag_close' => '</ul></div>',
                        'first_link' => false,
                        'last_link' => false,
                        'first_tag_open' => '<li>',
                        'first_tag_close' => '</li>',
                        'prev_link' => '&laquo',
                        'prev_tag_open' => '<li class="prev">',
                        'prev_tag_close' => '</li>',
                        'next_link' => '&raquo',
                        'next_tag_open' => '<li>',
                        'next_tag_close' => '</li>',
                        'last_tag_open' => '<li>',
                        'last_tag_close' => '</li>',
                        'cur_tag_open' => '<li class="active"><a href="#">',
                        'cur_tag_close' => '</a></li>',
                        'num_tag_open' => '<li>',
                        'num_tag_close' => '</li>'
                    ); 
                $config['base_url'] = base_url().'/'.$seminar_name.'/'.$seminar_location_url;
                $config['total_rows'] = $this->AdminModel->record_count();
                $config['per_page'] = 3;
                $config['uri_segment'] = 3;
                $this->pagination->initialize($config);
                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data["query_registrants"] = $this->AdminModel->getRegistrants($seminar_location_url, $config["per_page"], $page);
                $data["links"] = $this->pagination->create_links();

            $this->load->view('adminPage/seminarProfile',$data); 
            $this->load->view('adminPage/modals/modalSeminar/statusSeminar');
            $this->load->view('adminPage/modals/modalSeminar/updateSeminar');
            $this->load->view('adminPage/modals/modalSeminar/deleteSeminar');
            $this->load->view('adminPage/adminTemplate/footer');
        }
        else{
            redirect(base_url().'restricted-access');
        }
    }
//=====================================================================================================
    public function updateSeminar() {
        if($this->session->userdata('is_logged_in') == TRUE){
            $data['title'] = "Update Seminar";
            $this->load->view('adminPage/adminTemplate/header',$data,array('is_logged_in' => $this->is_logged_in));
            $this->load->view('adminPage/adminTemplate/navbar');

                $seminar_id = $this->input->get_post('id');
                $this->db->select('*');
                $this->db->from('seminar');
                $this->db->where('seminar_id',$seminar_id);
                $data['query_seminar_result'] = $this->db->get();

                $data['query_seminar'] =   $this->AdminModel->getSeminar();

            $this->load->view('adminPage/updateSeminar',$data);
            $this->load->view('adminPage/adminTemplate/footer');
        }else{
            redirect(base_url().'restricted-access');
        }
    }
//=====================================================================================================
    public function update_Seminar(){
        $newData =   array(
                array(
                    'field' =>  'seminarName',
                    'label' =>  'Seminar Name',
                    'rules' =>  'trim|required|min_length[5]'
                ),
                array(
                    'field' =>  'seminarLocation',
                    'label' =>  'Seminar Location',
                    'rules' =>  'trim|required|min_length[5]'
                ),
                array(
                    'field' =>  'seminarTime',
                    'label' =>  'Seminar Time',
                    'rules' =>  'required|min_length[5]'
                ),
                array(
                    'field' =>  'seminarDate',
                    'label' =>  'Seminar Date',
                    'rules' =>  'trim|required|min_length[0]'
                ),
                array(
                    'field' =>  'starts',
                    'label' =>  'Registration starts',
                    'rules' =>  'trim|required|min_length[0]'
                ),
                array(
                    'field' =>  'ends',
                    'label' =>  'Registration ends',
                    'rules' =>  'trim|required|min_length[0]'
                )
            );
            $this->form_validation->set_rules($newData);
            if($this->form_validation->run()==FALSE){
                $this->updateSeminar();
            }else{
                $username = $this->session->userdata('username');
                $seminarId = $this->input->post('id');
                $seminarName = $this->input->post('seminarName');
                $seminarLocation = $this->input->post('seminarLocation');
                $seminarTime = $this->input->post('seminarTime');
                $date = date('Y-m-d', strtotime($this->input->post('seminarDate')));
                $starts = date('Y-m-d', strtotime($this->input->post('starts')));
                $ends = date('Y-m-d', strtotime($this->input->post('ends'))); 
                $this->AdminModel->updateSeminar($username,$seminarId,$seminarName,$seminarLocation,$seminarTime,$date,$starts,$ends);
            }
    }
//=====================================================================================================
    public function insertSeminar() {
        $newData =   array(
                array(
                    'field' =>  'seminarName',
                    'label' =>  'Seminar Name',
                    'rules' =>  'trim|required|min_length[5]'
                ),
                array(
                    'field' =>  'seminarLocation',
                    'label' =>  'Seminar Location',
                    'rules' =>  'trim|required|min_length[5]|is_unique[seminar.seminar_location]'
                ),
                array(
                    'field' =>  'seminarTime',
                    'label' =>  'Seminar Time',
                    'rules' =>  'required|min_length[5]'
                ),
                array(
                    'field' =>  'seminarDate',
                    'label' =>  'Seminar Date',
                    'rules' =>  'trim|required|min_length[9]'
                ),
                array(
                    'field' =>  'starts',
                    'label' =>  'Registration starts',
                    'rules' =>  'trim|required|min_length[9]'
                ),
                array(
                    'field' =>  'ends',
                    'label' =>  'Registration ends',
                    'rules' =>  'trim|required|min_length[9]'
                )
            );
            $this->form_validation->set_rules($newData);
            if($this->form_validation->run()==FALSE){
                $this->createSeminar();
            }else{
                $username = $this->session->userdata('username');
                $seminarName = $this->input->post('seminarName');
                $seminarLocation = $this->input->post('seminarLocation');
                $seminarTime = $this->input->post('seminarTime');
                $date = date('Y-m-d', strtotime($this->input->post('seminarDate')));
                $starts = date('Y-m-d', strtotime($this->input->post('starts')));
                $ends = date('Y-m-d', strtotime($this->input->post('ends')));

                $this->AdminModel->insertSeminar($username,$seminarName,$seminarLocation,$seminarTime,$date,$starts,$ends);
            }
    }
//=====================================================================================================
    public function activateSeminar(){
            $id = $this->input->get_post('id');
            $this->AdminModel->activateSeminar($id);
    } 
//=====================================================================================================
    public function deactivateSeminar(){
            $id = $this->input->get_post('id');
            $this->AdminModel->deactivateSeminar($id);
    }   
//=====================================================================================================
    public function deleteSeminar(){
            $id = $this->input->get_post('id');
            $this->AdminModel->deleteSeminar($id);
    }
//====================================================================================================================
    public function save(){
        $url = $this->do_upload();
        $id = $_POST["seminar_id"];
        $this->AdminModel->save($id, $url);
    }
//====================================================================================================================
    public function do_upload(){ 
        $type = explode('.', $_FILES["userfile"]["name"]);
        $type = strtolower($type[count($type)-1]);
        $url = "./images/seminar/".uniqid(rand()).'.'.$type;
        if(in_array($type, array("jpg", "jpeg", "gif", "png")))
            if(is_uploaded_file($_FILES["userfile"]["tmp_name"]))
                if(move_uploaded_file($_FILES["userfile"]["tmp_name"],$url))
                    return $url;
        return "";
    }
//====================================================================================================================  
//==================================================================================================================== 
}