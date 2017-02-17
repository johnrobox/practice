<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class UserModel extends CI_model{
//====================================================================================
        public function getSeminar() {
            $this->db->select('*');
            $this->db->from('seminar');
            $query_seminar = $this->db->get();
            return $query_seminar->result();
        }
//====================================================================================
        public function getSeminarSelected($seminar_location_url) {
            $this->db->select('*');
            $this->db->from('seminar');
            $this->db->where('seminar_location_url',$seminar_location_url);
            $query_seminar_selected = $this->db->get();
            return $query_seminar_selected->result();
        } 
//====================================================================================
        public function getSeminarSelectedbyId($cs_id) {
            $this->db->select('*');
            $this->db->from('seminar');
            $this->db->where('seminar_id',$cs_id);
            $query_seminar_selected = $this->db->get();
            return $query_seminar_selected->result();
        } 
//====================================================================================
        public function insertNewRegistrants($cs_id, $firstname, $middlename, $lastname, $age, $address, $contactnumber, $emailaddress, $found) {
            
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('s_id',$cs_id);
            $this->db->where('lastname',$lastname);
            $this->db->where('firstname',$firstname);
            $this->db->where('middlename',$middlename);
            $this->db->where('age',$age);
            $this->db->where('address',$address);
            $this->db->where('con_number',$contactnumber);
            $this->db->where('email',$emailaddress);
            $this->db->where('found',$found); 
            $this->db->get();

            if($this->db->affected_rows()>0){
                redirect(base_url().'registration/multiple-data-entry');
            }else{ 

            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('lastname',$lastname);
            $this->db->where('firstname',$firstname);
            $this->db->where('middlename',$middlename);
            $this->db->where('age',$age);
            $this->db->get();

                if($this->db->affected_rows()>0){
                    redirect(base_url().'registration/multiple-data-entry');
                }else{ 
                    $insertNew = array(
                        'firstname' => $firstname, 
                        'middlename' => $middlename, 
                        'lastname' => $lastname, 
                        'age' => $age, 
                        'address' => $address, 
                        'con_number' => $contactnumber, 
                        'email' => $emailaddress, 
                        'found' => $found, 
                        's_id' => $cs_id, 
                        ); 
                    $this->db->insert('tbl_users',$insertNew);
                    redirect(base_url().'registration/success');
                }
            } 
        } 

	}
?>