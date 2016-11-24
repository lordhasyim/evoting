<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group('admin')) {
            redirect('/', 'refresh');
        }
    }

    public function index()
    {
        $data = $this->db->get_where('booth', [
            'event_id' => $this->config->item('default_event_id'),
            'status' => true
        ])->result();

        if($data === null)
            redirect('/', 'refresh');

        $this->grocery_crud
            ->set_table('booth')
            ->where('event_id', $this->config->item('default_event_id'))
            ->set_subject('Daftar Bilik')
            ->columns('title','status')
            ->fields('event_id','title','password','status')
            ->field_type('event_id', 'hidden', $this->config->item('default_event_id'))
            ->change_field_type('password', 'password')
            ->callback_before_insert(array($this,'encrypt_password_callback'))
            ->callback_before_update(array($this,'encrypt_password_callback'))
            ->callback_edit_field('password',array($this,'input_password_callback'))
            ->display_as('title','Nama Bilik')
            ->required_fields('event_id','title')
            ->add_action('Counter', '', 'booth-counter','ui-icon-grip-dotted-horizontal')
            ->add_action('Login Sebagai Bilik', '', 'booth-login','ui-icon-grip-dotted-horizontal')
            ->unset_read()
            ->unset_print()
            ->unset_export();
        $output = $this->grocery_crud->render();

        //template from admin
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //Booth index content
        $this->load->view('booth/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }

    function encrypt_password_callback($post_array) {
        password_hash($post_array['password'], PASSWORD_DEFAULT);
        $post_array['password'] = password_hash($post_array['password'], PASSWORD_DEFAULT);

        return $post_array;
    }

    function input_password_callback($post_array) {
        return '<input id="field-password" class="form-control" name="password" type="password" value="" maxlength="16">';
    }

    public function login($booth_id)
    {

        $data = $this->db->get_where('booth', [
            'event_id' => $booth_id,
            'status' => true
        ])->result();

        if($data === null)
            redirect('/', 'refresh');

        $this->form_validation->set_rules(
            'password',
            str_replace(':', '', $this->lang->line('login_password_label')),
            'required'
        );

        $row = $this->db->get_where('booth', [
            'booth_id' => $booth_id,
            'status' => true
        ])->row();

        if ($this->form_validation->run() == true)
        {

            if($row !== null)
            {
                if (password_verify($this->input->post('password'), $row->password))
                {
                    $this->ion_auth->logout();
                    redirect('login/booth/'.$booth_id, 'refresh');

                }
                $this->session->set_flashdata('message', 'password salah');
            } else {
                $this->session->set_flashdata('message', 'data bilik tidak ditemukan');
                redirect('booth-list', 'refresh');
            }
        }

        $this->data['item'] = $row;
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');


        $this->data['password'] = array('name' => 'password',
            'id'   => 'password',
            'type' => 'password',
        );

        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //Booth index content
        $this->load->view('booth/login', $this->data);
        //footer
        $this->load->view('admin/themes/footer');
    }

    public function monitoring()
    {
        $result = $this->db->query("
select *,
	(select v.`voter_id` from voting v where v.`booth_id` = b.`booth_id` and v.`status` <> true limit 1) as voter_id
	from `booth` b where  b.`status` = true")->result();

        if($result === null)
            redirect('voterwaiting', 'refresh');

        foreach($result as $row) {


            $identity = null;
            $name = null;
            $note = null;

            if ($row->voter_id !== null) {
                $voter = $this->db->get_where('voter',
                    [
                        'event_id' => $this->config->item('default_event_id'),
                        'voter_id'  => $row->voter_id
                    ])->row();

                $identity = $voter->identity;
                $name = $voter->name;
                $note = $voter->note;
            }

            $return['data'][] = [
                'booth_id' => $row->booth_id,
                'title' => $row->title,
                'voter_id' => $row->voter_id,
                'identity' => $identity,
                'name' => $name,
                'note' => $note
            ];
        }

        //template from admin
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //Booth index content
        $this->load->view('booth/lists',$return);
        //footer
        $this->load->view('admin/themes/footer');
    }

    public function counter($booth_id)
    {
        $data = $this->db
            ->from('voting')
            ->join('booth', 'booth.booth_id = voting.booth_id')
            ->join('voter', 'voter.voter_id = voting.voter_id')
            ->where('voting.status', false)
            ->where('voting.booth_id', $booth_id)
//            ->group_by('voter.voter_id')
            ->order_by('voting.date_created', 'asc')
            ->limit(1)->get()->row_array();


        $this->load->view('booth/counter',['data' => $data]);

    }

    public function logout()
    {
        $this->session->unset_userdata(['booth_id']);
        redirect('/logout', 'refresh');
    }

}