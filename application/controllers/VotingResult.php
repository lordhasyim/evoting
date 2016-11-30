<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VotingResult extends CI_Controller
{
    private $section_id;

    public function __construct()
    {
        parent::__construct();

    }

    public function index($section_id)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('/', 'refresh');
        }

        $row = $this->db->get_where('section',
            ['section_id' => $section_id, 'event_id' => $this->config->item('default_event_id')])->row();

        if ($row === null)
            redirect('/', 'refresh');

        $data['section_id'] = $section_id;
        $data['section'] = $row;

        $num_rows = $this->db->get_where('voting', ['section_id' => $section_id, 'status' => true])->num_rows();

        $query = $this->db->query("select IFNULL(c.name,'Golput') as graph_name, c.*,  count(IFNULL(v.candidate_id,0)) as voter_total, count(IFNULL(v.candidate_id,0))/$num_rows as percentage from `voting` v
LEFT JOIN candidate c on c.candidate_id = v.candidate_id
WHERE v.section_id = $section_id
AND v.status = true
GROUP BY v.candidate_id")->result_array();


        $graph = null;
        foreach ($query as $item) {
            $graph[] = [
                'name' => $item['graph_name'],
                'y' => $item['voter_total'] / $num_rows
            ];
        }
        $data['graph'] = json_encode($graph);
        $data['data'] = $query;

        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //candidate index content
        $this->load->view('voting-result/index', $data);
        //footer
        $this->load->view('admin/themes/footer');
    }

    public function data($section_id)
    {

        $row = $this->db->get_where('section',
            ['section_id' => $section_id, 'event_id' => $this->config->item('default_event_id')])->row();

        if ($row === null)
            redirect('/', 'refresh');

        $query = $this->db->query("select IFNULL(c.name,'Golput') as graph_name, c.*,  count(IFNULL(v.candidate_id,0)) as voter from `voting` v
LEFT JOIN candidate c on c.candidate_id = v.candidate_id
WHERE v.section_id = $section_id
AND v.status = true
GROUP BY v.candidate_id")->result_array();


        $num_rows = $this->db->get_where('voting', ['section_id' => $section_id, 'status' => true])->num_rows();

        $graph = null;
        foreach ($query as $item) {
            $graph[] = [
                'name' => $item['graph_name'],
                'y' => $item['voter'] / $num_rows
            ];
        }

        echo json_encode($graph);
    }

    public function result()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('/', 'refresh');
        }

        $row = $this->db->get_where('section',
            ['event_id' => $this->config->item('default_event_id')])->result_array();

        if ($row === null)
            redirect('/', 'refresh');

        $data = null;
        foreach($row as $item) {

            $num_rows = $this->db->get_where('voting', ['section_id' => $item['section_id'], 'status' => true])->num_rows();

            $query = $this->db->query("select IFNULL(c.name,'Abstain') as graph_name, c.*,  count(IFNULL(v.candidate_id,0)) as voter_total, count(IFNULL(v.candidate_id,0))/$num_rows as percentage from `voting` v
LEFT JOIN candidate c on c.candidate_id = v.candidate_id
WHERE v.section_id = ".$item['section_id']."
AND v.status = true
GROUP BY v.candidate_id")->result_array();

            $graph = null;
            foreach ($query as $list) {
                $graph[] = [
                    'name' => $list['graph_name']." (".$list['voter_total'].")",
                    'y' => $list['voter_total'] / $num_rows * 100
                ];
            }

            $data[] = [
                'section' => $item,
                'data' => $query,
                'graph' => json_encode($graph)
            ];
        }



        $this->load->view('admin/themes/header');
        $this->load->view('voting-result/result', ['data' => $data]);
    }
}