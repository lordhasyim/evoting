<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller
{
    private $event_id;

    public function __construct()
    {
        parent::__construct();

//        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
//            redirect('/', 'refresh');
//        }
    }

    public function index()
    {
        if($booth_id = $this->session->userdata('booth_id')) {

        }
    }
}