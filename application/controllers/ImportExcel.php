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
		$this->grocery_crud
            ->set_table('uploads')
            ->where('event_id', $this->config->item('default_event_id'))
            ->set_subject('Daftar File')
            ->columns('date_created','file','imported','duplicate','voter')
            ->fields('event_id','file')
            ->field_type('event_id', 'hidden', $this->config->item('default_event_id'))
            ->callback_after_insert(array($this,'doImportExcel'))
            ->display_as('file','Nama File')
            ->display_as('imported','Jumlah data ter-import')
            ->display_as('duplicate','Data Duplicate')
            ->display_as('voter','Jumlah Pemilih')
            ->required_fields('event_id','file')
            ->set_field_upload('file','assets/uploads/files')
 //           ->add_action('Generate', '', 'ImportExcel/doImportExcel','ui-icon-grip-dotted-horizontal')
            ->unset_read()
            ->unset_print()
            ->unset_edit()
            ->unset_delete()
            ->unset_export();
        $output = $this->grocery_crud->render();

        //template from admin
        //header
        $this->load->view('admin/themes/header');
        //nav, top menu
        $this->load->view('admin/themes/nav');
        //sidebar
        $this->load->view('admin/themes/sidebar');
        //Booth index content
        $this->load->view('upload/index',$output);
        //footer
        $this->load->view('admin/themes/footer');
	}

    public function backup() {
        if ($this->checkEventAuthority($this->config->item('default_event_id')) === false)
            redirect('/','refresh');

        $data['message'] = null;
        $data['title'] = 'Upload Excel';
        if($this->input->post() ){
            if (isset($_FILES['filename']['size']) && ($_FILES['filename']['size'] > 0)) {
				
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'xls|xlsx|csv';
                $config['max_size'] = '2048';
                $config['encrypt_name'] = true;

                $this->load->library('upload',$config);
                if ($this->upload->do_upload('filename') === false) {
                    $data['message'] = $this->upload->display_errors();
                }else {
                    $media = $this->upload->data();
                    $inputFileName = './assets/uploads/'.$media['file_name'];
                    $import = $this->doImportExcel($inputFileName);
                    if($data['status'] = true) {
                        $data['message'] = $import['success_imported'];
                    } else {
                        $data['message'] = $import['fail_imported'];
                    }
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

    function checkEventAuthority($id) {
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
    function doImportExcel($post_array,$primary_key) {
		
		$data = $this->db->get_where('uploads',['upload_id' => $primary_key])->row_array();
		
		$inputFileName = './assets/uploads/files/'.$data['file'];
		
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
                    'event_id' => $this->config->item('default_event_id'),
                    'identity' => $rowData[0][1]
                ])->num_rows() < 1) {
                $data = array(
                    "event_id"  => $this->config->item('default_event_id'),
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
		
		$voter = $this->db->get_where('voter',['event_id' => $this->config->item('default_event_id')])->num_rows();
		
		$this->db->set('imported', $i);
		$this->db->set('duplicate', $j);
		$this->db->set('voter', $voter);
		$this->db->where('upload_id', $primary_key);
		$this->db->update('uploads');

        return true;
    }
}











