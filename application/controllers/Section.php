<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in())
            redirect('/', 'refresh');
    }

    public function index()
    {
//        echo $this->config->item('default_event_id');
//        $data = $this->db->get_where('section', ['event_id' => $this->config->item('default_event_id')])->row();
//
//        if($data === null)
//            redirect('/', 'refresh');

        $this->grocery_crud
            ->set_table('section')
            ->where('event_id', $this->config->item('default_event_id'))
            ->set_subject('Daftar Lembaga Pemilihan')
            ->columns('title','timer')
            ->fields('event_id','title','timer')
            ->field_type('event_id', 'hidden', $this->config->item('default_event_id'))
            ->display_as('title','Nama Lembaga')
            ->display_as('timer','Waktu Pemilihan (detik)')
            ->unset_texteditor('title')
            ->required_fields('event_id','title','timer')
            ->add_action('Lihat Kandidat', '', 'Candidate/index','ui-icon-grip-dotted-horizontal')
//            ->unset_add()
            ->unset_delete()
            ->unset_read_fields('date_created')
            ->unset_read()
            ->unset_print()
            ->unset_export();

        if($this->ion_auth->is_admin()) {
            $this->grocery_crud->add_action('Lihat Detail Pemilih', '', 'VotingDetail/index','ui-icon-grip-dotted-horizontal');
        }
        $output = $this->grocery_crud->render();

        //template from admin themes
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //candidate index content
        $this->load->view('section/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }

}