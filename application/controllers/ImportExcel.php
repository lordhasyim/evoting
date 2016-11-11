<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Hasyim
 * Date: 10/11/2016
 * Time: 10.41
 */

class ImportExcel extends CI_Controller {



    function __construct() {
        parent::__construct();
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
    }

    public function index() {
        $data['title'] = 'Upload Excel';
        if($this->input->post() ){
            if (isset($_FILES['filename']['size']) && ($_FILES['filename']['size'] > 0)) {
                $config['upload_path'] = './assets/upload/';
                $config['allowed_types'] = 'xls|xlsx|csv';
                $config['max_size'] = '2048';
                $config['encrypt_name'] = true;

                $this->load->library('upload',$config);
                if ($this->upload->do_upload('filename') === false) {
                    $data['status'] = false;
                    $data['message'] = $this->upload->display_errors();
                }else {
                    $import = $this->doImportExcel($this->upload->data());
                    $data['status'] = true;
                    $data['success_imported'] = $import['success_imported'];
                    $data['fail_imported'] = $import['fail_imported'];
                    $data['file'] = $this->upload->data();
                }
            }
        }
        $this->load->view('import_excel',$data);
    }

    /**
     * @param array $inputFileName
     */
    private function doImportExcel(array $inputFileName) {

        try {
            $inputFileType  = IOFactory::identify($inputFileName['full_path']);
            $objReader      = IOFactory::createReader($inputFileType);
            $objPHPExcel    = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Terjadi kesalahan "'.pathinfo($inputFileName,PATHINFO_BASENAME). '": '. $e->getMessage());
        }

        $sheet         = $objPHPExcel->getSheet(0);
        $higestRow     = $sheet->getHighestRow();
        $higestColumn  = $sheet->getHighestColumn();

        $i = 1;
        $j = 1;
        for ($row = 2; $row <= $higestRow; $row++) {
            $rowData =  $sheet->rangeToArray( //Read a row of data into an array
                'A' . $row . ':' . $higestColumn . $row
                ,null
                ,TRUE
                ,FALSE
            );
            //sesuaikan nama kolom tabel di database
            $data = array(
                "identitas_pemilh"  => $rowData[0][1],
                "nama_pemilih"      => $rowData[0][3],
                "tempat_pemilih"    => $rowData[0][4],
                "tgl_lahir"         => $rowData[0][5],
                "jk"                => $rowData[0][6],
                "keterangan"        => $rowData[0][2]
            );

            $this->db->insert("t_pemilih", $data);

            $this->db->affected_rows() === true ? $i++ : $j++;
        }

        return [
            'success_imported' => $i,
            'fail_imported' => $j
        ];
    }
}











