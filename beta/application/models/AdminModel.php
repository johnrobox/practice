<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model{

//=====================================================================================================
	public function reg_new_admin($firstname,$middlename,$lastname,$username,$email,$Password){
                $reg_new    =   array(
                    'firstname'    =>  $firstname,
                    'middlename'    =>  $middlename,
                    'lastname'    =>  $lastname,
                    'username'    =>  $username,
                    'user_email'   =>  $email,
                    'password'    =>  md5($Password),
                    'role'  =>  'Regular',
                    'is_active' => 0,
                    'd_o_c' => date('Y/m/d'),
                    'is_logged_in' => 0
                );

                $this->db->insert('admin_account',$reg_new);
                redirect(base_url().'success');
            }
//=====================================================================================================
    public function admin_login_exec($username,$password){  

                    $data   =   array(
                        'username'    =>  trim($username),
                        'password'    =>  md5(trim($password))
                    );

                    $query  =   $this->db->get_where('admin_account',$data);

                    if($query->num_rows()>0){
                        foreach($query->result() as $rows){
                        $session_data = array(
                                'id' => $rows->id,
                                'username' => $rows->username,
                                'user_email' => $rows->user_email,
                                'role' => $rows->role,
                                'is_active' => $rows->is_active
                            );
                            $this->set_session_login($session_data);
                            $access = $session_data['is_active'];
                            $id = $session_data['id'];
                        }// end of foreach

                        if($access == 0){
                            $this->session->set_userdata('error_logged_in','Account is not yet activated!');
                            return false;
                        }// end of IF - condition of accessability of the system user
                        $data = array(
                            'is_logged_in'=>1
                            );
                        $this->db->where('id',$id);
                        $this->db->update('admin_account',$data);
                        return 'is_logged_in';
                    }// end of IF query for inputed username and password

                    $this->session->set_userdata('error_logged_in','Invalid Username or Password');
                    return false;

            } // end of functions
//=====================================================================================================
    private function set_session_login($session_data){
        $session_data = array(
                'u_id' => $session_data['id'],
                'username' => $session_data['username'],
                'email' => $session_data['user_email'],
                'role' => $session_data['role'],
                'is_active' => $session_data['is_active'],
                'is_logged_in' => 1
            );
            $this->session->set_userdata($session_data);
    }
//=====================================================================================================
    public function deleteUser($id){ 
            $data = $this->db->where('id', $id);
            $this->db->delete('admin_account', $data);
            
            if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('delete-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One item Deleted successfully.
                        </div>
                        ');    
               }
            else{
                    $this->session->set_flashdata('delete-alert-message',
                        '<div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> Sorry! Deletion unsuccessful.
                        </div>
                        ');    
               }
                
                redirect('manageUser');
                exit;
    }
//=====================================================================================================
    public function activateUser($id){ 
            $data = array('is_active' => 1 );
            $this->db->where('id', $id);
            $this->db->update('admin_account', $data);
            
           if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('activate-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One item Activated successfully.
                        </div>
                        ');    
               }
            else{
                    $this->session->set_flashdata('activate-alert-message',
                        '<div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> Sorry! Activation unsuccessful.
                        </div>
                        ');    
               }
               
                redirect('manageUser');
                exit;
    }
//=====================================================================================================
    public function deactivateUser($id){ 
            $data = array('is_active' => 0 );
            $this->db->where('id', $id);
            $this->db->update('admin_account', $data);
            
           if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('deactivate-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One item Deactivated successfully.
                        </div>
                        ');    
               }
            else{
                    $this->session->set_flashdata('deactivate-alert-message',
                        '<div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> Sorry! Deactivation unsuccessful.
                        </div>
                        ');    
               }
               
                redirect('manageUser');
                exit;
    }
//=====================================================================================================
    public function admin_users_getall(){
            $this->db->select('*');
            $this->db->from('admin_account');
            $query_user  =   $this->db->get();
            return $query_user->result();   
        }
//=====================================================================================================
    public function insertSeminar($username,$seminarName,$seminarLocation,$seminarTime,$date,$starts,$ends){
                    $temp = str_replace(',','',(strtolower($seminarLocation)));
                    $temp1 = trim($temp);
            $insert   =   array(
                    'seminar_creator_username' => $username,
                    'seminar_name'    =>  $seminarName,
                    'seminar_location'    => $seminarLocation,
                    'seminar_location_url'    => str_replace(' ','-',($temp1)),
                    'seminar_time'    =>  $seminarTime,
                    'seminar_date'    =>  $date,
                    'seminar_starts'    =>  $starts,
                    'seminar_ends'   =>  $ends,
                    'seminar_is_active' => 0,
                    'seminar_d_o_c' => date('Y/m/d'),
                );

                $this->db->insert('seminar',$insert);
                if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('insertSeminar-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One seminar inserted successfully.
                        </div>
                        ');    
               }
                redirect(base_url().'dashboard');
        }
//=====================================================================================================
        public function activateSeminar($id){ 
            $data = array('seminar_is_active' => 1 );
            $this->db->where('seminar_id', $id);
            $this->db->update('seminar', $data);
            
           if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('activateSeminar-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One item Activated successfully.
                        </div>
                        ');    
               }
            else{
                    $this->session->set_flashdata('activateSeminar-alert-message',
                        '<div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> Sorry! Activation unsuccessful.
                        </div>
                        ');    
               }
                redirect('seminar');
                exit;
        }
//=====================================================================================================
        public function deleteSeminar($id){ 
            $data = $this->db->where('seminar_id', $id);
            $this->db->delete('seminar', $data);
            
            if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('deleteSeminar-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One item Deleted successfully.
                        </div>
                        ');    
               }
            else{
                    $this->session->set_flashdata('deleteSeminar-alert-message',
                        '<div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> Sorry! Deletion unsuccessful.
                        </div>
                        ');    
               }
               
                redirect('seminar');
                exit;
        }
//=====================================================================================================
        public function deactivateSeminar($id){ 
            $data = array('seminar_is_active' => 0 );
            $this->db->where('seminar_id', $id);
            $this->db->update('seminar', $data);
            
           if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('deactivateSeminar-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One item deactivated successfully.
                        </div>
                        ');    
               }
            else{
                    $this->session->set_flashdata('deactivateSeminar-alert-message',
                        '<div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> Sorry! Deactivation unsuccessful.
                        </div>
                        ');    
               }
               
                redirect('seminar');
                exit;
        }
//=====================================================================================================
         public function updateSeminar($username,$seminarId,$seminarName,$seminarLocation,$seminarTime,$date,$starts,$ends){
            $Data = array(
                    'seminar_creator_username' => $username,
                    'seminar_name'    =>  $seminarName,
                    'seminar_location'    =>  $seminarLocation,
                    'seminar_location_url'    => str_replace(' ','-',(strtolower($seminarLocation))),
                    'seminar_time'    =>  $seminarTime,
                    'seminar_date'    =>  $date,
                    'seminar_starts'    =>  $starts,
                    'seminar_ends'   =>  $ends,
                    'seminar_is_active' => 0,
                    'seminar_d_o_c' => date('Y/m/d'),
                );
                $this->db->where('seminar_id', $seminarId);
                $this->db->update('seminar', $Data);
                if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('updateSeminar-alert-message',
                        '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button> One seminar updated successfully.
                        </div>
                        ');    
               }
                redirect(base_url().'dashboard');
        }
//=====================================================================================================
        public function getSeminar() {
            $this->db->select('*');
            $this->db->from('seminar');
            $query_seminar = $this->db->get();
            return $query_seminar->result();
        }
//=====================================================================================================
        public function getSeminartoUpdate($seminar_id){
            $this->db->select('*');
            $this->db->from('seminar');
            $this->db->where('seminar_id',$seminar_id);
            $query_seminar_result = $this->db->get();
            return $query_seminar_result->result();
        }
//=====================================================================================================
        public function save($id, $url){ 
            $update = array('seminar_pic' => $url);
            $this->db->where('seminar_id',$id);
            $this->db->update('seminar',$update);
            redirect(base_url().'dashboard');
        }
//=====================================================================================================
        public function getRegistrants($seminar_location_url,$limit,$start){
            $this->db->select('*');
            $this->db->from('seminar');
            $this->db->where('seminar_location_url',$seminar_location_url);
            $queryThis = $this->db->get();
            
            if($this->db->affected_rows()>0){
                foreach ($queryThis->result_array() as $row) { 
                    $this->db->limit($limit, $start);
                    $this->db->select('*');
                    $this->db->from('tbl_users');
                    $this->db->where('s_id',$row['seminar_id']);
                    $query_registrants = $this->db->get();
                    return $query_registrants->result();
                }
            }

        }
//=====================================================================================================
    public function record_count() {
        //$this->db->where('seminar_location_url',$seminar_location_url);
        return $this->db->count_all("tbl_users");
        }
//=====================================================================================================

    }
?>
