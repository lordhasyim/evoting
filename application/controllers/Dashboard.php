<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public $is_admin;
    public $logged_in_name;

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in())
            redirect('/', 'refresh');
        $this->is_admin = $this->ion_auth->is_admin();
        $user = $this->ion_auth->user()->row();
        $this->logged_in_name = $user->first_name;

    }

    // log the user in
    public function index()
    {
        //var_dump($this->session->userdata());
        //$data['tes'] = $this->session->userdata('username');
        //$username = $this->session->userdata('admin');
        $username = $this->ion_auth->user()->row();
        $data['username'] = $username;
        $this->load->view('admin/dashboard', $data);
     
    }
}