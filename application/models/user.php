<?php
class User extends CI_Model{
    /** Save User's Data and Check if User's Data is the first to be Save in Database*/
    /* Owner: Christian Earle C. Peralta */
    public function register($data){
        $data['password'] = md5($data['password']);
        $data = $this->sanitize($data);
        /**remove password_confirmation to avoid getting error coz values to insert and ? is not equal count */
        /* Owner: Christian Earle C. Peralta */
        unset($data['password_confirmation']);
        $query = "SELECT count(*) as count FROM users LIMIT 1";
        $count = $this->db->query($query)->row_array();
        if($count['count'] == '0'){
            $query = "INSERT INTO users(email, first_name, last_name, password, user_level, created_at) VALUES (?, ?, ?, ?, 'admin', NOW())";
        }
        else{
            $query = "INSERT INTO users(email, first_name, last_name, password, user_level, created_at) VALUES (?, ?, ?, ?, 'normal', NOW())";
        }
        $this->db->query($query, $data);
    }
    /**Check if User's data Exist */
    /* Owner: Christian Earle C. Peralta */
    public function user_exist($data){
        $data = $this->sanitize($data);
        $data['password'] = md5($data['password']);
        $query = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1";
        return $this->db->query($query, $data)->row_array();
    }
    /**Query All Non-Confidential Data to Dashboard */
    /* Owner: Christian Earle C. Peralta */
    public function dashboard(){
        $query = "SELECT id, CONCAT(first_name, ' ', last_name) as name, email, DATE_FORMAT(created_at, '%b %D %Y') as created_at, user_level FROM users";
        return $this->db->query($query)->result_array();
    }
    /**Check if User's ID Exist */
    /* Owner: Christian Earle C. Peralta */
    public function check_userid($id){
        $id = $this->security->xss_clean($id);
        $query = "SELECT * FROM users WHERE id = ?";
        return $this->db->query($query, $id)->row_array();
    }
    /**Update User Information */
    /* Owner: Christian Earle C. Peralta */
    public function update_information($post){
        $post = $this->sanitize($post);
        if($this->session->userdata('user_level') == "admin" && $this->session->userdata('user_id') != $post['user_id'] ){
            $query = "UPDATE users SET email = ?, first_name = ?, last_name = ?, user_level = ?, updated_at = NOW() WHERE id = ?";
            $this->db->query($query, $post);
        }
        else{
            $query = "UPDATE users SET email = ?, first_name = ?, last_name = ?, updated_at = NOW() WHERE id = ?";
            $this->db->query($query, $post);
        }
    }
    /**Update Profile Description */
    /* Owner: Christian Earle C. Peralta */
    public function update_profile_description($post){
        $post = $this->security->xss_clean($post);
        $query = "UPDATE users SET description = ?, updated_at = NOW() WHERE id = ?";
        $this->db->query($query, $post);
    }
    /* Validate Register page Form Data */
    /* Owner: Christian Earle C. Peralta */
    public function register_validate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[password_confirmation]');
        $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'trim|required');
        if($this->form_validation->run() == FALSE) {
            $errors = array(validation_errors());
            $this->session->set_flashdata('errors', $errors);
            return FALSE;
        } 
        else {
            return TRUE;
        }
    }
    /* Validate Signin page Form Data */
    /* Owner: Christian Earle C. Peralta */
    public function signin_validate(){
        $this->load->library('form_validation');  
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');  
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if($this->form_validation->run() == FALSE) {
            $errors = array(validation_errors());
            $this->session->set_flashdata('errors', $errors);
            return FALSE;
        } 
        else {
            return TRUE;
        }
    }
    /**Validate Edit Information Form Data from Profile/edit page */
    /* Owner: Christian Earle C. Peralta */
    public function edit_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if($this->form_validation->run() == FALSE) {
            $errors = array(validation_errors());
            $this->session->set_flashdata('errors', $errors);
            return FALSE;
        } 
        else {
            return TRUE;
        }
    }
    /**Validate Change Password Form Data from Profile/edit page */
    /* Owner: Christian Earle C. Peralta */
    public function changepass_validation($oldpass_error){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[8]|matches[new_password_confirmation]|is_unique[users.password]');
        $this->form_validation->set_rules('new_password_confirmation', 'New Password Confirmation', 'trim|required');
        if($this->form_validation->run() == FALSE) {
            $errors = array($oldpass_error . " " . validation_errors());
            $this->session->set_flashdata('errors', $errors);
            return FALSE;
        } 
        else {
            return TRUE;
        }
    }
    /**Get and Send User's Record for Validation in password_check Method*/
    /* Owner: Christian Earle C. Peralta */
    public function check_password(){
        $id = $this->session->userdata('user_id');
        $query = "SELECT * FROM users WHERE id = ?";
        return $this->db->query($query, $id)->row_array();
    }
    public function update_pass($post){
        $value = md5($this->security->xss_clean($post['new_password']));
        $id = $this->session->userdata('user_id');
        $query = "UPDATE users SET updated_at = NOW(), password = ? WHERE id = ?";
        $value = array($value, $id);
        $this->db->query($query, $value);
    }
    public function delete($id){
        $query = "DELETE FROM comments WHERE user_id = ?";
        $this->db->query($query, $id);
        $query = "DELETE FROM messages WHERE user_id = ?";
        $this->db->query($query, $id);
        $query = "DELETE FROM users WHERE id = ?";
        $this->db->query($query, $id);
    }
    /**Sanitize Form User's Input */
    public function sanitize($data){
        foreach ($data as $key => $sanitize_value) {
            $data[$key] = $this->security->xss_clean($sanitize_value);
        }
        return $data;
    }
}