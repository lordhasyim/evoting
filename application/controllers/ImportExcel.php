<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Hasyim
 * Date: 10/11/2016
 * Time: 10.41
 */

class ImportExcel extends CI_Controller
{

    /**
     * @var int $section_id
     */
    private $event_id;

    function __construct() {
        parent::__construct();
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
    }

    public function index() {
        if ($this->checkEventAuthority($this->config->item('default_event_id')) === false)
            redirect('/','refresh');

        $data['title'] = 'Upload Excel';
        if($this->input->post() ){
            if (isset($_FILES['filename']['size']) && ($_FILES['filename']['size'] > 0)) {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'xls|xlsx|csv';
                $config['max_size'] = '2048';
                $config['encrypt_name'] = true;

                $this->load->library('upload',$config);
                if ($this->upload->do_upload('filename') === false) {
                    $data['status'] = false;
                    $data['message'] = $this->upload->display_errors();
                }else {
                    $media = $this->upload->data();
                    $inputFileName = './assets/uploads/'.$media['file_name'];
                    $import = $this->doImportExcel($inputFileName);
                    $data['status'] = true;
                    $data['success_imported'] = $import['success_imported'];
                    $data['fail_imported'] = $import['fail_imported'];
                    $data['file'] = $media;
                }
            }
        }
        //template from admin themes
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //candidate index content
        $this->load->view('import_excel',$data);
        //footer
        $this->load->view('admin/themes/footer');
    }

    private function checkEventAuthority($id) {
        if ($this->db->get_where('event', [
                'event_id' => $id,
//                'user_id' => $this->session->userdata('user_id')
            ])->num_rows() < 1)
            return false;

        $this->event_id = $id;
        return true;
    }

    /**
     * @param $inputFileName
     * @return array
     */
    private function doImportExcel($inputFileName) {

        try {
            $inputFileType  = IOFactory::identify($inputFileName);
            $objReader      = IOFactory::createReader($inputFileType);
            $objPHPExcel    = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Terjadi kesalahan '.pathinfo($inputFileName,PATHINFO_BASENAME). '": '. $e->getMessage());
        }

        $sheet         = $objPHPExcel->getSheet(0);
        $higestRow     = $sheet->getHighestRow();
        $higestColumn  = $sheet->getHighestColumn();

        $i = 0;
        $j = 0;
        for ($row = 2; $row <= $higestRow; $row++) {
            $rowData =  $sheet->rangeToArray( //Read a row of data into an array
                'A' . $row . ':' . $higestColumn . $row
                ,null
                ,TRUE
                ,FALSE
            );

            switch ($rowData[0][6]) {
                case 'L' :
                    $gender = 'male';
                    break;
                case 'P' :
                    $gender = 'female';
                    break;
                default:
                    $gender = null;
                    break;
            }

            if ($this->db->get_where('voter', [
                    'section_id' => $this->event_id,
                    'identity' => $rowData[0][1]
                ])->num_rows() < 1) {
                $data = array(
                    "event_id"  => $this->event_id,
                    "identity"  => $rowData[0][1],
                    "name"      => $rowData[0][3],
                    "gender"    => $gender,
                    "pob"                => $rowData[0][4],
                    "dob"        => $rowData[0][5],
                    "note"        => $rowData[0][8]."/".$rowData[0][2],
                    "status"        => 'open'
                );

                $this->db->insert("voter", $data);
                $i++;
            } else {
                $j++;
            }
        }

        return [
            'success_imported' => $i,
            'fail_imported' => $j
        ];
    }
}











