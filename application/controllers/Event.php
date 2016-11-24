<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('/', 'refresh');
        }
    }

    public function index()
    {
        $data = $this->db->get_where('section', ['event_id' => $this->config->item('default_event_id')])->row();

        if($data === null)
            redirect('/', 'refresh');

        $this->grocery_crud
            ->set_table('event')
            ->where('user_id', $this->session->userdata('user_id'))
            ->order_by('date_created', 'asc')
            ->set_subject('Daftar Event')
            ->columns('date_created','name','status')
            ->add_fields('user_id','name')
            ->edit_fields('user_id','name','status')
            ->field_type('user_id', 'hidden', $this->session->userdata('user_id'))
            ->display_as('date_created','Tanggal')
            ->display_as('name','Nama Event')
            ->unset_texteditor('name')
            ->required_fields('user_id','name')
            ->callback_before_update(array($this,'set_inactive'))
            ->unset_delete()
            ->unset_read()
            ->unset_print()
            ->unset_export();

        $output = $this->grocery_crud->render();

        //template from admin themes
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //candidate index content
        $this->load->view('event/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }

    public function set_inactive($post_array, $primary_key){
        if($post_array['status'] == true) {
            $this->db->set('status', false);
            $this->db->update('event');
        }
    }
}