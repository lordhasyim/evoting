<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VoterList extends CI_Controller
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
        $data = $this->db->get_where('event', ['event_id' => $this->config->item('default_event_id')])->row();

        if($data === null)
            redirect('/', 'refresh');

        $this->event_id = $this->config->item('default_event_id');

        $this->grocery_crud
            ->set_table('voter')
            ->where('event_id', $this->config->item('default_event_id'))
            ->where('status', 'open')
            ->set_subject('Daftar Pemilih '.$data->name)
            ->columns('identity','name','gender','pob','dob','note')
            ->display_as('identity','NIM')
            ->display_as('name','Nama')
            ->display_as('gender','Jenis Kelamin')
            ->display_as('pob','Tempat Lahir')
            ->display_as('dob','Tanggal Lahir')
            ->display_as('note','Keterangan')
            ->add_action('Check In', '', 'check-in','ui-icon-play')
            ->unset_add()
            ->unset_delete()
            ->unset_edit()
            ->unset_read();

        $output = $this->grocery_crud->render();

        $this->load->view('voter/index',$output);
    }

    public function checkIn($id)
    {
        $data = $this->db->get_where('voter', ['voter_id' => $id, 'status' => 'open'])->row_array();

        if($data === null) {
            $this->session->set_flashdata('message', 'data pemilih tidak ditemukan');
            redirect('voterlist', 'refresh');
        }

        $this->db
            ->where('voter_id', $id)
            ->set('status', 'pending')
            ->set('check_in_time', date('Y-m-d h:i:s'))
            ->update('voter');

        $this->load->view('voter/summary',$data);
    }

}