<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller
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
        echo json_encode($data);
    }

    public function candidate_list($voter_id)
    {
        $data = null;
        if($booth_id = $this->session->userdata('booth_id')) {
            $voting = $this->db
                ->from('voting')
                ->where('voting.status', false)
                ->where('voting.voter_id', $voter_id)
                ->where('voting.booth_id', $booth_id)
                ->order_by('voting.date_created', 'asc')
                ->limit(1)->get()->row();

            $data = $this->db
                ->select('voting.voting.id, candidate.*')
                ->from('voting')
                ->join('event','event.event_id = voting.event_id')
                ->join('section','section.event_id = event.event_id')
                ->join('candidate','candidate.section_id = candidate.section_id')
                ->where('voting.voting_id', $voting->voting_id)
                ->where('voting.status', $voting->false)
                ->get()
                ->result();
        }

        echo json_encode($data);
    }

    public function vote($voting_id, $candidate_id)
    {
        $voting = $this->db->get_where('voting', ['voting_id' => $voting_id, 'status' => false])->row();

        if($voting === null) {
            echo json_encode([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ]);
        }

        $this->db->set('candidate_id', $candidate_id);
        $this->db->set('status', true);
        $this->db->where('status', false);
        $this->db->where('voting_id', $voting_id);
        $this->db->update('voting');

        if($this->db->affected_rows() > 0) {
            echo json_encode([
                'status' => true
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'update data gagal'
            ]);
        }
    }
}