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
//        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

    }

    public function index() {
        $this->load->view('import_excel');
    }

    public function upload() {
        if (isset($_FILES['filename']['size']) && ($_FILES['filename']['size'] > 0)) {
            $config['upload_path'] = './assets/';
            $config['allowed_type'] = 'jpg|jpeg|gif|png';
            $config['max_size'] = '2048';
            $config['encrypt_name'] = true;

            $this->load->library('upload');
            $this->upload->initialize($config);
            if ($this->upload->do_upload('filename') === false) {
                echo "s";
                echo "terjadi kesalahan, upload gagal";
            } else {
                echo "e";
                $media = $this->upload->data();
                var_dump($media);
                $this->load->view('import_success', $media);
            }
        }
        echo "A";


    }
    /*private function do_import_excel() {

        try {
            $inputFileType  = IOFactory::identify($inputFileName);
            $objReader      = IOFactory::createReader($inputFileType);
            $objPHPExcel    = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Terjadi kesalahan "'.pathinfo($inputFileName,PATHINFO_BASENAME). '": '. $e->getMessage());
        }

        $sheet         = $objPHPExcel->getSheet(0);
        $higestRow     = $sheet->getHighestRow();
        $higestColumn  = $sheet->getHighestColumn();

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
            //sesuaikan nama tabel
            $insert = $this->db->insert("t_pemilih", $data);
            delete_files($media['file_path']);
        }
     redirect('ImportExcel/');
    }*/


}











