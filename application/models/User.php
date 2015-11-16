<?php
Class User extends CI_Model
{
    function login($email, $password)
    {
        $this->db->select('id, email, password');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_user_data($id, $row, $table)
    {
        $this->db->select($row);
        $this->db->from($table);
        $this->db->where('user_id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_user_data_url($id, $row, $table)
    {
        $this->db->select($row);
        $this->db->from($table);
        $this->db->where('user_id', $id);

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function replace_notes($id)
    {
        // Checks database if this user has an entry
        $this->db->from('notes');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        $notes = $this->input->post('notes');
        // If user has an entry, update with new data
        if ($query->num_rows() != 0) {
            $data = array(
                'note' => $notes
            );
            $this->db->where('user_id', $id);
            $this->db->update('notes', $data);
            // If user has no entry in database, create one
        } else {
            $insert_data = array(
                'id' => null,
                'user_id' => $id,
                'note' => $notes,
            );

            $this->db->insert('notes', $insert_data);
        }
    }

    function replace_tbd($id)
    {
        // Checks database if this user has an entry
        $this->db->from('tbd');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        $tbd = $this->input->post('tbd');
        // If user has an entry, update with new data
        if ($query->num_rows() != 0) {
            $data = array(
                'tbd' => $tbd
            );
            $this->db->where('user_id', $id);
            $this->db->update('tbd', $data);
            // If user has no entry in database, create one
        } else {
            $insert_data = array(
                'id' => null,
                'user_id' => $id,
                'tbd' => $tbd,
            );

            $this->db->insert('tbd', $insert_data);
        }
    }

    function replace_websites($id)
    {
        // Not an elegant solution
        // Deletes all url instances in database for specific user
        $this->db->where('user_id', $id);
        $this->db->where('user_id !=', 'NULL');
        $this->db->delete('url');

        $url = $this->input->post('urls');

        // Repopulates database with urls from text boxes
        foreach ($url as $u) {
            if ($u != null) {
                $insert_data = array(
                    'id' => null,
                    'user_id' => $id,
                    'url' => $u,
                );

                $this->db->insert('url', $insert_data);
            }
        }
    }
}
?>