<?php

class ForgetPW extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->database();
    }


    public function index()
    {
        $formSubmit = $this->input->post('submit');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        if (!$formSubmit == "check") {
            //Field validation failed.  Reload this page.
            $this->load->view('forgotten_pw');
        } else if ($this->form_validation->run() == FALSE){
            $email = $this->input->post('email');
            echo $email . " was provided, it exists in db</br>";

            $new_pw = $this->getRandomWord(6);
            $data = array(
                'password' => md5($new_pw)
            );

            $this->db->where('email', $email);
            $this->db->update('users', $data);

            echo "New password for " . $email . " is " . $new_pw;

            // Unable to test emailing as it is not hosted on a server. Test later.
            //$this->sendMail($email, $new_pw);

        } else {
            echo "Failed: That email doesn't exists in database";
            $this->load->view('forgotten_pw');
        }
    }

    function getRandomWord($len = 6) {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }

    // UNTESTED
    function sendMail($email, $new_pw)
    {
        $this->load->library('email');

        $this->email->from('note_to_myself@example.com', 'Note_to_myself');
        $this->email->to($email);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Reset password');
        $this->email->message('This is your new password, ' . $new_pw . '.');

        $this->email->send();

        echo $this->email->print_debugger();
    }
}