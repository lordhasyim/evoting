<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public $is_admin;
    public $logged_in_name;

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in())
            redirect('/', 'refresh');
        $this->is_admin = $this->ion_auth->is_admin();
        $user = $this->ion_auth->user()->row();
        $this->logged_in_name = $user->first_name;

        if($this->ion_auth->in_group('wadek'))
            redirect('voting-result');

    }

    // log the user in
    public function index()
    {

        $query = $this->db->query("SELECT status, COUNT(*) as total FROM voter WHERE event_id = ".$this->config->item('default_event_id')."
GROUP BY status")->result_array();


        $num_rows = $this->db->get_where('voter', ['event_id' => $this->config->item('default_event_id')])->num_rows();

        $graph = [];
        foreach ($query as $item) {
            $graph[] = [
                'name' => $this->status_column($item['status'])." (".$item['total'].")",
                'y' => $item['total'] / $num_rows
            ];
        }
        $data['graph'] = json_encode($graph);

        $username = $this->ion_auth->user()->row();
        $data['username'] = $username;


        $data['booths'] = $this->db->get_where('booth', ['event_id' => $this->config->item('default_event_id'), 'status' => true])->result();


        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //candidate index content
        $this->load->view('admin/dashboard', $data);
        //footer
        $this->load->view('admin/themes/footer');

    }

    private function status_column($status) {
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

    public function booth($boothId)
    {
        $data = $this->db
            ->from('voting')
            ->join('voter','voter.voter_id = voting.voter_id')
            ->where('voting.booth_id', $boothId)
            ->where('voting.status', false)
            ->limit(1)
            ->get()->row_array();

        echo json_encode($data);

    }

    public function graph()
    {
        $query = $this->db->query("SELECT status, COUNT(*) as total FROM voter WHERE event_id = " . $this->config->item('default_event_id') . "
GROUP BY status")->result_array();

        $num_rows = $this->db->get_where('voter', ['event_id' => $this->config->item('default_event_id')])->num_rows();

        foreach ($query as $item) {
            $graph[] = [
                'name' => $this->status_column($item['status'])." (".$item['total'].")",
                'y' => $item['total'] / $num_rows
            ];
        }
        echo json_encode($graph);
    }

    public function voterPercentage()
    {

        $query = $this->db->query("SELECT status, COUNT(*) as total FROM voter WHERE event_id = ".$this->config->item('default_event_id')."
GROUP BY status")->result_array();


        $num_rows = $this->db->get_where('voter', ['event_id' => $this->config->item('default_event_id')])->num_rows();

        $graph = [];
        foreach ($query as $item) {
            $graph[] = [
                'name' => $this->status_column($item['status'])." (".$item['total'].")",
                'y' => $item['total'] / $num_rows
            ];
        }
        $data['graph'] = json_encode($graph);

        $username = $this->ion_auth->user()->row();
        $data['username'] = $username;


        $data['booths'] = $this->db->get_where('booth', ['event_id' => $this->config->item('default_event_id'), 'status' => true])->result();

        $this->load->view('admin/themes/header');
        $this->load->view('voter-percentage/index', $data);

    }
}