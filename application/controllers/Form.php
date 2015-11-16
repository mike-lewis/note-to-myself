<?php

class Form extends CI_Controller {

    public function index()
    {
        $this->load->helper(array('form', 'url', 'captcha'));
        $this->load->library('form_validation');
        $this->load->driver("session");
        //Once library is loaded, the image library object will be available using: $this->image_lib
        $this->load->library('image_lib');

        // Validates email
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required',
            array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('captcha', "Captcha", 'required');

        // Data to be inserted into the database
        $data = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password'))
        );

        // Get the user's entered captcha value from the form
        $userCaptcha = $this->input->post('captcha');

        // Get the actual captcha value that we stored in the session (see below)
        $word = $this->session->userdata('captchaWord');

        if ($this->form_validation->run() == FALSE)
        {
            $rand_word = $this->getRandomWord();
            // Form validation fails, re-enter information
            $vals = array(
                'word'	=> $rand_word,
                'img_path'	=> './captcha/',
                'img_url'	=> base_url().'captcha',
                'font_path'	=> './path/to/fonts/texb.ttf',
                'img_width'	=> '150',
                'img_height' => 30,
                'expiration' => 7200
            );

            $cap = create_captcha($vals);
            // Store the captcha value (or 'word') in a session to retrieve later
            $this->session->set_userdata('captchaWord', $cap['word']);

            $this->load->view('registration', $cap);
        }
        else if ($this->form_validation->run() == TRUE &&
            strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
        {
            // Validation successful
            // Clear the session variable
            $this->session->unset_userdata('captchaWord');

            $this->db->insert('users', $data);
            $this->load->view('registration_success');
        }
    }

    function getRandomWord($len = 6) {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }

}