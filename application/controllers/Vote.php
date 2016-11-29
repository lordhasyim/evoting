<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller
{
    private $event_id;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('booth_id')) {
            redirect('/', 'refresh');
        }
    }

    public function index()
    {
        $data = null;
        if($booth_id = $this->session->userdata('booth_id')) {
            $data = $this->db
                ->select('event.name as event_name, event.timer as event_timer, voter.*')
                ->from('voting')
                ->join('voter', 'voter.voter_id = voting.voter_id')
                ->join('event', 'event.event_id = voter.event_id')
                ->where('voting.status', false)
                ->where('voting.booth_id', $booth_id)
                ->order_by('voting.date_created', 'asc')
                ->limit(1)->get()->row();
        }

        if($data === null)
            redirect('vote-waiting', 'refresh');

        $this->load->view('vote/index',['data'=>$data]);
    }

    public function candidate_list($voter_id)
    {
        $data = null;
        if($booth_id = $this->session->userdata('booth_id')) {
            $voting = $this->db
                ->from('voting')
                ->join('section','section.section_id = voting.section_id')
                ->where('voting.status', false)
                ->where('voting.voter_id', $voter_id)
                ->where('voting.booth_id', $booth_id)
                ->order_by('voting.date_created', 'asc')
                ->limit(1)->get()->row();

            if(!isset($voting)) {
                redirect('vote-waiting', 'refresh');
            }

            $data = $this->db
                ->select('voting.voting_id, candidate.*')
                ->from('voting')
                ->join('section','section.section_id = voting.section_id')
                ->join('candidate','candidate.section_id = section.section_id')
                ->where('voting.voting_id', $voting->voting_id)
                ->where('voting.status', $voting->status)
                ->get()
                ->result();
        }

        $this->load->view('vote/candidate',['data' => $voting, 'items'=>$data]);
    }

    public function vote($voting_id, $candidate_id = null)
    {
        $voting = $this->db->get_where('voting', ['voting_id' => $voting_id, 'status' => false])->row();

        if($voting === null) {
            $this->session->set_flashdata('message', 'data tidak ditemukan');
            $this->load->view('vote/waiting');
        }

        $this->db->set('candidate_id', $candidate_id);
        $this->db->set('status', true);
        $this->db->where('status', false);
        $this->db->where('voting_id', $voting_id);
        $this->db->update('voting');

        if($this->db->affected_rows() > 0) {

            $voter = $this->db
                ->from('voting')
                ->where('voting.voting_id =', $voting_id)->get()->row();

            $data = $this->db
                ->from('voting')
                ->where('voting.status', false)
                ->where('voting.voting_id !=', $voting_id)
                ->order_by('voting.date_created', 'asc')
                ->limit(1)->get()->row();

            if(!isset($data)) {
                $this->db->set('status','done');
                $this->db->where('status','process');
                $this->db->where('voter_id',$voter->voter_id);
                $this->db->update('voter');

                redirect('vote-waiting', 'refresh');
            }

            redirect('section-vote/'.$data->voter_id,'refresh');
        } else {
            $this->session->set_flashdata('message', 'update data gagal');
            redirect('vote-waiting', 'refresh');
        }
    }

    public function waiting() {
        $data = null;
        if($booth_id = $this->session->userdata('booth_id')) {
            $data = $this->db
                ->from('voting')
                ->join('voter', 'voter.voter_id = voting.voter_id')
                ->where('voting.status', false)
                ->where('voting.booth_id', $booth_id)
                ->order_by('voting.date_created', 'asc')
                ->limit(1)->get()->row();
        }

        if($data !== null)
            redirect('vote', 'refresh');

        $this->load->view('vote/waiting');
    }

    public function check()
    {
        $data = null;
        if($booth_id = $this->session->userdata('booth_id')) {
            $data = $this->db
                ->from('voting')
                ->join('voter', 'voter.voter_id = voting.voter_id')
                ->where('voting.status', false)
                ->where('voting.booth_id', $booth_id)
                ->order_by('voting.date_created', 'asc')
                ->get()->num_rows();
        }

        if($data < 1) {
            echo json_encode(['status' => false]);
        } else {
            echo json_encode(['status' => true]);
        }
    }
}