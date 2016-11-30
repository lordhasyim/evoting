<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VoterWaiting extends CI_Controller
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
            ->where('voter.status', 'pending')
            ->order_by('check_in_time')
            ->set_subject('Daftar Pemilih '.$data->name)
            ->columns('identity','name','gender','pob','dob','note')
            ->display_as('identity','NIM')
            ->display_as('name','Nama')
            ->display_as('gender','Jenis Kelamin')
            ->display_as('pob','Tempat Lahir')
            ->display_as('dob','Tanggal Lahir')
            ->display_as('note','Keterangan')
            ->add_action('Arahkan ke Bilik', '', 'process','ui-icon-play')
            ->unset_add()
            ->unset_delete()
            ->unset_edit()
            ->unset_print()
            ->unset_export()
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
        $this->load->view('voter-waiting/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }

    public function process($id)
    {
        $data = $this->db
            ->from('voter')
            ->where('event_id', $this->config->item('default_event_id'))
            ->where('voter_id', $id)
            ->where('status', 'pending')
            ->count_all_results();

        if($data == 0) {
            $this->session->set_flashdata('message', 'pemilih tidak ditemukan dalam antrian');
            redirect('voterwaiting', 'refresh');
        }

        $result = $this->db->query("
select *,
	(select v.`voter_id` from voting v where v.`booth_id` = b.`booth_id` and v.`status` <> true limit 1) as voter_id
	from `booth` b where  b.`status` = true and event_id =".$this->config->item('default_event_id'))->result();

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
        $return['voter_id'] = $id;

        //template from admin
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //Booth index content
        $this->load->view('voter-waiting/directing',$return);
        //footer
        $this->load->view('admin/themes/footer');

    }

    public function directing($voter_id, $booth_id)
    {
        $voter = $this->db->get_where('voter', [
            'voter_id' => $voter_id,
            'status' => 'pending'
        ])->row();

        if($voter === null)
            redirect('voterwaiting', 'refresh');


        $booth = $this->db->get_where('booth', [
            'booth_id' => $booth_id,
            'status' => true
        ])->row();

        if($booth === null)
            redirect('voterwaiting', 'refresh');

        $count_booth = $this->db
            ->from('voting')
            ->where('booth_id', $voter_id)
            ->where('status', false)
            ->count_all_results();

        if($count_booth > 0) {
            $this->session->set_flashdata('message', 'bilik sedang digunakan');
            redirect('voterwaiting', 'refresh');
        }


        $section = $this->db->get_where('section', [
            'event_id' => $this->config->item('default_event_id')
        ])->result();

        foreach($section as $item) {
            $insert[] = [
                'section_id' => $item->section_id,
                'voter_id' => $voter_id,
                'booth_id' => $booth_id,
                'status' => false

            ];
        }

        $this->db->insert_batch('voting', $insert);


        $this->db
            ->where('voter_id', $voter_id)
            ->set('status', 'process')
            ->update('voter');

        $output['message'] = $voter->identity.' silakan masuk bilik '.$booth->title;

        //template from admin
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //Booth index content
        $this->load->view('voter-waiting/summary',$output);
        //footer
        $this->load->view('admin/themes/footer');
    }
}