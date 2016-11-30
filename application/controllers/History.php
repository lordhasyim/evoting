<?php defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller
{
    private $event_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in())
            redirect('/', 'refresh');
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
            ->where('voter.status', 'done')
            ->set_subject('Daftar Pemilih '.$data->name)
            ->columns('identity','name','gender','pob','dob','note','status','check_in_time')
            ->callback_column('status',[$this, 'status_column'])
            ->display_as('identity','NIM')
            ->display_as('name','Nama')
            ->display_as('gender','Jenis Kelamin')
            ->display_as('pob','Tempat Lahir')
            ->display_as('dob','Tanggal Lahir')
            ->display_as('note','Keterangan')
            ->display_as('status','Status')
            ->display_as('check_in_time','Waktu Checkin')
            ->fields('event_id','identity','name','gender','pob','dob','note','date_created')
            ->unset_texteditor('note')
            ->field_type('event_id', 'hidden', $this->config->item('default_event_id'))
            ->required_fields('event_id','identity','name','gender')
            ->set_rules('identity', 'NIM','callback_identity_check')
            ->unset_add()
            ->unset_delete()
            ->unset_edit()
            ->unset_read();

        $output = $this->grocery_crud->render();

        //template from admin
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //Booth index content
        $this->load->view('voter/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }

    function identity_check($identity)
    {
        if($identity == null) {
            $this->form_validation->set_message('identity_check', "NIM tidak boleh kosong");
            return FALSE;
        }

        if ($this->db->get_where('voter', [
            'event_id' => $this->event_id,
            'identity' => $identity
        ])->num_rows() > 0) {
            $this->form_validation->set_message('identity_check', "NIM $identity sudah terdaftar sebagai pemilih");
            return FALSE;
        }
        return true;
    }

    function status_column($status) {
        switch ($status) {
            case 'open' :
                return 'Belum Memilih';
            case 'pending' :
                return 'Dalam Antrian';
            case 'process' :
                return 'Proses Memilih';
            case 'done' :
                return 'Telah Memilih';
        }
    }

}