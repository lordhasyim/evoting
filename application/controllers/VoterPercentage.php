<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VoterPercentage extends CI_Controller {
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

    }

    // log the user in
    public function index()
    {

        $query = $this->db->query("SELECT status, COUNT(*) as total FROM voter WHERE event_id = ".$this->config->item('default_event_id')."
GROUP BY status")->result_array();


        $num_rows = $this->db->get_where('voter', ['event_id' => $this->config->item('default_event_id')])->num_rows();

        //for testing
        $graph = null;

        foreach ($query as $item) {
            $graph[] = [
                'name' => $this->status_column($item['status']),
                'y' => $item['total'] / $num_rows
            ];
        }
        $data['graph'] = json_encode($graph);

        $username = $this->ion_auth->user()->row();
        $data['username'] = $username;

        $this->load->view('admin/themes/header');
        //candidate index content
        $this->load->view('voter-percentage/index', $data);
        //footer
        $this->load->view('admin/themes/footer');
     
    }

    public function data()
    {
        $query = $this->db->query("SELECT status, COUNT(*) as total FROM voter WHERE event_id = " . $this->config->item('default_event_id') . "
GROUP BY status")->result_array();


        $num_rows = $this->db->get_where('voter', ['event_id' => $this->config->item('default_event_id')])->num_rows();

        foreach ($query as $item) {
            $graph[] = [
                'name' => $item['status'],
                'y' => $item['total'] / $num_rows
            ];
        }
        $data['graph'] = json_encode($graph);
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
}