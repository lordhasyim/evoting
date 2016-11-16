<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

//        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
//            redirect('/', 'refresh');
//        }
    }

    public function index()
    {
        $data = $this->db->get_where('booth', ['event_id' => $this->config->item('default_event_id')])->row();

        if($data === null)
            redirect('/', 'refresh');

        $this->grocery_crud
            ->set_table('booth')
            ->where('event_id', $this->config->item('default_event_id'))
            ->set_subject('Daftar Bilik')
            ->columns('title','username','status')
            ->fields('event_id','title','username','password','status')
            ->field_type('event_id', 'hidden', $this->config->item('default_event_id'))
            ->change_field_type('password', 'password')
            ->callback_before_insert(array($this,'encrypt_password_callback'))
            ->callback_before_update(array($this,'encrypt_password_callback'))
            ->callback_edit_field('password',array($this,'input_password_callback'))
            ->display_as('title','Nama Bilik')
            ->required_fields('event_id','title','username')
            ->unset_read()
            ->unset_print()
            ->unset_export();
        $output = $this->grocery_crud->render();

        $this->load->view('booth/index',$output);
    }

    function encrypt_password_callback($post_array) {
        password_hash($post_array['password'], PASSWORD_DEFAULT);
        $post_array['password'] = password_hash($post_array['password'], PASSWORD_DEFAULT);

        return $post_array;
    }

    function input_password_callback($post_array) {
        return '<input id="field-password" class="form-control" name="password" type="password" value="" maxlength="16">';
    }

}