<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        $this->load->helper('url');
        $this->load->helper(array('form'));
    }

    function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $formSubmit = $this->input->post('submit');
            $session_data = $this->session->userdata('logged_in');
            // Retrieves user's email and id
            $data['email'] = $session_data['email'];
            $id['id'] = $session_data['id'];
            // Changes string id into int
            $int_id = intval($id['id']);
            // If user has clicked the save button, save to database
            if ($formSubmit == "Save") {
                $this->user->replace_notes($int_id);
                $this->user->replace_tbd($int_id);
                $this->user->replace_websites($int_id);
            }
            // Get updated data from database
            $notes = $this->user->get_user_data($int_id, "note", "notes");
            $tbd   = $this->user->get_user_data($int_id, "tbd", "tbd");
            $url   = $this->user->get_user_data_url($int_id, "url", "url");
            //var_dump($url);

            $data['note'] = $notes;
            $data['tbd']  = $tbd;
            $data['url']  = $url;

            // Pass data to view
            $this->load->view('home_view', $data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }

    function save() {
        $formSubmit = $this->input->post('submit');
        if (!$formSubmit == "Save") {
            echo "clicked save";
        }
    }

}

?>