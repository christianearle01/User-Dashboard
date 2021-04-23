<?php
class Users extends CI_Controller{
    public function index(){
        $this->load->view('homepage');
    }
    public function signin(){
        $this->load->view('user/sign-in');
    }
    public function register(){
        $this->load->view('user/register');
    }
    public function logoff(){
        $this->session->sess_destroy();
        redirect("/");   
    }
    /**Query All Records and display in user_level respective folder/page */
    /* Owner: Christian Earle C. Peralta */
    public function dashboard(){
        $records['records'] = $this->user->dashboard();
        if($this->session->userdata('user_level') == "admin"){
            $this->load->view('admin/dashboard', $records);
        }
        else{
            $this->load->view('user/dashboard', $records);
        }
    }
    public function new(){
        if($this->session->userdata('user_level') == "admin"){
            $this->load->view('admin/add_user');
        }
    }
    /**Redirect to User's Profile Page based in user's level*/
    /* Owner: Christian Earle C. Peralta */
    public function edit($id=1){
        $data = $this->user->check_userid($id);
        if($data['id'] == NULL){
            redirect('dashboard');
        }
        if($this->session->userdata('user_level') == "admin" && $this->session->userdata('user_id') != $id){
            $this->load->view('admin/edit_user', $data);
        }
        else{
            // $action['action'] = "edit";
            $this->load->view('user/edit_user', $data);
        }
    }
    /* Validate Register page Form Data*/
    /* Owner: Christian Earle C. Peralta */
    public function register_validate(){
         $validate = $this->user->register_validate();
        if($validate == FALSE) {
            $action['action'] = "register";
            $this->load->view('partial/errors', $action);
        } 
        else {
            /*Pass data to user model to query/save to database*/
            $this->user->register($this->input->post());
            if($this->session->userdata('user_level') == "admin"){
                redirect('users/dashboard');
            }
            else{
                redirect('users/signin');
            }
        }
    }
    /* Validate Signin page Form Data */
    /* Owner: Christian Earle C. Peralta */
    public function signin_validate(){
        $validate = $this->user->signin_validate();
        if($validate == FALSE) {
            $action['action'] = "signin";
            $this->load->view('partial/errors', $action);
        } 
        else {
            /*Pass data to user model to check if user exist in database*/
            $user_info = $this->user->user_exist($this->input->post());
            if($user_info){
                $user = array(
                    "user_id" => $user_info['id'],
                    "user_level" => $user_info['user_level']
                );
                $this->session->set_userdata($user);
                redirect('users/dashboard');
            }
            else{
                $data = array(
                    "email" => "Email/Password combination is not valid!",
                    "password" => "Email/Password combination is not valid!"
                );
                $this->load->view('user/sign-in', $data);
            }
        }  
    }
    public function edit_validation(){
        $validate = $this->user->edit_validation();
        if($validate == FALSE){
            $action = array(
                "action" => "profile",
                "id" => $this->input->post('user_id'),
                "user_level" => $this->input->post('user_level')
            );
            $this->load->view('partial/errors', $action);
        }
        else{
            $this->user->update_information($this->input->post());
            redirect("users/dashboard");
        }
    }
    public function changepass_validation(){
        $oldpass_error = $this->changepass_validate();
        $validate = $this->user->changepass_validation($oldpass_error);
        if($validate == FALSE){
            $action = array(
                "action" => "changepass",
                "id" => $this->session->userdata('user_id'),
                "user_level" => $this->session->userdata('user_level')
            );
            $this->load->view('partial/errors', $action);
        }
        else{
            $this->user->update_pass($this->input->post());
            redirect("users/dashboard");
        }
    }
    public function update_profile_description(){
        $this->user->update_profile_description($this->input->post());
        redirect("users/edit/", $this->input->post('user_id'));
    }
    /**Validate Change Password Form Data from Profile/edit page.. Validate in Controller to use callback in form validation */
    /* Owner: Christian Earle C. Peralta */
    public function changepass_validate(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('old_password', 'Old Password', 'callback_password_check');
        if($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            return $errors;
        }
    }
    /**Check if User's Input Old Password Macth to User's Password */
    /* Owner: Christian Earle C. Peralta */
    public function password_check($old_password) {
        $user = $this->user->check_password();
        if($user['password'] !== md5($old_password)) {
            $this->form_validation->set_message('password_check', 'The {field} does not match.');
            return false;
        }
        return true;
    }
    public function delete($id){
        if($this->session->userdata('user_level') == "admin" && is_numeric($id)){
            $this->user->delete($id);
        }
        redirect('users/dashboard');
    }
}