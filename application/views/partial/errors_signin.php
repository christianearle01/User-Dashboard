<?php
/* Declare Associative Array to contain Field Errors*/
/* Owner: Christian Earle C. Peralta */   
if(!empty($this->session->flashdata('errors'))){
    $search = array(
        "email" => "Email",
        "password" => "Password"
    );
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
                $errors[$key] = $error;
            }
        }
    }
}
$this->load->view('user/sign-in', $errors);