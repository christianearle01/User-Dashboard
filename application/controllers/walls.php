<?php
class Walls extends CI_Controller{
    public function show($id){
        $data = $this->user->check_userid($id);
        $records['records'] = $this->wall->show($id);
        if($data['id'] != NULL){
            $this->load->view("user/wall", $records);
        }
        else{
            redirect('users/dashboard');
        }
    }
    public function message($id){
        $this->wall->message($this->input->post());
        $this->show($id);
    }
    public function comment($id){
        $this->wall->comment($this->input->post());
        $this->show($id);
    }
}