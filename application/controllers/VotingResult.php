<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VotingResult extends CI_Controller
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

        $row = $this->db->get_where('section',
            ['section_id' => $section_id, 'event_id' => $this->config->item('default_event_id')])->row();

        if($row === null)
            redirect('/', 'refresh');

        $data['section_id'] = $section_id;
        $data['section'] = $row;


        $query = $this->db->query("select IFNULL(c.name,'Golput') as graph_name, c.*,  count(IFNULL(v.candidate_id,0)) as voter_total from `voting` v
LEFT JOIN candidate c on c.candidate_id = v.candidate_id
WHERE v.section_id = $section_id
AND v.status = true
GROUP BY v.candidate_id")->result_array();


        $num_rows = $this->db->get_where('voting', ['section_id' => $section_id, 'status' => true])->num_rows();

        foreach ($query as $item) {
            $graph[] = [
                'name' =>$item['graph_name'],
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
        $this->load->view('voting-result/index',$data);
        //footer
        $this->load->view('admin/themes/footer');
    }

    public function data($section_id){

        $row = $this->db->get_where('section',
            ['section_id' => $section_id, 'event_id' => $this->config->item('default_event_id')])->row();

        if($row === null)
            redirect('/', 'refresh');

        $query = $this->db->query("select IFNULL(c.name,'Golput') as graph_name, c.*,  count(IFNULL(v.candidate_id,0)) as voter from `voting` v
LEFT JOIN candidate c on c.candidate_id = v.candidate_id
WHERE v.section_id = $section_id
AND v.status = true
GROUP BY v.candidate_id")->result_array();


        $num_rows = $this->db->get_where('voting', ['section_id' => $section_id, 'status' => true])->num_rows();

        foreach ($query as $item) {
            $graph[] = [
                'name' =>$item['graph_name'],
                'y' => $item['voter'] / $num_rows
            ];
        }

        echo  json_encode($graph);
    }

}