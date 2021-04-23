<?php   
/* Declare Associative Array to contain Field Errors*/
/* Owner: Christian Earle C. Peralta */   
$search = "";
if(!empty($this->session->flashdata('errors'))){
    if($action == "register"){
        $search = array(
            "first_name" => "First Name",
            "last_name" => "Last Name",
            "email" => "Email",
            "password" => "Password",
            "password_confirmation" => "Password Confirmation"
        );
    }
    else if($action == "signin"){
        $search = array(
            "email" => "Email",
            "password" => "Password"
        );
    }
    else if($action == "profile"){
        $search = array(
            "email" => "Email",
            "first_name" => "First Name",
            "last_name" => "Last Name"
        );
    }
    else if($action == "changepass"){
        $search = array(
            "old_password" => "Old Password",
            "new_password" => "New Password",
            "new_password_confirmation" => "New Password Confirmation"
        );
    }
    $split_errors = "";
/* Split Field Error/s into Array */
/* Owner: Christian Earle C. Peralta */
    foreach ($this->session->flashdata('errors') as $error) {
        $split_errors = explode(".", $error);
    }
/* Search Field Error/s Name To Place in Same Field Placeholder to highlight field errors*/
/* Owner: Christian Earle C. Peralta */
    foreach ($split_errors as $error) { 
        foreach ($search as $key => $value) {
            if(preg_match("/{$value}/i", $error)) {
                if($action == "profile"){
                    $errors[$key . "p"] = $error;
                }
                else{
                    $errors[$key] = $error;
                }
            }
        }
    }
    if($action == "register" && $this->session->userdata('user_level') == "admin"){
        $this->load->view('admin/add_user', $errors);
    }
    else if($action == "register" && $this->session->userdata('user_level') != "admin"){
        $this->load->view('user/register', $errors);
    }
    else if($action == "signin"){
        $this->load->view('user/sign-in', $errors);
    }
    else if($action == "profile"){
        if($this->session->userdata('user_id') != $id && $this->session->userdata('user_level') == "admin"){
            $errors["user_id"] = $id;
            $this->load->view('admin/edit_user', $errors); 
        }
        else{
           $this->load->view('user/edit_user', $errors); 
        }
    }
    else if($action == "changepass"){
        $this->load->view('user/edit_user', $errors);
    }
}