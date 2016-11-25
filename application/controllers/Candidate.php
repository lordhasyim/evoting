<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller
{
    private $section_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')) {
            redirect('/', 'refresh');
        }
    }

    public function index($section_id)
    {
        $data = $this->db->get_where('section', ['section_id' => $section_id])->row();

        if($data === null)
            redirect('/', 'refresh');

        $this->section_id = $section_id;

        $this->grocery_crud
            ->set_table('candidate')
            ->where('section_id', $section_id)
            ->order_by('serial_number')
            ->set_subject('Daftar Kandidat '.$data->title)
            ->columns('identity','name','serial_number','motto','picture')
            ->display_as('identity','NIM')
            ->display_as('name','Nama')
            ->display_as('serial_number','No Urut')
            ->display_as('motto','Motto')
            ->display_as('picture','Foto')
            ->fields('section_id','identity','name','serial_number','motto','picture')
            ->field_type('section_id', 'hidden', $section_id)
            ->set_field_upload('picture','assets/uploads/files')
            ->unset_texteditor('motto')
//            ->set_rules('identity', 'NIM','required|is_unique[candidate.identity]')
//            ->set_rules('serial_number', 'No Urut','callback_serial_number_check')
            ->required_fields('section_id','identity','name','serial_number','picture');
        $output = $this->grocery_crud->render();

        //template from admin themes
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //candidate index content
        $this->load->view('candidate/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }

//    function identity_check($identity)
//    {
//        if ($this->db->get_where('candidate', [
//            'section_id' => $this->section_id,
//            'identity' => $identity
//        ])->num_rows() > 0) {
//            $this->form_validation->set_message('identity_check', "NIM $identity sudah terdaftar sebagai kandidat");
//            return FALSE;
//        }
//        return true;
//    }
//
//
//    function serial_number_check($serial_number)
//    {
//        if ($this->db->get_where('candidate', [
//                'section_id' => $this->section_id,
//                'serial_number' => $serial_number
//            ])->num_rows() > 0) {
//            $this->form_validation->set_message('serial_number_check', "$serial_number sudah terdaftar");
//            return FALSE;
//        }
//        return true;
//    }

}