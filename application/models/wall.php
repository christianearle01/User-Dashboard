<?php
class Wall extends CI_Model{
    public function show($id){
        $query = 
            "SELECT id, first_name, CONCAT(first_name, ' ', last_name) as name, email, created_at, description FROM users WHERE id = ?";
        $user = $this->db->query($query, $id)->row_array();
        $query = 
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) as name,
            m.id as message_id, m.user_id, m.wall, m.message, m.created_at
            FROM users as u
            INNER JOIN messages as m
                ON u.id = m.user_id
            ORDER BY created_at DESC;";
        $messages = $this->db->query($query)->result_array();
        $query = 
            "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) as name,
            c.id as comment_id, c.user_id, c.message_id, c.comment, c.created_at
            FROM users as u
            INNER JOIN comments as c
                ON u.id = c.user_id
            ORDER BY created_at DESC;";
        $comments = $this->db->query($query)->result_array();
        $records = array(
            "user" => $user,
            "messages" => $messages,
            "comments" => $comments
        );
        return $records;
    }
    public function message($values){
        $values = $this->sanitize($values);
        $values = array($this->session->userdata('user_id'), $values['wall'], $values['message_input']);
        $query = "INSERT INTO messages(user_id, wall, message, created_at) VALUES(?, ?, ?, NOW())";
        $this->db->query($query, $values);
    }
    public function comment($post){
        $values = $this->sanitize($post);
        $values = array($this->session->userdata('user_id'), $values['message_id'], $values['comment_input']);
        $query = "INSERT INTO comments(user_id, message_id, comment, created_at) VALUES(?, ?, ?, NOW())";
        $this->db->query($query, $values);
    }
    public function sanitize($values){
        foreach ($values as $key => $sanitize_value) {
            $values[$key] = $this->security->xss_clean($sanitize_value);
        }
        return $values;
    }
}