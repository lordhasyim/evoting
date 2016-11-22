<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VotingDetail extends CI_Controller
{
    private $section_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
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
            ->set_table('voting')
            ->set_relation('voter_id','voter','name',['status' => 'done'])
            ->set_relation('candidate_id','candidate','name')
            ->set_relation('booth_id','booth','title')
            ->where('voting.section_id', $section_id)
            ->set_subject('Detail Pemilihan')
            ->columns('date_created','voter_id','candidate_id','booth_id')
            ->display_as('date_created','Waktu Memlih')
            ->display_as('voter_id','Nama Pemilih')
            ->display_as('candidate_id','Nama Kandidat')
            ->display_as('booth_id','Nama Bilik')
            ->unset_add()
            ->unset_delete()
            ->unset_edit()
            ->unset_read();
        $output = $this->grocery_crud->render();

        //template from admin themes
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //candidate index content
        $this->load->view('voting-detail/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }

}