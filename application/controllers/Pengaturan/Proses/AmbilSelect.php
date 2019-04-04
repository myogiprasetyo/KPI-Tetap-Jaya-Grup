<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AmbilSelect extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        if ($this->session->userdata('NIK') == '') {
            redirect ('Autentikasi');
        }
        
        date_default_timezone_set('Asia/Jakarta');
	}
    
    public function Jabatan() {
        $devisi = $this->input->post('Devisi');
        
        $this->load->model('Karyawan/Posisi');
        
        $data = $this->Posisi->FilterJabatan(array('Devisi' => $devisi))->result();
        
        echo json_encode($data);
    }
    
    public function HakAkses() {
        $karyawan = $this->input->post('Karyawan');
        
        $this->load->model('Karyawan/Pengguna');
        
        $data = $this->Pengguna->Filter(array('NIK' => $karyawan))->result();
        
        echo json_encode($data);
    }
}

?>